<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $fillable = [
        'transaction_id',
        'product_id',
        'product_code',
        'product_name',
        'price',
        'unit_price',
        'quantity',
        'subtotal'
    ];

    // Backwards-compatible accessor
    public function getUnitPriceAttribute()
    {
        return $this->attributes['price'] ?? null;
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
