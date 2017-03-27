
 <!-- Navigation -->
<div class="navigation">
        <div class="secondary-navigation">
            <div class="container">
                <div class="contact">
                    <figure><strong>Тел.:</strong>+7 999-123-4567</figure>
                    <figure><strong>Email:</strong>mena@yandex.ru</figure>
                </div>
                {{-- <div class="user-area">
                    <div class="actions">
                        <a href="submit.html" title="Разместить объявление своей квартиры бесплатно!" class="promoted"><strong>Разместить объявление</strong></a>
                    </div>
                </div> --}}
            </div>
        </div>

<div class="container">

<header class="navbar" id="top" role="banner">
    <div class="navbar-header">
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="navbar-brand nav" id="brand">
            <a href="{{url('/')}}" > <img src="{{asset('static/assets/img/logo.png')}}" alt="Менахаус" title="Менахаус"></a>
        </div>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
        <ul class="nav navbar-nav">

            @if(Auth::check())

              <li class="has-child"><a href="#" title="Основное личное меню пользователя"><i class="fa fa-user fa-fw"></i>&nbsp;Личный кабинет</a>
                  <ul class="child-navigation">
                      <li><a href="{{ url('/mailbox/inbox') }}" title="Проверить новые сообщения, вам должно повезти" class="list-group-item"><i class="fa fa-envelope-o"></i>&nbsp; Сообщения мне &nbsp;<span class="badge-red" align="right">@include('messenger.unread-count')</span></a></li> <!-- CZ кол-во сообщений выводится из базы -->
                      <li><a href="{{ url('/me/obyavlenie') }}" title="Проверить и добавить новое объявление"><i class="fa fa-th-list"></i>&nbsp; Мои объявления</a></li>
                      <li><a href="{{ url('subscription-plan')}}" title="Активировать дополнительные функции сайта"><i class="fa fa-rub"></i>&nbsp; Оплата</a></li>
                      <li><a href="{{ url('/me/account')}}" title="Настройки пользователя и сайта"><i class="fa fa-cog"></i>&nbsp; Настройки</a>
                      <li><a href="{{ url('/auth/logout') }}" title="Обязательно зайдите завтра проверить новые сообщения!"><i class="fa fa-sign-out"></i>&nbsp;Выход</a></li>
                  </ul>
              </li>
              {{-- <li>
                <a href="{{ url('/dashboard/advertisement/add') }}" class="btn btn-white-green" title="Разместить объявление своей квартиры бесплатно!"><i class="fa fa-plus"></i>&nbsp; Разместить объявление</a>
              </li> --}}
              <li>&nbsp;&nbsp;&nbsp;</li>
              <a href="{{ url('/dashboard/advertisement/add') }}"  class="btn btn-white-green" title="Разместить объявление своей квартиры бесплатно!">
                 <i class="fa fa-plus"></i>&nbsp; Разместить объявление
              </a>
            @else

      <li><a href="{{ url('/sign-in') }}" title="Войти на сайт или пройти быструю регистрацию" style="margin-top: -3px; margin-right: 15px"><p><i class="fa fa-sign-in" aria-hidden="true">&nbsp; Войти </i></p></a></li>
      <a href="{{ url('/sign-in') }}" class="btn btn-white-green" title="Разместить объявление своей квартиры бесплатно!"><i class="fa fa-pencil-square-o"></i>&nbsp; Разместить объявление</a>
            @endif

        </ul>
    </nav><!-- /.navbar collapse-->
    {{-- <div class="add-your-property">

      @if(Auth::check())
          <a href="{{ url('/dashboard/nedvizhimosts') }}" class="btn btn-green"><i class="fa fa-plus"></i><span class="text">Разместить объявление</span></a>
      @else
          <a href="{{ url('/auth/login') }}" class="btn btn-green"><i class="fa fa-plus"></i><span class="text">Разместить объявление</span></a>
      @endif

    </div> --}}
</header><!-- /.navbar -->
</div><!-- /.container -->
</div><!-- /.navigation -->
