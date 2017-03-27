 var listArenda = angular.module('listArenda', []);

 listArenda.controller('ListArendaController', function ($scope, $http) {

       $scope.loading = true ;
       $http.get('/listarenda').success(function(listarenda){
               $scope.listarenda = listarenda ;
               $scope.loading = false ;
       });
 });
