<?php
class Partner_model extends CI_Model{
	
	
	protected $_name = 'cs_partner';
	var $id;
	var $name_partner;
	var $link_partner;
	var $image;
	var $status;

	function Partner_model(){
		parent::__construct();
		$this->load->database();
	}

	function getById($id){
		$sql = "SELECT sc.* FROM {$this->_name} as sc
		WHERE id = ".$this->db->escape($id);
		$query = $this->db->query($sql);
		return $query->row(); 
	}

	function getAllPartner(){
		$sql = "SELECT * 
				FROM {$this->_name} as sc
				where status = 0
				order by id asc";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAllPartnerComboBox($level = 0){
		$sql = "SELECT * 
				FROM {$this->_name} as sc
				WHERE level_Partner = ".$this->db->escape($level)
				." AND status = 0 order by id asc";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function save($params = null){
		
		if(empty($params['id'])){
			$this->db->insert($this->_name, $params);
			return $this->db->insert_id();
		}else{
			$this->db->where('id', $params['id']);
			return $this->db->update($this->_name, $params); 
		}
		
	}

	function delete($id){
		return $this->db->delete($this->_name, array('id' => $id)); 
	}

	/*function for show front*/
	function getAllPartnerClient($limit){
		$sql = "SELECT * 
				FROM {$this->_name} as sc
				WHERE sc.status = 0
				order by id asc Limit 0, ".$limit;
		$query = $this->db->query($sql);
		return $query->result();
	}
	/*End */

}