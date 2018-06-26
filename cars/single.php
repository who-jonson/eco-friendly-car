<?php
// cars index
session_start();

require '../config.php';
require '../classes/DbModel.php';
require '../classes/Functions.php';

Functions::checkLogging();

$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
if(isset($post['add_comment'])){
    $db = new DbModel;

    $stmt = 'INSERT INTO comments (user_id, car_id, comment) VALUES (:user_id, :car_id, :comment)';
    $db->query($stmt);

    $db->bind(':user_id', $_SESSION['user_data']['id']);
    $db->bind(':car_id', $post['car_id']);
    $db->bind(':comment', $post['comment']);

    $db->execute();
    if($db->lastInsertId()){
        header('Refresh:1; url=' . ROOT_URL . 'cars/' . $_GET['category'] . '/' . $_GET['model']);
        echo '<script>alert("Comment successfully added.");</script>';
        $db = null;
        exit();
    }
}

if(isset($_GET['category']) && $_GET['category'] != null){

    if(!isset($_GET['model']) || $_GET['model'] == null){
        header('Location: ' . ROOT_URL . 'cars/' . $_GET['category']);
        exit();
    }
    else {
        $_SESSION['car_not_found'] = false;
        $thisCategory = array();

        $db = new DbModel;

        $stmt = 'SELECT * FROM cars WHERE slug = :slug';
        $db->query($stmt);

        $db->bind(':slug', htmlspecialchars($_GET['model']));
        $singleCar = $db->single();

        $db = null;

        if(!$singleCar){
            $_SESSION['car_not_found'] = true;
        }
        else {
            Functions::addHistory($_SESSION['user_data']['id'], $singleCar['id']);

            $thisCategory = Functions::getCategoryByCar($singleCar['category_id']);
            $features = explode(', ', $singleCar['features']);
            $sub_title = $thisCategory['name'] . ' ' . $singleCar['model'] . ' - ';
            $comments = Functions::commentsByCarId($singleCar['id']);
        }
    }

}
?>

<?php include '../viewIncludes/header.php'; ?>

    <div class="page-title" style="background-image: url('<?php echo ROOT_URL; ?>assets/images/page-title-bg.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-4">
                    <?php if($_SESSION['car_not_found']): ?>
                        <h1>Cars</h1>
                    <?php else: ?>
                        <h1><?php echo $thisCategory['name'] . ' ' . $singleCar['model']; ?></h1>
                    <?php endif; ?>
                </div>
                <div class="col-xs-12 col-sm-8">
                    <p class="text-right">
                        <?php if(isset($_GET['model']) && $_GET['model'] != null): ?>
                            <?php if(!$_SESSION['car_not_found']): ?>
                                <a href="<?php echo ROOT_URL; ?>">Home</a> /
                                <a href="<?php echo ROOT_URL . 'cars'; ?>">Cars</a> /
                                <a href="<?php echo ROOT_URL . 'cars/' . $thisCategory['slug']; ?>"><?php echo $thisCategory['name']; ?></a> /
                                <span class="active"> <?php echo $singleCar['model']; ?> </span>
                            <?php else: ?>
                                <a href="<?php echo ROOT_URL; ?>">Home</a> /
                                <a class="active" href="<?php echo ROOT_URL . 'cars'; ?>">Cars</a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div id="single-car">
            <div class="container">
                <div class="row">
                    <?php if($_SESSION['car_not_found']): ?>
                        <div class="col-sm-8 col-sm-offset-2">
                            <div class="panel panel-danger text-center error-panel">
                                <div class="panel-heading">
                                    <h2 class="panel-title">Error</h2>
                                </div>
                                <div class="panel-body">
                                    Your requested car not found.
                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- Single car details -->
                        <div class="col-md-8">
                            <div class="car-details">

                                <?php if($singleCar['img_url'] != null): ?>
                                    <img src="<?php echo $singleCar['img_url']; ?>" alt="<?php echo $thisCategory['name'] . ' ' . $singleCar['model'] . '-' . SITE_TITLE; ?>" class="img-responsive header-img">
                                <?php else: ?>
                                    <img src="<?php echo ROOT_URL . 'assets/images/car.png'; ?>" alt="<?php echo $thisCategory['name'] . ' ' . $singleCar['model'] . '-' . SITE_TITLE; ?>" class="img-responsive header-img">
                                <?php endif; ?>

                                <h3>Car Features</h3>
                                <ul class="car-features">
                                    <?php foreach($features as $feature): ?>
                                        <li><i class="icofont icofont-list"></i> <?php echo $feature; ?></li>
                                    <?php endforeach; ?>
                                </ul> <!-- .car-features -->

                                <h3>Car Description</h3>
                                <p class="car-description">
                                    <?php echo $singleCar['details']; ?>
                                </p>

                            </div><!-- .car-details -->

                            <div class="comments">
                                <div class="comments-header">
                                    <h3>
                                        <?php echo count($comments); ?> Comments <i class="icofont icofont-speech-comments"></i>
                                        <button class="pull-right btn btn-default" role="button" id="leaveReply">LEAVE A REPLY</button>
                                    </h3>
                                    <hr>
                                </div>
                                <form action="<?php echo ROOT_URL . 'cars/' . $_GET['category'] . '/' . $_GET['model']; ?>" method="post" id="commentForm" style="display: none;">
                                    <h4>LEAVE A REPLY</h4>

                                    <p>
                                        Thanks for choosing to leave a comment. Please keep in mind that all comments are moderated according to our comment policy,
                                        and your email address will NOT be published. Please Do NOT use keywords in the name field.
                                        Let's have a personal and meaningful conversation.
                                    </p>

                                    <div class="form-group">
                                        <label class="sr-only" for="comment">Comment</label>
                                        <textarea name="comment" id="comment" class="form-control" rows="7" required></textarea>
                                    </div>
                                    <input type="hidden" name="car_id" value="<?php echo $singleCar['id']; ?>">
                                    <div class="form-group">
                                        <input type="submit" name="add_comment" class="btn btn-default" value="Add Comment">
                                    </div>
                                    <hr>
                                </form>
                                <script>
                                    $('#leaveReply').click(function() {
                                        $('#commentForm').css({
                                            'display': 'block'
                                        });
                                    });
                                </script>
                                <ul class="comments-list">
                                    <?php $comments_count = 1; ?>
                                    <?php foreach($comments as $comment): ?>
                                        <?php if($comments_count % 2 != 0): ?>
                                            <li class="odd" id="comment<?php echo $comment['id']; ?>">
                                                <div class="single-comment-head">
                                                    <img class="img-thumbnail img-circle" src="<?php echo (Functions::getUserById($comment['user_id'])['img_url'] != null)? Functions::getUserById($comment['user_id'])['img_url'] : ROOT_URL . 'assets/images/user.png'; ?>" alt="">
                                                    <div class="user-details">
                                                        <h4><?php echo Functions::getUserById($comment['user_id'])['full_name']; ?></h4>
                                                        <p class="text-muted"><?php echo $comment['created_at']; ?></p>
                                                    </div>
                                                </div>
                                                <div class="single-comment-detail">
                                                    <p><?php echo $comment['comment']; ?></p>
                                                </div>
                                            </li>
                                        <?php else: ?>
                                            <li class="even" id="comment<?php echo $comment['id']; ?>">
                                                <div class="single-comment-head">
                                                    <img class="img-thumbnail img-circle" src="<?php echo (Functions::getUserById($comment['user_id'])['img_url'] != null)? Functions::getUserById($comment['user_id'])['img_url'] : ROOT_URL . 'assets/images/user.png'; ?>" alt="">
                                                    <div class="user-details">
                                                        <h4><?php echo Functions::getUserById($comment['user_id'])['full_name']; ?></h4>
                                                        <p class="text-muted"><?php echo $comment['created_at']; ?></p>
                                                    </div>
                                                </div>
                                                <div class="single-comment-detail">
                                                    <p><?php echo $comment['comment']; ?></p>
                                                </div>
                                            </li>
                                        <?php endif; ?>
                                        <?php $comments_count++; ?>
                                    <?php endforeach; ?>
                                </ul>
                            </div><!-- .car-details -->
                        </div><!-- .col-md-8 -->

                        <div class="col-md-4">
                            <div class="car-sidebar">
                                <h3>About This Car</h3>
                                <ul class="sidebar-car-spec">
                                    <li class="row">
                                        <div class="col-xs-5 col-md-5">
                                            Color
                                        </div>
                                        <div class="col-xs-7 col-md-7 text-right">
                                            <span><?php echo $singleCar['color']; ?></span>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="col-xs-5 col-md-5">
                                            Engine
                                        </div>
                                        <div class="col-xs-7 col-md-7 text-right">
                                            <span><?php echo $singleCar['engine']; ?></span>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="col-xs-5 col-md-5">
                                            Power
                                        </div>
                                        <div class="col-xs-7 col-md-7 text-right">
                                            <span><?php echo $singleCar['power']; ?></span>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="col-xs-5 col-md-5">
                                            Top Speed
                                        </div>
                                        <div class="col-xs-7 col-md-7 text-right">
                                            <span><?php echo $singleCar['top_speed']; ?></span>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="col-xs-5 col-md-5">
                                            Fuel Type
                                        </div>
                                        <div class="col-xs-7 col-md-7 text-right">
                                            <span><?php echo $singleCar['fuel_type']; ?></span>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="col-xs-5 col-md-5">
                                            Brake
                                        </div>
                                        <div class="col-xs-7 col-md-7 text-right">
                                            <span><?php echo $singleCar['brake']; ?></span>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="col-xs-5 col-md-5">
                                            Gear
                                        </div>
                                        <div class="col-xs-7 col-md-7 text-right">
                                            <span><?php echo $singleCar['gear']; ?></span>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="col-xs-5 col-md-5">
                                            Wheel Size
                                        </div>
                                        <div class="col-xs-7 col-md-7 text-right">
                                            <span><?php echo $singleCar['wheel_size']; ?></span>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="col-xs-5 col-md-5">
                                            Wheel Material
                                        </div>
                                        <div class="col-xs-7 col-md-7 text-right">
                                            <span><?php echo $singleCar['wheel_material']; ?></span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="car-sidebar">
                                <h3>Price</h3>
                                <p class="price"><?php echo $singleCar['price']; ?></p>
                                <div class="car-actions">
                                    <a href="#commentForm" class="btn btn-default"><i class="icofont icofont-comment"></i> Add a Comment</a>
                                    <?php if(!Functions::isFavorite($singleCar['id'], $_SESSION['user_data']['id'])): ?>
                                        <form method="post" id="add-favorite" role="form">
                                            <input type="hidden" name="car_id" value="<?php echo $singleCar['id']; ?>">
                                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_data']['id']; ?>">
                                            <button type="submit" id="addFav" name="add_favorite" class="btn btn-success"><i class="icofont icofont-favourite"></i> Add To Favorites</button>
                                            <button type="submit" id="removeFav" name="remove_favorite" class="btn btn-danger" style="display: none;"><i class="icofont icofont-favourite"></i> Remove From Favorites</button>
                                        </form>
                                    <?php else: ?>
                                        <form method="post" id="add-favorite" role="form">
                                            <input type="hidden" name="car_id" value="<?php echo $singleCar['id']; ?>">
                                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_data']['id']; ?>">
                                            <button type="submit" id="addFav" name="add_favorite" class="btn btn-success" style="display: none;"><i class="icofont icofont-favourite"></i> Add To Favorites</button>
                                            <button type="submit" id="removeFav" name="remove_favorite" class="btn btn-danger"><i class="icofont icofont-favourite"></i> Remove From Favorites</button>
                                        </form>
                                    <?php endif; ?>

                                </div>
                            </div>
                            <div class="car-sidebar">
                                <h3>Ratings</h3>
                                <ul class="car-ratings">
                                    <li class="row">
                                        <div class="col-xs-4 col-md-4">
                                            <h5>Fuel</h5>
                                        </div>
                                        <div class="col-xs-8 col-md-8">
                                            <div id="fuel-rating"></div>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="col-xs-4 col-md-4">
                                            <h5>Battery</h5>
                                        </div>
                                        <div class="col-xs-8 col-md-8">
                                            <div id="battery-rating"></div>
                                        </div>
                                    </li>
                                    <li class="row">
                                        <div class="col-xs-4 col-md-4">
                                            <h5>Car</h5>
                                        </div>
                                        <div class="col-xs-8 col-md-8">
                                            <div id="car-rating"></div>
                                        </div>
                                    </li>
                                </ul>
                                <script>
                                    $('#fuel-rating').stars({
                                        value: <?php echo $singleCar['rate_fuel']; ?>,
                                        color: '#fff'
                                    });
                                    $('#battery-rating').stars({
                                        value: <?php echo $singleCar['rate_battery']; ?>,
                                        color: '#fff'
                                    });
                                    $('#car-rating').stars({
                                        value: <?php echo $singleCar['rate_car']; ?>,
                                        color: '#fff'
                                    });
                                </script>
                            </div>
                        </div><!-- .col-md-4 -->
                    <?php endif; ?>
                </div>
            </div>

        </div>

    </div>


<?php include '../viewIncludes/footer.php'; ?>