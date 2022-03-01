 <?php

include_once "includes/header.php"; 
if (isset($_REQUEST['reservation'])) {
		$fetchReservation=fetchRecord($dbc,"reservation","reservation_id",$_REQUEST['reservation']);

}

?>
<style type="text/css">
	.col-sm-5>label{
		float: left;
		text-align: left;
	}
	label{
		text-align: left;
			float: left;
	}
</style>

 <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Payments Voucher</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Payments</li>
                            </ol>
                        </div>
                    </div>


                  <div class="col-sm-12" >
                  	<div class="panel panel-info">
                  			<div class="panel panel-heading-red" align="center"><h4>REMITTER </h4></div>
                  			<div class="panel panel-body">
                  				<form action="php_action/custom_action.php" method="POST" role="form" id="formData11">
	<?php 
          @$id = $_GET['vehicle_id'];
        ?>
        <input type="hidden" value="<?=@$_REQUEST['reservation']?>" name="reservation_id">
        <input type="text" value="<?=@$id?>" class="vehicle_idMain d-none" name="vehicle_id">
        <div class="msg"></div>
        <div class="msgDetail"></div>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-5">
						<label for="">CUSTOMER NAME</label>
					</div><!-- col -->
					<div class="col-sm-7">			
						<select required name="customer_name_paymentModule" id="customer_name_paymentModule" class="form-control">
							<option value="">~~SELECT~~</option>
							<?php $q = get($dbc,"customers WHERE customer_active = '1' AND customer_role='customer'");
		 						while($r = mysqli_fetch_assoc($q)): ?>
								<option <?=($fetchReservation['reservation_customer']==$r['customer_id'])?"selected":""?> value="<?=$r['customer_id']?>"><?=$r['customer_name']?>
									(<?=$r['customer_contact_person']?>)
								</option>
							<?php endwhile ?>
						</select>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-5">
						<label for="">AMOUNT REMITTED</label>
					</div><!-- col -->
					<div class="col-sm-7">			
						<input type="number" required name="total_sender_amount" id="total_sender_amount" class="form-control">
						<span id="alert_ammount_received" style="color: red;display: none;"></span>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
				<div class="form-group">
				<div class="row">
					<div class="col-sm-5">
						<label for="">REFERENCE #</label>
					</div><!-- col -->
					<div class="col-sm-7">			
						<input type="text" class="form-control" name="sender_reference" id="sender_reference">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
		
			
			
			
			
			 
			
		</div><!-- col -->
		<div class="col-sm-6">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-5">
						<label for="">AMOUNT REMITTED FROM</label>
					</div><!-- col -->
					<div class="col-sm-7">			
						<select required class="form-control select2" id="sender_country" name="sender_country">
				    		 <option>Select Country</option>
			                                <?php
						                    	$sql = mysqli_query($dbc,"SELECT * FROM country_regulation GROUP BY country_regulation_country");
						                    	while($countries=mysqli_fetch_assoc($sql)):

						                    ?>

			                                <option  value="<?=strtoupper($countries['country_regulation_country'])?>"><?=$countries['country_regulation_country']?></option>
			                                <?php
			                              endwhile;
			                                ?>
				    	</select>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
				<div class="form-group">
				<div class="row">
					<div class="col-sm-5">
						<label for="">CURRENCY</label>
					</div><!-- col -->
					<div class="col-sm-7">			 
						<!-- <input type="text" name="currency" id="currency" class="form-control form-control-sm"> -->
						<?php //countryCurrency("sender_currency", "sender_currency", "form-control") ?>
						<select required class="form-control" id="sender_currency" name="sender_currency">
							
							<?php $q=get($dbc,"currency WHERE currency_status=1 ");
									while($r=mysqli_fetch_assoc($q)): ?>
							<option   value="<?=$r['currency_id']?>"><?=$r['currency_name']?></option>
							<?php endwhile; ?>
						</select>
						<input type="text" name="payment_id" id="payment_id" class="form-control d-none form-control-sm">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-5">
						<label for="">BANK SLIP</label>
					</div><!-- col -->
					<div class="col-sm-7">			
						<input type="file"  class="form-control" name="bank_slip" id="bank_slip">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			
		
			
			
		</div><!-- col -->
		
			
			
	</div><!-- mian -->
			

<div class="row">
	<div class="col-sm-6">	
		<div class="form-group">
				<div class="row">
					<div class="col-sm-5">
						<label for="">REMITTER BANK NAME</label>
					</div><!-- col -->
					<div class="col-sm-7">			
						<input type="text" required class="form-control" name="sender_bank_name" id="sender_bank_name">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-5">
						<label for="">BRANCH CODE</label>
					</div><!-- col -->
					<div class="col-sm-7">			
						<input type="text" required class="form-control" name="sender_branch_code" id="sender_branch_code">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-5">
						<label for="">ACCOUNT #</label>
					</div><!-- col -->
					<div class="col-sm-7">			
						<input type="text" required name="sender_account" id="sender_account" class="form-control">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-5">
						<label for="">BANK PHONE #</label>
					</div><!-- col -->
					<div class="col-sm-7">			
						<input type="text" required name="sender_bank_phone" id="sender_bank_phone" class="form-control">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-5">
						<label for="">PAYMENT PURPOSE</label>
					</div><!-- col -->
					<div class="col-sm-7">		
					
						<textarea class="form-control" name="purpose" id="purpose"></textarea>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
	</div> <!--  col end -->
	<div class="col-sm-6">
		
			<div class="form-group">
				<div class="row">
					<div class="col-sm-5">
						<label for="">BRANCH NAME</label>
					</div><!-- col -->
					<div class="col-sm-7">			
						<input type="text" required class="form-control" name="sender_branch_name" id="sender_branch_name">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-5">
						<label for="">SWIFT CODE / IBAN #</label>
					</div><!-- col -->
					<div class="col-sm-7">			
						<input type="text" required class="form-control" name="sender_swift_code" id="sender_swift_code">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
				<div class="form-group">
				<div class="row">
					<div class="col-sm-5">
						<label for="">ACCOUNT TITLE</label>
					</div><!-- col -->
					<div class="col-sm-7">			
						<input type="text" required class="form-control" name="sender_account_title" id="sender_account_title">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-5">
						<label for="">ACCOUNT ADDRESS</label>
					</div><!-- col -->
					<div class="col-sm-7">			
						<input type="text" required class="form-control" name="sender_account_address" id="sender_account_address">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->


	</div> <!--  col end -->
</div>
<div class="panel panel-heading-red" align="center"><h4>BENEFICIARY </h4></div>

<div class="row">
	<div class="col-sm-6">	
		<div class="form-group">
				<div class="row">
					<div class="col-sm-5">
						<label for="">RECEIVING BANK NAME</label>
					</div><!-- col -->
					<div class="col-sm-7">
						<select name="receving_bank" id="receving_bank" class="form-control" autocomplete="off" required>
							<option value="">~~SELECT~~</option>
			  				<?php 
						   	$sql = "SELECT * FROM customers WHERE customer_active = 1 AND customer_role = 'bank'";
								$result = $connect->query($sql);
								while($row = $result->fetch_array()) {
								echo "<option value='".$row[0]."'>".$row[10]." ".$row[1]."</option>";
								} // while
							?>
						</select>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-5">
						<label for="">AMOUNT</label>
					</div><!-- col -->
					<div class="col-sm-7">			
						<input required type="number" name="total_receiver_amount" id="total_receiver_amount" class="form-control">
						<span id="alert_ammount_received" style="color: red;display: none;"></span>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-5">
						<label for="">INTER BANK CHARGES</label>
					</div><!-- col -->
					<div class="col-sm-7">			
						<input type="number" name="inter_bank_charges" id="inter_bank_charges" class="form-control">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-5">
						<label for="">NET RECEIVED AMOUNT</label>
					</div><!-- col -->
					<div class="col-sm-7">			
						<input type="number" name="net_amount_received" id="net_amount_received" class="form-control">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
				<div class="form-group">
				<div class="row">
					<div class="col-sm-5">
						<label for="">TOTAL AMOUNT</label>
					</div><!-- col -->
					<div class="col-sm-7">			
						<input type="number" required name="total_amount_recevied" id="total_amount_recevied" class="form-control">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			
			<div class="form-group">
				<div class="row">
					<div class="col-sm-5">
						<label for="">REMARKS</label>
					</div><!-- col -->
					<div class="col-sm-7">			
						<textarea  class="form-control" name="voucher_notes" id="voucher_notes">
							</textarea>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			
	</div> <!--  col end -->
	<div class="col-sm-6">
		
			<div class="form-group">
				<div class="row">
					<div class="col-sm-5">
						<label for="">CURRENCY</label>
					</div><!-- col -->
					<div class="col-sm-7">			
						<!-- <input type="text" name="currency" id="currency" class="form-control form-control-sm"> -->
						<?=countryCurrency("receiver_currency", "receiver_currency", "form-control") ?>
						
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-5">
						<label for="">EXCHANGE RATE</label>
					</div><!-- col -->
					<div class="col-sm-7">			
						<input type="text" class="form-control" name="exchange_rate" id="exchange_rate">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
				<div class="form-group">
				<div class="row">
					<div class="col-sm-5">
						<label for="">LOCAL BANK CHARGES</label>
					</div><!-- col -->
					<div class="col-sm-7">			
						<input type="number" class="form-control" name="local_bank_charges" id="local_bank_charges">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-5">
						<label for="">RECEIVING DATE</label>
					</div><!-- col -->
					<div class="col-sm-7">			
						<input type="date" max="<?=date('Y-m-d')?>" autocomplete="off" class="form-control" name="receving_date" id="receving_date">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-5">
						<label for="">Payment ID</label>
					</div><!-- col -->
					<div class="col-sm-7">			
						<input type="text" required name="vehicle_info" id="vehicle_info" class="form-control">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-5">
						<label for="">REFERENCE #</label>
					</div><!-- col -->
					<div class="col-sm-7">			
						<input type="text" class="form-control" name="receiver_reference" id="receiver_reference">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
	<div class="form-group">
				<div class="row">
					<div class="col-sm-5">
						<label for="">Payement Type</label>
					</div><!-- col -->
					<div class="col-sm-7">			
						<select required name="payement_type" id="payement_type" class="form-control">
							<option value="">~~SELECT~~</option>
							<option value="general voucher">General Voucher</option>
							<option value="invoice voucher">Invoice Clearance</option>
						</select>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->


	</div> <!--  col end -->
</div>
			
	  	<div class="panel panel-info">
          <div class="form-group row">
          	<div class="col-sm-4">
          	<label class="">Total Amount</label>
          	<input type="text" readonly class="form-control" value="0" name="total_amount">
          	</div>
          	<div class="col-sm-4">
          	<label class="">Received Amount</label>
          	<input type="text" readonly class="form-control" value="0" name="received_amount">
          </div>
          <div class="col-sm-4">
          	<label class="">Remaing Amount</label>
          	<input type="text" readonly class="form-control" value="0" name="due_amount" id="remaining_amount_topay">
          	<input type="hidden"  class="form-control" value="0" name="total_ammount_counted" id="total_ammount_counted">
          </div>
          </div>
          
                  	</div>
	<div class="panel panel-info">
		<table class="table table-inverse data-table">
		<thead>
			<tr><th>Invoice Id</th>
				<th>Vehicle info</th>
				<th>Sold Price</th>
				<!-- <th>Paid Amount</th> -->
				<th>Remaining Amount</th>

				<th>Paying Amount</th>
				

			</tr>
		</thead>
		<tbody id="get_Customer_by">
			
		</tbody>
	</table>
	</div>
	 <?php if (@$userPrivileges['nav_add']==1 || $fetchedUserRole=="admin"): ?>
	<button type="submit" class="btn btn-primary btn-sm pull pull-right" id="saveData11" >Save</button>
<?php endif; ?>
</form>

<br>


                  			</div>
                  	</div>
                
                  </div>


</div>

</div>

<style type="text/css">
	.row{
		margin-top: 10px;
		text-align:center;
	}
</style>




<?php

include_once "includes/footer.php";
?>