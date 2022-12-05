<?php

namespace App\Models;

use GuzzleHttp\Handler\Proxy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class slidshow extends Model
{
    use HasFactory;
    protected $fillable = [

        'slidshow_img',
        'title',
        'description',
        'status',
    ];

    public function product()
    {
        return $this->hasMany(product::class, 'product_id');
    }
}
