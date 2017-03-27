@extends('templates.TemplateAccountUser')

@section('content')

<header><h1>Регистрация</h1></header>
<div class="row">
    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
        <form role="form" id="form-create-account" method="post" action="/auth/register" >
            <div class="center">
                <figure class="note">Если у вас уже есть аккаунт, нажмите кнопку &nbsp;<a href="{{ url('/sign-in') }}"><strong><ins>Войти</ins></strong></a></figure>
            </div>

            <hr>
            <div class="form-group">
                <label for="form-create-account-full-name">ФИО:</label>
                <input type="text" class="form-control" name="fio" id="form-create-account-full-name" title="Укажите ФИО" required>
            </div><!-- /.form-group -->

            <div class="form-group">
                <label for="form-create-account-email">Email:</label>
                <input type="email" class="form-control" name="email" id="form-create-account-email" title="Укажите Ваш адрес электронной почты" required>
            </div><!-- /.form-group -->

            <div class="form-group">
                <label for="form-create-agency-phone">Номер телефона:</label>
                <input type="tel" class="form-control" name="phonenumber" id="form-create-agency-phone" title="Укажите Ваш номер телефона" required>
            </div><!-- /.form-group -->

            <div class="form-group">
                <label for="form-create-account-password">Пароль:</label>
                <input type="password" class="form-control" name="password" id="form-create-account-password" title="Минимальная длина пароля 8 символов" required>
            </div><!-- /.form-group -->

            <div class="form-group">
                <label for="form-create-account-confirm-password">Подтверждение пароля:</label>
                <input type="password" class="form-control" name="password_confirmation" id="form-create-account-confirm-password" title="Подтвердите введёный пароль" required>
            </div><!-- /.form-group -->

            <div class="checkbox pull-left">
                <label>
                    <input type="checkbox" id="account-type-accept" name="account-accept"> Согласен с правилами
                </label>
            </div>

            <div class="form-group clearfix">
                <button type="submit" class="btn pull-right btn-success" id="account-submit" title="Зарегистрироваться на сайте">&nbsp; &nbsp; Регистрация &nbsp; &nbsp;</button> <!-- CZ регистрация -->
            </div><!-- /.form-group -->
        </form>
        <div class="center">
        <figure class="note"><i class="fa fa-lock"></i>&nbsp; Ваши данные ни при каких обстоятельствах не будут переданы третьим лицам</figure>
        </div>
        <hr>
        <div class="center">
            <figure class="note">Нажимая кнопку  “Регистрация” вы принимаете <a href="{{url('terms-conditions')}}">Правила нашего сайта</a></figure>
        </div>
    </div>
</div><!-- /.row -->
</br>
</br>
</br>
</br>
</br>
</br>

@endsection
