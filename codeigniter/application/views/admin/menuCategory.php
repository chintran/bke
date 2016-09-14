<div id='wrap_competitions'>
	<!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
			<h1 class="page-header">
			    Quản lý Menu
			</h1>
		</div>	
	</div>


	<div class="row">
        <div class="col-lg-12">
        	<div class='bound_control'>
		        <a href='<?php # /*echo base_url('/menu/menuCategory_form/');*/ ?>' class='btn btn-info'>Tạo mới Menu</a>
        	</div>

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên Menu Tiếng Việt</th>
                            <th>Tên Menu Tiếng Anh</th>
                            <th>Tên Website</th>
                            <th>Vị trí menu</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php 
                            $length = count($menuCategory);
                            for($i=0; $i < $length; $i++){?>
                            <tr>
                                <td width="10px"><?php echo $i+1; ?></td>
                                <td width="80px">
                                    <?php echo $menuCategory[$i]->vn_name_menu; ?>
                                </td>
                                <td width="80px"><?php echo $menuCategory[$i]->en_name_menu; ?></td>
                                <td width="150px"><?php echo $menuCategory[$i]->name_menu_website; ?></td>
                                <td width="150px"><?php echo $menuCategory[$i]->position; ?></td>
                                <td align='center'>
                                    <?php if($menuCategory[$i]->status == 0): ?>
                                        <a class="stustatus" href='<?php echo base_url('/menu/menu_alter_status/'.$menuCategory[$i]->id.'/'.$menuCategory[$i]->status); ?>' title='Vô hiệu' >
                                            <img src='<?php echo Util::loadImg('/images/admin/disable.png');?>'>
                                        </a>
                                    <?php else: ?>
                                        <a class="stustatus" href='<?php echo base_url('/menu/menu_alter_status/'.$menuCategory[$i]->id.'/'.$menuCategory[$i]->status); ?>' title='Kích hoạt'>
                                            <img src='<?php echo Util::loadImg('/images/admin/activate.png');?>'>
                                        </a>
                                    <?php endif; ?>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href='<?php /*echo base_url('/menu/menuCategory_remove/'.$menuCategory[$i]->id);*/ ?>' onclick='return onRemove();' title='Xóa'>
                                        <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
                                    </a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a class="stustatus" href='<?php echo base_url('/menu/menuCategory_form/'.$menuCategory[$i]->id); ?>' title='Edit'>
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