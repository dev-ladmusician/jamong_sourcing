<?php
class Subscriber_model extends CI_Model {
    private $table;
    function __construct()
    {
        parent::__construct();
        $this->table = 'jumper__mychannels';
    }

    function gets($channelId,$page=1, $per_page=4){
        if ($page === 1) {
            $this->db->limit($per_page);

        } else {
            $this->db->limit($per_page, ($page - 1) * $per_page);
        }
//        $this->db->select('jumper__mychannels.userNumber');
        $this->db->select('jumper__mychannels.userNumber, jumper_user.nickName, jamong__tb_users_picture.picture');
        $this->db->where('channelnum',$channelId);
        $this->db->join('jamong__tb_users_picture', 'jamong__tb_users_picture.userNumber = jumper__mychannels.userNumber','left');
        $this->db->join('jumper_user', 'jumper_user.userNumber = jumper__mychannels.userNumber','left');
        $this->db->group_by('jumper__mychannels.userNumber');
//        $this->db->order_by('follow', 'asc');
        $this->db->from($this->table);
        return $this->db->get()->result();
    }

//    function get_profile_pictue()

    function get_all_count($channelId) {
        $this->db->where('channelnum',$channelId);
        return $this->db->count_all_results($this->table);
    }
}