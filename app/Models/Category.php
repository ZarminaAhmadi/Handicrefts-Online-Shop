<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name_eng',
        'category_icon',
    ];
    public function subcatagory()
    {
        return $this->hasMany(SubCategory::class, 'category_id');
    }
    public function product()
    {
        return $this->belongsTo(product::class);
    }
}
