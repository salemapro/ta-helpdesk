<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Client extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_client');
        $this->load->model('M_user');
        $this->load->model('M_users');
        // $this->load->model('M_company');
        cek_login();
    }

    public function client()
    {
        $data['cln'] = $this->M_client->get_client();
        $this->template->load('helpdesk/template_admin', 'helpdesk/admin/client/client', $data);
    }

    public function company()
    {
        $data['company'] = $this->M_client->get_company();
        $this->template->load('helpdesk/template_admin', 'helpdesk/admin/company/company', $data);
    }

    public function application()
    {
        $data['app'] = $this->M_client->get_app();
        $data['company'] = $this->M_client->get_company();
        $this->template->load('helpdesk/template_admin', 'helpdesk/admin/application/app', $data);
    }

    public function get_app()
    {
        $company = $this->input->post('company');
        $result = $this->M_client->get_application($company);
        echo json_encode($result);
    }

    public function add_client()
    {
        $data['code_user'] = $this->M_client->code_client();
        // $data['role'] = $this->M_user->get_user_roles();
        $data['company'] = $this->M_client->get_company();
        $this->template->load('helpdesk/template_admin', 'helpdesk/admin/client/add_client', $data);
    }

    public function edit_client($id_client)
    {
        $id = $id_client;
        $data['cln'] = $this->M_client->data_client($id);
        $data['role'] = $this->M_user->get_user_roles();
        $data['company'] = $this->M_client->get_company();

        $this->template->load('helpdesk/template_admin', 'helpdesk/admin/client/edit_client', $data);
    }

    public function formTambahCompany()
    {
        if ($this->input->is_ajax_request() == true) {
            $msg = [
                'success' => $this->load->view('helpdesk/admin/company/add_company', '', true)
            ];
            echo json_encode($msg);
        }
    }

    public function formTambahApp()
    {
        if ($this->input->is_ajax_request() == true) {
            $data['company'] = $this->M_client->get_company();
            $msg = [
                'success' => $this->load->view('helpdesk/admin/application/add_app', $data, true)
            ];
            echo json_encode($msg);
        }
    }

    function save_client()
    {
        if ($this->input->is_ajax_request() == true) {
            $code_user = $this->input->post('code_user', true);
            $fullname = $this->input->post('fullname', true);
            $email = $this->input->post('email', true);
            // $password = $this->input->post('password', true);
            $num_phone = $this->input->post('num_phone', true);
            $company = $this->input->post('company', true);
            // $role = "3";
            // $status = "1";
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
                'trim|required|is_unique[client.email]',
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
                'company',
                'Company',
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
                $this->M_client->save_client($code_user, $fullname, $email, $num_phone, $company,  $update);
                // $this->M_users->user_save($code_user, $email, $password, $full_name, $role, $status);
                $msg = [
                    'success' => 'client berhasil disimpan'
                ];
            } else {
                $msg = [
                    'error' => validation_errors()
                ];
            }
            echo json_encode($msg);
        }
    }

    public function save_company()
    {
        if ($this->input->is_ajax_request() == true) {
            $company = $this->input->post('company', true);

            $this->form_validation->set_rules(
                'company',
                'Company',
                'trim|required|is_unique[company.company]',
                [
                    'required' => '%s tidak boleh kosong',
                    'is_unique' => 'company rapat sudah ada'
                ]
            );
            if ($this->form_validation->run() == TRUE) {
                $this->M_client->save_company($company);

                $msg = [
                    'success' => 'company berhasil disimpan'
                ];
            } else {
                $msg = [
                    'error' => validation_errors()
                ];
            }
            echo json_encode($msg);
        }
    }

    public function save_app()
    {
        if ($this->input->is_ajax_request() == true) {
            $company_id = $this->input->post('company_id', true);
            $app = $this->input->post('application', true);

            $this->form_validation->set_rules(
                'application',
                'Application',
                'required[application.application]',
                [
                    'required' => '%s tidak boleh kosong',
                ]
            );
            if ($this->form_validation->run() == TRUE) {
                $this->M_client->save_app($app, $company_id);

                $msg = [
                    'success' => 'app berhasil disimpan'
                ];
            } else {
                $msg = [
                    'error' => validation_errors()
                ];
            }
            echo json_encode($msg);
        }
    }

    public function formEditCompany()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post('id_company', true);
            $ambildata = $this->M_client->data_company($id);

            if ($ambildata->num_rows() > 0) {
                $row = $ambildata->row_array();
                $data = [
                    'id_company' => $id,
                    'company' => $row['company']
                ];
            }
            $msg = [
                'success' => $this->load->view('helpdesk/admin/company/edit_company', $data, true)
            ];
            echo json_encode($msg);
        }
    }

    public function formEditApp()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post('id_app', true);
            $data['app'] = $this->M_client->data_app($id);
            if ($data['app']) {
                $data['company'] = $this->M_client->get_company();
                $msg = [
                    'success' => $this->load->view('helpdesk/admin/application/edit_app', $data, true)
                ];
                // var_dump($data);
            } else {
                $msg = [
                    'error' => 'invalid'
                ];
            }
            echo json_encode($msg);
        }
    }

    function update_client()
    {
        if ($this->input->is_ajax_request() == true) {
            $id_client = $this->input->post('id_client', true);
            $code_user = $this->input->post('code_user', true);
            $fullname = $this->input->post('fullname', true);
            $email = $this->input->post('email', true);
            $num_phone = $this->input->post('num_phone', true);
            // $password = $this->input->post('password', true);
            $company = $this->input->post('company', true);
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
                'num_phone',
                'Phone Number',
                'required',
                [
                    'required' => '%s tidak boleh kosong'
                ]
            );
            $this->form_validation->set_rules(
                'email',
                'Email',
                'trim|required[client.email]',
                [
                    'required' => '%s tidak boleh kosong'
                ]
            );
            if ($this->form_validation->run() == TRUE) {
                $this->M_client->update_client($id_client, $fullname, $email, $num_phone, $company, $update);
                // $this->M_user->user_update($code_user, $full_name, $role, $status);
                $msg = [
                    'success' => 'client berhasil diupdate'
                ];
            } else {
                $msg = [
                    'error' => validation_errors()
                ];
            }
            echo json_encode($msg);
        }
    }

    public function update_company()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post('id_company', true);
            $company = $this->input->post('company', true);

            $this->form_validation->set_rules(
                'company',
                'Company',
                'trim|required[company.company]',
                [
                    'required' => '%s tidak boleh kosong',
                ]
            );

            if ($this->form_validation->run() == TRUE) {
                $this->M_client->update_company($id, $company);

                $msg = [
                    'success' => 'company berhasil di-update'
                ];
            } else {
                $msg = [
                    'error' => validation_errors()
                ];
            }
            echo json_encode($msg);
        }
    }

    public function update_app()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post('id_app', true);
            $app = $this->input->post('application', true);
            $company_id = $this->input->post('company_id', true);

            $this->form_validation->set_rules(
                'application',
                'Application',
                'required[application.application]',
                [
                    'required' => '%s tidak boleh kosong',
                ]
            );

            if ($this->form_validation->run() == TRUE) {
                $this->M_client->update_app($id, $app, $company_id);

                $msg = [
                    'success' => 'Application berhasil di-update'
                ];
            } else {
                $msg = [
                    'error' => validation_errors()
                ];
            }
            echo json_encode($msg);
        }
    }

    public function delete_client()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post('id_client', true);
            // $code = $this->input->post('code', true);
            $delete = $this->M_client->delete_client($id);
            if ($delete) {
                // $user = $this->M_user->user_delete($code);
                // if ($user) {
                //     $msg = [
                //         'success' => 'Client Berhasil Terhapus'
                //     ];
                // }
                $msg = [
                    'success' => 'Client Berhasil Terhapus'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function deleteCompany()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post('id_company', true);
            $delete = $this->M_client->delete_company($id);

            if ($delete) {
                $msg = [
                    'success' => 'Company Berhasil Terhapus'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function deleteApp()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post('id_app', true);
            $delete = $this->M_client->delete_app($id);

            if ($delete) {
                $msg = [
                    'success' => 'Application Berhasil Terhapus'
                ];
            }
            echo json_encode($msg);
        }
    }
}
