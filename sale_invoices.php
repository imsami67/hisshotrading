

  



   



<body>

<?php 

//mac work

// Turn on output buffering  

ob_start();  



//Get the ipconfig details using system commond  

system('ipconfig /all');  



// Capture the output into a variable  

$mycomsys=ob_get_contents();     



// Clean (erase) the output buffer  

ob_clean();  



$find_mac = "Physical"; 

//find the "Physical" & Find the position of Physical text  



$pmac = strpos($mycomsys, $find_mac);  

// Get Physical Address  



$macaddress=substr($mycomsys,($pmac+36),17);

//echo $macaddress;  

//Display Mac Address  

//if ($macaddress=='C0-18-85-3C-84-EC') {



//mac work end


 $date_now = new DateTime();

 $date2    = new DateTime("01/01/2022");



if ($date_now < $date2) {

	require_once 'php_action/db_connect.php'; 

	require_once 'includes/header.php'; 

	require_once 'inc/code.php'; 
	

?>

<style>



   		</style>

<!-- start page content -->

            <div class="page-content-wrapper">

                <div class="page-content">

	<div id="app"  style="position: fixed;top: 50px;left: 0px;z-index: 10000;">

		<div>

			 <center>

		       	<video  id="preview" style="width: 180px;height: 180px;border-radius: 10px"></video>

		       	<div id="scan_img" style="display: none;margin-top: -20px;width: 100px;height: 100px;margin:auto;float: left;">

			 		<img src="img/scanning.gif" class="img img-responsive center-block" alt="" align="bottom" width="180px" height="180px">

			 	</div>

		       </center>

		</div><!-- col -->

	</div><!-- app -->

<div class="panel">



<div class="panel-heading panel-heading-green">

  		<i class="fa fa-plus"></i>	Sale Invoice

  		<a href='orderslist.php?o=manord' style="color: white !important; " ><button class='btn btn-primary pull pull-right' style="margin-top: -4.7px;">

  		<span class="fa fa-list"></span> &nbsp List of Orders</button></a>

	</div> <!--/panel-->

	<div class="panel-body">

		<!-- <div class="msg"></div> /success-messages -->

  		<form method="POST" action="php_action/custom_action.php" id="formData14">

			<div class="detailMsg"></div>

  			<div class="msg"></div>

			<div class="row">

				<div class="col-sm-3">

				  <div class="form-group row">

				    <label for="invoiceNumber" class="control-label">Invoice #</label>

				  
				    	<?php 

				    	if (empty($fetchQuationData['invoice_id'])) {

				    	@$q = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT invoice_id from invoice ORDER BY invoice_id DESC LIMIT 1"));

				    	$abc = (int)$q['invoice_id']+1;

				    	?>

				      <input type="text" class="form-control" readonly="" id="invoiceNumber" value="INV-JP<?=date('y')?>-<?=$abc?>"/>

				      <input type="hidden" name="invoice_id" value="<?=$abc?>">

			 <?php  }else{ $invoice_id=$fetchQuationData['invoice_id'];

			 

			 $getCredit=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM transactions WHERE bank_id IS NOT NULL AND invoice_id='$invoice_id'"));



			  $getDebit=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM transactions WHERE customer_id != '$getCredit[customer_id]' AND invoice_id='$invoice_id' "));

				   ?><input type="hidden" name="transaction_debit" value="<?=@$getDebit['transaction_id']?>">

				   <input type="hidden" name="transaction_credit" value="<?=@$getCredit['transaction_id']?>">

				      	<input type="texh" class="form-control" readonly="" id="invoiceNumber" value="<?=@$fetchQuationData['invoice_id']?>"/>

				      	<input type="hidden" name="invoice_id" value="<?=$fetchQuationData['invoice_id']?>">



				      <?php  } ?>

				    

				

				  </div> <!--/form-group-->

					

				</div><!-- col -->
				<div class="col-sm-3">

				  <div class="form-group row">

				    <label for="orderDate" class="control-label">Invoice</label>

				  

				     <select class="form-control" name="invoice_type" id="invoice_type" required>
				     	<option <?=(@$fetchQuationData['invoice_type']=="general_invoice")?"selected":""?> value="general_invoice">General Invoice</option>
				     	<option <?=(@$fetchQuationData['invoice_type']=="credit_invoice")?"selected":""?> value="credit_invoice">Credit Invoice</option>
				     </select>

				  

				  </div> <!--/form-group-->

				</div><!-- col -->
				<div class="col-sm-3">

				  <div class="form-group row">

				    <label for="orderDate" class=" control-label">Date</label>

				  

				      <input type="date" readonly class="form-control dateField" id="orderDate" name="invoice_date" value="<?php echo date("Y-m-d")?>"/>

				   

				  </div> <!--/form-group-->

				</div><!-- col -->

				<div class="col-sm-3">

				  <div class="form-group row">

				    <label for="orderDate" class="control-label">Due Date</label>


				    	<?php 

				    	if (empty($fetchQuationData['invoice_id'])) {

				    		$today = date("Y-m-d");

				    		$date = strtotime("+5 day", strtotime($today));

							$newDate = date("Y-m-d", $date);

				    	?>

				      <input type="date"  onchange="checkduedate()" class="form-control dateField" id="orderDate" name="invoice_due_date" value="<?=$newDate?>"/>

				  <?php } else{  ?>

				  	    <input type="date" class="form-control dateField" id="orderDate" name="invoice_due_date" value="<?=$fetchQuationData['invoice_due_date']?>"/> <?php }  ?>

				   

				  </div> <!--/form-group-->

				</div><!-- main -col -->

			</div><!-- main row -->

			<div class="row mb-3">


				<div class="col-sm-3">

			

				    <label for="clientName" class=" control-label">Select Account</label>

			

				    		<select   data-type="invoice"  class="form-control select2" id="clientName" name="invoice_customer" required>

						

							<option value="">~~SELECT~~</option>

							<?php 

					$sql = "SELECT * FROM customers WHERE customer_active = 1 AND customer_role = 'customer'";

						$result = $connect->query($sql);

						while($row = $result->fetch_array()) {?>



						<option <?=(isset($_REQUEST['reserve']) OR isset($_REQUEST['edit_quotation_id']) )?($reservation_inv_customer==$row[0])?"selected":"disabled":""?>   value='<?=$row[0]?>'><?=$row[1]?> (<?=$row['customer_phone']?>-<?=$row['customer_country']?>)</option>

										 

								<?php	} // while

							?>

						</select>

				

				</div><!-- mian col -->

				<div class="col-sm-3">

					 <label for="clientName" class="control-label">Select Consignee</label>

						<select class="form-control" id="consignee_id" name="consignee_id" required>

							<option value="">~~SELECT~~</option>

							<?php 



							if (!empty($fetchQuationData['consignee_id'])) {

								$consigneeQ=getWhere($dbc, "consignee", "customer_id", $fetchQuationData['invoice_customer']);

								while ($consignee=mysqli_fetch_assoc($consigneeQ)) {

									# code... ?>

							<option <?=($fetchQuationData['consignee_id']==$consignee['consignee_id'])?"selected":""?> value="<?=$consignee['consignee_id']?>"><?=$consignee['consignee_name']?></option><?php }} ?>

						</select>

			

				</div><!-- form group -->

				<div class="col-sm-3">

					 <label for="clientName" class="control-label">Name/Balance</label>

							<div class="input-group">

								<input type="text" class="form-control" value="<?=@$fetchCustomerData['customer_name']?>" id="customeName" readonly="readonly">

								<span class="input-group-addon">Balance: <span class="badge" id="customer_balance">0</span></span>

						

					</div><!-- form group -->

				</div><!-- mian col -->



					<div class="col-sm-3">

					

				    <label for="clientName" class="control-label">Seller</label>

				  

						<select class="form-control" id="user_name" name="invoice_user" required>

							<option value="">~~SELECT~~</option>

							<?php 

							     	$sql = "SELECT * FROM users WHERE status = 1";

										$result = $connect->query($sql);

										while($row = $result->fetch_array()) {

										echo "<option selected value='".$row[0]."'>".$row[1]."</option>";

									} // while

							?>

						</select>

			

				</div><!-- form group -->


			</div><!-- main row -->

			<div class="row">

				<div class="col-sm-3">

				  <div class="form-group ">

				    <label for="country_name" class=" control-label">Select Country</label>

				    

				    	
				    	<select name="country_name" class="country_name form-control" id="country_name">

				    		 <option>Select Country</option>

			                                <?php

						                    	$sql = mysqli_query($dbc,"SELECT * FROM country_regulation GROUP BY country_regulation_country");

						                    	while($countries=mysqli_fetch_assoc($sql)):

						                    ?>

			                                <option <?=(@strtoupper($invoice_country)==strtoupper($countries['country_regulation_country']))?"selected":""?> value="<?=$countries['country_regulation_country']?>"><?=$countries['country_regulation_country']?></option>

			                                <?php

			                              endwhile;

			                                ?>
				    	</select>

				   	

				  </div> <!--/form-group-->

				</div><!-- mian col -->

				<div class="col-sm-3">

					<div class="form-group row">

				    <label for="port_name" class=" control-label">Port Name</label>

				    

						<select class="form-control port_name" id="port_name" name="port_name" value="<?=@$fetchQuationData['invoice_country_port']?>">

							<option value="<?=!empty(@$invoice_country_port)?$country_regulation['country_regulation_id']:" "?>"><?=!empty(@$invoice_country_port)?$country_regulation['country_regulation_destination_port']:"~~SELECT~~"?> </option>




						</select>

				   	

				  </div> <!--/form-group-->

				</div><!-- mian col -->

				
				<div class="col-sm-3">

			  		<div class="form-group">

			  			<div class="row">

			  				<div class="col-sm-12">

						  		<label for="invoice_inspection">Inspection</label>

			  				

			  				

						  		<input type="text" class="form-control" value="<?=@$invoice_inspection?>" name="invoice_inspection" id="invoice_inspection" readonly>

			  				</div>

			  			</div><!-- row -->

			  		</div><!-- form group -->

			  	</div><!-- col -->
			  	<div class="col-sm-3">

					<div class="form-group row">

				    <label for="Fee" class=" control-label">Fee</label>

				  

				    	<input type="text" class="form-control" name="invoice_fee" id="fee" value="<?=@$invoice_inspection_fee?>">

				   	

				  </div> <!--/form-group-->

				</div><!-- col -->

			</div><!-- main row -->



			  <table class="table" id="productTable" style="width: 100%">

				

			  	<thead>

			  		<tr>			  			

			  			<th style="width:30%;">Vehicle / Car</th>

			  			<th style="width:20%;">Cost</th>

			  			<th style="width:20%;">Rate</th>

			  			<th style="width:15%;">Show Rate</th>

			  			<th style="width:15%;">Total</th>			  			

			  		</tr>

			  	</thead>

			  	<tbody>

			  		<?php

			  		$arrayNumber = 0;

			  		for($x = 1; $x < 2; $x++) { ?>

			  			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				

			  				<td style="margin-left:20px;">

			  					<div class="form-group">

			  						<!-- <div id="customOpt"></div> -->

				  				<input list="lst" data-type="invoice" class="form-control livesearch" autocomplete="off" name="invoice_vehicle" id="invoice_vehicle" onchange="getVehicle();" value="<?=@$invoice_vehicle?>">



			  					<datalist id="lst">

			  						<option id="customOpt">~~SELECT~~</option>

		  						</datalist>

						       <input  name="f_Text" id="f_Text" class="form-control" readonly / >

			  				</td>

			  				<td style="padding-left:20px;">	

			  					<div class="form-group">

			  						<input type="number" name="invoice_cost" id="invoice_cost" autocomplete="off" onkeyup="getTotal(<?php echo $x ?>)"  class="form-control" value="<?=@$fetchQuationData['invoice_vehicle_cost']?>" />

			  					</div>

			  				</td>

			  				<td style="padding-left:20px;">	

			  					<div class="form-group">

			  						<input type="number" name="invoice_rate" id="invoice_rate" autocomplete="off" onkeyup="getTotalInvoice();"  class="form-control" value="<?=@$fetchQuationData['invoice_vehicle_rate']?>" />

			  					</div>

			  				</td>





							

			  				<td style="padding-left:20px;">

			  					<div class="form-group">

			  						<input type="number" name="invoice_show_rate" id="invoice_show_rate" autocomplete="off" onkeyup=""  class="form-control" value="<?=@$fetchQuationData['invoice_show_rate']?>" />

			  					</div>

			  				</td>

			  				<td style="padding-left:20px;">			  					

			  					<input type="text" name="total" id="total"  autocomplete="off" class="form-control" readonly />

			  				</td>

			  				<td>



			  					<!-- <button class="btn btn-danger removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow()"><i class="fa fa-trash"></i></button> -->

			  				</td>

			  			</tr>

		  			<?php

		  			$arrayNumber++;

			  		} // /for

	 		  		?>

			  	</tbody>			  	

			  </table>

			  <td>

			  	<button type="text" class="btn btn-primary d-none pull-right" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="fa fa-plus"></i> Add Row </button>



			  </td>

			  <br>



			  	<div class="col-sm-12">

			  		<table class="table" id="servicesTable">

	<tr>

		

		<th>Service Name</th>

		<th>Amount</th>

		<th>Gift it</th>

		<th>Purchesed</th>

		<th>Not Purchesed</th>



	</tr>

	<tbody id="services_fetch">

			  		<?php 

if (!empty($_REQUEST['edit_quotation_id'])) {

			# code...		

	$invoice_id=$_REQUEST['edit_quotation_id'];

 	$Subtotal_price=0;

	$c=0;

if ($services=getWhere($dbc,"services_invoice","invoice_id",$_REQUEST['edit_quotation_id'])) {



if (mysqli_num_rows($services)>0) {



	while ($servicesFetch=mysqli_fetch_assoc($services)) {



		$serDetail=fetchRecord($dbc,"vehicle_services", "vehicle_info_id", $servicesFetch['vehicle_id']);

		@$vehicle=fetchRecord($dbc, "vehicle_info", "vehicle_id", $servicesFetch['vehicle_id']);

		@$maker=fetchRecord($dbc, "maker", "maker_id", $vehicle['vehicle_maker']);

		@$brand=fetchRecord($dbc, "brands", "brand_id", $vehicle['vehicle_brand']);

		$Subtotal_price+=(int)$serDetail["vehicle_services_amount"];  $c++;

		

		if ($servicesFetch["gifted"]==0) {

			$checked="checked";

			$purchaseed="";

			$notpurchaseed="";

		}

		elseif ($servicesFetch["gifted"]==1) {

				$purchaseed="checked";

				

		$checked="";

		$notpurchaseed="";

		}

		elseif ($servicesFetch["gifted"]==2) {

			$notpurchaseed="checked";

			$purchaseed="";

			$checked="";

		}

		else{

		$notpurchaseed="checked";

		$purchaseed="";

		$checked="";

		}

 echo '<tr >

           



             <td>'.$serDetail['vehicle_services_name'].'</td>                        



             <td>'.$serDetail["vehicle_services_amount"].'</td>



             <td ><input '.$checked.'  onclick="gift('.$serDetail["vehicle_services_amount"].','.$servicesFetch['services_invoice_id'].','.$serDetail['vehicle_info_id'].','.$invoice_id.')" class="form-check-input gift service'.$servicesFetch['services_invoice_id'].'" value="'.$serDetail["vehicle_services_id"].'" type="checkbox" name="gifted[]" id="gift_'.$servicesFetch['services_invoice_id'].'" title="'.$servicesFetch['services_invoice_id'].'">



                 <i class="fa fa-gift" style="font-size:30px;"></i>



                  </td> 



              <td><input  '.$purchaseed.'   onclick="purchase('.$serDetail["vehicle_services_amount"].','.$servicesFetch['services_invoice_id'].','.$serDetail['vehicle_info_id'].','.$invoice_id.')"   class="form-check-input purchase ml-2 service'.$servicesFetch['services_invoice_id'].'" value="'.$serDetail["vehicle_services_id"].'" type="checkbox" name="purchased[]" id="pur_'.$servicesFetch['services_invoice_id'].'" title="'.$servicesFetch['services_invoice_id'].'">



                 <i class="fa fa-dollar ml-4" style="font-size:30px;"></i>



                </td> 



                 <td><input  '.$notpurchaseed.' onclick="notpurchase('.$serDetail["vehicle_services_amount"].','.$servicesFetch['services_invoice_id'].','.$serDetail['vehicle_info_id'].','.$invoice_id.')"  class="form-check-input purchase ml-2  service'.$servicesFetch['services_invoice_id'].'" value="'.$serDetail["vehicle_services_id"].'" type="checkbox"  name="not_purchased[]" id="notpur_'.$servicesFetch['services_invoice_id'].'" title="'.$servicesFetch['services_invoice_id'].'">



                 <i class="fa fa-dollar ml-4" style="font-size:30px;"></i>		



                </td> 

                                                             

        </tr>

        ';



	}}}	}

		  		 ?></tbody>

		  		 <input type="hidden" class="set_total" name="" value="<?=$Subtotal_price?>">

		  	

		  	

		  		 </table>

			  	</div>

			  

			  <div class="row">

			  		



			  	<div class="col-sm-4">

			  		<div class="row">

				  		<div class="col-sm-2 mt-2">

					  		<label for="fci">FOB</label><br>

				 

					  		<input type="checkbox" <?=!empty($invoice_fob)?"checked":""?> id="fci" class="mt-1" value="">

					  		

				  		</div>
				  		<div class="col-sm-10">
				  			<label style="visibility: hidden;">FOB</label><br>
				  			<input type="text" name="invoice_fci" id="fci_field" value="<?=@$fetchQuationData['invoice_fci']?>" class="form-control oneInput d-none <?=!empty($invoice_fob)?"d-block":""?>">
				  		</div>

			  		</div>

			  	</div><!-- mian col -->

			  	<div class="col-sm-4">

			  		<div class="row">

				  		<div class="col-sm-12">

					  		<label for="Frieght">Frieght</label>

				  	

					  		<input type="text" id="Frieght" class="form-control" value="<?=@$invoice_freight?>"  name="invoice_fright" id="invoice_fright">

				  		</div>

			  		</div>

			  	</div><!-- mian col -->

			  	<div class="col-sm-4">

			  		<div class="row">

				  		<div class="col-sm-2 mt-2 check">

					  		<label for="cui">CNF</label><br>

				  		

					  		<input type="checkbox" id="cui" class="mt-1" value="" <?=!empty($invoice_cnf)?"checked":""?>>

					  		
				  		</div>
				  		<div class="col-sm-10">
				  			<label style="visibility: hidden;">CNF</label>
				  			<input type="text" name="invoice_cui" value="<?=@$fetchQuationData['invoice_cui']?>" id="cui_field" class="form-control oneInput d-none <?=!empty(@$invoice_cnf)?"d-block":""?>">

				  		</div>

			  		</div>

			  	</div><!-- mian col -->

			  	

			  </div><!-- main row -->

			  <br>

			  <div class="row">

			  

			  	<div class="col-sm-4">

			  	<div class="form-group"><label for="">Previous Balance</label>

			  			

			  				<input type="text" class="form-control" value="" name="invoice_previous_balance" readonly="readonly" id="invoice_previous_balance"></div><!-- formgroip -->

			  </div><!-- col -->

			  	<div class="col-sm-4">

			  		<div class="form-group">

						  		<label for="">Bank</label>

			  				

							<input list="bank_name1" value="<?=@$fetchQuationData['invoice_bank']?>" class="form-control" id="invoice_bank" name="invoice_bank" required autocomplete="off">

							<datalist id="bank_name1">

			  					<?php 

							     	$sql = "SELECT * FROM customers WHERE customer_active = 1 AND customer_role = 'bank'";

										$result = $connect->query($sql);

										while($row = $result->fetch_array()) {

										echo "<option value='".$row[0]."'>".$row[10]." ".$row[1]."</option>";

									} // while

								?>

							</datalist>

			  				</div><!-- form group -->

			  	</div><!-- col -->

			  	<div class="col-sm-4">

			  		<div class="form-group">

						  		<label for="">Total</label>


							<input value="0" readonly class="form-control" id="sub_total_amount" name="sub_total_amount" required >



			  				</div><!-- form group -->

			  	</div><!-- col -->

			  </div><!-- main row -->
<hr>
			 <div class="row">
			 	<div class="col-sm-4">
			 		<div class="form-group">
						<label for="invoice_currency">Currency</label>
			<select required class="form-control" id="invoice_currency" name="invoice_currency">
					
							<?php $q=get($dbc,"currency WHERE currency_status=1 ");
									while($r=mysqli_fetch_assoc($q)): ?>
							<option <?=(@$invoice_currency==$r['currency_id'])?"selected disabled":"disabled"?> value="<?=$r['currency_id']?>"><?=$r['currency_name']?></option>
							<?php endwhile; ?>
						</select>
			  			
			  				
			  				<input type="hidden" name="" value="0" id="total_val">
			  		</div><!-- form group -->
			 	</div>
			 	<div class="col-sm-4">
			 		<div class="form-group">


						  		<label for="invoice_currency">Exchange Rate</label>

			  					<input type="number"  autocomplete="off" onkeyup="invoice_exchange()" id="invoice_exchange_rate" value="<?=@$invoice_exchange_rate?>" name="exchange_rate" class="form-control" placeholder="Exchange Rate">


			  		</div><!-- form group -->
			 	</div>
			 	<div class="col-sm-4">
			 		<div class="form-group">

			  		
						  		<label for="invoice_currency">Amount In Selected Currency</label>
			  					<input type="number"  readonly  id="grand_total_incurrency" name="grand_total_incurrency" class="form-control" >
			  		

			  		</div><!-- form group -->
			 	</div>

			 </div>

<hr>
			<div class="row">			

			  <div class="col-md-4">
			  	
			 		<div class="form-group">
			 			<label for="invoice_currency">Paid Amount in Currency</label>

			  					<input type="number" value="<?=@$fetchQuationData['invoice_paid_amount']?>" autocomplete="off" onkeyup="invoice_paid()" id="paid_amount_incurrency" name="paid_amount_incurrency" class="form-control" placeholder="Paid Amount">
			  				

			  		</div><!-- form group -->
			 	
			  </div> <!--/col-md-4-->

			  <div class="col-md-4">

			  	<div class="form-group">

			  		

			  				<label for="">Discount</label>


			  				<input type="number" max="100" min="0" value="<?=@$fetchQuationData['invoice_discount']?>" class="form-control" onkeyup="getDiscount();" name="invoice_discount" id="invoice_discount">

			  			

			  	</div><!-- formgroip -->

			  </div> <!--/col-md-4-->	

			  <div class="col-md-4">

			  	<div class="form-group">

		

			  				<label for="">Grand Total</label>

			  		

			  				<input type="text" readonly="readonly" value="<?=@$fetchQuationData['invoice_grand_total']?>"  class="form-control" name="invoice_grand_total" id="invoice_grand_total">

			  			

			  	</div><!-- formgroip -->

			  </div> <!--/col-md-4-->

			</div>  <!-- mian row -->
<hr>


			<div class="row">			

			  <div class="col-md-4">

			  	<div class="form-group">
<label for="">Paid Amount</label>
			  		<div class="row">
	

			  			<div class="col-sm-6">

			  				<input type="text" readonly class="form-control" value="<?=@$fetchQuationData['invoice_paid_amount']?>" name="invoice_paid_amount" id="invoice_paid_amount" onkeyup="getPaid();">

			  			</div><!-- col -->

			  			<div class="col-sm-6">

			  				<div class="form-group row">

								<div class="input-group">

									<input type="text" placeholder="Percentage %" value="<?=@$fetchQuationData['invoice_percent']?>" class="form-control" name="invoice_paid_percent" id="invoice_paid_percent" onkeyup="getPayPercent();" min="1" max="100">

									<span class="input-group-addon">%</span>

								</div>

							</div><!-- form group -->

						</div>

			  		</div><!-- row -->

			  	</div><!-- formgroip -->

			  </div> <!--/col-md-4-->

			  <div class="col-md-4">

			  	<div class="form-group">

			  	

			  				<label for="">Due Amount</label>

			  			

			  				<input type="text" class="form-control" value="<?=@$fetchQuationData['invoice_due_amount']?>" name="invoice_due_amount" id="invoice_due_amount" readonly="readonly">


			  	</div><!-- formgroip -->

			  </div> <!--/col-md-4-->	

			  <div class="col-md-4">

			  	<div class="form-group">

			  		

			  				<label for="">Next Due Date</label>

			  		

			  				<input type="date" onchange="checkduedate()" value="<?=@$fetchQuationData['invoice_next_due']?>" class="form-control" name="invoice_next_due" id="invoice_next_due">

			  			

			  	</div><!-- formgroip -->

			  </div> <!--/col-md-4-->

			</div>  <!-- mian row -->

			<div class="row">

				<div class="col-sm-8 offset-4">

					<div class="row">

						<div class="col-sm-3">

					  		<label for="">Invoice Status</label>

						</div>

						<div class="col-sm-9">					

							<select name="invoice_sts" id="invoice_sts" class="form-control" required="required">

								<option value="">~~ SELECT ~~</option>

								<option <?=(@$fetchQuationData['invoice_sts']==1)?"selected":""?> value="1">Completed</option>

								<option <?=(@$fetchQuationData['invoice_sts']==2)?"selected":""?> value="2">Pending</option>

								<option <?=(@$fetchQuationData['invoice_sts']==3)?"selected":""?> value="3">Forfiet</option>

							</select>

						</div>

					</div>

				</div><!-- col -->

			</div><!-- main roe -->





			  <div class="form-group submitButtonFooter">

			    <div class="col-sm-offset-2 col-sm-10">

			    <!-- <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="fa fa-plus"></i> Add Row </button> -->

			    <?php $btn_name=(empty(@$fetchQuationData))?"Save Changes":"Update Changes";



			    $btn_value=(empty(@$fetchQuationData))?"add":"update";  ?>

			    

			    <input type="hidden" name="type_btn" value="<?=$btn_value?>">

			   

 <?php if (empty(@$fetchQuationData) AND @$userPrivileges['nav_add']==1 || @$fetchedUserRole=="admin"): ?>
			      <button type="submit" id="createOrderBtn"   data-loading-text="Loading..." class="btn btn-success"><i class="fa fa-check-circle-o"></i>Save Changes</button>
				<?php endif ?>

				 <?php if (!empty(@$fetchQuationData) AND @$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): ?>
			      <button type="submit" id="createOrderBtn"   data-loading-text="Loading..." class="btn btn-success"><i class="fa fa-check-circle-o"></i>Update Changes</button>
				<?php endif ?>
			      <button type="reset" class="btn btn-default" onclick="resetOrderForm()"><i class="fa fa-eraser"></i> Reset</button>

			    </div>

			  </div>

			</form>

			<div id="success-messages"></div>



		<?php 

		// /else manage order

		}

		?>

		

	</div> <!--/panel-->	

</div> <!--/panel-->	



<!-- remove order -->

<div class="modal fade" tabindex="-1" role="dialog" id="removeOrderModal">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h4 class="modal-title"><i class="fa fa-trash"></i> Remove Order</h4>

      </div>

      <div class="modal-body">



      	<div class="removeOrderMessages"></div>



        <p>Do you really want to remove ?</p>

      </div>

      <div class="modal-footer removeProductFooter">

        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="fa fa-remove"></i> Close</button>

        <button type="button" class="btn btn-primary"  id="removeOrderBtn" data-loading-text="Loading..."> <i class="fa fa-check-circle-o"></i> Save changes</button>

      </div>

    </div><!-- /.modal-content -->

  </div><!-- /.modal-dialog -->

</div><!-- /.modal -->

<!-- /remove order-->

</div>

</div>

</body>



<?php 

	require_once 'includes/footer.php'; 

?>

<!-- Bootstrap JavaScript -->

  <script>


  $(document).ready(function () {

  	 
  	setTimeout(function(){ invoice_exchange(); getVehicle(); }, 2000);
  });



  				var ammount=parseInt($('.set_total').val());

	  			var grand=parseInt($('#invoice_grand_total').val());

				$('#total_val').val(grand);

				console.log(ammount);

				$('#invoice_grand_total').val(ammount+grand);

  	$('.check input:checkbox').click(function() {

  		$('.check input:checkbox').not(this).prop('checked', false);

    	var element = $(".oneInput");

  		element.classList.toggle("d-none");



	}); 

  	$('#fci').change(function(){

	    var c = this.checked ? 'false' : 'true';

	    if (c == "true") {

		    $('#fci_field').addClass('d-none');

	    }else{

		    $('#fci_field').removeClass('d-none');

	    }

	});

	$('#cui').change(function(){

	    var d = this.checked ? 'false' : 'true';

	    if (d == "true") {

		    $('#cui_field').addClass('d-none');

	    }else{

		    $('#cui_field').removeClass('d-none');

	    }

	});

  </script>

	 <script>

        document.onkeyup = function(e) {

  if (e.altKey && e.which == 82) {

  	//p press

   $("#paid").focus();

   // subAmount();

  } 

  if (e.altKey && e.which == 83) {

  	//r press

   $("#createOrderBtn").submit();



  } 

   if (e.altKey && e.which == 80) {

  	//p press

  	$("#printorder").click();

  



  }  if (e.altKey && e.which == 78) {

  	//n press

  	$("#neworder").click();

  



  } 

}; 

$(document).on('input','.search-barcode',function(){

	var barcode_id = $(this).attr('title');

	var barcode_val = $(this).val();

	 		 $("#productName"+barcode_id).val(barcode_val);

		      getProductData(barcode_id);

		$.ajax({

			url:"ajax/fetchBarcodeData.php",

			type:'get',

			data:{productId:$(this).val()},

			dataType:'text',

			success:function(response){

			$("#productName"+barcode_id).html(response);

			}

		});

});

</script>