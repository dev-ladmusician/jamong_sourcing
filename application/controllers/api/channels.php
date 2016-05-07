<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Channels extends CORE_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('channel_model');
    }

    function get_channel_list()
    {
        $page = $this->input->get('page');
        $per_page = $this->input->get('perPage');
        $rtv = $this->channel_model->get_channel_list($page, $per_page);
        $total_count = $this->channel_model->get_all_count();

        $last_page = ceil($total_count / $per_page);

        $view_data = array('items'=>$rtv, 'count'=>$total_count);

        $pass_data = array('data'=> $this->load->view('_PARTIAL/channel_list_item.php',$view_data, true),
                            'page'=> $page,
                            'per_page' => $per_page,
                            'total_count' => $total_count,
                            'last_page' => $last_page);

        echo json_encode($pass_data);
    }

}
