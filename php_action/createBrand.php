<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$brandName = $_POST['brandName'];
	$brandStatus = $_POST['brandStatus']; 
	$maker_id = $_POST['maker_id']; 

	$sql = "INSERT INTO brands (brand_name, brand_active, brand_status, maker_id) VALUES ('$brandName', '$brandStatus', 1, '$maker_id')";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the members";
	}
	 

	$connect->close();

	echo json_encode($valid);
  
} // /if $_POST