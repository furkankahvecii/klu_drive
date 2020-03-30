<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ShareFolder extends CI_Controller 
{
    public function index()
    {
        
    }

    public function ShareFakBol()
    {
        $array[] = array("FAK_ID" => 5,  "FAK_AD" => "MÜHENDİSLİK FAKÜLTESİ", "PROG_ID" =>716026, "PROG_AD"=> "YAZILIM MÜHENDİSLİĞİ", "YIL" => 4);
        $array[] = array("FAK_ID" => 56, "FAK_AD" => "LÜLEBURGAZ MESLEK YÜKSEKOKULU", "PROG_ID" =>561300, "PROG_AD"=> "BİLGİSAYAR PROGRAMCILIĞI", "YIL" => 2);
        $array[] = array("FAK_ID" => 56, "FAK_AD" => "LÜLEBURGAZ MESLEK YÜKSEKOKULU", "PROG_ID" =>566600, "PROG_AD"=> "BİLGİSAYAR PROGRAMCILIĞI (İÖ)", "YIL" => 2);
        $array[] = array("FAK_ID" => 56, "FAK_AD" => "LÜLEBURGAZ MESLEK YÜKSEKOKULU", "PROG_ID" =>716241, "PROG_AD"=> "BİLGİSAYAR PROGRAMCILIĞI (UZAKTAN ÖĞRETİM)", "YIL" => 2);
        $array[] = array("FAK_ID" => 82, "FAK_AD" => "FEN BİLİMLERİ ENSTİTÜSÜ", "PROG_ID" =>"5388", "PROG_AD"=> "ELEKTRİK ELEKTRONİK MÜHENDİSLİĞİ TEZLİ YÜKSEKLİSANS", "YIL" => 4);
        $result['fakBol'] = $array;
        $result['STATUS'] = "true";
        echo json_encode($result);
    }

    public function ShareFakBolSinif()
    {
        $status       = array(
            "STATUS" => "true",
        );
        echo json_encode($status);
    }
}