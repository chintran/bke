<?php 
class Admin_Helper{
	private static $intance = null;
	private $ci;
	public function Admin_Helper(){
		$this->ci = &get_instance();
	}
	public static function ins(){
		if(self::$intance == null)
			self::$intance = new Admin_Helper();
		return self::$intance;
	}
	public function isLogin(){
		$isLoggedIn = $this->ci->session->userdata(Constant::$KEY_ADMIN_STATE, null);
		return  $isLoggedIn != null ? true : false;
	}

	public  function adminLogin(){

		if($this->ci->session->userdata(Constant::$KEY_ADMIN_STATE))
			return true;
		else 
		{	
			redirect(base_url("admin/login"));
			return false;
		}
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
}