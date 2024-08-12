<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'Dept_Id',
        'Name',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'Dept_Id');
    }
}
