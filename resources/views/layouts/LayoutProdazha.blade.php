<!DOCTYPE html>
<html ng-app>
<head>
  <meta charset="utf-8">
  <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>@yield('title')</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"
    rel="stylesheet">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.rawgit.com/olton/Metro-UI-CSS/master/build/css/metro-icons.min.css">
  <link rel="stylesheet" href="http://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular.min.js"></script>
  <link rel="stylesheet" href="{{ elixir('css/all.css') }}">

</head>
<body ng-controller ="ProdazhaController">
  <div >
    @include('layouts.partials.sidebar')
  </div>

  <div>
      @yield('content')
  </div>


  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="https://storage.googleapis.com/code.getmdl.io/1.0.5/material.min.js"></script>
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <script src="http://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>


  <script src="{{ elixir('js/all.js') }}"> </script>

  <script>
      function showDialog(id){
          var dialog = $(id).data('dialog');
          dialog.open();
      }

      // $(function(){
      //     $("#accordion").accordion();
      // }) ;
  </script>
</body>

</html>
