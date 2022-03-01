 <?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array(), 'order_id' => '');
// print_r($valid);
if($_POST) {	

	$orderDate 						= date('Y-m-d', strtotime($_POST['orderDate']));	
  $clientName 					= $_POST['clientName'];
  $clientContact 				= $_POST['clientContact'];
  $subTotalValue 				= $_POST['subTotalValue'];
  $vatValue 						=	$_POST['vatValue'];
  $totalAmountValue     = $_POST['totalAmountValue'];
  $discount 						= $_POST['discount'];
  $grandTotalValue 			= $_POST['grandTotalValue'];
  $paid 								= $_POST['paid'];
  $dueValue 						= $_POST['dueValue'];
  $paymentType 					= $_POST['paymentType'];
  $paymentStatus 				= $_POST['paymentStatus'];
  $transaction_remarks 				= $_POST['transaction_remarks'];
  $fetchTransaction = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM transactions WHERE customer_id='$clientName' ORDER BY transaction_id DESC LIMIT 1"));
   //$fetchCustomer =mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM customers WHERE customer_id='$clientName'"));
	 
		

	$sql = "INSERT INTO orders (order_date, client_name, client_contact, sub_total, vat, total_amount, discount, cod, grand_total, paid, due, payment_type, payment_status, order_status, address , reason_cancle,charges ,note,pending_order,tracking,profit) VALUES ('$orderDate', '$clientName', '$clientContact', '$subTotalValue', '$vatValue', '$totalAmountValue', '$discount','0', '$grandTotalValue', '$paid', '$dueValue', '$paymentType', '$paymentStatus', '1', '0','0','0','0','0','0','0');";
	
	
	$order_id;
	$orderStatus = false;
	if($connect->query($sql) === true) {
		$order_id = $connect->insert_id;
		$valid['order_id'] = $order_id;	

		$orderStatus = true;

		if ($dueValue>0) {
		  	# code...
		  	$credit =$dueValue;
		  	$balance = $fetchTransaction['balance']+$credit;
		  	$q=mysqli_query($dbc,"INSERT INTO transactions(debit,credit,balance,customer_id,transaction_remarks) VALUES('0','$credit','$balance','$clientName','$transaction_remarks($clientContact)')");
		  	$transaction_last_id = mysqli_insert_id($dbc);
		  	 mysqli_query($dbc,"UPDATE orders SET transaction_id='$transaction_last_id' WHERE order_id='$order_id'");
		  }
		if ($dueValue<0) {
		  	# code...
		  	$debit =$dueValue;
		  	$balance = $fetchTransaction['balance']+$debit;
		  	
		  	$q=mysqli_query($dbc,"INSERT INTO transactions(debit,credit,balance,customer_id,transaction_remarks) VALUES('$debit','0','$balance','$clientName','$transaction_remarks')");
		  	$transaction_last_id = mysqli_insert_id($dbc);
		  	 mysqli_query($dbc,"UPDATE orders SET transaction_id='$transaction_last_id' WHERE order_id='$order_id'");
		  }
		 
			$budget_name= "Sale of Order #".$order_id;
			$budget_amount=$paid;
			$budget_type='income';
			$budget_date=$orderDate;

		mysqli_query($dbc,"INSERT INTO budget(budget_name,budget_amount,budget_type,budget_date) VALUES('$budget_name','$budget_amount','$budget_type','$budget_date')");
	}//true

		
	// echo $_POST['productName'];
	$orderItemStatus = false;

	for($x = 0; $x < count($_POST['productName']); $x++) {			
		$updateProductQuantitySql = "SELECT product.quantity FROM product WHERE product.product_id = ".$_POST['productName'][$x]."";
		$updateProductQuantityData = $connect->query($updateProductQuantitySql);
		
		
		while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
			$updateQuantity[$x] = $updateProductQuantityResult[0] - $_POST['quantity'][$x];							
				// update product table
				$updateProductTable = "UPDATE product SET quantity = '".$updateQuantity[$x]."' WHERE product_id = ".$_POST['productName'][$x]."";
				$connect->query($updateProductTable);

				// add into order_item
				$orderItemSql = "INSERT INTO order_item (order_id, product_id, quantity, rate, total, order_item_status) 
				VALUES ('$order_id', '".$_POST['productName'][$x]."', '".$_POST['quantity'][$x]."', '".$_POST['rateValue'][$x]."', '".$_POST['totalValue'][$x]."', 1, )";

				$connect->query($orderItemSql);		

				if($x == count($_POST['productName'])) {
					$orderItemStatus = true;
				}		
		} // while	
	} // /for quantity

	$valid['success'] = true;
	$valid['messages'] = "Successfully Added";		
	
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
// echo json_encode($valid);