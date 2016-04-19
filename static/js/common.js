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
    })
});