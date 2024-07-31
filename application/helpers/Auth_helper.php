<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('cek_login')) {
    function cek_login()
    {
        $CI = &get_instance();
        $email = $CI->session->userdata('email');

        if ($email == NULL) {
            $CI->session->set_flashdata('message', '<div class="alert alert-danger"> Harus Login Bro</div>');
            redirect('helpdesk/auth/login');
        }
    }
}

if (!function_exists('check_admin')) {
    function check_admin()
    {
        cek_login();
        $CI = &get_instance();
        if ($CI->session->userdata('role_id') != '1') {
            $CI->session->set_flashdata('message', '<div class="alert alert-danger"> Access Denied: Admins only.</div>');
            redirect('helpdesk/auth/login');
        }
    }
}

if (!function_exists('check_agent')) {
    function check_agent()
    {
        cek_login();
        $CI = &get_instance();
        if ($CI->session->userdata('role_id') != '2') {
            $CI->session->set_flashdata('message', '<div class="alert alert-danger"> Access Denied: Agents only.</div>');
            redirect('helpdesk/auth/login');
        }
    }
}

if (!function_exists('check_user')) {
    function check_user()
    {
        cek_login();
        $CI = &get_instance();
        if ($CI->session->userdata('role_id') != '3') {
            $CI->session->set_flashdata('message', '<div class="alert alert-danger"> Access Denied: Users only.</div>');
            redirect('helpdesk/auth/login');
        }
    }
}
