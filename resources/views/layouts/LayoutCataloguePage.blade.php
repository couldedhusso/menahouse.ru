<!DOCTYPE html>

<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="ThemeStarz">

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,700' rel='stylesheet' type='text/css'>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">


   <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
   <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}" type="text/css">
   <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-select.min.css') }}" type="text/css">
   <link rel="stylesheet" href="{{ asset('assets/css/jquery.slider.min.css') }}" type="text/css">
   <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css') }}" type="text/css">
   <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}" type="text/css">
   <link rel="stylesheet" href="{{ asset('assets/css/owl.transitions.css') }}" type="text/css">
   <link rel="stylesheet" href="{{ asset('css/theproject.css') }}" type="text/css">
   <link rel="stylesheet" href="{{ asset('css/vendor/jquery.bxslider.css') }}" type="text/css">

   <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" type="text/css">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.24.3/css/uikit.min.css" />


    <title>Zoner | Create an Account</title>

</head>

<body class="page-sub-page page-create-account page-account" id="page-top">
<!-- Wrapper -->
<div class="wrapper">

      <div class="navigation">
	      {{-- @if(Auth::check())
		      @include('layouts.partials.header')
	      @else
		      @include('layouts.partials.navibar-search')
	      @endif --}}

        @include('layouts.partials.navibar')
      </div><!-- /.navigation -->


    <!-- Page Content -->
    <!-- Page Content -->
    <div id="page-content">
      <!-- Breadcrumb -->
      <div class="container">
          <div class="cls-search-box">
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
                                      <div class="col-md-2 col-sm-5">
                                          <div class="form-group">
                                              <button type="submit" class="btn btn-default">Найти</button>
                                          </div><!-- /.form-group -->
                                      </div>

                      </div>

                </form><!-- /#form-map -->
          </div>
          <div class="cls-filter-box">
            <ul>
              <li>Сортировка :</li>
              <li><a href="#">По умолчанию</a></li>
              <li><a href="#">По цене</a></li>

              <li>
                  <ul>
                      <li>Показать :</li>
                      <li><a href="#">Список</a></li>
                      <li><a href="#">На карте</a></li>
                  </ul>
              </li>
            </ul>
          </div>
          <div class="main-content">
              @yield('content')
          </div>

      </div>


    </div>
    <!-- end Page Content -->
    <!-- end Page Content -->
    <!-- Page Footer -->
    <footer id="page-footer">
        <div class="inner">
            <section id="footer-copyright">
                <div class="container">
                    <span>RADEXO Copyright © 2015. All Rights Reserved.</span>
                    <span class="pull-right"><a href="#page-top" class="roll">Вернуться наверх страницы</a></span>
                </div>
            </section>
        </div><!-- /.inner -->
    </footer>
    <!-- end Page Footer -->
</div>

<script type="text/javascript" src="{{ asset('assets/js/jquery-2.1.0.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery-migrate-1.2.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/smoothscroll.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/icheck.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/retina-1.1.0.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/custom.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/2.24.3/js/uikit.min.js"></script>
<script type="text/javascript" src="{{ asset('js/vendor/jquery.bxslider.min.js') }}"></script>


<!--[if gt IE 8]>
<script type="text/javascript" src="assets/js/ie.js"></script>
<![endif]-->

</body>
</html>
