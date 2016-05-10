<?php

class Subscriber_model extends CI_Model
{
    private $table;

    function __construct()
    {
        parent::__construct();
        $this->table = 'jumper__mychannels';
    }

    function add($channelId, $userId)
    {
        $rtv = $this->db->insert($this->table, array("channelnum" => $channelId, "userNumber" => $userId));
        return $rtv;
    }

    function delete($channelId, $userId)
    {
        $this->db->where(array("channelnum" => $channelId, "userNumber" => $userId));
        $rtv = $this->db->delete($this->table);
        return $rtv;
    }

    function gets($channelId, $page = 1, $per_page = 4)
    {
        if ($page === 1) {
            $this->db->limit($per_page);

        } else {
            $this->db->limit($per_page, ($page - 1) * $per_page);
        }
//        $this->db->select('jumper__mychannels.userNumber');
        $this->db->select('jumper__mychannels.userNumber, jumper_user.nickName, jamong__tb_users_picture.picture');
        $this->db->where('channelnum', $channelId);
        $this->db->join('jamong__tb_users_picture', 'jamong__tb_users_picture.userNumber = jumper__mychannels.userNumber', 'left');
        $this->db->join('jumper_user', 'jumper_user.userNumber = jumper__mychannels.userNumber', 'left');
        $this->db->group_by('jumper__mychannels.userNumber');
//        $this->db->order_by('follow', 'asc');
        $this->db->from($this->table);
        return $this->db->get()->result();
    }

//    function get_profile_pictue()

    function get_all_count($channelId)
    {
        $this->db->where('channelnum', $channelId);
        return $this->db->count_all_results($this->table);
    }

    function is_subscibed_channel($channelId, $userId)
    {
        $this->db->select('*');
        $this->db->where(array('userNumber' => $userId, 'channelnum' => $channelId));
        $this->db->from('jumper__mychannels');
        $rtv = $this->db->get()->row();

        if (empty($rtv)) {
            return false;
        }
        return true;
    }
}