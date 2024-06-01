<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_employee');
        $this->load->model('M_user');
        $this->load->model('M_divisi');
        // cek_login();
    }

    public function employee()
    {
        $data['emp'] = $this->M_employee->get_employee();
        // var_dump($data);
        // print_r($data);
        $this->template->load('helpdesk/template_admin', 'helpdesk/admin/employee/employee', $data);
    }

    public function add_employee()
    {
        $data['code_user'] = $this->M_employee->code_employee();
        // $data['role'] = $this->M_user->get_user_roles();
        $data['divisi'] = $this->M_divisi->get_divisi();
        $this->template->load('helpdesk/template_admin', 'helpdesk/admin/employee/add_employee', $data);
    }

    public function edit_employee($id_employee)
    {
        $id = $id_employee;
        $data['emp'] = $this->M_employee->data_employee($id);
        // $data['role'] = $this->M_user->get_user_roles();
        $data['divisi'] = $this->M_divisi->get_divisi();

        $this->template->load('helpdesk/template_admin', 'helpdesk/admin/employee/edit_employee', $data);
    }

    function save_employee()
    {
        if ($this->input->is_ajax_request() == true) {
            $code_user = $this->input->post('code_user', true);
            $fullname = $this->input->post('full_name', true);
            $email = $this->input->post('email', true);
            // $password = $this->input->post('password', true);
            $company = "1";
            $divisi = $this->input->post('divisi', true);
            $num_phone = $this->input->post('num_phone', true);
            // $status = "1";
            $update = date('Y-m-d');

            $this->form_validation->set_rules(
                'full_name',
                'Full Name',
                'required',
                [
                    'required' => '%s tidak boleh kosong'
                ]
            );
            $this->form_validation->set_rules(
                'email',
                'Email',
                'trim|required|is_unique[employee.email]',
                [
                    'required' => '%s tidak boleh kosong',
                    'is_unique' => 'email sudah ada'
                ]
            );
            // $this->form_validation->set_rules(
            //     'password',
            //     'Password',
            //     'required',
            //     [
            //         'required' => '%s tidak boleh kosong'
            //     ]
            // );
            $this->form_validation->set_rules(
                'divisi',
                'Divisi',
                'required',
                [
                    'required' => '%s tidak boleh kosong'
                ]
            );
            $this->form_validation->set_rules(
                'num_phone',
                'Phone Number',
                'required',
                [
                    'required' => '%s tidak boleh kosong'
                ]
            );
            if ($this->form_validation->run() == TRUE) {
                $this->M_employee->save_employee($code_user, $fullname, $email, $company, $divisi, $num_phone, $update);
                // $this->M_user->user_save($code_user, $email, $password, $fullname, $num_phone, $status);
                $msg = [
                    'success' => 'employee berhasil disimpan'
                ];
            } else {
                $msg = [
                    'error' => validation_errors()
                ];
            }
            echo json_encode($msg);
        }
    }

    function update_employee()
    {
        if ($this->input->is_ajax_request() == true) {
            $id_employee = $this->input->post('id_employee', true);
            $code_user = $this->input->post('code_user', true);
            $fullname = $this->input->post('fullname', true);
            $email = $this->input->post('email', true);
            $num_phone = $this->input->post('num_phone', true);
            // $password = $this->input->post('password', true);
            $divisi = $this->input->post('divisi', true);
            // $role = $this->input->post('role', true);
            // $status = $this->input->post('status', true);
            $update = date('Y-m-d');

            $this->form_validation->set_rules(
                'fullname',
                'Full Name',
                'required',
                [
                    'required' => '%s tidak boleh kosong'
                ]
            );
            $this->form_validation->set_rules(
                'email',
                'Email',
                'trim|required[employee.email]',
                [
                    'required' => '%s tidak boleh kosong'
                ]
            );
            $this->form_validation->set_rules(
                'divisi',
                'Divisi',
                'required[employee.divisi_id]',
                [
                    'required' => '%s tidak boleh kosong'
                ]
            );
            $this->form_validation->set_rules(
                'num_phone',
                'Phone Number',
                'required',
                [
                    'required' => '%s tidak boleh kosong'
                ]
            );
            if ($this->form_validation->run() == TRUE) {
                $this->M_employee->update_employee($id_employee, $fullname, $email, $divisi, $num_phone,  $update);
                // $this->M_user->user_update($code_user, $full_name,  $role, $status);
                $msg = [
                    'success' => 'employee berhasil diupdate'
                ];
            } else {
                $msg = [
                    'error' => validation_errors()
                ];
            }
            echo json_encode($msg);
        }
    }

    public function delete_employee()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post('id_employee', true);
            // $code = $this->input->post('code', true);
            $delete = $this->M_employee->delete_employee($id);
            // $user = $this->M_user->user_delete($code);
            if ($delete) {
                // $user = $this->M_user->user_delete($code);
                // if ($user) {
                // $msg = [
                //     'success' => 'Employee Berhasil Terhapus'
                // ];
                // }
                $msg = [
                    'success' => 'Employee Berhasil Terhapus'
                ];
            }
            echo json_encode($msg);
        }
    }
}
