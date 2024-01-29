<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'orderID',
        'productID',
        'price',
        'qty',
    ];

    // Model OrderItem
    public function order() {
        return $this->belongsTo(Order::class, 'orderID');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'productID', 'id');
    }
}
