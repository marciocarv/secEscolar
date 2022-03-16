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
        <input type="hidden" value="{{$boxUpdate->id}}" name="id">
      @endif
      <div class="field">
        <label class="label">Descrição</label>
        <div class="field-body">
          <div class="field">
            <div class="control icons-left">
              <input 
                class="input" 
                type="text" 
                name="description" 
                placeholder="Descrição"
                @if($action == 'update')
                value="{{$boxUpdate->description}}"
                @endif
                >
              <span class="icon left"><i class="fa-solid fa-box-open"></i></span>
            </div>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="label">Tipo de Arquivo</label>
        <div class="control">
          <div class="select">
            <select name="type">
              <option value="1">Escolha uma Opção</option>
              <option value="aluno" {{$boxUpdate->type == 'aluno' ? 'selected':''}}>Aluno</option>
              <option value="servidor" {{$boxUpdate->type == 'servidor' ? 'selected':''}}>Servidor</option>
              <option value="devendo" {{$boxUpdate->type == 'devendo' ? 'selected':''}}>Devendo Histórico</option>
            </select>
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

    <div class="card has-table mt-10">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="fa-solid fa-box-open"></i></span>
          CAIXAS
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
            <th>Descrição</th>
            <th>Tipo</th>
            <th>Criação</th>
            <th></th>
          </tr>
          </thead>
          <tbody>
            @foreach($boxes as $box)
            <tr>
              <td class="checkbox-cell">
                <label class="checkbox">
                  <input name="id_box" value="{{$box->id}}" type="checkbox" >
                  <span class="check"></span>
                </label>
              </td>
              <td data-label="Descrição">{{$box->description}}</td>
              <td data-label="Tipo">{{$box->type}}</td>
              <td data-label="Created">
                <small class="text-gray-500" title="{{$box->created_at->format('d/m/Y')}}">{{$box->created_at->format('d/m/Y')}}</small>
              </td>
              <td class="actions-cell">
                <div class="buttons right nowrap">
                  <a title="Editar" href="{{route('setUpdateBox', ['id'=>$box->id])}}" class="button small green" type="button">
                    <span class="icon"><i class="fa-solid fa-pen-to-square"></i></span>
                  </a>
                  <a title="Excluir" href="{{route('deleteBox', ['id'=>$box->id])}}" class="button small red" type="button">
                    <span class="icon"><i class="fa-solid fa-trash"></i></span>
                  </a>
                </div>
              </td>
            </tr>
            @endforeach
            @if($boxes->isEmpty())
            <tr>
              <td data-label="Sem caixas" colspan="4" class="text-center">
                Não existem caixas cadastradas
              </td>
            </tr>
            @endif
          </tbody>
        </table>
        {{$boxes->links()}}
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