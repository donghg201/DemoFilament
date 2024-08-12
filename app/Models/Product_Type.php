<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'Product_Type_Id',
        'Name',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'Product_Type_Id');
    }
}
