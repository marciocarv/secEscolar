@extends('layouts.site')

@section('content')

<section class="is-hero-bar">
  <div class="flex flex-col items-center justify-between space-y-6 md:flex-row md:space-y-0">
    <h1 class="title">
      {{$title}}
    </h1>
  </div>
</section>

<section class="section main-section">

  <div class="flex justify-center">
    <a href="{{route('manageBoxes')}}" class="p-5 button green"><span class="icon">
      <i class="fa-solid fa-boxes-stacked"></i></span> Gerenciar Caixas
    </a> 
  </div>

  <div class="">
    <form method="POST" action="#">
      <div class="field">
        <label class="label">Pesquisar</label>
        <div class="control">
          <input class="input" type="text" placeholder="Nome do aluno, servidor etc.">
        </div>
      </div>
      <div class="field grouped">
        <div class="control">
          <button type="submit" class="button green">
            <span class="icon"><i class="fa-solid fa-magnifying-glass"></i></span> Pesquisar
          </button>
        </div>
      </div>
    </form>
  </div>

  <div class="grid grid-cols-1 gap-6 my-6 md:grid-cols-3">
    <a href="{{route('showBox', ['type'=>'Aluno'])}}">
      <div class="card shadow-md border-gray-300 hover:bg-gray-200">
        <div class="card-content">
          <div class="flex items-center justify-between">
            <div class="widget-label">
              <h2 class="font-bold">
                Caixas Alunos
              </h2>
            </div>
            <span class="text-green-500 icon widget-icon"><i class="fa-solid fa-user-graduate"></i></span>
          </div>
        </div>
      </div>
    </a>
    <a href="{{route('showBox', ['type'=>'Servidor'])}}">
      <div class="card shadow-md border-gray-300 hover:bg-gray-200">
          <div class="card-content">
            <div class="flex items-center justify-between">
              <div class="widget-label">
                <h2 class="font-bold">
                  Caixas Servidores
                </h2>
              </div>
              <span class="text-blue-500 icon widget-icon"><i class="fa-solid fa-user-tie"></i></span>
            </div>
          </div>
      </div>
    </a>
    <a href="{{route('showBox', ['type'=>'devendo'])}}">
      <div class="card shadow-md border-gray-300 hover:bg-gray-200">
        <div class="card-content">
          <div class="flex items-center justify-between">
            <div class="widget-label">
              <h2 class="font-bold">
                Caixas Devendo Histórico / Matrículas Canceladas
              </h2>
            </div>
            <span class="text-red-500 icon widget-icon"><i class="fa-solid fa-user-graduate"></i></span>
          </div>
        </div>
      </div>
    </a>
  </div>

  
          
@endsection

@section('script')

@endsection