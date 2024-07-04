<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

// Include FPDF library
require_once(APPPATH . 'third_party/fpdf/fpdf.php');

class Pdf extends FPDF
{
    function __construct()
    {
        parent::__construct();
    }

    function logo($logo)
    {
        $this->Image($logo, 20, 18, 25, 20);
    }

    function judul($teks1, $teks2, $teks3, $teks4)
    {
        $this->Cell(170);
        $this->SetFont('Arial', 'B', '12');
        $this->Cell(1, 0, $teks1, 0, 1, 'R');
        $this->Cell(1, 5, '', 0, 1);
        $this->Cell(170);
        $this->SetFont('Arial', '', '12');
        $this->Cell(1, 0, $teks2, 0, 1, 'R');
        $this->Cell(1, 5, '', 0, 1);
        $this->Cell(170);
        $this->SetFont('Arial', '', '12');
        $this->Cell(1, 0, $teks3, 0, 1, 'R');
        $this->Cell(1, 5, '', 0, 1);
        $this->Cell(170);
        $this->SetFont('Arial', 'B', '12');
        $this->Cell(1, 0, $teks4, 0, 1, 'R');
    }

    function title1($title)
    {
        $this->SetFont('Arial', 'B', '10');
        $this->Cell(30, 6, $title, 0, 0, 'L');
    }

    function title2($title)
    {
        $this->SetFont('Arial', 'B', '10');
        $this->Cell(170, 8, $title, 0, 0, 'L');
    }

    function is($is)
    {
        $this->SetFont('Arial', '', '10');
        $this->Cell(3, 7, $is, 0, 0, 'L');
    }

    function desc1($desc)
    {
        $this->SetFont('Arial', '', '10');
        $this->Cell(51, 7, $desc, 0, 0, 'L');
    }

    function desc2($desc)
    {
        $this->SetFont('Arial', '', '10');
        $this->Cell(170, 10, $desc, 1, 0, 'L');
    }

    function sender($name)
    {
        $this->SetFont('Arial', '', '10');
        $this->Cell(85, 5, $name, 0, 0, 'L');
    }

    function date($date)
    {
        $this->SetFont('Arial', '', '10');
        $this->Cell(85, 5, $date, 0, 0, 'R');
    }

    function comment($comment)
    {
        $this->SetFont('Arial', '', '10');
        $this->Cell(170, 5, $comment, 1, 0, 'L');
    }
}
