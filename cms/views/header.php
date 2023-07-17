<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?=API_TITLE?>">

    <meta name="author" content="MF">
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="144x144" href="<?=URL?>public/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=URL?>public/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=URL?>public/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?=URL?>public/img/favicon/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <title><?= (isset($this->title)) ? $this->title : API_TITLE; ?> | MF-CMS v1.0</title>

    <link href="<?= URL ?>public/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= URL ?>public/css/metisMenu.min.css" rel="stylesheet">
    <?php
    if (isset($this->css)) {
        foreach ($this->css as $css) {
            ?><link href="<?= URL ?>public/<?= $css ?>" rel="stylesheet"><?php
        }
    }
    ?>

    <link href="<?= URL ?>public/css/default.css" rel="stylesheet">
    <link href="<?= URL ?>public/css/fonts.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?= URL ?>public/js/html5shiv.js"></script>
    <script src="<?= URL ?>public/js/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= URL ?>"><?=API_TITLE?></a>
        </div>

        <ul class="nav navbar-right top-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                    <i class="glyphicon glyphicon-user"></i> <span class="user"><?=Session::get('adminName')?></span> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu admin-menu">
                    <li><a href="<?= URL ?>admin"><i class="glyphicon glyphicon-user"></i> <?=Lang::get('{Profil}')?></a></li>
                    <li><a href="<?= URL ?>admin/edit/<?=Session::get('adminId')?>"><i class="glyphicon glyphicon-cog"></i> <?=Lang::get('{Redaktə et}')?></a></li>
                    <li class="divider"></li>
                    <li><a href="<?= URL ?>login/logout"><i class="glyphicon glyphicon-off"></i> <?=Lang::get('{Çıxış}')?></a></li>
                </ul>
            </li>
        </ul>

        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav side-nav metismenu" id="menu">
                <?php
                foreach (MFAdmin::$_menu_list as $key => $value) {
                    if($key!='hidden') {
                        $active = in_array($this->menu, $value)?' active':'';
                        $attr_a = in_array($this->menu, $value)?'  aria-expanded="true"':' aria-expanded="false"';
                        $count = sizeof($value);
                        if($count>1){
                            if(count(array_intersect($value, array_keys($this->admin['role'])))) {
                                ?>

                                <li class="<?= $active ?>">
                                    <a class="has-arrow<?= $active ?>" href="#"<?= $attr_a ?>><i class="glyphicon <?= MFAdmin::$_menu_icon[$key] ?>"></i> <?= Lang::get($key) ?></a>
                                    <ul>
                                        <?php
                                        foreach ($value as $v) {
                                            if (in_array($v, array_keys($this->admin['role']))) {
                                                $dot = (isset($this->menuAlert) && array_key_exists($v, $this->menuAlert) && ($this->menuAlert[$v])) ? ' class="dot"' : '';
                                                ?><li<?= $dot ?>><a href="<?= URL . $v ?>"><?= Lang::get($v) ?></a></li><?php
                                            }
                                        }
                                        ?>

                                    </ul>
                                </li>
                                <?php
                            }
                        } else {
                            if(in_array($value[0], array_keys($this->admin['role']))) {
                                ?>

                                <li class="<?=$active?>">
                                    <a class="has-arrow<?=$active?>" href="#"<?=$attr_a.$active?>><i class="glyphicon <?=MFAdmin::$_menu_icon[$key]?>"></i>  <?= Lang::get($key) ?></a>
                                    <ul>
                                        <?php
                                        foreach ($value as $v) {
                                            if (in_array($v, array_keys($this->admin['role']))) {
                                                ?>
                                                <li><a href="<?= URL . $v ?>"><?= Lang::get($v) ?></a></li>
                                                <?php
                                            }
                                        }
                                        ?>

                                    </ul>
                                </li>
                                <?php
                            }
                        }
                    }
                }
                ?>

            </ul>
        </div>
    </nav>

    <div id="page-wrapper">
        <div class="container-fluid">