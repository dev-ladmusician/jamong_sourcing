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

    // submit comment
    var commentForm = $('#jm-form-comment');
    $('.btn-cm-submit > a').click(function() {
        console.log(commentForm);
        commentForm.submit();
    });

    var page = 1;
    var per_page = 10;
    var last_page = -1;
    var total_count = -1;
    var processing = false;
    var ajax_loader = $('.jm-ajax-loader-container');
    var contentId = $('#jamong-content-id').val();

    get_search_items(page, per_page);

    function get_search_items(page, perPage) {
        var query = $('#jm-search').val();
        var api = '/JAMONG/api/player/get_comments?page=' + page + '&perPage=' + perPage +
            '&contentId=' + contentId;
        processing = true;
        ajax_loader.show();

        getJson(api, {},
            function (data) {
                ajax_loader.hide();
                processing = false;
                page = data.page;
                per_page = data.per_page;
                last_page = data.last_page;
                total_count = data.total_count;
                $('.comment-list').append(data.data);

                if (data.is_last) {
                    $('.load-more').hide();
                }
                handleCommentDelet();
            }, function (arg) {
                console.log('error!!: ' + arg);
            }, 'json');
    };

    // show more comment
    $('.load-more').click(function () {
        if (!processing && page < last_page) {
            get_search_items(++page, per_page);
        }
    });

    function handleCommentDelet() {
        // delete comment
        $('.comment-delete').click(function (e) {
            e.preventDefault();
            var commentId = $(this).attr('id');
            getJson('/JAMONG/api/player/delete_comment?commentId=' + commentId, {},
                function (data) {
                    console.log(data);
                    if (data > 0) {
                        window.location.href = "/JAMONG/player?contentId=" + contentId;
                    } else {
                        alert('댓글을 삭제하는데 오류가 발생헀습니다.');
                    }
                }, function (arg) {
                    console.log('error!!: ' + arg);
                }, 'json');
        });
    }
});

function reset_recommend_list_max_height(){
    var row_height = $('.content-wrapper .row div:first-child').outerHeight();
    var upper_item_height = $('.jm-player-channel').outerHeight(true);
    var target_header = $('.jm-player-recommend .header').outerHeight();
    var target = $('.jm-player-recommend .recommend-list');
    target.css("max-height", row_height - upper_item_height - target_header + "px");
}