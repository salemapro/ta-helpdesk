<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_report extends CI_Model
{
    public function get_filtered_tickets($start_date, $end_date)
    {
        $this->db->select('*');
        $this->db->join('user', 'ticket.sender_id = user.id_user', 'left');
        $this->db->join('subject', 'ticket.subject = subject.id_subject', 'left');
        $this->db->join('divisi', 'ticket.divisi_id = divisi.id_divisi', 'left');
        $this->db->join('company', 'ticket.company_id = company.id_company', 'left');
        $this->db->join('application', 'ticket.app_id = application.id_application', 'left');
        $this->db->from('ticket');

        if (!empty($start_date)) {
            $this->db->where('DATE(ticket.created_at) >=', date('Y-m-d', strtotime($start_date)));
        }
        if (!empty($end_date)) {
            $this->db->where('DATE(ticket.created_at) <=', date('Y-m-d', strtotime($end_date)));
        }

        $query = $this->db->get();
        return $query->result();
    }
}
