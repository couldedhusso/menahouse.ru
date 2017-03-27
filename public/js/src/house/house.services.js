(function () {

    'use strict';
    angular
        .module('mainApp')
        .factory('houseservice', houseservice);
    

    houseservice.$inject = ['Restangular'];

    function houseservice (Restangular) {
        var service ={
            getListHouse: getListHouse,
            getDetailHouse: getDetailHouse
        }

        return service ;

    ////////////

    
        function getDetailHouse(id) {
            return Restangular.one('house', id)
                              .then(getDetailComplete)
                              .catch(getDetailFailed);

            function getDetailComplete(response) {
                return response.data.results;
            }

            function getDetailFailed(error) {
                return "";
                // logger.error('XHR Failed for getAvengers.' + error.data);
            }
        }


        function getAvengers(paginate) {
            return Restangular.all('search/house').getList("page", {query: paginate})
                              .then(getListHouseComplete)
                              .catch(getListHouseFailed);

            function getListHouseComplete(response) {
                return response.data.results;
            }

            function getListHouseFailed(error) {
                return "";
                // logger.error('XHR Failed for getAvengers.' + error.data);
            }
        }

    }




})();