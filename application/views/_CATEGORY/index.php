<div class="content-wrapper col-lg-9 col-md-9 col-sm-12">
    <section class="jm-category">
        <div class="row solid-border-empty">

            <input type="hidden" value="<?= $categoryId?>" id="jm-category-id">
            <div id="jm-category-header" class="page-header solid-border-bottom">
                <?= $title ?> <span><?= $sub ?></span>
            </div>

            <div class="jm-ajax-loader-container text-center">
                <img class="jm-ajax-loader" src="<?= site_url('/static/img/loader.gif')?>" />
            </div>

            <div class="category-list col-lg-12 col-md-12 col-sm-12 padding-outer solid-border-bottom">

            </div>

            <div class="load-more col-lg-12 col-md-12 col-sm-12">
                <a href="#">더보기<i class="glyphicon glyphicon-menu-down"></i></a>
            </div>

        </div>


    </section>
</div>
