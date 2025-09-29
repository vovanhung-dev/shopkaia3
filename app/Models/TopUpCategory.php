<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopUpCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'image',
        'is_active',
        'display_order',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    /**
     * Mối quan hệ với dịch vụ nạp thuê
     */
    public function topUpServices()
    {
        return $this->hasMany(TopUpService::class, 'category_id');
    }

    /**
     * Lấy số lượng dịch vụ có sẵn trong danh mục
     */
    public function availableServices()
    {
        return $this->topUpServices()->where('is_active', true);
    }

    /**
     * Định nghĩa các thuộc tính phụ
     */
    public function getUrlAttribute()
    {
        return route('topup.category', $this->slug);
    }
} 