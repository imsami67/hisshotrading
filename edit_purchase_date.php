 
 <?php
include_once "includes/header.php";
  			$orderId = $_GET['var'];

  			$sql = "SELECT * FROM purchase WHERE purchase_id = '$orderId'";

				$result = $connect->query($sql);
				$data = $result->fetch_row();				
  			

?>

<form method="post" action="">
<div class="form-group">

			    <label for="orderDate" class="col-sm-2 control-label">Purchase Date</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control dateField" id="orderDate" name="purchase_date" 
			      value="<?php echo $data[1] ?>"     />
			    </div>
			  </div> <!--/form-group-->

<input type="submit" name="update_purchase" value="Update Purchase" class="btn btn-danger">			  

</form>	 

<?php

if (isset($_POST['update_purchase'])) {
	$purchase_date = $_POST['purchase_date'];

	$sql = "UPDATE purchase SET purchase_date = '$purchase_date'  WHERE purchase_id = '$orderId '";	
	$connect->query($sql);
	$connect->close();

	
	echo '<script>alert("purchase Updated....! ")</script>';
	echo "<script>  window.location.assign('show_purchase.php')</script>";
}

?>