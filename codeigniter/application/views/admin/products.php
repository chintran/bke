<div id='wrap_competitions'>
	<!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
			<h1 class="page-header">
			    Products
			</h1>
		</div>
        <div class='bound_control'>
            <a href='<?php echo base_url('/admin_man/product_form/'); ?>' class='btn btn-info'>Create New</a>
        </div>
        <div class="col-lg-12">

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Code Product</th>
                            <th>Name Product</th>
                            <th>Business Area</th>
                            <th>Image</th>
                            <th>Price Sale</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                    	<?php 
                    		$length = count($products);
                    		for($i=0; $i < $length; $i++){?>
                    		<tr>
                                <td width="10px"><?php echo $i+1; ?></td>
                                <td><?php echo $products[$i]->code_product; ?></td>
	                            <td><?php echo $products[$i]->name; ?></td>
                                <td><?php echo $products[$i]->name_areas; ?></td>
                                <td><img style='width:100px;heigth:100px;' src='<?php echo Util::loadImg($products[$i]->image); ?>' /></td>
                                <td><?php echo $products[$i]->cur_price;?>$</td>
	                            <td align='center'>
                                    <?php if($products[$i]->status == 0): ?>
                                        <a class="stustatus" href='<?php echo base_url('/admin_man/product_alter_status/'.$products[$i]->id.'/'.$products[$i]->status); ?>' title='Vô hiệu' >
                                            <img src='<?php echo Util::loadImg('/images/admin/disable.png');?>'>
                                        </a>
                                    <?php else: ?>
                                        <a class="stustatus" href='<?php echo base_url('/admin_man/product_alter_status/'.$products[$i]->id.'/'.$products[$i]->status); ?>' title='Kích hoạt'>
                                            <img src='<?php echo Util::loadImg('/images/admin/activate.png');?>'>
                                        </a>
                                    <?php endif; ?>
	                            	<a href='<?php echo base_url('/admin_man/product_remove/'.$products[$i]->id); ?>' onclick='return onRemove();'>
	                            		<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
	                            	</a>
                                    <a class="stustatus" href='<?php echo base_url('/admin_man/product_form/'.$products[$i]->id); ?>' title='Edit'>
                                        <img src='<?php echo Util::loadImg('/images/admin/edit.png');?>'>
                                    </a>
	                            </td>
	                        </tr>
                    	<?php
                    		}
                    	 ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class='wrap_pagination' style='text-align:center;'>
        <div class='pagination' >
            <?php echo $pagination; ?>
        </div>
    </div>
</div>

<script type="text/javascript">
	function onRemove(){
		return confirm("Do you want to remove it?");
	}
</script>