<?php
/*
 * All Cars Admin
 */
session_start();

require '../../config.php';
require '../../classes/DbModel.php';
require '../../classes/Functions.php';

Functions::checkLogging();

if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']){
    if($_SESSION['user_data']['type'] != 'admin'){
        header('Location: ' . ROOT_URL . 'cars');
        exit();
    }
}

$db = new DbModel;
//Select Cars
$stmt = 'SELECT * FROM cars ORDER BY id DESC';
$db->query($stmt);
$cars = $db->resultSet();
//Disconnect DB
$db = null;

include '../includes/header.php';

?>

<div class="main-content">
    <div class="efc-admin-body-header">
        <div class="row" style="margin-right: 0 !important;">
            <div class="col-xs-8">
                <ol class="breadcrumb">
                    <li><a href="<?php echo ROOT_URL?>efc-admin"><i class="icofont icofont-home"></i> Home</a></li>
                    <li class="active">Cars</li>
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
        <h3>All Cars <span class="pull-right"><a href="<?php echo ROOT_URL; ?>efc-admin/cars/add" class="btn btn-info">Add Car</a></span></h3>
        <hr>
        <table id="allCarsTable" class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Model</th>
                <th class="text-center">Category</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <?php $sr = 1; ?>
            <tbody>
            <?php foreach($cars as $car): ?>
                <tr>
                    <td><?php echo $sr; $sr++; ?></td>
                    <td><?php echo $car['model']; ?></td>
                    <td class="text-center">
                        <?php
                        $category = Functions::getCategoryByCar($car['category_id']);
                        echo $category['name'];
                        ?>
                    </td>
                    <td>
                        <p class="text-center">
                            <a title="View this car" href="<?php echo ROOT_URL . 'cars/' . $category['slug'] . '/' . $car['slug']; ?>" class="btn btn-info" target="_blank"><i class="icofont icofont-eye-alt"></i></a>
                            <a title="Edit this car" href="<?php echo ROOT_URL . 'efc-admin/cars/edit?id=' . $car['id']; ?>" class="btn btn-success"><i class="icofont icofont-ui-edit"></i></a>
                            <button title="Delete this car" class="btn btn-danger" data-toggle="modal" data-target="#deleteCar<?php echo $sr; ?>"><i class="icofont icofont-ui-delete"></i></button>
                        </p>
                        <!-- Modal -->
                        <div class="modal fade" id="deleteCar<?php echo $sr; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header text-center">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Delete Car</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p class="text-center text-danger">
                                            Are you sure to delete <strong>'<?php echo $category['name'] . ' - ' . $car['model']; ?>'</strong>?
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="<?php echo ROOT_URL; ?>efc-admin/cars/delete" method="post" role="form">
                                            <input type="hidden" name="id" value="<?php echo $car['id'] ?>">
                                            <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                            <button name="delete_car" type="submit" class="btn btn-danger">Confirm</button>
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
    var activeNav = document.getElementById("side-cars");
    activeNav.classList.add("active");
</script>
<?php

include '../includes/footer.php';

$_SESSION['last_visited'] = 'http://localhost' . $_SERVER['REQUEST_URI'];

?>

