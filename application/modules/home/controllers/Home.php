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
	'content'=>'home/content-body',
	'boxsearch'=>'home/box-search',
	'slider'=>'home/slider'
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
 


    
}


