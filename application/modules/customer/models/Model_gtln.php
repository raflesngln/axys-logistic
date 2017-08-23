<?php

class Model_gtln extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->gtln = $this->load->database('gtln', true);
    }
	//========================Get Header ========================
	public function getData($nmtabel)
	{
		$this->gtln->from($nmtabel);
		//$this->gtln->where($key,$id);
		$query = $this->gtln->get();
		return $query->result();
	}

	//============search by id ========================
	public function getLogin($nmtabel,$username,$password)
	{
		$this->gtln->from($nmtabel);
		$this->gtln->where("Email",$username);
		$this->gtln->where("Password",$password);
		$query = $this->gtln->get();
		return $query->result();
	}	


//=====================login member cek============================
    function getCustom($kolom,$table,$where) 
	{
	$query=$this->gtln->query("select ".$kolom." from ".$table." $where");		
	return $query->result();
 	}
//====================UPDATE data=====================================	 
	    function update($table,$kolom,$id,$data)
	    {
	      $this->gtln->where($kolom,$id);
	       $ubah= $this->gtln->update($table,$data);
			return $ubah;
	    }

//========================INSERT ========================
public function insert($table,$data) {
	 $this->gtln->insert($table,$data);
    }
	
	
//-- for 2 choosen ---///////////////////////////////////////////
private function _get_datatables_query2($nm_coloum,$orderby,$where)
	{	
		$i = 0;
		foreach ($nm_coloum as $item) 
		{
			if($_POST['search']['value'])
				($i===0) ? $this->gtln->like($item, $_POST['search']['value']) : $this->gtln->or_like($item, $_POST['search']['value']);
			$column[$i] = $item;
			$i++;
		}
		
		if(isset($_POST['order']))
		{
				$n=0;
            $sort=$_POST['order'];
            foreach($sort as $i =>$val){
             $this->gtln->order_by($column[$_POST['order'][$n]['column']], $_POST['order'][$n]['dir']);   
             $n++;
            }
			//$this->gtln->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($orderby))
		{
			
			$order = $orderby;
			$this->gtln->order_by(key($order), $order[key($order)]);
			
			
		}
		
		if($where != ''){
        $this->gtln->where($where); 
		
		}
}

function get_datatables2($selected,$nm_tabel,$nm_coloum,$orderby,$where,$nm_tabel2,$kolom1,$kolom2)
	{
		
		$this->gtln->select($selected);
	    $this->gtln->from($nm_tabel);
		//$this->gtln->join($nm_tabel2,$kolom1.'='.$kolom2,'LEFT');
		
		$this->_get_datatables_query2($nm_coloum,$orderby,$where);
	
        if($_POST['length'] != -1)
		$this->gtln->limit($_POST['length'], $_POST['start']);
		$query = $this->gtln->get();
		return $query->result();
}

public function count_all2($nm_tabel,$nm_coloum,$nm_tabel2,$kolom1,$kolom2)
	{
		
		$this->gtln->from($nm_tabel);
		//$this->gtln->join($nm_tabel2,$kolom1.'='.$kolom2,'LEFT');
		return $this->gtln->count_all_results();
}

public function count_filtered2($nm_tabel,$nm_coloum,$orderby,$where,$nm_tabel2,$kolom1,$kolom2)
	{
		$this->_get_datatables_query2($nm_coloum,$orderby,$where);
        $this->gtln->from($nm_tabel);
		//$this->gtln->join($nm_tabel2,$kolom1.'='.$kolom2,'LEFT');
		

		return $this->gtln->count_all_results();
}

		//=====================get data all============================
    public function getdatapaging($kolom,$tabel,$where)
    {
        $query = $this->gtln->query("select ".$kolom." from ".$tabel." $where");
		return $query->result();
    }
	
	//=============== Hitung isi tabel===============================
		function hitung_isi_tabel($kolom,$tabel,$where)
	{
		$q = $this->gtln->query("SELECT ".$kolom." from ".$tabel." $where");
		return $q;
	}
public function get_gtln($limit) {
				$tgl1='2017-06-27';
				$tgl2='2017-06-28';
			$sql = "SELECT *
					FROM bc_t_shipment a
					WHERE LEFT(a.flight_date,10) >= '$tgl1' AND LEFT(a.flight_date,10) <= '$tgl2'  order by a.hawb $limit";
		
			$query = $this->gtln->query($sql);
		
			$all_data = array();
			foreach ($query->result() as $row) {
				$users[] = array(
					'hawb'   => $row->hawb,
					'mawb'  => $row->mawb
				);
			}
		
			return $all_data;
		}
	
}