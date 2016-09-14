<?php $subhead = ($subMenuCategory->id == null) ? 'Create New' : 'Edit';
MHtml_Helper::tinymce();
?>
<div id='wrap_competition_form'>
    <div class="row">
        <div class="col-lg-12">
			<h1 class="page-header">
			    Quản lý SubMenu
			    <small><?php echo $subhead; ?></small>
			</h1>
			<ol class="breadcrumb">
                <li>
                    <i class="fa fa-fw fa-table"></i>  <a href="<?php echo base_url('/menu/subMenuCategory'); ?>">Quản lý Menu</a>
                </li>
                <li class="active">
                    <i class="fa fa-fw fa-edit"></i> Form
                </li>
            </ol>

			<form action='' method='post' id='frm_subMenuCategory'  enctype="multipart/form-data">
				<div class='row'>
					<div class='col-sm-12'>

						<div class='form-group'>
							<label>Tên tiếng việt</label>
							<input class='form-control' type="text" name='vn_name_menu' value="<?php echo $subMenuCategory->vn_name_menu; ?>" required/>
						</div>
						<div class='form-group'>
							<label>Tên tiếng anh</label>
							<input class='form-control' type="text" name='en_name_menu' value="<?php echo $subMenuCategory->en_name_menu; ?>" required/>
						</div>
						<div class='form-group'>
							<label>Level Menu</label>
							
							<select name="level_menu" id="level_menu" class="input-large form-control">
								<?php 
		                    		for($i=1; $i < 4; $i++){
		                    		if(isset($subMenuCategory) && $subMenuCategory->level_menu == $i){ ?>
		                    			<option value="<?php echo $subMenuCategory->level_menu; ?>" selected><?php echo "Menu Level ".$i; ?></option>
		                    		<?php }else{ ?>
		                    			<option value="<?php echo $i; ?>"><?php echo "Menu Level ".$i; ?></option>;
		                    		<?php }
		                    		}
		                    	?>
							</select>
						</div>

						<div class='form-group'>
							<label>Hình đại diện</label>
							<?php 
								$required = 'required';
								if(!empty($subMenuCategory->image)): $required = ''; ?>
								<div>
									<img style='width:150px;height:100px;' src='<?php echo Util::loadImg($subMenuCategory->image); ?>' />
								</div>
							<?php endif; ?>
							<input class='form-control' type="file" name='userfile' value="<?php echo $subMenuCategory->image; ?>" />
						</div>

						<div class='form-group'>
							<label>Menu Cha</label>
							
							<select name="parent_submenu_id" id="parent_submenu_id" class="input-large form-control">
								<?php 
		                    		$length = count($parentMenuCategory);
		                    		for($i=0; $i < $length; $i++){
		                    		if($subMenuCategory->parent_submenu_id == $parentMenuCategory[$i]->id){ ?>
		                    			<option value="<?php echo $parentMenuCategory[$i]->id; ?>" selected><?php echo $parentMenuCategory[$i]->vn_name_menu; ?></option>;
		                    		<?php }else{ ?>
		                    			<option value="<?php echo $parentMenuCategory[$i]->id; ?>"><?php echo $parentMenuCategory[$i]->vn_name_menu; ?></option>;
		                    	<?php	}
		                    		}
		                    	 ?>
							</select>
						</div>
						<div class='form-group'>
							<label>Vị trí</label>
							<input class='form-control' type="text" name='position' value="<?php echo $subMenuCategory->position; ?>" required/>
						</div>
						<div class='form-group'>
							<label>Các web site sử dụng menu này</label></br>
							<?php
								$old_menu_website = array();
								if(isset($subMenuCategory)){
									$old_menu_website = explode('_', $subMenuCategory->menu_website);
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
						

					</div>
				</div>
				

				<div class='form-group text-center'>
					<input type='reset' value='Reset' class='btn btn-default' /> 
					<input type='submit' value='Submit' class='btn btn-primary'  name='submit' /> 
				</div>
				<?php if($subMenuCategory->id != null){ ?>
					<input type="hidden" value='<?php echo $subMenuCategory->id; ?>' name='id' />
					<input type="hidden" id="id_menu_website" value='<?php echo $subMenuCategory->menu_website; ?>' name='menu_website' />
					<input type="hidden" id="id_parent_submenu_name" value='<?php echo $subMenuCategory->parent_submenu_name; ?>' name='parent_submenu_name' />
					<input type="hidden" id="id_name_menu_website" value='<?php echo $subMenuCategory->name_menu_website; ?>' name='name_menu_website' />
					<input type="hidden" value='<?php echo $subMenuCategory->image; ?>' name='oldImg' />
				<?php
					} else { 
				?>
					<input type="hidden" id="id_menu_website" value='' name='menu_website' />
					<input type="hidden" id="id_parent_submenu_name" value='' name='parent_submenu_name' />
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
 			if($(this).is(':checked') == true){
 				var currentVal = $(this).val();
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

 		/*Event change combobox*/
 		$('#parent_submenu_id').change(function(){
 			var currentValId = $("#parent_submenu_id").val();
 			var currentValName = $("#parent_submenu_id option:selected").text();
 			$("#id_parent_submenu_name").val(currentValName);
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