@extends('layouts.admin')

@section('title', 'Chi tiết đơn hàng nạp hộ')

@section('content')
<div class="py-6">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900">Chi tiết đơn hàng nạp hộ #{{ $order->order_number }}</h1>
            <a href="{{ route('admin.topup_orders.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">
                Quay lại
            </a>
        </div>

        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Thông tin đơn hàng -->
            <div class="md:col-span-2 bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6 bg-gray-50">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Thông tin đơn hàng</h3>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Mã đơn hàng</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $order->order_number }}</dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Số tiền</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ number_format($order->amount, 0, ',', '.') }} đ</dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Trạng thái</dt>
                            <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                                @if($order->status == 'pending')
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                        Chờ thanh toán
                                    </span>
                                @elseif($order->status == 'paid')
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                        Đã thanh toán
                                    </span>
                                @elseif($order->status == 'processing')
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-indigo-100 text-indigo-800">
                                        Đang xử lý
                                    </span>
                                @elseif($order->status == 'completed')
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                        Hoàn thành
                                    </span>
                                @elseif($order->status == 'cancelled')
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                                        Đã hủy
                                    </span>
                                @endif
                            </dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Ngày tạo</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $order->created_at->format('d/m/Y H:i:s') }}</dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Cập nhật lần cuối</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $order->updated_at->format('d/m/Y H:i:s') }}</dd>
                        </div>
                        @if($order->notes)
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Ghi chú</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $order->notes }}</dd>
                        </div>
                        @endif
                    </dl>
                </div>
            </div>

            <!-- Thông tin khách hàng -->
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6 bg-gray-50">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">Thông tin khách hàng</h3>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Tên</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $order->user->name }}</dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Email</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $order->user->email }}</dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Số điện thoại</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $order->user->phone }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Thông tin dịch vụ -->
        <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 bg-gray-50">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Thông tin dịch vụ</h3>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Tên dịch vụ</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $order->service->name }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">ID Game</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $order->game_id }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Server Game</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $order->server_id }}</dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Thông tin tài khoản</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $order->account_info }}</dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Thông tin bổ sung</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 whitespace-pre-line">{{ $order->additional_info ?: 'Không có' }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        <!-- Cập nhật trạng thái -->
        @if($order->status == 'pending' || $order->status == 'paid')
        <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 bg-gray-50">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Cập nhật trạng thái</h3>
            </div>
            <div class="border-t border-gray-200 p-6">
                <form action="{{ route('admin.topup_orders.status', $order->id) }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Trạng thái mới</label>
                            <select id="status" name="status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="processing" {{ $order->status == 'paid' ? 'selected' : '' }}>Đang xử lý</option>
                                <option value="completed">Hoàn thành</option>
                                <option value="cancelled">Hủy đơn</option>
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <label for="notes" class="block text-sm font-medium text-gray-700">Ghi chú</label>
                            <textarea id="notes" name="notes" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"></textarea>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            Cập nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection 