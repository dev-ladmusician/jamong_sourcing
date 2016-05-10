<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CORE_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('category_model');
        $this->load->model('channel_model');
        $this->load->model('contents_model');
    }

    function index() {
        $this->__get_views('_SEARCH/index');
    }

    function result() {
        $str = $this->input->get('searchQuery');
        $page = $this->input->get('page');
        $per_page = $this->input->get('perPage');

        $contents = $this->contents_model->get_items_by_search($page, $per_page, $str);
        $total_count = $this->contents_model->get_total_count_by_search($str);

        $rtv = array(
            'page' => $page,
            'perPage' => $per_page,
            'items' => $contents,
            'itemCount' => count($contents),
            'totalCount' => $total_count
        );
        echo json_encode($rtv, JSON_PRETTY_PRINT);
//        $count = 6;
//
//        $this->__get_views('_SEARCH/result', array('categories' => $categories, 'channels'=>$channels),
//            array('search_query' => $str,
//                'count' => $count));
    }
}
