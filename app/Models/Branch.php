<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'Open_Branch_Id');
    }
}
