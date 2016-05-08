<?php
foreach ($items as $item) {
    ?>
    <div class="subscriber-item col-lg-4">
        <div class="item-img">
            <?php if ($item->picture == null) { ?>
                <img class="user" src="<?= site_url('/static/img/user.png') ?>" alt="">
                <?php
            } else { ?>
                <img class="user" src="<?= $item->picture ?>" alt="">
                <?php
            } ?>
        </div>
        <div class="item-info">
            <div><?= $item->nickName?></div>
            <div>구독 채널 수
                <div>100</div>
            </div>
        </div>
    </div>
    <?php
}
?>
