<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Example extends CI_Controller 
{
    public function index()
    {
       $bellek = $this->checkDiskFull();
       echo $bellek;
    }


    public function folderSize($dir)
    {
        $size = 0;
		foreach (glob(rtrim($dir, '/').'/{,.}*', GLOB_MARK|GLOB_BRACE) as $each) {
			if(substr($each, -3) == '..\\' || substr($each, -2) == '.\\')
				continue;
			$size += is_file($each) ? filesize($each) : $this->folderSize($each);
		}
		return $size;
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