<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'father',
        'mother',
        'naturalness',
        'marital_status',
        'sex',
        'color',
        'phone',
        'certificate_type',
        'certificate_term',
        'certificate_book',
        'certificate_sheet',
        'adress',
        'cep',
        'rg',
        'emission_org',
        'cpf',
        'bank_name',
        'bank_agency',
        'bank_number',
        'schooling',
        'course_name',
        'course_status',
        'name_college',
        'conclusion'
    ];

    protected $dates = [
        'date_birth',
        'rg_expedition'
    ];

    public function bond_employees(){
        $this->hasMany(Bond_employee::class);
    }
}
