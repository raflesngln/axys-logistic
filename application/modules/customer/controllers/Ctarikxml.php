<?php
class Ctarikxml extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('cas/Mdata');
		$this->load->model('cas/Model_cari');
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('cas/Model_pdf');
//        $this->load->library('Sesi_login');
//		if($this->sesi_login->log_session() !=TRUE){
//			redirect('login/login');
//			return false;
//		}
    }
    
    function autonumb($nmtabel='',$key='',$noawal=''){
        $length = strlen($noawal);
        $query=$this->db->query("SELECT RIGHT($key,5) AS nou FROM $nmtabel WHERE LEFT($key,$length)='$noawal' AND IdUser = '00' ORDER BY $key DESC LIMIT 0,1");
        $nobaru1='';
        if($query->num_rows() > 0){
            foreach($query->result() as $t){
                $tmp=((int)$t->nou)+1;
                $nobaru1=sprintf("%05s",$tmp);
            }
        }else{
            $nobaru1="00001";
        }
        $nobaru=$noawal.$nobaru1;
        return $nobaru; 
    }
    
    function mydate(){
        $tgl=date('Y-m-d');
        $mytgl=explode('-',$tgl);
        $y=substr($mytgl[0],2);
        $m=$mytgl[1];
        $d=$mytgl[2];
        return $y.$m.$d;
    }
    
    function showfile_server(){
        $dir= "/var/www/html/web/api_cas/asset/wsdl/all_response";
        $json = json_decode(file_get_contents(base_url().'file/json/file_response.json'), true);
        $sts = json_decode(file_get_contents(base_url().'file/json/sts_update.json'), true);
        if($sts[0]=='0'){
            
            $fsts = fopen('./file/json/sts_update.json', 'w');
            fwrite($fsts, json_encode(array("1")));
            fclose($fsts);
            
        $format_tgl= $this->mydate();
        $filejson = array();
            if(is_dir($dir))
            {
              if($handle = opendir($dir))
              {
                while(($file = readdir($handle)) !== false)
                {
                  if(substr($file,0,6)==$format_tgl){
                    $filejson[]=$file;
                    if (in_array($file, $json)){
                        
                    }else{
                      //  $this->loadxml($file);
                    }
                  }
                }
                closedir($handle);
              }
            }
        $fp = fopen('./file/json/file_response.json', 'w');
        fwrite($fp, json_encode($filejson));
        fclose($fp);
        
            $fsts = fopen('./file/json/sts_update.json', 'w');
            fwrite($fsts, json_encode(array("0")));
            fclose($fsts);
        
        }else{
            
        }
    }
    
    function loadxml($file){
        //$file='170519_05190000228667.xml';
        $xml=simplexml_load_file("http://192.168.88.33:8080/asset/wsdl/all_response/".$file);
          foreach ($xml->RESPONSE as $response) {
            foreach ($response->HEADER as $data) {
               $Hawb = $data->NO_BARANG;
               $Code = $data->KD_RESPON;
               $Ket  = $data->KET_RESPON;
               $wk   = $data->WK_REKAM;
               
               $delwhere = array(
                    'Hawb'              => $Hawb,
                    'IdStatusProses'    => $Code,
                    'DateUpdate'        => $wk,
               );
               $this->Mdata->delete_where($delwhere,'dstatusproses');
               
                $tgl= date('Y-m-d');
                $extgl=explode("-",$tgl);
                $noawal1=$extgl[0].$extgl[1].$extgl[2];
                $Id   = $this->autonumb('dstatusproses','Id',$noawal1);
               
               $nmtabel='dstatusproses';
               $data_ = array(
                  'Id'                => $Id,
                  'Hawb'              => $Hawb,
                  'DateUpdate'        => $wk,
                  'IdStatusProses'    => $Code,
                  'StatusProses'      => $Ket,
                  'Note'              => $Code.' - '.$Ket,
                  'IdImport'          => '',
                  'IdUser'            => '00',
                  'UserName'          => 'UPPMK',
                  'ModifDate'         => $wk,
               );
               $insert = $this->Mdata->save($data_,$nmtabel);
//            ====================== UPDATE HEADER ===================  
               $q=$this->db->query("SELECT DateUpdate,IdStatusProses,StatusProses,Note  FROM dstatusproses WHERE Hawb ='$Hawb' ORDER BY DateUpdate DESC ,Id DESC LIMIT 0,1");
               foreach ($q->result() as $row_123)
               {
                        $nmtabel_='t_shipment_cloud';
                        $key_='hawb';
              	        $data_ku = array(
                                    'TrackingStatus' => $row_123->IdStatusProses,
                                    'TrackingDate' => $row_123->DateUpdate,
                                    'TrackingRemark' => $row_123->Note,
                    			);
                    	$this->Mdata->update(array($key_ => $Hawb), $data_ku,$nmtabel_);
               }
//            ===================================================
               
                  foreach($data as $key => $val){
                   //==================== ADD FILE PDF =======
                   if($key=='PDF'){
                        $pdf_decoded = base64_decode ($val);
                        $pdf = fopen ('./file/manifest/_'.$Hawb.'_'.$Code.'.pdf','w');
                        fwrite ($pdf,$pdf_decoded);
                        fclose ($pdf);
                        
                        $delwhere = array(
                                'IdAttachment'  => '_'.$Hawb.'_'.$Code,
                        );
                        $this->Mdata->delete_where($delwhere,'attachment');
                        
                            $nmtabel='attachment';
                    		$data_ = array(
                                    'IdAttachment'      => '_'.$Hawb.'_'.$Code,
                                    'Reff'              => $Hawb,
                                    'AttachmentDate'    => $wk,
                    				'AttachmentName'    => '_'.$Hawb.'_'.$Code.'.pdf',
                                    'AttachmentEx'      => 'pdf',
                                    'AttachmentType'    => $Code,
                                    'Description'       => $Code.' - '.$Ket,
                                    'IdUser'            => '00',
                                    'UserName'          => 'UPPMK',
                    			);
                    		$insert = $this->Mdata->save($data_,$nmtabel);
                   }
                   //==================== END ================
                   if($key=='NO_SPPBMCP'){
                        $nosppbmcp = $data->NO_SPPBMCP;
                        $tglsppbmcp = $data->TGL_SPPBMCP;
                        $nmtabel='t_shipment_cloud';
                        $key='hawb';
                		$data_update_sppb = array(
                                        'Sppb' => $nosppbmcp,
                                        'tglsppb' => $tglsppbmcp,
                                        
                			);
                		$this->Mdata->update(array($key => $Hawb), $data_update_sppb,$nmtabel);
                   }
                   if($key=='KODE_BILLING'){
                      $pph = 0;
                      $ppn = 0;
                      $bm  = 0;
                        foreach ($data->DETIL_PUNGUTAN as $det1) {
                          foreach ($det1->PUNGUTAN as $det) {
                            if($det->KD_PUNGUTAN=='411123 - PPH Impor'){
                               $pph =  $det->NILAI ;
                            }
                            if($det->KD_PUNGUTAN=='411212 - PPN Impor'){
                               $ppn =  $det->NILAI ;
                            }
                            if($det->KD_PUNGUTAN=='412111 - Bea Masuk'){
                               $bm =  $det->NILAI ;
                            }
                          }
                        }
                        
                        $delwhere = array(
                                'Hawb'          => $Hawb,
                                'kode_billing'  => $data->KODE_BILLING,
                                'tgl_billing'   => $data->TGL_BILLING,
                        );
                        $this->Mdata->delete_where($delwhere,'bc_billing');
                        
                        $nmtabel='bc_billing';
                    	$data_ = array(
                                    'Hawb'          => $Hawb,
                                    'kode_billing'  => $data->KODE_BILLING,
                                    'tgl_billing'   => $data->TGL_BILLING,
                    				'tgl_jt_tempo'  => $data->TGL_JT_TEMPO,
                                    'kd_dok_billing'=> $data->KD_DOK_BILLING,
                                    'pph'           => $pph,
                                    'ppn'           => $ppn,
                                    'bm'            => $bm,
                                    'total_billing' => $data->TOTAL_BILLING,
                    			);
                    	 $insert = $this->Mdata->save($data_,$nmtabel);
                   }
                  }
            }
         }
    }
    
    function rafles(){
        
        $cetak = 1;
            
        $cRet = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                     <thead>                       
                        <tr>
                            <th bgcolor=\"#CCCCCC\"  align=\"center\"><b>No</b></th>
                            <th bgcolor=\"#CCCCCC\"  align=\"center\"><b>AWB</b></th>  
                            <th bgcolor=\"#CCCCCC\"  align=\"center\"><b>MAWB</b></th> 
                            <th bgcolor=\"#CCCCCC\"  align=\"center\"><b>Flight Date</b></th>                            
                            <th bgcolor=\"#CCCCCC\"  align=\"center\"><b>Consignee Name</b></th>
                            <th bgcolor=\"#CCCCCC\"  align=\"center\"><b>Consignee NPWP</b></th>
                            <th bgcolor=\"#CCCCCC\"  align=\"center\"><b>Pieces</b></th>  
                            <th bgcolor=\"#CCCCCC\"  align=\"center\"><b>Weight</b></th> 
                            <th bgcolor=\"#CCCCCC\"  align=\"center\"><b>F.O.B</b></th>                            
                            <th bgcolor=\"#CCCCCC\"  align=\"center\"><b>Kind OF Good</b></th>
                            <th bgcolor=\"#CCCCCC\"  align=\"center\"><b>HS Code</b></th>
                            <th bgcolor=\"#CCCCCC\"  align=\"center\"><b>C.I.F</b></th>  
                            <th bgcolor=\"#CCCCCC\"  align=\"center\"><b>BM %</b></th> 
                            <th bgcolor=\"#CCCCCC\"  align=\"center\"><b>BM Value</b></th>
                            <th bgcolor=\"#CCCCCC\"  align=\"center\"><b>PPN %</b></th>  
                            <th bgcolor=\"#CCCCCC\"  align=\"center\"><b>PPN Value</b></th> 
                            <th bgcolor=\"#CCCCCC\"  align=\"center\"><b>PPH %</b></th>                            
                            <th bgcolor=\"#CCCCCC\"  align=\"center\"><b>PPH Value</b></th>
                            <th bgcolor=\"#CCCCCC\"  align=\"center\"><b>Total Tax</b></th>
                            <th bgcolor=\"#CCCCCC\"  align=\"center\"><b>Last Status</b></th>  
                            <th bgcolor=\"#CCCCCC\"  align=\"center\"><b>DateTime</b></th> 
                            <th bgcolor=\"#CCCCCC\"  align=\"center\"><b>Action to Be taken</b></th>                            
                            <th bgcolor=\"#CCCCCC\"  align=\"center\"><b>408DateTime</b></th>
							<th bgcolor=\"#CCCCCC\"  align=\"center\"><b>LeadTime</b></th>
                        </tr>
                        
                     </thead>
                     <tfoot>
                        <tr>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>
                            <td style=\"border-top: none;\"></td>                       
                         </tr>
                     </tfoot>
                    ";
        
        $sql4="SELECT * FROM dbclearance_gtln.bc_t_shipment  WHERE flight_date ='2017-06-26'";
                 
        $query4 = $this->db->query($sql4);
        $no     = 0;                                  
        
        foreach ($query4->result() as $row4)
        {
           $no=$no+1;
           $hawb             = $row4->hawb;
           $kdrespon = 'Tidak Ada Respone';
           $wkrespon = 'Tidak Ada Respone';
           $sql_="SELECT KD_RESPON,WK_REKAM,hawb FROM (
                    SELECT NO_BARANG,KD_RESPON,WK_REKAM FROM dbclearance_gtln.bc_respone_100
					INNER JOIN dbclearance_gtln.bc_t_shipment WHERE NO_BARANG = '$hawb'
                    UNION ALL
                    SELECT NO_BARANG,KD_RESPON,WK_REKAM FROM dbclearance_gtln.bc_respone_200
					INNER JOIN dbclearance_gtln.bc_t_shipment WHERE NO_BARANG = '$hawb'
                    UNION ALL
                    SELECT NO_BARANG,KD_RESPON,WK_REKAM FROM dbclearance_gtln.bc_respone_300 
					INNER JOIN dbclearance_gtln.bc_t_shipment WHERE NO_BARANG = '$hawb'
                    UNION ALL
                    SELECT NO_BARANG,KD_RESPON,WK_REKAM FROM dbclearance_gtln.bc_respone_500 
					INNER JOIN dbclearance_gtln.bc_t_shipment WHERE NO_BARANG = '$hawb'
                    UNION ALL
                    SELECT NO_BARANG,KD_RESPON,WK_REKAM FROM dbclearance_gtln.bc_respone_900 
					INNER JOIN dbclearance_gtln.bc_t_shipment WHERE NO_BARANG = '$hawb'
                    ) AS tabel ORDER BY WK_REKAM DESC LIMIT 0,1";
           $query_ = $this->db->query($sql_);
           foreach ($query_->result() as $row_)
           {
                
                $kdrespon = $row_->KD_RESPON;
                $wkrespon = $row_->WK_REKAM;
           
           }
/*		    $sql5="SELECT * from dbclearance_gtln.bc_t_shipment where hawb='$hawb'";
			$myresult = $this->db->query($sql5);
			foreach ($myresult->result() as $dt)
           {
			   $my_awb=($dt->awb !='')?$dt->awb:'';
		   }*/
                     $cRet    .= "<tr>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$hawb</td>                                     
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$kdrespon</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row_->WK_REKAM</td>
									 <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$my_awb</td>
									 
                                 </tr>";
        }
        
        $cRet   .= "</table>";
		  $data['prev']= $cRet;
        $data['sikap'] = 'preview';
        $judul  = 'Cetak_Manifest';
      // echo $cRet;
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename= lap.xls");
            $this->load->view('cas/rpt/ctk', $data);
    }

    
}