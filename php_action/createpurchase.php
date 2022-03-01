<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array(), 'purchase_id' => '');
// print_r($valid);
if($_POST) {	

	$purchaseDate 						= date('Y-m-d', strtotime($_POST['purchaseDate']));	
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
   $fetchCustomer =mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM customers WHERE customer_id='$clientName'"));


	$sql = "INSERT INTO purchase (purchase_date, client_name, client_contact, sub_total, vat, total_amount, discount, grand_total, paid, due,payment_type, payment_status ,transaction_id) VALUES ('$purchaseDate', '$clientName', '$clientContact', '$subTotalValue', '$vatValue', '$totalAmountValue', '$discount', '$grandTotalValue', '$paid', '$dueValue' , '0', '0','0')";
	
	
	$order_id;
	$orderStatus = false;
	if(mysqli_query($dbc,$sql)) {
		$_SESSION['order_id']= $order_id = mysqli_insert_id($dbc);
		$valid['order_id'] = $order_id;	

		$orderStatus = true;

		if ($dueValue>0) {
			$debit =$dueValue;
		  	$balance = $fetchTransaction['balance']+$debit;
		  	
		  	$q=mysqli_query($dbc,"INSERT INTO transactions(debit,credit,balance,customer_id,transaction_remarks) VALUES('$debit','0','$balance','$clientName','$transaction_remarks')");
		  	$transaction_last_id = mysqli_insert_id($dbc);
		  	 mysqli_query($dbc,"UPDATE purchase SET transaction_id='$transaction_last_id' WHERE purchase_id='$order_id'");
		  	# code...
		  
		  }
		if ($dueValue<0) {
				$credit =$dueValue;
		  	$balance = $fetchTransaction['balance']-$credit;
		  	$q=mysqli_query($dbc,"INSERT INTO transactions(debit,credit,balance,customer_id,transaction_remarks) VALUES('0','$credit','$balance','$clientName','$transaction_remarks')");
		  	$transaction_last_id = mysqli_insert_id($dbc);
		  	 mysqli_query($dbc,"UPDATE purchase SET transaction_id='$transaction_last_id' WHERE purchase_id='$order_id'");
		  	# code...
		  	
		  }
		 
		
	}else{
		echo mysqli_error($dbc);
	}

		
	// echo $_POST['productName'];
	$orderItemStatus = false;

	for($x = 0; $x < count($_POST['productName']); $x++) {			
		$updateProductQuantitySql = "SELECT product.quantity FROM product WHERE product.product_id = ".$_POST['productName'][$x]."";
		$updateProductQuantityData = $connect->query($updateProductQuantitySql);
		
		
		while ($updateProductQuantityResult = $updateProductQuantityData->fetch_row()) {
			$updateQuantity[$x] = $updateProductQuantityResult[0] + $_POST['quantity'][$x];				
			$p_id = $_POST['productName'][$x];

			$fetchProductData = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM product WHERE product_id='$p_id'"));
			$rate_1 = $fetchProductData['purchase'];
			$rate_2 = $_POST['rate'][$x];
			$avg_rate = ($rate_1+$rate_2)/2;
				// update product table
				$updateProductTable = "UPDATE product SET purchase='$avg_rate', quantity = '".$updateQuantity[$x]."' WHERE product_id = ".$_POST['productName'][$x]."";
				$connect->query($updateProductTable);

				// add into order_item
				$orderItemSql = "INSERT INTO purchase_item (purchase_id, product_id, quantity, rate, total, purchase_item_status) 
				VALUES ('$_SESSION[order_id]', '".$_POST['productName'][$x]."', '".$_POST['quantity'][$x]."', '".$_POST['rate'][$x]."', '".$_POST['totalValue'][$x]."', 1)";

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
	echo "<script>alert('Purchase Added');</script>";
	echo header('location:../purchase.php?purchase_id='.$_SESSION['order_id'].'');
 
} // /if $_POST
// echo json_encode($valid);