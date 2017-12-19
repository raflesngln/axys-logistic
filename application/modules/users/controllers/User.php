<?php
class User extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('users/Mdata');
 /*       $this->load->model('cas/Model_gtln');
		$this->load->model('cas/Model_pdf');
        $this->load->library('Sesi_login');
		if($this->sesi_login->log_session() !=TRUE){
			redirect('login/login');
			return false;
		}*/
        date_default_timezone_set('Asia/Jakarta');
    }
    
  function login(){
	$data=array(
		'title'=>'Login Form',
		'content'=>'users/form_login_regist'
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
public function save_user(){
	$email=$this->input->post('txtemail');
	
		$data = array(
			'FirstName'=>$this->input->post('txtfirstname'),
			'LastName'=>$this->input->post('txtlastname'),
			'Username'=>$this->input->post('txtusername'),
			'FullName'=>$this->input->post('txtfirstname').' '.$this->input->post('txtlastname'),
			'Email'=>$this->input->post('txtemail'),
			'Phone'=>'081217627126',//$this->intxtusernameput->post('Phone'),
			'Password'=>md5($this->input->post('txtpassword')),
			'Password2'=>$this->input->post('txtpassword'),
			'CreatedBy'=>'',//$this->session->userdata('cs_Idusr'),
			'CreatedDate'=>date('Y-m-d'),
			);
		$insert = $this->Mdata->save('msuser',$data);
		$this->send_email($email);
		echo json_encode(array("status" => TRUE));
}

function send_email($email){
	  $this->load->library('email');
	  
	  $pengirim='raflesngln@gmail.com';//$this->input->post('temail',TRUE);
	  $penerima=$email;//$this->input->post('temail',TRUE);
	  $pecah=explode("@",$penerima);
	  $nm_penerima=$pecah[0];
	  //$captcha = $this->input->post('captcha',TRUE);
	
	   $this->form_validation->set_rules($penerima, 'Email', 'trim|required|valid_email');
	   //$this->form_validation->set_rules('captcha', 'Captcha', 'trim|required|alpha_numeric');
		if ($this->form_validation->run() == FALSE)
		{
			echo 'Your email is wrong';
			return false;
		}else{
		/*$config['protocol'] = 'smtp';
		//$config['smtp_host'] = 'ssl://inahall.com';
		$config['smtp_port'] = '25';
		//$config['smtp_timeout'] = '7';
		$config['smtp_user'] = 'info@inahall.com';
		$config['smtp_pass'] = 'sBG}ZERW8#{3';
		$config['charset'] = 'utf-8';*/
		$config['mailtype']= "html";
		$this->email->initialize($config);
		
		$htmlContent ='';
		
		$htmlContent .='<p>Dear '.$nm_penerima.',</p> 
					<p>Hi, '.$nm_penerima. ' thank you for visiting www.inahall.com. Here are some of your wishlist :</p> 
				
				<table width="100%" style="border:1px #CCC solid">
				<tr style="background:#F3F3F3">
					<th height="35px">Image</th>
					<th>Product Name</th>
					<th>Unit Price ( USD )</th>
					<th>Min. Order</th>
					<th>QR Code</th>
				</tr>
				<tr>
					<td>dfdfdfdf</td>
					<td>dfdd</td>
					<td>fdfdfdfdf</td>
					<td>fsffsfsf</td>
					<td>sffsfsfsf</td>
				<tr>
				</table>
				
				<p>Regards,</p> 
				<p>axys logistic</p>
				';
		
		$this->email->from('raflesngln@gmail.com', 'ERP');
		$this->email->to($penerima);
		$this->email->cc('info@inahall.com');
		$this->email->bcc('info@inahall.com');
		$this->email->subject('Registration user');
		$this->email->message($htmlContent);
		$this->email->send();
		 if($this->email->send()){
			  //echo $this->email->print_debugger();
			 $this->session->set_flashdata("email_sent","Email sent successfully."); }
         else {
			 $this->session->set_flashdata("email_not_sent","Error in sending Email.");
		 }
	}
		
}


    
}


