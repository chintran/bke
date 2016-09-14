<div id='wrap_competitions'>
	<!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
			<h1 class="page-header">
			    Quản lý SubMenu
			</h1>
		</div>	

        <div class="col-xs-4">
            <div class="input-group">
                <span class="input-group-addon">Search by Menu</span>
                <select id="menu_article_id" class="form-control text-center" name="menu_article_id">
                     <option value="0">----</option>
                    <?php 
                        $length = count($comboMenu);
                        for($i=0; $i < $length; $i++){
                    ?>
                            <option value="<?php echo $comboMenu[$i]->id; ?>"><?php echo $comboMenu[$i]->vn_name_menu; ?></option>;
                    <?php  
                        }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <br>

	<div class="row">
        <div class="col-lg-12">
        	<div class='bound_control'>
		        <a href='<?php echo base_url('/menu/subMenuCategory_form/'); ?>' class='btn btn-info'>Tạo mới SubMenu</a>
        	</div>

            <div class="table-responsive">
                <table id="submenu_table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên Menu Tiếng Việt</th>
                            <th>Tên Menu Tiếng Anh</th>
                            <th>Tên Menu Cha</th>
                            <th>Tên Website</th>
                            <th>Vị trí</th>
                            <th>Hình</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php 
                            $length = count($subMenuCategory);
                            for($i=0; $i < $length; $i++){?>
                            <tr>
                                <td width="10px"><?php echo $i+1; ?></td>
                                <td width="80px">
                                    <?php echo $subMenuCategory[$i]->vn_name_menu; ?>
                                </td>
                                <td width="80px"><?php echo $subMenuCategory[$i]->en_name_menu; ?></td>
                                <td width="80px"><?php echo $subMenuCategory[$i]->parent_submenu_name; ?></td>
                                <td width="150px"><?php echo $subMenuCategory[$i]->name_menu_website; ?></td>
                                <td width="20px"><?php echo $subMenuCategory[$i]->position; ?></td>
                                <td><img style='width:100px;heigth:100px;' src='<?php echo Util::loadImg($subMenuCategory[$i]->image); ?>' /></td>
                                <td align='center'>
                                    <?php if($subMenuCategory[$i]->status == 0): ?>
                                        <a class="stustatus" href='<?php echo base_url('/menu/subMenu_alter_status/'.$subMenuCategory[$i]->id.'/'.$subMenuCategory[$i]->status); ?>' title='Vô hiệu' >
                                            <img src='<?php echo Util::loadImg('/images/admin/disable.png');?>'>
                                        </a>
                                    <?php else: ?>
                                        <a class="stustatus" href='<?php echo base_url('/menu/subMenu_alter_status/'.$subMenuCategory[$i]->id.'/'.$subMenuCategory[$i]->status); ?>' title='Kích hoạt'>
                                            <img src='<?php echo Util::loadImg('/images/admin/activate.png');?>'>
                                        </a>
                                    <?php endif; ?>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href='<?php echo base_url('/menu/subMenuCategory_remove/'.$subMenuCategory[$i]->id); ?>' onclick='return onRemove();' title='Xóa'>
                                        <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
                                    </a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a class="stustatus" href='<?php echo base_url('/menu/subMenuCategory_form/'.$subMenuCategory[$i]->id); ?>' title='Edit'>
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
    var baseUrl = '<?php echo base_url('/menu'); ?>';
    var baseUrlImgData = '<?php echo Util::loadImg('');?>';
    var baseUrlImg = '<?php echo Util::loadImg('/images/admin');?>';
    function onRemove(){
        return confirm("Do you want to remove it?");
    }

    $(function(){

        $("#menu_article_id").change(function(){
            var menuArticleId = $("#menu_article_id").val();

            if(menuArticleId == ""){
                alert("Vui lòng chọn điều kiện search !");
            }else{
                $.ajax({
                    url: baseUrl+"/searhSubMenuAjax",
                    type: 'POST',
                    dataType: 'JSON',
                    data:{menuArticleId:menuArticleId}
                })
                .done(function(data){
                    $('#submenu_table tbody tr').remove();
                    var htmlContent = "";
                    $.each(data, function (index, value) {
                        htmlContent+="<tr>"
                                +"<td width='10px'>"+(index + 1)+"</td>"
                                +"<td width='80px'>"+value['vn_name_menu']+"</td>"
                                +"<td width='80px'>"+value['en_name_menu']+"</td>"
                                +"<td width='50px'>"+value['parent_submenu_name']+"</td>"
                                +"<td width='150px'>"+value['name_menu_website']+"</td>"
                                +"<td width='20px'>"+value['position']+"</td>"
                                +"<td > <img style='width:100px;heigth:100px;' src='"+baseUrlImgData+"/"+value['image']+"' > </td>"
                                +"<td align='center'>";
                                if(value['status'] == 0){
                                    htmlContent+="<a class='stustatus' href='"+baseUrl+"/subMenu_alter_status/"+value['id']+"/"+value['status']+"' title='Vô hiệu' >"
                                    +"<img src='"+baseUrlImg+"/disable.png' > </a>"
                                }else{
                                    htmlContent += "<a class='stustatus' href='"+baseUrl+"/subMenu_alter_status/"+value['id']+"/"+value['status']+"' title='Vô hiệu' >"
                                    +"<img src='"+baseUrlImg+"/activate.png' > </a>"
                                }
                                htmlContent+= "&nbsp;&nbsp;&nbsp;<a href='"+baseUrl+"/subMenuCategory_remove/"+value['id']+"' onclick='return onRemove();' title='Xóa'>"
                                        +"<span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span>  </a>"
                                   
                                    +"&nbsp;&nbsp;&nbsp;<a class='stustatus' href='"+baseUrl+"/subMenuCategory_form/"+value['id']+"' title='Edit'>"
                                    +"<img src='"+baseUrlImg+"/edit.png'></a>"
                                +"</td>"
                            +"</tr>";
                    });

                    $('#submenu_table tbody').append(htmlContent);
                })
                .fail( function(XMLHttpRequest, textStatus, errorThrown)  {
                    console.log(textStatus);
                });

            }
        });
    });

</script>
