<?php
/*
 * Add Cars Admin
 */

session_start();

require '../../config.php';
require '../../classes/DbModel.php';
require '../../classes/Functions.php';

Functions::checkLogging();

if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']){
    if($_SESSION['user_data']['type'] != 'admin'){
        header('Location: ' . ROOT_URL . 'cars');
    }
}

$categories = Functions::allCategories();
$features = Functions::allFeatures();

$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if(isset($post['add_car'])){
    $db = new DbModel;

    $slug = Functions::createSlug($post['model'], 'cars');
    $car_features = implode(', ', $post['features']);

    $stmt = 'INSERT INTO cars (category_id, features, slug, model, color, img_url, price, engine, power, top_speed, fuel_type, brake, gear, wheel_size, wheel_material, rate_fuel, rate_battery, rate_car, details, views) 
              VALUES(:category_id, :features, :slug, :model, :color, :img_url, :price, :engine, :power, :top_speed, :fuel_type, :brake, :gear, :wheel_size, :wheel_material, :rate_fuel, :rate_battery, :rate_car, :details, :views)';
    $db->query($stmt);

    $db->bind(':category_id', $post['category_id']);
    $db->bind(':features', $car_features);
    $db->bind(':slug', $slug);
    $db->bind(':model', $post['model']);
    $db->bind(':color', $post['color']);
    $db->bind(':img_url', $post['img_url']);
    $db->bind(':price', $post['price']);
    $db->bind(':engine', $post['engine']);
    $db->bind(':power', $post['power']);
    $db->bind(':top_speed', $post['top_speed']);
    $db->bind(':fuel_type', $post['fuel_type']);
    $db->bind(':brake', $post['brake']);
    $db->bind(':gear', $post['gear']);
    $db->bind(':wheel_size', $post['wheel_size']);
    $db->bind(':wheel_material', $post['wheel_material']);
    $db->bind(':rate_fuel', $post['rate_fuel']);
    $db->bind(':rate_battery', $post['rate_battery']);
    $db->bind(':rate_car', $post['rate_car']);
    $db->bind(':details', $post['details']);
    $db->bind(':views', 0);

    $db->execute();

    if($db->lastInsertId()){
        header('Refresh:1; url='. ROOT_URL . 'efc-admin/cars');
        echo '<script>alert("Car added successfully.");</script>';
        $db = null;
        exit();
    }
}


include '../includes/header.php';
?>

    <div class="main-content">
        <div class="efc-admin-body-header">
            <div class="row" style="margin-right: 0 !important;">
                <div class="col-xs-8">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo ROOT_URL?>efc-admin"><i class="icofont icofont-home"></i> Home</a></li>
                        <li><a href="<?php echo ROOT_URL?>efc-admin/cars"></i> Cars</a></li>
                        <li class="active">Add</li>
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
            <h3>Add Car</h3>
            <hr>
            <div class="car-form">
                <div class="form-header">
                    <i class="icofont icofont-edit"></i>
                </div>
                <div class="col-sm-6 col-sm-offset-3">
                    <div class="car-image-up">
                        <div class="main-up">
                            <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
                                <div id="image_preview">
                                    <img class="img-responsive" id="previewing" src="<?php echo ROOT_URL; ?>assets/images/car.png" >
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
                        </div>
                    </div>
                </div>

                <form id="addCarForm" action="<?php echo ROOT_URL . 'efc-admin/cars/add' ?>" method="post" role="form" class="form-horizontal">

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="model" class="col-sm-2 control-label">Model</label>
                                <div class="col-sm-9">
                                    <input name="model" type="text" class="form-control" id="model" placeholder="Car Model" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="category" class="col-sm-2 control-label">Category</label>
                                <div class="col-sm-9">
                                    <select name="category_id"  class="form-control" id="category" required>
                                        <option value="null">--- Select Category ---</option>
                                        <?php foreach($categories as $category): ?>
                                            <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <a class="add-new-cat" href="<?php echo ROOT_URL . 'efc-admin/categories/add'; ?>">Add new category</a>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="details" class="col-sm-2 control-label">Details</label>
                                <div class="col-sm-9">
                                    <textarea name="details" class="form-control" placeholder="Write a short description about car....." rows="5" id="details" style="resize: none;" required></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="features" class="col-sm-2 control-label">Features</label>
                                <div class="col-sm-9">
                                    <?php foreach($features as $feature): ?>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="features[]" value="<?php echo $feature; ?>"> <?php echo $feature; ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">
                                <label for="color" class="col-sm-2 control-label">Color</label>
                                <div class="col-sm-9">
                                    <input name="color" type="text" class="form-control" id="color" placeholder="Color" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="price" class="col-sm-2 control-label">Price</label>
                                <div class="col-sm-9">
                                    <input name="price" type="text" class="form-control" id="price" placeholder="Price" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="engine" class="col-sm-2 control-label">Engine</label>
                                <div class="col-sm-9">
                                    <input name="engine" type="text" class="form-control" id="engine" placeholder="Engine type" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="power" class="col-sm-2 control-label">Power</label>
                                <div class="col-sm-9">
                                    <input name="power" type="text" class="form-control" id="power" placeholder="Power" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="top-speed" class="col-sm-2 control-label">Top Speed</label>
                                <div class="col-sm-9">
                                    <input name="top_speed" type="text" class="form-control" id="top-speed" placeholder="Top Speed" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="fuel-type" class="col-sm-2 control-label">Fuel Type</label>
                                <div class="col-sm-9">
                                    <input name="fuel_type" type="text" class="form-control" id="fuel-type" placeholder="Fuel Type" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="brake" class="col-sm-2 control-label">Brake</label>
                                <div class="col-sm-9">
                                    <input name="brake" type="text" class="form-control" id="brake" placeholder="Brake" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="gear" class="col-sm-2 control-label">Gear</label>
                                <div class="col-sm-9">
                                    <input name="gear" type="text" class="form-control" id="gear" placeholder="Gear" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="wheel-size" class="col-sm-2 control-label">Wheel Size</label>
                                <div class="col-sm-9">
                                    <input name="wheel_size" type="text" class="form-control" id="wheel-size" placeholder="Wheel Size" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="wheel-material" class="col-sm-2 control-label">Wheel Material</label>
                                <div class="col-sm-9">
                                    <input name="wheel_material" type="text" class="form-control" id="wheel-material" placeholder="Wheel Material" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="rate-fuel" class="col-sm-2 control-label">Rate Fuel</label>
                                <div class="col-sm-9">
                                    <input name="rate_fuel" type="number" class="form-control" id="rate-fuel" placeholder="Rate Fuel Out of 5. Ex: 4" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="rate-battery" class="col-sm-2 control-label">Rate Battery</label>
                                <div class="col-sm-9">
                                    <input name="rate_battery" type="number" class="form-control" id="rate-battery" placeholder="Rate Battery Out of 5. Ex: 3" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="rate-car" class="col-sm-2 control-label">Rate Car</label>
                                <div class="col-sm-9">
                                    <input name="rate_car" type="number" class="form-control" id="rate-car" placeholder="Rate Car Out of 5. Ex: 4" required>
                                </div>
                            </div>

                        </div>
                        <div class="col-xs-12 text-center">
                            <input type="hidden" name="img_url" id="new-img-url" value="">
                            <input name="add_car" type="submit" class="btn btn-success" value="Add New Car">
                        </div>
                    </div>

                </form>
            </div>

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