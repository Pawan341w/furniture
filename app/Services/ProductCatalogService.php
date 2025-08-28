<?php

namespace App\Services;

use App\Models\ProductCatalog;
use Illuminate\Support\Str;

class ProductCatalogService
{
    public function createProduct(array $data)
    {
        $slug = Str::slug($data['name']);
        return ProductCatalog::create(array_merge($data, ['slug' => $slug]));
    }

    public function updateProduct(ProductCatalog $product, array $data)
    {
        $slug = Str::slug($data['name']);
        $product->update(array_merge($data, ['slug' => $slug]));
        return $product;
    }
}
