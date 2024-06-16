<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ticket extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('M_ticket');
        $this->load->model('M_subject');
        $this->load->model('M_client');
        $this->load->model('M_user');
        cek_login();
    }

    public function admin()
    {
        $data['ticket'] = $this->M_ticket->get_ticket();
        $this->template->load('helpdesk/template_admin', 'helpdesk/admin/tickets/ticket', $data);
    }

    public function agent()
    {
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
        $data['no_ticket'] = $this->M_ticket->get_no_ticket();
        $data['subject'] = $this->M_subject->get_subject();
        $data['user'] = $this->M_user->get_all_data();
        $this->template->load('helpdesk/template_admin', 'helpdesk/admin/tickets/new_ticket', $data);
    }

    //for client
    function new_ticket()
    {
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
                        'subject' => $this->input->post('subject'),
                        'message' => $this->input->post('message'),
                        'img_ticket' => $file_path,
                        'sender_id' => $this->input->post('sender_id'),
                        'company_id' => $this->input->post('company'),
                        'app_id' => $this->input->post('application'),
                        'divisi_id' => $divisi,
                        'status_ticket' => 0
                    );

                    // Save the data to the database
                    if ($this->M_ticket->insert($data)) {
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

            if ($this->M_ticket->post($data)) {
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
            $status_ticket = $this->input->post('status_ticket', true);

            if ($this->M_ticket->update($id, $status_ticket)) {
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
            // var_dump($id, $status_ticket, $solved_by);

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

            if ($delete) {
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
