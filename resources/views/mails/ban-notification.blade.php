<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>

    <style type="text/css">
    .header {
        background: #8a8a8a;
    }
    
    .header .columns {
        padding-bottom: 0;
    }
    
    .header p {
        color: #fff;
        padding-top: 15px;
    }
    
    .header .wrapper-inner {
        padding: 20px;
    }
    
    .header .container {
        background: transparent;
    }
    
    table.button.facebook table td {
        background: #3B5998 !important;
        border-color: #3B5998;
    }
    
    table.button.twitter table td {
        background: #1daced !important;
        border-color: #1daced;
    }
    
    table.button.google table td {
        background: #DB4A39 !important;
        border-color: #DB4A39;
    }
    
    .wrapper.secondary {
        background: #f3f3f3;
    }
    
    .sidebar .menu .menu-item {
        border-top: 1px solid #777777;
    }
</style>



<body>
{{-- <wrapper class="header">
    <container>
        <row class="collapse">
            <columns small="6">
                <img src="http://placehold.it/200x50/663399">
            </columns>
            <columns small="6">
                <p class="text-right">МЕНАХАУСС</p>
            </columns>
        </row>
    </container>
</wrapper> --}}

<container>

    <row>
        <columns large="7">
            <h2>{{$user->id, $user->email}} </h2>
            <hr>
        </columns>

        <columns large="5" class="sidebar">

            <callout class="secondary">
                {{-- <h5>данны пользователи:</h5> --}}
                <p>id:    {{ $user->id }} </p>
                <p>ФИО:   {{ $user->imia .' '.$user->otchestvo}}</p>
                <p>Тел.:  {{ $user->phonenumber}}</p>
                <p>Почта: {{ $user->email }}</p>
                <p><a href="{{url('support/obyavlenie/'.$user->id)}}">ссылька на объявление &raquo;</a></p>
                <p><a href="{{url('support/user/'.$user->id)}}">ссылька на профил &raquo;</a></p>
            </callout>
        </columns>
    </row>
</container>

    </body>
</html>



