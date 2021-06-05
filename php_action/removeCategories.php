<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$categoriesId = $_POST['categoriesId'];

if($categoriesId) { 

$sql = "SELECT * FROM categories NATURAL JOIN product_materials WHERE categories_id = $categoriesId";
$result = $connect->query($sql);

if($result->num_rows == 0) { 
	 $sql = "UPDATE categories SET categories_status = 2 WHERE categories_id = {$categoriesId}";

	 if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Removed";		
	 } else {
		$valid['success'] = false;
		$valid['messages'] = "Error while removing the Material";
	 }
 }
 else {
	$valid['success'] = false;
	$valid['messages'] = "Materail already exists in some product";
 }
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST