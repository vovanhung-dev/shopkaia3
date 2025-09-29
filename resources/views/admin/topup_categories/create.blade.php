@extends('layouts.admin')

@section('title', 'Thêm danh mục nạp hộ')

@section('content')
<div class="py-6">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900">Thêm danh mục nạp hộ</h1>
            <a href="{{ route('admin.topup_categories.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">
                Quay lại danh sách
            </a>
        </div>

        <!-- Form danh mục -->
        <div class="mt-6 bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <ul class="list-disc ml-5 text-sm text-red-700">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
                
                <form action="{{ route('admin.topup_categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                Tên danh mục <span class="text-red-500">*</span>
                            </label>
                            <div class="mt-1">
                                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Nhập tên danh mục, ví dụ: Kim Cương, Vàng, Xu"
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md @error('name') border-red-500 @enderror" required>
                            </div>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="slug" class="block text-sm font-medium text-gray-700">
                                Slug
                            </label>
                            <div class="mt-1">
                                <input type="text" id="slug" name="slug" value="{{ old('slug') }}" placeholder="slug-tu-dong-tao-tu-ten-danh-muc"
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md @error('slug') border-red-500 @enderror">
                            </div>
                            @error('slug')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="display_order" class="block text-sm font-medium text-gray-700">
                                Thứ tự hiển thị
                            </label>
                            <div class="mt-1">
                                <input type="number" id="display_order" name="display_order" value="{{ old('display_order', 0) }}" placeholder="0" min="0"
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md @error('display_order') border-red-500 @enderror">
                                <p class="mt-1 text-xs text-gray-500">Số nhỏ hơn sẽ hiển thị trước</p>
                            </div>
                            @error('display_order')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <div class="mt-6">
                                <label for="is_active" class="inline-flex items-center">
                                    <input type="checkbox" id="is_active" name="is_active" value="1" 
                                        {{ old('is_active', 1) ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Hiển thị danh mục</span>
                                </label>
                            </div>
                        </div>

                        <div class="sm:col-span-6">
                            <label for="image" class="block text-sm font-medium text-gray-700">
                                Hình ảnh danh mục
                            </label>
                            <div class="mt-1">
                                <input type="file" id="image" name="image" accept="image/*"
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 @error('image') border-red-500 @enderror">
                                <p class="mt-1 text-xs text-gray-500">Hình ảnh có kích thước tối đa 2MB, định dạng: jpg, jpeg, png, gif</p>
                            </div>
                            @error('image')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-6">
                            <label for="short_description" class="block text-sm font-medium text-gray-700">
                                Mô tả ngắn
                            </label>
                            <div class="mt-1">
                                <textarea id="short_description" name="short_description" rows="2" placeholder="Nhập mô tả ngắn gọn về danh mục này"
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md @error('short_description') border-red-500 @enderror">{{ old('short_description') }}</textarea>
                                <p class="mt-1 text-xs text-gray-500">Mô tả ngắn gọn sẽ hiển thị ở trang danh sách</p>
                            </div>
                            @error('short_description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-6">
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                Mô tả danh mục
                            </label>
                            <div class="mt-1">
                                <textarea id="description" name="description" rows="4" placeholder="Nhập mô tả chi tiết về danh mục nạp hộ"
                                    class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                            </div>
                            @error('description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('admin.topup_categories.index') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Hủy
                        </a>
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Lưu danh mục
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
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
</script>
@endpush 