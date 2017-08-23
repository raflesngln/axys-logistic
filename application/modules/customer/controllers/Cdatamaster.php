<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cdatamaster extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('front/Mdata');
 		$this->load->library('Sesi_login');
		if($this->sesi_login->log_session() !=TRUE){
			redirect('login/Login');
		}
	}
    
	public function index()
	{  
        $data['judul']='okkeee';
        $data['keterangan']='';
        $this->template->set('title', 'Tess');
	    $this->template->load('template', 'person',$data);
		//$this->load->view('person_view');
	}
    
    public function remove(){
        
        $nmtabel=$this->input->post('cnmtabel');
        $key=$this->input->post('ckeytabel');
		$data = array(
				'isRemove' => 1,
			);
		$this->Mdata->update(array($key => $this->input->post('cid')), $data,$nmtabel);
		echo json_encode(array("status" => TRUE));
        
    }
    
    public function get()
	{
        $nmtabel= $this->input->post('cnmtabel');
		$data = $this->Mdata->get($nmtabel);
		echo json_encode($data);
	}
    
	public function get_edit()
	{
	   	$id     = $this->input->post('cid');
        $nmtabel= $this->input->post('cnmtabel');
        $key    = $this->input->post('ckeytabel');
		$data = $this->Mdata->get_by_id($id,$nmtabel,$key);
		echo json_encode($data);
	}
    
    public function get_edit_join(){
        $id     = $this->input->post('cid');
        $nmtabel= $this->input->post('cnmtabel');
        $nmtabel1= $this->input->post('cnmtabel1');
        $on= $this->input->post('con');
        $key    = $this->input->post('ckeytabel');
		$data = $this->Mdata->get_by_id_join($id,$nmtabel,$nmtabel1,$on,$key);
		echo json_encode($data);
    }
    
    public function get_edit_join1(){
        $id     = $this->input->post('cid');
        $nmtabel= $this->input->post('cnmtabel');
        $nmtabel1= $this->input->post('cnmtabel1');
        $on= $this->input->post('con');
        $join1 = $this->input->post('join1');
        $nmtabel2= $this->input->post('cnmtabel2');
        $on2= $this->input->post('con2');
        $join2 = $this->input->post('join2');
        $key    = $this->input->post('ckeytabel');
		$data = $this->Mdata->get_by_id_join1($id,$nmtabel,$nmtabel1,$on,$nmtabel2,$on2,$key,$join1,$join2);
		echo json_encode($data);
    }
    
    public function get_edit_join2(){
        $id     = $this->input->post('cid');
        $nmtabel= $this->input->post('cnmtabel');
        $nmtabel1= $this->input->post('cnmtabel1');
        $on= $this->input->post('con');
        $nmtabel2= $this->input->post('cnmtabel2');
        $on2= $this->input->post('con2');
        $nmtabel3= $this->input->post('cnmtabel3');
        $on3= $this->input->post('con3');
        $key    = $this->input->post('ckeytabel');
      
		$data = $this->Mdata->get_by_id_join2($id,$nmtabel,$nmtabel1,$on,$nmtabel2,$on2,$nmtabel3,$on3,$key);
		echo json_encode($data);
    }
    
    public function get_edit_join3(){
        $id     = $this->input->post('cid');
        $nmtabel= $this->input->post('cnmtabel');
        $nmtabel1= $this->input->post('cnmtabel1');
        $on= $this->input->post('con');
        $nmtabel2= $this->input->post('cnmtabel2');
        $on2= $this->input->post('con2');
        $nmtabel3= $this->input->post('cnmtabel3');
        $on3= $this->input->post('con3');
        $nmtabel4= $this->input->post('cnmtabel4');
        $on4= $this->input->post('con4');
        $key= $this->input->post('ckeytabel');
      
		$data = $this->Mdata->get_by_id_join3($id,$nmtabel,$nmtabel1,$on,$nmtabel2,$on2,$nmtabel3,$on3,$nmtabel4,$on4,$key);
		echo json_encode($data);
    }
    
    public function get_edit_join4(){
        $id     = $this->input->post('cid');
        $nmtabel= $this->input->post('cnmtabel');
        $nmtabel1= $this->input->post('cnmtabel1');
        $on= $this->input->post('con');
        $nmtabel2= $this->input->post('cnmtabel2');
        $on2= $this->input->post('con2');
        $nmtabel3= $this->input->post('cnmtabel3');
        $on3= $this->input->post('con3');
        $nmtabel4= $this->input->post('cnmtabel4');
        $on4= $this->input->post('con4');
        $nmtabel5= $this->input->post('cnmtabel5');
        $on5= $this->input->post('con5');
        $key= $this->input->post('ckeytabel');
      
		$data = $this->Mdata->get_by_id_join4($id,$nmtabel,$nmtabel1,$on,$nmtabel2,$on2,$nmtabel3,$on3,$nmtabel4,$on4,$nmtabel5,$on5,$key);
		echo json_encode($data);
    }    
}
