/**
 * Created by ivan on 30.04.16.
 */
var appControllers = angular.module('appController',[]);
appControllers.controller("mainCTRL",["$scope", "locData",'$cookies', 'blogRecord', function($scope,  locData, $cookies, blogRecord){

    // check if we already have filled object
    if($scope.records){
       return
    }

        $scope.records={};
        blogRecord.query().$promise.then(function (result) {

            prepareQueryResults(result,$scope.records);

        });


/*
*
*
* work with cookies to set - get language properties
*
*
*/

        //get current language preferences
    var navigatorLang = navigator.language || navigator.userLanguage,
        userLang = $cookies.get('IZVlanguage'),
        local = "";

        navigatorLang = navigatorLang.substr(0,2);

        if (userLang){
            //already have prefered language in cookie
            local =userLang;
        }
        else {
            // not have language in cookie
            if (navigatorLang=="ru"||navigatorLang=="ua"){
                local ="ru";
                          }
            else{
                local ="en";
                           }
            $cookies.put('IZVlanguage', local);

        }


        //TODO Local is critical should be an value
        $scope.local=local;
        $scope.mainModel=locData[local];


        //triggered by language togglebutton(checkbox)
        $scope.setLocal =function(val){
           //on toggleButton value checked: true = ru language, false = en
           var ruLang =val.target.checked;

            if(ruLang){
                this.local="ru";
                $("#language").prop('checked', true);


            }
            else {
                this.local="en";


            }
            $cookies.put('IZVlanguage', this.local);
            $scope.mainModel=locData[this.local];
            $scope.local=this.local;
        };


    }])



    .controller("pgRoot",['$scope',function($scope){

    $(".navigation-internal a").css("color","black");
    $("#Portfolio").css("color","brown")
}])
    .controller("pgAbout",['$scope',function($scope){
    $(".navigation-internal a").css("color","black")
    $("#About").css("color","brown")

}])
    .controller("pgBlog",['$scope',"blogRecord",function($scope,blogRecord){
    $(".navigation-internal a").css("color","black")
    $("#Blog").css("color","brown")

        if($scope.records){
            return
        }

        $scope.records={};
        blogRecord.query().$promise.then(function (result) {

            prepareQueryResults(result, $scope.records)


        })


}])
    .controller("pgArticle",['$scope',"$routeParams",function($scope,$routeParams){
        $(".navigation-internal a").css("color","black");
        $("#Blog").css("color","brown");
        id= $routeParams.id;

         var record=(function(id){
                for(record in $scope.records){

                    if ($scope.records[record]['id']==id){return $scope.records[record]}
                }
        })(id);

        $scope.record=record;


    }])
    .controller("pgAdvices",['$scope',function($scope){
    $(".navigation-internal a").css("color","black")
    $("#Blog").css("color","brown")

}])
    .controller("pgTag",['$routeParams',
    function($routeParams){
        $(".navigation-internal a").css("color","black");
        //Advices is separate tag
        ($routeParams.filterName.toLowerCase() ==='advices')?$("#Advices").css("color","brown"):$("#Blog").css("color","brown");

        //create filter based on tag


    }])

.controller("pgServices",['$scope',function($scope){
    $(".navigation-internal a").css("color","black")
    $("#Services").css("color","brown")

}])
    .controller("pgContacts",['$scope',"sendMail", function($scope, sendMail){
    $(".navigation-internal a").css("color","black");
    $("#Contacts").css("color","brown");
       //var mail={};
        $scope.sendMail=function(mail){
            if($scope.submitForm.$valid){
                //TODO: server mail
                var mailContainer={};
                 mailContainer ["action"] ="send_mail";
                 mailContainer ["mail"] = mail;
                sendMail.send(mailContainer).then(function(response){
                    console.log( response);
                },
                    function(response){
                        console.log(response);
                })

        }
        }



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
    .controller("pgFeedbacks",["$scope","feedBacks",function($scope,feedBacks){
        $(".navigation-internal a").css("color","black");
        $("#Feedbacks").css("color","brown");

        if ( $scope.feedbacks){return }

        var feedbacks ={};
        feedBacks.query().$promise.then(function(result){
            for (key in result) {
                if (result.hasOwnProperty(key) && key != "$promise" && key != "$resolved") {
                    feedbacks[key] = result[key];
                    feedbacks[key]["description"]={};
                    feedbacks[key]["description"]["en"] =result[key]["feedback"];
                    feedbacks[key]["description"]["ru"] =result[key]["feedback_ru"];
                    delete feedbacks[key]["feedback"];
                    delete feedbacks[key]["feedback_ru"];

                }
            }
            $scope.feedbacks = feedbacks;

        })

    }])
.controller("popular_stories",["$scope","popularRecord",function($scope,popularRecord) {

    if ( $scope.stories){return }
    var stories ={};

    popularRecord.query().$promise.then(function (result) {

        for (key in result) {
            if (result.hasOwnProperty(key) && key != "$promise" && key != "$resolved") {
                stories[key] = result[key];

            }
        }
        $scope.stories = stories;

    })
}]);


/*
        Block for reusable functions in controller
 */
function prepareQueryResults(result, glob) {


    for (key in result) {
        if (result.hasOwnProperty(key) && key != "$promise" && key != "$resolved") {
            glob[key] = result[key];
            glob[key]["description"]={};
            glob[key]["description"]["en"] =result[key]["descr"];
            glob[key]["description"]["ru"] =result[key]["descr_ru"];
            delete glob[key]["descr"];
            delete glob[key]["descr_ru"];

            //replace string of date to date format
            glob[key]["date"] = (function(str){
                var pattern = /(\d{4}).(\d{2}).(\d{2})?/;

                return( new Date(str.substr(0,10).replace(pattern,'$1-$2-$3')));

            })(glob[key]["date"])




        }
    }



}