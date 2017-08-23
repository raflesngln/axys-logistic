<?php
class Ticket extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('login/Model_db_users');
        $this->load->model('cas/Mdata');
/*        $this->load->library('Sesi_login');
		if($this->sesi_login->log_session() !=TRUE){
			redirect('login/login');
			return false;
		}*/
    }
function load_ticket(){
	$v_Hawb=$this->input->post('v_Hawb');
      $result=$this->Model_db_users->getCustom('a.*,b.FullName,c.name as status',"ticket_full_hdr a",
	  			"LEFT JOIN msuser b ON a.assignTo=b.Id
				 LEFT JOIN ticket_status c ON a.status_id=c.id
				  WHERE a.object_id='$v_Hawb' ORDER BY a.ticket_id");
	foreach($result as $list){
		$row = array(
				'ticket_id' =>$list->ticket_id,
				'object_id' =>$list->object_id,
				'subject' =>$list->subject,
				'complain_date' =>$list->complain_date,
				'complain_name' =>$list->complain_name,
				'FullName' =>$list->FullName,
				'remarks' =>$list->remarks,
				'created_date' =>$list->created_date,
				'status_id' =>$list->status_id,
				'created_date' =>$list->created_date,
				'status' =>$list->status,
				'idsesi' =>$this->session->userdata('cs_Idusr'),
				'assignTo' =>$list->assignTo,
			);
			$data[] = $row;
		} 
		echo json_encode($data);
	}
function load_ticket_detail(){
	$idticket=$this->input->post('idticket');
	
      $result=$this->Model_db_users->getCustom('a.*,b.object_id,b.ticket_id,b.complain_name,b.subject,c.FullName as user_detail,d.FullName as user_assign',"ticket_detail a",
	  			"INNER JOIN ticket_full_hdr b ON a.ticket_id=b.ticket_id
				LEFT JOIN msuser c ON a.user_id=c.Id
				LEFT JOIN msuser d ON b.assignTo=d.Id
				WHERE a.ticket_id='$idticket' ORDER BY a.Id");
	foreach($result as $list){
		$row = array(
				'Id' =>$list->Id,
				'ticket_id' =>$list->ticket_id,
				'object_id' =>$list->object_id,
				'subject' =>$list->subject,
				'complain_name' =>$list->complain_name,
				'FullName' =>$list->user_detail,
				'user_detail' =>$list->user_detail,
				'user_assign' =>$list->user_assign,
				'comment' =>$list->comment,
				'subject_detail' =>$list->subject_detail,
				'comment_date' =>$list->comment_date,
			);
			$data[] = $row;
		} 
		echo json_encode($data);
	}
function load_status_ticket(){
	$v_Hawb=$this->input->post('v_Hawb');
      $result=$this->Model_db_users->getCustom('*',"ticket_status a",
	  			"");
	foreach($result as $list){
		$row = array(
				'id' =>$list->id,
				'name' =>$list->name,
			);
			$data[] = $row;
		} 
		echo json_encode($data);
}	
function load_tabs_list(){
	$idusr=$this->session->userdata('cs_Idusr');
      $result=$this->Model_db_users->getCustom('a.*,b.tab_title,b.action',"tab_role a",
	  			"INNER JOIN tab_list b ON a.tab_id=b.tab_id
				 INNER JOIN msgroup_usr c ON a.id_group=c.Id
				 WHERE a.id_group='2'");
	foreach($result as $list){
		$row = array(
				'tab_id' =>$list->tab_id,
				'id_group' =>$list->id_group,
				'tab_title' =>$list->tab_title,
				'action' =>$list->action,
			);
			$data[] = $row;
		} 
		echo json_encode($data);
}	
function load_header_detail(){
	$id=$this->input->post('id');
      $result=$this->Model_db_users->getCustom('*',"ticket_full_hdr a",
	  			"WHERE a.ticket_id='$id'");
	foreach($result as $list){
		$row = array(
				'subject' =>$list->subject,
				'remarks' =>$list->remarks,
			);
			$data[] = $row;
		} 
		echo json_encode($data);
}	
 public function save_ticket()
	{   
		$subject=$this->input->post('subject');
		$remarks=$this->input->post('remarks');
		$data = array(
			'object_id'=>$this->input->post('id_v_Hawb'),
			'subject'=>$this->input->post('subject'),
			'remarks'=>$this->input->post('remarks'),
			'assignTo'=>$this->session->userdata('cs_Idusr'),
			'created_date'=>date('Y-m-d H:i:s'),
			'remarks'=>$this->input->post('remarks'),
			'complain_date'=>date('Y-m-d H:i:s'),
			'status_id'=>'1',
			'complain_name'=>$this->input->post('complain_name'),
			'phone2'=>$this->input->post('phone2'),
			'email'=>$this->input->post('email'),
 
			);
		$insert = $this->Model_db_users->save('ticket_full_hdr',$data);
		echo json_encode(array("status" => TRUE));
		
}
 public function save_comment()
	{   
		$idticket=isset($_POST['id_hidden_ticket2'])?$_POST['id_hidden_ticket2']:false;
		//for picture
		$folder='./asset/ticket/';
		$tmp  = isset($_FILES['comment_attachment']['tmp_name'])?$_FILES['comment_attachment']['tmp_name']:false;
		$gbr=isset($_FILES['comment_attachment']['name'])?$_FILES['comment_attachment']['name']:false;
		$data = array(
			'ticket_id'=>isset($_POST['id_hidden_ticket2'])?$_POST['id_hidden_ticket2']:false,
			'user_id'=>$this->session->userdata('cs_Idusr'),
			'comment'=>isset($_POST['comment_remarks'])?$_POST['comment_remarks']:false,
			'subject_detail'=>isset($_POST['comment_subject'])?$_POST['comment_subject']:false,   
			'comment_date'=>date('Y-m-d'),
			'attachment'=>$gbr, 
			);
		$insert = $this->Model_db_users->save('ticket_detail',$data);
		move_uploaded_file($tmp,$folder.$gbr);		
		$ubah = array(
			'status_id'=>isset($_POST['status_id'])?$_POST['status_id']:false,
			);
		$update = $this->Model_db_users->update('ticket_full_hdr','ticket_id',$idticket,$ubah);
		echo json_encode(array("status" => TRUE));
		
/*		$pic=isset($_POST['pic']);
		if($pic !=''){
		   $pic2=$_POST['pic'];
		   foreach($pic2 as $key => $val){
		  $data2=array(
		  'IdVenHdr' =>$idvendor,
		  'PIC' =>isset($_POST['pic'][$key])?$_POST['pic'][$key]:false,
		  'Email' =>isset($_POST['email'][$key])?$_POST['email'][$key]:false,
		  'HP01' =>isset($_POST['hp01'][$key])?$_POST['hp01'][$key]:false,
		  'HP02' =>isset($_POST['hp02'][$key])?$_POST['hp02'][$key]:false,
		  );
		  $this->Model_db_users->save('msvendor_dtl',$data2);   
			}
		}*/


}
public function delete_ticket(){
		$idticket=$this->input->post('idticket');
		$deletedata=$this->Model_db_users->delete_data('ticket_full_hdr','ticket_id',$idticket);
		$det=$this->Model_db_users->delete_data('ticket_detail','ticket_id',$idticket);
		echo json_encode(array("status" => TRUE));

}


 public function count_notif2(){
	  $idgrup=$this->session->userdata('cs_Idgroup_usr');
      $result=$this->Model_db_users->getCustom('a.*,c.complain_name',"ticket_detail a",
	  			"INNER JOIN msgroup_usr b ON a.idGroup=b.Id
				 INNER JOIN ticket_full_hdr c ON a.ticket_id=c.ticket_id
				 WHERE a.isActive='0' AND a.idGroup=$idgrup");
	foreach($result as $list){
		$row = array(
				'Id' =>$list->Id,
				'ticket_id' =>$list->ticket_id,
				'subject_detail' =>$list->subject_detail,
				'complain_name' =>$list->complain_name,
				'comment' =>substr($list->comment,0,60),
			);
			echo '<li>
			     <span>'.$list->complain_name.'</span>
				 <p>'.$list->comment.'</p>
			   </li>';
		}
        
}
function load_data_notif(){
	  $idgrup=$this->session->userdata('cs_Idgroup_usr');
      $result=$this->Model_db_users->getCustom('a.*,c.complain_name',"ticket_detail a",
	  			"INNER JOIN msgroup_usr b ON a.idGroup=b.Id
				 INNER JOIN ticket_full_hdr c ON a.ticket_id=c.ticket_id
				 WHERE a.isActive='0' AND a.idGroup=$idgrup");
	foreach($result as $list){
		$row = array(
				'Id' =>$list->Id,
				'ticket_id' =>$list->ticket_id,
				'subject_detail' =>$list->subject_detail,
				'complain_name' =>$list->complain_name,
				'comment' =>substr($list->comment,0,60),
			);
			$data[] = $row;
		} 
		echo json_encode($data);
}

function load_data_job(){
        $tlc    =$this->Mdata->gen_tlc();
        $digit  =$this->Mdata->gen_digit();
        $type   =$this->Mdata->gen_type();
        $pmk182 =$this->Mdata->gen_pmk182();
        $usr = $this->session->userdata('cs_Idusr');

        $data = array();
        $no = 0;
        
        $query=$this->db->query("
        SELECT hawb,flight_date FROM t_shipment_cloud WHERE 
        RIGHT(hawb,1) IN $digit AND TrackingStatus IN $tlc AND (Id_aju IN $pmk182)
        order by flight_date ");
        
        foreach($query->result() as $t){
            $no=$no+1;
                $row = array(
                'no' =>$no,
				'Id' =>$t->hawb,
				'ticket_id' =>$t->hawb,
				'subject_detail' =>$t->hawb,
				'complain_name' =>$t->hawb,
				'comment' =>$t->flight_date,
                'getlink' =>'ManifestList_job'
			);
			$data[] = $row;
        }
        
        $query=$this->db->query("
        SELECT b.hawb,b.flight_date FROM assign_hawb a INNER JOIN t_shipment_cloud b 
        ON a.Hawb=b.hawb WHERE b.TrackingStatus IN $tlc AND a.id_user ='$usr'");
        
        foreach($query->result() as $t){
            $no=$no+1;
                $row = array(
                'no' =>$no,
				'Id' =>$t->hawb,
				'ticket_id' =>$t->hawb,
				'subject_detail' =>$t->hawb,
				'complain_name' =>$t->hawb,
				'comment' =>$t->flight_date,
                'getlink' =>'ManifestList_job_assign'
			);
			$data[] = $row;
        }
		echo json_encode($data);
    }
    
     public function count_notif(){
        
        $tlc    =$this->Mdata->gen_tlc();
        $digit  =$this->Mdata->gen_digit();
        $type   =$this->Mdata->gen_type();
        $pmk182 =$this->Mdata->gen_pmk182();
        $usr = $this->session->userdata('cs_Idusr');
        
        $jum = 0;
        $q2 = "";
        $query=$this->db->query("SELECT COUNT(*) AS jml_tot FROM t_shipment_cloud WHERE 
        RIGHT(hawb,1) IN $digit AND TrackingStatus IN $tlc AND (Id_aju IN $pmk182)
        ");
        foreach($query->result() as $t){
                $jum=$t->jml_tot;
        }
        
        $jum_ = 0;
        $q2_ = "";  
        $query_=$this->db->query("SELECT Count(*) AS jml_tot FROM assign_hawb a INNER JOIN t_shipment_cloud b 
        ON a.Hawb=b.hawb WHERE b.TrackingStatus IN $tlc AND a.id_user ='$usr'
        ");
        foreach($query_->result() as $t_){
                $jum_=$t_->jml_tot;
        }
        
        $jumtot = $jum + $jum_;
        if( $jumtot >=1){
			$result=$jumtot;
		} else {
			$result='';
		}
        
        echo $result;

    }
    
function kill_(){
//        $query=$this->db->query("SHOW FULL PROCESSLIST");
//        foreach($query->result() as $t){
//			$myid       =	$t->Id;
//            $mydb       =	$t->db;
//            $mycommand  =	$t->Command;
//            if($mycommand=='Sleep' && $mydb=='Cas_CRM_DB'){
//                $query=$this->db->query("KILL $myid");
//            }
//        }
    }
    	  
}


