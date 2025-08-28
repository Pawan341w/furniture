<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductList;
// use App\Models\ProductCatalog;

class ProductListController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = ProductList::latest()->paginate(9);
        return view('productlists.index', compact('products'));
    }
}