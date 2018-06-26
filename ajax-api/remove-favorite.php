<?php
// remove favorites
require '../config.php';
require '../classes/DbModel.php';

$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

$db = new DbModel;

$stmt = 'DELETE FROM favorites WHERE user_id = :user_id AND car_id = :car_id';
$db->query($stmt);

$db->bind(':user_id', $post['user_id']);
$db->bind(':car_id', $post['car_id']);

$db->execute();
echo '1';
$db = null;
exit();
