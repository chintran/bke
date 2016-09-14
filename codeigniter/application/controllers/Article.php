<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends MY_Controller {

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

	/*End partner manager*/
	public function articleMagnager(){

		$this->load->model ('article_model');
		$uri_segment_page = 3;
		$cfg_page = $this->load_pagination("article/articleMagnager/", $uri_segment_page);
		$page = ($this->uri->segment($uri_segment_page)) ? $this->uri->segment($uri_segment_page) : 0;
		$resp['articleList'] = $this->article_model->getAllArticle();

		$this->pagination->initialize($cfg_page);
		$resp['pagination'] = $this->pagination->create_links();
		$resp['curentMenu'] = 5;
		$resp['comboMenu'] = $this->article_model->getMenuComboBox();

		$this->template->load('admin/articleList', $resp);
	}

	public function article_alter_status($menu_id, $status_cur){

		$this->load->model ('article_model');
		$params['id'] = $menu_id;
		if($status_cur == 1)
			$params['status'] = 0;
		else
			$params['status'] = 1;
		$rlt = $this->article_model->save($params);
		redirect(base_url('/article/articleMagnager'));
	}

	public function article_form($id = 0){
		$this->load->model ('article_model');
		$this->load->model ('businessAreas_model');
		
		if($this->gpost('submit', null) != null){
			$rlt = $this->article_save();
			if($rlt)
				Admin_Helper::ins()->setMessage('Your item was saved successfully.', 'success');
			else
				Admin_Helper::ins()->setMessage('Your item was saved unsuccessfully.', 'danger');
			redirect(base_url('/article/articleMagnager'));
		}

		$articleItem = $this->article_model->getByIdForEdit($id);

		if($id != 0 && $articleItem == null)
			show_404();
		if($articleItem == null)
			$articleItem = new article_model();
		$resp['curentMenu'] = 5;
		$resp['comboMenu'] = $this->article_model->getMenuComboBox();
		if($articleItem->menu_article_id != ''){
			$resp['comboSubMenu'] = $this->article_model->getSubMenuComboBox($articleItem->menu_article_id);
		}
		$resp['businessAreasCategory'] = $this->businessAreas_model->getAllAreas();
		$resp['articleItem'] = $articleItem;
		$this->template->load('admin/article_form', $resp);
	}

	public function article_remove($id){
		$this->load->model ('article_model');
		$this->article_model->delete($id);
		Admin_Helper::ins()->setMessage('Your item was removed successfully.', 'success');
		redirect(base_url('/article/articleMagnager'));
	}


	private function article_save(){
		$params['id'] = $this->gpost('id', null);
		$params['vn_title_name'] 	= $this->gpost('vn_title_name', '');
		$params['en_title_name'] 	= $this->gpost('en_title_name', '');
		$params['menu_article_id'] 	= $this->gpost('menu_article_id', '0');
		$params['sub_menu_article_id'] 	= $this->gpost('sub_menu_article_id', '0');
		$params['position'] 	= $this->gpost('position', '0');
		$params['article_website'] 	= $this->gpost('article_website', '');
		$params['name_article_website'] 	= $this->gpost('name_article_website', '0');
		$params['menu_article_name'] 	= $this->gpost('menu_article_name', '');
		$params['sub_menu_article_name'] 	= $this->gpost('sub_menu_article_name', '');
		$params['vn_description'] 	= $this->gpost('vn_edit_description', '');
		$params['en_description'] 	= $this->gpost('en_edit_description', '');
		$params['vn_tab_introduce'] 	= $this->gpost('vn_tab_introduce', '');
		$params['en_tab_introduce'] 	= $this->gpost('en_tab_introduce', '');
		$params['vn_tab_tech'] 	= $this->gpost('vn_tab_tech', '');
		$params['en_tab_tech'] 	= $this->gpost('en_tab_tech', '');
		$params['vn_tab_using'] 	= $this->gpost('vn_tab_using', '');
		$params['en_tab_using'] 	= $this->gpost('en_tab_using', '');
		$params['vn_tab_link'] 	= $this->gpost('vn_tab_link', '');
		$params['en_tab_link'] 	= $this->gpost('en_tab_link', '');
		$params['vn_synopsis_description'] 	= $this->gpost('vn_synopsis_description', '');
		$params['en_synopsis_description'] 	= $this->gpost('en_synopsis_description', '');


		$params['vn_tab_1'] 	= $this->gpost('vn_tab_1', '');
		$params['en_tab_1'] 	= $this->gpost('en_tab_1', '');
		$params['vn_tab_2'] 	= $this->gpost('vn_tab_2', '');
		$params['en_tab_2'] 	= $this->gpost('en_tab_2', '');
		$params['vn_tab_3'] 	= $this->gpost('vn_tab_3', '');
		$params['en_tab_3'] 	= $this->gpost('en_tab_3', '');
		$params['vn_tab_4'] 	= $this->gpost('vn_tab_4', '');
		$params['en_tab_4'] 	= $this->gpost('en_tab_4', '');
		

		$params['add_content_tab'] 	= $this->gpost('add_content_tab');
		$params['add_img_relate'] 	= $this->gpost('add_img_relate');
		if($params['add_content_tab'] != ''){
			$params['add_content_tab'] = 1;
		}else{
			$params['add_content_tab'] = 0;
		}

		$params['status'] = $this->gpost('status', '1');

		if($_FILES['userfile']['size']){
			$upload = $this->do_upload_pricture_article();
			if(isset($upload['upload_data']))
				$params['image'] = '/upload/images/article/'.$upload['upload_data']['file_name'];
			if(isset($upload['error']))
				Admin_Helper::ins()->setMessage($upload['error'], 'warning');
		}
		
		if($params['add_img_relate'] != ''){
			$params['add_img_relate'] = 1;
			for ($i=1; $i < 8; $i++) {
				$fileInput = 'userfile';
				$feildImage= 'image';
				$fileInput.=$i;
				$feildImage.=$i;
				$fileimageHide = "hide_userfile".$i; 
				
				if($this->gpost($fileimageHide, '') == '' && $_FILES[$fileInput]['size'] == 0){
					$params[$feildImage] = "";
				}else{
					if($_FILES[$fileInput]['size']){
						$_FILES['userfile'] = &$_FILES[$fileInput];
						$upload = $this->do_upload_pricture_article();
						
						if(isset($upload['upload_data']))
							$params[$feildImage] = '/upload/images/article/'.$upload['upload_data']['file_name'];
						if(isset($upload['error']))
							Admin_Helper::ins()->setMessage($upload['error'], 'warning');
					}
				}
			}
		}else{
			$params['add_img_relate'] = 0;
		}

		$rlt = $this->article_model->save($params);
		return $rlt;
	}

	private function do_upload_pricture_article()
	{
		$file_name = Constant::$CONS_WEBSITE."_".time();

		$config['upload_path'] = UPLOAD_PATH.'/images/article';
		$config['allowed_types'] = Constant::$ALLOW_PIC_UPLOAD;
		$config['max_size']	= Constant::$LIMIT_PIC_UPLOAD;
		$config['file_name'] = $file_name; // set the name here
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

	/*Ajax call*/
	public function subMenuAjax(){
		$this->load->model ('article_model');

		$articleId	= $this->gpost('articleId', '');

		$lstSubmenu = $this->article_model->getSubMenuComboBox($articleId);
		$lstCombobox = array();
		foreach ($lstSubmenu as $key => $value) {
			$lstCombobox[] = $value->id."_".$value->vn_name_menu;
		}

		$data = json_encode($lstCombobox);

    	
    	echo $data;
	}

	public function searhArticleAjax(){
		$this->load->model ('article_model');
		$menu_article_id	= $this->gpost('menuArticleId', 0);
		$sub_menu_article_id	= $this->gpost('subMenuArticleId', 0);

		$lstArticle = $this->article_model->getAllArticleByMenuSubmenu($menu_article_id,$sub_menu_article_id);
		
		echo json_encode($lstArticle);
	}


	/*Start exe product*/
}