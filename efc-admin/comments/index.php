<?php
/*
 * All Comments Admin
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

$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if(isset($post['delete_comment'])){
    $db = new DbModel;

    $stmt = 'DELETE FROM comments WHERE id = :id';
    $db->query($stmt);

    $db->bind(':id', $post['id']);

    $db->execute();

    $db = null;
    header('Refresh:1; url=' . ROOT_URL . 'efc-admin/comments');
    echo '<script>alert("Comment Deleted!");</script>';
    exit();
}

$db = new DbModel;

$stmt = 'SELECT * FROM comments ORDER BY created_at DESC ';
$db->query($stmt);

$comments = $db->resultSet();
$db = null;

include '../includes/header.php';
?>

<div class="main-content">
    <div class="efc-admin-body-header">
        <div class="row" style="margin-right: 0 !important;">
            <div class="col-xs-8">
                <ol class="breadcrumb">
                    <li><a href="<?php echo ROOT_URL; ?>efc-admin"><i class="icofont icofont-home"></i> Home</a></li>
                    <li class="active">Comments</li>
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
        <h3>All Comments</h3>
        <hr>
        <table id="allCommentsTable" class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Comment</th>
                <th class="text-center">Car</th>
                <th class="text-center">User</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <?php $sr = 1; ?>
            <tbody>
            <?php foreach($comments as $comment): ?>
                <tr>
                    <td><?php echo $sr; $sr++; ?></td>
                    <?php
                    $excerpt = strip_tags($comment['comment']);
                    if (strlen($excerpt) > 45) {
                        $excerpt = substr($excerpt, 0, 45);
                        $excerpt = substr($excerpt, 0, strrpos($excerpt, ' '));
                        $excerpt .= '...';
                    }
                    ?>
                    <td><?php echo $excerpt; ?></td>
                    <td class="text-center"><?php echo Functions::carById($comment['car_id'])['model']; ?></td>
                    <td class="text-center"><?php echo Functions::getUserById($comment['user_id'])['full_name']; ?></td>
                    <td>
                        <p class="text-center">
                            <a title="View Comment"
                               href="<?php echo ROOT_URL . 'cars/' . Functions::getCategoryByCar($comment['car_id'])['slug'] . '/' . Functions::carById($comment['car_id'])['slug'] . '#comment' . $comment['id']; ?>" class="btn btn-info" target="_blank">
                                <i class="icofont icofont-eye-alt"></i>
                            </a>
                            <button title="Delete this category" class="btn btn-danger" data-toggle="modal" data-target="#deleteComment<?php echo $sr; ?>"><i class="icofont icofont-ui-delete"></i></button>
                        </p>
                        <!-- Modal -->
                        <div class="modal fade" id="deleteComment<?php echo $sr; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header text-center">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Delete Comment</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p class="text-center text-danger">
                                            Are you sure to delete this comment?
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="<?php echo ROOT_URL; ?>efc-admin/comments/" method="post" role="form">
                                            <input type="hidden" name="id" value="<?php echo $comment['id'] ?>">
                                            <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                            <button name="delete_comment" type="submit" class="btn btn-danger">Confirm</button>
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
    var activeNav = document.getElementById("side-comments");
    activeNav.classList.add("active");
</script>

<?php

include '../includes/footer.php';

$_SESSION['last_visited'] = 'http://localhost' . $_SERVER['REQUEST_URI'];

?>

