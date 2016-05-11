<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CORE_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('form_validation');
    }

    function login_by_fb() {
        $data = array(
            'email' => $_POST['email'],
            'name' => $_POST['name'],
            'id' => $_POST['id'],
        );

        $user = $this->user_model->get_user_by_email($data['email']);

        // db 정보와 확인
        if ($user != null && count($user) > 0) {
            $user = $user[0];
            if ($user->email == $data['email']) {
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
    }

    function join_by_fb()
    {
        $data = array(
            'email' => $_POST['email'],
            'name' => $_POST['name'],
            'id' => $_POST['id'],
        );

        $user = $this->user_model->get_user_by_email($data['email']);

        if (count($user) > 0) {
            $this->user_model->logined($user);

            $this->session->set_userdata('userid', $user->_userid);
            $this->session->set_userdata('email', $user->email);
            $this->session->set_userdata('username', $user->username);
            $this->session->set_userdata('is_login', TRUE);

            if ($user->is_admin == 1) {
                // if admin, return -3
                echo json_encode(-3, JSON_PRETTY_PRINT);
            } else {
                echo json_encode(999, JSON_PRETTY_PRINT);
            }
        } else {
            $rtv = $this->user_model->add_user_by_fb($data);

            if ($rtv > 0) {
                $this->session->set_userdata('userid', $rtv);
                $this->session->set_userdata('email', $data['email']);
                $this->session->set_userdata('username', $data['name']);
                $this->session->set_userdata('is_login', TRUE);
            }

            echo json_encode($rtv, JSON_PRETTY_PRINT);
        }
    }

    function submit_login() {
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
//                        if ($user->is_admin || $user->is_superadmin) {
                        $this->handle_login($user);
//                        } else {
//                            $this->session->set_flashdata('message', '관리자만 접근할 수 있습니다.');
//                            redirect('auth/login');
//                        }
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
        $agree = $this->input->post('input-agree');

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
                        $rtv_2 = $this->user_model->add_nickname($rtv, $input_data);

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
}
