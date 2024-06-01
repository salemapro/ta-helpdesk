<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_subject extends CI_Model
{
    function get_subject()
    {
        $this->db->join('divisi', 'subject.divisi_id = divisi.id_divisi', 'left');
        return $this->db->get('subject')->result();
    }

    function get_id_divisi($id)
    {
        // $this->db->where('id_subject', $id);
        // $query = $this->db->get('subject');
        // if ($query->num_rows() > 0) {
        //     foreach ($query->result() as $row) {
        //         $sess = array(
        //             'divisi' => $row->divisi_id,
        //         );
        //     }
        //     $divisi = $sess;
        // }
        // return $divisi;
        $this->db->where('id_subject', $id);
        $query = $this->db->get('subject');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                return $row->divisi_id; // Directly return the divisi_id
            }
        }
        return null;
    }

    function data_subject($id)
    {
        $this->db->join('divisi', 'subject.divisi_id = divisi.id_divisi', 'left');
        $this->db->where('id_subject', $id);
        return $this->db->get('subject')->row();
    }


    function save_subject($subject, $divisi, $update)
    {
        $save = [
            'subject' => $subject,
            'divisi_id' => $divisi,
            'updated_at' => $update
        ];

        $this->db->insert('subject', $save);
    }

    function update_subject($id_subject, $subject, $divisi, $update)
    {
        $update = [
            'id_subject' => $id_subject,
            'subject' => $subject,
            'divisi_id' => $divisi,
            'updated_at' => $update
        ];
        $this->db->where('id_subject', $id_subject);
        $this->db->update('subject', $update);
    }

    public function delete_subject($id)
    {
        return $this->db->delete('subject', ['id_subject' => $id]);
    }
}
