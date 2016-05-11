<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Channel extends CORE_Controller {

    function __construct () {
        parent::__construct();
        $this->load->model('category_model');
        $this->load->model('channel_model');
        $this->load->model('contents_model');
        $this->load->model('subscriber_model');
    }

    function index() {

        $categories= $this->category_model->gets();
        $channels = $this->channel_model->gets();

        $this->__get_views('_CHANNEL/index', array('categories' => $categories, 'channels'=>$channels));
    }

    function home() {
        $channelId = $this->input->get('channelId');

        $categories= $this->category_model->gets();
        $channels = $this->channel_model->gets();
        $main_video = $this->contents_model->get_main_video_by_channel($channelId);
        $vr_list_hot = $this->contents_model->get_vr_list_hot_by_channel($channelId);
        $vr_list_new = $this->contents_model->get_vr_list_new_by_channel($channelId);

        $rtv = $this->channel_model->get_by_id($channelId);

        $userId = $this->session->userdata('userid');

        $is_subscribed = false;
        if($userId){
            $is_subscribed = $this->subscriber_model->is_subscibed_channel($channelId, $userId);
        }
        $this->__get_views('_CHANNEL/index', array('categories' => $categories, 'channels'=>$channels),
            array('is_subscribed' => $is_subscribed,'channel'=>$rtv, 'main_video' => $main_video, 'vr_list_hot' => $vr_list_hot, 'vr_list_new' => $vr_list_new));
    }
}
