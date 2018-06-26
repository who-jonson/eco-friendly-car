<?php
// cars index
session_start();

require '../config.php';
require '../classes/DbModel.php';
require '../classes/Functions.php';

Functions::checkLogging();





?>

<?php include '../viewIncludes/header.php'; ?>

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
                <div id="histories">

                </div>
            </div>
        </div>
    </div>


<?php include '../viewIncludes/footer.php'; ?>