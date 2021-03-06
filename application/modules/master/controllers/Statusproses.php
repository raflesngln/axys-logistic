<?php
class M_status_proses extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('cas/Model_statusproses');
		$this->load->library('Sesi_login');
		if($this->sesi_login->log_session() !=TRUE){
			redirect('login/Login');
		}
    }
	

    function list_status(){
       	  $data=array(
		  'title'=>'Status Proses',
		  'scrumb'=>'<a href="'.base_url().'cas/Statusproses" class="breadcrumb">3 Letter Code</a>3 Letter Code(status)',
		  'content'=>'cas/statusproses/page'
		  );
	      $this->load->view('template/template',$data);
		  
	}
 function listdata()
	{
		//$idsession=$this->session->userdata('idusr');
		$nm_tabel='statusproses a';
		$nm_tabel2='msgroup_usr b';
		$kolom1='a.IdFolingData';
		$kolom2='b.Id';
		
		$selected='a.*';
		//$selected='a.*,b.Id as id_customer,b.Status as status_app,b.Name as nm_customer,c.name as ori_country,d.Name as ori_city,e.Name as ori_port,f.name as dest_country,g.Name as dest_city,h.Name as dest_port';
        $nm_coloum= array('a.Noid,a.CodeStatus','a.Keterangan','a.IdFolingData','a.FolingData');
        $orderby= array('a.Noid' => 'ASC');
		$where=  array('a.isActive' => '1');
        $list = $this->Model_statusproses->get_datatables2($selected,$nm_tabel,$nm_coloum,$orderby,$where,$nm_tabel2,$kolom1,$kolom2);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $datalist){
			$no++;
			$row = array(
            'no' => $no,
			'Noid' =>$datalist->Noid,
            'CodeStatus' =>$datalist->CodeStatus,
			'Keterangan' =>$datalist->Keterangan,
			'IdFolingData' =>$datalist->IdFolingData,
			'FolingData' =>$datalist->FolingData,
			'action' =>'<div class="uk-button-dropdown" data-uk-dropdown>
                                <button class="md-btn"><i class="material-icons">build</i> <i class="material-icons">&#xE313;</i></button>
                                <div class="uk-dropdown uk-dropdown-small">
                                    <ul class="uk-nav uk-nav-dropdown">
                                        <li><a href="#" onclick="edit_data('.$datalist->Noid.')"><i class="material-icons">edit</i> Edit</a></li>
                                        <li><a href="#" onclick="nonactive_status('.$datalist->Noid.')"><i class="material-icons md-color-red-A700">refresh</i> Non Active</a></li>
                                    </ul>
                                </div>
                            </div>',

            );
			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Model_statusproses->count_all2($nm_tabel,$nm_coloum,$nm_tabel2,$kolom1,$kolom2),
						"recordsFiltered" => $this->Model_statusproses->count_filtered2($nm_tabel,$nm_coloum,$orderby,$where,$nm_tabel2,$kolom1,$kolom2),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
}



public function save_status()
	{   
		$data = array(
			'CodeStatus'=>$this->input->post('CodeStatus'),
			'Keterangan'=>$this->input->post('remarks'),
			'IdFolingData'=>$this->input->post('IdFolingData'),
			'FolingData'=>$this->input->post('FolingData'),
			);
		$insert = $this->Model_statusproses->save('statusproses',$data);
		echo json_encode(array("status" => TRUE));
		
}
function load_edit_data(){
	  $id=$this->input->post('id');
      $result=$this->Model_statusproses->getCustom('*',"statusproses a",
	  			"WHERE a.Noid='$id' LIMIT 1");
	foreach($result as $list){
		$row = array(
				'Noid' =>$list->Noid,
				'CodeStatus' =>$list->CodeStatus,
				'Keterangan' =>$list->Keterangan,
				'IdFolingData' =>$list->IdFolingData,
				'FolingData' =>$list->FolingData,
			);
			$data[] = $row;
		} 
		echo json_encode($data);
}

public function update_status()
	    {
			$id=$this->input->post('idstatus');
		$ubah = array(
			'Keterangan'=>$this->input->post('remarks'),
			'IdFolingData'=>$this->input->post('IdFolingData'),
			'FolingData'=>$this->input->post('FolingData'),
			);
		$update = $this->Model_statusproses->update('statusproses','Noid',$id,$ubah);
		echo json_encode(array("status" => TRUE));
	 }
public function nonactive_status(){
		$id=$this->input->post('id');
		$ubah = array(
			'isActive'=>'0',
			);
		$update = $this->Model_statusproses->update('statusproses','Noid',$id,$ubah);
		echo json_encode(array("status" => TRUE));

}

	 

}


