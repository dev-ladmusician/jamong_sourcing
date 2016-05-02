<?php
class Category_model extends CI_Model {
    private $table;
    function __construct()
    {
        parent::__construct();
        $this->table = 'jumper__category';
    }

    function gets(){
        $this->db->select('*');
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