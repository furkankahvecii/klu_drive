<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ogrenci extends CI_Controller 
{
    public function index()
    {
        $data['shared'] = $this->db_ogrenci->PaylasilanGetir();
        $this->load->view('ogrenci',$data);
    }
}
