<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Eco-Friendly Car</title>
    <link rel="icon" href="<?php echo ROOT_URL; ?>favicon.ico">

    <!-- Bootstrap -->
    <link href="<?php echo ROOT_URL; ?>/assets/styles/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo ROOT_URL; ?>assets/styles/icofont/css/icofont.css">
    <link rel="stylesheet" href="<?php echo ROOT_URL; ?>assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
    <!-- Style Sheets -->
    <link rel="stylesheet" href="<?php echo ROOT_URL; ?>assets/styles/style.css">

    <?php if ($_SERVER['REQUEST_URI'] != '/eco-friendly-car/register'):  ?>
        <style>
            .index-body .index-main .registration-form { margin-top: 140px; }
            @media screen and (max-width: 767px) {
                .index-body .index-footer { position: fixed; margin-top: 0; }
            }

        </style>
    <?php endif; ?>
</head>
<body>
<div class="index-body" style="background-image: url('<?php echo ROOT_URL; ?>/assets/images/indexBackground.jpg')">
    <section id="index-header" class="index-header">
        <nav class="navbar navbar-default">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo ROOT_URL; ?>">
                        <img src="<?php echo ROOT_URL; ?>assets/images/logo.png" alt="Eco-Friendly Car" class="img-responsive">
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?php echo ROOT_URL; ?>about">About</a></li>
                        <li><a href="<?php echo ROOT_URL; ?>contact">Contact</a></li>
                        <?php if ($_SERVER['REQUEST_URI'] != '/eco-friendly-car/register'):  ?>
                            <li class="index-login-btn"><a href="<?php echo ROOT_URL . 'register'; ?>">Register</a></li>
                        <?php else: ?>
                            <li class="index-login-btn"><a href="<?php echo ROOT_URL; ?>">Login</a></li>
                        <?php endif; ?>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </section>
    <section id="index-main" class="index-main">
