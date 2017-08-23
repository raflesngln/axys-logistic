<?php 

class Sesi_login{

 	protected $CI;
         public function __construct()
        {
                // Assign the CodeIgniter super-object
                $this->CI =& get_instance();
        }
public function log_session(){
		$login_status=$this->CI->session->userdata('cs_sesi_login');
		if($login_status == TRUE){
		   return true;
		} else {
			return false;
		}
}

	
public function cek_sesi(){
		$login_status=$this->CI->session->userdata('cs_sesi_login');
		if($login_status != TRUE){
		redirect('login/Login');
		}
}


}