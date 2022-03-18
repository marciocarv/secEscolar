<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bond_student extends Model
{
    use HasFactory;

    protected $fillable = [
        'order',
        'status',
        'entry_year',
        'exit_year'
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function box(){
        return $this->belongsTo(Box::class);
    }
}
