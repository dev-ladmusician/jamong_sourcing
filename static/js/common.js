/**
 * Created by ladmusician on 15. 9. 6..
 */
$(document).ready(function () {

    //search input event
    $('#jm-search').keydown(function(e){
        if(e.keyCode == 13){
            console.log($(this).val());
            $('.nav-search').submit();
        }
    });

    //user menu

    $('#jm-user').click(function(){
       console.log('user menu');
        var obj = $(this).position();
       console.log(obj.left);
        $('#jm-user-setting').css('left',obj.left + "px");
    });

    $('#jm-user-setting .list-user-setting li:first-child').click(function(){
        $('#fade').css("display","initial");
    });
    $('#jm-user-setting .list-user-setting li:last-child').click(function(){
        $('#fade').css("display","initial");
    });
    $('#join .close').click(function(){
        $('#fade').css("display","none");
    });
    $('#login .close').click(function(){
        $('#fade').css("display","none");
    });
});