<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {
	$productId = $_POST['productId'];
	$productName 		= $_POST['editProductName']; 
	$rate 					= 0;
	$brandName 			= $_POST['editBrandName'];

	$sql = "UPDATE product SET product_name = '$productName', brand_id = '$brandName', rate = '$rate' WHERE product_id = $productId ";
	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Update";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating product info";
	}
	if($valid['success'])
	{
		$material = $_POST['categoryName'];
		$qty=$_POST['qty'];
		for ($i=0; $i < count($material); $i++) {
			if($qty[$i]==0)
			{
				$sql="DELETE FROM product_materials WHERE product_id = $productId AND categories_id = $material[$i]";
				if($connect->query($sql)!=TRUE)
				{
					$valid['success'] = false;
					$valid['messages'] = "Error while updating Product Materials info $sql";
				}
				continue;
			}
			$sql = "SELECT categories_id FROM product_materials WHERE product_id = $productId AND categories_id = $material[$i]";
			$result = $connect->query($sql);
			if($result->num_rows > 0)
				$sql = "UPDATE product_materials SET qty = $qty[$i] WHERE product_id = $productId AND categories_id = $material[$i]";
			else
				$sql = "INSERT INTO product_materials (product_id, categories_id, qty) VALUES ($productId, $material[$i], $qty[$i])";
			if($connect->query($sql)!=TRUE)
			{
				$valid['success'] = false;
				$valid['messages'] = "Error while updating Product Materials info $sql";
			}
		}
	}

} // /$_POST
	 
$connect->close();

echo json_encode($valid);
 
