<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'Product_Id',
        'Date_Offered',
        'Date_Retired',
        'Name',
        'Product_Type_Id',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'Product_Id');
    }

    public function productType()
    {
        return $this->hasMany(ProductType::class, 'Product_Type_Id');
    }
}
