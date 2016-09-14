<div class="content_left">
    <div class="content_menu">
        <?php
            $lang_code = User_Helper::ins()->getLangCode();
            $slag = $lang_code."_name_menu";
            $slagDescript = $lang_code."_description";
        ?>
        <h3><?php echo $parentMenuProject->$slag; ?></h3>
        <ul class="children_menu">
            <?php
            $length = count($lstProjectShow);
            for($i=0; $i < $length; $i++){
                if($currentLink == $lstProjectShow[$i]->id){
                    $article_name = $lstProjectShow[$i]->$slag;
                    $class ='chil_menu_active';
                }else{
                    $class = '';
                }
                ?>
                <li class="<?php echo $class; ?>">
                    <a href="<?php echo base_url($parentMenuProject->slug."/".$lstProjectShow[$i]->id); ?>"><?php echo $lstProjectShow[$i]->$slag; ?></a>
                </li>
            <?php
                }
            ?>
        </ul>
    </div>

    <div class="content_menu content_contact">
        <h3><?php echo $this->lang->line('contact_info');?></h3>
        <p class="title_contact">
            <span>
                <strong><?php echo $this->lang->line('address');?>:</strong>
            </span>
        </p>
        <?php 
        $lang_code = User_Helper::ins()->getLangCode();
            $slagbusi = $lang_code."_address_areas";
         ?>
         <p><?php echo $businessAreas->$slagbusi; ?></p>
         
        <p class="title_contact">
            <span>
                <strong><?php echo $this->lang->line('phone');?>:</strong>
            </span>
        </p>
        <p><?php echo $businessAreas->phone_areas; ?></p>
        <p class="title_contact">
            <span>
                <strong><?php echo $this->lang->line('fax');?>:</strong>
            </span>
        </p>
        <p><?php echo $businessAreas->fax_areas; ?></p>
    </div >
    <div class="hotline">
        <img src="<?php echo Util::loadImg('/images/img_hotline.png')?>">
    </div>
    
</div>

<div class="content_right">
    <div class="wrap_content_right">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url("/"); ?>"><?php echo $menucategory[0]->$slag; ?></a></li>
            <li><a href="<?php echo base_url($parentMenuProject->slug); ?>"><?php echo $parentMenuProject->$slag; ?></a></li>
            <li class="" ><?php echo $article_name; ?></li>
        </ol>

        <p class="label_title"><?php 
            $lang_code = User_Helper::ins()->getLangCode();
            $slagtitle = $lang_code."_title_name";
            echo $articllProject->$slagtitle; ?></p>
        <div class="contain_main">
            <div class="project_detail_img">
                <div class="custom-container widgetDetail">
                    <div class="mid">
                        <img src="<?php echo Util::loadImg($articllProject->image)?>" alt="1">
                    </div>
                    <div class="project_relate">
                        <div class="pro_arrow pro_arrow_prev">
                            <a href="#" class="prev"><img src="<?php echo Util::loadImg('/templates/front/img/logo/arrow_left.png')?>"></a>
                        </div>
                        <div class="lst_image">
                            <div class="carouselDetail">
                                <ul>
                                    <li><img src="<?php echo Util::loadImg($articllProject->image)?>"></li>
                                    <?php

                                    for($i=1; $i < 8; $i++){
                                        $imgShow = 'image'.$i;
                                        if($articllProject->$imgShow != '') {
                                    ?>
                                        <li><img src="<?php echo Util::loadImg($articllProject->$imgShow);?>"></li>

                                    <?php 
                                        }
                                    }
                                     ?>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="pro_arrow pro_arrow_next">
                            <a href="#" class="next"><img src="<?php echo Util::loadImg('/templates/front/img/logo/arrow_right.png')?>"></a>
                        </div>
                        
                    </div>
                </div>

           </div>
           <div class="project_detail_content">
                <?php echo $articllProject->$slagDescript; ?>
           </div>
           <div class="project_detail_relate">
               <p><?php echo $this->lang->line('relate_project');?></p>
               <div class="image_relate">
                   <?php
                    $lang_code = User_Helper::ins()->getLangCode();
                    $slag = $lang_code."_title_name";
                    $length = count($articllProjectOther);
                    for($i=0; $i < $length; $i++){
                        ?>
                        <div class="image_relate_item">
                            <figure>
                                <a href="<?php echo base_url("/main/projectDetail/".$articllProjectOther[$i]->id); ?>" title=""> 
                                    <img src="<?php echo Util::loadImg($articllProjectOther[$i]->image);?>">
                                </a>
                                <p><?php echo $articllProjectOther[$i]->$slag; ?></p>
                            </figure>
                        </div>
                    <?php
                        }
                    ?>
               </div>
           </div>
        </div>
    </div>
</div>