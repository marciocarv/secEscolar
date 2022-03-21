<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bond_employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'order',
        'status',
        'entry_year',
        'exit_year'
    ];
}
