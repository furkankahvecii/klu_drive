<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
                'roots' => array(
                    array( 
                        'driver'        => 'LocalFileSystem',
                        'path'          =>  APPPATH.'/files',
                        'URL'           => "",
                        'uploadDeny'    => array('all'),                  // All Mimetypes not allowed to upload
                        'uploadAllow'   => array('image', 'text/plain', 'application/pdf'),// Mimetype `image` and `text/plain` allowed to upload
                        'uploadOrder'   => array('deny', 'allow'),        // allowed Mimetype `image` and `text/plain` only    
                        'uploadOverwrite' => false,    //true - replace old files, false give new names like original_name-number.ext
                        'tmbURL'        => 'self',
                        //'imgLib'      => 'imagick',
                        //'tmbSize'       => 200,
                        'utf8fix'       => true,
                        'tmbCrop'       => false,
                        'tmbBgColor'    => 'transparent'
                        // more elFinder options here
                    ) 
                ),                
            );