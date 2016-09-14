<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $document['title']; ?></title>
	<meta name='description' content='<?php echo $document['description']; ?>' />
	<link rel="stylesheet" href="<?php echo $document['template_url']; ?>/bootstrap-3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $document['template_url']; ?>/bootstrap-3.3.5/css/bootstrap-tagsinput.css" />
    <link rel="stylesheet" href="<?php echo $document['template_url']; ?>/bootstrap-3.3.5/css/bootstrap-multiselect.css" />
	<link href="<?php echo $document['template_url']; ?>/font_aws/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel='stylesheet' type='text/css' href="<?php echo $document['css_url']; ?>sb-admin.css" />
	<link rel='stylesheet' type='text/css' href="<?php echo $document['css_url']; ?>bootstrap-datetimepicker.css" />
	<link rel='stylesheet' type='text/css' href="<?php echo $document['css_url']; ?>template.css?v=1.2" />
	<script type="text/javascript">
        var BASE_URL = '<?php echo base_url("/"); ?>';
    </script>
    <script type="text/javascript" src="<?php echo $document['js_url']; ?>jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="<?php echo $document['js_url']; ?>jquery-ui.js"></script>
    <script src="<?php echo $document['template_url']; ?>/bootstrap-3.3.5/js/bootstrap.min.js"></script>
    <script src="<?php echo $document['template_url']; ?>/bootstrap-3.3.5/js/bootstrap-multiselect.js"></script>
    <script type="text/javascript" src="<?php echo $document['js_url']; ?>tinymce.4.2.8/tinymce.min.js"></script>
    <script type="text/javascript" src="<?php echo $document['js_url']; ?>moment-with-locales.js"></script>  
    <script type="text/javascript" src="<?php echo $document['js_url']; ?>bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="<?php echo $document['js_url']; ?>ckeditor.js"></script> 

    <script src="<?php echo $document['template_url']; ?>/bootstrap-3.3.5/js/bootstrap-tagsinput.min.js"></script> 
    
    <script type="text/javascript" src="<?php echo $document['js_url']; ?>main.js"></script>    
</head>
<body>

	<?php 
	if(!Admin_Helper::ins()->isLogin()):
		echo $contents;
	else: ?>
	<div id="wrapper">
       	<div id='navigation'>
       		<?php echo $navigation; ?>
       	</div>
        <div id="page-wrapper">
            <div class="container-fluid">

                <?php 
                echo Admin_Helper::ins()->getMessage();

                echo $contents; 
                ?>
            </div>
        </div>
    </div>
	<?php endif; ?>
    
    <script type="text/javascript">
        window.onload = function() {
            var menu_cur = '<?php if(isset($curentMenu)) {echo $curentMenu ;}?>';
            if(menu_cur == null || menu_cur == ""){
                $(".admenuclass li ").removeClass("active");
            }else{
                $(".admenuclass li:eq("+menu_cur+") ").addClass("active");
            }
        };
    </script>
</body>
</html>