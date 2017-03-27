@extends('templates.base')

@section('page-content')
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
                  @yield('resultats-recherches')
              </div><!-- /.col-md-9 -->
              <!-- end Results -->

              <!-- sidebar -->
              <div class="col-md-3 col-sm-3">
                  @include('layouts.partials.quick-search')
              </div><!-- /.col-md-3 -->
              <!-- end Sidebar -->
          </div><!-- /.row -->

        </div><!-- /.container -->
    </div>
    <!-- end Page Content -->
@endsection

@section('styles')
     <link rel="stylesheet" href="assets/css/angular.rangeSlider.css" type="text/css">
     <link rel="stylesheet" href="assets/css/angular.rangeSlider.sm.css" type="text/css">    
@endsection
@section('scripts')
    
@endsection