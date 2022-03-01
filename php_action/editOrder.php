<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
	$order_id=$orderId = $_POST['orderId'];

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
  $fetchthistransaction = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM orders WHERE order_id = '$orderId'"));

				
	$sql = "UPDATE orders SET order_date = '$orderDate', client_name = '$clientName', client_contact = '$clientContact', sub_total = '$subTotalValue', vat = '$vatValue', total_amount = '$totalAmountValue', discount = '$discount', grand_total = '$grandTotalValue', paid = '$paid', due = '$dueValue', payment_type = '$paymentType', payment_status = '$paymentStatus', order_status = 1 WHERE order_id = {$orderId}";	
	
	if ($dueValue>0) {
		  	# code...
		  	echo $credit =$dueValue;
		  	//$balance = $fetchTransaction['balance']+$credit;
		  	$q= mysqli_query($dbc, "UPDATE transactions SET credit = '$credit' WHERE transaction_id = '$fetchthistransaction[transaction_id]'");
		  	// $q=mysqli_query($dbc,"INSERT INTO transactions(debit,credit,balance,customer_id,transaction_remarks) VALUES('0','$credit','$balance','$clientName','$transaction_remarks')");
		  	// $transaction_last_id = mysqli_insert_id($dbc);
		   	//  mysqli_query($dbc,"UPDATE orders SET transaction_id='$transaction_last_id' WHERE order_id='$order_id'");
		  }
		if ($dueValue<0) {
		  	# code...
		  	$debit =$dueValue;
		  	$balance = $fetchTransaction['balance']+$debit;
		  	$q= mysqli_query($dbc, "UPDATE transactions SET debit = '$debit' WHERE transaction_id = '$fetchthistransaction[transaction_id]'");
		  	
		  	// $q=mysqli_query($dbc,"INSERT INTO transactions(debit,credit,balance,customer_id,transaction_remarks) VALUES('$debit','0','$balance','$clientName','$transaction_remarks')");
		  	// $transaction_last_id = mysqli_insert_id($dbc);
		  	//  mysqli_query($dbc,"UPDATE orders SET transaction_id='$transaction_last_id' WHERE order_id='$order_id'");
		  }
		 if ($dueValue==0) {
		  	# code...
		  	$debit =$paid;
		  	$balance = $fetchTransaction['balance']-$debit;
		  	$q= mysqli_query($dbc, "UPDATE transactions SET debit = '$debit' AND credit = '0' WHERE transaction_id = '$fetchthistransaction[transaction_id]'");
		  	
		  	// $q=mysqli_query($dbc,"INSERT INTO transactions(debit,credit,balance,customer_id,transaction_remarks) VALUES('$debit','0','$balance','$clientName','$transaction_remarks')");
		  	// $transaction_last_id = mysqli_insert_id($dbc);
		  	//  mysqli_query($dbc,"UPDATE orders SET transaction_id='$transaction_last_id' WHERE order_id='$order_id'");
		  }
		  $connect->query($sql);
			

		// mysqli_query($dbc,"INSERT INTO budget(budget_name,budget_amount,budget_type,budget_date) VALUES('$budget_name','$budget_amount','$budget_type','$budget_date')");
	
	$readyToUpdateOrderItem = false;
	// add the quantity from the order item to product table
	for($x = 0; $x < count($_POST['productName']); $x++) {		
		//  product table
		$updateProductQuantitySql = "SELECT product.quantity FROM product WHERE product.product_id = ".$_POST['productName'][$x]."";
		$updateProductQuantityData = $connect->query($updateProductQuantitySql);			
			
		while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
			// order item table add product quantity
			$orderItemTableSql = "SELECT order_item.quantity FROM order_item WHERE order_item.order_id = {$orderId}";
			$orderItemResult = $connect->query($orderItemTableSql);
			$orderItemData = $orderItemResult->fetch_row();

			$editQuantity = $updateProductQuantityResult[0] + $orderItemData[0];							

			$updateQuantitySql = "UPDATE product SET quantity = $editQuantity WHERE product_id = ".$_POST['productName'][$x]."";
			$connect->query($updateQuantitySql);		
		} // while	
		
		if(count($_POST['productName']) == count($_POST['productName'])) {
			$readyToUpdateOrderItem = true;			
		}
	} // /for quantity

	// remove the order item data from order item table
	for($x = 0; $x < count($_POST['productName']); $x++) {			
		$removeOrderSql = "DELETE FROM order_item WHERE order_id = {$orderId}";
		$connect->query($removeOrderSql);	
	} // /for quantity

	if($readyToUpdateOrderItem) {
			// insert the order item data 
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
				VALUES ({$orderId}, '".$_POST['productName'][$x]."', '".$_POST['quantity'][$x]."', '".$_POST['rateValue'][$x]."', '".$_POST['totalValue'][$x]."', 1)";

				$connect->query($orderItemSql);		
			} // while	
		} // /for quantity
	}

	

	$valid['success'] = true;
	$valid['messages'] = "Successfully Updated";		
	
	$connect->close();

	echo json_encode($valid);
	//echo header('location:../orderslist.php?o=manord');
 
} // /if $_POST
// echo json_encode($valid);