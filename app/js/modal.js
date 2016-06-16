/**
 * Created by zvorskyi on 6/14/2016.
 */
angular.module('modalTest',['ui.bootstrap','dialogs'])
    .controller('dialogServiceTest',function($scope,$rootScope,$timeout,$dialogs){

        $scope.launch = function(){
            var dlg = null;
            dlg = $dialogs.notify('Something Happened!','Something happened that I need to tell you.');

            // for faking the progress bar in the wait dialog

        } // end dialogsServiceTest
})
        .run(['$templateCache',function($templateCache){
            $templateCache.put('/dialogs/whatsyourname.html','<div class="modal"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4 class="modal-title"><span class="glyphicon glyphicon-star"></span> User\'s Name</h4></div><div class="modal-body"><ng-form name="nameDialog" novalidate role="form"><div class="form-group input-group-lg" ng-class="{true: \'has-error\'}[nameDialog.username.$dirty && nameDialog.username.$invalid]"><label class="control-label" for="username">Name:</label><input type="text" class="form-control" name="username" id="username" ng-model="user.name" ng-keyup="hitEnter($event)" required><span class="help-block">Enter your full name, first &amp; last.</span></div></ng-form></div><div class="modal-footer"><button type="button" class="btn btn-default" ng-click="cancel()">Cancel</button><button type="button" class="btn btn-primary" ng-click="save()" ng-disabled="(nameDialog.$dirty && nameDialog.$invalid) || nameDialog.$pristine">Save</button></div></div></div></div>');
        }]); // end run / module
/* Fix for Bootstrap 3 with Angular UI Bootstrap

.modal {
    display: block;
}




.dialog-header-notify { background-color: #eeeeee; }



.pad { padding: 25px; }


 <html ng-app="modalTest">
 <head>
 <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.1.5/angular.min.js"></script>
 <script src="http://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.6.0.js" type="text/javascript"></script>
 <script src="http://m-e-conroy.github.io/angular-dialog-service/javascripts/dialogs.min.js" type="text/javascript"></script>
 </head>
 <body ng-controller="dialogServiceTest" class="pad">
 <h2>Bootstrap 3 & AngularJS Dialog/Modals</h2><br />
 <p>
 Demostration of my Angular-Dialog-Service module. Which can be found on Github: <a href="https://github.com/m-e-conroy/angular-dialog-service">https://github.com/m-e-conroy/angular-dialog-service</a><br />
 </p>
 <div class="row">


 <button class="btn btn-default" ng-click="launch()">Notify Dialog</button>


 </div>
 </div>
 <br />
 <div class="row">
 <div class="col-md-12">
 <p>
 <span class="text-info">From Confirm Dialog</span>: {{confirmed}}
 </p>
 </div>
 </div>
 <br />
 <div class="row">
 <div class="col-md-12">
 <p>
 <span class="text-info">Your Name</span>: {{name}}
 </p>
 </div>
 </div>
 <br />
 <p>
 <a href="http://michaeleconroy.blogspot.com/2013/10/redux-creating-application-dialog.html" target="_top"><strong>View My Blog Post</strong>: Redux: Creating an Application Dialog Service using AngularJS, Twitter Bootstrap & Angular UI-Bootstrap</a>
 </p>

 </body>
 </html>