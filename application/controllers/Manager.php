<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends CI_Controller 
{
    public function index()
    {
        $this->load->view('admin/v_manager_vw');
    }
}
