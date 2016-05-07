<?php
class Contents_model extends CI_Model {
    private $table;
    function __construct()
    {
        parent::__construct();
        $this->table = 'jumper_talk';
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
}