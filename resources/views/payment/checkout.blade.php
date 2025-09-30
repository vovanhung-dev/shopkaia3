@extends('layouts.app')

@section('title', 'Thanh toán đơn hàng #' . $order->order_number)

@section('content')
<div class="bg-gray-50 py-8">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Trang chủ
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        @if(isset($isBoostingOrder) && $isBoostingOrder)
                        <a href="{{ route('boosting.index') }}" class="ml-1 text-gray-700 hover:text-blue-600 md:ml-2">Dịch vụ cày hộ</a>
                        @else
                        <a href="{{ route('orders.index') }}" class="ml-1 text-gray-700 hover:text-blue-600 md:ml-2">Đơn hàng của tôi</a>
                        @endif
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        @if(isset($isBoostingOrder) && $isBoostingOrder)
                        <a href="{{ route('boosting.my_orders') }}" class="ml-1 text-gray-700 hover:text-blue-600 md:ml-2">Đơn hàng cày hộ</a>
                        @elseif(isset($order) && strpos($order->order_number, 'SRV-') === 0)
                        <a href="{{ route('services.my_orders') }}" class="ml-1 text-gray-700 hover:text-blue-600 md:ml-2">Đơn hàng dịch vụ</a>
                        @else
                        <a href="{{ route('orders.index') }}" class="ml-1 text-gray-700 hover:text-blue-600 md:ml-2">Đơn hàng của tôi</a>
                        @endif
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        @if(isset($order))
                            @if(strpos($order->order_number, 'SRV-') === 0)
                                <a href="{{ route('services.view_order', $order->order_number) }}" class="ml-1 text-gray-700 hover:text-blue-600 md:ml-2">Đơn hàng #{{ $order->order_number }}</a>
                            @elseif(strpos($order->order_number, 'BST-') === 0)
                                <a href="{{ route('boosting.orders.show', $order->order_number) }}" class="ml-1 text-gray-700 hover:text-blue-600 md:ml-2">Đơn hàng #{{ $order->order_number }}</a>
                            @else
                                <a href="{{ route('orders.index') }}" class="ml-1 text-gray-700 hover:text-blue-600 md:ml-2">Đơn hàng #{{ $order->order_number }}</a>
                            @endif
                        @else
                            <span class="ml-1 text-gray-700 md:ml-2">Đơn hàng</span>
                        @endif
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-gray-500 md:ml-2">Thanh toán</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cột thông tin thanh toán -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-800">Thông tin thanh toán</h2>
                    </div>
                    
                    <div class="p-6">
                        <!-- Hiển thị trạng thái thanh toán -->
                        <div id="payment-status-check" class="my-5 px-4 py-3 border-l-4 border-blue-500 bg-blue-50 text-blue-700">
                            <span>Đang kiểm tra trạng thái thanh toán...</span>
                            
                            <div class="mt-3 flex space-x-3">
                                <button onclick="manualCheckStatus()" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none">
                                    Kiểm tra thủ công
                                </button>
                                <button onclick="window.location.reload()" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 focus:outline-none">
                                    Làm mới trang
                                </button>
                            </div>
                        </div>

                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 sm:px-6 flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Phương thức thanh toán</h3>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-500">Lựa chọn phương thức thanh toán phù hợp</p>
                                </div>
                                <div>
                                    <button id="refreshStatusBtn" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <svg class="mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                        </svg>
                                        Kiểm tra thanh toán
                                    </button>
                                </div>
                            </div>

                            <div class="border-t border-gray-200">
                                <div class="px-6 py-5 space-y-6">
                                    @if(isset($wallet) && $wallet && $wallet->balance >= $order->amount)
                                    <!-- Thanh toán qua ví -->
                                    <div class="relative p-4 mt-4 border border-gray-200 rounded-lg bg-gradient-to-r from-blue-50 to-indigo-50 hover:from-blue-100 hover:to-indigo-100 transition-all duration-300 shadow-sm">
                                        <div class="flex items-center justify-between">
                                            <div class="flex-1">
                                                <h3 class="font-medium text-gray-900 flex items-center">
                                                    <svg class="mr-2 h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                    </svg>
                                                    Thanh toán bằng số dư ví
                                                </h3>
                                                <div class="mt-2">
                                                    <p class="text-sm text-gray-600">Số dư hiện tại: <span class="font-semibold text-green-600">{{ number_format($wallet->balance, 0, ',', '.') }}đ</span></p>
                                                    <p class="text-sm text-gray-600">Số tiền thanh toán: <span class="font-semibold text-gray-900">{{ number_format($order->amount, 0, ',', '.') }}đ</span></p>
                                                    <p class="text-sm text-gray-600 mt-1">Số dư còn lại sau thanh toán: <span class="font-semibold text-blue-600">{{ number_format($wallet->balance - $order->amount, 0, ',', '.') }}đ</span></p>
                                                    <p class="mt-2 text-xs text-gray-500">Thanh toán nhanh chóng và an toàn từ số dư ví của bạn.</p>
                                                </div>
                                            </div>
                                            
                                            <div class="ml-4">
                                                <form action="{{ route('payment.wallet', $order->order_number) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                                                        <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                        </svg>
                                                        Xác nhận thanh toán
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @elseif(isset($wallet) && $wallet && $wallet->balance < $order->amount)
                                    <!-- Số dư ví không đủ -->
                                    <div class="relative p-4 mt-4 border border-red-200 rounded-lg bg-red-50">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <h3 class="font-medium text-gray-900 flex items-center">
                                                    <svg class="mr-2 h-5 w-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Thanh toán bằng số dư ví
                                                </h3>
                                                <div class="mt-2">
                                                    <p class="text-sm text-gray-600">Số dư hiện tại: <span class="font-semibold text-red-600">{{ number_format($wallet->balance, 0, ',', '.') }}đ</span></p>
                                                    <p class="text-sm text-gray-600">Số tiền thanh toán: <span class="font-semibold text-gray-900">{{ number_format($order->amount, 0, ',', '.') }}đ</span></p>
                                                    <p class="mt-1 text-sm text-red-600 font-medium">Số dư không đủ để thanh toán (còn thiếu {{ number_format($order->amount - $wallet->balance, 0, ',', '.') }}đ)</p>
                                                </div>
                                            </div>
                                            <a href="{{ route('wallet.deposit') }}" class="ml-4 inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                                Nạp tiền ngay
                                            </a>
                                        </div>
                                    </div>
                                    @elseif(Auth::check() && !isset($wallet))
                                    <!-- Chưa có ví -->
                                    <div class="relative p-4 mt-4 border border-yellow-200 rounded-lg bg-yellow-50">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <h3 class="font-medium text-gray-900 flex items-center">
                                                    <svg class="mr-2 h-5 w-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Thanh toán bằng số dư ví
                                                </h3>
                                                <p class="mt-2 text-sm text-gray-600">Bạn chưa có ví điện tử. Tạo ví điện tử để thanh toán nhanh chóng cho các đơn hàng sau này.</p>
                                            </div>
                                            <a href="{{ route('wallet.deposit') }}" class="ml-4 inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                                                <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                </svg>
                                                Tạo ví điện tử
                                            </a>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    <!-- Chuyển khoản ngân hàng -->
                                    <div class="relative border rounded-md p-4">
                                        <h3 class="text-lg font-medium text-gray-900">Thanh toán chuyển khoản</h3>
                                        
                                        <div class="mt-4 grid md:grid-cols-2 gap-4">
                                            <div>
                                                <div class="mb-4">
                                                    <p class="text-sm font-medium text-gray-700">Ngân hàng:</p>
                                                    <p class="text-base font-semibold">MBBank</p>
                                                </div>
                                                <div class="mb-4">
                                                    <p class="text-sm font-medium text-gray-700">Số tài khoản:</p>
                                                    <p class="text-base font-semibold">
                                                        0971202103
                                                        <button type="button" class="ml-2 inline-flex items-center p-1 border border-transparent rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 copy-btn" data-clipboard-text="0971202103">
                                                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                                            </svg>
                                                        </button>
                                                    </p>
                                                </div>
                                                <div class="mb-4">
                                                    <p class="text-sm font-medium text-gray-700">Chủ tài khoản:</p>
                                                    <p class="text-base font-semibold">HOANG DUY KHANH	                                                   </p>
                                                </div>
                                                <div class="mb-4">
                                                    <p class="text-sm font-medium text-gray-700">Số tiền:</p>
                                                    <p class="text-base font-semibold">{{ number_format($order->amount, 0, ',', '.') }}đ
                                                        <button type="button" class="ml-2 inline-flex items-center p-1 border border-transparent rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 copy-btn" data-clipboard-text="{{ $order->amount }}">
                                                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                                            </svg>
                                                        </button>
                                                    </p>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-medium text-gray-700">Nội dung chuyển khoản:</p>
                                                    <p class="text-base font-semibold">
                                                        {{ $paymentInfo['payment_content'] }}
                                                        <button type="button" class="ml-2 inline-flex items-center p-1 border border-transparent rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 copy-btn" data-clipboard-text="{{ $paymentInfo['payment_content'] }}">
                                                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                                            </svg>
                                                        </button>
                                                    </p>
                                                    <p class="mt-1 text-xs text-gray-500">
                                                        (Lưu ý: Vui lòng sử dụng đúng nội dung chuyển khoản này để hệ thống xác nhận tự động)
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-center">
                                                @if(isset($paymentInfo['qr_image']) && $paymentInfo['qr_image'])
                                                    <img src="{{ $paymentInfo['qr_image'] }}" alt="QR Thanh toán" class="max-w-full h-auto">
                                                @else
                                                    <img src="{{ $paymentInfo['qr_url'] ?? '' }}" alt="QR Thanh toán" class="max-w-full h-auto">
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="mt-6">
                                            <p class="text-sm text-gray-500">
                                                <strong>Lưu ý:</strong> Hệ thống tự động xác nhận thanh toán sau 1-3 phút. Nếu quá thời gian trên mà chưa nhận được xác nhận, vui lòng liên hệ hotline để được hỗ trợ.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cột tóm tắt đơn hàng -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-md overflow-hidden sticky top-6">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-800">Tóm tắt đơn hàng</h2>
                    </div>
                    
                    <div class="p-6">
                        @if(isset($isBoostingOrder) && $isBoostingOrder)
                        <!-- Hiển thị thông tin đơn hàng cày thuê -->
                        <div class="mb-4">
                            <h3 class="font-medium text-gray-900">{{ $order->service->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $order->service->game->name }}</p>
                            <!--<p class="text-sm text-gray-500 mt-2">Thời gian ước tính: {{ $order->service->estimated_days }} ngày</p>-->
                        </div>
                        
                        <div class="border-t border-gray-200 pt-4 mt-4">
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Giá dịch vụ</span>
                                <span class="font-medium text-gray-900">{{ number_format($order->original_amount, 0, ',', '.') }}đ</span>
                            </div>
                            
                            @if($order->discount > 0)
                                <div class="flex justify-between mb-2 text-green-600">
                                    <span>Giảm giá</span>
                                    <span>-{{ number_format($order->discount, 0, ',', '.') }}đ</span>
                                </div>
                            @endif
                            
                            <div class="flex justify-between font-bold text-lg pt-4 border-t border-gray-200 mt-4">
                                <span>Tổng cộng</span>
                                <span class="text-red-600">{{ number_format($order->amount, 0, ',', '.') }}đ</span>
                            </div>
                        </div>
                        @elseif(isset($isTopUpOrder) && $isTopUpOrder)
                        <!-- Hiển thị thông tin đơn hàng nạp thuê -->
                        <div class="mb-4">
                            <h3 class="font-medium text-gray-900">{{ $order->service->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $order->service->game->name }}</p>
                            <p class="text-sm text-gray-500 mt-2">Game ID: {{ $order->game_id }}</p>
                            @if($order->server_id)
                            <p class="text-sm text-gray-500">Server: {{ $order->server_id }}</p>
                            @endif
                            <!--<p class="text-sm text-gray-500 mt-2">Thời gian ước tính: {{ $order->service->estimated_days ?? 'N/A' }} ngày</p>-->
                        </div>
                        
                        <div class="border-t border-gray-200 pt-4 mt-4">
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Giá dịch vụ</span>
                                <span class="font-medium text-gray-900">{{ number_format($order->original_amount, 0, ',', '.') }}đ</span>
                            </div>
                            
                            @if($order->discount > 0)
                                <div class="flex justify-between mb-2 text-green-600">
                                    <span>Giảm giá</span>
                                    <span>-{{ number_format($order->discount, 0, ',', '.') }}đ</span>
                                </div>
                            @endif
                            
                            <div class="flex justify-between font-bold text-lg pt-4 border-t border-gray-200 mt-4">
                                <span>Tổng cộng</span>
                                <span class="text-red-600">{{ number_format($order->amount, 0, ',', '.') }}đ</span>
                            </div>
                        </div>
                        @elseif(isset($order) && strpos($order->order_number, 'SRV-') === 0)
                        <!-- Hiển thị thông tin đơn hàng dịch vụ -->
                        <div class="flex items-center mb-4">
                            <div class="w-16 h-16 bg-blue-100 rounded-md flex items-center justify-center">
                                <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center text-sm font-bold">
                                    {{ strtoupper(substr($order->user->name, 0, 1)) }}
                                </div>
                            </div>
                            <div class="ml-4">
                                <h3 class="font-medium text-gray-900">{{ $order->service->name ?? 'Dịch vụ game' }}</h3>
                                <p class="text-sm text-gray-500">{{ $order->package->name ?? 'Gói dịch vụ' }}</p>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 pt-4 mt-4">
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Giá dịch vụ</span>
                                <span class="font-medium text-gray-900">{{ number_format($order->original_amount ?? $order->amount, 0, ',', '.') }}đ</span>
                            </div>

                            @if(isset($order->discount) && $order->discount > 0)
                                <div class="flex justify-between mb-2 text-green-600">
                                    <span>Giảm giá</span>
                                    <span>-{{ number_format($order->discount, 0, ',', '.') }}đ</span>
                                </div>
                            @endif

                            <div class="flex justify-between font-bold text-lg pt-4 border-t border-gray-200 mt-4">
                                <span>Tổng cộng</span>
                                <span class="text-red-600">{{ number_format($order->amount, 0, ',', '.') }}đ</span>
                            </div>
                        </div>
                        @else
                        <!-- Hiển thị thông tin đơn hàng tài khoản thường -->
                        <div class="flex items-center mb-4">
                            @php
                                $accountImage = 'https://via.placeholder.com/300x200';
                                if ($order->account && $order->account->images) {
                                    if (is_string($order->account->images)) {
                                        $images = json_decode($order->account->images, true);
                                        if (is_array($images) && !empty($images)) {
                                            $accountImage = asset('storage/' . $images[0]);
                                        }
                                    } elseif (is_array($order->account->images) && !empty($order->account->images)) {
                                        $accountImage = asset('storage/' . $order->account->images[0]);
                                    }
                                }
                            @endphp
                            <img src="{{ $accountImage }}" alt="{{ $order->account->title ?? 'Tài khoản' }}" class="w-16 h-16 object-cover rounded-md">
                            <div class="ml-4">
                                <h3 class="font-medium text-gray-900">{{ $order->account->title ?? 'Tài khoản game' }}</h3>
                                <p class="text-sm text-gray-500">{{ $order->account->game->name ?? '' }}</p>
                            </div>
                        </div>
                        
                        <div class="border-t border-gray-200 pt-4 mt-4">
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Giá tài khoản</span>
                                <span class="font-medium text-gray-900">{{ number_format($order->original_amount ?? $order->amount, 0, ',', '.') }}đ</span>
                            </div>
                            
                            @if(isset($order->discount) && $order->discount > 0)
                                <div class="flex justify-between mb-2 text-green-600">
                                    <span>Giảm giá</span>
                                    <span>-{{ number_format($order->discount, 0, ',', '.') }}đ</span>
                                </div>
                            @endif
                            
                            <div class="flex justify-between font-bold text-lg pt-4 border-t border-gray-200 mt-4">
                                <span>Tổng cộng</span>
                                <span class="text-red-600">{{ number_format($order->amount, 0, ',', '.') }}đ</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Khởi tạo Clipboard.js
        var clipboard = new ClipboardJS('.copy-btn');
        
        clipboard.on('success', function(e) {
            // Hiển thị thông báo sao chép thành công
            const originalText = e.trigger.innerHTML;
            e.trigger.innerHTML = '<svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>';
            
            setTimeout(function() {
                e.trigger.innerHTML = originalText;
            }, 2000);
            
            e.clearSelection();
        });
        
        // Kiểm tra trạng thái thanh toán tự động
        const orderNumber = '{{ $order->order_number }}';
        const checkStatusUrl = '{{ route('payment.check_status', ['orderNumber' => $order->order_number]) }}';
        
        function checkPaymentStatus() {
            fetch(checkStatusUrl)
                .then(response => response.json())
                .then(data => {
                    
                    if (data.status === 'paid' || data.status === 'completed' || data.status === 'processing') {
                        // Hiển thị thông báo thành công
                        showSuccessMessage(data.message);
                        
                        // Chuyển hướng sau 2 giây
                        setTimeout(function() {
                            if (data.status === 'paid' || data.status === 'completed') {
                                if (data.redirect_url) {
                                    window.location.href = data.redirect_url;
                                } else if ('{{ isset($isBoostingOrder) && $isBoostingOrder }}' === '1') {
                                    window.location.href = '{{ route('boosting.account_info', $order->order_number) }}';
                                } else if ('{{ isset($order) && strpos($order->order_number, 'SRV-') === 0 }}' === '1') {
                                    window.location.href = '{{ route('services.view_order', $order->order_number) }}';
                                } else {
                                    window.location.href = '{{ route('payment.success', $order->order_number) }}';
                                }
                            }
                        }, 2000);
                    }
                })
                .catch(error => {
                    console.error('Lỗi khi kiểm tra trạng thái:', error);
                });
        }
        
        // Kiểm tra trạng thái mỗi 10 giây
        const statusInterval = setInterval(checkPaymentStatus, 10000);
        
        // Nút kiểm tra trạng thái thủ công
        document.getElementById('refreshStatusBtn').addEventListener('click', function() {
            // Thay đổi trạng thái nút
            this.classList.add('animate-pulse');
            this.disabled = true;
            
            fetch(checkStatusUrl)
                .then(response => response.json())
                .then(data => {
                    
                    // Khôi phục trạng thái nút
                    this.classList.remove('animate-pulse');
                    this.disabled = false;
                    
                    if (data.status === 'paid' || data.status === 'completed' || data.status === 'processing') {
                        // Hiển thị thông báo thành công
                        showSuccessMessage(data.message);
                        
                        // Chuyển hướng sau 2 giây
                        setTimeout(function() {
                            if (data.status === 'paid' || data.status === 'completed') {
                                if (data.redirect_url) {
                                    window.location.href = data.redirect_url;
                                } else if ('{{ isset($isBoostingOrder) && $isBoostingOrder }}' === '1') {
                                    window.location.href = '{{ route('boosting.account_info', $order->order_number) }}';
                                } else if ('{{ isset($order) && strpos($order->order_number, 'SRV-') === 0 }}' === '1') {
                                    window.location.href = '{{ route('services.view_order', $order->order_number) }}';
                                } else {
                                    window.location.href = '{{ route('payment.success', $order->order_number) }}';
                                }
                            }
                        }, 2000);
                    } else {
                        // Hiển thị thông báo chưa thanh toán
                        showErrorMessage('Hệ thống chưa ghi nhận thanh toán của bạn. Vui lòng kiểm tra lại sau.');
                    }
                })
                .catch(error => {
                    console.error('Lỗi khi kiểm tra trạng thái:', error);
                    
                    // Khôi phục trạng thái nút
                    this.classList.remove('animate-pulse');
                    this.disabled = false;
                    
                    showErrorMessage('Đã xảy ra lỗi khi kiểm tra. Vui lòng thử lại sau.');
                });
        });
        
        function showSuccessMessage(message) {
            // Tạo phần tử thông báo
            var notification = document.createElement('div');
            notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-lg transition-all duration-500 transform translate-x-full';
            notification.textContent = message || 'Đã xác nhận thanh toán thành công!';
            
            // Thêm vào body
            document.body.appendChild(notification);
            
            // Hiển thị
            setTimeout(function() {
                notification.classList.remove('translate-x-full');
            }, 100);
            
            // Ẩn sau 5 giây
            setTimeout(function() {
                notification.classList.add('translate-x-full');
                setTimeout(function() {
                    document.body.removeChild(notification);
                }, 500);
            }, 5000);
        }
        
        function showErrorMessage(message) {
            // Tạo phần tử thông báo
            var notification = document.createElement('div');
            notification.className = 'fixed top-4 right-4 bg-red-500 text-white px-4 py-2 rounded shadow-lg transition-all duration-500 transform translate-x-full';
            notification.textContent = message || 'Đã xảy ra lỗi!';
            
            // Thêm vào body
            document.body.appendChild(notification);
            
            // Hiển thị
            setTimeout(function() {
                notification.classList.remove('translate-x-full');
            }, 100);
            
            // Ẩn sau 5 giây
            setTimeout(function() {
                notification.classList.add('translate-x-full');
                setTimeout(function() {
                    document.body.removeChild(notification);
                }, 500);
            }, 5000);
        }
    });
</script>
@endsection 