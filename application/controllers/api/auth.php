<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CORE_Controller {

    function __construct () {
        parent::__construct();
        $this->load->model('user_model');
    }

    function register(){
        $nickName = $this->input->post('input-nickname');
        $email = $this->input->post('input-email');
        $age = $this->input->post('input-age');
        $gender = $this->input->post('input-gender');
        $password = $this->input->post('input-password');
        $password_confirm = $this->input->post('input-password-confirm');
        $agree = $this->input->post('input-agree');

        if(strlen($nickName)){
            if($gender){
                if(strlen($password)){
                    if( strcmp($password,$password_confirm) == 0 ){
                        if($agree){
                            $input_data = array("nickName" => $nickName,
                                "email" => $email,
                                "age" => $age,
                                "gender" => $gender,
                                "password" => $password);

                            $rtv = $this->user_model->add($input_data);
                            if($rtv){
                                $this->session->set_flashdata('message', '회원등록에 성공 했습니다.');
                                redirect('/auth/login');
                            }else{
                                $this->session->set_flashdata('message', '회원등록에 실패 했습니다.');
                                redirect('/auth/register');
                            }
                        }else{
                            $this->session->set_flashdata('message', '이용약관과 개인정보취급방침에 동의해주세요.');
                            redirect('/auth/register');
                        }
                    }else{
                        $this->session->set_flashdata('message', '비밀번호와 비밀번호 확인이 일치하지 않습니다.');
                        redirect('/auth/register');
                    }
                }else{
                    $this->session->set_flashdata('message', '비밀번호 길이가 너무 짧습니다.');
                    redirect('/auth/register');
                }
            }else{
                $this->session->set_flashdata('message', '성별을 선택해 주세요.');
                redirect('/auth/register');
            }
        }else{
            $this->session->set_flashdata('message', '닉네임 길이가 너무 짧습니다.');
            redirect('/auth/register');
        }
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
            $this->keyEncrypt($password) == $user->password) {
            echo json_encode($user->userNumber, JSON_PRETTY_PRINT);
        } else {
            echo json_encode(-1, JSON_PRETTY_PRINT);
        }
    }

    function join() {
        $email = $this->input->post('email');
        $nickname = $this->input->post('nickname');
        $password = $this->input->post('password');

        $user = $this->user_model->add(
            array (
                'email' => $email,
                'password' => $this->keyEncrypt($password),
                'nickname' => $nickname
            )
        );
    }
}
