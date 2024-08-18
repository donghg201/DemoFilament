<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'Dept_Id',
        'Name',
        'Emp_Id',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'Emp_Id');
    }
}
