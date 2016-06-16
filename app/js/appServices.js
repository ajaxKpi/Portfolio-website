/**
 * Created by ivan on 30.04.16.
 */
    "use strict";
var appServices = angular.module('appServices',['ngResource']);

appServices.factory('slider', ['$resource',
    function($resource){
        var url = 'http://zvorska.com/backend/api.php?action=get_instagram';
            return $resource(url, {}, {
                getInstagram: {method: 'get'}
            });
    }])

.factory('blogRecord', ['$resource',
    function($resource){
        var url = 'http://zvorska.com/backend/api.php?action=get_ALL';
        return $resource(url, {}, {
            query: {method: 'get'}
        });
    }])

.factory('popularRecord', ['$resource',
    function($resource){
        var url = 'http://zvorska.com/backend/api.php?action=get_popular';
        return $resource(url, {}, {
            query: {method: 'get'}
        });

    }])
.factory('feedBacks', ['$resource',
    function($resource){
        var url = 'http://zvorska.com/backend/api.php?action=get_feedback';
        return $resource(url, {}, {
            query: {method: 'get'}
        });

    }])
    .factory('sendMail',['$http',
    function ($http){
        return{
            send: function (mail){return(
                $http({
                    method: 'post',
                    url: 'http://zvorska.com/backend/api.php',
                    data: mail,
                    dataType: "json"
                }).then(function successCallback(response) {
                    // this callback will be called asynchronously
                    return (response["data"])
                }, function errorCallback(response) {
                    // called asynchronously if an error occurs
                    // or server returns response with an error status.
                    return ("Got error")
                })
                )}
         }

    }

    ]);
