<?php 
class Mhtml_Helper{
	public static function breakNum($num){
		$arr = str_split((string)$num);

		$length = count($arr);
		$html = '';
		for ($i=0; $i < $length; $i++) { 
			$html.='<span>'.$arr[$i].'</span>';
		}

		return $html;
	}

	public static function studentAvar($pic){
		if(empty($pic))
			return Util::loadImg('/images/user_default.jpg');
		else
			return Util::loadImg($pic);
	}

	public static function logoSchool($logo, $class=''){
		if(empty($logo))
			$src = Util::loadImg('/images/school/icon_global.jpg');
		else
			$src = Util::loadImg($logo);
		return "<img class='logo_school {$class}' src='{$src}' />";
	}

	public static function loadView($view, $data=null){
		$ci = &get_instance();
		return $ci->load->view($view, $data, true);
	}

	public static function tinymce(){
		$editor = '
		<script>
			var Editor = {
				basic: function(id, block){
					if(typeof block != "undefined")
						block = "div";
					else
						block = "p";	
					tinymce.init({
					selector: "#"+id,
					relative_urls: false,
					remove_script_host: false,
					convert_urls: true,
					forced_root_block : block,
					plugins: [
				        "advlist autolink lists image link charmap print preview anchor",
				        "searchreplace visualblocks code",
				        "insertdatetime table contextmenu paste responsivefilemanager asciimath4"
				    ],
				    toolbar: "undo redo | bold italic | sub sup | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | asciimath4",
					external_filemanager_path: BASE_URL+"filemanager/",
					filemanager_title:"Responsive Filemanager" ,
					external_plugins: { "filemanager" : BASE_URL+"filemanager/plugin.min.js"}
					});
				},
			}
		</script>';

		echo $editor;
	}

	public static function jslang(){
		$ci = &get_instance();
		$tmp = $ci->lang->language;
		$jslang = array();
		foreach ($tmp as $key => $value) {
			if(strpos($key,'js_') === 0)
				$jslang[$key] = $value;
			else
				break;
		}
		echo '
			<script>
				var jlang = '.json_encode($jslang).';
			</script>
		';
	}

	public static function bgBanner($url){
		if(empty($url))
			return '';
		
		$stype_banner = 'background:-webkit-gradient(linear,left top, left bottom, color-stop(0%, rgba(0, 0, 0, 0)),
			color-stop(40%, rgba(0, 0, 0, 0.2)),color-stop(60%, rgba(0, 0, 0, 0.4)), color-stop(80%, rgba(0, 0, 0, 0.6)), 
			color-stop(100%, rgba(0, 0, 0, 0.8))),  url('.Util::loadImg($url).') center no-repeat;

			background: -moz-linear-gradient(center top , transparent 0%, rgba(0, 0, 0, 0.2) 40%, rgba(0, 0, 0, 0.4) 60%, 
			rgba(0, 0, 0, 0.6) 80%, rgba(0, 0, 0, 0.8) 100%), url('.Util::loadImg($url).') center no-repeat;
			background-size: cover;
		';
		return $stype_banner;
	}
}