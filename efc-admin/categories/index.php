<?php
/*
 * All Categories Admin
 */

session_start();

require '../../config.php';
require '../../classes/DbModel.php';
require '../../classes/Functions.php';

if(!isset($_SESSION['is_logged_in'])){
    header('Location: ' . ROOT_URL);
    exit();
}

if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']){
    if($_SESSION['user_data']['type'] != 'admin'){
        header('Location: ' . ROOT_URL . 'cars');
        exit();
    }
}

$categories = Functions::allCategories();

include '../includes/header.php';
?>

<div class="main-content">
    <div class="efc-admin-body-header">
        <div class="row" style="margin-right: 0 !important;">
            <div class="col-xs-8">
                <ol class="breadcrumb">
                    <li><a href="<?php echo ROOT_URL; ?>efc-admin"><i class="icofont icofont-home"></i> Home</a></li>
                    <li class="active">Categories</li>
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
        <h3>All Categories <span class="pull-right"><a href="<?php echo ROOT_URL; ?>efc-admin/categories/add" class="btn btn-info">Add Category</a></span></h3>
        <hr>
        <table id="allCategoriesTable" class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category Name</th>
                    <th class="text-center">No. of Cars</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <?php $sr = 1; ?>
            <tbody>
            <?php foreach($categories as $category): ?>
                <tr>
                    <td><?php echo $sr; $sr++; ?></td>
                    <td><?php echo $category['name']; ?></td>
                    <td class="text-center"><?php echo Functions::numOfCarsByCategory($category['id']); ?></td>
                    <td>
                        <p class="text-center">
                            <a title="View Cars of This Category" href="<?php echo ROOT_URL . 'cars/' . $category['slug']; ?>" class="btn btn-info" target="_blank"><i class="icofont icofont-eye-alt"></i></a>
                            <a title="Edit this category" href="<?php echo ROOT_URL . 'efc-admin/categories/edit?id=' . $category['id']; ?>" class="btn btn-success"><i class="icofont icofont-ui-edit"></i></a>
                            <button title="Delete this category" class="btn btn-danger" data-toggle="modal" data-target="#deleteCat<?php echo $sr; ?>"><i class="icofont icofont-ui-delete"></i></button>
                        </p>
                        <!-- Modal -->
                        <div class="modal fade" id="deleteCat<?php echo $sr; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header text-center">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Delete Category</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p class="text-center text-danger">
                                            If you delete this category, all the cars under this category will be deleted. <br>
                                            Are you sure to delete <strong>'<?php echo $category['name']; ?>'</strong>?
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="<?php echo ROOT_URL; ?>efc-admin/categories/delete" method="post" role="form">
                                            <input type="hidden" name="id" value="<?php echo $category['id'] ?>">
                                            <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                            <button name="delete_cat" type="submit" class="btn btn-danger">Confirm</button>
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
    var activeNav = document.getElementById("side-categories");
    activeNav.classList.add("active");
</script>

<?php

include '../includes/footer.php';

$_SESSION['last_visited'] = 'http://localhost' . $_SERVER['REQUEST_URI'];

?>

