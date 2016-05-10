<?php
class Comment_model extends CI_Model {
    private $table;
    function __construct()
    {
        parent::__construct();
        $this->table = 'jumper__comments';
    }

    function add($content_id, $user_id, $comment) {
        $input_data = array(
            'V_inum' => $content_id,
            'usernumber' => $user_id,
            'comments' => $comment
        );

        $this->db->insert($this->table, $input_data);
        return $this->db->insert_id();
    }

    function gets($content_id, $page, $per_page) {
        $this->db->select('jumper__comments.inum, jumper__comments.comments, jumper_user.nickName,
                           jumper__comments.V_inum, jumper__comments.isdeprecated,
                           jumper_user.userNumber,
                           jamong__tb_users_picture.picture');
        $this->db->from($this->table);
        $this->db->where(array(
            'jumper__comments.V_inum' => $content_id,
            'jumper__comments.isdeprecated' => false));
        $this->db->join('jamong__tb_users_picture', 'jamong__tb_users_picture.userNumber = jumper__comments.usernumber', 'left');
        $this->db->join('jumper_user', 'jumper_user.userNumber = jumper__comments.usernumber', 'left');
        $this->db->order_by('jumper__comments.inum', 'desc');
        $this->db->limit($per_page, ($page - 1) * $per_page);
        return $this->db->get()->result();
    }

    function get_total_count_comment($content_id) {
        $this->db->select('inum');
        $this->db->from($this->table);
        $this->db->where('V_inum', $content_id);
        $this->db->where('isdeprecated', false);
        return count($this->db->get()->result());
    }

    function delete($comment_id) {
        try {
            $data = array (
                'isdeprecated' => true
            );
            $this->db->where('inum', $comment_id);
            $this->db->update($this->table, $data);
            return $this->db->affected_rows();
        } catch(Exception $e) {
            return -1;
        }
    }
}