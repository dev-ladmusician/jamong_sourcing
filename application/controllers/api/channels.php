<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Channels extends CORE_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('channel_model');
        $this->load->model('subscriber_model');
    }

    function get_channel_list() {
        $page = $this->input->get('page');
        $per_page = $this->input->get('perPage');

        if(!$page) $page = 1;
        if(!$per_page) $per_page = 8;

        $channels = $this->channel_model->get_channel_list_with_my_subscribe($page, $per_page);
        $total_count = $this->channel_model->get_all_count();
        $last_page = ceil($total_count / $per_page);

        $view_data = array('items'=>$channels);

        $pass_data = array(
            'page'=> $page,
            'per_page' => $per_page,
            'total_count' => $total_count,
            'last_page' => $last_page,
            'data'=> $this->load->view('_PARTIAL/channel_list_item.php', $view_data, true));

        echo json_encode($pass_data, JSON_PRETTY_PRINT);
    }

//    function get_channel_list()
//    {
//        $page = $this->input->get('page');
//        $per_page = $this->input->get('perPage');
//        $rtv = $this->channel_model->get_channel_list_with_my_subscribe($page, $per_page);
//        $total_count = $this->channel_model->get_all_count();
//
//        $last_page = ceil($total_count / $per_page);
//
//        $is_login = $this->session->userdata('is_login');
//
//        $subs = array();
//        if($is_login){
//            $userId = $this->session->userdata('userid');
//            $subs = $this->subscriber_model->get_channel_list_by_user($userId);
//        }
//
//        $view_data = array('items'=>$rtv, 'count'=>$total_count, 'subs'=>$subs);
//
//        $pass_data = array('data'=> $this->load->view('_PARTIAL/channel_list_item.php',$view_data, true),
//                            'page'=> $page,
//                            'per_page' => $per_page,
//                            'total_count' => $total_count,
//                            'last_page' => $last_page);
//
//        echo json_encode($pass_data);
//    }

//    function subscribe_update(){
//        $this->__require_login();
//
//        $userId = $this->session->userdata('userid');
//        $channelId = $this->input->get('channelId');
//        $is_subscribed = $this->input->get('is_subscribed');
//
//        //구독할때 add
//        if(strcmp($is_subscribed, 'true') == 0){
//            $rtv = $this->subscriber_model->add($channelId,$userId);
//
//            if($rtv=='1'){
//                //            update_follow($channelId,true);
//                $this->session->set_flashdata('message', '채널을 구독했습니다.');
//                redirect('channels');
//            }else{
//                $this->session->set_flashdata('message', '채널을 구독하는 데 오류가 발생했습니다.');
//                redirect('channels');
//            }
//        }else{
//            $rtv = $this->subscriber_model->delete($channelId,$userId);
//
//            if($rtv=='1'){
//                //            update_follow($channelId,false);
//                $this->session->set_flashdata('message', '채널 구독을 취소했습니다.');
//                redirect('channels');
//            }else{
//                $this->session->set_flashdata('message', '채널을 구독을 취소하는데 오류가 발생했습니다.');
//                redirect('channels');
//            }
//        }
//    }

}
