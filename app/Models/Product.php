<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'supplier_id',
        'product_code',
        'product_name',
        'description',
        'purchase_price',
        'sale_price',
        'stock',
        'minimum_stock',
        'unit',
        'image',
        'status'
    ];

    public static function generateCode()
    {
        $lastProduct = self::orderBy('id', 'desc')->first();
        
        if (!$lastProduct) {
            return 'PRD-0001';
        }
        
        $lastNumber = intval(substr($lastProduct->product_code, 4));
        $newNumber = $lastNumber + 1;
        
        return 'PRD-' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
