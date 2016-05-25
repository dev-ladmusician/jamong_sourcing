<?php

class CORE_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        if (!$this->input->is_cli_request())
            $this->load->library('session');

        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
    }

    function __get_views($viewStr, $nav = null, $data = null)
    {

        if (strpos($viewStr, 'AUTH')) {
            $this->load->view('_AUTH/header.php');

            if ($data != null) {
                $this->load->view($viewStr, $data);
            } else {
                $this->load->view($viewStr);
            }

            $this->load->view('_AUTH/footer.php');
        } else {
            $this->load->view('_LAYOUT/header.php');

            $this->load->view('_LAYOUT/navbar.php', $nav);

            if ($data != null) {
                $this->load->view($viewStr, $data);
            } else {
                $this->load->view($viewStr);
            }

            $this->load->view('_LAYOUT/footer.php');
        }
    }

    //ajax
    function __get_partial_view($viewStr, $data = null, $is_value = false)
    {
        if ($data != null) {
            $this->load->view($viewStr, $data, $is_value);
        } else {
            $this->load->view($viewStr);
        }
    }

    function __require_login($return_url = "")
    {
        // 로그인이 되어 있지 않다면 로그인 페이지로 리다이렉션
        if (!$this->session->userdata('is_login')) {
            if ($return_url == "") {
                redirect('/auth/login');
            }
            redirect('/auth/login?returnURL=' . rawurlencode($return_url));
        }
    }

    function __require_admin_login($return_url = "")
    {
        // 로그인이 되어 있지 않다면 로그인 페이지로 리다이렉션
        $this->load->model('user_model');
        $user_id = $this->session->userdata('userid');

        $rtv = $this->user_model->get_user_by_id($user_id);

        if (count($rtv) > 0) {
            $user = $rtv[0];
            if ($user->is_superadmin) {
                //redirect('/Home/index');
            } else {
                $this->session->set_flashdata('message', '권한이 없습니다. 관리자에게 문의하세요.');
                //$this->session->sess_destroy();
                redirect('/auth/login');
            }
        } else {
            $this->session->sess_destroy();
            redirect('/auth/login');
        }
    }

    function __is_logined($return_url = "")
    {
        // 로그인이 되어 있지 않다면 로그인 페이지로 리다이렉션
        if ($this->session->userdata('is_login')) {
            if ($return_url == "") {
                redirect('/home/index');
            }
            redirect($return_url);
        }
    }

    /* handler */
    function handle_date($date)
    {
        // 00/00/2015 -> 2015-00-00
        $arr_date = explode('+', $date);
        $output = explode('-', $arr_date[0]);
//        return '20' . $output[0] . '년' . $output[1] . '월' . $output[2] . '일';
        return 'ok';
    }

    function hadle_short_date($date)
    {
        // 2015-08-03 00:00: -> 2015-08-03
        return substr($date, 0, 10);
    }

    function handle_title_string($data, $limit)
    {
        //한국어 1글자당 3
        $korean = 3;

        $rtv = array();
        if ($data != null && count($data)) {
            foreach ($data as $item) {
                $title = $item->title;

                if (ceil(strlen($title) / $korean) >= $limit) {
                     array_push($rtv, str_split($title, $limit * $korean)[0] . '...');
                } else {
                    array_push($rtv, $title);
                }
            }
            return $rtv;
        }
        return false;
    }

    /**
     * jamong source
     * password decode
     * password encode
     */
    function keyEncrypt($value)
    {
        $Primekey = 'f0u20rj0fjsfjsopfj29rngh3u5hasfn';
        $padSize = 16 - (strlen($value) % 16);
        $value = $value . str_repeat(chr($padSize), $padSize);
        $output = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $Primekey, $value, MCRYPT_MODE_CBC, str_repeat(chr(0), 16));
        return base64_encode($output);
    }

    function keyDecrypt($value)
    {
        $Primekey = 'f0u20rj0fjsfjsopfj29rngh3u5hasfn';
        $value = base64_decode($value);
        $output = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $Primekey, $value, MCRYPT_MODE_CBC, str_repeat(chr(0), 16));

        $valueLen = strlen($output);
        if ($valueLen % 16 > 0)
            $output = "";

        $padSize = ord($output{$valueLen - 1});
        if (($padSize < 1) or ($padSize > 16)) {
            $output = "";                // Check padding.
        }

        for ($i = 0; $i < $padSize; $i++) {
            if (ord($output{$valueLen - $i - 1}) != $padSize)
                $output = "";
        }
        $output = substr($output, 0, $valueLen - $padSize);

        return $output;
    }
}