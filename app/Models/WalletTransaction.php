<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WalletTransaction extends Model
{
     protected $fillable = [
        'user_id', 'type', 'amount', 'message', 'utr', 'transaction_id', 'balance_before','bank_details','status'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    
    protected $casts = [
    'bank_details' => 'array',
];
}
