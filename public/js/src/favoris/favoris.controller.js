(function() {

        'use strict';

        angular
            .module('mainApp')
            .factory('PagerService', PagerService)
            .controller('FavorisController', FavorisController);

        function FavorisController($http) {

            var BASE_URL = '/api/user/favoris';

            var vm = this;
            vm.current_page = 1;

            vm.pager = GetPager;
            // vm.authnotification = UserBookmarkNotification;

            vm.setPage = setPage();

            function setPage(pageNo) {

                pageNo = 1;

                var NEXT_LINKS = BASE_URL + '?page=' + pageNo;

                //  "http://localhost:8000/api/search/house?page=2"
                $http.get(NEXT_LINKS).then(function(response) {

                    var result = response.data
                    var paginator = result.meta.pagination;

                    vm.total = paginator.total;
                    vm.count = paginator.count;
                    vm.per_page = paginator.per_page;
                    vm.current_page = pageNo;
                    vm.total_pages = paginator.total_pages;

                    vm.pages = _.range(1, vm.total_pages + 1);


                    vm.favorisuser = (result !== 'null') ? result : {};
                }).catch(function() {
                    console.log(vm.favorisuser);
                });


            };

            function GetPager(current_page) {

                vm.current_page = current_page || 1;

                var NEXT_LINKS = BASE_URL + '?page=' + current_page;

                //  "http://localhost:8000/api/search/house?page=2"
                $http.get(NEXT_LINKS).then(function(response) {

                    var result = response.data
                    vm.current_page = current_page;
                    vm.favorisuser = (result !== 'null') ? result : {};
                }).catch(function() {
                    console.log(vm.favorisuser);
                });

            };



            vm.gettypehouse = function(number_room, type_nedvizhimosti) {
                var nbre_room = parseInt(number_room, 10);
                var tproom;

                if (type_nedvizhimosti == "2" ||
                    type_nedvizhimosti == '3') {

                    if (type_nedvizhimosti == '3') {
                        return 'Дом';
                    }

                    return 'Комната';

                } else {

                    switch (nbre_room) {
                        case 1:
                            tproom = "однокомнатная квартира";
                            break;

                        case 2:
                            tproom = "2х ком. квартира";
                            break;

                        case 3:
                            tproom = "3х ком. квартира";
                            break;

                        case 4:
                            tproom = "4х ком. квартира";
                            break;

                        default:
                            tproom = "Студия";
                            break;
                    }

                    return tproom;



                } // fin HouseController




                // http://jasonwatmore.com/post/2016/01/31/angularjs-pagination-example-with-logic-like-google
                function PagerService() {
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
                }


            })();