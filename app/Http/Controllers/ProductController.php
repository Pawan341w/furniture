<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        $categories = Category::all();
        return view('admin.products.index', compact('products', 'categories'));
    }

    public  function qr_mang()
    {
                $products = Product::get();
                        return view('admin.products.qr_mang', compact('products'));


    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'dimensions' => 'nullable|string',
            'weight' => 'nullable|numeric',
            'stock_quantity' => 'nullable|integer',
            'main_image' => 'nullable|image',
            'gallery_image' => 'nullable|image',
        ]);

        if ($request->hasFile('main_image')) {
            $data['image'] = $request->file('main_image')->store('products/main', 'public');
        }

        // if ($request->hasFile('gallery_image')) {
        //     $data['gallery_image'] = $request->file('gallery_image')->store('products/gallery', 'public');
        // }

        $product = Product::create($data);

        return response()->json(['message' => 'Product added successfully', 'data' => $product]);
    }

    public function show(Product $product)
    {
        return response()->json($product);
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'dimensions' => 'nullable|string',
            'weight' => 'nullable|numeric',
            'stock_quantity' => 'nullable|integer',
            'main_image' => 'nullable|image',
            'gallery_image' => 'nullable|image',
        ]);

        if ($request->hasFile('main_image')) {
            if ($product->main_image) Storage::disk('public')->delete($product->image);
            $data['image'] = $request->file('main_image')->store('products/main', 'public');
        }

        // if ($request->hasFile('gallery_image')) {
        //     if ($product->gallery_image) Storage::disk('public')->delete($product->gallery_image);
        //     $data['gallery_image'] = $request->file('gallery_image')->store('products/gallery', 'public');
        // }

        $product->update($data);

        return response()->json(['message' => 'Product updated successfully']);
    }

    public function destroy(Product $product)
    {
        if ($product->main_image) Storage::disk('public')->delete($product->main_image);
        if ($product->gallery_image) Storage::disk('public')->delete($product->gallery_image);

        $product->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
