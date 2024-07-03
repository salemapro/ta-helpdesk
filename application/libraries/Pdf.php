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
        $this->Image($logo, 10, 10, 30, 25);
    }
}
