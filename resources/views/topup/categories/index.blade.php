@extends('layouts.app')

@section('title', 'Danh mục dịch vụ nạp thuê')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Danh mục dịch vụ nạp thuê</h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Chọn danh mục dịch vụ nạp thuê phù hợp với nhu cầu của bạn. Chúng tôi cung cấp đa dạng các dịch vụ nạp thuê cho nhiều game khác nhau.
            </p>
        </div>


        <!-- Danh sách danh mục -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-12">
            @forelse($categories as $category)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                <a href="{{ route('topup.category', $category->slug) }}" class="block">
                    <div class="relative">
                        <img src="{{ $category->image ? asset('storage/'.$category->image) : asset('images/default-category.jpg') }}" 
                            alt="{{ $category->name }}" class="h-48 w-auto mx-auto object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="text-xl font-bold text-gray-900 mb-2 truncate">{{ $category->name }}</h3>
                        
                        <div class="flex items-center text-gray-600 text-sm mb-2">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            <span>{{ $category->availableServices()->count() }} dịch vụ</span>
                        </div>
                        
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2 text-center">Hoàn thành: {{ rand(10, 100) }}</p>
                        
                        <div class="flex justify-end">
                            <span class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 text-sm">
                                Xem chi tiết
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-span-4 bg-white rounded-lg shadow-md p-6 text-center">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-xl font-medium text-gray-900 mb-2">Không tìm thấy danh mục nào</h3>
                <p class="text-gray-600 mb-4">Chúng tôi không tìm thấy danh mục nào trong hệ thống.</p>
                <a href="{{ route('topup.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Xem tất cả dịch vụ
                </a>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection 