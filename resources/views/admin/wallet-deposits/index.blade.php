@extends('layouts.admin')

@section('title', 'Quản lý giao dịch nạp tiền')

@section('content')
<div class="py-6">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900">Quản lý giao dịch nạp tiền</h1>
        </div>

        <!-- Thông báo -->
        @if(session('success'))
        <div class="mt-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded" role="alert">
            <p class="font-bold">Thành công!</p>
            <p>{{ session('success') }}</p>
        </div>
        @endif

        @if(session('error'))
        <div class="mt-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded" role="alert">
            <p class="font-bold">Lỗi!</p>
            <p>{{ session('error') }}</p>
        </div>
        @endif

        <!-- Thống kê -->
        <div class="mt-4 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Giao dịch đang chờ</dt>
                                <dd class="text-lg font-semibold text-gray-900">{{ number_format($countPending) }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Giao dịch hoàn thành</dt>
                                <dd class="text-lg font-semibold text-gray-900">{{ number_format($countCompleted) }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Tổng tiền đang chờ</dt>
                                <dd class="text-lg font-semibold text-gray-900">{{ number_format($totalPending) }}đ</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Tổng tiền đã nạp</dt>
                                <dd class="text-lg font-semibold text-gray-900">{{ number_format($totalCompleted) }}đ</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bộ lọc -->
        <div class="mt-4 bg-white shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 sm:p-6">
                <form action="{{ route('admin.wallet-deposits.index') }}" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        <div>
                            <label for="deposit_code" class="block text-sm font-medium text-gray-700">Mã giao dịch</label>
                            <input type="text" name="deposit_code" id="deposit_code" value="{{ request('deposit_code') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Trạng thái</label>
                            <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                <option value="">Tất cả trạng thái</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Đang chờ</option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Thất bại</option>
                            </select>
                        </div>
                        <div>
                            <label for="from_date" class="block text-sm font-medium text-gray-700">Từ ngày</label>
                            <input type="date" name="from_date" id="from_date" value="{{ request('from_date') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="to_date" class="block text-sm font-medium text-gray-700">Đến ngày</label>
                            <input type="date" name="to_date" id="to_date" value="{{ request('to_date') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        </div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="inline-flex w-full justify-center rounded-md bg-blue-600 py-2 px-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">
                            Lọc
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Danh sách giao dịch -->
        <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-md">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mã giao dịch</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Người dùng</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Số tiền</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phương thức</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ngày tạo</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($deposits as $deposit)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $deposit->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $deposit->deposit_code }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $deposit->user->name }}</div>
                                <div class="text-sm text-gray-500">{{ $deposit->user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($deposit->amount) }}đ</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $deposit->payment_method }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($deposit->status == 'pending')
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Đang chờ
                                </span>
                                @elseif($deposit->status == 'completed')
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Hoàn thành
                                </span>
                                @else
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Thất bại
                                </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $deposit->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.wallet-deposits.show', $deposit->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                    Chi tiết
                                </a>
                                @if($deposit->status == 'pending')
                                <form action="{{ route('admin.wallet-deposits.update-status', $deposit->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="completed">
                                    <button type="submit" class="text-green-600 hover:text-green-900" onclick="return confirm('Xác nhận hoàn thành giao dịch này?')">
                                        Hoàn thành
                                    </button>
                                </form>
                                <form action="{{ route('admin.wallet-deposits.update-status', $deposit->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="failed">
                                    <button type="submit" class="text-red-600 hover:text-red-900 ml-3" onclick="return confirm('Xác nhận hủy giao dịch này?')">
                                        Hủy
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                Không có giao dịch nào
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Phân trang -->
            <div class="px-4 py-3 bg-white border-t border-gray-200 sm:px-6">
                {{ $deposits->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 