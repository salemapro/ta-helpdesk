<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_subject');
        $this->load->model('M_ticket');
        // $this->load->model('M_report');
        cek_login();
    }

    public function report_admin()
    {
        $data['ticket'] = $this->M_ticket->get_ticket();
        $this->template->load('helpdesk/template_admin', 'helpdesk/admin/report/report', $data);
    }

    public function report_agent()
    {
        $data['ticket'] = $this->M_ticket->get_ticket_agent();
        $this->template->load('helpdesk/template_agent', 'helpdesk/agent/report/report', $data);
    }

    public function report_user()
    {
        $data['ticket'] = $this->M_ticket->get_ticket_user();
        $this->template->load('helpdesk/template_user', 'helpdesk/user/report/report', $data);
    }

    function print_report_admin($id)
    {
        // $data['get_report'] = $this->M_report->get_report($id)->result();
        $this->template->load('helpdesk/template_admin', 'helpdesk/admin/report/print_report');
    }
}
