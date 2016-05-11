<div class="row">
    <section class="jm-register">
        <div class="container">
            <div class="form-container solid-border-box">

                <div class="header solid-border-bottom">
                    <a href="<?= site_url('/auth/login') ?>">로그인</a>
                    <a href="<?= site_url('/auth/register') ?>">회원가입</a>
                </div>

                <form id="jm-auth-join" action="<?=site_url('api/auth/submit_register')?>"  method="post">
                    <div class="form-group">
                        JOIN
                    </div>
                    <div class="form-group">
                        <input name="input-nickname" type="text" placeholder="닉네임" class="solid-border-box" required>
                    </div>
                    <div class="form-group">
                        <input name="input-email" type="email" placeholder="이메일" class="solid-border-box" required>
                    </div>
                    <div class="form-group">
                        <input type="number" size="6" name="input-age" min="13" max="99" value="21" class="solid-border-box" required>
                    </div>
                    <div class="form-group radio-input-male">
                        <input id="male" type="radio" name="input-gender" value="Male">
                        <label for="male">남자</label>
                    </div>
                    <div class="form-group radio-input-female">
                        <input id="female" type="radio"  name="input-gender" value="Female">
                        <label for="female">여자</label>
                    </div>
                    <div class="form-group">
                        <input type="password" name="input-password" placeholder="비밀번호" class="solid-border-box" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="input-password-confirm" placeholder="비밀번호 확인" class="solid-border-box" required>
                    </div>
                    <div class="form-group">
                        <input name="input-agree" class="check-box" type="checkbox" required><span>이용약관과 개인정보취급방침을 모두 읽고, 동의합니다.</span>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn-login-submit" value="회원가입">
                    </div>
                    <div class="form-group btn-fb-join">
                        <a href="">페이스북으로 가입하기</a>
                    </div>
                </form>

            </div>
        </div>
    </section>
</div>