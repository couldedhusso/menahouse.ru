<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">

    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ url('/home') }}">HOME.RU</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
       <ul class="nav navbar-nav navbar-right">

         @if (Auth::check())
              <li><a href="{{ url('register') }}"> Привет!!  <strong>{{ Auth::user()->familia }}</strong>  <span class="sr-only">(current) </span></a></li>
              <li><a href="{{ url('/auth/logout') }}">Выход</a></li>

        @else
            <li><a href="{{ url('/join') }}"> Зарегистрироваться  <span class="sr-only">(current)</span></a></li>
            <li><a href="{{ url('/auth/login') }}">Вход</a></li>
       @endif

       </ul>
   </div>
 </div>
</nav>
