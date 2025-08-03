<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 use App\Models\ProductQRCode;
use Illuminate\Support\Facades\Auth;
use App\Models\WalletTransaction;
use Illuminate\Support\Str;

class ScanController extends Controller
{

public function scan($code)
{
    $qr = ProductQRCode::where('code', $code)->first();

    if (!$qr) {
        return redirect()->back()->with('error', 'Invalid QR code.');
    }

    if ($qr->is_used) {
        return redirect()->back()->with('error', 'QR Code already used (Expired).');
    }

    $user = Auth::user();
    $product = $qr->product;
    $oldAmount = $user->wallet;

    $user->wallet += $qr->coin_reward;
    $user->save();

    $qr->update([
        'is_used' => true,
        'used_at' => now(),
        'used_by' => $user->id,
    ]);

  WalletTransaction::create([
    'user_id' => $user->id,
    'type' => 'credit',
    'amount' => $qr->coin_reward,
    'message' => 'Cashback via QR scan for: ' . $product->name,
    'transaction_id' => 'TXN' . now()->format('YmdHis') . strtoupper(Str::random(4)),
    'balance_before' => $oldAmount,
]);


    return redirect('/')->with('success', '🎉 Congrats! You received ' . $qr->coin_reward . ' coins for scanning "' . $product->name . '"!');
}


}
