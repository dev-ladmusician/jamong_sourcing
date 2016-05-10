<div class="content-wrapper col-lg-9 col-md-9 col-sm-12">
    <section class="sc-main">
        <div class="row">
            <div class="main-video padding-none col-lg-12">
                <div class="video-large">
                    <a href="<?= site_url('/player?contentId=') . $main_video->inum ?>">
                        <img
                            src="https://s3-ap-northeast-1.amazonaws.com/dongshin.images/playlist/<?= $main_video->filename ?>/<?= $main_video->picture ?>"
                            alt=""></a>
                </div>
            </div>

            <div class="list-hot col-lg-12 padding-none">
                <section class="sc-main-hot">
                    <div class="list-header solid-border-bottom  padding-normal">
                        <span>인기VR컨텐츠</span>
                        <a href="<?= site_url('/category?categoryId=9') ?>"><span>more</span></a>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 padding-outer">
                        <?php
                        foreach ($vr_list_hot as $item) {
                            ?>
                            <div class="video-small col-lg-3 col-md-3 col-sm-4 col-xs-6 padding-inner">
                                <div class="solid-border-box">
                                    <a href="<?= site_url('/player?contentId=') . $item->inum ?>">
                                        <img
                                            src="https://s3-ap-northeast-1.amazonaws.com/dongshin.images/playlist/<?= $item->filename ?>/<?= $item->picture ?>"
                                            alt="">
                                    </a>

                                    <div class="video-des">
                                        <p class="video-des-title"><?= $item->title ?></p>

                                        <p class="video-des-publisher">게시자: <?= $item->nickName ?></p>

                                        <p class="video-des-hits">조회수: <?= $item->hit ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </section>

            </div>

            <div class="list-new col-lg-12 padding-none">
                <section class="sc-main-new">
                    <div class="list-header solid-border-bottom col-lg-12 padding-normal">
                        <span>신규VR컨텐츠</span>
                        <a href="<?= site_url('/category?categoryId=10') ?>"><span>more</span></a>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 padding-outer">
                        <?php
                        foreach ($vr_list_new as $item) {
                            ?>
                            <div class="video-small col-lg-3 col-md-3 col-sm-4 col-xs-6 padding-inner">
                                <div class="solid-border-box">
                                    <a href="<?= site_url('/player?contentId=') . $item->inum ?>">
                                        <img
                                            src="https://s3-ap-northeast-1.amazonaws.com/dongshin.images/playlist/<?= $item->filename ?>/<?= $item->picture ?>"
                                            alt="">
                                    </a>

                                    <div class="video-des">
                                        <p class="video-des-title"><?= $item->title ?></p>

                                        <p class="video-des-publisher">게시자: <?= $item->nickName ?></p>

                                        <p class="video-des-hits">조회수: <?= $item->hit ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>

                </section>
            </div>


        </div>
    </section>

</div>