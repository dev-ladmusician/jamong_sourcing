<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CORE_Controller {

    function __construct () {
        parent::__construct();
        $this->load->model('category_model');
        $this->load->model('channel_model');
    }

    function index()
    {
        $category_id = $this->input->get('id');
        $rtv = $this->category_model->getById($category_id);

        $categories= $this->category_model->gets();
        $channels = $this->channel_model->gets();

        $this->__get_views('_CATEGORY/index', array('categories' => $categories, 'channels'=>$channels), array("title"=>$rtv[0]->name_kr, "sub"=>$rtv[0]->name_en));
    }
}
