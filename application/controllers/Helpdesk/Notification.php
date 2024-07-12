<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notification extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('M_notif');
    }

    function NotificationNewTicket($sender, $no_ticket, $divisi)
    {
        $fullname = $this->M_notif->get_sender_name($sender);
        $ticket = $this->M_notif->get_id_ticket($no_ticket);

        $notification = addslashes("<i class='fa fa-exchange'></i> #" . $fullname . " Telah mengirim ticket");
        $role = 1;
        $divisi = $divisi;
        $status = "Unread";

        $result = $this->M_notif->new_ticket_notif($ticket, $notification, $role, $divisi, $status);

        // echo $notification;
    }

    public function mark()
    {
        $id = $this->input->post('id');
        $role = $this->session->userdata('role_id');

        if ($id !== null) {
            log_message('debug', 'Received ID: ' . $id);
        } else {
            log_message('debug', 'ID not received');
        }
        // log_message('debug', 'Received ID: ' . $id);

        if (isset($id)) {
            if ($role == 1) {
                $result = $this->M_notif->mark_notification_as_read_admin($id);
            } else if ($role == 2) {
                $result = $this->M_notif->mark_notification_as_read_agent($id);
            } else {
                $result = $this->M_notif->mark_notification_as_read_user($id);
            }

            if ($result) {
                $response['success'] = 'Notification marked as read.';
            } else {
                $response['error'] = 'Failed to mark notification.';
            }
        } else {
            $response['error'] = 'Invalid notification ID.';
            // print_r($id);
        }
        // print_r($id);
        log_message('debug', 'Response: ' . json_encode($response));
        echo json_encode($response);
    }

    public function mark_notification_as_read()
    {
        // $user_id = $this->session->userdata('id_user');
        // $id = $this->input->post('id');
        // if ($id !== null) {
        //     log_message('debug', 'Received ID: ' . $id);
        //     log_message('debug', 'user_id: ' . $user_id);
        // } else {
        //     log_message('debug', 'ID not received');
        //     log_message('debug', 'user_id: ' . $user_id);
        // }

        // if (isset($id)) {
        //     $result = $this->M_notif->mark_notification_as_read($user_id, $id);
        //     if ($result) {
        //         $response['success'] = 'Notification marked as read.';
        //     } else {
        //         $response['error'] = 'Failed to mark notification.';
        //     }
        // } else {
        //     $response['error'] = 'Invalid notification ID.';
        // }
        // log_message('debug', 'Response: ' . json_encode($response));
        // echo json_encode($response);

        $user_id = $this->session->userdata('id_user');
        $id = $this->input->post('id');
        log_message('debug', 'Received ID: ' . $id);

        if ($id !== null || $id !== 0) {
            log_message('debug', 'Received ID: ' . $id);
            log_message('debug', 'user_id: ' . $user_id);
        } else {
            log_message('debug', 'ID not received');
            log_message('debug', 'user_id: ' . $user_id);
        }

        if (isset($id)) {
            $result = $this->M_notif->mark_notification_as_read($user_id, $id);

            if ($result) {
                $response['success'] = 'Notification marked as read.';
            } else {
                $response['error'] = 'Failed to mark notification.';
            }
        } else {
            $response['error'] = 'Invalid notification ID.';
        }

        log_message('debug', 'Response: ' . json_encode($response));
        echo json_encode($response);
    }
}
