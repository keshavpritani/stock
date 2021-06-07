<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());
// echo json_encode($valid);
if($_POST) {	
	$orderId = $_POST['orderId'];
	$newQty = $_POST['quantity'];

$sql = "SELECT * FROM party_order WHERE order_id = $orderId";

$result = $connect->query($sql);
$products = array();
$row = $result->fetch_array();
$ps = explode("|", $row['product_ids']);
for ($i=0; $i < count($ps)-1; $i++) { 
	$id = explode("-",$ps[$i]);
	$qty=$id[1];
	$id=$id[0];
	array_push($products, array($id,$qty) );
}

/*$newQty[0]=0;
print_r($products);
echo "<br>";
print_r($newQty);
echo "<br>";*/
/*if ($newProducts) {
	echo $newProducts;
}
else
	echo "Keshav";*/


	for ($i=0; $i < count($products); $i++) { 
		if($newQty[$i] != $products[$i][1])
		{
			// echo $products[$i][0];
			$new = $newQty[$i] - $products[$i][1];
			$sql = "SELECT * FROM product WHERE product_id = ". $products[$i][0];
			$result = $connect->query($sql);
			$row = $result->fetch_array();
			if($row['status']!=1)
			{
				$valid['messages'] = $row["product_name"]." is not Active";
				echo json_encode($valid);
				return;
			}
			if($row["rate"]<$new)
			{
				$valid['messages'] = $row["product_name"]." has Insuffient Stock";
				echo json_encode($valid);
				return;
			}
		}
	}

	$desc="";

	for ($i=0; $i < count($products); $i++)
	{
		$new = $newQty[$i] - $products[$i][1];
		$sql = "UPDATE  product SET rate = rate - $new WHERE product_id = ". $products[$i][0];
		$result = $connect->query($sql);
		// echo $sql."<br>";
		if($newQty[$i]!=0)
			$desc.=$products[$i][0]."-".$newQty[$i]."|";
	}

	if(count($newQty)!=count($products))
	{
		for ($i=0; $i < count($_POST['productName']); $i++) {
			$sql = "SELECT * FROM product WHERE product_id = " .$products[$i][0];
			$result = $connect->query($sql);
			$row = $result->fetch_array();
			if($row["rate"]-$newQty[count($products) - 1 + $i]<0)
			{
				$valid['messages'] = $row["product_name"]." has Insuffient Stock";
				echo json_encode($valid);
				return;
			}
		}

		for ($i=0; $i < count($_POST['productName']); $i++) {
			$desc.=$_POST['productName'][$i]."-".$newQty[count($products) - 1 + $i]."|";
		}
	}

	// echo $desc;
	
	$sql = "UPDATE party_order SET product_ids = '$desc' WHERE order_id=$orderId";
	if($connect->query($sql))
	{
		$valid['success'] = true;
		$valid['messages'] = "Successfully Updated";		
	}
	
	$connect->close();

 
} // /if $_POST
echo json_encode($valid);