<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_subject');
        $this->load->model('M_ticket');
        $this->load->library('Pdf');
        $this->load->model('M_report');
        cek_login();
    }

    public function report_admin()
    {
        $data['ticket'] = $this->M_ticket->get_ticket();
        $this->template->load('helpdesk/template_admin', 'helpdesk/admin/report/report', $data);
    }

    public function report_agent()
    {
        $data['ticket'] = $this->M_ticket->get_ticket_agent();
        $this->template->load('helpdesk/template_agent', 'helpdesk/agent/report/report', $data);
    }

    public function report_user()
    {
        $data['ticket'] = $this->M_ticket->get_ticket_user();
        $this->template->load('helpdesk/template_user', 'helpdesk/user/report/report', $data);
    }

    public function filter_tickets()
    {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');

        log_message('debug', 'Start Date: ' . $start_date);
        log_message('debug', 'End Date: ' . $end_date);

        $this->load->model('M_report');
        $tickets = $this->M_report->get_filtered_tickets($start_date, $end_date);

        log_message('debug', 'Filtered Tickets: ' . print_r($tickets, true));

        $output = '';
        $no = 1;
        foreach ($tickets as $row) {
            $output .= '<tr>
                        <td>' . $no++ . '</td>
                        <td class="text-sm">
                            <div class="media align-items-center">
                                <div class="avatar-wrapper2">
                                    <img src="' . base_url('assets/back/' . $row->avatar) . '" class="img-size-32 img-circle">
                                </div>
                                <div class="media-body ml-2">
                                    <h4 class="dropdown-item-title text-sm mb-0">' . $row->fullname . '</h4>
                                    <p class="text-sm text-muted mb-0">' . $row->email . '</p>
                                </div>
                            </div>
                        </td>
                        <td class="text-sm">' . $row->no_ticket . '</td>
                        <td class="text-sm">' . $row->subject . '</td>
                        <td class="text-sm">';
            if ($row->status_ticket == '0') {
                $output .= '<span class="badge badge-danger">Waiting</span>';
            } else if ($row->status_ticket == '1') {
                $output .= '<span class="badge badge-warning">Process</span>';
            } else {
                $output .= '<span class="badge badge-success">Solved</span>';
            }
            $output .= '</td>
                        <td class="text-sm">
                            <a href="' . base_url('helpdesk/report/print_report/' . $row->id_ticket) . '" class="btn btn-default btn-sm">
                                <i class="fa fa-print"></i>
                            </a>
                        </td>
                    </tr>';
        }
        echo $output;
    }


    function print_report($id)
    {
        error_reporting(0);
        $pdf = new Pdf('P', 'mm', 'A4');
        $pdf->setMargins(20, 18, 18);
        $pdf->AddPage();
        $pdf->logo("assets/back/dist/img/insaba.png");
        $pdf->judul('CV. INSABA PRATISTA AGYA', 'Jl. Mars Utara No. 20', 'Bandung 40286', 'T: 022-87515131');
        $pdf->Cell(10, 15, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(170, 6, 'DETAIL ISSUE REPORT', 0, 0, 'C');

        $pdf->Cell(10, 10, '', 0, 1);

        $ticket = $this->M_ticket->ticket_report($id);
        //row1
        $pdf->title1('Customer');
        $pdf->is(':');
        $pdf->desc1($ticket->fullname);
        $pdf->Cell(2, 6, '', 0, 0, 'L');
        $pdf->title1('Application');
        $pdf->is(':');
        $pdf->desc1($ticket->application);

        //row2
        $pdf->Cell(10, 6, '', 0, 1);
        $pdf->title1('Ticket Number');
        $pdf->is(':');
        $pdf->desc1($ticket->no_ticket);
        $pdf->Cell(2, 6, '', 0, 0, 'L');
        $pdf->title1('Status');
        $pdf->is(':');
        if ($ticket->status_ticket == 0) {
            $status = "WAITING";
        } else if ($ticket->status_ticket == 1) {
            $status = "PROCESS";
        } else {
            $status = "CLOSED";
        }
        $pdf->desc1($status);

        //row3
        $pdf->Cell(10, 6, '', 0, 1);
        $pdf->title1('Company');
        $pdf->is(':');
        $pdf->desc1($ticket->company);
        $pdf->Cell(2, 6, '', 0, 0, 'L');
        $pdf->title1('Reported by');
        $pdf->is(':');
        $pdf->desc1($this->session->fullname);

        //row4
        $pdf->Cell(10, 6, '', 0, 1);
        $pdf->title1('Open Date');
        $pdf->is(':');
        $pdf->desc1($ticket->created_at);
        $pdf->Cell(2, 6, '', 0, 0, 'L');
        $pdf->title1('Printed by');
        $pdf->is(':');
        $pdf->desc1($this->session->fullname);

        //row5
        $pdf->Cell(10, 10, '', 0, 1);
        $pdf->title2('Subject:');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->desc2($ticket->subject);

        //row6
        $pdf->Cell(10, 12, '', 0, 1);
        $pdf->title2('Description:');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->desc2($ticket->message);

        //row7
        $comment = $this->M_ticket->get_comment($id);
        if ($comment) {
            $pdf->Cell(10, 12, '', 0, 1);
            $pdf->title2('Comments:');
            $pdf->Cell(10, 2, '', 0, 1);

            foreach ($comment as $row) {
                $pdf->Cell(10, 6, '', 0, 1);
                $pdf->sender($row->fullname);
                $pdf->date($row->date);
                $pdf->Cell(10, 5, '', 0, 1);
                $pdf->comment($row->comment);
            }
        }
        $pdf->Cell(10, 2, '', 0, 1);

        //Footer
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10, 10, '', 0, 1);
        $pdf->Cell(85, 6, 'Presented By :', 0, 0, 'L');
        $pdf->Cell(85, 6, 'Approved, Tested, and Closed By :', 0, 0, 'L');
        $pdf->Cell(10, 6, '', 0, 1);
        $pdf->Cell(85, 6, 'Customer : ' . $ticket->fullname, 0, 0, 'L');
        if ($ticket->status_ticket == 2) {
            $solved_by = $ticket->solved_by;
        } else {
            $solved_by = "--";
        }
        $pdf->Cell(85, 6, 'Agent : ' . $solved_by, 0, 0, 'L');
        $pdf->Cell(10, 6, '', 0, 1);
        $pdf->Cell(10, 6, '', 0, 1);
        $pdf->Cell(10, 6, '', 0, 1);
        $pdf->Cell(10, 6, '', 0, 1);

        if ($ticket->solved_at) {
            $solved_at = $ticket->solved_at;
        } else {
            $solved_at = "--";
        }
        $pdf->Cell(85, 6, '', 0, 0, 'L');
        $pdf->Cell(85, 6, 'Date : ' . $solved_at, 0, 0, 'L');

        $pdf->Output();

        // $pdf->Cell(10, 6, '', 0, 1);
        // $pdf->Cell(30, 6, 'Ticket Number', 0, 0, 'L');
        // $pdf->Cell(3, 6, ':', 0, 0, 'L');
        // $pdf->Cell(51, 6, 'T2420240001', 0, 0, 'L');
        // $pdf->Cell(2, 6, '', 0, 0, 'L');
        // $pdf->Cell(30, 6, 'Status', 0, 0, 'L');
        // $pdf->Cell(3, 6, ':', 0, 0, 'L');
        // $pdf->Cell(51, 6, 'CLOSED', 0, 0, 'L');

        // $pdf->Cell(10, 10, '', 0, 1);
        // $pdf->Cell(170, 6, 'Subject :', 0, 0, 'L');
        // $pdf->Cell(10, 6, '', 0, 1);
        // $pdf->Cell(170, 10, 'Tidak Bisa Login', 1, 0, 'L');


        //Comments
        // $pdf->Cell(10, 6, '', 0, 1);
        // $pdf->Cell(85, 5, 'Osamu Dazai', 0, 0, 'L');
        // $pdf->Cell(85, 5, '04 Juli 2024 09:41:00', 0, 0, 'R');
        // $pdf->Cell(10, 5, '', 0, 1);
        // $pdf->Cell(170, 5, 'Oke bang bentar', 1, 0, 'L');
    }
}
