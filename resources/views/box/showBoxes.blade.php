@extends('layouts.site')

@section('content')

<div class="return">
  <a href="{{route('inactive')}}" class="text-gray-500 font-bold m-2 hover:text-blue-800"> <i class="fa-solid fa-arrow-left"></i> Voltar</a>
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

  <div class="w-full lg:w-6/12 xl:w-2/12">
    <div class="relative flex flex-col min-w-0 break-words rounded mb-6 xl:mb-0 shadow-lg bg-teal-900 hover:bg-teal-700">
      <a href="http://sgfin.test/receita/4" class="">
      <div class="flex-auto p-4">
        <div class="flex flex-wrap">
          <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
            <span class="font-bold uppercase text-sm text-white">
            matriculas canceladas 1
            </span>
          </div>
          <div class="relative w-auto pl-4 flex-initial">
            <div class="text-teal-900 p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-white">
              <i class="fa-solid fa-box-archive"></i>
            </div>
          </div>
        </div>
        <p class="text-sm text-white mt-4 uppercase">
          <span class="text-blue-500 mr-2">
          </span>
          <span class="whitespace-no-wrap">
            Aluno Inativo
          </span>
        </p>
      </div>
    </a>
    </div>
  </div>

</section>
        
@endsection

@section('script')
<script>
  function hide(){
    let notification = document.querySelector('#notification');

    notification.classList.add('hidden');
  } 
</script>

@endsection