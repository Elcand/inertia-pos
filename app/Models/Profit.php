<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Profit extends Model
{
    protected $fillable = [
        'transaction_id',
        'total'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->format('d-M-Y H:i:s'),
        );
    }
}
