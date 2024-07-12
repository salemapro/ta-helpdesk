<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notification
{
    protected $CI;

    public function __construct()
    {
        // Assign the CodeIgniter super-object
        $this->CI = &get_instance();
        // Load necessary models here
        $this->CI->load->model('M_notif');
    }

    public function NotificationNewTicket($sender, $no_ticket, $divisi)
    {
        $fullname = $this->CI->M_notif->get_sender_name($sender);
        $ticket = $this->CI->M_notif->get_id_ticket($no_ticket);

        $notification = addslashes("<i class='fa fa-exchange'></i> #" . $fullname . " Telah mengirim ticket");
        $role = 1;
        $status = "Unread";

        $result = $this->CI->M_notif->new_ticket_notif($ticket, $notification, $role, $divisi, $status);

        // echo $notification;
    }
}
