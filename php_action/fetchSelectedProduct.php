<?php 	

require_once 'core.php';

$productId = $_POST['productId'];

$sql = "SELECT categories_id,categories_name, qty,qty_in_stock,product.* FROM product NATURAL JOIN product_materials NATURAL JOIN categories WHERE product_id = $productId";
$result = $connect->query($sql);
$row=$sql;

$output = array();

if($result->num_rows > 0)
	while($row = $result->fetch_array()) 
		$output[] = array(
			$row['categories_id'] ,//0
			$row['categories_name'],//1
			$row['qty'],//2
			$row['qty_in_stock'],//3
			$row['product_image'],//4
			$row['product_name'],//5
			$row['rate'],//6
			$row['brand_id'],//7
			$row['product_id'],//8

		);

// $output[] = array($sql);
$connect->close();

echo json_encode($output);