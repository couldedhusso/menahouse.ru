<!DOCTYPE html>

<html lang="en-US">
<head>
     <meta charset="UTF-8"/>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="author" content="ThemeStarz">

     <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,700' rel='stylesheet' type='text/css'>
     <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/angular_material/1.1.0/angular-material.min.css">

     @yield('head')
     <link rel="stylesheet" href="{{asset('assets/css/libs/sweetalert.css')}}" type="text/css">

     {{-- <link href="{{asset('assets/fonts/font-awesome.css')}}" rel="stylesheet" type="text/css">
     <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.css')}}" type="text/css">
     <link rel="stylesheet" href="{{asset('assets/css/bootstrap-select.min.css')}}" type="text/css">
     <link rel="stylesheet" href="{{asset('assets/css/magnific-popup.css')}}" type="text/css">
     <link rel="stylesheet" href="{{asset('assets/css/jquery.slider.min.css')}}" type="text/css">
     <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.css')}}" type="text/css">
     <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" type="text/css">

     <link rel="stylesheet" href="{{asset('assets/css/angular.rangeSlider.css')}}" type="text/css"> --}}

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,700' rel='stylesheet' type='text/css'>
    <link href="{{asset('assets/fonts/font-awesome.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-select.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/magnific-popup.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/jquery.slider.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/angular.rangeSlider.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/angular.rangeSlider.sm.css')}}" type="text/css">
     <title>Mena | Properties Listing</title>
</head>

<body class="page-sub-page page-create-account page-account"  id="page-top" ng-app="mainApp">
<!-- Wrapper -->
<div class="wrapper">
  {{-- Say hello to: {> $scope. <} --}}
  {{-- Say hello to: <input type="text" ng-model="name"> --}}

    {{-- <div class="navigation">
        <div class="secondary-navigation">
            <div class="container">
                <div class="contact">
                    <figure><strong>Тел.:</strong>+7 999-123-4567</figure>
                    <figure><strong>Email:</strong>mena@yandex.ru</figure>
                </div>
                <div class="user-area"> --}}
                    {{-- <div class="actions">
                      @if(Auth::check())
                         <a href="{{ url('/dashboard/nedvizhimosts') }}" title="Разместить объявление своей квартиры бесплатно!" class="promoted"><strong>Разместить объявление</strong></a>
                      @else
                         <a href="{{ url('/sign-in')}}" title="Разместить объявление своей квартиры бесплатно!" class="promoted"><strong>Разместить объявление</strong></a>
                      @endif
                    </div> --}}
                {{-- </div>
            </div>
        </div>
        <div class="container"> --}}
             @include('templates.NavTemplate')
        {{-- </div><!-- /.container -->
    </div><!-- /.navigation --> --}}

    <!-- Page Content -->
    <div id="page-content">
        <!-- Breadcrumb -->
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="{{url('/')}}">Главная</a></li>
                <li class="active">Результаты поиска</li>
            </ol>
        </div>
        <!-- end Breadcrumb -->

        <div class="container">
          <div class="row">
              <!-- Results -->
              <div class="col-md-9 col-sm-9">
                  @yield('search-results')
              </div><!-- /.col-md-9 -->
              <!-- end Results -->

              <!-- sidebar -->
              <div class="col-md-3 col-sm-3"  ng-controller="mainController as vm">
                  @include('layouts.partials.quick-search')
              </div><!-- /.col-md-3 -->
              <!-- end Sidebar -->
          </div><!-- /.row -->

        </div><!-- /.container -->
    </div>
    <!-- end Page Content -->
    <!-- Page Footer -->
    @include('footer')
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

<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript" src="{{asset('static/assets/js/jquery-2.1.0.min.js')}}"></script>
<script type="text/javascript" src="{{asset('static/assets/js/jquery-migrate-1.2.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('static/assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('static/assets/js/smoothscroll.js')}}"></script>
<script type="text/javascript" src="{{asset('static/assets/js/bootstrap-select.min.js')}}"></script>
<script type="text/javascript" src="{{asset('static/assets/js/jquery.validate.min.js')}}"></script>
<script type="text/javascript" src="{{asset('static/assets/js/icheck.min.js')}}"></script>
<script type="text/javascript" src="{{asset('static/assets/js/retina-1.1.0.min.js')}}"></script>
<script type="text/javascript" src="{{asset('static/assets/js/custom.js')}}"></script>
<script type="text/javascript" src="{{asset('js/vendor/jquery.infinitescroll.min.js')}}"></script>

<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-animate.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-aria.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular-messages.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.1.1/angular-material.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.4.4/underscore-min.js"></script>

{{-- <script type="text/javascript" src="{{ asset('js/angular/vendor/angular.min.js') }}"></script> --}}
<script type="text/javascript" src="{{ asset('assets/js/sm.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/angular.rangeSlider.js')}} "></script>
<script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.11.0.js"></script>
<script type="text/javascript" src="{{ asset('js/src/menahouseInit.js') }} "></script>
<script type="text/javascript" src="{{asset('assets/js/libs/sweetalert.min.js')}}">
<script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.11.0.js"></script>

 @include('flash.messages')

@yield('scripts')

{{-- {!! Toastr::render() !!} --}}

<!--[if gt IE 8]>
<script type="text/javascript" src="{{asset('static/assets/js/ie.js')}}"></script>
<![endif]-->

</body>
</html>
