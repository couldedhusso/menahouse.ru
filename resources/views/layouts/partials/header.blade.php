<div class="secondary-navigation">
           <div class="container">
               <div class="contact">
                   <figure><strong>Тел.:</strong>+7 999-123-4567</figure>
                   <figure><strong>Email:</strong>mena@yandex.ru</figure>
               </div>
               <div class="user-area">
                   <div class="actions">
                       {{-- <a href="create-account.html" class="promoted"><strong>Регистрация</strong></a>
                       <a href="sign-in.html">Войти</a> --}}
                       @if(Auth::check())
                           <a  class="promoted cls-avatar" href=""> <strong>{{ Auth::user()->familia ." ". Auth::user()->imia }}</strong>  <span class="sr-only">(current) </span></a>
                           <a href="{{ url('/auth/logout') }}">Выйти</a>
                       @endif

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
                       <a href="#"> <img src="assets/img/logo.png" alt="Менахаус" title="Менахаус"></a>
                   </div>
               </div>
               <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                   <ul class="nav navbar-nav">
                       <li class="has-child"><a href="#"> <div style="width:25px; height:25px;">

                       </div> @include('sessions.user_img') Личный кабинет</a>
                           <ul class="child-navigation">
                               <li><a title="Копировать" href="#" class="active"><img src="assets/img/icons/Copy Link-100.png" width="15" height="15" alt=""> &nbsp; {!! Auth::user()->imia !!} &nbsp; ID: {!! Auth::user()->id  !!} </a></li>
                               <li><a href="{{ url('/mailbox/inbox') }}">Сообщения <span class="badge-red" align="right">@include('messenger.unread-count')</span></a></li>
               <li><a href="{{ url('/dashboard/advertisements') }}">Мои объявления</a></li>
               <li><a href="{{ url('/dashboard/settings/'.Auth::user()->id )}}">Настройки</a></li>
                               <li><a href="#">Оплата</a></li>
                               <li><a href="{{ url('/auth/logout') }}">Выход</a></li>
                           </ul>
                       </li>
                   </ul>
               </nav><!-- /.navbar collapse-->
               {{-- <div class="add-your-property">
                   <a href="{{url('/dashboard/nedvizhimosts/add')}}" class="btn btn-green"><i class="fa fa-plus"></i><span class="text">Разместить объявление</span></a>
               </div> --}}
           </header><!-- /.navbar -->
</div><!-- /.container -->
