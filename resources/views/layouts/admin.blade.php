<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Dashboard Admin</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Clean Admin Sidebar */
        .admin-sidebar {
            background: #ffffff;
            border-right: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .sidebar-menu-item {
            transition: all 0.15s ease;
            border-radius: 8px;
            margin: 2px 12px;
        }

        .sidebar-menu-item:hover {
            background-color: #f3f4f6;
        }

        .sidebar-menu-item.active {
            background-color: #3b82f6;
            color: white;
        }

        .sidebar-submenu {
            background-color: #f9fafb;
            border-radius: 6px;
            margin: 4px 12px;
            border-left: 3px solid #e5e7eb;
        }

        .sidebar-submenu-item:hover {
            background-color: #f3f4f6;
        }

        .sidebar-submenu-item.active {
            background-color: #dbeafe;
            color: #1d4ed8;
            font-weight: 500;
        }

        .user-profile {
            background-color: #f8fafc;
            border-top: 1px solid #e5e7eb;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="flex h-screen bg-gray-50">
        <!-- Sidebar -->
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64">
                <div class="admin-sidebar flex flex-col h-0 flex-1">
                    <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                        <!-- Logo -->
                        <div class="flex items-center flex-shrink-0 px-6 py-6 border-b border-gray-200">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center mr-3">
                                    <i class="bi bi-speedometer2 text-white text-lg"></i>
                                </div>
                                <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-gray-800">Admin Panel</a>
                            </div>
                        </div>
                        
                        <!-- Menu -->
                        <nav class="mt-4 flex-1 px-3 space-y-1">
                            <a href="{{ route('admin.dashboard') }}" class="sidebar-menu-item {{ request()->routeIs('admin.dashboard') ? 'active text-white' : 'text-gray-700' }} flex items-center px-3 py-2.5 text-sm font-medium">
                                <i class="bi bi-house mr-3 text-lg {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-gray-500' }}"></i>
                                Dashboard
                            </a>
                            
                            <a href="{{ route('admin.games.index') }}" class="sidebar-menu-item {{ request()->routeIs('admin.games.*') ? 'active text-white' : 'text-gray-700' }} flex items-center px-3 py-2.5 text-sm font-medium">
                                <i class="bi bi-controller mr-3 text-lg {{ request()->routeIs('admin.games.*') ? 'text-white' : 'text-gray-500' }}"></i>
                                Quản lý game
                            </a>
                            
                            <!-- Dropdown: Quản lý tài khoản -->
                            <div x-data="{ open: {{ request()->routeIs('admin.accounts.*') || request()->routeIs('admin.account_categories.*') ? 'true' : 'false' }} }">
                                <button @click="open = !open" class="sidebar-menu-item w-full text-left text-gray-700 flex items-center px-3 py-2.5 text-sm font-medium">
                                    <i class="bi bi-person-circle mr-3 text-lg text-gray-500"></i>
                                    <span class="flex-1">Quản lý tài khoản</span>
                                    <i :class="{'rotate-90': open}" class="bi bi-chevron-right text-sm transform transition-transform"></i>
                                </button>
                                <div x-show="open" class="sidebar-submenu mt-2 py-2">
                                    <a href="{{ route('admin.account_categories.index') }}" class="sidebar-submenu-item {{ request()->routeIs('admin.account_categories.*') ? 'active' : 'text-gray-600' }} block px-6 py-2 text-sm">
                                        Danh mục tài khoản
                                    </a>
                                    <a href="{{ route('admin.accounts.index') }}" class="sidebar-submenu-item {{ request()->routeIs('admin.accounts.*') ? 'active' : 'text-gray-600' }} block px-6 py-2 text-sm">
                                        Tài khoản
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Dropdown: Quản lý đơn hàng -->
                            <div x-data="{ open: {{ request()->routeIs('admin.orders.*') ? 'true' : 'false' }} }">
                                <button @click="open = !open" class="sidebar-menu-item w-full text-left text-gray-700 flex items-center px-3 py-2.5 text-sm font-medium">
                                    <i class="bi bi-bag mr-3 text-lg text-gray-500"></i>
                                    <span class="flex-1">Quản lý đơn hàng</span>
                                    <i :class="{'rotate-90': open}" class="bi bi-chevron-right text-sm transform transition-transform"></i>
                                </button>
                                <div x-show="open" class="sidebar-submenu mt-2 py-2">
                                    <a href="{{ route('admin.orders.index') }}" class="sidebar-submenu-item {{ request()->routeIs('admin.orders.*') ? 'active' : 'text-gray-600' }} block px-6 py-2 text-sm">
                                        Đơn hàng tài khoản
                                    </a>
                                </div>
                            </div>
                            
                            <!-- Dropdown: Quản lý dịch vụ -->
                            <div x-data="{ open: {{ request()->routeIs('admin.services.*') || request()->routeIs('admin.topup.*') || request()->routeIs('admin.boosting.*') ? 'true' : 'false' }} }">
                                <button @click="open = !open" class="sidebar-menu-item w-full text-left text-gray-700 flex items-center px-3 py-2.5 text-sm font-medium">
                                    <i class="bi bi-gear mr-3 text-lg text-gray-500"></i>
                                    <span class="flex-1">Quản lý dịch vụ</span>
                                    <i :class="{'rotate-90': open}" class="bi bi-chevron-right text-sm transform transition-transform"></i>
                                </button>
                                <div x-show="open" class="sidebar-submenu mt-2 py-2">
                                    <a href="{{ route('admin.services.index') }}" class="sidebar-submenu-item {{ request()->routeIs('admin.services.*') ? 'active' : 'text-gray-600' }} block px-6 py-2 text-sm">
                                        Dịch vụ
                                    </a>
                                    <a href="{{ route('admin.services.orders.index') }}" class="sidebar-submenu-item {{ request()->routeIs('admin.services.orders.*') ? 'active' : 'text-gray-600' }} block px-6 py-2 text-sm">
                                        Đơn hàng dịch vụ
                                    </a>
                                </div>
                            </div>

                              <!-- Dropdown: Quản lý nạp hộ -->
                              <div x-data="{ open: {{ request()->routeIs('admin.topup.*') || request()->routeIs('admin.topup_categories.*') ? 'true' : 'false' }} }">
                                <button @click="open = !open" class="sidebar-menu-item w-full text-left text-gray-700 flex items-center px-3 py-2.5 text-sm font-medium">
                                    <i class="bi bi-credit-card mr-3 text-lg text-gray-500"></i>
                                    <span class="flex-1">Quản lý nạp hộ</span>
                                    <i :class="{'rotate-90': open}" class="bi bi-chevron-right text-sm transform transition-transform"></i>
                                </button>
                                <div x-show="open" class="sidebar-submenu mt-2 py-2">
                                    <a href="{{ route('admin.topup.index') }}" class="sidebar-submenu-item {{ request()->routeIs('admin.topup.*') ? 'active' : 'text-gray-600' }} block px-6 py-2 text-sm">
                                        Dịch vụ nạp hộ
                                    </a>
                                    <a href="{{ route('admin.topup_categories.index') }}" class="sidebar-submenu-item {{ request()->routeIs('admin.topup_categories.*') ? 'active' : 'text-gray-600' }} block px-6 py-2 text-sm">
                                        Danh mục nạp hộ
                                    </a>
                                    <a href="{{ route('admin.topup_orders.index') }}" class="sidebar-submenu-item {{ request()->routeIs('admin.topup_orders.*') ? 'active' : 'text-gray-600' }} block px-6 py-2 text-sm">
                                        Đơn hàng nạp hộ
                                    </a>
                                </div>
                            </div>
                            
                            <a href="{{ route('admin.users.index') }}" class="sidebar-menu-item {{ request()->routeIs('admin.users.*') ? 'active text-white' : 'text-gray-700' }} flex items-center px-3 py-2.5 text-sm font-medium">
                                <i class="bi bi-people mr-3 text-lg {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-gray-500' }}"></i>
                                <span class="font-medium">Quản lý người dùng</span>
                            </a>
                        </nav>
                    </div>
                    
                    <!-- User profile -->
                    <div class="user-profile flex-shrink-0 p-4">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white text-sm font-semibold">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="text-sm font-medium text-gray-800">{{ auth()->user()->name }}</p>
                                <form method="POST" action="{{ route('logout') }}" class="mt-1">
                                    @csrf
                                    <button type="submit" class="text-xs text-gray-500 hover:text-gray-700 flex items-center">
                                        <i class="bi bi-box-arrow-right mr-1"></i>
                                        Đăng xuất
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Mobile menu -->
        <div class="md:hidden bg-gray-800 text-white p-4 flex justify-between items-center w-full">
            <a href="{{ route('admin.dashboard') }}" class="font-bold text-xl">Admin</a>
            <button type="button" class="mobile-menu-button">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
        
        <!-- Mobile menu (hidden by default) -->
        <div class="md:hidden mobile-menu hidden bg-gray-800 w-full absolute z-10" x-data="{ accountsOpen: false, ordersOpen: false, servicesOpen: false }">
            <nav class="px-4 py-2">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-gray-900' : '' }} block px-4 py-2 text-white rounded-md">Dashboard</a>
                <a href="{{ route('admin.games.index') }}" class="{{ request()->routeIs('admin.games.*') ? 'bg-gray-900' : '' }} block px-4 py-2 text-white rounded-md">Quản lý game</a>
                
                <!-- Mobile: Quản lý tài khoản -->
                <div>
                    <button @click="accountsOpen = !accountsOpen" class="flex items-center justify-between w-full px-4 py-2 text-white">
                        <span>Quản lý tài khoản</span>
                        <svg :class="{'rotate-90': accountsOpen, 'rotate-0': !accountsOpen}" class="w-4 h-4 transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="accountsOpen" class="pl-6">
                        <a href="{{ route('admin.account_categories.index') }}" class="{{ request()->routeIs('admin.account_categories.*') ? 'bg-gray-900' : '' }} block px-4 py-2 text-white rounded-md">Danh mục tài khoản</a>
                        <a href="{{ route('admin.accounts.index') }}" class="{{ request()->routeIs('admin.accounts.*') ? 'bg-gray-900' : '' }} block px-4 py-2 text-white rounded-md">Tài khoản</a>
                    </div>
                </div>
                
                <!-- Mobile: Quản lý đơn hàng -->
                <div>
                    <button @click="ordersOpen = !ordersOpen" class="flex items-center justify-between w-full px-4 py-2 text-white">
                        <span>Quản lý đơn hàng</span>
                        <svg :class="{'rotate-90': ordersOpen, 'rotate-0': !ordersOpen}" class="w-4 h-4 transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="ordersOpen" class="pl-6">
                        <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'bg-gray-900' : '' }} block px-4 py-2 text-white rounded-md">Đơn hàng tài khoản</a>
                    </div>
                </div>
                
                <!-- Mobile: Quản lý dịch vụ -->
                <div>
                    <button @click="servicesOpen = !servicesOpen" class="flex items-center justify-between w-full px-4 py-2 text-white">
                        <span>Quản lý dịch vụ</span>
                        <svg :class="{'rotate-90': servicesOpen, 'rotate-0': !servicesOpen}" class="w-4 h-4 transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="servicesOpen" class="pl-6">
                        <a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services.*') ? 'bg-gray-900' : '' }} block px-4 py-2 text-white rounded-md">Dịch vụ</a>
                        <a href="{{ route('admin.services.orders.index') }}" class="{{ request()->routeIs('admin.services.orders.*') ? 'bg-gray-900' : '' }} block px-4 py-2 text-white rounded-md">Đơn hàng dịch vụ</a>
                        <a href="{{ route('admin.topup.index') }}" class="{{ request()->routeIs('admin.topup.*') ? 'bg-gray-900' : '' }} block px-4 py-2 text-white rounded-md">Dịch vụ nạp hộ</a>
                        <a href="{{ route('admin.topup_categories.index') }}" class="{{ request()->routeIs('admin.topup_categories.*') ? 'bg-gray-900' : '' }} block px-4 py-2 text-white rounded-md">Danh mục nạp hộ</a>
                        <a href="{{ route('admin.topup_orders.index') }}" class="{{ request()->routeIs('admin.topup_orders.*') ? 'bg-gray-900' : '' }} block px-4 py-2 text-white rounded-md">Đơn hàng nạp hộ</a>
                    </div>
                </div>
                
                <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'bg-gray-900' : '' }} block px-4 py-2 text-white rounded-md">Quản lý người dùng</a>
            </nav>
        </div>
        
        <!-- Main Content -->
        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mx-6 mt-4 rounded-r" role="alert">
                    <div class="flex items-center">
                        <i class="bi bi-check-circle text-green-500 mr-2"></i>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mx-6 mt-4 rounded-r" role="alert">
                    <div class="flex items-center">
                        <i class="bi bi-exclamation-circle text-red-500 mr-2"></i>
                        <p>{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            <main class="flex-1 relative overflow-y-auto focus:outline-none">
                @yield('content')
            </main>
        </div>
    </div>
    
    <!-- Scripts -->
    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.querySelector('.mobile-menu-button');
            const mobileMenu = document.querySelector('.mobile-menu');
            
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html> 