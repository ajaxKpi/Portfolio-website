'use strict';

// Declare app level module which depends on views, and components
angular.module('myApp', [
  'ngRoute',
  'appController',
  'appDirective',
  'appServices',
  'djds4rce.angular-socialshare',
  'localization',
  'ngSanitize'

])
    .config(['$routeProvider', '$locationProvider',function($routeProvider,$locationProvider) {
  $routeProvider
      .when('/index.html', {
        templateUrl: 'templates/main.html',
        controller: 'pgRoot'
      })
      .when('/',{redirectTo: '/index.html'})
      .when ('/About',{
          templateUrl: 'templates/about_en.html',
          controller: 'pgAbout'

      })
      .when ('/Blog',{
          templateUrl: 'templates/Blog.html',
          controller: 'pgBlog'

      })
      .when ('/Blog/:id',{
          templateUrl: 'templates/Article.html',
          controller: 'pgArticle'

      })
      .when ('/Advices',{
          templateUrl: 'templates/Blog.html',
          controller: 'pgAdvices'

      })
      .when ('/Feedbacks',{
          templateUrl: 'templates/Feedbacks.html',
          controller: 'pgFeedbacks'

      })
      .when ('/Services',{
          templateUrl: 'templates/services_en.html',
          controller: 'pgServices'

      })
      .when ('/Contacts',{
          templateUrl: 'templates/Contacts.html',
          controller: 'pgContacts'

      })
      .when ('/404',{
        templateUrl: 'templates/404.html'

      })
      .otherwise({redirectTo: '/404'});
  $locationProvider.html5Mode(true);

}])
    .run( ['$FB',function($FB){
        $FB.init('137710999746808');

    }]);










