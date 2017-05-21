/**
 * Created by ivan on 30.04.16.
 */
    "use strict";
var appServices = angular.module('appServices',['ngResource']);

appServices.factory('slider', ['$resource',
    function($resource){
        var url = '/backend/get_instagram';
            return $resource(url, {}, {
                getInstagram: {method: 'get'}
            });
    }])

.factory('blogRecord', ['$resource',
    function($resource){
        var url = '/backend/get_ALL';
        return $resource(url, {}, {
            query: {method: 'get'}
        });
    }])

.factory('popularRecord', ['$resource',
    function($resource){
        var url = '/backend/get_popular';
        return $resource(url, {}, {
            query: {method: 'get'}
        });

    }])
.factory('feedBacks', ['$resource',
    function($resource){
        var url = '/backend/get_feedbacks';
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
                    url: '/backend/send_mail',
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

    ])
    .factory('addVisitPage',['$http', function($http){
        return{
            increment: function(recordContainer){
                return (
                    $http({
                        method:'post',
                        url: 'backend/visit_page/'+recordContainer['recordId'],
                        data: recordContainer,
                        dataType: "json"
                        }).then(
                        function successCallback(response){

                        }

                    )
                )
            }
        }

}])
