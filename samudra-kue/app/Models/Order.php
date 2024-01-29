<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'userID',
        'addressID',
        // 'order_date',
        'shipping_cost',
        'payment_total',
        'payment_method',
        'payment_status',
        'order_status',
        'add_notes',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'userID', 'id');
    }

    public function address() {
        return $this->belongsTo(ShippingAddress::class, 'addressID');
    }

    public function orderItems() {
        return $this->hasMany(OrderItem::class, 'orderID', 'id');
    }
}
