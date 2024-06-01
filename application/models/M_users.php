<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_users extends CI_Model
{
    function user_save($code_user, $email, $password, $full_name, $role, $status)
    {
        $simpan = [
            'code_user' => $code_user,
            'email' => $email,
            'password' => $password,
            'full_name' => $full_name,
            'role_id' => $role,
            'status' => $status
        ];

        // var_dump($simpan);
        $this->db->insert('users', $simpan);
    }
}