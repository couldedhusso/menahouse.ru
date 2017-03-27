
var menahouseailbox = angular.module('menahouseailbox', []);

// var mainApp = angular.module('mainApp', ['ui-rangeSlider',
//                                          'ui.bootstrap'
//                                         ]);

/*app configuration added here*/
menahouseailbox.config(['$interpolateProvider', '$locationProvider',
  function($interpolateProvider, $locationProvider) {

    $interpolateProvider.startSymbol('{>');
    $interpolateProvider.endSymbol('<}');

    $locationProvider.html5Mode({
      enabled: true,
      requireBase: false
    });
  }
]);
