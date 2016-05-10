/**
 * Created by SangBeom on 2016-04-19.
 */
$(document).ready(function(){
    var page = 1;
    var per_page = 8;
    var last_page = -1;
    var total_count = -1;
    var processing = false;
    var ajax_loader = $('.jm-ajax-loader');

    get_search_items(page, per_page);

    function get_search_items(page, perPage) {
        var query = $('#jm-search').val();
        var api = '/JAMONG/api/search/search_result?page=' + page + '&perPage=' + perPage + '&search_query=' + query;

        console.log(query);
        processing = true;
        ajax_loader.show();

        getJson(api, {},
            function (data) {

                ajax_loader.hide();
                processing = false;

                if (data.total_count) {
                    console.log(data);
                    page = data.page;
                    per_page = data.per_page;
                    last_page = data.last_page;
                    total_count = data.total_count;
                    $('.result-list').append(data.data);
                    var title = query + data.total_count + "개의 콘텐츠";
                    $('.jamong-search-result').text(title);
                } else {
                    $('.result-list').html(data.data);
                }

            }, function (arg) {
                console.log('error!!: ' + arg);
            }, 'json');
    };

    $('.jm-search .load-more').click(function () {
        if (!processing && page < last_page) {
            get_search_items(++page, per_page);
        }
    });
});