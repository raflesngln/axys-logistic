<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdata extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database(); 
	}
    
    function hitungdate($lahir){

        $pecah = explode("-", $lahir);
        
        $tgl = intval($pecah['2']);
        $bln = intval($pecah['1']);
        $thn = $pecah['0'];
        $utahun = date("Y") - $thn;
        $ubulan = date("m") - $bln;
        $uhari = date("j") - $tgl;
        if($uhari < 0){
        $uhari = date("t",mktime(0,0,0,$bln-1,date("m"),date("Y"))) - abs($uhari); $ubulan = $ubulan - 1;
        }
        if($ubulan < 0){
        $ubulan = 12 - abs($ubulan); $utahun = $utahun - 1;
        }
        return $utahun;  
    }
    

    
    function myKill(){ 
       //===========================Kill
           $query=$this->db->query("SHOW FULL PROCESSLIST");
           foreach($query->result() as $t){
     		  $myid       =	$t->Id;
              $mydb       =	$t->db;
              $mycommand  =	$t->Command;
              if($mycommand=='Sleep' && $mydb=='Cas_CRM_DB'){
              $query=$this->db->query("KILL $myid");
              }
           }
        //===============================
    }
    
    
    function gen_tlc(){
        $a=$this->session->userdata('ses_left_tlc');
        $hasil = '(';
        for($i=0;$i<count($a);$i++){
				if($i==0){$hasil .= "'".$a[$i]."'";}else{$hasil .= ","."'".$a[$i]."'";}
		}
        $hasil .= ')';
        if($i==0){
            $hasil = "('')";
        }
        
        return $hasil ;
        
    }
    
    function gen_digit(){
        $a=$this->session->userdata('ses_mydigit');
        $hasil = '(';
        for($i=0;$i<count($a);$i++){
				if($i==0){$hasil .= "'".$a[$i]."'";}else{$hasil .= ","."'".$a[$i]."'";}
		}
        $hasil .= ')';
        if($i==0){
            $hasil = "('')";
        }
        
        return $hasil ;
        
    }
    
    function gen_type(){
        $a=$this->session->userdata('ses_type_clear');
        $hasil = '(';
        for($i=0;$i<count($a);$i++){
				if($i==0){$hasil .= "'".$a[$i]."'";}else{$hasil .= ","."'".$a[$i]."'";}
		}
        $hasil .= ')';
        if($i==0){
            $hasil = "('')";
        }
        
        return $hasil ;
        
    }
    
    function gen_pmk182(){
        $a=$this->session->userdata('ses_pmk_182');
        $hasil = '(';
        for($i=0;$i<count($a);$i++){
				if($i==0){$hasil .= "'".$a[$i]."'";}else{$hasil .= ","."'".$a[$i]."'";}
		}
        $hasil .= ')';
        if($i==0){
            $hasil = "('')";
        }
        
        return $hasil ;
        
    }
    
    function  tanggal_format_indonesia($tgl){
        $tanggal  = explode('-',$tgl); 
        $bulan  = $this-> getBulan($tanggal[1]);
        $tahun  =  $tanggal[0];
        return  $tanggal[2].' '.$bulan.' '.$tahun;

        }
         
    function  tanggal_indonesia($tgl){
        $tanggal  =  substr($tgl,8,2);
        $bulan  = substr($tgl,5,2);
        $tahun  =  substr($tgl,0,4);
        return  $tanggal.'-'.$bulan.'-'.$tahun;
        }
    
    function bulan(){
        $bln = array('jan','feb','mar','apr','mey','jun','jul','agus','sep','oct','nov','des');
        return $bln;
    }
           
    function  getBulan($bln){
        switch  ($bln){
        case  1:
        return  "Januari";
        break;
        case  2:
        return  "Februari";
        break;
        case  3:
        return  "Maret";
        break;
        case  4:
        return  "April";
        break;
        case  5:
        return  "Mei";
        break;
        case  6:
        return  "Juni";
        break;
        case  7:
        return  "Juli";
        break;
        case  8:
        return  "Agustus";
        break;
        case  9:
        return  "September";
        break;
        case  10:
        return  "Oktober";
        break;
        case  11:
        return  "November";
        break;
        case  12:
        return  "Desember";
        break;
     }
    }
    
    function  romawi_bln($bln){
        switch  ($bln){
        case  1:
        return  "I";
        break;
        case  2:
        return  "II";
        break;
        case  3:
        return  "III";
        break;
        case  4:
        return  "IV";
        break;
        case  5:
        return  "V";
        break;
        case  6:
        return  "VI";
        break;
        case  7:
        return  "VII";
        break;
        case  8:
        return  "VII";
        break;
        case  9:
        return  "IX";
        break;
        case  10:
        return  "X";
        break;
        case  11:
        return  "XI";
        break;
        case  12:
        return  "XII";
        break;
     }
    }

	private function _get_datatables_query($nm_tabel,$nm_coloum,$orderby,$where)
	{	
		$i = 0;
		foreach ($nm_coloum as $item) 
		{
			if($_POST['search']['value'])
				($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
			$column[$i] = $item;
			$i++;
		}
		
		if(isset($_POST['order']))
		{
		  $n=0;
            $sort=$_POST['order'];
            foreach($sort as $i =>$val){
             $this->db->order_by($column[$_POST['order'][$n]['column']], $_POST['order'][$n]['dir']);   
             $n++;
            }
		}
		else if(isset($orderby))
		{
			$order = $orderby;
			$this->db->order_by(key($order), $order[key($order)]);
		}
        $this->db->where($where); 
        

	}

	function get_datatables($nm_tabel,$nm_coloum,$orderby,$where)
	{
	    $this->db->from($nm_tabel);
        
		$this->_get_datatables_query($nm_tabel,$nm_coloum,$orderby,$where);
        if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
    
	function count_filtered($nm_tabel,$nm_coloum,$orderby,$where)
	{
		$this->_get_datatables_query($nm_tabel,$nm_coloum,$orderby,$where);
        $this->db->from($nm_tabel);
		return $this->db->count_all_results();
	}

	public function count_all($nm_tabel,$nm_coloum)
	{
		$this->db->from($nm_tabel);
		return $this->db->count_all_results();
	}
    
    public function get($nmtabel)
	{
		$this->db->from($nmtabel);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_by_id($id,$nmtabel,$key)
	{
		$this->db->from($nmtabel);
		$this->db->where($key,$id);
		$query = $this->db->get();
		return $query->row();
	}
    public function get_by_id_join($id,$nmtabel,$nmtabel1,$join='inner',$on1,$key)
	{
		$this->db->from($nmtabel);
        $this->db->join($nmtabel1, $on1,$join);//join
		$this->db->where($key,$id);
		$query = $this->db->get();
		return $query->row();
	}
    public function get_by_id_join1($id,$nmtabel,$nmtabel1,$join1='inner',$on1,$nmtabel2,$join2='inner',$on2,$key)
	{
		$this->db->from($nmtabel);
        $this->db->join($nmtabel1, $on1,$join1);//join
        $this->db->join($nmtabel2, $on2,$join2);//join
		$this->db->where($key,$id);
		$query = $this->db->get();
		return $query->row();
	}
    
    public function get_by_id_join2($id,$nmtabel,$nmtabel1,$join1='inner',$on1,$nmtabel2,$join2='inner',$on2,$nmtabel3,$join3='inner',$on3,$key)
	{
		$this->db->from($nmtabel);
        $this->db->join($nmtabel1, $on1,$join1);//join
        $this->db->join($nmtabel2, $on2,$join2);//join
        $this->db->join($nmtabel3, $on3,$join3);//join
		$this->db->where($key,$id);
		$query = $this->db->get();
		return $query->row();
	}
    
    public function get_by_id_join3($id,$nmtabel,$nmtabel1,$join1='inner',$on1,$nmtabel2,$join2='inner',$on2,$nmtabel3,$join3='inner',$on3,$nmtabel4,$join4='inner',$on4,$key)
	{
		$this->db->from($nmtabel);
        $this->db->join($nmtabel1, $on1,$join1);//join
        $this->db->join($nmtabel2, $on2,$join2);//join
        $this->db->join($nmtabel3, $on3,$join3);//join
		$this->db->join($nmtabel4, $on4,$join4);//join
        $this->db->where($key,$id);
		$query = $this->db->get();
		return $query->row();
	}
    
    public function get_by_id_join4($id,$nmtabel,$nmtabel1,$join1='inner',$on1,$nmtabel2,$join2='inner',$on2,$nmtabel3,$join3='inner',$on3,$nmtabel4,$join4='inner',$on4,$nmtabel5,$join5='inner',$on5,$key)
	{
		$this->db->from($nmtabel);
        $this->db->join($nmtabel1, $on1,$join1);//join
        $this->db->join($nmtabel2, $on2,$join2);//join
        $this->db->join($nmtabel3, $on3,$join3);//join
		$this->db->join($nmtabel4, $on4,$join4);//join
        $this->db->join($nmtabel5, $on5,$join5);//join
        $this->db->where($key,$id);
		$query = $this->db->get();
		return $query->row();
	}

	public function save($data,$nmtabel)
	{
		$this->db->insert($nmtabel, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data, $nmtabel)
	{
		$this->db->update($nmtabel, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id,$nmtabel,$key)
	{
		$this->db->where($key, $id);
		$this->db->delete($nmtabel);
	}
    
    public function delete_where($where,$nmtabel)
	{
		$this->db->where($where);
		$this->db->delete($nmtabel);
	}
    
    private function _get_datadetail_query($nm_coloum,$orderby,$where)
	{	
		$i = 0;
		
		if(isset($_POST['order']))
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($orderby))
		{
			$order = $orderby;
			$this->db->order_by(key($order), $order[key($order)]);
		}
        $this->db->where($where); 
	}
    
    public function get_datadetail($nm_tabel,$nm_coloum,$orderby,$where,$in='')
	{
	    $this->db->from($nm_tabel);
		$this->_get_datadetail_query($nm_coloum,$orderby,$where);
        
        if($in != ''){
            $otopt=$this->session->userdata('otopt');
            $this->db->where_in($in,$otopt);
        }
        
		$query = $this->db->get();
		return $query->result();
	}
    
    public function get_datadetailMy($nm_coloum,$nm_tabel,$orderby,$where,$in='')
	{
	    $this->db->select($nm_coloum);
	    $this->db->from($nm_tabel);
		$this->_get_datadetail_query($nm_coloum,$orderby,$where);
        
        if($in != ''){
            $otopt=$this->session->userdata('otopt');
            $this->db->where_in($in,$otopt);
        }
        
		$query = $this->db->get();
		return $query->result();
	}
    
    public function get_datadetail_join1($nm_coloum,$nm_tabel,$nm_tabel1,$on1,$join1,$orderby,$where,$in='')
	{
	    $this->db->select($nm_coloum);
	    $this->db->from($nm_tabel);
        $this->db->join($nm_tabel1, $on1,$join1);//join
		$this->_get_datadetail_query($nm_coloum,$orderby,$where);
        
        if($in != ''){
            $otopt=$this->session->userdata('otopt');
            $this->db->where_in($in,$otopt);
        }
        
		$query = $this->db->get();
		return $query->result();
	}
    
    public function get_datadetail_join2($nm_coloum,$nm_tabel,$nm_tabel1,$on1,$join1,$nm_tabel2,$on2,$join2,$orderby,$where,$in='')
	{
	    $this->db->select($nm_coloum);
	    $this->db->from($nm_tabel);
        $this->db->join($nm_tabel1, $on1,$join1);//join
         $this->db->join($nm_tabel2, $on2,$join2);
		$this->_get_datadetail_query($nm_coloum,$orderby,$where);
        
        if($in != ''){
            $otopt=$this->session->userdata('otopt');
            $this->db->where_in($in,$otopt);
        }
        
		$query = $this->db->get();
		return $query->result();
	}
    
    public function get_datadetail_join3($nm_coloum,$nm_tabel,$nm_tabel1,$on1,$join1,$nm_tabel2,$on2,$join2,$nm_tabel3,$on3,$join3,$orderby,$where,$in='')
	{
	    $this->db->select($nm_coloum);
	    $this->db->from($nm_tabel);
        $this->db->join($nm_tabel1, $on1,$join1);//join
        $this->db->join($nm_tabel2, $on2,$join2);
        $this->db->join($nm_tabel3, $on3,$join3);
		$this->_get_datadetail_query($nm_coloum,$orderby,$where);
        
        if($in != ''){
            $otopt=$this->session->userdata('otopt');
            $this->db->where_in($in,$otopt);
        }
        
		$query = $this->db->get();
		return $query->result();
	}
    
    public function get_datadetail_join4($nm_coloum,$nm_tabel,$nm_tabel1,$on1,$join1,$nm_tabel2,$on2,$join2,$nm_tabel3,$on3,$join3,$nm_tabel4,$on4,$join4,$orderby,$where,$in='')
	{
	    $this->db->select($nm_coloum);
	    $this->db->from($nm_tabel);
        $this->db->join($nm_tabel1, $on1,$join1);//join
        $this->db->join($nm_tabel2, $on2,$join2);
        $this->db->join($nm_tabel3, $on3,$join3);
        $this->db->join($nm_tabel4, $on4,$join4);
		$this->_get_datadetail_query($nm_coloum,$orderby,$where);
        
        if($in != ''){
            $otopt=$this->session->userdata('otopt');
            $this->db->where_in($in,$otopt);
        }
        
		$query = $this->db->get();
		return $query->result();
	}
    
    
//==================== JOIN TABEL 2 ====================///   
    function get_datatables_join1($nm_tabel,$nm_coloum,$nm_tabel1,$join1='inner',$on1,$orderby,$where)
	{
	    $this->db->select($nm_coloum);
	    $this->db->from($nm_tabel);
        $this->db->join($nm_tabel1, $on1,$join1);//join
		$this->_get_datatables_query($nm_tabel,$nm_coloum,$orderby,$where);
        if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
    
    function count_filtered_join1($nm_tabel,$nm_coloum,$nm_tabel1,$join1='inner',$on1,$orderby,$where)
	{
		$this->_get_datatables_query($nm_tabel,$nm_coloum,$orderby,$where);
        $this->db->from($nm_tabel);
        $this->db->join($nm_tabel1, $on1,$join1);//join
		return $this->db->count_all_results();
	}

	public function count_all_join1($nm_tabel,$nm_coloum,$nm_tabel1,$join1='inner',$on1)
	{
		$this->db->from($nm_tabel);
        $this->db->join($nm_tabel1, $on1,$join1);//join
		return $this->db->count_all_results();
	}
    
//============================ JOIN TABEL 3 ========================== //    
    function get_datatables_join2($nm_tabel,$nm_coloum,$nm_tabel1,$join1='inner',$on1,$nm_tabel2,$join2='inner',$on2,$orderby,$where)
	{
	   $this->db->select($nm_coloum);
	    $this->db->from($nm_tabel);
        $this->db->join($nm_tabel1, $on1,$join1);//join
        $this->db->join($nm_tabel2, $on2,$join2);//join
		$this->_get_datatables_query($nm_tabel,$nm_coloum,$orderby,$where);
        if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
 
    function count_filtered_join2($nm_tabel,$nm_coloum,$nm_tabel1,$join1='inner',$on1,$nm_tabel2,$join2='inner',$on2,$orderby,$where)
	{
		$this->_get_datatables_query($nm_tabel,$nm_coloum,$orderby,$where);
        $this->db->from($nm_tabel);
        $this->db->join($nm_tabel1, $on1,$join1);//join
        $this->db->join($nm_tabel2, $on2,$join2);//join
		return $this->db->count_all_results();
	}

	public function count_all_join2($nm_tabel,$nm_coloum,$nm_tabel1,$join1='inner',$on1,$nm_tabel2,$join2='inner',$on2)
	{
		$this->db->from($nm_tabel);
        $this->db->join($nm_tabel1, $on1,$join1);//join
        $this->db->join($nm_tabel2, $on2,$join2);//join
		return $this->db->count_all_results();
	}
    
    
 //============================ JOIN TABEL 4 ========================== //   
    function get_datatables_join3($nm_tabel,$nm_coloum,$nm_tabel1,$join1='inner',$on1,$nm_tabel2,$join2='inner',$on2,$nm_tabel3,$join3='inner',$on3,$orderby,$where,$in='')
	{  
	    $this->db->select($nm_coloum);
	    $this->db->from($nm_tabel);
        $this->db->join($nm_tabel1, $on1,$join1);//join
        $this->db->join($nm_tabel2, $on2,$join2);//join
        $this->db->join($nm_tabel3, $on3,$join3);//join
		$this->_get_datatables_query($nm_tabel,$nm_coloum,$orderby,$where);
        if($in != ''){
            $otopt=$this->session->userdata('otopt');
            $this->db->where_in($in,$otopt);
        }
        if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
    
    function count_filtered_join3($nm_tabel,$nm_coloum,$nm_tabel1,$join1='inner',$on1,$nm_tabel2,$join2='inner',$on2,$nm_tabel3,$join3='inner',$on3,$orderby,$where,$in='')
	{
		$this->_get_datatables_query($nm_tabel,$nm_coloum,$orderby,$where);
        $this->db->from($nm_tabel);
        $this->db->join($nm_tabel1, $on1,$join1);//join
        $this->db->join($nm_tabel2, $on2,$join2);//join
        $this->db->join($nm_tabel3, $on3,$join3);//join
        if($in != ''){
            $otopt=$this->session->userdata('otopt');
            $this->db->where_in($in,$otopt);
        }
		return $this->db->count_all_results();
	}

	public function count_all_join3($nm_tabel,$nm_coloum,$nm_tabel1,$join1='inner',$on1,$nm_tabel2,$join2='inner',$on2,$nm_tabel3,$join3='inner',$on3,$where='',$in='')
	{
		$this->db->from($nm_tabel);
        if($in != ''){
            $otopt=$this->session->userdata('otopt');
            $this->db->where_in($in,$otopt);
        }
        $this->db->where($where); 
        $this->db->join($nm_tabel1, $on1,$join1);//join
        $this->db->join($nm_tabel2, $on2,$join2);//join
        $this->db->join($nm_tabel3, $on3,$join3);//join

		return $this->db->count_all_results();
	}
    
    
   //============================ JOIN TABEL 5 ========================== //   
    function get_datatables_join4($nm_tabel,$nm_coloum,$nm_tabel1,$join1='inner',$on1,$nm_tabel2,$join2='inner',$on2,$nm_tabel3,$join3='inner',$on3,$nm_tabel4,$join4='inner',$on4,$orderby,$where,$nm_coloum_order)
	{
	   $this->db->select($nm_coloum);
	    $this->db->from($nm_tabel);
        $this->db->join($nm_tabel1, $on1,$join1);//join
        $this->db->join($nm_tabel2, $on2,$join2);//join
        $this->db->join($nm_tabel3, $on3,$join3);//join
        $this->db->join($nm_tabel4, $on4,$join4);//join
		$this->_get_datatables_query($nm_tabel,$nm_coloum_order,$orderby,$where);
        if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
    
    function count_filtered_join4($nm_tabel,$nm_coloum,$nm_tabel1,$join1='inner',$on1,$nm_tabel2,$join2='inner',$on2,$nm_tabel3,$join3='inner',$on3,$nm_tabel4,$join4='inner',$on4,$orderby,$where)
	{
		$this->_get_datatables_query($nm_tabel,$nm_coloum,$orderby,$where);
        $this->db->from($nm_tabel);
        $this->db->join($nm_tabel1, $on1,$join1);//join
        $this->db->join($nm_tabel2, $on2,$join2);//join
        $this->db->join($nm_tabel3, $on3,$join3);//join
        $this->db->join($nm_tabel4, $on4,$join4);//join
		return $this->db->count_all_results();
	}

	public function count_all_join4($nm_tabel,$nm_coloum,$nm_tabel1,$join1='inner',$on1,$nm_tabel2,$join2='inner',$on2,$nm_tabel3,$join3='inner',$on3,$nm_tabel4,$join4='inner',$on4,$where='')
	{
	    $this->db->where($where); 
		$this->db->from($nm_tabel);
        $this->db->join($nm_tabel1, $on1,$join1);//join
        $this->db->join($nm_tabel2, $on2,$join2);//join
        $this->db->join($nm_tabel3, $on3,$join3);//join
        $this->db->join($nm_tabel4, $on4,$join4);//join
		return $this->db->count_all_results();
	} 

   //============================ JOIN TABEL 6 ========================== //   
    function get_datatables_join5($nm_tabel,$nm_coloum,$nm_tabel1,$join1='inner',$on1,$nm_tabel2,$join2='inner',$on2,$nm_tabel3,$join3='inner',$on3,$nm_tabel4,$join4='inner',$on4,$nm_tabel5,$join5='inner',$on5,$orderby,$where,$nm_coloum_order)
	{
	   $this->db->select($nm_coloum);
	    $this->db->from($nm_tabel);
        $this->db->join($nm_tabel1, $on1,$join1);//join
        $this->db->join($nm_tabel2, $on2,$join2);//join
        $this->db->join($nm_tabel3, $on3,$join3);//join
        $this->db->join($nm_tabel4, $on4,$join4);//join
        $this->db->join($nm_tabel5, $on5,$join5);//join
		$this->_get_datatables_query($nm_tabel,$nm_coloum_order,$orderby,$where);
        if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
    
    function count_filtered_join5($nm_tabel,$nm_coloum,$nm_tabel1,$join1='inner',$on1,$nm_tabel2,$join2='inner',$on2,$nm_tabel3,$join3='inner',$on3,$nm_tabel4,$join4='inner',$on4,$nm_tabel5,$join5='inner',$on5,$orderby,$where)
	{
		$this->_get_datatables_query($nm_tabel,$nm_coloum,$orderby,$where);
        $this->db->from($nm_tabel);
        $this->db->join($nm_tabel1, $on1,$join1);//join
        $this->db->join($nm_tabel2, $on2,$join2);//join
        $this->db->join($nm_tabel3, $on3,$join3);//join
        $this->db->join($nm_tabel4, $on4,$join4);//join
        $this->db->join($nm_tabel5, $on5,$join5);//join
		return $this->db->count_all_results();
	}

	public function count_all_join5($nm_tabel,$nm_coloum,$nm_tabel1,$join1='inner',$on1,$nm_tabel2,$join2='inner',$on2,$nm_tabel3,$join3='inner',$on3,$nm_tabel4,$join4='inner',$on4,$nm_tabel5,$join5='inner',$on5,$where='')
	{
	    $this->db->where($where); 
		$this->db->from($nm_tabel);
        $this->db->join($nm_tabel1, $on1,$join1);//join
        $this->db->join($nm_tabel2, $on2,$join2);//join
        $this->db->join($nm_tabel3, $on3,$join3);//join
        $this->db->join($nm_tabel4, $on4,$join4);//join
        $this->db->join($nm_tabel5, $on5,$join5);//join
		return $this->db->count_all_results();
	}
    
    
    public function cek_dobel($nm_tabel,$where='')
    {
        $this->db->where($where);
        $this->db->from($nm_tabel);
        $isi= $this->db->count_all_results();
        
        if($isi>0){
            return false;
        }else{
            return true;
        }
        
    }
    
    function get_port_service($where,$q)
    {
      if ($q === '') {
            return array(array('vendorname' => 'Data null'));
      } else {
        $this->db->like('PortGabung', $q);
        $this->db->select('*');
        $this->db->where($where);
        $this->db->from('trport_search');
        $query = $this->db->get();
		return $query->result();
      }
    }
function getCustom($kolom,$table,$where) 
	{
	$query=$this->db->query("select ".$kolom." from ".$table." $where");		
	return $query->result();
 	}
	
}
