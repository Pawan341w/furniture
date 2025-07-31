<?php
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductQRCode;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

if (!function_exists('generateProductQRCodes')) {
    function generateProductQRCodes($productId, $count = 10, $coinRewards = [])
    {
        $product = Product::findOrFail($productId);

        // Sanitize and re-index rewards array
        $coinRewards = array_values(array_filter($coinRewards, fn($v) => $v !== null));
        $lastReward = end($coinRewards); // default if not enough rewards

        for ($i = 0; $i < $count; $i++) {
            $uniqueCode = Str::uuid()->toString();
            $qrPath = public_path("qr_codes/{$uniqueCode}.png");

            if (!file_exists(public_path('qr_codes'))) {
                mkdir(public_path('qr_codes'), 0755, true);
            }

            QrCode::format('png')
                ->size(300)
                ->generate(route('product.qr.scan', ['code' => $uniqueCode]), $qrPath);

            ProductQRCode::create([
                'product_id'   => $product->id,
                'code'         => $uniqueCode,
                'path'         => "qr_codes/{$uniqueCode}.png",
                'coin_reward'  => $coinRewards[$i] ?? $lastReward, // fallback to last if missing
            ]);
        }

        return response()->json(['message' => "$count QR codes generated successfully."]);
    }
}
