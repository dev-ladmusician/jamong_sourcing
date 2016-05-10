<div class="row">
    <section class="jm-find-password">
        <div class="container">

            <div class="form-container solid-border-box">

                <div class="header solid-border-bottom">
                    <a href="<?= site_url('/auth/login') ?>">로그인</a>
                    <a href="<?= site_url('/auth/register') ?>">회원가입</a>
                </div>
                <form id="jm-auth-find-password" action="post">
                    <div class="form-group">
                        비밀번호 찾기
                    </div>
                    <div class="form-group">
                        <input type="email" placeholder="이메일" class="solid-border-box" required>
                    </div>
                    <div class="form-group">
                        <input class="btn-login-submit" type="submit" value="비밀번호 재설정" href="">
                    </div>
                    <ul class="form-group">
                        <li>가입시 등록했던 이메일로 임시 비밀번호를 보내드립니다.</li>
                        <li>메일 발송 후 1시간 이내로 발송된 비밀번호로 로그인을 해야 변경됩니다.</li>
                    </ul>
                </form>
            </div>
        </div>
    </section>
</div>