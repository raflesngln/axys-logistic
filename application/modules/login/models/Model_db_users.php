<?php
/**
 * Created by PhpStorm.
 * User: wisnubaldas
 * Date: 12/28/16
 * Time: 2:06 PM
 */
class Model_db_users extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		//$this->dbusers = $this->load->database('dbusers', true);
    }
	//========================Get Header ========================
	public function getData($nmtabel)
	{
		$this->db->from($nmtabel);
		$query = $this->db->get();
		return $query->result();
	}

	//============search by id ========================
	public function getLogin($nmtabel,$username,$password)
	{
		$this->db->from($nmtabel);
		$this->db->where("Email",$username);
		$this->db->where("Password",$password);
		$query = $this->db->get();
		return $query->result();
	}	

	public function save($nmtabel,$data)
	{
		$this->db->insert($nmtabel, $data);
		return $this->db->insert_id();
	}
function delete_data($table,$kolom,$id)
	{
		$this->db->where($kolom,$id);
		$this->db->delete($table);
	}
//=====================login member cek============================
    function getCustom($kolom,$table,$where) 
	{
	$query=$this->db->query("select ".$kolom." from ".$table." $where");		
	return $query->result();
 	}
//====================UPDATE data=====================================	 
	    function update($table,$kolom,$id,$data)
	    {
	      $this->db->where($kolom,$id);
	      $ubah= $this->db->update($table,$data);
			return $ubah;
	 }
	 
function notif_count($table,$where) {
        $this->db->from($table);
		$this->db->where($where);
		$query = $this->db->get();
        return $query->num_rows();
/*		 $this->db->select('a.ticket_id, COUNT(object_id) as jml');
		 $this->db->group_by('user_id'); 
		 $this->db->order_by('ticket_id', 'desc'); 
		 $this->db->get('tablename', 10);*/
}

function getDataNotif($table) {
        $this->db->from($table);
        $this->db->order_by('ticket_id', 'DESC');
        $this->db->limit(10);
        $query = $this->db->get();
			if ($query->num_rows() >0) {
				return $query->result();
			}
}
 
//========================INSERT ========================
public function insert($table,$data) {
	 $this->db->insert($table,$data);
    }
	
}