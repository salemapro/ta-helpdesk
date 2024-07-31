<?php
class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('Auth');
        $this->load->model('M_notif');
        // $this->load->library('notification');

        $user = $this->session->userdata('id_user');
        $this->data['notifications'] = $this->M_notif->get_user_notifications($user);
        // $this->data['unread_count'] = $this->notification->getUnreadNotificationsCount($user);
    }

    protected function check_access($role)
    {
        if ($this->session->userdata('role_id') != $role) {
            $this->session->set_flashdata('error', 'Silahkan masuk terlebih dahulu !!');
            redirect('helpdesk/auth/login');
        }
    }

    protected function check_admin()
    {
        $this->check_access('1');
    }

    protected function check_agent()
    {
        $this->check_access('2');
    }

    protected function check_user()
    {
        $this->check_access('3');
    }
}
