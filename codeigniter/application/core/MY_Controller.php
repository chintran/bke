<?php
class MY_Controller extends CI_Controller{
	public function __construct($template = 'front'){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('user_helper');
		$this->load->helper('mhtml_helper');
		$this->lang->load("js",User_Helper::ins()->getLang()); 
		$this->lang->load("main",User_Helper::ins()->getLang());

		$this->loadTemplate($template);
	}

	protected function loadTemplate($template = 'front'){
		switch ($template) {
			case 'front':
				$this->load->helper('user_helper');
				$document = $this->frontEnd();
				break;
			
			case 'admin':
				$document = $this->backEnd();
				break;
		}

		$this->template->setTemplate($document['template'], $document);
	}

	protected function frontEnd(){
		$options=array();
		$this->addNavigation();
		$options['template']='templates/front/tmpl';
		$options['template_url'] = base_url().TEMPLATE_URL. '/front';
		$options['css_url'] = $options['template_url'] . '/css/';
		$options['js_url'] = $options['template_url'] . '/js/';
		$options['img_url'] = $options['template_url'] . '/img/';

		return $options;
	}

	protected function backEnd(){
		$options=array();
		$this->addAdminNav();
		$options['template']='templates/admin/tmpl';
		$options['template_url'] = base_url().TEMPLATE_URL. '/admin';
		$options['css_url'] = $options['template_url'] . '/css/';
		$options['js_url'] = $options['template_url'] . '/js/';
		$options['img_url'] = $options['template_url'] . '/images/';

		$options['title'] = 'Administrator - CodeArena';
		$options['description'] = 'CodeArena';
		return $options;
	}

	public function gpost($key, $defaul = null){
		if(!isset($_POST[$key]))
			return $defaul;
		else 
			return $_POST[$key];
	}

	public function gget($key, $defaul = null){
		if(!isset($_GET[$key]))
			return $defaul;
		else 
			return $_GET[$key];
	}

	private function addNavigation(){
		$this->load->model ('article_model');
		$this->load->model ('businessAreas_model');
		$this->load->model ('menu_model');
		$this->load->model ('banner_model');
		$action = $this->uri->segment(2, '');
		$controler = $this->uri->segment(1, 'main');
		$link = '/'.$controler. ($action != '' ? '/'.$action: '');
		$resp =  array('controler'=>$controler, 
					'action'=>$action, 
					'link'=>$link);
		$resp['businessAreas'] = $this->businessAreas_model->getByArea(Constant::$CONS_WEBSITE);
		$lstMenu = $this->menu_model->getAllMenu(0);
		$itemSubmenu= array();
		foreach ($lstMenu as $key => $value) {
			# code...
			$lstSubmenu = $this->article_model->getSubMenuDisplay($value->id);
			if(count($lstSubmenu) != 0){
				$itemSubmenu[$value->id]=$lstSubmenu;
			}
		}

		$lstShowHome = $this->menu_model->getListForHome(Constant::$CONS_SOLUTIONS);
		$parentMenu = $this->menu_model->getById($lstShowHome[0]->parent_submenu_id);
		$lstBanner = $this->banner_model->getBannerForWeb();
		
		$resp['lstBanner'] = $lstBanner;
		$resp['lstShowHome'] = $lstShowHome;
		$resp['parentShow']  = $parentMenu;

		$resp['itemSubmenu'] = $itemSubmenu;
		$resp['menucategory'] = $lstMenu;
		$navigation = $this->load->view('main/navigation', $resp, true);
		$this->template->set('navigation', $navigation);
	}

	private function addAdminNav(){
		$action = $this->uri->segment(2, 'index');
		$navigation = $this->load->view('admin/navigation',  array('action'=>$action), true);
		$this->template->set('navigation', $navigation);
	}

	public function load_pagination($url, $uri_segment){
		$this->load->library("pagination");
		$config["base_url"] = base_url().$url;
		$config["per_page"] = Constant::$PER_ROW_PAGE;
		$config["uri_segment"] = $uri_segment;
		$config['num_links'] = Constant::$NUM_LINK_PAGE;
		$config['prev_link'] = 'Previous';
		$config['next_link'] = 'Next';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="javascript:;">';
		$config['cur_tag_close'] = '</a></li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		//$this->config_pagination['first_link'] = ' <<';
		//$this->config_pagination['last_link'] = ' >>';
		return $config;
	}

}