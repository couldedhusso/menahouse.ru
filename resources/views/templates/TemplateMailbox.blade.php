<!DOCTYPE html>

<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="ThemeStarz">

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,700' rel='stylesheet' type='text/css'>

    <link href="{{ asset('assets/fonts/font-awesome.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ elixir("css/all.css") }}">

    <title>@yield('Title')</title>

    <style> 


        
    </style>

</head>

<body class="page-sub-page page-create-account page-account" id="page-top" ng-app="mena">
<!-- Wrapper -->
<div class="wrapper">
    <div class="navigation">
        <div class="secondary-navigation">
            <div class="container">
                <div class="contact">
                    <figure><strong>Тел.:</strong>+7 999-123-4567</figure>
                    <figure><strong>Email:</strong>mena@yandex.ru</figure>
                </div>
                <div class="user-area">
                    <div class="actions">
                      {{-- @if(!Auth::check())
                         <a href="{{ url('dashboard/advertisement/add') }}" title="Разместить объявление своей квартиры бесплатно!" class="promoted"><strong>Разместить объявление</strong></a>
                      @else
                        @if($show_link)
                          <a href="{{ url('/sign-in')}}" title="Разместить объявление своей квартиры бесплатно!" class="promoted"><strong>Разместить объявление</strong></a>
                        @endif
                      @endif --}}
                    </div>
                </div>
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
                        <a href="{{url('/')}}"> <img src="{{asset('static/assets/img/logo.png')}}" alt="Менахаус" title="Менахаус"></a>
                    </div>
                </div>

                <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                    <ul class="nav navbar-nav">

                          <li class="has-child"><a href="#" title="Основное личное меню пользователя"><i class="fa fa-user fa-fw"></i>&nbsp;Личный кабинет</a>
                              <ul class="child-navigation">
                                    <li><a href="{{ url('/mailbox/inbox') }}" title="Проверить новые сообщения, вам должно повезти" class="list-group-item"><i class="fa fa-envelope-o"></i>&nbsp; Сообщения мне &nbsp;<span class="badge-red" align="right">@include('messenger.unread-count')</span></a></li> <!-- CZ кол-во сообщений выводится из базы -->
                                    <li><a href="{{ url('/me/obyavlenie') }}" title="Проверить и добавить новое объявление"><i class="fa fa-th-list"></i>&nbsp; Мои объявления</a></li>
                                    {{-- <li><a href="#" title="Активировать дополнительные функции сайта"><i class="fa fa-rub"></i>&nbsp; Оплата</a></li> --}}
                                    <li><a href="{{ url('/me/account')}}" title="Настройки пользователя и сайта"><i class="fa fa-cog"></i>&nbsp; Настройки</a>
                                    <li><a href="{{ url('/auth/logout') }}" title="Обязательно зайдите завтра проверить новые сообщения!"><i class="fa fa-sign-out"></i>&nbsp;Выход</a></li>
                              </ul>
                          </li>

                    </ul>
                </nav><!-- /.navbar collapse-->

            </header><!-- /.navbar -->
        </div><!-- /.container -->
    </div><!-- /.navigation -->

    <!-- Page Content -->
    <div id="page-content">
        <!-- Breadcrumb -->
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">Главная</a></li>
                @yield('active_breadcrumb')
            </ol>
        </div>
        <!-- end Breadcrumb -->

        <div class="container">
            <div class="row">
              <!-- sidebar -->
              @if(Session::has('flash_message'))
                <div class="alert alert-info text-center">
                  <strong>Внимание! </strong> {{ Session::get('flash_message') }}&nbsp;
                <a href="{{url('dashboard/advertisement/add')}}">Разместить объявление</a>
               </div>
              @endif
                <div class="col-md-3 col-sm-2">
                    <section id="sidebar">
                        <header><h3>Личный кабинет</h3></header>
                        @yield('sidebar')
                        {{-- @include('layouts.partials.sidebar') --}}
                    </section><!-- /#sidebar -->
                </div><!-- /.col-md-3 -->
              <!-- end Sidebar -->

                <div>
                    @yield('content')
                </div><!-- /.col-md-9 -->

            </div>

        </div><!-- /.container -->
    </div>
    <!-- end Page Content -->
    <!-- Page Footer -->
    <footer id="page-footer">
        <div class="inner">
            <section id="footer-copyright">
                <div class="container">
                    <span>RADEXO Copyright © 2015. All Rights Reserved.</span>
                    <span class="pull-right"><a href="#page-top" class="roll"><i class="fa fa-arrow-up">&nbsp; вернуться</i></a></span>
                </div>
            </section>
        </div><!-- /.inner -->
    </footer>
    <!-- end Page Footer -->
</div>


<script type="text/javascript" src="{{asset('assets/js/jquery-2.1.0.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/jquery-migrate-1.2.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/smoothscroll.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/bootstrap-select.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/icheck.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/retina-1.1.0.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/fileinput.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/custom.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/angular/vendor/angular.min.js') }}"></script>
<script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.11.0.js"></script>

<script type="text/javascript" src="{{ asset('js/src/menahouseInit.js') }} "></script>

{{-- <script type="text/javascript" src="{{asset('js/scr/mailbox.js')}}"></script> --}}

<!--[if gt IE 8]>
<script type="text/javascript" src="{{asset('assets/js/ie.js')}}"></script>
<![endif]-->

{{-- <script type="text/javascript">
$(function () {
    $("div.table").slice(0, 1).show();
    $("#arrow-right").on('click', function (e) {
        e.preventDefault();
        $("div.table:hidden").slice(0, 1).slideDown();
        if ($("div.table:hidden").length == 0) {
            $("#load").fadeOut('slow');
        }
        $('html,body').animate({
            scrollTop: $(this).offset().top
        }, 1500);
    });
});


$(function () {
    $("div.mail-box").slice(0, 4).show();
    $("#loadMore").on('click', function (e) {
        e.preventDefault();
        $("div.property:hidden").slice(0, 4).slideDown();
        if ($("div.property:hidden").length == 0) {
            $("#load").fadeOut('slow');
        }
        $('html,body').animate({
            scrollTop: $(this).offset().top
        }, 1500);
    });
});

</script> --}}

</body>
</html>
