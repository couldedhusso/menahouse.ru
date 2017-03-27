@extends('layouts.admin')

@section('content')
<div class="container">
  <div class="grid">
      <div class="row cells12">
          <div class="cell colspan12">
            <h3 class="text-light">Редактирование Профиля</h3>
              <hr>
                    {{-- <p>
                      Для того чтобы подавать объявления на <strong> www.mena.ru </strong> вам необходимо Ппдтвердите ваш E-mail и получить персональный ID.
                      После активации вы всегда сможете подтвердить  восстановить пароль, Разместить объявления а также внести изменения в настройки, изменить тариф и пр.
                    </p> --}}
          </div>
      </div>
   </div>

   <div class="grid">
     {!! Form::model($user->profile, array('route' => 'profil_edit', 'method' => 'post', 'files' => 'true')) !!}
     <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
     {!! csrf_field() !!}

       <!-- uer id -->
     <input name="user_id" type="hidden" value="{!! $user->id !!}" />
         <div class="row cells12">
            <div class="cell colspan8">
                <div class="grid">
                      <div class="row cells12">
                         <div class="cell colspan6">
                              <h5>Фамилия</h5>
                              <div class="full-size input-control text">
                                  <input type="text" name="familia">
                              </div>
                          </div>

                          <div class="cell colspan6">
                                <h5>Имя</h5>
                                <div class="full-size input-control text">
                                    <input type="text" name="imia">
                                </div>
                          </div>

                      </div>

                      <div class="row cells12">

                          <div class="cell colspan12">
                              <h5>Город</h5>
                              <div class="full-size input-control select">
                                <select name="gorod">
                                     <option value="">- Не выбрано -</option>
                                     <option value="Москва">Москва</option>
                                     <option value="Московская область">Московская область</option>
                                     <option value="Санкт-Петербург">Санкт-Петербург</option>
                                </select>
                              </div>
                          </div>

                      </div>


                    <div class="row cells12">

                      <div class="cell colpsan6">
                        <h5></h5>
                          <input type="submit"  value="Сохранить изменения" class="button primary">
                      </div>
                    </div>

                </div>
            </div>

            <div class="cell colspan4 cls-border">
                <div id="image-preview">
                    <label for="image-upload" id="image-label">Choose File</label>
                    <input type="file" name="image" id="image-upload" />
                </div>
            </div>
         </div>

     {!! Form::close() !!}
   </div>



</div>
@endsection
