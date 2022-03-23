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

        $request->validate([
            'order'=>'required|numeric',
            'name'=>'required',
            'date_birth'=>'required',
            'exit_year'=>'required|numeric',
            'mother'=>'required',
        ]);

        $student = new Student;

        $box = Box::findOrFail($request->box_id);

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

    public function delete($id){
        $bond_student = Bond_student::findOrFail($id);
        $student = $bond_student->student;
        $box = $bond_student->box;

        if(!$student->delete()){
            return redirect()->route('viewBox', ['id'=>$box->id])->with('error', 'Nâo foi possível excluir esse aluno!');
        }

        return redirect()->route('viewBox', ['id'=>$box->id])->with('success', 'Aluno excluído com sucesso!');
    }

    public function deleteLoose($id){
        $student = Student::findOrFail($id);

        if(!$student->delete()){
            return false;
        }
        return true;
    }

    public function setUpdate($id){
        $bond_student = Bond_student::findOrFail($id);

        $student = $bond_student->student;

        $box = $bond_student->box;

        $title = 'Editar Aluno';

        return view('student.formStudent', ['bond_student'=>$bond_student, 'box_id'=>$box->id, 'student'=>$student, 'title'=>$title,
                    'action'=>'update', 'route'=>'updateStudent']);
    }

    public function update(Request $request){

        $request->validate([
            'order'=>'required|numeric',
            'name'=>'required',
            'date_birth'=>'required',
            'exit_year'=>'required|numeric',
            'mother'=>'required',
        ]);

        $student = Student::findOrFail($request->student_id);

        $box = Box::findOrFail($request->box_id);

        $student->name = $request->name;
        $student->date_birth = $request->date_birth;
        $student->mother = $request->mother;

        if(!$student->save()){
            return redirect()->route('viewBox', ['id'=>$box->id])->with('error', 'Não foi possível alterar o aluno!');
        }

        $bond_student = Bond_student::findOrFail($request->bond_student_id);

        $bond_student->order = $request->order;
        $bond_student->student_id = $student->id;
        $bond_student->box_id = $box->id;
        $bond_student->entry_year = $request->entry_year;
        $bond_student->exit_year = $request->exit_year;

        if(!$bond_student->save()){
            $student->delete();
            return redirect()->route('viewBox', ['id'=>$box->id])->with('error', 'Não foi possível alterar o aluno!');
        }

        return redirect()->route('viewBox', ['id'=>$box->id])->with('success', 'Aluno Alterado com sucesso!');

    }
}
