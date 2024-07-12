<?php
class MY_Controller extends CI_Controller
{
    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->load->model('M_notif'); // Load the model once in the base controller

    //     // Fetch navbar items and store them in the data array
    //     $this->data['navbar_items'] = $this->M_notif->get_navbar_items();
    // }

    // Additional common functionality can be added here
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_notif');

        $user = $this->session->userdata('id_user');
        $this->data['notifications'] = $this->M_notif->get_user_notifications($user);

        // $this->load->model('Message_model');
        // $this->load->model('Notification_model'); // Assuming you have a model for notifications
        // $this->data['navbar_items'] = $this->M_notif->get_navbar_items();

        // Fetch user role
        // $role = $this->session->userdata('role_id');
        // $divisi = $this->session->userdata('divisi_id');

        // // Fetch notifications based on user role
        // switch ($role) {
        //     case 1:
        //         $this->data['notifications'] = $this->M_notif->get_admin_notifications();
        //         break;
        //     case 2:
        //         $this->data['notifications'] = $this->M_notif->get_agent_notifications($divisi);
        //         break;
        //     case 3:
        //         $this->data['notifications'] = $this->M_notif->get_client_notifications($user);
        //         break;
        //     default:
        //         $this->data['notifications'] = [];
        // }
    }
}
