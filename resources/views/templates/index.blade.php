<!DOCTYPE html>

<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="ThemeStarz">

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,700' rel='stylesheet' type='text/css'>
    <link href="assets/fonts/font-awesome.css" rel="stylesheet" type="text/css">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">


    <link rel="stylesheet" href="{{ elixir("css/all.css") }}">

    <title>Mena | Homepage</title>

</head>

<body class="page-homepage navigation-fixed-top page-slider horizontal-search-float"  ng-controller="mainController"
            id="page-top" data-spy="scroll" data-target=".navigation" data-offset="90">
<!-- Wrapper -->
<div class="wrapper">
    <!-- Navigation -->
    <div class="navigation">
        <div class="secondary-navigation">
            <div class="container">
                <div class="contact">
                    <figure><strong>Тел.:</strong>+7 999-123-4567</figure>
                    <figure><strong>Email:</strong>mena@yandex.ru</figure>
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
                                  {{-- <li><a href="#" title="Активировать дополнительные функции сайта"><i class="fa fa-rub"></i>&nbsp; Оплата</a></li> --}}
                                  <li><a href="{{ url('/me/account')}}" title="Настройки пользователя и сайта"><i class="fa fa-cog"></i>&nbsp; Настройки</a>
                                  <li><a href="{{ url('/auth/logout') }}" title="Обязательно зайдите завтра проверить новые сообщения!"><i class="fa fa-sign-out"></i>&nbsp;Выход</a></li>
                              </ul>
                          </li>
                          {{-- <li>
                            <a href="{{ url('/dashboard/advertisement/add') }}" class="btn btn-white-green" title="Разместить объявление своей квартиры бесплатно!"><i class="fa fa-plus"></i>&nbsp; Разместить объявление</a>
                          </li> --}}
                        
                                <li>&nbsp;&nbsp;&nbsp;</li>
                                <a href="{{ url('/dashboard/advertisement/add') }}"  class="btn btn-white-green" 
                                        title="Разместить объявление своей квартиры бесплатно!">
                                        <i class="fa fa-plus"> </i>&nbsp; Разместить объявление
                                 </a>
                        @else

                        <li><a href="{{ url('/sign-in') }}" title="Войти на сайт или пройти быструю регистрацию" style="margin-top: -3px; margin-right: 15px"><p><i class="fa fa-sign-in" aria-hidden="true">&nbsp; Войти </i></p></a></li>
                        <a href="{{ url('/sign-in') }}" class="btn btn-white-green" title="Разместить объявление своей квартиры бесплатно!"><i class="fa fa-pencil-square-o"></i>&nbsp; Разместить объявление</a>
                        @endif

                    </ul>
                </nav><!-- /.navbar collapse-->
            </header><!-- /.navbar -->
        </div><!-- /.container -->
    </div><!-- /.navigation -->

    <!-- Slider -->
    <div id="slider" class="loading has-parallax">
        <div id="loading-icon"><i class="fa fa-cog fa-spin"></i></div>
        <div class="owl-carousel homepage-slider carousel-full-width">
            <div class="slide">
                <div class="container">
                    <div class="overlay">
                        <div class="info">
                            <div class="tag title-action">цена всего 11,000,000</div>
                            <h3>H3 Важный заголовок</h3>
							<h4>H4 Крутой текст</h4>
                            <figure>Подзаголовок</figure>
                        </div>
                        <hr>
                        <a href="property-detail.html" class="link-arrow">Продолжить</a>
                    </div>
                </div>
                <img alt="" src="{{asset('static/assets/img/slide-01.jpg')}}">
            </div>
            <div class="slide">
                <div class="container">
                    <div class="overlay">
                        <div class="info">
                            <div class="tag title-action">площадь 186 м^2</div>
                            <h3>H3 Важный заголовок</h3>
                            <figure>Подзаголовок</figure>
                        </div>
                        <hr>
                        {{-- property-detail.html --}}
                        <a href="#" class="link-arrow">Узнать</a>
                    </div>
                </div>
                <img alt="" src="{{asset('static/assets/img/slide-02.jpg')}}">
            </div>
            <div class="slide">
                <div class="container">
                    <div class="overlay">
                        <div class="info">
                            <div class="tag title-action">только 3 дня!</div>
                            <h3>H3 Важный заголовок</h3>
                            <figure>Подзаголовок</figure>
                        </div>
                        <hr>
                        <a href="property-detail.html" class="link-arrow">Получить!</a>
                    </div>
                </div>
                <img alt="" src="{{asset('static/assets/img/slide-03.jpg')}}">
            </div>
        </div>
    </div>
    <!-- end Slider -->

	<!-- Search Box -->
    <div class="search-box-wrapper">
        <div class="search-box-inner">
            <div class="container">
                <div class="search-box map">
<br>
                   <form role="form" id="form-map-sale" class="form-map form-search clearfix" method="post" action="menahouse/recherches">
                        <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
                        <input name="_index_r" type="hidden" value="1" />

                        <div class="row">
                          <div class="col-md-1">
                          </div>
                            <div class="col-md-3 col-sm-4">
                                <div class="form-group">
                                    {{-- <select name="gorod" ng-model="qs.gorod">
                                        <option value="">Город</option>
                                        <option value="Москва">Москва</option>
                                        <option value="Московская область">Московская область</option>
                                        <option value="Новая Москва">Новая Москва</option>
                                    </select> --}}

                                    <select name="gorod">
                                        <option value="">Город</option>
                                        <option value="1">Москва</option>
                                        <option value="2">Московская область</option>
                                        <option value="3">Новая Москва</option>
                                    </select>


                                </div><!-- /.form-group -->
                            </div>

                            <div class="col-md-4 col-sm-4">
                                <div class="form-group">
                                    <select name="type_nedvizhimosti">
                                        <option value="">Тип жилья</option>
                                        {{-- <option value="Комната">Комната</option>
                                        <option value="Квартира">Квартира</option>
                                        <option value="Частный дом">Частный дом</option>
                                        <option value="Новостройки">Новостройки</option> --}}

                                        <option value="1">Комната</option>
                                        <option value="2">Квартира</option>
                                        <option value="3">Частный дом</option>
                                        <option value="4">Новостройки</option>

                                    </select>

                                </div><!-- /.form-group -->
                            </div>
							<!-- <div class="col-md-3 col-sm-4">
                                <div class="form-group">
                                    <select name="form-sale-number-room" data-ng-model ="search.number_room">
                                        <option value="">Кол-во комнат</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5+</option>
                                    </select>
                                </div><!-- /.form-group
                            </div> -->
                            <div class="col-md-3 col-sm-4">
                                <div class="form-group">
                                   {{-- <button type="submit" data-ng-click = "processForm(search)" class="btn btn-default">Искать</button>  action="properties/all" --}}
                                   <button type="submit"  class="btn btn-default">Искать</button>
                                </div><!-- /.form-group -->
                            </div>
							<div class="col-md-12 col-sm-12">
								<hr>
							</div>
              <div class="col-md-1">
              </div>
              {{--
                  TODO : chercher non pas les types de proprietes a Moscou mais plustot
                            faire une recherche en RF.
                            Donc remplacer par exemple url('/catalogue/houses/Moskva/1') par
                            url('/catalogue/houses/1')

              --}}

              <div class="col-md-3 col-sm-4">
                <article>

                              
                  <ul class="list-unstyled list-links">
                        <li>
                               <a href="{{ url('s/'.$houses[0][0]) }}">
                                  Однокомнатные квартиры - {{$houses[0][1]}}
                               </a>
                        {{-- <a href="{{ url($houses[0][0]) }}" align="center">Однокомнатные квартиры - {{$houses[0][1]}}</a> --}} 
                        </li>


                        <li>
                               <a href="{{ url('s/'.$houses[1][0]) }}">
                                    Двухкомнатные квартиры - {{$houses[1][1]}}
                               </a>
                               {{-- <form id="tworooms" action="{{ url('/api/search') }}" method="POST" style="display: none;">
                                   {{ csrf_field() }}
                                   <input type="hidden" name="redirect_url" value="{{$houses[1][0]}}">
                                   <input type="hidden" name="kolitchestvo_komnat" value="2">
                               </form> --}}
                        </li>
                        {{-- <li><a href="{{ url($houses[1][0]) }}" align="center">Двухкомнатные квартиры - {{$houses[1][1]}}</a></li> --}}
                  </ul>
                </article>
              </div><!-- /.col-sm-3 -->
              <div class="col-md-4 col-sm-4">
                <article>
                  <ul class="list-unstyled list-links" align="center">

                      <li>

                               <a href="{{ url('s/'.$houses[2][0]) }}"> 
                                    Трехкомнатные квартиры - {{$houses[2][1]}}
                               </a>


                               {{-- <a href="{{ url($houses[2][0]) }}" onclick="event.preventDefault();
                                 document.getElementById('threerooms').submit();"> Трехкомнатные квартиры - {{$houses[2][1]}}
                               </a>
                               <form id="threerooms" action="{{ url('/api/search') }}" method="POST" style="display: none;">
                                   {{ csrf_field() }}
                                   <input type="hidden" name="redirect_url" value="{{$houses[2][0]}}">
                                   <input type="hidden" name="kolitchestvo_komnat" value="3">
                               </form> --}}
                        </li>

                        <li>

                                <a href="{{ url('s/'.$houses[3][0]) }}"> 
                                    Квартиры четыре+ комнаты - {{$houses[3][1]}}
                                </a>
                        </li>
                  </ul>
                </article>
              </div><!-- /.col-sm-3 -->
              <div class="col-md-3 col-sm-4">
                <article>
                  <ul class="list-unstyled list-links">
                       <li>
                            <a href="{{ url('s/'.$houses[4][0]) }}"> 
                                Частные дома - {{$houses[4][1]}}
                            </a>
                        </li>

                        <li>
                             <a href="{{ url('s/'.$houses[5][0]) }}">
                                 Новостройки - {{$houses[5][1]}}
                             </a>
                        </li>
                  </ul>
                </article>
              </div><!-- /.col-sm-3 -->
						</div>

                    </form><!-- /#form-map -->
                </div><!-- /.search-box -->
            </div><!-- /.container -->
			<br>
        </div><!-- /.search-box-inner -->
        <div class="background-image"><img class="opacity-20" src="assets/img/searchbox-bg.jpg"><br><br></div>


    </div>
    <!-- end Search Box -->

    <!-- Page Content -->
    <div id="page-content">
        <section id="our-services" class="block">
            <div class="container">
                <header class="section-title"><h2>Обмен квартир</h2></header>
                <div class="row">
					<br>
                    <div class="col-md-4 col-sm-4">
                        <div class="feature-box equal-height">
                            <figure class="icon"><i class="fa fa-bug" aria-hidden="true"></i></figure>
                            <aside class="description">
                                <header><h3>Безопасно</h3></header>
                                <p>Без риэлторов, посредников и прочих! <br>
                                Вы общаетесь исключительно с собственниками напрямую</p><br>
                                <a href="{{url("#")}}" class="link-arrow">Подробнее</a>
							</aside>
							<br>
                        </div><!-- /.feature-box -->
                    </div><!-- /.col-md-4 -->
                    <div class="col-md-4 col-sm-4">
                        <div class="feature-box equal-height">
                            <figure class="icon"><i class="fa fa-check-square-o" aria-hidden="true"></i></figure>
                            <aside class="description">
                                <header><h3>Самостоятельно</h3></header>
                                <p>Нашли, посмотрели, договорились. Мы поможем со всеми документами Без переплат и скрытых условий!</p><br>
                                <a href="{{url("#")}}" class="link-arrow">Подробнее</a>
              </aside>
                            </aside>
							<br>
                        </div><!-- /.feature-box -->
                    </div><!-- /.col-md-4 -->
                    <div class="col-md-4 col-sm-4">
                        <div class="feature-box equal-height">
                            <figure class="icon"><i class="fa fa-users" aria-hidden="true"></i></figure>
                            <aside class="description">
                                <header><h3>С каждым днём больше</h3></header>
                                <p>Расскажите Вашим Друзьям, и Друзьям Друзей<br>
                                 Больше Объявлений позволят найти лучший вариант</p><br>
                                 <a href="{{url("#")}}" class="link-arrow">Подробнее</a>
               </aside>
                            </aside>
							<br>
                        </div><!-- /.feature-box -->
                    </div><!-- /.col-md-4 -->
                </div><!-- /.row -->
				<br>
            </div><!-- /.container -->
        </section><!-- /#our-services -->

        {{-- <section id="testimonials" class="block">
            <div class="container">
                <header class="section-title"><h2>Отзывы</h2></header>
                <div class="owl-carousel testimonials-carousel">
                    <blockquote class="testimonial">
                        <figure>
                            <div class="image">
                                <img alt="" src="{{asset('assets/img/client-01.jpg')}}">
                            </div>
                        </figure>
                        <aside class="cite">
                            <p>Бла-бла-бла Я молодой и энергичный человек. Это мега крутой сайт, он мне помог и всё было очень живенько и круто. Спасибо!</p>
                            <footer>Настоящий человек</footer>
                        </aside>
                    </blockquote>
                    <blockquote class="testimonial">
                        <figure>
                            <div class="image">
                                <img alt="" src="{{asset('assets/img/client-01.jpg') }}">
                            </div>
                        </figure>
                        <aside class="cite">
                            <p>Я старый и сворливый человек. Мне ничего не нравится и всё раздражает. Обменял свою квартиру в центре на окраину, сэкономил уйму времени и денег.</p>
                            <footer>Настоящий человек старший</footer>
                        </aside>
                    </blockquote>
                </div><!-- /.testimonials-carousel -->
            </div><!-- /.container -->
        </section><!-- /#testimonials --> --}}

    </div>
    <!-- end Page Content -->

        

        @if(!Auth::check())

          <aside id="advertising" class="block">
              <div class="container">
                  <a href="{{ url('/sign-up') }}">
                      <div class="banner">
                          <div class="wrapper">
                              <span class="title">Попробуйте, месяц бесплатно!</span>
                              <span class="submit">Присоединиться! <i class="fa fa-plus-square"></i></span>
                          </div>
                      </div><!-- /.banner-->
                  </a>
              </div>
          </aside><!-- /#adveritsing-->

        @endif
<br><br>
    <!-- Page Footer -->
    <footer id="page-footer">
        <div class="inner">
            <aside id="footer-main">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <article>
                                <h3>Информация</h3>
                                <p>Дополнительная информация по сайту<br>
								можно дать список популярный станций метро в пару столбиков<br>
								или другую необходимую SEO информацию
                                </p>
                                <hr>
                                <a href="#" class="link-arrow">продолжить</a>
                            </article>
                        </div><!-- /.col-sm-6 -->
                        <div class="col-md-3 col-sm-3">
                            <article>
                                <h3>Контакты</h3>
                                <address>
                                    <strong>Mena</strong><br>
                                    физический адрес<br>
                                    юридический адрес
                                </address>
                                +7 (999) 123-4567<br>
								+7 (999) 123-4566<br>
                                <a href="#">mena@example.com</a>
                            </article>
                        </div><!-- /.col-sm-3 -->
                        <div class="col-md-3 col-sm-3">
                            <article>
                                <h3>Меню</h3>
                                <ul class="list-unstyled list-links">
                                    <li><a href="#">Карта сайта</a></li>
                                    <li><a href="#">Поиск по карте</a></li>
                                    <li><a href="#">Спецпредложения</a></li>
                                    <li><a href="#">Честный обмен</a></li>
                                    <li><a href="#">Подбор ипотеки</a></li>
                                </ul>
                            </article>
                        </div><!-- /.col-sm-3 -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </aside><!-- /#footer-main -->
            <aside id="footer-thumbnails" class="footer-thumbnails"></aside><!-- /#footer-thumbnails -->
            <aside id="footer-copyright">
                <div class="container">
                    <span>RADEXO Copyright © 2015. All Rights Reserved.</span>
                    <span class="pull-right"><a href="#page-top" class="roll"><i class="fa fa-arrow-up">&nbsp; вернуться</i></a></span>
                </div>
            </aside>
        </div><!-- /.inner -->
    </footer>
    <!-- end Page Footer -->
</div>

<div id="overlay"></div>

<script src="{{asset('js/lib/menahouse_vendor.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/src/menahouseInit.js') }} "></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::render() !!}


<!--[if gt IE 8]>
<script type="text/javascript" src="assets/js/ie.js"></script>
<![endif]-->
<script>
    $(window).load(function(){
        initializeOwl(false);
    });
</script>
</body>
</html>
