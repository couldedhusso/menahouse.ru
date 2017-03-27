<!DOCTYPE html>

<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="ThemeStarz">

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,700' rel='stylesheet' type='text/css'>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

   <link rel="stylesheet" href="{{ asset('css/vendor/jquery.bxslider.css') }}" type="text/css">
   <!-- <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css"> -->
   <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}" type="text/css">
   <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-select.min.css') }}" type="text/css">
   <link rel="stylesheet" href="{{ asset('assets/css/jquery.slider.min.css') }}" type="text/css">
   <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css') }}" type="text/css">
   <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}" type="text/css">
   <link rel="stylesheet" href="{{ asset('assets/css/owl.transitions.css') }}" type="text/css">

   <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" type="text/css">

   <link rel="stylesheet" href="{{ asset('css/theproject.css') }}" type="text/css">
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


  <div class="modal fade" id="connexionModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-container cls-modal ">

            <div class="modal-header">
                    <div>
                         <h3> Единый вход</h3>
                    </div>
            </div>

            <div class="modal-body">
                <div>
                  <form method="post" action="/auth/login">

                        <input name="_token" type="hidden" value="{!! csrf_token() !!}" />
                        <div class="form-group">
                            <input id="email" name="email" placeholder="Электронная почта" required="" type="email">
                        </div>
                        <div class="form-group">
                            <input id="password" name="password" placeholder="Пароль" required="" type="password">
                        </div>
                        <div class="form-group">
                          <input type="submit" name="name" value="Войти">
                        </div>
                    </form>
               </div>
            </div>

            <div class="modal-footer">
                <div>
                  <footer>
                      <a href="/password_resets/create" class="utility-muted-link utility-left">
                          Забыли пароль ?
                      </a>
                      <a href="/join" class="utility-muted-link utility-right">
                          Присоединиться
                      </a>
                  </footer>
               </div>
            </div>

        </div>

  </div>



    {{-- <div style="display: none;" class="modal-mask modal-transition" id="connexionModal" tabindex="-1" role="dialog">


        </div> --}}
    <!-- Page Content -->
    <div id="page-content" class="cls-wrapper">
        <section id="our-services" class="block">
            <div class="container">
                @yield('content')
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
                                <img alt="" src="{{asset('assets/img/client-01.jpg')}}">
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
 <script src='https://www.google.com/recaptcha/api.js'></script>
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
<!-- <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }} "></script> -->
<script type="text/javascript" src="{{ asset('js/vendor/jquery.bxslider.js') }} "></script>
<script>
    $(window).load(function(){
        initializeOwl(false);
    });

    $('.bxslider').bxSlider({
      pagerCustom: '#bx-pager'
    });

    $('#sendMsgFormModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this)
      modal.find('.modal-title').text('Новое сообщение пользователю ' + recipient)

    })
</script>


</body>
</html>
