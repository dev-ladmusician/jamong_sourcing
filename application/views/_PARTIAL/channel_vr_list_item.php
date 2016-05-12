<?php foreach ($items as $item) {
        ?>
        <div class="video-small col-lg-3 col-md-3 col-sm-4 col-xs-6">
            <div class="solid-border-box">
                <a href="<?= site_url('/player?contentId=' . $item->inum) ?>">

                    <?php
                    if ($item->picture) {
                        ?>
                        <img
                            src="https://s3-ap-northeast-1.amazonaws.com/dongshin.images/playlist/<?php echo $item->filename . '/low_thumb'; ?><?php if (strpos($item->picture, 'high_thumb')) {
                                $rtv = explode('high_thumb', $item->picture)[1];
                                echo $rtv;
                            }?>"
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



                <div class="video-des">
                    <p class="video-des-title"><?= $item->title ?></p>
                    <p class="video-des-publisher">게시자: <?= $item->nickName ?></p>
                    <p class="video-des-hits">조회수 <?= $item->view ?></p>
                </div>
            </div>
        </div>
        <?php
} ?>