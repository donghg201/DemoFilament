<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'Txn_Id',
        'Amount',
        'Funds_Avail_Date',
        'Txn_Date',
        'Txn_Type_Id',
        'Account_Id',
        'Execution_Branch_Id',
        'Teller_Emp_Id',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'Account_Id');
    }

    public function branch()
    {
        return $this->hasMany(Branch::class, 'Branch_Id');
    }

    public function employee()
    {
        return $this->hasMany(Employee::class, 'Emp_Id');
    }
}
