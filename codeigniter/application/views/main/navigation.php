<!-- HEADER MAIN -->
<!--  -->
<div class="wrap_header">
    <div class="top_header">
        <div class="wrap_menu_header">
            <div class="preheader_content">
                <div class="preheader_left_content">
                    <a href="<?php echo base_url();?>" ><img width="200px" height="60px" src="<?php echo Util::loadImg($businessAreas->image_head); ?>"></a>
                </div>
                <div class="preheader_right_content">
                    <div class="top_preheader_content">
                        <?php echo $this->lang->line('language_name');?><a href="<?php echo base_url('/main/lang/vn'); ?>"><img class="preheader_img" src="<?php echo Util::loadImg('/templates/front/img/logo/flg_vn.png')?>"></a><a href="<?php echo base_url('/main/lang/en'); ?>"><img class="preheader_img" src="<?php echo Util::loadImg('/templates/front/img/logo/flg_en.png')?>"></a>
                    </div>
                    <div class="bottom_preheader_content">
                        <img class="img_hotline" src="<?php echo Util::loadImg('/templates/front/img/logo/ico_phone.png')?>"><span><?php echo $businessAreas->phone_areas; ?></span>&nbsp;&nbsp;
                        <img class="img_hotline" src="<?php echo Util::loadImg('/templates/front/img/logo/ico_fax.png')?>"><span><?php echo $businessAreas->fax_areas; ?></span>
                    </div>
                </div>
            </div>
            <div class="main_menu menu_format" >
                <nav id="topNav">
                    <ul class="menu_first_level">
                        <?php
                        $lang_code = User_Helper::ins()->getLangCode();
                        $slag = $lang_code."_name_menu";
                        $slagCaption1 = $lang_code."_caption_1";
                        $slagCaption2 = $lang_code."_caption_2";
                        $length = count($menucategory);
                        for($i=0; $i < $length; $i++){
                            if($link =='/main'){
                                $classFirt = "menu_active";
                            }else{
                                $classFirt = '';
                            }
                            if($i == 0){

                            ?>
                                <li class="<?php echo $classFirt;?> menu_uppercase"><img src="<?php echo Util::loadImg('/templates/front/img/logo/ico_home_w.png')?>"><a href="<?php echo base_url('/'); ?>" ><?php echo $menucategory[$i]->$slag; ?></a>
                                <?php if(isset($itemSubmenu[$menucategory[$i]->id])) {?>
                                    <ul>
                                        <?php 
                                            $lengthSub = count($itemSubmenu[$menucategory[$i]->id]);
                                            for($j=0; $j < $lengthSub; $j++){ ?>
                                                <li><a href="<?php echo base_url($menucategory[$i]->slug."/".$itemSubmenu[$menucategory[$i]->id][$j]->id); ?>" ><?php echo $itemSubmenu[$menucategory[$i]->id][$j]->$slag; ?></a></li>
                                        <?php }?>
                                    </ul>
                                <?php } ?>
                                </li>
                            <?php }else{
                                    $class = (strpos($link,$menucategory[$i]->slug) !== false) ? 'menu_active' : '';
                                ?>
                                <li class="<?php echo $class;?> menu_uppercase"><a href='<?php echo base_url($menucategory[$i]->slug); ?>'><?php echo $menucategory[$i]->$slag; ?></a>
                                <?php if(isset($itemSubmenu[$menucategory[$i]->id])) {?>
                                    <ul>
                                        <?php 
                                            $lengthSub = count($itemSubmenu[$menucategory[$i]->id]);
                                            for($j=0; $j < $lengthSub; $j++){ ?>
                                                <li><a href="<?php echo base_url($menucategory[$i]->slug."/".$itemSubmenu[$menucategory[$i]->id][$j]->id); ?>" ><?php echo $itemSubmenu[$menucategory[$i]->id][$j]->$slag; ?></a></li>
                                        <?php }?>
                                    </ul>
                                <?php } ?>
                                </li>
                        <?php
                            }
                        }
                        ?>
                        <div class="search">
                            <input type="text" id="key_search_web" name="">
                            <img id="search_exe" src="<?php echo Util::loadImg('/templates/front/img/logo/Icon_search.png'); ?>">
                        </div>
                    </ul>
                    <!-- Login for user -->
                    <ul class="nav navbar-nav user_action">
                        <?php $user = User_Helper::ins()->get();

                        if($user == null){
                        ?>
                            <li>
                                <a href='javascript:;' data-toggle="modal" data-target="#modal_frm_login" id='btn_student_login'><?php echo $this->lang->line('lbl_sign_in'); ?></a>
                            </li>
                        <?php }else{ ?>
                            
                        <?php
                        } ?>
                    </ul>
                    <!--  -->
                </nav>
            </div>
        </div>
    </div>
    
    <div class="row carousel-holder">

        <div class="col-md-12">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

                <ol class="carousel-indicators">
                    <?php
                    $lengthBanner = count($lstBanner);
                    for($i=0; $i < $lengthBanner; $i++){
                            if($i == 0){   
                        ?>
                            <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>" class="active">
                            </li>
                        <?php } else { ?>
                            <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i; ?>">
                            </li>
                    <?php
                            }
                        }
                    ?>
                </ol>
                <div class="carousel-inner">
                <?php
                    $lengthBanner = count($lstBanner);
                    for($i=0; $i < $lengthBanner; $i++){
                            if($i == 0){   
                        ?>
                            <div class="item active">
                                <img class="slide-image" src="<?php echo Util::loadImg($lstBanner[$i]->image); ?>" alt="">
                                <?php if($lstBanner[$i]->$slagCaption1 != "") {?>
                                    <div class="caption_content">
                                        <div class="carousel_caption_content">
                                          <h2><span><?php echo $lstBanner[$i]->$slagCaption1; ?></span></h2>
                                          <p class="caption_p"><span><?php echo $lstBanner[$i]->$slagCaption2; ?></span></p>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php }else{ ?>
                            <div class="item">
                                <img class="slide-image" src="<?php echo Util::loadImg($lstBanner[$i]->image); ?>" alt="">
                                <?php if($lstBanner[$i]->$slagCaption1 != "") {?>
                                    <div class="caption_content">
                                        <div class="carousel_caption_content">
                                          <h2><span><?php echo $lstBanner[$i]->$slagCaption1; ?></span></h2>
                                          <p class="caption_p"><span><?php echo $lstBanner[$i]->$slagCaption2; ?></span></p>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
        </div>

    </div>

    <!-- Login form -->
    <!-- Modal -->
    <div class="modal fade" id="modal_frm_login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('lbl_sign_in'); ?></h4>
          </div>

          <form action='' method='' id='frm_user_login'>
                <div class="modal-body">
                    <div class="alert alert-danger ehide" id='login_message' role="alert">
                    
                    </div>
                    <div class='form-group'>
                        <label><?php echo $this->lang->line('lbl_email'); ?></label>
                        <input type="email" name='email' id='field_email_login' class='form-control lfrequired' placeholder='<?php $this->lang->line('txt_enter_email'); ?>' />
                    </div>
                    
                    <div class='form-group'>
                        <label><?php echo $this->lang->line('lbl_password'); ?></label>
                        <input type="password" name='password' id='field_pass_login' class='form-control lfrequired' placeholder='<?php $this->lang->line('txt_enter_password'); ?>' />
                    </div>
                    
                </div>

                <div class="modal-footer row" style="margin:0; padding-bottom: 0;">
                    <div class='col-sm-6' style="padding-right:0;">
                        <input type="button" class="btn btn-primary" value='<?php echo $this->lang->line('lbl_sign_in'); ?>' id='btn_user_login' onclick="return onStudentLogin();" />
                    </div>
                </div>
          </form>
        </div>
      </div>
    </div>
</div>
<!-- END HEADER MAIN