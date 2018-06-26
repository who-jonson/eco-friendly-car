<?php
session_start();
// Categories Delete
require '../../config.php';
require '../../classes/DbModel.php';

Functions::checkLogging();

if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']){
    if($_SESSION['user_data']['type'] != 'admin'){
        header('Location: ' . ROOT_URL . 'cars');
    }
}

$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
//delete category
if(isset($post['delete_car'])){
    $db = new DbModel;

    $stmt = 'DELETE FROM cars WHERE id = :id';
    $db->query($stmt);

    $db->bind(':id', $post['id']);
    $db->execute();

    header('Refresh:1; url='. ROOT_URL . 'efc-admin/cars');
    echo '<script>alert("Car deleted successfully.");</script>';
    $db = null;
    exit();
}
else {
    header('Location: ' . ROOT_URL . 'efc-admin/cars');
    exit();
}