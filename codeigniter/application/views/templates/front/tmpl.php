<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo $document['template_url']; ?>/ico/favicon.ico" type="image/x-icon">
    <title><?php echo $title_page; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo $document['css_url']; ?>bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $document['css_url']; ?>font-awesome.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo $document['css_url']; ?>index.css" rel="stylesheet">
    <link href="<?php echo $document['css_url']; ?>jcarousel.css" rel="stylesheet">
</head>
<body>
    <!-- END PRE-HEADER -->

	<!-- Navigation -->
    <?php echo $navigation; ?>

    <!-- Page Content -->
    <!-- BODY -->
    <div class="wrap_contain">
        <div class="content_main">
            <?php echo $contents; ?>
        </div>
    </div>
    <!-- END BODY -->
  	<!-- FOOTER -->
    <div class="wrap_footer">
        <div class="wrap_contain footer_top">
            <div class="footer_block_logo">
                <?php 
                $lang_code = User_Helper::ins()->getLangCode();
                    $slagbusi = $lang_code."_address_areas";
                    $slagname = $lang_code."_name_areas";
                 ?>
                 <p class="footer_name_company"><?php echo $businessAreas->$slagname; ?></p>
                 <p><img src="<?php echo Util::loadImg('/templates/front/img/logo/ico_home_w.png')?>"> &nbsp;&nbsp;<?php echo $businessAreas->$slagbusi; ?></p>
                 <p><img src="<?php echo Util::loadImg('/templates/front/img/logo/ico_phone_w.png')?>">&nbsp;&nbsp;<?php echo $businessAreas->phone_areas; ?>&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo Util::loadImg('/templates/front/img/logo/ico_fax_w.png')?>">&nbsp;&nbsp;<?php echo $businessAreas->fax_areas; ?></p>
            </div>
            <div class="footer_block footer_boder">
                <ul class="footer_menu">
                    <?php
                    $slag = $lang_code."_name_menu";
                    $length = count($menucategory);
                    for($i=0; $i < $length; $i++){
                        if($link =='/main'){
                            $classFirt = "menu_active";
                        }else{
                            $classFirt = '';
                        }
                        if($i == 0){

                        ?>
                            <li><img src="<?php echo $document['img_url']; ?>logo/img_arrow.png"><a href="<?php echo base_url('/'); ?>" ><?php echo $menucategory[$i]->$slag; ?></a>
                            </li>
                        <?php }else{
                                $class = (strpos($link,$menucategory[$i]->slug) !== false) ? 'menu_active' : '';
                            ?>
                            <li><img src="<?php echo $document['img_url']; ?>logo/img_arrow.png"><a href='<?php echo base_url($menucategory[$i]->slug); ?>'><?php echo $menucategory[$i]->$slag; ?></a>
                            </li>
                    <?php
                        }
                    }
                    ?>
                    
                </ul>
            </div>
            <div class="footer_block_logo footer_boder">
                <ul class="footer_menu">

                    <?php
                    $length = count($lstShowHome);
                    for($i=0; $i < $length; $i++){
                        ?>
                            <li>
                                <img src="<?php echo $document['img_url']; ?>logo/img_arrow.png"><a href="<?php echo base_url($parentShow->slug."/".$lstShowHome[$i]->id); ?>"><?php echo $lstShowHome[$i]->$slag; ?></a>
                            </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
            <div class="footer_block footer_boder">
                <ul class="footer_menu">
                    <li>
                        <img src="<?php echo $document['img_url']; ?>logo/ico_face.png"><a href="<?php echo $businessAreas->facebook_areas; ?>">&nbsp;&nbsp;&nbsp;&nbsp; FaceBook</a>
                    </li>
                    <li>
                        <img src="<?php echo $document['img_url']; ?>logo/ico_tw.png"><a href="<?php echo $businessAreas->twitter_areas; ?>">&nbsp;&nbsp;Twitter</a>
                    </li>
                    <li>
                        <img src="<?php echo $document['img_url']; ?>logo/ico_google.png"><a href="<?php echo $businessAreas->google_areas; ?>">&nbsp;&nbsp;Google+</a>
                    </li>
                    <li>
                        <img src="<?php echo $document['img_url']; ?>logo/ico_youtube.png"><a href="<?php echo $businessAreas->youtub_areas; ?>">&nbsp;&nbsp;Youtube</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="wrap_contain coppyright">
            Coppyright &copy; 2016
        </div>
    </div>
    <!-- jQuery -->
    <script src="<?php echo $document['js_url']; ?>jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo $document['js_url']; ?>bootstrap.min.js"></script>

    <script src="<?php echo $document['js_url']; ?>jquery.easing-1.3.js"></script>
    <script src="<?php echo $document['js_url']; ?>jquery.mousewheel-3.1.12.js"></script>
    <script src="<?php echo $document['js_url']; ?>jquery.jcarousellite.js"></script>
    <!-- END FOOTER -->
    <script type="text/javascript">
        var baseUrl = '<?php echo base_url('/main'); ?>';
        $(function(){
            
            $('.carousel[data-type="multi"] .item').each(function () {

                var next = $(this).next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }
                next.children(':first-child').clone().appendTo($(this));

                for (var i=0;i<3;i++) {
                    next=next.next();
                    if (!next.length) {
                        next = jQuery(this).siblings(':first');
                    }
                    next.children(':first-child').clone().appendTo($(this));
                }
            });
            /*Home*/
            $(".jcarouselPartner").jCarouselLite({
                btnNext: ".strategic_partner_right",
                btnPrev: ".strategic_partner_left",
                auto: 800,
                speed: 1000
            });
            /*Project*/
             $(".widgetDetail .carouselDetail").jCarouselLite({
                btnNext: ".widgetDetail .next",
                btnPrev: ".widgetDetail .prev",
                speed: 800,
                easing: "easeOutBack",
                auto: 1200
            });
            $(".widgetDetail li img").click(function() {
                $(".widgetDetail .mid img").attr("src", $(this).attr("src"));
            })

            /*solution*/
             $(".carouselSolution").jCarouselLite({
                speed: 800,
                /*visible: 4,*/
                auto: 1200
            });
            $(".carouselSolution li img").click(function() {
                $(".solu_show img").attr("src", $(this).attr("src"));
            })

            /*Search */
            $('#search_exe').click(function() {
                var keysearch = $('#key_search_web').val();
                $.ajax({
                    url: baseUrl + '/search',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        keysearch : keysearch
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
            });

            onStudentLogin();
        });

        function onStudentLogin(){
            $('input.lfrequired').each(function(index){
                var val = $(this).val();
                if($.trim(val) == '')
                    $(this).addClass('lferror');
                else
                    $(this).removeClass('lferror');
            });

            var login_message = $('#login_message');
            login_message.hide();
            if($('input.lferror').length == 0){
                API.userLogin($('#frm_user_login').serialize(), function(resp){
                    if(resp.error_code == 0)
                        location.reload();
                    else{
                        login_message.html(resp.message);
                        login_message.show();
                    }
                });
            }

        }

        $(window).load(function(){
            var maxLength = 300;
            $("#customer_talk .item").each(function(){
                /*var linkText = $('.content_customer_talk > q > p:nth-child(2)',this)[0].innerHTML;*/
                var contentText = $('.content_customer_talk  > p:first-child',this).text();
                if (contentText.length > maxLength) {
                    contentText = contentText.substr(0,maxLength) + '...';
                }
                contentText = "<p>"+contentText+"</p>";
                /*linkText = "<p>"+linkText+"</p>";*/
                $('.content_customer_talk  > p',this).remove();
                $('.content_customer_talk ',this).append(contentText);
                /*$('.content_customer_talk > q',this).after(linkText);*/
            })
            
        });
    </script>


</body>
</html>