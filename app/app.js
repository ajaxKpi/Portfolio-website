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
  'afkl.lazyImage'

])
    .config(['$routeProvider', '$locationProvider',function($routeProvider, $locationProvider) {
  $routeProvider
      .when('/index.html', {
        templateUrl: 'app/templates/main.html',
        controller: 'pgRoot'
      })
      .when('/',{
          templateUrl: 'app/templates/main.html',
          controller: 'pgRoot'
      })
      .
      when('#',{
          redirectTo:"/"
      })


      .when ('/About',{
          templateUrl: 'app/templates/About.html',
          controller: 'pgAbout'

      })
      .when ('/Blog',{
          templateUrl: 'app/templates/Blog.html',
          controller: 'pgBlog'

      })
      .when ('/Blog/:id',{
          templateUrl: 'app/templates/Article.html',
          controller: 'pgArticle'

      })
      .when ('/Advices',{
          templateUrl: 'app/templates/Blog.html',
          controller: 'pgAdvices'

      })
      /*
      .when ('/tag/:filterName',{
          templateUrl: 'app/templates/Blog.html',
          controller: 'pgTag'

      })*/
      .when ('/Feedbacks',{
          templateUrl: 'app/templates/Feedbacks.html',
          controller: 'pgFeedbacks'

      })
      .when ('/Services',{
          templateUrl: 'app/templates/Services.html',
          controller: 'pgServices'

      })
      .when ('/Contacts',{
          templateUrl: 'app/templates/Contacts.html',
          controller: 'pgContacts'

      })
      .when ('/404',{
        templateUrl: 'app/templates/404.html'

      })
      .otherwise({
          redirectTo: "/"
      });

        $locationProvider.html5Mode({enabled: true, requireBase: false});


}])
    .run( ['$FB','$rootScope',function($FB,$rootScope){
        $FB.init('1492697214384249');

        // VK.init({apiId: 5077240}); should be uncommented when vk.com will resume work
        $rootScope.SocialFB=true;

    }]);











