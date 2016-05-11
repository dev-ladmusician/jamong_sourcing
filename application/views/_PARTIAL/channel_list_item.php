<?php
foreach ($items as $item) {
    ?>
    <div class="video-small col-lg-6 col-md-6 col-sm-6 col-xs-12 padding-inner">
        <div class=" solid-border-box padding-normal col-lg-12 col-md-12 col-sm-12">
            <div class="col-lg-5 col-md-6 col-sm-12 padding-none">
                <a href="<?= site_url('/channel/home?channelId='.$item->channelnum)?>">
                    <img src= <?php if($item->ch_picture){
                        echo $item->ch_picture;
                    }else{
                        echo site_url('static/img/default_thumbnail.jpg');
                    } ?> alt="">
                </a>
            </div>

            <div class="video-des col-lg-7 col-md-6 col-sm-12">
                <div class="des-title">
                    <a href="<?= site_url('/channel/home?channelId='.$item->channelnum)?>"><?= $item->channelname ?></a>
                </div>
                <div class="des-content">
                    <?= $item->chdesc ?>
                </div>
                <div class="des-info">
                    <div>
                        <div>VR컨텐츠<span><?= $item->contents ?></span></div>
                        <div>구독자<span><?= $item->follow ?></span></div>
                    </div>

                    <?php if (isset($item->userNumber) && $item->userNumber != null) { ?>
                        <a href="<?= site_url('api/channels/subscribe_update?channelId=' . $item->channelnum . '&is_subscribed=false') ?>"
                           class="btn-ch-subs-cancel btn-ch-subs">
                            <i class="glyphicon glyphicon-remove"></i> 구독취소</a>
                    <?php } else { ?>
                        <a href="<?= site_url('api/channels/subscribe_update?channelId=' . $item->channelnum . '&is_subscribed=true') ?>"
                           class="btn-ch-subs btn-ch-subs-plus">
                            <i class="glyphicon glyphicon-plus"></i> 구독하기</a>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
