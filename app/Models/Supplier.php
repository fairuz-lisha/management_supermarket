<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'supplier_code',
        'supplier_name',
        'contact_name',
        'no_telephone',
        'email',
        'address',
        'city',
        'status'
    ];

    // Generate kode supplier otomatis
    public static function generateCode()
    {
        $lastSupplier = self::orderBy('id', 'desc')->first();
        
        if (!$lastSupplier) {
            return 'SUP-001';
        }
        
        $lastNumber = intval(substr($lastSupplier->supplier_code, 4));
        $newNumber = $lastNumber + 1;
        
        return 'SUP-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}