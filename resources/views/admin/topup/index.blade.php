@extends('layouts.admin')

@section('title', 'Quản lý dịch vụ nạp thuê')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900">Quản lý dịch vụ nạp thuê</h1>
            <a href="{{ route('admin.topup.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Thêm dịch vụ mới
            </a>
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

        <!-- Bộ lọc -->
        <div class="mt-4 bg-white shadow overflow-hidden sm:rounded-md">
            <form action="{{ route('admin.topup.index') }}" method="GET" class="p-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label for="game_id" class="block text-sm font-medium text-gray-700">Game</label>
                        <select name="game_id" id="game_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="">Tất cả game</option>
                            @foreach(\App\Models\Game::all() as $game)
                            <option value="{{ $game->id }}" {{ request('game_id') == $game->id ? 'selected' : '' }}>
                                {{ $game->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Danh mục</label>
                        <select name="category_id" id="category_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="">Tất cả danh mục</option>
                            @foreach(\App\Models\TopUpCategory::all() as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="is_active" class="block text-sm font-medium text-gray-700">Trạng thái</label>
                        <select name="is_active" id="is_active" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="">Tất cả trạng thái</option>
                            <option value="1" {{ request('is_active') == '1' ? 'selected' : '' }}>Đang hoạt động</option>
                            <option value="0" {{ request('is_active') == '0' ? 'selected' : '' }}>Tạm ngưng</option>
                        </select>
                    </div>
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700">Tìm kiếm</label>
                        <input type="text" name="search" id="search" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Tên dịch vụ..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="mt-4 flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 mr-2">
                        Lọc
                    </button>
                    <a href="{{ route('admin.topup.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                        Đặt lại
                    </a>
                </div>
            </form>
        </div>

        <!-- Bảng dữ liệu -->
        <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-md">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Hình ảnh
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tên dịch vụ
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Game
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Danh mục
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Giá
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Thời gian
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Trạng thái
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Thao tác
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($services as $service)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $service->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($service->thumbnail)
                                <img src="{{ asset('storage/' . $service->thumbnail) }}" alt="{{ $service->name }}"
                                    class="h-10 w-10 rounded-full object-cover">
                                @else
                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-500 text-xs">No img</span>
                                </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $service->name }}</p>
                                    <p class="text-xs text-gray-500">{{ Str::limit($service->description, 50) }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $service->game->name ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $service->category->name ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if($service->hasDiscount())
                                <span class="line-through">{{ number_format($service->price, 0, ',', '.') }}đ</span>
                                <span class="text-red-600 font-medium">{{ number_format($service->sale_price, 0, ',', '.') }}đ</span>
                                @else
                                <span>{{ number_format($service->price, 0, ',', '.') }}đ</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $service->estimated_minutes }} phút
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($service->is_active)
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                    Đang hoạt động
                                </span>
                                @else
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                                    Tạm ngưng
                                </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.topup.edit', $service->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                    Sửa
                                </a>
                                
                                <form action="{{ route('admin.topup.destroy', $service->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" 
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa dịch vụ này?')">
                                        Xóa
                                    </button>
                                </form>
                                
                                <a href="{{ route('topup.show', $service->slug) }}" target="_blank" 
                                   class="inline-block ml-3 text-blue-600 hover:text-blue-900">
                                    Xem
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="px-6 py-4 text-sm text-center text-gray-500">
                                Không có dữ liệu dịch vụ nạp thuê.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-gray-200">
                {{ $services->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 