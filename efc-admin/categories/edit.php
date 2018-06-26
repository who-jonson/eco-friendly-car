<?php
session_start();
// Edit Categories Admin
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

$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
//check if has update post request
if(isset($post['edit_cat'])){
    $db = new DbModel;

    $stmt = $stmt = 'UPDATE categories SET name = :name, slug = :slug WHERE id = :id';
    $db->query($stmt);

    $slug = Functions::createSlug($post['category'], 'categories');
    $db->bind(':id', $post['id']);
    $db->bind(':name', $post['category']);
    $db->bind(':slug', $slug);

    $db->execute();

    header('Refresh:1; url='. ROOT_URL . 'efc-admin/categories');
    echo '<script>alert("Category edited successfully.");</script>';
    $db = null;
    exit();
}

if(!isset($_GET['id'])){
    header('Location: ' . ROOT_URL . 'efc-admin/categories');
    exit();
}
else {
    $id = $_GET['id'];
    $db = new DbModel;
    $stmt = 'SELECT * FROM categories WHERE id = :id';
    $db->query($stmt);

    $db->bind(':id', $id);
    $category = $db->single();
    $db= null;

    if(!$category){
        header('Refresh:1; url='. ROOT_URL . 'efc-admin/categories');
        echo '<script>alert("Category not found.");</script>';
        exit();
    }
}

include '../includes/header.php';

?>
    <script>
        var activeNav = document.getElementById("side-categories");
        activeNav.classList.add("active");
    </script>
    <div class="main-content">
        <div class="efc-admin-body-header">
            <div class="row" style="margin-right: 0 !important;">
                <div class="col-xs-8">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo ROOT_URL?>efc-admin"><i class="icofont icofont-home"></i> Home</a></li>
                        <li><a href="<?php echo ROOT_URL?>efc-admin/categories">Categories</a></li>
                        <li class="active">Edit</li>
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
            <h3>Edit Category</h3>
            <hr>
            <form class="form-horizontal" method="post" action="<?php echo ROOT_URL . 'efc-admin/categories/edit' ?>">
                <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
                <div class="form-group">
                    <label for="category" class="col-sm-2 control-label">Category Name</label>
                    <div class="col-sm-7">
                        <input name="category" type="text" class="form-control" id="category" placeholder="Category Name" value="<?php echo $category['name']; ?>" required>
                    </div>
                </div>
                <!--<div id="fileuploader">Upload</div>-->

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-7">
                        <input name="edit_cat" type="submit" class="btn btn-success" value="Edit Category">
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php

include '../includes/footer.php';

$_SESSION['last_visited'] = 'http://localhost' . $_SERVER['REQUEST_URI'];

?>