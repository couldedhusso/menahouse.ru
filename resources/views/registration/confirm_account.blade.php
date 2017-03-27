@extends('layouts.LayoutPage')

@section('content')
  <div class="container">
    <div class="grid">
      <div class="rows cells12">

              <div class="cell colspan12">
                  <h3 class="text-light">Подтверждение регистрации</h3>
                  <hr>
                  <p>
                    Для того чтобы подавать объявления на <strong> www.mena.ru </strong> вам необходимо Ппдтвердите ваш E-mail и получить персональный ID.
                    После активации вы всегда сможете подтвердить  восстановить пароль, Разместить объявления а также внести изменения в настройки, изменить тариф и пр.
                  </p>
              </div>


              <div class="cell colspan12">
                  <h4 class="text-light">Для завершения регистрации, пожалуйста: </h4>
                  <h5> Подтвердите ваш E-mail </h5>
                  <p> Письмо с ссылкой на подтверждение выслано на адрес: {{ $email }}</p>
              </div>

      </div>

      <div class="rows cells12">
            <a  href="{{ url('/') }}"> <i class="fa fa-arrow-circle-o-left"></i> Вернуться в главную страницу </a>
      </div>

    </div>
  </div>
@endsection
