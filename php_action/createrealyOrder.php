 <?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array(), 'order_id' => '');
// print_r($valid);
if($_POST) {	

							

				$purchaseDate  = date('Y-m-d', strtotime($_POST['purchaseDate']));
			$clientName = $_REQUEST['clientName'];
			$segment = $_REQUEST['segment'];
			$marketier = $_REQUEST['marketier'];
			$periodcontract = $_REQUEST['periodcontract'];
			$days = $_REQUEST['days'];
			$month = $_REQUEST['month'];
			$r_order_numberclip = $_REQUEST['r_order_numberclip'];
			$r_order_duration	 = $_REQUEST['r_order_duration'];

					$startdate = $_REQUEST['startdate'];
		$enddate = $_REQUEST['enddate'];
		$stoporderno = $_REQUEST['stoporderno'];
		$daysonair = $_REQUEST['daysonair'];
		$note = $_REQUEST['note'];
		$acount_branch = $_REQUEST['acount_branch'];
		$CoOrdinator = $_REQUEST['Co-Ordinator'];
  
  
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
	 
		





 
 


	$sql = "INSERT INTO relayorder ( r_order_date, r_order_client, r_order_segment, r_order_marketier, r_order_period, r_order_days, r_order_month, r_order_numberclip, r_order_duration, r_order_startdate, r_order_enddate, r_order_stoporder, r_order_onair, r_order_note, account_branch, r_order_cooffice,grand_total,paid,due) VALUES ( '$purchaseDate', '$clientName', '$segment', '$marketier', '$periodcontract', '$days', '$month', '$r_order_numberclip', '$r_order_duration', '$startdate', '$enddate', '$stoporderno', '$daysonair', '$note', '$acount_branch', '$CoOrdinator','$grandTotalValue','$paid','$dueValue');";
	
	
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
		  	$q=mysqli_query($dbc,"INSERT INTO transactions(debit,credit,balance,customer_id,transaction_remarks) VALUES('0','$credit','$balance','$clientName','$transaction_remarks')");
		  	$transaction_last_id = mysqli_insert_id($dbc);
		  	 mysqli_query($dbc,"UPDATE relayorder SET transaction_id='$transaction_last_id' WHERE relayorder_id='$order_id'");
		  }
		if ($dueValue<0) {
		  	# code...
		  	$debit =$dueValue;
		  	$balance = $fetchTransaction['balance']+$debit;
		  	
		  	$q=mysqli_query($dbc,"INSERT INTO transactions(debit,credit,balance,customer_id,transaction_remarks) VALUES('$debit','0','$balance','$clientName','$transaction_remarks')");
		  	$transaction_last_id = mysqli_insert_id($dbc);
		  	 mysqli_query($dbc,"UPDATE relayorder SET transaction_id='$transaction_last_id' WHERE relayorder_id='$order_id'");
		  }
		 
			$budget_name= "Sale of Order #".$order_id;
			$budget_amount=$paid;
			$budget_type='income';
			$budget_date=$purchaseDate;

		mysqli_query($dbc,"INSERT INTO budget(budget_name,budget_amount,budget_type,budget_date) VALUES('$budget_name','$budget_amount','$budget_type','$budget_date')");
	}//true

		
	// echo $_POST['productName'];
	$orderItemStatus = false;

	for($x = 0; $x < count($_POST['productName']); $x++) {			
		
		
		
		
			

				// add into order_item
				$orderItemSql = "INSERT INTO relayorder_item (relayorder,channel_id, airing, duration, rate, total) 
				VALUES ('$order_id', '".$_POST['productName'][$x]."', '".$_POST['onairing'][$x]."', '".$_POST['duration'][$x]."', '".$_POST['rate'][$x]."', '".$_POST['total'][$x]."' )";
				if(mysqli_query($dbc,$orderItemSql)){
					//echo "success";
				}else{
					echo mysqli_error($dbc);
				}
				// $connect->query($orderItemSql);		

				if($x == count($_POST['productName'])) {
					$orderItemStatus = true;
				}		
		
	} // /for quantity

	$valid['success'] = true;
	$valid['messages'] = "Successfully Added";		
	
	$connect->close();

	echo json_encode($valid);
	 header('location:../relayorder.php?relayorder_id='.$order_id.'');
 
} // /if $_POST
// echo json_encode($valid);