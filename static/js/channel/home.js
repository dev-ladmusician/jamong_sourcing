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

    var page = 1;
    var per_page = 8;
    var last_page = -1;
    var total_count = -1;
    var processing = false;
    var ajax_loader = $('.jm-ajax-loader');

    get_items(page, per_page);

    function get_items(page, perPage) {
        var channelId = $('#jm-channel-id').val();
        var api = '/JAMONG/api/channel/get_vr_list_by_channel?page=' + page + '&perPage=' + perPage + '&channelId=' + channelId;

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
                    $('#channel-vr .list-vr').append(data.data);
                } else {
                    $('#channel-vr .list-vr').html(data.data);
                }

                console.log(data.data);
                console.log(data.page);
                console.log(data.per_page);
                console.log(data.last_page);
                console.log(data.total_count);

            }, function (arg) {
                console.log('error!!: ' + arg);
            }, 'json');
    }

    $('#channel-vr .load-more').click(function(){
        if (!processing && page < last_page) {
            get_items(++page, per_page);
        }
    });
});
