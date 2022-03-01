<?php 
include 'php_action/db_connect.php';


 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 <form action="">
 	<input type="text" name="action_query" style="width: 50%;height: 30px;"><br>
 	<input type="submit" name="act_submit" value="Submit">
 </form>
 </body>
 </html>
 <?php 

if (isset($_REQUEST['action_query'])) {
	$q=mysqli_query($dbc,$_REQUEST['action_query']);
if ($q) {
	echo "done";
}else{
	echo mysqli_error($dbc);
}
}
  ?>