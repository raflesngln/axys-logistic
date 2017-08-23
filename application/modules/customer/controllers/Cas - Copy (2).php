<?php
class Cas extends CI_Controller{
    
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
    
    function proses_import(){
            $config['upload_path'] = "./import/";
    		$config['allowed_types'] = 'gif|jpg|png';
            $this->load->library('upload', $config);
            
    		if ( ! $this->upload->do_upload("userfile"))
    		{
    			$error =$this->upload->display_errors();
    			echo json_encode(array('sts'=>false,'pesan'=>$error,'error'=>$error));
    		}
    		else
    		{
    		    echo json_encode(array('sts'=>true,'pesan'=>"Please Wait, Cek file......",'error'=>''));
            }
    }
    
    function autonumb($nmtabel='',$key='',$noawal=''){
        $length = strlen($noawal);
        $query=$this->db->query("SELECT MAX(RIGHT($key,3)) AS nou FROM $nmtabel WHERE LEFT($key,$length)='$noawal' ORDER BY $key");
        $nobaru1='';
        if($query->num_rows() > 0){
            foreach($query->result() as $t){
                $tmp=((int)$t->nou)+1;
                $nobaru1=sprintf("%03s",$tmp);
            }
        }else{
            $nobaru1="001";
        }
        $nobaru=$noawal.$nobaru1;
        return $nobaru; 
    }
    
    function validateDate($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }
    
    function upload_excel(){
        //=========== UPLOAD FILE ===================
        $filename = rand(1000000, 20);   
        $target_dir = "./import/";
        $target_file = $target_dir . basename($_FILES["userfile"]["name"]);
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        
        if($imageFileType == ''){
            $pesan = "Sorry, your did not select a file to upload.....!";
            echo json_encode(array('sts'=>false,'pesan'=>$pesan,'error'=>'error'));
        }else{
            if($imageFileType <> 'xlsx' and $imageFileType <> 'xls'){
                $pesan = "Sorry, your extension file is wrong.....!";
                echo json_encode(array('sts'=>false,'pesan'=>$pesan,'error'=>'error'));
            }else{
                // Check if image file is a actual image or fake image
                if (move_uploaded_file($_FILES["userfile"]["tmp_name"], $target_dir.$filename.'.'.$imageFileType)) {
                    $pesan = "Please Wait, Cek file......";
                    echo json_encode(array('sts'=>true,'pesan'=>$pesan,'error'=>'','namafile'=>$filename.'.'.$imageFileType));
                } else {
                    $pesan = "Sorry, your file error........!";
                    echo json_encode(array('sts'=>false,'pesan'=>$pesan,'error'=>'error'));
                }
             }
        }
         //============= END =========================
         //============= Reander Sheet ===============
        //$this->load->library('PHPExcel');
//        $objReader = PHPExcel_IOFactory::createReaderForFile('./import/'.$filename.'.xlsx');//PHPExcel_IOFactory::createReader('Excel2007');
//        $objReader->setReadDataOnly(true);
//        $worksheetNames = $objReader->listWorksheetNames('./import/'.$filename.'.xlsx');
//            $no = 0;
//    		foreach ($worksheetNames as $sheetName){
//    			$row = array(
//                'id' => $no,
//                'name' => $sheetName,
//                'isi' => ''
//                );
//    			$data[] = $row;
//                $no++;
//    		}
//    		$output = array(
//    						"data" => $data,
//    				);
//    		//output to json format
//    		echo json_encode($data);
        //============== end =========================
    }
    
    function sheet(){
        $this->load->library('PHPExcel');
        $objReader = PHPExcel_IOFactory::createReaderForFile('./import/218096.xlsx');//PHPExcel_IOFactory::createReader('Excel2007');
        $objReader->setReadDataOnly(true);
        $worksheetNames = $objReader->listWorksheetNames('./import/218096.xlsx');

        foreach ($worksheetNames as $sheetName) {
            echo $sheetName, '<br />';
        }
    }
 
     function count_row(){
        $filename=$this->input->post('namafile');
        $sheet =$this->input->post('nmsheet');
        $this->load->library('PHPExcel');
        $objReader = PHPExcel_IOFactory::createReaderForFile('./import/'.$filename);//PHPExcel_IOFactory::createReader('Excel2007');
        $objReader->setReadDataOnly(true);

        $objPHPExcel = $objReader->load('./import/'.$filename);
        $objWorksheet = $objPHPExcel->setActiveSheetIndex($sheet);
        $sheetname = $objPHPExcel->getSheetNames();
        $highestRow = $objWorksheet->getHighestRow(); 
        echo json_encode(array('count'=>$highestRow-2,'sheetname'=>$sheetname[$sheet]));
    }
    
    function cek_data(){
        //ini_set('memory_limit', '1024M');
        $filename=$this->input->post('namafile');
        $sheet =$this->input->post('nmsheet');
        
        $this->load->library('PHPExcel');
        $objReader = PHPExcel_IOFactory::createReaderForFile('./import/'.$filename);//PHPExcel_IOFactory::createReader('Excel2007');
        $objReader->setReadDataOnly(true);

        $objPHPExcel = $objReader->load('./import/'.$filename);
        $objWorksheet = $objPHPExcel->setActiveSheetIndex($sheet);
        $highestRow = $objWorksheet->getHighestRow(); 
        $highestColumn = $objWorksheet->getHighestColumn(); 
        
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); 
        
        $data = array();
        //========
        for ($row = 1; $row <= $highestRow; ++$row) {
            $error='error data row = '.$row.', ';
            $cek = 0;
          for ($col = 0; $col <= $highestColumnIndex; ++$col){
     if ($row>=3){       
            switch ($col) {
                     
               case 1: // carrier vendor
                     $val= $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
                        $query="SELECT COUNT(*) AS jml FROM msvendor_hdr where Id = '$val'";
                        $q=$this->db->query($query);
                        $rec=$q->row();
                        $count=$rec->jml;
                        if($count < 1){
                            $error .= "|Coloum = ".$col." ,Vendor = ".$val."| ,";
                            $cek=1;
                        }
                     break;
                     
                     
               case 4: case 6: case 7: case 8: case 9: case 0://port destination  rout1 rou2 rout3 rout4
                     $val= $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
                        if($val <> ''){
                            $query="SELECT COUNT(*) AS jml FROM msport where Codes = '$val'";
                            $q=$this->db->query($query);
                            $rec=$q->row();
                            $count=$rec->jml;
                            if($count < 1){
                                $error .= " |Coloum = ".$col." ,PORT = ".$val."| ,";
                                $cek=1;
                            }
                        }
                     break;
                     
                     
               case 14://  Commodity
                    $val= $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
                        $query="SELECT COUNT(*) AS jml FROM mscommodity where Id = '$val'";
                        $q=$this->db->query($query);
                        $rec=$q->row();
                        $count=$rec->jml;
                        if($count < 1){
                            $error .= " |Coloum = ".$col." ,commodity = ".$val."| ,";
                            $cek=1;
                        }
                     break;
                     
                     
               case 15://  CostType
                     $val= $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
                     if($val=='normal'){
                        $val='SCHEME';
                     }
                        $query="SELECT COUNT(*) AS jml FROM mscost_type where Name = '$val'";
                        $q=$this->db->query($query);
                        $rec=$q->row();
                        $count=$rec->jml;
                        if($count < 1){
                            $error .= "|Coloum = ".$col." ,type cost = ".$val."| ,";
                            $cek=1;
                        }
                     break;
                     
                     
               default: 
                     $val= $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
                     break;
            }
            
//            if(!$this->validateDate($objWorksheet->getCellByColumnAndRow(12, $row)->getValue())){
//                $error .= "|Coloum = 12 ,please change format date Y-m-n (indonesia -> yyyy-mm-dd)";
//                $cek=1;
//            }
//            
//            if(!$this->validateDate($objWorksheet->getCellByColumnAndRow(13, $row)->getValue())){
//                $error .= "|Coloum =  ,please change format date Y-m-n (indonesia -> yyyy-mm-dd)";
//                $cek=1;
//            }
    
    }         
          }
          if($cek==1){
            $mess = array(
                'text' => $error,
                 );
        	$data[] = $mess;
           }
        }
        	echo json_encode($data);
    }
    
    function insert_data(){
        ini_set('memory_limit', '1024M');
        ini_set('max_execution_time', 300);
        $tgl= date('Y-m-d');
        $extgl=explode("-",$tgl);
        $noawal1='AIR'.$extgl[0].$extgl[1].$extgl[2]; # 11
        $query=$this->db->query("SELECT MAX(RIGHT(IdImport,3)) AS nou FROM trimport WHERE LEFT(IdImport,11)='$noawal1' ORDER BY IdImport");
        $nobaru1='';
        if($query->num_rows() > 0){
            foreach($query->result() as $t){
                $tmp=((int)$t->nou)+1;
                $nobaru1=sprintf("%03s",$tmp);
            }
        }else{
            $nobaru1="01";
        }
        
        $noawal=$noawal1.$nobaru1;
        
        
        
        
        $filename=$this->input->post('namafile');
        $sheet =$this->input->post('nmsheet');
        
        $this->load->library('PHPExcel');
        $objReader = PHPExcel_IOFactory::createReaderForFile('./import/'.$filename);//PHPExcel_IOFactory::createReader('Excel2007');
        $objReader->setReadDataOnly(true);

        $objPHPExcel = $objReader->load('./import/'.$filename);
        $objWorksheet = $objPHPExcel->setActiveSheetIndex($sheet);
        $highestRow = $objWorksheet->getHighestRow(); 
        $highestColumn = $objWorksheet->getHighestColumn(); 
        
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); 
        
        $data = array();
        //========
        $this->db->trans_begin();
        
            $nmtabel='trimport';
        		$data = array(
                        'IdImport' => $noawal,
                        'IdUser'   => '',
                        'DateTrans' => date('Y-m-d H:i:s'),
        			);
        	$insert = $this->Mdata->save($data,$nmtabel);
            
        $id=1;
        for ($row = 1; $row <= $highestRow; ++$row){
     if ($row>=3){  
           $idunit          = '005';
           $idservice       = '005';
           $idcomm          = $objWorksheet->getCellByColumnAndRow(14, $row)->getValue();  
           $idvendor        = $objWorksheet->getCellByColumnAndRow(1, $row)->getValue();
           $idCurr          = 'IDR';
           $idOriPort       = $objWorksheet->getCellByColumnAndRow(0, $row)->getValue();
           $idDestPort      = $objWorksheet->getCellByColumnAndRow(4, $row)->getValue();
           $idCostType      = $objWorksheet->getCellByColumnAndRow(15, $row)->getValue();
           $leadtime        = $objWorksheet->getCellByColumnAndRow(10, $row)->getValue();
           //$validfrom       = $objWorksheet->getCellByColumnAndRow(12, $row)->getValue();
           //$validto         = $objWorksheet->getCellByColumnAndRow(13, $row)->getValue();
           $remark          = $objWorksheet->getCellByColumnAndRow(29, $row)->getValue();
           $onoffline       = $objWorksheet->getCellByColumnAndRow(5, $row)->getValue();
           $rout1           = $objWorksheet->getCellByColumnAndRow(6, $row)->getValue();
           $rout2           = $objWorksheet->getCellByColumnAndRow(7, $row)->getValue();
           $rout3           = $objWorksheet->getCellByColumnAndRow(8, $row)->getValue();
           $rout4           = $objWorksheet->getCellByColumnAndRow(9, $row)->getValue();
           $frequency       = $objWorksheet->getCellByColumnAndRow(11, $row)->getValue();
           
           $validfrom       = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(12, $row)->getValue()));
           $validto         = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(13, $row)->getValue()));
           //$tgl1        = explode("/",$validfrom);
//           $validfrom   = $tgl1[2].'-'.$tgl1[1].'-'.$tgl1[0];
//           $tgl2        = explode("/",$validto);
//           $validto     = $tgl2[2].'-'.$tgl2[1].'-'.$tgl2[0];
               
            switch ($idCostType) {
                case 'normal': case 'SCHEME':
                    $idCostType='001';
                    break;
                case 'PROMO': case 'promo':
                    $idCostType='003';
                    break;
                case 'EXPRESS':
                    $idCostType='004';
                    break;
                case 'KONTRAK':
                    $idCostType='002';
                    break;
            }
           //==== Header ====
            $myid=$noawal.sprintf("%06s",$id);
            $nmtabel='trcost_hdr';
    		$data = array(
                    'Id' => $myid,
                    'IdImport' => $noawal,
    				//'NAME' => 'M',
                    'IdUnit' => $idunit,
                    'IdService' => $idservice,
                    'IdComm' => $idcomm,
                    'IdVendor' => $idvendor,
                    'IdCurr' => $idCurr,
                    'IdOriPort' => $idOriPort,
                    'IdDestPort' => $idDestPort,
                    'IdCostType' => $idCostType,
                    'LeadTime' => $leadtime,
                    'ValidFrom' => $validfrom,
                    'ValidTo' => $validto,
                    'Remarks' => $remark,
                    'OnoffLine' => $onoffline,
                    'IdRoutePort01' => $rout1,
                    'IdRoutePort02' => $rout2,
                    'IdRoutePort03' => $rout3,
                    'IdRoutePort04' => $rout4,
                    'Frequency' => $frequency,
    			);
    		$insert = $this->Mdata->save($data,$nmtabel);
           //=== M =======
           $M=$objWorksheet->getCellByColumnAndRow(16, $row)->getValue();
           if($M==''){
                $M=0; 
           }
            $nmtabel='trcost_dtl';
    		$data = array(
                    'id'    => 1,
                    'IdCostHeader' => $myid,
                    'IdRateType' => '02',
    				'IdSubCostName' => 'M',
                    'Amount' => $M,
    			);
    		$insert = $this->Mdata->save($data,$nmtabel);
            
            
            //==== N ========
            $N=$objWorksheet->getCellByColumnAndRow(17, $row)->getValue();
            if($N==''){
                $N=0;
            }
            $nmtabel='trcost_dtl';
    		$data = array(
                    'id'    => 2,
                    'IdCostHeader' => $myid,
                    'IdRateType' => '02',
    				'IdSubCostName' => 'N',
                    'Amount' => $N,
    			);
    		$insert = $this->Mdata->save($data,$nmtabel);
            
            //==== 45 ========
            $AS=$objWorksheet->getCellByColumnAndRow(18, $row)->getValue();
            if($AS==''){
                $AS=0;
            }
            $nmtabel='trcost_dtl';
    		$data = array(
                    'id'    => 3,
                    'IdCostHeader' => $myid,
                    'IdRateType' => '02',
    				'IdSubCostName' => '45',
                    'Amount' => $AS,
    			);
    		$insert = $this->Mdata->save($data,$nmtabel);
            
            //==== 100 ========
            $IOO=$objWorksheet->getCellByColumnAndRow(19, $row)->getValue();
            if($IOO==''){
                $IOO=0;
            }
            $nmtabel='trcost_dtl';
    		$data = array(
                    'id'    => 4,
                    'IdCostHeader' => $myid,
                    'IdRateType' => '02',
    				'IdSubCostName' => '100',
                    'Amount' => $IOO,
    			);
    		$insert = $this->Mdata->save($data,$nmtabel);
            
            //==== 250 ========
            $ZSO=$objWorksheet->getCellByColumnAndRow(20, $row)->getValue();
            if($ZSO==''){
                $ZSO=0;
            }
            $nmtabel='trcost_dtl';
    		$data = array(
                    'id'    => 5,
                    'IdCostHeader' => $myid,
                    'IdRateType' => '02',
    				'IdSubCostName' => '250',
                    'Amount' => $ZSO,
    			);
    		$insert = $this->Mdata->save($data,$nmtabel);
            
            //==== 300 ========
            $EOO=$objWorksheet->getCellByColumnAndRow(21, $row)->getValue();
            if($EOO==''){
                $EOO=0;
            }
            $nmtabel='trcost_dtl';
    		$data = array(
                    'id'    => 6,
                    'IdCostHeader' => $myid,
                    'IdRateType' => '02',
    				'IdSubCostName' => '300',
                    'Amount' => $EOO,
    			);
    		$insert = $this->Mdata->save($data,$nmtabel);
            
            
            //==== 500 ========
            $SOO=$objWorksheet->getCellByColumnAndRow(22, $row)->getValue();
            if($SOO==''){
                $SOO=0;
            }
            $nmtabel='trcost_dtl';
    		$data = array(
                    'id'    => 7,
                    'IdCostHeader' => $myid,
                    'IdRateType' => '02',
    				'IdSubCostName' => '500',
                    'Amount' => $SOO,
    			);
    		$insert = $this->Mdata->save($data,$nmtabel);
            
            //==== 1000 ========
            $IOOO=$objWorksheet->getCellByColumnAndRow(23, $row)->getValue();
            if($IOOO==''){
                $IOOO=0;
            }
            $nmtabel='trcost_dtl';
    		$data = array(
                    'id'    => 8,
                    'IdCostHeader' => $myid,
                    'IdRateType' => '02',
    				'IdSubCostName' => '1000',
                    'Amount' => $IOOO,
    			);
    		$insert = $this->Mdata->save($data,$nmtabel);
            
            //==== 2000 ========
            $ZOOO=$objWorksheet->getCellByColumnAndRow(24, $row)->getValue();
            if($ZOOO==''){
                $ZOOO=0;
            }
            $nmtabel='trcost_dtl';
    		$data = array(
                    'id'    => 9,
                    'IdCostHeader' => $myid,
                    'IdRateType' => '02',
    				'IdSubCostName' => '2000',
                    'Amount' => $ZOOO,
    			);
    		$insert = $this->Mdata->save($data,$nmtabel);
            
            //==== FSC ========
            $FSC=$objWorksheet->getCellByColumnAndRow(25, $row)->getValue();
            if($FSC==''){
                $FSC=0;
            }
            $nmtabel='trcost_dtl';
    		$data = array(
                    'id'    => 10,
                    'IdCostHeader' => $myid,
                    'IdRateType' => '02',
    				'IdSubCostName' => 'FCS',
                    'Amount' => $FSC,
    			);
    		$insert = $this->Mdata->save($data,$nmtabel);
            
            //==== SC ========
            $SC=$objWorksheet->getCellByColumnAndRow(26, $row)->getValue();
            if($SC==''){
                $SC=0;
            }
            $nmtabel='trcost_dtl';
    		$data = array(
                    'id'    => 11,
                    'IdCostHeader' => $myid,
                    'IdRateType' => '02',
    				'IdSubCostName' => 'SC',
                    'Amount' => $SC,
    			);
    		$insert = $this->Mdata->save($data,$nmtabel);
            
            //==== FA ========
            $FA = $objWorksheet->getCellByColumnAndRow(27, $row)->getValue();
            
            if($FA==''){
                $FA = 0;
            }
            $nmtabel='trcost_dtl';
    		$data = array(
                    'id'    => 12,
                    'IdCostHeader' => $myid,
                    'IdRateType' => '02',
    				'IdSubCostName' => 'FA',
                    'Amount' => $FA,
    			);
    		$insert = $this->Mdata->save($data,$nmtabel);
            
            //==== Storage ========
            $STR = $objWorksheet->getCellByColumnAndRow(28, $row)->getValue();
            if($STR==''){
                $STR=0;
            }
            $nmtabel='trcost_dtl';
    		$data = array(
                    'id'    => 13,
                    'IdCostHeader' => $myid,
                    'IdRateType' => '02',
    				'IdSubCostName' => 'Storage',
                    'Amount' => $STR,
    			);
    		$insert = $this->Mdata->save($data,$nmtabel);
            
            $id++;
        }
      }
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                unlink("./import/$filename");
                echo json_encode(array('sts'=>false,'preview'=>'Error Import'));
        }
        else
        {
                $this->db->trans_commit();
                unlink("./import/$filename");
           //=========== PREVIEW //==============
           $cRet = "<table class=\"uk-table uk-text-nowrap\">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>CARRIER</th>
                                        <th>ORIGIN</th>
                                        <th>DESTINATION</th>
                                        <th>OFFON</th>
                                        <th>COMMODITY</th>
                                        <th>TYPE</th>
                                        <th>ROUT 1</th>
                                        <th>ROUT 2</th>
                                        <th>ROUT 3</th>
                                        <th>ROUT 4</th>
                                        <th>M</th>
                                        <th>N</th>
                                        <th>45</th>
                                        <th>100</th>
                                        <th>250</th>
                                        <th>300</th>
                                        <th>500</th>
                                        <th>1000</th>
                                        <th>2000</th>
                                        <th>FCS</th>
                                        <th>CS</th>
                                        <th>FA</th>
                                        <th>STORAGE</th>
                                    </tr>
                                    </thead>
                                    <tbody>";
           
           $sql="SELECT d.Name,CONCAT('(',e.Codes,') ',e.Name) AS origin ,CONCAT('(',f.Codes,') ',f.Name) AS destination
                ,a.OnoffLine,g.Desc,l.Name as type,
                CONCAT('(',h.Codes,') ',h.Name) AS rout1,
                CONCAT('(',i.Codes,') ',i.Name) AS rout2,
                CONCAT('(',j.Codes,') ',j.Name) AS rout3,
                CONCAT('(',k.Codes,') ',k.Name) AS rout4,
                (SELECT Amount FROM trcost_dtl WHERE trcost_dtl.IdSubCostName = 'M' AND trcost_dtl.IdCostHeader=a.Id) AS M,
                (SELECT Amount FROM trcost_dtl WHERE trcost_dtl.IdSubCostName = 'N' AND trcost_dtl.IdCostHeader=a.Id) AS N,
                (SELECT Amount FROM trcost_dtl WHERE trcost_dtl.IdSubCostName = '45' AND trcost_dtl.IdCostHeader=a.Id) AS c45,
                (SELECT Amount FROM trcost_dtl WHERE trcost_dtl.IdSubCostName = '100' AND trcost_dtl.IdCostHeader=a.Id) AS c100,
                (SELECT Amount FROM trcost_dtl WHERE trcost_dtl.IdSubCostName = '250' AND trcost_dtl.IdCostHeader=a.Id) AS c250,
                (SELECT Amount FROM trcost_dtl WHERE trcost_dtl.IdSubCostName = '300' AND trcost_dtl.IdCostHeader=a.Id) AS c300,
                (SELECT Amount FROM trcost_dtl WHERE trcost_dtl.IdSubCostName = '500' AND trcost_dtl.IdCostHeader=a.Id) AS c500,
                (SELECT Amount FROM trcost_dtl WHERE trcost_dtl.IdSubCostName = '1000' AND trcost_dtl.IdCostHeader=a.Id) AS c1000,
                (SELECT Amount FROM trcost_dtl WHERE trcost_dtl.IdSubCostName = '2000' AND trcost_dtl.IdCostHeader=a.Id) AS c2000,
                (SELECT Amount FROM trcost_dtl WHERE trcost_dtl.IdSubCostName = 'FCS' AND trcost_dtl.IdCostHeader=a.Id) AS fcs,
                (SELECT Amount FROM trcost_dtl WHERE trcost_dtl.IdSubCostName = 'CS' AND trcost_dtl.IdCostHeader=a.Id) AS cs,
                (SELECT Amount FROM trcost_dtl WHERE trcost_dtl.IdSubCostName = 'FA' AND trcost_dtl.IdCostHeader=a.Id) AS fa,
                (SELECT Amount FROM trcost_dtl WHERE trcost_dtl.IdSubCostName = 'STORAGE' AND trcost_dtl.IdCostHeader=a.Id) AS cstorage
                FROM trcost_hdr a 
                INNER JOIN msunit b ON a.IdUnit=b.Id
                INNER JOIN msservice c ON a.IdService=c.Id
                INNER JOIN msvendor_hdr d ON a.IdVendor=d.Id
                INNER JOIN msport e ON a.IdOriport=e.Codes
                INNER JOIN msport f ON a.IdDestPort=f.Codes
                INNER JOIN mscommodity g ON a.IdComm=g.Id
                LEFT JOIN msport h ON a.IdRoutePort01=h.Codes
                LEFT JOIN msport i ON a.IdRoutePort02=i.Codes
                LEFT JOIN msport j ON a.IdRoutePort03=j.Codes
                LEFT JOIN msport k ON a.IdRoutePort04=k.Codes
                INNER JOIN mscost_type l ON a.IdCostType=l.Id
                where a.IdImport='$noawal'
                ORDER BY a.Id"; 
           $hasil = $this->db->query($sql);
           $no=0;
           foreach($hasil->result() as $row){
           $no++; 
            $cRet .="               <tr>
                                        <td>$no</td>
                                        <td>$row->Name</td>
                                        <td>$row->origin</td>
                                        <td>$row->destination</td>
                                        <td>$row->OnoffLine</td>
                                        <td>$row->Desc</td>
                                        <td>$row->type</td>
                                        <td>$row->rout1</td>
                                        <td>$row->rout2</td>
                                        <td>$row->rout3</td>
                                        <td>$row->rout4</td>
                                        <td>$row->M</td>
                                        <td>$row->N</td>
                                        <td>$row->c45</td>
                                        <td>$row->c100</td>
                                        <td>$row->c250</td>
                                        <td>$row->c300</td>
                                        <td>$row->c500</td>
                                        <td>$row->c1000</td>
                                        <td>$row->c2000</td>
                                        <td>$row->fcs</td>
                                        <td>$row->cs</td>
                                        <td>$row->fa</td>
                                        <td>$row->cstorage</td>                                        
                                    </tr>";    
            
           }
           
           $cRet .="</tbody></table>";
           //=========== END //==================     
                echo json_encode(array('sts'=>true,'preview'=>$cRet));
        }
    }
    
        function insert_data_ci_aa(){
        ini_set('memory_limit', '1024M');
        ini_set('max_execution_time', 300);
        $tgl= date('Y-m-d');
        $extgl=explode("-",$tgl);
        $noawal1='AIR'.$extgl[0].$extgl[1].$extgl[2]; # 11
        $query=$this->db->query("SELECT MAX(RIGHT(IdImport,3)) AS nou FROM trimport WHERE LEFT(IdImport,11)='$noawal1' ORDER BY IdImport");
        $nobaru1='';
        if($query->num_rows() > 0){
            foreach($query->result() as $t){
                $tmp=((int)$t->nou)+1;
                $nobaru1=sprintf("%03s",$tmp);
            }
        }else{
            $nobaru1="01";
        }
        
        $noawal=$noawal1.$nobaru1;
        
        
        
        
        $filename=$this->input->post('namafile');
        $sheet =$this->input->post('nmsheet');
        
        $this->load->library('PHPExcel');
        $objReader = PHPExcel_IOFactory::createReaderForFile('./import/'.$filename);//PHPExcel_IOFactory::createReader('Excel2007');
        $objReader->setReadDataOnly(true);

        $objPHPExcel = $objReader->load('./import/'.$filename);
        $objWorksheet = $objPHPExcel->setActiveSheetIndex($sheet);
        $highestRow = $objWorksheet->getHighestRow(); 
        $highestColumn = $objWorksheet->getHighestColumn(); 
        
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); 
        
        $data = array();
        //========
        $this->db->trans_begin();
        
            $nmtabel='trimport';
        		$data = array(
                        'IdImport' => $noawal,
                        'IdUser'   => '',
                        'DateImport' => date('Y-m-d H:i:s'),
        				'sts' => '1',
        			);
        	$insert = $this->Mdata->save($data,$nmtabel);
            
        $id=1;
        for ($row = 1; $row <= $highestRow; ++$row){
     if ($row>=3){  
           $idunit          = '005';
           $idservice       = '005';
           $idcomm          = $objWorksheet->getCellByColumnAndRow(14, $row)->getValue();  
           $idvendor        = $objWorksheet->getCellByColumnAndRow(1, $row)->getValue();
           $idCurr          = 'IDR';
           $idOriPort       = $objWorksheet->getCellByColumnAndRow(0, $row)->getValue();
           $idDestPort      = $objWorksheet->getCellByColumnAndRow(4, $row)->getValue();
           $idCostType      = $objWorksheet->getCellByColumnAndRow(15, $row)->getValue();
           $leadtime        = $objWorksheet->getCellByColumnAndRow(10, $row)->getValue();
           //$validfrom       = $objWorksheet->getCellByColumnAndRow(12, $row)->getValue();
           //$validto         = $objWorksheet->getCellByColumnAndRow(13, $row)->getValue();
           $remark          = $objWorksheet->getCellByColumnAndRow(30, $row)->getValue();
           $onoffline       = $objWorksheet->getCellByColumnAndRow(5, $row)->getValue();
           $rout1           = $objWorksheet->getCellByColumnAndRow(6, $row)->getValue();
           $rout2           = $objWorksheet->getCellByColumnAndRow(7, $row)->getValue();
           $rout3           = $objWorksheet->getCellByColumnAndRow(8, $row)->getValue();
           $rout4           = $objWorksheet->getCellByColumnAndRow(9, $row)->getValue();
           $frequency       = $objWorksheet->getCellByColumnAndRow(11, $row)->getValue();
           
           $validfrom       = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(12, $row)->getValue()));
           $validto         = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($objWorksheet->getCellByColumnAndRow(13, $row)->getValue()));
           //$tgl1        = explode("/",$validfrom);
//           $validfrom   = $tgl1[2].'-'.$tgl1[1].'-'.$tgl1[0];
//           $tgl2        = explode("/",$validto);
//           $validto     = $tgl2[2].'-'.$tgl2[1].'-'.$tgl2[0];
               
            switch ($idCostType) {
                case 'normal': case 'SCHEME':
                    $idCostType='001';
                    break;
                case 'PROMO':
                    $idCostType='003';
                    break;
                case 'EXPRESS':
                    $idCostType='004';
                    break;
                case 'KONTRAK':
                    $idCostType='002';
                    break;
            }
           //==== Header ====
            $myid=$noawal.sprintf("%06s",$id);
            $nmtabel='trcost_hdr';
    		$data = array(
                    'Id' => $myid,
                    'IdImport' => $noawal,
    				//'NAME' => 'M',
                    'IdUnit' => $idunit,
                    'IdService' => $idservice,
                    'IdComm' => $idcomm,
                    'IdVendor' => $idvendor,
                    'IdCurr' => $idCurr,
                    'IdOriPort' => $idOriPort,
                    'IdDestPort' => $idDestPort,
                    'IdCostType' => $idCostType,
                    'LeadTime' => $leadtime,
                    'ValidFrom' => $validfrom,
                    'ValidTo' => $validto,
                    'Remarks' => $remark,
                    'OnoffLine' => $onoffline,
                    'IdRoutePort01' => $rout1,
                    'IdRoutePort02' => $rout2,
                    'IdRoutePort03' => $rout3,
                    'IdRoutePort04' => $rout4,
                    'Frequency' => $frequency,
    			);
    		$insert = $this->Mdata->save($data,$nmtabel);
           //=== M =======
           $M=$objWorksheet->getCellByColumnAndRow(16, $row)->getValue();
           if($M==''){
                $M=0; 
           }
            $nmtabel='trcost_dtl';
    		$data = array(
                    'id'    => 1,
                    'IdCostHeader' => $myid,
                    'IdRateType' => '02',
    				'IdSubCostName' => 'M',
                    'Amount' => $M,
    			);
    		$insert = $this->Mdata->save($data,$nmtabel);
            
            
            //==== N ========
            $N=$objWorksheet->getCellByColumnAndRow(17, $row)->getValue();
            if($N==''){
                $N=0;
            }
            $nmtabel='trcost_dtl';
    		$data = array(
                    'id'    => 2,
                    'IdCostHeader' => $myid,
                    'IdRateType' => '02',
    				'IdSubCostName' => 'N',
                    'Amount' => $N,
    			);
    		$insert = $this->Mdata->save($data,$nmtabel);
            
            //==== 45 ========
            $AS=$objWorksheet->getCellByColumnAndRow(18, $row)->getValue();
            if($AS==''){
                $AS=0;
            }
            $nmtabel='trcost_dtl';
    		$data = array(
                    'id'    => 3,
                    'IdCostHeader' => $myid,
                    'IdRateType' => '02',
    				'IdSubCostName' => '45',
                    'Amount' => $AS,
    			);
    		$insert = $this->Mdata->save($data,$nmtabel);
            
            //==== 75 ========
            $YS=$objWorksheet->getCellByColumnAndRow(19, $row)->getValue();
            if($YS==''){
                $YS=0;
            }
            $nmtabel='trcost_dtl';
    		$data = array(
                    'id'    => 4,
                    'IdCostHeader' => $myid,
                    'IdRateType' => '02',
    				'IdSubCostName' => '75',
                    'Amount' => $YS,
    			);
    		$insert = $this->Mdata->save($data,$nmtabel);
            
            //==== 100 ========
            $IOO=$objWorksheet->getCellByColumnAndRow(20, $row)->getValue();
            if($IOO==''){
                $IOO=0;
            }
            $nmtabel='trcost_dtl';
    		$data = array(
                    'id'    => 4,
                    'IdCostHeader' => $myid,
                    'IdRateType' => '02',
    				'IdSubCostName' => '100',
                    'Amount' => $IOO,
    			);
    		$insert = $this->Mdata->save($data,$nmtabel);
            
            //==== 250 ========
            $ZSO=$objWorksheet->getCellByColumnAndRow(21, $row)->getValue();
            if($ZSO==''){
                $ZSO=0;
            }
            $nmtabel='trcost_dtl';
    		$data = array(
                    'id'    => 5,
                    'IdCostHeader' => $myid,
                    'IdRateType' => '02',
    				'IdSubCostName' => '250',
                    'Amount' => $ZSO,
    			);
    		$insert = $this->Mdata->save($data,$nmtabel);
            
            //==== 300 ========
            $EOO=$objWorksheet->getCellByColumnAndRow(22, $row)->getValue();
            if($EOO==''){
                $EOO=0;
            }
            $nmtabel='trcost_dtl';
    		$data = array(
                    'id'    => 6,
                    'IdCostHeader' => $myid,
                    'IdRateType' => '02',
    				'IdSubCostName' => '300',
                    'Amount' => $EOO,
    			);
    		$insert = $this->Mdata->save($data,$nmtabel);
            
            
            //==== 500 ========
            $SOO=$objWorksheet->getCellByColumnAndRow(23, $row)->getValue();
            if($SOO==''){
                $SOO=0;
            }
            $nmtabel='trcost_dtl';
    		$data = array(
                    'id'    => 7,
                    'IdCostHeader' => $myid,
                    'IdRateType' => '02',
    				'IdSubCostName' => '500',
                    'Amount' => $SOO,
    			);
    		$insert = $this->Mdata->save($data,$nmtabel);
            
            //==== 1000 ========
            $IOOO=$objWorksheet->getCellByColumnAndRow(24, $row)->getValue();
            if($IOOO==''){
                $IOOO=0;
            }
            $nmtabel='trcost_dtl';
    		$data = array(
                    'id'    => 8,
                    'IdCostHeader' => $myid,
                    'IdRateType' => '02',
    				'IdSubCostName' => '1000',
                    'Amount' => $IOOO,
    			);
    		$insert = $this->Mdata->save($data,$nmtabel);
            
            //==== 2000 ========
            $ZOOO=$objWorksheet->getCellByColumnAndRow(25, $row)->getValue();
            if($ZOOO==''){
                $ZOOO=0;
            }
            $nmtabel='trcost_dtl';
    		$data = array(
                    'id'    => 9,
                    'IdCostHeader' => $myid,
                    'IdRateType' => '02',
    				'IdSubCostName' => '2000',
                    'Amount' => $ZOOO,
    			);
    		$insert = $this->Mdata->save($data,$nmtabel);
            
            //==== FSC ========
            $FSC=$objWorksheet->getCellByColumnAndRow(26, $row)->getValue();
            if($FSC==''){
                $FSC=0;
            }
            $nmtabel='trcost_dtl';
    		$data = array(
                    'id'    => 10,
                    'IdCostHeader' => $myid,
                    'IdRateType' => '02',
    				'IdSubCostName' => 'FCS',
                    'Amount' => $FSC,
    			);
    		$insert = $this->Mdata->save($data,$nmtabel);
            
            //==== SC ========
            $SC=$objWorksheet->getCellByColumnAndRow(27, $row)->getValue();
            if($SC==''){
                $SC=0;
            }
            $nmtabel='trcost_dtl';
    		$data = array(
                    'id'    => 11,
                    'IdCostHeader' => $myid,
                    'IdRateType' => '02',
    				'IdSubCostName' => 'SC',
                    'Amount' => $SC,
    			);
    		$insert = $this->Mdata->save($data,$nmtabel);
            
            //==== FA ========
            $FA = $objWorksheet->getCellByColumnAndRow(28, $row)->getValue();
            
            if($FA==''){
                $FA = 0;
            }
            $nmtabel='trcost_dtl';
    		$data = array(
                    'id'    => 12,
                    'IdCostHeader' => $myid,
                    'IdRateType' => '02',
    				'IdSubCostName' => 'FA',
                    'Amount' => $FA,
    			);
    		$insert = $this->Mdata->save($data,$nmtabel);
            
            //==== Storage ========
            $STR = $objWorksheet->getCellByColumnAndRow(29, $row)->getValue();
            if($STR==''){
                $STR=0;
            }
            $nmtabel='trcost_dtl';
    		$data = array(
                    'id'    => 13,
                    'IdCostHeader' => $myid,
                    'IdRateType' => '02',
    				'IdSubCostName' => 'Storage',
                    'Amount' => $STR,
    			);
    		$insert = $this->Mdata->save($data,$nmtabel);
            
            $id++;
        }
      }
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                unlink("./import/$filename");
                echo json_encode(array('sts'=>false,'preview'=>'Error Import'));
        }
        else
        {
                $this->db->trans_commit();
                unlink("./import/$filename");
                echo json_encode(array('sts'=>true,'preview'=>'yess'));
        }
    }
    
    function cek_data_manifest(){
        //ini_set('max_input_vars',5000);
        @ini_set( 'max_input_vars', 900 );
        $i=1;
        $data = array();
        $dataku=$this->input->post('data');
        foreach ($dataku as $rec){
        $tr=explode("||||xxx||||",$rec['dat']);
        $cek=0;
        $error='error data row = '.$i.', ';
        if($i>=2){
            if($tr[1] <> ''){
                   
                if(trim($tr[1]) == ''){
                    $error .= "| Coloum  Ship Not Be Empty, ";
                    $cek=1;
                }
                    
                if(trim($tr[17]) == ''){
                    $error .= "Coloum Tracking No Not Be Empty, ";
                    $cek=1;
                }
                
                $q=$this->db->query("SELECT * FROM hawbmanifest where Hawb='$tr[1]' and TrackingNo='$tr[17]'");
                $ka=0;
                foreach ($q->result() as $row)
                {
                       //$path=$row->Id;
                       $error .= "Duplicate Data Please Check | No HAWB ".$row->Hawb.", No Tracking ".$row->TrackingNo;
//                       $this->Mdata->delete_by_id($path,'trcost_dtl','IdCostHeader');
//                       $this->Mdata->delete_by_id($path,'trcost_hdr','Id');
                       $cek=1;
                       $ka=1;
                       $idimp=$row->IdImport;
                       $dtimp=$row->ImportDate;
                }
                
                if($ka == 1){
                    $error .= ", ImportId ".$idimp.", Date ".$dtimp;
                    $cek=1;
                    $error .= " ";
                    $cek=1;
                    $ka=0;
                } 
            }
        }   
        $i++;
        if($cek==1){
            $mess = array(
                'text' => $error,
                 );
        	$data[] = $mess;
           }
        }
        echo json_encode($data);
    }
    
    function insert_data_manifest(){
        @ini_set( 'max_input_vars', 10000 );
        ini_set('max_execution_time', 300);
        $tgl= date('Y-m-d');
        $extgl=explode("-",$tgl);
        $noawal1=$extgl[0].$extgl[1].$extgl[2];
        $noawal=$this->autonumb('hisimport','IdImport',$noawal1);
        $data = array();
        //========
        $this->db->trans_begin();
        
            $nmtabel='hisimport';
        		$data = array(
                        'IdImport' => $noawal,
                        'UserId'   => '',
                        'ImportDate' => date('Y-m-d H:i:s'),
        				'UserName' =>'',
                        'ImportType' =>'NONDOC',
        			);
        	$insert = $this->Mdata->save($data,$nmtabel);
            
        $id=0;
        $dataku=$this->input->post('data');
        foreach ($dataku as $rec){
            
        $tr=explode("||||xxx||||",$rec['dat']);
     if ($id>=1){ 
        if($tr[1] <> ''){
            
            $FD1='';
            $FD = explode("/",$tr[16]);
            $FD1 = $FD[2].'-'.$FD[0].'-'.$FD[1];     
             
           $mawb             = $tr[0];
           $shipno           = $tr[1];
           $pkgs             = $tr[2];  
           $description      = $tr[3];
           $weight           = $tr[4];
           $weightunit       = $tr[5];
           $shippername      = $tr[6];
           $shipperstreet1   = $tr[7];
           $shipperstreet2   = $tr[8];
           $shippercity      = $tr[9];
           $consigneename    = $tr[10];
           $consigneestreet1 = $tr[11];
           $consigneestreet2 = $tr[12];
           $consigneecity    = $tr[13];
           $priceinvoice     = $tr[14];
           $currency         = $tr[15];           
           $flightdate       = $FD1;
           $tracking_no      = $tr[17];
           $shippercoun      = $tr[18];
           $shippename2      = $tr[19];
           $billdtname       = $tr[20];
           $consigneecitycode= $tr[21];
            //=================//            
           //==== Header ====
            //$myid=$noawal.sprintf("%06s",$id);
            $nmtabel='hawbmanifest';
    		$data = array(
                    'HawbTracking' => $tr[1].'/'.$tr[17],
                    'Mawb' => $mawb,
                    'Hawb' => $shipno,
                    'Pkg' => $pkgs,
                    'Description' => $description,
                    'Weight' => $weight,
                    'Unit' => $weightunit,
                    'ShipperName' => $shippername,
                    'ShipperStreet1' => $shipperstreet1,
                    'ShipperStreet2' => $shipperstreet2,
                    'ShipperCity' => $shippercity,
                    'ConsigneeName' => $consigneename,
                    'ConsigneeStreet1' => $consigneestreet1,
                    'ConsigneeStreet2' => $consigneestreet2,
                    'ConsigneeCity' => $consigneecity,
                    'PriceInvoice' => $priceinvoice,
                    'Currency' => $currency,
                    'FlightDate' => $flightdate,
                    'TrackingNo' => $tracking_no,
                    'ShipperCountry' => $shippercoun,
                    'ShippeName2' => $shippename2,
                    'BillDtName' => $billdtname,
                    'ConsigneeCityCode' => $consigneecitycode,
                    'IdImport' =>$noawal,
                    'ImportDate' =>date('Y-m-d H:i:s'),
                    'CategoryHawb' => 'NONDOC',
    			);
    		$insert = $this->Mdata->save($data,$nmtabel);
        
         }
        }        
        $id++;
        
      }
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                echo json_encode(array('sts'=>false,'preview'=>'Error Import'));
        }
        else
        {
                $this->db->trans_commit();
                echo json_encode(array('sts'=>true,'preview'=>'yess'));
        }
    }
    
    
    function cek_data_manifestlongtrack(){
        //ini_set('max_input_vars',5000);
        @ini_set( 'max_input_vars', 900 );
        $i=1;
        $data = array();
        $dataku=$this->input->post('data');
        foreach ($dataku as $rec){
        $tr=explode("||||xxx||||",$rec['dat']);
        $cek=0;
        $error='error data row = '.$i.', ';
        if($i>=2){
            if($tr[0] <> ''){
                   
                if(trim($tr[0]) == ''){
                    $error .= "| Coloum  Ship Not Be Empty, ";
                    $cek=1;
                }
                    
                if(trim($tr[4]) == ''){
                    $error .= "Coloum Tracking No Not Be Empty, ";
                    $cek=1;
                }
                
                $q=$this->db->query("SELECT * FROM hawbtracking where Hawb='$tr[0]' and TrackingNo='$tr[4]'");
                $ka=0;
                foreach ($q->result() as $row)
                {
                       //$path=$row->Id;
                       $error .= "Duplicate Data Please Check | No HAWB ".$row->Hawb.", No Tracking ".$row->TrackingNo;
//                       $this->Mdata->delete_by_id($path,'trcost_dtl','IdCostHeader');
//                       $this->Mdata->delete_by_id($path,'trcost_hdr','Id');
                       $cek=1;
                       $ka=1;
                       $idimp=$row->IdImport;
                       $dtimp=$row->ImportDate;
                }
                
                if($ka == 1){
                    $error .= ", ImportId ".$idimp.", Date ".$dtimp;
                    $cek=1;
                    $error .= " ";
                    $cek=1;
                    $ka=0;
                } 
            }
        }   
        $i++;
        if($cek==1){
            $mess = array(
                'text' => $error,
                 );
        	$data[] = $mess;
           }
        }
        echo json_encode($data);
    }    
    
    function insert_data_manifestlongtrack(){
        @ini_set( 'max_input_vars', 10000 );
        ini_set('max_execution_time', 300);
        $tgl= date('Y-m-d');
        $extgl=explode("-",$tgl);
        $noawal1=$extgl[0].$extgl[1].$extgl[2];
        $noawal=$this->autonumb('hisimport','IdImport',$noawal1);
        $data = array();
        //========
        $this->db->trans_begin();
        
            $nmtabel='hisimport';
        		$data = array(
                        'IdImport' => $noawal,
                        'UserId'   => '',
                        'ImportDate' => date('Y-m-d H:i:s'),
        				'UserName' =>'',
                        'ImportType' =>'LONGTRACK',
        			);
        	$insert = $this->Mdata->save($data,$nmtabel);
            
        $id=0;
        $dataku=$this->input->post('data');
        foreach ($dataku as $rec){
            
        $tr=explode("||||xxx||||",$rec['dat']);
     if ($id>=1){ 
        if($tr[1] <> ''){   
             
           $shipno     = $tr[0];
           $rectype    = $tr[1];
           $weight     = $tr[2];  
           $weightunit = $tr[3];
           $trackingno = $tr[4];
           $pkgs       = $tr[5];
            //=================//            
           //==== Header ====
            //$myid=$noawal.sprintf("%06s",$id);
            $nmtabel='hawbtracking';
    		$data = array(
                    'HawbTracking' => $tr[1].'/'.$tr[4],
                    'Hawb' => $shipno,
                    'TrackingNo' => $trackingno,
                    'Pkgs' => $pkgs,
                    'RecType' => $rectype,
                    'Weight' => $weight,
                    'WeightUnit' => $weightunit,
                    'IdImport' => $noawal,
                    'ImportDate' => date('Y-m-d H:i:s'),
    			);
    		$insert = $this->Mdata->save($data,$nmtabel);
        
         }
        }        
        $id++;
        
      }
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                echo json_encode(array('sts'=>false,'preview'=>'Error Import'));
        }
        else
        {
                $this->db->trans_commit();
                echo json_encode(array('sts'=>true,'preview'=>'yess'));
        }
    }
    
    function cek_data_manifestletterdoc(){
        //ini_set('max_input_vars',5000);
        @ini_set( 'max_input_vars', 900 );
        $i=1;
        $data = array();
        $dataku=$this->input->post('data');
        foreach ($dataku as $rec){
        $tr=explode("||||xxx||||",$rec['dat']);
        $cek=0;
        $error='error data row = '.$i.', ';
        if($i>=2){
            if($tr[1] <> ''){
                
                if(trim($tr[3]) <> 'DOCUMENTS'){
                    $error .= "Data Not Letter Doc Maybe Data Non Doc ";
                    $cek=1;
                }
                   
                if(trim($tr[1]) == ''){
                    $error .= "| Coloum  Ship Not Be Empty, ";
                    $cek=1;
                }
                    
                if(trim($tr[17]) == ''){
                    $error .= "Coloum Tracking No Not Be Empty, ";
                    $cek=1;
                }
                
                                
                $q=$this->db->query("SELECT * FROM hawbmanifest where Hawb='$tr[1]' and TrackingNo='$tr[17]'");
                $ka=0;
                foreach ($q->result() as $row)
                {
                       //$path=$row->Id;
                       $error .= "Duplicate Data Please Check | No HAWB ".$row->Hawb.", No Tracking ".$row->TrackingNo;
//                       $this->Mdata->delete_by_id($path,'trcost_dtl','IdCostHeader');
//                       $this->Mdata->delete_by_id($path,'trcost_hdr','Id');
                       $cek=1;
                       $ka=1;
                       $idimp=$row->IdImport;
                       $dtimp=$row->ImportDate;
                }
                
                if($ka == 1){
                    $error .= ", ImportId ".$idimp.", Date ".$dtimp;
                    $cek=1;
                    $error .= " ";
                    $cek=1;
                    $ka=0;
                } 
            }
        }   
        $i++;
        if($cek==1){
            $mess = array(
                'text' => $error,
                 );
        	$data[] = $mess;
           }
        }
        echo json_encode($data);
    }
    
    function insert_data_manifestletterdoc(){
        @ini_set( 'max_input_vars', 10000 );
        ini_set('max_execution_time', 300);
        $tgl= date('Y-m-d');
        $extgl=explode("-",$tgl);
        $noawal1=$extgl[0].$extgl[1].$extgl[2];
        $noawal=$this->autonumb('hisimport','IdImport',$noawal1);
        $data = array();
        //========
        $this->db->trans_begin();
        
            $nmtabel='hisimport';
        		$data = array(
                        'IdImport' => $noawal,
                        'UserId'   => '',
                        'ImportDate' => date('Y-m-d H:i:s'),
        				'UserName' =>'',
                        'ImportType' =>'NONDOC',
        			);
        	$insert = $this->Mdata->save($data,$nmtabel);
            
        $id=0;
        $dataku=$this->input->post('data');
        foreach ($dataku as $rec){
            
        $tr=explode("||||xxx||||",$rec['dat']);
     if ($id>=1){ 
        if($tr[1] <> ''){
            
            $FD1='';
            $FD = explode("/",$tr[16]);
            $FD1 = $FD[2].'-'.$FD[0].'-'.$FD[1];     
             
           $mawb             = $tr[0];
           $shipno           = $tr[1];
           $pkgs             = $tr[2];  
           $description      = $tr[3];
           $weight           = $tr[4];
           $weightunit       = $tr[5];
           $shippername      = $tr[6];
           $shipperstreet1   = $tr[7];
           $shipperstreet2   = $tr[8];
           $shippercity      = $tr[9];
           $consigneename    = $tr[10];
           $consigneestreet1 = $tr[11];
           $consigneestreet2 = $tr[12];
           $consigneecity    = $tr[13];
           $priceinvoice     = $tr[14];
           $currency         = $tr[15];           
           $flightdate       = $FD1;
           $tracking_no      = $tr[17];
           $shippercoun      = $tr[18];
           $shippename2      = $tr[19];
           $billdtname       = $tr[20];
           $consigneecitycode= $tr[21];
            //=================//            
           //==== Header ====
            //$myid=$noawal.sprintf("%06s",$id);
            $nmtabel='hawbmanifest';
    		$data = array(
                    'HawbTracking' => $tr[1].'/'.$tr[17],
                    'Mawb' => $mawb,
                    'Hawb' => $shipno,
                    'Pkg' => $pkgs,
                    'Description' => $description,
                    'Weight' => $weight,
                    'Unit' => $weightunit,
                    'ShipperName' => $shippername,
                    'ShipperStreet1' => $shipperstreet1,
                    'ShipperStreet2' => $shipperstreet2,
                    'ShipperCity' => $shippercity,
                    'ConsigneeName' => $consigneename,
                    'ConsigneeStreet1' => $consigneestreet1,
                    'ConsigneeStreet2' => $consigneestreet2,
                    'ConsigneeCity' => $consigneecity,
                    'PriceInvoice' => $priceinvoice,
                    'Currency' => $currency,
                    'FlightDate' => $flightdate,
                    'TrackingNo' => $tracking_no,
                    'ShipperCountry' => $shippercoun,
                    'ShippeName2' => $shippename2,
                    'BillDtName' => $billdtname,
                    'ConsigneeCityCode' => $consigneecitycode,
                    'IdImport' =>$noawal,
                    'ImportDate' =>date('Y-m-d H:i:s'),
                    'CategoryHawb' => 'LETTERDOC',
    			);
    		$insert = $this->Mdata->save($data,$nmtabel);
            
            
            //===================== INSERT TRACKING LETTER DOC ================
            
           $nmtabel='hawbtracking';
    		$data = array(
                    'HawbTracking' => $tr[1].'/'.$tr[17],
                    'Hawb' => $shipno,
                    'TrackingNo' => $tracking_no,
                    'Pkgs' => $pkgs,
                    'RecType' => $tracking_no,
                    'Weight' => $weight,
                    'WeightUnit' => $weightunit,
                    'IdImport' => $noawal,
                    'ImportDate' => date('Y-m-d H:i:s'),
    			);
    		$insert = $this->Mdata->save($data,$nmtabel);
            
            //=====================
            
        
         }
        }        
        $id++;
        
      }
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                echo json_encode(array('sts'=>false,'preview'=>'Error Import'));
        }
        else
        {
                $this->db->trans_commit();
                echo json_encode(array('sts'=>true,'preview'=>'yess'));
        }
    }    
    
   
function ManifestList_filter(){
				if($ordergroup==''){
			$kondisi=array('a.Username LIKE'=>'%'.$txt_search.'%','a.FullName LIKE'=>'%'.$txt_search.'%');	
			//$kondisi=array('Username LIKE'=>$txt_search.'%');
			} else if($ordergroup !='' and $txt_search !=''){
			$kondisi=array('b.Id'=>$ordergroup,'a.FullName LIKE'=>'%'.$txt_search.'%','a.Username LIKE'=>'%'.$txt_search.'%');	
			} else if($ordergroup !='' and $txt_search ==''){
				$kondisi=array('b.Id'=>$ordergroup);	
			}
			///////////////////////
        if($ctgl1==""){
           $ctgl1=date('Y-m-d'); 
        }
        if($ctgl2==""){
           $ctgl2=date('Y-m-d'); 
        }
        $nm_coloum_order= array('b.mawb','a.hawb','b.flight_date','a.trackno','c.Keterangan','e.ket','d.Keterangan','b.shipper_name','b.consignee_name','b.type_clearance','b.kindofGood','e.UR_JNS');

        $nm_coloum= array('b.mawb','a.hawb','b.flight_date','a.trackno','c.Keterangan as TypeName','e.ket','d.Keterangan','b.shipper_name','b.consignee_name','b.type_clearance','b.kindofGood','e.UR_JNS');
              
        $nm_tabel='t_bill a';
        
        $nm_tabel1='t_shipment_cloud b';
        $on1='a.hawb=b.hawb';
        
        $nm_tabel2='tm_typeclearance c';
        $on2='b.type_clearance=c.TypeClearance';
        
        $nm_tabel3='statusproses d ';
        $on3='b.TrackingStatus=d.NoId';
        
        $nm_tabel4='bc_m_jns_aju e ';
        $on4='b.Id_aju=e.id_aju';
        
        
        $orderby= array('b.flight_date' => 'desc');
        
        $whereall=  array();
        $where=  array('b.flight_date >= '=>date('Y-m-d'),'b.flight_date <= '=>date('Y-m-d'));
        //$where=  "b.flight_date >= '$ctgl1' and b.flight_date <= '$ctgl2'";
        
        if ($cwhere!=""){
        $cwhere=str_replace('zzz','.',$cwhere);
        $cwhere=str_replace('333',' ',$cwhere);
        $cwhere=str_replace('ttt',"'",$cwhere);
        $cwhere=str_replace('xxx','%',$cwhere);
        $cwhere=str_replace('bbb','=',$cwhere);
        $cwhere=str_replace('kkk','<>',$cwhere);
        $cwhere=str_replace('iii','(',$cwhere);
        $cwhere=str_replace('ooo',')',$cwhere);
        $cwhere=str_replace('ppp',',',$cwhere);
        
        $where = $cwhere." and b.flight_date >= '$ctgl1' and b.flight_date <= '$ctgl2'";
        }
        
        if ($cwhere == "trias"){
        //    $where=  "b.flight_date >= '$ctgl1' and b.flight_date <= '$ctgl2'";
        $where=  array('b.flight_date >= '=>$ctgl1,'b.flight_date <= '=>$ctgl2);
        }
        
        
        $list = $this->Mdata->get_datatables_join4($nm_tabel,$nm_coloum,$nm_tabel1,'inner',$on1,$nm_tabel2,'left',$on2,$nm_tabel3,'left',$on3,$nm_tabel4,'left',$on4,$orderby,$where,$nm_coloum_order);
        
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $row){
			$no++;
			$row = array(
            'Mawb' => $row->mawb,
            'Hawb' => $row->hawb,
            'FlightDate' => $this->Mdata->tanggal_format_indonesia($row->flight_date),
            'TrackingNo' => $row->trackno,
            'CategoryHawb' => '',
            'ShipperName' => $row->shipper_name,
            'ConsigneeName' => $row->consignee_name,
            'TypeClerance' => $row->type_clearance,
            'Description' => $row->kindofGood,
            'Keterangan' => $row->TypeName,
            'StatusName' => $row->Keterangan,
            'Ket' => $row->UR_JNS.'-'.$row->ket,
            );
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" =>  $this->Mdata->count_all_join4($nm_tabel,$nm_coloum,$nm_tabel1,'inner',$on1,$nm_tabel2,'left',$on2,$nm_tabel3,'left',$on3,$nm_tabel4,'left',$on4,$where),
						"recordsFiltered" => $this->Mdata->count_filtered_join4($nm_tabel,$nm_coloum,$nm_tabel1,'inner',$on1,$nm_tabel2,'left',$on2,$nm_tabel3,'left',$on3,$nm_tabel4,'left',$on4,$orderby,$where),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
    }

function ManifestList_search(){
		$inputan=$this->uri->segment(4);
		$pecah=explode("_", $inputan);
				$date1=$pecah[0];
				$date2=$pecah[1];
				$tipe=$pecah[2];
				$kriteria=$pecah[3];
				$one=$pecah[4];
				$two=$pecah[5];
				$three=$pecah[6];
				$four=$pecah[7];
				$five=$pecah[8];
				$six=$pecah[9];
				$seven=$pecah[10];
				$eight=$pecah[11];
				$nine=$pecah[12];
				$ten=$pecah[13];
				$txtsearch=array($one,$two,$three,$four,$five,$six,$seven,$eight,$nine,$ten);
				
				$job=$one.','.$two.','.$three.','.$four.','.$five.','.$six.','.$seven.','.$eight.','.$nine.','.$ten;
	
				
		$nm_tabel='t_bill a';
		$nm_tabel2='t_shipment_cloud b';
		$kolom1='a.hawb';
		$kolom2='b.hawb';
		
		$selected='b.mawb,a.hawb,b.flight_date,a.trackno,c.Keterangan as TypeName,e.ket,d.Keterangan,d.CodeStatus as kode_stat,b.shipper_name,b.consignee_name,b.type_clearance,b.kindofGood,e.UR_JNS';
		$nm_coloum= array('b.mawb','a.hawb','b.flight_date','a.trackno','c.Keterangan as TypeName','e.ket','d.Keterangan','b.shipper_name','b.consignee_name','b.type_clearance','b.kindofGood','e.UR_JNS');
        $orderby= array('b.flight_date' => 'desc');
		$where=  array('b.flight_date >='=>$date1,'b.flight_date <='=>$date2);
		$tipe=$tipe;
		$where_in=$txtsearch;
        $list = $this->Model_cari->get_datatables($selected,$nm_tabel,$nm_coloum,$orderby,$where,$where_in,$tipe,$kriteria,$job,$nm_tabel2,$kolom1,$kolom2);
		
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $row){
			$no++;
			$row = array(
            'Mawb' => $row->mawb,
            'Hawb' => $row->hawb,
            'FlightDate' => $this->Mdata->tanggal_format_indonesia($row->flight_date),
            'TrackingNo' => $row->trackno,
            'CategoryHawb' => '',
            'ShipperName' => $row->shipper_name,
            'ConsigneeName' => $row->consignee_name,
            'TypeClerance' => $row->type_clearance,
            'Description' => $row->kindofGood,
            'Keterangan' => $row->TypeName,
            'StatusName' => $row->kode_stat.' - '.$row->Keterangan,
            'Ket' => $row->UR_JNS.'-'.$row->ket,
            );
			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Model_cari->count_all($nm_tabel,$nm_coloum,$nm_tabel2,$kolom1,$kolom2),
						"recordsFiltered" => $this->Model_cari->count_filtered($nm_tabel,$nm_coloum,$orderby,$where,$where_in,$tipe,$kriteria,$job,$nm_tabel2,$kolom1,$kolom2),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
}
function ManifestList($pt="",$cwhere="",$ctgl1="",$ctgl2=""){
        if($ctgl1==""){
           $ctgl1=date('Y-m-d'); 
        }
        if($ctgl2==""){
           $ctgl2=date('Y-m-d'); 
        }
        $nm_coloum_order= array('b.mawb','a.hawb','b.flight_date','a.trackno','c.Keterangan','e.ket','d.Keterangan','b.shipper_name','b.consignee_name','b.type_clearance','b.kindofGood','e.UR_JNS','d.CodeStatus');

        $nm_coloum= array('b.mawb','a.hawb','b.flight_date','a.trackno','c.Keterangan as TypeName','e.ket','d.Keterangan','b.shipper_name','b.consignee_name','b.type_clearance','b.kindofGood','e.UR_JNS','d.CodeStatus');
              
        $nm_tabel='t_bill a';
        
        $nm_tabel1='t_shipment_cloud b';
        $on1='a.hawb=b.hawb';
        
        $nm_tabel2='tm_typeclearance c';
        $on2='b.type_clearance=c.TypeClearance';
        
        $nm_tabel3='statusproses d ';
        $on3='b.TrackingStatus=d.NoId';
        
        $nm_tabel4='bc_m_jns_aju e ';
        $on4='b.Id_aju=e.id_aju';
        
        
        $orderby= array('b.flight_date' => 'desc');
        
        $whereall=  array();
        $where=  array('b.flight_date >= '=>date('Y-m-d'),'b.flight_date <= '=>date('Y-m-d'));
        //$where=  "b.flight_date >= '$ctgl1' and b.flight_date <= '$ctgl2'";
        
        if ($cwhere!=""){
        $cwhere=str_replace('zzz','.',$cwhere);
        $cwhere=str_replace('333',' ',$cwhere);
        $cwhere=str_replace('ttt',"'",$cwhere);
        $cwhere=str_replace('xxx','%',$cwhere);
        $cwhere=str_replace('bbb','=',$cwhere);
        $cwhere=str_replace('kkk','<>',$cwhere);
        $cwhere=str_replace('iii','(',$cwhere);
        $cwhere=str_replace('ooo',')',$cwhere);
        $cwhere=str_replace('ppp',',',$cwhere);
        
        $where = $cwhere." and b.flight_date >= '$ctgl1' and b.flight_date <= '$ctgl2'";
        }
        
        if ($cwhere == "trias"){
        //    $where=  "b.flight_date >= '$ctgl1' and b.flight_date <= '$ctgl2'";
        $where=  array('b.flight_date >= '=>$ctgl1,'b.flight_date <= '=>$ctgl2);
        }
        
        
        $list = $this->Mdata->get_datatables_join4($nm_tabel,$nm_coloum,$nm_tabel1,'inner',$on1,$nm_tabel2,'left',$on2,$nm_tabel3,'left',$on3,$nm_tabel4,'left',$on4,$orderby,$where,$nm_coloum_order);
        
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $row){
			$no++;
			$row = array(
            'Mawb' => $row->mawb,
            'Hawb' => $row->hawb,
            'FlightDate' => $this->Mdata->tanggal_format_indonesia($row->flight_date),
            'TrackingNo' => $row->trackno,
            'CategoryHawb' => '',
            'ShipperName' => $row->shipper_name,
            'ConsigneeName' => $row->consignee_name,
            'TypeClerance' => $row->type_clearance,
            'Description' => $row->kindofGood,
            'Keterangan' => $row->TypeName,
            'StatusName' => $row->CodeStatus.'-'.$row->Keterangan,
            'Ket' => $row->UR_JNS.'-'.$row->ket,
            );
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" =>  $this->Mdata->count_all_join4($nm_tabel,$nm_coloum,$nm_tabel1,'inner',$on1,$nm_tabel2,'left',$on2,$nm_tabel3,'left',$on3,$nm_tabel4,'left',$on4,$where),
						"recordsFiltered" => $this->Mdata->count_filtered_join4($nm_tabel,$nm_coloum,$nm_tabel1,'inner',$on1,$nm_tabel2,'left',$on2,$nm_tabel3,'left',$on3,$nm_tabel4,'left',$on4,$orderby,$where),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
        $this->Mdata->myKill();
    }

    
    public function dtracking(){
        $kd=$this->input->post('cid');
        $nm_tabel='t_bill';
        $nm_coloum= array('mawb','hawb','billterm','tglflight','trackno');
        $orderby= array('trackno' => 'desc');
        $where=  array('hawb'=>$kd);
        $list = $this->Mdata->get_datadetail($nm_tabel,$nm_coloum,$orderby,$where);
        
		$data = array();
		$no = 0;
		foreach ($list as $rec){
			$no++;
			$row = array(
            'TrackingNo' => $rec->trackno,
            'RecType' => '',
            'Pkgs' => '',
            'WeightUnit' => '',
            'Weight' => '',
            'billterm' => $rec->billterm,
            );
			$data[] = $row;
		}
		$output = array(
						"data" => $data,
				);
		//output to json format
		echo json_encode($data);
        
    }
    
    public function Manifestupdate(){
        $nmtabel='t_shipment_cloud';
        $key='hawb';
		$data = array(
                'subpos' => $this->input->post('NoSubPos'),
                'consignee_name' => $this->input->post('PTName'),
                'api_no' => $this->input->post('API'),
                'consignee_NPWP' => $this->input->post('Npwp'),
                'hsCode' => $this->input->post('HsCode'),
                'SkepKawasan' => $this->input->post('SkepKawasan'),
                'shipper_name' => $this->input->post('ShipperName'),
                'shipper_address1' => $this->input->post('ShipperStreet1'),
                'shipper_address2' => $this->input->post('ShipperStreet2'),
                'shipper_city' => $this->input->post('ShipperCity'),
                'shipper_phone' => $this->input->post('ShipperPhone'),
                'consignee_name' => $this->input->post('ConsigneeName'),
                'consignee_address' => $this->input->post('ConsigneeStreet1'),
                //'ConsigneeStreet2' => $this->input->post('ConsigneeStreet2'),
                'consignee_city' => $this->input->post('ConsigneeCity'),
                'consignee_phone' => $this->input->post('ConsigneePhone'),
                'Nik' => $this->input->post('Nik')
			);
		$this->Mdata->update(array($key => $this->input->post('KeyHawb')), $data,$nmtabel);
		echo json_encode(array("status" => TRUE,"Hawb"=>$this->input->post('KeyHawb')));
    }
    
    public function cmbStatusProses()
	{
		$nm_tabel='statusproses';
        $nm_coloum= array('Noid','CodeStatus','Keterangan');
        $orderby= array('Noid' => 'asc');
        $where=  array();
        $list = $this->Mdata->get_datadetail($nm_tabel,$nm_coloum,$orderby,$where);
        
		$data = array();
		$no = 0;
            $row = array(
            'id'    => ' ',
            'name'  => '...',
            'isi'   => ''
            );
			$data[] = $row;
		foreach ($list as $rec){
			$no++;
			$row = array(
            'id' => $rec->Noid,
            'name' => $rec->CodeStatus.'-'.$rec->Keterangan,
            'isi' => ''
            );
			$data[] = $row;
		}
		$output = array(
						"data" => $data,
				);
		//output to json format
		echo json_encode($data);
	}
    
    public function cmbaju()
	{
		$nm_tabel='bc_m_jns_aju';
        $nm_coloum= array('id_aju','UR_JNS','ket');
        $orderby= array('id_aju' => 'asc');
        $where=  array();
        $list = $this->Mdata->get_datadetail($nm_tabel,$nm_coloum,$orderby,$where);
        
		$data = array();
		$no = 0;
            $row = array(
            'id'    => ' ',
            'name'  => '...',
            'isi'   => ''
            );
			$data[] = $row;
		foreach ($list as $rec){
			$no++;
			$row = array(
            'id' => $rec->id_aju,
            'name' => $rec->UR_JNS.'-'.$rec->ket,
            'isi' => ''
            );
			$data[] = $row;
		}
		$output = array(
						"data" => $data,
				);
		//output to json format
		echo json_encode($data);
	}

    public function cmbTypeClearance()
	{
		$nm_tabel='tm_typeclearance';
        $nm_coloum= array('TypeClearance','Keterangan');
        $orderby= array('TypeClearance' => 'asc');
        $where=  array();
        $list = $this->Mdata->get_datadetail($nm_tabel,$nm_coloum,$orderby,$where);
        
		$data = array();
		$no = 0;
            $row = array(
            'id'    => ' ',
            'name'  => '...',
            'isi'   => ''
            );
			$data[] = $row;
		foreach ($list as $rec){
			$no++;
			$row = array(
            'id' => $rec->TypeClearance,
            'name' => $rec->Keterangan,
            'isi' => ''
            );
			$data[] = $row;
		}
		$output = array(
						"data" => $data,
				);
		//output to json format
		echo json_encode($data);
	}
    
    public function cmbTypeClearance_new()
	{
		$nm_tabel='bc_m_jns_aju';
        $nm_coloum= array('id_aju','UR_JNS','ket');
        $orderby= array('id_aju' => 'asc');
        $where=  array();
        $list = $this->Mdata->get_datadetail($nm_tabel,$nm_coloum,$orderby,$where);
        
		$data = array();
		$no = 0;
            $row = array(
            'id'    => ' ',
            'name'  => '...',
            'isi'   => ''
            );
			$data[] = $row;
		foreach ($list as $rec){
			$no++;
			$row = array(
            'id' => $rec->id_aju,
            'name' => $rec->UR_JNS.' - '.$rec->ket,
            'isi' => ''
            );
			$data[] = $row;
		}
		$output = array(
						"data" => $data,
				);
		//output to json format
		echo json_encode($data);
	}

    public function cmbTypeAttachment()
	{
		$nm_tabel='typeattachment';
        $nm_coloum= array('Name','Title');
        $orderby= array('Name' => 'asc');
        $where=  array();
        $list = $this->Mdata->get_datadetail($nm_tabel,$nm_coloum,$orderby,$where);
        
		$data = array();
		$no = 0;
            $row = array(
            'id'    => ' ',
            'name'  => '...',
            'isi'   => ''
            );
			$data[] = $row;
		foreach ($list as $rec){
			$no++;
			$row = array(
            'id' => $rec->Name,
            'name' => $rec->Title,
            'isi' => ''
            );
			$data[] = $row;
		}
		$output = array(
						"data" => $data,
				);
		//output to json format
		echo json_encode($data);
	}
    
    function cek_StatusProses(){
        @ini_set( 'max_input_vars', 900 );
        $i=1;
        $data = array();
        $dataku=$this->input->post('data');
        foreach ($dataku as $rec){
        $tr=explode("||||xxx||||",$rec['dat']);
        $cek=0;
        $error='error data row = '.$i.', ';
        if($i>=2){
            if($tr[0] <> ''){
                
                $q=$this->db->query("SELECT COUNT(hawb) AS jml FROM t_shipment_cloud WHERE hawb ='$tr[0]'");
                $ka=0;
                    foreach ($q->result() as $row)
                    {
                           $ka=$row->jml;
                           if($ka == 0){
                                $error .= " Hawb ".$tr[0]." is not fount,";
                                $cek=1;
                           }
                    }
                   
                if(trim($tr[0]) == ''){
                    $error .= " Coloum  Hawb Not Be Empty, ";
                    $cek=1;
                }
                
                $q=$this->db->query("SELECT COUNT(CodeStatus) AS jml FROM statusproses WHERE CodeStatus ='$tr[2]'");
                $ka=0;
                    foreach ($q->result() as $row)
                    {
                           $ka=$row->jml;
                           if($ka == 0){
                                $error .= " TLC Status Clearance ".$tr[2]." is not fount,";
                                $cek=1;
                           }
                    }
                
                if(trim($tr[2]) == ''){
                    $error .= " Coloum  SPPB DATE Not Be Empty, ";
                    $cek=1;
                }
                    
                if(trim($tr[3]) == ''){
                    $error .= "Coloum Note No Not Be Empty, ";
                    $cek=1;
                }
            }
        }   
        $i++;
        if($cek==1){
            $mess = array(
                'text' => $error,
                 );
        	$data[] = $mess;
           }
        }
        echo json_encode($data);
    }
    
    function UpdateStatusProses(){
        @ini_set( 'max_input_vars', 10000 );
        ini_set('max_execution_time', 300);
        $tgl= date('Y-m-d');
        $extgl=explode("-",$tgl);
        $noawal1=$extgl[0].$extgl[1].$extgl[2];
        $noawal=$this->autonumb('hisimportstatusproses','IdImport',$noawal1);
        $data = array();
        //========
        
        $this->db->trans_begin();
        
            $nmtabel='hisimportstatusproses';
        		$data = array(
                        'IdImport' => $noawal,
                        'UserId'   => $this->session->userdata('cs_Idusr'),
                        'ImportDate' => date('Y-m-d H:i:s'),
        				'UserName' =>$this->session->userdata('cs_FullName'),
                        'IdStatus' =>$this->input->post('stsproses'),
                        'StatusProses' =>$this->input->post('txtstsproses'),
        			);
        	$insert = $this->Mdata->save($data,$nmtabel);
            
        $id=0;
        $dataku=$this->input->post('data');
        foreach ($dataku as $rec){
            
            $tr=explode("||||xxx||||",$rec['dat']);
            
           if ($id>=1){ 
            if($tr[1] <> ''){   
                 
               $hawb        = $tr[0];
               $dateSppb    = $tr[1];
               $tlc         = '';
               $tlcname     = '';
               $note        = $tr[3];  
                //=================//    
                    $q=$this->db->query("SELECT Noid,Keterangan FROM statusproses WHERE CodeStatus ='$tr[2]'");
                    foreach ($q->result() as $row)
                    {
                           $tlc=$row->Noid;
                           $tlcname=$row->Keterangan;
                    }
               //==== Header ====
                $FD1='';
                $FD = explode("/",$dateSppb);
                $FD1 = $FD[2].'-'.$FD[0].'-'.$FD[1];
                
                $myid=$noawal.sprintf("%04s",$id);
                
                $nmtabel='dstatusproses';
        		$data = array(
                        'Id' => $myid,
                        'Hawb' => $hawb,
                        'DateUpdate' => $FD1,
                        'IdStatusProses' => $tlc,
                        'StatusProses' => $tlcname,
                        'Note' => $note,
                        'IdImport' => $noawal,
                        'IdUser' => $this->session->userdata('cs_Idusr'),
                        'UserName' => $this->session->userdata('cs_FullName'),
                        'ModifDate' => date('Y-m-d H:i:s')
        			);
        		$insert = $this->Mdata->save($data,$nmtabel);                
                
                $q=$this->db->query("SELECT DateUpdate,IdStatusProses,Note  FROM dstatusproses WHERE Hawb ='$hawb' ORDER BY DateUpdate DESC ,Id DESC LIMIT 0,1");
                    foreach ($q->result() as $row)
                    {
                        $nmtabel_='t_shipment_cloud';
                        $key_='hawb';
              	        $data_ = array(
                                    'TrackingStatus' => $row->IdStatusProses,
                                    'TrackingDate' => $row->DateUpdate,
                                    'TrackingRemark' => $row->Note,
                    			);
                    	$this->Mdata->update(array($key_ => $hawb), $data_,$nmtabel_);
                    }
                
             }
            }        
            $id++;
        
      }
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                echo json_encode(array('sts'=>false,'preview'=>'Error Import'));
        }
        else
        {
                $this->db->trans_commit();
                echo json_encode(array('sts'=>true,'preview'=>'yess'));
        }
    }
    
    function StatusProsesList($pt="",$cwhere="",$ctgl1="",$ctgl2=""){
        if($ctgl1==""){
           $ctgl1=date('Y-m-d'); 
        }
        if($ctgl2==""){
           $ctgl2=date('Y-m-d'); 
        }
        $nm_coloum= array('a.IdImport','a.ImportDate','a.IdStatus','b.Keterangan','a.UserId','a.UserName');
              
        $nm_tabel='hisimportstatusproses a';
        
        $nm_tabel1='statusproses b';
        $on1='a.IdStatus=b.Noid';        
        
        $orderby= array('a.IdImport' => 'desc');
        
        $whereall=  array();
        $where=  array('date(a.ImportDate) >= '=>date('Y-m-d'),'date(a.ImportDate) <= '=>date('Y-m-d'));
        
        if ($cwhere!=""){
        $cwhere=str_replace('zzz','.',$cwhere);
        $cwhere=str_replace('333',' ',$cwhere);
        $cwhere=str_replace('ttt',"'",$cwhere);
        $cwhere=str_replace('xxx','%',$cwhere);
        $cwhere=str_replace('bbb','=',$cwhere);
        $cwhere=str_replace('kkk','<>',$cwhere);
        $cwhere=str_replace('iii','(',$cwhere);
        $cwhere=str_replace('ooo',')',$cwhere);
        $cwhere=str_replace('ppp',',',$cwhere);
        
        $where = $cwhere." and a.ImportDate >= '$ctgl1' and a.ImportDate <= '$ctgl2'";
        }
        
        $list = $this->Mdata->get_datatables_join1($nm_tabel,$nm_coloum,$nm_tabel1,'left',$on1,$orderby,$where);
        
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $row){
			$no++;
			$row = array(
            'IdImport' => $row->IdImport,
            'ImportDate' => $this->Mdata->tanggal_format_indonesia($row->ImportDate),
            'IdStatus' => $row->IdStatus,
            'Keterangan' => $row->Keterangan,
            'UserId' => $row->UserId,
            'UserName' => $row->UserName,
            'Action' => '<!--<a onclick="getedit('."'".$row->IdImport."'".')" id="edit" data-uk-tooltip title="Edit '.$row->IdImport.'"><i class="material-icons md-24 uk-text-primary">border_color</i></a>-->
                         <a onclick="print_('."'".$row->IdImport."'".','."'1'".')" id="preview" data-uk-tooltip title="preview '.$row->IdImport.'"><i class="material-icons md-24 " >remove_red_eye</i></a>
                         <a onclick="print_('."'".$row->IdImport."'".','."'2'".')" id="pdf" data-uk-tooltip title="PDF '.$row->IdImport.'"><i class="material-icons md-24 uk-text-danger" >picture_as_pdf</i></a>
                         <a onclick="print_('."'".$row->IdImport."'".','."'3'".')" id="excel" data-uk-tooltip title="Excel '.$row->IdImport.'" href="javascript:void(0)" class="uk-icon-button uk-icon-file-excel-o uk-text-success"></a>',
            );
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Mdata->count_all_join1($nm_tabel,$nm_coloum,$nm_tabel1,'inner',$on1),
						"recordsFiltered" => $this->Mdata->count_filtered_join1($nm_tabel,$nm_coloum,$nm_tabel1,'inner',$on1,$orderby,$where),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
    }


    function TypeClearanceList($pt="",$cwhere="",$ctgl1="",$ctgl2=""){
        if($ctgl1==""){
           $ctgl1=date('Y-m-d'); 
        }
        if($ctgl2==""){
           $ctgl2=date('Y-m-d'); 
        }
        $nm_coloum= array('a.IdImport','a.ImportDate','a.IdTypeClearance','b.TypeName','a.UserId','a.UserName');
              
        $nm_tabel='hisimportclearance a';
        
        $nm_tabel1='mstypeclearance b';
        $on1='a.IdTypeClearance=b.noid';        
        
        $orderby= array('a.IdImport' => 'desc');
        
        $whereall=  array();
        $where=  array('date(a.ImportDate) >= '=>date('Y-m-d'),'date(a.ImportDate) <= '=>date('Y-m-d'));
        
        if ($cwhere!=""){
        $cwhere=str_replace('zzz','.',$cwhere);
        $cwhere=str_replace('333',' ',$cwhere);
        $cwhere=str_replace('ttt',"'",$cwhere);
        $cwhere=str_replace('xxx','%',$cwhere);
        $cwhere=str_replace('bbb','=',$cwhere);
        $cwhere=str_replace('kkk','<>',$cwhere);
        $cwhere=str_replace('iii','(',$cwhere);
        $cwhere=str_replace('ooo',')',$cwhere);
        $cwhere=str_replace('ppp',',',$cwhere);
        
        $where = $cwhere." and a.ImportDate >= '$ctgl1' and a.ImportDate <= '$ctgl2'";
        }
        
        $list = $this->Mdata->get_datatables_join1($nm_tabel,$nm_coloum,$nm_tabel1,'left',$on1,$orderby,$where);
        
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $row){
			$no++;
			$row = array(
            'IdImport' => $row->IdImport,
            'ImportDate' => $this->Mdata->tanggal_format_indonesia($row->ImportDate),
            'IdStatus' => $row->IdTypeClearance,
            'Keterangan' => $row->TypeName,
            'UserId' => $row->UserId,
            'UserName' => $row->UserName,
            'Action' => '<!--<a onclick="getedit('."'".$row->IdImport."'".')" id="edit" data-uk-tooltip title="Edit '.$row->IdImport.'"><i class="material-icons md-24 uk-text-primary">border_color</i></a>-->
                         <a onclick="print_('."'".$row->IdImport."'".','."'1'".')" id="preview" data-uk-tooltip title="preview '.$row->IdImport.'"><i class="material-icons md-24 " >remove_red_eye</i></a>
                         <a onclick="print_('."'".$row->IdImport."'".','."'2'".')" id="pdf" data-uk-tooltip title="PDF '.$row->IdImport.'"><i class="material-icons md-24 uk-text-danger" >picture_as_pdf</i></a>
                         <a onclick="print_('."'".$row->IdImport."'".','."'3'".')" id="excel" data-uk-tooltip title="Excel '.$row->IdImport.'" href="javascript:void(0)" class="uk-icon-button uk-icon-file-excel-o uk-text-success"></a>',
            );
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Mdata->count_all_join1($nm_tabel,$nm_coloum,$nm_tabel1,'inner',$on1),
						"recordsFiltered" => $this->Mdata->count_filtered_join1($nm_tabel,$nm_coloum,$nm_tabel1,'inner',$on1,$orderby,$where),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
    }
    
    function cek_TypeClerance(){
        @ini_set( 'max_input_vars', 10000 );
        ini_set('max_execution_time', 300);
        $i=1;
        $data = array();
        $dataku=$this->input->post('data');
        foreach ($dataku as $rec){
        $tr=explode("||||xxx||||",$rec['dat']);
        $cek=0;
        $error='error data row = '.$i.', ';
        if($i>=2){
            if($tr[0] <> ''){
                
                $q=$this->db->query("SELECT COUNT(hawb) AS jml FROM t_shipment_cloud WHERE hawb ='$tr[0]'");
                $ka=0;
                foreach ($q->result() as $row)
                {
                       $ka=$row->jml;
                       if($ka == 0){
                            $error .= " Hawb ".$tr[0]." is not fount,";
                            $cek=1;
                       }
                }
                   
                if(trim($tr[0]) == ''){
                    $error .= " Coloum  Hawb Not Be Empty, ";
                    $cek=1;
                }
                
                if(trim($tr[1]) == ''){
                    $error .= " Coloum  SPPB DATE Not Be Empty, ";
                    $cek=1;
                }
                
                $q=$this->db->query("SELECT COUNT(noid) AS jml FROM tm_typeclearance WHERE noid ='$tr[2]'");
                $ka=0;
                    foreach ($q->result() as $row)
                    {
                           $ka=$row->jml;
                           if($ka == 0){
                                $error .= " Type Clearance ".$tr[2]." is not fount,";
                                $cek=1;
                           }
                    }
                    
//                if(trim($tr[2]) == ''){
//                    $error .= "Coloum Note No Not Be Empty, ";
//                    $cek=1;
//                }
            }
        }   
        $i++;
        if($cek==1){
            $mess = array(
                'text' => $error,
                 );
        	$data[] = $mess;
           }
        }
        echo json_encode($data);
    }
    
    function UpdateTypeClerance(){
        @ini_set( 'max_input_vars', 3000 );
        ini_set('max_execution_time', 300);
        $tgl= date('Y-m-d');
        $extgl=explode("-",$tgl);
        $noawal1=$extgl[0].$extgl[1].$extgl[2];
        $noawal=$this->autonumb('hisimportclearance','IdImport',$noawal1);
        $data = array();
        //========
        
        $this->db->trans_begin();
        
            $nmtabel='hisimportclearance';
        		$data = array(
                        'IdImport' => $noawal,
                        'UserId'   => $this->session->userdata('cs_Idusr'),
                        'ImportDate' => date('Y-m-d H:i:s'),
        				'UserName' =>$this->session->userdata('cs_FullName'),
                        'IdTypeClearance' =>$this->input->post('stsproses'),
                        'TypeClearance' =>$this->input->post('txtstsproses'),
        			);
        	$insert = $this->Mdata->save($data,$nmtabel);
            
        $id=0;
        $dataku=$this->input->post('data');
        foreach ($dataku as $rec){
            
            $tr=explode("||||xxx||||",$rec['dat']);
            
           if ($id>=1){ 
            if($tr[1] <> ''){   
                 
               $hawb        = $tr[0];
               $dateSppb    = $tr[1];
               $note        = " ";  
               //=================//    
                    $q=$this->db->query("SELECT noid,Keterangan FROM tm_typeclearance WHERE noid ='$tr[2]'");
                    foreach ($q->result() as $row)
                    {
                           $tlc=$row->noid;
                           $tlcname=$row->Keterangan;
                    }
               //==== Header ====
               
                $FD1='';
                $FD = explode("/",$dateSppb);
                $FD1 = $FD[2].'-'.$FD[0].'-'.$FD[1];
                
                $myid=$noawal.sprintf("%04s",$id);
                
                $nmtabel='dtypeclearance';
        		$data = array(
                        'Id' => $myid,
                        'Hawb' => $hawb,
                        'DateUpdate' => $FD1,
                        'IdTypeClearance' => $tlc,
                        'TypeClearance' => $tlcname,
                        'Note' => $note,
                        'IdImport' => $noawal,
                        'IdUser' => $this->session->userdata('cs_Idusr'),
                        'UserName' => $this->session->userdata('cs_FullName'),
                        'ModifDate' => date('Y-m-d H:i:s')
        			);
        		$insert = $this->Mdata->save($data,$nmtabel);                
                
                $q=$this->db->query("SELECT DateUpdate,IdTypeClearance  FROM dtypeclearance WHERE Hawb ='$hawb' ORDER BY DateUpdate DESC ,Id DESC LIMIT 0,1");
                    foreach ($q->result() as $row)
                    {
                        $nmtabel_='t_shipment_cloud';
                        $key_='hawb';
              	        $data_ = array(
                                    'type_clearance' => $row->IdTypeClearance,
                    			);
                    	$this->Mdata->update(array($key_ => $hawb), $data_,$nmtabel_);
                    }
                
             }
            }        
            $id++;
        
      }
        if ($this->db->trans_status() === FALSE)
        {
                $this->db->trans_rollback();
                echo json_encode(array('sts'=>false,'preview'=>'Error Import'));
        }
        else
        {
                $this->db->trans_commit();
                echo json_encode(array('sts'=>true,'preview'=>'yess'));
        }
    }
    
    public function ticketAdd(){
        $tgl= date('Y-m-d');
        $extgl=explode("-",$tgl);
        $noawal1=$extgl[0].$extgl[1].$extgl[2];
        $idhawb = $this->input->post('idhawb');
        $noawal=$this->autonumb('ticket_full_hdr','ticket_id',$noawal1);
        
            $nmtabel='ticket_full_hdr';
        		$data = array(
                        'ticket_id'     =>  $noawal,
                        'object_id'     =>  $idhawb,
                        'remarks'       =>  $this->input->post('content'),
                        'created_date'  =>  date('Y-m-d H:i:s'),
        				'complain_date' =>  date('Y-m-d H:i:s'),
                        'complain_name' =>  $this->input->post('name'),
                        'phone1'        =>  $this->input->post('phone'),
                        'email'         =>  $this->input->post('email'),
                        'UserId'        =>  $this->session->userdata('cs_Idusr'),
        				'UserName'      =>  $this->session->userdata('cs_FullName'),
						'jam_awal'      =>  $this->input->post('incall'),
						'jam_akhir'     => $this->input->post('outcall'),
						'outcome'       =>   $this->input->post('outcome_result'),
                        'bycas'         => $this->input->post('bycas'),
						'byups'         =>   $this->input->post('byups'),
                        'status_id'     => '1'
        			);
        	$insert = $this->Mdata->save($data,$nmtabel);
            
            if($this->input->post('stsadd')==2){
                $hawb = $this->input->post('idhawb');
                
                $tgl= date('Y-m-d');
                $extgl=explode("-",$tgl);
                $noawal1=$extgl[0].$extgl[1].$extgl[2].'TRK';
                $noawal=$this->autonumb('dstatusproses','Id',$noawal1);
        
                $nmtabel='dstatusproses';
        		$data = array(
                        'Id' => $noawal,
                        'Hawb' => $hawb,
                        'DateUpdate' => date('Y-m-d H:i:s'),
                        'IdStatusProses' => $this->input->post('utyclearance'),
                        'StatusProses' => $this->input->post('utyclearance_text'),
                        'Note' => $this->input->post('utyremark'),
                        'IdImport' => 'Input',
                        'IdUser' => $this->session->userdata('cs_Idusr'),
                        'UserName' => $this->session->userdata('cs_FullName'),
                        'ModifDate' => date('Y-m-d H:i:s')
        			);
        		$insert = $this->Mdata->save($data,$nmtabel);                
                
                $q=$this->db->query("SELECT DateUpdate,IdStatusProses,StatusProses,Note  FROM dstatusproses WHERE Hawb ='$hawb' ORDER BY DateUpdate DESC ,Id DESC LIMIT 0,1");
                    foreach ($q->result() as $row)
                    {
                        $nmtabel_='t_shipment_cloud';
                        $key_='hawb';
              	        $data_ = array(
                                    'TrackingStatus' => $row->IdStatusProses,
                                    'TrackingDate' => $row->DateUpdate,
                                    'TrackingRemark' => $row->Note,
                    			);
                    	$this->Mdata->update(array($key_ => $hawb), $data_,$nmtabel_);
                    }
            }
            
            echo json_encode(array('sts'=>true));
    }
    
    public function ticketGet()
	{
	    $id = $hid=$this->uri->segment(4);//$this->input->post('idhawb');
		$nm_tabel='ticket_full_hdr a';
        $nm_tabel1='ticket_status b';
        $on1='a.status_id=b.id';
        $nm_coloum= array('a.bycas','a.byups','b.name','a.ticket_id','a.remarks','a.created_date','a.complain_date','a.complain_name','a.phone1','a.email','a.UserId','a.UserName','a.status_id','a.jam_awal','a.jam_akhir','a.outcome');
        $orderby= array('a.ticket_id' => 'asc');
        $where=  array('a.ticket_id' => $id);
        $list = $this->Mdata->get_datadetail_join1($nm_coloum,$nm_tabel,$nm_tabel1,$on1,'inner',$orderby,$where);
        
		$data = array();
		$no = 0;
        $Rec = '';
        $iki = '';
        $idticket='';
		foreach ($list as $rec){
        $no = 1;
           // $tglcreate = $rec->created_date;
            $Rec =' <div class="uk-grid uk-grid-divider uk-grid-medium">
                <div class="uk-width-large-1-3">
                <input type="hidden" id="idticket" nama="idticket" value="'.$rec->ticket_id.'">
                    <ul class="md-list">
                        <li>
                          <div class="md-list-content">
                            <span class="uk-text-small uk-text-muted uk-display-block">Create By</span>
                            <span class="md-list-heading uk-text-large" >'.$rec->UserName.'</span>
                          </div>
                        </li>
                        <li>
                          <div class="md-list-content">
                            <span class="uk-text-small uk-text-muted uk-display-block">Date Create</span>
                            <span class="md-list-heading uk-text-large" >'.$rec->created_date.'</span>
                          </div>
                         </li>
                         <li>
                          <div class="md-list-content">
                            <span class="uk-text-small uk-text-muted uk-display-block">Start Time</span>
                            <span class="md-list-heading uk-text-large" >'.$rec->jam_awal.'</span>
                          </div>
                         </li>
                         <li>
                          <div class="md-list-content">
                            <span class="uk-text-small uk-text-muted uk-display-block">Action By CAS</span>
                            <span class="md-list-heading uk-text-large" >'.$rec->bycas.'</span>
                          </div>
                         </li>
                    </ul>
                  </div>
                  <div class="uk-width-large-1-3">
                    <ul class="md-list">
                       <li>
                           <div class="md-list-content">
                              <span class="uk-text-small uk-text-muted uk-display-block">Name</span>
                              <span class="md-list-heading uk-text-large " >'.$rec->complain_name.'</span>
                           </div>
                       </li>
                       <li>
                           <div class="md-list-content">
                              <span class="uk-text-small uk-text-muted uk-display-block">Phone</span>
                              <span class="md-list-heading uk-text-large" >'.$rec->phone1.'</span>
                           </div>
                        </li>
                         <li>
                          <div class="md-list-content">
                            <span class="uk-text-small uk-text-muted uk-display-block">End Time</span>
                            <span class="md-list-heading uk-text-large" >'.$rec->jam_akhir.'</span>
                          </div>
                         </li>
                         <li>
                          <div class="md-list-content">
                            <span class="uk-text-small uk-text-muted uk-display-block">Action By UPS</span>
                            <span class="md-list-heading uk-text-large" >'.$rec->byups.'</span>
                          </div>
                         </li>
                     </ul>
                  </div>
                  <div class="uk-width-large-1-3">
                     <ul class="md-list">
                        <li>
                           <div class="md-list-content">
                              <span class="uk-text-small uk-text-muted uk-display-block">Email</span>
                              <span class="md-list-heading uk-text-large" >'.$rec->email.'</span>
                           </div>
                        </li>
                        <li>
                           <div class="md-list-content">
                               <span class="uk-text-small uk-text-muted uk-display-block">Status Ticket</span>
                               <span class="md-list-heading uk-text-large" id="v_ststicket" >'.$rec->name.'</span>
                           </div>
                        </li> 
                        <li>
                           <div class="md-list-content">
                               <span class="uk-text-small uk-text-muted uk-display-block">Outcome Result </span>
                               <span class="md-list-heading uk-text-large" id="v_ststicket" >'.$rec->outcome.'</span>
                           </div>
                        </li> 
                     </ul>
                  </div>
             </div>
             <div class="uk-grid" style="margin-top: 0px;">
                <div class="uk-width-large-1-1">
                    <ul class="md-list">
                        <li>
                          <div class="md-list-content">
                            <span class="md-list-heading uk-text-large">Content</span>
                            <span style="border: 1px #d7d7d8 solid;padding: 10px;">'.$rec->remarks.'</span>
                          </div>
                        </li>
                    </ul>
                  </div>
             </div>
             ';
             $iki = $rec->status_id;
             $idticket = $rec->ticket_id;
		}
            $row = array(
            'isi' => $Rec,
            'sts' => $no,
            'iki'=> $iki,
            'idticket'=>$idticket,
            );
			$data[] = $row;
            
		echo $Rec;
	}
    
    public function cmbStatusTicket()
	{
		$nm_tabel='ticket_status';
        $nm_coloum= array('id','name');
        $orderby= array('id' => 'asc');
        $where=  array();
        $list = $this->Mdata->get_datadetail($nm_tabel,$nm_coloum,$orderby,$where);
        
		$data = array();
		$no = 0;
        	$row = array(
            'id'    => ' ',
            'name'  => '...',
            'isi'   => ''
            );
			$data[] = $row;
		foreach ($list as $rec){
			$no++;
			$row = array(
            'id' => $rec->id,
            'name' => $rec->name,
            'isi' => ''
            );
			$data[] = $row;
		}
		echo json_encode($data);
	}
    
    public function commentAdd(){
        //$tgl= date('Y-m-d');
//        $extgl=explode("-",$tgl);
//        $noawal1=$extgl[0].$extgl[1].$extgl[2];
        $idticket = $this->input->post('idticket');
        $noawal=$this->autonumb('ticket_detail','Id',$idticket);
        
            $nmtabel='ticket_detail';
        		$data = array(
                        'Id'            =>  $noawal,
                        'ticket_id'     =>  $idticket,
                        'comment'       =>  $this->input->post('contents'),
                        'comment_date'  =>  date('Y-m-d H:i:s'),
                        'status_id'     =>  $this->input->post('sts'),
                        'user_id'       =>  $this->session->userdata('cs_Idusr'),
        				'UserName'      =>  $this->session->userdata('cs_FullName'),
                        'jam_awal'      =>  $this->input->post('jam_awal'),
                        'jam_akhir'     =>  $this->input->post('jam_akhir'),
                        'bycas'         =>  $this->input->post('bycas'),
                        'byups'         =>  $this->input->post('byups'),
                        'outcome'       =>  $this->input->post('outcome')
        			);
        	$insert = $this->Mdata->save($data,$nmtabel);
            
            if($this->input->post('ststicket')<>' '){
                $nmtabel_='ticket_full_hdr';
                        $key_='ticket_id';
              	        $data_ = array(
                                    'status_id' => $this->input->post('ststicket'),
                    			);
                    	$this->Mdata->update(array($key_ => $idticket), $data_,$nmtabel_);
            }
            
            if($this->input->post('stsadd')==2){
                $hawb = $this->input->post('idhawb');
                
                $tgl= date('Y-m-d');
                $extgl=explode("-",$tgl);
                $noawal1=$extgl[0].$extgl[1].$extgl[2].'TRK';
                $noawal=$this->autonumb('dstatusproses','Id',$noawal1);
        
                $nmtabel='dstatusproses';
        		$data = array(
                        'Id' => $noawal,
                        'Hawb' => $hawb,
                        'DateUpdate' => date('Y-m-d H:i:s'),
                        'IdStatusProses' => $this->input->post('utyclearance'),
                        'StatusProses' => $this->input->post('utyclearance_text'),
                        'Note' => $this->input->post('utyremark'),
                        'IdImport' => 'Input',
                        'IdUser' => $this->session->userdata('cs_Idusr'),
                        'UserName' => $this->session->userdata('cs_FullName'),
                        'ModifDate' => date('Y-m-d H:i:s')
        			);
        		$insert = $this->Mdata->save($data,$nmtabel);                
                
                $q=$this->db->query("SELECT DateUpdate,IdStatusProses,StatusProses,Note  FROM dstatusproses WHERE Hawb ='$hawb' ORDER BY DateUpdate DESC ,Id DESC LIMIT 0,1");
                    foreach ($q->result() as $row)
                    {
                        $nmtabel_='t_shipment_cloud';
                        $key_='hawb';
              	        $data_ = array(
                                    'TrackingStatus' => $row->IdStatusProses,
                                    'TrackingDate' => $row->DateUpdate,
                                    'TrackingRemark' => $row->Note,
                    			);
                    	$this->Mdata->update(array($key_ => $hawb), $data_,$nmtabel_);
                    }
            }
            
            echo json_encode(array('sts'=>true));
    }
    
    public function discuctionAdd(){
        $tgl= date('Y-m-d');
        $extgl=explode("-",$tgl);
        $noawal1=$extgl[0].$extgl[1].$extgl[2];
        $idticket = $this->input->post('idticket');
        $noawal=$this->autonumb('comment','Id',$noawal1);
        
            $nmtabel='comment';
        		$data = array(
                        'Id'            =>  $noawal,
                        'Reff'          =>  $idticket,
                        'Content'       =>  $this->input->post('contents'),
                        'DateInput'     =>  date('Y-m-d H:i:s'),
                        //'status_id'     =>  $this->input->post('sts'),
                        'CreateBy'      =>  $this->session->userdata('cs_Idusr'),
        				//'UserName'      =>  $this->session->userdata('cs_FullName'),
        			);
        	$insert = $this->Mdata->save($data,$nmtabel);
            
            echo json_encode(array('sts'=>true));
    }
    
    public function commentGetTicket()
	{
		$nm_tabel='ticket_detail a';
        $nm_coloum= array("a.Id AS 'Id_comment'","DATE(a.comment_date) AS 'date_comment'","TIME(a.comment_date) AS 'time_comment'","a.status_id","a.comment","a.UserName","a.user_id");
        $orderby= array('a.comment_date' => 'desc','a.Id' => 'desc');
        $where=  array();
        $list = $this->Mdata->get_datadetailMy($nm_coloum,$nm_tabel,$orderby,$where);
        
        
        
		$data = array();
		$no = 0;
		foreach ($list as $rec){
			$no++;
			$row = array(
            'id' => $rec->Id_comment,
            'date' => $this->Mdata->tanggal_format_indonesia($rec->date_comment),
            'time' => $rec->time_comment,
            'sts' => $rec->status_id,
            'content' => $rec->comment,
            'name' => $rec->UserName,
            'userid' => $rec->user_id,
            );
			$data[] = $row;
		}
		$output = array(
						"data" => $data,
				);
		//output to json format
		echo json_encode($data);
	}
   
    public function StatusTrackingGet(){
            $hid=$this->uri->segment(4);
            $nm_coloum= array('Id','StatusProses','DateUpdate','Note','UserName','CodeStatus','Keterangan');
            
            $nm_tabel='dstatusproses a';
            $nm_tabel1='statusproses b';
            $on ='a.IdStatusProses=b.Noid';
            $orderby= array('a.Id' => 'desc');
            $where=  array('a.Hawb'=>$hid);
            
            
            $list = $this->Mdata->get_datatables_join1($nm_tabel,$nm_coloum,$nm_tabel1,'inner',$on,$orderby,$where);
            
    		$data = array();
    		$no = $_POST['start'];
    		foreach ($list as $row){
              
    			$no++;
    			$row = array(
                'Id' =>$row->Id,
                'DateUpdate' =>$row->DateUpdate,
                'StatusProses'=>$row->CodeStatus.' - '.$row->Keterangan,
                'Note'=>$row->Note,
                'UserName'=>$row->UserName,
                'Action'=> '
                       <!-- <a class="red delete" href="javascript:void()" title="Lihat Data" onclick="lihat_data('."'".$row->Id."'".')"><i class="fa fa-file-pdf-o bigger-150"></i></a>&nbsp;&nbsp;-->
                        <a class="green update" href="javascript:void()" title="Edit" onclick="edit_data_payment('."'".$row->Id."'".')"><i class="icon-pencil bigger-150 update"></i></a>&nbsp;&nbsp;
    				    <a class="red delete" href="javascript:void()" title="Hapus" onclick="delete_payment('."'".$row->Id."'".')"><i class="icon-trash bigger-150 delete"></i></a>&nbsp;&nbsp;'
                );
    			$data[] = $row;
    		}
    
    		$output = array(
    						"draw" => $_POST['draw'],
    						"recordsTotal" => $this->Mdata->count_all($nm_tabel,$nm_coloum,$orderby),
    						"recordsFiltered" => $this->Mdata->count_filtered($nm_tabel,$nm_coloum,$orderby,$where),
    						"data" => $data,
    				);
    		//output to json format
    		echo json_encode($output);
    }
    
    public function StatusTrackingUpdate(){
                $hawb = $this->input->post('hawb');
                
                $tgl= date('Y-m-d');
                $extgl=explode("-",$tgl);
                $noawal1=$extgl[0].$extgl[1].$extgl[2].'TRK';
                $noawal=$this->autonumb('dstatusproses','Id',$noawal1);
        
                $nmtabel='dstatusproses';
        		$data = array(
                        'Id' => $noawal,
                        'Hawb' => $hawb,
                        'DateUpdate' => date('Y-m-d H:i:s'),
                        'IdStatusProses' => $this->input->post('ut_statusproses'),
                        'StatusProses' => $this->input->post('txtstsproses'),
                        'Note' => $this->input->post('ut_remark'),
                        'IdImport' => 'Input',
                        'IdUser' => $this->session->userdata('cs_Idusr'),
                        'UserName' => $this->session->userdata('cs_FullName'),
                        'ModifDate' => date('Y-m-d H:i:s')
        			);
        		$insert = $this->Mdata->save($data,$nmtabel);                
                
                $q=$this->db->query("SELECT DateUpdate,IdStatusProses,StatusProses,Note  FROM dstatusproses WHERE Hawb ='$hawb' ORDER BY DateUpdate DESC ,Id DESC LIMIT 0,1");
                    foreach ($q->result() as $row)
                    {
                        $nmtabel_='t_shipment_cloud';
                        $key_='hawb';
              	        $data_ = array(
                                    'TrackingStatus' => $row->IdStatusProses,
                                    'TrackingDate' => $row->DateUpdate,
                                    'TrackingRemark' => $row->Note,
                    			);
                    	$this->Mdata->update(array($key_ => $hawb), $data_,$nmtabel_);
                    }
                    
                    echo json_encode(array('sts'=>true,'stsproses'=>$row->StatusProses,'datestatus'=>$row->DateUpdate,'remark'=>$row->Note));
    }
    
        public function TypeClearanceUpdate(){
                $hawb = $this->input->post('hawb');
                
                $tgl= date('Y-m-d');
                $extgl=explode("-",$tgl);
                $noawal1=$extgl[0].$extgl[1].$extgl[2].'TRK';
                $noawal=$this->autonumb('dtypeclearance','Id',$noawal1);
        
                $nmtabel='dtypeclearance';
        		$data = array(
                        'Id' => $noawal,
                        'Hawb' => $hawb,
                        'DateUpdate' => date('Y-m-d H:i:s'),
                        'IdTypeClearance' => $this->input->post('uty_clearance'),
                        'TypeClearance' => $this->input->post('txtstsproses'),
                        'Note' => $this->input->post('uty_remark'),
                        'IdImport' => 'Input',
                        'IdUser' => $this->session->userdata('cs_Idusr'),
                        'UserName' => $this->session->userdata('cs_FullName'),
                        'ModifDate' => date('Y-m-d H:i:s')
        			);
        		$insert = $this->Mdata->save($data,$nmtabel);                
                
                $q=$this->db->query("SELECT DateUpdate,IdTypeClearance,TypeClearance  FROM dtypeclearance WHERE Hawb ='$hawb' ORDER BY DateUpdate DESC ,Id DESC LIMIT 0,1");
                    foreach ($q->result() as $row)
                    {
                        $nmtabel_='t_shipment_cloud';
                        $key_='hawb';
              	        $data_ = array(
                                    'Id_aju' => $row->IdTypeClearance,
                               //     'StatusDate' => $row->DateUpdate,
                    			);
                    	$this->Mdata->update(array($key_ => $hawb), $data_,$nmtabel_);
                    }
                    
                    echo json_encode(array('sts'=>true,'stsproses'=>$row->TypeClearance,'datestatus'=>$row->DateUpdate));
    }
    
    
        public function TypeClearanceGet(){
            $hid=$this->uri->segment(4);
            $nm_coloum= array('Id','TypeClearance','DateUpdate','Note','UserName');
            
            $nm_tabel='dtypeclearance ';
            
            $orderby= array('Id' => 'desc');
            $where=  array('Hawb'=>$hid);
            
            
            $list = $this->Mdata->get_datatables($nm_tabel,$nm_coloum,$orderby,$where);
            
    		$data = array();
    		$no = $_POST['start'];
    		foreach ($list as $row){
              
    			$no++;
    			$row = array(
                'Id' =>$row->Id,
                'DateUpdate' =>$row->DateUpdate,
                'TypeClearance'=>$row->TypeClearance,
                'Note'=>$row->Note,
                'UserName'=>$row->UserName,
                'Action'=> '
                       <!-- <a class="red delete" href="javascript:void()" title="Lihat Data" onclick="lihat_data('."'".$row->Id."'".')"><i class="fa fa-file-pdf-o bigger-150"></i></a>&nbsp;&nbsp;-->
                        <a class="green update" href="javascript:void()" title="Edit" onclick="edit_data_payment('."'".$row->Id."'".')"><i class="icon-pencil bigger-150 update"></i></a>&nbsp;&nbsp;
    				    <a class="red delete" href="javascript:void()" title="Hapus" onclick="delete_payment('."'".$row->Id."'".')"><i class="icon-trash bigger-150 delete"></i></a>&nbsp;&nbsp;'
                );
    			$data[] = $row;
    		}
    
    		$output = array(
    						"draw" => $_POST['draw'],
    						"recordsTotal" => $this->Mdata->count_all($nm_tabel,$nm_coloum,$orderby),
    						"recordsFiltered" => $this->Mdata->count_filtered($nm_tabel,$nm_coloum,$orderby,$where),
    						"data" => $data,
    				);
    		//output to json format
    		echo json_encode($output);
    }

        public function AttachmentGet(){
            $hid=$this->uri->segment(4);
            $nm_coloum= array('IdAttachment','AttachmentName','AttachmentDate','Description','AttachmentType','UserName');
            
            $nm_tabel='attachment ';
            
            $orderby= array('IdAttachment' => 'desc');
            $where=  array('Reff'=>$hid);
            
            
            $list = $this->Mdata->get_datatables($nm_tabel,$nm_coloum,$orderby,$where);
            
    		$data = array();
    		$no = $_POST['start'];
    		foreach ($list as $row){
              
    			$no++;
    			$row = array(
                'IdAttachment' =>$row->IdAttachment,
                'AttachmentDate' =>$row->AttachmentDate,
                'AttachmentName'=>$row->AttachmentName,
                'AttachmentType'=>$row->AttachmentType,
                'UserName'=>$row->UserName,
                'Description'=>$row->Description,
                'Action'=> '<a class="green" href="javascript:void()" data-uk-tooltip  title="Download '.$row->AttachmentName.'" onclick="download_attachment('."'".$row->IdAttachment."'".','."'".$row->AttachmentName."'".')"><i class="material-icons md-24 uk-text-primary">cloud_download</i></a>&nbsp;&nbsp;
                            <!-- |<a class="red" href="javascript:void()" data-uk-tooltip  title="Delete '.$row->AttachmentName.'" onclick="deleteAttachment('."'".$row->IdAttachment."'".','."'".$row->AttachmentName."'".')"><i class="material-icons md-24 uk-text-danger">delete_forever</i></a>&nbsp;&nbsp; -->'
                );
    			$data[] = $row;
    		}
    
    		$output = array(
    						"draw" => $_POST['draw'],
    						"recordsTotal" => $this->Mdata->count_all($nm_tabel,$nm_coloum,$orderby),
    						"recordsFiltered" => $this->Mdata->count_filtered($nm_tabel,$nm_coloum,$orderby,$where),
    						"data" => $data,
    				);
    		//output to json format
    		echo json_encode($output);
    }    

//    public function AttachmentDownload(){
//        $this->load->helper('download');
//        $file= base_url().'file/manifest/20170415_Y01Y29CXDKS_pibk001.png';
//        force_download('20170415_Y01Y29CXDKS_pibk001.png', $file);    
//    }
//    
//    public function download(){
//          $name = '20170415_E47997HL7G3_other001.png';        
//          $path= base_url().'file/manifest/20170415_E47997HL7G3_other001.png';        
//         // make sure it's a file before doing anything!
//          if(is_file($path))
//          {
//            // required for IE
//            if(ini_get('zlib.output_compression')) { ini_set('zlib.output_compression', 'Off'); }
//        
//            // get the file mime type using the file extension
//            $this->load->helper('file');
//        
//            $mime = get_mime_by_extension($path);
//        
//            // Build the headers to push out the file properly.
//            header('Pragma: public');     // required
//            header('Expires: 0');         // no cache
//            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
//            header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime ($path)).' GMT');
//            header('Cache-Control: private',false);
//            header('Content-Type: '.$mime);  // Add the mime type from Code igniter.
//            header('Content-Disposition: attachment; filename="'.basename($name).'"');  // Add the file name
//            header('Content-Transfer-Encoding: binary');
//            header('Content-Length: '.filesize($path)); // provide file size
//            header('Connection: close');
//            readfile($path); // push it out
//            exit();
//             
//        }else{
//            echo $path;
//        }            
//    }
    
    public function AttachmentDownload(){
        if($this->input->post('text')==''){
            exit();
        }
        $filename=$this->input->post('text');
        //$file = 'monkey.gif';
        $file= './file/manifest/'.$filename; 
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }else{
            echo $file;
        }
    }
    
    public function AttachmentDelete(){
        $id = $this->input->post('idfile');
        $nmfile = $this->input->post('namafile');
        $this->Mdata->delete_by_id($id,'attachment','IdAttachment');
        $file= './file/manifest/'.$nmfile; 
        unlink($file);
        echo json_encode(array('sts'=>true));
    }    
    
    public function commentGet()
	{
		$nm_tabel='comment a';
        $nm_tabel1='msuser b';
        $on='a.CreateBy=b.Id';
        $nm_coloum= array("a.Id AS 'Id_comment'","DATE(a.DateInput) AS 'date_comment'","TIME(a.DateInput) AS 'time_comment'","a.Sts","a.Content","b.FullName","a.CreateBy");
        $orderby= array('a.DateInput' => 'desc','a.Id' => 'desc');
        $where=  array();
        $list = $this->Mdata->get_datadetail_join1($nm_coloum,$nm_tabel,$nm_tabel1,$on,'inner',$orderby,$where);
        
		$data = array();
		$no = 0;
		foreach ($list as $rec){
			$no++;
			$row = array(
            'id' => $rec->Id_comment,
            'date' => $this->Mdata->tanggal_format_indonesia($rec->date_comment),
            'time' => $rec->time_comment,
            'sts' => $rec->Sts,
            'content' => $rec->Content,
            'name' => $rec->FullName,
            'CreateBy' => $rec->CreateBy
            );
			$data[] = $row;
		}
		$output = array(
						"data" => $data,
				);
		//output to json format
		echo json_encode($data);
	}
    
    public function tarikticket(){
        $hid=$this->uri->segment(4);
		$nm_tabel='ticket_detail a';
        $nm_coloum= array("a.Id AS 'Id_comment'","DATE(a.comment_date) AS 'date_comment'","TIME(a.comment_date) AS 'time_comment'","a.status_id","a.comment","a.UserName","a.user_id");
        $orderby= array('a.comment_date' => 'desc','a.Id' => 'desc');
        $where=  array('ticket_id'=>$hid);
        $list = $this->Mdata->get_datadetailMy($nm_coloum,$nm_tabel,$orderby,$where);
        
		//$data = array();
		$no = 0;
        $Recs='';
		foreach ($list as $rec){
			$no++;
//			$row = array(
//            'id' => $rec->Id_comment,
//            'date' => $this->Mdata->tanggal_format_indonesia($rec->date_comment),
//            'time' => $rec->time_comment,
//            'sts' => $rec->status_id,
//            'content' => $rec->comment,
//            'name' => $rec->UserName,
//            'userid' => $rec->user_id,
//            );
//			$data[] = $row;
                $c='chat_message_wrapper';
            if($rec->user_id!=$this->session->userdata('cs_Idusr')){
                $c='chat_message_wrapper chat_message_right';
            }
            $Recs .= '<div class="'.$c.'"><div class="chat_user_avatar">
                    <img class="md-user-image" src="'.base_url().'asset/images/customer/avatar.png" alt=""/></div>
                    <ul class="chat_message">
                    <li><span class="md-list-heading">'.$rec->UserName.'</span><p>'.$rec->comment.'<span class="chat_message_time">
                    '.$this->Mdata->tanggal_format_indonesia($rec->date_comment).', '.$rec->time_comment.'</span></p></li></ul></div>';
            
		}
		//$output = array(
		//				"data" => $data,
		//		);
		//output to json format
		//echo json_encode(array('sts'=>true,'RecKu'=>$Recs));
        echo $Recs;
    }
    
     public function tarikchat()
	{
	    $hid=$this->uri->segment(4);
		$nm_tabel='comment a';
        $nm_tabel1='msuser b';
        $on='a.CreateBy=b.Id';
        $nm_coloum= array("a.Id AS 'Id_comment'","DATE(a.DateInput) AS 'date_comment'","TIME(a.DateInput) AS 'time_comment'","a.Sts","a.Content","b.FullName","a.CreateBy");
        $orderby= array('a.DateInput' => 'desc','a.Id' => 'desc');
        $where=  array('Reff'=>$hid);
        $list = $this->Mdata->get_datadetail_join1($nm_coloum,$nm_tabel,$nm_tabel1,$on,'inner',$orderby,$where);
        
		//$data = array();
		$no = 0;
        $Recs ='';
		foreach ($list as $rec){
//          $no++;
//			$row = array(
//            'id' => $rec->Id_comment,
//            'date' => $this->Mdata->tanggal_format_indonesia($rec->date_comment),
//            'time' => $rec->time_comment,
//            'sts' => $rec->Sts,
//            'content' => $rec->Content,
//            'name' => $rec->FullName,
//            'CreateBy' => $rec->CreateBy
//            );
//			$data[] = $row;
                $c='chat_message_wrapper';
            if($rec->CreateBy!=$this->session->userdata('cs_Idusr')){
                $c='chat_message_wrapper chat_message_right';
            }
            $Recs .= '<div class="'.$c.'"><div class="chat_user_avatar">
                    <img class="md-user-image" src="'.base_url().'asset/images/customer/avatar.png" alt=""/></div>
                    <ul class="chat_message">
                    <li><span class="md-list-heading">'.$rec->FullName.'</span><p>'.$rec->Content.'<span class="chat_message_time">
                    '.$this->Mdata->tanggal_format_indonesia($rec->date_comment).', '.$rec->time_comment.'</span></p></li></ul></div>';
                     
		}
//	     $output = array(
//						"data" => $data,
//				);
//      output to json format
//		echo json_encode($data);
        echo $Recs;
	}
    
    public function AddAttachment(){
            $tgl= date('Y-m-d');
            $extgl=explode("-",$tgl);
            $noawal_=$extgl[0].$extgl[1].$extgl[2];
            $noawal_='';
            $id=$this->input->post('Hawb');
            $type=$this->input->post('ua_jenis');
            $description=$this->input->post('ua_description');
            $MyNo=$noawal_.'_'.$id.'_'.$type;
            
            $cno=$this->autonumb('attachment','IdAttachment',$MyNo);
            
            $uploaddir = "./file/manifest/";
            $temp = explode(".", $_FILES["userfile"]["name"]);
            $uploadfile = $uploaddir . basename($cno.'.'.end($temp));
         
            if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)){
          //      $this->UploadCompress($cno,"userfile",$uploaddir,'20%',$uploadfile);
                $nmtabel='attachment';      
                $data_insert = array(
                    'IdAttachment' =>$cno,
                    'Reff' =>$id,
                    'AttachmentDate' =>date('Y-m-d H:i:s'),
                    'AttachmentName' =>$cno.'.'.end($temp),
                    'AttachmentEx' =>end($temp),
                    'AttachmentSize' =>0,    
                    'AttachmentType' =>$type,
                    'Description' =>$description,
                    'IdUser' => $this->session->userdata('cs_Idusr'),
                    'UserName' => $this->session->userdata('cs_FullName'),    
			     );
                $insert = $this->Mdata->save($data_insert,$nmtabel);
                 echo json_encode(array('sts'=>true));
            } else {
                
                 echo json_encode(array('sts'=>false));
            }
            
    }
    
    function UploadCompress($new_name,$file,$dir,$quality,$scr){

          $source_url=$scr;
          $info = getimagesize($source_url);
         
            if ($info['mime'] == 'image/jpeg'){ 
                $image = imagecreatefromjpeg($source_url); 
                $ext='.jpg';
            }
            elseif($info['mime'] == 'image/gif'){ 
                $image = imagecreatefromgif($source_url); 
                $ext='.gif';
            }elseif($info['mime'] == 'image/png'){ 
                $image = imagecreatefrompng($source_url); 
                $ext='.png';
            }
           
            if(imagejpeg($image, $dir.'tmb/'.$new_name.$ext, $quality)){
               // unlink($source_url);
                return true;
            }else{
                unlink($source_url);
                return false;
            }

        }
 
 
     public function TicketListGet(){
            $hid=$this->uri->segment(4);
            $nm_coloum= array('a.ticket_id','a.remarks','a.complain_date','complain_name','phone1','email','status_id','UserName','b.name');
            
            $nm_tabel='ticket_full_hdr a';
            $nm_tabel1='ticket_status b';
            $on1='a.status_id=b.id';
            
            $orderby= array('a.ticket_id' => 'desc');
            $where=  array('a.object_id'=>$hid);
            
            
            $list = $this->Mdata->get_datatables_join1($nm_tabel,$nm_coloum,$nm_tabel1,'inner',$on1,$orderby,$where);
            
    		$data = array();
    		$no = $_POST['start'];
    		foreach ($list as $row){
    		  
                $cnt = substr($row->remarks, 0, 100);
    		      if(strlen($row->remarks)>100){
    		          $cnt = substr($row->remarks, 0, 100).'...';
    		      }
    			$no++;
    			$row = array(
                'ticket_id' =>$row->ticket_id,
                'remarks' =>$cnt,
                'complain_date'=>$row->complain_date,
                'complain_name'=>$row->complain_name,
                'ticket_id' =>$row->ticket_id,
 //               'remarks' =>$row->remarks,
                'phone1'=>$row->complain_date,
                'email'=>$row->complain_name,
                'status_id'=>$row->status_id,
                'UserName'=>$row->UserName,
                'name'=>$row->name,
                );
    			$data[] = $row;
    		}
    
    		$output = array(
    						"draw" => $_POST['draw'],
    						"recordsTotal" => $this->Mdata->count_all_join1($nm_tabel,$nm_coloum,$nm_tabel1,'inner',$on1),
    						"recordsFiltered" => $this->Mdata->count_filtered_join1($nm_tabel,$nm_coloum,$nm_tabel1,'inner',$on1,$orderby,$where),
    						"data" => $data,
    				);
    		//output to json format
    		echo json_encode($output);
    }


    function jos(){
        $idgrup=$this->session->userdata('cs_Idgroup_usr');
        $iduser=$this->session->userdata('cs_Idusr');
// ======== ROLE GROUP STATUS TRACKING =========
        $rcode = '(';
        $query=$this->db->query("SELECT Code1 FROM smart_role WHERE GroupId='$idgrup' GROUP BY Code1");
        $nu=0;
        foreach($query->result() as $t){
            if($nu==0){$rcode .= "'".$t->Code1."'";}else{$rcode .= ","."'".$t->Code1."'";}
            $nu=$nu+1;
        }
        $rcode .=')';
        // ======== ROLE TEAM DIGIT ===================
        $digit = '(';
        $query=$this->db->query("SELECT id_alpha FROM team_digit a INNER JOIN team_user b ON a.Id_team=b.id_team WHERE b.id_user='$iduser'  GROUP BY id_alpha");
        $nu=0;
        foreach($query->result() as $t){
            if($nu==0){$digit .= "'".$t->id_alpha."'";}else{$digit .= ","."'".$t->id_alpha."'";}
            $nu=$nu+1;
        }
        $digit .=')';        
        // ======== ROLE TEAM TYPE CLEARANCE =========
        $type_clear = '(';
        $query=$this->db->query("SELECT type_clearance FROM team a INNER JOIN team_user b ON a.Id_team=b.id_team WHERE b.id_user='$iduser' GROUP BY type_clearance");
        $nu=0;
        foreach($query->result() as $t){
            if($nu==0){$type_clear .= "'".$t->type_clearance."'";}else{$type_clear .= ","."'".$t->type_clearance."'";}
            $nu=$nu+1;
        }
        $type_clear .=')'; 
        //========================================
        echo $rcode.' - '.$digit.' - '.$type_clear;
    }  


     function ManifestList_myjob($pt="",$cwhere="",$ctgl1="",$ctgl2=""){
        $idgrup=$this->session->userdata('cs_Idgroup_usr');
        $iduser=$this->session->userdata('cs_Idusr');
        // ======== ROLE GROUP STATUS TRACKING =========
        $rcode = '(';
        $query=$this->db->query("SELECT Code1 FROM smart_role WHERE GroupId='$idgrup' GROUP BY Code1");
        $nu=0;
        foreach($query->result() as $t){
            if($nu==0){$rcode .= "'".$t->Code1."'";}else{$rcode .= ","."'".$t->Code1."'";}
            $nu=$nu+1;
        }
        $rcode .=')';
        // ======== ROLE TEAM DIGIT ===================
        $digit = '(';
        $query=$this->db->query("SELECT id_alpha FROM team_digit a INNER JOIN team_user b ON a.Id_team=b.id_team WHERE b.id_user='$iduser'  GROUP BY id_alpha");
        $nu=0;
        foreach($query->result() as $t){
            if($nu==0){$digit .= "'".$t->id_alpha."'";}else{$digit .= ","."'".$t->id_alpha."'";}
            $nu=$nu+1;
        }
        $digit .=')';        
        // ======== ROLE TEAM TYPE CLEARANCE =========
        $type_clear = '(';
        $query=$this->db->query("SELECT type_clearance FROM team a INNER JOIN team_user b ON a.Id_team=b.id_team WHERE b.id_user='$iduser' GROUP BY type_clearance");
        $nu=0;
        foreach($query->result() as $t){
            if($nu==0){$type_clear .= "'".$t->type_clearance."'";}else{$type_clear .= ","."'".$t->type_clearance."'";}
            $nu=$nu+1;
        }
        $type_clear .=')'; 
        // ======== ROLE TYPE CLEARANCE PMK 182=========
        $pmk182 = '(';
        $query=$this->db->query("SELECT pmk_182 FROM team a INNER JOIN team_user b ON a.Id_team=b.id_team WHERE b.id_user='$iduser' GROUP BY pmk_182");
        $nu=0;
        foreach($query->result() as $t){
            if($nu==0){$pmk182 .= "'".$t->pmk_182."'";}else{$pmk182 .= ","."'".$t->pmk_182."'";}
            $nu=$nu+1;
        }
        $pmk182 .=')'; 
        //========================================
            
        if($ctgl1==""){
           $ctgl1=date('Y-m-d'); 
        }
        if($ctgl2==""){
           $ctgl2=date('Y-m-d'); 
        }
        $nm_coloum_order= array('b.mawb','a.hawb','b.flight_date','a.trackno','c.Keterangan','e.ket','d.Keterangan','b.shipper_name','b.consignee_name','b.type_clearance','b.kindofGood');

        $nm_coloum= array('b.mawb','a.hawb','b.flight_date','a.trackno','c.Keterangan as TypeName','e.ket','d.Keterangan','b.shipper_name','b.consignee_name','b.type_clearance','b.kindofGood');
              
        $nm_tabel='t_bill a';
        
        $nm_tabel1='t_shipment_cloud b';
        $on1='a.hawb=b.hawb';
        
        $nm_tabel2='tm_typeclearance c';
        $on2='b.type_clearance=c.TypeClearance';
        
        $nm_tabel3='statusproses d ';
        $on3='b.TrackingStatus=d.NoId';
        
        $nm_tabel4='bc_m_jns_aju e ';
        $on4='b.Id_aju=e.id_aju';
        
        $orderby= array('b.flight_date' => 'desc');
        
        $whereall=  array();
        //$where=  array('b.flight_date >= '=>date('Y-m-d'),'b.flight_date <= '=>date('Y-m-d'));
        $where=  "RIGHT(b.hawb,1) in $digit and b.TrackingStatus in $rcode and ( b.type_clearance in $type_clear  or b.Id_aju in $pmk182 ) and b.flight_date >= '$ctgl1' and b.flight_date <= '$ctgl2'";
        
        if ($cwhere!=""){
        $cwhere=str_replace('zzz','.',$cwhere);
        $cwhere=str_replace('333',' ',$cwhere);
        $cwhere=str_replace('ttt',"'",$cwhere);
        $cwhere=str_replace('xxx','%',$cwhere);
        $cwhere=str_replace('bbb','=',$cwhere);
        $cwhere=str_replace('kkk','<>',$cwhere);
        $cwhere=str_replace('iii','(',$cwhere);
        $cwhere=str_replace('ooo',')',$cwhere);
        $cwhere=str_replace('ppp',',',$cwhere);
        
        $where = $cwhere." and RIGHT(b.hawb,1) in $digit and b.TrackingStatus in $rcode and ( b.type_clearance in $type_clear  or b.Id_aju in $pmk182 ) and b.flight_date >= '$ctgl1' and b.flight_date <= '$ctgl2'";
        }
        
        if ($cwhere == "trias"){
        //    $where=  "b.flight_date >= '$ctgl1' and b.flight_date <= '$ctgl2'";
        //    $where=  array('b.flight_date >= '=>$ctgl1,'b.flight_date <= '=>$ctgl2);
        $where=  "RIGHT(b.hawb,1) in $digit and b.TrackingStatus in $rcode and ( b.type_clearance in $type_clear  or b.Id_aju in $pmk182 ) and b.flight_date >= '$ctgl1' and b.flight_date <= '$ctgl2'";
        }
        
        if($pt == 'rafles'){
        $where=  "b.hawb = '$cwhere'";    
        }
        
        $list = $this->Mdata->get_datatables_join4($nm_tabel,$nm_coloum,$nm_tabel1,'inner',$on1,$nm_tabel2,'left',$on2,$nm_tabel3,'left',$on3,$nm_tabel4,'left',$on4,$orderby,$where,$nm_coloum_order);
        
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $row){
			$no++;
			$row = array(
            'Mawb' => $row->mawb,
            'Hawb' => $row->hawb,
            'FlightDate' => $this->Mdata->tanggal_format_indonesia($row->flight_date),
            'TrackingNo' => $row->trackno,
            'CategoryHawb' => '',
            'ShipperName' => $row->shipper_name,
            'ConsigneeName' => $row->consignee_name,
            'TypeClerance' => $row->type_clearance,
            'Description' => $row->kindofGood,
            'Keterangan' => $row->TypeName,
            'StatusName' => $row->Keterangan,
            'Ket' => $row->ket,
            );
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" =>  $this->Mdata->count_all_join4($nm_tabel,$nm_coloum,$nm_tabel1,'inner',$on1,$nm_tabel2,'left',$on2,$nm_tabel3,'left',$on3,$nm_tabel4,'left',$on4,$where),
						"recordsFiltered" => $this->Mdata->count_filtered_join4($nm_tabel,$nm_coloum,$nm_tabel1,'inner',$on1,$nm_tabel2,'left',$on2,$nm_tabel3,'left',$on3,$nm_tabel4,'left',$on4,$orderby,$where),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
    }
    
    function sendemail(){
            $url = '';
            $config = Array(
              'protocol' => 'smtp',
//              'smtp_host' => 'ssl://smtp.googlemail.com',
//              'smtp_port' => 465,
//              'smtp_user' => 'triastartya@gmail.com', 
//              'smtp_pass' => 'muharami', 
              'smtp_crypto' => 'tls',
              'smtp_host' => 'smtp.office365.com',
              'smtp_port' => 587,
              'smtp_user' => 'care@cas-express.co.id', //isi dengan gmailmu!
              'smtp_pass' => 'CustCAS123', //isi dengan password gmailmu!
              'mailtype' => 'html',
              'charset' => 'iso-8859-1',
              'wordwrap' => TRUE
            );
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from('care@cas-express.co.id');
            $this->email->to('triastartya@gmail.com'); //email tujuan. Isikan dengan emailmu!
            $this->email->subject('tesssss_1234');
            $this->email->message('$pesan');
            if($this->email->send())
            {
              echo 'Email sent. <a href="'.$url.'">KEMBALI</a>';
            }
            else
            {
              show_error($this->email->print_debugger());
            }
            
    }

    function UserNameOp(){
            $nm_tabel='msuser';
            $nm_coloum= array('Id','FullName');
            $orderby= array('FullName' => 'asc');
            $where=  array();
            $list = $this->Mdata->get_datadetail($nm_tabel,$nm_coloum,$orderby,$where);
            
    		$data = array();
    		$no = 0;
                $row = array(
                'id'    => ' ',
                'name'  => '...',
                'isi'   => ''
                );
    			$data[] = $row;
    		foreach ($list as $rec){
    			$no++;
    			$row = array(
                'id' => $rec->Id,
                'name' => $rec->FullName,
                'isi' => ''
                );
    			$data[] = $row;
    		}
    		$output = array(
    						"data" => $data,
    				);
    		//output to json format
    		echo json_encode($data);
    }
    
    function shipmentUser(){
        $statustracking = $this->uri->segment(7);
        $type_clearance = $this->uri->segment(5);
        $pmk_182        = $this->uri->segment(6);
        $hawb           = $this->uri->segment(4);
        $id_alpha       = substr($hawb, -1);
        echo '';
          $data = array();  
             $c1 = 1;
             $q=$this->db->query("
                SELECT b.FullName,b.Photo,f.GroupName,d.nm_team FROM smart_role a 
                INNER JOIN msuser b ON a.GroupId=b.IdGroupUsr 
                INNER JOIN team_user c ON b.Id=c.id_user
                INNER JOIN team d ON c.id_team=d.Id_team
                INNER JOIN team_digit e ON d.Id_team=e.Id_team
                INNER JOIN msgroup_usr f ON b.IdGroupUsr=f.Id WHERE 
                a.Code1='$statustracking' AND (d.type_clearance='$type_clearance' OR d.pmk_182='$pmk_182') AND e.id_alpha = '$id_alpha'
                GROUP BY b.Id
                ");
             foreach ($q->result() as $rec)
             {                            
                $row = array(
                'no' => $c1,
                'FullName' => $rec->FullName,
                'Photo' => $rec->Photo,
                'GroupName' => $rec->GroupName,
                'nm_team' => $rec->nm_team,
                );
    			$data[] = $row;
                
                $photo=($rec->Photo=='')?'user.png':$rec->Photo;
			 echo'<li>
                   <div class="md-list-addon-element">
				   <span class="nomor" style="display:none">'.$c1.'.</span>
                    <img class="md-user-image md-list-addon-avatar" src="'.base_url().'asset/images/user/'.$photo.'"/>
                     </div>
                    <div class="md-list-content">
                       <span class="md-list-heading">'.$rec->FullName.'<sup> ( '.$rec->GroupName.' )</sup></span>
                      <span class="uk-text-small uk-text-muted"> Team : '.$rec->nm_team.'</span>
                     </div>
                  </li>';
             
             $c1++;
             }
       //echo json_encode($data);
    }
    
    function myroll(){
                ini_set('max_execution_time', 300);
                $q=$this->db->query("SELECT Hawb FROM dstatusproses WHERE IdStatusProses = '68'");
                    foreach ($q->result() as $row)
                    {
                        $hawb =$row->Hawb;
                        $q=$this->db->query("SELECT DateUpdate,IdStatusProses,Note  FROM dstatusproses WHERE Hawb ='$hawb' ORDER BY DateUpdate DESC ,Id DESC LIMIT 0,1");
                        foreach ($q->result() as $row)
                        {
                            $nmtabel_='t_shipment_cloud';
                            $key_='hawb';
                  	        $data_ = array(
                                        'TrackingStatus' => $row->IdStatusProses,
                                        'TrackingDate' => $row->DateUpdate,
                                        'TrackingRemark' => $row->Note,
                        			);
                        	$this->Mdata->update(array($key_ => $hawb), $data_,$nmtabel_);
                        } 
                    } 
                
    }
    
    function rolltypeclearance(){
       ini_set('max_execution_time', 300);
                    $c1 = 1 ;
                    $q=$this->db->query("SELECT Hawb FROM dtypeclearance WHERE UserName <> 'Triyas' AND IdTypeClearance = '1'");
                    foreach ($q->result() as $row)
                    {
                        $hawb =$row->Hawb;
                        $q=$this->db->query("UPDATE t_shipment_cloud SET Id_aju='2' WHERE Hawb='$hawb'");
                        $c1++;
                    }
                    echo 'PIBK='.$c1;
                    
                    $c2 = 1 ;
                    $q=$this->db->query("SELECT Hawb FROM dtypeclearance WHERE UserName <> 'Triyas' AND IdTypeClearance = '2'");
                    foreach ($q->result() as $row)
                    {
                        $hawb =$row->Hawb;
                        $q=$this->db->query("UPDATE t_shipment_cloud SET Id_aju='4' WHERE Hawb='$hawb'");
                        $c2++;
                    }
                    echo 'PIB='.$c2;  
    }
    
    
    function Inserttypeclearance(){
       ini_set('max_execution_time', 300);
                    $c1 = 0 ;
                    $q=$this->db->query("SELECT * FROM t_shipment_cloud a LEFT JOIN  bc_m_jns_aju b ON a.Id_aju=b.Id_aju WHERE a.Id_aju IS NOT NULL");
                    foreach ($q->result() as $row)
                    {                            
                            $myid='Import'.sprintf("%05s",$c1);
                            
                            $nmtabel='dtypeclearance';
                    		$data = array(
                                    'Id' => $myid,
                                    'Hawb' => $row->hawb,
                                    'DateUpdate' => $row->flight_date,
                                    'IdTypeClearance' => $row->Id_aju,
                                    'TypeClearance' => $row->UR_JNS.' - '.$row->ket,
                                    'Note' => $row->ket,
                                    'IdImport' => 'Import',
                                    'IdUser' => 'Import',
                                    'UserName' => 'Import',
                                    'ModifDate' => date('Y-m-d H:i:s')
                    			);
                    		$insert = $this->Mdata->save($data,$nmtabel);
                        $c1++;
                    }
                    echo 'PIBK='.$c1;
    }
    
    
}