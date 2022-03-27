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

        if(!$bond_student->delete()){
            return redirect()->route('viewBox', ['id'=>$box->id])->with('error', 'Nâo foi possível excluir esse aluno!');
        }

        if(!$student->bond_students->isEmpty()){
            return redirect()->route('viewBox', ['id'=>$box->id])->with('success', 'Aluno excluído com sucesso!');
        }

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

    public function rescue($id){
        $bond_student = Bond_student::findOrfail($id);

        $bond_student->status = 'RESGATADO - '.now()->format('d/m/Y');
        
        if(!$bond_student->save()){
            return redirect()->route('viewBox', ['id'=>$bond_student->box_id])->with('error', 'Não foi possível resgatar esse aluno!');
        }

        return redirect()->route('viewBox', ['id'=>$bond_student->box_id])->with('success', 'Aluno resgatado com sucesso!');
    }

    public function setTransfer($id){
        $bond_student = Bond_student::findOrFail($id);

        $student = $bond_student->student;

        $box = new Box;

        $title = 'Trasferir ALuno';

        $boxesDevendo = $box->boxForType('devendo');

        $boxesStudent = $box->boxForType('Aluno');

        $boxes = $boxesStudent->merge($boxesDevendo);

        return view('student.transferStudent', ['student'=>$student, 'boxes'=>$boxes, 'title'=>$title, 'bond_student'=>$bond_student]);
    }

    public function transfer(Request $request){
        $student = Student::findOrFail($request->student_id);

        $formerBond_student = Bond_student::findOrFail($request->bond_student_id);

        $box = Box::findOrFail($request->box_id);

        $bond_student = new Bond_student;
        $bond_student->student_id = $student->id;
        $bond_student->box_id = $box->id;
        $bond_student->order = $request->order;
        $bond_student->entry_year = $request->entry_year;
        $bond_student->exit_year = $request->exit_year;

        if(!$bond_student->save()){
            return redirect()->route('viewBox', ['id'=>$formerBond_student->box_id])->with('error', 'Não foi possível transferir o aluno!');
        }

        $formerBond_student->status = "TRANSFERIDO - ".now()->format('d/m/Y');

        $formerBond_student->save();

        return redirect()->route('viewBox', ['id'=>$box->id])
            ->with('success', 'Aluno transferido da caixa '.$formerBond_student->box->description.' para a caixa '.$box->description.'!');

    }
}
