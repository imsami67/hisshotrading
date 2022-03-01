<?php 	

  // $username = "nexcojap_website";
  // $password = "nexcojap_website";
  // $dbname = "nexcojap_website";
$localhost = "localhost";
 $username = "root";
 $password = "";
 $dbname = "hisso_tradingv1";

$connect = new mysqli($localhost, $username, $password, $dbname);
$dbc =  mysqli_connect($localhost, $username, $password, $dbname);
@session_start();
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  //echo "Done";
}

?>