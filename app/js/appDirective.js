/**
 * Created by ivan on 30.04.16.
 */
var appDirective = angular.module("appDirective",[]);
appDirective.directive('navHeader', function() {
    return {
        restrict:'E',
        templateUrl: 'app/templates/header.html'
    };
});
appDirective.directive(
        'seFooter', function() {
            return {
                restrict:'E',
                templateUrl: 'app/templates/footer.html'
            };
        }
    );
appDirective.directive(
        'seSidebar', function() {
            return {
                restrict:'E',
                templateUrl: 'app/templates/sidebar.html',
                link:{

                }
            };
        }
    );

appDirective.directive('calendar', [function(){
    return {
        restrict: 'EA',
        scope: {
            date: '=',
            events: '='
        },
        link: function(scope, element, attributes) {
            var data = [{
                date: new Date(2016, 2,20),
                events: [{
                    name: 'wedding of Nastya and Sergii',
                    type: 'bot',
                    color: 'red'
                }]
            }];
            var calendar = new Calendar('#calendar', data);
        }
    }
}]);