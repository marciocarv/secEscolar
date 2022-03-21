<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'type',
    ];

    public function listBoxes(){
        return Box::paginate(50);
    }

    public function bond_students(){
        return $this->hasMany(Bond_student::class)->orderBy('order');
    }
}
