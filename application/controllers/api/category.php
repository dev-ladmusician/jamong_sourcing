<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CORE_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('contents_model');
    }

    function get_contents_by_category()
    {
        $categoryId = $this->input->get('categoryId');
        $page = $this->input->get('page');
        $per_page = $this->input->get('perPage');

        //인기
        if ($categoryId == 9) {
            $rtv = $this->contents_model->get_vr_list_hot_more($page, $per_page);
            $total_count = 50;
            $last_page = ceil($total_count / $per_page);
            $view_data = array('items' => $rtv, 'count' => $total_count);

            if (($page == 1) && (count($rtv) == 0)) {

                $pass_data = array(
                    'data' => $this->load->view('_PARTIAL/no_item.php', true),
                    'page' => $page,
                    'per_page' => $per_page,
                    'total_count' => $total_count,
                    'last_page' => $last_page
                );
                echo json_encode($pass_data);
            } else {
                $pass_data = array(
                    'data' => $this->load->view('_PARTIAL/category_contents_item.php', $view_data, true),
                    'page' => $page,
                    'per_page' => $per_page,
                    'total_count' => $total_count,
                    'last_page' => $last_page
                );
                echo json_encode($pass_data);
            }

        } else if ($categoryId == 10) {
            $rtv = $this->contents_model->get_vr_list_new_more($page, $per_page);
            $total_count = 50;
            $last_page = ceil($total_count / $per_page);
            $view_data = array('items' => $rtv, 'count' => $total_count);

            if (($page == 1) && (count($rtv) == 0)) {

                $pass_data = array(
                    'data' => $this->load->view('_PARTIAL/no_item.php', $view_data, true),
                    'page' => $page,
                    'per_page' => $per_page,
                    'total_count' => $total_count,
                    'last_page' => $last_page
                );
                echo json_encode($pass_data);
            } else {

                $pass_data = array(
                    'data' => $this->load->view('_PARTIAL/category_contents_item.php', $view_data, true),
                    'page' => $page,
                    'per_page' => $per_page,
                    'total_count' => $total_count,
                    'last_page' => $last_page
                );
                echo json_encode($pass_data);
            }

        } else {
            $rtv = $this->contents_model->get_contents_by_category($categoryId, $page, $per_page);
            $total_count = $this->contents_model->get_all_count($categoryId);
            $last_page = ceil($total_count / $per_page);
            $view_data = array('items' => $rtv, 'count' => $total_count);


            if ($total_count) {
                $pass_data = array(
                    'data' => $this->load->view('_PARTIAL/category_contents_item.php', $view_data, true),
                    'page' => $page,
                    'per_page' => $per_page,
                    'total_count' => $total_count,
                    'last_page' => $last_page
                );
                echo json_encode($pass_data);
            } else {

                $pass_data = array(
                    'data' => $this->load->view('_PARTIAL/no_item.php', $view_data, true),
                    'page' => $page,
                    'per_page' => $per_page,
                    'total_count' => $total_count,
                    'last_page' => $last_page
                );
                echo json_encode($pass_data);
            }
        }
    }

}
