<?php 	

require_once 'core.php';

$valid = array('success' => false, 'messages' => array());
// print_r($valid);
// echo json_encode($valid);
if($_POST) {	

	$productID=$_POST['productName'];
	$partyName = $_POST['partyName'];
	$qty = $_POST['quantity'];
	/*echo $partyName."<br>";
	echo json_encode($productID)."<br>";
	echo json_encode($qty)."<br>";*/
	$desc = "";
	for($x = 0; $x < count($productID); $x++) 
	{
		$sql = "SELECT * FROM product WHERE product_id = $productID[$x]";
		$result = $connect->query($sql);
		$row = $result->fetch_array();
		if($row["rate"]-$qty[$x]<0)
		{
			$valid['messages'] = $row["product_name"]." has Insuffient Stock";
			echo json_encode($valid);
			return;
		}
		$desc .= $productID[$x]."-".$qty[$x]."|";
	}
	for($x = 0; $x < count($productID); $x++) 
	{	
		$sql = "UPDATE product SET rate = rate - $qty[$x] WHERE product_id = $productID[$x]";
		$result = $connect->query($sql);
	}
	$sql = "INSERT INTO party_order (party_id,product_ids) VALUES($partyName,'$desc')";
	
	
	if($connect->query($sql) === true) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Added";	
	}
	
	
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
return;