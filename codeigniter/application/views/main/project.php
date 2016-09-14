<div class="content_left">
    <div class="content_menu">
        <?php
            $lang_code = User_Helper::ins()->getLangCode();
            $slag = $lang_code."_name_menu";
        ?>
        <h3><?php echo $parentMenuProject->$slag; ?></h3>
        <ul class="children_menu">
            <?php
            $length = count($lstProjectShow);
            for($i=0; $i < $length; $i++){
                if($link.$currentLink == $parentMenuProject->slug."/".$lstProjectShow[$i]->id){
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

        <p class="label_title"><?php echo $article_name; ?></p>
        <div class="contain_main">
           <?php
            $lang_code = User_Helper::ins()->getLangCode();
            $slagTitle = $lang_code."_title_name";
             $slagDescript = $lang_code."_synopsis_description";
            $length = count($articllProject);
            for($i=0; $i < $length; $i++){
                ?>
                    <div class="content_project_lst">
                            <a href="<?php echo base_url("/main/projectDetail/".$articllProject[$i]->id); ?>" title=""> 
                            <p><?php echo $articllProject[$i]->$slagTitle; ?></p></a>
                            <div class="img_show">
                                <a href="<?php echo base_url("/main/projectDetail/".$articllProject[$i]->id); ?>" title=""> 
                                <img src="<?php echo Util::loadImg($articllProject[$i]->image);?>">
                                </a>
                            </div>
                            <div class="description_show">
                                <p><?php echo $articllProject[$i]->$slagDescript; ?></p>
                            </div>
                            
                    </div>
            <?php
                }
                if($length == 0){
                ?>
                <div class="update_content">
                    <img src="<?php echo Util::loadImg('/images/maintenance.jpg'); ?>">
                </div>
                <?php
                }
            ?>

        </div>
        <div class="paging_div">
            
            <ul class="pagination">
                <?php
                    for($j=0; $j < $totalPage; $j++){
                 ?>
                    <?php if($j == $curPage) { ?>
                        <li class='active'><a href="#"><?php echo $j+1; ?></a></li>
                    <?php }else{ ?>
                        <li><a href="<?php echo base_url("/main/project/".$curProjectId."/".$j); ?>"><?php echo $j+1; ?></a></li>
                    <?php }?>
                <?php 
                }
                ?>
            </ul>
        </div>
    </div>
</div>