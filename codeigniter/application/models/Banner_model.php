<?php
class Banner_model extends CI_Model{
	
	
	protected $_name = 'cs_banner';
	var $id;
	var $name_banner;
	var $link_banner;
	var $image;
	var $status;
	var $menu_website;
	var $name_menu_website;
	var $vn_caption_1;
	var $en_caption_1;
	var $vn_caption_2;
	var $en_caption_2;

	function Banner_model(){
		parent::__construct();
		$this->load->database();
	}

	function getById($id){
		$sql = "SELECT sc.* FROM {$this->_name} as sc
		WHERE id = ".$this->db->escape($id);
		$query = $this->db->query($sql);
		return $query->row(); 
	}

	function getAllbanner(){
		$sql = "SELECT * 
				FROM {$this->_name} as sc
				order by id asc";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getBannerForWeb(){
		$sql = "SELECT * 
				FROM {$this->_name} as sc
				where status = 0 AND name_menu_website like '%".Constant::$CONS_WEBSITE."%' 
				order by id asc";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAllbannerComboBox($level = 0){
		$sql = "SELECT * 
				FROM {$this->_name} as sc
				WHERE level_banner = ".$this->db->escape($level)
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
	function getAllbannerClient($limit){
		$sql = "SELECT * 
				FROM {$this->_name} as sc
				WHERE sc.status = 0
				order by id asc Limit 0, ".$limit;
		$query = $this->db->query($sql);
		return $query->result();
	}
	/*End */

}