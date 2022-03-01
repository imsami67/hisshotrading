<?php 	



require_once 'core.php';
require_once 'db_connect.php';



$sql = "SELECT product_id, product_name FROM product WHERE status = 1 AND active = 1 ORDER BY product_name ASC";

$result = mysqli_query($dbc,$sql);



while($r=mysqli_fetch_assoc($result)){
				$arr[]=$r;
			}
	echo json_encode(["data"=>$arr]);

// $connect->close();



