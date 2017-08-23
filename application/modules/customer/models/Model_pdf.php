<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pdf extends CI_Model {

    function _mpdf($judul='',$isi='',$lMargin='',$rMargin='',$font=0,$orientasi='',$ada_halaman='', $hal='') {
        
        ini_set("memory_limit","512M");
        $this->load->library('mpdf');
        
        /*
        $this->mpdf->progbar_altHTML = '<html><body>
	                                    <div style="margin-top: 5em; text-align: center; font-family: Verdana; font-size: 12px;"><img style="vertical-align: middle" src="'.base_url().'images/loading.gif" /> Creating PDF file. Please wait...</div>';        
        $this->mpdf->StartProgressBarOutput();
        */
        
        $this->mpdf->defaultheaderfontsize = 6;	/* in pts */
        $this->mpdf->defaultheaderfontstyle = BI;	/* blank, B, I, or BI */
        $this->mpdf->defaultheaderline = 1; 	/* 1 to include line below header/above footer */

        $this->mpdf->defaultfooterfontsize = 6;	/* in pts */
        $this->mpdf->defaultfooterfontstyle = BI;	/* blank, B, I, or BI */
        $this->mpdf->defaultfooterline = 1; 
        $this->mpdf->SetLeftMargin = $lMargin;
        $this->mpdf->SetRightMargin = $rMargin;
        //$this->mpdf->SetHeader('SIMAKDA||');
        
        if ($hal==''){
            $hal1=1;
        } 
        if($hal!=''){
            $hal1=$hal;
        }
        if($ada_halaman == "y"){
            $this->mpdf->SetHeader('||Page {PAGENO} / {nb}|');
        }
        
        
        $jam = date("H:i:s");
        //$this->mpdf->SetFooter('Printed on @ {DATE j-m-Y H:i:s} |Simakda| Page {PAGENO} of {nb}');
       // $this->mpdf->SetFooter('Printed on @ {DATE j-m-Y H:i:s} |Halaman {PAGENO} / {nb}| ');
        
        $this->mpdf->AddPage($orientasi,'',$hal1,'1','off',$lMargin,$rMargin);
        
        if (!empty($judul)) $this->mpdf->writeHTML($judul);
        $this->mpdf->writeHTML($isi);         
        $this->mpdf->Output();
    }
    
     function mpdf_($judul='',$isi='',$lMargin='',$rMargin='',$tMargin='',$bMargin='',$font=0,$orientasi='',$ada_halaman='', $hal='') {
        
        ini_set("memory_limit","512M");
        $this->load->library('mpdf');
        $mpdf = new mPDF('utf-8', 'A4-P');
        if ($hal==''){
            $hal1=1;
        } 
        if($hal!=''){
            $hal1=$hal;
        }
        if($ada_halaman == "y"){
            $mpdf->SetHeader('||Page {PAGENO} / {nb}|');
        }
        
        
        $jam = date("H:i:s");
        //$this->mpdf->SetFooter('Printed on @ {DATE j-m-Y H:i:s} |Simakda| Page {PAGENO} of {nb}');
       // $this->mpdf->SetFooter('Printed on @ {DATE j-m-Y H:i:s} |Halaman {PAGENO} / {nb}| ');

        $mpdf->AddPage($orientasi,'',$hal1,'1','off',$lMargin,$rMargin,$tMargin,$bMargin);
        
        if (!empty($judul)) $mpdf->writeHTML($judul);
        //$html = mb_convert_encoding($isi, 'UTF-8', 'UTF-8');
        //$this->mpdf->writeHTML();
        $mpdf->writeHTML($isi);         
        $mpdf->Output();
               
    }
    
    function mpdf_attach($judul='Mypdf',$isi='',$lMargin='',$rMargin='',$tMargin='',$bMargin='',$font=0,$orientasi='',$ada_halaman='', $hal='') {
        
        ini_set("memory_limit","512M");
        $this->load->library('mpdf');
        $mpdf = new mPDF('utf-8', 'A4-P');
        if ($hal==''){
            $hal1=1;
        } 
        if($hal!=''){
            $hal1=$hal;
        }
        if($ada_halaman == "y"){
            $mpdf->SetHeader('||Page {PAGENO} / {nb}|');
        }
        
        
        $jam = date("H:i:s");
        

        $mpdf->AddPage($orientasi,'',$hal1,'1','off',$lMargin,$rMargin,$tMargin,$bMargin);
        
       // if (!empty($judul)) $mpdf->writeHTML($judul);

        $mpdf->writeHTML(utf8_encode($isi));     
        $mpdf->Output(APPPATH.'/file/pdf/'.$judul.'.pdf','F');    
        return APPPATH.'/file/pdf/'.$judul.'.pdf';
    }
    
    
    function html2pdf($isi='',$title=''){
        $this->load->library('html2pdf');
        try
        {
            $html2pdf = new HTML2PDF('P', 'A4', 'en');
            $html2pdf->setDefaultFont('javiergb');
            $html2pdf->pdf->SetDisplayMode('fullpage');
            $html2pdf->writeHTML($isi, isset($_GET['vuehtml']));
            $html2pdf->Output($title.'.pdf');
        }
        catch(HTML2PDF_exception $e){
            echo $e;
            exit;
        }
    }
}
