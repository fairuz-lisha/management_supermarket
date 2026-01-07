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

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
