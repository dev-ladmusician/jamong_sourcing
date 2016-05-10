<?php
class Contents_model extends CI_Model {
    private $table;
    function __construct()
    {
        parent::__construct();
        $this->table = 'jumper_talk';
    }

    function get_items_by_search($page, $per_page, $query_str) {
        if ($page == 1) {
            $query_str = "SELECT * FROM dongshindb.jumper_talk ".
                "LEFT JOIN jumper__channellist ON jumper__channellist.channelnum = jumper_talk.ch ".
                "WHERE jumper_talk.nickName like '%goqual%' ".
                "OR jumper_talk.title like '%goqual%' ".
                "OR jumper_talk.talk like '%goqual%' ".
                "OR jumper__channellist.channelname like '%goqual%' ".
                "ORDER BY jumper_talk.inum DESC ".
                "LIMIT ". $per_page;
        } else {
            $query_str = "SELECT * FROM dongshindb.jumper_talk ".
                "LEFT JOIN jumper__channellist ON jumper__channellist.channelnum = jumper_talk.ch ".
                "WHERE jumper_talk.nickName like '%".$query_str."%' ".
                "OR jumper_talk.title like '%".$query_str."%' ".
                "OR jumper_talk.talk like '%".$query_str."%' ".
                "OR jumper__channellist.channelname like '%".$query_str."%' ".
                "ORDER BY jumper_talk.inum DESC ".
                "LIMIT ". $per_page. " OFFSET " .($page -1) * $per_page;
        }

        $query = $this->db->query($query_str);
        return $query->result();
    }

    function get_total_count_by_search($query_str) {
        $query_str = "SELECT jumper_talk.inum FROM dongshindb.jumper_talk ".
            "LEFT JOIN jumper__channellist ON jumper__channellist.channelnum = jumper_talk.ch ".
            "WHERE jumper_talk.nickName like '%goqual%' ".
            "OR jumper_talk.title like '%goqual%' ".
            "OR jumper_talk.talk like '%goqual%' ".
            "OR jumper__channellist.channelname like '%goqual%' ";

        $query = $this->db->query($query_str);
        return count($query->result());
    }

    function gets(){
        $this->db->select('*');
        $this->db->where('isdeprecated',false);
        $this->db->from($this->table);
        return $this->db->get()->result();
    }


    function getById($id){
        $this->db->select('picture, title, hit');
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
        $this->db->select('inum, nickName, picture, datetime, hit, title');
        $this->db->where(array('cate'=>$categoryId, "uploadstat"=> "Complete"));
//        $this->db->order_by('follow', 'asc');
        $this->db->from($this->table);
        return $this->db->get()->result();
    }

    function get_all_count($categoryId){
        $this->db->where(array('cate'=>$categoryId, "uploadstat"=> "Complete"));
        return $this->db->count_all_results($this->table);
    }

    function get_main_video(){
        $this->db->select('picture, inum, filename');
        $this->db->where("uploadstat" , "Complete");
        $this->db->order_by('hit','desc');
        $this->db->limit(1);
        $this->db->from($this->table);
        return $this->db->get()->row();
    }

    function get_vr_list_hot(){

        $this->db->select('picture, inum, filename, hit, nickName, title');
        $this->db->where("uploadstat" , "Complete");
        $this->db->order_by('hit','desc');
        $this->db->limit(8);
        $this->db->from($this->table);
        return $this->db->get()->result();
    }

    function get_vr_list_new(){

        $this->db->select('picture, inum, filename, hit, nickName, title');
        $this->db->where("uploadstat" , "Complete");
        $this->db->order_by('datetime','desc');
        $this->db->limit(8);
        $this->db->from($this->table);
        return $this->db->get()->result();
    }

    function get_main_video_by_channel($channelId){
        $this->db->select('picture, inum, filename, talk, title, nickName, datetime');
        $this->db->where(array("uploadstat"=>"Complete", "ch" => $channelId));
        $this->db->order_by('hit','desc');
        $this->db->limit(1);
        $this->db->from($this->table);
        return $this->db->get()->row();
    }

    function get_vr_list_hot_by_channel($channelId){

        $this->db->select('picture, inum, filename, hit, nickName, title');
        $this->db->where(array("uploadstat"=>"Complete", "ch" => $channelId));
        $this->db->order_by('hit','desc');
        $this->db->limit(4);
        $this->db->from($this->table);
        return $this->db->get()->result();
    }

    function get_vr_list_new_by_channel($channelId){

        $this->db->select('picture, inum, filename, hit, nickName, title');
        $this->db->where(array("uploadstat"=>"Complete", "ch" => $channelId));
        $this->db->order_by('datetime','desc');
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
        $this->db->select('inum, nickName, picture, filename, hit, title');
        $this->db->where(array('ch'=>$channelId, "uploadstat"=> "Complete"));
//        $this->db->order_by('follow', 'asc');
        $this->db->from($this->table);
        return $this->db->get()->result();
    }

    function get_vr_list_count_by_channel($channelId){
        $this->db->where(array('ch'=>$channelId, "uploadstat"=> "Complete"));
        return $this->db->count_all_results($this->table);
    }

    function getByContentId($contentId){
        $this->db->select('nickName, picture, filename, hit, title, ch, likes, datetime');
        $this->db->where("inum" , $contentId);
        $this->db->from($this->table);
        return $this->db->get()->row();
    }
}