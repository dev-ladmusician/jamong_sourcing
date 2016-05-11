<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CORE_Controller {

    function __construct () {
        parent::__construct();
        $this->load->model('user_model');

    }

    function index()
    {
        $this->__get_views('_AUTH/login');
    }

    function login()
    {
        $userId = $this->input->get('userId');

        $email = $this->user_model->get_email_by_user_id($userId);

        if(count($email)){
            $this->__get_views('_AUTH/login',null, array('email'=> $email->email));
        }else{
            $this->__get_views('_AUTH/login',null,array('email'=> null));
        }
    }

    function register(){
        $this->__get_views('_AUTH/register');
    }


    function find_id(){
        $this->__get_views('_AUTH/find_id');
    }

    function find_password(){
        $this->__get_views('_AUTH/find_password');
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect('/auth/login');
    }


}
