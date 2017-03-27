@extends('layouts.masterpage')

@section('Title', 'Вход')
@endsection

@section('content')
  <br><br>
  <h3>Вход </h3>

  {!! Form::open(array('route' => 'login_path')) !!}
  <input name="_token" type="hidden" value="{!! csrf_token() !!}" />

  <div class="form-group">
      {!!   Form::label('email', 'Электпронная почта') !!}
      {!!   Form::text('email')!!}
  </div>

  <div class="form-group">
      {!!   Form::label('password', 'Пароль') !!}
      {!!   Form::password('password')!!}
  </div>

  <div class="form-group">
      {!!   Form::submit('Вход') !!}
  </div>

  {!! Form::close() !!}

@endsection
