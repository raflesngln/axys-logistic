<?php
class Gtln_report_manifest extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('front/Mdata');
        $this->load->model('cas/Model_gtln');
		$this->load->model('cas/Model_pdf');
        $this->load->library('Sesi_login');
		if($this->sesi_login->log_session() !=TRUE){
			redirect('login/login');
			return false;
		}
        date_default_timezone_set('Asia/Jakarta');
    }
    
 
	
    function manifest_non_4xx(){
         $data=array(
		  'title'=>'Non status 4xx manifest ',
          'ismenu'=>'1',
		  'content'=>'cas/gtln_report/manifest_non_4xx'
		  );
		$cari=$this->Model_gtln->getCustom("NO_BARANG","bc_respone_4xx_crm"," GROUP BY NO_BARANG");
		$no_brg='';
		$query='';
		$numb=1;
		foreach($cari as $dt){
			$no_brg.="'".$dt->NO_BARANG."',";
		}
		$no_brg_clean=rtrim($no_brg,',');
		
		$this->session->unset_userdata('session_non_4xx');
		$session_data = array('session_non_4xx'  => $no_brg_clean);
		$this->session->set_userdata($session_data);

        $this->load->view('template/template',$data);
    }

 function view_gtln(){
	 $data['content']='cas/gtln_report/v_gtln2';
      $this->load->view('template/template',$data);
 }
 function phpexcel(){	 
		$this->load->library('PHPExcel');
		$this->load->library('PHPExcel/IOFactory');
		// merubah style border pada cell yang aktif (cell yang terisi)
		$styleArray = array( 'borders' => 
			array( 'allborders' => 
				array( 'style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'), 
					), 
				), 
			);
			
	$font_title = array( 
			'font' => array(
				'bold' => true,
				'size' => 16,
				'color' => array('rgb' => '0000FF')
			)
		);
		// melakukan pengaturan pada header kolom
		$fontHeader = array( 
			'font' => array(
				'bold' => true
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
             	'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
             	'rotation'   => 0,
			),
			'fill' => array(
            	'type' => PHPExcel_Style_Fill::FILL_SOLID,
            	'color' => array('rgb' => '6CCECB')
        	)
		);

		$objPHPExcel = new PHPExcel();
		// data dibuat pada sheet pertama
		$objPHPExcel->setActiveSheetIndex(0); 

		$tanggal=$this->input->post('tgl1');
		
//----------------------CREATE COLOUMN HEADER------------------------------------------------------------------------
		
		$objPHPExcel->getActiveSheet()->setCellValue('B2', 'Manifest Non-4xx tanggal '.date('d M Y',strtotime($tanggal)));
		$objPHPExcel->getActiveSheet()->setCellValue('B3', 'No');
		$objPHPExcel->getActiveSheet()->setCellValue('C3', 'Hawb');
		$objPHPExcel->getActiveSheet()->setCellValue('D3',  'Mawb');
		$objPHPExcel->getActiveSheet()->setCellValue('E3',  'flight_date');
		$objPHPExcel->getActiveSheet()->setCellValue('F3',  'consignee_name');
		$objPHPExcel->getActiveSheet()->setCellValue('G3',  'consignee_NPWP');
		$objPHPExcel->getActiveSheet()->setCellValue('H3', 'Package');
		$objPHPExcel->getActiveSheet()->setCellValue('I3',  'Weight');
		$objPHPExcel->getActiveSheet()->setCellValue('J3',  'FOB');
		$objPHPExcel->getActiveSheet()->setCellValue('K3',  'kindofGood');
		$objPHPExcel->getActiveSheet()->setCellValue('L3',  'hsCode');
		$objPHPExcel->getActiveSheet()->setCellValue('M3', 'CIF');
		$objPHPExcel->getActiveSheet()->setCellValue('N3',  'bm_persen');
		$objPHPExcel->getActiveSheet()->setCellValue('O3',  'bm_value');
		$objPHPExcel->getActiveSheet()->setCellValue('P3',  'ppn_persen');
		$objPHPExcel->getActiveSheet()->setCellValue('Q3',  'ppn_value');
		$objPHPExcel->getActiveSheet()->setCellValue('R3', 'pph_persen');
		$objPHPExcel->getActiveSheet()->setCellValue('S3',  'pph_value');
		$objPHPExcel->getActiveSheet()->setCellValue('T3',  'TotalTax');
		$objPHPExcel->getActiveSheet()->setCellValue('U3',  'kdrespon');
		$objPHPExcel->getActiveSheet()->setCellValue('V3',  'WK_REKAM');

		//make a border column
		$objPHPExcel->getActiveSheet()->getStyle('B3:V3')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		//-----------------------------------END create column HEADER------------------------------------------
		
       
        $sql="SELECT * FROM dbclearance_gtln.bc_t_shipment WHERE flight_date ='$tanggal'";
                 
        $result = $this->db->query($sql);
        $no     = 0;                                  
        
		$nomor=1;
		$kol=$nomor+3;
        foreach ($result->result() as $row)
        {
           $no=$no+1;
           $hawb             = $row->hawb;
           $kdrespon = 'Belum ada Respon BC';
           $wkrespon = '';
           $sql2="SELECT NO_BARANG,KD_RESPON,KET_RESPON,WK_REKAM,create_at FROM (
                    SELECT NO_BARANG,KD_RESPON,KET_RESPON,WK_REKAM,create_at FROM dbclearance_gtln.bc_respone_100 WHERE NO_BARANG = '$hawb'
                    UNION ALL
                    SELECT NO_BARANG,KD_RESPON,KET_RESPON,WK_REKAM,create_at FROM dbclearance_gtln.bc_respone_200 WHERE NO_BARANG = '$hawb'
                    UNION ALL
                    SELECT NO_BARANG,KD_RESPON,KET_RESPON,WK_REKAM,create_at FROM dbclearance_gtln.bc_respone_300 WHERE NO_BARANG = '$hawb'
                    UNION ALL
                    SELECT NO_BARANG,KD_RESPON,KET_RESPON,WK_REKAM,create_at FROM dbclearance_gtln.bc_respone_500 WHERE NO_BARANG = '$hawb'
                    UNION ALL
                    SELECT NO_BARANG,KD_RESPON,KET_RESPON,WK_REKAM,create_at FROM dbclearance_gtln.bc_respone_900 WHERE NO_BARANG = '$hawb'
                    ) AS tabel ORDER BY create_at DESC LIMIT 0,1";
         $result2 = $this->db->query($sql2);
		 foreach ($result2->result() as $row2){	
		 	$kdrespon = $row2->KD_RESPON;
            $wkrespon = $row2->KET_RESPON;;
		 }
//		$nomor=1;
//		$kol=$nomor+3;
//		 foreach ($result2->result() as $row2){		   
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$kol, $nomor);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$kol, $row->hawb);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$kol, "'".$row->mawb);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$kol, $row->flight_date);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$kol, $row->consignee_name);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$kol, $row->consignee_NPWP);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$kol, $row->Package);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$kol, "'".$row->Weight);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$kol, "'".$row->FOB);
				$objPHPExcel->getActiveSheet()->setCellValue('K'.$kol, $row->kindofGood);
				$objPHPExcel->getActiveSheet()->setCellValue('L'.$kol, $row->hsCode);
				$objPHPExcel->getActiveSheet()->setCellValue('M'.$kol, $row->CIF);
				$objPHPExcel->getActiveSheet()->setCellValue('N'.$kol, "'".$row->bm_persen);
				$objPHPExcel->getActiveSheet()->setCellValue('O'.$kol, "'".$row->bm_value);
				$objPHPExcel->getActiveSheet()->setCellValue('P'.$kol, $row->ppn_persen);
				$objPHPExcel->getActiveSheet()->setCellValue('Q'.$kol, $row->ppn_value);
				$objPHPExcel->getActiveSheet()->setCellValue('R'.$kol, $row->pph_persen);
				$objPHPExcel->getActiveSheet()->setCellValue('S'.$kol, "'".$row->pph_value);
				$objPHPExcel->getActiveSheet()->setCellValue('T'.$kol, "'".$row->TotalTax);
				$objPHPExcel->getActiveSheet()->setCellValue('U'.$kol, $kdrespon);
				$objPHPExcel->getActiveSheet()->setCellValue('V'.$kol, $wkrespon);
				
				$kol++;
				$nomor++;
			   //}
			
		}
			
			//auto size column
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(5);//setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);

		//for style
		$objWorksheet = $objPHPExcel->getActiveSheet();
		$objWorksheet->getStyle('B3:V3')->applyFromArray($fontHeader);
		$objWorksheet->getStyle('B2:H2')->applyFromArray($font_title);
		
		// Rename worksheet name
		$objPHPExcel->getActiveSheet()->setTitle('Report Manifest Non- 4xx');
		 
		// Set active sheet index to the first sheet, so <a class="zem_slink" title="Microsoft Excel" href="http://office.microsoft.com/en-us/excel" target="_blank" rel="homepage">Excel</a> opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		 
		// Redirect output to a client’s web browser (Excel2007)
		header('<a class="zem_slink" title="Internet media type" href="http://en.wikipedia.org/wiki/Internet_media_type" target="_blank" rel="wikipedia">Content-Type</a>: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Report Manifest Non-4xx_'.$tanggal.'.xlsx"');
		header('<a class="zem_slink" title="Web cache" href="http://en.wikipedia.org/wiki/Web_cache" target="_blank" rel="wikipedia">Cache-Control</a>: max-age=0');
		// If you're serving to <a class="zem_slink" title="Internet Explorer 9" href="http://windows.microsoft.com/ie" target="_blank" rel="homepage">IE 9</a>, then the following may be needed
		header('Cache-Control: max-age=1');
 
		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 <a class="zem_slink" title="Greenwich Mean Time" href="http://en.wikipedia.org/wiki/Greenwich_Mean_Time" target="_blank" rel="wikipedia">GMT</a>'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		ob_end_clean(); 
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
		
} 

 function generate_excel(){
        $tanggal=$this->input->post('tgl1');
        $cetak = 1;
            
        $cRet = "";
        $cRet .= "<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
                     <thead>                       
                        <tr>
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
                    ";
        
        $sql4="SELECT * FROM dbclearance_gtln.bc_t_shipment  WHERE flight_date ='$tanggal'";
                 
        $query4 = $this->db->query($sql4);
        $no     = 0;                                  
        
        foreach ($query4->result() as $row4)
        {
           $no=$no+1;
           $hawb             = $row4->hawb;
           $kdrespon = '';
           $wkrespon = '';
           $sql_="SELECT KD_RESPON,WK_REKAM FROM (
                    SELECT NO_BARANG,KD_RESPON,WK_REKAM FROM dbclearance_gtln.bc_respone_100 WHERE NO_BARANG = '$hawb'
                    UNION ALL
                    SELECT NO_BARANG,KD_RESPON,WK_REKAM FROM dbclearance_gtln.bc_respone_200 WHERE NO_BARANG = '$hawb'
                    UNION ALL
                    SELECT NO_BARANG,KD_RESPON,WK_REKAM FROM dbclearance_gtln.bc_respone_300 WHERE NO_BARANG = '$hawb'
                    UNION ALL
                    SELECT NO_BARANG,KD_RESPON,WK_REKAM FROM dbclearance_gtln.bc_respone_500 WHERE NO_BARANG = '$hawb'
                    UNION ALL
                    SELECT NO_BARANG,KD_RESPON,WK_REKAM FROM dbclearance_gtln.bc_respone_900 WHERE NO_BARANG = '$hawb'
                    ) AS tabel ORDER BY WK_REKAM DESC LIMIT 0,1";
           $query_ = $this->db->query($sql_);
           foreach ($query_->result() as $row_)
           {
                
                $kdrespon = $row_->KD_RESPON;
                $wkrespon = $row_->WK_REKAM;
           
           }

                     $cRet    .= "<tr>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$hawb</td>                       
                     				 <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->mawb</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->flight_date</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_name</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->consignee_NPWP</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->Package</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->Weight</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->FOB</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->kindofGood</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->hsCode</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->CIF</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->bm_persen</td>
									 <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->bm_value</td>
									 <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->ppn_persen</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->ppn_value</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->pph_persen</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->pph_value</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row4->TotalTax</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$kdrespon</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row_->WK_REKAM</td>
									 
									 
                                 </tr>";
        }
        
        $cRet   .= "</table>";
		  $data['prev']= $cRet;
        $data['sikap'] = 'preview';
        $judul  = 'Cetak_Manifest';
      // echo $cRet;
            header("Cache-Control: no-cache, no-store, must-revalidate");
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=Report_Respon_ $tanggal.xls");
            $this->load->view('cas/rpt/ctk', $data);
    } 

 function view_gtln2($periode='2'){
	 $date1='2017-06-27';//($this->input->post('tgl1')==''?$this->session->userdata('gtln_date1'):$this->input->post('tgl1'));
	 $date2='2017-06-27';;//($this->input->post('tgl2')==''?$this->session->userdata('gtln_date2'):$this->input->post('tgl2'));
	 		//$this->session->unset_userdata('gtln_date1');
			//$this->session->unset_userdata('gtln_date2');
		    $session_data =
						array(
						'gtln_date1'  => $date1,
						'gtln_date2'  => $date2
						);
		    $this->session->set_userdata($session_data);
	 $gtln_date1=$this->session->userdata('gtln_date1');
	 $gtln_date2=$this->session->userdata('gtln_date2');
	 
	 $tgl1=($gtln_date1 !='')?$gtln_date1:date('Y-m-d');
	 $tgl2=($gtln_date2 !='')?$gtln_date2:date('Y-m-d');
	 $data['tgl1']=$date1;
	 $data['tgl2']=$date2;
	
	 	//$tgl1='2017-06-27';
		//$tgl2='2017-06-28';
	  	$cari=$this->Model_gtln->getCustom("NO_BARANG","bc_respone_4xx_crm"," GROUP BY NO_BARANG");
		$no_brg='';
		$query='';
		$numb=1;
		foreach($cari as $dt){
			$no_brg.="'".$dt->NO_BARANG."',";
		}
		$no_brg_clean=rtrim($no_brg,',');
		
		//$this->session->unset_userdata('session_non_4xx');
		//$session_data = array('session_non_4xx'  => $no_brg_clean);
		//$this->session->set_userdata($session_data);

	 	$page=$this->uri->segment(5);
      	$limit=25;
		if(!$page):
		$offset = 0;
		else:
		$offset = $page;
		endif;
		
		$data['list']=$this->Model_gtln->getdatapaging("*",
		'bc_t_shipment a',"WHERE LEFT(a.flight_date,10) >= '$tgl1' AND LEFT(a.flight_date,10) <= '$tgl2' AND hawb NOT IN($no_brg_clean) order by a.hawb ASC LIMIT $offset,$limit");
		 		 
		$tot_hal = $this->Model_gtln->hitung_isi_tabel('*',
		'bc_t_shipment a',"WHERE LEFT(a.flight_date,10) >= '$tgl1' AND LEFT(a.flight_date,10) <= '$tgl2' AND hawb NOT IN($no_brg_clean) order by a.hawb ASC");
        					//create for pagination		
			$config['base_url'] = base_url() . 'cas/Gtln_report_manifest/view_gtln/'.$periode.'/';
  			$config['total_rows'] = $tot_hal->num_rows();
        	$config['per_page'] = $limit;
			$config['uri_segment'] = 5;
	    	$config['first_link'] = 'First';
			$config['last_link'] = 'last';
			$config['next_link'] = 'Next';
			$config['prev_link'] = 'Prev';
	//STYLE PAGIN FOR BOOTSTRAP
	
		$config['full_tag_open'] = "<ul class='uk-pagination uk-margin-medium-top'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li><span>';
		$config['num_tag_close'] = '</span></li>';
		$config['cur_tag_open'] = '<li class="uk-active"><span>';
		$config['cur_tag_close'] = '</span></li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = "</li>";
		$config['prev_tag_open'] = '<li>';
		$config['prev_tagl_close'] = "</li>";
		
       		$this->pagination->initialize($config);
			$data["paginator"] =$this->pagination->create_links();
			$data['halaman']=$config['per_page'];
		
		$data['content']='cas/gtln_report/v_gtln';
       $this->load->view('template/template',$data);
		//$this->load->view('cas/gtln_report/v_gtln',$data);
 } 
 public function download_excel_jobs2(){
		$this->load->library('PHPExcel');
		$this->load->library('PHPExcel/IOFactory');
		// merubah style border pada cell yang aktif (cell yang terisi)
		$styleArray = array( 'borders' => 
			array( 'allborders' => 
				array( 'style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'), 
					), 
				), 
			);
			
	$font_title = array( 
			'font' => array(
				'bold' => true,
				'size' => 16,
				'color' => array('rgb' => '0000FF')
			)
		);
		// melakukan pengaturan pada header kolom
		$fontHeader = array( 
			'font' => array(
				'bold' => true
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
             	'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
             	'rotation'   => 0,
			),
			'fill' => array(
            	'type' => PHPExcel_Style_Fill::FILL_SOLID,
            	'color' => array('rgb' => '6CCECB')
        	)
		);

		$objPHPExcel = new PHPExcel();
		// data dibuat pada sheet pertama
		$objPHPExcel->setActiveSheetIndex(0); 

		$tgl1=$this->input->post('tanggal1');
		$tgl2=$this->input->post('tanggal2');
		/*$tgl=date('Y-m-d',strtotime($get_tgl));
		$get_name=$this->uri->segment(6);
		$name=str_replace('%20','_',$get_name);*/
		
//----------------------CREATE COLOUMN HEADER------------------------------------------------------------------------
		
		$objPHPExcel->getActiveSheet()->setCellValue('B2', 'Manifest list Non-4xx Periode '.date('d M Y',strtotime($tgl1)).' - '.date('d M Y',strtotime($tgl2)) );
		$objPHPExcel->getActiveSheet()->setCellValue('B3', 'No');
		$objPHPExcel->getActiveSheet()->setCellValue('C3', 'Hawb');
		$objPHPExcel->getActiveSheet()->setCellValue('D3',  'Mawb');
		$objPHPExcel->getActiveSheet()->setCellValue('E3',  'flight_date');
		$objPHPExcel->getActiveSheet()->setCellValue('F3',  'consignee_name');
		$objPHPExcel->getActiveSheet()->setCellValue('G3',  'consignee_NPWP');
		$objPHPExcel->getActiveSheet()->setCellValue('H3', 'Package');
		$objPHPExcel->getActiveSheet()->setCellValue('I3',  'Weight');
		$objPHPExcel->getActiveSheet()->setCellValue('J3',  'FOB');
		$objPHPExcel->getActiveSheet()->setCellValue('K3',  'kindofGood');
		$objPHPExcel->getActiveSheet()->setCellValue('L3',  'hsCode');
		$objPHPExcel->getActiveSheet()->setCellValue('M3', 'CIF');
		$objPHPExcel->getActiveSheet()->setCellValue('N3',  'bm_persen');
		$objPHPExcel->getActiveSheet()->setCellValue('O3',  'bm_value');
		$objPHPExcel->getActiveSheet()->setCellValue('P3',  'ppn_persen');
		$objPHPExcel->getActiveSheet()->setCellValue('Q3',  'ppn_value');
		$objPHPExcel->getActiveSheet()->setCellValue('R3', 'pph_persen');
		$objPHPExcel->getActiveSheet()->setCellValue('S3',  'pph_value');
		$objPHPExcel->getActiveSheet()->setCellValue('T3',  'TotalTax');
		$objPHPExcel->getActiveSheet()->setCellValue('U3',  'kdrespon');
		$objPHPExcel->getActiveSheet()->setCellValue('V3',  'WK_REKAM');

		//make a border column
		$objPHPExcel->getActiveSheet()->getStyle('B3:V3')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		//-----------------------------------END create column HEADER------------------------------------------
		$cari=$this->Model_gtln->getCustom("NO_BARANG","bc_respone_4xx_crm"," GROUP BY NO_BARANG");
		$no_brg='';
		$query='';
		$numb=1;
		foreach($cari as $dt){
			$no_brg.="'".$dt->NO_BARANG."',";
		}
		$no_brg_clean=rtrim($no_brg,',');
		
 $result = $this->Model_gtln->getCustom("*",
		"bc_t_shipment a","WHERE LEFT(a.flight_date,10) >= '$tgl1' AND LEFT(a.flight_date,10) <= '$tgl2' AND hawb NOT IN($no_brg_clean) order by a.hawb");

		$no=1;
		$kol=$no+3;
		foreach($result as $list){			   
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$kol, $no);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$kol, $list->hawb);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$kol, "'".$list->mawb);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$kol, $list->flight_date);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$kol, $list->consignee_name);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$kol, $list->consignee_NPWP);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$kol, $list->Package);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$kol, "'".$list->Weight);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$kol, "'".$list->FOB);
				$objPHPExcel->getActiveSheet()->setCellValue('K'.$kol, $list->kindofGood);
				$objPHPExcel->getActiveSheet()->setCellValue('L'.$kol, $list->hsCode);
				$objPHPExcel->getActiveSheet()->setCellValue('M'.$kol, $list->CIF);
				$objPHPExcel->getActiveSheet()->setCellValue('N'.$kol, "'".$list->bm_persen);
				$objPHPExcel->getActiveSheet()->setCellValue('O'.$kol, "'".$list->bm_value);
				$objPHPExcel->getActiveSheet()->setCellValue('P'.$kol, $list->ppn_persen);
				$objPHPExcel->getActiveSheet()->setCellValue('Q'.$kol, $list->ppn_value);
				$objPHPExcel->getActiveSheet()->setCellValue('R'.$kol, $list->pph_persen);
				$objPHPExcel->getActiveSheet()->setCellValue('S'.$kol, "'".$list->pph_value);
				$objPHPExcel->getActiveSheet()->setCellValue('T'.$kol, "'".$list->TotalTax);
				$objPHPExcel->getActiveSheet()->setCellValue('U'.$kol, $list->TotalTax);
				$objPHPExcel->getActiveSheet()->setCellValue('V'.$kol, $list->TotalTax);
				$kol++;
				$no++;
			}
			
			//auto size column
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(5);//setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);

		//for style
		$objWorksheet = $objPHPExcel->getActiveSheet();
		$objWorksheet->getStyle('B3:V3')->applyFromArray($fontHeader);
		$objWorksheet->getStyle('B2:H2')->applyFromArray($font_title);
		
		// Rename worksheet name
		$objPHPExcel->getActiveSheet()->setTitle('Report Manifest Non- 4xx');
		 
		// Set active sheet index to the first sheet, so <a class="zem_slink" title="Microsoft Excel" href="http://office.microsoft.com/en-us/excel" target="_blank" rel="homepage">Excel</a> opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		 
		// Redirect output to a client’s web browser (Excel2007)
		header('<a class="zem_slink" title="Internet media type" href="http://en.wikipedia.org/wiki/Internet_media_type" target="_blank" rel="wikipedia">Content-Type</a>: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Report Manifest Non-4xx_'.$tgl1.'.xlsx"');
		header('<a class="zem_slink" title="Web cache" href="http://en.wikipedia.org/wiki/Web_cache" target="_blank" rel="wikipedia">Cache-Control</a>: max-age=0');
		// If you're serving to <a class="zem_slink" title="Internet Explorer 9" href="http://windows.microsoft.com/ie" target="_blank" rel="homepage">IE 9</a>, then the following may be needed
		header('Cache-Control: max-age=1');
 
		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 <a class="zem_slink" title="Greenwich Mean Time" href="http://en.wikipedia.org/wiki/Greenwich_Mean_Time" target="_blank" rel="wikipedia">GMT</a>'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		ob_end_clean(); 
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
} 


public function download_excel_jobs(){
		$this->load->library('PHPExcel');
		$this->load->library('PHPExcel/IOFactory');
		// merubah style border pada cell yang aktif (cell yang terisi)
		$styleArray = array( 'borders' => 
			array( 'allborders' => 
				array( 'style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '00000000'), 
					), 
				), 
			);
			
	$font_title = array( 
			'font' => array(
				'bold' => true,
				'size' => 16,
				'color' => array('rgb' => '0000FF')
			)
		);
		// melakukan pengaturan pada header kolom
		$fontHeader = array( 
			'font' => array(
				'bold' => true
			),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
             	'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
             	'rotation'   => 0,
			),
			'fill' => array(
            	'type' => PHPExcel_Style_Fill::FILL_SOLID,
            	'color' => array('rgb' => '6CCECB')
        	)
		);

		$objPHPExcel = new PHPExcel();
		// data dibuat pada sheet pertama
		$objPHPExcel->setActiveSheetIndex(0); 

		$tgl1=$this->input->post('tanggal1');
		$tgl2=$this->input->post('tanggal2');
		/*$tgl=date('Y-m-d',strtotime($get_tgl));
		$get_name=$this->uri->segment(6);
		$name=str_replace('%20','_',$get_name);*/

		$user_id=$this->session->userdata('cs_Idusr');
		
//----------------------CREATE COLOUMN HEADER------------------------------------------------------------------------
		
		$objPHPExcel->getActiveSheet()->setCellValue('B2', 'Manifest list Non-4xx Periode '.date('d M Y',strtotime($tgl1)).' - '.date('d M Y',strtotime($tgl2)) );
		$objPHPExcel->getActiveSheet()->setCellValue('B3', 'No');
		$objPHPExcel->getActiveSheet()->setCellValue('C3', 'Flight_date');
		$objPHPExcel->getActiveSheet()->setCellValue('D3',  'Mawb');

		$objPHPExcel->getActiveSheet()->setCellValue('E3',  'Hawb');
		$objPHPExcel->getActiveSheet()->setCellValue('F3',  'shipper_name');
		$objPHPExcel->getActiveSheet()->setCellValue('G3',  'consignee_name');

		//make a border column
		$objPHPExcel->getActiveSheet()->getStyle('B3:G3')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		//-----------------------------------END create column HEADER------------------------------------------
		$cari=$this->Model_gtln->getCustom("NO_BARANG","bc_respone_4xx_crm"," GROUP BY NO_BARANG");
		$no_brg='';
		$query='';
		$numb=1;
		foreach($cari as $dt){
			$no_brg.="'".$dt->NO_BARANG."',";
		}
		$no_brg_clean=rtrim($no_brg,',');
		
 $result = $this->Model_gtln->getCustom("*",
		"bc_t_shipment a","WHERE LEFT(a.flight_date,10) >= '$tgl1' AND LEFT(a.flight_date,10) <= '$tgl2' AND hawb NOT IN($no_brg_clean) order by a.hawb");

		$no=1;
		$kol=$no+3;
		foreach($result as $list){			   
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$kol, $no);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$kol, $list->flight_date);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$kol, "'".$list->mawb);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$kol, "'".$list->hawb);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$kol, $list->shipper_name);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$kol, $list->consignee_name);
				$kol++;
				$no++;
			}
			
			//auto size column
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(5);//setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);

		//for style
		$objWorksheet = $objPHPExcel->getActiveSheet();
		$objWorksheet->getStyle('B3:G3')->applyFromArray($fontHeader);
		$objWorksheet->getStyle('B2:G2')->applyFromArray($font_title);
		
		// Rename worksheet name
		$objPHPExcel->getActiveSheet()->setTitle('Report Manifest Non- 4xx');
		 
		// Set active sheet index to the first sheet, so <a class="zem_slink" title="Microsoft Excel" href="http://office.microsoft.com/en-us/excel" target="_blank" rel="homepage">Excel</a> opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		 
		// Redirect output to a client’s web browser (Excel2007)
		header('<a class="zem_slink" title="Internet media type" href="http://en.wikipedia.org/wiki/Internet_media_type" target="_blank" rel="wikipedia">Content-Type</a>: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Report Manifest Non-4xx_'.$tgl1.'.xlsx"');
		header('<a class="zem_slink" title="Web cache" href="http://en.wikipedia.org/wiki/Web_cache" target="_blank" rel="wikipedia">Cache-Control</a>: max-age=0');
		// If you're serving to <a class="zem_slink" title="Internet Explorer 9" href="http://windows.microsoft.com/ie" target="_blank" rel="homepage">IE 9</a>, then the following may be needed
		header('Cache-Control: max-age=1');
 
		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 <a class="zem_slink" title="Greenwich Mean Time" href="http://en.wikipedia.org/wiki/Greenwich_Mean_Time" target="_blank" rel="wikipedia">GMT</a>'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		ob_end_clean(); 
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
} 

function download_pdf_jobs(){
	$tgl1=$this->input->post('tanggal3');
	 $tgl2=$this->input->post('tanggal4');
      $cari=$this->Model_gtln->getCustom("NO_BARANG","bc_respone_4xx_crm"," GROUP BY NO_BARANG");
		$no_brg='';
		$query='';
		$numb=1;
		foreach($cari as $dt){
			$no_brg.="'".$dt->NO_BARANG."',";
		}
		$no_brg_clean=rtrim($no_brg,',');
		
	  $result=$this->Model_gtln->getCustom("*",
				"bc_t_shipment a",
	  			"WHERE LEFT(a.flight_date,10) >= '$tgl1' AND LEFT(a.flight_date,10) <= '$tgl2' AND hawb NOT IN($no_brg_clean) order by a.hawb");
				 
	$isi='<h3> GTLN - Manifest Non-4xx <span style="color:red">  ( ' .date('d M Y',strtotime($tgl1)). '</span> s/d - <span style="color:red">'.date('d M Y',strtotime($tgl2)).' )</span></h3>';
	         $isi .="<table style=\"border-collapse:collapse;\" width=\"100%\" align=\"center\" border=\"1\" cellspacing=\"0\" cellpadding=\"4\">
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
                     </thead>";
		$no=0;
		  foreach($result as $row){	
		  $no++;
             $isi.= "<tr><td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$no</td>                                   
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row->hawb</td>                       
                     				 <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row->mawb</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row->flight_date</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row->consignee_name</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row->consignee_NPWP</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row->Package</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row->Weight</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row->FOB</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row->kindofGood</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row->hsCode</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row->CIF</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row->bm_persen</td>
									 <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row->bm_value</td>
									 <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row->ppn_persen</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row->ppn_value</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row->pph_persen</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row->pph_value</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row->TotalTax</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$kdrespon</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >$row_->WK_REKAM</td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" >  </td>
                                     <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" > </td>
									 <td style=\"vertical-align:top;border-top: none;border-bottom: none;\" > </td>
                          </tr>";
				}
  	      $isi.= "</table>";
	$this->Model_pdf->_mpdf('',$isi,10,10,10,'1','y');
}


    
}


