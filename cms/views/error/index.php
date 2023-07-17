<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= API_TITLE ?>">
    <meta name="author" content="MF">
    <title><?= (isset($this->title)) ? $this->title : API_TITLE; ?> | CERT</title>

    <link href="<?= URL ?>public/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= URL ?>public/css/fonts.css" rel="stylesheet">
    <link href="<?= URL ?>public/css/default.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="<?= URL ?>public/js/html5shiv.js"></script>
    <script src="<?= URL ?>public/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">
    <div class="row error404">
        <div class="col-md-6">
            <div class="clearfix">
                <h1>404</h1>
                <h4>You're lost.</h4>
                <p class="text-muted"><?= $this->msg ?></p><br>
                <a href="javascript:history.go(-1)" class="btn btn-danger"><i class="glyphicon glyphicon-chevron-left"></i>
                    Back</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>