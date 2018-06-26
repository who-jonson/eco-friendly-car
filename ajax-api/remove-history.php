<?php
// remove histories
require '../config.php';
require '../classes/DbModel.php';

$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

$db = new DbModel;

$stmt = 'DELETE FROM histories WHERE id = :id';
$db->query($stmt);

$db->bind(':id', $post['id']);

$db->execute();
echo '1';
$db = null;
exit(); 
