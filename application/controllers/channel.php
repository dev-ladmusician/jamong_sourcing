<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Channel extends CORE_Controller {

    function __construct () {
        parent::__construct();
        $this->load->model('category_model');
    }

    function index()
    {
        $nav = $this->category_model->gets();
        $this->__get_views('_CHANNEL/index', $nav);
    }

    function home()
    {
        $nav = $this->category_model->gets();
        $this->__get_views('_CHANNEL/index', $nav);
    }
}
