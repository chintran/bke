<?php 
class User_Helper{
	private static $intance = null;
	private $ci;
	public function User_Helper(){
		$this->ci = &get_instance();
	}
	public static function ins(){
		if(self::$intance == null)
			self::$intance = new User_Helper();
		return self::$intance;
	}
	public function isLogin(){
		$isLoggedIn = $this->ci->session->userdata(Constant::$KEY_USER_STATE, null);
		return  $isLoggedIn != null ? true : false;
	}

	public function setInfo($data){
		$tmp = (object)array('id'=>$data->id, 'email'=>$data->email);
		$this->ci->session->set_userdata(Constant::$KEY_USER_STATE, $tmp);
	}

	public function get(){
		$user = $this->ci->session->userdata(Constant::$KEY_USER_STATE, null);
		if($user != null){
			$this->ci->load->model('student_model');
			return $this->ci->student_model->getById($user->id);
		}
		else
			return null;

	}

	public function logout(){
		return $this->ci->session->unset_userdata(Constant::$KEY_USER_STATE);
	}

	public function setLang($code, $name){
		$this->ci->session->set_userdata(Constant::$KEY_LANG, array('code'=>$code, 'name'=>$name));
	}
	public function getLang(){
		$lang = $this->ci->session->userdata(Constant::$KEY_LANG, null);
		if($lang == null){
			return Constant::$LANGUAGE['vn'];
		}else{
			return $lang['name'];
		}
	}
	public function getLangCode(){
		$lang = $this->ci->session->userdata(Constant::$KEY_LANG, null);
		if($lang == null){
			return 'vn';
		}else{
			return $lang['code'];
		}
	}

	public function setSession($key, $data){
		$this->ci->session->set_userdata($key, $data);
	}

	public function getSession($key, $data = null){
		return $this->ci->session->userdata($key, $data);
	}
	
	public function setMessage($msg, $code='info'){
		//code = succ - info - warn - err
		$arr = $this->ci->session->userdata(Constant::$KEY_MESSAGE, array());
		$arr[] = array('msg'=>$msg, 'code'=>$code);
		return $this->ci->session->set_userdata(Constant::$KEY_MESSAGE, $arr);
	}
	public function getMessage($only_msg = false){
		$msgs = $this->ci->session->userdata(Constant::$KEY_MESSAGE, null);
		$this->ci->session->unset_userdata(Constant::$KEY_MESSAGE);

		if($msgs != null){
			$message = '';
			if($only_msg)
				$message = $msgs;
			else{
				foreach ($msgs as $key => $msg) {
					$class = $msg['code'];
					$message.= "<div class='alert alert-".$class."'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						  	<strong></strong>".$msg['msg']."
						</div>";
				}
				
			}
			return $message;
		}
		return null;
	}

	public function checkStudentPermit(){
		if(!$this->isLogin()){
			$this->setMessage($this->ci->lang->line('warning_permission'),'warning');
			redirect(base_url('/'));
			exit;
		}
	}

	public function sendMail($to, $message, $subject){
        $this->ci->load->library('email');
        $this->ci->email->to($to);
        $this->ci->email->subject($subject);
        $this->ci->email->message($message);
        return $this->ci->email->send();
    }
}