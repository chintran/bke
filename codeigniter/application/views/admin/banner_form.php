<?php $subhead = ($banner->id == null) ? 'Create New' : 'Edit';
MHtml_Helper::tinymce();
?>
<div id='wrap_competition_form'>
    <div class="row">
        <div class="col-lg-12">
			<h1 class="page-header">
			    Quản lý Banner
			    <small><?php echo $subhead; ?></small>
			</h1>
			<ol class="breadcrumb">
                <li>
                    <i class="fa fa-fw fa-table"></i>  <a href="<?php echo base_url('/menu/bannerMagnager'); ?>">Quản lý Banner</a>
                </li>
                <li class="active">
                    <i class="fa fa-fw fa-edit"></i> Form
                </li>
            </ol>

			<form action='' method='post' id='frm_bannerMagnager'  enctype="multipart/form-data">
				<div class='row'>
					<div class='col-sm-12'>
						<div class='form-group'>
							<label>Tiêu đề(có thể trống)</label>
							<input class='form-control' type="text" name='name_banner' value="<?php echo $banner->name_banner; ?>"/>
						</div>

						<div class='form-group'>
							<label>Caption 1 tiếng việt</label>
							<input class='form-control' type="text" name='vn_caption_1' value="<?php echo $banner->vn_caption_1; ?>"/>
						</div>

						<div class='form-group'>
							<label>Caption 1 tiếng anh</label>
							<input class='form-control' type="text" name='en_caption_1' value="<?php echo $banner->en_caption_1; ?>"/>
						</div>

						<div class='form-group'>
							<label>Caption 2 tiếng việt</label>
							<input class='form-control' type="text" name='vn_caption_2' value="<?php echo $banner->vn_caption_2; ?>"/>
						</div>

						<div class='form-group'>
							<label>Caption 2 tiếng anh</label>
							<input class='form-control' type="text" name='en_caption_2' value="<?php echo $banner->en_caption_2; ?>"/>
						</div>

						<div class='form-group'>
							<label>Link</label>
							<input class='form-control' type="text" name='link_banner' value="<?php echo $banner->link_banner; ?>"/>
						</div>
					
						<div class='form-group'>
							<label>Hình Banner</label>
							<?php 
								$required = 'required';
								if(!empty($banner->image)): $required = ''; ?>
								<div>
									<img style='width:150px;height:100px;' src='<?php echo Util::loadImg($banner->image); ?>' />
								</div>
							<?php endif; ?>
							<input class='form-control' type="file" name='userfile' value="<?php echo $banner->image; ?>" <?php echo $required; ?>/>
						</div>
					</div>
				</div>
				
				<div class='form-group'>
					<label>Các web site sử dụng banner này</label></br>
					<?php
						$old_menu_website = array();
						if(isset($banner)){
							$old_menu_website = explode('_', $banner->menu_website);
						}
						foreach ($businessAreasCategory as $key => $value) {
							if (in_array($value->id, $old_menu_website)) {
					?>
						<input type='checkbox' class='website_class' checked value='<?php echo $value->id; ?>' checked onchange='checkBoxChange();'> &nbsp;<span class='website_class<?php echo $value->id; ?>'><?php echo $value->code_areas; ?></span>&nbsp;&nbsp;
                	<?php
                			}
                			else{
                	?>
                		<input type='checkbox' class='website_class' value='<?php echo $value->id; ?>' onchange='checkBoxChange();'> &nbsp;<span <span class='website_class<?php echo $value->id; ?>'><?php echo $value->code_areas; ?></span>&nbsp;&nbsp;
                	<?php
                			}
                		}
                	?>
                	<input type='checkbox' class='website_checkall'> Chọn tất cả
				</div>

				<div class='form-group text-center'>
					<input type='reset' value='Reset' class='btn btn-default' /> 
					<input type='submit' value='Submit' class='btn btn-primary'  name='submit' /> 
				</div>
				
				<?php if($banner->id != null){ ?>
					<input type="hidden" value='<?php echo $banner->id; ?>' name='id' />
					<input type="hidden" value='<?php echo $banner->image; ?>' name='oldImg' />
					<input type="hidden" id="id_menu_website" value='<?php echo $banner->menu_website; ?>' name='menu_website' />
					<input type="hidden" id="id_name_menu_website" value='<?php echo $banner->name_menu_website; ?>' name='name_menu_website' />
				<?php
					} else { 
				?>
					<input type="hidden" id="id_menu_website" value='' name='menu_website' />
					<input type="hidden" id="id_name_menu_website" value='' name='name_menu_website' />
				<?php
					}
				?>
			</form>	
		</div>	
	</div>
</div>
<script type="text/javascript">
 	function checkBoxChange(id_checkbox){
 		if($('.website_checkall').is(':checked') == true){
			$('.website_checkall').prop('checked', false); 
 		}
 		var lstmenu = '';
 		var lstNameWeb = '';
 		var ischeckAll = 1;
 		$('.website_class').each(function(){
 			var currentVal = $(this).val();
 			if($(this).is(':checked') == true){
 				lstmenu += "_"+currentVal;
 				if(lstNameWeb == ""){
 					lstNameWeb = $(".website_class"+currentVal).text();
 				}else{
 					lstNameWeb+=", "+ $(".website_class"+currentVal).text();
 				}
 				
 			}else{
 				ischeckAll = 2;
 			}
 		});
 		lstmenu+="_";
 		$("#id_menu_website").val(lstmenu);
 		$("#id_name_menu_website").val(lstNameWeb);
 		if (ischeckAll == 1){
 			$('.website_checkall').prop('checked', true);
 		}
	}
 	$(function(){
 		/*event onchange check all in check box*/
 		$('.website_checkall').change(function(){
 			var lstmenu = '';
 			var lstNameWeb = '';
 			if($('.website_checkall').is(':checked') == true){
	 			$('.website_class').prop('checked', true);
		 		
		 		$('.website_class').each(function(){
		 			var currentVal = $(this).val();
	 				lstmenu += "_"+currentVal;
	 				if(lstNameWeb == ""){
	 					lstNameWeb = $(".website_class"+currentVal).text();
	 				}else{
	 					lstNameWeb+=", "+ $(".website_class"+currentVal).text();
	 				}
		 		});

 			}else{
 				$('.website_class').prop('checked', false);
 				lstmenu = "";
 				lstNameWeb = "";
 			}
 			lstmenu+="_";
 			$("#id_menu_website").val(lstmenu);
 			$("#id_name_menu_website").val(lstNameWeb);
 			
 		});
 	});
 	$(window).load(function(){
 		var checkAll = 1;
 		$('.website_class').each(function(){
 			if($(this).is(':checked') == false){
 				checkAll = 2;
 			}
 		});

 		if(checkAll == 1){
 			$('.website_checkall').prop('checked', true); 
 		}
 	});

</script>