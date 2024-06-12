<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_client');
        $this->load->model('M_ticket');
        $this->load->model('M_user');
        cek_login();
    }

    public function admin()
    {
        $data['ticket_wait'] = $this->M_ticket->ticket_wait();
        $data['ticket_proses'] = $this->M_ticket->ticket_proses();
        $data['ticket_close'] = $this->M_ticket->ticket_close();
        $data['user'] = $this->M_user->jumlah_user();
        $this->template->load('helpdesk/template_admin', 'helpdesk/admin/dashboard', $data);
    }

    public function agent()
    {
        $data['ticket_wait'] = $this->M_ticket->ticket_wait_agent();
        $data['ticket_proses'] = $this->M_ticket->ticket_proses_agent();
        $data['ticket_close'] = $this->M_ticket->ticket_close_agent();
        $data['user'] = $this->M_user->user_divisi();
        $this->template->load('helpdesk/template_agent', 'helpdesk/agent/dashboard', $data);
    }

    public function user()
    {
        $data['ticket'] = $this->M_ticket->get_ticket_user();
        $this->template->load('helpdesk/template_user', 'helpdesk/user/tickets/ticket', $data);
    }
}
