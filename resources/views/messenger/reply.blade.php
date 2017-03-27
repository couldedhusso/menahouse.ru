@extends('templates.TemplateMailbox')

@section('Title')
  Mena | Mailbox$To 
@endsection

@section('active_breadcrumb')
  <li><a href="/mailbox/inbox">Сообщения</a></li>
  <li class="active">Написать письмо</li>
@endsection

@section('sidebar')
  @include('layouts.partials.sidebar-mailbox')
@endsection

@section('content')

 <div class="col-lg-9 col-sm-9">

         <div class="mail-box-header">
               <h3>
                {{$typemsg}}
               </h3>
               <div class="mail-tools">
                   <h4>
                     <span class="font-noraml">От: </span>{{ Auth::user()->imia.' '.Auth::user()->familia }}
                   </h4>
                   <h5>
                       <span class="pull-right font-noraml">{{$create_at}}</span>
                       <span class="font-noraml">Объявление: &nbsp;</span> <a href="{{ url('/'.$house->link) }}" title="Открыть объявление адресата"><i class="fa fa-map-marker"></i> {{$house->ulitsa}}</i> </a>
                   </h5>

               </div>
           </div>
           <hr>


           <div class="mail-box">

                 <form role="form" id="form-submit" method="post" class="form-submit" action="/mailbox/message/compose">

                   <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
                   {!! csrf_field() !!}
                   <input type="hidden" name="subject" value="{{'RE:'.$house->type_appart }}">
                   <input type="hidden" name="id_obivlenie" value="{{$house->id }}">
                   <input type="hidden" name="To" value="{{$house->owner}}">
                   <div class="mail-text">
                       <textarea class="form-control" name="form-message" rows="8" placeholder="Текст сообщения" required></textarea>
                   </div><!-- /.mail-text -->

                   <div class="clearfix"></br></div>
                   <div class="mail-body text-right">
                    <div class="form-group">
                        <button type="submit" class="btn btn-white-blue btn-m-4" title="Отправить сообщение"><i class="fa fa-reply"></i> Отправить</button>
                    </div><!-- /.form-group -->
           </div>
           </div>


 </div>

@endsection
