<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo (isset($sub_title))? $sub_title : ''; ?>Eco-Friendly Car</title>
    <link rel="icon" href="<?php echo ROOT_URL; ?>favicon.ico">

    <!-- Bootstrap & JS -->
    <link href="<?php echo ROOT_URL; ?>assets/styles/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Monoton" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo ROOT_URL; ?>assets/styles/icofont/css/icofont.css">

    <?php if(isset($_GET['model']) && $_GET['model'] != null): ?>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <script src="<?php echo ROOT_URL; ?>assets/plugins/stars.min.js"></script>
        <script src="<?php echo ROOT_URL; ?>assets/js/add-favorite.js"></script>
    <?php endif; ?>
    <?php if($_SERVER['REQUEST_URI'] == '/eco-friendly-car/history'): ?>
        <link rel="stylesheet" href="<?php echo ROOT_URL . 'assets/plugins/DataTables/datatables.min.css'; ?>">
    <?php endif; ?>
    <?php if($_SERVER['REQUEST_URI'] == '/eco-friendly-car/profile/'): ?>
        <link rel="stylesheet" href="<?php echo ROOT_URL . 'assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css'; ?>">
    <?php endif; ?>
    <?php if($_SERVER['REQUEST_URI'] == '/eco-friendly-car/profile/photo'): ?>
        <link rel="stylesheet" href="<?php echo ROOT_URL . 'assets/plugins/ajax-img-up/style.css'; ?>">
    <?php endif; ?>
    <!-- Style Sheets -->
    <link rel="stylesheet" href="<?php echo ROOT_URL; ?>assets/styles/home.css">
</head>
<body>
    <section id="header" class="header">
        <nav class="navbar navbar-default">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="icofont icofont-navigation-menu"></i>
                    </button>
                    <a class="navbar-brand" href="<?php echo ROOT_URL; ?>">
                        <img src="<?php echo ROOT_URL; ?>assets/images/logo-home.png" alt="Eco-Friendly Car" class="img-responsive">
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?php echo ROOT_URL . 'cars'; ?>">Cars</a></li>
                        <li><a href="<?php echo ROOT_URL . 'history'; ?>">History</a></li>
                        <li><a href="<?php echo ROOT_URL . 'favorites'; ?>">Favorites</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle user-name" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <?php if($_SESSION['user_data']['gender'] == 'male'): ?>
                                    <i class="icofont icofont-user-male"></i>
                                <?php elseif($_SESSION['user_data']['gender'] == 'female'): ?>
                                    <i class="icofont icofont-user-female"></i>
                                <?php else: ?>
                                    <i class="icofont icofont-user"></i>
                                <?php endif; ?>
                                <?php echo $_SESSION['user_data']['user_name'] ?> <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="panel panel-default">
                                    <div class="panel-body text-center">
                                        <?php if($_SESSION['user_data']['img_url'] != null): ?>
                                            <img class="img-thumbnail img-circle" src="<?php echo $_SESSION['user_data']['img_url']; ?>" alt="">
                                        <?php else: ?>
                                            <img class="img-thumbnail img-circle" src="<?php echo ROOT_URL; ?>assets/images/user.png" alt="">
                                        <?php endif; ?>

                                        <h3><?php echo $_SESSION['user_data']['name']; ?></h3>
                                        <p><?php echo $_SESSION['user_data']['age']; ?></p>
                                    </div>
                                    <div class="panel-footer">
                                        <p>
                                            <a href="<?php echo ROOT_URL . 'profile'; ?>" class="btn btn-success">Profile</a>
                                            <span class="pull-right">
                                                <a class="btn btn-danger" href="javascript:void(0)" onclick="document.getElementById('logout-form').submit(); return false; ">
                                                    Logout
                                                </a>
                                            </span>
                                        </p>
                                        <form action="<?php echo ROOT_URL; ?>" method="post" id="logout-form" style="display: none;">
                                            <input type="text" name="logout_val" value="1">
                                            <input type="submit" name="logout">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>

                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <?php if($_SESSION['user_data']['type'] == 'admin'): ?>
        <div id="dashboard-float">
            <a href="<?php echo ROOT_URL ?>efc-admin" target="_blank" title="Go To Dashboard"><i class="icofont icofont-dashboard-web"></i></a>
        </div>
        <?php endif; ?>
    </section>
    <section id="main" class="main">
