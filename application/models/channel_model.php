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

    function get_channel_list($page=1, $per_page=4){
        if ($page === 1) {
            $this->db->limit($per_page);

        } else {
            $this->db->limit($per_page, ($page - 1) * $per_page);
        }
        $this->db->select('jumper__channellist.channelname, jumper__channellist.channelnum, jumper__channellist.nickName, jumper__channellist.chdesc, jumper__channellist.contents, jumper__channellist.follow, jumper__channel_profile.ch_picture');
        $this->db->where('isdeprecated',false);
        $this->db->join('jumper__channel_profile', 'jumper__channellist.channelnum = jumper__channel_profile.channelnum');
//        $this->db->order_by('follow', 'asc');
        $this->db->from($this->table);
        return $this->db->get()->result();
    }

    function get_by_id($id){
        $this->db->select('jumper__channellist.channelname, jumper__channellist.channelnum, jumper__channellist.follow, jumper__channellist.chdesc, jumper__channellist.contents, jumper__channel_profile.ch_picture, jumper__channel_profile.bg_picture');
        $this->db->where(array('isdeprecated'=> false, 'jumper__channellist.channelnum' =>$id));
        $this->db->join('jumper__channel_profile', 'jumper__channellist.channelnum = jumper__channel_profile.channelnum');
        $this->db->from($this->table);
        return $this->db->get()->row();
    }

    function get_all_count() {
        return $this->db->count_all_results($this->table);
    }
}