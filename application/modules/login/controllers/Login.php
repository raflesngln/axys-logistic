<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Login extends CI_Controller{

    //put your code here
    public function __construct() {
        parent::__construct();		
		$this->load->model('Model_db_users');
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('user/Model_user');
/*		$this->load->library('Sesi_login');
	    $cs_sesi_login=$this->session->userdata('cs_sesi_login');
		  if($cs_sesi_login != TRUE){
			redirect('login/Login/form_login');
        } else {
		   $this->load->view('login/v_login');
    }*/
}		 
  
 public function index() {
		$cap['message']=$this->session->flashdata('flashMessage');
		$this->load->view('login/v_login',$cap);
    }
	
 public function index2222() {
		$this->session->unset_userdata('captchaword');
		$options=array(
				'img_path'=>'./asset/captcha_img/',
				'img_url'=>base_url('./asset/captcha_img/'),
				'font_path'     => './asset/fonts/sanserif.otf',
					'img_width'     => '170',
					'img_height'    => 48,
					'expiration'    => 7200,
					'word_length'   => 4,
					'font_size'     => 20
				);
		$gbr=create_captcha($options);
		$this->session->set_userdata('captchaword',$gbr['word']);
		$cap['image']=$gbr['image'];
		$cap['message']=$this->session->flashdata('flashMessage');
		$this->load->view('login/v_login',$cap);
		//echo $nama=$gbr['image'];
    }



	
function cek_login() {
	$site_key = '6Lf2BC0UAAAAAHyE392Tif6AFzThAu2z2th3DDY8';
    $secret_key = '6Lf2BC0UAAAAANEmZj2zYS5Y1EsA59dlher98Trb';
        $username =$this->input->post('usr');
        $password =md5($this->input->post('psw'));
	
	 if(isset($_POST['g-recaptcha-response']))
        {
            $api_url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret_key . '&response='.$_POST['g-recaptcha-response'];
            $response = @file_get_contents($api_url);
            $data = json_decode($response, true);

            if($data['success'])
            {
				$result =$this->Model_db_users->getCustom("a.*,b.Id as idgroup,b.GroupName","msuser a",
									  "INNER JOIN msgroup_usr b on a.IdGroupUsr=b.Id
									   WHERE a.Username='$username' AND a.Password='$password' AND a.isActive='1' ORDER BY a.Id ASC LIMIT 1");
							if($result) {
								foreach($result as $row){
								//create the session
									$sess_array = array(
										'cs_Idgroup_usr' => $row->idgroup,
										'cs_Idusr' => $row->Id,
										'cs_Username' => $row->Username,
										'cs_FullName'=>$row->FullName,
										'cs_GroupName'=>$row->GroupName,
										'cs_Email'=>$row->Email,
										'cs_Photo'=>$row->Photo,
										'cs_sesi_login'=>TRUE,
									);
									$this->session->set_userdata($sess_array);
									$kodeid=$this->Model_user->getMaxId('users_online','id');
									$useronline = array(
												'id'=>$kodeid+1,
												'user_id'=>$this->session->userdata('cs_Idusr'),
												'status_online'=>'1',
												'start_active'=>date('Y-m-d H:i:s'),
												'last_active'=>date('Y-m-d H:i:s'),
												);
											$insert = $this->Model_db_users->save('users_online',$useronline);
											$insertlog = $this->Model_db_users->save('users_online_log',$useronline);
								/*------Save session for this user identities of job and others-----------*/
												$idusr=$this->session->userdata('cs_Idusr');
												$idgroup=$this->session->userdata('cs_Idgroup_usr');
												
												$smart_role=$this->Model_user->getCustom('Code1',"smart_role","WHERE GroupId='$idgroup' GROUP BY Code1");
												$mydigit=$this->Model_user->getCustom('id_alpha',"team_digit a","INNER JOIN team_user b ON a.Id_team=b.id_team WHERE b.id_user='$idusr' GROUP BY id_alpha");
												$type_clear=$this->Model_user->getCustom('type_clearance',"team a","INNER JOIN team_user b ON a.Id_team=b.id_team WHERE b.id_user='$idusr' GROUP BY type_clearance");
												$pmk_182=$this->Model_user->getCustom('pmk_182',"team a","INNER JOIN team_user b ON a.Id_team=b.id_team WHERE b.id_user='$idusr' GROUP BY pmk_182");	
												$ses_left_tlc = array();
												$ses_mydigit=array();
												$ses_type_clear=array();
												$ses_pmk_182=array();
												  foreach($smart_role as $row){      
													 $Code1 = $row->Code1;       
													 array_push($ses_left_tlc,$Code1);
													}
												  foreach($mydigit as $row2){      
													 $id_alpha = $row2->id_alpha;       
													 array_push($ses_mydigit,$id_alpha);
													}
												  foreach($type_clear as $row3){      
													 $type_clearance = $row3->type_clearance;       
													 array_push($ses_type_clear,$type_clearance);
												  }
												  foreach($pmk_182 as $row4){      
													 $pmk182 = $row4->pmk_182;       
													 array_push($ses_pmk_182,$pmk182);
												  }
													$mysession = array(
																'ses_left_tlc' => $ses_left_tlc,
																'ses_mydigit' => $ses_mydigit,
																'ses_type_clear' => $ses_type_clear,
																'ses_pmk_182' => $ses_pmk_182,
															);
													 $this->session->set_userdata($mysession);
									/*-------------------end of session this user own ----------------------*/
											redirect('dashboard/Dashboard/my_dashboard');
								}
							} else {
								//if form validate false
								$this->session->set_flashdata('flashMessage', 'Your Password and Username not Match! ');
								redirect('login/Login/index');
						 } 
            }
            else
            {
					 $success = false;
					 $this->session->set_flashdata('flashMessage', 'You must Check validate Captcha before!');
					 redirect('login/Login/index');
            }
        }
//==============================================
}
function cek_loginNNNN() {
		
		$txtcaptcha = trim($this->input->post('txtcaptcha'));
		$sescaptcha =$this->session->userdata('captchaword');
		
        $username =$this->input->post('usr');
        $password =md5($this->input->post('psw'));
	if( isset($_POST['btnlogin']) ){
		 $this->form_validation->set_rules('txtcaptcha', 'Captcha', 'trim|required');
		if ($this->form_validation->run() == FALSE)
		{
			 $this->session->set_flashdata('flashMessage', 'Your Captcha is wrong!');
			 redirect('login/Login/index');
		}else{
		 if($txtcaptcha==$sescaptcha)
		 {
			$this->session->unset_userdata('captchaword');	 
				//query the database
				$result =$this->Model_db_users->getCustom("a.*,b.Id as idgroup,b.GroupName","msuser a",
									  "INNER JOIN msgroup_usr b on a.IdGroupUsr=b.Id
									   WHERE a.Username='$username' AND a.Password='$password' AND a.isActive='1' ORDER BY a.Id ASC LIMIT 1");
							if($result) {
								foreach($result as $row){
							//create the session
									$sess_array = array(
										'cs_Idgroup_usr' => $row->idgroup,
										'cs_Idusr' => $row->Id,
										'cs_Username' => $row->Username,
										'cs_FullName'=>$row->FullName,
										'cs_GroupName'=>$row->GroupName,
										'cs_Email'=>$row->Email,
										'cs_Photo'=>$row->Photo,
										'cs_sesi_login'=>TRUE,
									);
									$this->session->set_userdata($sess_array);
									$kodeid=$this->Model_user->getMaxId('users_online','id');
									$useronline = array(
												'id'=>$kodeid+1,
												'user_id'=>$this->session->userdata('cs_Idusr'),
												'status_online'=>'1',
												'start_active'=>date('Y-m-d H:i:s'),
												'last_active'=>date('Y-m-d H:i:s'),
												);
											$insert = $this->Model_db_users->save('users_online',$useronline);
											$insertlog = $this->Model_db_users->save('users_online_log',$useronline);
								/*------Save session for this user identities of job and others-----------*/
												$idusr=$this->session->userdata('cs_Idusr');
												$idgroup=$this->session->userdata('cs_Idgroup_usr');
												
												$smart_role=$this->Model_user->getCustom('Code1',"smart_role","WHERE GroupId='$idgroup' GROUP BY Code1");
												$mydigit=$this->Model_user->getCustom('id_alpha',"team_digit a","INNER JOIN team_user b ON a.Id_team=b.id_team WHERE b.id_user='$idusr' GROUP BY id_alpha");
												$type_clear=$this->Model_user->getCustom('type_clearance',"team a","INNER JOIN team_user b ON a.Id_team=b.id_team WHERE b.id_user='$idusr' GROUP BY type_clearance");
												$pmk_182=$this->Model_user->getCustom('pmk_182',"team a","INNER JOIN team_user b ON a.Id_team=b.id_team WHERE b.id_user='$idusr' GROUP BY pmk_182");	
												$ses_left_tlc = array();
												$ses_mydigit=array();
												$ses_type_clear=array();
												$ses_pmk_182=array();
												  foreach($smart_role as $row){      
													 $Code1 = $row->Code1;       
													 array_push($ses_left_tlc,$Code1);
													}
												  foreach($mydigit as $row2){      
													 $id_alpha = $row2->id_alpha;       
													 array_push($ses_mydigit,$id_alpha);
													}
												  foreach($type_clear as $row3){      
													 $type_clearance = $row3->type_clearance;       
													 array_push($ses_type_clear,$type_clearance);
												  }
												  foreach($pmk_182 as $row4){      
													 $pmk182 = $row4->pmk_182;       
													 array_push($ses_pmk_182,$pmk182);
												  }
													$mysession = array(
																'ses_left_tlc' => $ses_left_tlc,
																'ses_mydigit' => $ses_mydigit,
																'ses_type_clear' => $ses_type_clear,
																'ses_pmk_182' => $ses_pmk_182,
															);
													 $this->session->set_userdata($mysession);
									/*-------------------end of session this user own ----------------------*/
											redirect('dashboard/Dashboard/my_dashboard');
								}
							} else {
								//if form validate false
								$this->session->set_flashdata('flashMessage', 'Your Password and username no Match -> '.$identity);
								redirect('login/Login/index');
						 } 
		 } else {
			 $this->session->set_flashdata('flashMessage', 'Your Captcha is wrong !');
			 redirect('login/Login/index');
			 }
		}
	}
}
function cek_login_nocaptcha() {
	        $username =$this->input->post('usr');
        $password =md5($this->input->post('psw'));
					$result =$this->Model_db_users->getCustom("a.*,b.Id as idgroup,b.GroupName","msuser a",
									  "INNER JOIN msgroup_usr b on a.IdGroupUsr=b.Id
									   WHERE a.Username='$username' AND a.Password='$password' AND a.isActive='1' ORDER BY a.Id ASC LIMIT 1");
							if($result) {
								foreach($result as $row){
							//create the session
									$sess_array = array(
										'cs_Idgroup_usr' => $row->idgroup,
										'cs_Idusr' => $row->Id,
										'cs_Username' => $row->Username,
										'cs_FullName'=>$row->FullName,
										'cs_GroupName'=>$row->GroupName,
										'cs_Email'=>$row->Email,
										'cs_Photo'=>$row->Photo,
										'cs_sesi_login'=>TRUE,
									);
									$this->session->set_userdata($sess_array);
									$kodeid=$this->Model_user->getMaxId('users_online','id');
									$useronline = array(
												'id'=>$kodeid+1,
												'user_id'=>$this->session->userdata('cs_Idusr'),
												'status_online'=>'1',
												'start_active'=>date('Y-m-d H:i:s'),
												'last_active'=>date('Y-m-d H:i:s'),
												);
											$insert = $this->Model_db_users->save('users_online',$useronline);
											$insertlog = $this->Model_db_users->save('users_online_log',$useronline);
								/*------Save session for this user identities of job and others-----------*/
												$idusr=$this->session->userdata('cs_Idusr');
												$idgroup=$this->session->userdata('cs_Idgroup_usr');
												
												$smart_role=$this->Model_user->getCustom('Code1',"smart_role","WHERE GroupId='$idgroup' GROUP BY Code1");
												$mydigit=$this->Model_user->getCustom('id_alpha',"team_digit a","INNER JOIN team_user b ON a.Id_team=b.id_team WHERE b.id_user='$idusr' GROUP BY id_alpha");
												$type_clear=$this->Model_user->getCustom('type_clearance',"team a","INNER JOIN team_user b ON a.Id_team=b.id_team WHERE b.id_user='$idusr' GROUP BY type_clearance");
												$pmk_182=$this->Model_user->getCustom('pmk_182',"team a","INNER JOIN team_user b ON a.Id_team=b.id_team WHERE b.id_user='$idusr' GROUP BY pmk_182");	
												$ses_left_tlc = array();
												$ses_mydigit=array();
												$ses_type_clear=array();
												$ses_pmk_182=array();
												  foreach($smart_role as $row){      
													 $Code1 = $row->Code1;       
													 array_push($ses_left_tlc,$Code1);
													}
												  foreach($mydigit as $row2){      
													 $id_alpha = $row2->id_alpha;       
													 array_push($ses_mydigit,$id_alpha);
													}
												  foreach($type_clear as $row3){      
													 $type_clearance = $row3->type_clearance;       
													 array_push($ses_type_clear,$type_clearance);
												  }
												  foreach($pmk_182 as $row4){      
													 $pmk182 = $row4->pmk_182;       
													 array_push($ses_pmk_182,$pmk182);
												  }
													$mysession = array(
																'ses_left_tlc' => $ses_left_tlc,
																'ses_mydigit' => $ses_mydigit,
																'ses_type_clear' => $ses_type_clear,
																'ses_pmk_182' => $ses_pmk_182,
															);
													 $this->session->set_userdata($mysession);
									/*-------------------end of session this user own ----------------------*/
											redirect('cas/Ccas/ManifestList');
								}
							} else {
								//if form validate false
								$this->session->set_flashdata('flashMessage', 'Your Password and username no Match -> '.$identity);
								redirect('login/Login/index');
						 } 
	
}	
  function logout() {
	  $user_id=$this->session->userdata('cs_Idusr');
	  $cek_ol=$this->Model_user->getCustom('*',"users_online a",
	  			"where user_id='$user_id'");
	foreach($cek_ol as $list){
		$ubah = array(
				'status_online'=>'0',
				'last_active'=>date('Y-m-d H:i:s'),
				);
				$id_online=$list->id;
				$start_ol=$list->start_active;
				$update_log = $this->Model_user->update_user_offline('users_online_log','id',$id_online,'start_active',$start_ol,$ubah);
				$deletedata=$this->Model_user->delete_data('users_online','user_id',$user_id);	
  }
        $this->session->unset_userdata('cs_Idusr');
		$this->session->unset_userdata('cs_Idgroup_usr');
        $this->session->unset_userdata('cs_Username');
        $this->session->unset_userdata('cs_FullName');
		$this->session->unset_userdata('cs_Email');
		$this->session->unset_userdata('cs_sesi_login');
        $this->session->set_flashdata('notif','THANK YOU FOR LOGIN IN THIS APP');
		$this->db->close();
        redirect('login/Login');
    }

	
	

		
}
