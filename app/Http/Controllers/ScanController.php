<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 use App\Models\ProductQRCode;
use Illuminate\Support\Facades\Auth;
class ScanController extends Controller
{


public function scan($code)
{
    $qr = ProductQRCode::where('code', $code)->first();

    if (!$qr) {
        return response()->json(['status' => false, 'message' => 'Invalid QR code'], 404);
    }

    if ($qr->is_used) {
        return response()->json(['status' => false, 'message' => 'QR Code already used (Expired)'], 410);
    }

    $user = Auth::user();
    $product = $qr->product;

    // Add coins
    $user->wallet += $product->coin_reward;
    $user->save();

    // Mark QR as used
    $qr->update([
        'is_used' => true,
        'used_at' => now(),
        'used_by' => $user->id,
    ]);

    return response()->json([
        'status' => true,
        'message' => 'Coins added!',
        'wallet' => $user->wallet,
        'coin_rewarded' => $product->coin_reward,
        'product_name' => $product->name
    ]);
}

}
