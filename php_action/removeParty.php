<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$PartyId = $_POST['PartyId'];

if($PartyId) { 

	 $sql = "UPDATE parties SET party_status = 2 WHERE party_id = {$PartyId}";

	 if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Removed";		
	 } else {
		$valid['success'] = false;
		$valid['messages'] = "Error while removing the Party";
	 }
 }
 $connect->close();

 echo json_encode($valid);
 
?>