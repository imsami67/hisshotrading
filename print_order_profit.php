<?php 
	include_once "includes/header.php"; 
	include_once "php_action/db_connect.php"; 
?>
<script>
	window.print()
</script>
<?php if(!empty($_REQUEST['i'])):
	 $orderid = $_REQUEST['i'];
 ?>

<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
<center>
	<a href="#" onclick="window.print()" class="print_hide btn btn-block btn-primary">Print Report</a>
<?php

$sql="SELECT * FROM orders WHERE order_id='$orderid'";
$result=mysqli_query($dbc,$sql);

// Associative array
$row=mysqli_fetch_assoc($result);
 $row["order_id"];

// Free result set
mysqli_free_result($result);

mysqli_close($dbc);
	


$orderId = $row["order_id"];

$sql = "SELECT order_date, client_name, client_contact, sub_total, vat, total_amount, discount, grand_total, paid, due FROM orders WHERE order_id = $orderId";

$orderResult = $connect->query($sql);
$orderData = $orderResult->fetch_array();

$orderDate = $orderData[0];
 $clientName_id = $orderData[1];
	$q ="SELECT * FROM customers WHERE customer_id='$clientName_id'";
	 $getCustomer=$connect->query($q);
	 $fetchCustomer=$getCustomer->fetch_assoc();
	 $client_name = $fetchCustomer["customer_name"];
			$clientContact = $orderData[2]; 
			$subTotal = $orderData[3];
			$vat = $orderData[4];
			$totalAmount = $orderData[5]; 
			$discount = $orderData[6];
			$grandTotal = $orderData[7];
			$paid = $orderData[8];
			$due = $orderData[9];


$orderItemSql = "SELECT order_item.product_id, order_item.rate, order_item.quantity, order_item.total,
product.product_name FROM order_item
	INNER JOIN product ON order_item.product_id = product.product_id 
 WHERE order_item.order_id = $orderId";
$orderItemResult = $connect->query($orderItemSql);
if ( mysqli_num_rows($orderItemResult) > 0): ?>
 <?php
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
 <table border="1" cellspacing="0" cellpadding="2" width="100%" class="table">
	<thead>
		<tr >
			<th colspan="5">
				<div align="center">
				<!-- <img src="img/uploads/<?= $logo; ?>" class="img-responsive" style="width: 100%; height: 70px;"> -->
				<h2><?php echo $row['name']; ?></h2>
				<p style="font-size: 16px; margin-top: -10px;"><strong>Company No:</strong> <?php echo $name  ?></p>
				<p style="font-size: 16px; margin-top: -10px;"><strong>Company No:</strong> <?php echo $company_phone  ?></p>
				<p style="font-size: 16px; margin-top: -10px;"><strong>Personal No:</strong> <?php echo $personal_phone ?></p>
				<p style="font-size: 16px; margin-top: -10px;"><strong>Address:</strong> <?php echo $address ?></p>
				</div>
			</th>
		</tr>	
		<tr >
			<th colspan="5">
			<div align="center">
				Bill No.: <strong><?php echo $orderId ; ?> </strong><br />
				Order Date : <strong><?php echo $orderDate ; ?> </strong><br />
				Account Title : <strong> <?php echo $client_name ; ?></strong><br />
				Customer :<strong> <?php echo $clientContact ; ?></strong>
				

			</div>

			</th>
			</tr>

		<tr >
			<th colspan="5">

			<center>
				
			</center>		
			</th>
				
		</tr>		
	</thead>
</table>
<table border="0" width="100%;" cellpadding="1" style="border:1px solid black;border-top-style:1px solid black;border-bottom-style:1px solid black ;" class="table table-bordered">

	<tbody>
		<tr>
			<th>S.no</th>
			<th>Product</th>
			<th>Rate</th>
			<th>QTY</th>
			
			<th>Total</th>
		</tr>
		<?php
		$x = 1;	
		while($row = $orderItemResult->fetch_array()) {
				$product_id = $row['product_id'];
				$getProduct = $connect->query("SELECT * FROM product WHERE product_id='$product_id'");
				$fetchProduct = $getProduct->fetch_assoc();
				$getCategory = $connect->query("SELECT * FROM categories WHERE categories_id='$fetchProduct[categories_id]'");
				$fetchCategory = $getCategory->fetch_assoc();
			
		?>				
			 <tr>
				<th><?php echo $x ?></th>
				<td style="font-size:12px;"><?php echo $row[4]; ?> (<?=$fetchCategory['categories_name']?>)</td>
				<th><?php echo $row[1]; ?></th>
				<th><?php echo $row[2]; ?></th>
				<th><?php echo $row[3] ; ?></th>
			
		<?php	
		$x++;
		} // /while
?>
		</tr>
</tbody>
</table>
			
		<div class="row">
			<div class="col-sm-4 pull-right">
				<table class="table table-bordered lead">
		<tr class="lead">
		<?php
		$sql = "SELECT * FROM customers WHERE customer_id = '$clientName_id'";

			$result = $connect->query($sql);

			while($row = $result->fetch_array()) {
				$customer_id = $row[0];
				$customer_name = $row[1];
				$customer_blance = '';
			$sqll = "SELECT * FROM transactions WHERE customer_id='$clientName_id' ORDER BY transaction_id DESC limit 1";
			$resultt = $connect->query($sqll);
			while($roww = $resultt->fetch_array()) {
				 $customer_blance = $roww['balance'];
				 $customer_credit = $roww['credit'];
			}//while transation	
		}
			?> 
			<td>Due Amount</td>
			<td><h2 class="label label-danger" style="font-size: 25px"><?php echo @($customer_blance- $customer_credit); ?></h2></td>			
		</tr>

		<tr>
			<td>Now Paid Amount </td>
			<td><?php echo @$paid  ?></td>			
		</tr>
		<tr>
			<td>Remaining Balance</td>
			<td><h4><?php echo  @$customer_blance; ?></h4></td>			
		</tr>
		<tr  class="lead">
			<!-- Calculate Profit -->
	<?php	
	$net_profit=0;
		 $sql = "SELECT * FROM order_item WHERE order_id = '$orderid'";
			$query = $connect->query($sql);
	while ($result = $query->fetch_assoc()) {
		  $product_id= $result['product_id'];
		 $sold_quantity= $result['quantity'];
		 $sold_rate= $result['rate'];
		
	$sql_item = "SELECT * FROM product WHERE product_id = '$product_id'";
	$query_item = $connect->query($sql_item);
	while ($result_item = $query_item->fetch_assoc()) {
		 $product_purchase= $result_item['purchase'];
	
	$sold_income = $sold_quantity * $sold_rate;
	$purchase_income = $product_purchase * $sold_quantity; 
}
 	$net_profit+=$sold_income-$purchase_income ;
 }//while
		?>
			<td>Profit</td>
			<td><h2 class="label label-success" style="font-size: 25px"><?php echo  @$net_profit; ?></h2></td>			
		</tr>
		</div>	
	</table>
</div><!-- col -->
</div><!-- row -->
<?php endif; //when row found ?>

</center>
</div>
</div>
<?php else: ?>
	<h2 class="text-center text-danger">No Data Found <a href="orders.php?o=manord">Go Back</a></h2>
<?php endif; ?>
<?php include_once "includes/footer.php"; ?>
