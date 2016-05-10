<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Player extends CORE_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('subscriber_model');
    }

    function submit_comment() {
        $content_id = $this->input->get('contentId');
        $user_id = $this->session->userdata('userid');
        $comment = $this->input->post('user-comment');

        if ($this->session->userdata('is_login')) {

        } else {
            $this->session->set_flashdata('message', '로그인해주세요.');
            redirect('/player/index?contentId='.$content_id);
        }
    }

    function subscribe_update(){
        $this->__require_login();

        $contentId = $this->input->get('contentId');
        $userId = $this->session->userdata('userid');
        $channelId = $this->input->get('channelId');
        $is_subscribed = $this->input->get('is_subscribed');

        //구독할때 add
        if(strcmp($is_subscribed, 'true') == 0){
            $rtv = $this->subscriber_model->add($channelId,$userId);
            if($rtv=='1'){
                $this->session->set_flashdata('message', '채널을 구독했습니다.');
                redirect('player?contentId='.$contentId);
            }else{
                $this->session->set_flashdata('message', '채널을 구독하는 데 오류가 발생했습니다.');
                redirect('player?contentId='.$contentId);
            }
        }else{
            $rtv = $this->subscriber_model->delete($channelId,$userId);
            if($rtv=='1'){
                $this->session->set_flashdata('message', '채널 구독을 취소했습니다.');
                redirect('player?contentId='.$contentId);
            }else{
                $this->session->set_flashdata('message', '채널을 구독을 취소하는데 오류가 발생했습니다.');
                redirect('player?contentId='.$contentId);
            }
        }


    }

}
