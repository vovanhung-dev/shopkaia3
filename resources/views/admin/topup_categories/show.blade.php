@extends('layouts.admin')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">Chi tiết danh mục: {{ $category->name }}</h1>
            <div class="flex space-x-2">
                <a href="{{ route('admin.topup_categories.index') }}" class="flex items-center text-gray-600 hover:text-gray-900 bg-gray-100 hover:bg-gray-200 py-2 px-4 rounded-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Quay lại
                </a>
                <a href="{{ route('admin.topup_categories.edit', $category->id) }}" class="flex items-center text-white bg-blue-600 hover:bg-blue-700 py-2 px-4 rounded-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Chỉnh sửa
                </a>
            </div>
        </div>
        
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="bg-gray-50 py-3 px-4 border-b border-gray-200">
                <h2 class="text-xl font-medium text-gray-800">Thông tin danh mục</h2>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Thông tin chung -->
                    <div>
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-lg font-medium text-gray-700 mb-2">Thông tin cơ bản</h3>
                                <div class="bg-gray-50 p-4 rounded-md">
                                    <div class="grid grid-cols-1 gap-3">
                                        <div class="flex">
                                            <span class="w-1/3 text-sm font-medium text-gray-500">ID:</span>
                                            <span class="w-2/3 text-sm text-gray-900">{{ $category->id }}</span>
                                        </div>
                                        <div class="flex">
                                            <span class="w-1/3 text-sm font-medium text-gray-500">Tên danh mục:</span>
                                            <span class="w-2/3 text-sm text-gray-900">{{ $category->name }}</span>
                                        </div>
                                        <div class="flex">
                                            <span class="w-1/3 text-sm font-medium text-gray-500">Slug:</span>
                                            <span class="w-2/3 text-sm text-gray-900">{{ $category->slug }}</span>
                                        </div>
                                        <div class="flex">
                                            <span class="w-1/3 text-sm font-medium text-gray-500">Thứ tự hiển thị:</span>
                                            <span class="w-2/3 text-sm text-gray-900">{{ $category->display_order }}</span>
                                        </div>
                                        <div class="flex">
                                            <span class="w-1/3 text-sm font-medium text-gray-500">Trạng thái:</span>
                                            <span class="w-2/3">
                                                @if($category->is_active)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    Đang hoạt động
                                                </span>
                                                @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                    Không hoạt động
                                                </span>
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <h3 class="text-lg font-medium text-gray-700 mb-2">Thông tin mô tả</h3>
                                <div class="bg-gray-50 p-4 rounded-md">
                                    <p class="text-sm text-gray-900">{{ $category->description ?: 'Không có mô tả' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Thông tin SEO và hình ảnh -->
                    <div class="space-y-4">
                        @if($category->image)
                        <div>
                            <h3 class="text-lg font-medium text-gray-700 mb-2">Hình ảnh</h3>
                            <div class="bg-gray-50 p-4 rounded-md">
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="max-w-full h-auto rounded-lg">
                            </div>
                        </div>
                        @endif
                        
                        <div>
                            <h3 class="text-lg font-medium text-gray-700 mb-2">Thông tin SEO</h3>
                            <div class="bg-gray-50 p-4 rounded-md space-y-3">
                                <div class="flex">
                                    <span class="w-1/3 text-sm font-medium text-gray-500">Meta Title:</span>
                                    <span class="w-2/3 text-sm text-gray-900">{{ $category->meta_title ?: 'Không có' }}</span>
                                </div>
                                <div class="flex">
                                    <span class="w-1/3 text-sm font-medium text-gray-500">Meta Keywords:</span>
                                    <span class="w-2/3 text-sm text-gray-900">{{ $category->meta_keywords ?: 'Không có' }}</span>
                                </div>
                                <div class="flex">
                                    <span class="w-1/3 text-sm font-medium text-gray-500">Meta Description:</span>
                                    <span class="w-2/3 text-sm text-gray-900">{{ $category->meta_description ?: 'Không có' }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-medium text-gray-700 mb-2">Thông tin thời gian</h3>
                            <div class="bg-gray-50 p-4 rounded-md space-y-3">
                                <div class="flex">
                                    <span class="w-1/3 text-sm font-medium text-gray-500">Ngày tạo:</span>
                                    <span class="w-2/3 text-sm text-gray-900">{{ $category->created_at->format('d/m/Y H:i:s') }}</span>
                                </div>
                                <div class="flex">
                                    <span class="w-1/3 text-sm font-medium text-gray-500">Cập nhật lần cuối:</span>
                                    <span class="w-2/3 text-sm text-gray-900">{{ $category->updated_at->format('d/m/Y H:i:s') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 