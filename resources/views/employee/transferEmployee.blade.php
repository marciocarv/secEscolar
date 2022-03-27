@extends('layouts.site')

@section('content')

<div class="return">
  <a href="{{route('viewBox', ['id'=>$bond_employee->box_id])}}" class="text-gray-500 font-bold m-2 hover:text-blue-800">
    <i class="fa-solid fa-arrow-left"></i> 
    Voltar
  </a>
</div>

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
    <form method="POST" action="{{route('transferEmployee')}}" class="w-96">
      @csrf

      <input type="hidden" value="{{$bond_employee->id}}" name="bond_employee_id">
      <input type="hidden" value="{{$employee->id}}" name="employee_id">

      <div class="field">
        <label class="label">Nome</label>
        <div class="field-body">
          <div class="field">
            {{$employee->name}}
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Mãe</label>
        <div class="field-body">
          <div class="field">
            {{$employee->mother}}
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Data de Nascimento</label>
        <div class="field-body">
          <div class="field">
            {{$employee->date_birth->format('d/m/Y')}}
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Caixa de destino</label>
        <div class="control">
          <div class="select">
            <select name="box_id">
              <option value="">Escolha uma caixa</option>
              @foreach($boxes as $box)
              <option value="{{$box->id}}">Caixa {{$box->description}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Ordem</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="number" 
                name="order" 
                placeholder="Ordem"
                >
              <span class="icon left"><i class="fa-solid fa-list"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Ano de Entrada</label>
        <div class="field-body">
          <div class="field flex flex-wrap">
            <div class="control icons-left">
                <input 
                class="input w-56" 
                type="number" 
                name="entry_year" 
                placeholder=""
                >
              <span class="icon left"><i class="fa-solid fa-right-to-bracket"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Ano de Saída</label>
        <div class="field-body">
          <div class="field flex flex-wrap">
            <div class="control icons-left">
                <input 
                class="input w-56" 
                type="number" 
                name="exit_year" 
                placeholder=""
                >
              <span class="icon left"><i class="fa-solid fa-right-from-bracket"></i></span>
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

  function uppercase(ev){
    const input = ev.target;
	  input.value = input.value.toUpperCase();
  }

  function less_space(ev){
    const input = ev.target;
	  input.value = input.value.replace(/( )+/g, ' ');
    input.value = input.value.normalize('NFD').replace(/[\u0300-\u036f]/g, "");
  }

  document.querySelector('#uppercase_student').addEventListener('keyup', (ev) => {
    uppercase(ev);
  });

  document.querySelector('#uppercase_mother').addEventListener('keyup', (ev) => {
    uppercase(ev);
  });

  document.querySelector('#uppercase_student').addEventListener('blur', (ev) => {
    less_space(ev);
  });

  document.querySelector('#uppercase_mother').addEventListener('blur', (ev) => {
    less_space(ev);
  });


</script>

@endsection