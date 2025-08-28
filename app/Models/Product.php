<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'category_id', 'name', 'description', 'price', 'dimensions',
        'weight', 'stock_quantity', 'is_available',
        'image', 'gallery_image', 'qr_code_path'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
