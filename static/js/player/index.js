///**
// * Created by SangBeom on 2016-04-20.
// */
//embedpano(
//    {
//        //used in flash
//        //swf: "krpano.swf",
//
//        //null is used
//        //xml: "pano.xml",
//        xml: null,
//
//        //The #id of the html element where the viewer should be embedded.
//        // There will be an 'alert()' error when no target will be set.
//        target: "pano"
//    });


$(window).load(function(){
    reset_recommend_list_max_height();
});
$(document).ready(function(){
    embedpano({
        swf:"http://ec2-54-250-155-70.ap-northeast-1.compute.amazonaws.com/JAMONG/static/jamongplayer/kp_jamong.swf",
        xml:"http://ec2-54-250-155-70.ap-northeast-1.compute.amazonaws.com/JAMONG/static/jamongplayer/video.xml",
        target:"pano",
        html5:"only"});

    $('.load-more').click(function(){
        reset_recommend_list_max_height();
    });

    var commentForm = $('#jm-form-comment');
    $('.btn-cm-submit > a').click(function() {
        console.log(commentForm);
        commentForm.submit();
    });
});

function reset_recommend_list_max_height(){
    var row_height = $('.content-wrapper .row div:first-child').outerHeight();
    var upper_item_height = $('.jm-player-channel').outerHeight(true);
    var target_header = $('.jm-player-recommend .header').outerHeight();
    var target = $('.jm-player-recommend .recommend-list');
    target.css("max-height", row_height - upper_item_height - target_header + "px");
}