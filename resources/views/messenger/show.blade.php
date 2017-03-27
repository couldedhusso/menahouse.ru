
@extends('templates.TemplateMailbox')

@section('Title')
  Mena | Mailbox
@endsection

@section('active_breadcrumb')
  <li><a href="{{url('mailbox/inbox')}}">Сообщения</a></li>
  <li class="active">Подробнее</li>
@endsection

@section('sidebar')
  @include('layouts.partials.sidebar-mailbox')
@endsection

@section('content')
  <!-- Message -->
                  <div class="col-lg-9 col-sm-9">
                  <div class="mail-box-header">
                      <div class="pull-right">
                          <a href="{{url('/mailbox/message/reply/'.$usermessage->fromid.'/'.$house->id)}}" class="btn btn-white2-sm" title="Ответить"><i class="fa fa-reply"></i> Ответить</a>
                          <a href="{{url('/mailbox/message/like/'.$usermessage->id)}}" class="btn  btn-white-red-2 btn-sm-1"title="Добавить в избранное"><i class="fa fa-heart-o"></i> </a>
                          <a href="{{url('/mailbox/message/trash/'.$usermessage->id)}}" class="btn btn-white-grey" title="Удалить"><i class="fa fa-trash-o"></i> </a>
                          <a href="{{url('me/zhaloba/'.$usermessage->fromid)}}" class="btn btn-white-grey" title="Пожаловаться"><i class="fa fa-bug"></i> </a>
                      </div>

                      <h3>
                          Подробности сообщения
                      </h3>

                      <div class="mail-tools">
                          <h4>
                            <span class="font-noraml">От: <?php  echo $usermessage->getSenderInfos($usermessage->fromid); ?></span>
                          </h4>
                          <h5>
                              <span class="pull-right font-noraml">{{$usermessage->created_at}}</span>
                              <span class="font-noraml">Объявление: &nbsp;</span> <a href="{{url('/'.$house->link )}}" title="Открыть объявление адресата"><i class="fa fa-map-marker"></i>{{ $house->ulitsa }}</i> </a>
                          </h5>
                      </div>
                  </div>
                  <hr>
                      <div class="mail-box">


                      <div class="mail-body">
                              {{$usermessage->body}}
                              <hr>
                      </div>
                          {{-- <div class="mail-attachment">
                              <div class="attachment">

                                  <div class="clearfix"></div>
                              </div>
                              </div> --}}
                              <div class="mail-body text-right">
           
                                      <a class="btn btn-white2" href="{{url('/mailbox/message/'.$usermessage->id.'/reply')}}"><i class="fa fa-reply"></i>&nbsp; Ответить на сообщение</a>
                                      <a class="btn btn-white-grey" href="#"><i class="fa fa-arrow-right"></i> Заключить сделку</a>
                              </div>
                            </br>
                              <div class="clearfix"></div>

                      </div>
                  </div>
  <!-- end Message -->
@endsection
