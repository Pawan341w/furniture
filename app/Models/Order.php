<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address_id',
        'order_number',
        'product_name',
        'product_amount',
        'shipping_charge',
        'total_amount',
        'payment_method',
        'payment_status',
        'order_status',
        'address',
       'txn_id',
        'ordered_at',
        'delivered_at'
    ];

    protected $casts = [
        'ordered_at' => 'datetime',
        'delivered_at' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
