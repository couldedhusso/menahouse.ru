@extends('templates.TemplateAccountUser')
@section('Title')
Mena | Sign in
@endsection

@section('active_breadcrumb')
  <li class="active">Войти</li>
@endsection

@section('content')

  <header><h1>Войти</h1></header>
  <div class="row">
      <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">

          {!! Form::open(array('route' => 'login_path', 'method' => 'post'))!!}

              {{-- {!! csrf_field() !!} --}}
              <input name="_token" type="hidden" value="{!! csrf_token() !!}" />

              <div class="form-group">
                  <label for="form-create-account-email">Email:</label>
                  <input type="email" name="email" class="form-control" id="form-create-account-email" title="Введите Ваш адрес электронной почты" required>
              </div><!-- /.form-group -->

              <div class="form-group">
                  <label for="form-create-account-password">Пароль:</label>
                  <input type="password" name="password" class="form-control" id="form-create-account-password" title="Введите Ваш пароль при регистрации" required>
              </div><!-- /.form-group -->

              <div class="form-group clearfix">
                  <button type="submit" class="btn pull-right btn-success" id="account-submit">&nbsp; &nbsp; &nbsp; &nbsp; Войти &nbsp; &nbsp; &nbsp; &nbsp;</button>  <!-- CZ регистрация -->
              </div><!-- /.form-group -->
          {!! Form::close() !!}
          <hr>
          <div class="pull-left">
            <figure class="note"><a href="{{ url('sign-up') }}">&nbsp; &nbsp; Регистрация</a></figure>
          </div>
          <div class="pull-right">
            <figure class="note"><a href="forgot-password.html">Восстановить пароль &nbsp; &nbsp;</a></figure>
          </div>

      </div>
      </br>
      </br>
      </br>
      </br>
      </br>
      </br>
  </div><!-- /.row -->

{{--
<!-- Breadcrumb -->
<div class="container">
      <ol class="breadcrumb">
          <li><a href="{{url('/')}}">Главная</a></li>
          <li class="active">Вход</li>
      </ol>
</div>
<!-- end Breadcrumb -->


<div class="container">
  <header><h1>Вход</h1></header>
    <div class="row">
        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
          <div class="center form-group">
              @if (count($errors) > 0)
                 @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                 @endforeach
              @endif
          </div>


          {!! Form::open(array('route' => 'login_path', 'method' => 'post'))!!}


            <input name="_token" type="hidden" value="{!! csrf_token() !!}" />

            <fieldset>
                  <div class="form-group">
                    {!!   Form::label('email', 'Электронная почта') !!}
                    {!! Form::email('email', null, [ 'required', 'autofocus', 'id' => 'inputEmail' ]) !!}
                  </div>

                  <div class="form-group">
                     {!!   Form::label('password', 'Пароль') !!}
                     {!! Form::password('password', null, [ 'required', 'autofocus', 'id' => 'inputPassword' ]) !!}
                  </div>


                  <div class="form-group">
                      <label class="input-control checkbox small-check ">
                          <input type="checkbox">
                          <span class="check"></span>
                          <span class="caption">запомнить меня </span>
                       </label>
                  </div>
                  <div class="form-group clearfix">
                      <button type="submit" class="btn  btn-green" id="account-submit"> Войти </button>
                  </div><!-- /.form-group -->

            </fieldset>
         {!! Form::close() !!}
        </div>
    </div>
</div> --}}















{{--


    <form method="POST" action="/auth/login">
        {!! csrf_field() !!}
<div class="login-form">

        <div class="form-group">
             {!! Form::label('Электронная почта', 'Электронная почта', ['class' => 'control-label']) !!}
             <div class="form-controls">
                 {!! Form::email('email', null, ['class' => 'form-control']) !!}
             </div>
        </div>
         <div class="form-group">
           {!! Form::label('Пароль') !!}
           <div class="form-controls">
               {!! Form::password('password', ['class' =>'form-control']) !!}
           </div>
         </div>

         <div class="form-group">
           {!! Form::label('Remember Me') !!}
           <div class="form-controls">
               {!! Form::checkbox('remember', 0, ['class' =>'form-control']) !!}
           </div>
         </div>

        <div class="form-group"> --}}
            {{-- <div>
                Email
                <input class="form-group"  type="email" name="email" value="{{ old('email') }}">
            </div>

            <div>
                Password
                <input class="form-group" type="password" name="password" id="password">
            </div>

            <div>
                <input class="form-group" type="checkbox" name="remember"> Remember Me
            </div>--}}

            {{-- <div>
                <button class="btn btn-primary" type="submit">Вход</button>
            </div>
      </div>
</div>
    </form> --}}


@endsection
