<?php
class Menu_model extends CI_Model{
	
	
	protected $_name = 'cs_menu';
	var $id;
	var $vn_name_menu;
	var $en_name_menu;
	var $level_menu;
	var $parent_submenu_id;
	var $parent_submenu_name;
	var $menu_website;
	var $name_menu_website;
	var $image;
	var $position;
	var $status;

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

	function getAllMenu($level = 0){
		$sql = "SELECT * 
				FROM {$this->_name} as sc
				WHERE level_menu = ".$this->db->escape($level)
				." order by position asc";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAllMenuSub($level = 0){
		$sql = "SELECT * 
				FROM {$this->_name} as sc
				WHERE level_menu = ".$this->db->escape($level)
				." order by id, position asc";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAllMenuComboBox($level = 0){
		$sql = "SELECT * 
				FROM {$this->_name} as sc
				WHERE level_menu = ".$this->db->escape($level)
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
	function getAllMenuClient($limit){
		$sql = "SELECT * 
				FROM {$this->_name} as sc
				WHERE sc.status = 0
				order by id asc Limit 0, ".$limit;
		$query = $this->db->query($sql);
		return $query->result();
	}
	/*End */

	function getListForHome($keyshow = ''){
		$sql = "SELECT * 
				FROM {$this->_name} as sc
				WHERE parent_submenu_id IN  ( 
					SELECT id 
					FROM {$this->_name} 
					WHERE slug like '%".$keyshow
				."%' ) AND name_menu_website like '%".Constant::$CONS_WEBSITE."%'
				 AND status = 0 order by position asc";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getMenuBySlug($keyshow = ''){
		$sql = "SELECT * 
				FROM {$this->_name} as sc
				WHERE slug like '%".$keyshow
				."%' AND name_menu_website like '%".Constant::$CONS_WEBSITE."%'
				 AND status = 0 order by position asc";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAllMenuSubByParentMenu($level = 0,$articleId = 0){
		$sql = "SELECT * 
				FROM {$this->_name} as sc
				WHERE level_menu = ".$this->db->escape($level) ." AND parent_submenu_id = ".$articleId
				." order by id, position asc";
		$query = $this->db->query($sql);
		return $query->result();
	}

}