<!DOCTYPE html>

<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="ThemeStarz">

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,700' rel='stylesheet' type='text/css'>
    {{-- <link href="{{asset('assets/fonts/font-awesome.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-select.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/magnific-popup.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/jquery.slider.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/angular.rangeSlider.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/angular.rangeSlider.sm.css')}}" type="text/css"> --}}

    <link rel="stylesheet" href="{{asset('assets/css/_owl.carousel.css')}}" type="text/css">

    <link href="{{ asset('assets/fonts/font-awesome.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ elixir("css/all.css") }}">

    <link rel="stylesheet" href="{{asset('assets/css/angular.rangeSlider.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/angular.rangeSlider.sm.css')}}" type="text/css">

    <title>@yield('Title')</title>

</head>

<body class="page-sub-page page-property-detail" id="page-top" ng-app="App" ng-controller="mainController">
<!-- Wrapper -->
<div class="wrapper">

    <!-- Navigation -->
    {{-- <div class="navigation">
        <div class="secondary-navigation">
            <div class="container">
                <div class="contact" style="display:none">
                    <figure><strong>Тел.:</strong>+7 999-123-4567</figure>
                    <figure><strong>Email:</strong>mena@yandex.ru</figure>
                </div>
            </div>
        </div>
        <div class="container">
          <div class="container"> --}}
               @include('templates.NavTemplate')
          {{-- </div><!-- /.container -->
        </div><!-- /.container -->
    </div><!-- /.navigation --> --}}

    <!-- end Navigation -->

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
            <!-- Property Detail Content -->
            <div class="col-md-9 col-sm-9">
                @yield('content')
            </div>

            <!-- sidebar -->
            <div class="col-md-3 col-sm-3">
                  @include('layouts.partials.quick-search')
            </div><!-- /.col-md-3 -->
            <!-- end Sidebar -->
      </div>
    </div><!-- /.container -->
</div>

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

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=places"></script>
<script type="text/javascript" src="{{asset('static/assets/js/draggable-0.1.js')}}"></script>
<script type="text/javascript" src="{{asset('static/assets/js/jshashtable-2.1_src.js')}}"></script>
<script type="text/javascript" src="{{asset('static/assets/js/jquery.numberformatter-1.2.3.js')}}"></script>
<script type="text/javascript" src="{{asset('static/assets/js/tmpl.js')}}"></script>
<script type="text/javascript" src="{{asset('static/assets/js/jquery.dependClass-0.1.js')}}"></script>
<script type="text/javascript" src="{{asset('static/assets/js/jquery.slider.js')}}"></script>
<script type="text/javascript" src="{{asset('static/assets/js/jquery-2.1.0.min.js')}}"></script>
<script type="text/javascript" src="{{asset('static/assets/js/jquery-migrate-1.2.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('static/assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('static/assets/js/smoothscroll.js')}}"></script>
<script type="text/javascript" src="{{asset('static/assets/js/bootstrap-select.min.js')}}"></script>
<script type="text/javascript" src="{{asset('static/assets/js/jquery.validate.min.js')}}"></script>
<script type="text/javascript" src="{{asset('static/assets/js/icheck.min.js')}}"></script>
<script type="text/javascript" src="{{asset('static/assets/js/retina-1.1.0.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/markerwithlabel_packed.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/_owl.carousel.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/fileinput.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/custom-map.js')}}"></script>
<script type="text/javascript" src="{{asset('static/assets/js/custom.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/angular/vendor/angular.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/sm.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/angular.rangeSlider.js')}} "></script>

<script type="text/javascript" src="{{ asset('assets/js/infobox.js')}}"></script>

<script type="text/javascript" src="{{ asset('assets/js/jquery.placeholder.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/icheck.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/retina-1.1.0.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.raty.min.js')}}"></script>

{{-- <script type="text/javascript" src="{{ asset('assets/js/jquery.fitvids.js')}}"></script>
<script src="{{ asset('assets/js/jquery.tools.min.js')}}"></script>
<script src="{{ asset('assets/js/jquery.mobile.custom.min.js')}}"></script> --}}
<script src="{{ asset('assets/js/jquery.cm-overlay.js')}}"></script>

<script>angular.module("App", ["ui-rangeSlider"]).controller("mainController", function ($scope) {
    $scope.range = { min: 20, max: 200 };
});</script>

<!--[if gt IE 8]>
<script type="text/javascript" src="assets/js/ie.js"></script>
<![endif]-->

<script>
    $(document).ready(function(){
        $('.cm-overlay').cmOverlay();
    });

    $(".owl-carousel").owlCarousel();
</script>

</body>
</html>
