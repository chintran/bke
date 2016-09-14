<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends MY_Controller {

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
	/*Banner Manager*/
	public function bannerMagnager(){
		$this->load->model ('banner_model');
		$uri_segment_page = 3;
		$cfg_page = $this->load_pagination("menu/bannerMagnager/", $uri_segment_page);
		$page = ($this->uri->segment($uri_segment_page)) ? $this->uri->segment($uri_segment_page) : 0;
		$level_menu = 0;
		$resp['bannerMagnager'] = $this->banner_model->getAllbanner();
		$this->pagination->initialize($cfg_page);
		$resp['pagination'] = $this->pagination->create_links();
		$resp['curentMenu'] = 6;
		$this->template->load('admin/bannerMagnager', $resp);
	}

	public function banner_alter_status($banner_id, $status_cur){
		$this->load->model ('banner_model');
		$params['id'] = $banner_id;
		if($status_cur == 1)
			$params['status'] = 0;
		else
			$params['status'] = 1;
		$rlt = $this->banner_model->save($params);
		redirect(base_url('/menu/bannerMagnager/'.$product_id));
	}

	public function banner_form($id = 0){
		$this->load->model ('banner_model');
		$this->load->model ('businessAreas_model');

		if($this->gpost('submit', null) != null){
			$rlt = $this->banner_save();
			if($rlt)
				Admin_Helper::ins()->setMessage('Your item was saved successfully.', 'success');
			else
				Admin_Helper::ins()->setMessage('Your item was saved unsuccessfully.', 'danger');
			redirect(base_url('/menu/bannerMagnager'));
		}

		$banner = $this->banner_model->getById($id);
		$resp['businessAreasCategory'] = $this->businessAreas_model->getAllAreas();
		if($id != 0 && $banner == null)
			show_404();
		if($banner == null)
			$banner = new banner_model();
		$resp['curentMenu'] = 6;
		$resp['banner'] = $banner;
		$this->template->load('admin/banner_form', $resp);
	}

	public function banner_remove($id){
		$this->load->model ('banner_model');
		$this->banner_model->delete($id);
		Admin_Helper::ins()->setMessage('Your item was removed successfully.', 'success');
		redirect(base_url('/menu/bannerMagnager'));
	}


	private function banner_save(){
		$params['id'] = $this->gpost('id', null);
		$params['name_banner'] 	= $this->gpost('name_banner', '');
		$params['link_banner'] 	= $this->gpost('link_banner', '');
		$params['menu_website'] 	= $this->gpost('menu_website', '');
		$params['name_menu_website'] 	= $this->gpost('name_menu_website', '');
		$params['vn_caption_1'] 	= $this->gpost('vn_caption_1', '');
		$params['en_caption_1'] 	= $this->gpost('en_caption_1', '');
		$params['vn_caption_2'] 	= $this->gpost('vn_caption_2', '');
		$params['en_caption_2'] 	= $this->gpost('en_caption_2', '');
		
		if($_FILES['userfile']['size']){
			$upload = $this->do_upload_pricture_banner();
			if(isset($upload['upload_data']))
				$params['image'] = '/upload/images/banner/'.$upload['upload_data']['file_name'];
			if(isset($upload['error']))
				Admin_Helper::ins()->setMessage($upload['error'], 'warning');
		}

		$rlt = $this->banner_model->save($params);
		return $rlt;
	}

	private function do_upload_pricture_banner()
	{
		$file_name = Constant::$CONS_WEBSITE."_bn_".time();

		$config['upload_path'] = UPLOAD_PATH.'/images/banner';
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
	/*End banner manager*/
	/*Partner managerment*/
	public function partnerMagnager(){
		$this->load->model ('partner_model');
		$uri_segment_page = 3;
		$cfg_page = $this->load_pagination("menu/partnerMagnager/", $uri_segment_page);
		$page = ($this->uri->segment($uri_segment_page)) ? $this->uri->segment($uri_segment_page) : 0;
		$level_menu = 0;
		$resp['partnerMagnager'] = $this->partner_model->getAllPartner();
		$this->pagination->initialize($cfg_page);
		$resp['pagination'] = $this->pagination->create_links();
		$resp['curentMenu'] = 4;
		$this->template->load('admin/partnerMagnager', $resp);
	}

	public function partner_alter_status($partner_id, $status_cur){
		$this->load->model ('partner_model');
		$params['id'] = $partner_id;
		if($status_cur == 1)
			$params['status'] = 0;
		else
			$params['status'] = 1;
		$rlt = $this->partner_model->save($params);
		redirect(base_url('/menu/partnerMagnager'));
	}

	public function partner_form($id = 0){
		$this->load->model ('partner_model');

		if($this->gpost('submit', null) != null){
			$rlt = $this->partner_save();
			if($rlt)
				Admin_Helper::ins()->setMessage('Your item was saved successfully.', 'success');
			else
				Admin_Helper::ins()->setMessage('Your item was saved unsuccessfully.', 'danger');
			redirect(base_url('/menu/partnerMagnager'));
		}

		$partner = $this->partner_model->getById($id);

		if($id != 0 && $partner == null)
			show_404();
		if($partner == null)
			$partner = new partner_model();
		$resp['curentMenu'] = 4;
		$resp['partner'] = $partner;
		$this->template->load('admin/partner_form', $resp);
	}

	public function partner_remove($id){
		$this->load->model ('partner_model');
		$this->partner_model->delete($id);
		Admin_Helper::ins()->setMessage('Your item was removed successfully.', 'success');
		redirect(base_url('/menu/partnerMagnager'));
	}


	private function partner_save(){
		$params['id'] = $this->gpost('id', null);
		$params['name_partner'] 	= $this->gpost('name_partner', '');
		$params['link_partner'] 	= $this->gpost('link_partner', '');

		if($_FILES['userfile']['size']){
			$upload = $this->do_upload_pricture_partner();
			if(isset($upload['upload_data']))
				$params['image'] = '/upload/images/partner/'.$upload['upload_data']['file_name'];
			if(isset($upload['error']))
				Admin_Helper::ins()->setMessage($upload['error'], 'warning');
		}

		$rlt = $this->partner_model->save($params);
		return $rlt;
	}

	private function do_upload_pricture_partner()
	{
		$file_name = Constant::$CONS_WEBSITE."_partner_".time();

		$config['upload_path'] = UPLOAD_PATH.'/images/partner';
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

	/*End partner manager*/
	public function menuCategory(){

		$this->load->model ('menu_model');
		$uri_segment_page = 3;
		$cfg_page = $this->load_pagination("menu/menuCategory/", $uri_segment_page);
		$page = ($this->uri->segment($uri_segment_page)) ? $this->uri->segment($uri_segment_page) : 0;
		$level_menu = 0;
		$resp['menuCategory'] = $this->menu_model->getAllMenu($level_menu);
		$this->pagination->initialize($cfg_page);
		$resp['pagination'] = $this->pagination->create_links();
		$resp['curentMenu'] = 2;
		$this->template->load('admin/menuCategory', $resp);
	}

	public function menu_alter_status($menu_id, $status_cur){
		$this->load->model ('menu_model');
		$params['id'] = $menu_id;
		if($status_cur == 1)
			$params['status'] = 0;
		else
			$params['status'] = 1;
		$rlt = $this->menu_model->save($params);
		redirect(base_url('/menu/menuCategory'));
	}

	public function menuCategory_form($id = 0){
		$this->load->model ('menu_model');
		$this->load->model ('businessAreas_model');

		if($this->gpost('submit', null) != null){
			$rlt = $this->menu_save();
			if($rlt)
				Admin_Helper::ins()->setMessage('Your item was saved successfully.', 'success');
			else
				Admin_Helper::ins()->setMessage('Your item was saved unsuccessfully.', 'danger');
			redirect(base_url('/menu/menuCategory'));
		}

		$menuCategory = $this->menu_model->getById($id);

		if($id != 0 && $menuCategory == null)
			show_404();
		if($menuCategory == null)
			$menuCategory = new menu_model();
		$resp['curentMenu'] = 2;
		$resp['businessAreasCategory'] = $this->businessAreas_model->getAllAreas();
		$resp['menuCategory'] = $menuCategory;
		$this->template->load('admin/menuCategory_form', $resp);
	}

	public function menuCategory_remove($id){
		$this->load->model ('menu_model');
		$this->menu_model->delete($id);
		Admin_Helper::ins()->setMessage('Your item was removed successfully.', 'success');
		redirect(base_url('/menu/menuCategory'));
	}

	private function menu_save(){
		$params['id'] = $this->gpost('id', null);
		$params['vn_name_menu'] 	= $this->gpost('vn_name_menu', '');
		$params['en_name_menu'] 	= $this->gpost('en_name_menu', '');
		$params['level_menu'] 	= $this->gpost('level_menu', '0');
		$params['parent_submenu_id'] 	= $this->gpost('parent_submenu_id', '0');
		$params['menu_website'] 	= $this->gpost('menu_website', '');
		$params['name_menu_website'] 	= $this->gpost('name_menu_website', '');
		$params['position'] 	= $this->gpost('position', '');

		$rlt = $this->menu_model->save($params);
		return $rlt;
	}

	/*Start exe product*/

	/*Controller for sub menu*/

	public function subMenuCategory(){

		$this->load->model ('menu_model');
		$this->load->model ('article_model');

		$uri_segment_page = 3;
		$cfg_page = $this->load_pagination("menu/subMenuCategory/", $uri_segment_page);
		$page = ($this->uri->segment($uri_segment_page)) ? $this->uri->segment($uri_segment_page) : 0;
		$level_menu = 1;
		$resp['subMenuCategory'] = $this->menu_model->getAllMenuSub($level_menu);
		$resp['parentMenuCategory'] = $this->menu_model->getAllMenuComboBox($level_menu-1);

		$this->pagination->initialize($cfg_page);
		$resp['pagination'] = $this->pagination->create_links();
		$resp['curentMenu'] = 3;
		$resp['comboMenu'] = $this->article_model->getMenuComboBox();

		$this->template->load('admin/subMenuCategory', $resp);
	}

	public function subMenu_alter_status($menu_id, $status_cur){
		$this->load->model ('menu_model');
		$params['id'] = $menu_id;
		if($status_cur == 1)
			$params['status'] = 0;
		else
			$params['status'] = 1;
		$rlt = $this->menu_model->save($params);
		redirect(base_url('/menu/subMenuCategory'));
	}

	public function subMenuCategory_form($id = 0){
		$this->load->model ('menu_model');
		$this->load->model ('businessAreas_model');

		if($this->gpost('submit', null) != null){
			$rlt = $this->subMenu_save();
			if($rlt)
				Admin_Helper::ins()->setMessage('Your item was saved successfully.', 'success');
			else
				Admin_Helper::ins()->setMessage('Your item was saved unsuccessfully.', 'danger');
			redirect(base_url('/menu/subMenuCategory'));
		}
		$level_menu=1;
		$menuCategory = $this->menu_model->getById($id);

		if($id != 0 && $menuCategory == null)
			show_404();
		if($menuCategory == null)
			$menuCategory = new menu_model();
		$resp['curentMenu'] = 3;
		$resp['parentMenuCategory'] = $this->menu_model->getAllMenuComboBox($level_menu-1);
		$resp['businessAreasCategory'] = $this->businessAreas_model->getAllAreas();
		$resp['subMenuCategory'] = $menuCategory;
		$this->template->load('admin/subMenuCategory_form', $resp);
	}

	public function subMenuCategory_remove($id){
		$this->load->model ('menu_model');
		$this->menu_model->delete($id);
		Admin_Helper::ins()->setMessage('Your item was removed successfully.', 'success');
		redirect(base_url('/menu/subMenuCategory'));
	}


	private function subMenu_save(){
		$params['id'] = $this->gpost('id', null);
		$params['vn_name_menu'] 	= $this->gpost('vn_name_menu', '');
		$params['en_name_menu'] 	= $this->gpost('en_name_menu', '');
		$params['level_menu'] 	= $this->gpost('level_menu', '1');
		$params['parent_submenu_id'] 	= $this->gpost('parent_submenu_id', '0');
		$params['parent_submenu_name'] 	= $this->gpost('parent_submenu_name', '');
		$params['menu_website'] 	= $this->gpost('menu_website', '');
		$params['name_menu_website'] 	= $this->gpost('name_menu_website', '');
		$params['position'] 	= $this->gpost('position', '');

		if($_FILES['userfile']['size']){
			$upload = $this->do_upload_pricture_submenu();
			if(isset($upload['upload_data']))
				$params['image'] = '/upload/images/submenu/'.$upload['upload_data']['file_name'];
			if(isset($upload['error']))
				Admin_Helper::ins()->setMessage($upload['error'], 'warning');
		}

		$rlt = $this->menu_model->save($params);
		return $rlt;
	}

	private function do_upload_pricture_submenu()
	{
		$file_name = Constant::$CONS_WEBSITE."_submenu_".time();

		$config['upload_path'] = UPLOAD_PATH.'/images/submenu';
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

	public function searhSubMenuAjax(){
		$this->load->model ('menu_model');

		$articleId	= $this->gpost('menuArticleId', 0);
		$level_menu = 1;
		if($articleId == 0){
			$lstSubmenu = $this->menu_model->getAllMenuSub($level_menu);
		}else{
			$lstSubmenu = $this->menu_model->getAllMenuSubByParentMenu($level_menu,$articleId);
		}

		$data = json_encode($lstSubmenu);

    	
    	echo $data;
	}

}