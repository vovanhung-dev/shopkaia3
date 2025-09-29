<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TopUpCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class TopUpCategoryController extends Controller
{
    /**
     * Hiển thị danh sách danh mục
     */
    public function index()
    {
        $categories = TopUpCategory::orderBy('display_order')
            ->orderBy('name')
            ->paginate(20);
            
        return view('admin.topup_categories.index', compact('categories'));
    }

    /**
     * Hiển thị form tạo danh mục mới
     */
    public function create()
    {
        return view('admin.topup_categories.create');
    }

    /**
     * Lưu danh mục mới vào database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'display_order' => 'integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
        ]);
        
        // Tạo slug từ tên
        $validated['slug'] = Str::slug($validated['name']);
        
        // Xử lý hình ảnh nếu có
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/topup_categories', $filename);
            $validated['image'] = 'topup_categories/' . $filename;
        }
        
        // Tạo danh mục mới
        TopUpCategory::create($validated);
        
        return redirect()->route('admin.topup_categories.index')
            ->with('success', 'Đã tạo danh mục dịch vụ nạp thuê thành công');
    }

    /**
     * Hiển thị chi tiết danh mục
     */
    public function show($id)
    {
        $category = TopUpCategory::findOrFail($id);
        
        return view('admin.topup_categories.show', compact('category'));
    }

    /**
     * Hiển thị form chỉnh sửa danh mục
     */
    public function edit($id)
    {
        $category = TopUpCategory::findOrFail($id);
        
        return view('admin.topup_categories.edit', compact('category'));
    }

    /**
     * Cập nhật danh mục vào database
     */
    public function update(Request $request, $id)
    {
        $category = TopUpCategory::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'display_order' => 'integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
        ]);
        
        // Cập nhật slug từ tên nếu slug chưa tồn tại
        if (empty($category->slug)) {
            $validated['slug'] = Str::slug($validated['name']);
        }
        
        // Xử lý hình ảnh nếu có
        if ($request->hasFile('image')) {
            // Xóa hình ảnh cũ nếu có
            if ($category->image && Storage::exists('public/' . $category->image)) {
                Storage::delete('public/' . $category->image);
            }
            
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/topup_categories', $filename);
            $validated['image'] = 'topup_categories/' . $filename;
        }
        
        // Cập nhật danh mục
        $category->update($validated);
        
        return redirect()->route('admin.topup_categories.index')
            ->with('success', 'Đã cập nhật danh mục dịch vụ nạp thuê thành công');
    }

    /**
     * Xóa danh mục khỏi database
     */
    public function destroy($id)
    {
        $category = TopUpCategory::findOrFail($id);
        
        // Kiểm tra xem có dịch vụ nào thuộc danh mục này không
        if ($category->topUpServices()->count() > 0) {
            return redirect()->route('admin.topup_categories.index')
                ->with('error', 'Không thể xóa danh mục này vì có dịch vụ đang sử dụng');
        }
        
        // Xóa hình ảnh nếu có
        if ($category->image && Storage::exists('public/' . $category->image)) {
            Storage::delete('public/' . $category->image);
        }
        
        // Xóa danh mục
        $category->delete();
        
        return redirect()->route('admin.topup_categories.index')
            ->with('success', 'Đã xóa danh mục dịch vụ nạp thuê thành công');
    }
} 