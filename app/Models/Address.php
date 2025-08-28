<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address_line1',
        'address_line2',
        'landmark',
        'city',
        'state',
        'country',
        'pincode',
        'address_type',
        'is_default'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
