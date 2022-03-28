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

    public function bond_employees(){
        return $this->hasMany(Bond_employee::class)->orderBy('order');
    }

    public function boxForType($type){
        return Box::where('type', $type)->orderBy('id')->get();
    }
}
