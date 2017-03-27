// var mena = angular.module('mena', ['ui.bootstrap']);
var mena = angular.module('mena', []);

mena.config(['$interpolateProvider', '$locationProvider',
  function($interpolateProvider, $locationProvider) {

    $interpolateProvider.startSymbol('{>');
    $interpolateProvider.endSymbol('<}');

    $locationProvider.html5Mode({
      enabled: true,
      requireBase: false
    });
  }
]);

mena.controller("MesFavorisController", ['$scope', '$http', function($scope,  $http) {

   var url = '/getuserbookmarkedproperties';
   $scope.mesfavoris = [];

   $http.get(url).success(function(response) {
          $scope.mesfavoris = response;

   }).error(function(response) {
           console.log(response);
         //  alert('This is embarassing. An error has occured. Please check the log for details');
   });

   $scope.totalItems = $scope.mesfavoris.length;
   $scope.currentPage = 1;
   $scope.itemsPerPage = 2;

  //  $scope.addItemToBookmark  = function(iditem){
  //    $http.get('/bookmarked', {  params: { id: iditem } })
  //      .then(function(results) {
  //         alert('hi from backend');
  //      }, function(reason) {
  //         // TODO : Send reason to developers
  //      })
  //  }

    $scope.addItemToBookmark = function(iditem){

        $http.get('/bookmarked', {  params: { id: iditem } }).success(function(response) {
                alert('hi from backend');

        }).error(function(response) {
                console.log(response);
              //  alert('This is embarassing. An error has occured. Please check the log for details');
        });
    }

   $scope.getimgpath = function(param){
       return '/storage/thumbnail/'+ param +'.jpeg';
   };

   $scope.gettypehouse = function(number_room, type_nedvizhimosti) {
       var nbre_room = parseInt(number_room, 10);
       var tproom ;


       if (type_nedvizhimosti == "Комната" ||
           type_nedvizhimosti == 'Частный дом') {

           if (type_nedvizhimosti == 'Частный дом'){
               return 'Дом';
           }

           return 'Комната';

       } else {

         switch (nbre_room) {
           case 1:
             tproom= "одноком.";
             break;

           case 2:
             tproom = "2х комн.";
             break;

           case 3:
             tproom = "3х комн.";
             break;

           case 4:
               tproom = "4х комн.";
               break;

           default:
             tproom = "Студия";
             break;
         };

        return tproom;

       }
   }

}]);

mena.controller("UserMailController", ['$scope', '$http', function($scope,  $http) {

   var url = '/mailbox/usermail';
   $scope.usermessages = [];

   $http.get(url).success(function(response) {
          $scope.usermessages = response;

   }).error(function(response) {
           console.log(response);
         //  alert('This is embarassing. An error has occured. Please check the log for details');
   });

   $scope.totalItems = $scope.usermessages.length;
   $scope.currentPage = 1;
   $scope.itemsPerPage = 2;

  //  $scope.addItemToBookmark  = function(iditem){
  //    $http.get('/bookmarked', {  params: { id: iditem } })
  //      .then(function(results) {
  //         alert('hi from backend');
  //      }, function(reason) {
  //         // TODO : Send reason to developers
  //      })
  //  }

}]);
