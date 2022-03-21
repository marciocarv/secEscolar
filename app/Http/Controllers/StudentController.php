<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Box;
use App\Models\Bond_student;

class StudentController extends Controller
{
    public function setStore($id){
        $title = "Cadastrar Aluno";

        return view('student.formStudent', ['box_id'=>$id, 'title'=>$title, 'action'=>'store', 'route'=>'storeStudent']);
    }

    public function store(Request $request){
        $student = new Student;

        $box = Box::find($request->box_id);

        $student->name = $request->name;
        $student->date_birth = $request->date_birth;
        $student->mother = $request->mother;

        if(!$student->save()){
            return redirect()->route('viewBox', ['id'=>$box->id])->with('error', 'Não foi possível salvar o aluno!');
        }

        $bond_student = new Bond_student;

        $bond_student->order = $request->order;
        $bond_student->student_id = $student->id;
        $bond_student->box_id = $box->id;
        $bond_student->entry_year = $request->entry_year;
        $bond_student->exit_year = $request->exit_year;

        if(!$bond_student->save()){
            $student->delete();
            return redirect()->route('viewBox', ['id'=>$box->id])->with('error', 'Não foi possível salvar o aluno!');
        }

        return redirect()->route('viewBox', ['id'=>$box->id])->with('success', 'Aluno Salvo com sucesso!');
    }
}
