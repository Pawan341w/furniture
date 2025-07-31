<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductQRCode extends Model
{
    protected $table="product_qr_codes";
           protected $fillable = ['product_id', 'code', 'coin_reward', 'is_used', 'used_at', 'used_by','path'];

}
