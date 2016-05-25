<input type="hidden" id="jamong-content-id" value="<?php echo $contentId; ?>"/>
<input type="hidden" id="jamong-content-file-name" value="<?php echo $content_info->filename; ?>"/>
<div class="content-wrapper col-lg-9 col-md-9 col-sm-12">
    <div class="row">
        <div class=" col-lg-9 col-md-8 padding-none">
            <section class="jm-player">
                <div class="jm-player-video solid-border-box col-lg-12 padding-none">
                    <div id="pano"></div>
                    <div class="solid-border-bottom video-des">
                        <p class="video-des-title"><?= $content_info->title ?></p>

                        <div class="video-des-info">
                            <div class="video-des-publisher">게시자 : <span><?= $content_info->nickName ?></span></div>
                            <div class="video-des-date"><span>게시일 :</span></div>
                            <input type="hidden" id="player-handle-date" value="<?= $content_info->created ?>">

                            <div class="video-des-hits">조회수 <span><?= $content_info->view ?></span>회</div>
                        </div>
                    </div>
                    <div class="video-action">
                        <?php
                        if ($is_liked) {
                            ?>
                            <a href="<?= site_url('api/player/like_update?contentId=' . $contentId . '&is_liked=false') ?>"
                            ><i class="glyphicon glyphicon-heart ic-heart"></i><span><?= $content_info->likes ?></span></a>
                            <?php
                        } else { ?>
                            <a href="<?= site_url('api/player/like_update?contentId=' . $contentId . '&is_liked=true') ?>">
                                <i class="glyphicon glyphicon-heart-empty ic-heart"></i>
                                <span><?= $content_info->likes ?></span>
                            </a>
                            <?php
                        }
                        ?>
                        <button type="button" data-toggle="modal" data-target="#myModal">
                            <i class="glyphicon glyphicon-share-alt ic-share"></i>공유
                        </button>
                        <!-- Trigger the modal with a button -->
                        <!--                        <button type="button" class="btn btn-info btn-lg" ">Open Modal</button>-->
                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">페이지 공유하기</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>미리 보기</p>

                                        <div>
                                            <a class="embedly-card"
                                               href="http://ec2-54-250-155-70.ap-northeast-1.compute.amazonaws.com/JAMONG/player?contentId=<?= $contentId ?>">동신대학교</a>
                                            <script async src="//cdn.embedly.com/widgets/platform.js"
                                                    charset="UTF-8"></script>
                                        </div>
                                        <p>Embed Code : 다음 코드를 복사해서 공유하고 싶은 페이지에 붙여넣기 해주세요.</p>
                                        <textarea cols="60" rows="3"><a class="embedly-card"
                                                                        href="http://ec2-54-250-155-70.ap-northeast-1.compute.amazonaws.com/JAMONG/player?contentId=<?= $contentId ?>">동신대학교</a><script
                                                async src="//cdn.embedly.com/widgets/platform.js"
                                                charset="UTF-8"></script>
                                        </textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="jm-player-comment solid-border-box col-lg-12">
                    <div class="header solid-border-bottom">
                        댓글 <span class="jamong-comment-total">0</span>
                    </div>
                    <!-- 댓글 입력 -->
                    <form id="jm-form-comment" class="solid-border-bottom "
                          method="post" action="<?= site_url('/api/player/submit_comment?contentId=' . $contentId) ?>">
                        <input type="hidden" name="user-id" value="<?php echo $this->session->userdata('userid'); ?>"/>

                        <div class="comment-img">
                            <?php if ($this->session->userdata('profile_url') != false) { ?>
                                <img class="jamong-user-profile" src="<?= $this->session->userdata('profile_url') ?>"
                                     alt="">
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
                        <div class="jm-ajax-loader-container text-center">
                            <img class="jm-ajax-loader" src="<?= site_url('/static/img/loader.gif') ?>"/>
                        </div>
                        <ul class="comment-list">
                        </ul>
                    </div>
                </div>
                <div class="load-more col-lg-12 col-md-12 col-sm-12 text-center">
                    <a href="javascript:void(0);">더보기<i class="glyphicon glyphicon-menu-down"></i></a>
                </div>
            </section>
        </div>

        <div class="col-lg-3 col-md-4 padding-none">
            <div class="jm-player-channel solid-border-box col-lg-12">
                <div class="image-container">
                    <a href="<?= site_url('/channel/home?channelId=' . $channel_info->channelnum) ?>">
                        <img src="<?php if ($channel_info->ch_picture) {
                            echo $channel_info->ch_picture;
                        } else {
                            echo site_url('static/img/default_thumbnail.jpg');
                        } ?>" alt="">
                    </a>
                </div>


                <div class="des-group">
                    <div class="des-title">
                        <?= $channel_info->channelname ?>
                    </div>

                    <div class="des-info">
                        구독자 <span><?= $channel_info->follow ?></span>
                    </div>
                    <?php
                    if ($is_subscribed) {
                        ?>
                        <a href="<?= site_url('api/player/subscribe_update?contentId=' . $contentId . '&channelId=' . $channel_info->channelnum . '&is_subscribed=false') ?>"
                           class="btn-ch-subs-cancel btn-ch-subs"><i class="glyphicon glyphicon-remove"></i> 구독취소</a>
                        <?php
                    } else { ?>
                        <a href="<?= site_url('api/player/subscribe_update?contentId=' . $contentId . '&channelId=' . $channel_info->channelnum . '&is_subscribed=true') ?>"
                           class="btn-ch-subs btn-ch-subs-plus "><i class="glyphicon glyphicon-plus"></i> 구독하기</a>
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
                    <?php
                    foreach ($recommend as $item) {
                        ?>
                        <div class="video-small">
                            <div class="image-container">
                                <a href="<?= site_url('/player?contentId=' . $item->inum) ?>">
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

                            <div class="video-des padding-none">
                                <p class="video-des-title"><?= $item->title ?></p>

                                <p class="video-des-publisher"><?= $item->nickName ?></p>

                                <p class="video-des-hits">조회수: <?= $item->view ?></p>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>

        </div>


    </div>
</div>


</div>
