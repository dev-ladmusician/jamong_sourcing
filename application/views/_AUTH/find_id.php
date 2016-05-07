<div class="row">
    <section class="jm-login">
        <div class="container">

            <div class="form-container solid-border-box">

                <div class="header solid-border-bottom">
                    <a href="<?= site_url('/auth/login') ?>">로그인</a>
                    <a href="<?= site_url('/auth/register') ?>">회원가입</a>
                </div>
                <form id="jm-auth-find-id" action="post">
                    <div class="form-group">
                        이메일 찾기
                    </div>
                    <div class="form-group">
                        <input type="text" placeholder="닉네임" class="solid-border-box">
                    </div>
                    <div class="form-group">
                        <input class="btn-login-submit" type="submit" value="이메일 찾기">
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>