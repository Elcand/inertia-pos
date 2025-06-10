<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'image',
        'name',
        'description'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    protected function image()
    {
        return Attribute::make(
            get: fn($value) => url('/storage/categoties/' . $value),
        );
    }
}
