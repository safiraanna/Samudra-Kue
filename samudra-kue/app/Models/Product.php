<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'price_unit',
        'price_box_unit',
        'unit_per_box',
        'stocks',
        'description', 
    ];

    public function images() {
        return $this->hasMany(ProductImage::class, 'productID');
    }

    public function scopeFilter($query, array $filter) {

        $query->when($filter['search'] ??  false, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('product_name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        });
    }
}
