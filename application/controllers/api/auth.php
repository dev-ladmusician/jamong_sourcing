<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CORE_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('form_validation');
    }
    function submit_find_id(){
        $nickName = $this->input->post('nickName');
        $rtv = $this->user_model->get_user_id_by_nickName($nickName);

        if(count($rtv)){
            $this->session->set_flashdata('message', '이메일을 찾았습니다.');
            redirect('auth/login?userId='.$rtv->userNumber);
        }else{
            $this->session->set_flashdata('message', '닉네임이 존재하지 않습니다.');
            redirect('auth/find_id');
        }

    }

    function submit_login()
    {
        $this->__is_logined();

        $this->form_validation->set_rules('jm-login-id', '이메일', 'required|valid_email');
        $this->form_validation->set_rules('jm-login-password', '비밀번호', 'required');

        $isValidate = $this->form_validation->run();

        $email = $this->input->post('jm-login-id');
        $password = $this->input->post('jm-login-password');

        if ($isValidate) {
            $input_data = array('email' => $email);

            $rtv = $this->user_model->get_user_by_email($input_data);

            // db 정보와 확인
            if ($rtv != null && count($rtv) > 0) {
                $user = $rtv[0];
                if ($user->email == $input_data['email'] && $this->keyEncrypt($password) == $user->password) {
                    if ($user->state == "active") {
                        $this->handle_login($user);
                    } else {
                        $this->session->set_flashdata('message', '이용정지된 사용자 입니다.');
                        redirect('auth/login');
                    }
                } else {
                    $this->session->set_flashdata('message', '로그인에 실패하였습니다.');
                    redirect('auth/login');
                }
            } else {
                $this->session->set_flashdata('message', '로그인에 실패하였습니다.');
                if ($this->input->get('returnURL') === "") {
                    $this->__get_views('_AUTH/login');
                }
            }
        } else {
            $this->session->set_flashdata('message', '이메일과 비밀번호를 입력해주세요.');
            redirect('auth/login');
//            $this->__get_views('_AUTH/login', array('returnURL' => $this->input->get('returnURL')));
        }
    }

    function handle_login($user)
    {
        $this->session->set_flashdata('message', '로그인에 성공하였습니다.');
        $userId = $this->session->set_userdata('userid', $user->userNumber);
        $this->session->set_userdata('is_login', true);
        $this->session->set_userdata('email', $user->email);
        $this->session->set_userdata('nickname', $user->nickName);
        $this->session->set_userdata('isadmin', $user->is_admin);
        $this->session->set_userdata('issuperadmin', $user->is_superadmin);

//        $profile_url = $this->user_model->get_profile_image_by_id($userId);
//        $this->session->set_userdata('profile_url', $profile_url->picture);

        $returnURL = $this->input->get('returnURL');

        if ($returnURL === false || $returnURL === "") {
            redirect('home/index');
        }
        redirect($returnURL);
    }

    function submit_register()
    {
        $nickName = $this->input->post('input-nickname');
        $email = $this->input->post('input-email');
        $age = $this->input->post('input-age');
        $gender = $this->input->post('input-gender');
        $password = $this->input->post('input-password');
        $password_confirm = $this->input->post('input-password-confirm');

        $rtv = $this->user_model->get_user_id_by_nickname($nickName);
        //nickName 중복?
        if (!count($rtv)) {
            $rtv = $this->user_model->get_user_id_by_email($email);
            //email 중복?
            if (!count($rtv)) {
                if (strlen($gender)) {
                    if (!strcmp($password, $password_confirm)) {
                        $input_data = array(
                            "nickName" => $nickName,
                            "email" => $email,
                            "age" => $age,
                            "gender" => $gender,
                            "password" => $this->keyEncrypt($password));

                        $rtv_1 = $this->user_model->add($input_data);
                        $rtv_2 = $this->user_model->add_nickname($rtv_1, $input_data);

                        if ($rtv_1 && $rtv_2) {
                            $this->session->set_flashdata('message', '회원등록에 성공 했습니다.');
                            redirect('/auth/login');
                        } else {
                            $this->session->set_flashdata('message', '회원등록에 실패 했습니다.');
                            redirect('/auth/register');
                        }

                    } else {
                        $this->session->set_flashdata('message', '비밀번호가 일치하지 않습니다.');
                        redirect('/auth/register');
                    }
                } else {
                    $this->session->set_flashdata('message', '성별을 표시해주세요');
                    redirect('/auth/register');
                }
            } else {
                $this->session->set_flashdata('message', '이미 존재하는 이메일 입니다');
                redirect('/auth/register');
            }

        } else {
            $this->session->set_flashdata('message', '이미 존재하는 닉네임 입니다');
            redirect('/auth/register');
        }
    }

    function send_mail()
    {
        $email = $this->input->post('jm-password-input');
        var_dump($email);
//        if(isset($email))
//        $user = $this->user_model->get_user_by_email($email);
//        var_dump($user);


//        $receiver = 'janghan3150@gmail.com';    // 받는 사람
//        $subject = " [[동신대학교]] 임시 비밀번호 입니다."; // 제목
//        $content = "<b>이름 : </b>" . $data['name'] . "<br>" .
//            "<b>연락처: </b>" . $data['contact'] . "<br>" .
//            "<b>이메일 : </b>" . $data['email'] . "<br>" .
//            "<b>문의분류 : </b>" . $data['category'] . "<br>" .
//            "<b>문의제목 : </b>" . $data['title'] . "<br>" .
//            "<b>문의내용 :</b>" . $data['content']. "<br>" ;
//
//        $headers = "From: " . strip_tags($data['email']) . "\r\n";
//        $headers .= "Reply-To: " . strip_tags($data['email']) . "\r\n";
//        $headers .= "MIME-Version: 1.0\r\n";
//        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
//
//        $success = mail($receiver, $subject, $content, $headers);
//
//        if ($success) {
//            echo '<meta http-equiv="content-type" content="text/html" charset="utf-8">';
//            echo '<script type="text/javascript" >';
//            echo 'alert("성공적으로 전송되었습니다");';
//            echo 'window.location = "http://itscodia.com/CODIA/home/inquiry";';
//            echo '</script>';
//        } else {
//            echo '<meta http-equiv="content-type" content="text/html" charset="utf-8">';
//            echo '<script type="text/javascript" >';
//            echo 'alert("전송에 실패하였습니다");';
//            echo 'window.history.back();';
//            echo '</script>';
//        }
    }

    /**
     * 로그인
     * email, password
     * 로그인 성공시 userNumber return
     * 로그인 실패시 -1 return
     */
    function login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->user_model->get_user_by_email(array('email' => $email));

        if ($user != null && $user->email == $email &&
            $this->keyEncrypt($password) == $user->password
        ) {
            echo json_encode($user->userNumber, JSON_PRETTY_PRINT);
        } else {
            echo json_encode(-1, JSON_PRETTY_PRINT);
        }
    }

    function join()
    {
        $email = $this->input->post('email');
        $nickname = $this->input->post('nickname');
        $password = $this->input->post('password');

        $user = $this->user_model->add(
            array(
                'email' => $email,
                'password' => $this->keyEncrypt($password),
                'nickname' => $nickname
            )
        );
    }
}
