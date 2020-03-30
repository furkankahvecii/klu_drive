<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PersonalDrive extends CI_Controller 
{
    public function index()
    {
        if(empty($_SESSION['ADI'])){
            redirect(base_url());
        }
        $data['connector'] = site_url() . 'PersonalDrive/connector/';
        $this->load->view('personal/personal_v',$data);
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

    function myPreCheck($cmd, &$result, $args, $elfinder, $volume) {

        if($_SESSION['UPLOAD_MAX_SIZE'] - $_SESSION['FOLDER_SIZE_MB'] > 0){
            $result['sync'] = 1; // to force refresh cwd
        }
        else{
            $_SESSION['UPLOAD_MAX_SIZE'] = 0;
            $args['FILES'] = array(); // argüment olarak gönderilen dosyayı temizlemek.
            return array(
                'preventexec' => true,
                'results' => array('error' => true)
            );
        }  
    }
    

    public function connector()
    {
        $bellek = $this->checkDiskFull();
        $opts = array(
            'plugin' => array(
                'AutoResize' => array(
                    'enable' => true,
                    'maxWidth'  => 1200,
                    'maxHeight'  => 1200,
                    'quality' => 95
                ),
                'Sanitizer' => array(
                    'enable' => true,
                    'callBack' => function($name, $options) {
                        $ext = '';
                        $pos = strrpos($name, '.');
                        if ($pos !== false) {
                            $ext = substr($name, $pos);
                            $name = substr($name, 0, $pos);
                        }
                        return str_replace('.', '_', $name) . $ext;
                    }
                ),
                'Normalizer' => array(
                    'convmap' => array(
                        ' ' => '_',
                        ',' => '_',
                        '^' => '_',
                        ',' => '_',
                        'à' => 'a',
                        'ä' => 'a',
                        'é' => 'e',
                        'è' => 'e',
                        'ü' => 'u',
                        'ö' => 'o',
                        'ı' => 'i',
                        "ğ" => 'g',
                        "ü" => 'u',
                        "ş" => 's',
                        "ö" => 'o',
                        "ç" => 'c'
                    )
                ),
                ),
        'roots' => array(
                array( 
                    'driver'        => 'LocalFileSystem',
                    'path'          => $this->config->item('base_file').'personal',
                    'URL'           => base_url(),
                    'trashHash'       => 't1_Lw',
                    'uploadMaxSize' => $bellek,
                    'uploadDeny'    => array('text/x-php'),                  // All Mimetypes not allowed to upload
                    'uploadAllow'   => array('all'),// 'image', 'text/plain', 'application/pdf' Mimetype `image` and `text/plain` allowed to upload
                    'uploadOrder'   => array('deny', 'allow'),        // allowed Mimetype `image` and `text/plain` only
                    'accessControl' => array($this, 'elfinderAccess'),// disable and hide dot starting files (OPTIONAL)
                    // more elFinder options here
                ),
                // Trash volume
                array(
                    'id'            => '1',
                    'driver'        => 'Trash',
                    'path'          => $this->config->item('base_file')."user/.trash",
                    'tmbURL'        => $this->config->item('base_file')."user/.trash/.tmb",
                    'winHashFix'    => DIRECTORY_SEPARATOR !== '/', // to make hash same to Linux one on windows too
                    'uploadDeny'    => array('text/x-php'),                // Recomend the same settings as the original volume that uses the trash
                    'uploadAllow'   => array('all'), // Same as above
                    'uploadOrder'   => array('deny', 'allow'),      // Same as above
                    'accessControl' => array($this, 'elfinderAccess'),                    // Same as above
                )
            ),
            'bind' => array(
                //'duplicate.pre archive' => array($this,'myPreCheck'),
                'upload paste duplicate extract rm archive' => array($this,'myPreCheck'),
                'upload.pre mkdir.pre mkfile.pre rename.pre archive.pre ls.pre' => array(
                    'Plugin.Sanitizer.cmpdPreprocess',
                    'Plugin.Normalizer.cmdPreprocess'
                ),
                'ls' => array(
                    'Plugin.Sanitizer.cmdPostprocess',
                    'Plugin.Normalizer.cmdPostprocess'
                ),
                'upload.presave' => array(
                    'Plugin.Sanitizer.onUpLoadPreSave',
                    'Plugin.Normalizer.onUpLoadPreSave'
                )
            ),      
            );
        $connector = new elFinderConnector(new elFinder($opts));
        $connector->run();
    }

    public function elfinderAccess($attr, $path, $data, $volume, $isDir, $relpath)
    {
        $basename = basename($path);
        return $basename[0] === '.' && strlen($relpath) !== 1  ? !($attr == 'read' || $attr == 'write')  : null;                      
    }

    public function AjaxForElfinder()
    {
        $fileName = $this->input->post('nameFile');
        $status       = array(
            "STATUS" => "true"
        );
        if($this->db_personel->FindSharedFile($_SESSION['EMAIL_PARTONE']."/".$fileName))
        {
            $this->db_personel->PaylasaEkle($_SESSION['EMAIL_PARTONE']."/".$fileName);
            $status       = array(
                "STATUS" => "true"
            );

        }
        else{
            $status       = array(
                "STATUS" => "false"
            );
        }

        echo json_encode($status);
    }

    public function AdmintoDrive()
    {
        if($_SESSION['ROL'] == 3)
        $_SESSION['ROL'] = 1;
        redirect(base_url()."PersonalDrive");
    }

    public function DriveKontrol()
    {
        $kalan = number_format(500 - $_SESSION['FOLDER_SIZE_MB'], 2, '.', '');
        $status['kalan_limit'] =$kalan < 0 ? 0 : $kalan;
        echo json_encode($status);
    }

}