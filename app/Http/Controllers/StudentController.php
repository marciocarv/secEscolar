<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function setStore($id){
        $title = "Cadastrar Aluno";

        return view('student.formStudent', ['box_id'=>$id, 'title'=>$title, 'action'=>'store', 'route'=>'storeStudent']);
    }

    public function store(Request $request){

    }
}
