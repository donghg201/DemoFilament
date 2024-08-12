<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Individual extends Model
{
    use HasFactory;

    protected $fillable = [
        'Birthday',
        'First_Name',
        'Last_Name',
        'Cust_Id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'Cust_Id');
    }
}
