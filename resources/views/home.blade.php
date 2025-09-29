@extends('layouts.app')

@section('title', 'Trang chủ')

<!--@section('breadcrumbs')
<div class="flex items-center text-sm">
    <a href="{{ route('home') }}" class="text-indigo-600 font-medium">Trang chủ</a>
</div>
@endsection-->

@section('content')


    <!-- ACC PLAY TOGETHER -->
    <div class="bg-white py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10 text-center">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">DANH SÁCH DỊCH VỤ</h2>
                <div class="w-24 h-1 bg-blue-500 mx-auto rounded-full"></div>
            </div>

            <!-- Display all services in a grid -->
            @if(isset($allServices) && $allServices->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($allServices as $service)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="relative h-48">
                        @if($service->image)
                            <img src="{{ asset($service->image) }}" alt="{{ $service->name }}"
                                class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-600 flex items-center justify-center">
                                <i class="bi bi-controller text-white text-4xl"></i>
                            </div>
                        @endif
                    </div>

                    <div class="p-4">
                        <h3 class="text-lg font-bold text-orange-500 mb-2 text-center uppercase">{{ $service->name }}</h3>

                        <div class="text-center mb-3">
                            <p class="text-gray-600 text-sm">Đã bán: <span class="font-semibold">{{ rand(500, 20000) }}</span></p>
                            <p class="text-gray-600 text-sm">Còn lại: <span class="font-semibold">{{ rand(10, 2000) }}</span></p>
                        </div>

                        <div class="text-center">
                            <a href="{{ route('services.show', $service->slug) }}"
                               class="bg-gradient-to-r from-orange-400 to-red-500 text-white px-6 py-2 rounded-full font-bold text-sm hover:from-orange-500 hover:to-red-600 transition-all duration-300 inline-block">
                                XEM TẤT CẢ
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            @if(!isset($allServices) || $allServices->count() == 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Sample cards to match the image -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="relative h-48">
                        <div class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-600 flex items-center justify-center">
                            <span class="text-white text-xl font-bold text-center px-4">NICK CÓ NHIỀU TIEN SAO<br>THUẬN 1997</span>
                        </div>
                    </div>

                    <div class="p-4">
                        <h3 class="text-lg font-bold text-orange-500 mb-2 text-center uppercase">NICK CÓ NHIỀU TIEN SAO</h3>

                        <div class="text-center mb-3">
                            <p class="text-gray-600 text-sm">Đã bán: <span class="font-semibold">6492</span></p>
                            <p class="text-gray-600 text-sm">Còn lại: <span class="font-semibold">2073</span></p>
                        </div>

                        <div class="text-center">
                            <a href="#" class="bg-gradient-to-r from-orange-400 to-red-500 text-white px-6 py-2 rounded-full font-bold text-sm hover:from-orange-500 hover:to-red-600 transition-all duration-300 inline-block">
                                XEM TẤT CẢ
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Add more sample cards to fill the grid -->
                @for($i = 1; $i <= 6; $i++)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="relative h-48">
                        <div class="w-full h-full bg-gradient-to-br from-purple-400 to-blue-600 flex items-center justify-center">
                            <span class="text-white text-xl font-bold text-center px-4">DỊCH VỤ {{ $i }}</span>
                        </div>
                    </div>

                    <div class="p-4">
                        <h3 class="text-lg font-bold text-orange-500 mb-2 text-center uppercase">DỊCH VỤ {{ $i }}</h3>

                        <div class="text-center mb-3">
                            <p class="text-gray-600 text-sm">Đã bán: <span class="font-semibold">{{ rand(500, 10000) }}</span></p>
                            <p class="text-gray-600 text-sm">Còn lại: <span class="font-semibold">{{ rand(10, 1000) }}</span></p>
                        </div>

                        <div class="text-center">
                            <a href="#" class="bg-gradient-to-r from-orange-400 to-red-500 text-white px-6 py-2 rounded-full font-bold text-sm hover:from-orange-500 hover:to-red-600 transition-all duration-300 inline-block">
                                XEM TẤT CẢ
                            </a>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
            @endif
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