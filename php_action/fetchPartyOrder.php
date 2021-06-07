<?php 	

require_once 'core.php';

$sql = "SELECT * FROM party_order NATURAL JOIN parties ORDER BY order_id DESC";
$result = $connect->query($sql);



$output = array('data' => array());

if($result->num_rows > 0) { 
 
 $x = 1;

 while($row = $result->fetch_array()) {
 	$orderId = $row['order_id'];
 	$productCount = count(explode("|", $row['product_ids'])) - 1;
 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a href="orders-party.php?o=editOrd&i='.$orderId.'" id="editOrderModalBtn"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>

	    <li><a href="orders-party.php?o=viewOrder&i='.$orderId.'"> <i class="glyphicon glyphicon-print"></i> View Order </a></li>
	    
	    <li><a type="button" data-toggle="modal" data-target="#removeOrderModal" id="removeOrderModalBtn" onclick="removeOrder('.$orderId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';		

 	$output['data'][] = array( 		
 		// image
 		$x,
 		// order date
 		$row['order_date'],
 		// product name
 		$row['party_name'],

 		$productCount, 
 		// button
 		$button 		
 		); 	
 	$x++;
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);