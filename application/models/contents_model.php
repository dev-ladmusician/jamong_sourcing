<?php
class Contents_model extends CI_Model {
    private $table;
    function __construct()
    {
        parent::__construct();
        $this->table = 'jumper_talk';
    }

    function get_items_by_search($page, $per_page, $query_str, $filter, $sorting) {
        $query_str = "SELECT * FROM dongshindb.jumper_talk ".
            "LEFT JOIN jumper__channellist ON jumper__channellist.channelnum = jumper_talk.ch ".
            "WHERE (jumper_talk.nickName like '%".$query_str."%' ".
            "OR jumper_talk.title like '%".$query_str."%' ".
            "OR jumper_talk.talk like '%".$query_str."%' ".
            "OR jumper__channellist.channelname like '%".$query_str."%') ".
            "AND jumper_talk.cate > 0 ";

        if (isset($filter['today'])) $query_str = $query_str."AND jumper_talk.created >= ".date('Y-m-d') .' ';
        if (isset($filter['yesterday'])) $query_str = $query_str."AND jumper_talk.created >= ".date("Y-m-d", strtotime("-1 day", time())) .' ';
        if (isset($filter['week'])) $query_str = $query_str."AND jumper_talk.created >= ".date("Y-m-d", strtotime("-7 day", time())) .' ';
        if (isset($filter['month'])) $query_str = $query_str."AND jumper_talk.created >= ".date("Y-m-d", strtotime("-30 day", time())) .' ';
        if (isset($filter['year'])) $query_str = $query_str."AND jumper_talk.created >= ".date("Y-m-d", strtotime("-366 day", time())) .' ';

        if (isset($sorting['like'])) $query_str = $query_str."ORDER BY jumper_talk.likes DESC ";
        if (isset($sorting['hit'])) $query_str = $query_str."ORDER BY jumper_talk.view DESC ";
        if (isset($sorting['date'])) $query_str = $query_str."ORDER BY jumper_talk.inum DESC ";

        if (!$sorting) $query_str = $query_str."ORDER BY jumper_talk.inum DESC ";
        $query_str = $query_str."LIMIT ". $per_page. " OFFSET " .($page -1) * $per_page;

        $query = $this->db->query($query_str);
        return $query->result();
    }

    function get_total_count_by_search($query_str, $filter, $sorting) {
        $query_str = "SELECT jumper_talk.inum FROM dongshindb.jumper_talk ".
            "LEFT JOIN jumper__channellist ON jumper__channellist.channelnum = jumper_talk.ch ".
            "WHERE (jumper_talk.nickName like '%".$query_str."%' ".
            "OR jumper_talk.title like '%".$query_str."%' ".
            "OR jumper_talk.talk like '%".$query_str."%' ".
            "OR jumper__channellist.channelname like '%".$query_str."%') ".
            "AND jumper_talk.cate > 0 ";

        if (isset($filter['today'])) $query_str = $query_str."AND jumper_talk.created >= ".date('Y-m-d') .' ';
        if (isset($filter['yesterday'])) $query_str = $query_str."AND jumper_talk.created >= ".date("Y-m-d", strtotime("-1 day", time())) .' ';
        if (isset($filter['week'])) $query_str = $query_str."AND jumper_talk.created >= ".date("Y-m-d", strtotime("-7 day", time())) .' ';
        if (isset($filter['month'])) $query_str = $query_str."AND jumper_talk.created >= ".date("Y-m-d", strtotime("-30 day", time())) .' ';
        if (isset($filter['year'])) $query_str = $query_str."AND jumper_talk.created >= ".date("Y-m-d", strtotime("-366 day", time())) .' ';

        if (isset($sorting['like'])) $query_str = $query_str."ORDER BY jumper_talk.likes DESC ";
        if (isset($sorting['view'])) $query_str = $query_str."ORDER BY jumper_talk.view DESC ";
        if (isset($sorting['date'])) $query_str = $query_str."ORDER BY jumper_talk.inum DESC ";

        if (!$sorting) $query_str = $query_str."ORDER BY jumper_talk.inum DESC ";

        $query = $this->db->query($query_str);
        return count($query->result());
    }

    function update_like_count($contentId, $like_count){
        $this->db->where('inum', $contentId);
        $this->db->update($this->table, array('likes' => $like_count));
    }

    function update_view($contentId, $view_count){
        $this->db->where('inum', $contentId);
        $this->db->update($this->table, array('view' => $view_count));
    }

    function gets(){
        $this->db->select('*');
        $this->db->where('isdeprecated',false);
        $this->db->from($this->table);
        return $this->db->get()->result();
    }


    function getById($id){
        $this->db->select('picture, title, view');
        $this->db->where(array("cate"=> $id, "uploadstat"=> "Complete"));
        $this->db->from($this->table);
        return $this->db->get()->result();
    }

    function get_contents_by_category($categoryId, $page=1, $per_page=8){
        if ($page === 1) {
            $this->db->limit($per_page);

        } else {
            $this->db->limit($per_page, ($page - 1) * $per_page);
        }
        $this->db->select('inum, nickName, filename, datetime, view, title, cate, picture');
        $this->db->where(array('cate'=>$categoryId, "uploadstat"=> "Complete"));
//        $this->db->order_by('follow', 'asc');
        $this->db->from($this->table);
        return $this->db->get()->result();
    }

    function get_vr_list_hot_more($page=1, $per_page=8){
        if ($page === 1) {
            $this->db->limit($per_page);

        } else {
            $this->db->limit($per_page, ($page - 1) * $per_page);
        }

        $this->db->select('picture, inum, filename, view, nickName, title, cate');
        $this->db->where(array("uploadstat"=>"Complete", "cate >" =>0));
        $this->db->order_by('view','desc');
        $this->db->from($this->table);
        return $this->db->get()->result();
    }

    function get_vr_list_new_more($page=1, $per_page=8){
        if ($page === 1) {
            $this->db->limit($per_page);

        } else {
            $this->db->limit($per_page, ($page - 1) * $per_page);
        }

        $this->db->select('picture, inum, filename, view, nickName, title, cate');
        $this->db->where(array("uploadstat"=>"Complete", "cate >" =>0));
        $this->db->order_by('created','desc');
        $this->db->from($this->table);
        return $this->db->get()->result();
    }

    function get_all_count($categoryId){
        $this->db->where(array('cate'=>$categoryId, "uploadstat"=> "Complete"));
        return $this->db->count_all_results($this->table);
    }

    function get_main_video(){
        $this->db->select('picture, inum, filename');
        $this->db->where(array("uploadstat"=>"Complete", "cate >" =>0));
        $this->db->order_by('view','desc');
        $this->db->limit(1);
        $this->db->from($this->table);
        return $this->db->get()->row();
    }

    function get_vr_list_random(){
        $this->db->select('picture, inum, filename, view, nickName, title, cate');
        $this->db->where(array("uploadstat"=>"Complete", "cate >" =>0));
        $this->db->order_by('inum','random');
        $this->db->limit(5);
        $this->db->from($this->table);
        return $this->db->get()->result();
    }

    function get_vr_list_hot(){
        $this->db->select('picture, inum, filename, view, nickName, title, cate');
        $this->db->where(array("uploadstat"=>"Complete", "cate >" =>0));
        $this->db->order_by('view','desc');
        $this->db->limit(8);
        $this->db->from($this->table);
        return $this->db->get()->result();
    }

    function get_vr_list_new(){

        $this->db->select('picture, inum, filename, view, nickName, title, cate');
        $this->db->where(array("uploadstat"=>"Complete", "cate >" =>0));
        $this->db->order_by('created','desc');
        $this->db->limit(8);
        $this->db->from($this->table);
        return $this->db->get()->result();
    }

    function get_main_video_by_channel($channelId){
        $this->db->select('picture, inum, filename, talk, title, nickName, created, view');
        $this->db->where(array("uploadstat"=>"Complete", "ch" => $channelId, "cate >"=> 0));
        $this->db->order_by('view','desc');
        $this->db->limit(1);
        $this->db->from($this->table);
        return $this->db->get()->row();
    }

    function get_vr_list_hot_by_channel($channelId){

        $this->db->select('picture, inum, filename, view, nickName, title, cate, talk, datetime');
//        $this->db->where(array("uploadstat"=>"Complete", "ch" => $channelId, "cate>"=> 0));
        $this->db->where(array("uploadstat"=>"Complete", "ch" => $channelId, "cate >"=> 0));
        $this->db->order_by('view','desc');
        $this->db->limit(4);
        $this->db->from($this->table);
        return $this->db->get()->result();
    }

    function get_vr_list_new_by_channel($channelId)
    {

        $this->db->select('picture, inum, filename, view, nickName, title, cate, talk, datetime');
        $this->db->where(array("uploadstat" => "Complete", "ch" => $channelId, "cate >" => 0));
        $this->db->order_by('created', 'desc');
        $this->db->limit(4);
        $this->db->from($this->table);
        return $this->db->get()->result();
    }

    function get_vr_list_by_channel($channelId ,$page, $per_page){
        if ($page === 1) {
            $this->db->limit($per_page);

        } else {
            $this->db->limit($per_page, ($page - 1) * $per_page);
        }
        $this->db->select('inum, nickName, picture, filename, view, title, cate,picture');
        $this->db->where(array('ch'=>$channelId, "uploadstat"=> "Complete", "cate >" =>0 ));
//        $this->db->order_by('follow', 'asc');
        $this->db->from($this->table);
        return $this->db->get()->result();
    }

    function get_vr_list_count_by_channel($channelId){
        $this->db->where(array('ch'=>$channelId, "uploadstat"=> "Complete", "cate >" =>0 ));
        return $this->db->count_all_results($this->table);
    }

    function getByContentId($contentId){
        $this->db->select('nickName, picture, filename, view, title, ch, likes, created, type, cate');
        $this->db->where( array("inum" =>$contentId, "cate >" =>0 ));
        $this->db->from($this->table);
        return $this->db->get()->row();
    }

    function get_view_by_content_id($contentId){
        $this->db->select('view');
        $this->db->where('inum', $contentId);
        $this->db->from($this->table);
        return $this->db->get()->row();
    }
}