<div class="row">
        <div class="col-lg-12">
			<h1 class="page-header">
			    Thay đổi Mật khẩu
			</h1>
		</div>
                <p style="color:red; display:none" id="message_info"></p>
                <div class="row">
                    <div class="col-xs-4">
                        <div class="input-group">
                            <span class="input-group-addon">Mật khẩu cũ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span>
                        
                            <input class="oldpasswd" type="password" class="form-control" name='oldpasswd' placeholder="" value="">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">

                    <div class="col-xs-4">
                        <div class="input-group">
                            <span class="input-group-addon">Mật khẩu mới &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></span>
                        
                            <input class="newpasswd" type="password" class="form-control" name='newpasswd' placeholder="" value="">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    
                    <div class="col-xs-4">
                        <div class="input-group">
                            <span class="input-group-addon">Xác nhận mật khẩu mới</span></span>
                        
                            <input class="newpasswd_repeat" type="password" class="form-control" name='newpasswd_repeat' placeholder="" value="">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-2">
                        <button type="submit" id="change_pass" class="btn btn-info">Submit</button>
                    </div>
                </div>

        <form action='<?php echo base_url('admin/changePassWord'); ?>' method='post'>
        </form>
</div>

<script type="text/javascript">
    var baseUrl = '<?php echo base_url('/admin'); ?>';
    $(function(){
        $('#change_pass').click(function() {
            var oldpasswd = $('.oldpasswd').val();
            var newpasswd = $('.newpasswd').val();
            var newpasswd_repeat = $('.newpasswd_repeat').val();
            if(newpasswd.length < 6){
                $("#message_info").text("Mật khẩu ít nhất 6 ký tự !");
                $("#message_info").css("display","block");
            }else if(newpasswd != newpasswd_repeat){
                $("#message_info").text("Mật khẩu mới chưa đúng");
                $("#message_info").css("display","block");
            }else{
                $("#message_info").css("display","none");
                $.ajax({
                    url: baseUrl + '/changePassWord',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        oldpasswd : oldpasswd,newpasswd:newpasswd
                    },
                })
                .done(function(data) {
                    if(data != "200"){
                        $("#message_info").text(data);
                        $("#message_info").css("display","block");
                    }else{
                        window.location.href = baseUrl;
                    }
                    
                 })
                 .fail( function(XMLHttpRequest, textStatus, errorThrown)  {
                    $("#message_info").text(textStatus);
                    $("#message_info").css("display","block");
                });
            }
        });
    });
    
</script>