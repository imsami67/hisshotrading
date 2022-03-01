<?php
include_once "includes/header.php";
?>

<div class="panel panel-success">
	<div class="panel-heading" align="center"><h4>Pending Balance</h4></div>
	<div class="panel-body">
		<div class="table table-responsive">
		<button class="btn btn-danger print_hide pull pull-right" onclick="window.print();"><span class="glyphicon glyphicon-print"></span> Print All Report </button>
			<table class="table table-hover" cellspacing="5" cellpadding="5" id="myTable">
				<tr>
					<th>Customer Name</th>
					<th>phone</th>
					<th>Blance</th>
					<th class="print_hide">Print</th>


				</tr>
		
		<?php 
						      	$sql = "SELECT * FROM customers WHERE customer_active = 1";

										$result = $connect->query($sql);

										while($row = $result->fetch_array()) {
											$customer_id = $row[0];
											$customer_name = $row[1];
											$customer_blance = '';
											$customer_phone = $row[3];
										$sqll = "SELECT * FROM transactions WHERE customer_id='$customer_id' ORDER BY transaction_id DESC limit 1";

										$resultt = $connect->query($sqll);

										while($roww = $resultt->fetch_array()) {
											
											 $customer_blance = $roww['balance'];

										}//while transation	

					?>
					<tr>
						<td><?php echo $customer_name; ?></td>
						<td><?php echo $customer_phone; ?></td>
						<td><?php echo $customer_blance; ?></td>
						<td class="print_hide"><a href="print_balance.php?var=<?php echo $row[0]; ?>"> <button class="btn btn-info"><span class="glyphicon glyphicon-print"></span> Print</button></td>
					</tr>
					<?php					

										} // while customer
										
						      	?>
			</table>			      	
		</div><!--table-->				      	
	</div>
</div>












<?php
include_once "includes/footer.php";
?>