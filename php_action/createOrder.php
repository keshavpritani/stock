<?php 	

require_once 'core.php';

$valid = array('success' => false, 'messages' => array());
// print_r($valid);
if($_POST) {	

	$productID=$_POST['productName'][0];
	$material = $_POST['material'];
	$material_name = array();
	$qty = $_POST['qty'];
	$desc = "";
	for($x = 0; $x < count($material); $x++) 
	{	
		if(!($qty[$x]>0))
			continue;
		$sql = "SELECT * FROM categories WHERE categories_id = $material[$x]";
		$result = $connect->query($sql);
		$row = $result->fetch_array();
		if($row['categories_status']!=1)
		{
			$valid['messages'] = $row["categories_name"]." is not Active";
			echo json_encode($valid);
			return;
		}
		if($row["qty_in_stock"]-$qty[$x]<0)
		{
			$valid['messages'] = $row["categories_name"]." has Insuffient Stock";
			echo json_encode($valid);
			return;
		}
		$desc .= $row['categories_name']." - ".$qty[$x].", ";
	}
	for($x = 0; $x < count($material); $x++) 
	{	
		$sql = "UPDATE  categories SET qty_in_stock = qty_in_stock - $qty[$x] WHERE categories_id = $material[$x]";
		$result = $connect->query($sql);
	}
				
	$sql = "INSERT INTO order_log (product_id,description) VALUES($productID,'$desc')";
	
	
	if($connect->query($sql) === true) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Added";	
	}
	
	
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);