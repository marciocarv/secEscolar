<?php

namespace App\Http\Controllers;

use App\Models\Bond_employee;
use App\Models\Box;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function setStoreBox($id){
        $title = "Cadastrar Servidor";

        $box = Box::findOrFail($id);

        $order = $box->bond_employees->count() + 1;

        return view('employee.formEmployeeBox', ['box_id'=>$box->id, 'title'=>$title, 'action'=>'store', 'route'=>'storeBoxEmployee', 'order'=>$order]);
    }

    public function storeBox(Request $request){
        $request->validate([
            'order'=>'required|numeric',
            'name'=>'required',
            'date_birth'=>'required',
            'exit_year'=>'required|numeric',
            'mother'=>'required',
        ]);

        $employee = new Employee;

        $box = Box::findOrFail($request->box_id);

        $employee->name = $request->name;
        $employee->date_birth = $request->date_birth;
        $employee->mother = $request->mother;

        if(!$employee->save()){
            return redirect()->route('viewBox', ['id'=>$box->id])->with('error', 'Não foi possível salvar o servidor!');
        }

        $bond_employee = new Bond_employee;

        $bond_employee->order = $request->order;
        $bond_employee->employee_id = $employee->id;
        $bond_employee->box_id = $box->id;
        $bond_employee->entry_year = $request->entry_year;
        $bond_employee->exit_year = $request->exit_year;

        if(!$bond_employee->save()){
            $employee->delete();
            return redirect()->route('viewBox', ['id'=>$box->id])->with('error', 'Não foi possível salvar o servidor!');
        }

        return redirect()->route('viewBox', ['id'=>$box->id])->with('success', 'Servidor Salvo com sucesso!');
    }

    public function delete($id){
        $bond_employee = Bond_employee::findOrFail($id);

        $employee = $bond_employee->employee;

        if(!$employee->delete()){
            return redirect()->route('viewBox', ['id'=>$bond_employee->box->id])->with('error', 'Não foi possível excluir o servidor!');
        }
        return redirect()->route('viewBox', ['id'=>$bond_employee->box->id])->with('success', 'Servidor excluído com sucesso!');
    }

    public function setUpdateBoxEmployee($id){
        $bond_employee = Bond_employee::findOrFail($id);

        $employee = $bond_employee->employee;

        $box = $bond_employee->box;

        $title = 'Editar Servidor';

        return view('employee.formEmployeeBox', ['bond_employee'=>$bond_employee, 'box_id'=>$box->id, 'employee'=>$employee, 'title'=>$title,
                    'action'=>'update', 'route'=>'updateBoxEmployee']);
    }

    public function updateBox(Request $request){

        $request->validate([
            'order'=>'required|numeric',
            'name'=>'required',
            'date_birth'=>'required',
            'exit_year'=>'required|numeric',
            'mother'=>'required',
        ]);

        $employee = Employee::findOrFail($request->employee_id);

        $box = Box::findOrFail($request->box_id);

        $employee->name = $request->name;
        $employee->date_birth = $request->date_birth;
        $employee->mother = $request->mother;

        if(!$employee->save()){
            return redirect()->route('viewBox', ['id'=>$box->id])->with('error', 'Não foi possível alterar o Servidor!');
        }

        $bond_employee = Bond_employee::findOrFail($request->bond_employee_id);

        $bond_employee->order = $request->order;
        $bond_employee->employee_id = $employee->id;
        $bond_employee->box_id = $box->id;
        $bond_employee->entry_year = $request->entry_year;
        $bond_employee->exit_year = $request->exit_year;

        if(!$bond_employee->save()){
            $employee->delete();
            return redirect()->route('viewBox', ['id'=>$box->id])->with('error', 'Não foi possível alterar o servidor!');
        }

        return redirect()->route('viewBox', ['id'=>$box->id])->with('success', 'Servidor Alterado com sucesso!');

    }

    public function setTransfer($id){
        $bond_employee = Bond_employee::findOrFail($id);

        $employee = $bond_employee->employee;

        $box = new Box;

        $title = 'Trasferir Servidor';

        $boxes = $box->boxForType('Servidor');


        return view('employee.transferEmployee', ['employee'=>$employee, 'boxes'=>$boxes, 'title'=>$title, 'bond_employee'=>$bond_employee]);
    }

    public function transfer(Request $request){
        $employee = Employee::findOrFail($request->employee_id);

        $formerBond_employee = Bond_employee::findOrFail($request->bond_employee_id);

        $box = Box::findOrFail($request->box_id);

        $bond_employee = new Bond_employee;
        $bond_employee->employee_id = $employee->id;
        $bond_employee->box_id = $box->id;
        $bond_employee->order = $request->order;
        $bond_employee->entry_year = $request->entry_year;
        $bond_employee->exit_year = $request->exit_year;

        if(!$bond_employee->save()){
            return redirect()->route('viewBox', ['id'=>$formerBond_employee->box_id])->with('error', 'Não foi possível transferir o aluno!');
        }

        $formerBond_employee->status = "TRANSFERIDO - ".now()->format('d/m/Y');

        $formerBond_employee->save();

        return redirect()->route('viewBox', ['id'=>$box->id])
            ->with('success', 'Aluno transferido da caixa '.$formerBond_employee->box->description.' para a caixa '.$box->description.'!');

    }
}
