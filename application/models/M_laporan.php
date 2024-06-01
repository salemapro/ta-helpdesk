<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_laporan extends CI_Model
{
    function get_periode_laporan($tgl_awal, $tgl_akhir)
    {
        $this->db->select('*');
        $this->db->from('tbl_detail_ticket');
        $this->db->join('tbl_ticket', 'tbl_detail_ticket.ticket_id = tbl_ticket.id_ticket', 'left');
        $this->db->where('waktu_tanggapan >=', $tgl_awal);
        $this->db->where('waktu_tanggapan <=', $tgl_akhir);
        $this->db->where('status_ticket', 3);

        return $this->db->get();
    }
}
