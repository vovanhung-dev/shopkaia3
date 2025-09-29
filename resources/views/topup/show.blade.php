@extends('layouts.app')

@section('title', $service->name)

@section('content')
<div class="bg-gray-50">
    <!-- Hero Banner -->
    <div class="relative">
        @if($service->banner)
        <div class="w-full h-[400px] overflow-hidden">
            <img src="{{ asset('storage/' . $service->banner) }}" alt="{{ $service->name }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
        </div>
        @else
        <div class="w-full h-[400px] bg-gradient-to-r from-blue-600 to-indigo-700">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
        </div>
        @endif
        
        <div class="absolute bottom-0 left-0 w-full p-8 text-white">
            <div class="container mx-auto max-w-7xl">
                <div class="flex flex-col space-y-3">
                    <div class="flex items-center space-x-3 flex-wrap">
                        <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-sm font-medium shadow-sm mb-2">{{ $service->game->name }}</span>
                        <span class="flex items-center bg-blue-600/20 backdrop-blur-sm px-3 py-1 rounded-full text-sm mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $service->estimated_minutes }} phút
                        </span>
                        @if($service->hasDiscount())
                        <span class="bg-red-600/90 backdrop-blur-sm text-white px-3 py-1 rounded-full text-sm font-medium shadow-sm flex items-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Giảm giá
                        </span>
                        @endif
                    </div>
                    <h1 class="text-4xl font-bold mb-2 text-shadow">{{ $service->name }}</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto max-w-7xl py-12 px-4 sm:px-6">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Thông tin chính -->
            <div class="w-full lg:w-2/3">
                <!-- Breadcrumbs -->
                <nav class="mb-8">
                    <ol class="flex text-sm text-gray-500 flex-wrap">
                        <li class="flex items-center">
                            <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Trang chủ</a>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </li>
                        <li class="flex items-center">
                            <a href="{{ route('topup.index') }}" class="hover:text-blue-600 transition">Dịch vụ nạp hộ</a>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </li>
                        <li class="text-gray-900 font-medium">{{ $service->name }}</li>
                    </ol>
                </nav>

                <!-- Mô tả dịch vụ -->
                <div class="bg-white rounded-xl shadow-sm p-8 mb-6 hover:shadow-md transition duration-300">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Mô tả dịch vụ
                    </h2>
                    <div class="prose max-w-none text-gray-700 leading-relaxed">
                        <strong>🎮 Chỉ cần vào Cài đặt → Lấy ID game → Điền vào form là nạp ngay, không cần chờ đợi!</strong><br><strong>⚡ Nhanh – Gọn – Chính xác: Ai cũng làm được, khỏi cần hỏi ai!</strong><br><strong>📬 Nếu sau 10 phút chưa thấy thư, liên hệ ngay với shop để được hỗ trợ liền tay nha bạn!</strong>
                    </div>
                </div>

                <!-- Yêu cầu -->
                @if($service->requirements)
                <div class="bg-white rounded-xl shadow-sm p-8 mb-6 hover:shadow-md transition duration-300">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Yêu cầu
                    </h2>
                    <div class="prose max-w-none text-gray-700 leading-relaxed">
                        {!! $service->requirements !!}
                    </div>
                </div>
                @endif

                <!-- Bao gồm -->
                @if($service->includes)
                <div class="bg-white rounded-xl shadow-sm p-8 mb-6 hover:shadow-md transition duration-300">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Dịch vụ bao gồm
                    </h2>
                    <div class="prose max-w-none text-gray-700 leading-relaxed">
                        {!! $service->includes !!}
                    </div>
                </div>
                @endif

                <!-- Quy trình đặt hàng -->
                <div class="bg-white rounded-xl shadow-sm p-8 hover:shadow-md transition duration-300">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                        Quy trình đặt hàng
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="flex flex-col items-center text-center p-6 bg-blue-50 rounded-xl hover:bg-blue-100 transition duration-300">
                            <div class="bg-blue-600 text-white rounded-full p-4 mb-4 shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold mb-3 text-gray-800">1. Đặt dịch vụ</h3>
                            <p class="text-gray-600">Chọn dịch vụ và thanh toán qua cổng thanh toán an toàn của chúng tôi.</p>
                        </div>
                        <div class="flex flex-col items-center text-center p-6 bg-blue-50 rounded-xl hover:bg-blue-100 transition duration-300">
                            <div class="bg-blue-600 text-white rounded-full p-4 mb-4 shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold mb-3 text-gray-800">2. Xác nhận & Lên lịch</h3>
                            <p class="text-gray-600">Chúng tôi sẽ liên hệ để xác nhận và lên lịch thực hiện công việc.</p>
                        </div>
                        <div class="flex flex-col items-center text-center p-6 bg-blue-50 rounded-xl hover:bg-blue-100 transition duration-300">
                            <div class="bg-blue-600 text-white rounded-full p-4 mb-4 shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold mb-3 text-gray-800">3. Hoàn thành</h3>
                            <p class="text-gray-600">Nhận thông báo khi hoàn thành và kiểm tra kết quả trước khi xác nhận.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Đặt hàng -->
            <div class="w-full lg:w-1/3 mt-8 lg:mt-0">
                <div class="bg-white rounded-xl shadow p-8 sticky top-24 hover:shadow-lg transition duration-300">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        Đặt hàng ngay
                    </h2>
                    
                    <div class="flex items-center justify-between mb-6 pb-6 border-b border-gray-200">
                        <span class="text-gray-600 font-medium">Giá dịch vụ:</span>
                        @if($service->hasDiscount())
                        <div class="flex flex-col items-end">
                            <span class="line-through text-gray-500">{{ number_format($service->price, 0, ',', '.') }}đ</span>
                            <span class="text-2xl font-bold text-red-600">{{ number_format($service->sale_price, 0, ',', '.') }}đ</span>
                        </div>
                        @else
                        <span class="text-2xl font-bold text-gray-800">{{ number_format($service->price, 0, ',', '.') }}đ</span>
                        @endif
                    </div>
                    
                    <div class="flex items-center justify-between mb-6 pb-6 border-b border-gray-200">
                        <span class="text-gray-600 font-medium">Thời gian hoàn thành:</span>
                        <span class="font-semibold text-gray-800 bg-blue-50 px-3 py-1 rounded-full">{{ $service->estimated_minutes }} phút</span>
                    </div>
                    
                    @auth
                    <form action="{{ route('topup.order', $service->slug) }}" method="POST" class="mt-6">
                        @csrf
                        <div class="space-y-4">
                            @if($service->login_type === 'game_id' || $service->login_type === 'both')
                            <div>
                                <label for="game_id" class="block text-sm font-medium text-gray-700">ID Game <span class="text-red-600">*</span></label>
                                <input type="text" name="game_id" id="game_id" value="{{ old('game_id') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                                @error('game_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            @endif
                            
                            @if($service->login_type === 'username_password' || $service->login_type === 'both')
                            <div>
                                <label for="game_username" class="block text-sm font-medium text-gray-700">Tên đăng nhập Game <span class="text-red-600">*</span></label>
                                <input type="text" name="game_username" id="game_username" value="{{ old('game_username') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                                @error('game_username')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="game_password" class="block text-sm font-medium text-gray-700">Mật khẩu Game <span class="text-red-600">*</span></label>
                                <input type="password" name="game_password" id="game_password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                                @error('game_password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            @endif
                            
                            <div>
                                <label for="server_id" class="block text-sm font-medium text-gray-700">Server Game</label>
                                <input type="text" name="server_id" id="server_id" value="{{ old('server_id') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <p class="mt-1 text-xs text-gray-500">Nhập server game nếu có</p>
                            </div>
                            
                            <div>
                                <label for="additional_info" class="block text-sm font-medium text-gray-700">Thông tin bổ sung</label>
                                <textarea name="additional_info" id="additional_info" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">{{ old('additional_info') }}</textarea>
                                <p class="mt-1 text-xs text-gray-500">Thông tin thêm mà bạn muốn cung cấp</p>
                            </div>
                            
                            <div class="pt-4">
                                <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Đặt ngay
                                </button>
                            </div>
                        </div>
                    </form>
                    @else
                    <div class="text-center bg-blue-50 p-6 rounded-lg mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-blue-600 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <p class="mb-4 text-gray-700 font-medium">Vui lòng đăng nhập để đặt dịch vụ</p>
                        <a href="{{ route('login') }}" class="w-full inline-block bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-300 font-bold shadow-md">
                            Đăng nhập ngay
                        </a>
                    </div>
                    @endauth
                    
                    <div class="mt-6 p-6 bg-gray-50 rounded-lg">
                        <h3 class="font-semibold text-gray-800 mb-4 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Cam kết của chúng tôi
                        </h3>
                        <ul class="space-y-3">
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-700">Hỗ trợ 24/7 qua chat và hotline</span>
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-700">Bảo mật thông tin tuyệt đối</span>
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-700">Hoàn tiền 100% nếu không hài lòng</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dịch vụ khác -->
        @if(isset($relatedServices) && $relatedServices->count() > 0)
        <div class="mt-16">
            <h2 class="text-2xl font-bold mb-8 text-gray-800 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
                Dịch vụ khác có thể bạn quan tâm
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($relatedServices as $relatedService)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300">
                    <a href="{{ route('topup.show', $relatedService->slug) }}" class="block">
                        <div class="relative">
                            <img src="{{ $relatedService->thumbnail ? asset('storage/' . $relatedService->thumbnail) : asset('images/default-service.jpg') }}" 
                                alt="{{ $relatedService->name }}" class="w-full h-48 object-cover">
                            <!--<div class="absolute top-0 right-0 bg-blue-600 text-white text-sm font-bold px-3 py-1 m-2 rounded-md">
                                {{ $relatedService->game->name }}
                            </div>-->
                        </div>
                        <div class="p-4">
                            <h3 class="text-xl font-bold text-gray-900 mb-2 truncate">{{ $relatedService->name }}</h3>
                            
                            <!--<div class="flex items-center text-gray-600 text-sm mb-2">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Thời gian ước tính: {{ $relatedService->estimated_minutes }} phút</span>
                            </div>-->
                            
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{!! Str::limit(strip_tags($relatedService->description), 100) !!}</p>
                            
                            <div class="flex justify-between items-center">
                                <div>
                                    @if($relatedService->hasDiscount())
                                    <p class="text-gray-500 line-through text-sm">{{ number_format($relatedService->price, 0, ',', '.') }}đ</p>
                                    <p class="text-xl font-bold text-red-600">{{ number_format($relatedService->sale_price, 0, ',', '.') }}đ</p>
                                    @else
                                    <p class="text-xl font-bold text-gray-900">{{ number_format($relatedService->price, 0, ',', '.') }}đ</p>
                                    @endif
                                </div>
                                <span class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 inline-block text-sm">
                                    Xem chi tiết
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection 