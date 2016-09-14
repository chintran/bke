<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	public function __construct() {
		parent::__construct ('admin');
		$this->load->helper('admin_helper');
		$this->load->model ('admin_model');
	}

	public function index(){

		if(Admin_Helper::ins()->adminLogin())
			redirect(base_url('admin_man/index'));

		$this->template->load('admin/login');
	}

	public function login(){

		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$user = $this->admin_model->check_user($username , $password );
		
		if(count($user))
		{
			$this->session->set_userdata(Constant::$KEY_ADMIN_STATE, $user);
			redirect(base_url('admin_man/index'));
		}	
		else
		{
			$resp = array();
			if($username != false || $password != false){
				$resp = array('error'=>'Login unsuccessfully');
			}
		
			$this->template->load('admin/login', $resp);
		}
	}

	public function logout(){
		$this->session->set_userdata(Constant::$KEY_ADMIN_STATE, false);
		redirect(base_url('admin/login'));
	}

	public function changePass(){
		$resp['curentMenu'] = 7;
		$this->template->load('admin/change_pass',$resp);
	}

	public function changePassWord(){

		$old_pass_session = $this->session->get_userdata(Constant::$KEY_ADMIN_STATE)['NV_ADMIN_STATE']->password;
		$current_user_id = $this->session->get_userdata(Constant::$KEY_ADMIN_STATE)['NV_ADMIN_STATE']->id;

		$old_pass = $this->input->post('oldpasswd');
		$newpasswd = $this->input->post('newpasswd');
		
		if(md5($old_pass) != $old_pass_session){
			echo json_encode("Mật khẩu cũ không đúng");
		}else{
			$params['id'] = $current_user_id;
			$params['password'] = md5($newpasswd);
			$result = $this->admin_model->user_save($params);
			if($result){

				$this->session->set_userdata(Constant::$KEY_ADMIN_STATE, false);
				echo json_encode("200");
			}else{
				var_dump('expression');
				exit();
				echo json_encode("Đổi mật khẩu không thành công");
			}
		}
	}
}