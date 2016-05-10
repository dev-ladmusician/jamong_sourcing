<div class="content-wrapper col-lg-9 col-md-9 col-sm-12">
    <div class="row">
        <div class=" col-lg-9 col-md-8 padding-none">
            <section class="jm-player">
                <div class="jm-player-video solid-border-box col-lg-12 padding-none">
                    <div id="pano"></div>
                    <div class="solid-border-bottom video-des">
                        <p class="video-des-title"><?= $content_info->title?></p>

                        <div class="video-des-info">
                            <div class="video-des-publisher">게시자 : <span><?= $content_info->nickName?></span></div>
                            <div class="video-des-date">게시일 : <span><?= $content_info->datetime?></span></div>
                            <div class="video-des-hits">조회수 <span><?= $content_info->hit?></span>회</div>
                        </div>

                    </div>

                    <div class="video-action">
                        <?php
                        if ($is_liked) {
                            ?>
                            <a href="<?= site_url('api/player/like_update?contentId=' . $contentId . '&is_liked=false') ?>"
                               class="btn-ch-subs"><i class="glyphicon glyphicon-heart ic-heart"></i><span><?= $content_info->likes?></span></a>
                            <?php
                        } else { ?>
                            <a href="<?= site_url('api/player/like_update?contentId=' . $contentId. '&is_liked=true') ?>"
                               class="btn-ch-subs"><i class="glyphicon glyphicon-heart-empty ic-heart"></i><span><?= $content_info->likes?></span></a>
                            <?php
                        }
                        ?>
                        <a href="#"><i class="glyphicon glyphicon-share-alt ic-share"></i>공유</a>
                    </div>
                </div>

                <div class="jm-player-comment solid-border-box col-lg-12">
                    <div class="header solid-border-bottom">
                        댓글 <span>70</span>
                    </div>
                    <!-- 댓글 입력 -->
                    <form id="jm-form-comment" class="solid-border-bottom ">
                        <div class="comment-img">
                            <?php if ($this->session->userdata('profile_url') != false) { ?>
                                <img class="jamong-user-profile" src="<?= $this->session->userdata('profile_url') ?>" alt="">
                            <?php } else { ?>
                                <img class="jamong-user-profile" src="<?= site_url('/static/img/user.png') ?>" alt="">
                            <?php } ?>
                        </div>
                        <div class="comment-content">
                            <textarea placeholder="댓글을 입력하세요" name="user-comment" id="jm-comment"></textarea>
                        </div>
                        <div class="btn-cm-submit comment-submit">
                            <a href="#" class="">등록</a>
                        </div>
                    </form>

                    <!-- 댓글 -->
                    <div class="comment-list-container">
                        <ul class="comment-list">
                            <li class="comment-group">
                                <div class="comment-item-img">
                                    <img src="<?= site_url('/static/img/user.png') ?>" alt="">
                                </div>
                                <div class="comment-item-contents">
                                    <div class="comment-item-name">
                                        <span>Jamong</span>
                                        <span>신고</span>
                                    </div>
                                    <div class="comment-item-content">
                                        테스트입니다. 테스트입니다. 테스트입니다. 테스트입니다. 테스트입니다. 테스트입니다. 테스트입니다. 테스트입니다. 테스트입니다.
                                        테스트입니다. 테스트입니다. 테스트입니다. 테스트입니다. 테스트입니다. 테스트입니다. 테스트입니다. 테스트입니다. 테스트입니다. 테스트입니다.
                                        테스트입니다.
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="load-more col-lg-12 col-md-12 col-sm-12 text-center">
                    <a href="#">더보기<i class="glyphicon glyphicon-menu-down"></i></a>
                </div>

            </section>
        </div>

        <div class="col-lg-3 col-md-4 padding-none">
            <div class="jm-player-channel solid-border-box col-lg-12">
                <div class="image-container">
                    <a href="<?= site_url('/channel/home?channelId='.$channel_info->channelnum)?>">
                        <img src="<?= $channel_info->ch_picture ?>" alt="">
                    </a>
                </div>


                <div class="des-group">
                    <div class="des-title">
                        <?= $channel_info->channelname?>
                    </div>

                    <div class="des-info">
                        구독자 <span><?= $channel_info->follow?></span>
                    </div>
                    <?php
                    if ($is_subscribed) {
                        ?>
                        <a href="<?= site_url('api/player/subscribe_update?contentId='.$contentId.'&channelId='.$channel_info->channelnum.'&is_subscribed=false')?>" class="btn-ch-ok"><i class="glyphicon glyphicon-ok"></i> 구독</a>
                        <?php
                    } else { ?>
                        <a href="<?= site_url('api/player/subscribe_update?contentId='.$contentId.'&channelId='.$channel_info->channelnum. '&is_subscribed=true')?>" class="btn-ch-subs "><i class="glyphicon glyphicon-plus"></i> 구독하기</a>
                        <?php
                    }
                    ?>
<!--                    <a href="" class="btn-ch-subs"><i class="glyphicon glyphicon-plus"></i>구독하기</a>-->

                </div>
            </div>

            <div class="jm-player-recommend solid-border-box col-lg-12 padding-none">
                <div class="header solid-border-bottom">
                    추천 VR컨텐츠
                </div>
                <div class="recommend-list">
                    <div class="video-small">
                        <img src="/JAMONG/static/img/ex_6.png" alt="">

                        <div class="video-des padding-none">
                            <p class="video-des-title">테스트</p>

                            <p class="video-des-publisher">게시자: 고퀄</p>

                            <p class="video-des-hits">조회수</p>
                        </div>
                    </div>
                    <div class="video-small">
                        <img src="/JAMONG/static/img/ex_6.png" alt="">

                        <div class="video-des padding-none">
                            <p class="video-des-title">테스트</p>

                            <p class="video-des-publisher">게시자: 고퀄</p>

                            <p class="video-des-hits">조회수</p>
                        </div>
                    </div>
                    <div class="video-small">
                        <img src="/JAMONG/static/img/ex_6.png" alt="">

                        <div class="video-des padding-none">
                            <p class="video-des-title">테스트</p>

                            <p class="video-des-publisher">게시자: 고퀄</p>

                            <p class="video-des-hits">조회수</p>
                        </div>
                    </div>
                    <div class="video-small">
                        <img src="/JAMONG/static/img/ex_6.png" alt="">

                        <div class="video-des padding-none">
                            <p class="video-des-title">테스트</p>

                            <p class="video-des-publisher">게시자: 고퀄</p>

                            <p class="video-des-hits">조회수</p>
                        </div>
                    </div>

                </div>

            </div>


        </div>
    </div>


</div>
