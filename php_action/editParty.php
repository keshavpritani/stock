<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$partyName = $_POST['editPartyName'];
  $party_id  = $_POST['editPartyId'];

	$sql = "UPDATE parties SET party_name = '$partyName' WHERE party_id  = '$party_id'";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated - $party_id - $partyName";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while updating the party";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST

echo '
<script>
	window.location.href = "http://localhost/stock/party.php";
</script>
';