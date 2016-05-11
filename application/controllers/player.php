<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Player extends CORE_Controller {

    function __construct () {
        parent::__construct();
        $this->load->model('category_model');
        $this->load->model('channel_model');
        $this->load->model('contents_model');
        $this->load->model('subscriber_model');
        $this->load->model('like_model');
        $this->load->model('hit_model');
    }

    function index()
    {
        $contentId = $this->input->get('contentId');
        $categories= $this->category_model->gets();
        $channels = $this->channel_model->gets();
        $contents = $this->contents_model->getByContentId($contentId);
        $channel = $this->channel_model->get_by_id($contents->ch);

        $userId = $this->session->userdata('userid');

        $is_subscribed = false;
        $is_liked = false;
        if($userId){
            $is_subscribed = $this->subscriber_model->is_subscibed_channel($contents->ch, $userId);
            $is_liked = $this->like_model->is_liked_content($contentId, $userId);
            $is_hit = $this->hit_model->is_hit_content($contentId, $userId);
            if(!$is_hit) {
                $this->hit_model->add($contentId, $userId);
                $hit_count = $this->hit_model->get_hit_count_by_content($contentId);
                $this->contents_model->update_hit_count($contentId, $hit_count);
            }
        }

        $this->__get_views('_PLAYER/index', array('categories' => $categories, 'channels'=>$channels),
            array('contentId'=>$contentId,'is_subscribed' => $is_subscribed, 'is_liked' => $is_liked, 'content_info'=> $contents, 'channel_info'=> $channel));
    }
}
