<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\TopUpCategory;
use App\Models\TopUpService;
use Illuminate\Http\Request;

class TopUpCategoryController extends Controller
{
    /**
     * Hiển thị danh sách các danh mục dịch vụ nạp thuê
     */
    public function index()
    {
        $categories = TopUpCategory::where('is_active', true)
            ->orderBy('display_order')
            ->orderBy('name')
            ->get();
        
        return view('topup.categories.index', compact('categories'));
    }
    
    /**
     * Hiển thị danh sách dịch vụ nạp thuê theo danh mục
     */
    public function show($slug)
    {
        $category = TopUpCategory::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        
        $query = TopUpService::where('category_id', $category->id)
            ->where('is_active', true);
        
        // Sắp xếp mặc định theo mới nhất
        $query->orderBy('created_at', 'desc');
        
        $services = $query->paginate(12);
        
        // Lấy list game để lọc
        $games = Game::whereHas('topUpServices', function($q) use ($category) {
            $q->where('category_id', $category->id)
                ->where('is_active', true);
        })->get();
        
        return view('topup.categories.show', compact('category', 'services', 'games'));
    }
    
    /**
     * Lọc dịch vụ nạp thuê theo danh mục và các tiêu chí khác
     */
    public function filter(Request $request, $slug)
    {
        $category = TopUpCategory::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        
        $query = TopUpService::where('category_id', $category->id)
            ->where('is_active', true);
        
        // Lọc theo trò chơi
        if ($request->has('game_id') && $request->game_id) {
            $query->where('game_id', $request->game_id);
        }
        
        // Lọc theo khoảng giá
        if ($request->has('price_min') && $request->price_min) {
            $query->where(function($q) use ($request) {
                $q->where('price', '>=', $request->price_min)
                    ->orWhere('sale_price', '>=', $request->price_min);
            });
        }
        
        if ($request->has('price_max') && $request->price_max) {
            $query->where(function($q) use ($request) {
                $q->where('price', '<=', $request->price_max)
                    ->orWhere('sale_price', '<=', $request->price_max);
            });
        }
        
        // Sắp xếp
        $sortBy = $request->input('sort_by', 'latest');
        switch ($sortBy) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }
        
        $services = $query->paginate(12);
        
        // Lấy list game để lọc
        $games = Game::whereHas('topUpServices', function($q) use ($category) {
            $q->where('category_id', $category->id)
                ->where('is_active', true);
        })->get();
        
        return view('topup.categories.show', compact('category', 'services', 'games'));
    }

    /**
     * Tải thêm dịch vụ khi cuộn trang
     */
    public function loadMore(Request $request, $slug)
    {
        $page = $request->input('page', 1);
        
        $category = TopUpCategory::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        
        $query = TopUpService::where('category_id', $category->id)
            ->where('is_active', true);
        
        // Sắp xếp mặc định theo mới nhất
        $query->orderBy('created_at', 'desc');
        
        $services = $query->paginate(12, ['*'], 'page', $page);
        
        if ($request->ajax()) {
            return response()->json([
                'html' => view('topup.categories._services', compact('services'))->render(),
                'next_page' => $services->hasMorePages() ? $page + 1 : null
            ]);
        }
        
        return view('topup.categories.show', compact('category', 'services'));
    }
} 