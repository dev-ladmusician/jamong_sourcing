<?php
foreach ($items as $item) {
    ?>
    <div class="video-small col-lg-3 col-md-3 col-sm-4 col-xs-6 padding-inner">
        <div class="solid-border-box">
            <a href="<?= site_url('player?contentId=' . $item->inum) ?>">
                <img
                    src="https://s3-ap-northeast-1.amazonaws.com/dongshin.images/playlist/<?= $item->filename ?>/low_thumb.png"
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