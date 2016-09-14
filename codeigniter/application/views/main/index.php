<p class="title_welcome"><?php echo $this->lang->line('welcome_title');?></p>
<div class="welcome_contain">
    <div class="wel_article_contain">
        <?php 
            $lang_code = User_Helper::ins()->getLangCode();
            $slagTitle = $lang_code."_title_name";
            $slagDescript = $lang_code."_description";
            $slagDescriptSynopsis = $lang_code."_synopsis_description";
            $length = count($articleCategory);
            if($length > 0){
        ?>
        <p class="title_article"><?php
        
        echo $articleCategory[0]->$slagTitle; ?></p>
        <?php echo $articleCategory[0]->$slagDescript; ?>
    </div>
    <div class="wel_img">
        <img src="<?php echo Util::loadImg($articleCategory[0]->image)?>">
    </div>

    <?php } ?>
    
</div>
<div class="middle_left">
    <header>
        <h3 class="label_header"><?php echo $this->lang->line('solution_customer');?></h3>
    </header>
    <div class="solution_sec">

        <?php
        $lang_code = User_Helper::ins()->getLangCode();
        $slag = $lang_code."_name_menu";
        $length = count($lstShowHome);
        for($i=0; $i < $length; $i++){
            ?>
                <div class="content_solution">
                    <a href="<?php echo base_url($parentShow->slug."/".$lstShowHome[$i]->id); ?>" title=""> 
                        <img src="<?php echo Util::loadImg($lstShowHome[$i]->image);?>">
                        <p><?php echo $lstShowHome[$i]->$slag; ?></p>
                    </a>
                </div>
        <?php
            }
        ?>
    </div>
</div>

<div class="middle_right">
    <header>
        <h3 class="label_header"><?php echo $this->lang->line('customer_talk');?></h3>
        <a class="right" href="#customer_talk" data-slide="next">
            <img src="<?php echo Util::loadImg('/images/arr_right.png')?>">
        </a>
        <a class="left" href="#customer_talk" data-slide="prev">
            <img src="<?php echo Util::loadImg('/images/arr_left.png')?>">
        </a>
        
    </header>
    <div class="solution_sec">
        <div id="customer_talk" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php
                $length = count($articllProject);
                if($length >= 2)
                for($i=0; $i < $length; $i++){?>
                    <?php if($i == 1) {?>
                        <div class="item active">
                            <a href="<?php echo base_url("/main/projectDetail/".$articllProject[$i]->id); ?>" title=""> 
                                <img class="slide-image" src="<?php echo Util::loadImg($articllProject[$i]->image) ?>" alt="">
                            </a>
                            <div class="content_customer_talk">
                                  <?php echo $articllProject[$i]->$slagDescriptSynopsis; ?>
                                    
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="item">
                            <a href="<?php echo base_url("/main/projectDetail/".$articllProject[$i]->id); ?>" title=""> 
                                <img class="slide-image" src="<?php echo Util::loadImg($articllProject[$i]->image) ?>" alt="">
                            </a>
                            <div class="content_customer_talk">
                                  <?php echo $articllProject[$i]->$slagDescriptSynopsis; ?>
                            </div>
                        </div>
                <?php }
                    }
                 ?>

                
                
            </div>
            
        </div>
    </div>
</div>
<div class="after_contain">
    <header>
        <h3 class="label_header"><?php echo $this->lang->line('customer_partner');?></h3>
        <a class="strategic_partner_right " href="#" data-slide="next">
            <img src="<?php echo Util::loadImg('/images/arr_right.png')?>">
        </a>
        <a class="strategic_partner_left" href="#" data-slide="prev">
            <img src="<?php echo Util::loadImg('/images/arr_left.png')?>">
        </a>
        
    </header>
    <div class="solution_sec">
        <div id="parterCarousel">
            <div class="jcarouselPartner">
                <ul>
                    <?php
                    $length = count($partnerCategory);
                    for($i=0; $i < $length; $i++){?>
                        <li>
                            <a class="img-responsive" href="<?php echo $partnerCategory[$i]->link_partner;?>"><img src="<?php echo Util::loadImg($partnerCategory[$i]->image);?>" class="img-responsive center-block"></a>
                        </li>
                    <?php 
                        }
                     ?>
                </ul>
            </div>
        </div>
    </div>
</div>