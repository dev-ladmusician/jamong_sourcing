<!--<div class="row">-->
<section class="jm-login">
    <div class="container-wrapper">

        <div class="form-container solid-border-box">

            <div class="header solid-border-bottom">
                <a href="<?= site_url('/auth/login') ?>">로그인</a>
                <a href="<?= site_url('/auth/register') ?>">회원가입</a>
            </div>
            <form id="jm-auth-login" action="<?= site_url('api/auth/submit_login') ?>" method="post">
                <div class="form-group">
                    LOGIN
                </div>
                <div class="form-group">
                    <?php
                    if(isset($email)){
                        ?>
                        <input name="jm-login-id" type="email" value="<?= $email?>" class="solid-border-box" required>
                        <?php
                    }else{?>

                        <input name="jm-login-id" type="email" placeholder="E-mail" class="solid-border-box" required>
                        <?php

                    }
                    ?>
                </div>
                <div class="form-group">
                    <input name="jm-login-password" type="password" placeholder="Password" class="solid-border-box"
                           required>
                </div>
                <div class="form-group">
                    <input class="btn-login-submit" type="submit" value="로그인">
                </div>
                <div class="form-group btn-fb-login">
                    <a id="login" href="">페이스북으로 로그인</a>
                </div>

            </form>
            <div class="login-footer text-center">
                <a href="<?= site_url('/auth/find_id') ?>" class="btn-login-wh solid-border-box">ID 찾기</a>
                <a href="<?= site_url('/auth/find_password') ?>" class="btn-login-wh solid-border-box">PW 찾기</a>
            </div>
        </div>
    </div>
</section>
<!--</div>-->