<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Player extends CORE_Controller {

    function __construct () {
        parent::__construct();
        $this->load->model('category_model');
    }

    function index()
    {
        $nav = $this->category_model->gets();
        $this->__get_views('_PLAYER/index', $nav);
    }
}
