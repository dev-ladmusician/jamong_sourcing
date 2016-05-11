// This is called with the results from from FB.getLoginStatus().
function statusChangeCallback(response) {
    if (response.status === 'connected') {
        var url = window.location.href;
        if (url.indexOf("login") >= 0) {
            console.log('login');
        } else if (url.indexOf("join") >= 0) {
            console.log('join');
        }
    } else if (response.status === 'not_authorized') {
        // The person is logged into Facebook, but not your app.
        document.getElementById('status').innerHTML = 'Please log ' +
            'into this app.';
    } else {
        // The person is not logged into Facebook, so we're not sure if
        // they are logged into this app or not.
        document.getElementById('status').innerHTML = 'Please log ' +
            'into Facebook.';
    }
}

// This function is called when someone finishes with the Login
// Button.  See the onlogin handler attached to it in the sample
// code below.
function checkLoginState() {
    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });
}

window.fbAsyncInit = function() {
    var url = window.location.href;
    var appId = '1545041632465908';
    if (url.indexOf("www") >= 0) {
        //appId = '420184654847738';
    }
    FB.init({
        appId      : appId,
        cookie     : true,  // enable cookies to allow the server to access
                            // the session
        xfbml      : true,  // parse social plugins on this page
        version    : 'v2.2' // use version 2.2
    });

    // Now that we've initialized the JavaScript SDK, we call
    // FB.getLoginStatus().  This function gets the state of the
    // person visiting this page and can return one of three states to
    // the callback you provide.  They can be:
    //
    // 1. Logged into your app ('connected')
    // 2. Logged into Facebook, but not your app ('not_authorized')
    // 3. Not logged into Facebook and can't tell if they are logged into
    //    your app or not.
    //
    // These three cases are handled in the callback function.

    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });

};

// Load the SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Here we run a very simple test of the Graph API after login is
// successful.  See statusChangeCallback() for when this call is made.

$('.sg-auth-btn-join-fb').click(function () {
    FB.login(function(response) {
        console.log(response);
        if (response.authResponse) {
            fbJoin();
        }
    }, {scope: 'public_profile, email'});
});

$('.btn-fb-login').click(function () {
    FB.login(function(response) {
        console.log(response);
        if (response.authResponse) {
            fbLogin();
        } else {

        }
    }, {scope: 'public_profile, email'});
});


function fbJoin() {
    var url = '/me?fields=name,email';
    FB.api(url, function(response) {
        console.log(response);

        ajax_template('/GOODS/API/auth/add_user_by_fb', response,
            function (data) {
                if (data > 0) {
                    window.location.replace("/GOODS/home/index");
                } else {
                    if (data == -3) {
                        window.location.replace('/MGMT/home/index');
                    } else {
                        alert('페이스북으로 가입하는데 오류가 발생했습니다.');
                    }
                }
            },
            function (arg) {
                console.log(arg);
            });
    });
}

function fbLogin() {
    var url = '/me?fields=name,email';
    FB.api(url, function(response) {
        console.log(response);

        ajax_template('/GOODS/API/auth/login_by_fb', response,
            function (data) {
                console.log(data);
                if (data > 0) {
                    window.location.replace("/GOODS/home/index");
                } else {
                    if (data == -1) {
                        alert('아직 something goods 회원이 아니시군요. 회원가입을 해주세요.');
                    } else if (data == -2) {
                        alert('비밀번호가 올바르지 않습니다.')
                    } else if (data == -3) {
                        window.location.replace('/MGMT/home/index');
                    } else {
                        alert('페이스북으로 로그인하는데 오류가 발생했습니다.');
                    }
                }
            },
            function (arg) {
                console.log(arg);
            });
    });
}

function ajax_template(url, data, success, error, dataType) {
    $.ajax({
        'url': url,
        'type': "POST",
        'dataType': 'json',
        'data': data,
        'xhrFields': {
            withCredentials: true
        },
        'success': function (data) {
            success(data)
        },
        'error': function (arg) {
            if (error) {
                error(arg);
            } else {
                alert("error");
            }
        },
    });
}
