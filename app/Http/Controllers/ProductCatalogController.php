<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Services\ProductCatalogService;
use App\Jobs\ProcessProductCatalog;
use App\Models\ProductCatalog;
use App\Models\Category;
use App\Models\Address;
use Illuminate\Support\Facades\Storage;

class ProductCatalogController extends Controller
{
    protected $service;

    public function __construct(ProductCatalogService $service)
    {
        $this->service = $service;
    }

    public function view()
    {
        $categories = Category::all();
        return view('admin.product_catalog.index', compact('categories'));
    }
    
    
    
    


    public function index(Request $request)
    {
        $query = ProductCatalog::query()->with('category');
    
        if($request->name) {
            $query->where('name', 'like', "%{$request->name}%");
        }
        if($request->category) {
            $query->where('category_id', $request->category);
        }
        if($request->status !== null && $request->status !== '') {
            $query->where('status', $request->status);
        }
    
        return response()->json($query->latest()->get());
    }

    public function updateStatus(Request $request, $id)
    {
        $product = ProductCatalog::findOrFail($id);
        $product->status = $request->status;
        $product->save();
    
        return response()->json(['message' => 'Status updated']);
    }


public function store(Request $request)
{
    try {
        $data = $request->validate([
            'name'           => 'required|string',
            'description'    => 'nullable|string',
            'price'          => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'stock'          => 'nullable|numeric',
            'category_id'    => 'required|exists:categories,id',
            'status'         => 'required|boolean',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    'gallery'   => 'nullable|array',
    'gallery.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $product = $this->service->createProduct($data);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->update(['image' => $imagePath]);
        }

        if ($request->hasFile('gallery')) {
            $galleryPaths = [];
            foreach ($request->file('gallery') as $g) {
                $galleryPaths[] = $g->store('products/gallery', 'public');
            }

            $product->update(['gallery' => json_encode($galleryPaths)]);

            
        }

        return response()->json([
            'success' => true,
            'message' => 'Product created successfully',
            'product' => $product
        ], 201);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to create product',
            'error'   => $e->getMessage()
        ], 500);
    }
}


    public function edit($id)
    {
        $product = ProductCatalog::with('category')->findOrFail($id);
        return response()->json($product);
    }
    

    public function update(Request $request, $id)
    {
        $product = ProductCatalog::findOrFail($id);

        $data = $request->validate([
            'name'=>'required|string',
            'description'=>'nullable|string',
            'price'=>'required|numeric',
            'discount_price'=>'nullable|numeric',
            'stock'=>'nullable|numeric',
            'category_id'=>'required|exists:categories,id',
            'status'=>'required|boolean',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    'gallery'   => 'nullable|array',
    'gallery.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $product = $this->service->updateProduct($product, $data);

       if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('products','public');
        }else $imagePath = null;

       if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->update(['image' => $imagePath]);
        }

        if ($request->hasFile('gallery')) {
            $galleryPaths = [];
            foreach ($request->file('gallery') as $g) {
                $galleryPaths[] = $g->store('products/gallery', 'public');
            }

            $product->update(['gallery' => json_encode($galleryPaths)]);

            
        }


        return response()->json(['message'=>'Product updated successfully', 'product'=>$product]);
    }

    public function destroy($id)
    {
        $product = ProductCatalog::findOrFail($id);

      if ($product->image) {
    Storage::disk('public')->delete($product->image);
}

if (!empty($product->gallery) && is_array($product->gallery)) {
    foreach ($product->gallery as $g) {
        Storage::disk('public')->delete($g);
    }
}
        $product->delete();

        return response()->json(['message'=>'Product deleted successfully']);
    }
    
    
    
    public function show_user_product(Request $request)
{
    $user = Auth::user();

    $query = ProductCatalog::where('status', 1)->orderBy('name', 'asc');

    if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
    }

    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    if ($request->filled('min_price')) {
        $query->where('price', '>=', $request->min_price);
    }

    if ($request->filled('max_price')) {
        $query->where('price', '<=', $request->max_price);
    }

    $products = $query->with('category')->paginate(9);

    $addresses = Address::where('user_id', $user->id)->get();
    $categories = Category::all();

    if ($request->ajax()) {
        $html = '';

        if ($products->count() > 0) {
            $html .= '<div class="row g-4">';
            foreach ($products as $productItem) {
                $discount = $productItem->discount_price ?? 0;
                $finalPrice = max(0, $productItem->price - $discount);

                $imageUrl = $productItem->image ? asset('storage/' . $productItem->image) : asset('assets/images/placeholder.png');

                $html .= '
                <div class="col-md-4 col-sm-6">
                    <div class="card product-card h-100">
                        <img src="' . $imageUrl . '" class="card-img-top product-img" alt="' . e($productItem->name) . '">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-truncate" title="' . e($productItem->name) . '">' . e($productItem->name) . '</h5>
                            <p class="card-text product-description">' . \Illuminate\Support\Str::limit(e($productItem->description), 100) . '</p>
                            <div class="price-tag mb-2">
                                <img src="' . asset('assets/images/icons/coin.png') . '" alt="coin" width="18" height="18" style="margin-bottom: 3px;">';

                if ($discount > 0) {
                    $html .= '
                                <span class="fw-bold text-muted">' . number_format($finalPrice, 0) . '</span>
                                <span class="text-danger text-decoration-line-through ms-2">' . number_format($productItem->price, 0) . '</span>
                                <span class="badge bg-success ms-2">' . number_format($discount, 0) . ' OFF</span>';
                } else {
                    $html .= '<span class="fw-bold text-dark">' . number_format($productItem->price, 0) . '</span>';
                }

                $html .= '
                            </div>
                            <button class="btn btn-success purchase-btn mt-auto"
                                data-bs-toggle="modal"
                                data-bs-target="#purchaseModal"
                                data-product-id="' . $productItem->id . '"
                                data-product-name="' . e($productItem->name) . '">
                                Purchase
                            </button>
                        </div>
                    </div>
                </div>';
            }
            $html .= '</div>';

            // Pagination links with appended query parameters
            $pagination = $products->appends(request()->query())->links('pagination::bootstrap-4')->toHtml();

            $html .= '<div class="d-flex justify-content-center mt-4">' . $pagination . '</div>';
        } else {
            $html = '<div class="col-12"><p class="text-center text-muted fs-5">No products available.</p></div>';
        }

        return response()->json(['html' => $html]);
    }

    return view('productlists.index', compact('products', 'addresses', 'categories'));
}




   
}
