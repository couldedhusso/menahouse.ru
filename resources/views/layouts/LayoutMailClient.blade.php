<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="" ng-app> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Mena |  Mail box</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"
      rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.rawgit.com/olton/Metro-UI-CSS/master/build/css/metro-icons.min.css">
    <link rel="stylesheet" href="{{ elixir('css/all.css') }}">

    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body id="top">
    {{-- @include('layouts.partials.nav') --}}

{{-- mdl-color--grey-100 --}}
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <header class="demo-header mdl-layout__header mdl-color--white mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
          {{-- <div class="container">
              <span class="mdl-layout-title branding">MENAHOUSE</span>
              <div class="mdl-layout-spacer"></div>
          </div> --}}
  <span class="mdl-layout-title branding">MENAHOUSE</span>
{{--
          <ul class="cls-ul place-right">
                  <li ><a href="{{url('/')}}"><span class="mif-mail"></span> сообщения</a></li>
                  <li ><a href="{{url('/')}}"><span class="mif-switch"></span> Выход</a></li>
          </ul> --}}


        </div>
      </header>
      {{-- mdl-color--grey-100 --}}
      <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
   <header class="demo-drawer-header">
     @include('sessions.avatar-user')
     {{-- <img src="//www.gravatar.com/avatar/{!! md5(Auth::user()->email) !!}?s=64" class="img-circle demo-avatar"> --}}
     {{-- <img src="{{ asset('storage/profil').'/'.$userprofile->images->path }}" class="img-circle demo-avatar"> --}}
     <div class="demo-avatar-dropdown">
       <span>ID : {!! Auth::user()->id !!}</span>
       <div class="mdl-layout-spacer"></div>
       <button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
         <i class="material-icons" role="presentation">arrow_drop_down</i>
         <span class="visuallyhidden">Accounts</span>
       </button>
       <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn">
         <li><a class="mdl-menu__item" href="{{url('auth/logout')}}">Завершить работу </a></li>
         {{-- <li class="mdl-menu__item">info@example.com</li>
         <li class="mdl-menu__item"><i class="material-icons">add</i>Add another account...</li> --}}
       </ul>
     </div>
   </header>
   <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
     <a class="mdl-navigation__link" href="{{ url('/dashboard/nedvizhimosts') }}"><i class="material-icons mdl-color-text--blue-grey-400" role="presentation">arrow_back</i>Назад</a>
          <a class="mdl-navigation__link" href="{{ url('messages/') }}" ><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">move_to_inbox</i>Входящие &nbsp;  <span class="badge">@include('messenger.unread-count')</span></a>
          <a class="mdl-navigation__link" href="{{ url('message/izbrannie') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">favorite</i>Избранное </a>
          <a class="mdl-navigation__link" href="{{ url('message/otpravlenie/') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">send</i>Отправленные</a>
          <a class="mdl-navigation__link" href="{{ url('/message/udalinie') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">delete</i> Удаленные </a>

          {{-- <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">shopping_cart</i>Purchases</a>--}}
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">forum</i>Forums</a>
          <div class="mdl-layout-spacer"></div>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">help_outline</i><span class="visuallyhidden">Help</span></a>
   </nav>
 </div>
      <main class="mdl-layout__content">
           @yield('content')
      </main>
    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://storage.googleapis.com/code.getmdl.io/1.0.5/material.min.js"></script>

    <script src="{{ elixir('js/all.js') }}"></script>
    </script>

</body>
</html>
