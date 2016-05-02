<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CORE_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('category_model');
    }

    function index()
    {
        $this->__get_views('_SEARCH/index');
    }

    function result()
    {
        $nav = $this->category_model->gets();
        $str = $this->input->get('search_query');

        //get data from db

        //get counts of results
        $count = 6;
        $this->__get_views('_SEARCH/result', $nav,  array('search_query' => $str,
            'count' => $count));

//        echo json_encode(array('search_query' => $str,
//                                'count' => $count), JSON_PRETTY_PRINT);
    }
}
