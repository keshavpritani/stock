<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$brandName = $_POST['editCategoriesName'];
  $brandStatus = $_POST['editcategoriesStatus']; 
  $categoriesId = $_POST['editCategoriesId'];

	$sql = "UPDATE categories SET categories_name = '$brandName', qty_in_stock = qty_in_stock + ('$brandStatus') WHERE categories_id = '$categoriesId'";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while updating the categories";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST

echo '
<script>
	window.location.href = "http://localhost/stock/categories.php";
</script>
';