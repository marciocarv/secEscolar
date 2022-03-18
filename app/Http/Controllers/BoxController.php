<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Box;

class BoxController extends Controller
{
    public function manageBoxes($id=null){

        $title = "Gerenciar Caixa";

        $box = new Box;

        $boxes = $box->listBoxes();

        if($id===null){
            return view('box.manageBoxes', ['title'=>$title, 'route'=>'storeBox', 'boxes'=>$boxes, 'action'=>'store', 'boxUpdate'=>$box]);
        }else{
            $box = Box::find($id);
            return view('box.manageBoxes', ['title'=>$title, 'route'=>'updateBox', 'boxes'=>$boxes, 'action'=>'update', 'boxUpdate'=>$box]);
        }

    }

    public function store(Request $request){
        $request->validate([
            'description'=> 'required',
            'type'=>'required|min:2'
        ]);

        if(Box::create($request->all())){
            return redirect()->route('manageBoxes')->with('success', 'A caixa foi salva com sucesso!');
        }else{
            return redirect()->route('manageBoxes')->with('error', 'Não foi possível salvar a caixa!');
        }
    }

    public function delete($id){

        $box = Box::find($id);

        if($box->delete()){
            return redirect()->route('manageBoxes')->with('success', 'A caixa foi excluída com sucesso!');
        }else{
            return redirect()->route('manageBoxes')->with('error', 'Não foi possível excluir a caixa!');
        }
    }

    public function update(Request $request){
        
        $request->validate([
            'description'=> 'required',
            'type'=>'required|min:2'
        ]);

        $box = Box::find($request->id);

        $box->description = $request->description;
        $box->type = $request->type;

        if($box->save()){
            return redirect()->route('manageBoxes')->with('success', 'A caixa foi Editada com sucesso!');
        }else{
            return redirect()->route('manageBoxes')->with('error', 'Não foi possível Editar a caixa!');
        }
    }

    public function view($id){
        $box = Box::find($id);
        $title = "Gerenciar Caixa ".$box->description;

        $bond_students = $box->bond_students;

        return view('box.viewBox', ['title'=>$title, 'bond_students'=>$bond_students, 'box'=>$box]);
    }
}
