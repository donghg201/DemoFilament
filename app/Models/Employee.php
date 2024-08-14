<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'Emp_Id',
        'End_Date',
        'First_Name',
        'Last_Name',
        'Start_Date',
        'Title',
        'Assigned_Branch_Id',
        'Dept_Id',
        'Superior_Emp_Id',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'Open_Emp_Id');
    }

    public function accTransaction()
    {
        return $this->belongsTo(AccTransaction::class, 'Teller_Emp_Id');
    }

    public function department()
    {
        return $this->hasMany(Department::class, 'Dept_Id');
    }
}
