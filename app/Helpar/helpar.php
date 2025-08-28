<?php
use App\Models\Product;
use App\Models\ProductQRCode;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use App\Models\GeneralSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\WalletTransaction;
use App\Models\BankAccount;
use App\Models\User;
use Illuminate\Support\Str;

if (!function_exists('WalletTransaction_help')) {
    function WalletTransaction_help($request, $type, $message, $status = 'pending',$userId) {
        // $userId = Auth::id();


        try {
             if($type=='debit')
             {
        $bankdetalis = BankAccount::find($request->bank_id);
            if (!$bankdetalis) {
                throw new \Exception('Bank details not found.');
            }
             }
            else
            {
               $bankdetalis=(object) $request->bank_details;
            }



            DB::transaction(function () use ($request, $userId, $bankdetalis, $type, $message, $status) {
                $user = User::where('id', $userId)->lockForUpdate()->first();

                $pending = WalletTransaction::where('user_id', $userId)
                    ->where('type', 'debit')->where('bank_details','wallet')
                    ->where('status', 'pending')
                    ->lockForUpdate()
                    ->exists();

           if($type=='debit')
             {
                if ($pending) {
                    throw new \Exception('You already have a pending withdrawal request.');
                }

                if ($user->wallet < $request->amount) {
                    throw new \Exception('Insufficient balance.');
                }
             }

                WalletTransaction::create([
                    'user_id'         => $userId,
                    'type'            => $type,
                    'amount'          => $request->amount,
                    'message'         => $message,
                    'utr'             => null,
                    'transaction_id'  => 'TXN' . now()->format('YmdHis') . strtoupper(Str::random(4)),
                    'balance_before'  => $user->wallet,
                    'status'          => $status,
                    'bank_details'    => [
                        "account_holder_name" => $bankdetalis->account_holder_name,
                        "bank_name"           => $bankdetalis->bank_name,
                        "account_number"      => $bankdetalis->account_number,
                        "ifsc_code"           => $bankdetalis->ifsc_code,
                                                "upi"           => $bankdetalis->upi

                    ],
                ]);
                if($type=='credit')
                {
                $user->wallet += $request->amount;


                }
                else
                {
                  $user->wallet -= $request->amount;

                }
                // $user->wallet -= $request->amount;
                $user->save();
            });

            return ['success' => true];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}




if (!function_exists('get_setting')) {
    function get_setting($key, $default = null)
    {
        // All settings ek hi cache me store karte hain
        $settings = Cache::remember('general_settings_all', 3600, function () {
            $allSettings = GeneralSetting::all();
            $result = [];
            foreach ($allSettings as $setting) {
                switch ($setting->type) {
                    case 'array':
                        $result[$setting->key] = json_decode($setting->value, true);
                        break;
                    case 'image':
                        $result[$setting->key] = $setting->value ? Storage::url($setting->value) : null;
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


if (!function_exists('num_format')) {

function num_format($amount) {
    if ($amount >= 10000000) {
        return  $amount / 10000000 . ' Cr';
    } elseif ($amount >= 100000) {
        return  $amount / 100000 . ' L';
    } elseif ($amount >= 1000) {
        return  $amount / 1000 . ' K';
    }
    return  $amount;
}
}
