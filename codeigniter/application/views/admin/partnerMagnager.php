<div id='wrap_competitions'>
	<!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
			<h1 class="page-header">
			    Quản lý đối tác
			</h1>
		</div>	
	</div>


	<div class="row">
        <div class="col-lg-12">
        	<div class='bound_control'>
		        <a href='<?php echo base_url('/menu/partner_form/'); ?>' class='btn btn-info'>Thêm đối tác</a>
        	</div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên Công Ty</th>
                            <th>Link website</th>
                            <th>Logo </th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php 
                            $length = count($partnerMagnager);
                            for($i=0; $i < $length; $i++){?>
                            <tr>
                                <td width="10px"><?php echo $i+1; ?></td>
                                <td width="100px"><?php echo $partnerMagnager[$i]->name_partner; ?></td>
                                <td width="100px"><?php echo $partnerMagnager[$i]->link_partner; ?></td>
                                <td><img style='width:100px;heigth:100px;' src='<?php echo Util::loadImg($partnerMagnager[$i]->image); ?>' /></td>
                                <td align='center'>
                                    <?php if($partnerMagnager[$i]->status == 0): ?>
                                        <a class="stustatus" href='<?php echo base_url('/menu/partner_alter_status/'.$partnerMagnager[$i]->id.'/'.$partnerMagnager[$i]->status); ?>' title='Vô hiệu' >
                                            <img src='<?php echo Util::loadImg('/images/admin/disable.png');?>'>
                                        </a>
                                    <?php else: ?>
                                        <a class="stustatus" href='<?php echo base_url('/menu/partner_alter_status/'.$partnerMagnager[$i]->id.'/'.$partnerMagnager[$i]->status); ?>' title='Kích hoạt'>
                                            <img src='<?php echo Util::loadImg('/images/admin/activate.png');?>'>
                                        </a>
                                    <?php endif; ?>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href='<?php echo base_url('/menu/partner_remove/'.$partnerMagnager[$i]->id); ?>' onclick='return onRemove();' title='Xóa'>
                                        <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
                                    </a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a class="stustatus" href='<?php echo base_url('/menu/partner_form/'.$partnerMagnager[$i]->id); ?>' title='Edit'>
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