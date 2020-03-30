<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Example extends CI_Controller 
{
    public function index()
    {
        $totalspace = $this->getFolderSize($this->config->item('base_file')."personal");
        $a = number_format($totalspace / pow(2,20), 2);
        echo $a;
    }


    function getFolderSize($directory){
        $totalSize = 0;
        $directoryArray = scandir($directory);

        foreach($directoryArray as $key => $fileName){
            if($fileName != ".." && $fileName != "."){
                if(is_dir($directory . "/" . $fileName)){
                    $totalSize = $totalSize + $this->getFolderSize($directory . "/" . $fileName);
                } else if(is_file($directory . "/". $fileName)){
                    $totalSize = $totalSize + filesize($directory. "/". $fileName);
                }
            }
        }
        return $totalSize;
    }

    public function checkDiskFull(){
        $_SESSION['FOLDER_SIZE_BYTE'] = $this->getFolderSize($this->config->item('base_file')."personal");
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