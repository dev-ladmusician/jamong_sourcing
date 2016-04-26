$(document).ready(function(){
    $('.tab a').on('click', function (e) {
        var currentAttrValue = $(this).attr('href');
        console.log(currentAttrValue);

        //show / hide tabs
        //$('.tabs ' + currentAttrValue).show().siblings().hide();

        //// Change/remove current tab to active
        $(this).addClass('active').siblings().removeClass('active');
        //
        $(currentAttrValue).addClass('active').siblings().removeClass('active');
        e.preventDefault();
    });
})/**
 * Created by SangBeom on 2016-04-26.
 */
