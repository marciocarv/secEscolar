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

        return view('employee.formEmployeeBox', ['box_id'=>$id, 'title'=>$title, 'action'=>'store', 'route'=>'storeBoxEmployee']);
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
        return redirect()->route('viewBox', ['id'=>$bond_employee->box->id])->with('error', 'Servidor excluído com sucesso!');
    }
}
