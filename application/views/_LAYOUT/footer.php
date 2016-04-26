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
                        <div class="float-right">
                            <a href="#" class="btn-ft-blue">
                                <img src="<?= base_url('/static/img/fb_logo_2.png') ?>" alt="FACEBOOK_LOGO">좋아요</a>
                            <a href="#" class="btn-ft-blue">공유하기</a>

                            <div class="text-ft-sns">12명이 좋아합니다. 친구들이 무엇을 좋아하는지<br>알아보려면 가입하기</div>
                        </div>
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

    <div class="popup-login-container solid-border-box">
        <a class="close" href="#">&times;</a>

        <ul class="list-user-setting">
            <a href="#login">
                <li class="solid-border-bottom padding-normal">
                    <img src="<?=base_url('/static/img/ic_log_in.png')?>" alt="IC_PNG">
                    <span>로그인</span>
                </li>
            </a>
            <a href="#join">
                <li class="padding-normal">
                    <img src="<?=base_url('/static/img/ic_join.png')?>" alt="IC_PNG">
                    <span>회원가입</span>
                </li>
            </a>
        </ul>
    </div>
</div>

<div id="login" class="popup-container ">

    <div class="popup-login-container solid-border-box">
        <a class="close" href="#">&times;</a>
        <div class="login-header solid-border-bottom text-center">
            <a href="#login">로그인</a>
            <a href="#join">회원가입</a>
        </div>
        <form id="jm-auth-login" action="post">
            <div class="form-group">
                LOGIN
            </div>
            <div class="form-group">
                <input type="text" placeholder="ID">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Password">
            </div>
            <div class="form-group btn-login-submit">
                <a href="" >로그인</a>
            </div>
            <div class="form-group btn-fb-login">
                <a href="" >페이스북으로 로그인</a>
            </div>
        </form>
        <div class="login-footer text-center">
            <a href="" class="btn-login-wh solid-border-box">ID 찾기</a>
            <a href="" class="btn-login-wh solid-border-box" >PW 찾기</a>
        </div>
    </div>
</div>

<div id="join" class="popup-container ">

    <div class="popup-login-container solid-border-box">
        <a class="close" href="#">&times;</a>
        <div class="login-header solid-border-bottom text-center">
            <a href="#login">로그인</a>
            <a href="#join">회원가입</a>
        </div>
        <form id="jm-auth-join" action="post">
            <div class="form-group">
                JOIN
            </div>
            <div class="form-group">
                <input type="text" placeholder="닉네임">
            </div>
            <div class="form-group">
                <input type="email" placeholder="이메일">
            </div>
            <div class="form-group">
                <input type="password" placeholder="비밀번호">
            </div>
            <div class="form-group">
                <input type="password" placeholder="비밀번호 확인">
            </div>
            <div class="form-group btn-login-submit">
                <a href="" >회원가입</a>
            </div>
            <div class="form-group btn-fb-login">
                <a href="" >페이스북으로 로그인</a>
            </div>
            <div class="form-group">
                <input class="check-box" type="checkbox"><span>이용약관과 개인정보취급방침을 모두 읽고, 동의합니다.</span>
            </div>
        </form>
    </div>
</div>
<div id="fade" class="popup-bg"></div>

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