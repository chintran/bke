<div class="row">

<div class="col-md-3">
    <ul class="breadcrumb">
        <li><a href="<?php echo base_url('/main/index'); ?>">Trang chủ</a></li>
        <li class="active">Sản phẩm</li>
    </ul>
    <div class="list-group groupArea">
        <?php 
            $length = count($businessAreas);
            for($i=0; $i < $length; $i++){?>
                <a href="<?php echo base_url('/main/productArea/'.$businessAreas[$i]->id); ?>" class="list-group-item <?php echo $businessAreas[$i]->id; ?>"><?php echo $businessAreas[$i]->name_areas; ?></a>
        <?php
            }
        ?>
    </div>

    <div class="sidebar-products clearfix">
        <h2>Bestsellers</h2>
         <?php 
            $length = count($bestProduct);
            for($i=0; $i < $length; $i++){?>
                <div class="item">
                    <a href="<?php echo base_url('/main/productDetail/'.$bestProduct[$i]->id.'/'.$bestProduct[$i]->business_area); ?>"><img src="<?php echo Util::loadImg($bestProduct[$i]->image); ?>" alt="best"></a>
                    <h3><a href="<?php echo base_url('/main/productDetail/'.$bestProduct[$i]->id.'/'.$bestProduct[$i]->business_area); ?>"><?php echo $bestProduct[$i]->name; ?></a></h3>
                    <div class="price">
                        <span class="price_valnew" itemprop="price"><?php echo $bestProduct[$i]->cur_price; ?></span><span class="price__symbol">$</span>
                    </div>
                </div>
        <?php
            }
        ?>
    </div>
</div>

<div class="col-md-9">

    <div class="row carousel-holder">

        <div class="col-md-12">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="item active">
                        <img class="slide-image" src="<?php echo Util::loadImg('/images/banner/bn_dt.jpg'); ?>" alt="">
                    </div>
                    <div class="item">
                        <img class="slide-image" src="<?php echo Util::loadImg('/images/banner/bn_perfume1.jpg'); ?>" alt="">
                    </div>
                    <div class="item">
                        <img class="slide-image" src="<?php echo Util::loadImg('/images/banner/bn_mp1.jpg'); ?>" alt="">
                    </div>
                    <div class="item">
                        <img class="slide-image" src="<?php echo Util::loadImg('/images/banner/bn_perfume2.jpg'); ?>" alt="">
                    </div>
                    <div class="item">
                        <img class="slide-image" src="<?php echo Util::loadImg('/images/banner/bn_mp2.jpg'); ?>" alt="">
                    </div>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
        </div>

    </div>

    <div class="row">
        <?php 
            $length = count($products);
            for($i=0; $i < $length; $i++){?>
                <div class="col-sm-4 col-lg-4 col-md-4">
                    <div class="thumbnail">
                        <img style="width:260px;height:180px;" src="<?php echo Util::loadImg($products[$i]->image); ?>" alt="">
                        <div class="caption">
                            <span class='price_value'><?php echo $products[$i]->old_price; ?>$</span>
                            <span class="price_new">
                                    <span class="price_valnew" itemprop="price"><?php echo $products[$i]->cur_price; ?>$</span>
                                    <span class="price_discount">-<?php echo $products[$i]->discount_percent; ?>%</span>
                            </span>
                            <h4><a href="<?php echo base_url('/main/productDetail/'.$products[$i]->id.'/'.$products[$i]->business_area); ?>">Chi tiết</a>
                            </h4>
                            <p><?php echo $products[$i]->product_intro; ?></p>
                        </div>
                        <div class="ratings">
                            <p class="pull-right">15 reviews</p>
                            <p>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                            </p>
                        </div>
                    </div>
                </div>
        <?php
            }
        ?>

    </div>

</div>

</div>