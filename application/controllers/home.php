<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CORE_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('category_model');
        $this->load->model('channel_model');
        $this->load->model('contents_model');
        $this->load->model('user_model');
    }

    function index()
    {

        //로그인 한 경우, profile_image가 등록되어 있으면,
        $user_id = $this->session->userdata('userid');
        if($user_id){
            $profile_url = $this->user_model->get_profile_image_by_id($user_id);
            $this->session->set_userdata('profile_url', $profile_url->picture);
        }
//        $is_superadmin = $this->session->userdata('issuperadmin');
//        $is_login = $this->session->userdata('is_login');
//        $email = $this->session->userdata('email');
//        $nickname = $this->session->userdata('nickname');
//        $is_admin = $this->session->userdata('isadmin');


        $categories = $this->category_model->gets();
        $channels = $this->channel_model->gets();
        $main_video = $this->contents_model->get_main_video();
        $vr_list_hot = $this->contents_model->get_vr_list_hot();
        $vr_list_new = $this->contents_model->get_vr_list_new();

//        var_dump($vr_list_new);
        $this->__get_views('_HOME/index', array('categories' => $categories, 'channels' => $channels,
            'main_video' => $main_video, 'vr_list_hot' => $vr_list_hot, 'vr_list_new' => $vr_list_new));
    }

    function contact()
    {
        $categories = $this->category_model->gets();
        $channels = $this->channel_model->gets();

        $this->__get_views('_HOME/contact', array('categories' => $categories, 'channels' => $channels));
    }
}
