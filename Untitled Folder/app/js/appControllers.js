/**
 * Created by ivan on 30.04.16.
 */
var appControllers = angular.module('appController',[]);
<<<<<<< HEAD
appControllers.controller("pgRoot",['$scope',function($scope){
=======
appControllers.controller("mainCTRL",["$scope", "$http",function($scope, $http){
        /*get current language preferences

        if (!$.cookie("language","ru")){
            $scope.local ="ru";
        }
        else {
            $scope.local ="en";
        }
*/
        var local="ru";
        $http({
            method: 'GET',
            url: 'localization/locData.json'
        }).then(
                function(result){
                    $scope.MainModel= result.data[local];
                },
            function(res){
                alert(res)
            }
            )

        this.setLocal = function(val){
            if(val){
                this.local="ru";
              //  $.cookie("language","ru");

            }
            else {
                this.local="en";
               // $.cookie("language","en");
            }
        }


    }])



    .controller("pgRoot",['$scope',function($scope){
>>>>>>> 9180d4912c1e75c7e83534f6f907b8fdadcda704
    $(".navigation-internal a").css("color","black");
    $("#Portfolio").css("color","brown")
}])
    .controller("pgAbout",['$scope',function($scope){
    $(".navigation-internal a").css("color","black")
    $("#About").css("color","brown")

}])
    .controller("pgBlog",['$scope',function($scope){
    $(".navigation-internal a").css("color","black")
    $("#Blog").css("color","brown")

}])
    .controller("pgArticle",['$scope',"$routeParams",function($scope,$routeParams){
        $(".navigation-internal a").css("color","black");
        $("#Blog").css("color","brown");
        console.log($routeParams.id)
    }])
    .controller("pgAdvices",['$scope',function($scope){
    $(".navigation-internal a").css("color","black")
    $("#Blog").css("color","brown")

}])
.controller("pgServices",['$scope',function($scope){
    $(".navigation-internal a").css("color","black")
    $("#Services").css("color","brown")

}])
    .controller("pgContacts",['$scope',function($scope){
    $(".navigation-internal a").css("color","black")
    $("#Contacts").css("color","brown")

}])
.controller("pgFeedbacks",['$scope',function($scope){
    $(".navigation-internal a").css("color","black")
    $("#Feedbacks").css("color","brown")

}])
.controller("set_slider",["slider",function(slider) {
    var instaImg = [];

    slider.getInstagram().$promise.then(function (result) {
        for (key in result) {
            if (result.hasOwnProperty(key) && key != "$promise" && key != "$resolved") {

                instaImg.push(result[key]);
            }
        }

        /*

         instagram slider block

         */

        var currentIndex = 0, items = instaImg,
            itemAmt = items.length, prevIndex = 0;
        $('.inst_item a').attr('href', items[currentIndex].link);
        $('.inst_item img').attr('src', items[currentIndex].large);

        var autoSlide = setInterval(function () {
            currentIndex += 1;
            if (currentIndex > itemAmt - 1) {
                currentIndex = 0;
                prevIndex = itemAmt - 1;
            }

            // $(items[prevIndex]).css("opacity", "0")
            // $(items[currentIndex]).css("opacity", "1")
            $('.inst_item').fadeOut(2000, function () {
                $('.inst_item a').attr('href', items[currentIndex].link);
                $('.inst_item img').attr('src', items[currentIndex].large);
                $('.inst_item').fadeIn(2000)
            });


            prevIndex = currentIndex;
        }, 4000);


    })
}])

.controller("popular_stories",["$scope","popularRecord",function($scope,popularRecord) {
    var stories ={};

    popularRecord.query().$promise.then(function (result) {

        for (key in result) {
            if (result.hasOwnProperty(key) && key != "$promise" && key != "$resolved") {
                stories[key] = result[key];

            }
        }
        $scope.stories = stories;




    })
}])
<<<<<<< HEAD
=======

.controller("locData.json",["$http", function($http){
        var formData =$http()


    }])
>>>>>>> 9180d4912c1e75c7e83534f6f907b8fdadcda704
