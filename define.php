<?php
 header('Access-Control-Allow-Origin: *');  
date_default_timezone_set('Asia/Ho_Chi_Minh');
define('APPLICATION_PATH',realpath(dirname(__FILE__)).'/application');

define('PUBLIC_PATH',realpath(dirname(__FILE__)).'/public');

define('SYSTEM_PATH',realpath(dirname(__FILE__)).'/system');

define('PUBLIC_URL','public');

define('UPLOAD_PATH',PUBLIC_PATH.'/upload');

define('TEMPLATE_URL',PUBLIC_URL.'/templates');

define('TEMPLATE_URL_FRONT',PUBLIC_URL.'/templates/front');
define('TEMPLATE_URL_ADMIN',PUBLIC_URL.'/templates/admin');

define('SITE_LOCAL_PATH',realpath(dirname(__FILE__)));


function debug($arr){
	echo "<pre>";
		print_r($arr);
	echo "</pre>";
	exit;
}