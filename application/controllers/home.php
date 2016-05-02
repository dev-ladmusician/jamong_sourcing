<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CORE_Controller {

    function __construct () {
        parent::__construct();
        $this->load->model('category_model');
    }

    function index()
    {
        $nav_item = $this->category_model->gets();
        $this->__get_views('_HOME/index', $nav_item);
    }
    function contact(){
        $nav_item = $this->category_model->gets();
        $this->__get_views('_HOME/contact', $nav_item);
    }
}
