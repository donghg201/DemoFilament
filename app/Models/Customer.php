<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'Cust_Id',
        'Address',
        'City',
        'Cust_Type_Id',
        'Fed_Id',
        'Postal_Id',
        'State',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'Account_Id');
    }

    public function business()
    {
        return $this->hasMany(Business::class, 'Cust_Id');
    }
    public function individual()

    {
        return $this->hasMany(Individual::class, 'Cust_Id');
    }
}
