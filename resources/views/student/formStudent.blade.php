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

  <div>
    <form method="POST" action="{{route($route)}}" class="w-96">
      @csrf
      @if($action === "update")
        <input type="hidden" value="{{$student->id}}" name="id">
      @endif
      <input type="hidden" value="{{$box_id}}" name="box_id">

      <div class="field">
        <label class="label">Ordem</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="text" 
                name="order" 
                placeholder="Ordem"
                @if($action == 'update')
                value="{{$bond_student->order}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-box-open"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Nome</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="text" 
                name="name" 
                placeholder="Nome"
                @if($action == 'update')
                value="{{$student->name}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-box-open"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Data de Nascimento</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="date" 
                name="date_birth" 
                placeholder=""
                @if($action == 'update')
                value="{{$student->date_birth}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-box-open"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Mãe</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="text" 
                name="mother" 
                placeholder="Nome da mãe"
                @if($action == 'update')
                value="{{$student->mother}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-box-open"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Período</label>
        <div class="field-body">
          <div class="field">
            teste<div class="control icons-left">
                <input 
                class="input" 
                type="date" 
                name="entry_year" 
                placeholder=""
                @if($action == 'update')
                value="{{$bond_student->entry_year}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-box-open"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field grouped">
        <div class="control">
          <button type="submit" class="button green">
            Salvar
          </button>
        </div>
        <div class="control">
          <button type="reset" class="button red">
            Limpar
          </button>
        </div>
      </div>

    </form>

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