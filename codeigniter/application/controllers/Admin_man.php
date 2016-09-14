<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_man extends MY_Controller {

	public function __construct() {
		
		parent::__construct ('admin');
		$this->load->helper('admin_helper');
		Admin_Helper::ins()->adminLogin();
		$this->load->model ('admin_model');
	}

	public function index(){
		$resp['curentMenu'] = 0;
		$this->template->load('admin/index', $resp);
	}

	public function businessAreas(){
		$this->load->model ('businessAreas_model');
		$uri_segment_page = 3;
		$cfg_page = $this->load_pagination("admin_man/businessAreas/", $uri_segment_page);
		$page = ($this->uri->segment($uri_segment_page)) ? $this->uri->segment($uri_segment_page) : 0;

		$resp['businessAreas'] = $this->businessAreas_model->getAllAreas(10);
		$this->pagination->initialize($cfg_page);
		$resp['pagination'] = $this->pagination->create_links();
		$resp['curentMenu'] = 1;
		$this->template->load('admin/businessAreas', $resp);
	}

	public function business_alter_status($business_id, $status_cur){
		$this->load->model ('businessAreas_model');
		$params['id'] = $business_id;
		if($status_cur == 1)
			$params['status'] = 0;
		else
			$params['status'] = 1;
		$rlt = $this->businessAreas_model->save($params);
		redirect(base_url('/admin_man/businessAreas/'.$product_id));
	}

	public function businessAreas_form($id = 0){
		$this->load->model ('businessAreas_model');
		$this->load->model ('product_model');

		if($this->gpost('submit', null) != null){
			$rlt = $this->business_save();
			if($rlt)
				Admin_Helper::ins()->setMessage('Your item was saved successfully.', 'success');
			else
				Admin_Helper::ins()->setMessage('Your item was saved unsuccessfully.', 'danger');
			redirect(base_url('/admin_man/businessAreas'));
		}

		$businessAreas = $this->businessAreas_model->getById($id);

		if($id != 0 && $businessAreas == null)
			show_404();
		if($businessAreas == null)
			$businessAreas = new BusinessAreas_model();
		$resp['curentMenu'] = 1;
		$resp['num_product'] = $this->product_model->getNumProductBuArea($id);
		$resp['businessAreas'] = $businessAreas;
		$this->template->load('admin/businessAreas_form', $resp);
	}

	public function businessAreas_remove($id){
		$this->load->model ('businessAreas_model');
		$this->businessAreas_model->delete($id);
		Admin_Helper::ins()->setMessage('Your item was removed successfully.', 'success');
		redirect(base_url('/admin_man/businessAreas'));
	}


	private function business_save(){
		$params['id'] = $this->gpost('id', null);
		$params['code_areas'] 	= $this->gpost('code_areas', '');
		$params['vn_name_areas'] 	= $this->gpost('vn_name_areas', '');
		$params['phone_areas'] 	= $this->gpost('phone_areas', '');
		$params['description'] 	= $this->gpost('description', '');
		$params['facebook_areas'] 	= $this->gpost('facebook_areas', '');
		$params['twitter_areas'] 	= $this->gpost('twitter_areas', '');
		$params['google_areas'] 	= $this->gpost('google_areas', '');
		$params['vn_address_areas'] 	= $this->gpost('vn_address_areas', '');
		$params['download_areas'] 	= $this->gpost('download_areas', '');
		$params['en_name_areas'] 	= $this->gpost('en_name_areas', '');
		$params['en_address_areas'] 	= $this->gpost('en_address_areas', '');
		$params['fax_areas'] 	= $this->gpost('fax_areas', '');
		$params['link_areas'] 	= $this->gpost('link_areas', '#');
		$params['email_areas'] 	= $this->gpost('email_areas', '');
		$params['position'] 	= $this->gpost('position',0);
		$params['vn_branch_name'] 	= $this->gpost('vn_branch_name', '');
		$params['en_branch_name'] 	= $this->gpost('en_branch_name', '');

		if($_FILES['userfile']['size']){
			$upload = $this->do_upload_pricture_area();
			if(isset($upload['upload_data']))
				$params['image'] = '/upload/images/businessArea/'.$upload['upload_data']['file_name'];
			if(isset($upload['error']))
				Admin_Helper::ins()->setMessage($upload['error'], 'warning');
		}

		if($_FILES['userfilehead']['size']){
			$_FILES['userfile'] = &$_FILES['userfilehead'];
			$upload = $this->do_upload_pricture_area();
			if(isset($upload['upload_data']))
				$params['image_head'] = '/upload/images/businessArea/'.$upload['upload_data']['file_name'];
			if(isset($upload['error']))
				Admin_Helper::ins()->setMessage($upload['error'], 'warning');
		}

		$rlt = $this->businessAreas_model->save($params);
		return $rlt;
	}

	private function do_upload_pricture_area()
	{
		$file_name = Constant::$CONS_WEBSITE."_area_".time();
		$config['upload_path'] = UPLOAD_PATH.'/images/businessArea';
		$config['allowed_types'] = Constant::$ALLOW_PIC_UPLOAD;
		$config['max_size']	= Constant::$LIMIT_PIC_UPLOAD;

		$config['file_name'] = $file_name;
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			return $error = array('error' => $this->upload->display_errors());
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			return $data;
		}
	}


	/*Start exe product*/


	/*manage schools*/
	public function products(){

		$this->load->model ('product_model');
		$uri_segment_page = 3;
		$cfg_page = $this->load_pagination("admin_man/products/", $uri_segment_page);
		$page = ($this->uri->segment($uri_segment_page)) ? $this->uri->segment($uri_segment_page) : 0;
		$resp['products'] = $this->product_model->getAllProduct(5);
		$this->pagination->initialize($cfg_page);
		$resp['pagination'] = $this->pagination->create_links();
		$resp['curentMenu'] = 2;
		$this->template->load('admin/products', $resp);
	}

	public function productsBusiArea($businessCode){

		$this->load->model ('product_model');
		$uri_segment_page = 3;
		$cfg_page = $this->load_pagination("admin_man/products/", $uri_segment_page);
		$page = ($this->uri->segment($uri_segment_page)) ? $this->uri->segment($uri_segment_page) : 0;
		$resp['products'] = $this->product_model->getProductByArea($businessCode);
		$this->pagination->initialize($cfg_page);
		$resp['pagination'] = $this->pagination->create_links();
		$resp['curentMenu'] = 2;
		$this->template->load('admin/products', $resp);
	}

	public function product_form($id = 0){
		$this->load->model ('product_model');
		$this->load->model ('businessAreas_model');

		if($this->gpost('submit', null) != null){
			$rlt = $this->product_save();
			
			if($rlt)
				Admin_Helper::ins()->setMessage('Your item was saved successfully.', 'success');
			else
				Admin_Helper::ins()->setMessage('Your item was saved unsuccessfully.', 'danger');
			redirect(base_url('/admin_man/products'));
		}

		$product = $this->product_model->getById($id);

		if($id != 0 && $product == null)
			show_404();
		if($product == null)
			$product = new Product_model();
		$resp['comboArea'] = $this->businessAreas_model->getAllAreasComboBox();
		$resp['product'] = $product;
		$resp['curentMenu'] = 2;
		$this->template->load('admin/product_form', $resp);
	}

	public function product_alter_status($product_id, $status_cur){
		$this->load->model ('product_model');
		$params['id'] = $product_id;
		if($status_cur == 1)
			$params['status'] = 0;
		else
			$params['status'] = 1;
		$rlt = $this->product_model->save($params);
		redirect(base_url('/admin_man/products'));
	}

	public function product_remove($id){
		$this->load->model ('product_model');
		$this->product_model->delete($id);
		Admin_Helper::ins()->setMessage('Your item was removed successfully.', 'success');
		redirect(base_url('/admin_man/products'));
	}

	private function product_save(){
		$params['id'] = $this->gpost('id', null);
		$params['code_product'] = $this->gpost('code_product', '');
		$params['name'] = $this->gpost('name', '');
		$params['business_area'] = $this->gpost('business_area', '');
		$params['description'] = $this->gpost('description', '');
		$params['product_intro'] = $this->gpost('introduction', '');
		$params['cur_price'] = $this->gpost('cur_price', '');
		$params['old_price'] = $this->gpost('old_price', '');
		$params['discount_percent'] = $this->gpost('discount_percent', '');

		if($_FILES['image']['size']){
			$_FILES['userfile'] = &$_FILES['image'];
			$upload = $this->do_upload_product(0);
			if(isset($upload['upload_data']))
				$params['image'] = '/upload/images/products/'.$upload['upload_data']['file_name'];
			if(isset($upload['error']))
				Admin_Helper::ins()->setMessage($upload['error'], 'warning');
		}

		if($_FILES['thumn_img']['size']){
			$_FILES['userfile'] = &$_FILES['thumn_img'];
			$upload = $this->do_upload_product(1);
			if(isset($upload['upload_data']))
				$params['thumn_img'] = '/upload/images/products/thumnImg/'.$upload['upload_data']['file_name'];
			if(isset($upload['error']))
				Admin_Helper::ins()->setMessage($upload['error'], 'warning');
		}

		
		$rlt = $this->product_model->save($params);
		return $rlt;
	}

	private function do_upload_product($type)
	{
		if($type == 0){
			$config['upload_path'] = UPLOAD_PATH.'/images/products';
		}else{
			$config['upload_path'] = UPLOAD_PATH.'/images/products/thumnImg';
		}
		$config['allowed_types'] = Constant::$ALLOW_PIC_UPLOAD;
		$config['max_size']	= Constant::$LIMIT_PIC_UPLOAD;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			
			return $error = array('error' => $this->upload->display_errors());
		}
		else
		{
			if($type == 0){
				$this->load->helper("url");
				$pathOldImg = $this->gpost('oldImg', '');
			}else{
				$this->load->helper("url");
				$pathOldImgThumn = $this->gpost('oldThumnImg', '');
			}
			$data = array('upload_data' => $this->upload->data());
			return $data;
		}
	}

	/*End executive product */
}