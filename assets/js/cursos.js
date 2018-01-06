
var width = null;
var navleft = $("#navleft");
var navtop = $("#navtop");
var smallOptions = $("#small-options");

navleft.hide();
navtop.hide();
smallOptions.hide();

if($(window).width() < 776){
    navtop.show();
    smallOptions.show();
} else {
    navleft.show();
}
