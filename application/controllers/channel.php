<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Channel extends CORE_Controller {

    function __construct () {
        parent::__construct();
        $this->load->model('category_model');
        $this->load->model('channel_model');
    }

    function index()
    {

        $categories= $this->category_model->gets();
        $channels = $this->channel_model->gets();

        $this->__get_views('_CHANNEL/index', array('categories' => $categories, 'channels'=>$channels));
    }

    function home()
    {

        $categories= $this->category_model->gets();
        $channels = $this->channel_model->gets();

        $this->__get_views('_CHANNEL/index', array('categories' => $categories, 'channels'=>$channels));
    }
}
