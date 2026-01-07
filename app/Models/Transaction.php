<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'invoice_number',
        'transaction_date',
        'customer_name',
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

    public static function generateCode()
    {
        return 'TRX' . date('YmdHis') . rand(100, 999);
    }
}
