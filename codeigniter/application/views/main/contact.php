<div class="wrap_content_contact">
    <?php
        $lang_code = User_Helper::ins()->getLangCode();
        $slag = $lang_code."_name_menu";
    ?>
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url("/"); ?>"><?php echo $menucategory[0]->$slag; ?></a></li>
        <li class="" ><?php if(isset($lstContactShow[0])) echo $lstContactShow[0]->$slag; ?></li>
    </ol>

    <h3 class="label_header"><?php if(isset($lstContactShow[0])) echo $lstContactShow[0]->$slag; ?></h3>
    <div class="contain_contact">
        <div class="info_contact contact_format">
            <?php
            $lang_code = User_Helper::ins()->getLangCode();
            $slagName = $lang_code."_name_areas";
            $slagbusi = $lang_code."_address_areas";
            $length = count($businessAreasContact);
            for($i=0; $i < $length; $i++){
            ?>
                <div class="contact_brand">
                <p class="title_branch"><?php echo $businessAreasContact[$i]->$slagName; ?></p>
                <p>
                    <img width="16px" height="16px" src="<?php echo Util::loadImg('/images/ico_home.png'); ?>">
                    <span>
                        <strong>
                            <?php echo $this->lang->line('address');?> :
                        </strong>
                    </span>
                     <?php echo $businessAreasContact[$i]->$slagbusi; ?>
                </p>
                <div class="contact_group">
                    <p>
                        <img width="16px" height="16px" src="<?php echo Util::loadImg('/images/ico_phone.png'); ?>">
                        <span>
                            <strong>
                                <?php echo $this->lang->line('phone');?>:
                            </strong>
                        </span>
                        <?php echo $businessAreasContact[$i]->phone_areas; ?>
                    </p>
                    <p>
                        <img width="16px" height="16px" src="<?php echo Util::loadImg('/images/ico_email.png'); ?>">
                        <span>
                            <strong>
                                <?php echo $this->lang->line('email');?>:
                            </strong>
                            <?php echo $businessAreasContact[$i]->email_areas; ?>
                        </span>
                    </p>
                </div>
                <div class="contact_group">
                    <p>
                        <img width="16px" height="16px" src="<?php echo Util::loadImg('/images/ico_fax.png'); ?>">
                        <span>
                            <strong>
                                <?php echo $this->lang->line('fax');?>:
                            </strong>
                        </span>
                        <?php echo $businessAreasContact[$i]->fax_areas; ?>
                    </p>
                    <p>
                        <img width="16px" height="16px" src="<?php echo Util::loadImg('/images/ico_web.png'); ?>"> 
                        <span>
                            <strong>
                                <?php echo $this->lang->line('web');?>:
                            </strong>
                        </span>
                        <?php echo $businessAreasContact[$i]->link_areas; ?>
                    </p>
                </div>
                
            </div>
            <?php
                }
            ?>
            
        </div>
        <div class="map_contact contact_format">
            <div id="map_canvas">
                <div style="text-decoration:none; overflow:hidden; height:100%; width:100%; max-width:100%;"><div id="embed-map-display" style="height:100%; width:100%;max-width:100%;"><iframe style="height:100%;width:100%;border:0;" frameborder="0" src="https://www.google.com/maps/embed/v1/search?q=36/57+Đường+D2,+Phường+25,+Sài+Gòn,+quận+Bình+Thạnh,+Ho+Chi+Minh,+Vietnam&key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU"></iframe></div><a class="google-map-html" href="https://www.hostingreviews.website/dreamhost-review" id="auth-map-data">dreamhost review</a><style>#embed-map-display img{max-width:none!important;background:none!important;font-size: inherit;}</style></div><script src="https://www.hostingreviews.website/google-maps-authorization.js?id=210fc064-f726-3cf1-c35f-6210fbdc65f3&c=google-map-html&u=1467291964" defer="defer" async="async"></script>
            </div>
        </div>
    </div>
</div>