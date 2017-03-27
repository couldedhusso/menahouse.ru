
var menamailbox = angular.module('menamailbox', []);

// var mainApp = angular.module('mainApp', ['ui-rangeSlider',
//                                          'ui.bootstrap'
//                                         ]);

/*app configuration added here*/
menaMailbox.config(['$interpolateProvider', '$locationProvider',
  function($interpolateProvider, $locationProvider) {

    $interpolateProvider.startSymbol('{>');
    $interpolateProvider.endSymbol('<}');

    $locationProvider.html5Mode({
      enabled: true,
      requireBase: false
    });
  }
]);
