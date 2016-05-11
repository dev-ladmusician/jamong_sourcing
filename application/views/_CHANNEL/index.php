<div class="content-wrapper col-lg-9 col-md-9 col-sm-12">
    <section class="jm-channel-home">
        <div class="row solid-border-empty">
            <div class="channel-header solid-border-bottom col-lg-12">

                <?php if (!empty($channel)) { ?>
                    <input id="jm-channel-id" type="hidden" value="<?php if (isset($channel->channelnum)) {
                        echo $channel->channelnum;
                    } ?>">

                    <div class="col-lg-2 padding-none">
                        <img src="<?php if ($channel->ch_picture) {
                            echo $channel->ch_picture;
                        }else {
                            echo site_url('/static/img/default_thumbnail.jpg');
                        } ?>" alt="">
                    </div>
                    <div class="col-lg-10 video-des">
                        <div class="des-title">
                            <?php if (isset($channel->channelname)) {
                                echo $channel->channelname;
                            } ?>
                        </div>
                        <div class="des-content">
                            <?php if (isset($channel->chdesc)) {
                                echo $channel->chdesc;
                            } ?>
                        </div>
                        <div class="des-info">
                        <span>VR컨텐츠 <span class="value-content-count"><b><?php if (isset($channel->contents)) {
                                        echo $channel->contents;
                                    } ?></b></span></span>
                        <span>구독자 <span class="value-subs-count"><b><?php if (isset($channel->follow)) {
                                        echo $channel->follow;
                                    } ?></b></span></span>

                            <?php
                            if (isset($is_subscribed) && $is_subscribed) {
                                ?>
                                <a href="<?= site_url('api/channel/subscribe_update?channelId=' . $channel->channelnum . '&is_subscribed=false') ?>"
                                   class="btn-ch-ok"><i class="glyphicon glyphicon-ok"></i> 구독</a>
                                <?php
                            } else { ?>
                                <a href="<?= site_url('api/channel/subscribe_update?channelId=' . $channel->channelnum . '&is_subscribed=true') ?>"
                                   class="btn-ch-subs "><i class="glyphicon glyphicon-plus"></i> 구독하기</a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

            <div class="tab-links col-lg-12 solid-border-bottom">
                <a href="#channel-home" class="active tab">홈</a>
                <a href="#channel-vr" class="tab">VR컨텐츠</a>
                <a href="#channel-sub" class="tab">구독자</a>
            </div>

            <div class="tab-content col-lg-12">
                <!--                            home-->
                <div id="channel-home" class="col-lg-12 tab active">
                    <div class="main-video padding-none col-lg-12 solid-border-box">
                        <?php if (!empty($main_video)) {
                            ?>
                            <div class="padding-none video-large col-lg-8">
                                <a href="<?= site_url('/player?contentId=') . $main_video->inum ?>">
                                    <img
                                        src="https://s3-ap-northeast-1.amazonaws.com/dongshin.images/playlist/<?= $main_video->filename ?>/high_thumb.png"
                                        alt="">
                                </a>
                            </div>
                            <div class="padding-none video-des col-lg-4">
                                <div class="video-des-title">
                                    <?= $main_video->title ?>
                                </div>
                                <div class="video-des-content">
                                    <?= $main_video->talk ?>
                                </div>
                                <div class="video-des-bottom">
                                    <div class="channel-title"><?= $main_video->nickName ?></div>
                                    <div class="upload-date"><?= $main_video->datetime ?></div>
                                </div>
                            </div>
                            <?php
                        } ?>

                    </div>

                    <div class="list-hot col-lg-12 padding-none">
                        <section class="sc-main-hot">
                            <div class="list-header solid-border-bottom ">
                                <span>인기VR컨텐츠</span>
                                <a href="#"><span>more</span></a>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 padding-none">
                                <?php if (!empty($vr_list_hot)) {
                                    foreach ($vr_list_hot as $item) {
                                        ?>
                                        <div class="video-small col-lg-3 col-md-3 col-sm-4 col-xs-6 ">
                                            <div class="solid-border-box">
                                                <a href=" <?= site_url('/player?contentId=') . $item->inum ?>">
                                                    <img
                                                        src="https://s3-ap-northeast-1.amazonaws.com/dongshin.images/playlist/<?= $item->filename ?>/low_thumb.png"
                                                        alt="">
                                                </a>

                                                <div class="video-des">
                                                    <p class="video-des-title"><?= $item->title ?></p>

                                                    <p class="video-des-publisher">게시자:<?= $item->nickName ?></p>

                                                    <p class="video-des-hits">조회수<?= $item->hit ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                } ?>

                            </div>
                        </section>

                    </div>

                    <div class="list-new col-lg-12 padding-none">
                        <section class="sc-main-new">
                            <div class="list-header solid-border-bottom col-lg-12">
                                <span>신규VR컨텐츠</span>
                                <a href="#"><span>more</span></a>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 padding-none">
                                <?php
                                foreach ($vr_list_new as $item) {
                                    if ($item->cate > 0) {
                                        ?>
                                        <div class="video-small col-lg-3 col-md-3 col-sm-4 col-xs-6 ">
                                            <div class="solid-border-box">
                                                <a href="<?= site_url('/player?contentId=') . $item->inum ?>">
                                                    <img
                                                        src="https://s3-ap-northeast-1.amazonaws.com/dongshin.images/playlist/<?= $item->filename ?>/low_thumb.png" alt="">
                                                </a>

                                                <div class="video-des">
                                                    <p class="video-des-title">
                                                        <?= $item->title ?></p>

                                                    <p class="video-des-publisher">게시자:
                                                        <?= $item->nickName ?></p>

                                                    <p class="video-des-hits">조회수
                                                        <?= $item->hit ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>

                        </section>
                    </div>

                </div>
                <!-- HOME ****************************************************************************************-->

                <!--            vr-->

                <div id="channel-vr" class=" col-lg-12 tab">
                    <div class="padding-normal solid-border-bottom col-lg-12 text-right">
                        <select name="order" id="jm-channel-order">
                            <option value="recently">신규순</option>
                        </select>
                        <select name="view" id="jm-channel-view">
                            <option value="list">리스트형으로 보기</option>
                            <option value="card">카드형으로 보기</option>
                        </select>
                    </div>

                    <div class=" list-vr col-lg-12 col-md-12 col-sm-12 padding-outer">
                    </div>

                    <div class="jm-ajax-loader-container text-center">
                        <img class="jm-ajax-loader-vr" src="<?= site_url('/static/img/loader.gif') ?>"/>
                    </div>

                    <div class="load-more col-lg-12 col-md-12 col-sm-12 text-center">
                        <a href="#">더보기<i class="glyphicon glyphicon-menu-down"></i></a>
                    </div>

                </div>
                <!-- VR ****************************************************************************************-->

                <!--            sub-->

                <div id="channel-sub" class="col-lg-12 tab">

                    <div class=" list-sub">
                    </div>

                    <div class="jm-ajax-loader-container text-center">
                        <img class="jm-ajax-loader-sub" src="<?= site_url('/static/img/loader.gif') ?>"/>
                    </div>

                    <div class="load-more col-lg-12 col-md-12 col-sm-12 text-center">
                        <a href="#">더보기<i class="glyphicon glyphicon-menu-down"></i></a>
                    </div>
                </div>
                <!-- SUB ****************************************************************************************-->
            </div>

        </div>
    </section>
</div>