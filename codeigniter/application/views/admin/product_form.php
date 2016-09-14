<?php $subhead = ($product->id == null) ? 'Create New' : 'Edit';
MHtml_Helper::tinymce();
?>
<div id='wrap_schools_form'>
    <div class="row">
        <div class="col-lg-12">
			<h1 class="page-header">
			    Product Form
			    <small><?php echo $subhead; ?></small>
			</h1>
			<ol class="breadcrumb">
                <li>
                    <i class="fa fa-fw fa-table"></i>  <a href="<?php echo base_url('/admin_man/products'); ?>">Products</a>
                </li>
                <li class="active">
                    <i class="fa fa-fw fa-edit"></i> Form
                </li>
            </ol>

			<form action='' method='post' id='frm_products'  enctype="multipart/form-data">
				<div class='row'>
					<div class="col-lg-12">
						<div class='form-group'>
							<label>Product Code</label>
							<input class='form-control' type="text" name='code_product' value="<?php echo $product->code_product; ?>" required/>
						</div>
						<div class='form-group'>
							<label>Product Name</label>
							<input class='form-control' type="text" name='name' value="<?php echo $product->name; ?>" required/>
						</div>	

						<div class='form-group'>
							<label>Business Areas</label>
							
							<select name="business_area" id="business_area" class="input-large form-control">
								<?php 
		                    		$length = count($comboArea);
		                    		for($i=0; $i < $length; $i++){
		                    		if($product->business_area == $comboArea[$i]->id){ ?>
		                    			<option value="<?php echo $comboArea[$i]->id; ?>" selected><?php echo $comboArea[$i]->name_areas; ?></option>;
		                    		<?php }else{ ?>
		                    			<option value="<?php echo $comboArea[$i]->id; ?>"><?php echo $comboArea[$i]->name_areas; ?></option>;
		                    	<?php	}
		                    		}
		                    	 ?>
							</select>
						</div>

						<div class='form-group'>
							<label>Image</label>
							<?php if(!empty($product->image)): ?>
								<div>
									<img style='width:100px;heigth:100px;' src='<?php echo Util::loadImg($product->image); ?>' />
								</div>
							<?php endif; ?>
							<input class='form-control' type="file" name='image' value="<?php echo $product->image; ?>"/>
						</div>

						<div class='form-group'>
							<label>Old price</label>
							<input id="old_price" class='form-control' type="text" name='old_price' value="<?php echo $product->old_price; ?>" />
						</div>

						<div class='form-group'>
							<label>Curent Price</label>
							<input id="cur_price" class='form-control' type="text" name='cur_price' value="<?php echo $product->cur_price; ?>" />
						</div>
						

						<div class='form-group'>
							<label>Discount Percent (%)</label>
							<input id="discount_percent" class='form-control' type="text" name='discount_percent' value="<?php echo $product->discount_percent; ?>" />
						</div>

						<div class='form-group'>
							<label>Description</label>
							<textarea  name='description' id='edit_description'><?php echo $product->description; ?></textarea>
						</div>

						<div class='form-group'>
							<label>Introduction</label>
							<textarea  name='introduction' id='edit_introduction'><?php echo $product->product_intro; ?></textarea>
						</div>

					</div>
				</div>
				<div class='form-group text-center'>
					<input type='reset' value='Reset' class='btn btn-default' /> 
					<input type='submit' value='Submit' class='btn btn-primary'  name='submit' /> 
				</div>
				<?php if($product->id != null){ ?>
					<input type="hidden" value='<?php echo $product->id; ?>' name='id' />
					<input type="hidden" value='<?php echo Util::loadImg($product->image); ?>' name='oldImg' />
					<input type="hidden" value='<?php echo Util::loadImg($product->thumn_img); ?>' name='oldThumnImg' />
				<?php
				} ?>
			</form>	
		</div>	
	</div>
</div>

 <script type="text/javascript">
 	
 	$(function(){
 		$("#cur_price").focusout(function(){
 			var curPrice = $("#cur_price").val();
 			var oldPrice = $("#old_price").val();
 			if(curPrice == "" || oldPrice == ""){
 				$("#discount_percent").val(0);
 			}else{
 				var perCent = (oldPrice - curPrice)/oldPrice * 100;
 				$("#discount_percent").val(perCent.toFixed(2));
 			}
 		});
 	});

    Editor.basic('edit_description');
    Editor.basic('edit_introduction');
   	Editor.basic('edit_rules');
   	Editor.basic('edit_team');


</script>