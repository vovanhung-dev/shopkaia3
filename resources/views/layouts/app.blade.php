<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Shopkaia3- Web mua bán tài khoản game uy tín, chất lượng cao">
    <meta name="keywords" content="mua tài khoản game, bán tài khoản, game online, nạp game, dịch vụ game">

    <title>{{ config('app.name', 'Shopkaia3') }} - @yield('title', 'Trang chủ')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <style>
        /* Custom styles */
        .gradient-bg {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 50%, #6366f1 100%);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .floating-social {
            position: fixed;
            right: 20px;
            bottom: 20px;
            z-index: 999;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .floating-social a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
        }
        .floating-social a:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 15px rgba(0,0,0,0.2);
        }
        .facebook-btn {
            background: #1877F2;
        }
        .zalo-btn {
            background: #0068ff;
        }
        .nav-link {
            position: relative;
            transition: all 0.3s ease;
        }
        .dropdown-menu {
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
            transform-origin: top;
            transform: scale(0.95);
            opacity: 0;
            visibility: hidden;
            transition: transform 0.2s ease, opacity 0.2s ease, visibility 0.2s ease;
        }
        .dropdown-menu.show {
            transform: scale(1);
            opacity: 1;
            visibility: visible;
        }
        .toast-container {
            position: fixed;
            top: 80px;
            right: 20px;
            z-index: 1000;
            max-width: 350px;
        }
        .mobile-menu {
            transform: translateY(-10px);
            opacity: 0;
            transition: all 0.3s ease;
        }
        .mobile-menu.show {
            transform: translateY(0);
            opacity: 1;
        }
        .nav-item {
            position: relative;
        }
        .badge-notification {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #ef4444;
            color: white;
            border-radius: 9999px;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        /* Logo Style */
        .logo-text {
            font-size: 2rem;
            font-weight: 900;
            letter-spacing: -0.5px;
            color: white;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            transition: all 0.3s ease;
        }

        .logo-text:hover {
            transform: scale(1.05);
            text-shadow: 0 4px 8px rgba(0,0,0,0.4);
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(45deg, #fbbf24, #f59e0b);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            box-shadow: 0 4px 12px rgba(251, 191, 36, 0.3);
            transition: all 0.3s ease;
        }

        .logo-icon:hover {
            transform: rotate(10deg) scale(1.1);
            box-shadow: 0 6px 16px rgba(251, 191, 36, 0.4);
        }
        
        /* Hiệu ứng sao băng */
        .card {
            overflow: hidden;
        }
        
        /* Cập nhật CSS cho các hạt đom đóm */
        .lightning-effect .floating-particle {
            position: absolute;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.9) 20%, rgba(0, 198, 255, 0.7) 70%);
            box-shadow: 
                0 0 6px 2px rgba(0, 198, 255, 0.5),
                0 0 10px 4px rgba(0, 114, 255, 0.3);
            opacity: 0;
            z-index: 6;
            pointer-events: none;
        }

        .lightning-effect .p1 {
            top: 5px;
            left: calc(var(--random-position1, 10%) + var(--random-offset1, 20px));
            animation: floatingParticle1 3.8s ease-in-out infinite;
            animation-delay: calc(var(--random-delay1, 0.2s));
        }

        .lightning-effect .p2 {
            top: 5px;
            right: calc(var(--random-position2, 30%) + var(--random-offset2, 20px));
            animation: floatingParticle2 4.1s ease-in-out infinite;
            animation-delay: calc(var(--random-delay2, 1.5s));
        }

        .lightning-effect .p3 {
            top: calc(var(--random-position3, 20%) + var(--random-offset3, 15px));
            right: 5px;
            animation: floatingParticle3 3.9s ease-in-out infinite;
            animation-delay: calc(var(--random-delay3, 0.7s));
        }

        .lightning-effect .p4 {
            bottom: calc(var(--random-position4, 40%) + var(--random-offset4, 15px));
            right: 5px;
            animation: floatingParticle4 3.4s ease-in-out infinite;
            animation-delay: calc(var(--random-delay4, 1.1s));
        }

        .lightning-effect .p5 {
            bottom: 5px;
            right: calc(var(--random-position5, 20%) + var(--random-offset5, 20px));
            animation: floatingParticle5 3.7s ease-in-out infinite;
            animation-delay: calc(var(--random-delay5, 0.5s));
        }

        .lightning-effect .p6 {
            bottom: 5px;
            left: calc(var(--random-position6, 30%) + var(--random-offset6, 20px));
            animation: floatingParticle6 4.2s ease-in-out infinite;
            animation-delay: calc(var(--random-delay6, 0.3s));
        }

        .lightning-effect .p7 {
            bottom: calc(var(--random-position7, 35%) + var(--random-offset7, 15px));
            left: 5px;
            animation: floatingParticle7 4.0s ease-in-out infinite;
            animation-delay: calc(var(--random-delay7, 1.8s));
        }

        .lightning-effect .p8 {
            top: calc(var(--random-position8, 30%) + var(--random-offset8, 15px));
            left: 5px;
            animation: floatingParticle8 3.6s ease-in-out infinite;
            animation-delay: calc(var(--random-delay8, 0.9s));
        }

        @keyframes floatingParticle1 {
            0% { opacity: 0; transform: translate(0, 0); }
            3% { opacity: 0.3; }
            8% { opacity: 0.9; }
            15% { transform: translate(calc(35% + var(--random-x1, 5px)), calc(var(--random-y1, 3px))); }
            30% { transform: translate(calc(70% + var(--random-x1, 5px)), calc(var(--random-y1, 5px))); }
            50% { opacity: 0.9; transform: translate(calc(100% + var(--random-x1, 0px)), calc(var(--random-y1, 0px))); }
            70% { opacity: 0.7; transform: translate(calc(70% + var(--random-x1, 8px)), calc(-1 * var(--random-y1, 5px))); }
            90% { transform: translate(calc(30% + var(--random-x1, 0px)), calc(-1 * var(--random-y1, 8px))); opacity: 0.3; }
            100% { opacity: 0; transform: translate(0, 0); }
        }

        @keyframes floatingParticle2 {
            0% { opacity: 0; transform: translate(0, 0); }
            3% { opacity: 0.3; }
            8% { opacity: 0.9; }
            25% { transform: translate(calc(var(--random-x2, -5px)), calc(30% + var(--random-y2, 5px))); }
            45% { transform: translate(calc(var(--random-x2, -8px)), calc(60% + var(--random-y2, 8px))); }
            65% { opacity: 0.9; transform: translate(calc(var(--random-x2, -5px)), calc(85% + var(--random-y2, 10px))); }
            85% { opacity: 0.6; transform: translate(calc(var(--random-x2, -10px)), calc(110% + var(--random-y2, 5px))); }
            95% { transform: translate(calc(var(--random-x2, -5px)), calc(130% + var(--random-y2, 10px))); opacity: 0.3; }
            100% { opacity: 0; transform: translate(0, 0); }
        }

        @keyframes floatingParticle3 {
            0% { opacity: 0; transform: translate(0, 0); }
            3% { opacity: 0.3; }
            6% { opacity: 0.9; }
            20% { transform: translate(calc(var(--random-x3, -5px)), calc(25% + var(--random-y3, 5px))); }
            40% { opacity: 0.9; transform: translate(calc(var(--random-x3, -8px)), calc(55% + var(--random-y3, 10px))); }
            65% { opacity: 0.7; transform: translate(calc(var(--random-x3, -12px)), calc(75% + var(--random-y3, 15px))); }
            90% { transform: translate(calc(var(--random-x3, -15px)), calc(105% + var(--random-y3, 5px))); opacity: 0.3; }
            100% { opacity: 0; transform: translate(0, 0); }
        }

        @keyframes floatingParticle4 {
            0% { opacity: 0; transform: translate(0, 0); }
            4% { opacity: 0.3; }
            8% { opacity: 0.9; }
            25% { transform: translate(calc(-35% - var(--random-x4, 5px)), calc(25% + var(--random-y4, 5px))); }
            50% { opacity: 0.9; transform: translate(calc(-65% - var(--random-x4, 10px)), calc(40% + var(--random-y4, 10px))); }
            75% { opacity: 0.7; transform: translate(calc(-95% - var(--random-x4, 5px)), calc(60% + var(--random-y4, 5px))); }
            92% { transform: translate(calc(-125% - var(--random-x4, 10px)), calc(45% + var(--random-y4, 0px))); opacity: 0.3; }
            100% { opacity: 0; transform: translate(0, 0); }
        }

        @keyframes floatingParticle5 {
            0% { opacity: 0; transform: translate(0, 0); }
            3% { opacity: 0.3; }
            7% { opacity: 0.9; }
            25% { transform: translate(calc(-35% - var(--random-x5, 5px)), calc(var(--random-y5, 0px))); }
            45% { transform: translate(calc(-65% - var(--random-x5, 10px)), calc(var(--random-y5, 0px))); }
            65% { opacity: 0.9; transform: translate(calc(-95% - var(--random-x5, 15px)), calc(var(--random-y5, 0px))); }
            85% { opacity: 0.6; transform: translate(calc(-125% - var(--random-x5, 5px)), calc(var(--random-y5, 0px))); }
            95% { transform: translate(calc(-150% - var(--random-x5, 10px)), calc(var(--random-y5, 0px))); opacity: 0.3; }
            100% { opacity: 0; transform: translate(0, 0); }
        }

        @keyframes floatingParticle6 {
            0% { opacity: 0; transform: translate(0, 0); }
            3% { opacity: 0.3; }
            6% { opacity: 0.9; }
            25% { transform: translate(calc(-25% - var(--random-x6, 8px)), calc(-25% - var(--random-y6, 5px))); }
            45% { transform: translate(calc(-45% - var(--random-x6, 12px)), calc(-55% - var(--random-y6, 10px))); }
            65% { opacity: 0.9; transform: translate(calc(-75% - var(--random-x6, 15px)), calc(-85% - var(--random-y6, 15px))); }
            85% { opacity: 0.6; transform: translate(calc(-105% - var(--random-x6, 5px)), calc(-115% - var(--random-y6, 5px))); }
            95% { transform: translate(calc(-135% - var(--random-x6, 10px)), calc(-130% - var(--random-y6, 10px))); opacity: 0.3; }
            100% { opacity: 0; transform: translate(0, 0); }
        }

        @keyframes floatingParticle7 {
            0% { opacity: 0; transform: translate(0, 0); }
            3% { opacity: 0.3; }
            5% { opacity: 0.9; }
            20% { transform: translate(calc(var(--random-x7, 0px)), calc(-30% - var(--random-y7, 5px))); }
            40% { opacity: 0.9; transform: translate(calc(var(--random-x7, 0px)), calc(-60% - var(--random-y7, 10px))); }
            65% { opacity: 0.7; transform: translate(calc(var(--random-x7, 0px)), calc(-85% - var(--random-y7, 15px))); }
            90% { transform: translate(calc(var(--random-x7, 0px)), calc(-115% - var(--random-y7, 5px))); opacity: 0.3; }
            100% { opacity: 0; transform: translate(0, 0); }
        }

        @keyframes floatingParticle8 {
            0% { opacity: 0; transform: translate(0, 0); }
            3% { opacity: 0.3; }
            7% { opacity: 0.9; }
            25% { transform: translate(calc(35% + var(--random-x8, 5px)), calc(-20% - var(--random-y8, 5px))); }
            45% { opacity: 0.9; transform: translate(calc(75% + var(--random-x8, 10px)), calc(-10% - var(--random-y8, 2px))); }
            70% { opacity: 0.7; transform: translate(calc(105% + var(--random-x8, 5px)), calc(var(--random-y8, 0px))); }
            90% { transform: translate(calc(135% + var(--random-x8, 10px)), calc(15% + var(--random-y8, 5px))); opacity: 0.3; }
            100% { opacity: 0; transform: translate(0, 0); }
        }
        
        .shooting-star {
            position: absolute;
            width: 2px;
            height: 100px;
            background: linear-gradient(180deg, 
                rgba(255, 255, 255, 0), 
                rgba(255, 255, 255, 0.5) 20%, 
                rgba(70, 200, 255, 0.6) 40%, 
                rgba(30, 100, 255, 0.3));
            transform: rotate(15deg);
            filter: drop-shadow(0 0 4px rgba(255, 255, 255, 0.5));
            opacity: 0;
            z-index: 20;
            pointer-events: none;
            will-change: transform, opacity;
        }
        
        .shooting-star::after {
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
        
        .card .shooting-star-1 {
            top: -60px;
            left: 30%;
            animation: shootingStar1 6s ease-in-out infinite;
            animation-delay: 2s;
        }
        
        .card .shooting-star-2 {
            top: -80px;
            left: 60%;
            animation: shootingStar2 8s ease-in-out infinite;
            animation-delay: 5s;
        }
        
        .card .shooting-star-3 {
            top: -70px;
            left: 20%;
            animation: shootingStar3 7s ease-in-out infinite;
            animation-delay: 1s;
        }
        
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
        
        /* Fix cho hiệu ứng sao băng và các hiệu ứng khác */
        .lightning-border, .lightning-effect, .lightning-item {
            position: relative;
        }
        
        .lightning-effect .floating-particle,
        .lightning-item .inner-glow,
        .lightning-item .flash,
        .lightning-item .corner,
        .shooting-star {
            pointer-events: none;
            z-index: 5;
            position: absolute;
        }
        
        /* Hiệu ứng mạng nhện kết nối */
        .lightning-effect {
            overflow: visible;
            position: relative;
        }
        
        .lightning-effect .web-container {
            position: absolute;
            inset: 0;
            overflow: hidden;
            pointer-events: none;
            z-index: 4;
        }
        
        .lightning-effect .web-line {
            position: absolute;
            background: linear-gradient(90deg, transparent, rgba(70, 200, 255, 0.3), transparent);
            height: 1px;
            transform-origin: left center;
            opacity: 0;
            animation: webLineOpacity 5s ease-in-out infinite;
            border-radius: 50%;
            pointer-events: none;
        }
        
        @keyframes webLineOpacity {
            0%, 100% { opacity: 0; }
            30%, 70% { opacity: 0.3; }
        }
        
        .card.lightning-border.lightning-effect.lightning-item a {
            position: relative;
            z-index: 10;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-800">
    <div class="min-h-screen flex flex-col">
        <!-- Header/Navbar -->
        <header class="sticky top-0 z-50">
            <nav class="gradient-bg text-white shadow-lg backdrop-blur-sm">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between items-center h-16 md:h-18">
                        <!-- Logo -->
                        <div class="flex items-center">
                            <a href="{{ route('home') }}" class="flex items-center hover:opacity-90 transition-opacity">
                                <div class="logo-icon">
                                    <i class="bi bi-controller text-white text-xl"></i>
                                </div>
                                <span class="logo-text">Shopkaia3</span>
                            </a>
                        </div>
                        
                        <!-- Desktop Navigation -->
                        <div class="hidden md:flex md:items-center md:space-x-1">
                            <a href="{{ route('home') }}" class="nav-link px-4 py-2 text-white hover:bg-white/10 rounded-lg font-medium transition-all {{ request()->routeIs('home') ? 'bg-white/20' : '' }}">Trang chủ</a>
                            <a href="{{ route('accounts.index') }}" class="nav-link px-4 py-2 text-white hover:bg-white/10 rounded-lg font-medium transition-all {{ request()->routeIs('accounts.*') ? 'bg-white/20' : '' }}">Tài khoản</a>
                            <a href="{{ route('services.index') }}" class="nav-link px-4 py-2 text-white hover:bg-white/10 rounded-lg font-medium transition-all {{ request()->routeIs('services.*') ? 'bg-white/20' : '' }}">Dịch vụ</a>
                            @if(Auth::check() && Auth::user()->isAdmin())
                            <a href="{{ route('topup.index') }}" class="nav-link px-4 py-2 text-white hover:bg-white/10 rounded-lg font-medium transition-all {{ request()->routeIs('topup.*') ? 'bg-white/20' : '' }}">Nạp hộ</a>
                            @endif
                        </div>
                        
                        <!-- User Menu (Desktop) -->
                        <div class="hidden md:flex items-center space-x-3">
                            <!-- Nạp tiền button -->
                            <a href="{{ route('wallet.deposit') }}" class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-4 py-2 rounded-lg font-medium transition-all duration-300 flex items-center space-x-2 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <i class="bi bi-plus-circle"></i>
                                <span>Nạp tiền</span>
                            </a>

                            @guest
                                <a href="{{ route('login') }}" class="text-white/90 hover:text-white font-medium px-3 py-2 rounded-lg hover:bg-white/10 transition-all">Đăng nhập</a>
                                <a href="{{ route('register') }}" class="bg-white text-blue-600 hover:bg-gray-50 px-4 py-2 rounded-lg font-medium transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">Đăng ký</a>
                            @else
                                <div class="relative" id="userDropdown">
                                    <div class="flex items-center space-x-3 cursor-pointer">
                                        <!-- Wallet balance -->
                                        <a href="{{ route('wallet.index') }}" class="flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-lg hover:bg-white/20 transition-all duration-300 border border-white/20">
                                            <i class="bi bi-wallet2 mr-2 text-yellow-300"></i>
                                            <span class="font-semibold">{{ Auth::user()->wallet ? number_format(Auth::user()->wallet->balance, 0, ',', '.') : 0 }}đ</span>
                                        </a>

                                        <div class="flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-white/10 transition-all">
                                            <div class="w-8 h-8 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full flex items-center justify-center text-white font-semibold text-sm">
                                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                            </div>
                                            <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                                            <i class="bi bi-chevron-down text-xs"></i>
                                        </div>
                                    </div>
                                    
                                    <!-- User Dropdown Menu -->
                                    <div class="dropdown-menu absolute right-0 mt-2 w-48 py-2 bg-white rounded-lg shadow-lg text-gray-700 z-10">
                                        @if(Auth::user()->isAdmin())
                                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm hover:bg-gray-100 hover:text-indigo-600 transition">
                                                <i class="bi bi-speedometer2 mr-2"></i>Quản trị viên
                                            </a>
                                            <hr class="my-1 border-gray-200">
                                        @endif
                                        
                                        <a href="{{ route('profile.index') }}" class="block px-4 py-2 text-sm hover:bg-gray-100 hover:text-indigo-600 transition">
                                            <i class="bi bi-person mr-2"></i>Thông tin tài khoản
                                        </a>
                                        <a href="{{ route('wallet.deposit') }}" class="block px-4 py-2 text-sm hover:bg-gray-100 hover:text-indigo-600 transition">
                                            <i class="bi bi-plus-circle mr-2"></i>Nạp tiền
                                        </a>
                                        <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm hover:bg-gray-100 hover:text-indigo-600 transition">
                                            <i class="bi bi-bag mr-2"></i>Đơn hàng tài khoản
                                        </a>
                                        <a href="{{ route('services.my_orders') }}" class="block px-4 py-2 text-sm hover:bg-gray-100 hover:text-indigo-600 transition">
                                            <i class="bi bi-clock-history mr-2"></i>Lịch sử dịch vụ
                                        </a>
                                        <hr class="my-1 border-gray-200">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm hover:bg-gray-100 hover:text-red-600 transition">
                                                <i class="bi bi-box-arrow-right mr-2"></i>Đăng xuất
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endguest
                        </div>
                        
                        <!-- Mobile Menu Button -->
                        <div class="flex md:hidden">
                            <button type="button" id="mobileMenuButton" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-200 hover:bg-indigo-700 transition">
                                <i class="bi bi-list text-2xl"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Mobile Menu -->
                <div id="mobileMenu" class="mobile-menu hidden md:hidden">
                    <div class="px-4 py-2 space-y-1 border-t border-indigo-700">
                        <!-- Mobile Search -->
                        <div class="pb-2">
                            <form action="{{ route('accounts.search') }}" method="GET" class="relative">
                                <input type="text" name="keyword" placeholder="Tìm kiếm tài khoản..." 
                                    class="w-full rounded-full py-2 px-4 pr-10 text-gray-800 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-400 border-0">
                                <button type="submit" class="absolute right-0 top-0 h-full px-3 text-gray-600">
                                    <i class="bi bi-search"></i>
                                </button>
                            </form>
                        </div>
                        
                        <!-- Mobile Navigation Links -->
                        <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-white {{ request()->routeIs('home') ? 'bg-indigo-700 font-medium' : 'hover:bg-indigo-700' }} transition">
                            <i class="bi bi-house mr-2"></i>Trang chủ
                        </a>
                        <a href="{{ route('accounts.index') }}" class="block px-3 py-2 rounded-md text-white {{ request()->routeIs('accounts.*') ? 'bg-indigo-700 font-medium' : 'hover:bg-indigo-700' }} transition">
                            <i class="bi bi-person-circle mr-2"></i>Tài khoản
                        </a>
                        <a href="{{ route('services.index') }}" class="block px-3 py-2 rounded-md text-white {{ request()->routeIs('services.*') ? 'bg-indigo-700 font-medium' : 'hover:bg-indigo-700' }} transition">
                            <i class="bi bi-gear mr-2"></i>Dịch vụ
                        </a>
                        @if(Auth::check() && Auth::user()->isAdmin())
                        <a href="{{ route('topup.index') }}" class="block px-3 py-2 rounded-md text-white {{ request()->routeIs('topup.*') ? 'bg-indigo-700 font-medium' : 'hover:bg-indigo-700' }} transition">
                            <i class="bi bi-currency-dollar mr-2"></i>Nạp hộ
                        </a>
                        @endif
                        <!--<a href="{{ route('contact') }}" class="block px-3 py-2 rounded-md text-white {{ request()->routeIs('contact') ? 'bg-indigo-700 font-medium' : 'hover:bg-indigo-700' }} transition">
                            <i class="bi bi-envelope mr-2"></i>Liên hệ
                        </a>-->
                        
                        <div class="pt-2 border-t border-indigo-700 mt-2">
                            @guest
                                <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-white hover:bg-indigo-700 transition">
                                    <i class="bi bi-box-arrow-in-right mr-2"></i>Đăng nhập
                                </a>
                                <a href="{{ route('register') }}" class="block mt-2 px-3 py-2 rounded-md bg-white text-indigo-600 hover:bg-gray-100 font-medium text-center transition">
                                    Đăng ký
                                </a>
                            @else
                                <!-- Mobile Wallet -->
                                <a href="{{ route('wallet.index') }}" class="flex items-center justify-between px-3 py-2 rounded-md bg-indigo-700 text-white mb-2">
                                    <div class="flex items-center">
                                        <i class="bi bi-wallet2 mr-2"></i>
                                        <span>Số dư</span>
                                    </div>
                                    <span class="font-semibold">{{ Auth::user()->wallet ? number_format(Auth::user()->wallet->balance, 0, ',', '.') : 0 }}đ</span>
                                </a>
                                
                                <!-- Mobile User Menu -->
                                <a href="{{ route('profile.index') }}" class="block px-3 py-2 rounded-md text-white hover:bg-indigo-700 transition">
                                    <i class="bi bi-person mr-2"></i>Thông tin tài khoản
                                </a>
                                <a href="{{ route('wallet.deposit') }}" class="block px-3 py-2 rounded-md bg-green-600 text-white font-medium hover:bg-green-700 mt-2 transition text-center">
                                    <i class="bi bi-plus-circle mr-2"></i>Nạp tiền
                                </a>
                                <a href="{{ route('orders.index') }}" class="block px-3 py-2 rounded-md text-white hover:bg-indigo-700 transition">
                                    <i class="bi bi-bag mr-2"></i>Đơn hàng tài khoản
                                </a>
                                <a href="{{ route('services.my_orders') }}" class="block px-3 py-2 rounded-md text-white hover:bg-indigo-700 transition">
                                    <i class="bi bi-clock-history mr-2"></i>Lịch sử dịch vụ
                                </a>
                                
                                @if(Auth::user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-md text-white hover:bg-indigo-700 mt-2 transition">
                                        <i class="bi bi-speedometer2 mr-2"></i>Quản trị viên
                                    </a>
                                @endif
                                
                                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-white hover:bg-red-600 transition">
                                        <i class="bi bi-box-arrow-right mr-2"></i>Đăng xuất
                                    </button>
                                </form>
                            @endguest
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        
        <!-- Breadcrumbs -->
        <!--@hasSection('breadcrumbs')
            <div class="bg-white shadow-sm border-b">
                <div class="container mx-auto px-4 py-2 text-sm">
                    @yield('breadcrumbs')
                </div>
            </div>
        @endif-->
        
        <!-- Flash Messages -->
        <div class="toast-container" id="toastContainer">
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded shadow-md" role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="bi bi-check-circle text-green-500"></i>
                        </div>
                        <div class="ml-3">
                            <p>{{ session('success') }}</p>
                        </div>
                        <button class="ml-auto text-green-500 hover:text-green-700" onclick="this.parentElement.parentElement.remove()">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                </div>
            @endif
            
            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded shadow-md" role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="bi bi-exclamation-circle text-red-500"></i>
                        </div>
                        <div class="ml-3">
                            <p>{{ session('error') }}</p>
                        </div>
                        <button class="ml-auto text-red-500 hover:text-red-700" onclick="this.parentElement.parentElement.remove()">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                </div>
            @endif
            
            @if (session('warning'))
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4 rounded shadow-md" role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="bi bi-exclamation-triangle text-yellow-500"></i>
                        </div>
                        <div class="ml-3">
                            <p>{{ session('warning') }}</p>
                        </div>
                        <button class="ml-auto text-yellow-500 hover:text-yellow-700" onclick="this.parentElement.parentElement.remove()">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                </div>
            @endif
        </div>
        
        <!-- Page Content -->
        <main class="flex-grow">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>
        
        <!-- Footer -->
        <footer class="bg-gray-900 text-white pt-12 pb-6">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h4 class="text-lg font-semibold mb-4 flex items-center">
                            <i class="bi bi-info-circle mr-2"></i>Về chúng tôi
                        </h4>
                        <p class="text-gray-400 mb-4">
                            Shopkaia3 là nơi cung cấp tài khoản game chất lượng, uy tín, với nhiều ưu đãi hấp dẫn.
                        </p>
                        <div class="flex space-x-4">
                            <a href="https://www.facebook.com/people/Shopbuffsao/61574594802771/" target="_blank" class="text-gray-400 hover:text-white transition">
                                <i class="bi bi-facebook text-xl"></i>
                            </a>
                            <a href="https://zalo.me/0876085633" target="_blank" class="text-gray-400 hover:text-white transition">
                                <span class="font-bold">Zalo</span>
                            </a>
                        </div>
                    </div>
                    
                    <div>
                        <h4 class="text-lg font-semibold mb-4 flex items-center">
                            <i class="bi bi-link-45deg mr-2"></i>Liên kết nhanh
                        </h4>
                        <ul class="space-y-2 text-gray-400">
                            <li><a href="{{ route('home') }}" class="hover:text-white transition"><i class="bi bi-chevron-right mr-2 text-xs"></i>Trang chủ</a></li>
                            <li><a href="{{ route('accounts.index') }}" class="hover:text-white transition"><i class="bi bi-chevron-right mr-2 text-xs"></i>Tài khoản</a></li>
                            <li><a href="{{ route('services.index') }}" class="hover:text-white transition"><i class="bi bi-chevron-right mr-2 text-xs"></i>Dịch vụ</a></li>
                            <li><a href="{{ route('topup.index') }}" class="hover:text-white transition"><i class="bi bi-chevron-right mr-2 text-xs"></i>Nạp hộ</a></li>
                            <li><a href="{{ route('contact') }}" class="hover:text-white transition"><i class="bi bi-chevron-right mr-2 text-xs"></i>Liên hệ</a></li>
                        </ul>
                    </div>
                    
                    <div>
                        <h4 class="text-lg font-semibold mb-4 flex items-center">
                            <i class="bi bi-telephone mr-2"></i>Liên hệ
                        </h4>
                        <ul class="space-y-3 text-gray-400">
                            <li class="flex items-start">
                                <i class="bi bi-clock mt-1 mr-3 text-indigo-400"></i>
                                <span>Hoạt động từ 8h - 23h</span>
                            </li>
                            <li class="flex items-center">
                                <i class="bi bi-telephone mr-3 text-indigo-400"></i>
                                <a href="tel:0876085633" class="hover:text-white transition">0876085633</a>
                            </li>
                            <li class="flex items-center">
                                <i class="bi bi-envelope mr-3 text-indigo-400"></i>
                                <a href="mailto:Shopkaia3@gmail.com" class="hover:text-white transition">Shopkaia3@gmail.com</a>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="border-t border-gray-800 mt-10 pt-6 text-center text-gray-500 text-sm">
                    <p>&copy; {{ date('Y') }} ShopBuffsao. Tất cả quyền được bảo lưu.</p>
                </div>
            </div>
        </footer>
    </div>
    
    <!-- Floating Social Buttons -->
    <div class="floating-social">
        <a href="https://www.facebook.com/people/Shopbuffsao/61574594802771/" target="_blank" class="facebook-btn">
            <i class="bi bi-facebook text-xl"></i>
        </a>
        <a href="https://zalo.me/0876085633" target="_blank" class="zalo-btn">
            <span class="font-bold text-sm">Zalo</span>
        </a>
        <button id="scrollToTop" class="bg-gray-800 text-white hover:bg-gray-700 transition">
            <i class="bi bi-arrow-up"></i>
        </button>
    </div>
    
    <script>
        // Initialize AOS
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true
            });
            
            // Mobile menu
            const mobileMenuButton = document.getElementById('mobileMenuButton');
            const mobileMenu = document.getElementById('mobileMenu');
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                    mobileMenu.classList.toggle('show');
                });
            }
            
            // User dropdown
            const userDropdown = document.getElementById('userDropdown');
            if (userDropdown) {
                const dropdownMenu = userDropdown.querySelector('.dropdown-menu');
                
                userDropdown.addEventListener('click', function(e) {
                    dropdownMenu.classList.toggle('show');
                });
                
                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (userDropdown && !userDropdown.contains(e.target)) {
                        dropdownMenu.classList.remove('show');
                    }
                });
            }
            
            // Auto-hide flash messages
            setTimeout(function() {
                const toasts = document.querySelectorAll('.toast-container > div');
                toasts.forEach(toast => {
                    toast.style.opacity = '0';
                    setTimeout(() => {
                        toast.remove();
                    }, 500);
                });
            }, 5000);
            
            // Scroll to top
            const scrollToTopButton = document.getElementById('scrollToTop');
            if (scrollToTopButton) {
                scrollToTopButton.addEventListener('click', function() {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
                
                // Show/hide scroll to top button
                window.addEventListener('scroll', function() {
                    if (window.pageYOffset > 300) {
                        scrollToTopButton.style.opacity = '1';
                    } else {
                        scrollToTopButton.style.opacity = '0';
                    }
                });
            }
            
            // Hiệu ứng tia sét ngẫu nhiên - mỗi hạt hoạt động độc lập
            function initLightningEffects() {
                // Lấy tất cả các thẻ có class lightning-effect
                const items = document.querySelectorAll('.lightning-effect');
                
                // Với mỗi thẻ, chỉ cập nhật một hạt duy nhất
                items.forEach(item => {
                    // Kiểm tra và thêm các hạt đom đóm nếu chưa có
                    let particles = item.querySelectorAll('.floating-particle');
                    if (particles.length === 0) {
                        // Tự động tạo các hạt nếu chưa có
                        for (let i = 1; i <= 8; i++) {
                            const particle = document.createElement('div');
                            particle.className = 'floating-particle p' + i;
                            item.prepend(particle);
                        }
                        // Cập nhật lại danh sách hạt
                        particles = item.querySelectorAll('.floating-particle');
                    }
                    
                    // Kiểm tra và thêm sao băng nếu chưa có
                    if (!item.querySelector('.shooting-star')) {
                        for (let i = 1; i <= 3; i++) {
                            const star = document.createElement('div');
                            star.className = 'shooting-star shooting-star-' + i;
                            item.prepend(star);
                        }
                    }
                    
                    // Chọn chính xác 1 hạt ngẫu nhiên để cập nhật
                    const randomIndex = Math.floor(Math.random() * particles.length);
                    const particle = particles[randomIndex];
                    const particleIndex = randomIndex + 1; // p1, p2, ..., p8
                    
                    // Bỏ qua nếu hạt đang trong giai đoạn animation
                    if (particle.dataset.updating === "true") {
                        return;
                    }
                    
                    // Đánh dấu hạt đang được cập nhật
                    particle.dataset.updating = "true";
                    
                    // Hiệu ứng sáng đặc biệt ngẫu nhiên
                    const isBright = Math.random() > 0.8; // 20% cơ hội tạo hiệu ứng sáng hơn
                    
                    // Áp dụng fade-out từ từ
                    if (parseFloat(window.getComputedStyle(particle).opacity) > 0.1) {
                        particle.style.transition = 'opacity 1.5s ease-out';
                        particle.style.opacity = '0';
                        
                        // Cập nhật lại các thông số sau khi fade-out
                        setTimeout(() => {
                            updateParticle(particle, particleIndex, item, isBright);
                        }, 1600);
                    } else {
                        // Nếu hạt đã ẩn, cập nhật ngay
                        updateParticle(particle, particleIndex, item, isBright);
                    }
                });
            }
            
            // Hàm cập nhật từng hạt riêng biệt
            function updateParticle(particle, particleIndex, item, isBright = false) {
                // Áp dụng hiệu ứng fade-out từ từ
                if (parseFloat(window.getComputedStyle(particle).opacity) > 0.1) {
                    // Áp dụng transition dài hơn
                    particle.style.transition = 'opacity 1.5s ease-out';
                    particle.style.opacity = '0';
                    
                    // Đợi hiệu ứng fade-out hoàn tất trước khi cập nhật
                    setTimeout(() => {
                        // Cập nhật thuộc tính mới khi đã ẩn hoàn toàn
                        prepareNewParticle();
                    }, 1600);
                } else {
                    // Nếu hạt đã ẩn, cập nhật ngay lập tức
                    prepareNewParticle();
                }
                
                // Hàm chuẩn bị hạt mới
                function prepareNewParticle() {
                    // Kích thước ngẫu nhiên cho hạt
                    const randomSize = isBright ? 6 + Math.random() * 2 : 4 + Math.random() * 2;
                    particle.style.width = `${randomSize}px`;
                    particle.style.height = `${randomSize}px`;
                    
                    // Vị trí bắt đầu ngẫu nhiên
                    const randomOffset = Math.floor(Math.random() * 30);
                    item.style.setProperty(`--random-offset${particleIndex}`, `${randomOffset}px`);
                    
                    // Delay ngẫu nhiên cho chuyển động tự nhiên hơn
                    const randomDelay = (Math.random() * (isBright ? 1 : 3)).toFixed(2);
                    item.style.setProperty(`--random-delay${particleIndex}`, `${randomDelay}s`);
                    
                    // Vị trí ngẫu nhiên dọc theo các cạnh
                    const randomPosition = Math.floor(Math.random() * 45);
                    item.style.setProperty(`--random-position${particleIndex}`, `${randomPosition}%`);
                    
                    // Biến X, Y ngẫu nhiên cho đường đi uốn lượn
                    const randomX = Math.floor(Math.random() * 30);
                    const randomY = Math.floor(Math.random() * 30);
                    item.style.setProperty(`--random-x${particleIndex}`, `${randomX}px`);
                    item.style.setProperty(`--random-y${particleIndex}`, `${randomY}px`);
                    
                    // Reset animation bằng cách xóa tạm và thêm lại class
                    const currentClasses = particle.className;
                    particle.className = currentClasses.replace(/p[1-8]/, '');
                    
                    // Đặt opacity về 0 và tạo transition cho fade-in từ từ
                    particle.style.opacity = '0';
                    
                    // Thêm lớp lại để hạt bắt đầu animation mới
                    setTimeout(() => {
                        particle.className = currentClasses;
                        
                        // Áp dụng transition cho fade-in từ từ
                        setTimeout(() => {
                            // Đặt transition dài hơn cho xuất hiện từ từ
                            particle.style.transition = 'opacity 1.8s ease-in';
                            
                            // Độ sáng ngẫu nhiên
                            const randomBrightness = isBright ? 0.9 + Math.random() * 0.1 : 0.7 + Math.random() * 0.3;
                            
                            // Fade-in từ từ
                            particle.style.opacity = randomBrightness.toString();
                            
                            // Thêm hiệu ứng shadow mạnh hơn cho hiệu ứng sáng
                            if (isBright) {
                                particle.style.boxShadow = '0 0 8px 3px rgba(76, 201, 240, 0.8), 0 0 12px 6px rgba(0, 180, 216, 0.5)';
                                
                                // Đặt lại shadow bình thường sau một khoảng thời gian
                                setTimeout(() => {
                                    // Áp dụng transition cho shadow
                                    particle.style.transition = 'box-shadow 2s ease-out, opacity 1.8s ease-in';
                                    particle.style.boxShadow = '';
                                }, 2000);
                            }
                            
                            // Xóa trạng thái đang cập nhật khi animation đã bắt đầu
                            setTimeout(() => {
                                particle.dataset.updating = "false";
                            }, 500);
                        }, 100);
                    }, 50);
                }
            }
            
            // Khởi tạo hiệu ứng cho các hạt sáng
            initLightningEffects();
            
            // Tạo mạng nhện kết nối các hạt
            function createWebLines() {
                const items = document.querySelectorAll('.lightning-effect');
                
                items.forEach(item => {
                    // Tạo container cho các đường mạng nhện
                    let webContainer = item.querySelector('.web-container');
                    if (!webContainer) {
                        webContainer = document.createElement('div');
                        webContainer.className = 'web-container';
                        item.appendChild(webContainer);
                    }
                    
                    // Xóa các đường cũ
                    webContainer.innerHTML = '';
                    
                    // Lấy các hạt
                    const particles = item.querySelectorAll('.floating-particle');
                    if (particles.length < 2) return;
                    
                    // Tạo mảng lưu vị trí các hạt có opacity > 0
                    const activeParticles = [];
                    particles.forEach(particle => {
                        if (parseFloat(window.getComputedStyle(particle).opacity) > 0.1) {
                            const rect = particle.getBoundingClientRect();
                            const itemRect = item.getBoundingClientRect();
                            
                            activeParticles.push({
                                x: rect.left - itemRect.left + rect.width/2,
                                y: rect.top - itemRect.top + rect.height/2,
                                element: particle
                            });
                        }
                    });
                    
                    // Nếu có ít nhất 2 hạt đang hiển thị, tạo các đường kết nối
                    if (activeParticles.length >= 2) {
                        // Tạo các đường ngẫu nhiên giữa các hạt
                        for (let i = 0; i < activeParticles.length; i++) {
                            for (let j = i + 1; j < activeParticles.length; j++) {
                                // Chỉ kết nối một số cặp ngẫu nhiên, không phải tất cả
                                if (Math.random() > 0.7) continue;
                                
                                const start = activeParticles[i];
                                const end = activeParticles[j];
                                
                                // Tính toán độ dài và góc của đường
                                const length = Math.sqrt(Math.pow(end.x - start.x, 2) + Math.pow(end.y - start.y, 2));
                                const angle = Math.atan2(end.y - start.y, end.x - start.x) * 180 / Math.PI;
                                
                                // Tính độ mờ dựa trên độ mờ của các hạt
                                const opacity1 = parseFloat(window.getComputedStyle(start.element).opacity);
                                const opacity2 = parseFloat(window.getComputedStyle(end.element).opacity);
                                const lineOpacity = Math.min(opacity1, opacity2) * 0.3;
                                
                                // Tạo đường
                                const line = document.createElement('div');
                                line.className = 'web-line';
                                line.style.width = `${length}px`;
                                line.style.left = `${start.x}px`;
                                line.style.top = `${start.y}px`;
                                line.style.transform = `rotate(${angle}deg)`;
                                line.style.opacity = lineOpacity;
                                
                                // Thay đổi độ dày ngẫu nhiên
                                line.style.height = `${0.5 + Math.random() * 0.5}px`;
                                
                                // Điều chỉnh màu ngẫu nhiên
                                const hue = 190 + Math.floor(Math.random() * 30);
                                const sat = 80 + Math.floor(Math.random() * 20);
                                const light = 60 + Math.floor(Math.random() * 20);
                                line.style.background = `linear-gradient(90deg, transparent, hsla(${hue}, ${sat}%, ${light}%, 0.3), transparent)`;
                                
                                // Áp dụng animation delay ngẫu nhiên
                                line.style.animationDelay = `${Math.random() * 5}s`;
                                
                                // Thêm vào container
                                webContainer.appendChild(line);
                            }
                        }
                    }
                });
            }
            
            // Tạo lịch trình cập nhật mạng nhện
            setInterval(createWebLines, 1000);
            
            // Tạo lịch trình ngẫu nhiên để cập nhật từng hạt riêng biệt
            function scheduleRandomUpdates() {
                // Lên lịch cập nhật hạt theo thời gian ngẫu nhiên
                function scheduleNext() {
                    const randomTime = 1500 + Math.random() * 2000; // 1.5-3.5s
                    setTimeout(() => {
                        initLightningEffects();
                        scheduleNext(); // Lên lịch cho lần tiếp theo
                    }, randomTime);
                }
                
                // Bắt đầu chu kỳ cập nhật 
                scheduleNext();
                
                // Thỉnh thoảng tạo hiệu ứng chớp mạnh - cập nhật một hạt sáng
                setInterval(() => {
                    if (Math.random() > 0.8) { // 20% cơ hội xảy ra
                        // Gọi hàm đặc biệt cập nhật một hạt với hiệu ứng sáng hơn
                        const items = document.querySelectorAll('.lightning-effect');
                        items.forEach(item => {
                            const particles = item.querySelectorAll('.floating-particle');
                            
                            if (particles.length === 0) return;
                            
                            // Tìm hạt đầu tiên không đang được cập nhật
                            let brightParticle = null;
                            let brightParticleIndex = -1;
                            
                            // Xáo trộn các hạt để chọn ngẫu nhiên
                            const indices = Array.from({length: particles.length}, (_, i) => i);
                            indices.sort(() => Math.random() - 0.5);
                            
                            // Tìm hạt đầu tiên không đang cập nhật
                            for (const index of indices) {
                                const particle = particles[index];
                                if (particle.dataset.updating !== "true") {
                                    brightParticle = particle;
                                    brightParticleIndex = index + 1;
                                    break;
                                }
                            }
                            
                            // Nếu tìm thấy hạt phù hợp, cập nhật nó
                            if (brightParticle) {
                                brightParticle.dataset.updating = "true";
                                updateParticle(brightParticle, brightParticleIndex, item, true);
                            }
                        });
                    }
                }, 6000 + Math.random() * 3000); // 6-9s
                
                // Lên lịch cập nhật mạng nhện
                setInterval(createWebLines, 3000);
            }
            
            // Bắt đầu tất cả các hiệu ứng
            initLightningEffects();
            createWebLines();
            scheduleRandomUpdates();
        });
    </script>
    
    @stack('scripts')
</body>
</html> 