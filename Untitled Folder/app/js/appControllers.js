/**
 * Created by ivan on 30.04.16.
 */
var appControllers = angular.module('appController',[]);

appControllers.controller("mainCTRL",["$scope", "locData",'$cookies', function($scope,  locData, $cookies){
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


        $scope.records={};
        blogRecord.query().$promise.then(function (result) {

            for (key in result) {
                if (result.hasOwnProperty(key) && key != "$promise" && key != "$resolved") {
                    $scope.records[key] = result[key];
                    $scope.records[key]["description"]={}
                    $scope.records[key]["description"]["en"] =result[key]["descr"];
                    $scope.records[key]["description"]["ru"] =result[key]["descr_ru"];
                    delete $scope.records[key]["descr"];
                    delete $scope.records[key]["descr_ru"];


                }
            }


        })


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
}]);

