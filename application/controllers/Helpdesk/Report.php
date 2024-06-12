<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_subject');
        $this->load->model('M_ticket');
        cek_login();
    }

    public function report_admin()
    {
        // $data['sub'] = $this->M_subject->get_subject();
        $data['ticket'] = $this->M_ticket->get_ticket();
        $this->template->load('helpdesk/template_admin', 'helpdesk/admin/report/report', $data);
    }
}
