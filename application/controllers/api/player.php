<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Player extends CORE_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('like_model');
        $this->load->model('contents_model');
    }

    function like_update(){

        $this->__require_login();
        $contentId = $this->input->get('contentId');
        $userId = $this->session->userdata('userid');
        $is_liked = $this->input->get('is_liked');

        //좋아 할때 add
        if(strcmp($is_liked, 'true') == 0){
            $rtv = $this->like_model->add($contentId,$userId);
            if($rtv=='1'){
                $like_count = $this->like_model->get_like_count_by_content($contentId);
                $this->contents_model->update_like_count($contentId, $like_count);
                $this->session->set_flashdata('message', '좋아요 :)');
                redirect('player?contentId='.$contentId);
            }else{
                $this->session->set_flashdata('message', '오류가 발생했습니다.');
                redirect('player?contentId='.$contentId);
            }
        }else{
            $rtv = $this->like_model->delete($contentId,$userId);
            $like_count = $this->like_model->get_like_count_by_content($contentId);
            $this->contents_model->update_like_count($contentId, $like_count);
            if($rtv=='1'){
                $this->session->set_flashdata('message', '좋아요 취소 :(');
                redirect('player?contentId='.$contentId);
            }else{
                $this->session->set_flashdata('message', '오류가 발생했습니다.');
                redirect('player?contentId='.$contentId);
            }
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
                $like_count = $this->like_model->get_like_count_by_content($contentId);
                $this->contents_model->update_like_count($contentId, $like_count);
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
