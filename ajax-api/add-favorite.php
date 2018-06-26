<?php

require '../config.php';
require '../classes/DbModel.php';

$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

$db = new DbModel;

$stmt = 'INSERT INTO favorites (user_id, car_id) VALUES (:user_id, :car_id)';
$db->query($stmt);

$db->bind(':user_id', $post['user_id']);
$db->bind(':car_id', $post['car_id']);

$db->execute();
if($db->lastInsertId()){
    echo '1';
    $db = null;
    exit();
}
