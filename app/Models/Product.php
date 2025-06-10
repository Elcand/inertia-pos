<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    protected $fillable = [
        'image',
        'barcode',
        'title',
        'description',
        'buy_price',
        'sell_price',
        'category_id',
        'stock'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected function image()
    {
        return Attribute::make(
            get: fn($value) => url('/storage/products/' . $value),
        );
    }
}
