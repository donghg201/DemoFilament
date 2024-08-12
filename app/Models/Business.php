<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'Incorp_Date',
        'Name',
        'State_Id',
        'Cust_Id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'Cust_Id');
    }
}
