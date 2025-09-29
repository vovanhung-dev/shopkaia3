@extends('layouts.app')

@section('title', 'Dịch vụ nạp hộ')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Dịch vụ nạp thuê</h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Dịch vụ nạp thuê uy tín, nhanh chóng và an toàn. Đội ngũ chuyên nghiệp của chúng tôi sẽ giúp bạn nạp tiền vào game một cách hiệu quả với mức giá hợp lý nhất.
            </p>
        </div>

        <!-- Bộ lọc -->
        <div class="mb-8">
            <form action="{{ route('topup.index') }}" method="GET" class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    @if(count($categories) > 0)
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Danh mục</label>
                        <select id="category" name="category" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Tất cả danh mục</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    
                    @if(count($games) > 0)
                    <div>
                        <label for="game" class="block text-sm font-medium text-gray-700 mb-1">Game</label>
                        <select id="game" name="game" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Tất cả game</option>
                            @foreach($games as $game)
                            <option value="{{ $game->slug }}" {{ request('game') == $game->slug ? 'selected' : '' }}>
                                {{ $game->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    
                    <div>
                        <label for="sort" class="block text-sm font-medium text-gray-700 mb-1">Sắp xếp theo</label>
                        <select id="sort" name="sort" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="created_at" {{ request('sort', 'created_at') == 'created_at' ? 'selected' : '' }}>Mới nhất</option>
                            <option value="price" {{ request('sort') == 'price' && request('order') == 'asc' ? 'selected' : '' }}>Giá thấp đến cao</option>
                            <option value="price" {{ request('sort') == 'price' && request('order') == 'desc' ? 'selected' : '' }}>Giá cao đến thấp</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Tên A-Z</option>
                        </select>
                        <input type="hidden" name="order" value="{{ request('sort') == 'price' && request('order') != 'desc' ? 'asc' : 'desc' }}">
                    </div>
                    
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Lọc kết quả
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Danh sách dịch vụ -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-12">
            @forelse($services as $service)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                <a href="{{ route('topup.show', $service->slug) }}" class="block">
                    <div class="relative">
                        <img src="{{ $service->thumbnail ? asset('storage/'.$service->thumbnail) : asset('images/default-thumbnail.jpg') }}" 
                            alt="{{ $service->name }}" class="w-full h-48 object-cover">
                        @if($service->hasDiscount())
                        <div class="absolute top-0 left-0 bg-red-600 text-white text-sm font-bold px-3 py-1 m-2 rounded-md">
                            -{{ $service->getDiscountPercentage() }}%
                        </div>
                        @endif
                        <!--<div class="absolute top-0 right-0 bg-blue-600 text-white text-sm font-bold px-3 py-1 m-2 rounded-md">
                            {{ $service->game->name }}
                        </div>-->
                    </div>
                    <div class="p-4">
                        <h3 class="text-xl font-bold text-gray-900 mb-2 truncate">{{ $service->name }}</h3>
                        
                        <!--<div class="flex items-center text-gray-600 text-sm mb-2">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Thời gian ước tính: {{ $service->estimated_minutes }} phút</span>
                        </div>-->
                        
                        <div class="flex items-center text-gray-600 text-sm mb-2">
                            @if($service->category)
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            <span>{{ $service->category->name }}</span>
                            @endif
                        </div>
                        
                        <div class="flex justify-between items-center mt-4">
                            <div>
                                @if($service->hasDiscount())
                                <span class="text-gray-500 line-through text-sm">{{ number_format($service->price) }}đ</span>
                                <span class="text-red-600 font-bold">{{ number_format($service->getDisplayPrice()) }}đ</span>
                                @else
                                <span class="text-red-600 font-bold">{{ number_format($service->price) }}đ</span>
                                @endif
                            </div>
                            <span class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 text-sm">
                                Xem chi tiết
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-span-3 bg-white rounded-lg shadow-md p-6 text-center">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-xl font-medium text-gray-900 mb-2">Không tìm thấy dịch vụ</h3>
                <p class="text-gray-600 mb-4">Chúng tôi không tìm thấy dịch vụ nào phù hợp với tiêu chí tìm kiếm của bạn.</p>
                <a href="{{ route('topup.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Xem tất cả dịch vụ
                </a>
            </div>
            @endforelse
        </div>

        <!-- Phân trang -->
        <div class="mt-6">
            {{ $services->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection 