<?php
    // cars index
    session_start();

    require '../config.php';
    require '../classes/DbModel.php';
    require '../classes/Functions.php';

    Functions::checkLogging();

    $db = new DbModel;

    $stmt = 'SELECT * FROM categories ORDER BY name ASC';
    $db->query($stmt);
    $categories = $db->resultSet();
    $db = null;

    $cars = Functions::allCars();
    $this_category = array();
    $sub_title = 'All Cars - ';

    if(isset($_GET['category']) && $_GET['category'] != null){

        $db = new DbModel;

        $stmt = 'SELECT * FROM categories WHERE slug = :slug';
        $db->query($stmt);

        $db->bind(':slug', htmlspecialchars($_GET['category']));
        $this_category = $db->single();
        $db = null;

        $sub_title = $this_category['name'] . ' - ';
        $cars = Functions::carsByCategoryId($this_category['id']);
    }
?>

<?php include '../viewIncludes/header.php'; ?>

    <div class="page-title" style="background-image: url('<?php echo ROOT_URL; ?>assets/images/page-title-bg.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-4">
                    <?php if(isset($_GET['category']) && $_GET['category'] != null && $cars != null): ?>
                        <h1><?php echo $this_category['name']; ?></h1>
                    <?php else: ?>
                        <h1>Cars</h1>
                    <?php endif; ?>
                </div>
                <div class="col-xs-12 col-sm-8">
                    <p class="text-right">
                        <?php if(isset($_GET['category']) && $_GET['category'] != null && $cars != null): ?>
                            <a href="<?php echo ROOT_URL; ?>">Home </a> /
                            <a href="<?php echo ROOT_URL; ?>cars">Cars </a> /
                            <span class="active"> <?php echo $this_category['name']; ?> </span>
                        <?php else: ?>
                            <a href="<?php echo ROOT_URL; ?>">Home </a> /
                            <a class="active" href="<?php echo ROOT_URL; ?>cars">Cars </a>
                        <?php endif; ?>
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

                    <div class="col-sm-4 col-md-3">
                        <div class="cars-sidebar">
                            <h4>Search Cars</h4>
                            <input class="search form-control" placeholder="Search Cars">
                            <h4>Filter by Category</h4>
                            <ul>
                                <?php foreach($categories as $category): ?>
                                    <li>
                                        <a href="<?php echo ROOT_URL . 'cars/' . $category['slug']; ?>">
                                            <?php echo $category['name']; ?>
                                        </a>
                                        <span class="pull-right"><?php echo Functions::numOfCarsByCategory($category['id']); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-8 col-md-9">

                        <?php if(isset($_GET['category']) && $_GET['category'] != null && $cars == null): ?>
                            <div class="panel panel-danger text-center error-panel">
                                <div class="panel-heading">
                                    <h2 class="panel-title">Error</h2>
                                </div>
                                <div class="panel-body">
                                    No cars found for this category or category not found.
                                </div>
                            </div>
                        <?php else: ?>
                            <ul class="list">.

                                <?php foreach($cars as $car): ?>

                                    <li class="col-sm-6 col-md-4">
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
                                            <a href="<?php echo ROOT_URL . 'cars/' . $category['slug'] . '/' . $car['slug']; ?>" class="btn btn-success">View Car <i class="icofont icofont-circled-right"></i></a>
                                        </div>
                                    </li>

                                <?php endforeach; ?>

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


<?php include '../viewIncludes/footer.php'; ?>