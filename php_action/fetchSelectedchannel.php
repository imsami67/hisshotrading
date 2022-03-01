<?php 	

require_once 'core.php';

$productId = $_POST['productId'];

$sql = "SELECT channel_id, channel_name, airing, duration, channel_time, rate, status FROM channels WHERE channel_id = $productId ORDER BY channel_name ASC";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);