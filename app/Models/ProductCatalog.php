<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCatalog extends Model
{
    use HasFactory;

    protected $table = 'product_catalog'; // Custom table name

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'discount_price',
        'stock',
        'image',
        'gallery',
        'category_id',
        'status'
    ];

    protected $casts = [
        'gallery' => 'array', // JSON array of images
        'status' => 'boolean'
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
