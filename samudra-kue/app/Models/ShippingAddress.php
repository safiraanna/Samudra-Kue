<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'userID',
        'province',
        'city',
        'kecamatan',
        'kelurahan',
        'address',
        'postal_code',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'userID', 'id');
    }
}
