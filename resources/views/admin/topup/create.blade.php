@extends('layouts.admin')

@section('title', 'Thêm dịch vụ nạp thuê mới')

@section('content')
<div class="py-6">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900">
                Thêm dịch vụ nạp thuê mới
            </h1>
            <a href="{{ route('admin.topup.index') }}"
                class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Quay lại</span>
            </a>
        </div>

        <!-- Thông báo lỗi -->
        @if($errors->any())
        <div class="mt-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded" role="alert">
            <p class="font-bold">Lỗi!</p>
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Form thêm dịch vụ -->
        <div class="mt-6 bg-white shadow rounded-lg p-6">
            <form action="{{ route('admin.topup.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Thông tin chung</h3>

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                Tên dịch vụ <span class="text-red-600">*</span>
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Nhập tên dịch vụ nạp thuê, ví dụ: Nạp 1000 Kim Cương Free Fire" required
                                class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <p class="text-xs text-gray-500 mt-1">Tên dịch vụ nạp thuê, ví dụ: Nạp 1000 Kim Cương Free Fire</p>
                        </div>

                        <div class="mb-4">
                            <label for="game_id" class="block text-sm font-medium text-gray-700 mb-1">
                                Game <span class="text-red-600">*</span>
                            </label>
                            <select id="game_id" name="game_id" required
                                class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Chọn game</option>
                                @foreach($games as $game)
                                <option value="{{ $game->id }}" {{ old('game_id') == $game->id ? 'selected' : '' }}>
                                    {{ $game->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">
                                Danh mục
                            </label>
                            <select id="category_id" name="category_id"
                                class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Không chọn danh mục</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="short_description" class="block text-sm font-medium text-gray-700 mb-1">
                                Mô tả ngắn
                            </label>
                            <textarea id="short_description" name="short_description" rows="2" placeholder="Nhập mô tả ngắn gọn về dịch vụ nạp thuê"
                                class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('short_description') }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Mô tả ngắn gọn sẽ hiển thị ở trang danh sách dịch vụ</p>
                            @error('short_description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                                Mô tả <span class="text-red-600">*</span>
                            </label>
                            <textarea id="description" name="description" rows="4"
                                class="ckeditor block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"><strong>🎮 Chỉ cần vào Cài đặt → Lấy ID game → Điền vào form là nạp ngay, không cần chờ đợi!</strong><br><strong>⚡ Nhanh – Gọn – Chính xác: Ai cũng làm được, khỏi cần hỏi ai!</strong><br><strong>📬 Nếu sau 10 phút chưa thấy thư, liên hệ ngay với shop để được hỗ trợ liền tay nha bạn!</strong></textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">
                                    Giá (VNĐ) <span class="text-red-600">*</span>
                                </label>
                                <input type="number" id="price" name="price" value="{{ old('price') }}" placeholder="50000" min="0" required
                                    class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="sale_price" class="block text-sm font-medium text-gray-700 mb-1">
                                    Giá khuyến mãi
                                </label>
                                <input type="number" id="sale_price" name="sale_price" value="{{ old('sale_price') }}" placeholder="45000" min="0"
                                    class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="estimated_minutes" class="block text-sm font-medium text-gray-700 mb-1">
                                Thời gian hoàn thành (phút) <span class="text-red-600">*</span>
                            </label>
                            <input type="number" id="estimated_minutes" name="estimated_minutes" value="{{ old('estimated_minutes') }}" placeholder="15" min="1" required
                                class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Thông tin bổ sung</h3>

                        <div class="mb-4">
                            <label for="requirements" class="block text-sm font-medium text-gray-700 mb-1">
                                Yêu cầu
                            </label>
                            <textarea id="requirements" name="requirements" rows="3" placeholder="Nhập các yêu cầu đối với tài khoản game của khách hàng"
                                class="ckeditor block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('requirements') }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Các yêu cầu đối với tài khoản game của khách hàng</p>
                        </div>

                        <div class="mb-4">
                            <label for="includes" class="block text-sm font-medium text-gray-700 mb-1">
                                Bao gồm
                            </label>
                            <textarea id="includes" name="includes" rows="3" placeholder="Nhập những gì khách hàng sẽ nhận được"
                                class="ckeditor block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('includes') }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Những gì khách hàng sẽ nhận được</p>
                        </div>

                        <div class="mb-4">
                            <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-1">
                                Hình ảnh thu nhỏ
                            </label>
                            <input type="file" id="thumbnail" name="thumbnail" accept="image/*"
                                class="block w-full mt-1 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="text-xs text-gray-500 mt-1">Hình ảnh hiển thị trong danh sách dịch vụ (Kích thước khuyến nghị: 600x400px)</p>
                        </div>

                        <div class="mb-4">
                            <label for="banner" class="block text-sm font-medium text-gray-700 mb-1">
                                Hình ảnh banner
                            </label>
                            <input type="file" id="banner" name="banner" accept="image/*"
                                class="block w-full mt-1 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="text-xs text-gray-500 mt-1">Hình ảnh banner hiển thị ở trang chi tiết (Kích thước khuyến nghị: 1200x400px)</p>
                        </div>

                        <div class="mb-4">
                            <label for="is_active" class="inline-flex items-center">
                                <input type="checkbox" id="is_active" name="is_active" value="1" 
                                    {{ old('is_active', 1) ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Kích hoạt dịch vụ</span>
                            </label>
                        </div>
                        
                        <div class="mb-4">
                            <label for="login_type" class="block text-sm font-medium text-gray-700 mb-1">
                                Loại thông tin đăng nhập <span class="text-red-600">*</span>
                            </label>
                            <select id="login_type" name="login_type" required
                                class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="game_id" {{ old('login_type', 'game_id') == 'game_id' ? 'selected' : '' }}>Chỉ ID Game</option>
                                <option value="username_password" {{ old('login_type') == 'username_password' ? 'selected' : '' }}>Tài khoản và mật khẩu</option>
                                <option value="both" {{ old('login_type') == 'both' ? 'selected' : '' }}>Cả hai (ID và tài khoản)</option>
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Loại thông tin đăng nhập mà người dùng cần cung cấp khi đặt dịch vụ này</p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <a href="{{ route('admin.topup.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 mr-2">
                        Hủy
                    </a>
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Tạo dịch vụ
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const textareaIds = ['description', 'requirements', 'includes'];
        const editors = {};
        
        textareaIds.forEach(id => {
            ClassicEditor
                .create(document.querySelector(`#${id}`), {
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|', 'outdent', 'indent', '|', 'imageUpload', 'blockQuote', 'insertTable', '|', 'undo', 'redo'],
                    heading: {
                        options: [
                            { model: 'paragraph', title: 'Đoạn văn', class: 'ck-heading_paragraph' },
                            { model: 'heading1', view: 'h1', title: 'Tiêu đề 1', class: 'ck-heading_heading1' },
                            { model: 'heading2', view: 'h2', title: 'Tiêu đề 2', class: 'ck-heading_heading2' },
                            { model: 'heading3', view: 'h3', title: 'Tiêu đề 3', class: 'ck-heading_heading3' }
                        ]
                    },
                    language: 'vi'
                })
                .then(editor => {
                    editors[id] = editor;
                })
                .catch(error => {
                    console.error(`Lỗi khi khởi tạo CKEditor cho ${id}:`, error);
                });
        });

        // Thêm validation cho form trước khi submit
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            // Kiểm tra trường description
            if (editors['description'] && editors['description'].getData().trim() === '') {
                e.preventDefault();
                alert('Vui lòng nhập mô tả dịch vụ');
                return false;
            }
            
            return true;
        });
    });
</script>
@endpush 