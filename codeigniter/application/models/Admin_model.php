<?php
class Admin_model extends CI_Model{
	
	protected $_name = 'tbl_admin';
	protected $_primary = 'id';

	function Admin_model(){
		parent::__construct();
		$this->load->database();
	}

	function check_user($username, $password){
	
		$sql = "SELECT * FROM {$this->_name} where username=".$this->db->escape($username)." 
		AND password='".md5($password)."' ";

		$query = $this->db->query($sql);
		return $query->row();
	
	}

	function user_save($params = null){
		
		if(empty($params['id'])){
			$this->db->insert($this->_name, $params);
			return $this->db->insert_id();
		}else{
			$this->db->where('id', $params['id']);
			return $this->db->update($this->_name, $params); 
		}
		
	}
}