<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_tiket extends CI_Model
{
    function get_tiket()
    {
        return $this->db->get('tbl_ticket')->result();
    }

    function get_no_tiket($no_ticket)
    {
        $this->db->join('tbl_user', 'tbl_ticket.user_id = tbl_user.id_user', 'left');
        $this->db->join('tbl_departemen', 'tbl_user.departemen_id = tbl_departemen.id_departemen', 'left');
        $this->db->join('tbl_jabatan', 'tbl_user.jabatan_id = tbl_jabatan.id_jabatan', 'left');
        $this->db->join('tbl_detail_ticket', 'tbl_ticket.id_ticket = tbl_detail_ticket.ticket_id', 'left');
        $this->db->where('no_ticket', $no_ticket);

        return $this->db->get('tbl_ticket')->row();
    }

    function get_id_tiket($id)
    {
        $this->db->where('id_ticket', $id);
        return $this->db->get('tbl_ticket')->row();
    }

    function no_tiket()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(no_ticket,4)) AS no_ticket FROM tbl_ticket WHERE DATE(tgl_daftar)=CURDATE()");
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
        return date('dmy') . $kd;
    }

    function insert($data)
    {
        return $this->db->insert('tbl_ticket', $data);
    }

    function insert_tanggapan($data)
    {
        return $this->db->insert('tbl_detail_ticket', $data);
    }

    function delete($id)
    {
        $this->db->where('id_ticket', $id);
        $this->db->delete('tbl_ticket');
    }

    function update($id, $data)
    {
        $this->db->where('id_ticket', $id);
        $this->db->update('tbl_ticket', $data);
    }

    function tiket_wait()
    {
        $this->db->select('*');
        $this->db->from('tbl_ticket');
        $this->db->where('status_ticket', 0);

        return $this->db->get()->num_rows();
    }

    function tiket_proses()
    {
        $this->db->select('*');
        $this->db->from('tbl_ticket');
        $this->db->where('status_ticket', 2);

        return $this->db->get()->num_rows();
    }

    function tiket_close()
    {
        $this->db->select('*');
        $this->db->from('tbl_ticket');
        $this->db->where('status_ticket', 3);

        return $this->db->get()->num_rows();
    }
}
