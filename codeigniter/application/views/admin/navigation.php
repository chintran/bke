<?php 
    $menuItems = array(array('title'=>'Dashboard', 'link'=>'/admin_man', 'action'=>'index', 'ic'=>'fa-dashboard'),
                array('title'=>'Quản lý website', 'link'=>'/admin_man/businessAreas', 'action'=>'businessAreas', 'ic'=>'fa-table'),
                array('title'=>'Quản lý Menu', 'link'=>'/menu/menuCategory', 'action'=>'menuCategory', 'ic'=>'fa-table'),
                array('title'=>'Quản lý SubMenu', 'link'=>'/menu/subMenuCategory', 'action'=>'subMenuCategory', 'ic'=>'fa-table'),
                array('title'=>'Đối tác', 'link'=>'/menu/partnerMagnager', 'action'=>'partnerMagnager', 'ic'=>'fa-table'),
                array('title'=>'Quản lý Bài Viết', 'link'=>'/article/articleMagnager', 'action'=>'articleMagnager', 'ic'=>'fa-table'),
                array('title'=>'Quản lý Banner', 'link'=>'/menu/bannerMagnager', 'action'=>'bannerMagnager', 'ic'=>'fa-table'),
                array('title'=>'Đổi Password', 'link'=>'/admin/changePass', 'action'=>'changePass', 'ic'=>'fa-table')
                /*array('title'=>'Products', 'link'=>'/admin_man/products/0', 'action'=>'products', 'ic'=>'fa-table')*/);
?>
 <!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo base_url('/admin_man'); ?>">Administrator</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> BKE  <b class="caret"></b></a>
            <ul class="dropdown-menu">
              
                <li>
                    <a href="<?php echo base_url('/admin/logout'); ?>"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav admenuclass">
            <?php 
                foreach ($menuItems as $val) { 
                    $class = ($val['action'] == $action) ? 'active' : '';
                ?>
                    <li class='item '>
                        
                        <a href='<?php echo base_url($val['link']); ?>'>
                            <i class="fa fa-fw <?php echo $val['ic']; ?>"></i><?php echo $val['title']; ?>
                        </a>
                    </li>
            <?php } ?>
        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>
