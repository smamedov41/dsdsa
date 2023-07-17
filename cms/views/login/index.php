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

    <link rel="icon" type="image/x-icon" href="<?= URL ?>favicon.ico" />

    <title><?=API_TITLE?></title>
    <link href="//fonts.googleapis.com/css?family=Roboto:400,400i,700,700i&amp;subset=cyrillic,latin-ext" rel="stylesheet">
    <link href="<?= URL ?>public/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= URL ?>public/css/default.css" rel="stylesheet">
    <?php
    if (isset($this->css)) {
        foreach ($this->css as $css) {
            ?><link href="<?= URL ?>public/<?= $css ?>" rel="stylesheet"><?php
        }
    }
    ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?= URL ?>public/js/html5shiv.js"></script>
    <script src="<?= URL ?>public/js/respond.min.js"></script>
    <![endif]-->

</head>

<body class="login-body">
<div class="container-fluid login">
    <div class="login-panel">
        <div class="panel-heading">
            <h3 class="panel-title"><?= Lang::get('{Content Management System}') ?></h3>
            <p><?= Lang::get('{Log in to your account}') ?></p>
        </div>
        <div class="login-form">
            <?php
            // show alert
            $alert = Session::get('note_error') ? Session::get('note_error') : NULL;
            if(isset($alert->headerError)){
                Func::headerAlert($alert->headerError);
                Session::delete('note_error');
            }
            ?>
            <form role="form" action="<?= URL ?>login/run" method="post">
                <?php $unique_form_name = Func::csrf_token_unique_form_name('admin'); ?>

                <input type="hidden" name="admin_csrf_name" value="<?= $unique_form_name ?>">
                <input type="hidden" name="admin_csrf_token" value="<?= Func::csrf_token_generate($unique_form_name) ?>">

                <div class="form-group">
                    <input class="form-control" placeholder="<?= Lang::get('{Username}') ?>" name="data_login" type="text" autofocus autocomplete="off" required>
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="<?= Lang::get('{Password}') ?>" name="data_password" type="password" required>
                </div>
                <?php
                if($this->recaptca){
                    ?>

                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="<?= RECAPTCHA_SITEKEY ?>"></div>
                        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                    </div>
                    <?php
                }
                ?>

                <button class="btn btn-lg btn-success btn-block"><?= Lang::get('{ENTER}') ?></button>
            </form>

        </div>
        <footer>© Copyright <?= date('Y') ?></footer>
    </div>
</div>
<?php
if (isset($this->js)) {
    foreach ($this->js as $js) {
        ?><script src="<?= URL ?>public/<?= $js ?>"></script><?php
    }
}
?>
</body>
</html>
