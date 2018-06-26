<?php
session_start();

require '../config.php';
require '../classes/Functions.php';

Functions::checkLogging();

if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']){
    if($_SESSION['user_data']['type'] != 'admin'){
        header('Location: ' . ROOT_URL . 'cars');
    }
}

$_SESSION['last_visited'] = 'http://localhost' . $_SERVER['REQUEST_URI'];

include 'includes/header.php';
?>
    <div class="main-content">
        <ol class="breadcrumb">
            <li><a href="#"><i class="icofont icofont-home"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>

        <div class="content-element">
            <div class="dashboard">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="user-image text-center">
                            <img src="<?php echo $_SESSION['user_data']['img_url']; ?>" class="img-responsive img-thumbnail img-circle">
                        </div>
                        <h3 class="text-center"><?php echo $_SESSION['user_data']['name']; ?></h3>
                        <p class="text-center text-muted"><?php echo $_SESSION['user_data']['email']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    var activeNav = document.getElementById("side-dashboard");
    activeNav.classList.add("active");
</script>
<?php include 'includes/footer.php'; ?>
