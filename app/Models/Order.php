<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'reference',
        'total_amount',
        'status',
        'name',
        'shipping_address',
        'city',
        'phone'
    ];
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


    // Add these fields to allow the Order::create() call in your Controller
