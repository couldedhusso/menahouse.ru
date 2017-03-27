var mainApp = angular.module('mainApp', ["ui-rangeSlider"]);

/*app configuration added here*/
mainApp.config(['$interpolateProvider', '$locationProvider',
  function($interpolateProvider, $locationProvider) {

    $interpolateProvider.startSymbol('{>');
    $interpolateProvider.endSymbol('<}');

    $locationProvider.html5Mode({
      enabled: true,
      requireBase: false
    });;
  }
]);

mainApp.factory('RangeSliderFactory', function() {
  // private variables and functions
  var range = {
    min: 20,
    max: 100
  };

  // public API
  return {
      getrangeValue : function() {
        return range
      }
  };
});


mainApp.controller("mainController", ['$scope', 'RangeSliderFactory','$http', function($scope, RangeSliderFactory, $http) {

  $scope.range = RangeSliderFactory.getrangeValue();
  var url = '/getqueryresults';
  //

  //
  $http.get(url).success(function(response) {
         $scope.data = response;
         alert('Everything is well ');
  }).error(function(response) {
          console.log(response);
          alert('This is embarassing. An error has occured. Please check the log for details');
  });

}]);

//# sourceMappingURL=all.js.map
