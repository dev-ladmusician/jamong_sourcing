$(document).ready(function(){

    var page = 1;
    var per_page = 8;
    var last_page = -1;
    var total_count = -1;
    var processing = false;
    var ajax_loader = $('.jm-ajax-loader-container');

    get_items(page, per_page);

    function get_items(page, perPage) {
        var categoryId = $('#jm-category-id').val();
        var api = '/JAMONG/api/category/get_contents_by_category?page=' + page + '&perPage=' + perPage + '&categoryId=' + categoryId;

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
                    $('.jm-category .category-list').append(data.data);

                    if (page == last_page) {
                        $('.load-more').hide();
                    }
                } else {
                    $('.jm-category .category-list').html(data.data);
                }


            }, function (arg) {
                console.log('error!!: ' + arg);
            }, 'json');
    }

    $('.jm-category .load-more').click(function(){
        if (!processing && page < last_page) {
            get_items(++page, per_page);
        }
    });
});