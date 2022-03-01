<?php 
include_once 'db_connect.php';
	 /*Delete*/
 if (!empty($_REQUEST['delete_id'])) {
 	# code...
 	$id=$_REQUEST['delete_id'];
 	$table=$_REQUEST['table'];
 	$fld=$_REQUEST['fld'];
 	if(mysqli_query($dbc,"DELETE FROM $table WHERE $fld='$id'")){
 		$msg = "Data Has been deleted...";
 		$sts ="success";
 	}else{
 			$msg = mysqli_error($dbc);
 			$sts = "danger";
 	}
 	echo json_encode(['msg'=>$msg,"sts"=>$sts]);
 }
  ?>
