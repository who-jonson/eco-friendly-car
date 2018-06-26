<?php
// history
session_start();

require 'config.php';
require 'classes/DbModel.php';
require 'classes/Functions.php';

Functions::checkLogging();

$db = new DbModel;
$stmt = 'SELECT * FROM histories WHERE user_id = :user_id ORDER BY updated_at DESC';
$db->query($stmt);

$db->bind(':user_id', $_SESSION['user_data']['id']);
$histories = $db->resultSet();

$sub_title = 'Cars History - ';

$db = null;



?>

<?php include 'viewIncludes/header.php'; ?>

    <div class="page-title" style="background-image: url('<?php echo ROOT_URL; ?>assets/images/page-title-bg.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-4">
                    <h1>History</h1>
                </div>
                <div class="col-xs-12 col-sm-8">
                    <p class="text-right">
                        <a href="<?php echo ROOT_URL; ?>">Home </a> /
                        <span class="active"> History</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div id="histories">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <table id="historiesTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th class="text-center">Time</th>
                                    <th class="text-center">Viewed</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <?php $sr = 1; ?>
                            <tbody>
                            <?php foreach($histories as $history): ?>
                                <tr id="userHistory<?php echo $history['id']; ?>">
                                    <td><i class="icofont icofont-history"></i></td>
                                    <td>
                                        <a href="<?php echo ROOT_URL . 'cars/' . Functions::getCategoryByCar(Functions::carById($history['car_id'])['category_id'])['slug'] . '/' . Functions::carById($history['car_id'])['slug']; ?>">
                                            <strong>
                                                <?php echo Functions::getCategoryByCar(Functions::carById($history['car_id'])['category_id'])['name']; ?>
                                            </strong>
                                            <?php echo Functions::carById($history['car_id'])['model']; ?>
                                        </a>
                                    </td>
                                    <td class="text-center"><?php echo $history['updated_at']; ?></td>
                                    <td class="text-center"><?php echo $history['total_viewed']; ?></td>
                                    <td class="text-center">
                                        <button title="Delete" class="btn btn-default delete-history-btn" data-toggle="modal" data-target="#deleteHistoryModal<?php echo $history['id']; ?>">
                                            <i class="icofont icofont-ui-delete"></i>
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal" id="deleteHistoryModal<?php echo $history['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteHistoryModalLabel<?php echo $history['id']; ?>">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header text-center">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="deleteHistoryModalLabel<?php echo $history['id']; ?>">Delete History</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-center text-danger">
                                                            Are you sure to delete
                                                            <strong>
                                                                '<?php echo Functions::getCategoryByCar(Functions::carById($history['car_id'])['category_id'])['name'] . ' ' . Functions::carById($history['car_id'])['model']; ?>'
                                                            </strong>
                                                            from your history?
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                                        <a href="javascript:void(0)" onclick="removeHistory(<?php echo $history['id']; ?>)" class="btn btn-danger" style="text-decoration: none;">
                                                          Remove
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <script>
                            function removeHistory(id) {
                                $.ajax({
                                    url: "http://localhost/eco-friendly-car/ajax-api/remove-history",
                                    method: "post",
                                    data: "id=" + id,
                                    dataType: "text",
                                    success: function(msg){
                                        if(msg === '1'){
                                            $('#deleteHistoryModal' + id).modal('hide');
                                            $('#userHistory' + id).remove();
                                        }
                                        else {
                                            alert("Something went wrong!");
                                        }
                                    }
                                });
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div> <!-- #histories -->
    </div>

<?php include 'viewIncludes/footer.php'; ?>
