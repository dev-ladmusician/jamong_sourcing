<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Player extends CORE_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('like_model');
        $this->load->model('contents_model');
    }

    function like_update()
    {

        $this->__require_login();
        $contentId = $this->input->get('contentId');
        $userId = $this->session->userdata('userid');
        $is_liked = $this->input->get('is_liked');

        //좋아 할때 add
        if (strcmp($is_liked, 'true') == 0) {
            $rtv = $this->like_model->add($contentId, $userId);
            if ($rtv == '1') {
                $like_count = $this->like_model->get_like_count_by_content($contentId);
                $this->contents_model->update_like_count($contentId, $like_count);
                $this->session->set_flashdata('message', '좋아요 :)');
                redirect('player?contentId=' . $contentId);
            } else {
                $this->session->set_flashdata('message', '오류가 발생했습니다.');
                redirect('player?contentId=' . $contentId);
            }
        } else {
            $rtv = $this->like_model->delete($contentId, $userId);
            $like_count = $this->like_model->get_like_count_by_content($contentId);
            $this->contents_model->update_like_count($contentId, $like_count);
            if ($rtv == '1') {
                $this->session->set_flashdata('message', '좋아요 취소 :(');
                redirect('player?contentId=' . $contentId);
            } else {
                $this->session->set_flashdata('message', '오류가 발생했습니다.');
                redirect('player?contentId=' . $contentId);
            }
        }
    }

    function submit_comment() {
        $content_id = $this->input->get('contentId');
        $user_id = $this->session->userdata('userid');
        $comment = $this->input->post('user-comment');
        $flash_str = "";

        if ($this->session->userdata('is_login')) {
            $rtv = $this->comment_model->add($content_id, $user_id, $comment);
            if ($rtv <= 0) $flash_str = "댓글 다는데 오류가 발생했습니다.";
        } else {
            $flash_str = "로그인 해주세요.";
        }
        if (strlen($flash_str) > 0) $this->session->set_flashdata('message', $flash_str);
        redirect('/player/index?contentId='.$content_id);
    }

    function test() {
        $content_id = $this->input->get('contentId');
        $comments = $this->comment_model->gets($content_id, 1, 100);

        $rtv = array(
            'contentId' => $content_id,
            'items' => $comments
        );
        echo json_encode($rtv, JSON_PRETTY_PRINT);
    }

    function get_comments() {
        $content_id = $this->input->get('contentId');
        $page = $this->input->get('page');
        $per_page = $this->input->get('perPage');

        if (!$page) $page = 1;
        if (!$per_page) $per_page = 10;

        $comments = $this->comment_model->gets($content_id, $page, $per_page);
        $total_count = $this->comment_model->get_total_count_comment($content_id);
        $last_page = ceil($total_count / $per_page);

        $view_data = array('items' => $comments);

        $pass_data = array(
            'page' => $page,
            'per_page' => $per_page,
            'total_count' => $total_count,
            'last_page' => $last_page,
            'count' => count($comments),
            'data' => $this->load->view("_PARTIAL/comment.php", $view_data, true),
            'is_last' => $last_page == $page
        );
        echo json_encode($pass_data);
    }

    function delete_comment() {
        $comment_id = $this->input->get('commentId');
        $rtv = $this->comment_model->delete($comment_id);
        echo json_encode($rtv, JSON_PRETTY_PRINT);
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
