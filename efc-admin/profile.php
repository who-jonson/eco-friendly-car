<?php
session_start();
// Admin Profile
require '../config.php';
require '../classes/DbModel.php';
require '../classes/Functions.php';

Functions::checkLogging();

if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']){
    if($_SESSION['user_data']['type'] != 'admin'){
        header('Location: ' . ROOT_URL . 'cars');
    }
}
$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

//update profile image
if(isset($post['update_img'])){
    $db = new DbModel;

    $stmt = 'UPDATE users SET img_url = :img_url WHERE id = :id';
    $db->query($stmt);
    $db->bind(':img_url', $post['img_url']);
    $db->bind(':id', $_SESSION['user_data']['id']);
    $db->execute();

    echo '<script>alert("Profile Picture successfully updated.");</script>';
}

//update profile
if(isset($post['update_profile'])){
    $db = new DbModel;

    $stmt = 'UPDATE users SET full_name = :full_name, email = :email, user_name = :user_name WHERE id = :id';
    $db->query($stmt);
    $db->bind(':full_name', $post['name']);
    $db->bind(':email', $post['email']);
    $db->bind(':user_name', $post['user_name']);
    $db->bind(':id', $_SESSION['user_data']['id']);
    $db->execute();

    echo '<script>alert("Profile successfully updated.");</script>';
}

//update password
if(isset($post['update_password'])){
    $db = new DbModel;

    $stmt = 'SELECT * FROM users WHERE id = :id';
    $db->query($stmt);
    $db->bind(':id', $_SESSION['user_data']['id']);
    $user = $db->single();

    if($user['password'] == md5($post['old_pass'])){
        $stmt = 'UPDATE users SET password = :password WHERE id = :id';
        $db->query($stmt);
        $db->bind(':password', md5($post['new_pass']));
        $db->bind(':id', $_SESSION['user_data']['id']);
        $db->execute();

        echo '<script>alert("Password successfully updated.");</script>';
    }
    else {
        echo '<script>alert("Old password is wrong.");</script>';

    }
}



$db = new DbModel;

$stmt = 'SELECT * FROM users WHERE id = :id';
$db->query($stmt);
$db->bind(':id', $_SESSION['user_data']['id']);
$user = $db->single();

include 'includes/header.php';

?>
    <div class="main-content">
        <div class="efc-admin-body-header">
            <div class="row" style="margin-right: 0 !important;">
                <div class="col-xs-8">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo ROOT_URL?>efc-admin"><i class="icofont icofont-home"></i> Home</a></li>
                        <li class="active">Profile</li>
                    </ol>
                </div>

                <div class="col-xs-4">
                    <div class="go-back">
                        <?php if(isset($_SESSION['last_visited'])): ?>
                            <a href="<?php echo $_SESSION['last_visited']; ?>" class="btn btn-info">
                                <i class="icofont icofont-swoosh-left"></i> Go Back
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-element">
            <h3>Profile Settings</h3>
            <hr>
            <div class="row">
                <div class="col-sm-4">
                    <div class="main-up">
                        <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
                            <div id="image_preview">
                                <?php if($user['img_url'] == null): ?>
                                    <img class="img-responsive" id="previewing" src="<?php echo ROOT_URL; ?>assets/images/user.png" >
                                <?php else: ?>
                                    <img class="img-responsive" id="previewing" src="<?php echo $user['img_url']; ?>" >
                                <?php endif; ?>
                            </div>
                            <hr id="line">
                            <div id="selectImage">
                                <label>Select Your Image</label><br/>
                                <input type="file" name="file" id="file" required />
                                <input type="submit" value="Upload" class="submit" />
                            </div>
                        </form>
                        <h4 id='loading' >loading..</h4>
                        <div id="message" class="text-center"></div>
                        <!--Update img-->
                        <form action="<?php echo ROOT_URL; ?>efc-admin/profile" method="post" role="form">
                            <input type="hidden" name="img_url" value="" id="new-img-url">
                            <input type="submit" name="update_img" value="Update Image" class="submit btn btn-success">
                        </form>
                    </div>

                </div>
                <div class="col-sm-8">
                    <form id="adminUpdateProfile" action="<?php echo ROOT_URL; ?>efc-admin/profile" method="post" role="form" class="form-horizontal">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Full Name</label>
                            <div class="col-sm-9 col-md-8">
                                <input name="name" type="text" class="form-control" id="name" placeholder="Your Name" value="<?php echo $user['full_name']; ?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-9 col-md-8">
                                <input name="email" type="email" class="form-control" id="email" placeholder="Your Email" value="<?php echo $user['email']; ?>" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="user-name" class="col-sm-2 control-label">User Name</label>
                            <div class="col-sm-9 col-md-8">
                                <input name="user_name" type="text" class="form-control" id="user-name" value="<?php echo $user['user_name']; ?>" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-9 col-md-offset-2 col-md-8">
                                <input name="update_profile" type="submit" class="btn btn-success" value="Update Information">
                            </div>
                        </div>
                    </form>
                    <h4 style="margin-top: 40px;">Change Password</h4>
                    <hr>
                    <form action="<?php echo ROOT_URL; ?>efc-admin/profile" method="post" role="form" class="form-horizontal" id="adminUpdatePassword">
                        <div class="form-group">
                            <label for="old-pass" class="col-sm-2 control-label">Old Password</label>
                            <div class="col-sm-9 col-md-8">
                                <input name="old_pass" type="password" class="form-control" id="old-pass" placeholder="Old Password" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="new-pass" class="col-sm-2 control-label">New Password</label>
                            <div class="col-sm-9 col-md-8">
                                <input name="new_pass" type="password" class="form-control" id="new-pass" placeholder="New Password" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="conf-new-pass" class="col-sm-2 control-label">Confirm New Password</label>
                            <div class="col-sm-9 col-md-8">
                                <input name="conf_new_pass" type="password" class="form-control" id="conf-new-pass" placeholder="Confirm Password" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-9 col-md-offset-2 col-md-8">
                                <input name="update_password" type="submit" class="btn btn-success" value="Update Password">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        var activeNav = document.getElementById("side-settings");
        activeNav.classList.add("active");
    </script>
<?php

include 'includes/footer.php';

$_SESSION['last_visited'] = 'http://localhost' . $_SERVER['REQUEST_URI'];

?>