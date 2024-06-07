<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_user');
        $this->load->model('M_client');
        $this->load->model('M_divisi');
        cek_login();
    }

    public function user_roles()
    {
        $data['role'] = $this->M_user->get_user_roles();
        $this->template->load('helpdesk/template_admin', 'helpdesk/admin/user_roles', $data);
    }

    public function user()
    {
        $data['user'] = $this->M_user->get_users();
        $this->template->load('helpdesk/template_admin', 'helpdesk/admin/users/user', $data);
    }

    public function new_user()
    {
        $data['code_user'] = $this->M_user->code_user();
        $data['role'] = $this->M_user->get_user_roles();
        $data['company'] = $this->M_client->get_company();
        $data['divisi'] = $this->M_divisi->get_divisi();
        $this->template->load('helpdesk/template_admin', 'helpdesk/admin/users/new_user', $data);
    }

    public function edit_user($id_user)
    {
        $id = $id_user;
        $data['user'] = $this->M_user->data_user($id);
        $data['role'] = $this->M_user->get_user_roles();
        $data['company'] = $this->M_client->get_company();
        $data['divisi'] = $this->M_divisi->get_divisi();
        $this->template->load('helpdesk/template_admin', 'helpdesk/admin/users/edit_user', $data);
    }

    public function save_user()
    {
        if ($this->input->is_ajax_request() == true) {
            $code_user = $this->input->post('code_user', true);
            $fullname = $this->input->post('fullname', true);
            $email = $this->input->post('email', true);
            $password = $this->input->post('password', true);
            $company = $this->input->post('company', true);
            $divisi = $this->input->post('divisi', true);
            $role = $this->input->post('role', true);
            $status = "1";
            $update = date('Y-m-d');

            if ($role == 1) {
                $avatar = '/dist/img/avatar3.png';
            } elseif ($role == 2) {
                $avatar = '/dist/img/avatar4.png';
            } else {
                $avatar = '/dist/img/avatar5.png';
            }

            if ($divisi == 0) {
                $divisi = "0";
                $this->form_validation->set_rules('fullname', 'Full Name', 'required', ['required' => '%s tidak boleh kosong']);
                $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[user.email]', ['required' => '%s tidak boleh kosong', 'is_unique' => 'Email sudah ada']);
                $this->form_validation->set_rules('password', 'Password', 'trim|required', ['required' => '%s tidak boleh kosong']);
                $this->form_validation->set_rules('company', 'Company', 'required', ['required' => '%s tidak boleh kosong']);
                $this->form_validation->set_rules('role', 'Role', 'required', ['required' => '%s tidak boleh kosong']);
            } else {
                $this->form_validation->set_rules('fullname', 'Full Name', 'required', ['required' => '%s tidak boleh kosong']);
                $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[user.email]', ['required' => '%s tidak boleh kosong', 'is_unique' => 'Email sudah ada']);
                $this->form_validation->set_rules('password', 'Password', 'trim|required', ['required' => '%s tidak boleh kosong']);
                $this->form_validation->set_rules('company', 'Company', 'required', ['required' => '%s tidak boleh kosong']);
                $this->form_validation->set_rules('divisi', 'Divisi', 'required', ['required' => '%s tidak boleh kosong']);
                $this->form_validation->set_rules('role', 'Role', 'required', ['required' => '%s tidak boleh kosong']);
            }



            if ($this->form_validation->run() == TRUE) {
                $this->M_user->save_user($code_user, $fullname, $email, $password, $company, $divisi, $role, $status, $avatar, $update);
                $msg = [
                    'success' => 'user berhasil disimpan'
                ];
            } else {
                $msg = [
                    'error' => validation_errors()
                ];
            }
            echo json_encode($msg);
        }
    }

    public function update_user()
    {
        if ($this->input->is_ajax_request() == true) {
            $id_user = $this->input->post('id_user', true);
            $code_user = $this->input->post('code_user', true);
            $fullname = $this->input->post('fullname', true);
            $email = $this->input->post('email', true);
            $password = $this->input->post('password', true);
            $company = $this->input->post('company', true);
            $divisi = $this->input->post('divisi', true);
            $role = $this->input->post('role', true);
            $status = $this->input->post('status', true);
            // $status = "1";
            $update = date('Y-m-d');

            $this->form_validation->set_rules(
                'fullname',
                'Full Name',
                'required[user.fullname]',
                [
                    'required' => '%s tidak boleh kosong'
                ]
            );
            $this->form_validation->set_rules(
                'email',
                'Email',
                'trim|required[user.email]',
                [
                    'required' => '%s tidak boleh kosong'
                ]
            );
            $this->form_validation->set_rules(
                'password',
                'Password',
                'trim|required[user.password]',
                [
                    'required' => '%s tidak boleh kosong'
                ]
            );

            if ($this->form_validation->run() == TRUE) {
                $this->M_user->update_user($id_user, $fullname, $email, $password, $company, $divisi, $role, $status, $update);
                // $this->M_user->update_user_detail($code_user, $company);
                $msg = [
                    'success' => 'user berhasil diupdate'
                ];
            } else {
                $msg = [
                    'error' => validation_errors()
                ];
            }
            echo json_encode($msg);
        }
    }

    public function deleteUser()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post('id_user', true);
            $delete = $this->M_user->delete_user($id);

            if ($delete) {
                $msg = [
                    'success' => 'User Berhasil Terhapus'
                ];
            }
            echo json_encode($msg);
        }
    }
}
