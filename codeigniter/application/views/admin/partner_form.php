<?php $subhead = ($partner->id == null) ? 'Create New' : 'Edit';
MHtml_Helper::tinymce();
?>
<div id='wrap_competition_form'>
    <div class="row">
        <div class="col-lg-12">
			<h1 class="page-header">
			    Quản lý đối tác
			    <small><?php echo $subhead; ?></small>
			</h1>
			<ol class="breadcrumb">
                <li>
                    <i class="fa fa-fw fa-table"></i>  <a href="<?php echo base_url('/menu/partnerMagnager'); ?>">Quản lý đối tác</a>
                </li>
                <li class="active">
                    <i class="fa fa-fw fa-edit"></i> Form
                </li>
            </ol>

        	<?php if($partner->id != null){ ?>
        	<ol class="breadcrumb">
                <li>
                    <i class="fa fa-fw fa-table"></i> 
                    <a href='<?php echo base_url('/menu/partnerMagnager/'.$partner->id); ?>'>
                    </a>
                </li>
            </ol>
			<?php
			} ?>

			<form action='' method='post' id='frm_partnerMagnager'  enctype="multipart/form-data">
				<div class='row'>
					<div class='col-sm-12'>
						<div class='form-group'>
							<label>Tên Công Ty đối tác</label>
							<input class='form-control' type="text" name='name_partner' value="<?php echo $partner->name_partner; ?>"/>
						</div>
						<div class='form-group'>
							<label>Địa chỉ website</label>
							<input class='form-control' type="text" name='link_partner' value="<?php echo $partner->link_partner; ?>"/>
						</div>
					
						<div class='form-group'>
							<label>Logo Công ty đối tác</label>
							<?php 
								$required = 'required';
								if(!empty($partner->image)): $required = ''; ?>
								<div>
									<img style='width:150px;height:100px;' src='<?php echo Util::loadImg($partner->image); ?>' />
								</div>
							<?php endif; ?>
							<input class='form-control' type="file" name='userfile' value="<?php echo $partner->image; ?>" <?php echo $required; ?>/>
						</div>
					</div>
				</div>
				

				<div class='form-group text-center'>
					<input type='reset' value='Reset' class='btn btn-default' /> 
					<input type='submit' value='Submit' class='btn btn-primary'  name='submit' /> 
				</div>
				<?php if($partner->id != null){ ?>
					<input type="hidden" value='<?php echo $partner->id; ?>' name='id' />
					<input type="hidden" value='<?php echo $partner->image; ?>' name='oldImg' />
				<?php
				} ?>
				
			</form>	
		</div>	
	</div>
</div>