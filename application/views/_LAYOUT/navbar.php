<section class="jm-main">
    <div class="container">
        <div class="row">

            <div class="main-sidebar col-lg-3 col-md-3 col-sm-12">
                <section class="sidebar-category solid-border-box">
                    <div class="solid-border-bottom menu-header">카테고리</div>
                    <ul class="sidebar-menu">
                        <?php
                        foreach( $categories as $item){?>
                            <a href="<?= site_url('/category?id='.$item->catenum)?>">
                                <li><?= $item->name_kr?> <span> <?= $item->name_en?></span></li>
                            </a>
                            <?php
                        }
                        ?>
                    </ul>
                </section>

                <section class="sidebar-channel solid-border-box ">
                    <div class="solid-border-bottom menu-header">채널 <span>Top 30</span></div>
                    <ul class="sidebar-menu solid-border-bottom">
                        <?php
                        foreach($channels as $channel){?>
                            <a href="<?=site_url('/channel/home?channelId='.$channel->channelnum)?>">
                                <li><img src="<?= $channel->ch_picture ?>" alt="">
                                <span><?= $channel->channelname?></span></li>
                            </a>
                        <?php
                        }?>
                    </ul>
                    <div><a href="<?= site_url('/channels')?>">더보기 ></a></div>
                </section>

                <section class="sidebar-service solid-border-box">
                    <ul class="sidebar-menu">
                        <a href="#">
                            <li class="solid-border-bottom">
                                <img src="<?=base_url('/static/img/ic_event.png')?>" alt="IC_PNG">
                                <span>이벤트</span>
                            </li>
                        </a>
                        <a href="#">
                            <li class="solid-border-bottom">
                                <img src="<?=base_url('/static/img/ic_cs_service.png')?>" alt="IC_PNG">
                                <span>고객센터</span>
                            </li>
                        </a>
                        <a href="<?= site_url('/home/contact'); ?>">
                            <li>
                                <img src="<?=base_url('/static/img/ic_contact.png')?>" alt="IC_PNG">
                                <span>Contact</span>
                            </li>
                        </a>
                    </ul>
                </section>
            </div>
