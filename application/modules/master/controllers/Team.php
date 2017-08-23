<?php
class Team extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('master/M_team');
		$this->load->model('user/Model_user');
		$this->load->library('Sesi_login');
		if($this->sesi_login->log_session() !=TRUE){
			redirect('login/Login');
		}
    }

    function index(){
       	  $data=array(
		  'title'=>'Status Proses',
		  'list_team'=>$this->M_team->getCustom('a.Id_team,a.id_alpha,b.nm_team,COUNT(a.id_team) AS jml_team',"team_digit a",
	  			  "INNER JOIN team b ON a.Id_team=b.Id_team GROUP BY a.Id_team"),
		  'scrumb'=>'<a href="'.base_url().'master/team" class="breadcrumb">3 Letter Code</a>3 Letter Code(status)',
		  'content'=>'master/team/page'
		  );
	      $this->load->view('template/template',$data);
	}

 function listdata(){
		//$idsession=$this->session->userdata('idusr');
		$nm_tabel='team a';
		$nm_tabel2='tm_typeclearance b';
		$kolom1='a.type_clearance';
		$kolom2='b.noid';
		
		$selected='a.Id_team,a.nm_team,a.type_clearance,a.pmk_182,b.Keterangan,c.UR_JNS';
		//$selected='a.*,b.Id as id_customer,b.Status as status_app,b.Name as nm_customer,c.name as ori_country,d.Name as ori_city,e.Name as ori_port,f.name as dest_country,g.Name as dest_city,h.Name as dest_port';
        $nm_coloum= array('a.Id_team,a.Id_team','a.nm_team','a.nm_team','a.nm_team');
        $orderby= array('a.Id_team' => 'ASC');
		$where=  array('a.isActive'=>'1');
        $list = $this->M_team->get_datatables2($selected,$nm_tabel,$nm_coloum,$orderby,$where,$nm_tabel2,$kolom1,$kolom2);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $datalist){
			$no++;
			$row = array(
            'no' => $no,
			'Id_team' =>$datalist->Id_team,
            'nm_team' =>$datalist->nm_team,
			'Keterangan' =>$datalist->Keterangan,
			'UR_JNS' =>$datalist->UR_JNS,
			'action' =>'<div class="uk-button-dropdown" data-uk-dropdown>
                                <button class="md-btn"><i class="material-icons">build</i> <i class="material-icons">&#xE313;</i></button>
                                <div class="uk-dropdown uk-dropdown-small">
                                    <ul class="uk-nav uk-nav-dropdown">
										<li><a href="#" onclick="edit_data('.$datalist->Id_team.')"><i class="material-icons">edit</i> Edit</a></li>
                                        <li><a href="#" onclick="nonactive_team('.$datalist->Id_team.')"><i class="material-icons md-color-red-A700">refresh</i> Non Active</a></li>
                                    </ul>
                                </div>
                            </div>',

            );
			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->M_team->count_all2($nm_tabel,$nm_coloum,$nm_tabel2,$kolom1,$kolom2),
						"recordsFiltered" => $this->M_team->count_filtered2($nm_tabel,$nm_coloum,$orderby,$where,$nm_tabel2,$kolom1,$kolom2),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
}
function search_team(){
		//$idsession=$this->session->userdata('idusr');
		$inputan=$this->uri->segment(4);
		$pecah=explode("_", $inputan);
				$txt_search=$pecah[1];
				
		$nm_tabel='team a';
		$nm_tabel2='tm_typeclearance b';
		$kolom1='a.type_clearance';
		$kolom2='b.noid';
		
		$selected='a.Id_team,a.nm_team,a.type_clearance,a.pmk_182,b.Keterangan,c.UR_JNS';
		//$selected='a.*,b.Id as id_customer,b.Status as status_app,b.Name as nm_customer,c.name as ori_country,d.Name as ori_city,e.Name as ori_port,f.name as dest_country,g.Name as dest_city,h.Name as dest_port';
        $nm_coloum= array('a.Id_team,a.Id_team','a.nm_team','a.nm_team','a.nm_team');
        $orderby= array('a.Id_team' => 'ASC');
		//$where=  array('a.nm_team LIKE '=>'%'.$txt_search.'%');
		$where=  array('a.nm_team LIKE '=>'%'.$txt_search.'%');
        $list = $this->M_team->get_datatables2($selected,$nm_tabel,$nm_coloum,$orderby,$where,$nm_tabel2,$kolom1,$kolom2);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $datalist){
			$no++;
			$row = array(
            'no' => $no,
			'Id_team' =>$datalist->Id_team,
            'nm_team' =>$datalist->nm_team,
			'Keterangan' =>$datalist->Keterangan,
			'UR_JNS' =>$datalist->UR_JNS,
			'action' =>'<div class="uk-button-dropdown" data-uk-dropdown>
                                <button class="md-btn"><i class="material-icons">build</i> <i class="material-icons">&#xE313;</i></button>
                                <div class="uk-dropdown uk-dropdown-small">
                                    <ul class="uk-nav uk-nav-dropdown">
										<li><a href="#" onclick="edit_data('.$datalist->Id_team.')"><i class="material-icons">edit</i> Edit</a></li>
                                        <li><a href="#" onclick="nonactive_team('.$datalist->Id_team.')"><i class="material-icons md-color-red-A700">refresh</i> Non Active</a></li>
                                    </ul>
                                </div>
                            </div>',

            );
			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->M_team->count_all2($nm_tabel,$nm_coloum,$nm_tabel2,$kolom1,$kolom2),
						"recordsFiltered" => $this->M_team->count_filtered2($nm_tabel,$nm_coloum,$orderby,$where,$nm_tabel2,$kolom1,$kolom2),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
}
public function save_team()
	{   
	$id_max=$this->Model_user->getMaxId("team","Id_team");
		$data = array(
			//'Id_team'=>$id_max+1,
			'nm_team'=>$this->input->post('nm_team'),
			'type_clearance'=>$this->input->post('idtypeclerance'),
			'pmk_182'=>$this->input->post('idtypeclerance2'),
			'CreatedBy'=>$this->session->userdata('cs_Idusr'),
			'CreatedDate'=>date('Y-m-d'),
			);
		$insert = $this->M_team->save('team',$data);
		echo json_encode(array("status" => TRUE));
		
}
function load_edit_data(){
	  $id=$this->input->post('id');
      $result=$this->M_team->getCustom('a.*,b.Keterangan,b.noid as idtipe,c.id_aju,c.UR_JNS',"team a",
	  			"LEFT JOIN tm_typeclearance b on a.type_clearance=b.noid
				 LEFT JOIN bc_m_jns_aju c on a.pmk_182=c.id_aju
				  WHERE a.Id_team='$id' LIMIT 1");
	foreach($result as $list){
		$row = array(
				'Id_team' =>$list->Id_team,
				'nm_team' =>$list->nm_team,
				'type_clearance' =>$list->type_clearance,
				'tipeclerance_old' =>$list->idtipe.'-'.$list->Keterangan,
				'tipeclerance_new' =>$list->id_aju.'-'.$list->UR_JNS,
				'idtipe' =>$list->idtipe,
			);
			$data[] = $row;
		} 
		echo json_encode($data);
}

public function update_team()
	    {
			$id=$this->input->post('idteam');
		$ubah = array(
			'nm_team'=>$this->input->post('nm_team'),
			'type_clearance'=>$this->input->post('idtypeclerance'),
			'pmk_182'=>$this->input->post('idtypeclerance2'),
			);
		$update = $this->M_team->update('team','Id_team',$id,$ubah);
		echo json_encode(array("status" => TRUE));
	 }
public function nonactive_team(){
		$id=$this->input->post('id');
		$ubah = array(
			'isActive'=>'0',
			);
		$update = $this->M_team->update('team','Id_team',$id,$ubah);
		echo json_encode(array("status" => TRUE));

}

function load_role_group(){
	$idteam=$this->input->post('idgrup');
       	  $data=array(	  
		  'all'=>$this->M_team->getCustom('a.Id as idusr,a.Username,a.FullName,a.Phone,c.GroupName',"msuser a",
	  			"LEFT JOIN team_user b on a.Id=b.id_user
				 INNER JOIN msgroup_usr c ON a.IdGroupUsr=c.Id
				 GROUP BY a.Id ORDER BY a.FullName ASC
				 "),
		  'aktif'=>$this->M_team->getCustom('a.id_team,a.id_user,a.nm_user,c.FullName,c.Id as idusr,c.Username',"team_user a",
	  			"INNER JOIN team b ON a.id_team=b.Id_team
				  INNER JOIN msuser c ON a.id_user=c.Id
				  WHERE a.id_team='$idteam' AND a.isActive='1'
				  ORDER BY c.FullName ASC"),
		  'idgrup'=>$idteam,
		  );
	      $this->load->view('master/team/role_content',$data);
}
function load_role_abjad(){
	$idteam=$this->input->post('idgrup');
       	  $data=array(	  
		  'all2'=>$this->M_team->getCustom('a.digit',"team_alp a",
	  			""),
		  'aktif2'=>$this->M_team->getCustom('a.digit',"team_alp a",
	  			"WHERE a.digit IN (SELECT b.id_alpha FROM team_digit b WHERE b.Id_team='$idteam')"),
		  );
	      $this->load->view('master/team/role_abjad/role_content',$data);
}

public function add_role(){   
	$idteam=$this->input->post('idgrup');
	$idno=$this->input->post('idno');
		$cari=$this->M_team->getCustom('*',"team_user",
	  			"WHERE id_team='$idteam' AND id_user='$idno'");
		if($cari){
			foreach($cari as $row){
				$id=$row->Id;
			}
			$idrole=$row->Id;
			$ubah = array('isActive'=>'1');
				$update = $this->M_team->update('team_user','Id',$idrole,$ubah);
				echo json_encode(array("status" => TRUE));
		} else {
		$data = array(
			'id_team'=>$idteam,
			'id_user '=>$idno,
			'nm_user '=>$idno,
			'isActive'=>'1',
			);
			$insert = $this->M_team->save('team_user',$data);
			echo json_encode(array("status" => TRUE));
	}
}	
public function add_digit(){   
	$idteam=$this->input->post('idgrup');
	$idno=$this->input->post('idno');
		$data = array(
			'Id_team'=>$idteam,
			'id_alpha '=>$idno,
			);
			$insert = $this->M_team->save('team_digit',$data);
			echo json_encode(array("status" => TRUE));
	
}
public function remove_role(){   
		$idteam=$this->input->post('idgrup');
		$idno=$this->input->post('idno');
		$cari=$this->M_team->getCustom('*',"team_user",
	  			"WHERE id_team='$idteam' AND id_user='$idno'");
			foreach($cari as $row){
				 $list=array('id'=>$row->Id);
				}
				$id=$row->Id;
		//$ubah = array('isActive'=>'0');
		//$update = $this->M_team->update('team_user','Id',$id,$ubah);
		$deletedata=$this->M_team->delete_data('team_user','Id',$id);
		echo json_encode(array("status" => TRUE));
}	
public function remove_digit(){   
		$idno=$this->input->post('idno');

		$deletedata=$this->M_team->delete_data('team_digit','id_alpha',$idno);
		echo json_encode(array("status" => TRUE));
}		
function load_group_list(){
      $result=$this->Model_user->getCustom('*',"team",
      		  "WHERE isActive='1'");
		foreach($result as $list){
		$row = array(
				'Id_team' =>$list->Id_team,
				'nm_team' =>$list->nm_team,
			);
			$data[] = $row;
		} 
		echo json_encode($data);
}
 

}


