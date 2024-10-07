<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ticket extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
        $this->load->library('form_validation');
        // $this->load->library('notification');
        $this->load->model('M_ticket');
        $this->load->model('M_subject');
        $this->load->model('M_client');
        $this->load->model('M_user');
        $this->load->model('M_notif');
        cek_login();
    }

    public function admin()
    {
        check_admin();
        $data['ticket'] = $this->M_ticket->get_ticket();
        $this->template->load('helpdesk/template_admin', 'helpdesk/admin/tickets/ticket', $data);
    }

    public function agent()
    {
        check_agent();
        $data['agent'] = $this->M_ticket->get_ticket_agent();
        $this->template->load('helpdesk/template_agent', 'helpdesk/agent/tickets/ticket', $data);
    }

    public function user()
    {
        $data['ticket'] = $this->M_ticket->get_ticket_user();
        $this->template->load('helpdesk/template_user', 'helpdesk/user/tickets/ticket', $data);
    }

    //for admin
    function new_ticket_admin()
    {
        check_admin();
        $data['no_ticket'] = $this->M_ticket->get_no_ticket();
        $data['subject'] = $this->M_subject->get_subject();
        $data['user'] = $this->M_user->get_all_data_user();
        $this->template->load('helpdesk/template_admin', 'helpdesk/admin/tickets/new_ticket', $data);
    }

    //for client
    function new_ticket()
    {
        check_user();
        $id = $this->session->id_user;
        $data['no_ticket'] = $this->M_ticket->get_no_ticket();
        $data['subject'] = $this->M_subject->get_subject();
        // $data['company'] = $this->M_client->get_company();
        // $data['app'] = $this->M_client->get_app();
        $this->template->load('helpdesk/template_user', 'helpdesk/user/tickets/new_ticket', $data);

        // if ($role == '1') {
        //     $this->template->load('helpdesk/template_admin', 'helpdesk/admin/tickets/new_ticket', $data);
        // } else if ($role == '2') {
        //     $this->template->load('helpdesk/template_agent', 'helpdesk/agent/tickets/new_ticket', $data);
        // } else {
        //     $this->template->load('helpdesk/template_user', 'helpdesk/user/tickets/new_ticket', $data);
        // }
    }

    function detail_ticket_admin($id_ticket)
    {
        check_admin();
        $data['comment'] = $this->M_ticket->get_comment($id_ticket);
        $data['ticket'] = $this->M_ticket->get_id_tiket($id_ticket);
        if ($data['ticket']) {
            $data['title'] = 'Detail Tiket' . $data['ticket']->id_ticket;
            $this->template->load('helpdesk/template_admin', 'helpdesk/admin/tickets/detail_ticket', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-info">Data Ticket Tidak Ada</div>');
            redirect('ticket', 'refresh');
        }
    }

    function detail_ticket_user($id_ticket)
    {
        check_user();
        $data['comment'] = $this->M_ticket->get_comment($id_ticket);
        $data['ticket'] = $this->M_ticket->get_id_tiket($id_ticket);
        if ($data['ticket']) {
            $data['title'] = 'Detail Tiket' . $data['ticket']->id_ticket;
            $this->template->load('helpdesk/template_user', 'helpdesk/user/tickets/detail_ticket', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-info">Data Ticket Tidak Ada</div>');
            redirect('ticket', 'refresh');
        }
    }

    function detail_ticket_agent($id_ticket)
    {
        check_agent();
        $data['comment'] = $this->M_ticket->get_comment($id_ticket);
        $data['ticket'] = $this->M_ticket->get_id_tiket($id_ticket);
        if ($data['ticket']) {
            $data['title'] = 'Detail Tiket' . $data['ticket']->id_ticket;
            $this->template->load('helpdesk/template_agent', 'helpdesk/agent/tickets/detail_ticket', $data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-info">Data Ticket Tidak Ada</div>');
            redirect('ticket', 'refresh');
        }
    }

    function save_ticket()
    {
        $response = array('error' => '', 'success' => '');

        $this->form_validation->set_rules('subject', 'Subject', 'required', ['required' => '%s tidak boleh kosong']);
        $this->form_validation->set_rules('message', 'Message', 'required', ['required' => '%s tidak boleh kosong']);
        $this->form_validation->set_rules('company', 'Company', 'required', ['required' => '%s tidak boleh kosong']);
        $this->form_validation->set_rules('application', 'Application', 'required', ['required' => '%s tidak boleh kosong']);
        // $this->form_validation->set_rules('img_ticket', 'Image', 'required', ['required' => '%s tidak boleh kosong']);

        if ($this->form_validation->run() == TRUE) {
            if ($this->session->userdata('role_id') == 1) {
                $check_ticket = $this->M_ticket->check_ticket($this->input->post('sender_id'));
            } else {
                $check_ticket = $this->M_ticket->check_ticket($this->session->userdata('id_user'));
            }

            if ($check_ticket) {

                if (isset($_FILES['img_ticket']) && $_FILES['img_ticket']['error'] == 0) {
                    // Set upload path
                    $config['upload_path'] = './assets/images/tiket/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size'] = 2048; // 2MB
                    $config['encrypt_name'] = TRUE; // Encrypt the file name for security
                    // $nama_file = $this->input->post('no_ticket') . date('YmdHis');
                    // $config['file_name'] = $nama_file;

                    // Load upload library with the config
                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('img_ticket')) {
                        // File upload success
                        $upload_data = $this->upload->data();
                        $file_path = $upload_data['file_name'];

                        $subject = $this->input->post('subject');
                        $divisi = $this->M_subject->get_id_divisi($subject);

                        // Get other form data
                        $data = array(
                            'no_ticket' => $this->input->post('no_ticket'),
                            'subject_id' => $this->input->post('subject'),
                            'subject' => $this->input->post('customInput'),
                            'message' => $this->input->post('message'),
                            'img_ticket' => $file_path,
                            'sender_id' => $this->input->post('sender_id'),
                            'company_id' => $this->input->post('company'),
                            'app_id' => $this->input->post('application'),
                            'divisi_id' => $divisi,
                            'status_ticket' => 0
                        );

                        $sender = $this->input->post('sender_id');
                        $fullname = $this->M_user->get_sender_name($sender);

                        $no_ticket = $this->input->post('no_ticket');

                        // Save the data to the database
                        if ($this->M_ticket->insert($data)) {
                            $ticket_id = $this->M_ticket->get_ticket_id($no_ticket);
                            $message = "New Ticket from " . $fullname;
                            $notification_id = $this->M_notif->create_notification($ticket_id, $message);

                            $admins = $this->db->get_where('user', array('role_id' => 1, 'divisi_id' => $divisi))->result();
                            foreach ($admins as $admin) {
                                $this->M_notif->assign_notification_to_user($admin->id_user, $notification_id);
                            }

                            // Send notification to agents in the same division
                            // $ticket = $this->db->get_where('ticket', array('id_ticket' => $ticket_id))->row();
                            $agents = $this->db->get_where('user', array('role_id' => 2, 'divisi_id' => $divisi))->result();
                            foreach ($agents as $agent) {
                                $this->M_notif->assign_notification_to_user($agent->id_user, $notification_id);
                            }

                            $response['success'] = 'Ticket saved successfully.';
                        } else {
                            $response['error'] = 'Failed to save ticket.';
                        }
                        // var_dump($data);
                    } else {
                        // File upload error
                        $response['error'] = $this->upload->display_errors();
                    }
                } else {
                    // No file was uploaded
                    $response['error'] = 'No file uploaded.';
                }
            } else {
                $response['error'] = 'Cannot add new ticket because user have 5 ticket unsuccessful';
            }
        } else {
            $response['error'] = validation_errors();
        }

        echo json_encode($response);
    }

    function post_comment()
    {
        $response = array('error' => '', 'success' => '');

        $this->form_validation->set_rules('comment', 'Comment', 'required', ['required' => '%s tidak boleh kosong']);
        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'ticket_id' => $this->input->post('ticket_id'),
                'user_id' => $this->input->post('user_id'),
                'comment' => $this->input->post('comment')
            );
            $user_id = $this->input->post('user_id');
            $fullname = $this->M_user->get_sender_name($user_id);

            $id = $this->input->post('ticket_id', true);
            $sender_id = $this->input->post('sender_id', true);
            $divisi = $this->input->post('divisi_id', true);
            // $role = $this->session->userdata('role_id');

            if ($this->M_ticket->post($data)) {
                $message = "New Comment from " . $fullname;
                $notification_id = $this->M_notif->create_notification($id, $message);

                if ($user_id == $sender_id) {
                    $admins = $this->db->get_where('user', array('role_id' => 1, 'divisi_id' => $divisi))->result();
                    foreach ($admins as $admin) {
                        $this->M_notif->assign_notification_to_user($admin->id_user, $notification_id);
                    }

                    $agents = $this->db->get_where('user', array('role_id' => 2, 'divisi_id' => $divisi))->result();
                    foreach ($agents as $agent) {
                        $this->M_notif->assign_notification_to_user($agent->id_user, $notification_id);
                    }
                } else {
                    $users = $this->db->get_where('user', array('role_id' => 3, 'id_user' => $sender_id))->result();
                    foreach ($users as $user) {
                        $this->M_notif->assign_notification_to_user($user->id_user, $notification_id);
                    }
                }

                // $admins = $this->db->get_where('user', array('role_id' => 1, 'divisi_id' => $divisi))->result();
                // foreach ($admins as $admin) {
                //     $this->M_notif->assign_notification_to_user($admin->id_user, $notification_id);
                // }

                // $agents = $this->db->get_where('user', array('role_id' => 2, 'divisi_id' => $divisi))->result();
                // foreach ($agents as $agent) {
                //     $this->M_notif->assign_notification_to_user($agent->id_user, $notification_id);
                // }

                // $users = $this->db->get_where('user', array('role_id' => 3, 'id_user' => $sender_id))->result();
                // foreach ($users as $user) {
                //     $this->M_notif->assign_notification_to_user($user->id_user, $notification_id);
                // }

                $response['success'] = 'Comment send successfully.';
            } else {
                $response['error'] = 'Failed to post comment.';
            }
        } else {
            $response['error'] = validation_errors();
        }
        echo json_encode($response);
    }

    function save_confirm()
    {
        $response = array('error' => '', 'success' => '');

        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post('id_ticket', true);
            $sender_id = $this->input->post('sender_id', true);
            $status_ticket = $this->input->post('status_ticket', true);

            if ($this->M_ticket->update($id, $status_ticket)) {
                // $ticket_id = $this->M_ticket->get_ticket_id($no_ticket);
                $message = "Your Ticket on Process";
                $notification_id = $this->M_notif->create_notification($id, $message);
                $users = $this->db->get_where('user', array('role_id' => 3, 'id_user' => $sender_id))->result();
                foreach ($users as $user) {
                    $this->M_notif->assign_notification_to_user($user->id_user, $notification_id);
                }

                $response['success'] = 'Status change successfully.';
            } else {
                $response['error'] = 'Failed to change status.';
            }

            echo json_encode($response);
        }
    }

    function close_confirm()
    {
        $response = array('error' => '', 'success' => '');

        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post('id_ticket', true);
            $status_ticket = $this->input->post('status_ticket', true);
            $solved_by = $this->input->post('solved_by', true);
            $date = date('Y-m-d');

            if ($this->M_ticket->close($id, $status_ticket, $solved_by, $date)) {
                $response['success'] = 'Status change successfully.';
            } else {
                $response['error'] = 'Failed to change status.';
            }

            echo json_encode($response);
        }
    }

    function delete_ticket()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post('id_ticket', true);
            $delete = $this->M_ticket->delete_ticket($id);
            $delete_comment = $this->M_ticket->delete_comment($id);

            if ($delete and $delete_comment) {
                $response['success'] = 'Ticket Berhasil Terhapus';
            }
            echo json_encode($response);
        }
    }

    // function save_ticket()
    // {

    // if ($this->form_validation->run() == TRUE) {
    //     if ($_FILES['img_ticket']['error'] <> 4) {
    //         $config['upload_path'] = './assets/images/tiket/';
    //         $config['allowed_types'] = 'gif|jpg|png|jpeg';
    //         $config['max_size'] = '2048';
    //         $nama_file = $this->input->post('no_ticket') . date('YmdHis');
    //         $config['file_name'] = $nama_file;

    //         $this->load->library('upload', $config);

    //         if (!$this->upload->do_upload('img_ticket')) {
    //             $error = array('error' => $this->upload->display_errors());
    //             // $this->session->set_flashdata('message', '<div class="alert alert-danger ">' . $error['error'] . '</div>');
    //             // $this->index();
    //             $msg = [
    //                 'error' => $error
    //             ];
    //         } else {
    //             $img_ticket = $this->upload->data();
    //             $subject = $this->input->post('subject');
    //             $divisi = $this->M_subject->get_id_divisi($subject);

    //             $data = array(
    //                 'no_ticket' => $this->input->post('no_ticket'),
    //                 'subject' => $this->input->post('subject'),
    //                 'message' => $this->input->post('message'),
    //                 'company' => $this->input->post('company'),
    //                 'subject' => $this->input->post('subject'),
    //                 'application' => $this->input->post('application'),
    //                 'sender_id' => $this->session->userdata('id_user'),
    //                 'divisi' => $divisi,
    //                 'img_ticket' => $this->upload->data('file_name'),
    //                 'status_ticket' => 0,
    //                 'tgl_daftar' => date('Y-m-d')
    //             );
    //             var_dump($data);
    //             // $this->M_tiket->insert($data);

    //             // $this->session->set_flashdata('message', '<div class="alert alert-info">Data Berhasil Disimpan</div>');
    //             // redirect('tiket', 'refresh');
    //             $msg = [
    //                 'success' => 'ticket berhasil disimpan'
    //             ];
    //         }
    //     } else {
    //         $subject = $this->input->post('subject');
    //         $divisi = $this->M_subject->get_id_divisi($subject);
    //         $data = array(
    //             'no_ticket' => $this->input->post('no_ticket'),
    //             'subject' => $this->input->post('subject'),
    //             'message' => $this->input->post('message'),
    //             'company' => $this->input->post('company'),
    //             'subject' => $this->input->post('subject'),
    //             'application' => $this->input->post('application'),
    //             'sender_id' => $this->session->userdata('id_user'),
    //             'divisi' => $divisi,
    //             'status_ticket' => 0,
    //             'user_id' => $this->session->userdata('id_user'),
    //             // 'img_ticket' => $this->upload->data('file_name'),
    //             'tgl_daftar' => date('Y-m-d')
    //         );
    //         var_dump($data);
    //         // $this->M_tiket->insert($data);

    //         // $this->session->set_flashdata('message', '<div class="alert alert-info">Data Berhasil Disimpan</div>');
    //         // redirect('tiket', 'refresh');
    //         $msg = [
    //             'success' => 'ticket berhasil disimpan'
    //         ];
    //     }
    // } else {
    //     $msg = [
    //         'error' => validation_errors()
    //     ];
    // }
    // $this->index();
    // echo json_encode($msg);
    // }

    // function save_ticket()
    // {
    //     $sender_id = $this->session->userdata('id_user');
    //     $no_ticket = $this->input->post('no_ticket');
    //     $subject = $this->input->post('subject');
    //     $message = $this->input->post('message');
    //     $divisi = $this->M_subject->get_id_divisi($subject);
    //     $company = $this->input->post('company');
    //     $application = $this->input->post('application');
    //     $img_ticket = $this->input->post('img_ticket');
    //     $status = 0;

    //     $this->form_validation->set_rules(
    //         'subject',
    //         'Subject',
    //         'required',
    //         [
    //             'required' => '%s tidak boleh kosong'
    //         ]
    //     );
    //     $this->form_validation->set_rules(
    //         'message',
    //         'Message',
    //         'required',
    //         [
    //             'required' => '%s tidak boleh kosong'
    //         ]
    //     );
    //     $this->form_validation->set_rules(
    //         'company',
    //         'Company',
    //         'required',
    //         [
    //             'required' => '%s tidak boleh kosong'
    //         ]
    //     );
    //     $this->form_validation->set_rules(
    //         'application',
    //         'Application',
    //         'required',
    //         [
    //             'required' => '%s tidak boleh kosong'
    //         ]
    //     );
    //     $this->form_validation->set_rules(
    //         'img_ticket',
    //         'Image',
    //         'required',
    //         [
    //             'required' => '%s tidak boleh kosong'
    //         ]
    //     );

    //     if ($this->form_validation->run() == TRUE) {
    //         // var_dump($sender_id, $no_ticket, $subject, $message, $divisi, $company, $application, $img_ticket, $status);
    //         if ($_FILES[$img_ticket]['error'] <> 4) {
    //             $config['upload_path'] = './assets/images/tiket/';
    //             $config['allowed_types'] = 'gif|jpg|png|jpeg';
    //             $config['max_size'] = '2048';
    //             $nama_file = $this->input->post('no_ticket') . date('YmdHis');
    //             $config['file_name'] = $nama_file;

    //             $this->load->library('upload', $config);

    //             if (!$this->upload->do_upload('img_ticket')) {
    //                 $error = array('error' => $this->upload->display_errors());
    //                 $msg = [
    //                     'error' => $error
    //                 ];
    //             } else {
    //                 $data = array(
    //                     'sender_id' => $sender_id,
    //                     'no_ticket' => $no_ticket,
    //                     'subject' => $subject,
    //                     'message' => $message,
    //                     'company' => $company,
    //                     'application' => $application,
    //                     'divisi' => $divisi,
    //                     'img_ticket' => $this->upload->data('file_name'),
    //                     'status' => $status,
    //                 );
    //                 var_dump($data);
    //                 // $this->M_tiket->insert($data);
    //                 $msg = [
    //                     'success' => 'ticket berhasil disimpan'
    //                 ];
    //             }
    //         } else {
    //             $data = array(
    //                 'sender_id' => $sender_id,
    //                 'no_ticket' => $no_ticket,
    //                 'subject' => $subject,
    //                 'message' => $message,
    //                 'company' => $company,
    //                 'application' => $application,
    //                 'divisi' => $divisi,
    //                 // 'img_ticket' => $this->upload->data('file_name'),
    //                 'status' => $status,
    //             );
    //             var_dump($data);
    //             // $this->M_tiket->insert($data);
    //             $msg = [
    //                 'success' => 'ticket berhasil disimpan'
    //             ];
    //         }
    //     } else {
    //         $msg = [
    //             'error' => validation_errors()
    //         ];
    //         // var_dump($sender_id, $no_ticket, $subject, $message, $divisi, $company, $application, $img_ticket, $status);
    //     }
    //     echo json_encode($msg);
    // }
}
