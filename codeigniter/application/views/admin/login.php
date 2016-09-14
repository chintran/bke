<?php 
$class = '';
if(isset($error)){
	$class = 'error';
}
?>
<div id='wrap_login'>
	<img width="150px" height="50px" src="<?php echo Util::loadImg('/images/admin/logo.png');?>" >
	<h3>Phần mềm quản trị website</h3>
	<?php if($class == 'error'): ?>
		<div class="alert alert-danger" role="alert">
			Your login attempt was not successful
		</div>
	<?php endif; ?>
	<form action='<?php echo base_url('admin/login'); ?>' method='post'>
		<div  class="bound_login form_group <?php echo $class; ?>">

			<div class='table_login'>
				<div class='bound_input form-group'>
					<input class='form-control' name='username' type='text' maxlength="50"  value='' placeholder='Username'/>
				</div>
				
				<div class='bound_input form-group'>
					<input class='form-control' name='password' type='password' maxlength="50" value='' placeholder='Password' />
				</div>
		
			</div>
			<div class='control'>
				<input class="btn btn-primary" type='submit'  value='Đăng nhập'/>
			</div>
			
		</div>
	</form>
	<div class="support_info">
	</div>
</div>

