<?php $subhead = ($businessAreas->id == null) ? 'Create New' : 'Edit';
MHtml_Helper::tinymce();
?>
<div id='wrap_competition_form'>
    <div class="row">
        <div class="col-lg-12">
			<h1 class="page-header">
			    Quản lý website
			    <small><?php echo $subhead; ?></small>
			</h1>
			<ol class="breadcrumb">
                <li>
                    <i class="fa fa-fw fa-table"></i>  <a href="<?php echo base_url('/admin_man/businessAreas'); ?>">Quản lý website</a>
                </li>
                <li class="active">
                    <i class="fa fa-fw fa-edit"></i> Form
                </li>
            </ol>

			<form action='' method='post' id='frm_businessAreas'  enctype="multipart/form-data">
				<div class='row'>
					<div class='col-sm-12'>
						<div class='form-group'>
							<label>Mã đại diện website (BKE,BKS..)</label>
							<input class='form-control' type="text" name='code_areas' value="<?php echo $businessAreas->code_areas; ?>" required/>
						</div>
						<div class='form-group'>
							<label>Tên web site</label>
							<input class='form-control' type="text" name='vn_name_areas' value="<?php echo $businessAreas->vn_name_areas; ?>" required/>
						</div>

						<div class='form-group'>
							<label>Tên web site tiếng anh</label>
							<input class='form-control' type="text" name='en_name_areas' value="<?php echo $businessAreas->en_name_areas; ?>"/>
						</div>

						<div class='form-group'>
							<label>Địa chỉ</label>
							<input class='form-control' type="text" name='vn_address_areas' value="<?php echo $businessAreas->vn_address_areas; ?>" required/>
						</div>

						<div class='form-group'>
							<label>Địa chỉ tiếng anh</label>
							<input class='form-control' type="text" name='en_address_areas' value="<?php echo $businessAreas->en_address_areas; ?>"/>
						</div>

						<div class='form-group'>
							<label>Số điện thoại</label>
							<input class='form-control' type="text" name='phone_areas' value="<?php echo $businessAreas->phone_areas; ?>" required/>
						</div>

						<div class='form-group'>
							<label>Fax</label>
							<input class='form-control' type="text" name='fax_areas' value="<?php echo $businessAreas->fax_areas; ?>"/>
						</div>

						<div class='form-group'>
							<label>Địa chỉ web</label>
							<input class='form-control' type="text" name='link_areas' value="<?php echo $businessAreas->link_areas; ?>"/>
						</div>

						<div class='form-group'>
							<label>Email</label>
							<input class='form-control' type="text" name='email_areas' value="<?php echo $businessAreas->email_areas; ?>"/>
						</div>

						<div class='form-group'>
							<label>Tóm tắt về website</label>
							<textarea  name='description' id='edit_description'><?php echo $businessAreas->description; ?></textarea>
						</div>
					
						<div class='form-group'>
							<label>Logo website Header</label>
							<?php 
								$required = 'required';
								if(!empty($businessAreas->image_head)): $required = ''; ?>
								<div>
									<img style='width:120px;height:50px;' src='<?php echo Util::loadImg($businessAreas->image_head); ?>' />
								</div>
							<?php endif; ?>
							<input class='form-control' type="file" name='userfilehead' value="<?php echo $businessAreas->image_head; ?>" <?php echo $required; ?>/>
						</div>

						<div class='form-group'>
							<label>Logo website</label>
							<?php 
								$required = 'required';
								if(!empty($businessAreas->image)): $required = ''; ?>
								<div>
									<img style='width:120px;height:50px;' src='<?php echo Util::loadImg($businessAreas->image); ?>' />
								</div>
							<?php endif; ?>
							<input class='form-control' type="file" name='userfile' value="<?php echo $businessAreas->image; ?>" <?php echo $required; ?>/>
						</div>

						<div class='form-group'>
							<label>Tên chi nhánh tiếng việt</label>
							<input class='form-control' type="text" name='vn_branch_name' value="<?php echo $businessAreas->vn_branch_name; ?>" />
						</div>

						<div class='form-group'>
							<label>Tên chi nhánh tiếng anh </label>
							<input class='form-control' type="text" name='en_branch_name' value="<?php echo $businessAreas->en_branch_name; ?>" />
						</div>

						<div class='form-group'>
							<label>Vị trí</label>
							<input class='form-control' type="text" name='position' value="<?php echo $businessAreas->position; ?>" />
						</div>

						<div class='form-group'>
							<label>Facebook Fanpage</label>
							<input class='form-control' type="text" name='facebook_areas' value="<?php echo $businessAreas->facebook_areas; ?>" />
						</div>

						<div class='form-group'>
							<label>Twitter </label>
							<input class='form-control' type="text" name='twitter_areas' value="<?php echo $businessAreas->twitter_areas; ?>" />
						</div>

						<div class='form-group'>
							<label>Google +</label>
							<input class='form-control' type="text" name='google_areas' value="<?php echo $businessAreas->google_areas; ?>" />
						</div>

						<div class='form-group'>
							<label>Youtube</label>
							<input class='form-control' type="text" name='youtub_areas' value="<?php echo $businessAreas->youtub_areas; ?>" />
						</div>

						<div class='form-group'>
							<label>DownLoad link</label>
							<input class='form-control' type="text" name='download_areas' value="<?php echo $businessAreas->download_areas; ?>" />
						</div>

					</div>
				</div>
				

				<div class='form-group text-center'>
					<input type='reset' value='Reset' class='btn btn-default' /> 
					<input type='submit' value='Submit' class='btn btn-primary'  name='submit' /> 
				</div>
				<?php if($businessAreas->id != null){ ?>
					<input type="hidden" value='<?php echo $businessAreas->id; ?>' name='id' />
					<input type="hidden" value='<?php echo $businessAreas->image; ?>' name='oldImg' />
				<?php
				} ?>
				
			</form>	
		</div>	
	</div>
</div>

 <script type="text/javascript">
    $(function () {
        $('#picker_begin_date').datetimepicker({
       		format: 'YYYY-MM-DD'
        });
        $('#picker_end_date').datetimepicker({
        	format: 'YYYY-MM-DD'
        });
        $('#picker_start_time').datetimepicker({
        	 format: 'HH:mm'
        });
        $('#picker_end_time').datetimepicker({
        	 format: 'HH:mm'
        });
    });

    Editor.basic('edit_description');
   	Editor.basic('edit_rules');
   	Editor.basic('edit_team');


</script>