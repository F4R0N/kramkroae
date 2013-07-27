var setMainmenuHeight = function() {
    $("#mainmenu").css("height", $(document).height());
}
$(document).ready(function(){
    setMainmenuHeight();
});
$(window).resize(function(){
    setMainmenuHeight();
});
