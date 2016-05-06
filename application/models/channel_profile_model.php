<?php
class Channel_profile_model extends CI_Model {
    private $table;
    function __construct()
    {
        parent::__construct();
        $this->table = 'jumper__channel_profile';
    }

    function gets(){
        $this->db->select('channelname, channelnum');
        $this->db->where('isdeprecated',false);
        $this->db->limit(30);
        $this->db->order_by('follow', 'asc');
        $this->db->from($this->table);
        return $this->db->get()->result();
    }

    function getById($id){
        $this->db->select('name_kr, name_en');
        $this->db->where('catenum',$id);
        $this->db->from($this->table);
        return $this->db->get()->result();
    }
}