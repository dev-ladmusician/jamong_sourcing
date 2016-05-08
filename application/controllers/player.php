<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Player extends CORE_Controller {

    function __construct () {
        parent::__construct();
        $this->load->model('category_model');
        $this->load->model('channel_model');
        $this->load->model('contents_model');
    }

    function index()
    {
        $contentId = $this->input->get('contentId');
        $categories= $this->category_model->gets();
        $channels = $this->channel_model->gets();
        $contents = $this->contents_model->getByContentId($contentId);
        $channel = $this->channel_model->get_by_id($contents->ch);

        $this->__get_views('_PLAYER/index', array('categories' => $categories, 'channels'=>$channels),
            array('content_info'=> $contents, 'channel_info'=> $channel));
    }
}
