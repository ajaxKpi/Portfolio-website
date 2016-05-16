/**
 * Created by ivan on 30.04.16.
 */
    "use strict";
var appServices = angular.module('appServices',['ngResource']);

appServices.factory('slider', ['$resource',
    function($resource){
        var url = 'http://localhost/angular-seed/backend/api.php?action=get_instagram';
            return $resource(url, {}, {
                getInstagram: {method: 'get'}
            });
    }])

.factory('blogRecord', [
    function(){


    }])

.factory('popularRecord', ['$resource',
    function($resource){
        var url = 'http://localhost/angular-seed/backend/api.php?action=get_popular';
        return $resource(url, {}, {
            query: {method: 'get'}
        });

    }]);