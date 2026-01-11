<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category_code', 
        'category_name', 
        'description'
    ];

    public static function generateCode()
    {
        $lastCategory = self::orderBy('id', 'desc')->first();
        
        if (!$lastCategory) {
            return 'CAT-001';
        }
        
        $lastNumber = intval(substr($lastCategory->category_code, 4));
        $newNumber = $lastNumber + 1;
        
        return 'CAT-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
