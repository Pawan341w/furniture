<?php
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductQRCode;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use App\Models\GeneralSetting;

if (!function_exists('get_setting')) {
    function get_setting($key, $default = null)
    {
        // Check last cleared time
        $lastCleared = Cache::get('general_settings_last_cleared');
        $now = now();

        if (!$lastCleared || $now->diffInMinutes($lastCleared) >= 5) {
            Cache::forget('general_settings_all');
            Cache::put('general_settings_last_cleared', $now);
        }

        $settings = Cache::rememberForever('general_settings_all', function () {
            $allSettings = GeneralSetting::all();
            $result = [];
            foreach ($allSettings as $setting) {
                switch ($setting->type) {
                    case 'array':
                        $result[$setting->key] = json_decode($setting->value, true);
                        break;
                    case 'image':
                        $result[$setting->key] = Storage::url($setting->value);
                        break;
                    default:
                        $result[$setting->key] = $setting->value;
                        break;
                }
            }
            return $result;
        });

        return $settings[$key] ?? $default;
    }
}

if (!function_exists('clear_setting_cache')) {
    function clear_setting_cache()
    {
        Cache::forget('general_settings_all');
        Cache::forget('general_settings_last_cleared');
    }
}



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


if (!function_exists('format_inr')) {

function format_inr($amount) {
    if ($amount >= 10000000) {
        return '₹' . round($amount / 10000000, 2) . ' Cr';
    } elseif ($amount >= 100000) {
        return '₹' . round($amount / 100000, 2) . ' L';
    } elseif ($amount >= 1000) {
        return '₹' . round($amount / 1000, 2) . ' K';
    }
    return '₹' . $amount;
}
}
