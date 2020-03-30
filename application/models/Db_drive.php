<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Db_drive extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function control($email,$password)
  {
    if($email == "personal" && $password == "personal")
    {
        $personelSession = array(
            'ROL'  => 1,
            'ADI'   =>  'personal',
            'FOLDER_SIZE_MB' => 0,
            'EMAIL' => "furkankahveci@klu.edu.tr",
            "EMAIL_PARTONE" => "furkankahveci",
            'UPLOAD_MAX_SIZE' => 500,
            'FOLDER_SIZE_MB' => 0,
            'FOLDER_SIZE_BYTE' => 0,
        );
        $this->session->set_userdata($personelSession);
        redirect(base_url()."PersonalDrive");

    }
    elseif($email == "student" && $password == "student"){
        $personelSession = array(
            'ROL'  => 2,
            'ADI'   =>  'student',
        );
        $this->session->set_userdata($personelSession);
        redirect(base_url()."OgrenciDrive");
    }
    elseif($email == "admin" && $password == "admin"){
        $personelSession = array(
            'ROL'  => 3,
            'ADI'   =>  'admin',
        );
        $this->session->set_userdata($personelSession);
        redirect(base_url()."AddManager");
    }
  }

}
