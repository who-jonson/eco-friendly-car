<?php
// favorites
session_start();

require 'config.php';
require 'classes/DbModel.php';
require 'classes/Functions.php';

Functions::checkLogging();

$db = new DbModel;

$stmt = 'SELECT * FROM favorites WHERE user_id = :user_id ORDER BY created_at DESC';
$db->query($stmt);

$db->bind(':user_id', $_SESSION['user_data']['id']);

$favorites = $db->resultSet();
$db = null;
$errMsg = false;

if(!$favorites){
    $errMsg = true;
}
else {
    $cars = array();
    $i = 0;
    foreach($favorites as $favorite){
        $cars[$i] = Functions::carById($favorite['car_id']);
        $i++;
    }
}



?>

<?php include 'viewIncludes/header.php'; ?>

    <div class="page-title" style="background-image: url('<?php echo ROOT_URL; ?>assets/images/page-title-bg.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-4">
                    <h1>Favorites</h1>
                </div>
                <div class="col-xs-12 col-sm-8">
                    <p class="text-right">
                        <a href="<?php echo ROOT_URL; ?>">Home </a> /
                        <span class="active"> Favorites</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="container">
            <div class="row">
                <div id="cars">
                    <div class="col-xs-12">
                        <div class="cars-header">
                            <span>Sort by:</span>
                            <button class="sort btn btn-primary" data-sort="model">Model</button>
                            <button class="sort btn btn-primary" data-sort="category">Category</button>
                            <button class="sort btn btn-primary" data-sort="update-date">Date</button>
                            <button class="sort btn btn-primary" data-sort="price">Price</button>
                        </div>
                    </div>

                    <div class="col-sm-12">

                        <?php if($errMsg): ?>
                            <div class="panel panel-danger text-center error-panel">
                                <div class="panel-heading">
                                    <h2 class="panel-title">Error</h2>
                                </div>
                                <div class="panel-body">
                                    No cars found.
                                </div>
                            </div>
                        <?php else: ?>
                            <ul class="list">.

                                <?php foreach($cars as $car): ?>

                                    <li class="col-sm-6 col-md-3" id="favCar<?php echo $car['id']; ?>">
                                        <div class="car-single">
                                            <?php if($car['img_url'] == null): ?>
                                                <img src="<?php echo ROOT_URL . 'assets/images/car.png'; ?>" alt="<?php echo $car['model']; ?>" class="img-responsive">
                                            <?php else: ?>
                                                <img src="<?php echo $car['img_url']; ?>" alt="<?php echo $car['model']; ?>" class="img-responsive">
                                            <?php endif; ?>

                                            <h4 class="model"><?php echo $car['model']; ?></h4>
                                            <?php $category = Functions::getCategoryByCar($car['category_id']); ?>
                                            <p class="speed">
                                                <i class="icofont icofont-speed-meter"></i> <?php echo $car['top_speed']; ?>
                                                <i class="icofont icofont-company"></i> <span class="category"><?php echo $category['name']; ?></span>
                                            </p>
                                            <p class="text-muted">
                                                <?php echo $car['fuel_type']; ?> | <?php echo $car['engine']; ?> | <?php echo $car['gear']; ?>
                                            </p>
                                            <p class="price">
                                                <?php echo $car['price']; ?>
                                            </p>
                                            <p class="sr-only update-date"><?php echo $car['updated_at']; ?></p>
                                            <a href="<?php echo ROOT_URL . 'cars/' . $category['slug'] . '/' . $car['slug']; ?>" class="btn btn-success fav-view">View Car <i class="icofont icofont-circled-right"></i></a>
                                            <a class=""></a>
                                            <button type="button" class="btn btn-danger fav-delete" data-toggle="modal" data-target="#removeFavModal<?php echo $car['id']; ?>">Remove <i class="icofont icofont-ui-delete"></i></button>
                                        </div>
                                    </li>

                                    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" id="removeFavModal<?php echo $car['id']; ?>" aria-labelledby="myRemoveFavModal<?php echo $car['id']; ?>">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title text-center" id="myRemoveFavModal<?php echo $car['id']; ?>">Remove</h4>
                                                </div>
                                                <div class="modal-body text-danger">
                                                    Remove This Car From Favorite
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                                    <a href="javascript:void(0)" onclick="removeFav(<?php echo $car['id']; ?>, <?php echo $_SESSION['user_data']['id']; ?>)" class="btn btn-danger">Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach; ?>
                                <script>
                                    function removeFav(car_id, user_id) {
                                        $.ajax({
                                            url: "http://localhost/eco-friendly-car/ajax-api/remove-favorite",
                                            method: "post",
                                            data: "car_id=" + car_id + "&user_id=" + user_id,
                                            dataType: "text",
                                            success: function(msg){
                                                if(msg === '1'){
                                                    $('#favCar' + car_id).remove();
                                                    $('#removeFavModal' + car_id).modal('hide');
                                                }
                                                else {
                                                    alert("Something went wrong!");
                                                }
                                            }
                                        });
                                    }
                                </script>

                            </ul>
                            <div class="col-xs-12 text-center">
                                <ul class="pagination"></ul>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>


<?php include 'viewIncludes/footer.php'; ?>