<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Divisi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_divisi');
        // $this->load->model('M_client');
        // cek_login();
    }

    public function divisi()
    {
        $data['dept'] = $this->M_divisi->get_divisi();
        // $data['company'] = $this->M_client->get_company();
        // var_dump($data);
        // print_r($data);
        $this->template->load('helpdesk/template_admin', 'helpdesk/admin/divisi/divisi', $data);
    }

    public function add_divisi()
    {
        $this->template->load('helpdesk/template_admin', 'helpdesk/admin/divisi/add_divisi');
    }

    public function edit_divisi($id)
    {
        // $id_divisi = $id;
        $data['divisi'] = $this->M_divisi->data_divisi($id);
        // var_dump($data);
        $this->template->load('helpdesk/template_admin', 'helpdesk/admin/divisi/edit_divisi', $data);
    }

    function save_divisi()
    {
        if ($this->input->is_ajax_request() == true) {
            $divisi = $this->input->post('divisi', true);
            $update = date('Y-m-d');

            $this->form_validation->set_rules(
                'divisi',
                'divisi',
                'required|is_unique[divisi.divisi]',
                [
                    'required' => '%s tidak boleh kosong',
                    'is_unique' => 'divisi sudah ada'
                ]
            );
            if ($this->form_validation->run() == TRUE) {
                $this->M_divisi->save_divisi($divisi, $update);
                $msg = [
                    'success' => 'divisi berhasil disimpan'
                ];
            } else {
                $msg = [
                    'error' => validation_errors()
                ];
            }
            echo json_encode($msg);
        }
    }

    function update_divisi()
    {
        if ($this->input->is_ajax_request() == true) {
            $id_divisi = $this->input->post('id_divisi', true);
            $divisi = $this->input->post('divisi', true);
            $update = date('Y-m-d');

            $this->form_validation->set_rules(
                'divisi',
                'divisi',
                'required[divisi.divisi]',
                [
                    'required' => '%s tidak boleh kosong'
                ]
            );
            if ($this->form_validation->run() == TRUE) {
                $this->M_divisi->update_divisi($id_divisi, $divisi, $update);
                $msg = [
                    'success' => 'divisi berhasil diupdate'
                ];
            } else {
                $msg = [
                    'error' => validation_errors()
                ];
            }
            echo json_encode($msg);
        }
    }

    public function delete_divisi()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post('id_divisi', true);
            $delete = $this->M_divisi->delete_divisi($id);

            if ($delete) {
                $msg = [
                    'success' => 'Divisi Berhasil Terhapus'
                ];
            }
            echo json_encode($msg);
        }
    }
}
