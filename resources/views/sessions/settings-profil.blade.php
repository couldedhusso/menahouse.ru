@extends('templates.TemplateDashboard')
@section('Title')
  Mena | Profile
@endsection

@section('active_breadcrumb')
  <li><a>Аккаунт</a></li>
  <li class="active">Настройки</li>
@endsection

@section('sidebar')
  @include('layouts.partials.sidebar-settings')
@endsection

@section('content')
    <section id="profile">
      <header><h1>Персональные настройки</h1></header>

      <div class="account-profile">
        <div class="row">

    
            <div class="col-md-9 col-sm-12">
              {!! Form::open(array('route' => 'dashboard.settings', 'method' => 'post', 'class' => 'form-contact-fields')) !!}
              <section id="contact">

                @if('banned' == Auth::user()->status)
                   <h2><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> &nbsp; Вы заблокированы по причине жалоб 
                   <a href="{{url('me/restore-account')}}"> <span class="float-right" style="font-size:14px;
                   border:1px solid; margin : 12px; padding : 10px">восстановить</span></a></h2>

                @else

                    <h2><i class="fa fa-info" aria-hidden="true"></i> &nbsp; Контактные данные</h2>
                @endif

                
                <div class="row">
                  <div class="col-md-9 col-sm-12">
                      <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
                      <input name="user_id" type="hidden" value="{!! $user->id !!}" />

                      <div class="form-group">
                          <label for="form-account-name">Ваше имя</label>
                          <input type="text" class="form-control" id="imia" name="fio" required value="{{$user->familia.' '.$user->imia.' '.$user->otchestvo}}">
                      </div><!-- /.form-group -->
                      <div class="form-group">
                          <label for="form-account-name">Номер телефона</label>
                          <input type="text" class="form-control" id="form-account-phone" name="form-account-phone" value="{{$user->phonenumber}}">
                      </div><!-- /.form-group -->
                      <div class="form-group">
                          <label for="form-account-name">Email</label>
                          <input type="text" class="form-control" id="form-account-email" name="form-account-email" value="{{$user->email}}">
                      </div><!-- /.form-group -->

                      @if(Auth::user()->hasRole('Admin'))

                          <div class="form-group">
                            <label for="account-status">Статус </label>

                            @if( 'Activated' == $user->status)
                                <input type="text" class="form-control" id="account-status" name="account-status" value="Чистый">
                            @else  
                                <input type="text" class="form-control" id="account-status" name="account-status" value="Заблокированный">
                            @endif
                          </div><!-- /.form-group -->
                      @endif


                      @cannot('update',Auth::user())
                        <div class="form-group clearfix">
                          <button type="submit" class="btn btn-m-5 btn-white-grey-3 pull-right" id="form-contact-fields-submit">Изменить данные</button>
                       </div><!-- /.form-group -->
                      @endcannot

                      
                  </div>

                <div class="col-md-3">
                    <strong>Совет:</strong>
                      <p>Укажите реальные контактные данные. Только актуальность информации даст положительный эффект.</p>
                </div>
              </div>
              </section>
              <br><br><br>
            {!! Form::close() !!}

            <div class="block clearfix">
        									<section id="change-password">
                                                <header><h2><i class="fa fa-lock" aria-hidden="true"></i> &nbsp; Безопасность</h2></header>
                                                <div class="row">
                                                    <div class="col-md-9 col-sm-12">
                                                      {!! Form::model($user, array('route' => 'password_edit', 'method' => 'post')) !!}
                                                          <input name="_token" type="hidden" value="{!! csrf_token() !!}" />

                                                           <!-- user id -->
                                                           <input name="user_id" type="hidden" value="{!! $user->id !!}" />

                                                          <div class="form-group">
                                                            <label for="form-account-password-current">Текущий пароль</label>
                                                            <input type="password" class="form-control" id="form-account-password-current" name="form-account-password-current">
                                                          </div>
                                                          <!-- /.form-group -->
                                                          <div class="form-group">
                                                            <label for="form-account-password-new">Новый пароль</label>
                                                            <input type="password" class="form-control" id="form-account-password-new" name="form-account-password-new">
                                                          </div>
                                                          <!-- /.form-group -->
                                                          <div class="form-group">
                                                            <label for="form-account-password-confirm-new">Подтверждение пароля</label>
                                                            <input type="password" class="form-control" id="form-account-password-confirm-new" name="form-account-password-confirm-new">
                                                          </div>
                                                          <!-- /.form-group -->

                                                           @cannot('update',Auth::user())
                       
                                                              <div class="form-group clearfix">
                                                                  <button type="submit" class="btn btn-m-5 btn-white-grey-3 pull-right" id="form-contact-fields-submit">Изменить  пароль</button>
                                                              </div><!-- /.form-group -->

                                                           @endcannot

                                                          <!-- /.form-group -->
                                                    {!! Form::close() !!}

                                                    </div>

                                                    <div class="col-md-3">
                                                        <strong>Совет:</strong>
                                                        <p>Желательно использовать не менее 8 символов с большими буквами.
                                                        </p>
                                                    </div>
                                                </div>
                                            </section>
        									</div>

          </div>
          <!-- /.col-md-9 -->
        </div>
        <!-- /.row -->
      </div>

      <!-- /.account-profile -->
    </section>
    <!-- /#profile -->
@endsection
