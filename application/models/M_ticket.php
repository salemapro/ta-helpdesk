<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_ticket extends CI_Model
{
    function get_ticket()
    {
        $this->db->join('user', 'ticket.sender_id = user.id_user', 'left');
        $this->db->join('subject', 'ticket.subject = subject.id_subject', 'left');
        $this->db->join('divisi', 'ticket.divisi_id = divisi.id_divisi', 'left');
        $this->db->join('company', 'ticket.company_id = company.id_company', 'left');
        $this->db->join('application', 'ticket.app_id = application.id_application', 'left');
        return $this->db->get('ticket')->result();
    }

    function get_ticket_user()
    {
        $user = $this->session->id_user;
        $this->db->join('user', 'ticket.sender_id = user.id_user', 'left');
        $this->db->join('subject', 'ticket.subject = subject.id_subject', 'left');
        $this->db->join('divisi', 'ticket.divisi_id = divisi.id_divisi', 'left');
        $this->db->join('company', 'ticket.company_id = company.id_company', 'left');
        $this->db->join('application', 'ticket.app_id = application.id_application', 'left');
        $this->db->where('ticket.sender_id', $user);
        return $this->db->get('ticket')->result();
    }

    function get_ticket_agent()
    {
        $divisi = $this->session->divisi_id;
        $this->db->join('user', 'ticket.sender_id = user.id_user', 'left');
        $this->db->join('subject', 'ticket.subject = subject.id_subject', 'left');
        $this->db->join('divisi', 'ticket.divisi_id = divisi.id_divisi', 'left');
        $this->db->join('company', 'ticket.company_id = company.id_company', 'left');
        $this->db->join('application', 'ticket.app_id = application.id_application', 'left');
        $this->db->where('ticket.divisi_id', $divisi);
        return $this->db->get('ticket')->result();
    }

    function get_no_ticket()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(no_ticket,4)) AS no_ticket FROM ticket WHERE DATE(created_at)=CURDATE()");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->no_ticket) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return "T" . date('dmy') . $kd;
    }

    function get_id_tiket($id_ticket)
    {
        $this->db->join('user', 'ticket.sender_id = user.id_user', 'left');
        $this->db->join('subject', 'ticket.subject = subject.id_subject', 'left');
        $this->db->join('divisi', 'ticket.divisi_id = divisi.id_divisi', 'left');
        $this->db->join('company', 'ticket.company_id = company.id_company', 'left');
        $this->db->join('application', 'ticket.app_id = application.id_application', 'left');
        $this->db->where('id_ticket', $id_ticket);

        return $this->db->get('ticket')->row();
    }

    function get_comment($id_ticket)
    {
        $this->db->join('user', 'ticket_detail.user_id = user.id_user', 'left');
        $this->db->where('ticket_id', $id_ticket);

        return $this->db->get('ticket_detail')->result();
    }

    function insert($data)
    {
        return $this->db->insert('ticket', $data);
    }

    function post($data)
    {
        return $this->db->insert('ticket_detail', $data);
    }

    function update($id, $status_ticket)
    {
        $update = [
            'status_ticket' => $status_ticket
        ];
        $this->db->where('id_ticket', $id);
        return $this->db->update('ticket', $update);
    }

    function close($id, $status_ticket, $solved_by, $date)
    {
        $update = [
            'status_ticket' => $status_ticket,
            'solved_by' => $solved_by,
            'solved_at' => $date
        ];
        $this->db->where('id_ticket', $id);
        return $this->db->update('ticket', $update);
    }

    function ticket_wait()
    {
        $this->db->select('*');
        $this->db->from('ticket');
        $this->db->where('status_ticket', 0);

        return $this->db->get()->num_rows();
    }

    function ticket_wait_agent()
    {
        $divisi = $this->session->divisi_id;
        $this->db->select('*');
        $this->db->from('ticket');
        $this->db->where('status_ticket', 0);
        $this->db->where('divisi_id', $divisi);

        return $this->db->get()->num_rows();
    }

    function ticket_proses()
    {
        $this->db->select('*');
        $this->db->from('ticket');
        $this->db->where('status_ticket', 1);

        return $this->db->get()->num_rows();
    }

    function ticket_proses_agent()
    {
        $divisi = $this->session->divisi_id;
        $this->db->select('*');
        $this->db->from('ticket');
        $this->db->where('status_ticket', 1);
        $divisi = $this->session->divisi_id;
        $this->db->where('divisi_id', $divisi);

        return $this->db->get()->num_rows();
    }

    function ticket_close()
    {
        $this->db->select('*');
        $this->db->from('ticket');
        $this->db->where('status_ticket', 2);

        return $this->db->get()->num_rows();
    }

    function ticket_close_agent()
    {
        $divisi = $this->session->divisi_id;
        $this->db->select('*');
        $this->db->from('ticket');
        $this->db->where('status_ticket', 2);
        $this->db->where('divisi_id', $divisi);


        return $this->db->get()->num_rows();
    }

    function delete_ticket($id)
    {
        $this->db->where('id_ticket', $id);
        return $this->db->delete('ticket');
    }
}
