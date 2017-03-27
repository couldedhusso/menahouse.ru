@extends('templates.TemplateDashboard')

@section('Title')
  Mena | Bookmarked Properties
@endsection

@section('active_breadcrumb')
  <li><a href="#">Аккаунт</a></li>
  <li class="active">Избранное</li>
@endsection

@section('sidebar')
  @include('layouts.partials.sidebar-bookmarked')
@endsection


@section('content')

<div ng-app="favoris" ng-controller="FavorisController as vm" ng-cloak>

  <section id="my-properties">
        <header><h1>Избранные объявления списком</h1></header>
            <div class="my-properties">
                <div class="table-responsive">
                    <table class="table">
                          <thead>
                                    <tr>
                                        <th>Объявление</th>
                                        <th></th>
                                        <th>Дата добавления</th>
                                        <th>Действие</th>
                                    </tr>
                            </thead>
                            <tbody ng-repeat = "house in vm.houses">
                                         <tr>
                                            <td class="image">
                                                <a ng-click = "vm.openlink(house.link)" style="cursor:pointer"> <img alt="" ng-src="{{asset('dev/thumb/')}}"></a>
                                            </td>
                                            <td><div class="inner">
                                                <a href="@{{ house.id }}}"><h2>@{{house.type_appart}} м @{{house.metro }}</h2></a>
                                                <figure>@{{ house.ulitsa }}</figure>
                                                <div class="tag price">@{{ house.price }}</div>
                                            </div>
                                            </td>
                                            <td>@{{ house.date_favoris }}</td>
                                            <td class="actions">
                                            <a ng-click = "vm.openlink(house.link)" class="edit" style="cursor:pointer"><i class="fa fa-link" title="Перейти к объявлению" ></i>Перейти</a>
                                            <a ng-href="/dashboard/bookmarked/delete/@{{house.id}}"><i class="delete fa fa-trash-o" title="Удалить объявление"></i></a>
                                            </td>
                                        </tr> 
                                    </tbody>
                                </table>
                    </div><!-- /.table-responsive -->
            </div><!-- /.my-properties -->
        </section><!-- /#my-properties -->
                <!-- end My Properties -->

        <div class="center">

             <ul ng-if = "vm.total" class="pagination" >
                <li ng-repeat="page in vm.pages" ng-class="{active:vm.current_page === page}">
                     <a href  ng-click = 'vm.pager(page)' >@{{page}}</a>
                </li>
             </ul><!-- /.pagination-->
      </div><!-- /.center-->

</div>
@endsection

@section('js')

 <script type="text/javascript">
    (function() {

       'use strict';

        angular
            .module('mainApp')
            .controller('FavorisController', FavorisController);

        function FavorisController($http, $window, $compile) {

            var BASE_URL = 'api/user/favoris';

            //user

            

            var vm = this;

            vm.houses = {!! json_encode($favoris) !!};
            vm.current_page = {!! $favorismeta->current_page !!}; 
            vm.total = {!! $favorismeta->total !!};
            vm.count = {!! $favorismeta->count !!};
            vm.per_page = {!! $favorismeta->per_page !!};
            vm.total_pages = {!! $favorismeta->total_pages !!};
            vm.pages = _.range(1, vm.total_pages + 1)

            vm.pager = GetPager;
            // vm.authnotification = UserBookmarkNotification;

            // link to send message 

            vm.sendMessageLink = function(uid){
                var url = '/mailbox/message/compose/'+uid;
                $window.open(url);
            }

            vm.openlink = function(link){
                var url = '/'+link;
                $window.open(url);
            }


            function GetPager(current_page) {

                vm.current_page = current_page || 1;
                var NEXT_LINKS = BASE_URL + '?page=' + current_page;

                //  "http://localhost:8000/api/search/house?page=2"
                $http.get(NEXT_LINKS).then(function(response) {
                    var result = response.data.data;
                    vm.houses = (result !== 'null') ? result : {};
                });

            };


            function UserBookmarkNotification() {
                toastr.info('Надо войти на сайт или пройти быструю регистрацию');
                return true;
            }


        } // fin FavorisController

    })();

</script>
    
@endsection





