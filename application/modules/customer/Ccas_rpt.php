<?php
class Ccas_rpt extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('cas/Mdata');
         $this->load->model('cas/Model_pdf');
         $this->load->model('user/Model_user');
        $this->load->library('Sesi_login');
		if($this->sesi_login->log_session() !=TRUE){
			redirect('login/login');
			return false;
		}
        date_default_timezone_set('Asia/Jakarta');
    }
    
    function v_status_last_track(){
         $data=array(
		  'title'=>'Report Status Tracking',
		  'modulname'=>'REPORT STATUS TRACKING',
          'ismenu'=>'1',
		  'menu'=>'front/Menu/rate_menu',
		  'content'=>'cas/Cas_rpt/rpt_status_tracking',
		  );
        $this->load->view('template/template',$data);
    }
    
    function rpt_status_last_track(){
        if($this->input->post('text')==''){
            exit();
        }
        
        $arr_data   =explode("|",$this->input->post('text'));
        $cetak      =$arr_data[0];
        $tgl1       =$arr_data[1];
        $tgl2       =$arr_data[2];
        $tlc_a      =$arr_data[3];
        $per        =$arr_data[4];
        $group      ='GROUP BY a.hawb';
        
        $where='';
        
        $arr_tlc    =explode(",",$tlc_a);
        $tlc        ='(';
        $nu         =0;
        foreach($arr_tlc as $key) {    
            if($nu==0){$tlc .= "'".$key."'";}else{$tlc .= ","."'".$key."'";}
            $nu=$nu+1;    
        }        
        $tlc        .=')';
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
                        <tr><td bgcolor=\"#CCCCCC\"  align=\"center\"><b>No</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>MAWB</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>HAWB</b></td>";                           
         if($per==1){
         $cRet .= "         <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACING NO</b></td>";
         $group      ='';
         }
         $cRet .= "
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>FLIGHT DATE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CLEARANCE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CLEARANCE PMK 182</b></td>  
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>KIND OF GOOD</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>WEIGHT</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>PACKAGE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>VALUE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TLC</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACKING</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACKING DATE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER NAME</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER ADDRESS1</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER ADDRESS2</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER CITY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER COMPANY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE NAME</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE ADDRESS</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE CITY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE COMPANY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE PHONE</b></td>
                        </tr>
                        
                     </thead>
                     <tfoot>
                        <tr><td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>";                           
         if($per==1){
         $cRet .= "         <td style=\"border-top: none;\"></td>";
         }
         $cRet .= "
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>                       
                         </tr>
                     </tfoot>
                    ";
        
       $sql4="
       SELECT 
	   a.mawb,a.hawb,b.trackno,a.flight_date,c.Keterangan AS clearance,a.kindofGood,a.Weight,a.Package,
	   a.shipper_name,a.shipper_address1,a.shipper_address2,a.shipper_city,a.shipper_company,
	   a.consignee_name,a.consignee_address,a.consignee_city,a.consignee_country,a.consignee_phone,
	   d.CodeStatus,d.Keterangan,a.TrackingDate,a.kindofGood,e.UR_JNS,e.ket,a.FOB
       FROM t_shipment_cloud a 
       INNER JOIN t_bill b ON a.hawb=b.hawb
       LEFT JOIN tm_typeclearance c ON a.type_clearance=c.TypeClearance
       LEFT JOIN statusproses d ON a.TrackingStatus=d.Noid
       LEFT JOIN bc_m_jns_aju e ON a.Id_aju=e.id_aju
       WHERE a.TrackingStatus in $tlc AND a.flight_date BETWEEN '$tgl1' AND '$tgl2' $group order by a.flight_date
       ";
                 
        $query4 = $this->db->query($sql4);
        $no     = 0;                                  
        
        foreach ($query4->result() as $row4)
        {
           $no=$no+1;           
                     $cRet    .= "<tr><td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$no</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->mawb</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->hawb</td>";                           
                     if($per==1){
                     $cRet .= "      <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->trackno</td>";
                     }
                     $cRet .= "
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->flight_date</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->clearance</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->UR_JNS - $row4->ket</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->kindofGood</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" align=\"right\">$row4->Weight</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" align=\"right\">$row4->Package</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" align=\"right\">$row4->FOB</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->CodeStatus</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->Keterangan</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->TrackingDate</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_name</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_address1</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_address2</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_city</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_company</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_name</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_address</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_city</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_country</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_phone</td>
                                 </tr>";
        }
        
        $cRet   .= "</table>";
        
        $data['prev']= $cRet;
        $data['sikap'] = 'preview';
        $judul  = 'Cetak_Last_Status_Tracking';
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
    
    function v_rpt_manifest(){
         $data=array(
		  'title'=>'Report Manifest',
		  'modulname'=>'REPORT MANIFEST',
          'ismenu'=>'1',
		  'menu'=>'front/Menu/rate_menu',
		  'content'=>'cas/Cas_rpt/rpt_manifest',
		  );
        $this->load->view('template/template',$data);
    }
    
    function rpt_manifest(){
        if($this->input->post('text')==''){
            exit();
        }
        
        $arr_data   =explode("|",$this->input->post('text'));
        $cetak      =$arr_data[0];
        $tgl1       =$arr_data[1];
        $tgl2       =$arr_data[2];
        $per        =$arr_data[3];
        $group      ='GROUP BY a.hawb';
        
        $where='';
        $cRet = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                     <thead>                       
                        <tr><td bgcolor=\"#CCCCCC\"  align=\"center\"><b>NO</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>MAWB</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>HAWB</b></td>";                           
         if($per==1){
         $cRet .= "         <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACING NO</b></td>";
         $group      ='';
         }
         $cRet .= "
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>FLIGHT DATE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CLEARANCE</b></td>  
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CLEARANCE PMK 182</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>KIND OF GOOD</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>WEIGHT</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>PACKAGE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>VALUE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TLC</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACKING</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACKING DATE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACKING REMARK</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER NAME</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER ADDRESS1</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER ADDRESS2</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER CITY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER COMPANY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE NAME</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE ADDRESS</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE CITY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE COMPANY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE PHONE</b></td>
                        </tr>
                        
                     </thead>
                     <tfoot>
                        <tr><td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>";                           
         if($per==1){
         $cRet .= "         <td style=\"border-top: none;\"></td>";
         }
         $cRet .= "
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>                       
                         </tr>
                     </tfoot>
                    ";
        
       $sql4="
       SELECT 
	   a.mawb,a.hawb,b.trackno,a.flight_date,c.Keterangan AS clearance,a.kindofGood,a.Weight,a.Package,
	   a.shipper_name,a.shipper_address1,a.shipper_address2,a.shipper_city,a.shipper_company,
	   a.consignee_name,a.consignee_address,a.consignee_city,a.consignee_country,a.consignee_phone,
	   d.CodeStatus,d.Keterangan,a.TrackingDate,a.kindofGood,e.UR_JNS,e.ket,a.FOB,TrackingRemark
       FROM t_shipment_cloud a 
       INNER JOIN t_bill b ON a.hawb=b.hawb
       LEFT JOIN tm_typeclearance c ON a.type_clearance=c.TypeClearance
       LEFT JOIN statusproses d ON a.TrackingStatus=d.Noid
       LEFT JOIN bc_m_jns_aju e ON a.Id_aju=e.id_aju
       WHERE a.flight_date BETWEEN '$tgl1' AND '$tgl2' $group order by a.flight_date
       ";
                 
        $query4 = $this->db->query($sql4);
        $no     = 0;                                  
        
        foreach ($query4->result() as $row4)
        {
           $no=$no+1;           
                     $cRet    .= "<tr><td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$no</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->mawb</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->hawb</td>";                           
                     if($per==1){
                     $cRet .= "      <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->trackno</td>";
                     }
                     $cRet .= "
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->flight_date</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->clearance</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->UR_JNS - $row4->ket</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->kindofGood</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" align=\"right\">$row4->Weight</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" align=\"right\">$row4->Package</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" align=\"right\">$row4->FOB</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->CodeStatus</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->Keterangan</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->TrackingDate</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->TrackingRemark</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_name</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_address1</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_address2</td>                                    
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_city</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_company</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_name</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_address</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_city</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_country</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_phone</td>
                                 </tr>";
        }
        
        $cRet   .= "</table>";
        
        $data['prev']= $cRet;
        $data['sikap'] = 'preview';
        $judul  = 'Cetak_Manifest';
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


    function v_rpt_manifest_last_ticket(){
         $data=array(
		  'title'=>'Report Manifest Last Ticket',
		  'modulname'=>'REPORT MANIFEST LAST',
          'ismenu'=>'1',
		  'menu'=>'front/Menu/rate_menu',
		  'content'=>'cas/Cas_rpt/rpt_manifest_last_ticket',
		  );
        $this->load->view('template/template',$data);
    }
    
    function rpt_manifest_last_ticket(){
        if($this->input->post('text')==''){
            exit();
        }
        
        $arr_data   =explode("|",$this->input->post('text'));
        $cetak      =$arr_data[0];
        $tgl1       =$arr_data[1];
        $tgl2       =$arr_data[2];
        $per        =$arr_data[3];
        $group      ='GROUP BY a.hawb';
        
        $where='';
        $cRet = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                     <thead>                       
                        <tr><td bgcolor=\"#CCCCCC\"  align=\"center\"><b>NO</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>MAWB</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>HAWB</b></td>";                           
         if($per==1){
         $cRet .= "         <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACING NO</b></td>";
         $group      ='';
         }
         $cRet .= "
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>FLIGHT DATE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CLEARANCE</b></td>  
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CLEARANCE PMK 182</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE NAME</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>KIND OF GOOD</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>WEIGHT</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>PACKAGE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>VALUE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TLC</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACKING</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACKING DATE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACKING REMARK</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>DATE CONTACT</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>OUTCOME</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>ACTION BY CAS</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>ACTION BY UPS</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CALL BEGIN</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CALL END</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CREATE BY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>STATUS TICKET</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>REMARK TICKET</b></td>
                        </tr>
                        
                     </thead>
                     <tfoot>
                        <tr><td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>";                           
         if($per==1){
         $cRet .= "         <td style=\"border-top: none;\"></td>";
         }
         $cRet .= "
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>                       
                         </tr>
                     </tfoot>
                    ";
        
       $sql4="
       SELECT 
	   a.mawb,a.hawb,b.trackno,a.flight_date,c.Keterangan AS clearance,a.kindofGood,a.Weight,a.Package,
	   a.shipper_name,a.shipper_address1,a.shipper_address2,a.shipper_city,a.shipper_company,
	   a.consignee_name,a.consignee_address,a.consignee_city,a.consignee_country,a.consignee_phone,
	   d.CodeStatus,d.Keterangan,a.TrackingDate,a.TrackingRemark,a.kindofGood,e.UR_JNS,e.ket,a.FOB
       FROM t_shipment_cloud a 
       INNER JOIN t_bill b ON a.hawb=b.hawb
       LEFT JOIN tm_typeclearance c ON a.type_clearance=c.TypeClearance
       LEFT JOIN statusproses d ON a.TrackingStatus=d.Noid
       LEFT JOIN bc_m_jns_aju e ON a.Id_aju=e.id_aju
       WHERE a.flight_date BETWEEN '$tgl1' AND '$tgl2' $group order by a.flight_date
       ";
                 
        $query4 = $this->db->query($sql4);
        $no     = 0;                                  
        
        foreach ($query4->result() as $row4)
        {


        $sql_="SELECT a.remarks,a.complain_date,a.jam_awal,a.jam_akhir,a.outcome,a.bycas,a.byups,a.UserName,b.name FROM ticket_full_hdr a 
               INNER JOIN ticket_status b ON a.status_id=b.id WHERE a.object_id = '$row4->hawb' ORDER BY complain_date DESC LIMIT 0,1";
        $datecontact = '';
        $outcome = '';
        $byups = '';
        $bycas = '';
        $callbegint = '';
        $callend = '';
        $createby = '';
        $status = '';
        $remark = '';
        $query_ = $this->db->query($sql_);
           foreach ($query_->result() as $row_)
           {
                $datecontact = $row_->complain_date;
                $outcome = $row_->outcome;
                $byups = $row_->byups;
                $bycas = $row_->bycas;
                $callbegint = $row_->jam_awal;
                $callend = $row_->jam_akhir;
                $createby = $row_->UserName;
                $status = $row_->name;
                $remark = $row_->remarks;
            
           }
           $no=$no+1;           
                     $cRet    .= "<tr><td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$no</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->mawb</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->hawb</td>";                           
                     if($per==1){
                     $cRet .= "      <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->trackno</td>";
                     }
                     $cRet .= "
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->flight_date</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->clearance</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->UR_JNS - $row4->ket</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_name</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->kindofGood</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" align=\"right\">$row4->Weight</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" align=\"right\">$row4->Package</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" align=\"right\">$row4->FOB</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->CodeStatus</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->Keterangan</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->TrackingDate</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->TrackingRemark</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$datecontact</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$outcome</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$bycas</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$byups</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$callbegint</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$callend</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$createby</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$status</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$remark</td>
                                 </tr>";
        }
        
        $cRet   .= "</table>";
        
        $data['prev']= $cRet;
        $data['sikap'] = 'preview';
        $judul  = 'Cetak_Manifest';
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


    function v_rpt_donotopenticket(){
         $data=array(
		  'title'=>'Report Manifest',
		  'modulname'=>'REPORT MANIFEST',
          'ismenu'=>'1',
		  'menu'=>'front/Menu/rate_menu',
		  'content'=>'cas/Cas_rpt/rpt_donotopenticket',
		  );
        $this->load->view('template/template',$data);
    }
    
    function rpt_donotopenticket(){
        if($this->input->post('text')==''){
            exit();
        }
        
        $arr_data   =explode("|",$this->input->post('text'));
        $cetak      =$arr_data[0];
        $tgl1       =$arr_data[1];
        $tgl2       =$arr_data[2];
        $per        =$arr_data[3];
        $group      ='GROUP BY a.hawb';
        
        $where='';
        $cRet = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                     <thead>                       
                        <tr><td bgcolor=\"#CCCCCC\"  align=\"center\"><b>NO</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>MAWB</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>HAWB</b></td>";                           
         if($per==1){
         $cRet .= "         <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACING NO</b></td>";
         $group      ='';
         }
         $cRet .= " 
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>FLIGHT DATE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CLEARANCE</b></td> 
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CLEARANCE PMK 182</b></td>  
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>KIND OF GOOD</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>WEIGHT</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>PACKAGE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>VALUE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TLC</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACKING</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACKING DATE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER NAME</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER ADDRESS1</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER ADDRESS2</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER CITY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER COMPANY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE NAME</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE ADDRESS</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE CITY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE COMPANY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE PHONE</b></td>
                        </tr>
                        
                     </thead>
                     <tfoot>
                        <tr><td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>";                           
         if($per==1){
         $cRet .= "         <td style=\"border-top: none;\"></td>";
         }
         $cRet .= "
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>                       
                         </tr>
                     </tfoot>
                    ";
      
       $sqlz="
        SELECT a.object_id as hawb FROM ticket_full_hdr a INNER JOIN t_shipment_cloud b ON a.object_id=b.hawb
        WHERE b.flight_date BETWEEN '$tgl1' AND '$tgl2'
        GROUP BY a.object_id 
        ";
                 
        $queryz     = $this->db->query($sqlz);                                  
        $notinhawb  ='(';
        $nu         =0;
        foreach ($queryz->result() as $rowz)
        {
            if($nu==0){$notinhawb .= "'".$rowz->hawb."'";}else{$notinhawb .= ","."'".$rowz->hawb."'";}
            $nu=$nu+1;
        }
        $notinhawb  .=')';
        
        if($nu==0){$notinhawb  ="('')";}
//=====================================        
        $sqlz="
        SELECT a.Hawb FROM dstatusproses a 
        INNER JOIN statusproses b ON a.IdStatusProses=b.Noid 
        INNER JOIN t_shipment_cloud c ON a.Hawb=c.hawb
        WHERE b.trigger_ticket='1' and c.flight_date BETWEEN '$tgl1' AND '$tgl2'
        GROUP BY a.Hawb
        ";
                 
        $queryz     = $this->db->query($sqlz);                                  
        $rlphawb  ='(';
        $nu         =0;
        foreach ($queryz->result() as $rowz)
        {
            if($nu==0){$rlphawb .= "'".$rowz->Hawb."'";}else{$rlphawb .= ","."'".$rowz->Hawb."'";}
            $nu=$nu+1;
        }
        $rlphawb  .=')';
        
        if($nu==0){$rlphawb  ="('')";}
      
      
        
       $sql4="
       SELECT 
	   a.mawb,a.hawb,b.trackno,a.flight_date,c.Keterangan AS clearance,a.kindofGood,a.Weight,a.Package,
	   a.shipper_name,a.shipper_address1,a.shipper_address2,a.shipper_city,a.shipper_company,
	   a.consignee_name,a.consignee_address,a.consignee_city,a.consignee_country,a.consignee_phone,
	   d.CodeStatus,d.Keterangan,a.TrackingDate,a.kindofGood,e.ket as pmk182,e.UR_JNS,a.FOB
       FROM t_shipment_cloud a 
       INNER JOIN t_bill b ON a.hawb=b.hawb
       LEFT JOIN tm_typeclearance c ON a.type_clearance=c.TypeClearance
       LEFT JOIN statusproses d ON a.TrackingStatus=d.Noid
       LEFT JOIN bc_m_jns_aju e ON a.Id_aju=e.id_aju
       WHERE a.hawb not in $notinhawb  and a.hawb not in $rlphawb and a.flight_date BETWEEN '$tgl1' AND '$tgl2' $group order by a.flight_date
       ";
                 
        $query4 = $this->db->query($sql4);
        $no     = 0;                                  
        
        foreach ($query4->result() as $row4)
        {
           $no=$no+1;           
                     $cRet    .= "<tr><td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$no</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->mawb</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->hawb</td>";                           
                     if($per==1){
                     $cRet .= "      <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->trackno</td>";
                     }
                     $cRet .= "
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->flight_date</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->clearance</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->UR_JNS - $row4->pmk182</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->kindofGood</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->Weight</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->Package</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->FOB</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->CodeStatus</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->Keterangan</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->TrackingDate</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_name</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_address1</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_address2</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_city</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_company</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_name</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_address</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_city</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_country</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_phone</td>
                                 </tr>";
        }
        
        $cRet   .= "</table>";
        
        $data['prev']= $cRet;
        $data['sikap'] = 'preview';
        $judul  = 'Cetak_Manifest';
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

    
    function v_rpt_typeclearance(){
         $data=array(
		  'title'=>'Report Type Clearance',
		  'modulname'=>'REPORT TYPE CLEARANCE',
          'ismenu'=>'1',
		  'menu'=>'front/Menu/rate_menu',
		  'content'=>'cas/Cas_rpt/rpt_typeclearance',
		  );
        $this->load->view('template/template',$data);
    }
    
    function rpt_typeclearance(){
        if($this->input->post('text')==''){
            exit();
        }
        
        $arr_data   =explode("|",$this->input->post('text'));
        $cetak      =$arr_data[0];
        $tgl1       =$arr_data[1];
        $tgl2       =$arr_data[2];
        $tlc_a      =$arr_data[3];
        $per        =$arr_data[4];
        $group      ='GROUP BY a.hawb';
        
        $arr_tlc    =explode(",",$tlc_a);
        $tlc        ='(';
        $nu         =0;
        
        foreach($arr_tlc as $key) {    
            if($nu==0){$tlc .= "'".$key."'";}else{$tlc .= ","."'".$key."'";}
            $nu=$nu+1;    
        }        
        $tlc        .=')';
        
        $where='';
        $cRet = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                     <thead>                       
                        <tr><td bgcolor=\"#CCCCCC\"  align=\"center\"><b>NO</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>MAWB</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>HAWB</b></td>";                           
         if($per==1){
         $cRet .= "         <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACING NO</b></td>";
         $group      ='';
         }
         $cRet .= "
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>FLIGHT DATE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CLEARANCE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CLEARANCE PMK 182</b></td>  
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>KIND OF GOOD</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>WEIGHT</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>PACKAGE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>VALUE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TLC</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACKING</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACKING DATE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER NAME</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER ADDRESS1</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER ADDRESS2</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER CITY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER COMPANY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE NAME</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE ADDRESS</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE CITY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE COMPANY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE PHONE</b></td>
                        </tr>
                        
                     </thead>
                     <tfoot>
                        <tr><td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>";                           
         if($per==1){
         $cRet .= "         <td style=\"border-top: none;\"></td>";
         }
         $cRet .= "
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>                       
                         </tr>
                     </tfoot>
                    ";
        
       $sql4="
       SELECT 
	   a.mawb,a.hawb,b.trackno,a.flight_date,c.Keterangan AS clearance,a.kindofGood,a.Weight,a.Package,
	   a.shipper_name,a.shipper_address1,a.shipper_address2,a.shipper_city,a.shipper_company,
	   a.consignee_name,a.consignee_address,a.consignee_city,a.consignee_country,a.consignee_phone,
	   d.CodeStatus,d.Keterangan,a.TrackingDate,a.kindofGood,e.UR_JNS,e.ket,a.FOB
       FROM t_shipment_cloud a 
       INNER JOIN t_bill b ON a.hawb=b.hawb
       LEFT JOIN tm_typeclearance c ON a.type_clearance=c.TypeClearance
       LEFT JOIN statusproses d ON a.TrackingStatus=d.Noid 
       LEFT JOIN bc_m_jns_aju e ON a.Id_aju=e.id_aju
       WHERE a.Type_clearance in $tlc and a.flight_date  BETWEEN '$tgl1' AND '$tgl2' $group order by a.flight_date
       ";
                 
        $query4 = $this->db->query($sql4);
        $no     = 0;                                  
        
        foreach ($query4->result() as $row4)
        {
           $no=$no+1;           
                     $cRet    .= "<tr><td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$no</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->mawb</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->hawb</td>";                           
                     if($per==1){
                     $cRet .= "      <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->trackno</td>";
                     }
                     $cRet .= "
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->flight_date</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->clearance</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->UR_JNS - $row4->ket</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->kindofGood</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" align=\"right\" >$row4->Weight</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" align=\"right\">$row4->Package</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" align=\"right\">$row4->FOB</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->CodeStatus</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->Keterangan</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->TrackingDate</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_name</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_address1</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_address2</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_city</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_company</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_name</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_address</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_city</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_country</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_phone</td>
                                 </tr>";
        }
        
        $cRet   .= "</table>";
        
        $data['prev']= $cRet;
        $data['sikap'] = 'preview';
        $judul  = 'Cetak_Type_Clearance';
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


    function v_rpt_typeclearance_new(){
         $data=array(
		  'title'=>'Report Type Clearance PMK 182',
		  'modulname'=>'REPORT TYPE CLEARANCE PMK 182',
          'ismenu'=>'1',
		  'menu'=>'front/Menu/rate_menu',
		  'content'=>'cas/Cas_rpt/rpt_typeclearance_new',
		  );
        $this->load->view('template/template',$data);
    }
    
    function rpt_typeclearance_new(){
        if($this->input->post('text')==''){
            exit();
        }
        
        $arr_data   =explode("|",$this->input->post('text'));
        $cetak      =$arr_data[0];
        $tgl1       =$arr_data[1];
        $tgl2       =$arr_data[2];
        $tlc_a      =$arr_data[3];
        $per        =$arr_data[4];
        $group      ='GROUP BY a.hawb';
        
        $arr_tlc    =explode(",",$tlc_a);
        $tlc        ='(';
        $nu         =0;
        foreach($arr_tlc as $key) {    
            if($nu==0){$tlc .= "'".$key."'";}else{$tlc .= ","."'".$key."'";}
            $nu=$nu+1;    
        }        
        $tlc        .=')';
        
        $where='';
        $cRet = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                     <thead>                       
                        <tr><td bgcolor=\"#CCCCCC\"  align=\"center\"><b>NO</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>MAWB</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>HAWB</b></td>";                           
         if($per==1){
         $cRet .= "         <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACING NO</b></td>";
         $group      ='';
         }
         $cRet .= "
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>FLIGHT DATE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CLEARANCE </b></td> 
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CLEARANCE 182</b></td>  
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>KIND OF GOOD</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>WEIGHT</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>PACKAGE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>VALUE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TLC</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACKING</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACKING DATE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER NAME</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER ADDRESS1</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER ADDRESS2</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER CITY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER COMPANY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE NAME</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE ADDRESS</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE CITY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE COMPANY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE PHONE</b></td>
                        </tr>
                        
                     </thead>
                     <tfoot>
                        <tr><td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>";                           
         if($per==1){
         $cRet .= "         <td style=\"border-top: none;\"></td>";
         }
         $cRet .= "
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>                       
                         </tr>
                     </tfoot>
                    ";
        
       $sql4="
       SELECT 
	   a.mawb,a.hawb,b.trackno,a.flight_date,c.Keterangan AS clearance,a.kindofGood,a.Weight,a.Package,
	   a.shipper_name,a.shipper_address1,a.shipper_address2,a.shipper_city,a.shipper_company,
	   a.consignee_name,a.consignee_address,a.consignee_city,a.consignee_country,a.consignee_phone,
	   d.CodeStatus,d.Keterangan,a.TrackingDate,a.kindofGood,e.UR_JNS,e.ket,a.FOB
       FROM t_shipment_cloud a 
       INNER JOIN t_bill b ON a.hawb=b.hawb
       LEFT JOIN tm_typeclearance c ON a.type_clearance=c.TypeClearance
       LEFT JOIN statusproses d ON a.TrackingStatus=d.Noid 
       LEFT JOIN bc_m_jns_aju e ON a.Id_aju=e.id_aju
       WHERE a.Id_aju in $tlc and a.flight_date  BETWEEN '$tgl1' AND '$tgl2' $group order by a.flight_date
       ";
                 
        $query4 = $this->db->query($sql4);
        $no     = 0;                                  
        
        foreach ($query4->result() as $row4)
        {
           $no=$no+1;           
                     $cRet    .= "<tr><td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$no</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->mawb</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->hawb</td>";                           
                     if($per==1){
                     $cRet .= "      <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->trackno</td>";
                     }
                     $cRet .= "
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->flight_date</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->clearance</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->UR_JNS - $row4->ket</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->kindofGood</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" align=\"right\" >$row4->Weight</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" align=\"right\" >$row4->Package</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" align=\"right\" >$row4->FOB</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->CodeStatus</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->Keterangan</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->TrackingDate</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_name</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_address1</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_address2</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_city</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_company</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_name</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_address</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_city</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_country</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_phone</td>
                                 </tr>";
        }
        
        $cRet   .= "</table>";
        
        $data['prev']= $cRet;
        $data['sikap'] = 'preview';
        $judul  = 'Cetak_Type_Clearance';
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
    
    function v_rpt_type_track(){
         $data=array(
		  'title'=>'Report Type Clearance and Status Tracking',
		  'modulname'=>'REPORT TYPE CLEARANCE AND STATUS TRACKING',
          'ismenu'=>'1',
		  'menu'=>'front/Menu/rate_menu',
		  'content'=>'cas/Cas_rpt/rpt_type_track',
		  );
        $this->load->view('template/template',$data);
    }
    
    function rpt_type_track(){
        if($this->input->post('text')==''){
            exit();
        }
        
        $arr_data   =explode("|",$this->input->post('text'));
        $cetak      =$arr_data[0];
        $tgl1       =$arr_data[1];
        $tgl2       =$arr_data[2];
        $tlc_a      =$arr_data[3];
        $type_a     =$arr_data[4];
        $per        =$arr_data[5];
        $group      ='GROUP BY a.hawb';
        
        $arr_tlc    =explode(",",$tlc_a);
        $tlc        ='(';
        $nu         =0;
        foreach($arr_tlc as $key) {    
            if($nu==0){$tlc .= "'".$key."'";}else{$tlc .= ","."'".$key."'";}
            $nu=$nu+1;    
        }        
        $tlc        .=')';
        
        
        $arr_type    =explode(",",$type_a);
        $type        ='(';
        $nu         =0;
        foreach($arr_type as $key) {    
            if($nu==0){$type .= "'".$key."'";}else{$type .= ","."'".$key."'";}
            $nu=$nu+1;    
        }        
        $type        .=')';
        
        
        $where='';
        $cRet = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                     <thead>                       
                        <tr><td bgcolor=\"#CCCCCC\"  align=\"center\"><b>NO</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>MAWB</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>HAWB</b></td>";                           
         if($per==1){
         $cRet .= "         <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACING NO</b></td>";
         $group      ='';
         }
         $cRet .= "
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>FLIGHT DATE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CLEARANCE</b></td>  
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CLEARANCE PMK 182</b></td> 
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>KIND OF GOOD</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>WEIGHT</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>PACKAGE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>VALUE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TLC</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACKING</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACKING DATE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER NAME</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER ADDRESS1</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER ADDRESS2</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER CITY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER COMPANY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE NAME</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE ADDRESS</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE CITY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE COMPANY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE PHONE</b></td>
                        </tr>
                        
                     </thead>
                     <tfoot>
                        <tr><td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>";                           
         if($per==1){
         $cRet .= "         <td style=\"border-top: none;\"></td>";
         }
         $cRet .= "
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>                       
                         </tr>
                     </tfoot>
                    ";
        
       $sql4="
       SELECT 
	   a.mawb,a.hawb,b.trackno,a.flight_date,c.Keterangan AS clearance,a.kindofGood,a.Weight,a.Package,
	   a.shipper_name,a.shipper_address1,a.shipper_address2,a.shipper_city,a.shipper_company,
	   a.consignee_name,a.consignee_address,a.consignee_city,a.consignee_country,a.consignee_phone,
	   d.CodeStatus,d.Keterangan,a.TrackingDate,a.kindofGood,e.UR_JNS,e.ket,a.FOB
       FROM t_shipment_cloud a 
       INNER JOIN t_bill b ON a.hawb=b.hawb
       LEFT JOIN tm_typeclearance c ON a.type_clearance=c.noid
       LEFT JOIN statusproses d ON a.TrackingStatus=d.Noid
       LEFT JOIN bc_m_jns_aju e ON a.Id_aju=e.id_aju
       WHERE a.Type_clearance in $type and a.TrackingStatus in $tlc and a.flight_date  BETWEEN '$tgl1' AND '$tgl2' $group order by a.flight_date
       ";
                 
        $query4 = $this->db->query($sql4);
        $no     = 0;                                  
        
        foreach ($query4->result() as $row4)
        {
           $no=$no+1;           
                     $cRet    .= "<tr><td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$no</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->mawb</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->hawb</td>";                           
                     if($per==1){
                     $cRet .= "      <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->trackno</td>";
                     }
                     $cRet .= "
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->flight_date</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->clearance</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->UR_JNS - $row4->ket</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->kindofGood</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" align=\"right\" >$row4->Weight</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" align=\"right\" >$row4->Package</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" align=\"right\" >$row4->FOB</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->CodeStatus</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->Keterangan</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->TrackingDate</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_name</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_address1</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_address2</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_city</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_company</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_name</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_address</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_city</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_country</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_phone</td>
                                 </tr>";
        }
        
        $cRet   .= "</table>";
        
        $data['prev']= $cRet;
        $data['sikap'] = 'preview';
        $judul  = 'Cetak_Type_Tracking';
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
    

    function v_rpt_ticket(){
         $data=array(
		  'title'=>'Report Ticket',
		  'modulname'=>'REPORT TICKET',
          'ismenu'=>'1',
		  'menu'=>'front/Menu/rate_menu',
		  'content'=>'cas/Cas_rpt/rpt_ticket',
		  );
        $this->load->view('template/template',$data);
    }
    

    function rpt_ticket(){
        if($this->input->post('text')==''){
            exit();
        }
        
        $arr_data   =explode("|",$this->input->post('text'));
        $cetak      =$arr_data[0];
        $tgl1       =$arr_data[1];
        $tgl2       =$arr_data[2];
        
        $where='';
        $cRet = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                     <thead>                       
                        <tr><td bgcolor=\"#CCCCCC\"  align=\"center\"><b>NO</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>HAWB</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>FLIGHT DATE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TYPE CLEARANCE</b></td> 
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>KIND OF GOOD</b></td>                           
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE NAME</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNE PHONE</b></td>  
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>DATE CONTACT</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>NAME</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>EMAIL</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>PHONE</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>OUTCOME</b></td>
                        <!--    <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONVERTATION WITH CUSTOMER</b></td> -->
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>ACTION BY CAS</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>ACTION BY UPS</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SPPB</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>DATE OF SPPB</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>UPS RESPONSE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CALL BEGIN</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CALL END</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CREATE BY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>STATUS TICKET</b></td>
                        </tr>
                        
                     </thead>
                     <tfoot>
                        <tr><td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                           <!--  <td style=\"border-top: none;\"></td> -->
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                         </tr>
                     </tfoot>
                    ";
        
       $sql4="
        SELECT * FROM (
        SELECT b.hawb,b.flight_date,c.Keterangan,b.consignee_name,b.kindofGood,
        b.consignee_phone,b.consignee_email,a.created_date,a.complain_name,a.email,a.phone1,a.outcome,a.remarks,a.bycas,a.byups,b.Sppb,
        b.tglsppb,a.jam_awal,a.jam_akhir,a.UserId,a.UserName,g.name FROM ticket_full_hdr a 
        INNER JOIN t_shipment_cloud b ON a.object_id=b.hawb
        LEFT JOIN tm_typeclearance c ON b.type_clearance=c.TypeClearance
        LEFT JOIN bc_m_jns_aju e ON b.Id_aju=e.id_aju
        LEFT JOIN statusproses d ON b.TrackingStatus=d.Noid
        LEFT JOIN ticket_status g ON a.status_id=g.id
        UNION ALL
        SELECT b.hawb,b.flight_date,c.Keterangan,b.consignee_name,b.kindofGood,
        b.consignee_phone,b.consignee_email,f.comment_date,a.complain_name,a.email,a.phone1,a.outcome,f.comment,a.bycas,a.byups,b.Sppb,
        b.tglsppb,a.jam_awal,a.jam_akhir,f.user_id,f.UserName,g.name FROM ticket_full_hdr a
        INNER JOIN ticket_detail f ON a.ticket_id=f.ticket_id 
        INNER JOIN t_shipment_cloud b ON a.object_id=b.hawb
        LEFT JOIN tm_typeclearance c ON b.type_clearance=c.TypeClearance
        LEFT JOIN bc_m_jns_aju e ON b.Id_aju=e.id_aju
        LEFT JOIN statusproses d ON b.TrackingStatus=d.Noid
	    LEFT JOIN ticket_status g ON a.status_id=g.id
        ) AS tbl WHERE date(created_date) BETWEEN '$tgl1' AND '$tgl2' ORDER BY created_date DESC 
       ";
                 
        $query4 = $this->db->query($sql4);
        $no     = 0;                                  
        
        foreach ($query4->result() as $row4)
        {
           $no=$no+1;           
                     $cRet    .= "<tr><td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$no</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->hawb</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->flight_date</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->Keterangan</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->kindofGood</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_name</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_phone</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->created_date</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->complain_name</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_email</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->phone1</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->outcome</td>
                                 <!--     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->remarks</td> -->
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->bycas</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->byups</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->Sppb</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->tglsppb</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" ></td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->jam_awal</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->jam_akhir</td> 
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->UserName</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->name</td>                    
                                 </tr>";
        }
        
        $cRet   .= "</table>";
        
        $data['prev']= $cRet;
        $data['sikap'] = 'preview';
        $judul  = 'Cetak_Customer_Service';
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
    
    
    function v_rpt_ticket_ups(){
         $data=array(
		  'title'=>'Report Ticket',
		  'modulname'=>'REPORT TICKET BY UPS',
          'ismenu'=>'1',
		  'menu'=>'front/Menu/rate_menu',
		  'content'=>'cas/Cas_rpt/rpt_ticket_byUPS',
		  );
        $this->load->view('template/template',$data);
    }
    

    function rpt_ticket_ups(){
        if($this->input->post('text')==''){
            exit();
        }
        
        $arr_data   =explode("|",$this->input->post('text'));
        $cetak      =$arr_data[0];
        $tgl1       =$arr_data[1];
        $tgl2       =$arr_data[2];
        
        $where='';
        $cRet = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                     <thead>                       
                        <tr><td bgcolor=\"#CCCCCC\"  align=\"center\"><b>NO</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>HAWB</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>FLIGHT DATE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TYPE CLEARANCE</b></td> 
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>KIND OF GOOD</b></td>                           
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE NAME</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNE PHONE</b></td>  
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>DATE CONTACT</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>NAME</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>EMAIL</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>PHONE</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>OUTCOME</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONVERTATION WITH CUSTOMER</b></td> 
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>ACTION BY CAS</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>ACTION BY UPS</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SPPB</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>DATE OF SPPB</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>UPS RESPONSE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CALL BEGIN</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CALL END</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CREATE BY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>STATUS TICKET</b></td>
                        </tr>
                        
                     </thead>
                     <tfoot>
                        <tr><td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td> 
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                         </tr>
                     </tfoot>
                    ";
        
       $sql4="
        SELECT * FROM (
        SELECT b.hawb,b.flight_date,c.Keterangan,b.consignee_name,b.kindofGood,
        b.consignee_phone,b.consignee_email,a.created_date,a.complain_name,a.email,a.phone1,a.outcome,a.remarks,a.bycas,a.byups,b.Sppb,
        b.tglsppb,a.jam_awal,a.jam_akhir,a.UserId,a.UserName,g.name FROM ticket_full_hdr a 
        INNER JOIN t_shipment_cloud b ON a.object_id=b.hawb
        LEFT JOIN tm_typeclearance c ON b.type_clearance=c.TypeClearance
        LEFT JOIN bc_m_jns_aju e ON b.Id_aju=e.id_aju
        LEFT JOIN statusproses d ON b.TrackingStatus=d.Noid
        LEFT JOIN ticket_status g ON a.status_id=g.id
        UNION ALL
        SELECT b.hawb,b.flight_date,c.Keterangan,b.consignee_name,b.kindofGood,
        b.consignee_phone,b.consignee_email,f.comment_date,a.complain_name,a.email,a.phone1,a.outcome,f.comment,a.bycas,a.byups,b.Sppb,
        b.tglsppb,a.jam_awal,a.jam_akhir,f.user_id,f.UserName,g.name FROM ticket_full_hdr a
        INNER JOIN ticket_detail f ON a.ticket_id=f.ticket_id 
        INNER JOIN t_shipment_cloud b ON a.object_id=b.hawb
        LEFT JOIN tm_typeclearance c ON b.type_clearance=c.TypeClearance
        LEFT JOIN bc_m_jns_aju e ON b.Id_aju=e.id_aju
        LEFT JOIN statusproses d ON b.TrackingStatus=d.Noid
	    LEFT JOIN ticket_status g ON a.status_id=g.id
        ) AS tbl WHERE date(created_date) BETWEEN '$tgl1' AND '$tgl2' AND byups NOT IN ('...') AND byups IS NOT NULL ORDER BY created_date DESC 
       ";
                 
        $query4 = $this->db->query($sql4);
        $no     = 0;                                  
        
        foreach ($query4->result() as $row4)
        {
           $no=$no+1;           
                     $cRet    .= "<tr><td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$no</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->hawb</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->flight_date</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->Keterangan</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->kindofGood</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_name</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_phone</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->created_date</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->complain_name</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_email</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->phone1</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->outcome</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->remarks</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->bycas</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->byups</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->Sppb</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->tglsppb</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" ></td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->jam_awal</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->jam_akhir</td> 
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->UserName</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->name</td>                    
                                 </tr>";
        }
        
        $cRet   .= "</table>";
        
        $data['prev']= $cRet;
        $data['sikap'] = 'preview';
        $judul  = 'Cetak_Customer_Service';
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
    
    function v_rpt_ticket_user(){
         $data=array(
		  'title'=>'Report Ticket User',
		  'modulname'=>'REPORT TICKET PER USER',
          'ismenu'=>'1',
		  'menu'=>'front/Menu/rate_menu',
		  'content'=>'cas/Cas_rpt/rpt_ticket_user',
		  );
        $this->load->view('template/template',$data);
    }
    
    function rpt_ticket_user(){
        if($this->input->post('text')==''){
            exit();
        }
        
        $arr_data   =explode("|",$this->input->post('text'));
        $cetak      =$arr_data[0];
        $tgl1       =$arr_data[1];
        $tgl2       =$arr_data[2];
        $un         =$arr_data[3];
        
        
        $arr_tlc    =explode(",",$un);
        $tlc        ='(';
        $nu         =0;
        foreach($arr_tlc as $key) {    
            if($nu==0){$tlc .= "'".$key."'";}else{$tlc .= ","."'".$key."'";}
            $nu=$nu+1;    
        }        
        $tlc        .=')';
        
        
        $where='';
        $cRet = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                     <thead>                       
                        <tr><td bgcolor=\"#CCCCCC\"  align=\"center\"><b>NO</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>HAWB</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>FLIGHT DATE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TYPE CLEARANCE</b></td> 
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>KIND OF GOOD</b></td>                           
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE NAME</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNE PHONE</b></td>  
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>DATE CONTACT</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>NAME</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>EMAIL</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>PHONE</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>OUTCOME</b></td>
                  <!--          <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONVERTATION WITH CUSTOMER</b></td> -->
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>ACTION BY CAS</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>ACTION BY UPS</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SPPB</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>DATE OF SPPB</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>UPS RESPONSE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CALL BEGIN</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CALL END</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CREATE BY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>STATUS TICKET</b></td>
                        </tr>
                        
                     </thead>
                     <tfoot>
                        <tr><td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                 <!--           <td style=\"border-top: none;\"></td> -->
                         </tr>
                     </tfoot>
                    ";
        
       $sql4="
        SELECT * FROM (
        SELECT b.hawb,b.flight_date,c.Keterangan,b.consignee_name,b.kindofGood,
        b.consignee_phone,b.consignee_email,a.created_date,a.complain_name,a.email,a.phone1,a.outcome,a.remarks,a.bycas,a.byups,b.Sppb,
        b.tglsppb,a.jam_awal,a.jam_akhir,a.UserId,a.UserName,g.name FROM ticket_full_hdr a 
        INNER JOIN t_shipment_cloud b ON a.object_id=b.hawb
        LEFT JOIN tm_typeclearance c ON b.type_clearance=c.TypeClearance
        LEFT JOIN bc_m_jns_aju e ON b.Id_aju=e.id_aju
        LEFT JOIN statusproses d ON b.TrackingStatus=d.Noid
        LEFT JOIN ticket_status g ON a.status_id=g.id
        UNION ALL
        SELECT b.hawb,b.flight_date,c.Keterangan,b.consignee_name,b.kindofGood,
        b.consignee_phone,b.consignee_email,f.comment_date,a.complain_name,a.email,a.phone1,a.outcome,f.comment,a.bycas,a.byups,b.Sppb,
        b.tglsppb,a.jam_awal,a.jam_akhir,f.user_id,f.UserName,g.name FROM ticket_full_hdr a
        INNER JOIN ticket_detail f ON a.ticket_id=f.ticket_id 
        INNER JOIN t_shipment_cloud b ON a.object_id=b.hawb
        LEFT JOIN tm_typeclearance c ON b.type_clearance=c.TypeClearance
        LEFT JOIN bc_m_jns_aju e ON b.Id_aju=e.id_aju
        LEFT JOIN statusproses d ON b.TrackingStatus=d.Noid
	    LEFT JOIN ticket_status g ON a.status_id=g.id
        ) AS tbl WHERE UserId in $tlc and date(created_date) BETWEEN '$tgl1' AND '$tgl2' ORDER BY created_date DESC 
       ";
                 
        $query4 = $this->db->query($sql4);
        $no     = 0;                                  
        
        foreach ($query4->result() as $row4)
        {
           $no=$no+1;           
                     $cRet    .= "<tr><td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$no</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->hawb</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->flight_date</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->Keterangan</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->kindofGood</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_name</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_phone</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->created_date</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->complain_name</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_email</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->phone1</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->outcome</td>
                                 <!--    <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->remarks</td> -->
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->bycas</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->byups</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->Sppb</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->tglsppb</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" ></td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->jam_awal</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->jam_akhir</td> 
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->UserName</td> 
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->name</td>                   
                                 </tr>";
        }
        
        $cRet   .= "</table>";
        
        $data['prev']= $cRet;
        $data['sikap'] = 'preview';
        $judul  = 'Cetak_Customer_Service';
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


    function v_rpt_ticket_myuser(){
         $data=array(
		  'title'=>'My Report Ticket ',
		  'modulname'=>'MY REPORT TICKET ',
          'ismenu'=>'1',
		  'menu'=>'front/Menu/rate_menu',
		  'content'=>'cas/Cas_rpt/rpt_ticket_myuser',
		  );
        $this->load->view('template/template',$data);
    }
    
    function rpt_ticket_myuser(){
        if($this->input->post('text')==''){
            exit();
        }
        
        $arr_data   =explode("|",$this->input->post('text'));
        $cetak      =$arr_data[0];
        $tgl1       =$arr_data[1];
        $tgl2       =$arr_data[2];
        $un         =$this->session->userdata('cs_Idusr');
        
        
        $where='';
        $cRet = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                     <thead>                       
                        <tr><td bgcolor=\"#CCCCCC\"  align=\"center\"><b>NO</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>HAWB</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>FLIGHT DATE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TYPE CLEARANCE</b></td> 
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>KIND OF GOOD</b></td>                           
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE NAME</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNE PHONE</b></td>  
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>DATE CONTACT</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>NAME</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>EMAIL</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>PHONE</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>OUTCOME</b></td>
                     <!--       <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONVERTATION WITH CUSTOMER</b></td> -->
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>ACTION BY CAS</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>ACTION BY UPS</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SPPB</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>DATE OF SPPB</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>UPS RESPONSE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CALL BEGIN</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CALL END</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CREATE BY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>STATUS TICKET</b></td>
                        </tr>
                        
                     </thead>
                     <tfoot>
                        <tr><td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                   <!--         <td style=\"border-top: none;\"></td> -->
                         </tr>
                     </tfoot>
                    ";
        
       $sql4="
        SELECT * FROM (
        SELECT b.hawb,b.flight_date,c.Keterangan,b.consignee_name,b.kindofGood,
        b.consignee_phone,b.consignee_email,a.created_date,a.complain_name,a.email,a.phone1,a.outcome,a.remarks,a.bycas,a.byups,b.Sppb,
        b.tglsppb,a.jam_awal,a.jam_akhir,a.UserId,a.UserName,g.name FROM ticket_full_hdr a 
        INNER JOIN t_shipment_cloud b ON a.object_id=b.hawb
        LEFT JOIN tm_typeclearance c ON b.type_clearance=c.TypeClearance
        LEFT JOIN bc_m_jns_aju e ON b.Id_aju=e.id_aju
        LEFT JOIN statusproses d ON b.TrackingStatus=d.Noid
        LEFT JOIN ticket_status g ON a.status_id=g.id
        UNION ALL
        SELECT b.hawb,b.flight_date,c.Keterangan,b.consignee_name,b.kindofGood,
        b.consignee_phone,b.consignee_email,f.comment_date,a.complain_name,a.email,a.phone1,a.outcome,f.comment,a.bycas,a.byups,b.Sppb,
        b.tglsppb,a.jam_awal,a.jam_akhir,f.user_id,f.UserName,g.name FROM ticket_full_hdr a
        INNER JOIN ticket_detail f ON a.ticket_id=f.ticket_id 
        INNER JOIN t_shipment_cloud b ON a.object_id=b.hawb
        LEFT JOIN tm_typeclearance c ON b.type_clearance=c.TypeClearance
        LEFT JOIN bc_m_jns_aju e ON b.Id_aju=e.id_aju
        LEFT JOIN statusproses d ON b.TrackingStatus=d.Noid
	    LEFT JOIN ticket_status g ON a.status_id=g.id
        ) AS tbl WHERE UserId = '$un' and date(created_date) BETWEEN '$tgl1' AND '$tgl2' ORDER BY created_date DESC 
       ";
                 
        $query4 = $this->db->query($sql4);
        $no     = 0;                                  
        
        foreach ($query4->result() as $row4)
        {
           $no=$no+1;           
                     $cRet    .= "<tr><td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$no</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->hawb</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->flight_date</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->Keterangan</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->kindofGood</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_name</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_phone</td>
                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->created_date</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->complain_name</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_email</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->phone1</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->outcome</td>
                                 <!--    <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->remarks</td> -->
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->bycas</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->byups</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->Sppb</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->tglsppb</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" ></td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->jam_awal</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->jam_akhir</td> 
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->UserName</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->name</td>                    
                                 </tr>";
        }
        
        $cRet   .= "</table>";
        
        $data['prev']= $cRet;
        $data['sikap'] = 'preview';
        $judul  = 'Cetak_Customer_Service';
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
    
    
     function rpt_new_clearance(){
         $data=array(
		  'title'=>'Report Type Clearance and Status Tracking',
		  'modulname'=>'REPORT TYPE CLEARANCE AND STATUS TRACKING',
		  'content'=>'cas/Cas_rpt/rpt_new_clearance',
		  );
        $this->load->view('template/template',$data);
    }
    
     function rpt_type_track_new(){
        if($this->input->post('text')==''){
            exit();
        }
        
        $arr_data   =explode("|",$this->input->post('text'));
        $cetak      =$arr_data[0];
        $tgl1       =$arr_data[1];
        $tgl2       =$arr_data[2];
        $tlc_a      =$arr_data[3];
        $type_a     =$arr_data[4];
        $per        =$arr_data[5];
        $group      ='GROUP BY a.hawb';
        
        $arr_tlc    =explode(",",$tlc_a);
        $tlc        ='(';
        $nu         =0;
        foreach($arr_tlc as $key) {    
            if($nu==0){$tlc .= "'".$key."'";}else{$tlc .= ","."'".$key."'";}
            $nu=$nu+1;    
        }        
        $tlc        .=')';
        
        
        $arr_type    =explode(",",$type_a);
        $type        ='(';
        $nu         =0;
        foreach($arr_type as $key) {    
            if($nu==0){$type .= "'".$key."'";}else{$type .= ","."'".$key."'";}
            $nu=$nu+1;    
        }        
        $type        .=')';
        
        
        $where='';
        $cRet = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                     <thead>                       
                        <tr><td bgcolor=\"#CCCCCC\"  align=\"center\"><b>NO</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>MAWB</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>HAWB</b></td>";                           
         if($per==1){
         $cRet .= "         <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACING NO</b></td>";
         $group      ='';
         }
         $cRet .= " 
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>FLIGHT DATE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CLEARANCE </b></td> 
							<td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CLEARANCE PMK 182 </b></td>  
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>KIND OF GOOD</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>WEIGHT</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>PACKAGE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>VALUE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TLC</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACKING</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACKING DATE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER NAME</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER ADDRESS1</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER ADDRESS2</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER CITY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER COMPANY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE NAME</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE ADDRESS</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE CITY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE COMPANY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE PHONE</b></td>
                        </tr>
                        
                     </thead>
                     <tfoot>
                        <tr><td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>";                           
         if($per==1){
         $cRet .= "         <td style=\"border-top: none;\"></td>";
         }
         $cRet .= "
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
							<td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>                       
                         </tr>
                     </tfoot>
                    ";
        
       $sql4="
       SELECT 
	   a.mawb,a.hawb,b.trackno,a.flight_date,c.Keterangan AS clearance,a.kindofGood,a.Weight,a.Package,
	   a.shipper_name,a.shipper_address1,a.shipper_address2,a.shipper_city,a.shipper_company,
	   a.consignee_name,a.consignee_address,a.consignee_city,a.consignee_country,a.consignee_phone,
	   d.CodeStatus,d.Keterangan,a.TrackingDate,a.kindofGood,e.UR_JNS as new_clearance,e.ket as ket_aju,a.FOB
       FROM t_shipment_cloud a 
       INNER JOIN t_bill b ON a.hawb=b.hawb
       LEFT JOIN tm_typeclearance c ON a.type_clearance=c.noid
       LEFT JOIN statusproses d ON a.TrackingStatus=d.Noid
	   LEFT JOIN bc_m_jns_aju e ON a.Id_aju=e.id_aju
       WHERE a.Id_aju in $type and a.TrackingStatus in $tlc and a.flight_date  BETWEEN '$tgl1' AND '$tgl2' $group order by a.flight_date
       ";
                 
        $query4 = $this->db->query($sql4);
        $no     = 0;                                  
        
        foreach ($query4->result() as $row4)
        {
           $no=$no+1;           
                     $cRet    .= "<tr><td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$no</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->mawb</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->hawb</td>";                           
                     if($per==1){
                     $cRet .= "      <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->trackno</td>";
                     }
                     $cRet .= "
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->flight_date</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->clearance</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->new_clearance - $row4->ket_aju</td>
									 <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->kindofGood</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" align=\"right\">$row4->Weight</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" align=\"right\">$row4->Package</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" align=\"right\">$row4->FOB</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->CodeStatus</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->Keterangan</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->TrackingDate</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_name</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_address1</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_address2</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_city</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_company</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_name</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_address</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_city</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_country</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_phone</td>
                                 </tr>";
        }
        
        $cRet   .= "</table>";
        
        $data['prev']= $cRet;
        $data['sikap'] = 'preview';
        $judul  = 'Cetak_Type_Tracking';
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
    
    
     function view_last_track_countain(){
         $data=array(
		  'title'=>'Report Last Tracking And Which Contain Status Tracking',
		  'modulname'=>'REPORT LAST TRACKING AND WHICH CONTAIN STATUS TRACKING',
		  'content'=>'cas/Cas_rpt/rpt_last_track_contain',
		  );
        $this->load->view('template/template',$data);
    }
    
     function rpt_last_track_countain(){
        if($this->input->post('text')==''){
            exit();
        }
        
        $arr_data   =explode("|",$this->input->post('text'));
        $cetak      =$arr_data[0];
        $tgl1       =$arr_data[1];
        $tgl2       =$arr_data[2];
        $tlc_a      =$arr_data[3];
        $type_a     =$arr_data[4];
        $per        =$arr_data[5];
                
        
        
        $arr_tlc    =explode(",",$tlc_a);
        $tlc        ='(';
        $nu         =0;
        foreach($arr_tlc as $key) {    
            if($nu==0){$tlc .= "'".$key."'";}else{$tlc .= ","."'".$key."'";}
            $nu=$nu+1;    
        }        
        $tlc        .=')';
        
        
        $arr_type    =explode(",",$type_a);
        $type        ='(';
        $nu         =0;
        foreach($arr_type as $key) {    
            if($nu==0){$type .= "'".$key."'";}else{$type .= ","."'".$key."'";}
            $nu=$nu+1;    
        }        
        $type        .=')';
        
        
        $where='';
        $cRet = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                     <thead>                       
                        <tr><td bgcolor=\"#CCCCCC\"  align=\"center\"><b>NO</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>HAWB</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>FLIGHT DATE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CLEARANCE</b></td> 
							<td bgcolor=\"#CCCCCC\"  align=\"center\"><b>BASE ON PMK 182 </b></td>  
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>LAST STATUS TRACKING</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>REMARK</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>DATE STATUS TRACKING</b></td>                           
                        </tr>
                        
                     </thead>
                     <tfoot>
                        <tr><td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>                    
                         </tr>
                     </tfoot>
                    ";
        $sqlz="
        SELECT b.hawb FROM dstatusproses a 
        INNER JOIN t_shipment_cloud b ON a.Hawb=b.hawb
        WHERE b.flight_date BETWEEN '$tgl1' AND '$tgl2' and a.IdStatusProses in $type 
        GROUP BY b.hawb
        ORDER BY b.flight_date,a.Hawb,a.DateUpdate 
        ";
                 
        $queryz     = $this->db->query($sqlz);
        $no         = 0;                                  
        $notinhawb  ='(';
        $nu         =0;
        foreach ($queryz->result() as $rowz)
        {
            if($nu==0){$notinhawb .= "'".$rowz->hawb."'";}else{$notinhawb .= ","."'".$rowz->hawb."'";}
            $nu=$nu+1;
        }
        $notinhawb  .=')';
        
        if($nu==0){$notinhawb  ="('')";}
        
        switch ($per) {
            case '1':
                $wh="and a.IdStatusProses in $tlc and a.Hawb not in $notinhawb";
                break;
            case '2':
                $wh="and a.IdStatusProses in $tlc";
                break;
            case '3':
                $wh="and a.Hawb not in $notinhawb";
                break;
        } 
        
        $sql4="
        SELECT b.TrackingRemark,b.hawb,b.flight_date,d.Keterangan AS TypeClearance,e.ket AS PMK_182,c.CodeStatus,c.Keterangan AS last_track,f.CodeStatus AS codelast,f.Keterangan AS contain,a.Note,a.DateUpdate FROM dstatusproses a 
        INNER JOIN t_shipment_cloud b ON a.Hawb=b.hawb
        LEFT JOIN statusproses c ON b.TrackingStatus=c.Noid
        LEFT JOIN tm_typeclearance d ON b.type_clearance=d.noid
        LEFT JOIN bc_m_jns_aju e ON b.Id_aju=e.id_aju
        LEFT JOIN statusproses f ON a.IdStatusProses=f.Noid 
        WHERE b.flight_date BETWEEN '$tgl1' AND '$tgl2' $wh 
        GROUP BY b.hawb
        ORDER BY b.flight_date,a.Hawb,a.DateUpdate 
        ";
                 
        $query4 = $this->db->query($sql4);
        $no     = 0;                                  
        
        foreach ($query4->result() as $row4)
        {
           $no=$no+1;           
                     $cRet    .= "<tr><td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$no</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->hawb</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->flight_date</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->TypeClearance</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->PMK_182</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->CodeStatus - $row4->last_track</td>
									 <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->TrackingRemark</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->DateUpdate</td>
                                 </tr>";
        }
        
        $cRet   .= "</table>";
        
        $data['prev']= $cRet;
        $data['sikap'] = 'preview';
        $judul  = 'Cetak_Type_Tracking';
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


    function v_rpt_myjob(){
         $data=array(
		  'title'=>'Report My Job',
		  'modulname'=>'REPORT MY JOB',
          'ismenu'=>'1',
		  'menu'=>'front/Menu/rate_menu',
		  'content'=>'cas/Cas_rpt/rpt_myjob',
		  );
        $this->load->view('template/template',$data);
    }
    
    function rpt_myjob(){
        if($this->input->post('text')==''){
            exit();
        }
        
        $arr_data   =explode("|",$this->input->post('text'));
        $cetak      =$arr_data[0];
        $tgl1       =$arr_data[1];
        $tgl2       =$arr_data[2];
        $per        =$arr_data[3];
        $group      ='GROUP BY a.hawb';
        
        $where='';
        $cRet = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                     <thead>                       
                        <tr><td bgcolor=\"#CCCCCC\"  align=\"center\"><b>NO</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>MAWB</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>HAWB</b></td> ";                           
         if($per==1){
         $cRet .= "         <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACING NO</b></td>";
         $group      ='';
         }
         $cRet .= "         <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>FLIGHT DATE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CLEARANCE</b></td> 
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CLEARANCE PMK 182</b></td>  
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>KIND OF GOOD</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>WEIGHT</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>PACKAGE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>VALUE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TLC</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACKING</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACKING DATE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER NAME</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER ADDRESS1</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER ADDRESS2</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER CITY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER COMPANY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE NAME</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE ADDRESS</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE CITY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE COMPANY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE PHONE</b></td>
                        </tr>
                        
                     </thead>
                     <tfoot>
                        <tr><td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>";                           
         if($per==1){
         $cRet .= "         <td style=\"border-top: none;\"></td>";
         }
         $cRet .= "         <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>                       
                         </tr>
                     </tfoot>
                    ";
        
        $tlc    =$this->Mdata->gen_tlc();
        $digit  =$this->Mdata->gen_digit();
        $type   =$this->Mdata->gen_type();
        $pmk182 =$this->Mdata->gen_pmk182();
        
       $sql4="
       SELECT 
	   a.mawb,a.hawb,b.trackno,a.flight_date,c.Keterangan AS clearance,a.kindofGood,a.Weight,a.Package,
	   a.shipper_name,a.shipper_address1,a.shipper_address2,a.shipper_city,a.shipper_company,
	   a.consignee_name,a.consignee_address,a.consignee_city,a.consignee_country,a.consignee_phone,
	   d.CodeStatus,d.Keterangan,a.TrackingDate,a.kindofGood,e.ket as pmk182,e.UR_JNS,a.FOB
       FROM t_shipment_cloud a 
       INNER JOIN t_bill b ON a.hawb=b.hawb
       LEFT JOIN tm_typeclearance c ON a.type_clearance=c.TypeClearance
       LEFT JOIN statusproses d ON a.TrackingStatus=d.Noid
       LEFT JOIN bc_m_jns_aju e ON a.Id_aju=e.id_aju
       WHERE
       RIGHT(a.hawb,1) IN $digit AND a.TrackingStatus IN $tlc AND a.Id_aju IN $pmk182 and
       a.flight_date BETWEEN '$tgl1' AND '$tgl2' 
       $group
       order by a.flight_date
       ";
                 
        $query4 = $this->db->query($sql4);
        $no     = 0;                                  
        
        foreach ($query4->result() as $row4)
        {
           $no=$no+1;           
                     $cRet    .= "<tr><td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$no</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->mawb</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->hawb</td>";                           
                     if($per==1){
                     $cRet .= "      <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->trackno</td>";
                     }
                     $cRet .= "      <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->flight_date</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->clearance</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->UR_JNS - $row4->pmk182</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->kindofGood</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->Weight</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->Package</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->FOB</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->CodeStatus</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->Keterangan</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->TrackingDate</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_name</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_address1</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_address2</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_city</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_company</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_name</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_address</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_city</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_country</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_phone</td>
                                 </tr>";
        }
        
        $cRet   .= "</table>";
        
        $data['prev']= $cRet;
        $data['sikap'] = 'preview';
        $judul  = 'Cetak_Manifest';
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
    

    function v_rpt_myjob_assign(){
         $data=array(
		  'title'=>'Report My Job',
		  'modulname'=>'REPORT MY JOB',
          'ismenu'=>'1',
		  'menu'=>'front/Menu/rate_menu',
		  'content'=>'cas/Cas_rpt/rpt_myjob_assign',
		  );
        $this->load->view('template/template',$data);
    }
    
    function v_rpt_summary(){
         $data=array(
		  'title'=>'Report My Job',
		  'modulname'=>'REPORT MY JOB',
          'ismenu'=>'1',
		  'menu'=>'front/Menu/rate_menu',
		  'content'=>'cas/Cas_rpt/rpt_summary',
		  );
        $this->load->view('template/template',$data);
    }
    
    function rpt_summary(){
        if($this->input->post('text')==''){
            exit();
        }
        
        $arr_data   =explode("|",$this->input->post('text'));
        $cetak      =$arr_data[0];
        $tgl1       =$arr_data[1];
        $tgl2       =$arr_data[2];
        $per        =$arr_data[3];
        
        $where='';
        $cRet = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                     <thead>                       
                        <tr><td bgcolor=\"#CCCCCC\"  align=\"center\"><b>FLIGHT DATE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CLEARANCE PMK 182</b></td>  
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>COUNT SHIPMENT</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SUM PACKAGES</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>RELEASE VOLUME (SPP/RLP/408)</b></td>
                        </tr>
                        
                     </thead>
                     <tfoot>
                        <tr>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>                       
                         </tr>
                     </tfoot>
                    ";
        
       $sql4="
       SELECT id_aju,UR_JNS,ket FROM bc_m_jns_aju 
       ";
                 
        $query4 = $this->db->query($sql4);
        $no     = 0;                                  
        
        foreach ($query4->result() as $row4)
        {
           $no=$no+1; 
           
         $hasil = $this->db->query("SELECT COUNT(*) AS count_ship FROM t_shipment_cloud WHERE flight_date BETWEEN '$tgl1' AND '$tgl2' and id_aju='$row4->id_aju'");
         $trh = $hasil->row(); 
         $count_ship = $trh->count_ship;
         
         $hasil = $this->db->query("SELECT SUM(Package) as sum_package FROM t_shipment_cloud WHERE flight_date BETWEEN '$tgl1' AND '$tgl2' and id_aju='$row4->id_aju'");
         $trh = $hasil->row(); 
         $sum_package = $trh->sum_package;
         
         $hasil = $this->db->query("SELECT COUNT(*) AS count_ship_ FROM t_shipment_cloud WHERE flight_date BETWEEN '$tgl1' AND '$tgl2' and TrackingStatus IN ('3','37','408') and id_aju='$row4->id_aju'");
         $trh = $hasil->row(); 
         $count_ship_ = $trh->count_ship_;
                     
                     $cRet    .= "<tr>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$tgl1</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->UR_JNS - $row4->ket</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$count_ship</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$sum_package</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$count_ship_</td>
                                 </tr>";
        }
        
        $cRet   .= "</table>";
        
        $data['prev']= $cRet;
        $data['sikap'] = 'preview';
        $judul  = 'Cetak_Manifest';
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
    
    
    function v_rpt_history_type(){
         $data=array(
		  'title'=>'Report Manifest',
		  'modulname'=>'REPORT MANIFEST',
          'ismenu'=>'1',
		  'menu'=>'front/Menu/rate_menu',
		  'content'=>'cas/Cas_rpt/rpt_history_type',
		  );
        $this->load->view('template/template',$data);
    }
    
    function rpt_history_type(){
        if($this->input->post('text')==''){
            exit();
        }
        
        $arr_data   =explode("|",$this->input->post('text'));
        $cetak      =$arr_data[0];
        $tgl1       =$arr_data[1];
        $tgl2       =$arr_data[2];
        $per        =$arr_data[3];
       // $group      ='GROUP BY a.hawb';
        
        $where='';
        $cRet = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                     <thead>                       
                        <tr><td bgcolor=\"#CCCCCC\"  align=\"center\"><b>NO</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>HAWB</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>DATE UPDATE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>UPDATE TO CLEARANCE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>NOTE</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>USER UPDATE</b></td>
                        </tr>
                     </thead>
                     <tfoot>
                        <tr><td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>                      
                         </tr>
                     </tfoot>
                    ";
        
       $sql4="
       SELECT 
       Hawb,DateUpdate,b.UR_JNS,b.ket,Note,UserName 
       FROM dtypeclearance a INNER JOIN bc_m_jns_aju b ON a.Hawb=b.id_aju 
       WHERE IdUser NOT IN ('Import','5') AND Date(DateUpdate) 
       BETWEEN '$tgl1' AND '$tgl2' order by DateUpdate, Hawb, Id
       ";
                 
        $query4 = $this->db->query($sql4);
        $no     = 0;                                  
        
        foreach ($query4->result() as $row4)
        {
           $no=$no+1;           
                     $cRet    .= "<tr><td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$no</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->Hawb</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->DateUpdate</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->UR_JNS - $row4->ket</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->Note</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->UserName</td>
                                 </tr>";
        }
        
        $cRet   .= "</table>";
        
        $data['prev']= $cRet;
        $data['sikap'] = 'preview';
        $judul  = 'History Type Clearance';
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
    
    
    function Monitoring_Ticket(){
        //if($this->input->post('text')==''){
//            exit();
//        }
        
       // $arr_data   =explode("|",$this->input->post('text'));
        $cetak      ='4';//$arr_data[0];
       // $tgl1       =$arr_data[1];
      //  $tgl2       =$arr_data[2];
      //  $per        =$arr_data[3];
       // $group      ='GROUP BY a.hawb';
       $tgl= $this->input->post('tgl'); 
        $where='';
        $cRet = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                     <thead>                       
                        <tr><td bgcolor=\"#CCCCCC\"  align=\"center\"><b>NO</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>HAWB</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>DATE UPDATE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>UPDATE TO CLEARANCE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>NOTE</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>USER UPDATE</b></td>
                        </tr>
                     </thead>
                     <tfoot>
                        <tr><td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>                      
                         </tr>
                     </tfoot>
                    ";
       
       $sql_="
        SELECT object_id  FROM ticket_full_hdr WHERE DATE(complain_date)='$tgl'
        UNION ALL
        SELECT a.object_id FROM ticket_full_hdr a INNER JOIN ticket_detail b ON a.ticket_id=b.ticket_id 
        WHERE DATE(b.comment_date)='$tgl'
       ";
       $query_ = $this->db->query($sql_);
       
       $myhawb="";
       $myhawb_in ="AND hawb IN (";
       $myhawb_notin ="AND hawb NOT IN (";
       $myhawb_nu = 0;
       foreach ($query_->result() as $row)
       {
            if($myhawb_nu==0){$myhawb .= "'".$row->object_id."'";}else{$myhawb .= ",'".$row->object_id."'";}
            $myhawb_nu++;
       }
       
       $myhawb_in .=$myhawb.")";
       $myhawb_notin .=$myhawb.")";
       if($myhawb_nu==0){
        $myhawb_in="AND hawb IN ('xxxxxx')";
        $myhawb_notin="AND hawb NOT IN ('xxxxxx')";
       }
       $sql4="
       SELECT a.FullName,b.GroupName,a.Id,a.IdGroupUsr FROM msuser a INNER JOIN msgroup_usr b ON a.IdGroupUsr=b.Id 
       WHERE a.IdGroupUsr = '2' ORDER BY b.GroupName,a.FullName
       ";
                 
        $query4 = $this->db->query($sql4);
        $no     = 0;                                  
        $data = array();
		$no_ =0;// $_POST['start'];
        
        foreach ($query4->result() as $row4)
        {
           $no=$no+1;           
           $no_++;
           
            $smart_role=$this->Model_user->getCustom('Code1',"smart_role","WHERE GroupId='$row4->IdGroupUsr' GROUP BY Code1");
			$mydigit=$this->Model_user->getCustom('id_alpha',"team_digit a","INNER JOIN team_user b ON a.Id_team=b.id_team WHERE b.id_user='$row4->Id' GROUP BY id_alpha");
			$type_clear=$this->Model_user->getCustom('type_clearance',"team a","INNER JOIN team_user b ON a.Id_team=b.id_team WHERE b.id_user='$row4->Id' GROUP BY type_clearance");
			$pmk_182=$this->Model_user->getCustom('pmk_182',"team a","INNER JOIN team_user b ON a.Id_team=b.id_team WHERE b.id_user='$row4->Id' GROUP BY pmk_182");	
          //===TLC  
            $mytlc ="AND TrackingStatus IN (";
            $mytlc_nu=0;
            foreach($smart_role as $row){      
				if($mytlc_nu==0){$mytlc .= "'".$row->Code1."'";}else{$mytlc .= ",'".$row->Code1."'";}
			$mytlc_nu++;
            }
            $mytlc .=")";
            if($mytlc_nu==0){$mytlc ="('')";}
         //===DIGIT 
            $mydig ="RIGHT(Hawb,1) IN (";
            $mydig_nu=0;
            foreach($mydigit as $row){      
				if($mydig_nu==0){$mydig .= "'".$row->id_alpha."'";}else{$mydig .= ",'".$row->id_alpha."'";}
			$mydig_nu++;
            }
            $mydig .=")";
            if($mydig_nu==0){$mydig ="('')";}
        //===Type Clearance
            $mytype ="(";
            $mytype_nu=0;
            foreach($type_clear as $row){      
				if($mytype_nu==0){$mytype .= "'".$row->type_clearance."'";}else{$mytype .= ",'".$row->type_clearance."'";}
			$mytype_nu++;
            }
            $mytype .=")";
            if($mytype_nu==0){$mytype ="('')";}
         //===Type PMK 182
            $mypmk182 ="(";
            $mypmk182_nu=0;
            foreach($type_clear as $row){      
				if($mypmk182_nu==0){$mypmk182 .= "'".$row->type_clearance."'";}else{$mypmk182 .= ",'".$row->type_clearance."'";}
			$mypmk182_nu++;
            }
            $mypmk182 .=")";
            if($mypmk182_nu==0){$mypmk182 ="('')";}
            
            
            $type_clear_="AND (Type_Clearance in $mytype or Id_aju in $mypmk182)";
            
            if($mytype_nu == 0 && $mypmk182_nu == 0){
                $type_clear_='';
            }
            
            if( $mypmk182_nu == 0){
                $type_clear_=" AND TypeClearance in $mytype";
            }
            
            if( $mytype_nu == 0){
                $type_clear_=" AND Id_aju in $mypmk182";
            }
            
                        $q=$this->db->query("SELECT COUNT(*) as target FROM t_shipment_cloud 
                        WHERE  $mydig  $mytlc $type_clear_");
                        foreach ($q->result() as $row)
                        {
                          $target = $row->target;
                        }
                        
                        $q=$this->db->query("SELECT COUNT(*) as needopen FROM t_shipment_cloud 
                        WHERE  $mydig  $mytlc $type_clear_ $myhawb_notin");
                        foreach ($q->result() as $row)
                        {
                          $needopen = $row->needopen;
                        }
                        
                        $q=$this->db->query("SELECT COUNT(*) as actual FROM t_shipment_cloud 
                        WHERE  $mydig  $mytlc $type_clear_ $myhawb_in");
                        foreach ($q->result() as $row)
                        {
                          $actual = $row->actual;
                        }   
                        
                     $cRet    .= "<tr><td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$no</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->FullName</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->GroupName</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$mytlc ,$mydig ,$mytype ,$mypmk182</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$target $needopen $actual</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$myhawb_in <br> $myhawb_notin </td>
                                 </tr>";
                                 
        $selisih = $target-$actual;
       //$p = $actual-$target;
       // $actual = 10;
        $per1   = ($actual!=0 && $target !=0)?($actual / $target ) * 100:0; 
        $persen1= number_format($per1,"2",".",",");
        $ntarget= number_format($target,"0",".",",");
        $nactual=number_format($actual,"0",".",",");
        $nselisih=number_format($selisih,"0",".",",");    
        $mytlc_ = str_replace("'","xxxxxx",$mytlc);
        $mydig_ = str_replace("'","xxxxxx",$mydig);
        $type_clear_1 = str_replace("'","xxxxxx",$type_clear_);
        $myhawb_in_ = str_replace("'","xxxxxx",$myhawb_in);
        $myhawb_notin_ = str_replace("'","xxxxxx",$myhawb_notin);
        $row = array(
            'No' => $no_,
            'Name' => $row4->FullName,
            'Group' => $row4->GroupName,
            'Target' => '<a onclick="ftarget('."'".$mytlc_."'".','."'".$mydig_."'".','."'".$type_clear_1."'".','."''".','."'1'".')" id="preview" data-uk-tooltip >'.$ntarget.'</a>',
            'Actual' => '<a onclick="ftarget('."'".$mytlc_."'".','."'".$mydig_."'".','."'".$type_clear_1."'".','."'".$myhawb_in_."'".','."'2'".')" id="preview" data-uk-tooltip >'.$nactual.'</a>',
            'Selisih' =>'<a onclick="ftarget('."'".$mytlc_."'".','."'".$mydig_."'".','."'".$type_clear_1."'".','."'".$myhawb_notin_."'".','."'3'".')" id="preview" data-uk-tooltip >'.$nselisih.'</a>',
            'Persen' => $persen1.'%',
            );
		$data[] = $row;
        
        }
        
        $output = array(
						"draw" => 0,
						"recordsTotal" => 0 ,
						"recordsFiltered" => 0,
						"data" => $data,
				);
		echo json_encode($data);
        
        $cRet   .= "</table>";
        
     //   echo $cRet;
    
        
//        $data['prev']= $cRet;
//        $data['sikap'] = 'preview';
//        $judul  = 'History Type Clearance';       
//        switch($cetak) {       
//        case 1;
//             $this->Model_pdf->_mpdf('',$cRet,10,10,10,'1','y');
//        break;
//        case 2;        
//            header("Cache-Control: no-cache, no-store, must-revalidate");
//            header("Content-Type: application/vnd.ms-excel");
//            header("Content-Disposition: attachment; filename= $judul.xls");
//            $this->load->view('cas/rpt/ctk', $data);
//        break;
//        case 3;     
//            header("Cache-Control: no-cache, no-store, must-revalidate");
//            header("Content-Type: application/vnd.ms-word");
//            header("Content-Disposition: attachment; filename= $judul.doc");
//            $this->load->view('cas/rpt/ctk', $data);
//        break;
//        case 4;     
//            echo json_encode(array('status'=>true,'isi'=>$cRet));
//        break;
//        }         
    }
    
    function Detile_Monitoring_Ticket(){
        
         $mydig         = str_replace("xxxxxx","'",$this->input->post('digit'));
         $mytlc         = str_replace("xxxxxx","'",$this->input->post('tlc'));
         $type_clear_   = str_replace("xxxxxx","'",$this->input->post('type'));
         $myhawb        = str_replace("xxxxxx","'",$this->input->post('hawb'));
                 
        
         $q=$this->db->query("SELECT hawb,flight_date FROM t_shipment_cloud 
         WHERE $mydig  $mytlc $type_clear_ $myhawb");
         $no = 0 ;
         $data = array();
         foreach ($q->result() as $row_)
         {
            $no++;
            $row = array(
                'No' => $no,
                'Hawb' => $row_->hawb,
                'Date_Hawb' => $row_->flight_date,
                );
    		$data[] = $row;
         }
         echo json_encode($data);
    }
    
       function Monitoring_Dafter(){
        //if($this->input->post('text')==''){
//            exit();
//        }
        
       // $arr_data   =explode("|",$this->input->post('text'));
        $cetak      ='4';//$arr_data[0];
       // $tgl1       =$arr_data[1];
      //  $tgl2       =$arr_data[2];
      //  $per        =$arr_data[3];
       // $group      ='GROUP BY a.hawb';
       $tgl= $this->input->post('tgl'); 
        $where='';
        $cRet = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                     <thead>                       
                        <tr><td bgcolor=\"#CCCCCC\"  align=\"center\"><b>NO</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>HAWB</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>DATE UPDATE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>UPDATE TO CLEARANCE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>NOTE</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>USER UPDATE</b></td>
                        </tr>
                     </thead>
                     <tfoot>
                        <tr><td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>                      
                         </tr>
                     </tfoot>
                    ";
       $sql4="
       SELECT a.FullName,b.GroupName,a.Id,a.IdGroupUsr FROM msuser a INNER JOIN msgroup_usr b ON a.IdGroupUsr=b.Id 
       WHERE a.IdGroupUsr = '3' ORDER BY b.GroupName,a.FullName
       ";
                 
        $query4 = $this->db->query($sql4);
        $no     = 0;                                  
        $data = array();
		$no_ =0;// $_POST['start'];
        
        foreach ($query4->result() as $row4)
        {
           $no=$no+1;           
           $no_++;
           
            $smart_role=$this->Model_user->getCustom('Code1',"smart_role","WHERE GroupId='$row4->IdGroupUsr' GROUP BY Code1");
	     //===TLC  
            $mytlc ="AND b.TrackingStatus IN (";
            $mytlc_nu=0;
            foreach($smart_role as $row){      
				if($mytlc_nu==0){$mytlc .= "'".$row->Code1."'";}else{$mytlc .= ",'".$row->Code1."'";}
			$mytlc_nu++;
            }
            $mytlc .=")";
            if($mytlc_nu==0){$mytlc ="('')";}
            
                        $q=$this->db->query("SELECT COUNT(*) AS target FROM assign_hawb a INNER JOIN t_shipment_cloud b ON a.Hawb=b.hawb 
                        WHERE a.Id_User = '$row4->Id'  $mytlc ");
                        foreach ($q->result() as $row)
                        {
                          $target = $row->target;
                        }
                        
                        
                     $cRet    .= "<tr><td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$no</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->FullName</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->GroupName</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$mytlc </td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$target </td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" > <br>  </td>
                                 </tr>";
                                     
        $mytlc_ = str_replace("'","xxxxxx",$mytlc);
        $ntarget= number_format($target,"0",".",",");
        $row = array(
            'No' => $no_,
            'Name' => $row4->FullName,
            'Group' => $row4->GroupName,
            'Target' => '<a onclick="ftarget('."'".$mytlc_."'".','."'".$row4->Id."'".')" id="preview" data-uk-tooltip >'.$ntarget.'</a>',
            'Actual' => '',
            'Selisih' =>'',
            'Persen' => '',
            );
		$data[] = $row;
        
        }
        
        $output = array(
						"draw" => 0,
						"recordsTotal" => 0 ,
						"recordsFiltered" => 0,
						"data" => $data,
				);
		echo json_encode($data);
        
        $cRet   .= "</table>";
        
     //   echo $cRet;
    
        
//        $data['prev']= $cRet;
//        $data['sikap'] = 'preview';
//        $judul  = 'History Type Clearance';       
//        switch($cetak) {       
//        case 1;
//             $this->Model_pdf->_mpdf('',$cRet,10,10,10,'1','y');
//        break;
//        case 2;        
//            header("Cache-Control: no-cache, no-store, must-revalidate");
//            header("Content-Type: application/vnd.ms-excel");
//            header("Content-Disposition: attachment; filename= $judul.xls");
//            $this->load->view('cas/rpt/ctk', $data);
//        break;
//        case 3;     
//            header("Cache-Control: no-cache, no-store, must-revalidate");
//            header("Content-Type: application/vnd.ms-word");
//            header("Content-Disposition: attachment; filename= $judul.doc");
//            $this->load->view('cas/rpt/ctk', $data);
//        break;
//        case 4;     
//            echo json_encode(array('status'=>true,'isi'=>$cRet));
//        break;
//        }         
    }
    function Detile_Monitoring_dafter(){
        
         $mytlc         = str_replace("xxxxxx","'",$this->input->post('tlc'));
         $id            = $this->input->post('cid');        
        
         $q=$this->db->query("SELECT b.hawb,b.flight_date,c.CodeStatus,c.Keterangan,b.TrackingRemark FROM assign_hawb a 
                            INNER JOIN t_shipment_cloud b ON a.Hawb=b.hawb 
                            LEFT JOIN statusproses c ON b.TrackingStatus=c.Noid
                            WHERE a.Id_User = '$id'  $mytlc  order by b.flight_date ");
         $no = 0 ;
         $data = array();
         foreach ($q->result() as $row_)
         {
            $no++;
            $row = array(
                'No' => $no,
                'Hawb' => $row_->hawb,
                'Date_Hawb' => $row_->flight_date,
                'Tlc' => $row_->CodeStatus.'-'.$row_->Keterangan,
                'Remark' => $row_->TrackingRemark,
                );
    		$data[] = $row;
         }
         echo json_encode($data);
    }
        
   function v_rpt_user_assignt(){
         $data=array(
		  'title'=>'Report User Assignt',
		  'modulname'=>'REPORT USER ASSIGNT',
          'ismenu'=>'1',
		  'menu'=>'front/Menu/rate_menu',
		  'content'=>'cas/Cas_rpt/rpt_user_assignt',
		  );
        $this->load->view('template/template',$data);
   }
   
   function rpt_user_assignt(){
        if($this->input->post('text')==''){
            exit();
        }
        
        $arr_data   =explode("|",$this->input->post('text'));
        $cetak      =$arr_data[0];
        $tgl1       =$arr_data[1];
        $tgl2       =$arr_data[2];
        $idusr      =$arr_data[3];
        $per        =$arr_data[4];
        $sts        =$arr_data[5];
        $whusr =  "AND Id_User ='$idusr'";
//        $ckusr      =$arr_data[6];
        
//        if($ckusr==1){
//            $whusr =  "AND Id_User ='$idusr'";
//        }else{
//            $whusr =  "";
//        }
        
        
        $group      ='GROUP BY a.hawb';
        $where_sts  = '';
        switch ($sts){
            case 2:
                $where_sts="AND a.TrackingStatus <> '37'";
                break;
            case 3:
                $where_sts="AND a.TrackingStatus = '37'";
                break;
        } 
        
        $where='';
        $cRet = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                     <thead>                       
                        <tr><td bgcolor=\"#CCCCCC\"  align=\"center\"><b>NO</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>MAWB</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>HAWB</b></td>";                           
         if($per==1){
         $cRet .= "         <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACING NO</b></td>";
         $group      ='';
         }
         $cRet .= "
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>FLIGHT DATE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CLEARANCE</b></td>  
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CLEARANCE PMK 182</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>KIND OF GOOD</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>WEIGHT</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>PACKAGE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>VALUE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TLC</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACKING</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACKING DATE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACKING REMARK</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER NAME</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER ADDRESS1</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER ADDRESS2</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER CITY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER COMPANY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE NAME</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE ADDRESS</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE CITY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE COMPANY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE PHONE</b></td>
                        </tr>
                        
                     </thead>
                     <tfoot>
                        <tr><td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>";                           
         if($per==1){
         $cRet .= "         <td style=\"border-top: none;\"></td>";
         }
         $cRet .= "
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>                       
                         </tr>
                     </tfoot>
                    ";
        
       $sql4="
       SELECT 
	   a.mawb,a.hawb,b.trackno,a.flight_date,c.Keterangan AS clearance,a.kindofGood,a.Weight,a.Package,
	   a.shipper_name,a.shipper_address1,a.shipper_address2,a.shipper_city,a.shipper_company,
	   a.consignee_name,a.consignee_address,a.consignee_city,a.consignee_country,a.consignee_phone,
	   d.CodeStatus,d.Keterangan,a.TrackingDate,a.kindofGood,e.UR_JNS,e.ket,a.FOB,TrackingRemark
       FROM t_shipment_cloud a 
       INNER JOIN t_bill b ON a.hawb=b.hawb
       LEFT JOIN tm_typeclearance c ON a.type_clearance=c.TypeClearance
       LEFT JOIN statusproses d ON a.TrackingStatus=d.Noid
       LEFT JOIN bc_m_jns_aju e ON a.Id_aju=e.id_aju
       INNER JOIN assign_hawb f ON a.hawb=f.Hawb
       WHERE a.flight_date BETWEEN '$tgl1' AND '$tgl2' $whusr  $where_sts  $group order by a.flight_date
       ";
                 
        $query4 = $this->db->query($sql4);
        $no     = 0;                                  
        
        foreach ($query4->result() as $row4)
        {
           $no=$no+1;           
                     $cRet    .= "<tr><td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$no</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->mawb</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->hawb</td>";                           
                     if($per==1){
                     $cRet .= "      <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->trackno</td>";
                     }
                     $cRet .= "
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->flight_date</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->clearance</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->UR_JNS - $row4->ket</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->kindofGood</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" align=\"right\">$row4->Weight</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" align=\"right\">$row4->Package</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" align=\"right\">$row4->FOB</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->CodeStatus</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->Keterangan</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->TrackingDate</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->TrackingRemark</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_name</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_address1</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_address2</td>                                    
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_city</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_company</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_name</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_address</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_city</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_country</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_phone</td>
                                 </tr>";
        }
        
        $cRet   .= "</table>";
        
        $data['prev']= $cRet;
        $data['sikap'] = 'preview';
        $judul  = 'Cetak_Manifest';
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
    
function v_rpt_noprogress_status(){
         $data=array(
          'title'=>'Report Status Tracking',
          'ismenu'=>'1',
          'content'=>'cas/Cas_rpt/rpt_no_changes',
          );
        $this->load->view('template/template',$data);
    }
function rpt_noprogress_status(){
        if($this->input->post('text')==''){
            exit();
        }
        
        $arr_data   =explode("|",$this->input->post('text'));
        $cetak      =$arr_data[0];
        $countdays  =$arr_data[1];
        //$tgl2       =$arr_data[2];
        $tlc_a      =$arr_data[3];
        $type_a     =$arr_data[4];
        $per        =$arr_data[5];
        $group      ='GROUP BY a.hawb';
        
            /*hitung mundur 2 hari*/
            $min="-".$countdays.'days';
            $min2="-2".'days';
            $tgl2=date('Y-m-d');
            $tgl_min2=date('Y-m-d',strtotime($min2));
            $tgl_custom=date('Y-m-d',strtotime($min));
            
        $arr_tlc    =explode(",",$tlc_a);
        $tlc        ='(';
        $nu         =0;
        foreach($arr_tlc as $key) {    
            if($nu==0){$tlc .= "'".$key."'";}else{$tlc .= ","."'".$key."'";}
            $nu=$nu+1;    
        }        
        $tlc        .=')';
        
        
        $arr_type    =explode(",",$type_a);
        $type        ='(';
        $nu         =0;
        foreach($arr_type as $key) {    
            if($nu==0){$type .= "'".$key."'";}else{$type .= ","."'".$key."'";}
            $nu=$nu+1;    
        }        
        $type        .=')';
        
        
        $where='';
        $cRet = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                     <thead>                       
                        <tr><td bgcolor=\"#CCCCCC\"  align=\"center\"><b>NO</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>MAWB</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>HAWB</b></td>";                           
         if($per==1){
         $cRet .= "         <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACING NO</b></td>";
         $group      ='';
         }
         $cRet .= "
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>FLIGHT DATE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CLEARANCE</b></td>  
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CLEARANCE PMK 182</b></td> 
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>KIND OF GOOD</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>WEIGHT</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>PACKAGE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>VALUE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TLC</b></td>                            
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACKING</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>TRACKING DATE</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER NAME</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER ADDRESS1</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER ADDRESS2</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER CITY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>SHIPPER COMPANY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE NAME</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE ADDRESS</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE CITY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE COMPANY</b></td>
                            <td bgcolor=\"#CCCCCC\"  align=\"center\"><b>CONSIGNEE PHONE</b></td>
                        </tr>
                        
                     </thead>";
        
       $sql4="
       SELECT 
       a.mawb,a.hawb,b.trackno,a.flight_date,c.Keterangan AS clearance,a.kindofGood,a.Weight,a.Package,
       a.shipper_name,a.shipper_address1,a.shipper_address2,a.shipper_city,a.shipper_company,
       a.consignee_name,a.consignee_address,a.consignee_city,a.consignee_country,a.consignee_phone,
       d.CodeStatus,d.Keterangan,a.TrackingDate,a.kindofGood,e.UR_JNS,e.ket,a.FOB
       FROM t_shipment_cloud a 
       INNER JOIN t_bill b ON a.hawb=b.hawb
       LEFT JOIN tm_typeclearance c ON a.type_clearance=c.noid
       LEFT JOIN statusproses d ON a.TrackingStatus=d.Noid
       LEFT JOIN bc_m_jns_aju e ON a.Id_aju=e.id_aju
       WHERE a.Type_clearance in $type and a.TrackingStatus in $tlc AND a.TrackingDate >='$tgl_custom' AND a.TrackingDate <='$tgl_min2' $group order by a.flight_date
       ";
                 
        $query4 = $this->db->query($sql4);
        $no     = 0;                                  
        
        foreach ($query4->result() as $row4)
        {
           $no=$no+1;           
                     $cRet    .= "<tr><td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$no</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->mawb</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->hawb</td>";                           
                     if($per==1){
                     $cRet .= "      <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->trackno</td>";
                     }
                     $cRet .= "
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->flight_date</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->clearance</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->UR_JNS - $row4->ket</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->kindofGood</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" align=\"right\" >$row4->Weight</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" align=\"right\" >$row4->Package</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" align=\"right\" >$row4->FOB</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->CodeStatus</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->Keterangan</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->TrackingDate</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_name</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_address1</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_address2</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_city</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->shipper_company</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_name</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_address</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_city</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_country</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_phone</td>
                                 </tr>";
        }
        
        $cRet   .= "</table>";
        
        $data['prev']= $cRet;
        $data['sikap'] = 'preview';
        $judul  = 'Cetak_Type_Tracking';
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
        case 4;     
            echo json_encode(array('status'=>true,'isi'=>$cRet));
        break;
        }         
    }


 public function cmbTypeClearance()
    {
        $list = $this->Mdata->getCustom("*","tm_typeclearance","");
        
        $data = array();
        $no = 0;

        foreach ($list as $rec){
            $no++;
            $row = array(
            'id' => $rec->TypeClearance,
            'name' => $rec->Keterangan,
            'isi' => ''
            );
            $data[] = $row;
        }
        echo json_encode($data);
    }
    public function cmbStatusProses()
    {
        $not="'401','402','403','404','405','406','407','408','37','65'";
        $list = $this->Mdata->getCustom("*","statusproses",
                "WHERE Noid NOT IN($not)");
        
        $data = array();
        $no = 0;
        foreach ($list as $rec){
            $no++;
            $row = array(
            'id' => $rec->Noid,
            'name' => $rec->CodeStatus.'-'.$rec->Keterangan,
            'isi' => ''
            );
            $data[] = $row;
        }
        echo json_encode($data);
    }
    

}





