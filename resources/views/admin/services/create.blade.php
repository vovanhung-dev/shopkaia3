@extends('layouts.admin')

@section('title', 'Thêm dịch vụ mới')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900">Thêm dịch vụ mới</h1>
            <a href="{{ route('admin.services.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Quay lại</span>
            </a>
        </div>
        
        <!-- Thông báo hướng dẫn -->
        <div class="mt-4 bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-blue-700">
                        Giá dịch vụ sẽ được thiết lập trong các gói dịch vụ con. Sau khi tạo dịch vụ này, bạn có thể thêm các gói dịch vụ với giá riêng.
                    </p>
                </div>
            </div>
        </div>

        <!-- Form dịch vụ -->
        <div class="mt-6 bg-white shadow rounded-lg p-6">
            <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Thông tin chung</h3>
                        
                        <div class="mb-4">
                            <label for="game_id" class="block text-sm font-medium text-gray-700 mb-1">
                                Game <span class="text-red-600">*</span>
                            </label>
                            <select id="game_id" name="game_id" 
                                class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="">-- Chọn game --</option>
                                @foreach ($games as $game)
                                    <option value="{{ $game->id }}" {{ old('game_id') == $game->id ? 'selected' : '' }}>
                                        {{ $game->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('game_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                Tên dịch vụ <span class="text-red-600">*</span>
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" 
                                class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-1">
                                Loại dịch vụ <span class="text-red-600">*</span>
                            </label>
                            <select id="type" name="type" 
                                class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="fishing" {{ old('type') == 'fishing' ? 'selected' : '' }}>Câu cá</option>
                                <option value="account" {{ old('type') == 'account' ? 'selected' : '' }}>Tài khoản</option>
                                <option value="boosting" {{ old('type') == 'boosting' ? 'selected' : '' }}>Cày thuê</option>
                                <option value="other" {{ old('type') == 'other' ? 'selected' : '' }}>Khác</option>
                            </select>
                            @error('type')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                                Trạng thái <span class="text-red-600">*</span>
                            </label>
                            <select id="status" name="status" 
                                class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Hoạt động</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Tạm ngừng</option>
                            </select>
                            @error('status')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Hình ảnh và mô tả</h3>
                        
                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">
                                Hình ảnh
                            </label>
                            <input type="file" id="image" name="image" accept="image/*"
                                class="block w-full mt-1 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="text-xs text-gray-500 mt-1">Hình ảnh nên có kích thước 800x600px và không quá 2MB</p>
                            @error('image')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="short_description" class="block text-sm font-medium text-gray-700 mb-1">
                                Mô tả ngắn
                            </label>
                            <textarea id="short_description" name="short_description" rows="2" 
                                class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('short_description') }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Mô tả ngắn gọn sẽ hiển thị ở trang danh sách dịch vụ</p>
                            @error('short_description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                                Mô tả dịch vụ
                            </label>
                            <textarea id="description" name="description" rows="5" 
                                class="ckeditor block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="is_featured" class="inline-flex items-center">
                                <input type="checkbox" id="is_featured" name="is_featured" value="1" 
                                    {{ old('is_featured') ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Dịch vụ nổi bật</span>
                            </label>
                        </div>
                        
                        <div class="mb-4">
                            <label for="login_type" class="block text-sm font-medium text-gray-700 mb-1">
                                Loại thông tin đăng nhập <span class="text-red-600">*</span>
                            </label>
                            <select id="login_type" name="login_type" required
                                class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="username_password" {{ old('login_type', 'username_password') == 'username_password' ? 'selected' : '' }}>Tài khoản và mật khẩu</option>
                                <option value="game_id" {{ old('login_type') == 'game_id' ? 'selected' : '' }}>Chỉ ID Game</option>
                                <option value="both" {{ old('login_type') == 'both' ? 'selected' : '' }}>Cả hai (ID và tài khoản)</option>
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Loại thông tin đăng nhập mà người dùng cần cung cấp khi đặt dịch vụ này</p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <a href="{{ route('admin.services.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 mr-2">
                        Hủy
                    </a>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Lưu dịch vụ
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
        // Khởi tạo CKEditor cho trường mô tả
        ClassicEditor
            .create(document.querySelector('#description'), {
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
            .catch(error => {
                console.error('Lỗi khi khởi tạo CKEditor:', error);
            });
    });
</script>
@endpush 