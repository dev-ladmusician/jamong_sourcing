$(document).ready(function(){
    $('.tab-links a').on('click', function (e) {
        var currentAttrValue = $(this).attr('href');
        console.log(currentAttrValue);

        //// Change/remove current tab to active
        $(this).addClass('active').siblings().removeClass('active');
        //
        $(currentAttrValue).addClass('active').siblings().removeClass('active');
        e.preventDefault();
    });

    //$('#channel-home').;
});
