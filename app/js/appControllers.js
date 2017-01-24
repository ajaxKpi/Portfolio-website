/**
 * Created by ivan on 30.04.16.
 */
var appControllers = angular.module('appController',[]);
appControllers.controller("mainCTRL",["$scope", '$location', "locData", 'blogRecord', function($scope, $location,  locData, blogRecord){

    $scope.filterTag = "";



        //get current language preferences
    var navigatorLang = navigator.language || navigator.userLanguage,
        local = "";
        // set 2 letter languge en-us -> en
        navigatorLang = navigatorLang.substr(0,2);


            if (Cookies.get('IZVlanguage')){
                //already have prefered language in cookie
                this.local =Cookies.get('IZVlanguage');
            }
            else {
                // not have language in cookie
                if (navigatorLang=="ru"||navigatorLang=="ua"){
                    this.local ="ru";
                }
                else{
                    this.local ="en";
                }
                Cookies.set('IZVlanguage', this.local, { expires: 365 });

            }
            //TODO Local is critical should be an value
            $scope.local=this.local||"ru";
            $scope.mainModel=locData[this.local];


        //triggered by language togglebutton(checkbox)
        $scope.setLocal =function(val){
           //on toggleButton value checked: true = ru language, false = en
           var ruLang =val.target.checked;

            if(ruLang){
                local="ru";
                $("#language").prop('checked', true);


            }
            else {
                local="en";

            }
            Cookies.set('IZVlanguage', local, { expires: 365 });
            $scope.mainModel=locData[local];
            $scope.local=local;
        };

        $scope.resetFilterTag=function(){

            $scope.filterTag = "";
            angular.element('.Tags .active').removeClass('active');

        };

        $scope.setFilterTag =function(tag){

            $scope.filterTag = angular.element(tag.currentTarget).text().toLowerCase();
            angular.element('.Tags .active').removeClass('active');
            angular.element(tag.currentTarget).addClass('active');

            //  if not on main and Blog page should relocate to it

            if($location.path()!=='/Blog'&& $location.path()!=='/'){
                $location.path('/Blog')
            }


        };

    //  make header element scrolable
    angular.element(document).ready(function () {
        makeHeaderScrolable(".navigation ");
    });



    // check if we already have filled object
        if($scope.records){
            return
        }

        $scope.records=[]; // Be accurate with this. Broke filter when {}
        blogRecord.query().$promise.then(function (result) {

            prepareQueryResults(result,$scope.records);

        });




    }])



    .controller("pgRoot",['$scope',function($scope){

    $(".navigation-internal a").css("color","black");
    $("#Portfolio").css("color","brown");

    }])

    .controller("pgAbout",['$scope',function($scope){

    $(".navigation-internal a").css("color","black");
    $("#About").css("color","brown");

    }])

    .controller("pgBlog",['$scope',"blogRecord",function($scope,blogRecord){
    $(".navigation-internal a").css("color","black");
    $("#Blog").css("color","brown");

    setImgPin('.Blog_photo img');

        if ($scope.filterTag==="advices"){$scope.resetFilterTag();}


        if($scope.records){
            return
        }

        $scope.records=[];
        blogRecord.query().$promise.then(function (result) {

            prepareQueryResults(result, $scope.records)


        });



    }])

    .controller("pgArticle",['$scope',"$routeParams", 'addVisitPage', 'blogRecord', function($scope,$routeParams, addVisitPage, blogRecord){
        $(".navigation-internal a").css("color","black");
        $("#Blog").css("color","brown");
        var id= $routeParams.id;

        // TODO: what a hell?
        $scope.record={};

        if ($scope.records.length!==0){

            for(record in $scope.records){
                if ($scope.records[record]['id']==id){$scope.record= $scope.records[record]}
            }

        }
        else {
                blogRecord.query().$promise.then(function (result) {

                    prepareQueryResults(result,$scope.records),(function(){  for(record in $scope.records){
                        if ($scope.records[record]['id']==id){return $scope.record=$scope.records[record]}
                    }})()


                });}



        //  increment visits in DB
        var visitPageContainer={
            recordId:id,
            action:"add_visit"
        };
        addVisitPage.increment(visitPageContainer);



    }])
    .controller("pgAdvices",['$scope',function($scope){
        $(".navigation-internal a").css("color","black");
        $("#Advices").css("color","brown");
        $scope.resetFilterTag();
        //for advice we should set filter block
        $scope.filterTag="advices";


    }])
    /*
    Replaces by
    .controller("pgTag",['$routeParams',
    function($routeParams){
        $(".navigation-internal a").css("color","black");
        //Advices is separate tag
        ($routeParams.filterName.toLowerCase() ==='advices')?$("#Advices").css("color","brown"):$("#Blog").css("color","brown");

        //create filter based on tag


    }])*/

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
        Block for reusable functions to perform database extract in usable JS object
 */
function prepareQueryResults(result, glob) {


    for (key in result) {
        if (result.hasOwnProperty(key) && key != "$promise" && key != "$resolved") {
            glob[key] = result[key];
            glob[key]["description"]={};
            glob[key]["description"]["en"] =result[key]["descr"];
            glob[key]["description"]["ru"] =result[key]["descr_ru"];
            /*
                For social share shold reduce text to 100 symbols and remove html
             */
            glob[key]["share_text"]={};
            glob[key]["share_text"]['en']=glob[key]["description"]["en"].replace(/(<([^>]+)>)/ig,"").substr(0,300);
            glob[key]["share_text"]['ru']=glob[key]["description"]["ru"].replace(/(<([^>]+)>)/ig,"").substr(0,300);


            delete glob[key]["descr"];
            delete glob[key]["descr_ru"];

            // should be fixed at server to save only foldername and file name (this need to past resolution 960 or 480)

            glob[key]["previews"]={};
            glob[key]["previews"]["960"] ="img/preview/960/" +result[key]["preview"].split("/")[2];

            //replace string of date to date format
            glob[key]["date"] = (function(str){
                var pattern = /(\d{4}).(\d{2}).(\d{2})?/;

                return( new Date(str.substr(0,10).replace(pattern,'$1-$2-$3')));

            })(glob[key]["date"])




        }
    }

}

/*

 scroll of fixed header

 */
function  makeHeaderScrolable(cssClass){
$(window).scroll(function(){
    if ($(window).innerWidth() < 960){
        $(cssClass).css('left',-$(window).scrollLeft());
    }
    else{
        $(cssClass).css('left', "");
    }
});
}
function removeHTMLtags(text) {
    var tmp = document.createElement("DIV");
    tmp.innerHTML = text;
    return tmp.textContent || tmp.innerText;
}
/*  set Custom logo of pinterest on img load on top right corneer(pos :2)
    use @ cssSelector for image selection
    @ pinLogoUrl - url to img that will appeared on hover
    @ use Jquery and jquery.imgPin
 */
function setImgPin(cssSelector){
    var pinLogoUrl = "img/pinterestOnImg.png";
    
    $(cssSelector).imgPin(
        {
            pinImg : pinLogoUrl, position: 2
        }
    );
}

