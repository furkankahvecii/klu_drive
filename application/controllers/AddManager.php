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

 
        if($email == "esguner@klu.edu.tr")
        {
            $status = array(
                "STATUS" => "true",
                "NAME"     => "EDİP SERDAR",
                "SURNAME" => "GÜNER",
                "UNVAN"     => "Dr. Öğr. Üyesi",
                "AKTIF" => "Aktif",
                "PERSONEL_TIP" => "Üniversite Personeli",
                "BRANS" => "Yazılım",
                "EPOSTA" => "EPOSTA",
                "GSM1"     => "GSM1",
                "FAK_AD" => "MÜHENDİSLİK FAKÜLTESİ",
                "BOL_AD" => "ELEKTRİK-ELEKTRONİK MÜHENDİSLİĞİ",
                "PROG_AD"     => "ELEKTRİK-ELEKTRONİK MÜHENDİSLİĞİ"
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
