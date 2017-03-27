(function() {

    'use strict';

    angular
        .module('mainApp')
        .factory('PagerService', PagerService)
        .controller('HouseController', HouseController);
    // .controller('HouseController', function($http) {
    //     var BASE_URL = '/api/recherches';

    //     var vm = this;
    //     vm.current_page = 1
    //     vm.houses = setPage(vm.current_page);

    //     // $http.get(BASE_URL).then(function(response) {
    //     //     var result = response.data
    //     //     var paginator = result.meta.pagination;

    //     //     vm.houses = (result !== 'null') ? result : {};
    //     // }).catch(function() {
    //     //     console.log(vm.houses);
    //     // });

    //     function setPage(pageNo) {

    //         pageNo = typeof pageNo !== 'undefined' ? pageNo : 1;

    //         // if (pageNo > vm.total_pages || pageNo < 1) {
    //         //     pageNo = 1;
    //         // }

    //         var NEXT_LINKS = BASE_URL + '?page=' + pageNo;

    //         //  "http://localhost:8000/api/search/house?page=2"
    //         $http.get(NEXT_LINKS).then(function(response) {

    //             var result = response.data
    //             var paginator = result.meta.pagination;

    //             vm.total = paginator.total;
    //             vm.count = paginator.count;
    //             vm.per_page = paginator.per_page;
    //             vm.current_page = pageNo;
    //             vm.total_pages = paginator.total_pages;


    //             vm.houses = (result !== 'null') ? result : {};
    //         }).catch(function() {
    //             console.log(vm.houses);
    //         });


    //     };




    //     // $http.get(url)
    //     //     .then(function(response) {
    //     //         return response.data;
    //     //     });


    //     // $http.get(url).success(function(response) {

    //     //     vm.houses = response.data;

    //     //     console.log(vm.houses);

    //     //     // $scope.totalItems = $scope.houses.length;

    //     // }).error(function(error) {
    //     //     // console.log(error.data);
    //     //     // alert('This is embarassing. An error has occured. Please check the log for details');
    //     // });


    //     function getListHouse() {
    //         // return $http.get(BASE_URL).then(function(response) {
    //         //     return response.data;
    //         // });


    //         return $http.get(BASE_URL).then(function(response) {
    //             var result = response.data

    //             return (result !== 'null') ? result : {};

    //         }).catch(function() {
    //             console.log(vm.houses);
    //         });

    //     }

    // });




    function HouseController($http, toastr, $mdToast, $mdDialog, $mdBottomSheet) {

        var BASE_URL = '/api/recherches';

        var vm = this;
        vm.current_page = 1;

        vm.houses = json_encode($house);

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

            toastr.info('Надо войти на сайт или пройти быструю регистрацию');
            // vm.showBottomSheet = function() {
            //     $mdBottomSheet.show({
            //         templateUrl: "bottomtemplate.html"
            //     });

            // }
        };




        vm.authnotification = function() {

            toastr.info('Надо войти на сайт или пройти быструю регистрацию');
            // $mdToast.show({
            //     hideDelay: 3000,
            //     position: 'top right',
            //     templateUrl: 'templates/toast-template.html'
            // });
        };

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


                vm.houses = (result !== 'null') ? result : {};
            }).catch(function() {
                console.log(vm.houses);
            });


        };

        function GetPager(current_page) {

            vm.current_page = current_page || 1;

            var NEXT_LINKS = BASE_URL + '?page=' + current_page;

            //  "http://localhost:8000/api/search/house?page=2"
            $http.get(NEXT_LINKS).then(function(response) {

                var result = response.data
                vm.current_page = current_page;
                vm.houses = (result !== 'null') ? result : {};
            }).catch(function() {
                console.log(vm.houses);
            });

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


        function favorisUser(id) {

            // http://localhost:8000/api/user/favoris?id=162

            var reqUser = {
                url: 'api/user/favoris',
                data: { 'id': id }
            }

            $http.post(reqUser).then(function(response) {
                toastr.succes('Надо войти на сайт или пройти быструю регистрацию');
            }).catch(function() {
                toastr.error('oups!!');
            });

            return true;
        }

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



    //HouseController.$inject = ['$http'];

    // function HouseController($scope, $http, Restangular) {

    //     var vm = this;
    //     vm.houses = []; //getListHouse();



    //     var url = 'api/search/house';

    //     $http.get(url).success(function(response) {

    //         vm.houses = response.data;

    //         console.log(vm.houses);

    //         // $scope.totalItems = $scope.houses.length;

    //     }).error(function(error) {
    //         console.log(error.data);
    //         // alert('This is embarassing. An error has occured. Please check the log for details');
    //     });

})();