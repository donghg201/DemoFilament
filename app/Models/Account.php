<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'Account_Id',
        'User_Id',
        'Avail_Balance',
        'Close_Date',
        'Last_Activity_Date',
        'Open_Date',
        'Pending_Balance',
        'Status',
        'Cust_Id',
        'Open_Branch_Id',
        'Open_Emp_Id',
        'Product_Id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function accTransactions()
    {
        return $this->hasMany(Acc_Transaction::class, 'Txn_Id');
    }

    public function customer()
    {
        return $this->hasMany(Customer::class, 'Cust_Id');
    }

    public function branch()
    {
        return $this->hasMany(Branch::class, 'Branch_Id');
    }

    public function employee()
    {
        return $this->hasMany(Employee::class, 'Emp_Id');
    }

    public function product()
    {
        return $this->hasMany(Product::class, 'Product_Id');
    }
}
