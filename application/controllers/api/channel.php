<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Channel extends CORE_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('contents_model');
        $this->load->model('subscriber_model');
    }

    function get_vr_list_by_channel()
    {
        $channelId = $this->input->get('channelId');
        $page = $this->input->get('page');
        $per_page = $this->input->get('perPage');
        $rtv = $this->contents_model->get_vr_list_by_channel($channelId, $page, $per_page);
        $total_count = $this->contents_model->get_vr_list_count_by_channel($channelId);

        $last_page = ceil($total_count / $per_page);

        $view_data = array('items'=>$rtv, 'count'=>$total_count);

        $pass_data = array('data'=> $this->load->view('_PARTIAL/channel_vr_list_item.php',$view_data, true),
            'page'=> $page,
            'per_page' => $per_page,
            'total_count' => $total_count,
            'last_page' => $last_page);

        echo json_encode($pass_data);
    }

    function get_subs_list_by_channel()
    {
        $channelId = $this->input->get('channelId');
        $page = $this->input->get('page');
        $per_page = $this->input->get('perPage');
        $rtv = $this->subscriber_model->gets($channelId,$page,$per_page);
        $total_count = $this->subscriber_model->get_all_count($channelId);

        $last_page = ceil($total_count / $per_page);

        $view_data = array('items'=>$rtv, 'count'=>$total_count);

        $pass_data = array('data'=> $this->load->view('_PARTIAL/channel_subs_item.php',$view_data, true),
            'page'=> $page,
            'per_page' => $per_page,
            'total_count' => $total_count,
            'last_page' => $last_page);

        echo json_encode($pass_data);
    }

}
