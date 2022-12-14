<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand_name_eng',
        'brand_image',
    ];
    public function product()
    {
        return $this->belongsTo(product::class);
    }
}
