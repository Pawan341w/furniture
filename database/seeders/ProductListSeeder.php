<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductList;
use Illuminate\Support\Str;

class ProductListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
        ProductList::create([
            'name' => "Product $i",
            'description' => Str::random(80),
            'price' => rand(10, 100),
            'image' => null,
        ]);
        }
    }
}
