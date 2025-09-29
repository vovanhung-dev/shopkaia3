@extends('layouts.app')

@section('title', 'Trang chủ')

<!--@section('breadcrumbs')
<div class="flex items-center text-sm">
    <a href="{{ route('home') }}" class="text-indigo-600 font-medium">Trang chủ</a>
</div>
@endsection-->

@section('content')
    <!-- Hero Banner -->
    <div class="relative">
        <div class="bg-gradient-to-r from-indigo-700/80 to-blue-500/80 text-white relative overflow-hidden">
            <div class="absolute inset-0 bg-cover bg-center bg-no-repeat animate-zoom-in-out overflow-hidden" style="background-image: url('{{ asset('images/banner.jpeg') }}')"></div>
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 mb-16 relative">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                    <div data-aos="fade-right">
                        <h1 class="welcome-text">
                        SHOPBUFFSAO XIN KÍNH CHÀO <span class="text-yellow-300"> QUÝ KHÁCH</span>
                        </h1>
                        <!--<p class="text-xl mb-8 text-gray-200 leading-relaxed animate-fade-in-up animate-delay-100 shadow-black-text">
                            Chúng tôi cung cấp các tài khoản game uy tín, giá tốt nhất thị trường, giao dịch an toàn, bảo mật.
                        </p>-->
                        <div class="flex flex-col sm:flex-row gap-4 animate-fade-in-up animate-delay-200">
                        <!-- Nút Xem tài khoản -->
                        <a href="{{ route('accounts.index') }}"
                        class="animated-opacity text-white font-bold px-6 py-3 text-lg rounded-xl shadow-xl flex items-center justify-center gap-2 transition-all duration-500 ease-in-out">
                        <i class="bi bi-controller text-xl"></i>
                        <span>Xem tài khoản</span>
                        </a>







                        <!-- Nút Tìm hiểu thêm (bật nếu cần) -->
                        <!--
                        <a href="{{ route('about') }}"
                        class="group border-2 border-white text-white font-semibold px-6 py-3 text-lg rounded-xl hover:bg-white hover:text-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center gap-2">
                            <i class="bi bi-info-circle text-xl group-hover:scale-110 transition-transform duration-300"></i>
                            <span>Tìm hiểu thêm</span>
                        </a>
                        -->
                    </div>

                    </div>
                    <div class="hidden md:block" data-aos="fade-left">
                        <div class="relative">
                            <div class="absolute -inset-4 bg-white/10 rounded-2xl blur-xl"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Wave effect -->
            <div class="absolute bottom-0 left-0 right-0">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 80" class="w-full">
                    <path fill="#f9fafb" fill-opacity="1" d="M0,32L80,42.7C160,53,320,75,480,74.7C640,75,800,53,960,37.3C1120,21,1280,11,1360,5.3L1440,0L1440,100L1360,100C1280,100,1120,100,960,100C800,100,640,100,480,100C320,100,160,100,80,100L0,100Z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Danh mục tài khoản -->
    <!--<div class="bg-gray-50 py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10 text-center" data-aos="fade-up">
                <span class="bg-indigo-100 text-indigo-800 text-xs font-medium inline-block px-2.5 py-1 rounded-full">DANH MỤC TÀI KHOẢN</span>
                <h2 class="text-3xl font-bold text-gray-800 mb-2 mt-2">SPAM KHẮP ĐẢO KAIA</h2>
                <div class="divider"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">Cập nhật liên tục các tài khoản mới nhất với nhiều ưu đãi hấp dẫn</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach($accountCategories as $category)
                <div class="card hover-shadow lightning-border lightning-effect lightning-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="floating-particle p1"></div>
                    <div class="floating-particle p2"></div>
                    <div class="floating-particle p3"></div>
                    <div class="floating-particle p4"></div>
                    <div class="floating-particle p5"></div>
                    <div class="floating-particle p6"></div>
                    <div class="floating-particle p7"></div>
                    <div class="floating-particle p8"></div>
                    <div class="inner-glow"></div>
                    <div class="flash"></div>
                    <div class="corner corner-tl"></div>
                    <div class="corner corner-tr"></div>
                    <div class="corner corner-bl"></div>
                    <div class="corner corner-br"></div>
                    <div class="shooting-star shooting-star-1"></div>
                    <div class="shooting-star shooting-star-2"></div>
                    <div class="shooting-star shooting-star-3"></div>
                    <a href="{{ route('account.category', $category->slug) }}" class="block relative z-10">
                        @if($category->image)
                            <div class="overflow-hidden rounded-t-xl">
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" 
                                    class="w-full h-52 object-cover transition-transform duration-500 hover:scale-110">
                            </div>
                        @else
                            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-52 flex items-center justify-center rounded-t-xl">
                                <span class="text-white text-2xl font-bold px-4 text-center">{{ $category->name }}</span>
                            </div>
                        @endif
                        <div class="p-5">
                            <h3 class="text-xl font-bold mb-2 text-gray-800 group-hover:text-indigo-600 transition-colors">{{ $category->name }}</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2 h-10">{{ $category->description }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-indigo-600 font-medium flex items-center">
                                    Xem tài khoản
                                    <i class="bi bi-arrow-right ml-1"></i>
                                </span>
                                <span class="badge badge-blue">
                                    {{ $category->accounts()->where('status', 'available')->count() }} tài khoản
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            </div>
            
            <div class="mt-12 text-center" data-aos="fade-up">
                <a href="{{ route('account.categories') }}" class="btn-primary px-8 py-3 flex items-center justify-center mx-auto w-auto max-w-xs">
                    <i class="bi bi-grid-3x3-gap mr-2"></i>
                    Xem tất cả danh mục
                </a>
            </div>
        </div>
    </div>-->

    <!-- Dịch vụ nổi bật -->
    @if(isset($services) && $services->count() > 0)
    <div class="bg-white py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10 text-center" data-aos="fade-up">
                <span class="bg-blue-100 text-blue-800 text-xs font-medium inline-block px-2.5 py-1 rounded-full">DỊCH VỤ HÀNG ĐẦU</span>
                <h2 class="text-3xl font-bold text-gray-800 mb-2 mt-2">Khu vực dịch vụ</h2>
                <div class="divider"></div>
                <p class="text-gray-600 max-w-2xl mx-auto">Dịch vụ uy tín từ các ShopBuffsao</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($services as $service)
                <div class="group card card-hover-effect lightning-effect lightning-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="inner-glow"></div>
                    <div class="flash"></div>
                    <div class="corner corner-tl"></div>
                    <div class="corner corner-tr"></div>
                    <div class="corner corner-bl"></div>
                    <div class="corner corner-br"></div>
                    <div class="shooting-star shooting-star-1"></div>
                    <div class="shooting-star shooting-star-2"></div>
                    <div class="shooting-star shooting-star-3"></div>
                    <a href="{{ route('services.show', $service->slug) }}" class="block relative z-10">
                        <div class="relative h-48 overflow-hidden rounded-t-xl">
                            @if($service->image)
                                <img src="{{ asset($service->image) }}" alt="{{ $service->name }}" 
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @else
                                <div class="w-full h-full bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center">
                                    <i class="bi bi-play-circle text-white text-6xl"></i>
                                </div>
                            @endif
                            @if($service->is_featured)
                                <div class="absolute top-2 right-2">
                                    <span class="bg-yellow-500/80 text-white text-xs font-medium px-2.5 py-1 rounded flex items-center backdrop-blur-sm">
                                        <i class="bi bi-star-fill mr-1"></i>
                                        Nổi bật
                                    </span>
                                </div>
                            @endif
                        </div>
                    </a>
                    
                    <div class="p-5">
                        <a href="{{ route('services.show', $service->slug) }}" class="block">
                            <h3 class="font-bold text-gray-800 mb-2 hover:text-indigo-600 transition text-center auto-shrink">{{ $service->name }}</h3>
                        </a>
                        
                        <p class="text-gray-600 text-sm mb-4 line-clamp-1 h-6 overflow-hidden whitespace-normal text-center">Hoàn thành: {{ rand(10, 100) }}</p>
                        
                        <div class="flex items-center justify-between">
                            <div class="text-indigo-600 font-semibold">
                                @if($service->packages->count() > 0)
                                    Từ {{ number_format($service->packages->min('price'), 0, ',', '.') }}đ
                                @else
                                    Liên hệ báo giá
                                @endif
                            </div>
                            <a href="{{ route('services.show', $service->slug) }}" 
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-700 focus:ring-4 focus:outline-none focus:ring-indigo-300 transition">
                                <span>Chi tiết</span>
                                <i class="bi bi-chevron-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="mt-12 text-center" data-aos="fade-up">
                <a href="{{ route('services.index') }}" class="btn-primary px-8 py-3 flex items-center justify-center mx-auto w-auto max-w-xs">
                    <i class="bi bi-grid-3x3-gap mr-2"></i>
                    Xem tất cả dịch vụ
                </a>
            </div>
        </div>
    </div>
    @endif

     <!-- Lý do chọn chúng tôi -->
     <div class="bg-gradient-to-r from-indigo-700 to-blue-700 text-white py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10 text-center" data-aos="fade-up">
                <span class="bg-white/20 text-white text-xs font-medium inline-block px-2.5 py-1 rounded-full backdrop-blur-sm">VÌ SAO CHỌN CHÚNG TÔI</span>
                <h2 class="text-3xl font-bold mb-2 mt-2">Tại sao chọn chúng tôi?</h2>
                <div class="w-16 sm:w-24 h-1 bg-white/20 rounded-full mx-auto my-4"></div>
                <p class="text-gray-200 max-w-2xl mx-auto">Chúng tôi cam kết mang đến cho bạn trải nghiệm mua tài khoản game tốt nhất</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="text-center flex flex-col items-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="bg-white/10 rounded-xl p-6 mb-6 w-20 h-20 flex items-center justify-center backdrop-blur-sm">
                        <i class="bi bi-patch-check text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Uy tín hàng đầu</h3>
                    <p class="text-gray-200">Chúng tôi cam kết cung cấp tài khoản chất lượng, đúng như mô tả, mang đến sự hài lòng cho khách hàng.</p>
                </div>
                
                <div class="text-center flex flex-col items-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="bg-white/10 rounded-xl p-6 mb-6 w-20 h-20 flex items-center justify-center backdrop-blur-sm">
                        <i class="bi bi-shield-check text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">An toàn & Bảo mật</h3>
                    <p class="text-gray-200">Giao dịch an toàn, bảo mật thông tin khách hàng tuyệt đối, thanh toán đa dạng qua nhiều hình thức.</p>
                </div>
                
                <div class="text-center flex flex-col items-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="bg-white/10 rounded-xl p-6 mb-6 w-20 h-20 flex items-center justify-center backdrop-blur-sm">
                        <i class="bi bi-headset text-4xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4">Hỗ trợ 24/7</h3>
                    <p class="text-gray-200">Đội ngũ hỗ trợ chuyên nghiệp, luôn sẵn sàng giải đáp mọi thắc mắc và hỗ trợ bạn khi cần.</p>
                </div>
            </div>
            
            <!-- CTA Button -->
            <div class="mt-12 text-center" data-aos="fade-up">
                <a href="{{ route('contact') }}" class="bg-white text-indigo-700 px-8 py-3 rounded-lg font-medium inline-flex items-center hover:bg-gray-100 transition-all transform hover:-translate-y-1 hover:shadow-xl">
                    <i class="bi bi-chat-dots mr-2"></i>
                    Liên hệ với chúng tôi
                </a>
            </div>
        </div>
    </div>
@endsection 

<style>
    @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap');
    h1 {
        font-family: 'Fredoka One', cursive;
    }
    @keyframes zoomInOut {
        0% {
            transform: scale(1.2);
        }
        100% {
            transform: scale(1);
        }
    }

    .animate-zoom-in-out {
        animation: zoomInOut 0.5s ease-out forwards;
        z-index: 0;
    }

    .welcome-text {
      font-family: 'Fredoka One', cursive, sans-serif;
      text-align: center;
      color: #ff6ec4;
      text-transform: uppercase;
      letter-spacing: 4px;
      animation: bounce 1s ease-in-out;
      text-shadow:
        2px 2px 0 #ffb347,
        4px 4px 0 #ffcc33,
        6px 6px 10px rgba(0, 0, 0, 0.2);
      font-size: 3vw;
      line-height: 1.2;
      margin: 20px 0;
    }

    @keyframes bounce {
      0% {
        transform: translateY(-50px);
        opacity: 0;
      }
      50% {
        transform: translateY(10px);
        opacity: 1;
      }
      70% {
        transform: translateY(-5px);
      }
      100% {
        transform: translateY(0);
      }
    }

    @media (max-width: 768px) {
      .welcome-text {
        font-size: 9vw;
        padding: 10px;
      }
    }

    @media (min-width: 769px) {
      .welcome-text {
        font-size: 3vw;
        text-align: left;
      }
    }

    .shadow-black-text {
        text-shadow:
            0 0 0 #000,
            0 0 5px #000,
            0 0 1px #000;
        font-weight: bold;
    }
    .animated-gradient {
    background: linear-gradient(270deg, #00c6ff, #0072ff, #00c6ff);
    background-size: 600% 600%;
    animation: gradientShift 8s ease infinite;
    transition: transform 0.3s ease;
    }

    @keyframes gradientShift {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
    }
    /* Animation chuyển động nền + độ mờ */
    @keyframes gradientOpacity {
    0% {
        background-position: 0% 50%;
        opacity: 0.5;
    }
    50% {
        background-position: 100% 50%;
        opacity: 0.8;
    }
    100% {
        background-position: 0% 50%;
        opacity: 0.5;
    }
    }

    .animated-opacity {
    background: linear-gradient(270deg, #00c6ff, #0072ff, #00c6ff);
    background-size: 600% 600%;
    animation: gradientOpacity 8s ease infinite;
    transition: transform 0.3s ease;
    border: none;
    }

    /* Sửa hiệu ứng phần tử */
    .card.lightning-effect {
        overflow: hidden !important;
        position: relative !important;
        border: none !important;
        box-shadow: 0 0 15px rgba(0, 114, 255, 0.3);
        z-index: 1;
        border-radius: 0.75rem;
        transition: all 0.3s ease;
    }
    
    /* Viền sáng di chuyển */
    .card.lightning-effect::before {
        content: '';
        position: absolute;
        top: -6px;
        left: -6px;
        right: -6px;
        bottom: -6px;
        z-index: -1;
        border-radius: 0.75rem;
        background: linear-gradient(90deg, 
            transparent 0%,
            transparent 35%,
            rgba(0, 198, 255, 0.9) 45%, 
            rgba(0, 114, 255, 1) 50%, 
            rgba(0, 198, 255, 0.9) 55%,
            transparent 65%,
            transparent 100%
        );
        background-size: 300% 300%;
        border: none;
        box-shadow: 0 0 20px rgba(0, 198, 255, 0.6);
        filter: blur(0.5px);
        animation: moveGradient 5s linear infinite;
        pointer-events: none;
        opacity: 1;
        transition: opacity 0.3s ease;
    }
    
    /* Ẩn viền khi hover */
    .card.lightning-effect:hover::before {
        opacity: 0;
    }
    
    /* Lớp trắng bên trong để không che phủ nội dung */
    .card.lightning-effect::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: white;
        border-radius: inherit;
        z-index: 0;
        pointer-events: none;
    }
    
    /* Đảm bảo nội dung card hiển thị trên cùng */
    .card.lightning-effect > * {
        position: relative;
        z-index: 2;
    }
    
    @keyframes moveGradient {
        0% {
            background-position: 0% 50%;
        }
        100% {
            background-position: 300% 50%;
        }
    }
    
    /* Đảm bảo hiệu ứng đom đóm nằm trong card và hiển thị dưới ảnh */
    .lightning-effect .floating-particle {
        position: absolute !important;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.9) 20%, rgba(0, 198, 255, 0.7) 70%);
        box-shadow: 0 0 6px 2px rgba(0, 198, 255, 0.5), 0 0 10px 4px rgba(0, 114, 255, 0.3);
        opacity: 0;
        z-index: 1 !important; /* Giảm z-index để hiển thị dưới nội dung */
        pointer-events: none;
    }
    
    /* Hiệu ứng sao băng - hiển thị trên toàn bộ card thay vì chỉ trong ảnh */
    .card .shooting-star {
        position: absolute;
        width: 2px;
        height: 100px;
        background: linear-gradient(180deg, 
            rgba(255, 255, 255, 0), 
            rgba(255, 255, 255, 0.5) 20%, 
            rgba(70, 200, 255, 0.6) 40%, 
            rgba(30, 100, 255, 0.3));
        filter: drop-shadow(0 0 4px rgba(255, 255, 255, 0.5));
        opacity: 0;
        z-index: 20 !important; /* Tăng z-index để nằm trên ảnh */
        pointer-events: none;
        transform-origin: center top;
        top: -60px; /* Di chuyển lên trên card */
    }
    
    /* Di chuyển sao băng ra khỏi thẻ div.relative */
    .card.lightning-effect .shooting-star {
        top: -60px;
        left: 30%;
    }

    .card.lightning-effect .shooting-star-1 {
        left: 30%;
        animation: shootingStar1 6s ease-in-out infinite;
        animation-delay: 2s;
    }

    .card.lightning-effect .shooting-star-2 {
        left: 60%;
        animation: shootingStar2 8s ease-in-out infinite;
        animation-delay: 5s;
    }

    .card.lightning-effect .shooting-star-3 {
        left: 20%;
        animation: shootingStar3 7s ease-in-out infinite;
        animation-delay: 1s;
    }

    .card .shooting-star::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: -1px;
        width: 4px;
        height: 4px;
        border-radius: 50%;
        background: white;
        box-shadow: 0 0 8px 1px rgba(70, 200, 255, 0.6);
    }

    /* Đảm bảo elements nằm đúng vị trí trong card */
    .card.lightning-effect .relative {
        position: relative;
        z-index: 15 !important; /* Tăng z-index để hiển thị trên đom đóm */
    }

    .card.lightning-effect .relative img {
        position: relative;
        z-index: 15 !important; /* Tăng z-index để hiển thị trên đom đóm */
    }

    .card.lightning-effect a {
        position: relative;
        z-index: 10;
    }

    .card.lightning-effect .web-container,
    .card.lightning-effect .web-line {
        position: absolute;
        pointer-events: none;
        z-index: 5 !important; /* Giảm z-index để hiển thị dưới ảnh */
        display: none; /* Ẩn web container và web line */
    }

    /* Animation sao băng */
    @keyframes shootingStar1 {
        0%, 100% { 
            opacity: 0; 
            transform: rotate(15deg) translateY(0);
        }
        10%, 15% { 
            opacity: 1; 
        }
        30% { 
            opacity: 0; 
            transform: rotate(15deg) translateY(300px);
        }
    }

    @keyframes shootingStar2 {
        0%, 100% { 
            opacity: 0; 
            transform: rotate(-10deg) translateY(0);
        }
        10%, 15% { 
            opacity: 1; 
        }
        35% { 
            opacity: 0; 
            transform: rotate(-10deg) translateY(350px);
        }
    }

    @keyframes shootingStar3 {
        0%, 100% { 
            opacity: 0; 
            transform: rotate(25deg) translateY(0);
        }
        10%, 15% { 
            opacity: 1; 
        }
        25% { 
            opacity: 0; 
            transform: rotate(25deg) translateY(250px);
        }
    }

    /* Ẩn hiệu ứng mạng nhện */
    .card.lightning-effect .web-container {
        display: none;
    }

    .card.lightning-effect .web-line {
        display: none;
    }

    .static-web-line {
        display: none;
    }

    /* Cải thiện đốm đom đóm - tập trung phía dưới card và di chuyển tự do */
    .floating-particle {
        position: absolute;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.9) 20%, rgba(0, 198, 255, 0.7) 70%);
        box-shadow: 0 0 6px 2px rgba(0, 198, 255, 0.5), 0 0 10px 4px rgba(0, 114, 255, 0.3);
        opacity: 0;
        z-index: 5;
        pointer-events: none;
    }

    /* Đốm sáng tự do - tập trung ở phía dưới card */
    .floating-particle.p1 {
        bottom: 20%;
        left: 15%;
        animation: floatingParticleBezier1 6s cubic-bezier(0.45, 0.05, 0.55, 0.95) infinite;
    }

    .floating-particle.p2 {
        bottom: 15%;
        left: 65%;
        animation: floatingParticleBezier2 7s cubic-bezier(0.45, 0.05, 0.55, 0.95) infinite;
        animation-delay: 1.5s;
    }

    .floating-particle.p3 {
        bottom: 10%;
        left: 35%;
        animation: floatingParticleBezier3 5.5s cubic-bezier(0.45, 0.05, 0.55, 0.95) infinite;
        animation-delay: 0.7s;
    }

    .floating-particle.p4 {
        bottom: 8%;
        left: 85%;
        animation: floatingParticleBezier4 6.5s cubic-bezier(0.45, 0.05, 0.55, 0.95) infinite;
        animation-delay: 1.1s;
    }

    .floating-particle.p5 {
        bottom: 5%;
        left: 25%;
        animation: floatingParticleBezier5 6.2s cubic-bezier(0.45, 0.05, 0.55, 0.95) infinite;
        animation-delay: 0.5s;
    }

    .floating-particle.p6 {
        bottom: 3%;
        left: 55%;
        animation: floatingParticleBezier6 5.8s cubic-bezier(0.45, 0.05, 0.55, 0.95) infinite;
        animation-delay: 0.3s;
    }

    .floating-particle.p7 {
        bottom: 2%;
        left: 10%;
        animation: floatingParticleBezier7 6.7s cubic-bezier(0.45, 0.05, 0.55, 0.95) infinite;
        animation-delay: 1.8s;
    }

    .floating-particle.p8 {
        bottom: 1%;
        left: 75%;
        animation: floatingParticleBezier8 6.3s cubic-bezier(0.45, 0.05, 0.55, 0.95) infinite;
        animation-delay: 0.9s;
    }

    .floating-particle.p9 {
        bottom: 12%;
        left: 45%;
        animation: floatingParticleBezier9 6.8s cubic-bezier(0.45, 0.05, 0.55, 0.95) infinite;
        animation-delay: 1.2s;
    }

    .floating-particle.p10 {
        bottom: 18%;
        left: 90%;
        animation: floatingParticleBezier10 5.9s cubic-bezier(0.45, 0.05, 0.55, 0.95) infinite;
        animation-delay: 1.7s;
    }

    /* Thêm đốm sáng đuổi nhau theo đường cong */
    .floating-particle.p11, .floating-particle.p12 {
        display: none !important;
    }

    /* Đường cong mượt mà cho đốm sáng đuổi nhau */
    @keyframes curvePathAnimation1 {
        0% { opacity: 0; transform: translate(var(--start-curve1-x, 80px), var(--start-curve1-y, 50px)); }
        5% { opacity: 1; }
        25% { transform: translate(var(--curve1-x1, 40px), var(--curve1-y1, -40px)); }
        50% { transform: translate(var(--curve1-x2, -20px), var(--curve1-y2, -80px)); }
        75% { transform: translate(var(--curve1-x3, -60px), var(--curve1-y3, -20px)); }
        95% { opacity: 1; }
        100% { opacity: 0; transform: translate(var(--end-curve1-x, -100px), var(--end-curve1-y, 50px)); }
    }

    @keyframes curvePathAnimation2 {
        0% { opacity: 0; transform: translate(var(--start-curve2-x, -70px), var(--start-curve2-y, 30px)); }
        5% { opacity: 1; }
        25% { transform: translate(var(--curve2-x1, 30px), var(--curve2-y1, -45px)); }
        50% { transform: translate(var(--curve2-x2, 10px), var(--curve2-y2, -85px)); }
        75% { transform: translate(var(--curve2-x3, -45px), var(--curve2-y3, -15px)); }
        95% { opacity: 1; }
        100% { opacity: 0; transform: translate(var(--end-curve2-x, 70px), var(--end-curve2-y, 40px)); }
    }

    /* Animations cho các đốm sáng di chuyển từ dưới lên */
    @keyframes floatingParticleBezier1 {
        0% { opacity: 0; transform: translate(var(--start-x1, 0px), var(--start-y1, 0px)); }
        10% { opacity: 0.7; }
        90% { opacity: 0.7; }
        100% { opacity: 0; transform: translate(var(--end-x1, 0px), var(--end-y1, -150px)); }
    }

    @keyframes floatingParticleBezier2 {
        0% { opacity: 0; transform: translate(var(--start-x2, 0px), var(--start-y2, 0px)); }
        10% { opacity: 0.7; }
        90% { opacity: 0.7; }
        100% { opacity: 0; transform: translate(var(--end-x2, 0px), var(--end-y2, -150px)); }
    }

    @keyframes floatingParticleBezier3 {
        0% { opacity: 0; transform: translate(var(--start-x3, 0px), var(--start-y3, 0px)); }
        10% { opacity: 0.7; }
        90% { opacity: 0.7; }
        100% { opacity: 0; transform: translate(var(--end-x3, 0px), var(--end-y3, -150px)); }
    }

    @keyframes floatingParticleBezier4 {
        0% { opacity: 0; transform: translate(var(--start-x4, 0px), var(--start-y4, 0px)); }
        10% { opacity: 0.7; }
        90% { opacity: 0.7; }
        100% { opacity: 0; transform: translate(var(--end-x4, 0px), var(--end-y4, -150px)); }
    }

    @keyframes floatingParticleBezier5 {
        0% { opacity: 0; transform: translate(var(--start-x5, 0px), var(--start-y5, 0px)); }
        10% { opacity: 0.7; }
        90% { opacity: 0.7; }
        100% { opacity: 0; transform: translate(var(--end-x5, 0px), var(--end-y5, -150px)); }
    }

    @keyframes floatingParticleBezier6 {
        0% { opacity: 0; transform: translate(var(--start-x6, 0px), var(--start-y6, 0px)); }
        10% { opacity: 0.7; }
        90% { opacity: 0.7; }
        100% { opacity: 0; transform: translate(var(--end-x6, 0px), var(--end-y6, -150px)); }
    }

    @keyframes floatingParticleBezier7 {
        0% { opacity: 0; transform: translate(var(--start-x7, 0px), var(--start-y7, 0px)); }
        10% { opacity: 0.7; }
        90% { opacity: 0.7; }
        100% { opacity: 0; transform: translate(var(--end-x7, 0px), var(--end-y7, -150px)); }
    }

    @keyframes floatingParticleBezier8 {
        0% { opacity: 0; transform: translate(var(--start-x8, 0px), var(--start-y8, 0px)); }
        10% { opacity: 0.7; }
        90% { opacity: 0.7; }
        100% { opacity: 0; transform: translate(var(--end-x8, 0px), var(--end-y8, -150px)); }
    }

    @keyframes floatingParticleBezier9 {
        0% { opacity: 0; transform: translate(var(--start-x9, 0px), var(--start-y9, 0px)); }
        10% { opacity: 0.7; }
        90% { opacity: 0.7; }
        100% { opacity: 0; transform: translate(var(--end-x9, 0px), var(--end-y9, -150px)); }
    }

    @keyframes floatingParticleBezier10 {
        0% { opacity: 0; transform: translate(var(--start-x10, 0px), var(--start-y10, 0px)); }
        10% { opacity: 0.7; }
        90% { opacity: 0.7; }
        100% { opacity: 0; transform: translate(var(--end-x10, 0px), var(--end-y10, -150px)); }
    }

    /* Viền nội bộ */
    .card.lightning-effect > .inner-border {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border: none;
        border-radius: inherit;
        z-index: 3;
        pointer-events: none;
    }
</style> 

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Xóa tất cả các đường mạng nhện hiện tại nếu có
        document.querySelectorAll('.web-container, .web-line, .static-web-line').forEach(el => {
            if (el) el.remove();
        });

        // Thêm đốm đom đóm vào các thẻ card
        const cards = document.querySelectorAll('.lightning-effect');
        
        cards.forEach(card => {
            // Xóa các đốm đom đóm cũ nếu có
            card.querySelectorAll('.floating-particle, .side-border-top, .side-border-bottom, .border-light-1, .border-light-2, .inner-border').forEach(el => el.remove());
            
            // Thêm viền nội bộ
            const innerBorder = document.createElement('div');
            innerBorder.className = 'inner-border';
            card.appendChild(innerBorder);
            
            // Thêm các đốm đom đóm mới (chỉ thêm p1-p10)
            for (let i = 1; i <= 10; i++) {
                const particle = document.createElement('div');
                particle.className = `floating-particle p${i}`;
                card.appendChild(particle);
            }
            
            // Tạo đường đi ngẫu nhiên cho các đốm sáng
            setupRandomPaths(card);
        });
        
        /**
         * Tạo đường đi ngẫu nhiên cho các đốm sáng
         */
        function setupRandomPaths(card) {
            // Hàm tạo số ngẫu nhiên trong khoảng
            const randomRange = (min, max) => Math.floor(Math.random() * (max - min + 1)) + min;
            
            // Tạo đường đi ngẫu nhiên cho 10 đốm sáng
            for (let i = 1; i <= 10; i++) {
                const dot = card.querySelector(`.p${i}`);
                if (!dot) continue;
                
                // Điểm xuất hiện ban đầu (phía dưới card)
                const startX = randomRange(-30, 30);
                const startY = randomRange(10, 50);
                dot.style.setProperty(`--start-x${i}`, `${startX}px`);
                dot.style.setProperty(`--start-y${i}`, `${startY}px`);
                
                // Điểm kết thúc (phía trên card)
                const endX = randomRange(-30, 30);
                const endY = randomRange(-180, -140);
                dot.style.setProperty(`--end-x${i}`, `${endX}px`);
                dot.style.setProperty(`--end-y${i}`, `${endY}px`);
                
                // Thời gian animation ngẫu nhiên cho mỗi đốm
                const duration = randomRange(5, 9);
                dot.style.animation = `floatingParticleBezier${i} ${duration}s cubic-bezier(0.45, 0.05, 0.55, 0.95) infinite`;
                
                // Thêm delay ngẫu nhiên để các đốm hoạt động độc lập
                dot.style.animationDelay = `${randomRange(0, 50) / 10}s`;
                
                // Tạo sự kiện để thay đổi ngẫu nhiên đường đi sau mỗi lần animation
                dot.addEventListener('animationiteration', () => {
                    // Tạo vị trí mới cho lần animation tiếp theo
                    const newStartX = randomRange(-30, 30);
                    const newStartY = randomRange(10, 50);
                    dot.style.setProperty(`--start-x${i}`, `${newStartX}px`);
                    dot.style.setProperty(`--start-y${i}`, `${newStartY}px`);
                    
                    const newEndX = randomRange(-30, 30);
                    const newEndY = randomRange(-180, -140);
                    dot.style.setProperty(`--end-x${i}`, `${newEndX}px`);
                    dot.style.setProperty(`--end-y${i}`, `${newEndY}px`);
                });
            }
        }
        
        // Hàm tạo số ngẫu nhiên trong khoảng
        function randomRange(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }
    });
</script> 