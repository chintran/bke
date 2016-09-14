/*JAVASCRIPT*/
var Util = {
	
	isEmpty: function(str){
	    if($.trim(str) == "")
	        return true;
	    else 
	        return false;
	},
	validateEmail: function(email) {
	    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	    return re.test(email);
	},
	httpRequest: function(params, action, method, callback) {
		if(typeof csecond != 'undefined') {
			if(csecond)
				return;
			$('html').addClass("wait");
		}
		$.ajax({
			url : BASE_URL+action,
			type : method,
			data : params,
			success : function(data, textStatus, jqXHR) {
				if(typeof csecond != 'undefined'){
					csecond = false;
					$('html').removeClass("wait");
				} 
				callback(data, textStatus);
			},
			error : function(jqXHR, textStatus, errorThrown) {
				if(typeof csecond != 'undefined'){
					csecond = false;
					$('html').removeClass("wait");
				} 
				console.log('callNetwork failed ' + errorThrown);
				callback(null, textStatus);
			}
		});
	}
}


/*API*/
var API = {
	arcQuiz: function(params, callback){
		Util.httpRequest(params, '/api/arcquiz', 'post', function(data, textStatus){
			callback(data);
		});
	},
	updateOrderOptionQuiz: function(params, callback){
		Util.httpRequest(params, '/admin_quiz/update_order_optionquiz', 'post', function(data, textStatus){
			callback(data);
		});
	},
}


//var AMTcgiloc = "http://www.imathas.com/cgi-bin/mimetex.cgi"; 
// var Editor = {
// 	basic: function(id){
// 		tinymce.init({
// 		selector: "#"+id,
// 			plugins: [
// 		        "advlist autolink lists image link charmap print preview anchor",
// 		        "searchreplace visualblocks code",
// 		        "insertdatetime table contextmenu paste"
// 		    ],
// 		    toolbar: "undo redo | bold italic | sub sup | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
// 		});
// 	},


// 	full: function(id){
// 		tinyMCE.init({
// 		    mode : "textareas",
// 		    selector : "#"+id,
// 		    theme : "advanced",
// 		    theme_advanced_buttons1 : "fontselect,fontsizeselect,formatselect,bold,italic,underline,strikethrough,separator,sub,sup,separator,cut,copy,paste,undo,redo",
// 		    theme_advanced_buttons2 : "justifyleft,justifycenter,justifyright,justifyfull,separator,numlist,bullist,outdent,indent,separator,forecolor,backcolor,separator,hr,link,unlink,image,media,table,code,separator,asciimath,asciimathcharmap,asciisvg",
// 		    theme_advanced_fonts : "Arial=arial,helvetica,sans-serif,Courier New=courier new,courier,monospace,Georgia=georgia,times new roman,times,serif,Tahoma=tahoma,arial,helvetica,sans-serif,Times=times new roman,times,serif,Verdana=verdana,arial,helvetica,sans-serif",
// 			theme_advanced_toolbar_location : "top",
// 			theme_advanced_toolbar_align : "left",
// 			theme_advanced_statusbar_location : "bottom",
// 			theme_advanced_resizing : true,
// 		    plugins : 'openmanager, advimage, asciimath,asciisvg,table,inlinepopups,media',
		   
// 		    AScgiloc : BASE_URL+'/math/svgimg.php',			      //change me  
// 		    ASdloc : BASE_URL+'/public/templates/admin/js/tiny_mce.3.5/plugins/asciisvg/js/d.svg',  //change me  	
			
// 			//Open Manager Options
// 			file_browser_callback: "openmanager",
// 			open_manager_upload_path: PUBLIC_PATH+'uploads/',

// 			// Example content CSS (should be your site CSS)
// 			//content_css : "css/content.css",

// 			// Drop lists for link/image/media/template dialogs
// 			template_external_list_url : "lists/template_list.js",
// 			external_link_list_url : "lists/link_list.js",
// 			external_image_list_url : "lists/image_list.js",
// 			media_external_list_url : "lists/media_list.js",
// 		});
// 	}
// }