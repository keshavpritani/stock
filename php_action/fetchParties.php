<?php 	

require_once 'core.php';

$sql = "SELECT * FROM parties WHERE party_status = 1";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();

 while($row = $result->fetch_array()) {
 	$PartiesId = $row[0];

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="editPartiesModalBtn" data-target="#editPartyModal" onclick="editParty('.$PartiesId.')"> <i class="glyphicon glyphicon-edit"></i> Edit Party</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removePartyModal" id="removePartiesModalBtn" onclick="removeParty('.$PartiesId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array( 		
 		$row[1],
 		$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);