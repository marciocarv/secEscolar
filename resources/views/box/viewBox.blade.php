@extends('layouts.site')

@section('content')

<div class="return">
  <a href="{{route('manageBoxes')}}" class="text-gray-500 font-bold m-2"> <i class="fa-solid fa-arrow-left"></i> Voltar</a>
</div>

<section class="is-hero-bar">
  <div class="flex flex-col items-center justify-between space-y-6 md:flex-row md:space-y-0">
    <h1 class="title">
      {{$title}}
    </h1>
  </div>
</section>

<section class="section main-section">

  <div class="flex justify-center">
    <a href="{{route($box->type=='servidor' ? 'setStoreBoxEmployee' : 'setStoreStudent', ['id'=>$box->id])}}" class="p-5 button green mb-2">
      <span class="icon"><i class="fa-solid fa-boxes-stacked"></i></span> Adicionar {{$box->type == 'devendo' ? 'Aluno' : $box->type}}
    </a> 
  </div>

  @if(session('success'))
  <div id="notification" class="notification green">
    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
      <div>
        <span class="icon"><i class="mdi mdi-buffer"></i></span>
        <b>{{session('success')}}</b>
      </div>
      <button type="button" class="button small textual --jb-notification-dismiss" onclick="hide()">Ocultar</button>
    </div>
  </div>
  @endif

  @if(session('error'))
  <div id="notification" class="notification red">
    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
      <div>
        <span class="icon"><i class="mdi mdi-buffer"></i></span>
        <b>{{session('error')}}</b>
      </div>
      <button type="button" class="button small textual --jb-notification-dismiss" onclick="hide()">Ocultar</button>
    </div>
  </div>
  @endif

    <div class="card has-table mt-10">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="fa-solid fa-box-open"></i></span>
          {{$box->type == 'devendo' ? 'Devendo Histórico': $box->type}}
        </p>
        <a href="#" class="card-header-icon">
          <span class="icon"><i class="mdi mdi-reload"></i></span>
        </a>
      </header>
      <div class="card-content">
        <table>
          <thead>
          <tr>
            <th class="checkbox-cell">
              <label class="checkbox">
                <input type="checkbox">
                <span class="check"></span>
              </label>
            </th>
            <th>Ordem</th>
            <th>Nome</th>
            <th>Data de Nascimento</th>
            <th>Mãe</th>
            <th>Período</th>
            <th>Situação</th>
            <th></th>
          </tr>
          </thead>
          <tbody>
            @foreach($bonds as $bond)
            <tr class="uppercase">
              <td class="checkbox-cell">
                <label class="checkbox">
                  <input name="id_box" value="{{$bond->id}}" type="checkbox" >
                  <span class="check"></span>
                </label>
              </td>
              <td data-label="Ordem">{{$bond->order}}</td>
              <td data-label="Nome">{{$box->type == 'servidor' ? $bond->employee->name : $bond->student->name}}</td>
              <td data-label="Nome">{{$box->type == 'servidor' ? $bond->employee->date_birth->format('d/m/Y') : $bond->student->date_birth->format('d/m/Y')}}</td>
              <td data-label="Nome">{{$box->type == 'servidor' ? $bond->employee->mother : $bond->student->mother}}</td>
              <td data-label="Nome">{{$bond->entry_year}} - {{$bond->exit_year}} </td>
              <td data-label="Situação">
                <small class="text-gray-500" title="{{$bond->status}}">{{$bond->status}}</small>
              </td>
              <td class="actions-cell">
                <div class="buttons right nowrap">
                  <a title="Editar" href="{{route($box->type == 'servidor' ? 'setUpdateBoxEmployee' : 'setUpdateStudent', ['id'=>$bond->id])}}" class="button small green" type="button">
                    <span class="icon"><i class="fa-solid fa-pen-to-square"></i></span>
                  </a>
                  <a title="Excluir" href="{{route($box->type == 'servidor' ? 'deleteEmployee' : 'deleteStudent', ['id'=>$bond->id])}}" class="button small red" type="button">
                    <span class="icon"><i class="fa-solid fa-trash"></i></span>
                  </a>
                </div>
              </td>
            </tr>
            @endforeach
            @if($bonds->isEmpty())
            <tr>
              <td data-label="Sem caixas" colspan="7" class="text-center">
                Sem registros
              </td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>
        
@endsection

@section('script')
<script>
  function hide(){
    let notification = document.querySelector('#notification');

    notification.classList.add('hidden');
  } 
</script>

@endsection