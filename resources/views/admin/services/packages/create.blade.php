@extends('layouts.admin')

@section('title', 'Thêm gói dịch vụ mới - ' . $service->name)

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Thêm gói dịch vụ mới</h1>
                <p class="mt-1 text-sm text-gray-600">Dịch vụ: {{ $service->name }}</p>
            </div>
            <div>
                <a href="{{ route('admin.services.packages', $service->id) }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">
                    Quay lại danh sách
                </a>
            </div>
        </div>

        <!-- Thông báo lỗi -->
        @if ($errors->any())
        <div class="mt-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded" role="alert">
            <p class="font-bold">Đã xảy ra lỗi!</p>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Form tạo gói dịch vụ -->
        <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-lg">
            <form action="{{ route('admin.services.packages.store', $service->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <!-- Tên gói dịch vụ -->
                        <div class="sm:col-span-3">
                            <label for="name" class="block text-sm font-medium text-gray-700">Tên gói dịch vụ <span class="text-red-500">*</span></label>
                            <div class="mt-1">
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" required>
                            </div>
                        </div>

                        <!-- Giá gốc -->
                        <div class="sm:col-span-3">
                            <label for="price" class="block text-sm font-medium text-gray-700">Giá gói (VNĐ) <span class="text-red-500">*</span></label>
                            <div class="mt-1">
                                <input type="number" name="price" id="price" min="0" value="{{ old('price') }}" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" required>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Nhập số tiền nguyên (không dấu phẩy hay dấu chấm), ví dụ: 100000</p>
                        </div>

                        <!-- Giá khuyến mãi -->
                        <div class="sm:col-span-3">
                            <label for="sale_price" class="block text-sm font-medium text-gray-700">Giá khuyến mãi (VNĐ)</label>
                            <div class="mt-1">
                                <input type="number" name="sale_price" id="sale_price" min="0" value="{{ old('sale_price', '') }}" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Để trống nếu không có khuyến mãi. Nhập số tiền nguyên, ví dụ: 80000</p>
                        </div>

                        <!-- Thứ tự hiển thị -->
                        <div class="sm:col-span-3">
                            <label for="display_order" class="block text-sm font-medium text-gray-700">Thứ tự hiển thị</label>
                            <div class="mt-1">
                                <input type="number" name="display_order" id="display_order" min="0" value="{{ old('display_order', 0) }}" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Số nhỏ hơn sẽ hiển thị trước</p>
                        </div>

                        <!-- Ảnh gói dịch vụ -->
                        <div class="sm:col-span-6">
                            <label for="image" class="block text-sm font-medium text-gray-700">Ảnh gói dịch vụ</label>
                            <div class="mt-1 flex items-center">
                                <div class="w-full">
                                    <label class="block">
                                        <span class="sr-only">Chọn ảnh gói dịch vụ</span>
                                        <input type="file" name="image" id="image" accept="image/*" class="block w-full text-sm text-gray-500
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-md file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-blue-50 file:text-blue-700
                                            hover:file:bg-blue-100
                                        "/>
                                    </label>
                                </div>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Tải lên ảnh minh họa cho gói dịch vụ (JPG, PNG). Kích thước tối đa 2MB.</p>
                            <div id="image-preview" class="mt-2 hidden">
                                <img src="#" alt="Xem trước ảnh" class="h-40 w-auto object-contain border rounded-md">
                            </div>
                        </div>

                        <!-- Trạng thái -->
                        <div class="sm:col-span-3">
                            <label for="status" class="block text-sm font-medium text-gray-700">Trạng thái <span class="text-red-500">*</span></label>
                            <div class="mt-1">
                                <select name="status" id="status" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Hoạt động</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Tạm ngừng</option>
                                </select>
                            </div>
                        </div>

                        <!-- Mô tả -->
                        <div class="sm:col-span-6">
                            <label for="description" class="block text-sm font-medium text-gray-700">Mô tả gói dịch vụ</label>
                            <div class="mt-1">
                                <textarea name="description" id="description" rows="3" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('description') }}</textarea>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Mô tả ngắn gọn về gói dịch vụ này</p>
                        </div>
                    </div>
                </div>

                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Tạo gói dịch vụ
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('image-preview');
        const previewImg = imagePreview.querySelector('img');
        
        imageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                }
                
                reader.readAsDataURL(this.files[0]);
            } else {
                previewImg.src = '#';
                imagePreview.classList.add('hidden');
            }
        });
    });
</script>

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
@endsection 