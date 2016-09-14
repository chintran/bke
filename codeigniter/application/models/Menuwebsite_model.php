<?php
class Menuwebsite_model extends CI_Model{
	
	
	protected $_name = 'cs_menu_website';
	var $id;
	var $parent_menu_id;
	var $menu_id;
	var $website_id;
	var $level_menu;

	function Product_model(){
		parent::__construct();
		$this->load->database();
	}

	function getById($id){
		$sql = "SELECT sc.* FROM {$this->_name} as sc
		WHERE id = ".$this->db->escape($id);
		$query = $this->db->query($sql);
		return $query->row(); 
	}

	function getAllMenu($limit){
		$sql = "SELECT * 
				FROM {$this->_name} as sc 
				order by vn_name_menu desc Limit 0, ".$limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAllMenuComboBox(){
		$sql = "SELECT sc.id,sc.vn_name_menu
				FROM {$this->_name} as sc
				WHERE status = 0
				order by vn_name_menu desc";
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
	function getAllMenuClient($limit){
		$sql = "SELECT * 
				FROM {$this->_name} as sc
				WHERE sc.status = 0
				order by id asc Limit 0, ".$limit;
		$query = $this->db->query($sql);
		return $query->result();
	}
	/*End */

}