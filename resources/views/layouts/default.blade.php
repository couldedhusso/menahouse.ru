<!DOCTYPE html>

<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="ThemeStarz">

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,700' rel='stylesheet' type='text/css'>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

   <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}" type="text/css">

   <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-select.min.css') }}" type="text/css">
   <link rel="stylesheet" href="{{ asset('assets/css/jquery.slider.min.css') }}" type="text/css">
   <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css') }}" type="text/css">
   <link rel="stylesheet" href="{{ asset('assets/css/owl.transitions.css') }}" type="text/css">
   <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" type="text/css">
   <!-- <script type="text/javascript" src="{{ elixir('css/all.css') }}"></script> -->

   <title>Mena | Slider with Floated Horizontal Search Box Homepage</title>

</head>

<body class="page-homepage navigation-fixed-top page-slider horizontal-search-float" id="page-top" data-spy="scroll" data-target=".navigation" data-offset="90">
<!-- Wrapper -->
<div class="wrapper">

    <div class="navigation">
          @if(Auth::check())
                @include('layouts.partials.header')
          @else
                @include('layouts.partials.navibar')
          @endif
    </div><!-- /.navigation -->

    <!-- Slider -->
    <div id="slider" class="loading has-parallax">
        <div id="loading-icon"><i class="fa fa-cog fa-spin"></i></div>
        <div class="owl-carousel homepage-slider carousel-full-width">
            <div class="slide">
                <div class="container">
                    <div class="overlay">
                        <div class="info">
                            <div class="tag price">цена всего 11,000,000</div>
                            <h3>H3 Важный заголовок</h3>
							<h4>H4 Крутой текст</h4>
                            <figure>Подзаголовок</figure>
                        </div>
                        <hr>
                        <a href="property-detail.html" class="link-arrow">Продолжить</a>
                    </div>
                </div>
                <img alt="" src="{{ asset('img/hiro-bg.jpeg')}}">
            </div>
            <div class="slide">
                <div class="container">
                    <div class="overlay">
                        <div class="info">
                            <div class="tag price">площадь 186 м<sup>2</sup> </div>
                            <h3>H3 Важный заголовок</h3>
                            <figure>Подзаголовок</figure>
                        </div>
                        <hr>
                        <a href="property-detail.html" class="link-arrow">Узнать</a>
                    </div>
                </div>
                <img alt="" src="{{ asset('img/hiro-bg.jpeg')}}">
            </div>
            <div class="slide">
                <div class="container">
                    <div class="overlay">
                        <div class="info">
                            <div class="tag price">только 3 дня!</div>
                            <h3>H3 Важный заголовок</h3>
                            <figure>Подзаголовок</figure>
                        </div>
                        <hr>
                        <a href="property-detail.html" class="link-arrow">Получить!</a>
                    </div>
                </div>
                <img alt="" src="{{ asset('img/hiro-bg.jpeg')}} ">
            </div>
        </div>
    </div>
    <!-- end Slider -->

	<!-- Search Box -->
    <div class="search-box-wrapper">
        <div class="search-box-inner">
            <div class="container">
                <div class="search-box map">
                    <div class="tab-content">

                    <form role="form" id="form-map-sale" class="form-map form-search clearfix" method="post" action="house/catalogue">
                        <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
                        <div class="row">
                            <div class="col-md-2 col-sm-4">
                                <div class="form-group">
                                    <select name="form-sale-city">
                                        <option value="Москва">Москва</option>
                                    </select>
                                </div><!-- /.form-group -->
                            </div>
                            <div class="col-md-2 col-sm-4">
                                <div class="form-group">
                                    <select name="form-sale-district">
                                        <option value="">Район</option>
                                        <option value="ЦАО">ЦАО</option>
                                        <option value="ЗАО">ЗАО</option>
                                        <option value="ЮАО">ЮАО</option>
                                        <option value="ВАО">ВАО</option>
                                        <option value="САО">САО</option>
                                    </select>
                                </div><!-- /.form-group -->
                            </div>
                            <div class="col-md-2 col-sm-4">
                                <div class="form-group">
                                    <select name="form-sale-property-type">

                                        <option value="">Тип жилья</option>
                                        <option value="Квартира">Квартира</option>
                                        <option value="Частный дом">Частный дом</option>
                                        <option value="Коттедж">Коттедж</option>
                                        <option value="Дача">Дача</option>
                                    </select>
                                </div><!-- /.form-group -->
                            </div>
							              <div class="col-md-2 col-sm-4">
                                <div class="form-group">
                                    <select name="form-sale-number-room">
                                        <option value="">Кол-во комнат</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5+</option>
                                    </select>
                                </div><!-- /.form-group -->
                            </div>
                            <div class="col-md-2 col-sm-4">
                                <div class="form-group">
                                    {{-- <select name="form-sale-price"> --}}
                                    <select name="form-sale-surface">
                                        <option value="">Площадь</option>
                                        <option value="1">30-70 +</option>
                                        <option value="2">70-90 +</option>
                                        <option value="3">90-110 +</option>
                                        <option value="4">110 +</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-4">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default">Искать</button>
                                </div><!-- /.form-group -->
                            </div>
							<div class="col-md-12 col-sm-12">
								<hr>
							</div>
							<div class="col-md-4 col-sm-4">
								<article>
									<ul class="list-unstyled list-links">
										<li><a href="{{ url('/catalogue/houses/Moskva/1') }}">Однокомнатные квартиры</a></li>
										<li><a href="{{ url('/catalogue/houses/Moskva/2') }}">Двухкомнатные квартиры</a></li>
									</ul>
								</article>
							</div><!-- /.col-sm-3 -->
							<div class="col-md-4 col-sm-4">
								<article>
									<ul class="list-unstyled list-links">
										<li><a href="{{ url('/catalogue/houses/Moskva/3') }}">Трехкомнатные квартиры</a></li>
										<li><a href="{{ url('/catalogue/houses/Moskva/4') }}">Четырёхкомнатные квартиры</a></li>
									</ul>
								</article>
							</div><!-- /.col-sm-3 -->
							<div class="col-md-4 col-sm-4">
								<article>
									<ul class="list-unstyled list-links">
										<li><a href="{{ url('/catalogue/houses/Moskva/drugie_tip_domov') }}">Частные дома, коттеджи, таунхаусы</a></li>
										<li><a href="{{ url('/catalogue/houses/drugie_goroda') }}">В других городах России</a></li>
									</ul>
								</article>
							</div><!-- /.col-sm-3 -->

                        </div>

                    </div>
                    </form><!-- /#form-map -->
                </div><!-- /.search-box -->
            </div><!-- /.container -->
        </div><!-- /.search-box-inner -->
		<br><br><br>
    </div>
    <!-- end Search Box -->
	<br>
    <!-- Page Content -->
    <div id="page-content">
        <section id="our-services" class="block">
            <div class="container">
                <header class="section-title"><h2>Обмен квартир</h2></header>
                <div class="row">
					<br>
                    <div class="col-md-4 col-sm-4">
                        <div class="feature-box equal-height">
                            <figure class="icon"><i class="fa fa-folder"></i></figure>
                            <aside class="description">
                                <header><h3>Заголовок н3</h3></header>
                                <p>Первая супер причина почему вы с нами! И она звучит так... С нами и только с нами</p><br>
                                <a href="properties-listing.html" class="link-arrow">Подробнее</a>
							</aside>
							<br>
                        </div><!-- /.feature-box -->
                    </div><!-- /.col-md-4 -->
                    <div class="col-md-4 col-sm-4">
                        <div class="feature-box equal-height">
                            <figure class="icon"><i class="fa fa-folder"></i></figure>
                            <aside class="description">
                                <header><h3>Заголовок н3</h3></header>
                                <p>Вторая супер причина почему вы с нами! И она звучит так... А почему не с нами? Только с нами</p><br>
                                <a href="properties-listing.html" class="link-arrow">Подробнее</a>
                            </aside>
							<br>
                        </div><!-- /.feature-box -->
                    </div><!-- /.col-md-4 -->
                    <div class="col-md-4 col-sm-4">
                        <div class="feature-box equal-height">
                            <figure class="icon"><i class="fa fa-folder"></i></figure>
                            <aside class="description">
                                <header><h3>Заголовок н3</h3></header>
                                <p>Третья супер причина почему вы с нами! И она звучит так... Прочее бла-бла-бла </p><br>
                                <a href="properties-listing.html" class="link-arrow">Подробнее</a>
                            </aside>
							<br>
                        </div><!-- /.feature-box -->
                    </div><!-- /.col-md-4 -->
                </div><!-- /.row -->
					<br>
            </div><!-- /.container -->
        </section><!-- /#our-services -->

        <section id="banner">
            <div class="block has-dark-background background-color-default-darker center text-banner">
                <div class="container">
                    <h1 class="no-bottom-margin no-border">Это невероятно звучит - <a href="#" class="text-underline">Все обмены здесь</a>!</h1>
                </div>
            </div>
        </section><!-- /#banner -->


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
        <section id="testimonials" class="block">
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
        </section><!-- /#testimonials -->
        <section id="partners" class="block">
            <div class="container">
                <header class="section-title"><h2>Наши партнеры</h2></header>
                <div class="logos">
                    <div class="logo"><a href=""><img src="{{asset('assets/img/logo-partner-01.png') }}" alt=""></a></div>
                    <div class="logo"><a href=""><img src="{{asset('assets/img/logo-partner-02.png') }}" alt=""></a></div>
                    <div class="logo"><a href=""><img src="{{asset('assets/img/logo-partner-03.png') }} " alt=""></a></div>
                    <div class="logo"><a href=""><img src="{{asset('assets/img/logo-partner-04.png') }} " alt=""></a></div>
                    <div class="logo"><a href=""><img src="{{asset('assets/img/logo-partner-05.png') }} " alt=""></a></div>
                </div>
            </div><!-- /.container -->
        </section><!-- /#partners -->
    </div>
    <!-- end Page Content -->
    <!-- Page Footer -->
    <footer id="page-footer">
        <div class="inner">
            <aside id="footer-main">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <article>
                                <h3>Информация</h3>
                                <p>Много какого-то текста... бла-бла-бла<br>
								можно дать список станций метро<br>
								или другую SEO информацию
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
                                    Текст или адрес<br>
                                    Чуть больше текста
                                </address>
                                +7 (999) 123-4567<br>
                                <a href="#">mena@example.com</a>
                            </article>
                        </div><!-- /.col-sm-3 -->
                        <div class="col-md-3 col-sm-3">
                            <article>
                                <h3>Ссылочки</h3>
                                <ul class="list-unstyled list-links">
                                    <li><a href="#">Ссылка #1</a></li>
                                    <li><a href="#">Ссылка #2</a></li>
                                    <li><a href="#">Ссылка #3</a></li>
                                    <li><a href="#">Ссылка #4</a></li>
                                    <li><a href="#">Ссылка #5</a></li>
                                </ul>
                            </article>
                        </div><!-- /.col-sm-3 -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </aside><!-- /#footer-main -->
            <aside id="footer-thumbnails" class="footer-thumbnails"></aside><!-- /#footer-thumbnails -->
            <aside id="footer-copyright">
                <div class="container">
                    <span>Copyright © 2015. All Rights Reserved.</span>
                    <span class="pull-right"><a href="#page-top" class="roll">Наверх страницы</a></span>
                </div>
            </aside>
        </div><!-- /.inner -->
    </footer>
    <!-- end Page Footer -->
</div>

<div id="overlay"></div>
<script type="text/javascript" src="{{ asset('assets/js/jquery-2.1.0.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery-migrate-1.2.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/smoothscroll.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.placeholder.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/icheck.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.vanillabox-0.1.5.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/retina-1.1.0.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jshashtable-2.1_src.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.numberformatter-1.2.3.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/tmpl.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.dependClass-0.1.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/draggable-0.1.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.slider.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/custom.js') }}"></script>


<!--[if gt IE 8]>
<script type="text/javascript" src="{{ asset('assets/js/ie.js') }} "></script>
<![endif]-->
<script>
    $(window).load(function(){
        initializeOwl(false);
    });

    $('#btn_send_msg').click(function() {
      $('#exampleModal').modal();
    });
</script>
</body>
</html>
