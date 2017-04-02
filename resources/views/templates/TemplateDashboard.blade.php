<!DOCTYPE html>

<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="ThemeStarz">

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/font-awesome.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    {{-- <link href="{{ asset('assets/fonts/bootstrap3.min.css') }}" rel="stylesheet" type="text/css"> --}}
    <link rel="stylesheet" href="{{ elixir("css/all.css") }}">

    <title>@yield('Title')</title>

</head>

<body class="page-sub-page page-create-account page-account" id="page-top" ng-app="mainApp">
<!-- Wrapper -->
<div class="wrapper">
   @include('templates.NavTemplate')
    <!-- Page Content -->
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
              <!-- sidebar -->
                <div class="col-md-3 col-sm-2">
                    <section id="sidebar">
                        <header><h3>Личный кабинет</h3></header>
                        @yield('sidebar')
                        {{-- @include('layouts.partials.sidebar') --}}
                    </section><!-- /#sidebar -->
                </div><!-- /.col-md-3 -->
              <!-- end Sidebar -->
                <div class="col-md-9 col-sm-10">
                    @yield('content')
                </div><!-- /.col-md-9 -->

            </div>

        </div><!-- /.container -->
    </div>
    <!-- end Page Content -->

   
    <!-- Page Footer -->
    <footer id="page-footer">
        <div class="inner">
            <section id="footer-copyright">
                <div class="container">
                    <span>RADEXO Copyright © 2015. All Rights Reserved.</span>
                    <span class="pull-right"><a href="#page-top" class="roll"><i class="fa fa-arrow-up">&nbsp; вернуться</i></a></span>
                </div>
            </section>
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


@include('flash.messages')


<!--[if gt IE 8]>
<script type="text/javascript" src="{{asset('assets/js/ie.js')}}"></script>
<![endif]-->

<script type="text/javascript">
    var mainApp = angular.module('mainApp', ['ngMaterial']);
</script>

 @yield('js')

</body>
</html>
