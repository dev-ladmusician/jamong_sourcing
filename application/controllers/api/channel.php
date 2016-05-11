<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Channel extends CORE_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('contents_model');
        $this->load->model('subscriber_model');
        $this->load->model('channel_model');
    }

//    function update_follow($channelId,$is_subscribed){
//        $follow = $this->subscriber_model->get_count_users_by_channel($channelId);
//        $rtv = $this->channel_model->update_follow($channelId,$follow);
//        var_dump($rtv);
//        if($rtv){
//            if($is_subscribed){
//                $this->session->set_flashdata('message', '채널을 구독했습니다.');
//                redirect('channel/home?channelId='.$channelId);
//            }else{
//                $this->session->set_flashdata('message', '채널 구독을 취소했습니다.');
//                redirect('channel/home?channelId='.$channelId);
//            }
//        }
//    }

    function subscribe_update(){
        $this->__require_login();

        $userId = $this->session->userdata('userid');
        $channelId = $this->input->get('channelId');
        $is_subscribed = $this->input->get('is_subscribed');

        //구독할때 add
        if(strcmp($is_subscribed, 'true') == 0){
            $rtv = $this->subscriber_model->add($channelId,$userId);

            if($rtv=='1'){
                //            update_follow($channelId,true);
                $this->session->set_flashdata('message', '채널을 구독했습니다.');
                redirect('channel/home?channelId='.$channelId);
            }else{
                $this->session->set_flashdata('message', '채널을 구독하는 데 오류가 발생했습니다.');
                redirect('channel/home?channelId='.$channelId);
            }
        }else{
            $rtv = $this->subscriber_model->delete($channelId,$userId);

            if($rtv=='1'){
                //            update_follow($channelId,false);
                $this->session->set_flashdata('message', '채널 구독을 취소했습니다.');
                redirect('channel/home?channelId='.$channelId);
            }else{
                $this->session->set_flashdata('message', '채널을 구독을 취소하는데 오류가 발생했습니다.');
                redirect('channel/home?channelId='.$channelId);
            }
        }


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

        if(count($rtv)){
            $pass_data = array('data'=> $this->load->view('_PARTIAL/channel_vr_list_item.php',$view_data, true),
                'page'=> $page,
                'per_page' => $per_page,
                'total_count' => $total_count,
                'last_page' => $last_page);

            echo json_encode($pass_data);
        }else{
            $pass_data = array('data'=> $this->load->view('_PARTIAL/no_item.php',$view_data,true),
                'page'=> $page,
                'per_page' => $per_page,
                'total_count' => $total_count,
                'last_page' => $last_page);

            echo json_encode($pass_data);
        }
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

        if(count($rtv)){
            $pass_data = array('data'=> $this->load->view('_PARTIAL/channel_subs_item.php',$view_data, true),
                'page'=> $page,
                'per_page' => $per_page,
                'total_count' => $total_count,
                'last_page' => $last_page);

            echo json_encode($pass_data);
        }else{
            $pass_data = array('data'=> $this->load->view('_PARTIAL/no_item.php',$view_data,true),
                'page'=> $page,
                'per_page' => $per_page,
                'total_count' => $total_count,
                'last_page' => $last_page);

            echo json_encode($pass_data);
        }
    }

}
