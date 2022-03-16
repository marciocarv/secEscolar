<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $title = "Sistema de Gestão de Secretaria Escolar";
        return view('index.index', ['title'=>$title]);
    }

    public function inactive(){
        $title = "Arquivo Inativo";
        return view('inactive.inactive', ['title'=>$title]);
    }
}
