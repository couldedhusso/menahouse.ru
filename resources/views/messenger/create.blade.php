@extends('layouts.admin')

@section('content')

  <h1>Create a new message</h1>
  {!! Form::open(['route' => 'messages.store']) !!}
      <div class="col-md-6">
        <!-- Subject Form Input -->

        <div class="form-group">
            {!! Form::label('To', 'To', ['class' => 'control-label']) !!}
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('subject', 'Subject', ['class' => 'control-label']) !!}
            {!! Form::text('subject', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Message Form Input -->
        <div class="form-group">
            {!! Form::label('message', 'Message', ['class' => 'control-label']) !!}
            {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
        </div>

        <div class="input-control file" data-role="input">
            <input type="file">
            <button class="button"><span class="mif-folder"></span></button>
        </div>



        @if($users->count() > 0)
        <div class="checkbox">
            @foreach($users as $user)
                <label title="{!!$user->imia!!}"><input type="checkbox" name="recipients[]" value="{!!$user->id!!}">{!!$user->imia!!}</label>
            @endforeach
        </div>
        @endif

        <!-- Submit Form Input -->
        <div class="form-group">
            {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
        </div>
      </div>
  {!! Form::close() !!}

@endsection
