<div id='wrap_competitions'>
	<!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
			<h1 class="page-header">
			    Quản lý banner
			</h1>
		</div>	
	</div>


	<div class="row">
        <div class="col-lg-12">
        	<div class='bound_control'>
		        <a href='<?php echo base_url('/menu/banner_form/'); ?>' class='btn btn-info'>Thêm banner</a>
        	</div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Caption 1</th>
                            <th>Caption 2</th>
                            <th>Link</th>
                            <th>Logo </th>
                            <th>Web site</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php 
                            $length = count($bannerMagnager);
                            for($i=0; $i < $length; $i++){?>
                            <tr>
                                <td width="10px"><?php echo $i+1; ?></td>
                                <td width="100px"><?php echo $bannerMagnager[$i]->vn_caption_1; ?></td>
                                <td width="100px"><?php echo $bannerMagnager[$i]->vn_caption_2; ?></td>
                                <td width="100px"><?php echo $bannerMagnager[$i]->link_banner; ?></td>
                                <td><img style='width:100px;heigth:100px;' src='<?php echo Util::loadImg($bannerMagnager[$i]->image); ?>' /></td>
                                
                                <td width="100px"><?php echo $bannerMagnager[$i]->name_menu_website; ?></td>
                                <td align='center'>
                                    <?php if($bannerMagnager[$i]->status == 0): ?>
                                        <a class="stustatus" href='<?php echo base_url('/menu/banner_alter_status/'.$bannerMagnager[$i]->id.'/'.$bannerMagnager[$i]->status); ?>' title='Vô hiệu' >
                                            <img src='<?php echo Util::loadImg('/images/admin/disable.png');?>'>
                                        </a>
                                    <?php else: ?>
                                        <a class="stustatus" href='<?php echo base_url('/menu/banner_alter_status/'.$bannerMagnager[$i]->id.'/'.$bannerMagnager[$i]->status); ?>' title='Kích hoạt'>
                                            <img src='<?php echo Util::loadImg('/images/admin/activate.png');?>'>
                                        </a>
                                    <?php endif; ?>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href='<?php echo base_url('/menu/banner_remove/'.$bannerMagnager[$i]->id); ?>' onclick='return onRemove();' title='Xóa'>
                                        <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
                                    </a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a class="stustatus" href='<?php echo base_url('/menu/banner_form/'.$bannerMagnager[$i]->id); ?>' title='Edit'>
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