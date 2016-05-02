<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CORE_Controller {

    function __construct () {
        parent::__construct();
        $this->load->model('category_model');
    }

    function index()
    {
        $nav = $this->category_model->gets();
        $category_id = $this->input->get('id');
        $rtv = $this->category_model->getById($category_id);

        $this->__get_views('_CATEGORY/index', $nav, array("title"=>$rtv[0]->name_kr, "sub"=>$rtv[0]->name_en));
    }
}
