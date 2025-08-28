<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductQRCode;
use Illuminate\Http\Request;

class ProductQRCodeController extends Controller
{

    public function show($productId)
    {
        $product = Product::findOrFail($productId);
        $qrCodes = ProductQRCode::where('product_id', $productId)->with('usedUser')->orderby('id','desc')->get();

        return view('admin.products.qr_list', compact('product', 'qrCodes'));
    }

    public function generate(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'count' => 'required|integer|min:1|max:20',
            'coin_rewards' => 'nullable|string',
        ]);

        $productId = $request->product_id;
        $count = (int) $request->input('count', 10);
        $coinRewards = explode(',', $request->input('coin_rewards', '0'));
        $coinRewards = array_map('intval', array_map('trim', $coinRewards));

        // Call your helper function to generate QR codes
        $result = generateProductQRCodes($productId, $count, $coinRewards);

        return response()->json([
            'status' => true,
            'message' => 'QR Codes generated successfully!',
            'data' => $result
        ]);
    }
}
