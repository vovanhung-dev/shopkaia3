<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Hiển thị danh sách đơn hàng của người dùng hiện tại
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('orders.index', compact('orders'));
    }
    
    /**
     * Hiển thị chi tiết đơn hàng
     */
    public function show($orderNumber)
    {
        // Kiểm tra loại đơn hàng dựa vào tiền tố
        if (strpos($orderNumber, 'SRV-') === 0) {
            return redirect()->route('services.view_order', $orderNumber);
        } elseif (strpos($orderNumber, 'BST-') === 0) {
            return redirect()->route('boosting.orders.show', $orderNumber);
        }
        
        $order = Order::where('order_number', $orderNumber)
            ->where('user_id', auth()->id())
            ->firstOrFail();
        
        // Tìm thông tin tài khoản nếu đơn hàng đã hoàn thành
        $accountInfo = null;
        if ($order->status === 'completed') {
            if ($order->account_details) {
                $accountInfo = json_decode($order->account_details, true);
            } elseif ($order->account) {
                // Nếu không có thông tin cached, lấy trực tiếp từ account
                $attributes = $order->account->attributes;
                // Kiểm tra nếu attributes là string thì mới json_decode
                $extraInfo = is_string($attributes) ? json_decode($attributes, true) : $attributes;
                
                $accountInfo = [
                    'username' => $order->account->username,
                    'password' => $order->account->password,
                    'extra_info' => $extraInfo,
                    'game_name' => $order->account->game->name,
                ];
            }
        }
        
        return view('orders.show', compact('order', 'accountInfo'));
    }
    
    /**
     * Tạo đơn hàng mới
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'account_id' => 'required|exists:accounts,id',
        ]);
        
        // Lấy thông tin tài khoản
        $account = Account::findOrFail($validated['account_id']);
        
        // Kiểm tra tài khoản còn khả dụng trực tiếp bằng raw query để tránh vấn đề timezone
        $isAvailable = DB::select(
            "SELECT (status = 'available' OR (status = 'pending' AND reserved_until < NOW())) as is_available 
             FROM accounts 
             WHERE id = ?", 
            [$account->id]
        );
        
        if (empty($isAvailable) || !$isAvailable[0]->is_available) {
            return back()->with('error', 'Tài khoản này đã được bán hoặc đang được người khác đặt mua.');
        }
        
        // Tạo đơn hàng
        $order = Order::create([
            'user_id' => Auth::id(),
            'account_id' => $account->id,
            'order_number' => Order::generateOrderNumber(),
            'amount' => $account->price,
            'status' => 'pending',
        ]);
        
        // Cập nhật trạng thái tài khoản trực tiếp bằng query
        $reservationMinutes = 3; // Thời gian giữ chỗ 3 phút
        
        // Sử dụng raw query để đặt reserved_until theo múi giờ của database
        DB::update(
            "UPDATE accounts 
             SET status = 'pending', 
                 reserved_until = DATE_ADD(NOW(), INTERVAL ? MINUTE),
                 updated_at = NOW()
             WHERE id = ?",
            [$reservationMinutes, $account->id]
        );
        
        // Lấy thời gian reserved_until mới được đặt để log
        $reservedInfo = DB::select(
            "SELECT reserved_until FROM accounts WHERE id = ?",
            [$account->id]
        );
        
        // Làm mới để lấy thông tin cập nhật
        $account->refresh();
        
        // Chuyển hướng đến trang thanh toán
        return redirect()->route('payment.checkout', $order->order_number);
    }
    
    /**
     * Hủy đơn hàng đang chờ thanh toán
     */
    public function cancel($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->where('user_id', auth()->id())
            ->where('status', 'pending')
            ->firstOrFail();
        
        // Cập nhật trạng thái đơn hàng
        $order->status = 'cancelled';
        $order->cancelled_at = now();
        $order->save();
        
        // Đưa tài khoản về trạng thái có sẵn
        if ($order->account_id) {
            // Sử dụng raw query để tránh vấn đề timezone khi cập nhật
            DB::update(
                "UPDATE accounts 
                 SET status = 'available', 
                     reserved_until = NULL,
                     updated_at = NOW()
                 WHERE id = ?",
                [$order->account_id]
            );
        
        }
        
        // Xác định route dựa trên prefix của mã đơn hàng
        if (strpos($orderNumber, 'SRV-') === 0) {
            return redirect()->route('services.view_order', $orderNumber)
                ->with('success', 'Đơn hàng đã được hủy thành công.');
        } elseif (strpos($orderNumber, 'BST-') === 0) {
            return redirect()->route('boosting.orders.show', $orderNumber)
                ->with('success', 'Đơn hàng đã được hủy thành công.');
        } else {
            return redirect()->route('orders.index')
                ->with('success', 'Đơn hàng đã được hủy thành công.');
        }
    }
}
