<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_auth extends CI_Model
{
    // public $id = 'id_user';

    // function insert($data)
    // {
    //     $this->db->insert('tbl_user', $data);
    // }

    // function get_username_user($id)
    // {
    //     $this->db->where('username', $id);
    //     return $this->db->get('tbl_user')->row();
    // }

    function validate($email, $password)
    {
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        return $this->db->get('user')->row();
    }
}
