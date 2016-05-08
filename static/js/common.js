/**
 * Created by ladmusician on 15. 9. 6..
 */
$(window).load(function(){
   //var popup = $('.popup-container');
   // var visible = popup.css('visibility');
   // console.log(visible);
});
$(document).ready(function () {

    setUserSettingMargin();

    $(window).resize(function(){
        var header = $('.main-header .container');
        var header_margin = header.outerWidth(true) - header.outerWidth() ;
        console.log("header-margin : " + header_margin/2);
        $('#jm-user-setting .popup-login-container').css('margin-right', (header_margin / 2) + "px");
    });
    //user menu
    $('#jm-user').click(function(){
        var header = $('.main-header .container');
        var header_margin = header.outerWidth(true) - header.outerWidth() ;
        console.log("header-margin : " + header_margin/2);
        $('#jm-user-setting .popup-login-container').css('margin-right', (header_margin / 2) + "px");
    });

    //search input event
    $('#jm-search').keydown(function(e){
        if(e.keyCode == 13){
            console.log($(this).val());
            $('.nav-search').submit();
        }
    });
});

function setUserSettingMargin(){
    var header = $('.main-header .container');
    var header_margin = header.outerWidth(true) - header.outerWidth() ;
    console.log("header-margin : " + header_margin/2);
    $('#jm-user-setting .popup-login-container').css('margin-right', (header_margin / 2) + "px");
}