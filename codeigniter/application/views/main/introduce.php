<div class="content_left">
    <div class="content_menu">
        <?php
            $lang_code = User_Helper::ins()->getLangCode();
            $slag = $lang_code."_name_menu";
            $slagDescript = $lang_code."_description";
        ?>
        <h3><?php echo $parentMenuIntroduce->$slag; ?></h3>
        <ul class="children_menu">
            <?php
            $length = count($lstIntroduceShow);
            
            for($i=0; $i < $length; $i++){
                if($link.$currentLink == $parentMenuIntroduce->slug."/".$lstIntroduceShow[$i]->id){
                    $article_name = $lstIntroduceShow[$i]->$slag;
                    $class ='chil_menu_active';
                }else{
                    $class = '';
                }
                ?>
                <li class="<?php echo $class; ?>">
                    <a href="<?php echo base_url($parentMenuIntroduce->slug."/".$lstIntroduceShow[$i]->id); ?>"><?php echo $lstIntroduceShow[$i]->$slag; ?></a>
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
            <li><a href="<?php echo base_url($parentMenuIntroduce->slug); ?>"><?php echo $parentMenuIntroduce->$slag; ?></a></li>
            <li class="" ><?php echo $article_name; ?></li>
        </ol>

        <p class="label_title"><?php echo $article_name; ?></p>
        <div class="contain_main">
            <?php 
                $length = count($articllIntroduce);
                if($length > 0)
                    echo $articllIntroduce[0]->$slagDescript; ?>
            <?php
                if($length == 0){
                ?>
                <div class="update_content">
                    <img src="<?php echo Util::loadImg('/images/maintenance.jpg'); ?>">
                </div>
                <?php
                }
            ?>
        </div>
    </div>
</div>