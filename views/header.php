<!DOCTYPE html>
<html class="no-js" lang="az">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= isset($this->def[1]) ? $this->def[1] : '' ?></title>
    <meta name="description" content="<?= isset($this->def[2]) ? $this->def[2] : '' ?>">
    <meta name="keywords" content="<?= isset($this->def[3])? $this->def[3] : '' ?>">
    <meta name="author" content="MF">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="144x144" href="<?=URL?>public/assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=URL?>public/assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=URL?>public/assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?=URL?>public/assets/img/favicon/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <!-- CSS
		============================================ -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?=URL?>public/assets/css/bootstrap.min.css">
    <!-- FontAwesome CSS -->
    <link rel="stylesheet" href="<?=URL?>public/assets/css/font-awesome.min.css">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="<?=URL?>public/assets/css/flaticon.min.css">
    <!-- Slick Slider CSS -->
    <link rel="stylesheet" href="<?=URL?>public/assets/css/plugins/slick.min.css">
    <!-- CSS Animation CSS -->
    <link rel="stylesheet" href="<?=URL?>public/assets/css/plugins/cssanimation.min.css">
    <!-- Justified Gallery CSS -->
    <link rel="stylesheet" href="<?=URL?>public/assets/css/plugins/justifiedGallery.min.css">
    <!-- Light Gallery CSS -->
    <link rel="stylesheet" href="<?=URL?>public/assets/css/plugins/light-gallery.min.css">
    <!-- Vendor & Plugins CSS (Please remove the comment from below vendor.min.css & plugins.min.css for better website load performance and remove css files from avobe) -->
    <!--
		<link rel="stylesheet" href="<?=URL?>public/assets/css/vendor.min.css">
		<link rel="stylesheet" href="<?=URL?>public/assets/css/plugins/plugins.min.css">
		-->
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="<?=URL?>public/assets/css/fonts.css">
    <link rel="stylesheet" href="<?=URL?>public/assets/css/style.css">
    <link rel="stylesheet" href="<?=URL?>public/assets/css/default.css">

    <?php
    if (isset($this->css)) {
        foreach ($this->css as $css) {
            ?><link href="<?= URL ?>public/<?= $css ?>" rel="stylesheet"><?php
        }
    }
    ?>
</head>
<body>
    <!--====================  header area ====================-->
    <div class="header-area header-sticky bg-img space__inner--y40 background-repeat--x background-color--dark d-none d-lg-block" data-bg="<?=URL?>public/assets/img/icons/ruler.png">
        <!-- header top -->
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="header-top-info">
                            <span class="fa fa-volume-control-phone header-icon"></span>
                            <span class="header-top-info__text"><?= isset($this->def[4])? $this->def[4] : '' ?></span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="header-top-info text-center">
                            <span class="fa fa-clock-o header-icon"></span>
                            <span class="header-top-info__text"><?= isset($this->def[5])? $this->def[5] : '' ?></span>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="header-top-info text-right">
                            <span class="fa fa-map-marker header-icon"></span>
                            <span class="header-top-info__text"><?= isset($this->def[6])? $this->def[6] : '' ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- menu bar -->
        <div class="menu-bar position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="menu-bar-wrapper background-color--default space__inner--x35">
                            <div class="menu-bar-wrapper-inner">
                                <div class="row align-items-center">
                                    <div class="col-lg-2">
                                        <div class="brand-logo">
                                            <a href="<?=URL.MF::$_lang?>">
                                                <img src="<?=URL?>public/assets/img/logo-big.svg" class="img-fluid" alt="Logo">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="navigation-area d-flex justify-content-end align-items-center">
                                            <!-- navigation menu -->
                                            <nav class="main-nav-menu">
                                                <ul class="d-flex justify-content-end">
                                                    <?php
                                                    if(isset($this->menuHeader) && !empty($this->menuHeader)) {
                                                        foreach ($this->menuHeader as $key=>$value) {
                                                            if(isset($value['sub']) && !empty($value['sub'])) {
                                                                ?>
                                                                <li class="has-sub-menu">
                                                                    <a href="<?=Func::create_link($value)?>"><?= $value['title'] ?></a>
                                                                    <ul class="sub-menu">
                                                                        <?php
                                                                        foreach ($value['sub'] as $key1 => $value1) {
                                                                            ?><li><a href="<?=Func::create_link($value1)?>"><?= $value1['title'] ?></a></li><?php
                                                                        }
                                                                        ?>
                                                                    </ul>
                                                                </li>
                                                                <?php
                                                            } else {
                                                                ?><li><a href="<?=Func::create_link($value)?>"><?= $value['title'] ?></a></li><?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                    <li class="langs">
                                                        <?php
                                                        $actual_link = $_SERVER['REQUEST_URI'];
                                                        $actual_link = explode('/', $actual_link);
                                                        $mas = [];
                                                        if(isset($actual_link) && !empty($actual_link)){
                                                            foreach ($actual_link as $key=>$value){
                                                                if(is_string($value)){
                                                                    $mas[] = Func::filter_string($value);
                                                                }
                                                            }
                                                            unset($mas[0], $mas[1]);
                                                        }
                                                        $mas = implode('/', $mas);
                                                        foreach (MF::$_langs as $key=>$value){
                                                            ?><a href="<?=URL.$key.'/'.$mas?>" title="<?=$value?>"><img src="<?=URL?>public/assets/img/<?=$key?>.png"></a> <?php
                                                        }
                                                        ?>
                                                    </li>
                                                </ul>
                                            </nav>
                                            <!-- search icon nav menu -->
                                            <!--div class="nav-search-icon">
                                                <button class="header-search-toggle"><i class="fa fa-search"></i></button>
                                                <div class="header-search-form">
                                                    <form action="#">
                                                        <input type="text" placeholder="Type and hit enter">
                                                        <button><i class="fa fa-search"></i></button>
                                                    </form>
                                                </div>
                                            </div-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====================  End of header area  ====================-->

    <!--====================  mobile header ====================-->
    <div class="mobile-header header-sticky bg-img space__inner--y30 background-repeat--x background-color--dark d-block d-lg-none" data-bg="<?=URL?>public/assets/img/icons/ruler.png">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-6">
                    <div class="brand-logo">
                        <a href="<?=URL.MF::$_lang?>">
                            <img src="<?=URL?>public/assets/img/logo-white.png" class="img-fluid" alt="Logo">
                        </a>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mobile-menu-trigger-wrapper text-right" id="mobile-menu-trigger">
                        <span class="mobile-menu-trigger"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====================  End of mobile header  ====================-->

    <!--====================  offcanvas mobile menu ====================-->
    <div class="offcanvas-mobile-menu" id="mobile-menu-overlay">
        <a href="javascript:void(0)" class="offcanvas-menu-close" id="mobile-menu-close-trigger">
            <span class="menu-close"></span>
        </a>
        <div class="offcanvas-wrapper">
            <div class="offcanvas-inner-content">

                <nav class="offcanvas-navigation">
                    <ul>
                        <?php
                        if(isset($this->menuHeader) && !empty($this->menuHeader)) {
                            foreach ($this->menuHeader as $key=>$value) {
                                if(isset($value['sub']) && !empty($value['sub'])) {
                                    ?>
                                    <li class="menu-item-has-children">
                                        <a href="<?=Func::create_link($value)?>"><?= $value['title'] ?></a>
                                        <ul class="sub-menu-mobile">
                                            <?php
                                            foreach ($value['sub'] as $key1 => $value1) {
                                                ?><li><a href="<?=Func::create_link($value1)?>"><?= $value1['title'] ?></a></li><?php
                                            }
                                            ?>
                                        </ul>
                                    </li>
                                    <?php
                                } else {
                                    ?><li><a href="<?=Func::create_link($value)?>"><?= $value['title'] ?></a></li><?php
                                }
                            }
                        }
                        ?>
                        <li class="langs">
                            <?php
                            $actual_link = $_SERVER['REQUEST_URI'];
                            $actual_link = explode('/', $actual_link);
                            $mas = [];
                            if(isset($actual_link) && !empty($actual_link)){
                                foreach ($actual_link as $key=>$value){
                                    if(is_string($value)){
                                        $mas[] = Func::filter_string($value);
                                    }
                                }
                                unset($mas[0], $mas[1]);
                            }
                            $mas = implode('/', $mas);
                            foreach (MF::$_langs as $key=>$value){
                                ?><a href="<?=URL.$key.'/'.$mas?>" title="<?=$value?>"><img src="<?=URL?>public/assets/img/<?=$key?>.png"></a> <?php
                            }
                            ?>
                        </li>
                    </ul>
                </nav>
                <div class="offcanvas-widget-area">
                    <div class="off-canvas-contact-widget">
                        <div class="header-contact-info">
                            <ul class="header-contact-info__list">
                                <li><i class="fa fa-phone"></i> <?= isset($this->def[4])? $this->def[4] : '' ?></li>
                            </ul>
                        </div>
                    </div>
                    <!--Off Canvas Widget Social Start-->
                    <div class="off-canvas-widget-social">
                        <?php
                        if(isset($this->def[9]) && !empty($this->def[9])){
                            ?><a href="<?= $this->def[9] ?>" target="_blank"><i class="fa fa-facebook"></i></a> <?php
                        }
                        if(isset($this->def[10]) && !empty($this->def[10])){
                            ?><a href="<?= $this->def[10] ?>" target="_blank"><i class="fa fa-twitter"></i></a> <?php
                        }
                        if(isset($this->def[11]) && !empty($this->def[11])){
                            ?><a href="<?= $this->def[11] ?>" target="_blank"><i class="fa fa-instagram"></i></a> <?php
                        }
                        ?>
                    </div>
                    <!--Off Canvas Widget Social End-->
                </div>
            </div>
        </div>
    </div>
    <!--====================  End of offcanvas mobile menu  ====================-->