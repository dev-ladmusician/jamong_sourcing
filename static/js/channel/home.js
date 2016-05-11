$(document).ready(function () {

    handle_date();

    $('.tab-links a').on('click', function (e) {
        var currentAttrValue = $(this).attr('href');
        console.log(currentAttrValue);

        //// Change/remove current tab to active
        $(this).addClass('active').siblings().removeClass('active');
        //
        $(currentAttrValue).addClass('active').siblings().removeClass('active');
        e.preventDefault();
    });

    //$('.btn-ch-subs').on('click', function (e) {
    //    var value = $('.value-subs-count').val();
    //    console.log("구독자 수 " + value);
    //});

    var vr_page = 1;
    var vr_per_page = 8;
    var vr_last_page = -1;
    var vr_total_count = -1;
    var vr_processing = false;
    var vr_ajax_loader = $('.jm-ajax-loader-container-vr');

    get_vr_list_items(vr_page, vr_per_page);

    function get_vr_list_items(page, perPage) {
        var channelId = $('#jm-channel-id').val();
        var api = '/JAMONG/api/channel/get_vr_list_by_channel?page=' + page + '&perPage=' + perPage + '&channelId=' + channelId;

        console.log(channelId);
        vr_processing = true;
        vr_ajax_loader.show();

        getJson(api, {},
            function (data) {

                vr_ajax_loader.hide();
                vr_processing = false;

                if (data.total_count) {
                    vr_page = data.page;
                    vr_per_page = data.per_page;
                    vr_last_page = data.last_page;
                    vr_total_count = data.total_count;
                    $('#channel-vr .list-vr').append(data.data);

                    if (vr_page == vr_last_page) {
                        $('.load-more').hide();
                    }
                } else {
                    $('#channel-vr .list-vr').html(data.data);
                }

            }, function (arg) {
                console.log('error!!: ' + arg);
            }, 'json');
    };

    var page = 1;
    var per_page = 6;
    var last_page = -1;
    var total_count = -1;
    var processing = false;
    var ajax_loader = $('.jm-ajax-loader-container-sub');

    get_subs_items(page, per_page);


    function get_subs_items(page, perPage) {
        var channelId = $('#jm-channel-id').val();
        var api = '/JAMONG/api/channel/get_subs_list_by_channel?page=' + page + '&perPage=' + perPage + '&channelId=' + channelId;

        console.log(channelId);
        processing = true;
        ajax_loader.show();

        getJson(api, {},
            function (data) {

                ajax_loader.hide();
                processing = false;

                if (data.total_count) {
                    page = data.page;
                    per_page = data.per_page;
                    last_page = data.last_page;
                    total_count = data.total_count;
                    $('#channel-sub .list-sub').append(data.data);
                    if (page == last_page) {
                        $('.load-more').hide();
                    }
                } else {
                    $('#channel-sub .list-sub').html(data.data);
                }

            }, function (arg) {
                console.log('error!!: ' + arg);
            }, 'json');
    };

    $('#channel-vr .load-more').click(function () {
        if (!vr_processing && vr_page < vr_last_page) {
            get_vr_list_items(++vr_page, vr_per_page);
        }
    });

    $('#channel-sub .load-more').click(function () {
        if (!processing && page < last_page) {
            get_subs_items(++page, per_page);
        }
    });
});

function handle_date(){
    var handle_date = $('#channel-handle-date').val();
    var str = handle_date.split('+');
    var date = str[0];
    var date_arr = date.split('-');
    var result = '20' + date_arr[0] + '년 ' + date_arr[1] + '월 ' + date_arr[2] + '일';
    console.log(result);
    $('#channel-home .main-video .video-des-bottom .video-des-date').append('<span>'+result+'</span>')
}
