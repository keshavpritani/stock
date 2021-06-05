<?php 	

require_once 'core.php';
$valid = array('success' => false, 'messages' => array());

if($_POST) {	

	$productName 		= $_POST['productName'];
  // $productImage 	= $_POST['productImage'];
  $quantity 			= $_POST['qty'];
  $rate 					= 0;
  $brandName 			= $_POST['brandName'];
  $categoryName 	= $_POST['categoryName'];


	$type = explode('.', $_FILES['productImage']['name']);
	$type = $type[count($type)-1];		
	$url = '../assests/images/stock/'.uniqid(rand()).'.'.$type;
	if($_FILES['productImage']['name']!="" && in_array($type, array('gif', 'jpg', 'jpeg', 'png', 'JPG', 'GIF', 'JPEG', 'PNG')))
		if(is_uploaded_file($_FILES['productImage']['tmp_name'])) 
			move_uploaded_file($_FILES['productImage']['tmp_name'], $url);
	$sql = "INSERT INTO product (product_name, product_image, brand_id , rate, status) 
	VALUES ('$productName', '$url', '$brandName', '$rate', 1)";
	// echo "$sql";

	if($connect->query($sql) === TRUE) {
		$product_id = $connect->insert_id;
		for ($i=0; $i < count($categoryName); $i++) { 
			$sql = "INSERT INTO product_materials (product_id, categories_id, qty) VALUES ($product_id,$categoryName[$i],$quantity[$i])";
			$connect->query($sql);
		}

		$valid['success'] = true;
		$valid['messages'] = "Successfully Added";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while adding the members";
	}
/*
			}	else {
				return false;
			}	// /else	
		} // if
	} // if in_array 		
*/
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST