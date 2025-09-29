<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\BoostingOrder;
use App\Models\Transaction;
use App\Models\WalletDeposit;
use App\Models\ServiceOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class WebhookController extends Controller
{
    /**
     * Xử lý webhook từ SePay (version mới, giống phương thức sepayWebhook)
     */
    public function sepay(Request $request)
    {
        // Thêm log này vào đầu hàm
        Log::info('SePay Webhook Received', [
            'data' => $request->all(),
            'headers' => $request->headers->all()
        ]);
        // Đọc dữ liệu từ request
        $data = $request->all();
        // Kiểm tra loại giao dịch
        if (!isset($data['transferType'])) {
            Log::error('SePay Webhook API: Thiếu thông tin loại giao dịch');
            return response()->json(['status' => 'error', 'message' => 'Thiếu thông tin giao dịch']);
        }
        
        if ($data['transferType'] === 'in') {
            // Tìm đơn hàng dựa trên mã nội dung chuyển khoản
            $pattern = config('payment.pattern', 'SEVQR');
            $content = $data['content'];
            
            if (strpos($content, $pattern) !== false) {
                // BOOST là prefix của đơn hàng cày thuê
                $isBoostingOrder = strpos($content, 'BOOST') !== false;
                // WALLET là prefix của đơn nạp ví
                $isWalletDeposit = strpos($content, 'WALLET') !== false;
                // Trích xuất order_number từ nội dung
                if ($isBoostingOrder) {
                    // Tìm vị trí của "ORDBOOST" trong chuỗi
                    $ordBoostPos = strpos($content, 'ORDBOOST');
                    if ($ordBoostPos !== false) {
                        // Lấy phần sau 'ORDBOOST'
                        $orderNumber = substr($content, $ordBoostPos + 8); // 8 là độ dài của 'ORDBOOST'
                        
                        // Loại bỏ các ký tự không phải số
                        $orderNumber = preg_replace('/[^0-9]/', '', $orderNumber);
                        
                        // Thêm lại prefix để có mã đơn hàng đầy đủ
                        $orderNumber = 'BOOST' . $orderNumber;
                    } else {
                        return response()->json(['success' => true]);
                    }
                } else if ($isWalletDeposit) {
                    // Tìm vị trí của "ORDWALLET" trong chuỗi
                    $ordWalletPos = strpos($content, 'ORDWALLET');
                    if ($ordWalletPos !== false) {
                        // Lấy phần sau 'ORDWALLET'
                        $walletCode = substr($content, $ordWalletPos + 9); // 9 là độ dài của 'ORDWALLET'
                        
                        // Loại bỏ các ký tự không phải số
                        $walletCode = preg_replace('/[^0-9]/', '', $walletCode);
                        
                        // Thêm lại prefix để có mã đơn hàng đầy đủ
                        $depositCode = 'WALLET-' . $walletCode;
                        
                        // Log dữ liệu đầu vào để debug
                        Log::info('SePay Webhook API: Thông tin nạp tiền ví', [
                            'deposit_code_raw' => $depositCode,
                            'transfer_content' => $content,
                            'amount' => $data['transferAmount'] ?? 0
                        ]);
                        
                        // Tìm bản ghi nạp tiền trong database
                        $walletDeposit = null;
                        $userId = null;
                        
                        // Phương pháp 1: Tìm chính xác theo mã ghi nhận
                        $walletDeposit = WalletDeposit::where('deposit_code', $depositCode)
                            ->where('status', 'pending')
                            ->first();
                        
                        // Phương pháp 2: Nếu không tìm thấy, thử tìm kiếm mở rộng với LIKE
                        if (!$walletDeposit) {
                            // Trích xuất phần chính của mã (không bao gồm các ký tự thêm vào bởi cổng thanh toán)
                            $baseCode = substr($walletCode, 0, 10); // Lấy 10 chữ số đầu tiên (phần timestamp)
                            
                            Log::info('SePay Webhook API: Tìm kiếm mở rộng với mã cơ bản', [
                                'base_code' => $baseCode
                            ]);
                            
                            // Tìm các giao dịch pending có mã gần giống
                            $walletDeposit = WalletDeposit::where('deposit_code', 'LIKE', "WALLET-{$baseCode}%")
                                ->where('status', 'pending')
                                ->where('amount', (int)$data['transferAmount']) // Đối chiếu với số tiền
                                ->first();
                        }
                        
                        // Phương pháp 3: Tìm theo format mới (nếu đang sử dụng)
                        // Format mới: WALLET-USER{ID}-{TIMESTAMP}-{RANDOM}
                        if (!$walletDeposit && preg_match('/(\d+)-(\d+)-(\d+)/', $walletCode, $matches)) {
                            if (count($matches) >= 3) {
                                $userId = $matches[1];
                                $timestamp = $matches[2];
                                
                                Log::info('SePay Webhook API: Tìm kiếm theo format mới', [
                                    'user_id' => $userId,
                                    'timestamp' => $timestamp
                                ]);
                                
                                // Tìm giao dịch của user này
                                $walletDeposit = WalletDeposit::where('user_id', $userId)
                                    ->where('deposit_code', 'LIKE', "WALLET-{$userId}-%")
                                    ->where('status', 'pending')
                                    ->where('amount', (int)$data['transferAmount'])
                                    ->orderBy('created_at', 'desc')
                                    ->first();
                            }
                        }
                        
                        // Phương pháp 4: Tìm tất cả giao dịch pending trong khoảng thời gian gần đây
                        if (!$walletDeposit) {
                            // Lấy tất cả giao dịch pending trong 24h gần đây
                            $recentDeposits = WalletDeposit::where('status', 'pending')
                                ->where('amount', (int)$data['transferAmount'])
                                ->where('created_at', '>=', now()->subDay())
                                ->orderBy('created_at', 'desc')
                                ->get();
                            
                            if ($recentDeposits->count() > 0) {
                                // Ưu tiên giao dịch gần nhất
                                $walletDeposit = $recentDeposits->first();
                                
                                Log::info('SePay Webhook API: Tìm thấy giao dịch theo phương pháp 4', [
                                    'deposit_id' => $walletDeposit->id,
                                    'deposit_code' => $walletDeposit->deposit_code,
                                    'created_at' => $walletDeposit->created_at->format('Y-m-d H:i:s')
                                ]);
                            }
                        }
                        
                        if ($walletDeposit) {
                            $userId = $walletDeposit->user_id;
                            $depositCode = $walletDeposit->deposit_code; // Sử dụng mã từ database
                        }
                        
                        if ($userId) {
                            // Nếu tìm thấy người dùng, xử lý nạp tiền vào ví
                            $amount = (int)$data['transferAmount'];
                            
                            try {
                                Log::info('SePay Webhook API: Bắt đầu xử lý nạp tiền', [
                                    'user_id' => $userId,
                                    'deposit_code' => $depositCode,
                                    'amount' => $amount
                                ]);
                                
                                // Gọi phương thức xử lý nạp tiền
                                $result = \App\Http\Controllers\WalletController::processDepositWebhook(
                                    $userId, 
                                    $amount, 
                                    $data, 
                                    $depositCode
                                );
                                
                                Log::info('SePay Webhook API: Xử lý nạp tiền thành công', [
                                    'user_id' => $userId,
                                    'deposit_code' => $depositCode,
                                    'result' => $result
                                ]);
                           
                            } catch (\Exception $e) {
                                Log::error('SePay Webhook API: Lỗi khi xử lý nạp tiền vào ví', [
                                    'user_id' => $userId,
                                    'deposit_code' => $depositCode,
                                    'error' => $e->getMessage(),
                                    'trace' => $e->getTraceAsString()
                                ]);
                            }
                        
                        } else {
                            Log::warning('SePay Webhook API: Không tìm thấy người dùng cho mã nạp tiền', [
                                'deposit_code' => $depositCode,
                                'transfer_content' => $content,
                                'amount' => $data['transferAmount'] ?? 0
                            ]);
                        }
                        
                        // Kiểm tra xem có phải là mã thanh toán dịch vụ (SRV-) hay không
                        if (strpos($orderNumber, 'SRV-') === 0) {
                            Log::info('SePay Webhook: Đơn hàng dịch vụ', ['order_number' => $orderNumber]);
                            $serviceOrder = ServiceOrder::where('order_number', $orderNumber)->first();
                            
                            if ($serviceOrder) {
                                // Cập nhật trạng thái đơn hàng thành 'paid'
                                $serviceOrder->status = 'paid';
                                $serviceOrder->payment_method = 'bank_transfer';
                                $serviceOrder->save();
                                
                                // Lưu giao dịch
                                Transaction::create([
                                    'order_id' => null,
                                    'boosting_order_id' => null,
                                    'game_service_order_id' => $serviceOrder->id,
                                    'amount' => $data['transferAmount'],
                                    'payment_method' => 'bank_transfer',
                                    'transaction_id' => $data['id'] ?? null,
                                    'status' => 'completed',
                                    'notes' => json_encode($data)
                                ]);
                                
                                return response()->json(['success' => true]);
                            } else {
                                Log::warning('SePay Webhook API: Không tìm thấy đơn hàng dịch vụ', [
                                    'order_number' => $orderNumber
                                ]);
                            }
                        }
                        
                        return response()->json(['success' => true]);
                    } else {
                        Log::warning('SePay Webhook API: Không tìm thấy đơn hàng cày thuê', [
                            'content' => $content
                        ]);
                        return response()->json(['success' => true]);
                    }
                } else if (strpos($content, 'ORDPRODUCT') !== false) {
                    // Đơn hàng thường
                    $ordProductPos = strpos($content, 'ORDPRODUCT');
                    if ($ordProductPos !== false) {
                        // Lấy phần sau 'ORDPRODUCT'
                        $cleanedOrderNumber = substr($content, $ordProductPos + 10); // 10 là độ dài của 'ORDPRODUCT'
                        
                        // Loại bỏ các ký tự không phải số và chữ cái
                        $cleanedOrderNumber = preg_replace('/[^0-9A-Z]/', '', $cleanedOrderNumber);
                        
                        // Thêm lại prefix ORD- để có mã đơn hàng đầy đủ
                        $fullOrderNumber = 'ORD-' . $cleanedOrderNumber;
                        // Tìm đơn hàng thường - phương pháp 1: tìm chính xác
                        $order = Order::where('order_number', $fullOrderNumber)
                            ->where('status', 'pending')
                            ->first();
                    
                        if (!$order) {
                            // Phương pháp 2: Tìm kiếm không có ký tự dash
                            $altOrderNumber = str_replace('-', '', $fullOrderNumber); 
                            $order = Order::where('order_number', 'like', '%' . $altOrderNumber . '%')
                                ->where('status', 'pending')
                                ->first();
                                
                            // Phương pháp 3: Tìm kiếm chỉ với phần số
                            if (!$order) {
                                Log::info('SePay Webhook API: Thử tìm kiếm mở rộng với LIKE', [
                                    'cleaned_order_number' => $cleanedOrderNumber
                                ]);
                                $order = Order::where('order_number', 'like', '%' . $cleanedOrderNumber . '%')
                                    ->where('status', 'pending')
                                    ->first();
                            }
                            
                            // Phương pháp 4: Tìm kiếm với toàn bộ order_number
                            if (!$order) {
                                $pendingOrders = Order::where('status', 'pending')->get();
                                foreach ($pendingOrders as $pendingOrder) {
                                    $orderNumberWithoutPrefix = str_replace('ORD-', '', $pendingOrder->order_number);
                                    if (strpos($orderNumberWithoutPrefix, $cleanedOrderNumber) !== false) {
                                        $order = $pendingOrder;
                                        Log::info('SePay Webhook API: Tìm thấy đơn hàng với phương pháp 4', [
                                            'order_number' => $pendingOrder->order_number
                                        ]);
                                        break;
                                    }
                                }
                            }
                        }
                        
                        if ($order) {
                        
                            $order->status = 'completed';
                            $order->completed_at = Carbon::now();
                            $order->save();
                            
                            // Cập nhật trạng thái tài khoản
                            if ($order->account) {
                                $order->account->status = 'sold';
                                $order->account->save();
                            }
                            
                            // Lưu giao dịch
                            Transaction::create([
                                'order_id' => $order->id,
                                'boosting_order_id' => null,
                                'amount' => $data['transferAmount'],
                                'payment_method' => 'bank_transfer',
                                'transaction_id' => $data['id'] ?? null,
                                'status' => 'completed',
                                'notes' => json_encode($data)
                            ]);
                            
                            return response()->json(['success' => true]);
                        } else {
                            Log::warning('SePay Webhook API: Không tìm thấy đơn hàng thường', [
                                'order_number' => $fullOrderNumber
                            ]);
                        }
                    } else {
                        Log::warning('SePay Webhook API: Không thể trích xuất mã đơn hàng thường', [
                            'content' => $content
                        ]);
                        return response()->json(['success' => true]);
                    }
                } else if (strpos($content, 'ORDSRV') !== false) {
                    // Tìm vị trí của "ORDSRV" trong chuỗi
                    $ordSrvPos = strpos($content, 'ORDSRV');
                    if ($ordSrvPos !== false) {
                        // Lấy phần sau 'ORDSRV'
                        $serviceNumberRaw = substr($content, $ordSrvPos + 6); // 6 là độ dài của 'ORDSRV'
                        
                        // Chỉ lấy các số đầu tiên cho đến khi gặp ký tự khác
                        if (preg_match('/^(\d+)/', $serviceNumberRaw, $matches)) {
                            $serviceNumber = $matches[1];
                            
                            // Thêm lại prefix để có mã đơn hàng đầy đủ
                            $orderNumber = 'SRV-' . $serviceNumber;
                            
                            Log::info('SePay Webhook: Tìm thấy đơn hàng dịch vụ', [
                                'order_number' => $orderNumber,
                                'raw_content' => $content,
                                'extracted_number' => $serviceNumber
                            ]);
    
                            // Tìm đơn hàng dịch vụ
                            $serviceOrder = ServiceOrder::where('order_number', $orderNumber)
                                ->where('status', 'pending')
                                ->first();
                            
                            if (!$serviceOrder) {
                                // Thử tìm kiếm mở rộng
                                $serviceOrder = ServiceOrder::where('order_number', 'like', '%' . $serviceNumber . '%')
                                    ->where('status', 'pending')
                                    ->first();
                                    
                                if (!$serviceOrder) {
                                    Log::info('SePay Webhook: Thử tìm thêm với status khác pending', [
                                        'order_number' => $orderNumber
                                    ]);
                                    
                                    // Nếu không tìm thấy với status pending, thử tìm với bất kỳ status nào
                                    $serviceOrder = ServiceOrder::where('order_number', $orderNumber)->first();
                                }
                            }
                            
                            if ($serviceOrder) {
                                // Nếu đơn đã được thanh toán thì bỏ qua
                                if ($serviceOrder->status == 'paid' || $serviceOrder->status == 'completed') {
                                    Log::info('SePay Webhook: Đơn hàng đã được thanh toán trước đó', [
                                        'order_id' => $serviceOrder->id,
                                        'order_number' => $serviceOrder->order_number,
                                        'status' => $serviceOrder->status
                                    ]);
                                    return response()->json(['status' => 'success', 'message' => 'Đơn hàng đã được thanh toán trước đó']);
                                }
                                
                                // Cập nhật trạng thái đơn hàng thành 'paid'
                                $serviceOrder->status = 'paid';
                                $serviceOrder->payment_method = 'bank_transfer';
                                $serviceOrder->paid_at = now();
                                $serviceOrder->save();
                                
                                Log::info('SePay Webhook: Đã cập nhật đơn hàng dịch vụ thành paid', [
                                    'order_id' => $serviceOrder->id,
                                    'order_number' => $serviceOrder->order_number
                                ]);
                                
                                // Lưu giao dịch
                                Transaction::create([
                                    'order_id' => null,
                                    'boosting_order_id' => null,
                                    'game_service_order_id' => $serviceOrder->id,
                                    'amount' => $data['transferAmount'],
                                    'payment_method' => 'bank_transfer',
                                    'transaction_id' => $data['id'] ?? null,
                                    'status' => 'completed',
                                    'notes' => json_encode($data)
                                ]);
                                
                                return response()->json(['status' => 'success', 'message' => 'Đã cập nhật đơn hàng dịch vụ']);
                            } else {
                                Log::warning('SePay Webhook: Không tìm thấy đơn hàng dịch vụ', [
                                    'order_number' => $orderNumber,
                                    'service_number' => $serviceNumber
                                ]);
                            }
                        } else {
                            Log::warning('SePay Webhook: Không thể trích xuất số từ mã đơn hàng dịch vụ', [
                                'content' => $content,
                                'service_number_raw' => $serviceNumberRaw
                            ]);
                        }
                    } else {
                        Log::warning('SePay Webhook: Không thể trích xuất mã đơn hàng dịch vụ', [
                            'content' => $content
                        ]);
                    }
                } else {
                    Log::warning('SePay Webhook API: Không tìm thấy định dạng đơn hàng hợp lệ', [
                        'content' => $content
                    ]);
                    return response()->json(['success' => true]);
                }
                
                // Tìm đơn hàng phù hợp (cày thuê hoặc thường)
                if ($isBoostingOrder) {
                    $order = BoostingOrder::where('order_number', 'like', '%' . $orderNumber . '%')
                        ->where('status', 'pending')
                        ->first();
                    
                    if ($order) {
                        
                      
                        // Cập nhật trạng thái đơn hàng bất kể số tiền
                        $order->status = 'paid';
                        $order->save();
                     
                        
                        // Lưu giao dịch
                        Transaction::create([
                            'order_id' => null, // Đơn hàng cày thuê không liên kết với bảng orders
                            'boosting_order_id' => $order->id,
                            'amount' => $data['transferAmount'],
                            'payment_method' => 'bank_transfer',
                            'transaction_id' => $data['id'] ?? null,
                            'status' => 'completed',
                            'notes' => json_encode($data)
                        ]);
                        
                        return response()->json(['success' => true]);
                    } else {
                        Log::warning('SePay Webhook API: Không tìm thấy đơn hàng cày thuê', [
                            'order_number' => $orderNumber
                        ]);
                    }
                } else {
                    // Đơn hàng thường
                    $order = Order::where('order_number', $orderNumber)
                        ->where('status', 'pending')
                        ->first();
                
                    if (!$order) {
                        Log::info('SePay Webhook API: Thử tìm kiếm với LIKE', ['pattern' => $orderNumber]);
                        $order = Order::where('order_number', 'like', '%' . $orderNumber . '%')
                            ->where('status', 'pending')
                            ->first();
                    }
                    
                    if ($order) {
                        
                        // Cập nhật trạng thái đơn hàng bất kể số tiền
                        $order->status = 'completed';
                        $order->completed_at = Carbon::now();
                        $order->save();
                        
                        // Cập nhật trạng thái tài khoản
                        if ($order->account) {
                            $order->account->status = 'sold';
                            $order->account->save();
                        
                        }
                        
                        // Lưu giao dịch
                        Transaction::create([
                            'order_id' => $order->id,
                            'boosting_order_id' => null,
                            'amount' => $data['transferAmount'],
                            'payment_method' => 'bank_transfer',
                            'transaction_id' => $data['id'] ?? null,
                            'status' => 'completed',
                            'notes' => json_encode($data)
                        ]);
                        
                        return response()->json(['success' => true]);
                    } else {
                        Log::warning('SePay Webhook API: Không tìm thấy đơn hàng thường', [
                            'order_number' => $orderNumber
                        ]);
                    }
                }
            }
        }
        
        // Luôn trả về thành công để SePay không gửi lại webhook
        return response()->json(['success' => true]);
    }
    
    /**
     * Xử lý webhook từ SePay
     */
    public function sepayWebhook(Request $request)
    {
        // Đọc dữ liệu từ request
        $data = $request->all();
        
        // Kiểm tra loại giao dịch
        if (!isset($data['transferType'])) {
            Log::error('SePay Webhook: Thiếu thông tin loại giao dịch');
            return response()->json(['status' => 'error', 'message' => 'Thiếu thông tin giao dịch']);
        }
        
        if ($data['transferType'] === 'in') {
            // Tìm đơn hàng dựa trên mã nội dung chuyển khoản
            $pattern = config('payment.pattern', 'SEVQR');
            $content = $data['content'];
            
            // Kiểm tra xem nội dung có chứa pattern không
            if (strpos($content, $pattern) !== false) {
                // BOOST là prefix của đơn hàng cày thuê
                $isBoostingOrder = strpos($content, 'BOOST') !== false;
                // WALLET là prefix của đơn nạp ví
                $isWalletDeposit = strpos($content, 'WALLET') !== false;
                
                // Trích xuất order_number từ nội dung
                if ($isBoostingOrder) {
                    // Tìm vị trí của "ORDBOOST" trong chuỗi
                    $ordBoostPos = strpos($content, 'ORDBOOST');
                    if ($ordBoostPos !== false) {
                        // Lấy phần sau 'ORDBOOST'
                        $orderNumber = substr($content, $ordBoostPos + 8); // 8 là độ dài của 'ORDBOOST'
                        
                        // Loại bỏ các ký tự không phải số
                        $orderNumber = preg_replace('/[^0-9]/', '', $orderNumber);
                        
                        // Thêm lại prefix để có mã đơn hàng đầy đủ
                        $orderNumber = 'BOOST' . $orderNumber;
                        
                        Log::info('SePay Webhook: Tìm thấy đơn hàng cày thuê', [
                            'order_number' => $orderNumber
                        ]);
                    } else {
                        Log::warning('SePay Webhook: Không thể trích xuất mã đơn hàng cày thuê', [
                            'content' => $content
                        ]);
                        return response()->json(['status' => 'error', 'message' => 'Không thể trích xuất mã đơn hàng']);
                    }
                } else if ($isWalletDeposit) {
                    // Tìm vị trí của "ORDWALLET" trong chuỗi
                    $ordWalletPos = strpos($content, 'ORDWALLET');
                    if ($ordWalletPos !== false) {
                        // Lấy phần sau 'ORDWALLET'
                        $walletCode = substr($content, $ordWalletPos + 9); // 9 là độ dài của 'ORDWALLET'
                        
                        // Loại bỏ các ký tự không phải số
                        $walletCode = preg_replace('/[^0-9]/', '', $walletCode);
                        
                        $depositCode = 'WALLET-' . $walletCode;
                        
                        // Log dữ liệu đầu vào để debug
                        Log::info('SePay Webhook: Thông tin nạp tiền ví', [
                            'deposit_code_raw' => $depositCode,
                            'transfer_content' => $content,
                            'amount' => $data['transferAmount'] ?? 0
                        ]);
                        
                        // Tìm bản ghi nạp tiền trong database
                        $walletDeposit = null;
                        $userId = null;
                        
                        // Phương pháp 1: Tìm chính xác theo mã ghi nhận
                        $walletDeposit = WalletDeposit::where('deposit_code', $depositCode)
                            ->where('status', 'pending')
                            ->first();
                        
                        // Phương pháp 2: Nếu không tìm thấy, thử tìm kiếm mở rộng với LIKE
                        if (!$walletDeposit) {
                            // Trích xuất phần chính của mã (không bao gồm các ký tự thêm vào bởi cổng thanh toán)
                            $baseCode = substr($walletCode, 0, 10); // Lấy 10 chữ số đầu tiên (phần timestamp)
                            
                            Log::info('SePay Webhook: Tìm kiếm mở rộng với mã cơ bản', [
                                'base_code' => $baseCode
                            ]);
                            
                            // Tìm các giao dịch pending có mã gần giống
                            $walletDeposit = WalletDeposit::where('deposit_code', 'LIKE', "WALLET-{$baseCode}%")
                                ->where('status', 'pending')
                                ->where('amount', (int)$data['transferAmount']) // Đối chiếu với số tiền
                                ->first();
                        }
                        
                        // Phương pháp 3: Tìm theo format mới (nếu đang sử dụng)
                        // Format mới: WALLET-USER{ID}-{TIMESTAMP}-{RANDOM}
                        if (!$walletDeposit && preg_match('/(\d+)-(\d+)-(\d+)/', $walletCode, $matches)) {
                            if (count($matches) >= 3) {
                                $userId = $matches[1];
                                $timestamp = $matches[2];
                                
                                Log::info('SePay Webhook: Tìm kiếm theo format mới', [
                                    'user_id' => $userId,
                                    'timestamp' => $timestamp
                                ]);
                                
                                // Tìm giao dịch của user này
                                $walletDeposit = WalletDeposit::where('user_id', $userId)
                                    ->where('deposit_code', 'LIKE', "WALLET-{$userId}-%")
                                    ->where('status', 'pending')
                                    ->where('amount', (int)$data['transferAmount'])
                                    ->orderBy('created_at', 'desc')
                                    ->first();
                            }
                        }
                        
                        // Phương pháp 4: Tìm tất cả giao dịch pending trong khoảng thời gian gần đây
                        if (!$walletDeposit) {
                            // Lấy tất cả giao dịch pending trong 24h gần đây
                            $recentDeposits = WalletDeposit::where('status', 'pending')
                                ->where('amount', (int)$data['transferAmount'])
                                ->where('created_at', '>=', now()->subDay())
                                ->orderBy('created_at', 'desc')
                                ->get();
                            
                            if ($recentDeposits->count() > 0) {
                                // Ưu tiên giao dịch gần nhất
                                $walletDeposit = $recentDeposits->first();
                                
                                Log::info('SePay Webhook: Tìm thấy giao dịch theo phương pháp 4', [
                                    'deposit_id' => $walletDeposit->id,
                                    'deposit_code' => $walletDeposit->deposit_code,
                                    'created_at' => $walletDeposit->created_at->format('Y-m-d H:i:s')
                                ]);
                            }
                        }
                        
                        if ($walletDeposit) {
                            $userId = $walletDeposit->user_id;
                            $depositCode = $walletDeposit->deposit_code; // Sử dụng mã từ database
                        }
                        
                        if ($userId) {
                            // Nếu tìm thấy người dùng, xử lý nạp tiền vào ví
                            $amount = (int)$data['transferAmount'];
                            
                            try {
                                Log::info('SePay Webhook: Bắt đầu xử lý nạp tiền', [
                                    'user_id' => $userId,
                                    'deposit_code' => $depositCode,
                                    'amount' => $amount
                                ]);
                                
                                // Gọi phương thức xử lý nạp tiền
                                $result = \App\Http\Controllers\WalletController::processDepositWebhook(
                                    $userId, 
                                    $amount, 
                                    $data, 
                                    $depositCode
                                );
                                
                                Log::info('SePay Webhook: Xử lý nạp tiền thành công', [
                                    'user_id' => $userId,
                                    'deposit_code' => $depositCode,
                                    'result' => $result
                                ]);
                              
                            } catch (\Exception $e) {
                                Log::error('SePay Webhook: Lỗi khi xử lý nạp tiền vào ví', [
                                    'user_id' => $userId,
                                    'deposit_code' => $depositCode,
                                    'error' => $e->getMessage(),
                                    'trace' => $e->getTraceAsString()
                                ]);
                            }
                        
                        } else {
                            Log::warning('SePay Webhook: Không tìm thấy người dùng cho mã nạp tiền', [
                                'deposit_code' => $depositCode,
                                'transfer_content' => $content,
                                'amount' => $data['transferAmount'] ?? 0
                            ]);
                        }
                        
                        // Kiểm tra xem có phải là mã thanh toán dịch vụ (SRV-) hay không
                        if (strpos($orderNumber, 'SRV-') === 0) {
                            Log::info('SePay Webhook: Đơn hàng dịch vụ', ['order_number' => $orderNumber]);
                            $serviceOrder = ServiceOrder::where('order_number', $orderNumber)->first();
                            
                            if ($serviceOrder) {
                                // Cập nhật trạng thái đơn hàng thành 'paid'
                                $serviceOrder->status = 'paid';
                                $serviceOrder->payment_method = 'bank_transfer';
                                $serviceOrder->save();
                                
                                // Lưu giao dịch
                                Transaction::create([
                                    'order_id' => null,
                                    'boosting_order_id' => null,
                                    'game_service_order_id' => $serviceOrder->id,
                                    'amount' => $data['transferAmount'],
                                    'payment_method' => 'bank_transfer',
                                    'transaction_id' => $data['id'] ?? null,
                                    'status' => 'completed',
                                    'notes' => json_encode($data)
                                ]);
                                
                                return response()->json(['success' => true]);
                            } else {
                                Log::warning('SePay Webhook API: Không tìm thấy đơn hàng dịch vụ', [
                                    'order_number' => $orderNumber
                                ]);
                            }
                        }
                        
                        return response()->json(['success' => true]);
                    } else {
                        Log::warning('SePay Webhook API: Không tìm thấy đơn hàng cày thuê', [
                            'content' => $content
                        ]);
                        return response()->json(['status' => 'error', 'message' => 'Không tìm thấy đơn hàng cày thuê']);
                    }
                } else if (strpos($content, 'ORDPRODUCT') !== false) {
                    // Đơn hàng thường
                    $ordProductPos = strpos($content, 'ORDPRODUCT');
                    if ($ordProductPos !== false) {
                        // Lấy phần sau 'ORDPRODUCT'
                        $cleanedOrderNumber = substr($content, $ordProductPos + 10); // 10 là độ dài của 'ORDPRODUCT'
                        
                        // Loại bỏ các ký tự không phải số và chữ cái
                        $cleanedOrderNumber = preg_replace('/[^0-9A-Z]/', '', $cleanedOrderNumber);
                        
                        // Thêm lại prefix ORD- để có mã đơn hàng đầy đủ
                        $fullOrderNumber = 'ORD-' . $cleanedOrderNumber;
                   
                        // Tìm đơn hàng thường - phương pháp 1: tìm chính xác
                        $order = Order::where('order_number', $fullOrderNumber)
                            ->where('status', 'pending')
                            ->first();
                    
                        if (!$order) {
                            // Phương pháp 2: Tìm kiếm không có ký tự dash
                            $altOrderNumber = str_replace('-', '', $fullOrderNumber); 
                            $order = Order::where('order_number', 'like', '%' . $altOrderNumber . '%')
                                ->where('status', 'pending')
                                ->first();
                                
                            // Phương pháp 3: Tìm kiếm chỉ với phần số
                            if (!$order) {
                              
                                $order = Order::where('order_number', 'like', '%' . $cleanedOrderNumber . '%')
                                    ->where('status', 'pending')
                                    ->first();
                            }
                            
                            // Phương pháp 4: Tìm kiếm với toàn bộ order_number
                            if (!$order) {
                                $pendingOrders = Order::where('status', 'pending')->get();
                                foreach ($pendingOrders as $pendingOrder) {
                                    $orderNumberWithoutPrefix = str_replace('ORD-', '', $pendingOrder->order_number);
                                    if (strpos($orderNumberWithoutPrefix, $cleanedOrderNumber) !== false) {
                                        $order = $pendingOrder;
                                        break;
                                    }
                                }
                            }
                        }
                        
                        if ($order) {
                            // Kiểm tra số tiền
                            if ((int)$order->amount !== (int)$data['transferAmount']) {
                                Log::warning('SePay Webhook API: Số tiền không khớp cho đơn hàng thường', [
                                    'order_id' => $order->id,
                                    'expected' => $order->amount,
                                    'received' => $data['transferAmount'],
                                ]);
                            }
                            
                            // Cập nhật trạng thái đơn hàng bất kể số tiền
                            $order->status = 'completed';
                            $order->completed_at = Carbon::now();
                            $order->save();
                            
                            Log::info('SePay Webhook API: Đã cập nhật đơn hàng thường thành completed', [
                                'order_id' => $order->id
                            ]);
                            
                            // Cập nhật trạng thái tài khoản
                            if ($order->account) {
                                $order->account->status = 'sold';
                                $order->account->save();
                                
                                Log::info('SePay Webhook API: Đã cập nhật trạng thái tài khoản thành sold', [
                                    'account_id' => $order->account->id
                                ]);
                            }
                            
                            // Lưu giao dịch
                            Transaction::create([
                                'order_id' => $order->id,
                                'boosting_order_id' => null,
                                'amount' => $data['transferAmount'],
                                'payment_method' => 'bank_transfer',
                                'transaction_id' => $data['id'] ?? null,
                                'status' => 'completed',
                                'notes' => json_encode($data)
                            ]);
                            
                            return response()->json(['status' => 'success', 'message' => 'Đã cập nhật đơn hàng thường']);
                        } else {
                            Log::warning('SePay Webhook API: Không tìm thấy đơn hàng thường', [
                                'order_number' => $fullOrderNumber
                            ]);
                        }
                    } else {
                        Log::warning('SePay Webhook API: Không thể trích xuất mã đơn hàng thường', [
                            'content' => $content
                        ]);
                        return response()->json(['success' => true]);
                    }
                } else {
                    Log::warning('SePay Webhook API: Không tìm thấy định dạng đơn hàng hợp lệ', [
                        'content' => $content
                    ]);
                    return response()->json(['status' => 'error', 'message' => 'Không tìm thấy định dạng đơn hàng']);
                }
                
                // Tìm đơn hàng phù hợp (cày thuê hoặc thường)
                if ($isBoostingOrder) {
                    $order = BoostingOrder::where('order_number', 'like', '%' . $orderNumber . '%')
                        ->where('status', 'pending')
                        ->first();
                    
                    if ($order) {
                        // Cập nhật trạng thái đơn hàng bất kể số tiền
                        $order->status = 'paid';
                        $order->save();
                     
                        // Lưu giao dịch
                        Transaction::create([
                            'order_id' => null, // Đơn hàng cày thuê không liên kết với bảng orders
                            'boosting_order_id' => $order->id,
                            'amount' => $data['transferAmount'],
                            'payment_method' => 'bank_transfer',
                            'transaction_id' => $data['id'] ?? null,
                            'status' => 'completed',
                            'notes' => json_encode($data)
                        ]);
                        
                        return response()->json(['status' => 'success', 'message' => 'Đã cập nhật đơn hàng cày thuê']);
                    } else {
                        Log::warning('SePay Webhook API: Không tìm thấy đơn hàng cày thuê', [
                            'order_number' => $orderNumber
                        ]);
                    }
                } else {
                    // Đơn hàng thường
                    $order = Order::where('order_number', $orderNumber)
                        ->where('status', 'pending')
                        ->first();
                
                    if (!$order) {
                        $order = Order::where('order_number', 'like', '%' . $orderNumber . '%')
                            ->where('status', 'pending')
                            ->first();
                    }
                    
                    if ($order) {
                        
                        // Cập nhật trạng thái đơn hàng bất kể số tiền
                        $order->status = 'completed';
                        $order->completed_at = Carbon::now();
                        $order->save();
                
                        
                        // Cập nhật trạng thái tài khoản
                        if ($order->account) {
                            $order->account->status = 'sold';
                            $order->account->save();
                       
                        }
                        
                        // Lưu giao dịch
                        Transaction::create([
                            'order_id' => $order->id,
                            'boosting_order_id' => null,
                            'amount' => $data['transferAmount'],
                            'payment_method' => 'bank_transfer',
                            'transaction_id' => $data['id'] ?? null,
                            'status' => 'completed',
                            'notes' => json_encode($data)
                        ]);
                        
                        return response()->json(['status' => 'success', 'message' => 'Đã cập nhật đơn hàng thường']);
                    } else {
                        Log::warning('SePay Webhook API: Không tìm thấy đơn hàng thường', [
                            'order_number' => $orderNumber
                        ]);
                    }
                }
            }
            
            // Không tìm thấy đơn hàng phù hợp
            return response()->json(['status' => 'error', 'message' => 'Không tìm thấy đơn hàng phù hợp']);
        }
        
        return response()->json(['status' => 'ignored', 'message' => 'Không phải giao dịch cần xử lý']);
    }
}
