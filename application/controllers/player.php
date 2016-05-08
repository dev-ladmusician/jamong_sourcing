<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Player extends CORE_Controller {

    function __construct () {
        parent::__construct();
        $this->load->model('category_model');
        $this->load->model('channel_model');
    }

    function index()
    {
        $contentId = $this->input->get('contentId');
        $categories= $this->category_model->gets();
        $channels = $this->channel_model->gets();

        var_dump($contentId);
        $this->__get_views('_PLAYER/index', array('categories' => $categories, 'channels'=>$channels));
    }
}
