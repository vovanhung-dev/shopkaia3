@extends('layouts.admin')

@section('title', 'Chỉnh sửa dịch vụ cày thuê')

@section('content')
<div class="py-6">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-semibold text-gray-900">
                Chỉnh sửa dịch vụ cày thuê: {{ $service->name }}
            </h1>
            <div class="flex gap-2">
                <a href="{{ route('admin.boosting.index') }}"
                    class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Quay lại</span>
                </a>
                <a href="{{ route('boosting.show', $service->slug) }}" target="_blank"
                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    <span>Xem trang</span>
                </a>
            </div>
        </div>

        <!-- Thông báo lỗi -->
        @if($errors->any())
        <div class="mt-4 p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Form chỉnh sửa dịch vụ -->
        <div class="mt-6 bg-white shadow rounded-lg p-6">
            <form action="{{ route('admin.boosting.update', $service->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Thông tin chung</h3>

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                Tên dịch vụ <span class="text-red-600">*</span>
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name', $service->name) }}" required
                                class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <p class="text-xs text-gray-500 mt-1">Tên dịch vụ cày thuê, ví dụ: Cày Rank Đồng -> Bạch Kim</p>
                        </div>

                        <div class="mb-4">
                            <label for="game_id" class="block text-sm font-medium text-gray-700 mb-1">
                                Game <span class="text-red-600">*</span>
                            </label>
                            <select id="game_id" name="game_id" required
                                class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">-- Chọn game --</option>
                                @foreach($games as $game)
                                <option value="{{ $game->id }}" {{ old('game_id', $service->game_id) == $game->id ? 'selected' : '' }}>
                                    {{ $game->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="short_description" class="block text-sm font-medium text-gray-700 mb-1">
                                Mô tả ngắn
                            </label>
                            <textarea id="short_description" name="short_description" rows="2" 
                                class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('short_description', $service->short_description) }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Mô tả ngắn gọn sẽ hiển thị ở trang danh sách dịch vụ</p>
                            @error('short_description')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                                Mô tả <span class="text-red-600">*</span>
                            </label>
                            <textarea id="description" name="description" rows="4" required
                                class="ckeditor block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description', $service->description) }}</textarea>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">
                                    Giá (VNĐ) <span class="text-red-600">*</span>
                                </label>
                                <input type="number" id="price" name="price" value="{{ old('price', $service->price) }}" min="0" required
                                    class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="sale_price" class="block text-sm font-medium text-gray-700 mb-1">
                                    Giá khuyến mãi
                                </label>
                                <input type="number" id="sale_price" name="sale_price" value="{{ old('sale_price', $service->sale_price) }}" min="0"
                                    class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="estimated_days" class="block text-sm font-medium text-gray-700 mb-1">
                                Thời gian hoàn thành (ngày) <span class="text-red-600">*</span>
                            </label>
                            <input type="number" id="estimated_days" name="estimated_days" value="{{ old('estimated_days', $service->estimated_days) }}" min="1" required
                                class="block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-4">Thông tin bổ sung</h3>

                        <div class="mb-4">
                            <label for="requirements" class="block text-sm font-medium text-gray-700 mb-1">
                                Yêu cầu
                            </label>
                            <textarea id="requirements" name="requirements" rows="3"
                                class="ckeditor block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('requirements', $service->requirements) }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Các yêu cầu đối với tài khoản game của khách hàng</p>
                        </div>

                        <div class="mb-4">
                            <label for="includes" class="block text-sm font-medium text-gray-700 mb-1">
                                Bao gồm
                            </label>
                            <textarea id="includes" name="includes" rows="3"
                                class="ckeditor block w-full mt-1 text-sm border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('includes', $service->includes) }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Những gì khách hàng sẽ nhận được</p>
                        </div>

                        <div class="mb-4">
                            <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-1">
                                Hình ảnh thu nhỏ
                            </label>
                            @if($service->thumbnail)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $service->thumbnail) }}" alt="{{ $service->name }}" class="h-32 w-auto rounded">
                                <p class="text-xs text-gray-500 mt-1">Hình ảnh hiện tại</p>
                            </div>
                            @endif
                            <input type="file" id="thumbnail" name="thumbnail" accept="image/*"
                                class="block w-full mt-1 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="text-xs text-gray-500 mt-1">Để trống nếu muốn giữ hình ảnh hiện tại (Kích thước khuyến nghị: 600x400px)</p>
                        </div>

                        <div class="mb-4">
                            <label for="banner" class="block text-sm font-medium text-gray-700 mb-1">
                                Hình ảnh banner
                            </label>
                            @if($service->banner)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $service->banner) }}" alt="{{ $service->name }}" class="h-32 w-auto rounded">
                                <p class="text-xs text-gray-500 mt-1">Hình ảnh hiện tại</p>
                            </div>
                            @endif
                            <input type="file" id="banner" name="banner" accept="image/*"
                                class="block w-full mt-1 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="text-xs text-gray-500 mt-1">Để trống nếu muốn giữ hình ảnh hiện tại (Kích thước khuyến nghị: 1200x400px)</p>
                        </div>

                        <div class="mb-4">
                            <label for="is_active" class="inline-flex items-center">
                                <input type="checkbox" id="is_active" name="is_active" value="1" 
                                    {{ old('is_active', $service->is_active) ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Kích hoạt dịch vụ</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end mt-6 space-x-3">
                    <a href="{{ route('admin.boosting.index') }}"
                        class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-100">
                        Hủy bỏ
                    </a>
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Cập nhật dịch vụ
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
                .catch(error => {
                    console.error(`Lỗi khi khởi tạo CKEditor cho ${id}:`, error);
                });
        });
    });
</script>
@endpush 