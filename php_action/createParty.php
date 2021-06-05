<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$partyName = $_POST['partyName'];

	$sql = "INSERT INTO parties (party_name) VALUES ('$partyName')";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the Party";
	}

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST