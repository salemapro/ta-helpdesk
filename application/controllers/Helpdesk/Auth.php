<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_auth');
        // cek_login();
    }

    function login()
    {
        $this->load->view('helpdesk/login');
    }

    function login_aksi()
    {
        $this->form_validation->set_rules(
            'email',
            'Email',
            'trim|required',
            [
                'required' => '%s tidak boleh kosong'
            ]
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'trim|required',
            [
                'required' => '%s tidak boleh kosong'
            ]
        );

        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);

        if ($this->form_validation->run() == TRUE) {
            $user = $this->M_auth->validate($email, $password);
            if (!$user) {
                $msg = [
                    'error' => 'Invailed Email or Password'
                ];
            } else if ($user->status == '0') {
                $msg = [
                    'error' => 'User Not Active'
                ];
            } else {
                $session = array(
                    'id_user'    => $user->id_user,
                    'code_user'    => $user->code_user,
                    'email'      => $user->email,
                    'fullname'  => $user->fullname,
                    'role_id'    => $user->role_id,
                    'divisi_id'    => $user->divisi_id,
                    'avatar'    => $user->avatar
                );
                $this->session->set_userdata($session);
                if ($user->role_id === '1') {
                    $msg = [
                        'role' => '1',
                        'success' => 'Hallo Admin'
                    ];
                } elseif ($user->role_id === '2') {
                    $msg = [
                        'role' => '2',
                        'success' => 'Hallo Agent'
                    ];
                } else {
                    $msg = [
                        'role' => '3',
                        'success' => 'Hallo User'
                    ];
                }
            }
        } else {
            $msg = [
                'error' => validation_errors()
            ];
        }
        echo json_encode($msg);
    }

    function logout()
    {
        $this->session->set_userdata('email', FALSE);
        $this->session->sess_destroy();
        redirect('helpdesk/auth/login');
    }
}
