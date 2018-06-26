<?php
    require '../config.php';
    require '../classes/DbModel.php';
    require 'demo_data.php';

    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    if(isset($post['create_admin'])){

        $db = new DbModel;
        $img_url = ROOT_URL . 'assets/images/user-male.jpg';

        // Insert into MySQL
        $stmt = 'INSERT INTO users (full_name, user_name, email, password, user_type, img_url) 
                VALUES(:full_name, :user_name, :email, :password, :user_type, :img_url)';
        $db->query($stmt);

        $db->bind(':full_name', $post['full_name']);
        $db->bind(':user_name', $post['user_name']);
        $db->bind(':email', $post['email']);
        $db->bind(':password', md5($post['password']));
        $db->bind(':user_type', 'admin');
        $db->bind(':img_url', $img_url);
        $db->execute();
        // Verify
        if($db->lastInsertId()){
            // Redirect
            echo '<script>alert("New admin created successfully.");</script>';
        }
    }
    if(isset($post['create_admin_demo'])){
        //demo categories
        addCategories();
        //demo cars
        addCars();
        //demo users
        addUsers();
        //demo options
        addOptions();
        //admin creation
        $db = new DbModel;
        $img_url = ROOT_URL . 'assets/images/user-male.jpg';

        // Insert into MySQL
        $stmt = 'INSERT INTO users (full_name, user_name, email, password, user_type, img_url) 
                VALUES(:full_name, :user_name, :email, :password, :user_type, :img_url)';
        $db->query($stmt);

        $db->bind(':full_name', $post['full_name']);
        $db->bind(':user_name', $post['user_name']);
        $db->bind(':email', $post['email']);
        $db->bind(':password', md5($post['password']));
        $db->bind(':user_type', 'admin');
        $db->bind(':img_url', $img_url);
        $db->execute();
        // Verify
        if($db->lastInsertId()){
            // Redirect
            echo '<script>alert("New admin created & demo data added successfully.");</script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Setup Admin</title>
    <link rel="icon" href="<?php echo ROOT_URL ?>favicon.ico">
    <meta name="robots" content="noindex, nofollow">

    <!-- Bootstrap -->
    <link href="<?php echo ROOT_URL ?>assets/styles/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

</head>
<body>

    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Create Admin</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="<?php echo ROOT_URL . 'setup/add-admin' ?>" role="form" id="adminRegistrationForm" class="form-horizontal">

                            <div class="form-group">
                                <label for="name" class="col-sm-3 control-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="full_name" class="form-control" id="name" placeholder="Full Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user-name" class="col-sm-3 control-label">User Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="user_name" class="form-control" id="user-name" placeholder="User Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Your email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-3 control-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="confirm-password" class="col-sm-3 control-label">Confirm Password</label>
                                <div class="col-sm-9">
                                    <input type="password" name="conf_password" class="form-control" id="confirm-password" placeholder="Confirm Password">
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="check"> Prove you are human.
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <input name="create_admin" type="submit" class="btn btn-info" value="Create Admin">
                                    <input name="create_admin_demo" type="submit" class="btn btn-success" value="Create Admin & Add Demo Data">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo ROOT_URL ?>assets/styles/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo ROOT_URL; ?>assets/plugins/jquery_validation/jquery.validate.min.js"></script>
    <script src="<?php echo ROOT_URL; ?>assets/js/formValidator.js"></script>
</body>
</html>
