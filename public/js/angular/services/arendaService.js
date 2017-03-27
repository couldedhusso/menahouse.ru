angular.module('searchService', []).factory('Obivlenie', function($http){
      return {
          // get all ad
          get : function(){
              return $http.get('/house/catalogue');
          }
      }
});
