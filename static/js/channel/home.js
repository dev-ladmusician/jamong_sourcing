$(document).ready(function () {
    $('.tab-links a').on('click', function (e) {
        var currentAttrValue = $(this).attr('href');
        console.log(currentAttrValue);

        //// Change/remove current tab to active
        $(this).addClass('active').siblings().removeClass('active');
        //
        $(currentAttrValue).addClass('active').siblings().removeClass('active');
        e.preventDefault();
    });

    var page = 1;
    var per_page = 8;
    var last_page = -1;
    var total_count = -1;
    var processing = false;
    var ajax_loader = $('.jm-ajax-loader-sub');
    //
    var vr_page = 1;
    var vr_per_page = 8;
    var vr_last_page = -1;
    var vr_total_count = -1;
    var vr_processing = false;
    var vr_ajax_loader = $('.jm-ajax-loader-vr');

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
                } else {
                    $('#channel-vr .list-vr').html(data.data);
                }

            }, function (arg) {
                console.log('error!!: ' + arg);
            }, 'json');
    };

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
                } else {
                    $('#channel-sub .list-sub').html(data.data);
                }

            }, function (arg) {
                console.log('error!!: ' + arg);
            }, 'json');
    }

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
