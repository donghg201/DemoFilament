<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'Branch_Id',
        'Address',
        'City',
        'Name',
        'State',
        'Zip_Code',
        'Emp_Id',
    ];

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'Open_Branch_Id');
    }

    public function accTransaction(): BelongsTo
    {
        return $this->belongsTo(AccTransaction::class, 'Execution_Branch_Id');
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'Emp_Id');
    }
}
