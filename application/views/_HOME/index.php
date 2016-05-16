<div class="content-wrapper col-lg-9 col-md-9 col-sm-12">
    <section class="sc-main">
        <div class="row">
            <div class="main-video padding-none col-lg-12">
                <div class="video-large">
                    <a href="<?= site_url('/player?contentId=') . $main_video->inum ?>">
                        <?php
                        if ($main_video->picture) {
                            ?>
                            <img
                                src="https://s3-ap-northeast-1.amazonaws.com/dongshin.images/playlist/<?php echo $main_video->filename . '/high_thumb'; ?><?php if (strpos($main_video->picture, 'high_thumb')) {
                                    $rtv = explode('high_thumb', $main_video->picture)[1];
                                    echo $rtv;
                                } else {
                                    echo '.png';
                                } ?>"
                                alt="">
                            <?php
                        } else {
                            ?>
                            <img
                                src="https://s3-ap-northeast-1.amazonaws.com/dongshin.images/playlist/<?= $main_video->filename ?>/high_00001.png"
                                alt="">
                            <?php

                        }
                        ?>
                    </a>
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
                        foreach ($vr_list_hot as $item) { ?>

                            <div class="video-small col-lg-3 col-md-3 col-sm-4 col-xs-6 padding-inner">
                                <div class="solid-border-box">
                                    <div class="video-thumbnail-container">

                                        <a href="<?= site_url('/player?contentId=') . $item->inum ?>">

                                            <?php
                                            if ($item->picture) {
                                                ?>
                                                <img
                                                    src="https://s3-ap-northeast-1.amazonaws.com/dongshin.images/playlist/<?php echo $item->filename . '/low_thumb'; ?><?php if (strpos($item->picture, 'high_thumb')) {
                                                        $rtv = explode('high_thumb', $item->picture)[1];
                                                        echo $rtv;
                                                    } else {
                                                        echo '.png';
                                                    } ?>"
                                                    alt="">
                                                <?php
                                            } else {
                                                ?>
                                                <img
                                                    src="https://s3-ap-northeast-1.amazonaws.com/dongshin.images/playlist/<?= $item->filename ?>/low_00001.png"
                                                    alt="">
                                                <?php

                                            }
                                            ?>
                                        </a>

                                    </div>

                                    <div class="video-des">
                                        <p class="video-des-title"><?php
                                            if( ceil( strlen($item->title ) / 3) > 10){
                                                echo str_split($item->title, 10*3)[0] . '...';
                                            }else{
                                                echo $item->title;
                                            }?></p>

                                        <p class="video-des-publisher">게시자: <?= $item->nickName ?></p>

                                        <p class="video-des-hits">조회수: <?= $item->view ?></p>
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
                                    <div class="video-thumbnail-container">
                                        <a href="<?= site_url('/player?contentId=') . $item->inum ?>">
                                            <?php
                                            if ($item->picture) {
                                                ?>
                                                <img
                                                    src="https://s3-ap-northeast-1.amazonaws.com/dongshin.images/playlist/<?php echo $item->filename . '/low_thumb'; ?><?php if (strpos($item->picture, 'high_thumb')) {
                                                        $rtv = explode('high_thumb', $item->picture)[1];
                                                        echo $rtv;
                                                    } else {
                                                        echo '.png';
                                                    } ?>"
                                                    alt="">
                                                <?php
                                            } else {
                                                ?>
                                                <img
                                                    src="https://s3-ap-northeast-1.amazonaws.com/dongshin.images/playlist/<?= $item->filename ?>/low_00001.png"
                                                    alt="">
                                                <?php

                                            }
                                            ?>
                                        </a>
                                    </div>

                                    <div class="video-des">
                                        <p class="video-des-title"><?php
                                            if( ceil( strlen($item->title ) / 3) > 10){
                                                echo str_split($item->title, 10*3)[0] . '...';
                                            }else{
                                                echo $item->title;
                                            }?></p>


                                        <p class="video-des-publisher">게시자: <?= $item->nickName ?></p>

                                        <p class="video-des-hits">조회수: <?= $item->view ?></p>
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