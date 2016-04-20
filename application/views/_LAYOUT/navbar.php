<section class="jm-main">
    <div class="container">
        <div class="row">


            <div class="main-sidebar col-lg-3 col-md-3 col-sm-12">
                <section class="sidebar-category solid-border-box">
                    <div class="solid-border-bottom menu-header">카테고리</div>
                    <ul class="sidebar-menu">
                        <a href="<?= site_url('/category?query=new')?>">
                            <li>신규 <span>New</span></li>
                        </a>
                        <a href="<?= site_url('/category?query=hot')?>">
                            <li>인기 <span>Hot</span></li>
                        </a>
                        <a href="<?= site_url('/category?query=show')?>">
                            <li>공연 <span>Show</span></li>
                        </a>
                        <a href="<?= site_url('/category?query=sports')?>">
                            <li>스포츠 <span>Sports</span></li>
                        </a>
                        <a href="<?= site_url('/category?query=travel')?>">
                            <li>여행 <span>Travel</span></li>
                        </a>
                        <a href="<?= site_url('/category?query=business')?>">
                            <li>기업 <span>Business</span></li>
                        </a>
                        <a href="<?= site_url('/category?query=entertainment')?>">
                            <li>엔터테인먼트 <span>Entertainment</span></li>
                        </a>
                        <a href="<?= site_url('/category?query=drama')?>">
                            <li>드라마 <span>Drama</span></li>
                        </a>
                        <a href="<?= site_url('/category?query=etc')?>">
                            <li>기타 <span>Etc</span></li>
                        </a>
                    </ul>
                </section>

                <section class="sidebar-channel solid-border-box ">
                    <div class="solid-border-bottom menu-header">채널 <span>Top 30</span></div>
                    <ul class="sidebar-menu solid-border-bottom">
                        <a href="#">
                            <li>jamong</li>
                        </a>
                        <a href="#">
                            <li>GOQUAL</li>
                        </a>
                        <a href="#">
                            <li>jamong</li>
                        </a>
                        <a href="#">
                            <li>GOQUAL</li>
                        </a>
                        <a href="#">
                            <li>jamong</li>
                        </a>
                        <a href="#">
                            <li>GOQUAL</li>
                        </a>
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
                            <li class="solid-border-bottom">
                                <img src="<?=base_url('/static/img/ic_contact.png')?>" alt="IC_PNG">
                                <span>Contact</span>
                            </li>
                        </a>
                    </ul>
                </section>
            </div>
