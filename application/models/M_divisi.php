<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_divisi extends CI_Model
{
    function get_divisi()
    {
        return $this->db->get('divisi')->result();
    }

    function save_divisi($divisi, $update)
    {
        $simpan = [
            'divisi' => $divisi,
            'updated_at' => $update
        ];
        $this->db->insert('divisi', $simpan);
    }

    function data_divisi($id)
    {
        return $this->db->get_where('divisi', ['id_divisi' => $id])->row();
    }

    function update_divisi($id_divisi, $divisi, $update)
    {
        $update = [
            'id_divisi' => $id_divisi,
            'divisi' => $divisi,
            'updated_at' => $update
        ];
        $this->db->where('id_divisi', $id_divisi);
        $this->db->update('divisi', $update);
    }

    public function delete_divisi($id)
    {
        return $this->db->delete('divisi', ['id_divisi' => $id]);
    }
}
