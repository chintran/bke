<?php
class Product_model extends CI_Model{
	
	protected $_name = 'cs_products';
	var $id;
	var $name;
	var $code_product;
	var $business_area;
	var $image;
	var $thumn_img;
	var $description;
	var $product_intro;
	var $cur_price;
	var $old_price;
	var $discount_percent;
	var $status;
	var $number_sale;

	function Product_model(){
		parent::__construct();
		$this->load->database();
	}
	function getNumProductBuArea($id){
		$sql = "SELECT count(id) as total FROM {$this->_name} 
				WHERE business_area = ".$this->db->escape($id);

		$query = $this->db->query($sql);
		return $query->row()->total;
	}

	function getById($id){
		$sql = "SELECT sc.*,ba.name_areas FROM {$this->_name} as sc
				LEFT JOIN cs_business_areas as ba ON sc.business_area = ba.id
		WHERE sc.id = ".$this->db->escape($id);
		$query = $this->db->query($sql);
		return $query->row(); 
	}

	function getAllProduct($limit){
		$sql = "SELECT sc.* ,ba.name_areas FROM {$this->_name} as sc 
				LEFT JOIN cs_business_areas as ba ON sc.business_area = ba.id
				order by name desc Limit 0, ".$limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getProductByArea($business_area){
		$sql = "SELECT sc.*,ba.name_areas FROM {$this->_name} as sc
				LEFT JOIN cs_business_areas as ba ON sc.business_area = ba.id
		WHERE business_area = ".$this->db->escape($business_area);
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

	/*Show to client function*/

	function getBestProduct($limit = 4){
		$sql = "SELECT sc.* FROM {$this->_name} as sc
				order by number_sale desc Limit 0, ".$limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getShowProductClient($limit){
		$sql = "SELECT sc.* FROM {$this->_name} as sc
				where status = 0 
				order by id asc Limit 0, ".$limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getShowProductAreaClient($idArea,$limit){
		$sql = "SELECT sc.* FROM {$this->_name} as sc
				where status = 0 and business_area = ".$idArea."
				order by id asc Limit 0, ".$limit;
		$query = $this->db->query($sql);
		return $query->result();
	}

}