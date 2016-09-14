<div class="content_left">
    <div class="content_menu">
        <?php
            $lang_code = User_Helper::ins()->getLangCode();
            $slag = $lang_code."_name_menu";
        ?>
        <h3><?php echo $parentShow->$slag; ?></h3>
        <ul class="children_menu">
            <?php
            $lang_code = User_Helper::ins()->getLangCode();
            $slag = $lang_code."_name_menu";
            $slagDescript = $lang_code."_description";
            $slagIntro = $lang_code."_tab_introduce";
            $slagTech = $lang_code."_tab_tech";
            $slagUsin = $lang_code."_tab_using";
            $slagLink = $lang_code."_tab_link";


            $slagTab1 = $lang_code."_tab_1";
            $slagTab2 = $lang_code."_tab_2";
            $slagTab3 = $lang_code."_tab_3";
            $slagTab4 = $lang_code."_tab_4";

            $length = count($lstShowHome);
            for($i=0; $i < $length; $i++){

                if($currentLink == $lstShowHome[$i]->id){
                    $article_name = $lstShowHome[$i]->$slag;
                    $class ='chil_menu_active';
                }else{
                    $class = '';
                }
                ?>
                    <li class="<?php echo $class; ?>">
                        <a href="<?php echo base_url($parentShow->slug."/".$lstShowHome[$i]->id); ?>"><?php echo $lstShowHome[$i]->$slag; ?></a>
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
            echo $articleSolutionItem->$slagtitle; ?></p>
        <div class="contain_main">
           <div class="solution_detail_top">
                <div class="img_solution_detail">
                    <div class="solu_show">
                        <img src="<?php echo Util::loadImg($articleSolutionItem->image)?>">
                    </div>
                    <div class="lst_solu_image">
                        <div class="carouselSolution">
                            <ul>
                                <li><img src="<?php echo Util::loadImg($articleSolutionItem->image)?>"></li>
                                <?php

                                for($i=1; $i < 8; $i++){
                                    $imgShow = 'image'.$i;
                                    if($articleSolutionItem->$imgShow != '') {
                                ?>
                                    <li><img src="<?php echo Util::loadImg($articleSolutionItem->$imgShow);?>"></li>

                                <?php 
                                    }
                                }
                                 ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="content_solution_detail">
                    <p class="title_content_solution_detail"><img width="16px" height="16px" src="<?php echo Util::loadImg('/images/detail.png'); ?>">&nbsp;&nbsp;<?php echo $this->lang->line('feature');?> </p>
                    <?php echo $articleSolutionItem->$slagDescript; ?>
                </div>
           </div>
           <div class="solution_detail_bottom">
               <ul class="nav nav-tabs">
                    <?php if($articleSolutionItem->$slagTab1 != "") {?>
                    <li class="active"><a data-toggle="tab" href="#home"><?php echo $articleSolutionItem->$slagTab1; ?></a></li>
                    <?php } ?>
                    <?php if($articleSolutionItem->$slagTab2 != "") {?>
                    <li><a data-toggle="tab" href="#specification"><?php echo $articleSolutionItem->$slagTab2; ?></a></li>
                    <?php } ?>
                    <?php if($articleSolutionItem->$slagTab3 != "") {?>
                    <li><a data-toggle="tab" href="#principle"><?php echo $articleSolutionItem->$slagTab3; ?></a></li>
                    <?php } ?>
                    <?php if($articleSolutionItem->$slagTab4 != "") {?>
                    <li><a data-toggle="tab" href="#tab_download"><?php echo $articleSolutionItem->$slagTab4; ?></a></li>
                    <?php } ?>
                </ul>
                <div class="tab-content">
                    <?php if($articleSolutionItem->$slagTab1 != "") {?>
                        <div id="home" class="tab-pane fade in active">
                            <?php echo $articleSolutionItem->$slagIntro; ?>
                        </div>
                    <?php } ?>
                    <?php if($articleSolutionItem->$slagTab2 != "") {?>
                        <div id="specification" class="tab-pane fade">
                            <?php echo $articleSolutionItem->$slagTech; ?>
                        </div>
                    <?php } ?>
                    <?php if($articleSolutionItem->$slagTab3 != "") {?>
                        <div id="principle" class="tab-pane fade">
                            <?php if($articleSolutionItem->$slagTab3 != "") echo $articleSolutionItem->$slagUsin; ?>
                        </div>
                    <?php } ?>
                    <?php if($articleSolutionItem->$slagTab4 != "") {?>
                        <div id="tab_download" class="tab-pane fade">
                            <?php if($articleSolutionItem->$slagTab4 != "") echo $articleSolutionItem->$slagLink; ?>
                        </div>
                    <?php } ?>
                </div>
           </div>
        </div>
    </div>
</div>