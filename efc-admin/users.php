<?php
/*
 * All Users Admin
 */
session_start();

require '../config.php';
require '../classes/DbModel.php';
require '../classes/Functions.php';

Functions::checkLogging();

if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']){
    if($_SESSION['user_data']['type'] != 'admin'){
        header('Location: ' . ROOT_URL . 'cars');
        exit();
    }
}

$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if(isset($post['delete_user'])){
    if($_SESSION['user_data']['id'] == $post['id']){
        header('Refresh:1; url=' . ROOT_URL . 'efc-admin/users');
        echo '<script>alert("You can not delete yourself.");</script>';
        exit();
    }
    $db = new DbModel;

    $stmt = 'DELETE FROM users WHERE id = :id';
    $db->query($stmt);

    $db->bind(':id', $post['id']);
    $db->execute();

    header('Refresh:1; url='. ROOT_URL . 'efc-admin/users');
    echo '<script>alert("User deleted successfully.");</script>';
    $db = null;
    exit();
}

$db = new DbModel;
//Select Cars
$stmt = 'SELECT * FROM users ORDER BY id DESC';
$db->query($stmt);
$users = $db->resultSet();
//Disconnect DB
$db = null;

include 'includes/header.php';

?>

<div class="main-content">
    <div class="efc-admin-body-header">
        <div class="row" style="margin-right: 0 !important;">
            <div class="col-xs-8">
                <ol class="breadcrumb">
                    <li><a href="<?php echo ROOT_URL?>efc-admin"><i class="icofont icofont-home"></i> Home</a></li>
                    <li class="active">Users</li>
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
        <h3>All Users <span class="pull-right"><a href="<?php echo ROOT_URL; ?>efc-admin/users/add" class="btn btn-info">Add New Admin</a></span></h3>
        <hr>
        <table id="allUsersTable" class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Type</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <?php $sr = 1; ?>
            <tbody>
            <?php foreach($users as $user): ?>
                <tr>
                    <td><?php echo $sr; $sr++; ?></td>
                    <?php if($user['user_type'] == 'admin'): ?>
                        <td><strong><?php echo $user['full_name']; ?></strong></td>
                        <td><strong><?php echo $user['email']; ?></strong></td>
                        <td><strong><?php echo $user['user_type']; ?></strong></td>
                    <?php else: ?>
                        <td><?php echo $user['full_name']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['user_type']; ?></td>
                    <?php endif; ?>
                    <td>
                        <p class="text-center">
                            <button title="View this user" class="btn btn-info" data-toggle="modal" data-target="#viewUser<?php echo $sr; ?>"><i class="icofont icofont-eye-alt"></i></button>
                            <button title="Delete this user" class="btn btn-danger" data-toggle="modal" data-target="#deleteUser<?php echo $sr; ?>"><i class="icofont icofont-ui-delete"></i></button>
                        </p>
                        <!-- View Modal -->
                        <div class="modal fade view-model" id="viewUser<?php echo $sr; ?>" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title text-center" id="viewModalLabel">User Details</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <h2 class="panel-title text-center"><?php echo $user['full_name']; ?></h2>
                                            </div>
                                            <div class="panel-body">
                                                <div class="user-image text-center">
                                                    <img src="<?php echo $user['img_url']; ?>" class="img-responsive img-thumbnail img-circle">
                                                </div>

                                                <table class="table table-striped table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td class="user-data-label"><strong>Email</strong></td>
                                                            <td><?php echo $user['email']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="user-data-label"><strong>Username</strong></td>
                                                            <td><?php echo $user['user_name']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="user-data-label"><strong>DOB</strong></td>
                                                            <td><?php echo $user['dob']; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <?php
                                                                $dob = date_create(date('Y-m-d', strtotime($user['dob'])));
                                                                $today = date_create(date('Y-m-d'));
                                                                $age = date_diff($dob, $today);
                                                            ?>
                                                            <td class="user-data-label"><strong>Age</strong></td>
                                                            <td><?php echo $age->format('%y Year %m Month %d Days'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="user-data-label"><strong>Gender</strong></td>
                                                            <td><?php echo ucfirst($user['gender']); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="user-data-label"><strong>Country</strong></td>
                                                            <td><?php echo $user['country']; ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button title="Delete this user" class="btn btn-danger" data-toggle="modal" data-target="#deleteUser<?php echo $sr; ?>">Delete User</button>
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteUser<?php echo $sr; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header text-center">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="deleteModalLabel">Delete User</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p class="text-center text-danger">
                                            Are you sure to delete <strong>'<?php echo $user['full_name']; ?>'</strong>?
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="<?php echo ROOT_URL; ?>efc-admin/users" method="post" role="form">
                                            <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
                                            <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                            <input name="delete_user" type="submit" class="btn btn-danger" value="Confirm">
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    var activeNav = document.getElementById("side-users");
    activeNav.classList.add("active");
</script>
<?php

include 'includes/footer.php';

$_SESSION['last_visited'] = 'http://localhost' . $_SERVER['REQUEST_URI'];

?>

