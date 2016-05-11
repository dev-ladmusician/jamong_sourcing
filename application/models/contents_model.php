<?php
class Contents_model extends CI_Model {
    private $table;
    function __construct()
    {
        parent::__construct();
        $this->table = 'jumper_talk';
    }

    function get_items_by_search($page, $per_page, $query_str, $filter, $sorting) {
//        $query_str = "SELECT * FROM dongshindb.jumper_talk ".
//            "LEFT JOIN jumper__channellist ON jumper__channellist.channelnum = jumper_talk.ch ".
//            "WHERE jumper_talk.nickName like '%".$query_str."%' ".
//            "OR jumper_talk.title like '%".$query_str."%' ".
//            "OR jumper_talk.talk like '%".$query_str."%' ".
//            "OR jumper__channellist.channelname like '%".$query_str."%' ".
//            "ORDER BY jumper_talk.inum DESC ".
//            "LIMIT ". $per_page. " OFFSET " .($page -1) * $per_page;

        $query_str = "SELECT * FROM dongshindb.jumper_talk ".
            "LEFT JOIN jumper__channellist ON jumper__channellist.channelnum = jumper_talk.ch ".
            "WHERE jumper_talk.nickName like '%".$query_str."%' ".
            "OR jumper_talk.title like '%".$query_str."%' ".
            "OR jumper_talk.talk like '%".$query_str."%' ".
            "OR jumper__channellist.channelname like '%".$query_str."%' ";

        if (isset($filter['today'])) $query_str = $query_str."AND jumper_talk.created >= ".date('Y-m-d') .' ';
        if (isset($filter['yesterday'])) $query_str = $query_str."AND jumper_talk.created >= ".date("Y-m-d", strtotime("-1 day", time())) .' ';
        if (isset($filter['week'])) $query_str = $query_str."AND jumper_talk.created >= ".date("Y-m-d", strtotime("-7 day", time())) .' ';
        if (isset($filter['month'])) $query_str = $query_str."AND jumper_talk.created >= ".date("Y-m-d", strtotime("-30 day", time())) .' ';
        if (isset($filter['year'])) $query_str = $query_str."AND jumper_talk.created >= ".date("Y-m-d", strtotime("-366 day", time())) .' ';

        if (isset($sorting['like'])) $query_str = $query_str."ORDER BY jumper_talk.likes DESC ";
        if (isset($sorting['hit'])) $query_str = $query_str."ORDER BY jumper_talk.hit DESC ";
        if (isset($sorting['date'])) $query_str = $query_str."ORDER BY jumper_talk.inum DESC ";

        if (!$sorting) $query_str = $query_str."ORDER BY jumper_talk.inum DESC ";
        $query_str = $query_str."LIMIT ". $per_page. " OFFSET " .($page -1) * $per_page;

        $query = $this->db->query($query_str);
        return $query->result();
    }

    function test ($page, $per_page, $query_str, $filter) {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('jumper__channellist', 'jumper__channellist.channelnum = jumper_talk.ch', 'left');
        $this->db->or_like('jumper_talk.nickName', '%'.$query_str.'%');
        $this->db->or_like('jumper_talk.talk', '%'.$query_str.'%');
        $this->db->or_like('jumper_talk.title', '%'.$query_str.'%');
        $this->db->or_like('jumper__channellist.channelname', '%'.$query_str.'%');
        $this->db->order_by('jumper_talk.inum', 'desc');
        $this->db->limit($per_page, ($page - 1) * $per_page);

        return $this->db->get()->result();
    }

    function get_total_count_by_search($query_str, $filter, $sorting) {
        $query_str = "SELECT jumper_talk.inum FROM dongshindb.jumper_talk ".
            "LEFT JOIN jumper__channellist ON jumper__channellist.channelnum = jumper_talk.ch ".
            "WHERE jumper_talk.nickName like '%".$query_str."%' ".
            "OR jumper_talk.title like '%".$query_str."%' ".
            "OR jumper_talk.talk like '%".$query_str."%' ".
            "OR jumper__channellist.channelname like '%".$query_str."%' ";

        if (isset($filter['today'])) $query_str = $query_str."AND jumper_talk.created >= ".date('Y-m-d') .' ';
        if (isset($filter['yesterday'])) $query_str = $query_str."AND jumper_talk.created >= ".date("Y-m-d", strtotime("-1 day", time())) .' ';
        if (isset($filter['week'])) $query_str = $query_str."AND jumper_talk.created >= ".date("Y-m-d", strtotime("-7 day", time())) .' ';
        if (isset($filter['month'])) $query_str = $query_str."AND jumper_talk.created >= ".date("Y-m-d", strtotime("-30 day", time())) .' ';
        if (isset($filter['year'])) $query_str = $query_str."AND jumper_talk.created >= ".date("Y-m-d", strtotime("-366 day", time())) .' ';

        if (isset($sorting['like'])) $query_str = $query_str."ORDER BY jumper_talk.likes DESC ";
        if (isset($sorting['hit'])) $query_str = $query_str."ORDER BY jumper_talk.hit DESC ";
        if (isset($sorting['date'])) $query_str = $query_str."ORDER BY jumper_talk.inum DESC ";

        if (!$sorting) $query_str = $query_str."ORDER BY jumper_talk.inum DESC ";

        $query = $this->db->query($query_str);
        return count($query->result());
    }

    function update_like_count($contentId, $like_count){
        $this->db->where('inum', $contentId);
        $this->db->update($this->table, array('likes' => $like_count));
    }

    function update_hit_count($contentId, $hit_count){
        $this->db->where('inum', $contentId);
        $this->db->update($this->table, array('hit' => $hit_count));
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
        $this->db->select('inum, nickName, filename, datetime, hit, title, cate');
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

        $this->db->select('picture, inum, filename, hit, nickName, title, cate');
        $this->db->where("uploadstat" , "Complete");
        $this->db->where_not_in("cate",-2);
        $this->db->order_by('hit','desc');
        $this->db->from($this->table);
        return $this->db->get()->result();
    }

    function get_vr_list_new_more($page=1, $per_page=8){
        if ($page === 1) {
            $this->db->limit($per_page);

        } else {
            $this->db->limit($per_page, ($page - 1) * $per_page);
        }

        $this->db->select('picture, inum, filename, hit, nickName, title, cate');
        $this->db->where("uploadstat" , "Complete");
        $this->db->where_not_in("cate",-2);
        $this->db->order_by('datetime','desc');
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
        $this->db->where_not_in("cate",-2);
        $this->db->order_by('hit','desc');
        $this->db->limit(1);
        $this->db->from($this->table);
        return $this->db->get()->row();
    }

    function get_vr_list_hot(){
        $this->db->select('picture, inum, filename, hit, nickName, title, cate');
        $this->db->where("uploadstat" , "Complete");
        $this->db->where_not_in("cate",-2);
        $this->db->order_by('hit','desc');
        $this->db->limit(8);
        $this->db->from($this->table);
        return $this->db->get()->result();
    }

    function get_vr_list_new(){

        $this->db->select('picture, inum, filename, hit, nickName, title, cate');
        $this->db->where("uploadstat" , "Complete");
        $this->db->where_not_in("cate",-2);
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

        $this->db->select('picture, inum, filename, hit, nickName, title, cate, talk, datetime');
        $this->db->where(array("uploadstat"=>"Complete", "ch" => $channelId));
        $this->db->where_not_in("cate",-2);
        $this->db->order_by('hit','desc');
        $this->db->limit(4);
        $this->db->from($this->table);
        return $this->db->get()->result();
    }

    function get_vr_list_new_by_channel($channelId){

        $this->db->select('picture, inum, filename, hit, nickName, title, cate, talk, datetime');
        $this->db->where(array("uploadstat"=>"Complete", "ch" => $channelId));
        $this->db->where_not_in("cate",-2);
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
        $this->db->select('inum, nickName, picture, filename, hit, title, cate');
        $this->db->where(array('ch'=>$channelId, "uploadstat"=> "Complete"));
        $this->db->where_not_in("cate",-2);
//        $this->db->order_by('follow', 'asc');
        $this->db->from($this->table);
        return $this->db->get()->result();
    }

    function get_vr_list_count_by_channel($channelId){
        $this->db->where(array('ch'=>$channelId, "uploadstat"=> "Complete"));
        $this->db->where_not_in("cate",-2);
        return $this->db->count_all_results($this->table);
    }

    function getByContentId($contentId){
        $this->db->select('nickName, picture, filename, hit, title, ch, likes, datetime, type, cate');
        $this->db->where("inum" , $contentId);
        $this->db->where_not_in("cate",-2);
        $this->db->from($this->table);
        return $this->db->get()->row();
    }
}