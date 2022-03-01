<?php 

//session_start();
include_once "db_connect.php";
include_once "inc/functions.php";
     

 if(empty($_SESSION['userId'])) {
 ?>
 <script>     window.location.assign('index.php');
  </script>
 <?php
 }else{

  @$fetchedUserData=fetchRecord($dbc,"users", "user_id",@$_SESSION['userId']);
  @$fetchedUserRole=$fetchedUserData['user_role'];
  //echo $getpage ;
   $getpage = basename($_SERVER['REQUEST_URI']);
    $checkurlvalidQ = mysqli_query($dbc, "SELECT privileges.*,menus.*  FROM privileges INNER JOIN menus ON privileges.nav_id=menus.id WHERE privileges.user_id = '$_SESSION[userId]' AND menus.page='$getpage' ");
  
if (mysqli_num_rows($checkurlvalidQ)>0) {
	$userPrivileges=mysqli_fetch_assoc($checkurlvalidQ);

    @$runQ = mysqli_query($dbc, "UPDATE reservation SET reservation_sts = CASE WHEN reservation_expiry_date < '".date('Y-m-d')."' THEN '2'ELSE '1' END WHERE  reservation_sts=1");
    $runD = mysqli_query($dbc,"SELECT  reservation.*,invoice.* FROM reservation INNER JOIN invoice ON invoice.invoice_customer = reservation.reservation_customer ");
    if (mysqli_num_rows($runD)>0) {
        while(@$r=mysqli_fetch_assoc($runD)):
             @$runDD = mysqli_query($dbc, "UPDATE reservation SET reservation_sts =1  WHERE  vehicle_id='".$r['vehicle_id']."' AND reservation_customer='".$r['reservation_customer']."' ");
        endwhile;
    }
	
}
	 } 



?>
