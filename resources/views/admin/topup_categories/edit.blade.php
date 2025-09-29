@extends('layouts.admin')

@section('title', 'Chỉnh sửa danh mục nạp hộ')

@section('content')
<div class="py-6">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900">Chỉnh sửa danh mục nạp hộ</h1>
            <a href="{{ route('admin.topup_categories.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Quay lại</span>
            </a>
        </div>

        <!-- Form danh mục -->
        <div class="mt-6 bg-white shadow rounded-lg p-6">
            @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
                <p class="font-bold">Lỗi!</p>
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
                
            <form action="{{ route('admin.topup_categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Thông tin chung</h3>
                    
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                Tên danh mục <span class="text-red-600">*</span>
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}"
                                placeholder="Ví dụ: Nạp thẻ game, Nạp xu"
                                class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">
                                Slug
                            </label>
                            <input type="text" id="slug" name="slug" value="{{ old('slug', $category->slug) }}"
                                placeholder="Ví dụ: nap-the-game"
                                class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <p class="text-xs text-gray-500 mt-1">Tự động tạo từ tên danh mục</p>
                            @error('slug')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="display_order" class="block text-sm font-medium text-gray-700 mb-1">
                                Thứ tự hiển thị
                            </label>
                            <input type="number" id="display_order" name="display_order" value="{{ old('display_order', $category->display_order) }}" min="0"
                                placeholder="Ví dụ: 1"
                                class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <p class="text-xs text-gray-500 mt-1">Số nhỏ hơn sẽ hiển thị trước</p>
                            @error('display_order')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="is_active" class="inline-flex items-center">
                                <input type="checkbox" id="is_active" name="is_active" value="1" 
                                    {{ old('is_active', $category->is_active) ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Hiển thị danh mục</span>
                            </label>
                        </div>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Hình ảnh và mô tả</h3>
                    
                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">
                                Hình ảnh danh mục
                            </label>
                            <input type="file" id="image" name="image" accept="image/*"
                                class="block w-full mt-1 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="text-xs text-gray-500 mt-1">Hình ảnh có kích thước tối đa 2MB, định dạng: jpg, jpeg, png, gif</p>
                            @error('image')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            
                            @if($category->image)
                            <div class="mt-3">
                                <span class="block text-sm font-medium text-gray-700 mb-1">Hình ảnh hiện tại:</span>
                                <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="h-24 w-auto object-cover rounded-md">
                            </div>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label for="short_description" class="block text-sm font-medium text-gray-700 mb-1">
                                Mô tả ngắn
                            </label>
                            <textarea id="short_description" name="short_description" rows="2"
                                placeholder="Mô tả ngắn gọn về danh mục..."
                                class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('short_description', $category->short_description) }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Mô tả ngắn gọn sẽ hiển thị ở trang danh sách</p>
                            @error('short_description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                                Mô tả danh mục
                            </label>
                            <textarea id="description" name="description" rows="4"
                                class="ckeditor block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description', $category->description) }}</textarea>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <a href="{{ route('admin.topup_categories.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 mr-2">
                        Hủy
                    </a>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Cập nhật danh mục
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
            
        // Tạo slug từ tên
        document.getElementById('name').addEventListener('keyup', function() {
            const name = this.value;
            const slug = slugify(name);
            document.getElementById('slug').value = slug;
        });

        function slugify(text) {
            return text.toString().toLowerCase()
                .replace(/\s+/g, '-')           // Replace spaces with -
                .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
                .replace(/\-\-+/g, '-')         // Replace multiple - with single -
                .replace(/^-+/, '')             // Trim - from start of text
                .replace(/-+$/, '');            // Trim - from end of text
        }
    });
</script>
@endpush 