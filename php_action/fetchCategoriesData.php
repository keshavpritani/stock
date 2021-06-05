<?php 	

require_once 'core.php';

$sql = "SELECT categories_id, categories_name, categories_status FROM categories WHERE categories_status = 1";
$result = $connect->query($sql);

$data = $result->fetch_all();

$connect->close();

echo json_encode($data);