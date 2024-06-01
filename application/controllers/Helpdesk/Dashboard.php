<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_client');
        $this->load->model('M_ticket');
        cek_login();
    }

    public function admin()
    {
        // $data['tiket_wait'] = $this->M_tiket->tiket_wait();
        // $data['tiket_proses'] = $this->M_tiket->tiket_proses();
        // $data['tiket_close'] = $this->M_tiket->tiket_close();
        // $data['user'] = $this->M_karyawan->jumlah_user();
        $this->template->load('helpdesk/template_admin', 'helpdesk/admin/dashboard');
    }

    public function agent()
    {
        $this->template->load('helpdesk/template_agent', 'helpdesk/agent/dashboard');
    }

    public function user()
    {
        $data['ticket'] = $this->M_ticket->get_ticket_user();
        $this->template->load('helpdesk/template_user', 'helpdesk/user/tickets/ticket', $data);
    }
}
