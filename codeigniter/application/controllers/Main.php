<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

	public function __construct() {
		parent::__construct ();
	}

	public function lang($lang_code){
		if(isset(Constant::$LANGUAGE[$lang_code])){
			$lang_name = Constant::$LANGUAGE[$lang_code];

			User_Helper::ins()->setLang($lang_code, $lang_name);
		}

		redirect(base_url('/'));
  	}

	public function index()
	{
		/*var_dump(__FILE__);
		var_dump($_SERVER['PHP_SELF']);
		exit();*/
		$this->load->model ('partner_model');
		$this->load->model ('menu_model');
		$this->load->model ('article_model');

		$lstIntroduceShow = $this->menu_model->getMenuBySlug(Constant::$CONS_HOME);
		$lstProjectShow = $this->menu_model->getMenuBySlug(Constant::$CONS_PROJ);

		$resp['partnerCategory'] = $this->partner_model->getAllPartner(0);

		$resp['articleCategory'] = $this->article_model->getArticleShowAllByMenuId($lstIntroduceShow[0]->id);

		$resp['articllProject'] = $this->article_model->getArticleShowHome($lstProjectShow[0]->id,3);
		
		$resp['title_page'] = $this->lang->line('title_home');

		$this->template->load('main/index', $resp);
	}

	public function introduce($introduceId = '')
	{
		$this->load->model ('menu_model');
		$this->load->model ('article_model');

		$lstIntroduceShow = $this->menu_model->getListForHome(Constant::$CONS_INTRO);

		$parentMenuIntroduce = $this->menu_model->getById($lstIntroduceShow[0]->parent_submenu_id);

		$resp['lstIntroduceShow'] = $lstIntroduceShow;
		$resp['parentMenuIntroduce'] = $parentMenuIntroduce;
		
		$currentLink = "/";
		$articllIntroduce;
		if($introduceId == ""){
			$currentLink.= $lstIntroduceShow[0]->id;
			$articllIntroduce = $this->article_model->getArticleShow($lstIntroduceShow[0]->id);
		}else{
			$currentLink.=$introduceId;
			$articllIntroduce = $this->article_model->getArticleShow($introduceId);
		}
		/*Setting for title*/
		if(isset($articllIntroduce[0])){

			$lang_code = User_Helper::ins()->getLangCode();
			$slag_code = $lang_code."_title_name";

			$resp['title_page'] = $articllIntroduce[0]->$slag_code;
		}else{
			$resp['title_page'] = $this->lang->line('company_title');
		}

		$resp['articllIntroduce'] = $articllIntroduce;
		$resp['currentLink'] = $currentLink;

		$this->template->load('main/introduce', $resp);
	}

	public function solution($solutionId = '')
	{
		$this->load->model ('menu_model');
		$this->load->model ('article_model');

		$lstShowHome = $this->menu_model->getListForHome(Constant::$CONS_SOLUTIONS);

		$currentLink = "/";
		if($solutionId == ""){
			$currentLink.= $lstShowHome[0]->id;
			$articleSolution = $this->article_model->getArticleShowAll($lstShowHome[0]->id);
		}else{
			$currentLink.=$solutionId;
			$articleSolution = $this->article_model->getArticleShowAll($solutionId);
		}
		/*Setting for title*/
		if(isset($articleSolution[0])){

			$lang_code = User_Helper::ins()->getLangCode();
			$slag_code = $lang_code."_title_name";

			$resp['title_page'] = $articleSolution[0]->$slag_code;
		}else{
			$resp['title_page'] = $this->lang->line('company_title');
		}

		$resp['articleSolution'] = $articleSolution;
		$resp['currentLink'] = $currentLink;
		$this->template->load('main/solution', $resp);
	}

	public function solutionDetail($solutionID = 0)
	{
		$this->load->model ('menu_model');
		$this->load->model ('article_model');
		$lstProjectShow = $this->menu_model->getListForHome(Constant::$CONS_SOLUTIONS);

		$parentMenuProject = $this->menu_model->getById($lstProjectShow[0]->parent_submenu_id);
		$resp['lstProjectShow'] = $lstProjectShow;
		$resp['parentMenuProject'] = $parentMenuProject;
		
		$articleSolutionItem = $this->article_model->getById($solutionID);
		$currentLink=$articleSolutionItem->sub_menu_article_id;
		
		/*Setting for title*/
		if(isset($articleSolutionItem)){

			$lang_code = User_Helper::ins()->getLangCode();
			$slag_code = $lang_code."_title_name";

			$resp['title_page'] = $articleSolutionItem->$slag_code;
		}else{
			$resp['title_page'] = $this->lang->line('company_title');
		}

		$resp['articleSolutionItem'] = $articleSolutionItem;
		$resp['currentLink'] = $currentLink;

		$this->template->load('main/solutionDetail', $resp);
	}

	public function technology($technologyId = '',$page = 0)
	{
		$this->load->model ('menu_model');
		$this->load->model ('article_model');

		$lstTechnologyShow = $this->menu_model->getListForHome(Constant::$CONS_TECH);
		$parentMenuTechnology = array();
		$currentLink = "/";

		/*get record show and info paging*/
		if(count($lstTechnologyShow) > 0){
			$parentMenuTechnology = $this->menu_model->getById($lstTechnologyShow[0]->parent_submenu_id);
			if($technologyId == ""){
				$technologyId = $lstTechnologyShow[0]->id;
			}
		}
		$currentLink.=$technologyId;

		$totalRecord = $this->article_model->getArticleCountShowAll($technologyId);
		$totalPage = round($totalRecord[0]->total_record / Constant::$PER_ROW_PAGE);
		if($totalPage*Constant::$PER_ROW_PAGE < $totalRecord[0]->total_record){
			$totalPage += 1;
		}

		if($totalPage == 1){
			$totalPage = 0;
		}
		
		$articllTechnology = $this->article_model->getArticleShowByPage($technologyId,$page);
		

		/*Setting for title*/
		if(isset($articllTechnology[0])){

			$lang_code = User_Helper::ins()->getLangCode();
			$slag_code = $lang_code."_title_name";

			$resp['title_page'] = $articllTechnology[0]->$slag_code;
		}else{
			$resp['title_page'] = $this->lang->line('company_title');
		}

		$resp['totalPage'] = $totalPage;
		$resp['curPage'] = $page;
		$resp['curTechnologyId'] = $technologyId;
		$resp['lstTechnologyShow'] = $lstTechnologyShow;
		$resp['parentMenuTechnology'] = $parentMenuTechnology;
		$resp['articllTechnology'] = $articllTechnology;
		$resp['currentLink'] = $currentLink;

		$this->template->load('main/technology', $resp);
	}

	public function technologyDetail($technologyID = 0)
	{
		$this->load->model ('menu_model');
		$this->load->model ('article_model');

		$lstTechnologyShow = $this->menu_model->getListForHome(Constant::$CONS_TECH);
		$parentMenuTechnology = $this->menu_model->getById($lstTechnologyShow[0]->parent_submenu_id);
		$resp['lstTechnologyShow'] = $lstTechnologyShow;
		$resp['parentMenuTechnology'] = $parentMenuTechnology;

		$articleTecnologyItem = $this->article_model->getById($technologyID);
		$currentLink=$articleTecnologyItem->sub_menu_article_id;

		/*Setting for title*/
		if(isset($articleTecnologyItem)){

			$lang_code = User_Helper::ins()->getLangCode();
			$slag_code = $lang_code."_title_name";

			$resp['title_page'] = $articleTecnologyItem->$slag_code;
		}else{
			$resp['title_page'] = $this->lang->line('company_title');
		}

		$resp['lstTechnologyShow'] = $lstTechnologyShow;
		$resp['articleTecnologyItem'] = $articleTecnologyItem;
		$resp['currentLink'] = $currentLink;

		$this->template->load('main/technologyDetail', $resp);
	}

	
	public function project($projectId = '',$page = 0)
	{
		$this->load->model ('menu_model');
		$this->load->model ('article_model');
		$lstProjectShow = $this->menu_model->getListForHome(Constant::$CONS_PROJ);
		$parentMenuProject = $this->menu_model->getById($lstProjectShow[0]->parent_submenu_id);
		$resp['lstProjectShow'] = $lstProjectShow;
		$resp['parentMenuProject'] = $parentMenuProject;
		$currentLink = "/";
		/*get record show and info paging*/
		if($projectId == ""){
			$projectId = $lstProjectShow[0]->id;
		}

		$currentLink.=$projectId;

		$totalRecord = $this->article_model->getArticleCountShowAll($projectId);

		$totalPage = intval(round($totalRecord[0]->total_record / Constant::$PER_ROW_PAGE));
		
		if($totalPage*Constant::$PER_ROW_PAGE < $totalRecord[0]->total_record){
			$totalPage += 1;
		}

		if($totalPage == 1){
			$totalPage = 0;
		}

		$articllProject = $this->article_model->getArticleShowByPage($projectId,$page);

		/*Setting for title*/
		if(isset($articllProject[0])){

			$lang_code = User_Helper::ins()->getLangCode();
			$slag_code = $lang_code."_title_name";

			$resp['title_page'] = $articllProject[0]->$slag_code;
		}else{
			$resp['title_page'] = $this->lang->line('company_title');
		}

		$resp['totalPage'] = $totalPage;
		$resp['curPage'] = $page;
		$resp['curProjectId'] = $projectId;
		$resp['articllProject'] = $articllProject;
		$resp['currentLink'] = $currentLink;

		$this->template->load('main/project', $resp);
	}

	public function projectDetail($projectId = '')
	{
		$this->load->model ('menu_model');
		$this->load->model ('article_model');
		$this->load->model ('partner_model');
		
		$lstProjectShow = $this->menu_model->getListForHome(Constant::$CONS_PROJ);

		$parentMenuProject = $this->menu_model->getById($lstProjectShow[0]->parent_submenu_id);
		$resp['lstProjectShow'] = $lstProjectShow;
		$resp['parentMenuProject'] = $parentMenuProject;
		
		$articllProject = $this->article_model->getById($projectId);
		$currentLink=$articllProject->sub_menu_article_id;

		$resp['articllProject'] = $articllProject;
		$resp['currentLink'] = $currentLink;
		$resp['partnerCategory'] = $this->partner_model->getAllPartner(0);


		/*Setting for title*/
		if(isset($articllProject)){

			$lang_code = User_Helper::ins()->getLangCode();
			$slag_code = $lang_code."_title_name";

			$resp['title_page'] = $articllProject->$slag_code;
		}else{
			$resp['title_page'] = $this->lang->line('company_title');
		}

		/*Orther project*/
		$articllProjectOther = $this->article_model->getArticleShow($currentLink,Constant::$RELATE_PROJECT);
		$resp['articllProjectOther'] = $articllProjectOther;

		$this->template->load('main/projectDetail', $resp);
	}

	public function contact(){
		$this->load->model ('businessAreas_model');
		$this->load->model ('menu_model');

		$lstContactShow = $this->menu_model->getMenuBySlug(Constant::$CONS_CONTACT);
		$resp['lstContactShow'] = $lstContactShow;
		$resp['businessAreasContact'] = $this->businessAreas_model->getAllAreasForContact();
		$resp['curentMenu'] = 2;
		$resp['title_page'] = $this->lang->line('title_home');
		$this->template->load('main/contact',$resp);
	}

	public function search(){
		$this->load->model ('article_model');

		$key_search = $this->input->post('keysearch');

		$resultSearch = $this->article_model->searchArticle($key_search);
		var_dump($key_search);
		exit();
	}
}
