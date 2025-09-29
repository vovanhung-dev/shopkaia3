@extends('layouts.app')

@section('title', $category->name)

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Tiêu đề danh mục -->
        <div class="relative mb-8 rounded-lg overflow-hidden">
            <img src="{{ $category->image ? asset('storage/'.$category->image) : asset('images/default-banner.jpg') }}" alt="{{ $category->name }}" class="w-full h-64 object-cover">
            <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-transparent flex items-center">
                <div class="px-6 py-4">
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">{{ $category->name }}</h1>
                    @if($category->description)
                    <p class="text-white/90 max-w-2xl">{!! $category->description !!}</p>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Đường dẫn điều hướng -->
        <div class="flex items-center text-sm text-gray-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-blue-600">Trang chủ</a>
            <span class="mx-2">/</span>
            <a href="{{ route('topup.categories') }}" class="hover:text-blue-600">Danh mục nạp hộ</a>
            <span class="mx-2">/</span>
            <span class="text-gray-700 font-medium">{{ $category->name }}</span>
        </div>
        
        <!-- Bộ lọc -->
        <div class="mb-8">
            <form action="{{ route('topup.category.filter', $category->slug) }}" method="GET" class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                    <!-- Lọc theo game -->
                    @if(count($games) > 0)
                    <div>
                        <label for="game_id" class="block text-sm font-medium text-gray-700 mb-1">Game</label>
                        <select id="game_id" name="game_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Tất cả game</option>
                            @foreach($games as $game)
                            <option value="{{ $game->id }}" {{ request('game_id') == $game->id ? 'selected' : '' }}>
                                {{ $game->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    
                    <!-- Lọc theo khoảng giá -->
                    <div>
                        <label for="price_min" class="block text-sm font-medium text-gray-700 mb-1">Giá từ</label>
                        <input type="number" id="price_min" name="price_min" value="{{ request('price_min') }}" min="0" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="VNĐ">
                    </div>
                    
                    <div>
                        <label for="price_max" class="block text-sm font-medium text-gray-700 mb-1">Đến</label>
                        <input type="number" id="price_max" name="price_max" value="{{ request('price_max') }}" min="0" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="VNĐ">
                    </div>
                    
                    <!-- Sắp xếp -->
                    <div>
                        <label for="sort_by" class="block text-sm font-medium text-gray-700 mb-1">Sắp xếp theo</label>
                        <select id="sort_by" name="sort_by" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="latest" {{ request('sort_by', 'latest') == 'latest' ? 'selected' : '' }}>Mới nhất</option>
                            <option value="price_low" {{ request('sort_by') == 'price_low' ? 'selected' : '' }}>Giá thấp đến cao</option>
                            <option value="price_high" {{ request('sort_by') == 'price_high' ? 'selected' : '' }}>Giá cao đến thấp</option>
                        </select>
                    </div>
                    
                    <!-- Nút áp dụng -->
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Lọc kết quả
                        </button>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Danh sách dịch vụ -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6" id="services-container">
            @include('topup.categories._services')
        </div>
        
        <!-- Loading indicator -->
        <div id="loading" class="text-center py-8 hidden">
            <div class="inline-block animate-spin rounded-full h-8 w-8 border-4 border-blue-600 border-t-transparent"></div>
            <p class="mt-2 text-gray-600">Đang tải thêm dịch vụ...</p>
        </div>

        <!-- No more data indicator -->
        <div id="no-more-data" class="text-center py-8 hidden">
            <p class="text-gray-600">Đã hiển thị tất cả dịch vụ</p>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let page = 1;
    let loading = false;
    let hasMoreData = true;
    const container = document.getElementById('services-container');
    const loadingIndicator = document.getElementById('loading');
    const noMoreDataIndicator = document.getElementById('no-more-data');
    
    window.addEventListener('scroll', function() {
        if (loading || !hasMoreData) return;
        
        const scrollHeight = document.documentElement.scrollHeight;
        const scrollTop = window.scrollY;
        const clientHeight = document.documentElement.clientHeight;
        
        if (scrollHeight - scrollTop - clientHeight < 100) {
            loadMore();
        }
    });
    
    function loadMore() {
        loading = true;
        loadingIndicator.classList.remove('hidden');
        
        fetch(`{{ route('topup.category.load-more', $category->slug) }}?page=${page + 1}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.html) {
                container.insertAdjacentHTML('beforeend', data.html);
                page = data.next_page || page;
                
                if (!data.next_page) {
                    hasMoreData = false;
                    noMoreDataIndicator.classList.remove('hidden');
                }
            } else {
                hasMoreData = false;
                noMoreDataIndicator.classList.remove('hidden');
            }
            
            loading = false;
            loadingIndicator.classList.add('hidden');
        })
        .catch(error => {
            console.error('Error loading more services:', error);
            loading = false;
            loadingIndicator.classList.add('hidden');
        });
    }
});
</script>
@endpush
@endsection 