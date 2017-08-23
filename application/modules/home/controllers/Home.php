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
	'title'=>'Xsys Logistic'
	);
      $this->load->view('home/index',$data);
 }

  function download_xl_report(){
	  $tanggal=$this->input->post('tgl1');
	  $kategori=$this->input->post('kategori');
	  $tabel=$this->input->post('tabel');
	  $mawb=$this->input->post('mawb');
	  $txtsearch=$this->input->post('txtsearch');
	  
	  if($kategori=='release'){
		  $this->release_excel($tanggal,$tabel);
	  } else {
		  $this->non_release_excel($tanggal,$tabel,$mawb,$txtsearch);
	  }
		
}
 


    
}


