<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        // 'Assigned_Branch_Id',
        // 'Dept_Id',
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

    public function department(): HasMany
    {
        return $this->hasMany(Department::class, 'Emp_Id');
    }

    public function branch(): HasMany
    {
        return $this->hasMany(Branch::class, 'Emp_Id');
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
