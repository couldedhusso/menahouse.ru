@extends('templates.TemplateMailbox')

@section('Title')
  Mena | Mailbox
@endsection

@section('active_breadcrumb')
  <li><a href="/mailbox/inbox">Сообщения</a></li>
  <li class="active">Написать письмо</li>
@endsection

@section('sidebar')
  @include('layouts.partials.sidebar-mailbox')
@endsection


@section('content')

  <!-- Message -->
           <div class="col-lg-9 col-sm-9">

           @if($typeform == 'restore')
                @include('layouts.partials.restoreform')
           @else   
                @include('layouts.partials.abusereport')
           @endif

           {{-- <div class="mail-box-header">
               <h3>
                {{-- {{$typemsg}} 
               </h3>
               <div class="mail-tools">
                   <h4>
                     <span class="font-noraml">От: </span>{{ Auth::user()->imia.' '.Auth::user()->familia }}
                   </h4>
                   <h5>
                       {{-- <span class="pull-right font-noraml">{{$house->created_at}}</span>
                       <span class="font-noraml">Объявление: &nbsp;</span> <a href="{{url('/property/'.$house->id)}}" title="Открыть объявление адресата"><i class="fa fa-map-marker"></i> {{$house->ulitsa}}</i> </a>
                   </h5>

               </div>
           </div> --}}

          
        </div>

@endsection
