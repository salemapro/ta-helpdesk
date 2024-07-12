<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_notif extends CI_Model
{
    public function create_notification($ticket_id, $message)
    {
        $data = array(
            'ticket_id' => $ticket_id,
            'notification' => $message
        );
        $this->db->insert('notification', $data);
        return $this->db->insert_id();
    }

    public function assign_notification_to_user($user_id, $notification_id)
    {
        $data = array(
            'user_id' => $user_id,
            'notification_id' => $notification_id
        );
        $this->db->insert('user_notification', $data);
    }

    public function get_user_notifications($user_id)
    {
        // $this->db->select('*');
        $this->db->join('user_notification', 'notification.id_notification = user_notification.notification_id');
        $this->db->where('user_notification.user_id', $user_id);
        $this->db->where('user_notification.is_read', FALSE);
        $this->db->order_by('notification.created_at', 'DESC');
        $this->db->from('notification');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function mark_notification_as_read($user_id, $notification_id)
    {
        $update = ['is_read' => TRUE];
        $this->db->where('user_id', $user_id);
        $this->db->where('notification_id', $notification_id);
        $this->db->update('user_notification', $update);
        return $this->db->affected_rows() > 0;
    }


    // public function get_admin_notifications()
    // {
    //     // Fetch notifications for admin
    //     $this->db->where('role_id', 1);
    //     // $this->db->where('status', 'Unread');
    //     $this->db->order_by('date', 'DESC');
    //     return $this->db->get('notification')->result_array();
    // }

    // public function get_agent_notifications($divisi)
    // {
    //     // Fetch notifications for agent
    //     $this->db->where('divisi_id', $divisi);
    //     $this->db->order_by('date', 'DESC');
    //     return $this->db->get('notification')->result_array();
    // }

    // public function get_client_notifications($user)
    // {
    //     // Fetch notifications for client
    //     $this->db->where('role_id', 3);
    //     $this->db->where('user_id', $user);
    //     $this->db->order_by('date', 'DESC');

    //     return $this->db->get('notification')->result_array();
    // }

    // function NotificationNewTicket($ticket_id, $message)
    // {
    //     $notification_id = $this->create_notification($ticket_id, $message);

    //     // $notification = addslashes("New Ticket from " . $fullname);
    //     // $role = 1;
    //     // $divisi = $divisi;
    //     // $user = $sender;
    //     // $status = "Unread";

    //     // $result = $this->new_ticket_notif($ticket, $notification, $role, $divisi, $user, $status);

    //     // echo $notification;
    // }

    // function get_sender_name($sender)
    // {
    //     $this->db->where('id_user', $sender);
    //     $query = $this->db->get('user');
    //     if ($query->num_rows() > 0) {
    //         foreach ($query->result() as $row) {
    //             return $row->fullname;
    //         }
    //     }
    //     return null;
    // }

    // function get_id_ticket($no_ticket)
    // {
    //     $this->db->where('no_ticket', $no_ticket);
    //     $query = $this->db->get('ticket');
    //     if ($query->num_rows() > 0) {
    //         foreach ($query->result() as $row) {
    //             return $row->id_ticket;
    //         }
    //     }
    //     return null;
    // }

    // function new_ticket_notif($ticket, $notification, $role, $divisi, $user, $status)
    // {
    //     $save = [
    //         'ticket_id' => $ticket,
    //         'notification' => $notification,
    //         'role_id' => $role,
    //         'divisi_id' => $divisi,
    //         'user_id' => $user,
    //         'status' => $status
    //     ];

    //     $this->db->insert('notification', $save);
    // }

    // public function get_navbar_items()
    // {
    //     // Fetch the items from the database
    //     $query = $this->db->get('notification'); // Adjust the table name and query as needed
    //     return $query->result_array();
    // }

    // public function mark_notification_as_read_admin($id)
    // {
    //     $this->db->where('id_notification', $id);
    //     return $this->db->update('notification', array('role_id' => 0));
    // }

    // public function mark_notification_as_read_agent($id)
    // {
    //     $this->db->where('id_notification', $id);
    //     return $this->db->update('notification', array('divisi_id' => 0));
    // }

    // public function mark_notification_as_read_user($id)
    // {
    //     $this->db->where('id_notification', $id);
    //     return $this->db->update('notification', array('user_id' => 0));
    // }

    // public function delete_notification($notification_id)
    // {
    //     $this->db->where('id', $notification_id);
    //     $this->db->delete('notifications');
    // }
}
