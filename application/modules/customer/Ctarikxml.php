<?php
class Ctarikxml extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('cas/Mdata');
		$this->load->model('cas/Model_cari');
        date_default_timezone_set('Asia/Jakarta');
        $this->load->library('Sesi_login');
		if($this->sesi_login->log_session() !=TRUE){
			redirect('login/login');
			return false;
		}
    }
    
    function autonumb($nmtabel='',$key='',$noawal=''){
        $length = strlen($noawal);
        $query=$this->db->query("SELECT MAX(RIGHT($key,5)) AS nou FROM $nmtabel WHERE LEFT($key,$length)='$noawal' ORDER BY $key");
        $nobaru1='';
        if($query->num_rows() > 0){
            foreach($query->result() as $t){
                $tmp=((int)$t->nou)+1;
                $nobaru1=sprintf("%05s",$tmp);
            }
        }else{
            $nobaru1="001";
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
        $format_tgl= $this->mydate();
        $filejson = array();
   
            if(is_dir($dir))
            {
              if($handle = opendir($dir))
              {
                while(($file = readdir($handle)) !== false)// ========== load data file XML
                {        
                  if(substr($file,0,6)==$format_tgl){
                    $filejson[]=$file;
                    if (in_array($file, $json)){ // ================= Cek File Sudah Di kirim atau belum
                        
                    }else{
                       $this->loadxml($file);// ============= function save ke database
                    }
                  }
                }
                closedir($handle);
              }
            }

        $fp = fopen('./file/json/file_response.json', 'w');
        fwrite($fp, json_encode($filejson));
        fclose($fp);
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
               $this->Mdata->delete_where($delwhere,'dstatusproses_coba');
               
                $tgl=date('Y-m-d');
                $extgl=explode("-",$tgl);
                $noawal1=$extgl[0].$extgl[1].$extgl[2];
               $Id   = $this->autonumb('dstatusproses_coba','Id',$noawal1);
               
               //$nmtabel='dstatusproses_coba';
               $data_ = array(
                  'Id'                => $Id,
                  'Hawb'              => $Hawb,
                  'DateUpdate'        => $wk,
                  'IdStatusProses'    => $Code,
                  'StatusProses'      => $Ket,
                  'Note'              => $Code.' - '.$Ket,
                  'IdImport'          => '',
                  'IdUser'            => '',
                  'UserName'          => 'UPPMK',
                  'ModifDate'         => $wk,
               );
               $insert = $this->Mdata->save($data_,'dstatusproses_coba');
               
                  foreach($data as $key => $val){
                   //==================== ADD FILE PDF =======
                   if($key=='PDF'){
                        $pdf_decoded = base64_decode ($val);
                        $pdf = fopen ('./file/manifest/'.$Hawb.'_'.$Code.'_'.$noawal1.'.pdf','w');
                        fwrite ($pdf,$pdf_decoded);
                        fclose ($pdf);
                        
                        $delwhere = array(
                                'IdAttachment'  => '_'.$Hawb.'_'.$Code,
                        );
                        $this->Mdata->delete_where($delwhere,'attachment_coba');
                        
                            //$nmtabel='attachment_coba';
                    		$data_ = array(
                                    'IdAttachment'      => '_'.$Hawb.'_'.$Code,
                                    'Reff'              => $Hawb,
                                    'AttachmentDate'    => $wk,
                    				'AttachmentName'    => '_'.$Hawb.'_'.$Code.'.pdf',
                                    'AttachmentEx'      => 'pdf',
                                    'AttachmentType'    => $Code,
                                    'Description'       => $Code.' - '.$Ket,
                                    'IdUser'            => '',
                                    'UserName'          => 'UPPMK',
                    			);
                    		$insert = $this->Mdata->save($data_,'attachment_coba');
                   }
                   //==================== END ================
                   if($key=='NO_SPPBMCP'){
                        $nosppbmcp = $data->NO_SPPBMCP;
                        $tglsppbmcp = $data->TGL_SPPBMCP;
                        //$nmtabel='t_shipment_cloud';
                        //$key='hawb';
                		$data_update_sppb = array(
                                        'Sppb' => $nosppbmcp,
                                        'tglsppb' => $tglsppbmcp,
                                        
                			);
                		$this->Mdata->update(array('hawb' => $Hawb), $data_update_sppb,'t_shipment_cloud');
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
                        $this->Mdata->delete_where($delwhere,'bc_billing_coba');
                        
                        //$nmtabel='bc_billing_coba';
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
                    	 $insert = $this->Mdata->save($data_,'bc_billing_coba');
                   }
                  }
            }
         }
    }
    
}