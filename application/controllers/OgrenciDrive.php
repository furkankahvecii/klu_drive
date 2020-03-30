<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OgrenciDrive extends CI_Controller 
{
    public function index()
    {   
        $data['connector'] = site_url() . 'OgrenciDrive/connector/'; 
        $this->load->view('ogrenci/ogrenci_v',$data);
    }

    public function connector()
    {       
        $opts = array( 'roots' => array( ),  );    
        array_push($opts['roots'],
            array (
                'driver'        => 'LocalFileSystem',
                'path'          => BASEPATH . 'data/personal';
                'URL'           => base_url(), 
                'uploadMaxSize' => '1KB', 
                'uploadDeny'    => array('all'),   
                'keepTimestamp'  => array(''),          
                'uploadAllow'   => array(''),
                'uploadOrder'   => array('deny', 'allow'), 
                'disabled' => array('share') ,  
                'accessControl' => array($this, 'elfinderAccess'),// disable and hide dot starting files (OPTIONAL)
                'attributes' => array(
                    array(
                        'pattern' => '/^.+/',
                        'read'    => true,
                        'write'   => false,
                        'locked'  => true                      
                    ),                 
                )
            )
        );
      

        $connector = new elFinderConnector(new elFinder($opts));
        $connector->run();
    }

    public function elfinderAccess($attr, $path, $data, $volume, $isDir, $relpath)
    {
        $basename = basename($path);
        return $basename[0] === '.' && strlen($relpath) !== 1  ? !($attr == 'read' || $attr == 'write')  : null;                      
    }

    function myPreCheck($cmd, &$result, $args, $elfinder, $volume) {
        $args['FILES'] = array(); // argüment olarak gönderilen dosyayı temizlemek.
    }
}