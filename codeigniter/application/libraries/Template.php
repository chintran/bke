<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template {
		var $template_data = array();
		var $template = '';

		function setTemplate($template = '', $document = array()) {
			$this->template = $template;
			$this->set('document', $document);
		}

		function set($name, $value)
		{
			$this->template_data[$name] = $value;
		}

		function setBlock($block = '',$view = '' , $view_data = array()){
			$this->set($block, $this->CI->load->view($view, $view_data, TRUE));	
		}

		function load($view = '' , $view_data = array(), $return = FALSE)
		{   
			/*var_dump("chintran load");
			exit();*/
			$this->CI =& get_instance();
			$this->set('contents', $this->CI->load->view($view, $view_data, TRUE));			
			return $this->CI->load->view($this->template, $this->template_data, $return);
		}

}

