<div id='wrap_competitions'>
	<!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
			<h1 class="page-header">
			    Quản lý website
			</h1>
		</div>	
	</div>


	<div class="row">
        <div class="col-lg-12">
        	<div class='bound_control'>
		        <a href='<?php echo base_url('/admin_man/businessAreas_form/'); ?>' class='btn btn-info'>Tạo mới website</a>
        	</div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã đại diện</th>
                            <th>Tên website</th>
                            <th>Logo </th>
                            <th>Địa chỉ </th>
                            <th>Điện thoại </th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php 
                            $length = count($businessAreas);
                            for($i=0; $i < $length; $i++){?>
                            <tr>
                                <td width="10px"><?php echo $i+1; ?></td>
                                <td width="10px"><?php echo $businessAreas[$i]->code_areas; ?></td>
                                <td width="80px">
                                     <a class="stustatus" href='<?php echo base_url('/admin_man/productsBusiArea/'.$businessAreas[$i]->id); ?>' title='Edit'>
                                        <?php echo $businessAreas[$i]->vn_name_areas; ?>
                                    </a>
                                </td>
                                <td><img style='width:80px;heigth:80px;' src='<?php echo Util::loadImg($businessAreas[$i]->image); ?>' /></td>
                                <td width="150px"><?php echo $businessAreas[$i]->vn_address_areas; ?></td>
                                <td width="10px"><?php echo $businessAreas[$i]->phone_areas; ?></td>
                                <td align='center'>
                                    <?php if($businessAreas[$i]->status == 0): ?>
                                        <a class="stustatus" href='<?php echo base_url('/admin_man/business_alter_status/'.$businessAreas[$i]->id.'/'.$businessAreas[$i]->status); ?>' title='Vô hiệu' >
                                            <img src='<?php echo Util::loadImg('/images/admin/disable.png');?>'>
                                        </a>
                                    <?php else: ?>
                                        <a class="stustatus" href='<?php echo base_url('/admin_man/business_alter_status/'.$businessAreas[$i]->id.'/'.$businessAreas[$i]->status); ?>' title='Kích hoạt'>
                                            <img src='<?php echo Util::loadImg('/images/admin/activate.png');?>'>
                                        </a>
                                    <?php endif; ?>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href='<?php echo base_url('/admin_man/businessAreas_remove/'.$businessAreas[$i]->id); ?>' onclick='return onRemove();' title='Xóa'>
                                        <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
                                    </a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a class="stustatus" href='<?php echo base_url('/admin_man/businessAreas_form/'.$businessAreas[$i]->id); ?>' title='Edit'>
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