$(document).ready(function () {
    var page = 1;
    var per_page = 8;
    var last_page = -1;
    var total_count = -1;
    var processing = false;
    var ajax_loader = $('.jm-ajax-loader-container');

    get_items(page, per_page);

    function get_items(page, perPage) {
        var api = '/JAMONG/api/channels/get_channel_list?page=' + page + '&perPage=' +perPage;

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
                $('.jm-channels .channels-list').append(data.data);

                if (page == last_page) {
                    $('.load-more').hide();
                }
            }, function (arg) {
                console.log('error!!: ' + arg);
            }, 'json');
    }

    $('.jm-channels .load-more').click(function(){
        if (!processing && page < last_page) {
            get_items(++page, per_page);
        }
    });
});

