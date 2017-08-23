<?php
class Crptcas extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('cas/Mdata');
        $this->load->model('cas/Model_pdf');
        $this->load->library('Sesi_login');
		if($this->sesi_login->log_session() !=TRUE){
			redirect('login/login');
			return false;
		}
    }
    
    function rpt_ImportStatusProses(){
        if($this->input->post('text')==''){
            exit();
        }
        
        $arr_data   =explode("|",$this->input->post('text'));
        $cetak      =$arr_data[0];
        $id         =$arr_data[1];
        
        $where='';
//        if($per==1){
//            $where="and year(f.Mulai) = '$tahun'";
//        }
//        if($per==2){
//            $where="and month(f.Mulai)= '$bulan' and year(f.Mulai) = '".date("Y")."'";
//        }
//        if($per==3){
//            $where="and f.Mulai BETWEEN '$tanggal1' and '$tanggal2'";
//        }
//        if($per==4){
//            $where="and f.Mulai = '$tanggal'";
//        }
        
      //  echo 'per :'.$per.','.'cetak :'.$cetak.','.'tahun :'.$tahun.','.'bulan :'.$bulan.','.'tgl1 :'.$tanggal1.','.'tgl2 :'.$tanggal2.','.'tgl :'.$tanggal.'pt :'.$pt;
        $cRet = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                     <thead>                       
                        <tr><td bgcolor=\"#CCCCCC\" width=\"3%\" align=\"center\"><b>HAWB</b></td>                            
                            <td bgcolor=\"#CCCCCC\" width=\"10%\" align=\"center\"><b>DATE</b></td>
                            <td bgcolor=\"#CCCCCC\" width=\"20%\" align=\"center\"><b>NOTE</b></td>
                            <td bgcolor=\"#CCCCCC\" width=\"15%\" align=\"center\"><b>STATUS PROSES</b></td>  
                        </tr>
                        
                     </thead>
                     <tfoot>
                        <tr>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>                       
                         </tr>
                     </tfoot>
                    ";
        
        $sql4="
        SELECT Hawb,date(DateUpdate) as DateUpdate,Note,a.StatusProses,a.IdImport,a.ModifDate 
        FROM dstatusproses a LEFT JOIN statusproses b ON a.IdStatusProses=b.Noid 
        WHERE IdImport = '$id'
        ";
                 
        $query4 = $this->db->query($sql4);
        $no     = 0;                                  
        
        foreach ($query4->result() as $row4)
        {
            $no=$no+1;
           $hawb             = $row4->Hawb;
           $date            = $this->Mdata->tanggal_format_indonesia($row4->DateUpdate);
           $note            = $row4->Note;
           $sts               = $row4->StatusProses;
           
                     $cRet    .= "<tr>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$hawb</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$date</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$note</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$sts</td>
                                 </tr>";
        }
        
        $cRet   .= "</table>";
        
        $data['prev']= $cRet;
        $data['sikap'] = 'preview';
        $judul  = 'Cetak History Inmport Status Proses';
        //$this->template->set('title', 'Cetak History Inmport Status Proses');        
        switch($cetak) {       
        case 1;
             $this->Model_pdf->_mpdf('',$cRet,10,10,10,'1','y');
        break;
        case 2;        
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('cas/rpt/ctk', $data);
        break;
        case 3;     
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-word");
            header("Content-Disposition: attachment; filename= $judul.doc");
            $this->load->view('cas/rpt/ctk', $data);
        break;
        case 4;     
            echo json_encode(array('status'=>true,'isi'=>$cRet));
        break;
        }         
    }
    
    
    function rpt_ImportTypeClerance(){
        if($this->input->post('text')==''){
            exit();
        }
        
        $arr_data   =explode("|",$this->input->post('text'));
        $cetak      =$arr_data[0];
        $id         =$arr_data[1];
        
        $where='';
//        if($per==1){
//            $where="and year(f.Mulai) = '$tahun'";
//        }
//        if($per==2){
//            $where="and month(f.Mulai)= '$bulan' and year(f.Mulai) = '".date("Y")."'";
//        }
//        if($per==3){
//            $where="and f.Mulai BETWEEN '$tanggal1' and '$tanggal2'";
//        }
//        if($per==4){
//            $where="and f.Mulai = '$tanggal'";
//        }
        
      //  echo 'per :'.$per.','.'cetak :'.$cetak.','.'tahun :'.$tahun.','.'bulan :'.$bulan.','.'tgl1 :'.$tanggal1.','.'tgl2 :'.$tanggal2.','.'tgl :'.$tanggal.'pt :'.$pt;
        $cRet = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                     <thead>                       
                        <tr><td bgcolor=\"#CCCCCC\" width=\"3%\" align=\"center\"><b>HAWB</b></td>                            
                            <td bgcolor=\"#CCCCCC\" width=\"10%\" align=\"center\"><b>DATE</b></td>
                            <td bgcolor=\"#CCCCCC\" width=\"20%\" align=\"center\"><b>NOTE</b></td>
                            <td bgcolor=\"#CCCCCC\" width=\"15%\" align=\"center\"><b>TYPE CLEARANCE</b></td>  
                        </tr>
                        
                     </thead>
                     <tfoot>
                        <tr>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>                       
                         </tr>
                     </tfoot>
                    ";
        
        $sql4="
        SELECT Hawb,DATE(DateUpdate) AS DateUpdate,Note,a.TypeClearance,a.IdImport,a.ModifDate 
        FROM dtypeclearance a LEFT JOIN mstypeclearance b ON a.IdTypeClearance=b.noid 
        WHERE IdImport = '$id'
        ";
                 
        $query4 = $this->db->query($sql4);
        $no     = 0;                                  
        
        foreach ($query4->result() as $row4)
        {
            $no=$no+1;
           $hawb             = $row4->Hawb;
           $date            = $this->Mdata->tanggal_format_indonesia($row4->DateUpdate);
           $note            = $row4->Note;
           $sts               = $row4->TypeClearance;
           
                     $cRet    .= "<tr>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$hawb</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$date</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$note</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$sts</td>
                                 </tr>";
        }
        
        $cRet   .= "</table>";
        
        $data['prev']= $cRet;
        $data['sikap'] = 'preview';
        $judul  = 'Cetak History Inmport Status Proses';
        //$this->template->set('title', 'Cetak History Inmport Status Proses');        
        switch($cetak) {       
        case 1;
             $this->Model_pdf->_mpdf('',$cRet,10,10,10,'1','y');
        break;
        case 2;        
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= $judul.xls");
            $this->load->view('cas/rpt/ctk', $data);
        break;
        case 3;     
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-word");
            header("Content-Disposition: attachment; filename= $judul.doc");
            $this->load->view('cas/rpt/ctk', $data);
        break;
        case 4;     
            echo json_encode(array('status'=>true,'isi'=>$cRet));
        break;
        }         
    }
    
}


