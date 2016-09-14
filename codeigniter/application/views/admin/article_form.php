<?php $subhead = ($articleItem->id == null) ? 'Create New' : 'Edit';
MHtml_Helper::tinymce();
?>
<div id='wrap_competition_form'>
    <div class="row">
        <div class="col-lg-12">
			<h1 class="page-header">
			    Quản lý bài viết
			    <small><?php echo $subhead; ?></small>
			</h1>
			<ol class="breadcrumb">
                <li>
                    <i class="fa fa-fw fa-table"></i>  <a href="<?php echo base_url('/article/articleMagnager'); ?>">Quản lý bài viết</a>
                </li>
                <li class="active">
                    <i class="fa fa-fw fa-edit"></i> Form
                </li>
            </ol>

			<form action='' method='post' id='frm_articleItem'  enctype="multipart/form-data">
				<div class='row'>
					<div class='col-sm-12'>
						<div class='form-group'>
							<label>Tiêu đề tiếng việt</label>
							<input class='form-control' type="text" name='vn_title_name' value="<?php echo $articleItem->vn_title_name; ?>" required/>
						</div>
						<div class='form-group'>
							<label>Tiêu đề tiếng anh</label>
							<input class='form-control' type="text" name='en_title_name' value="<?php echo $articleItem->en_title_name; ?>" required/>
						</div>
						<!--  -->
						<!-- Menu for article -->
						<div class='form-group'>
							<label>Chọn menu cho bài viết</label>
							
							<select name="menu_article_id" id="menu_article_id" class="input-large form-control">
								<?php 
		                    		$length = count($comboMenu);
		                    		for($i=0; $i < $length; $i++){
		                    		if($articleItem->menu_article_id == $comboMenu[$i]->id){ ?>
		                    			<option value="<?php echo $comboMenu[$i]->id; ?>" selected><?php echo $comboMenu[$i]->vn_name_menu; ?></option>;
		                    		<?php }else{ ?>
		                    			<option value="<?php echo $comboMenu[$i]->id; ?>"><?php echo $comboMenu[$i]->vn_name_menu; ?></option>;
		                    	<?php	}
		                    		}
		                    	 ?>
							</select>
						</div>

						<!-- Menu for article -->
						<div class='form-group'>
							<label>Chọn Submenu cho bài viết</label>
							
							<select name="sub_menu_article_id" id="sub_menu_article_id" class="input-large form-control">
								<option value="0"></option>
								<?php 
		                    		$length = count($comboSubMenu);
		                    		for($i=0; $i < $length; $i++){
		                    		if($articleItem->sub_menu_article_id == $comboSubMenu[$i]->id){ ?>
		                    			<option value="<?php echo $comboSubMenu[$i]->id; ?>" selected><?php echo $comboSubMenu[$i]->vn_name_menu; ?></option>;
		                    		<?php }else{ ?>
		                    			<option value="<?php echo $comboSubMenu[$i]->id; ?>"><?php echo $comboSubMenu[$i]->vn_name_menu; ?></option>;
		                    	<?php	}
		                    		}
		                    	 ?>
							</select>
						</div>
						
						<div class='form-group'>
							<label>Trạng thái bài viết (Public: bài viết sẽ được hiển thị ,Draft : Bài viết cần check lại )</label>
							
							<select name="status" id="status" class="input-large form-control">
								<option value="1"> Draft</option>
								<option value="0"> Public</option>
							</select>
						</div>

						<div class='form-group'>
							<label>Vị trí bài viết</label>
							<input class='form-control' type="text" name='position' value="<?php echo $articleItem->position; ?>" required/>
						</div>

						<div class='form-group'>
							<label>Các web site sử dụng menu này</label></br>
							<?php
								$old_menu_website = array();
								if(isset($articleItem)){
									$old_menu_website = explode('_', $articleItem->article_website);
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
						
						<div class='form-group'>
							<label>Image</label>
							<?php 
								$required = 'required';
								if(!empty($articleItem->image)): $required = ''; ?>
								<div>
									<img style='width:150px;height:100px;' src='<?php echo Util::loadImg($articleItem->image); ?>' />
								</div>
							<?php endif; ?>
							<input class='form-control' type="file" name='userfile' value="<?php echo $articleItem->image; ?>" <?php echo $required; ?>/>
						</div>


						<div class='form-group'>
							<label>Tóm tắt nội dung bài viết tiếng việt</label>
							<textarea  name='vn_synopsis_description' id='vn_synopsis_description'><?php echo $articleItem->vn_synopsis_description; ?></textarea>
							<br>
							<label>Tóm tắt nội dung bài viết tiếng anh</label>
							<textarea  name='en_synopsis_description' id='en_synopsis_description'><?php echo $articleItem->en_synopsis_description; ?></textarea>
						</div>

						<div class='form-group'>
							<label>Mô tả tiếng việt</label>
							<textarea  name='vn_edit_description' id='vn_edit_description'><?php echo $articleItem->vn_description; ?></textarea>
							<br>
							<label>Mô tả tiếng anh</label>
							<textarea  name='en_edit_description' id='en_edit_description'><?php echo $articleItem->en_description; ?></textarea>
						</div>

						<div class='form-group'>
							<input name="add_content_tab" type="checkbox" <?php if($articleItem->add_content_tab == 1) echo 'checked';?> class="add_content_tab" onchange='checkContentTab();'> Thêm nội dung cho tab &nbsp; &nbsp; &nbsp;
							<input name="add_img_relate" type="checkbox" <?php if($articleItem->add_img_relate == 1) echo 'checked';?> class="add_img_relate" onchange='checkImageRelate();'> Thêm hình ảnh liên quan
						</div>
						<?php if($articleItem->add_content_tab == 1){?>

						<div class='form-group tab_content'>

							<div class='form-group'>
								<label>Tên tab 1 tiếng việt</label>
								<input class='form-control' type="text" name='vn_tab_1' value="<?php echo $articleItem->vn_tab_1; ?>" />
							</div>
							<div class='form-group'>
								<label>Tên tab 1 tiếng anh</label>
								<input class='form-control' type="text" name='en_tab_1' value="<?php echo $articleItem->en_tab_1; ?>" />
							</div>

							<label>Nội dung tab 1 tiếng việt</label>
							<textarea  name='vn_tab_introduce' ><?php echo $articleItem->vn_tab_introduce; ?></textarea>
							<br> 

							<label>Nội dung tab 1 tiếng anh</label>
							<textarea  name='en_tab_introduce'><?php echo $articleItem->en_tab_introduce; ?></textarea>

							<div class='form-group'>
								<label>Tên tab 2 tiếng việt</label>
								<input class='form-control' type="text" name='vn_tab_2' value="<?php echo $articleItem->vn_tab_2; ?>" />
							</div>
							<div class='form-group'>
								<label>Tên tab 2 tiếng anh</label>
								<input class='form-control' type="text" name='en_tab_2' value="<?php echo $articleItem->en_tab_2; ?>" />
							</div>

							<label>Nội dung tab 2 tiếng việt</label>
							<textarea  name='vn_tab_tech' ><?php echo $articleItem->vn_tab_tech; ?></textarea>
							<br> 

							<label>Nội dung tab 2 tiếng anh</label>
							<textarea  name='en_tab_tech'><?php echo $articleItem->en_tab_tech; ?></textarea>

							<div class='form-group'>
								<label>Tên tab 3 tiếng việt</label>
								<input class='form-control' type="text" name='vn_tab_3' value="<?php echo $articleItem->vn_tab_3; ?>" />
							</div>
							<div class='form-group'>
								<label>Tên tab 3 tiếng anh</label>
								<input class='form-control' type="text" name='en_tab_3' value="<?php echo $articleItem->en_tab_3; ?>" />
							</div>

							<label>Nội dung tab 3 tiếng việt</label>
							<textarea  name='vn_tab_using' ><?php echo $articleItem->vn_tab_using; ?></textarea>

							<br> <label>Nội dung tab 3 tiếng anh</label>
							<textarea  name='en_tab_using'><?php echo $articleItem->en_tab_using; ?></textarea>

							<div class='form-group'>
								<label>Tên tab 4 tiếng việt</label>
								<input class='form-control' type="text" name='vn_tab_4' value="<?php echo $articleItem->vn_tab_4; ?>" />
							</div>
							<div class='form-group'>
								<label>Tên tab 4 tiếng anh</label>
								<input class='form-control' type="text" name='en_tab_4' value="<?php echo $articleItem->en_tab_4; ?>" />
							</div>

							<label>Nội dung tab 4 tiếng việt</label>
							<textarea  name='vn_tab_link' ><?php echo $articleItem->vn_tab_link; ?></textarea>

							<br> <label>Nội dung tab 4 tiếng anh</label>
							<textarea  name='en_tab_link'><?php echo $articleItem->en_tab_link; ?></textarea>
						</div>

						<?php
							}else{
						 ?>
						 	<div class='form-group tab_content' style="display:none;">
							
							</div>
						<?php }?>

						<?php  if($articleItem->add_img_relate == 1){ ?>
							<div class='form-group img_relate_content'>
								<label>Hình ảnh liên quan</label>
								<?php 
									for ($k=1; $k < 8; $k++) { 
										$flgImg = "image".$k; 
										$userfile = "userfile".$k;
										$image_relate = "image_relate".$k;?>
										<div class="<?php echo $image_relate; ?>">
											<?php if($articleItem->$flgImg != ''){ ?>
												<img style='width:150px;height:100px;' src='<?php echo Util::loadImg($articleItem->$flgImg); ?>' />
												<input type="button" onclick="removeImage('<?php echo $userfile; ?>','<?php echo $image_relate; ?>')" value="Xóa ảnh"/>
											<?php } ?>
										</div>
										<input class='form-control' type="file" name='<?php echo $userfile; ?>' value="<?php echo $articleItem->$flgImg; ?>" />
										<br>
								<?php } ?>
							</div>
						<?php
							}else{
						 ?>
						 	<div class='form-group img_relate_content' style="display:none;">
							
							</div>
						<?php }?>

					</div>
				</div>
				

				<div class='form-group text-center'>
					<input type='reset' value='Reset' class='btn btn-default' /> 
					<input type='submit' value='Submit' class='btn btn-primary'  name='submit' /> 
				</div>

				<?php if($articleItem->id != null){ ?>
					<input type="hidden" value='<?php echo $articleItem->id; ?>' name='id' />
					<input type="hidden" id="article_website" value='<?php echo $articleItem->article_website; ?>' name='article_website' />
					<input type="hidden" id="menu_article_name" value='<?php echo $articleItem->menu_article_name; ?>' name='menu_article_name' />
					<input type="hidden" id="sub_menu_article_name" value='<?php echo $articleItem->sub_menu_article_name; ?>' name='sub_menu_article_name' />
					<input type="hidden" id="name_article_website" value='<?php echo $articleItem->name_article_website; ?>' name='name_article_website' />
				<?php
					} else { 
				?>
					<input type="hidden" id="article_website" value='' name='article_website' />
					<input type="hidden" id="menu_article_name" value='' name='menu_article_name' />
					<input type="hidden" id="sub_menu_article_name" value='' name='sub_menu_article_name' />
					<input type="hidden" id="name_article_website" value='' name='name_article_website' />
				<?php
					}
				?>

				<?php 
					for ($k=1; $k < 8; $k++) { 
						$flgImg = "image".$k; 
						$userfilehide = "hide_userfile".$k?>
						<input id="<?php echo $userfilehide; ?>" class='form-control' type="hidden" name='<?php echo $userfilehide; ?>' value="<?php echo $articleItem->$flgImg; ?>" />
				<?php } ?>

			</form>	
		</div>	
	</div>
</div>

<script type="text/javascript">
	var baseUrl = '<?php echo base_url('/article'); ?>';	

	function removeImage(namedel,image_relate){
		if(confirm("Do you want to remove it?")){
			var hide_name = "hide_"+namedel;
			$("."+image_relate).remove();
			$('#'+hide_name).val("");
		}
		
	}

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
 		$("#article_website").val(lstmenu);
 		$("#name_article_website").val(lstNameWeb);
 		if (ischeckAll == 1){
 			$('.website_checkall').prop('checked', true);
 		}
	}
 	$(function(){
 		$("#sub_menu_article_id").change(function(){
 			var menuName = $('#sub_menu_article_id option:selected').text();
 			$("#sub_menu_article_name").val(menuName);
 		});
 		$("#menu_article_id").change(function(){
 			var articleId = $("#menu_article_id").val();
 			var menuName = $('#menu_article_id option:selected').text();
 			$("#menu_article_name").val(menuName);
 			$("#sub_menu_article_name").val("");
 			$.ajax({
 				url: baseUrl + "/subMenuAjax",
 				type: 'POST',
 				dataType:'JSON',
 				data:{articleId:articleId}
 			})
 			.done(function(data){
 				$('#sub_menu_article_id').find('option').remove();
	  			var lstOption = "<option value=0 ></option>";
	  			$.each(data, function (index, value) {
	  				var splitData = value.split("_");
	  				lstOption += "<option value="+splitData[0]+">"+splitData[1]+"</option>";
	  			});

				$("#sub_menu_article_id").append(lstOption);
 			})
 			.fail( function(XMLHttpRequest, textStatus, errorThrown)  {
 				console.log(textStatus);
		  	});
 		});
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
 			$("#article_website").val(lstmenu);
 			$("#name_article_website").val(lstNameWeb);
 			
 		});
 		/**/
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

 		var menuName = $('#menu_article_id option:selected').text();
 		$("#menu_article_name").val(menuName);
 	});

 	function checkContentTab() {
		if($('.add_content_tab').is(':checked') == true){
			$('.tab_content').css('display','block');
			$('.tab_content').empty();
			var htmlTab = "";
			
							
							
						
			htmlTab +="<div class='form-group'>"
					+"<label>Tên tab 1 tiếng việt </label>"
					+"<input class='form-control' type='text' name='vn_tab_1' />"
					+"</div>"
					+"<div class='form-group'>"
					+"<label>Tên tab 1 tiếng anh </label>"
					+"<input class='form-control' type='text' name='en_tab_1' />"
					+"</div>"

					+"<label>Nội dung tab 1 tiếng việt</label>"
					+"<textarea  name='vn_tab_introduce' ></textarea>"
					+"<br> <label>Nội dung tab 1 tiếng anh</label>"
					+"<textarea  name='en_tab_introduce'></textarea>"

					+"<div class='form-group'>"
					+"<label>Tên tab 2 tiếng việt </label>"
					+"<input class='form-control' type='text' name='vn_tab_2' />"
					+"</div>"
					+"<div class='form-group'>"
					+"<label>Tên tab 2 tiếng anh </label>"
					+"<input class='form-control' type='text' name='en_tab_2' />"
					+"</div>"

					+"<label>Nội dung tab 2 tiếng việt</label>"
					+"<textarea  name='vn_tab_tech' ></textarea>"
					+"<br> <label>Nội dung tab 2 tiếng anh</label>"
					+"<textarea  name='en_tab_tech'></textarea>"

					+"<div class='form-group'>"
					+"<label>Tên tab 3 tiếng việt </label>"
					+"<input class='form-control' type='text' name='vn_tab_3' />"
					+"</div>"
					+"<div class='form-group'>"
					+"<label>Tên tab 3 tiếng anh </label>"
					+"<input class='form-control' type='text' name='en_tab_3' />"
					+"</div>"

					+"<label>Nội dung tab 3 tiếng việt</label>"
					+"<textarea  name='vn_tab_using' ></textarea>"
					+"<br> <label>Nội dung tab 3 tiếng anh</label>"
					+"<textarea  name='en_tab_using'></textarea>"

					+"<div class='form-group'>"
					+"<label>Tên tab 4 tiếng việt </label>"
					+"<input class='form-control' type='text' name='vn_tab_4' />"
					+"</div>"
					+"<div class='form-group'>"
					+"<label>Tên tab 4 tiếng anh </label>"
					+"<input class='form-control' type='text' name='en_tab_4' />"
					+"</div>"

					+"<label>Nội dung tab 4 tiếng việt</label>"
					+"<textarea  name='vn_tab_link' ></textarea>"
					+"<br> <label>Nội dung tab 4 tiếng anh</label>"
					+"<textarea  name='en_tab_link'></textarea>"
			$('.tab_content').html(htmlTab);

 		}else{
 			$('.tab_content').empty();
 			$('.tab_content').css('display','none');
 		}
 		CKEDITOR.replace( 'vn_tab_introduce', {
			language: 'en',
	    	uiColor: '#F4F4F4',
		    filebrowserBrowseUrl: '/filemanager/dialog.php?type=Files',
	    	filebrowserUploadUrl: '/filemanager/dialog.php?type=Files'
		} );
 		CKEDITOR.replace( 'en_tab_introduce', {
			language: 'en',
	    	uiColor: '#F4F4F4',
		    filebrowserBrowseUrl: '/filemanager/dialog.php?type=Files',
	    	filebrowserUploadUrl: '/filemanager/dialog.php?type=Files'
		} );

		CKEDITOR.replace( 'vn_tab_tech', {
			language: 'en',
	    	uiColor: '#F4F4F4',
		    filebrowserBrowseUrl: '/filemanager/dialog.php?type=Files',
	    	filebrowserUploadUrl: '/filemanager/dialog.php?type=Files'
		} );
		CKEDITOR.replace( 'en_tab_tech', {
			language: 'en',
	    	uiColor: '#F4F4F4',
		    filebrowserBrowseUrl: '/filemanager/dialog.php?type=Files',
	    	filebrowserUploadUrl: '/filemanager/dialog.php?type=Files'
		} );

		CKEDITOR.replace( 'vn_tab_using', {
			language: 'en',
	    	uiColor: '#F4F4F4',
		    filebrowserBrowseUrl: '/filemanager/dialog.php?type=Files',
	    	filebrowserUploadUrl: '/filemanager/dialog.php?type=Files'
		} );
		CKEDITOR.replace( 'en_tab_using', {
			language: 'en',
	    	uiColor: '#F4F4F4',
		    filebrowserBrowseUrl: '/filemanager/dialog.php?type=Files',
	    	filebrowserUploadUrl: '/filemanager/dialog.php?type=Files'
		} );

		CKEDITOR.replace( 'vn_tab_link', {
			language: 'en',
	    	uiColor: '#F4F4F4',
		    filebrowserBrowseUrl: '/filemanager/dialog.php?type=Files',
	    	filebrowserUploadUrl: '/filemanager/dialog.php?type=Files'
		} );

		CKEDITOR.replace( 'en_tab_link', {
			language: 'en',
	    	uiColor: '#F4F4F4',
		    filebrowserBrowseUrl: '/filemanager/dialog.php?type=Files',
	    	filebrowserUploadUrl: '/filemanager/dialog.php?type=Files'
		} );

	}

	function checkImageRelate(){
		if($('.add_img_relate').is(':checked') == true){
			$('.img_relate_content').css('display','block');
			$('.img_relate_content').empty();
			var htmlImg = "";
				htmlImg+="<label>Hình ảnh liên quan tới Giải pháp</label>"
						+"<input class='form-control' type='file' name='userfile1'/>"
						+"<input class='form-control' type='file' name='userfile2'/>"
						+"<input class='form-control' type='file' name='userfile3'/>"
						+"<input class='form-control' type='file' name='userfile4'/>"
						+"<input class='form-control' type='file' name='userfile5'/>"
						+"<input class='form-control' type='file' name='userfile6'/>"
						+"<input class='form-control' type='file' name='userfile7'/>";

			$('.img_relate_content').html(htmlImg);
		}else{
			$('.img_relate_content').css('display','none');
			$('.img_relate_content').empty();
		}
	}

	/*Editor.basic('edit_description');
   	Editor.basic('edit_rules');
   	Editor.basic('edit_team');*/

   	CKEDITOR.replace( 'vn_synopsis_description', {
		language: 'en',
    	uiColor: '#F4F4F4',
	    filebrowserBrowseUrl: '/filemanager/dialog.php?type=Files',
    	filebrowserUploadUrl: '/filemanager/dialog.php?type=Files'
	} );

	CKEDITOR.replace( 'en_synopsis_description', {
		language: 'en',
    	uiColor: '#F4F4F4',
	    filebrowserBrowseUrl: '/filemanager/dialog.php?type=Files',
    	filebrowserUploadUrl: '/filemanager/dialog.php?type=Files'
	} );

	CKEDITOR.replace( 'vn_edit_description', {
		language: 'en',
    	uiColor: '#F4F4F4',
	    filebrowserBrowseUrl: '/filemanager/dialog.php?type=Files',
    	filebrowserUploadUrl: '/filemanager/dialog.php?type=Files'
	} );

	CKEDITOR.replace( 'en_edit_description', {
		language: 'en',
    	uiColor: '#F4F4F4',
	    filebrowserBrowseUrl: '/filemanager/dialog.php?type=Files',
    	filebrowserUploadUrl: '/filemanager/dialog.php?type=Files'
	} );

	CKEDITOR.replace( 'vn_tab_introduce', {
		language: 'en',
    	uiColor: '#F4F4F4',
	    filebrowserBrowseUrl: '/filemanager/dialog.php?type=Files',
    	filebrowserUploadUrl: '/filemanager/dialog.php?type=Files'
	} );
		CKEDITOR.replace( 'en_tab_introduce', {
		language: 'en',
    	uiColor: '#F4F4F4',
	    filebrowserBrowseUrl: '/filemanager/dialog.php?type=Files',
    	filebrowserUploadUrl: '/filemanager/dialog.php?type=Files'
	} );

	CKEDITOR.replace( 'vn_tab_tech', {
		language: 'en',
    	uiColor: '#F4F4F4',
	    filebrowserBrowseUrl: '/filemanager/dialog.php?type=Files',
    	filebrowserUploadUrl: '/filemanager/dialog.php?type=Files'
	} );
	CKEDITOR.replace( 'en_tab_tech', {
		language: 'en',
    	uiColor: '#F4F4F4',
	    filebrowserBrowseUrl: '/filemanager/dialog.php?type=Files',
    	filebrowserUploadUrl: '/filemanager/dialog.php?type=Files'
	} );

	CKEDITOR.replace( 'vn_tab_using', {
		language: 'en',
    	uiColor: '#F4F4F4',
	    filebrowserBrowseUrl: '/filemanager/dialog.php?type=Files',
    	filebrowserUploadUrl: '/filemanager/dialog.php?type=Files'
	} );
	CKEDITOR.replace( 'en_tab_using', {
		language: 'en',
    	uiColor: '#F4F4F4',
	    filebrowserBrowseUrl: '/filemanager/dialog.php?type=Files',
    	filebrowserUploadUrl: '/filemanager/dialog.php?type=Files'
	} );

	CKEDITOR.replace( 'vn_tab_link', {
		language: 'en',
    	uiColor: '#F4F4F4',
	    filebrowserBrowseUrl: '/filemanager/dialog.php?type=Files',
    	filebrowserUploadUrl: '/filemanager/dialog.php?type=Files'
	} );

	CKEDITOR.replace( 'en_tab_link', {
		language: 'en',
    	uiColor: '#F4F4F4',
	    filebrowserBrowseUrl: '/filemanager/dialog.php?type=Files',
    	filebrowserUploadUrl: '/filemanager/dialog.php?type=Files'
	} );

</script>