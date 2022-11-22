<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = [
        'product_name_eng',
        'product_code',
        'product_qty',
        'product_size_eng',
        'product_color_eng',
        'selling_price',
        'product_thambnail',
        'hot_deals',
        'featured',
        'special_offer',
        'special_deals',
        'status',
        'category_id',
        'subcategory_id',
        'brand_id',


    ];
    public function category()
    {
        return $this->hasMany(Category::class, 'category_id', 'id');
    }
    public function subcategory()
    {
        return $this->hasMany(SubCategory::class);
    }
    public function brand()
    {
        return $this->hasMany(Brand::class);
    }
}
