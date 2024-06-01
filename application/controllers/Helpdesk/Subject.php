<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subject extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_subject');
        $this->load->model('M_divisi');
        cek_login();
    }

    public function subject()
    {
        $data['sub'] = $this->M_subject->get_subject();
        $this->template->load('helpdesk/template_admin', 'helpdesk/admin/subject/subject', $data);
    }

    public function add_subject()
    {
        // $data['code_user'] = $this->M_subject->code_subject();
        // $data['role'] = $this->M_user->get_user_roles();
        $data['divisi'] = $this->M_divisi->get_divisi();
        $this->template->load('helpdesk/template_admin', 'helpdesk/admin/subject/add_subject', $data);
    }

    function edit_subject($id)
    {
        $id_subject = $id;
        $data['sub'] = $this->M_subject->data_subject($id_subject);
        $data['divisi'] = $this->M_divisi->get_divisi();
        $this->template->load('helpdesk/template_admin', 'helpdesk/admin/subject/edit_subject', $data);
    }

    function save_subject()
    {
        if ($this->input->is_ajax_request() == true) {
            $subject = $this->input->post('subject', true);
            $divisi = $this->input->post('divisi', true);
            $update = date('Y-m-d');

            $this->form_validation->set_rules(
                'subject',
                'Subject',
                'required|is_unique[subject.subject]',
                [
                    'required' => '%s tidak boleh kosong',
                    'is_unique' => 'subject sudah ada'
                ]
            );
            $this->form_validation->set_rules(
                'divisi',
                'divisi',
                'required',
                [
                    'required' => '%s tidak boleh kosong'
                ]
            );

            if ($this->form_validation->run() == TRUE) {
                $this->M_subject->save_subject($subject, $divisi, $update);
                $msg = [
                    'success' => 'subject berhasil disimpan'
                ];
            } else {
                $msg = [
                    'error' => validation_errors()
                ];
            }
            echo json_encode($msg);
        }
    }

    function update_subject()
    {
        if ($this->input->is_ajax_request() == true) {
            $id_subject = $this->input->post('id_subject', true);
            $subject = $this->input->post('subject', true);
            $divisi = $this->input->post('divisi', true);
            $update = date('Y-m-d');

            $this->form_validation->set_rules(
                'subject',
                'Subject',
                'required',
                [
                    'required' => '%s tidak boleh kosong'
                ]
            );
            $this->form_validation->set_rules(
                'divisi',
                'divisi',
                'required',
                [
                    'required' => '%s tidak boleh kosong'
                ]
            );

            if ($this->form_validation->run() == TRUE) {
                $this->M_subject->update_subject($id_subject, $subject, $divisi, $update);
                $msg = [
                    'success' => 'subject berhasil diupdate'
                ];
            } else {
                $msg = [
                    'error' => validation_errors()
                ];
            }
            echo json_encode($msg);
        }
    }

    public function delete_subject()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post('id_subject', true);
            $delete = $this->M_subject->delete_subject($id);

            if ($delete) {
                $msg = [
                    'success' => 'Subject Berhasil Terhapus'
                ];
            }
            echo json_encode($msg);
        }
    }
}
