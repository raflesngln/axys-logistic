<?php
/**
 * Created by PhpStorm.
 * User: wisnubaldas
 * Date: 12/28/16
 * Time: 2:06 PM
 */
class Model_cari extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function get_datatables($selected,$nm_tabel,$nm_coloum,$orderby,$where,$where_in,$tipe,$kriteria,$job,$nm_tabel2,$kolom1,$kolom2)
	{
		
		$this->db->select($selected);
	    $this->db->from($nm_tabel);
		$this->db->join($nm_tabel2,$kolom1.'='.$kolom2,'LEFT');
		$this->db->join("tm_typeclearance c",'b.type_clearance=c.TypeClearance','LEFT');
		$this->db->join("statusproses d",'b.TrackingStatus=d.NoId','LEFT');
		$this->db->join("bc_m_jns_aju e",'b.Id_aju=e.id_aju','LEFT');
		//$this->db->group_by('a.Name'); 
		$this->_get_datatables_query($nm_coloum,$orderby,$where,$where_in,$tipe,$kriteria,$job);	
        if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
private function _get_datatables_query($nm_coloum,$orderby,$where,$where_in,$tipe,$kriteria,$job)
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
            	// $this->db->group_by('a.Name'); 
             $this->db->order_by($column[$_POST['order'][$n]['column']], $_POST['order'][$n]['dir']); 
             $n++;
            }
			//$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($orderby))
		{
			 //$this->db->group_by('a.Name'); 
			$order = $orderby;
			$this->db->order_by(key($order), $order[key($order)]);
			
		}
		
		if($where != ''){
			$array = explode(',', $job);
											
								if($kriteria=='start'){
										foreach($array as $key => $value) {
											if($value =='') {
												 	$data='rafles';
												} else {
													$data=$value;
												}
													$this->db->or_like($tipe, $data,'after');
													$this->db->where($where);
											}
										
									} else if($kriteria=='end'){
										foreach($array as $key => $value) {
											if($value =='') {
												 	$data='rafles';
												} else {
													$data=$value;
												}
													$this->db->or_like($tipe, $data,'before');
													$this->db->where($where);
											}
									} else if($kriteria=='contains'){
										foreach($array as $key => $value) {
											if($value =='') {
												 	$data='rafles';
												} else {
													$data=$value;
												}
													$this->db->or_like($tipe, $data,'both');
													$this->db->where($where);
											}	
									} else if($kriteria=='notcontains'){
										foreach($array as $key => $value) {
											if($value =='') {
												 	$data='rafles';
												} else {
													$data=$value;
												}
													$this->db->not_like($tipe, $data,'after');
													$this->db->where($where);
											}
									} else if($kriteria=='equals'){
										$kondisi=$this->db->where_in($tipe,$where_in);
										$this->db->where($where);
									} else if($kriteria=='notequals'){
										$kondisi=$this->db->where_not_in($tipe,$where_in);
										$this->db->where($where);	
									}	
			//$this->db->where($where); 
			//$this->db->where_in($tipe,$where_in); 
		}
}
public function count_all($nm_tabel,$nm_coloum,$nm_tabel2,$kolom1,$kolom2)
	{
	    $this->db->from($nm_tabel);
		$this->db->join($nm_tabel2,$kolom1.'='.$kolom2,'LEFT');
		$this->db->join("tm_typeclearance c",'b.type_clearance=c.TypeClearance','LEFT');
		$this->db->join("statusproses d",'b.TrackingStatus=d.NoId','LEFT');
		$this->db->join("bc_m_jns_aju e",'b.Id_aju=e.id_aju','LEFT');
		return $this->db->count_all_results();
}
	function count_filtered($nm_tabel,$nm_coloum,$orderby,$where,$where_in,$tipe,$kriteria,$job,$nm_tabel2,$kolom1,$kolom2)
	{
		$this->_get_datatables_query($nm_coloum,$orderby,$where,$where_in,$tipe,$kriteria,$job);
	    $this->db->from($nm_tabel);
		$this->db->join($nm_tabel2,$kolom1.'='.$kolom2,'LEFT');
		$this->db->join("tm_typeclearance c",'b.type_clearance=c.TypeClearance','LEFT');
		$this->db->join("statusproses d",'b.TrackingStatus=d.NoId','LEFT');
		$this->db->join("bc_m_jns_aju e",'b.Id_aju=e.id_aju','LEFT');
		
		return $this->db->count_all_results();
	}

///////////////
	function get_datatables2($selected,$nm_tabel,$nm_coloum,$orderby,$where,$where_in,$tipe,$kriteria,$job,$nm_tabel2,$kolom1,$kolom2)
	{
		
		$this->db->select($selected);
	    $this->db->from($nm_tabel);
		$this->db->join($nm_tabel2,$kolom1.'='.$kolom2,'LEFT');
		$this->db->join("tm_typeclearance c",'b.type_clearance=c.TypeClearance','LEFT');
		$this->db->join("statusproses d",'b.TrackingStatus=d.NoId','LEFT');
		$this->db->join("bc_m_jns_aju e",'b.Id_aju=e.id_aju','LEFT');
		//$this->db->group_by('a.Name'); 
		$this->_get_datatables_query2($nm_coloum,$orderby,$where,$where_in,$tipe,$kriteria,$job);	
        if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
private function _get_datatables_query2($nm_coloum,$orderby,$where,$where_in,$tipe,$kriteria,$job){
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
            	// $this->db->group_by('a.Name'); 
             $this->db->order_by($column[$_POST['order'][$n]['column']], $_POST['order'][$n]['dir']); 
             $n++;
            }
			//$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($orderby))
		{
			 //$this->db->group_by('a.Name'); 
			$order = $orderby;
			$this->db->order_by(key($order), $order[key($order)]);
			
		}
		
		if($where != ''){
			$array = explode(',', $job);
											
								if($kriteria=='start'){
										foreach($array as $key => $value) {
											if($value =='') {
												 	$data='rafles';
												} else {
													$data=$value;
												}
													$this->db->or_like($tipe, $data,'after');
													$this->db->where($where);
											}
										
									} else if($kriteria=='end'){
										foreach($array as $key => $value) {
											if($value =='') {
												 	$data='rafles';
												} else {
													$data=$value;
												}
													$this->db->or_like($tipe, $data,'before');												
													$this->db->where($where);
											}
									} else if($kriteria=='contains'){
										foreach($array as $key => $value) {
											if($value =='') {
												 	$data='rafles';
												} else {
													$data=$value;
												}
													$this->db->or_like($tipe, $data,'both');												
													$this->db->where($where);
											}	
									} else if($kriteria=='notcontains'){
										foreach($array as $key => $value) {
											if($value =='') {
												 	$data='rafles';
												} else {
													$data=$value;
												}
													$this->db->not_like($tipe, $data,'after');												
													$this->db->where($where);
											}
									} else if($kriteria=='equals'){
										$kondisi=$this->db->where_in($tipe,$where_in);										
										$this->db->where($where);
									} else if($kriteria=='notequals'){
										$kondisi=$this->db->where_not_in($tipe,$where_in);									
										$this->db->where($where);	
									}	
			//$this->db->where($where); 
			//$this->db->where_in($tipe,$where_in); 
			//RIGHT(b.hawb,1) in $digit and b.TrackingStatus in $rcode and ( b.type_clearance in $type_clear  or b.Id_aju in $pmk182 )
		}
}
public function count_all2($nm_tabel,$nm_coloum,$nm_tabel2,$kolom1,$kolom2)
	{
	    $this->db->from($nm_tabel);
		$this->db->join($nm_tabel2,$kolom1.'='.$kolom2,'LEFT');
		$this->db->join("tm_typeclearance c",'b.type_clearance=c.TypeClearance','LEFT');
		$this->db->join("statusproses d",'b.TrackingStatus=d.NoId','LEFT');
		$this->db->join("bc_m_jns_aju e",'b.Id_aju=e.id_aju','LEFT');
		return $this->db->count_all_results();
}
	function count_filtered2($nm_tabel,$nm_coloum,$orderby,$where,$where_in,$tipe,$kriteria,$job,$nm_tabel2,$kolom1,$kolom2)
	{
		$this->_get_datatables_query2($nm_coloum,$orderby,$where,$where_in,$tipe,$kriteria,$job);
	    $this->db->from($nm_tabel);
		$this->db->join($nm_tabel2,$kolom1.'='.$kolom2,'LEFT');
		$this->db->join("tm_typeclearance c",'b.type_clearance=c.TypeClearance','LEFT');
		$this->db->join("statusproses d",'b.TrackingStatus=d.NoId','LEFT');
		$this->db->join("bc_m_jns_aju e",'b.Id_aju=e.id_aju','LEFT');
		
		return $this->db->count_all_results();
	}

}