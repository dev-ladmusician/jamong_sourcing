<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CORE_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('contents_model');
    }

    function search_result()
    {
        $page = $this->input->get('page');
        $per_page = $this->input->get('perPage');
        $str = $this->input->get('search_query');

        $result = $this->contents_model->get_items_by_search($str, $page, $per_page);
        $total_count = $this->contents_model->get_total_count_by_search($str);

        $last_page = ceil($total_count / $per_page);

        $view_data = array('items' => $result, 'count' => $total_count);

        $pass_data = array('data' => $this->load->view("_PARTIAL/search_item.php", $view_data, true),
                            'page' => $page,
                            'per_page' => $per_page,
                            'total_count' => $total_count,
                            'last_page' => $last_page
        );
        echo json_encode($pass_data);
    }
}
