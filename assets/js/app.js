// assets/js/app.js

// loads the jquery package from node_modules
var $ = require('jquery');

// JS is equivalent to the normal "bootstrap" package
// no need to set this to a variable, just require it
require('bootstrap-sass');

// import the function from greet.js (the .js extension is optional)
// ./ (or ../) means to look for a local file

$(document).ready(function() {

    console.log("hello ");
});