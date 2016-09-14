<div id='wrap_competitions'>
	<!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
			<h1 class="page-header">
			    Quản lý bài viết
			</h1>
		</div>
        
        <div class="col-xs-4">
            <div class="input-group">
                <span class="input-group-addon">Search by Menu</span>
                <select id="menu_article_id" class="form-control text-center" name="menu_article_id">
                     <option value="">----</option>
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

        <div class="col-xs-4">
            <div class="input-group">
                <span class="input-group-addon">Search by Submenu</span>
                <select id="sub_menu_article_id" class="form-control text-center" name="sub_menu_article_id">
                <option value="">----</option>
                </select>
            </div>
        </div>

        <div class="col-xs-2">
            <button type="button" id="search_article" class="btn btn-info">Tìm kiếm bài viết</button>
        </div>

	</div>
    <br>

	<div class="row">
        <div class="col-lg-12">
        	<div class='bound_control'>
		        <a href='<?php echo base_url('/article/article_form/'); ?>' class='btn btn-info'>Tạo mới bài viết</a>
        	</div>

            <div class="table-responsive">
                <table id="article_table" class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tiêu đề VN</th>
                            <th>Tiêu đề VN</th>
                            <th>Tên Menu</th>
                            <th>Tên SubMenu</th>
                            <th>Website</th>
                            <th>Vị trí</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php 
                            $length = count($articleList);
                            for($i=0; $i < $length; $i++){?>
                            <tr>
                                <td width="10px"><?php echo $i+1; ?></td>
                                <td width="80px">
                                    <?php echo $articleList[$i]->vn_title_name; ?>
                                </td>
                                <td width="80px"><?php echo $articleList[$i]->en_title_name; ?></td>
                                <td width="50px"><?php echo $articleList[$i]->menu_article_name; ?></td>
                                <td width="50px"><?php echo $articleList[$i]->sub_menu_article_name; ?></td>
                                <td width="50px"><?php echo $articleList[$i]->name_article_website; ?></td>
                                <td width="30px" align='center'><?php echo $articleList[$i]->position; ?></td>
                                <td align='center'>
                                    <?php if($articleList[$i]->status == 0): ?>
                                        <a class="stustatus" href='<?php echo base_url('/article/article_alter_status/'.$articleList[$i]->id.'/'.$articleList[$i]->status); ?>' title='Vô hiệu' >
                                            <img src='<?php echo Util::loadImg('/images/admin/disable.png');?>'>
                                        </a>
                                    <?php else: ?>
                                        <a class="stustatus" href='<?php echo base_url('/article/article_alter_status/'.$articleList[$i]->id.'/'.$articleList[$i]->status); ?>' title='Kích hoạt'>
                                            <img src='<?php echo Util::loadImg('/images/admin/activate.png');?>'>
                                        </a>
                                    <?php endif; ?>
                                    &nbsp;&nbsp;&nbsp;
                                    <a href='<?php echo base_url('/article/article_remove/'.$articleList[$i]->id); ?>' onclick='return onRemove();' title='Xóa'>
                                        <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
                                    </a>
                                    &nbsp;&nbsp;&nbsp;
                                    <a class="stustatus" href='<?php echo base_url('/article/article_form/'.$articleList[$i]->id); ?>' title='Edit'>
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
    var baseUrl = '<?php echo base_url('/article'); ?>';
    var baseUrlImg = '<?php echo Util::loadImg('/images/admin');?>';
	function onRemove(){
		return confirm("Do you want to remove it?");
	}

    $(function(){

        $("#menu_article_id").change(function(){
            var articleId = $("#menu_article_id").val();
            if(articleId != ""){
                $.ajax({
                    url: baseUrl + "/subMenuAjax",
                    type: 'POST',
                    dataType:'JSON',
                    data:{articleId:articleId}
                })
                .done(function(data){
                    $('#sub_menu_article_id').find('option').remove();
                    var lstOption = "<option value=0 ></option>";
                    $.each(data, function (index, value) {
                        var splitData = value.split("_");
                        lstOption += "<option value="+splitData[0]+">"+splitData[1]+"</option>";
                    });

                    $("#sub_menu_article_id").append(lstOption);
                })
                .fail( function(XMLHttpRequest, textStatus, errorThrown)  {
                    console.log(textStatus);
                });
            }else{
                $('#sub_menu_article_id').find('option').remove();
            }
        });

        $("#search_article").click(function(){
            var menuArticleId = $("#menu_article_id").val();
            var subMenuArticleId = $("#sub_menu_article_id").val();
            if(menuArticleId == ""){
                alert("Vui lòng chọn điều kiện search !");
            }else{
                $.ajax({
                    url: baseUrl+"/searhArticleAjax",
                    type: 'POST',
                    dataType: 'JSON',
                    data:{menuArticleId:menuArticleId,subMenuArticleId:subMenuArticleId}
                })
                .done(function(data){
                    $('#article_table tbody tr').remove();
                    var htmlContent = "";
                    $.each(data, function (index, value) {
                        htmlContent+="<tr>"
                                +"<td width='10px'>"+(index + 1)+"</td>"
                                +"<td width='80px'>"+value['vn_title_name']+"</td>"
                                +"<td width='80px'>"+value['en_title_name']+"</td>"
                                +"<td width='50px'>"+value['menu_article_name']+"</td>"
                                +"<td width='50px'>"+value['sub_menu_article_name']+"</td>"
                                +"<td width='50px'>"+value['name_article_website']+"</td>"
                                +"<td width='30px'>"+value['position']+"</td>"
                                +"<td align='center'>";
                                if(value['status'] == 0){
                                    htmlContent+="<a class='stustatus' href='"+baseUrl+"/article_alter_status/"+value['id']+"/"+value['status']+"' title='Vô hiệu' >"
                                    +"<img src='"+baseUrlImg+"/disable.png' > </a>"
                                }else{
                                    htmlContent += "<a class='stustatus' href='"+baseUrl+"/article_alter_status/"+value['id']+"/"+value['status']+"' title='Vô hiệu' >"
                                    +"<img src='"+baseUrlImg+"/activate.png' > </a>"
                                }
                                htmlContent+= "&nbsp;&nbsp;&nbsp;<a href='"+baseUrl+"/article_remove/"+value['id']+"' onclick='return onRemove();' title='Xóa'>"
                                        +"<span class='glyphicon glyphicon-remove-circle' aria-hidden='true'></span>  </a>"
                                   
                                    +"&nbsp;&nbsp;&nbsp;<a class='stustatus' href='"+baseUrl+"/article_form/"+value['id']+"' title='Edit'>"
                                    +"<img src='"+baseUrlImg+"/edit.png'></a>"
                                +"</td>"
                            +"</tr>";
                    });

                    $('#article_table tbody').append(htmlContent);
                })
                .fail( function(XMLHttpRequest, textStatus, errorThrown)  {
                    console.log(textStatus);
                });

            }
        });
    });

</script>