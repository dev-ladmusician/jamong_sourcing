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

    function test1() {
        echo date("Y-m-d", strtotime("-30 day", time()));
    }

    function result() {
        $str = $this->input->get('searchQuery');
//        $page = $this->input->get('page');
//        $per_page = $this->input->get('perPage');
//        $fileter = $this->input->get('filter');
//        $sorting = $this->input->get('sorting');
//
//        if (!$page) $page = 1;
//        if (!$per_page) $per_page = 12;
//
//        $contents = $this->contents_model->get_items_by_search($page, $per_page, $str, $fileter, $sorting);
//        $total_count = $this->contents_model->get_total_count_by_search($str);
//
//        $categories = $this->category_model->gets();
//        $channels = $this->channel_model->gets();
//
//        $rtv = array(
//            'page' => $page,
//            'perPage' => $per_page,
//            'items' => $contents,
//            'itemCount' => count($contents),
//            'totalCount' => $total_count
//        );
        //echo json_encode($rtv, JSON_PRETTY_PRINT);
//        $count = 6;
//
        $categories = $this->category_model->gets();
        $channels = $this->channel_model->gets();
        $this->__get_views('_SEARCH/result', array('categories' => $categories, 'channels'=>$channels),
            array('search_query' => $str));
                //'count' => count($contents)));
    }

    function test() {
        $str = $this->input->get('searchQuery');
        $page = $this->input->get('page');
        $per_page = $this->input->get('perPage');
        $fileter = $this->input->get('filter');

        if (!$page) $page = 1;
        if (!$per_page) $per_page = 12;

        $contents = $this->contents_model->get_items_by_search($page, $per_page, $str, $fileter);
        $total_count = $this->contents_model->get_total_count_by_search($str);

        $rtv = array(
            'page' => $page,
            'perPage' => $per_page,
            'filter' => $fileter,
            'itemCount' => count($contents),
            'items' => $contents,
            'totalCount' => $total_count,
        );
        echo json_encode($rtv, JSON_PRETTY_PRINT);
    }

}
