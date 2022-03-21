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
    <a href="{{route('setStoreStudent', ['id'=>$box->id])}}" class="p-5 button green mb-2">
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
            @foreach($bond_students as $bond_student)
            <tr class="uppercase">
              <td class="checkbox-cell">
                <label class="checkbox">
                  <input name="id_box" value="{{$bond_student->id}}" type="checkbox" >
                  <span class="check"></span>
                </label>
              </td>
              <td data-label="Ordem">{{$bond_student->order}}</td>
              <td data-label="Nome">{{$bond_student->student->name}}</td>
              <td data-label="Nome">{{$bond_student->student->date_birth->format('d/m/Y')}}</td>
              <td data-label="Nome">{{$bond_student->student->mother}}</td>
              <td data-label="Nome">{{$bond_student->entry_year}} - {{$bond_student->exit_year}} </td>
              <td data-label="Situação">
                <small class="text-gray-500" title="{{$bond_student->status}}">{{$bond_student->status}}</small>
              </td>
              <td class="actions-cell">
                <div class="buttons right nowrap">
                  <a title="Visualizar" href="{{route('viewBox', ['id'=>$bond_student->id])}}" class="button small blue" type="button">
                    <span class="icon"><i class="fa-solid fa-eye"></i></span>
                  </a>
                  <a title="Editar" href="{{route('setUpdateBox', ['id'=>$bond_student->id])}}" class="button small green" type="button">
                    <span class="icon"><i class="fa-solid fa-pen-to-square"></i></span>
                  </a>
                  <a title="Excluir" href="{{route('deleteBox', ['id'=>$bond_student->id])}}" class="button small red" type="button">
                    <span class="icon"><i class="fa-solid fa-trash"></i></span>
                  </a>
                </div>
              </td>
            </tr>
            @endforeach
            @if($bond_students->isEmpty())
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