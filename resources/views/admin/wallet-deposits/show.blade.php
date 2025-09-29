@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Chi tiết giao dịch nạp tiền #{{ $deposit->deposit_code }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.wallet-deposits.index') }}" class="btn btn-default">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 200px">Mã giao dịch</th>
                                    <td>{{ $deposit->deposit_code }}</td>
                                </tr>
                                <tr>
                                    <th>Người dùng</th>
                                    <td>{{ $deposit->user->name }} (ID: {{ $deposit->user->id }})</td>
                                </tr>
                                <tr>
                                    <th>Số tiền</th>
                                    <td>{{ number_format($deposit->amount) }}đ</td>
                                </tr>
                                <tr>
                                    <th>Phương thức thanh toán</th>
                                    <td>{{ $deposit->payment_method }}</td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th>
                                    <td>
                                        @if($deposit->status == 'pending')
                                            <span class="badge badge-warning">Đang chờ</span>
                                        @elseif($deposit->status == 'completed')
                                            <span class="badge badge-success">Hoàn thành</span>
                                        @else
                                            <span class="badge badge-danger">Thất bại</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Thời gian tạo</th>
                                    <td>{{ $deposit->created_at->format('d/m/Y H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <th>Thời gian hoàn thành</th>
                                    <td>{{ $deposit->completed_at ? $deposit->completed_at->format('d/m/Y H:i:s') : 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Ghi chú</th>
                                    <td>{{ $deposit->note ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>

                        @if($deposit->status == 'pending')
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Cập nhật trạng thái</h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.wallet-deposits.update-status', $deposit) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label>Trạng thái mới</label>
                                            <select name="status" class="form-control">
                                                <option value="completed">Hoàn thành</option>
                                                <option value="failed">Thất bại</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Ghi chú</label>
                                            <textarea name="note" class="form-control" rows="3"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 