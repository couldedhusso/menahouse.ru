
var menahouse = angular.module('menahouse', []);

/*app configuration added here*/
menahouse.config(['$interpolateProvider', '$locationProvider',
          function($interpolateProvider, $locationProvider) {

          $interpolateProvider.startSymbol('{> ');
          $interpolateProvider.endSymbol('<}');

          $locationProvider.html5Mode({ enabled: true, requireBase: false });;
}]);


// menahouse.controller('SearchItemsController', function($scope, $http, $windows) {
menahouse.controller('SearchItemsController', ['$scope','$location', '$http' ,
                      function($scope, $location, $http)
{
    $scope.datafilter = {};
    //$scope.loading = false ;

    $scope.processForm = function(search){
      $scope.datafilter = angular.copy(search);

      var qs = $location.search($scope.datafilter);
      window.location = "./properties";
    

      $http({
          method  : 'post',
          url     : 'properties/getdata',
          data    : $.param(qs),  // pass in data as strings
          headers : { 'Content-Type': 'application/x-www-form-urlencoded' }  // set the headers so angular passing info as form data (not request payload)
      }).success(function(response) {
            console.log(response);
      });
}}]);
