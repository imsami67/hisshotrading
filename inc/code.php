<!--shrz   Update Quotation  -->
<?php include_once 'inc/functions.php'; 

if(isset($_REQUEST['edit_quotation_id'])){
		$fetchQuationData=fetchRecord($dbc, "invoice","invoice_id",$_REQUEST['edit_quotation_id']);
	 $fetchCustomerData=fetchRecord($dbc, "customers", "customer_id", @$fetchQuationData['invoice_customer']);
	 $country_regulation=fetchRecord($dbc, "country_regulation", "country_regulation_id", @$fetchQuationData['invoice_country_port']);
	$invoice_country=$fetchQuationData['invoice_country'];
	$invoice_country_port=$fetchQuationData['invoice_country_port'];
	$invoice_inspection_fee=$fetchQuationData['invoice_fee'];
	$invoice_inspection=$fetchQuationData['invoice_inspection'];
	$invoice_freight=$fetchQuationData['invoice_fright'];
	$invoice_vehicle=$fetchQuationData['invoice_vehicle'];
	$invoice_currency=$fetchQuationData['invoice_currency'];
	$invoice_fob=$fetchQuationData['invoice_fci'];
	$invoice_cnf=$fetchQuationData['invoice_cui'];
	$invoice_exchange_rate=$fetchQuationData['exchange_rate'];
	$reservation_inv_customer=$fetchQuationData['invoice_customer'];

}elseif (isset($_REQUEST['reserve'])) {
	$fetchReservation=fetchRecord($dbc,"reservation","reservation_id",$_REQUEST['reserve']);
	$invoice_country=$fetchReservation['reservation_country'];
	$country_regulation=fetchRecord($dbc,"country_regulation","country_regulation_id",@$fetchReservation['reservation_port']);
	$invoice_country_port=$fetchReservation['reservation_port'];
	$invoice_inspection_fee=$fetchReservation['reservation_inspection_fee'];
	$invoice_inspection=$fetchReservation['reservation_inspection'];
	$invoice_freight=$fetchReservation['reservation_freight'];
	$invoice_vehicle=$fetchReservation['vehicle_id'];
	$invoice_currency=$fetchReservation['reservation_currency'];
	$REscurrency=fetchRecord($dbc,"currency","currency_id",$invoice_currency);
	$reservation_inv_customer=$fetchReservation['reservation_customer'];
	$invoice_exchange_rate=$REscurrency['currency_rate'];
	$invoice_fob=@(strtoupper($fetchReservation['reservation_sale_type'])=="FOB")?"1":"";
	$invoice_cnf=@(strtoupper($fetchReservation['reservation_sale_type'])=="CIF")?"1":"";

}

if(!empty($_REQUEST['edit_customer_bank'])){
	$fetchBankData=fetchRecord($dbc, "customer_banks","customer_bank_id",$_REQUEST['edit_customer_bank']);
}
function get_last_record($dbc){
$q =mysqli_fetch_assoc(mysqli_query($dbc,"SELECT ceo_id from ceo_msg ORDER BY ceo_id DESC LIMIT 1"));
return $q['ceo_id'];			    	
}

?>
		 <!--comapany profile add-->
		 <?php
		 	if (isset($_REQUEST['company_submit'])) {
		 			if ($_FILES['logo']['tmp_name']) {
		 			# code...
		 			upload_pic($_FILES['logo'],'img/uploads/');
		 			$data=[
		 				'logo'=>$_SESSION['pic_name'],
		 			'name'=>$_POST['name'],
		 			'address'=>$_POST['address'],
		 			'company_phone'=>$_POST['company_phone'],
		 			'personal_phone'=> $_POST['personal_phone'],
		 			'email' => $_POST['email'],
		 			'tax' => $_POST['tax']
			 		];
		 		}else{
		 			$data=[
		 			'name'=>$_POST['name'],
		 			'address'=>$_POST['address'],
		 			'company_phone'=>$_POST['company_phone'],
		 			'personal_phone'=> $_POST['personal_phone'],
		 			'email' => $_POST['email'],
		 			'tax' => $_POST['tax']
			 		];
		 		}

		 	 if (insert_data($dbc,'company', $data)) {
				# code...
				echo "<script>alert('company Added....!')</script>";
				//$msg = "<script>alert('Company Added')</script>";
					$sts = 'success';
					redirect("company.php",2000);
				}else{
					$msg = mysqli_error($dbc);
					$sts ="danger";
				}
		 		
		 	}
		 	/*get company data*/
		 	if (!empty($_REQUEST['company_edit'])) {
		 		# code...
		 		
		 		$company_edit = $_REQUEST['company_edit'];
		 		$fetchCompany = fetchRecord($dbc,"company",'id',$company_edit);
		 		$company_button='<input type="submit" value="Edit" name="company_update" class="btn btn-primary " style="width: 80%; border-radius: 10px;">';

		 	}else{
		 		$company_button = '<input type="submit" name="company_submit" class="btn btn-success " style="width: 80%; border-radius: 10px;">';
		 	}

		 /*edit company profile*/
		 	if (isset($_POST['company_update'])) {
		 		$company_id=  $_REQUEST['company_edit'];
		 		if ($_FILES['logo']['tmp_name']) {
		 			# code...
		 			upload_pic($_FILES['logo'],'img/uploads/');
		 			$data=[
		 				'logo'=>$_SESSION['pic_name'],
		 			'name'=>$_POST['name'],
		 			'address'=>$_POST['address'],
		 			'company_phone'=>$_POST['company_phone'],
		 			'personal_phone'=> $_POST['personal_phone'],
		 			'email' => $_POST['email'],
		 			'tax' => $_POST['tax']
			 		];
		 		}else{
		 			$data=[
		 			'name'=>$_POST['name'],
		 			'address'=>$_POST['address'],
		 			'company_phone'=>$_POST['company_phone'],
		 			'personal_phone'=> $_POST['personal_phone'],
		 			'email' => $_POST['email'],
		 			'tax' => $_POST['tax']
			 		];
		 		}
		 		
		 			

		 	 if (update_data($dbc,'company', $data , 'id',$company_id)) {
				# code...
				//echo "<script>alert('company Updated....!')</script>";
				echo $msg = "<script>alert('Company Updated')</script>";
					$sts = 'success';
					redirect("company.php",2000);
				}else{
					$msg = mysqli_error($dbc);
					$sts ="danger";
				}	
			}
		   ?>

	
		 <!--comapany profile end-->


<!-- customer add -->
<?php
 	//add customers
 if (isset($_REQUEST['add_customer'])) {
		$data = [
			'customer_name' => $_REQUEST['name'], 
			'customer_email' => $_REQUEST['email'], 
			'customer_phone' => $_REQUEST['phone'], 
			'customer_address' => $_REQUEST['address'], 
			'customer_active' => $_REQUEST['status'], 
			'customer_role' => $_REQUEST['type'], 
		];
		if(insert_data($dbc, "customers", $data)){
			$msg = "Customer Add Successfully";
			$sts = "success";
			//redirectURL(2000);
			redirect("customers.php",1200);
			}else{
				$msg = mysqli_error($dbc);
				$sts = "danger";
			}
		}
?>
		<?php
 	//add customers
 if (isset($_REQUEST['add_marketier'])) {
 		$customer_name = $_REQUEST['name'];
		$customer_email=$_REQUEST['email'];
		$customer_phone=$_REQUEST['phone'];
		$customer_address=$_REQUEST['address'];
		$status = $_REQUEST['status'];
		
		if(mysqli_query($dbc,"INSERT INTO customers(customer_name,customer_email,customer_phone,customer_address,customer_active,customer_role)VALUES('$customer_name','$customer_email','$customer_phone','$customer_address','$status','marketier')")){
			$msg = "Customer Add Successfully";
			$sts = "success";
			//redirectURL(2000);
			redirect("marketier.php",1200);
			}else{
				$msg = mysqli_error($dbc);
				$sts = "danger";
			}
		}

	/*create voucher*/
	if (isset($_REQUEST['add_voucher'])) {
		
		 $fetchTransaction = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM transactions WHERE customer_id='$_REQUEST[customer_id]' ORDER BY transaction_id DESC LIMIT 1"));
			if ($_REQUEST['debit']>0) {
				# code...
				$debit=$_REQUEST['debit'];
				$balance=$fetchTransaction['balance']-$debit;
				$credit=0;
			}
			if ($_REQUEST['credit']>0) {
				# code...
				$debit=0;
				$credit=$_REQUEST['credit'];
				$balance=$fetchTransaction['balance']+$credit;
				
				
			}

		$data_transaction=[
			'debit'=>$debit,
			'credit'=>$credit,
			'transaction_remarks'=>$_REQUEST['nuration'],
			'customer_id'=>$_REQUEST['customer_id'],
			'balance'=>$balance,

		];
	if(insert_data($dbc,"transactions",$data_transaction)){
		$transaction_id = mysqli_insert_id($dbc);
		$data_voucher=[
		'voucher_date'=>$_REQUEST['voucher_date'],
		'customer_id'=>$_REQUEST['customer_id'],
		'nuration'=>$_REQUEST['nuration'],
		'transaction_id'=>$transaction_id,
		];
		if(insert_data($dbc,"vouchers",$data_voucher)){
			$msg = "Voucher Added Successfully";
			$sts ="success";
			$last_voucher_id = mysqli_insert_id($dbc);
			redirect("createvoucher.php?print_voucher=".$last_voucher_id.'',1200);
		}else{
			$msg =mysqli_error($dbc);
			$sts = "danger";
		}
		
	}
		
	}//isset


	/*Add Budget Category*/
	if (isset($_REQUEST['add_budget_category'])) {
		# code...
	
		$data_budget_category=[
			'budget_category_name'=>$_REQUEST['budget_category_name'],
			'budget_category_type'=>$_REQUEST['budget_category_type'],
			

		];
		if(insert_data($dbc,"budget_category",$data_budget_category)){
			$msg = "Budget Category Added Successfully";
			$sts ="success";
			redirect("chartsofaccount.php",1200);
		}else{
			$msg =mysqli_error($dbc);
			$sts = "danger";
		}
		
	}

	/*Delete budget_category_del_id */
	if (!empty($_REQUEST['budget_category_del_id'])) {
		# code...
		deleteFromTable($dbc,"budget_category",base64_encode($_REQUEST['budget_category_del_id']),"budget_category_id");
		redirect('chartsofaccount.php',2000);
	}
	/*Fetch budget_category_edit_id */
	if (!empty($_REQUEST['budget_category_edit_id'])) {
		# code...
		$fetchBudgetCategory = fetchRecord($dbc,"budget_category",'budget_category_id',$_REQUEST['budget_category_edit_id']);
		$budget_category_button=' <button type="submit" id="budget_category" name="edit_budget_category" data-loading-text="Loading..." class="btn btn-info pull pull-right"><i class="glyphicon glyphicon-edit"></i> Edit </button>';
	}else{
		$budget_category_button=' <button type="submit" id="budget_category" name="add_budget_category" data-loading-text="Loading..." class="btn btn-info pull pull-right"><i class="glyphicon glyphicon-ok-sign"></i> Save </button>';
	}
	/*Edit budget Category*/
	if (isset($_REQUEST['edit_budget_category'])) {
		# code...
	
		$data_budget_category=[
			'budget_category_name'=>$_REQUEST['budget_category_name'],
			'budget_category_type'=>$_REQUEST['budget_category_type'],
			

		];
		if(update_data($dbc,"budget_category",$data_budget_category,'budget_category_id',$_REQUEST['budget_category_edit_id'])){
			$msg = "Budget Category Updated Successfully";
			$sts ="success";
			redirect("chartsofaccount.php",1200);
		}else{
			$msg =mysqli_error($dbc);
			$sts = "danger";
		}
		
	}

	/*Enter Expenses*/
	if (isset($_REQUEST['add_expenses'])) {
		# code...
	
		$data_budget=[
			'budget_name'=>$_REQUEST['expense_category'],
			'budget_amount'=>$_REQUEST['expense_amount'],
			'budget_type'=> 'expense',
			'budget_date'=>$_REQUEST['expense_date'],
			

		];
		if(insert_data($dbc,"budget",$data_budget)){
			$msg = "Expenses Added Successfully";
			$sts ="success";
			redirect("expenses.php",2000);
		}else{
			$msg =mysqli_error($dbc);
			$sts = "danger";
		}
		
	}



/*Add Channel*/
	if (isset($_REQUEST['channel_add'])) {
		# code...
	
		$data_channel=[
			'channel_name'=>$_REQUEST['channel_name'],
			'airing'=>$_REQUEST['onairing_detail'],
			'duration'=>$_REQUEST['duration'],
			'channel_time'=>$_REQUEST['time'],
			'rate'=>$_REQUEST['rate'],
			'status'=>1,
			

		];
		if(insert_data($dbc,"channels",$data_channel)){
			$msg = "Channel Added Successfully";
			$sts ="success";
			redirect("channels.php",1200);
		}else{
			$msg =mysqli_error($dbc);
			$sts = "danger";
		}
		
	}

	/*Delete budget_category_del_id */
	if (!empty($_REQUEST['channel_del_id'])) {
		# code...
		mysqli_query($dbc,"UPDATE channels SET status = '0' WHERE channel_id = '$_REQUEST[channel_del_id]'");
		redirect('channels.php',2000);
	}
	/*Fetch budget_category_edit_id */
	if (!empty($_REQUEST['channel_edit_id'])) {
		# code...
		$fetchchannel = fetchRecord($dbc,"channels",'channel_id',$_REQUEST['channel_edit_id']);
		$channel_button=' <button type="submit" id="budget_category" name="channel_edit" data-loading-text="Loading..." class="btn btn-info pull pull-right"> <i class="material-icons">edit</i> Edit </button>';
	}else{
		$channel_button=' <button type="submit" id="budget_category" name="channel_add" data-loading-text="Loading..." class="btn btn-info pull pull-right"> <i class="material-icons">done</i> Save </button>';
	}
	/*Edit budget Category*/
	if (isset($_REQUEST['channel_edit'])) {
		# code...
		$channel_id = $_REQUEST['channel_edit_id'];
		$data_channels_update=[

			'channel_name'=>$_REQUEST['channel_name'],
			'airing'=>$_REQUEST['onairing_detail'],
			'duration'=>$_REQUEST['duration'],
			'channel_time'=>$_REQUEST['time'],
			'rate'=>$_REQUEST['rate'],
			'status'=>1,
			

		];
		if(update_data($dbc,"channels",$data_channels_update,'channel_id',$channel_id)){
			$msg = "Channel Updated Successfully";
			$sts ="success";
			redirect("channels.php",1200);
		}else{
			$msg =mysqli_error($dbc);

			$sts = "danger"	;
				}
		
	}
	/*Add Channel*/
	if (isset($_REQUEST['users_add'])) {
		# code...
	
		$data_user=[
			'username' => $_REQUEST['username'],
			'email' => $_REQUEST['email'],
			'phone' => $_REQUEST['phone'],
			'password' => md5($_REQUEST['password']),
			'user_role' => $_REQUEST['user_role'],
			'address' => $_REQUEST['address'],
			'status' => $_REQUEST['status'],
			

		];
		if(insert_data($dbc,"users",$data_user)){
			$msg = "User Added Successfully";
			$sts ="success";
			redirect("users.php",1200);
		}else{
			$msg =mysqli_error($dbc);
			$sts = "danger";
		}
		
	}

	/*Delete budget_category_del_id */
	if (!empty($_REQUEST['user_del_id'])) {
		# code...
		mysqli_query($dbc,"UPDATE users SET status = '0' WHERE user_id = '$_REQUEST[user_del_id]'");
		redirect('users.php',2000);
	}
	/*Fetch budget_category_edit_id */
	if (!empty($_REQUEST['user_edit_id'])) {
		# code...
		$fetchusers = fetchRecord($dbc,"users",'user_id',$_REQUEST['user_edit_id']);
		$users_button=' <button type="submit" id="budget_category" name="user_edit" data-loading-text="Loading..." class="btn btn-info pull pull-right"> <i class="material-icons">edit</i> Edit </button>';
	}else{
		$users_button=' <button type="submit" id="budget_category" name="users_add" data-loading-text="Loading..." class="btn btn-info pull pull-right"> <i class="material-icons">done</i> Save </button>';
	}
	/*Edit budget Category*/
	if (isset($_REQUEST['user_edit'])) {
		# code...
		$user_id = $_REQUEST['user_edit_id'];
		$data_user_update=[

			'username' => $_REQUEST['username'],
			'email' => $_REQUEST['email'],
			'phone' => $_REQUEST['phone'],
			'password' => md5($_REQUEST['password']),
			'user_role' => $_REQUEST['user_role'],
			'address' => $_REQUEST['address'],
			'status' => $_REQUEST['status'],
			

		];
		if(update_data($dbc,"users",$data_user_update,'user_id',$user_id)){
			$msg = "Users Updated Successfully";
			$sts ="success";
			redirect("users.php",1200);
		}else{
			$msg =mysqli_error($dbc);

			$sts = "danger"	;
				}
		
	}

?>

<?php
 	//add customers
 if (isset($_REQUEST['add_customer'])) {
 		$customer_name = $_REQUEST['name'];
		$customer_email=$_REQUEST['email'];
		$customer_phone=$_REQUEST['phone'];
		$customer_address=$_REQUEST['address'];
		$status = '1';
		$bank_name    = $_REQUEST['bank_name'];
		$bank_account    = $_REQUEST['bank_account'];
		$nrc    = $_REQUEST['nrc'];
		$cui    = $_REQUEST['cui'];
		$shelf_life = $_REQUEST['shelf_life'];
		$supplier_code = $_REQUEST['supplier_code']; 
		if(mysqli_query($dbc,"INSERT INTO customers(customer_name,customer_email,customer_phone,customer_address,customer_active,customer_role,bank_name,bank_account,nrc,cui,shelf_life,supplier_code)VALUES('$customer_name','$customer_email','$customer_phone','$customer_address','$status','customer','$bank_name','$bank_account','$nrc','$cui','$shelf_life','$supplier_code')")){
			$msg = "Customer Add Successfully";
			$sts = "success";
			//redirectURL(2000);
			redirect("customers.php",1200);
			}else{
				$msg = mysqli_error($dbc);
				$sts = "danger";
			}
		}

		if (!empty($_REQUEST['customer_del_id'])) {
		# code...
		mysqli_query($dbc,"UPDATE customers SET customer_Active = '0' WHERE customer_id = '$_REQUEST[customer_del_id]'");
		redirect('customers.php',2000);
	}
	/*Fetch budget_category_edit_id */
	if (!empty($_REQUEST['customer_edit_id'])) {
		# code...
		$fetchCustomer = fetchRecord($dbc,"customers",'customer_id',$_REQUEST['customer_edit_id']);
		$customer_button=' <button type="submit" id="budget_category" name="edit_customer" data-loading-text="Loading..." class="btn btn-info pull pull-right"> <i class="material-icons">edit</i> Edit </button>';
	}else{
		$customer_button=' <button type="submit" id="budget_category" name="add_customer" data-loading-text="Loading..." class="btn btn-info pull pull-right"> <i class="material-icons">done</i> Save </button>';
	}
	//Edit budget Category/
	if (isset($_REQUEST['edit_customer'])) {
		# code...
		$customer_id = $_REQUEST['customer_edit_id'];
		$data_customer_update=[

			'customer_name'	=> $_REQUEST['name'],		
			'customer_email'	   => $_REQUEST['email'],	
			'customer_phone'	  => $_REQUEST['phone'],				
			'bank_name'		  => $_REQUEST['bank_name'],			
			'bank_account'	  => $_REQUEST['bank_account'],				
			'nrc'			  => $_REQUEST['nrc'],	
			'cui'				  => $_REQUEST['cui'],	
			'customer_address'  => $_REQUEST['address'],					
			'customer_role'  =>  'customer',	
			'shelf_life'  =>  $_REQUEST['shelf_life'],	
			'customer_active'  => '1',	
			'supplier_code' => $_REQUEST['supplier_code'],


		];
		if(update_data($dbc,"customers",$data_customer_update,'customer_id',$customer_id)){
			$msg = "Customer Updated Successfully";
			$sts ="success";
			redirect("customers.php",1200);
		}else{
			$msg =mysqli_error($dbc);

			$sts = "danger"	;
				}
		
	}

if( isset($_POST['DownloadZip']) )  {
 
 $filename = $_POST['docs'];
 $source = $_POST['docs'];
 $type = $_POST['docs']; 
 
 echo sizeof($filename) ;
 
 //check file is selected for upload
 if(isset($filename) != ""){
 
      //First check whether zip extension is enabled or not
  if(extension_loaded('zip')) {
  
   //create the directory named as "images"
   $folderLocation = "images" ; 
   if (!file_exists($folderLocation)) {
    mkdir($folderLocation, 0777, true);
   }  
         
   $zip_name = time().".zip"; // Zip file name 
   $zip = new ZipArchive;
   if ($zip->open($zip_name, ZipArchive::CREATE) == TRUE){          
   
    foreach($filename as $key=>$tmp_name){
     $temp = $filename[$key];
     $actualfile = $filename[$key];
     // moving image files to temporary locati0n that is "images/"
     move_uploaded_file($temp, $folderLocation."/".$actualfile);
     // adding image file to zip
     $zip->addFile($folderLocation."/".$actualfile, $actualfile );
   
    } 
   // All files are added, so close the zip file.
   $zip->close();
    }
       
  }
  // push to download the zip
  header();
  header('Content-type: application/zip');
  header('Content-Disposition: attachment; filename="skptricks.zip"');
  readfile($zip_name);
  // remove zip file is exists in temp path
  unlink($zip_name);
  //remove image directory once zip file created
  removedir($folderLocation); 
 }
 
} 
 // user defined function to remove directory with their content
function removedir($dir) {
  if (is_dir($dir)) {
    $objects = scandir($dir);
    foreach ($objects as $object) {
      if ($object != "." && $object != "..") {
        if (filetype($dir."/".$object) == "dir") 
           rrmdir($dir."/".$object); 
        else unlink   ($dir."/".$object);
      }
    }
    reset($objects);
    rmdir($dir);
  }
 } 
 
?>


