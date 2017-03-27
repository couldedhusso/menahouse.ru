<!DOCTYPE html>

<html lang="en-US">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="ThemeStarz">

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,700' rel='stylesheet' type='text/css'>

    <link href="{{ asset('assets/fonts/font-awesome.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ elixir("css/all.css") }}">

    <title>@yield('Title')</title>

</head>

<body class="page-sub-page page-legal" id="page-top">
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
                <div class="user-area">
                    <div class="actions">
                      @if(Auth::check())
                         <a href="{{ url('/dashboard/advertisement/add') }}" title="Разместить объявление своей квартиры бесплатно!" class="promoted"><strong>Разместить объявление</strong></a>
                      @else
                         <a href="{{ url('/sign-in')}}" title="Разместить объявление своей квартиры бесплатно!" class="promoted"><strong>Разместить объявление</strong></a>
                      @endif                    </div>
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
                                    <li><a href="{{ url('/dashboard/advertisements') }}" title="Проверить и добавить новое объявление"><i class="fa fa-th-list"></i>&nbsp; Мои объявления</a></li>
                                    {{-- <li><a href="#" title="Активировать дополнительные функции сайта"><i class="fa fa-rub"></i>&nbsp; Оплата</a></li> --}}
                                    <li><a href="{{ url('dashboard/settings/'.Auth::user()->id )}}" title="Настройки пользователя и сайта"><i class="fa fa-cog"></i>&nbsp; Настройки</a>
                                    <li><a href="{{ url('/auth/logout') }}" title="Обязательно зайдите завтра проверить новые сообщения!"><i class="fa fa-sign-out"></i>&nbsp;Выход</a></li>

                              </ul>
                          </li>
                          <li>
                            <a href="{{ url('/dashboard/advertisement/add') }}" class="btn btn-white-green" title="Разместить объявление своей квартиры бесплатно!"><i class="fa fa-plus"></i>&nbsp; Разместить объявление</a>
                          </li>

                        @else
                          <li>
                            <a href="{{ url('/sign-in') }}" title="Войти с помощью Вашего аккаунта">Войти &nbsp; </a>
                          </li>
                          <li class="activ">
                            <a href="{{ url('/sign-in') }}" title="Пройти быструю регистрацию"><strong>&nbsp;Регистрация</strong></a>
                          </li>
                        @endif

                    </ul>
                </nav><!-- /.navbar collapse-->
            </header><!-- /.navbar -->
        </div><!-- /.container -->
    </div><!-- /.navigation -->

    <!-- end Navigation -->
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
            @yield('content')
        </div><!-- /.container -->
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
{{-- <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=places"></script>
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
<script type="text/javascript" src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/fileinput.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/custom-map.js')}}"></script>
<script type="text/javascript" src="{{asset('static/assets/js/custom.js')}}"></script> --}}



<script type="text/javascript" src="{{asset('assets/js/jquery-2.1.0.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/jquery-migrate-1.2.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/smoothscroll.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/bootstrap-select.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/icheck.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/retina-1.1.0.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/jquery.magnific-popup.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/fileinput.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/custom-map.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/custom.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/sm.js')}}"></script>


<!--[if gt IE 8]>
<script type="text/javascript" src="{{asset('assets/js/ie.js')}}"></script>
<![endif]-->

<script>
//     var _latitude = 48.87;
//     var _longitude = 2.29;
//
//
//     google.maps.event.addDomListener(window, 'load', initSubmitMap(_latitude,_longitude));
//     function initSubmitMap(_latitude,_longitude){
//         var mapCenter = new google.maps.LatLng(_latitude,_longitude);
//         var mapOptions = {
//             zoom: 15,
//             center: mapCenter,
//             disableDefaultUI: false,
//             //scrollwheel: false,
//             styles: mapStyles
//         };
//         var mapElement = document.getElementById('submit-map');
//         var map = new google.maps.Map(mapElement, mapOptions);
//         var marker = new MarkerWithLabel({
//             position: mapCenter,
//             map: map,
//             icon: 'assets/img/marker.png',
//             labelAnchor: new google.maps.Point(50, 0),
//             draggable: true
//         });
//         $('#submit-map').removeClass('fade-map');
//         google.maps.event.addListener(marker, "mouseup", function (event) {
//             var latitude = this.position.lat();
//             var longitude = this.position.lng();
//             $('#latitude').val( this.position.lat() );
//             $('#longitude').val( this.position.lng() );
//         });
//
// //      Autocomplete
//         var input = /** @type {HTMLInputElement} */( document.getElementById('address-map') );
//         var autocomplete = new google.maps.places.Autocomplete(input);
//         autocomplete.bindTo('bounds', map);
//         google.maps.event.addListener(autocomplete, 'place_changed', function() {
//             var place = autocomplete.getPlace();
//             if (!place.geometry) {
//                 return;
//             }
//             if (place.geometry.viewport) {
//                 map.fitBounds(place.geometry.viewport);
//             } else {
//                 map.setCenter(place.geometry.location);
//                 map.setZoom(17);
//             }
//             marker.setPosition(place.geometry.location);
//             marker.setVisible(true);
//             $('#latitude').val( marker.getPosition().lat() );
//             $('#longitude').val( marker.getPosition().lng() );
//             var address = '';
//             if (place.address_components) {
//                 address = [
//                     (place.address_components[0] && place.address_components[0].short_name || ''),
//                     (place.address_components[1] && place.address_components[1].short_name || ''),
//                     (place.address_components[2] && place.address_components[2].short_name || '')
//                 ].join(' ');
//             }
//         });
//
//     }
//
//     function success(position) {
//         initSubmitMap(position.coords.latitude, position.coords.longitude);
//         $('#latitude').val( position.coords.latitude );
//         $('#longitude').val( position.coords.longitude );
//     }
//
//     $('.geo-location').on("click", function() {
//         if (navigator.geolocation) {
//             $('#submit-map').addClass('fade-map');
//             navigator.geolocation.getCurrentPosition(success);
//         } else {
//             error('Geo Location is not supported');
//         }
//     });

(function($){

    $(document).ready(function(){

    /////////////////////////////////////////////////////////////////

    // Установка видимости элементов выпадающего списка
    // obj - dom объект, по которому необходимо установить видимость (city)
    function setVisible(obj){
        //значение rel
        var rel = obj.attributes.rel.value;
        //список select районов
        var select = $("[name=district]");
        //dropdown список районов (где необходимо убирать видимость)
        var base = $(".dropdown-menu", select.parent());

        $($("li", district.parent().parent()).removeClass("selected").children()[0]).addClass("selected");
        $("[name=district]").val("");
        district.attr("title", "Округ");
        district.parent().removeClass("selected-option-check");
        $(".filter-option", district).text("Округ");
        $("li", base).attr("data-edit", "");

        for (var i = 0; i < count; i++){

            var visible = rel.indexOf((i + 1).toString()) >= 0;

            var items = $("[data-city~='" + (i+1) + "']");
            for (var a = 0; a < sitems.length; a++){

                var val = items[a].value;

                var itemLi = $("li[rel=" + (val/1+1) + "]", base);
                if (itemLi[0].dataset.edit != "true"){
                    itemLi.css("display", visible ? "" : "none");
                }

                if(visible){
                    itemLi[0].dataset.edit = true;
                    $("li[rel=" + (val/1+1) + "]", base).data("edit", true)
                }

            }
        }
    }

    //получение кнопки
    //name - имя select
    function btn(name){
        return $("button", $("[name=" + name +"]").parent());
    }

    //убирает видимость rel 0
    function disableRel(btnObj){
        if (typeof btnObj == "string"){
            btnObj = btn(btnObj);
        }
        $("[rel=0]", btnObj.parent()).css("display", "none");
    }

    //установка заголовка для элементов, которым необходим мультивыбор
    function setTitle(name, value){
        var obj = btn(name);


        setTimeout(function() {
            if (obj.attr("title") == "Nothing selected"){
                obj.attr("title", value);
                $(".filter-option", obj).text(value);
                $("[name="  + name + "]").val([]);
                obj.parent().removeClass("selected-option-check");
            }
            var txt = $(".filter-option", obj).text();

        }, 10);

    }

    //блокировка элемента
    function block(name, value){
        var obj= btn(name);
        //ставим селектед на первый элемент
        $($("li", obj.parent().parent()).removeClass("selected").children()[0]).addClass("selected");
        //убираем значение selected
        var sel = $("[name=" + name + "]");
        if (sel.attr("multiple") != undefined){
            sel.val([]);
        }
        else{
            sel.val("");
        }

        obj.attr("title", value);
        //убираем галочку
        obj.parent().removeClass("selected-option-check");
        $(".filter-option", obj).text(value);
        obj.attr("disabled", "");
    }

    //проверка на выбор жилья
    function check(txt){

        rooms.removeAttr("disabled");

        if (txt == "Тип жилья"){
            return;
        }

        if (txt == "Частный дом" || txt == "Комната"){

            block("room", "Кол-во комнат");
        }

    };

    //установка значения по умолчанию
    function setValue(name, value){
        var obj= btn(name);
        var li = $(".dropdown-menu li", obj.parent().parent()).removeClass("selected");

        for (var i = 0; i < li.length; i++){
            if ($("span", li[i]).text() == value){
                li[i].classList.add("selected");
                break;
            }
        }

        $("[name=" + name + "]").val(value);
        obj.attr("title", value);
        obj.parent().addClass("selected-option-check");
        $(".filter-option", obj).text(value);
    }
    /////////////////////////////////////////////////////////////////

    var typeHouse = btn("property-type");
    var city = btn("city");
    var district = btn("district");
    //количество элементов списка Город
    var count = $("option", "[name=city]").length;

    //уберем видимость город и районов
    disableRel(city);
    disableRel(district);

    // обработчик нажатия по кнопке района
    district.on("click", function(){

        setTimeout(function(){
            //корректируем размер выпадающего списка
            $(".dropdown-menu", district.parent()).css("minHeight", "20px");
        },50)

    });

    var rooms = btn("room");
    setTitle("room", "Количество комнат");
    disableRel("room");

    //обработка нажатия по списку комнат
    $(".dropdown-menu li", $("[name=room]").parent()).on("click", function(ev){
        setTitle("room", "Количество комнат");

    });

    // обработка нажатия по списку городов
    $(".dropdown-menu li", $("[name=city]").parent()).on("click", function(ev){
        district.removeAttr("disabled");
        setVisible(ev.currentTarget);
        switch (ev.currentTarget.innerText) {
            case "Москва":
                setValue("district", "Все округа");
                $("[name=district]").val(1);
                break;
            case "Московская область":
                setValue("district", "Все районы");
                $("[name=district]").val(6);
                break;
            case "Новая Москва":
                setValue("district", "Все районы");
                $("[name=district]").val(6);
                break;
            case "Все города":
                block("district", "Округ");
                break;

            default:
                break;
        }

      //  check(ev.target.innerText);

    });

    //обработка нажатия по району
    $(".dropdown-menu li", $("[name=district]").parent()).on("click", function(ev){
        var rel = ev.currentTarget.attributes.rel.value;
        if (rel == 0){
            return;
        }

        district.attr("title", ev.currentTarget.innerText);
        $(".filter-option", district).text(ev.currentTarget.innerText);

    });

    //нажатие по типу дома
    $("li", typeHouse.parent().parent()).on("click", function(ev){
        check(ev.target.innerText);

    })

    //проверка
    check(typeHouse.attr("title"));

    //для city - Москва
    setValue("city", "Москва");
    //установка видимости выпадающего списка
    setVisible($(".dropdown-menu li.selected", $("[name=city]").parent())[0]);
    //установка для районов все округа
    setValue("district", "Все округа");

    //для selected Москва - это 2 (см value)
    $("[name=city]").val(2);
    //Все округа - это 0 (см.value)
    $("[name=district]").val(0);
})
}($))

</script>
</body>
</html>
