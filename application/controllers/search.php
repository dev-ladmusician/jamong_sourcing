<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CORE_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->__get_views('_SEARCH/index');
    }

    function result()
    {
        $str = $this->input->get('search_query');

        //get data from db

        //get counts of results
        $count = 10;
        $this->__get_views('_SEARCH/result', array('search_query' => $str,
            'count' => $count));

//        echo json_encode(array('search_query' => $str,
//                                'count' => $count), JSON_PRETTY_PRINT);
    }
}
