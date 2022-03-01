<script type="text/javascript">
	 window.print();
</script>
<center>
<?php
include_once "php_action/db_connect.php";
include_once "includes/header_print.php";
if($_GET){
	 $userid = $_GET['var'];
	//  $qury = "SELECT * from transactions WHERE transaction_id=$userid";
	// 	@$chk = mysql_query($qury);
	// @$feth =	mysql_fetch_array($chk);
	$sqll = "SELECT * FROM transactions WHERE customer_id='$userid' ORDER BY transaction_id DESC limit 1";

										$resultt = $connect->query($sqll);

										while($roww = $resultt->fetch_array()) {
											
											  $customer_blance_remain = $roww['balance'];

										}//while transation	\
 

$sql = "SELECT * FROM customers WHERE customer_id= '$userid' ";

										$result = $connect->query($sql);

										while($row = $result->fetch_array()) {
											$customer_id = $row[0];
											$customer_name = $row[1];
											$customer_blance = '';
											$customer_phone = $row[3];

}

 $sql = "SELECT * FROM company ORDER BY id ASC LIMIT 1";

                    $result = $connect->query($sql);

                    while($row = $result->fetch_array()) {
                     
                   // while?>
	
    <?php
    $logo = $row['logo'];
     $name= $row['name'];
   $company_phone= $row['company_phone'];
	$personal_phone=$row['personal_phone'];
	$address=$row['address'];

 }
  
					?>

	<div class="panel panel-info">
		<div class="panel-heading" align="center">Remaining Balanace</div>
		<div class="panel-body text-uppercase">
			<h3><?= $name;  ?></h3>
			<h4>Contact :<?= $company_phone; ?></h4>
			<h5><?= $address ; ?></h5>
			<table border="1px" cellpadding="5" cellpadding="10" class="table table-bordered text-center">
				<thead>
				<tr style="text-align: center !important">
					
					<th class="text-center">Account Name</th>
					<th class="text-center">Contact Person</th>
					<th class="text-center">Balance</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo  $customer_name; ?></td>
					<td><?php echo $customer_phone; ?></td>
					<td style="font-size:20px; "><?php echo $customer_blance_remain; ?></td>
				</tr>
				</tbody>
			</table>
		</div>
	</div>
<?php }  ?>

</center>
