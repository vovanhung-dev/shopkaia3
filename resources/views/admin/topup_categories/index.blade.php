@extends('layouts.admin')

@section('title', 'Quản lý danh mục dịch vụ nạp thuê')

@section('content')
<div class="py-6">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900">Quản lý danh mục dịch vụ nạp thuê</h1>
            <a href="{{ route('admin.topup_categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Thêm danh mục
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
            <form action="{{ route('admin.topup_categories.index') }}" method="GET" class="p-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Trạng thái</label>
                        <select name="status" id="status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="">Tất cả trạng thái</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Hoạt động</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Tạm ngừng</option>
                        </select>
                    </div>
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700">Tìm kiếm</label>
                        <input type="text" name="search" id="search" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Tìm kiếm..." value="{{ request('search') }}">
                    </div>
                    <div>
                        <label for="sort" class="block text-sm font-medium text-gray-700">Sắp xếp theo</label>
                        <select name="sort" id="sort" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="display_order" {{ request('sort') == 'display_order' ? 'selected' : '' }}>Thứ tự hiển thị</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Tên danh mục</option>
                            <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Ngày tạo</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 mr-2">
                        Lọc
                    </button>
                    <a href="{{ route('admin.topup_categories.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                        Đặt lại
                    </a>
                </div>
            </form>
        </div>
        
        <!-- Danh sách danh mục -->
        <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-md">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hình ảnh</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tên danh mục</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Số dịch vụ</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Thứ tự</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trạng thái</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($categories as $category)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $category->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($category->image)
                            <img src="{{ asset('storage/'.$category->image) }}" alt="{{ $category->name }}" class="h-10 w-10 rounded-full object-cover">
                            @else
                            <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500 text-xs">No img</span>
                            </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $category->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $category->slug }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $category->topUpServices()->count() }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $category->display_order }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($category->is_active)
                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                Hoạt động
                            </span>
                            @else
                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                                Tạm ngưng
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.topup_categories.edit', $category->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">
                                Sửa
                            </a>
                            <a href="{{ route('admin.topup_categories.show', $category->id) }}" class="text-blue-600 hover:text-blue-900 mr-2">
                                Xem
                            </a>
                            <form action="{{ route('admin.topup_categories.destroy', $category->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')">
                                    Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                            Không có danh mục nào
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            
            <div class="p-4 border-t border-gray-200">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 