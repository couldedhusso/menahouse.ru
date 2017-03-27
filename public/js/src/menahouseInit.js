// var mainApp = angular.module('mainApp', ['ui-rangeSlider']);

var mainApp = angular.module('mainApp', ['ui-rangeSlider', 'toastr', 'ngMaterial']);

/*app configuration added here*/
mainApp.config(['$interpolateProvider', '$locationProvider',
    function($interpolateProvider, $locationProvider) {

        //RestangularProvider.setBaseUrl('api');

        $locationProvider.html5Mode({
            enabled: true,
            requireBase: false
        });
    }
]);

mainApp.constant('BASE_SEARCH_URL', 'api/search');

mainApp.factory('RangeSliderFactory', function() {
    // private variables and functions
    var range = {
        min: 20,
        max: 150
    };

    // public API
    return {
        getrangeValue: function() {
            return range
        }
    };
});


mainApp.controller("ItemsDetailsController", ['$scope', 'RangeSliderFactory', function($scope, RangeSliderFactory) {
    $scope.range = RangeSliderFactory.getrangeValue();
}]);


mainApp.controller("mainController", ['$scope', 'RangeSliderFactory',
    '$http', 'toastr',

    function($scope, RangeSliderFactory, $http, toastr) {

        $scope.range = RangeSliderFactory.getrangeValue();

        var city_url = '/api/cities';
        var district_url = '/city/districts';

        var vm = this

        vm.cities = [];
        vm.districts = [];
        vm.typehouse = "";

        //$scope.houses = Restangular.all('search/house').getList();
        //  console.log($scope.houses.data);

        $http.get(city_url).success(function(response) {
            vm.cities = (response !== 'null') ? response : [];
            console.log(vm.cities);
        }).error(function(response) {
            vm.cities = []
        });

        $scope.getDistrictsByCity = function(city) {

            ///  id = 1 correspond à la ville de Moscou
            var id_city = city || 1;

            var d_url = district_url + '?id=' + id_city

            $http.get(d_url).success(function(response) {
                vm.districts = (response !== 'null') ? response : [];
                console.log(vm.districts);
            }).error(function(response) {
                vm.districts = []
            });
        }


        $scope.currentPage = 1;
        $scope.itemsPerPage = 4;

        $scope.setPage = function(pageNo) {
            $scope.currentPage = pageNo;
        };

        $scope.getimgpath = function(param) {
            return 'storage/thumbnail/' + param + '.jpeg';
        };

        $scope.getstatus = function(status) {

            if (status == 'Обмен_продажа') {
                return 'Обмен + продажа';
            } else {
                return 'Обмен';
            }

        };

        $scope.gettypehouse = function(number_room, type_nedvizhimosti) {
            var nbre_room = parseInt(number_room, 10);
            var tproom;

            if (type_nedvizhimosti == "Комната" ||
                type_nedvizhimosti == 'Частный дом') {

                if (type_nedvizhimosti == 'Частный дом') {
                    return 'Дом';
                }

                return 'Комната';

            } else {

                switch (nbre_room) {
                    case 1:
                        tproom = "однокомнатная ";
                        break;

                    case 2:
                        tproom = "2х комнатная";
                        break;

                    case 3:
                        tproom = "3х комнатная";
                        break;

                    case 4:
                        tproom = "4х комнатная";
                        break;

                    default:
                        tproom = "Студия";
                        break;
                }

                return tproom;

                // if (type_nedvizhimosti == 'Новостройки') {
                //     if (tproom != 'Студия') {
                //         return tproom + 'квартира в новостроике';
                //     } else {
                //       return tproom + 'в новостроике';
                //     }
                // } else {
                //   if (tproom == 'Студия') {
                //       return tproom
                //   } else {
                //     return tproom + 'квартира';
                //   }
                // }

            }
        }

    }
]);


// var mena = angular.module('mena', ['ui.bootstrap']);
var mena = angular.module('mena', ['toastr', 'ngMaterial']);

mena.config(['$interpolateProvider', '$locationProvider',
    function($interpolateProvider, $locationProvider) {

        // $interpolateProvider.startSymbol('{>');
        // $interpolateProvider.endSymbol('<}');

        $locationProvider.html5Mode({
            enabled: true,
            requireBase: false
        });
    }
]);


// ======================================================== gestion des favoris

mena.controller("MesFavorisController", ['$scope', '$http', '$windows',
    '$compile',
    function($scope, $http, $windows, $compile) {


        var BASE_URL = 'api/user/favoris';

        var vm = this;

        vm.houses = window.favoris;
        vm.current_page = window.favorismeta.current_page;
        vm.total = window.favorismeta.total;
        vm.count = window.favorismeta.count;
        vm.per_page = window.favorismeta.per_page;
        vm.total_pages = window.favorismeta.total_pages;

        vm.pages = _.range(1, vm.total_pages + 1)

        vm.pager = GetPager;
        // vm.authnotification = UserBookmarkNotification;

        // link to send message 

        vm.sendMessageLink = function(uid) {
            var url = '/mailbox/message/compose/' + uid;
            $window.open(url);
        }

        vm.openlink = function(link, uid) {
            var url = '/' + link;
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








        // var url = '/getuserbookmarkedproperties';
        // $scope.mesfavoris = [];

        // $http.get(url).success(function(response) {
        //     $scope.mesfavoris = response;

        // }).error(function(response) {
        //     console.log(response);
        //     //  alert('This is embarassing. An error has occured. Please check the log for details');
        // });

        // $scope.totalItems = $scope.mesfavoris.length;
        // $scope.currentPage = 1;
        // $scope.itemsPerPage = 2;

        //  $scope.addItemToBookmark  = function(iditem){
        //    $http.get('/bookmarked', {  params: { id: iditem } })
        //      .then(function(results) {
        //         alert('hi from backend');
        //      }, function(reason) {
        //         // TODO : Send reason to developers
        //      })
        //  }

        // $scope.addItemToBookmark = function(iditem) {

        //     $http.get('/bookmarked', { params: { id: iditem } }).success(function(response) {

        //     }).error(function(response) {
        //         console.log(response);
        //         //  alert('This is embarassing. An error has occured. Please check the log for details');
        //     });
        // }



        // $scope.getimgpath = function(param) {
        //     return '/storage/thumbnail/' + param + '.jpeg';
        // };

        // $scope.gettypehouse = function(number_room, type_nedvizhimosti) {
        //     var nbre_room = parseInt(number_room, 10);
        //     var tproom;


        //     if (type_nedvizhimosti == "Комната" ||
        //         type_nedvizhimosti == 'Частный дом') {

        //         if (type_nedvizhimosti == 'Частный дом') {
        //             return 'Дом';
        //         }

        //         return 'Комната';

        //     } else {

        //         switch (nbre_room) {
        //             case 1:
        //                 tproom = "одноком.";
        //                 break;

        //             case 2:
        //                 tproom = "2х комн.";
        //                 break;

        //             case 3:
        //                 tproom = "3х комн.";
        //                 break;

        //             case 4:
        //                 tproom = "4х комн.";
        //                 break;

        //             default:
        //                 tproom = "Студия";
        //                 break;
        //         }

        //         return tproom;

        //     }
        // }

    }
]);


mena.controller("UserMailInboxController", ['$scope', '$http', function($scope, $http) {

    var url = '/mailbox/usermail';
    $scope.usermessages = [];

    $http.get(url).success(function(response) {
        $scope.usermessages = response;
        $scope.totalMails = response.length;
    }).error(function(response) {
        console.log(response);
        //  alert('This is embarassing. An error has occured. Please check the log for details');
    });


    $scope.currentPage = 1;
    $scope.mailPerPage = 10;

    $scope.sliceTexte = function(sizeText) {
        return parseInt((sizeText * 85) / 100)

    };

    //  $scope.addItemToBookmark  = function(iditem){
    //    $http.get('/bookmarked', {  params: { id: iditem } })
    //      .then(function(results) {
    //         alert('hi from backend');
    //      }, function(reason) {
    //         // TODO : Send reason to developers
    //      })
    //  }

}]);


mena.controller("UserMailSentController", ['$scope', '$http', function($scope, $http) {

    var url = '/mailbox/usermailsenv';
    $scope.usermessages = [];

    // scope.msg = 'UserMailTrashController';

    $http.get(url).success(function(response) {
        $scope.usermessages = response;
        $scope.totalMails = response.length;

    }).error(function(response) {
        console.log(response);
        //  alert('This is embarassing. An error has occured. Please check the log for details');
    });


    $scope.currentPage = 1;
    $scope.mailPerPage = 10;

    $scope.sliceTexte = function(sizeText) {
        return parseInt((sizeText * 85) / 100)

    };
}]);


mena.controller("UserMailTrashController", ['$scope', '$http', function($scope, $http) {

    var url = '/mailbox/usermailstrash';
    $scope.usermessages = [];

    $http.get(url).success(function(response) {
        $scope.usermessages = response;
        $scope.totalMails = response.length;
        //      scope.msg = 'UserMailTrashController';
    }).error(function(response) {
        console.log(response);
        //  alert('This is embarassing. An error has occured. Please check the log for details');
    });


    $scope.currentPage = 1;
    $scope.mailPerPage = 10;

    $scope.sliceTexte = function(sizeText) {
        return parseInt((sizeText * 85) / 100)

    };
}]);


mena.controller("UserMailFavorisController", ['$scope', '$http', function($scope, $http) {

    var url = '/mailbox/usermailsfavoris';
    $scope.usermessages = [];

    $http.get(url).success(function(response) {
        $scope.usermessages = response;
        $scope.totalMails = response.length;
    }).error(function(response) {
        console.log(response);
        //  alert('This is embarassing. An error has occured. Please check the log for details');
    });


    $scope.currentPage = 1;
    $scope.mailPerPage = 10;

    $scope.sliceTexte = function(sizeText) {
        return parseInt((sizeText * 85) / 100)

    };
}]);


// ======================================================== gestion du mailbox

// var mena = angular.module('mena', ['ui.bootstrap']);
var menahouseInbox = angular.module('menahouseInbox', []);

menahouseInbox.config(['$interpolateProvider', '$locationProvider',
    function($interpolateProvider, $locationProvider) {

        $interpolateProvider.startSymbol('{>');
        $interpolateProvider.endSymbol('<}');

        $locationProvider.html5Mode({
            enabled: true,
            requireBase: false
        });
    }
]);

menahouseInbox.controller('inboxController', ['$scope', '$http', function($scope, $http) {
    $scope.gretting = "inbox module";
}]);