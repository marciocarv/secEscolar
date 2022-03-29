<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Box;
use App\Models\Bond_student;

class TesteController extends Controller
{
    public function inserir(){
        $aluno = array(
            
        );

        /*foreach($aluno as $a){
            $student = new Student;
            $student->name = $a['nome'];
            $student->date_birth = $a['data_nascimento'];
            $student->mother = $a['nome_mae'];

            $student->save();

            $bond_student = new Bond_student;
            $bond_student->student_id = $student->id;
            $bond_student->box_id = 10;
            $bond_student->order = $a['ordem'];
            $bond_student->status = 'ARQUIVADO';
            $bond_student->exit_year = '2001';

            $bond_student->save();

            echo 'salvo'.$a['ordem'].'<br />'; 

        }*/
    }
}
