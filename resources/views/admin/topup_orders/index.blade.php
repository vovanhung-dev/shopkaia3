@extends('layouts.admin')

@section('title', 'Quản lý đơn hàng nạp hộ')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900">Quản lý đơn hàng nạp hộ</h1>
        </div>

        <!-- Thống kê -->
        <div class="mt-4 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <!-- Card: Chờ thanh toán -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Chờ thanh toán</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900">{{ $stats['pending'] }}</div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card: Đã thanh toán -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Đã thanh toán</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900">{{ $stats['paid'] }}</div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card: Hoàn thành -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Hoàn thành</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900">{{ $stats['completed'] }}</div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card: Đã hủy -->
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Đã hủy</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-semibold text-gray-900">{{ $stats['cancelled'] }}</div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bộ lọc -->
        <div class="mt-4 bg-white shadow overflow-hidden sm:rounded-md">
            <form action="{{ route('admin.topup_orders.index') }}" method="GET" class="p-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Trạng thái</label>
                        <select id="status" name="status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="">Tất cả trạng thái</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ thanh toán</option>
                            <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Đã thanh toán</option>
                            <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                        </select>
                    </div>
                    <div>
                        <label for="sort" class="block text-sm font-medium text-gray-700">Sắp xếp theo</label>
                        <select id="sort" name="sort" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Ngày đặt</option>
                            <option value="amount" {{ request('sort') == 'amount' ? 'selected' : '' }}>Giá trị</option>
                            <option value="id" {{ request('sort') == 'id' ? 'selected' : '' }}>ID</option>
                        </select>
                    </div>
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700">Tìm kiếm</label>
                        <input type="text" name="search" id="search" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Tìm theo mã đơn, tên khách hàng..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="mt-4 flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Lọc
                    </button>
                </div>
            </form>
        </div>

        <!-- Danh sách đơn hàng -->
        <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-md">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Mã đơn hàng
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Khách hàng
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Dịch vụ
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Số tiền
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Trạng thái
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Ngày tạo
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Thao tác
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($orders as $order)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                #{{ $order->order_number }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $order->user->name }}
                                <div class="text-xs text-gray-400">{{ $order->user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $order->service->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ number_format($order->amount, 0, ',', '.') }}đ
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
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
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $order->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.topup_orders.show', $order->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                    Chi tiết
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                Không có đơn hàng nào
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="px-4 py-3 border-t border-gray-200">
                {{ $orders->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 