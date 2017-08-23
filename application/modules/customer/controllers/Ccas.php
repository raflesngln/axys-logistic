<?php
class Ccas extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('front/Mdata');
        $this->load->library('Sesi_login');
		if($this->sesi_login->log_session() !=TRUE){
			redirect('login/login');
			return false;
		}
        date_default_timezone_set('Asia/Jakarta');
    }
    
    function Import_manifest(){
         $data=array(
		  'title'=>'Import Data ',
		  'modulname'=>'MANIFEST NON DOC',
          'ismenu'=>'1',
		  'menu'=>'cas/Menu/rate_menu',
		  'content'=>'cas/Cas/nondoc'
		  );
        $this->load->view('template/template',$data);
    }
    
    function Import_StatusProses(){
         $data=array(
		  'title'=>'Import Data ',
		  'modulname'=>'MANIFEST LONGTRACK',
          'ismenu'=>'1',
		  'menu'=>'cas/Menu/rate_menu',
		  'content'=>'cas/CAS/ImportStatusProses'
		  );
        $this->load->view('template/template',$data);
    }
    
    function Import_TypeClerance(){
         $data=array(
		  'title'=>'Import Data ',
		  'modulname'=>'MANIFEST LONGTRACK',
          'ismenu'=>'1',
		  'menu'=>'cas/Menu/rate_menu',
		  'content'=>'cas/CAS/ImportTypeClerance'
		  );
        $this->load->view('template/template',$data);
    }
    
    function Import_manifestlongtrack(){
         $data=array(
		  'title'=>'Import Data ',
		  'modulname'=>'MANIFEST LONGTRACK',
          'ismenu'=>'1',
		  'menu'=>'cas/Menu/rate_menu',
		  'content'=>'cas/CAS/longtrack'
		  );
        $this->load->view('template/template',$data);
    }
    
    function Import_manifestletterdoc(){
         $data=array(
		  'title'=>'Import Data ',
		  'modulname'=>'MANIFEST LETTER DOC',
          'ismenu'=>'1',
		  'menu'=>'cas/Menu/rate_menu',
		  'content'=>'cas/CAS/latterdoc'
		  );
        $this->load->view('template/template',$data);
    }
    
    function ManifestList(){
         $data=array(
		  'title'=>'Data Manifest',
		  'modulname'=>'DATA MANIFEST',
          'ismenu'=>'1',
		  'menu'=>'front/Menu/rate_menu',
		  'content'=>'cas/CAS/manifest_list',
          'quot_preview'=>'front/Portal/quotation/quop_detail',
          'discustion'=>'cas/CAS/tampung/discusstion',
          'log'=>'cas/CAS/tampung/log_activity',
          'noa'=>'cas/CAS/tampung/noa',
		  );
        $this->load->view('template/template',$data);
    }
    
    function ManifestList_view(){
         $data=array(
		  'title'=>'Data Manifest',
		  'modulname'=>'DATA MANIFEST',
          'ismenu'=>'1',
		  'menu'=>'front/Menu/rate_menu',
		  'content'=>'cas/CAS/manifest_list_Search',
          'quot_preview'=>'front/Portal/quotation/quop_detail',
          'discustion'=>'cas/CAS/tampung/discusstion',
          'log'=>'cas/CAS/tampung/log_activity',
          'noa'=>'cas/CAS/tampung/noa',
          'idhawb'=>$this->input->post('idhawb')
		  );
        $this->load->view('template/template',$data);
    }
    
    function ManifestList_job(){
         $data=array(
		  'title'=>'Data Manifest',
		  'modulname'=>'DATA MANIFEST',
          'ismenu'=>'1',
		  'menu'=>'front/Menu/rate_menu',
		  'content'=>'cas/CAS/manifest_list_job',
          'quot_preview'=>'front/Portal/quotation/quop_detail',
          'discustion'=>'cas/CAS/tampung/discusstion',
          'log'=>'cas/CAS/tampung/log_activity',
          'noa'=>'cas/CAS/tampung/noa',
          'idhawb'=>$this->input->post('idhawb')
		  );
        $this->load->view('template/template',$data);
    }

    function ManifestList_job_assign(){
         $data=array(
		  'title'=>'Data Manifest Assign',
		  'modulname'=>'DATA MANIFEST ASSIGN',
          'ismenu'=>'1',
		  'menu'=>'front/Menu/rate_menu',
		  'content'=>'cas/CAS/manifest_list_job_assign',
          'quot_preview'=>'front/Portal/quotation/quop_detail',
          'discustion'=>'cas/CAS/tampung/discusstion',
          'log'=>'cas/CAS/tampung/log_activity',
          'noa'=>'cas/CAS/tampung/noa',
          'idhawb'=>$this->input->post('idhawb')
		  );
        $this->load->view('template/template',$data);
    }
    
    function MonitoringTicket(){
         $data=array(
		  'title'=>'Monitoring Ticket',
		  'modulname'=>'MONITORING TICKET',
          'ismenu'=>'1',
		  'menu'=>'front/Menu/rate_menu',
		  'content'=>'cas/CAS/monitoring_ticket',
		  );
        $this->load->view('template/template',$data);
    }

    function MonitoringDafter(){
         $data=array(
		  'title'=>'Monitoring Dafter',
		  'modulname'=>'MONITORING DAFTER',
          'ismenu'=>'1',
		  'menu'=>'front/Menu/rate_menu',
		  'content'=>'cas/CAS/monitoring_dafter',
		  );
        $this->load->view('template/template',$data);
    }
    
   function AssignJob(){
         $data=array(
		  'title'=>'Assign Job',
		  'modulname'=>'ASSIGN JOB',
          'ismenu'=>'1',
		  'menu'=>'front/Menu/rate_menu',
		  'content'=>'cas/CAS/assign_job',
		  );
        $this->load->view('template/template',$data);
    }    
}


