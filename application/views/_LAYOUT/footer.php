</div><!--row-->
</div> <!--container-->
</section> <!--sc-jamong : min-height-->

</div><!-- body container-->

<div class="footer-container">
    <section class="sc-footer">
        <div class="container">
            <div class="row">
                <div class="footer-text col-lg-12">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <a class="footer-logo">
                            <img src="<?= base_url('/static/img/dongsin_logo.png') ?>" alt="">
                        </a>
                        <select name="language" id="language">
                            <option value="kor">한국어</option>
                            <option value="eng">English</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12">
                        <a href="" class="btn-ft-white">최근 동영상</a>
                        <a href="" class="btn-ft-white">도움말</a>
                    </div>
                    <div class="col-lg-5 col-md-4 col-sm-12">
                        <iframe
                            src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fjamong360%2F%3Ffref%3Dts&width=450&layout=standard&action=like&show_faces=false&share=true&height=35&appId"
                            height="35" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                    </div>
                </div>

                <div class="footer-text col-lg-12">
                    <div class="col-lg-5 col-sm-12">
                        <p>정보<span>|</span>보도자료<span>|</span>저작권<span>|</span>제작자<span>|</span>광고<span>|</span>개발자</p>
                        <a href="#">이용약관</a>
                        <a href="#">개인정보 보호</a>
                        <a href="#">정책 및 안전</a>
                        <a href="#">의견 보내기(건의)</a>
                        <a href="#">새로운 기능</a>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        COPYRIGHT JAMONG INC. ALL RIGHTS RESERVED.
                    </div>
                    <div class="col-lg-3 col-sm-12">
                        <div class="float-right">
                            <span>Google play</span>
                            <img src="<?= base_url('/static/img/fb_logo.png') ?>" alt="FACEBOOK_LOGO">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div id="jm-user-setting" class="popup-container ">

    <div class="popup-login-container">
        <a class="close" href="#">&times;</a>

        <ul class="list-user-setting">
            <?php
            if ($this->session->userdata('is_login')) {
                ?>
                <a href="<?= site_url('/auth/logout') ?>">
                    <li class="solid-bozrder-bottom">
                        <img src="<?= base_url('/static/img/ic_log_in.png') ?>" alt="IC_PNG">
                        <span>로그아웃</span>
                    </li>
                </a>
                <?php
                if ( !strcmp($this->session->userdata('isadmin'),'1') || !strcmp($this->session->userdata('issuperadmin'),'1')) {
                    ?>
                    <a href="http://ec2-54-250-155-70.ap-northeast-1.compute.amazonaws.com/MGMT">
                        <li>
                            <img src="<?= base_url('/static/img/ic_join.png') ?>" alt="IC_PNG">
                            <span>관리자 페이지</span>
                        </li>
                    </a>
                    <?php
                }
                ?>
                <?php
            } else {
                ?>
                <a href="<?= site_url('/auth/login') ?>">
                    <li class="solid-bozrder-bottom">
                        <img src="<?= base_url('/static/img/ic_log_in.png') ?>" alt="IC_PNG">
                        <span>로그인</span>
                    </li>
                </a>
                <a href="<?= site_url('/auth/register') ?>">
                    <li>
                        <img src="<?= base_url('/static/img/ic_join.png') ?>" alt="IC_PNG">
                        <span>회원가입</span>
                    </li>
                </a>
                <?php
            }
            ?>

        </ul>
    </div>
</div>

<script src="<?php echo base_url() ?>static/js/krpano/krpano.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="/static/lib/bootstrap/js/bootstrap.min.js"></script>
<script src="/static/js/ajaxBody.js"></script>
<script src="/static/js/smoothscroll.js"></script>


<script src="<?php echo base_url() ?>static/js/common.js"></script>


<?php
$total_url = $_SERVER['PHP_SELF'];
$arr_splitted_url = explode('/', $total_url);

if ($arr_splitted_url[count($arr_splitted_url) - 1] === "") {
    unset($arr_splitted_url[count($arr_splitted_url) - 1]);
}

$ctrl_name = $arr_splitted_url[count($arr_splitted_url) - 2];
$view_name = $arr_splitted_url[count($arr_splitted_url) - 1];
$filename = "";

if ($ctrl_name == 'index.php') {
    $filename = 'static/js/' . strtolower($view_name) . '/index.js';
} else {
    $filename = 'static/js/' . strtolower($ctrl_name) . '/' . strtolower($view_name) . '.js';
}

if (file_exists($filename)) {
    ?>
    <script src="<?= site_url() ?><?php echo $filename; ?>"></script>
    <?php
}
if (strpos($filename, 'index.php')) {
    ?>
    <script src="<?= site_url() ?>/static/js/home/index.js"></script>
    <?php
} ?>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="/static/lib/bootstrap/js/ie10-viewport-bug-workaround.js">

    </
    body >
    < / html >