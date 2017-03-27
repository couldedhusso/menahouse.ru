<div class="secondary-navigation">
          <div class="container">
              <div class="contact">
                  <figure><strong>Тел.:</strong>+7 999-123-4567</figure>
                  <figure><strong>Email:</strong>mena@yandex.ru</figure>
              </div>
              <div class="user-area">
                  <div class="actions">
                    @if(Auth::check())
                        <a  class="promoted cls-avatar" href=""> @include('sessions.user_img')
                         <strong>{{ Auth::user()->familia ." ". Auth::user()->imia }}</strong>  <span class="sr-only">(current) </span>
                        </a>
                        <a href="{{ url('/auth/logout') }}">Выйти</a>
                    @else
                      <a href="{{ url('/sign-up') }}" class="promoted"><strong>Регистрация</strong></a>
                      <a href="{{ url('/sign-in') }}">Войти</a>
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
                      <a href="#"><img src="{{asset('assets/img/logo.png')}}" alt="Менахаус" title="Менахаус"></a>
                  </div>
              </div>
              <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                  <ul class="nav navbar-nav">
                      <li><a href="#">Домой</a>
                      </li>
                      <!-- <li class="has-child"><a href="#">Список</a>
                          <ul class="child-navigation">
                              <li><a href="detail.html">Полное объявление</a></li>
                              <li><a href="listing.html">Список объявлений</a></li>
                          </ul>
                      </li> -->
                      <li class="has-child"><a href="#">Блог</a>
                          <ul class="child-navigation">
                              <li><a href="blog.html">Блог</a></li>
                              <li><a href="info.html">Информация</a></li>
                          </ul>
                      </li>
                      <li><a href="contact.html">Контакты</a></li>
                  </ul>
              </nav><!-- /.navbar collapse-->
              {{-- <div class="add-your-property">
                  @if(Auth::check())
                      <a href="{{ url('/dashboard/nedvizhimosts/add') }}" class="btn btn-default"><i class="fa fa-plus"></i><span class="text">Разместить объявление</span></a>
                  @else
                      <a href="{{ url('/sign-in') }}" class="btn btn-default"><i class="fa fa-plus"></i><span class="text">Разместить объявление</span></a>
                  @endif

              </div> --}}
          </header><!-- /.navbar -->
      </div><!-- /.container -->
