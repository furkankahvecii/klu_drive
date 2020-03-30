<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AddManager extends CI_Controller 
{
    public function index()
    {
        $this->load->view('admin/v_addManager');
    }

    public function control()
    {
        $email         = $this->input->post('mailAdress');
        $status       = array(
            "STATUS" => "false"
        );

 
        if($email == "furkankahveci@klu.edu.tr")
        {
            $status = array(
                "STATUS" => "true",
                "NAME"     => "FURKAN",
                "SURNAME" => "KAHVECİ",
                "UNVAN"     => "Ögrenci",
                "AKTIF" => "Aktif",
                "OGRENCI_TIP" => "Birinci Öğretim",
                "BRANS" => "Yazılım",
                "EPOSTA" => "EPOSTA",
                "GSM1"     => "GSM1",
                "FAK_AD" => "MÜHENDİSLİK FAKÜLTESİ",
                "BOL_AD" => "YAZILIM MÜHENDİSLİĞİ",
                "PROG_AD"     => "YAZILIM MÜHENDİSLİĞİ"
            );
        }
        
        echo json_encode($status);
    }

    public function addDatabase()
    {
        $email = $this->input->post('email');
        $size = $this->input->post('size');
        $data['mesaj'] = "accept";
        $data['email'] = $email;
        $data['size'] =  $size;
        $this->load->view('admin/v_addManager',$data); 
    }
    
  

    public function Back(){
        $_SESSION['ROL'] = 3;
        redirect(base_url()."AddManager");
    }
}
