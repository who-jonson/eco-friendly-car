<?php

if(isset($_GET['id'])){
    $current_id = $_GET['id'];
}
else {
    $current_id = null;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Eco Friendly Car - Admin</title>
    <meta name="robot" content="noindex, nofollow">

    <!-- Bootstrap -->
    <link href="<?php echo ROOT_URL; ?>assets/styles/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo ROOT_URL; ?>assets/styles/icofont/css/icofont.css">

    <?php if($_SERVER['REQUEST_URI'] == '/eco-friendly-car/efc-admin/categories/' || $_SERVER['REQUEST_URI'] == '/eco-friendly-car/efc-admin/cars/' || $_SERVER['REQUEST_URI'] == '/eco-friendly-car/efc-admin/users' || $_SERVER['REQUEST_URI'] == '/eco-friendly-car/efc-admin/comments/'): ?>
        <link rel="stylesheet" href="<?php echo ROOT_URL; ?>assets/plugins/DataTables/datatables.min.css">
    <?php endif; ?>
    <?php if($_SERVER['REQUEST_URI'] == '/eco-friendly-car/efc-admin/profile' || $_SERVER['REQUEST_URI'] == '/eco-friendly-car/efc-admin/cars/add' || $_SERVER['REQUEST_URI'] == '/eco-friendly-car/efc-admin/cars/edit?id=' . $current_id): ?>
        <link rel="stylesheet" href="<?php echo ROOT_URL; ?>assets/plugins/ajax-img-up/style.css">
    <?php endif; ?>

    <!--Own Stylesheets-->
    <link rel="stylesheet" href="<?php echo ROOT_URL; ?>assets/styles/admin.css">
</head>
<body>

<section class="header" id="header">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">EFC-Admin</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="icofont icofont-user-alt-3"></i> <?php echo $_SESSION['user_data']['user_name'];?> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Settings</a></li>
                            <li><a href="<?php echo ROOT_URL; ?>efc-admin/profile">Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li>
                                <a href="javascript:void(0)" onclick="document.getElementById('logout-form').submit(); return false; ">
                                    Logout
                                </a>
                                <form action="<?php echo ROOT_URL; ?>" method="post" id="logout-form" style="display: none;">
                                    <input type="text" name="logout_val" value="1">
                                    <input type="submit" name="logout">
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>


</section>

<section id="main">
    <div class="sidebar-nav">
        <ul class="nav nav-pills nav-stacked">
            <li><a id="side-dashboard" href="<?php echo ROOT_URL; ?>efc-admin"><i class="icofont icofont-dashboard-web"></i> Dashboard</a></li>
            <li role="presentation" class="dropdown">
                <a id="side-cars" class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="icofont icofont-car-alt-3"></i> Cars<i class="icofont icofont-caret-right"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo ROOT_URL; ?>efc-admin/cars">All Cars</a></li>
                    <li><a href="<?php echo ROOT_URL; ?>efc-admin/cars/add">Add New</a></li>
                </ul>
            </li>
            <li role="presentation" class="dropdown">
                <a id="side-categories" class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="icofont icofont-files"></i> Categories<i class="icofont icofont-caret-right"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo ROOT_URL; ?>efc-admin/categories">All Categories</a></li>
                    <li><a href="<?php echo ROOT_URL; ?>efc-admin/categories/add">Add New</a></li>
                </ul>
            </li>
            <li><a id="side-users" href="<?php echo ROOT_URL; ?>efc-admin/users"><i class="icofont icofont-users-social"></i> Users</a></li>
            <li><a id="side-comments" href="<?php echo ROOT_URL; ?>efc-admin/comments"><i class="icofont icofont-speech-comments"></i> Comments</a></li>
            <li role="presentation" class="dropdown">
                <a id="side-settings" class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="icofont icofont-ui-settings"></i> Settings<i class="icofont icofont-caret-right"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo ROOT_URL; ?>efc-admin/site-settings">Site Settings</a></li>
                    <li><a href="<?php echo ROOT_URL; ?>efc-admin/profile">Profile</a></li>
                    <li><a href="<?php echo ROOT_URL; ?>efc-admin/contact-page">Contact</a></li>
                </ul>
            </li>
        </ul>
    </div>