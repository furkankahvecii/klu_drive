<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Example extends CI_Controller 
{
    public function index()
    {
       $bellek = $this->config->item('base_file')."personal";
       echo $bellek;
    }


    

    public function checkDiskFull(){
        $_SESSION['FOLDER_SIZE_BYTE'] = $this->folderSize($this->config->item('base_file')."personal");
        $folderByte = number_format($_SESSION['FOLDER_SIZE_BYTE'] / pow(2,20), 2);
        $_SESSION['FOLDER_SIZE_MB'] = $folderByte;

        if($_SESSION['UPLOAD_MAX_SIZE'] - ($_SESSION['UPLOAD_MAX_SIZE'] / 100) <= ( $_SESSION['FOLDER_SIZE_MB']+1))
            $bellek = '1K';
        else{
            $bellek = $_SESSION['UPLOAD_MAX_SIZE'] - $_SESSION['FOLDER_SIZE_MB'];
            $bellek = $bellek<0 ? '1K' : $bellek."M";
        }
        return $bellek;
    }
   
}