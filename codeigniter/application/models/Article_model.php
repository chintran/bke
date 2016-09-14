<?php
class Article_model extends CI_Model{
	
	
	protected $_name = 'cs_article';
	
	var $id;
	var $vn_title_name;
	var $en_title_name;
	var $menu_article_id;
	var $sub_menu_article_id;
	var $position;
	var $article_website;
	var $name_article_website;
	var $menu_article_name;
	var $sub_menu_article_name;
	var $image;
	var $vn_description;
	var $en_description;
	var $status;
	var $add_content_tab;
	var $vn_tab_introduce;
	var $en_tab_introduce;
	var $vn_tab_tech;
	var $en_tab_tech;
	var $vn_tab_using;
	var $en_tab_using;
	var $vn_tab_link;
	var $en_tab_link;
	var $add_img_relate;
	var $image1;
	var $image2;
	var $image3;
	var $image4;
	var $image5;
	var $image6;
	var $image7;
	var $vn_tab_1;
	var $en_tab_1;
	var $vn_tab_2;
	var $en_tab_2;
	var $vn_tab_3;
	var $en_tab_3;
	var $vn_tab_4;
	var $en_tab_4;
	var $vn_synopsis_description;
	var $en_synopsis_description;

	function Article_model(){
		parent::__construct();
		$this->load->database();
	}

	function getById($id){
		$sql = "SELECT sc.* FROM {$this->_name} as sc
		WHERE status = 0 AND id = ".$this->db->escape($id);
		$query = $this->db->query($sql);
		return $query->row(); 
	}

	function getByIdForEdit($id){
		$sql = "SELECT sc.* FROM {$this->_name} as sc
		WHERE id = ".$this->db->escape($id);
		$query = $this->db->query($sql);
		return $query->row(); 
	}


	function getAllArticle($level = 0){
		$sql = "SELECT * 
				FROM {$this->_name} as sc
				order by menu_article_id, position asc";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getAllArticleByMenuSubmenu($menu_article_id = 0,$sub_menu_article_id = 0){
		$sql = "SELECT * 
				FROM {$this->_name} as sc
				where menu_article_id = ".$menu_article_id;
		if($sub_menu_article_id != 0){
			$sql.=" AND sub_menu_article_id = ".$sub_menu_article_id ;
		} 
		$sql.= " order by menu_article_id,sub_menu_article_id, position asc";
		
		$query = $this->db->query($sql);

		return $query->result();
	}

	function getMenuComboBox($level = 0){
		$sql = "SELECT * 
				FROM cs_menu as sc
				WHERE level_menu = ".$this->db->escape($level)
				." AND status = 0 order by position asc";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getSubMenuComboBox($parentId = 0){
		$sql = "SELECT * 
				FROM cs_menu as sc
				WHERE level_menu != 0 AND status = 0 AND parent_submenu_id =".$parentId."   order by id asc";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getSubMenuDisplay($parentId = 0){
		$sql = "SELECT * 
				FROM cs_menu as sc
				WHERE level_menu != 0 AND status = 0 AND name_menu_website like '%".Constant::$CONS_WEBSITE."%' AND parent_submenu_id =".$parentId."   order by id asc";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function searchArticle($keySearch = ''){
		$sql = "SELECT sc.* FROM {$this->_name} as sc
		WHERE vn_title_name like '% ".$keySearch."%'";
		$query = $this->db->query($sql);
		return $query->row(); 
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
	function getAllArticleClient($limit){
		$sql = "SELECT * 
				FROM {$this->_name} as sc
				WHERE sc.status = 0
				order by id asc Limit 0, ".$limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getArticleShow($sub_menu_article_id = 0, $limit = 1){
		$sql = "SELECT * 
				FROM {$this->_name} as sc
				WHERE sc.status = 0 AND sub_menu_article_id = ".$sub_menu_article_id."
				AND name_article_website like '%".Constant::$CONS_WEBSITE."%' 
				order by id asc Limit 0, ".$limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getArticleShowAll($sub_menu_article_id = 0){
		$sql = "SELECT * 
				FROM {$this->_name} as sc
				WHERE sc.status = 0 AND sub_menu_article_id = ".$sub_menu_article_id."
				AND name_article_website like '%".Constant::$CONS_WEBSITE."%' 
				order by id asc ";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getArticleShowByPage($sub_menu_article_id = 0,$page = 0){

		$offset = $page*Constant::$PER_ROW_PAGE;

		$sql = "SELECT * 
				FROM {$this->_name} as sc
				WHERE sc.status = 0 AND sub_menu_article_id = ".$sub_menu_article_id."
				AND name_article_website like '%".Constant::$CONS_WEBSITE."%' 
				order by id asc limit ".$offset.",".Constant::$PER_ROW_PAGE;
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getArticleShowHome($menu_article_id = 0,$limit = 1){

		$sql = "SELECT * 
				FROM {$this->_name} as sc
				WHERE sc.status = 0 AND menu_article_id = ".$menu_article_id."
				AND name_article_website like '%".Constant::$CONS_WEBSITE."%' 
				order by id desc limit 0 ,".$limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getArticleCountShowAll($sub_menu_article_id = 0){
		$sql = "SELECT count(*) as total_record
				FROM {$this->_name} as sc
				WHERE sc.status = 0 AND sub_menu_article_id = ".$sub_menu_article_id."
				AND name_article_website like '%".Constant::$CONS_WEBSITE."%' 
				order by id asc ";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getArticleShowAllByMenuId($menu_article_id = 0){
		$sql = "SELECT * 
				FROM {$this->_name} as sc
				WHERE sc.status = 0 AND menu_article_id = ".$menu_article_id."
				AND name_article_website like '%".Constant::$CONS_WEBSITE."%' 
				order by position asc ";
		$query = $this->db->query($sql);
		return $query->result();
	}

	/*End */

}