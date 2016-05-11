<?php

class Hit_model extends CI_Model
{
    private $table;

    function __construct()
    {
        parent::__construct();
        $this->table = 'jumper__hits';
    }

    function get_hit_count_by_content($contentId){
        $this->db->like('inum', $contentId);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function is_hit_content($contentId, $userId)
    {
        $this->db->select('*');
        $this->db->where(array('userNumber' => $userId, 'inum' => $contentId));
        $this->db->from($this->table);
        $rtv = $this->db->get()->row();

        if (empty($rtv)) {
            return false;
        }
        return true;
    }

    function add($contentId, $userId)
    {
        $rtv = $this->db->insert($this->table, array("userNumber" => $userId, "inum" => $contentId));
        return $rtv;
    }

    function delete($contentId, $userId)
    {
        $this->db->where(array("userNumber" => $userId, "inum" => $contentId));
        $rtv = $this->db->delete($this->table);
        return $rtv;
    }
}