<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $guarded = [];


    protected $fillable = [
        'category_id',
        'subcategory_name_eng',
        'gender',

    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function product()
    {
        return $this->hasMany(product::class);
    }
    public function undersub()
    {
        return $this->hasMany(UnderSubCategory::class, 'sub_category_id');
    }
}
