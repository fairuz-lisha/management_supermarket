<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'invoice_number',
        'customer_name',
        'customer_address',
        'customer_phone',
        'subtotal',
        'discount_persent',
        'discount_amount',
        'total_payment',
        'amount_received',
        'change',
        'payment_method',
        'status',
        'notes',
    ];

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    // Backwards-compatible accessors for legacy view fields
    public function getTotalAttribute()
    {
        return $this->attributes['total_payment'] ?? 0;
    }

    public function getTransactionCodeAttribute()
    {
        return $this->attributes['invoice_number'] ?? ($this->attributes['id'] ?? null);
    }

    public static function generateCode()
    {
        return 'TRX' . date('YmdHis') . rand(100, 999);
    }
}
