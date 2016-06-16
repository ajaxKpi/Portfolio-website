/**
 * Created by ivan.zvorskyi on 6/16/2016.
 */
var gulp = require("gulp"),
    htmlReplace = require("gulp-html-replace");

gulp.task("html-prod",function(){
    console.log("hi!");
});

gulp.task("default",["html-prod"]);
