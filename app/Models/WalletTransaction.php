<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
     protected $fillable = [
        'user_id', 'type', 'amount', 'message', 'utr', 'transaction_id', 'balance_after'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
