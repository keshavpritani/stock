<?php 	

require_once 'core.php';

$PartyId = $_POST['PartyId'];

$sql = "SELECT * FROM parties WHERE party_id = $PartyId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);