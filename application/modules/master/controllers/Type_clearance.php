<?php
class Type_clearance extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('master/M_master');
		$this->load->model('user/Model_user');
		$this->load->library('Sesi_login');
		if($this->sesi_login->log_session() !=TRUE){
			redirect('login/Login');
		}
    }

    function index(){
       	  $data=array(
		  'title'=>'Status Proses',
		  'scrumb'=>'<a href="'.base_url().'master/Type_clearance" class="breadcrumb">3 Letter Code</a>3 Letter Code(status)',
		  'all'=>$this->M_master->getCustom('*',"tm_typeclearance a",
	  			""),
		  'aktif'=>$this->M_master->getCustom('c.noid,c.Keterangan,a.user_id,b.Username',"role_typeclearance a",
	  			"INNER JOIN msuser b ON a.user_id=b.Id
				 INNER JOIN tm_typeclearance c ON a.id_typeclearance=c.noid
				 WHERE a.user_id='0' GROUP BY b.Id"),
		  'content'=>'master/type_clearance/page'
		  );
	      $this->load->view('template/template',$data);
		  
	}
 function listdata()
	{
		//$idsession=$this->session->userdata('idusr');
		$nm_tabel='tm_typeclearance a';
		$nm_tabel2='msgroup_usr b';
		$kolom1='a.CreatedBy';
		$kolom2='b.Id';
		
		$selected='a.*';
		//$selected='a.*,b.Id as id_customer,b.Status as status_app,b.Name as nm_customer,c.name as ori_country,d.Name as ori_city,e.Name as ori_port,f.name as dest_country,g.Name as dest_city,h.Name as dest_port';
        $nm_coloum= array('a.noid,a.Keterangan','a.Keterangan','a.void','a.void');
        $orderby= array('a.noid' => 'ASC');
		$where=  array('void'=>'0');
        $list = $this->M_master->get_datatables2($selected,$nm_tabel,$nm_coloum,$orderby,$where,$nm_tabel2,$kolom1,$kolom2);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $datalist){
			$no++;
			$row = array(
            'no' => $no,
			'noid' =>$datalist->noid,
            'Keterangan' =>$datalist->Keterangan,
			'TypeClearance' =>$datalist->TypeClearance,
			'void' =>$datalist->void,
			'action' =>'<div class="uk-button-dropdown" data-uk-dropdown>
                                <button class="md-btn"><i class="material-icons">build</i> <i class="material-icons">&#xE313;</i></button>
                                <div class="uk-dropdown uk-dropdown-small">
                                    <ul class="uk-nav uk-nav-dropdown">
                                        <li><a href="#" onclick="edit_data('.$datalist->noid.')"><i class="material-icons">edit</i> Edit</a></li>
                                        <li><a href="#" onclick="nonactive_status('.$datalist->noid.')"><i class="material-icons md-color-red-A700">refresh</i> Non Active</a></li>
                                    </ul>
                                </div>
                            </div>',

            );
			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->M_master->count_all2($nm_tabel,$nm_coloum,$nm_tabel2,$kolom1,$kolom2),
						"recordsFiltered" => $this->M_master->count_filtered2($nm_tabel,$nm_coloum,$orderby,$where,$nm_tabel2,$kolom1,$kolom2),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
}



public function save_type()
	{   
	$id_max=$this->Model_user->getMaxId("tm_typeclearance","noid");
	
		$data = array(
			'noid'=>$id_max+1,
			'Keterangan'=>$this->input->post('Keterangan'),
			'TypeClearance'=>'0',
			'void'=>'0',
			'CreatedBy'=>$this->session->userdata('cs_Idusr'),
			'CreatedDate'=>date('Y-m-d'),
			);
		$insert = $this->M_master->save('tm_typeclearance',$data);
		echo json_encode(array("status" => TRUE));
		
}
function load_edit_data(){
	  $id=$this->input->post('id');
      $result=$this->M_master->getCustom('*',"tm_typeclearance a",
	  			"WHERE a.noid='$id' LIMIT 1");
	foreach($result as $list){
		$row = array(
				'noid' =>$list->noid,
				'Keterangan' =>$list->Keterangan,
			);
			$data[] = $row;
		} 
		echo json_encode($data);
}

public function update_type()
	    {
			$id=$this->input->post('idclearance');
		$ubah = array(
			'Keterangan'=>$this->input->post('Keterangan'),
			);
		$update = $this->M_master->update('tm_typeclearance','noid',$id,$ubah);
		echo json_encode(array("status" => TRUE));
	 }
public function nonactive_status(){
		$id=$this->input->post('id');
		$ubah = array(
			'void'=>'1',
			);
		$update = $this->M_master->update('tm_typeclearance','noid',$id,$ubah);
		echo json_encode(array("status" => TRUE));
}

function load_role_group(){
	$idgrup=$this->input->post('idgrup');
       	  $data=array(	  
		  'all'=>$this->M_master->getCustom('a.noid,a.Keterangan,a.TypeClearance',"tm_typeclearance a",
	  			""),
		  'aktif'=>$this->M_master->getCustom('a.Id,b.noid,a.user_id,b.Keterangan',"role_typeclearance a",
	  			"INNER JOIN tm_typeclearance b ON a.id_typeclearance=b.noid 
				 WHERE a.user_id='$idgrup' AND a.isActive='1' GROUP BY a.Id"),
		  'idgrup'=>$idgrup,
		  'grup'=>$this->M_master->getCustom('Id,GroupName',"msgroup_usr",
	  			"WHERE Id='$idgrup'"),
		  );
	      $this->load->view('master/type_clearance/role_content',$data);
}
public function add_role(){   
	$idusr=$this->input->post('idgrup');
	$idno=$this->input->post('idno');
		$cari=$this->M_master->getCustom('*',"role_typeclearance",
	  			"WHERE user_id='$idusr' AND id_typeclearance='$idno'");
		if($cari){
			foreach($cari as $row){
				$id=$row->Id;
			}
			$idrole=$row->Id;
			$ubah = array('isActive'=>'1');
				$update = $this->M_master->update('role_typeclearance','Id',$idrole,$ubah);
				echo json_encode(array("status" => TRUE));
		} else {
		$data = array(
			'user_id'=>$idusr,
			'id_typeclearance '=>$idno,
			'Desc '=>'',
			'isActive'=>'1',
			);
			$insert = $this->M_master->save('role_typeclearance',$data);
			echo json_encode(array("status" => TRUE));
	}
}	
public function remove_role(){   
		$idusr=$this->input->post('idgrup');
		$idno=$this->input->post('idno');
		$cari=$this->M_master->getCustom('*',"role_typeclearance",
	  			"WHERE user_id='$idusr' AND id_typeclearance='$idno'");
			foreach($cari as $row){
				 $list=array('id'=>$row->Id);
				}
				$id=$row->Id;
		$ubah = array('isActive'=>'0');
		$update = $this->M_master->update('role_typeclearance','Id',$id,$ubah);
		//$deletedata=$this->M_master->delete_data('role_typeclearance','Id',$id);
		echo json_encode(array("status" => TRUE));
}		
function load_group_list(){
      $result=$this->Model_user->getCustom('Id,Username,FullName',"msuser",
      		  "");
		foreach($result as $list){
		$row = array(
				'Id' =>$list->Id,
				'Username' =>$list->Username,
				'FullName' =>$list->FullName,
			);
			$data[] = $row;
		} 
		echo json_encode($data);
}
function load_combo_typeclearance(){
      $result=$this->Model_user->getCustom('*',"tm_typeclearance",
      		  "");
		foreach($result as $list){
		$row = array(
				'noid' =>$list->noid,
				'Keterangan' =>$list->Keterangan,
			);
			$data[] = $row;
		} 
		echo json_encode($data);
}
function load_combo_typeclearance2(){
      $result=$this->Model_user->getCustom('*',"bc_m_jns_aju",
      		  "");
		foreach($result as $list){
		$row = array(
				'noid' =>$list->id_aju,
				'Keterangan' =>$list->UR_JNS,
			);
			$data[] = $row;
		} 
		echo json_encode($data);
}
 

}


