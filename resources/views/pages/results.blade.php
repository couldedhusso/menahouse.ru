@extends('templates.TemplatePropertiesListing')
@section('search-results')

  {{-- {{json_encode($response->getTransformer())}} --}}

   {{-- //  show if vm.houses is not null  --}}
   {{-- /// else :-( --}}
   <div ng-controller="HouseController as vm" ng-cloak>

        <header><h1>Предложения по вашему запросу</h1></header>
        <section id="search-filter">
             <figure><h3><i class="fa fa-search"></i>Результатов поиска:</h3>
                <span class="search-count">@{{vm.total}}</span>
                    <div class="sorting">
                         <div class="form-group">
                            <select name="sorting" ng-model ="criteria_sort">
                                             <option value="">Сортировать</option>
                                             <option value="-price">По цене убывания</option>
                                             <option value="-superficie_totale">По метражу</option>
                                             <option value="-created_at">По дате добавления</option>
                             </select>
                         </div><!-- /.form-group -->
                    </div>
            </figure>
        </section>


        <section id="properties" class="display-lines" ng-repeat = "house in vm.houses | orderBy:criteria_sort">

          <div class="property">
            <span class="actions pull-right">
                 <?php // TODO: tester l envoie de la requete ?>
                 @if (Auth::check())
                    <a ng-href="/add-item-to-bookmark/@{{house.id}}"  class="bookmark" data-bookmark-state="empty" style="cursor:pointer">
                    <span class="title-add">Добавить в избранное</span><span class="title-added">Добавлено</span></a>
                 @else
                    <a  href="{{url('auth-notification')}}" class="bookmark" style="cursor:pointer">
                    <span class="title-add">Добавить в избранное</span></a>
                 @endif

                 {{-- <a id="@{{house.id}}"  ng-href="dashboard/bookmarked/@{{house.id}}" class="bookmark"
                 data-bookmark-state="empty"><span class="title-add">В избранное</span><span class="title-added">Добавлено</span></a> --}}
             </span>

            <div class="property-image">
                  <figure class="ribbon">
                    @{{ house.status }}
                  </figure>
                  <a href ng-click ="vm.openlink(house.link, house.id)"> <img alt="" src="https://s3.amazonaws.com/devmenastorage/@{{house.thumb.source}}"></a>
             </div>
              <div class="info">
                  <header>
                      <a href ng-click ="vm.openlink(house.link, house.id)"><h3> @{{ house.type_appart }} </h3></a>
                      <figure>м.@{{ house.metro }}; @{{ house.ulitsa }}</figure>
                  </header>
                   <div class="tag price"> @{{ house.price }} &#x20bd</div>
                   <aside>
                      <p>
                        @{{ house.tekct_obivlenia }}
                      </p>
                      <dl>
                          <dt>Этаж:</dt>
                              <dd>@{{ house.etage }}</dd>
                          <dt>Площадь:</dt>
                              <dd> @{{ house.superficie_totale }}  м<sup>2</sup></dd>
                          <dt>Жилая:</dt>
                              <dd> @{{ house.superficie_living_room }} м<sup>2</sup></dd>
                          <dt>Кухня:</dt>
                              <dd> @{{ house.superficie_cuisine }} м<sup>2</sup></dd>
                      </dl>
                  </aside>

                   @if (Auth::check())

                    @if(!isProprio(Auth::user()))

                        <a href ="{{url('no-appart-notification')}}" class="btn btn-white-grey-3 btn-m-3" title="Открыть объявление, узнать полную информацию и написать владельцу">
                            <figure class="fa fa-envelope"></figure>
                            <span>&nbsp; Написать &nbsp;</span>
                            <span class="arrow fa fa-angle-right"></span>
                        </a><!-- /.write-button ng-href="/mailbox/message/compose/@{{house.id}}"-->

                    @else
                        <a  ng-click ="vm.sendMessageLink(house.id)" class="ng-cloak btn btn-white-grey-3 btn-m-3" title="Открыть объявление, узнать полную информацию и написать владельцу">
                            <figure class="fa fa-envelope"></figure>
                            <span>&nbsp; Написать &nbsp;</span>
                            <span class="arrow fa fa-angle-right"></span>
                        </a><!-- /.write-button ng-href="/mailbox/message/compose/@{{house.id}}"-->
                    
                    @endif

                    @else

                    <a ng-click ="vm.authnotification()" class="btn btn-white-grey-3 btn-m-3" title="Открыть объявление, узнать полную информацию и написать владельцу">
                        <figure class="fa fa-envelope"></figure>
                        <span>&nbsp; Написать &nbsp;</span>
                        <span class="arrow fa fa-angle-right"></span>
                    </a><!-- /.write-button -->

                  @endif


                  {{-- <a ng-href="/mailbox/message/compose/@{{house.id}}" class="btn btn-white-grey-3 btn-m-3" title="Открыть объявление, узнать
                                                                                полную информацию и написать владельцу">
                    <figure class="fa fa-envelope"></figure>
                    <span>&nbsp; Написать &nbsp;</span>
                    <span class="arrow fa fa-angle-right"></span>
                  </a><!-- /.write-button --> --}}
              </div>
            </div>
        </section>

       <!-- Pagination -->

      <div class="center">

             <ul ng-if = "vm.total" class="pagination" >
                <li ng-repeat="page in vm.pages" ng-class="{active:vm.current_page === page}">
                     <a href  ng-click = 'vm.pager(page)' >@{{page}}</a>
                </li>
             </ul><!-- /.pagination-->
      </div><!-- /.center-->


   </div>

   @include('footer')
@endsection

@section('scripts')
    <script src="{{asset('js/src/house/house.services.js')}}"></script>
    {{-- <script src="{{asset('js/src/house/house.controllers.js')}}"></script> --}}
    <script src="https://unpkg.com/angular-toastr/dist/angular-toastr.tpls.js"></script>
    {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script> --}}

    <script type="text/javascript">
    (function() {

       'use strict';

        angular
            .module('mainApp')
            .controller('HouseController', HouseController);

        function HouseController($http, $mdToast,toastr,
                    $mdDialog, $mdBottomSheet, $window, $compile) {

            var BASE_URL = '/api/recherches';

            //user

            var vm = this;

            vm.houses = {!! json_encode($data) !!};
            vm.current_page = {!! $meta->current_page !!}; 
            vm.total = {!! $meta->total !!};
            vm.count = {!! $meta->count !!};
            vm.per_page = {!! $meta->per_page !!};
            vm.total_pages = {!! $meta->total_pages !!};
            vm.pageRange = 5;
            // vm.pages = _.range(1, vm.total_pages + 1)

            vm.pages = paginator();

               
            function paginator() {

                var start = vm.current_page - vm.pageRange ;
                var end = vm.current_page +  vm.pageRange ;

                var rangeStart = (start > 0 ) ? start : 1;
                var rangeEnd = (end < vm.total_pages ) ? end : vm.total_pages ;
                
                var pages = [];
                
                for(var i = rangeStart; i<= rangeEnd; i++){
                    pages.push(i);
                }
                return pages;
            }

           vm.rangeStart = function(){
                var start = vm.current_page - vm.per_page ;
                return (start > 0 ) ? start : 1;
            }

            vm.rangeEnd = function(){
                var end = vm.current_page +  vm.per_page ;
                return (end < vm.total_pages ) ? end : vm.total_pages ;
            }

            vm.pager = GetPager;
            // vm.authnotification = UserBookmarkNotification;

            vm.showBottomSheet = function() {
                $mdDialog.show({
                    templateUrl: "dialogTemplate.html",
                    parent: angular.element(document.body), // dialog is a child element
                    clickOutsideToClose: true
                });



            };

            vm.messenger = function() {

                // toastr.info('Надо войти на сайт или пройти быструю регистрацию');
                // vm.showBottomSheet = function() {
                //     $mdBottomSheet.show({
                //         templateUrl: "bottomtemplate.html"
                //     });

                // }
            };

            // link to send message 

            vm.sendMessageLink = function(uid){
                var url = '/mailbox/message/compose/'+uid;
                $window.open(url);
            }

            vm.openlink = function(link,uid){
                var url = '/'+link;
                $window.open(url);
            }

            vm.authnotification = function() {

                toastr.info('Надо войти на сайт или пройти быструю регистрацию');
                // $mdToast.show({
                //     hideDelay: 3000,
                //     position: 'top right',
                //     templateUrl: 'templates/toast-template.html'
                // });
            };

              vm.ajouertAuxFavoris = function (id) {

                // http://localhost:8000/api/user/favoris?id=162

                 var url = 'api/add/favoris?id='+id;

                 $http.get(url).then(function(response) {
                     alert(response.status);
                     console.log(response);
                });
               
                return true;
            };

            function GetPager(current_page) {

                vm.current_page = current_page;
                var NEXT_LINKS = BASE_URL + '?page=' + current_page;

                //  "http://localhost:8000/api/search/house?page=2"
                $http.get(NEXT_LINKS).then(function(response) {
                    var result = response.data.data;
                    vm.houses = (result !== 'null') ? result : {};
                });

                vm.pages = paginator();


                //vm.pages = pager()

            };

            function getListHouse() {


                return $http.get(BASE_URL).then(function(response) {
                    var result = response.data

                    return (result !== 'null') ? result : {};

                }).catch(function() {
                    console.log(vm.houses);
                });

            }


            function UserBookmarkNotification() {
                toastr.info('Надо войти на сайт или пройти быструю регистрацию');
                return true;
            }
  
          

        } // fin HouseController




        // http://jasonwatmore.com/post/2016/01/31/angularjs-pagination-example-with-logic-like-google
        /*function PagerService() {
            // service definition
            var service = {};

            service.GetPager = GetPager;

            return service;

            // service implementation
            function GetPager(totalItems, currentPage, pageSize) {
                // default to first page
                currentPage = currentPage || 1;

                // default page size is 10
                pageSize = pageSize || 10;

                // calculate total pages
                var totalPages = Math.ceil(totalItems / pageSize);

                var startPage, endPage;
                if (totalPages <= 10) {
                    // less than 10 total pages so show all
                    startPage = 1;
                    endPage = totalPages;
                } else {
                    // more than 10 total pages so calculate start and end pages
                    if (currentPage <= 6) {
                        startPage = 1;
                        endPage = 10;
                    } else if (currentPage + 4 >= totalPages) {
                        startPage = totalPages - 9;
                        endPage = totalPages;
                    } else {
                        startPage = currentPage - 5;
                        endPage = currentPage + 4;
                    }
                }

                // calculate start and end item indexes
                var startIndex = (currentPage - 1) * pageSize;
                var endIndex = Math.min(startIndex + pageSize - 1, totalItems - 1);

                // create an array of pages to ng-repeat in the pager control
                var pages = _.range(startPage, endPage + 1);

                // return object with all pager properties required by the view
                return {
                    totalItems: totalItems,
                    currentPage: currentPage,
                    pageSize: pageSize,
                    totalPages: totalPages,
                    startPage: startPage,
                    endPage: endPage,
                    startIndex: startIndex,
                    endIndex: endIndex,
                    pages: pages
                };
            }
        }*/

    })();

    </script>


    {{-- <script type="text/javascript">
        swal({
            title: "Error!",
            text: "Here's my error message!",
            type: "error",
            confirmButtonText: "Cool"
       });
    </script> --}}


     {{-- <script type="text/ng-template" id="authnotification.html">

       
        <script type="text/javascript">
             swal({
                title: "Ajax request example",
                text: "Надо войти на сайт или пройти быструю регистрацию",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            });
        </script>
     </script > --}}

    <script type="text/ng-template" id="toast-template.html">

        <md-dialog>
            <md-toolbar>
            <div class="md-toolbar-tools">
            <h2>Welcome</h2>
            </div>
            </md-toolbar>
            <md-dialog-content class="md-dialog-content">
            <strong>
            Dialog begins here. Click anywhere outside the dialog to close it.
            </strong>
            <br/>
            <br/>
            <sup>Lorem ipsum ...</sup>
            </md-dialog-content>
    </md-dialog>

    </script >

@endsection

@section('head')
    <link rel="stylesheet" href="https://unpkg.com/angular-toastr/dist/angular-toastr.css" />
@endsection
