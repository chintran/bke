<?php
class BusinessAreas_model extends CI_Model{
	
	
	protected $_name = 'cs_business_areas';
	var $id;
	var $code_areas;
	var $vn_name_areas;
	var $vn_address_areas;
	var $en_name_areas;
	var $en_address_areas;
	var $phone_areas;
	var $image_head;
	var $image;
	var $vn_branch_name;
	var $en_branch_name;
	var $position;
	var $description;
	var $facebook_areas;
	var $twitter_areas;
	var $google_areas;
	var $youtub_areas;
	var $download_areas;
	var $status;
	var $slug;
	var $fax_areas;
	var $link_areas;
	var $email_areas;

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

	function getByArea($areas){
		$sql = "SELECT sc.* FROM {$this->_name} as sc
		WHERE code_areas like '%".$areas."%'";
		$query = $this->db->query($sql);
		return $query->row(); 
	}

	function getAllAreas(){
		$sql = "SELECT * 
				FROM {$this->_name} as sc
				where status = 0
				order by position asc ";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAllAreasForContact(){
		$sql = "SELECT * 
				FROM {$this->_name} as sc
				where status = 0 AND code_areas = '".Constant::$CONS_WEBSITE
				."' order by position asc ";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAllAreasComboBox(){
		$sql = "SELECT sc.id,sc.name_areas
				FROM {$this->_name} as sc
				WHERE status = 0
				order by name_areas desc";
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
	function getAllAreasClient($limit){
		$sql = "SELECT * 
				FROM {$this->_name} as sc
				WHERE sc.status = 0
				order by id asc Limit 0, ".$limit;
		$query = $this->db->query($sql);
		return $query->result();
	}
	/*End */

}