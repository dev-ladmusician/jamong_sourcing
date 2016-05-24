<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require('/var/www/html/JAMONG/static/aws/aws-autoloader.php');

use Aws\Ses\SesClient;

class Auth extends CORE_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('form_validation');
    }

    function submit_find_id()
    {

        $nickName = $this->input->post('nickName');
        $rtv = $this->user_model->get_user_id_by_nickName($nickName);

        if ($rtv != null && count($rtv) > 0) {
            $this->session->set_flashdata('message', "이메일을 찾았습니다. 로그인 화면으로 이동합니다.");
            redirect('auth/login?userId=' . $rtv->userNumber);
        } else {
            $this->session->set_flashdata('message', '존재하지 않는 닉네임입니다.');
            redirect('auth/find_id');
        }
    }

    function send_mail($email, $password)
    {
        //        error_reporting(E_ALL);
//        ini_set("display_errors", 1);

        $client = SesClient::factory([
            'version' => 'latest',
            'region' => 'us-east-1',
            'credentials' => [
                'key' => 'AKIAJO2KWDCBJ342FTMQ',
                'secret' => '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'
            ]
        ]);

        $body_str = '<p>아이디 : ' . $email . ' </p>';
        $body_str .= '<p>임시비밀번호 : ' . $password . ' </p>';
        $body_str .= '<a href="http://ec2-54-250-155-70.ap-northeast-1.compute.amazonaws.com/JAMONG/auth/login"> 로그인으로 이동하기</a>';
        $result = $client->sendEmail(array(
            'Source' => 'janghan3150@gmail.com',
            'Destination' => array(
                'ToAddresses' => array($email)
            ),
            'Message' => array(
                'Subject' => array('Data' => '[동신대학교] 임시 비밀 번호 입니다.', 'charset' => 'UTF-8'),
                'Body' => array('Html' => array('Data' => $body_str, 'charset' => 'UTF-8'))
            )
        ));

        if(count($result) && $result != null){
            return true;
        }else{
            return false;
        }
    }

    function submit_find_password()
    {
        $data = array(
            'email' => $_POST['email'],
        );
        $rtv = $this->user_model->get_user_by_email($data);

        if ($rtv[0] != null && count($rtv)) {

            $random_password = random_string('alnum',10);
            $this->user_model->update_password($rtv[0]->userNumber, $this->keyEncrypt($random_password));
            $success = $this->send_mail($_POST['email'], $random_password);

            if ($success) {
                $this->session->set_flashdata('message', '성공적으로 전송되었습니다.');
                redirect('auth/login');
            } else {
                $this->session->set_flashdata('message', '메일 전송에 실패하였습니다.');
                redirect('auth/find_password');
            }
        } else {
            $this->session->set_flashdata('message', '존재하지 않는 이메일 입니다.');
            redirect('auth/find_password');
        }
    }

    /**
     * 페이스북 로그인
     */
    function login_by_fb()
    {
        $data = array(
            'email' => $_POST['email'],
            'name' => $_POST['name'],
            'id' => $_POST['id'],
        );
        $user = $this->user_model->get_user_by_email($data);

        // db 정보와 확인
        if ($user != null && count($user) > 0) {
            $user = $user[0];
            if ($user->state == "active") {
                $this->session->set_userdata('userid', $user->userNumber);
                $this->session->set_userdata('is_login', true);
                $this->session->set_userdata('email', $user->email);
                $this->session->set_userdata('nickname', $user->nickName);
                $this->session->set_userdata('isadmin', $user->is_admin);
                $this->session->set_userdata('issuperadmin', $user->is_superadmin);

                echo json_encode(1, JSON_PRETTY_PRINT);
            } else {
                echo json_encode(-1, JSON_PRETTY_PRINT);
            }
        } else {
            echo json_encode(-2, JSON_PRETTY_PRINT);
        }
    }

    /**
     * 페이스북 가입
     */
    function join_by_fb()
    {
        $data = array(
            'email' => $_POST['email'],
            'name' => $_POST['name'],
            'id' => $_POST['id'],
        );
        $users = $this->user_model->get_user_by_email($data);

        // db 정보와 확인
        if ($users != null && count($users) > 0) {
            $user = $users[0];
            if ($user->state == "active") {
                $this->session->set_userdata('userid', $user->userNumber);
                $this->session->set_userdata('is_login', true);
                $this->session->set_userdata('email', $user->email);
                $this->session->set_userdata('nickname', $user->nickName);
                $this->session->set_userdata('isadmin', $user->is_admin);
                $this->session->set_userdata('issuperadmin', $user->is_superadmin);

                echo json_encode(1, JSON_PRETTY_PRINT);
            } else {
                echo json_encode(-1, JSON_PRETTY_PRINT);
            }
        } else {
            $input_data = array(
                "nickName" => explode('@', $data['email'])[0],
                "email" => $data['email'],
                "age" => -1,
                "gender" => -1,
                'fb' => 1,
                'fb_id' => $data['id'],
                "password" => $this->keyEncrypt($data['id']));

            $rtv_1 = $this->user_model->add_by_fb($input_data);
            $rtv_2 = $this->user_model->add_nickname($rtv_1, $input_data);

            if ($rtv_1 && $rtv_2) {
                $users = $this->user_model->get_user_by_email($data);
                $user = $users[0];
                $this->session->set_userdata('userid', $user->userNumber);
                $this->session->set_userdata('is_login', true);
                $this->session->set_userdata('email', $user->email);
                $this->session->set_userdata('nickname', $user->nickName);
                $this->session->set_userdata('isadmin', $user->is_admin);
                $this->session->set_userdata('issuperadmin', $user->is_superadmin);

                echo json_encode(1, JSON_PRETTY_PRINT);
            } else {
                echo json_encode(-2, JSON_PRETTY_PRINT);
            }
        }
    }

    function test()
    {
        $rtv = $this->user_model->get_user_by_email(array('email' => $this->input->get('email')));
        $user = $rtv[0];

        $block_date = $user->blockdate;
        $end_block_date = date("Y-m-d", strtotime("-" . $user->blockday . " day", time()));
        var_dump($block_date < $end_block_date);
        var_dump($block_date > $end_block_date);
        //var_dump($user);
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
                        $this->handle_block_user($user);
                    }
                } else {
                    $this->session->set_flashdata('message', '로그인에 실패하였습니다.');
                    redirect('auth/login');
                }
            } else {
                $this->session->set_flashdata('message', '해당 유저가 없습니다.');
                redirect('auth/register');
            }
        } else {
            $this->session->set_flashdata('message', '이메일과 비밀번호를 입력해주세요.');
            redirect('auth/login');
//            $this->__get_views('_AUTH/login', array('returnURL' => $this->input->get('returnURL')));
        }
    }

    function handle_block_user($user)
    {
        $block_date = $user->blockdate;
        $end_block_date = date("Y-m-d", strtotime("-" . $user->blockday . " day", time()));

        if ($end_block_date > $block_date) {
            $rtv = $this->user_model->change_state_block_to_active($user->userNumber);
            if ($rtv > 0) {
                $this->handle_login($user);
            } else {
                $this->session->set_flashdata('message', '로그인하는데 오류가 발생했습니다.');
                redirect('auth/login');
            }
        } else {
            $this->session->set_flashdata('message', '이용정지된 사용자 입니다.');
            redirect('auth/login');
        }
    }

    function handle_login($user)
    {
        $this->session->set_flashdata('message', '로그인에 성공하였습니다.');
        $this->session->set_userdata('userid', $user->userNumber);
        $this->session->set_userdata('is_login', true);
        $this->session->set_userdata('email', $user->email);
        $this->session->set_userdata('nickname', $user->nickName);
        $this->session->set_userdata('isadmin', $user->is_admin);
        $this->session->set_userdata('issuperadmin', $user->is_superadmin);

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
}
