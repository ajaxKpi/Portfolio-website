'use strict';
// Declare app level module which depends on views, and components
angular.module('myApp', [
  'ngRoute',
  'appController',
  'appDirective',
  'appServices',
  'djds4rce.angular-socialshare',
  'localization',
  'ngSanitize',
  'ngCookies',
  'afkl.lazyImage'

])
    .config(['$routeProvider', '$locationProvider',function($routeProvider, $locationProvider) {
  $routeProvider
      .when('/index.html', {
        templateUrl: 'templates/main.html',
        controller: 'pgRoot'
      })
      .when('/',{ templateUrl: 'templates/main.html',
          controller: 'pgRoot'})
      .when ('/About',{
          templateUrl: 'templates/About.html',
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
      .when ('/tag/:filterName',{
          templateUrl: 'templates/Blog.html',
          controller: 'pgTag'

      })
      .when ('/Feedbacks',{
          templateUrl: 'templates/Feedbacks.html',
          controller: 'pgFeedbacks'

      })
      .when ('/Services',{
          templateUrl: 'templates/Services.html',
          controller: 'pgServices'

      })
      .when ('/Contacts',{
          templateUrl: 'templates/Contacts.html',
          controller: 'pgContacts'

      })
      .when ('/404',{
        templateUrl: 'templates/404.html'

      });

        //$locationProvider.html5Mode(true);

}])
    .run( ['$FB',function($FB){
        $FB.init('137710999746808');

    }]);











