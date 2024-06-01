<?php
defined('BASEPATH') or exit('No direct script access allowed');

function cek_login()
{
    $CI = &get_instance();
    $email = $CI->session->email;

    if ($email == NULL) {
        $CI->session->set_flashdata('message', '<div class="alert alert-danger"> Harus Login Bro</div>');

        redirect('helpdesk/auth/login');
    }
}
