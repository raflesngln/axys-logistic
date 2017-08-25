<?php
class Home extends CI_Controller{
    function __construct(){
        parent::__construct();
/*        $this->load->model('front/Mdata');
        $this->load->model('cas/Model_gtln');
		$this->load->model('cas/Model_pdf');
        $this->load->library('Sesi_login');
		if($this->sesi_login->log_session() !=TRUE){
			redirect('login/login');
			return false;
		}*/
        date_default_timezone_set('Asia/Jakarta');
    }
    
  function index(){
	$data=array(
	'title'=>'Xsys Logistic',
	'content'=>'home/content-body'
	);
      $this->load->view('home/index',$data);
 }

  function search_rate(){
	
	$origin=$this->input->post('origin');
	$destination=$this->input->post('destination');
	$service_type=$this->input->post('service_type');
	
	$data=array(
		'title'=>'Search Result',
		'subtitle'=>$origin.' - '.$destination,
		'service_type'=>$service_type,
	);
	
	$this->load->view('home/result_search',$data);
	return true;
		
}
 


    
}


