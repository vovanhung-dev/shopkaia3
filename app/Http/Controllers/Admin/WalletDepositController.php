<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WalletDeposit;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class WalletDepositController extends Controller
{
    /**
     * Hiển thị danh sách giao dịch nạp tiền
     */
    public function index(Request $request)
    {
        $query = WalletDeposit::with(['user', 'wallet'])
            ->orderBy('created_at', 'desc');

        // Lọc theo mã giao dịch
        if ($request->has('deposit_code')) {
            $query->where('deposit_code', 'like', '%' . $request->deposit_code . '%');
        }

        // Lọc theo trạng thái
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Lọc theo khoảng thời gian
        if ($request->has('from_date')) {
            $query->whereDate('created_at', '>=', Carbon::parse($request->from_date));
        }
        if ($request->has('to_date')) {
            $query->whereDate('created_at', '<=', Carbon::parse($request->to_date));
        }

        // Tính tổng số tiền và số lượng giao dịch
        $totalPending = WalletDeposit::where('status', WalletDeposit::STATUS_PENDING)->sum('amount');
        $totalCompleted = WalletDeposit::where('status', WalletDeposit::STATUS_COMPLETED)->sum('amount');
        $countPending = WalletDeposit::where('status', WalletDeposit::STATUS_PENDING)->count();
        $countCompleted = WalletDeposit::where('status', WalletDeposit::STATUS_COMPLETED)->count();

        $deposits = $query->paginate(20);

        return view('admin.wallet-deposits.index', compact(
            'deposits',
            'totalPending',
            'totalCompleted',
            'countPending',
            'countCompleted'
        ));
    }

    /**
     * Hiển thị chi tiết một giao dịch nạp tiền
     */
    public function show(WalletDeposit $deposit)
    {
        $deposit->load(['user', 'wallet', 'transaction']);
        
        return view('admin.wallet-deposits.show', compact('deposit'));
    }

    /**
     * Cập nhật trạng thái giao dịch nạp tiền
     */
    public function updateStatus(Request $request, WalletDeposit $deposit)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,failed'
        ]);

        $oldStatus = $deposit->status;
        $newStatus = $request->status;

        if ($oldStatus === $newStatus) {
            return back()->with('info', 'Trạng thái không thay đổi');
        }

        // Nếu đánh dấu là hoàn thành
        if ($newStatus === WalletDeposit::STATUS_COMPLETED && !$deposit->isCompleted()) {
            // Thêm tiền vào ví người dùng
            $wallet = $deposit->wallet;
            $transaction = $wallet->deposit(
                $deposit->amount,
                WalletTransaction::TYPE_DEPOSIT,
                "Nạp tiền vào ví qua chuyển khoản ngân hàng",
                $deposit->id,
                'wallet_deposit',
                ['admin_updated' => true]
            );

            // Cập nhật trạng thái deposit
            $deposit->status = WalletDeposit::STATUS_COMPLETED;
            $deposit->completed_at = Carbon::now();
            $deposit->save();

            return back()->with('success', 'Đã cập nhật trạng thái và thêm tiền vào ví người dùng');
        }

        // Các trường hợp khác chỉ cập nhật trạng thái
        $deposit->status = $newStatus;
        $deposit->save();

        return back()->with('success', 'Đã cập nhật trạng thái giao dịch');
    }
} 