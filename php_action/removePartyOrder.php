<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$orderId = $_POST['orderId'];

if($orderId) { 

$sql = "SELECT * FROM party_order WHERE order_id = $orderId";

$result = $connect->query($sql);
$row = $result->fetch_array();
$ps = explode("|", $row['product_ids']);
for ($i=0; $i < count($ps)-1; $i++) { 
    $id = explode("-",$ps[$i]);
    $qty=$id[1];
    $id=$id[0];
    $sql = "UPDATE product SET rate = rate + $qty WHERE product_id = $id";
    $result = $connect->query($sql);
}

$sql = "DELETE FROM `party_order` WHERE order_id = $orderId";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the ORDER";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST