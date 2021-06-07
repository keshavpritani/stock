<?php 	

require_once 'core.php';

$orderId = $_POST['orderId'];

$valid = array('order' => array(), 'order_item' => array());

$sql = "SELECT * FROM party_order NATURAL JOIN parties WHERE order_id = $orderId";

$result = $connect->query($sql);
$products = array();
$row = $result->fetch_array();
$ps = explode("|", $row['product_ids']);
for ($i=0; $i < count($ps)-1; $i++) { 
	$id = explode("-",$ps[$i]);
	$qty=$id[1];
	$id=$id[0];
	$sql = "SELECT * FROM product WHERE product_id = $id";
	$result = $connect->query($sql);
	$row = $result->fetch_array();
	array_push($products, array($row['product_name'],$qty) );
}

$valid['order'] = $data;
$valid['order_item'] = $products;


$connect->close();

echo json_encode($valid);