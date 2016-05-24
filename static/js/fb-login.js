var appId = '1552807958354012';
var status = null;
// This is called with the results from from FB.getLoginStatus().
function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    status = response.status;
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
        // Logged into your app and Facebook.
        //testAPI();
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
    FB.init({
        appId      : appId,
        cookie     : true,  // enable cookies to allow the server to access
                            // the session
        xfbml      : true,  // parse social plugins on this page
        version    : 'v2.6' // use version 2.6
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

//// Load the SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Here we run a very simple test of the Graph API after login is
// successful.  See statusChangeCallback() for when this call is made.
function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
        console.log('Successful login for: ' + response.name);
        document.getElementById('status').innerHTML =
            'Thanks for logging in, ' + response.name + '!';
    });
}

$('.btn-fb-login').click(function () {
    FB.login(function (response) {
        console.log(response);
        if (response.authResponse) {
            fbLogin();
        }
    }, {scope: 'public_profile, email'});
});

function fbLogin() {
    var url = '/me?fields=name,email';
    FB.api(url, function (response) {
        console.log(response);
        ajax_template('/JAMONG/api/auth/login_by_fb', response,
            function (data) {
                console.log(data);
                if (data > 0) {
                    window.location.replace("/JAMONG/home/index");
                } else {
                    if (data == -1) {
                        alert('이용정지된 계정입니다.');
                        window.location.replace('/JAMONG/auth/login');
                    } else if (data == -2) {
                        alert('회원가입을 먼저 해주세요.');
                        window.location.replace('/JAMONG/auth/register');
                    } else {
                        window.location.replace('/JAMONG/auth/login');
                    }
                }
            },
            function (arg) {
                console.log(arg);
                alert('로그인하는데 오류가 발생했습니다.');
                window.location.replace('/JAMONG/auth/login');
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
        }
    });
}