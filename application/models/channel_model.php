<?php
class Channel_model extends CI_Model {
    private $table;
    function __construct()
    {
        parent::__construct();
        $this->table = 'jumper__channellist';
    }

    function gets(){
        $this->db->select('jumper__channellist.channelname, jumper__channellist.channelnum, jumper__channel_profile.ch_picture');
        $this->db->where('isdeprecated',false);
        $this->db->join('jumper__channel_profile', 'jumper__channellist.channelnum = jumper__channel_profile.channelnum');
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