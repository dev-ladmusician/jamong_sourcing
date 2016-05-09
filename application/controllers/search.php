<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CORE_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('category_model');
        $this->load->model('channel_model');
        $this->load->model('contents_model');
    }

    function index()
    {
        $this->__get_views('_SEARCH/index');
    }

    function result()
    {
        $str = $this->input->get('search_query');

        $categories= $this->category_model->gets();
        $channels = $this->channel_model->gets();
//
        $count = $this->contents_model->get_total_count_by_search($str);

        $this->__get_views('_SEARCH/result', array('categories' => $categories, 'channels'=>$channels),
            array('search_query' => $str,'count' => $count));
    }
}
