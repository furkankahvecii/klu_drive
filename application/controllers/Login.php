<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
{
    public function index()
    {
        if(isset($_SESSION['ROL']) && $_SESSION['ROL'] == 1){
            redirect(base_url()."PersonalDrive");
        }
        elseif(isset($_SESSION['ROL']) && $_SESSION['ROL'] == 2){
            redirect(base_url()."OgrenciDrive");
        }
        $this->load->view('login/v_login');
    }

    public function LoginControl()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $this->db_drive->control($email,$password);
        $this->load->view('login/v_login');
    }
   
}