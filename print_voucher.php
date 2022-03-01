<?php include_once "includes/header.php"; ?>
<!-- <script>window.print()</script>
 --><?php if(!empty($_GET['print_voucher']) OR isset($_GET['reservation'])): ?>
	            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Options</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Payment Voucher </li>
                            </ol>
                        </div>
                    </div>

			<div class="col-sm-12">
	<div class="panel panel-success">
	<div class="panel-heading print_hide">Single Voucher
	</div><!-- heading -->
		<div class="panel-body" align="center">
				<?php 
				$status='';
				$print_hide='print_hide';
				if (isset($_GET['reservation'])) {
					$q=mysqli_query($dbc,"SELECT * FROM payment WHERE reservation_id = '".$_GET['reservation']."'");
				}else{
					$q=mysqli_query($dbc,"SELECT * FROM payment WHERE payment_id = '".$_GET[print_voucher]."'");
				}
				
				if (mysqli_num_rows($q)>0) {
					// code...
				
				$r=mysqli_fetch_assoc($q);
				$payment_id=$r['payment_id'];
					$fetchCustomer=fetchRecord($dbc,"customers",'customer_id',$r['customer_name']);
					$bank=fetchRecord($dbc,"customers",'customer_id',$r['receving_bank']);
					//$fetchTransaction=fetchRecord($dbc,"transactions",'transaction_id',$r['transaction_id']);
					
					
					

				?>

				<div class="print_hide">
				

					<button type="button" onclick="window.print()" title="<?=$r['transaction_id']?>"  class="btn btn-primary pull-right print_btn">Print Voucher</button>

					<br><br>
				</div>
			<div id="table_<?=$r['transaction_id']?>" title="<?=$r['transaction_id']?>">
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
			<table border="2px" cellspacing="5" cellpadding="5" class="table table-hover text-uppercase" width="80%" align="center" style="text-align: center!important;">
				<thead>
					<tr >
				<th colspan="2">
				<div align="center">
				<img src="img/uploads/<?=@$logo; ?>" class="img-responsive" style="width: 200px">
				</div>
				</th>
				<th colspan="3">
				<p  style="font-size:20px;margin-top: 10px;"> <?php echo $name  ?></p>
				<p style="font-size:15px; "><strong>Company No:</strong> <?php echo $company_phone  ?></p>
				<p style="font-size:15px; margin-top: -10px;"><strong>Personal No:</strong> <?php echo $personal_phone ?></p>
				<p style="font-size:15px; margin-top: -10px;"><strong>Address:</strong> <?php echo $address ?></p>
				</div>		
			</th>
		</tr>
				</thead>
			</table>
			<table border="2px" cellspacing="5" cellpadding="5" class="table table-hover text-uppercase" width="80%" align="left" style="text-align: left!important;">
				<tbody align="left">
					<tr>
						<td colspan="4" align="center">
							<h5 class="text-center font-weight-bold">REMITTER</h5>
						</td>
					</tr>
					<tr>
						<th>CUSTOMER NAME</th><td><?=$fetchCustomer['customer_name']?></td>
						
						<th>COUNTRY</th><td><?=$r['sender_country']?></td>
						<!-- <th>Phone/Email</th><td><?=$fetchCustomer['customer_phone']?><br/><?=$fetchCustomer['customer_email']?></td>  -->
					</tr>
					<tr>
						
						<th>AMOUNT REMITTED</th><td><?=$r['total_sender_amount']?></td>
						<th>CURRENCY</th><td><?=$r['sender_currency']?></td>
					</tr>
					<tr><th>REFERENCE #</th><td><?=$r['receiver_reference']?></td> 

						<th>PAYMENT PURPOSE</th><td><?=$r['purpose']?></td>
					</tr>
					<tr>
						<th>REMITTER BANK NAME</th><td><?=$r['sender_bank_name']?></td> 
						
						<th>BRANCH NAME</th><td><?=$r['sender_branch_name']?></td>
					</tr>

					<tr>
						<th>BRANCH CODE</th><td><?=$r['sender_branch_code']?></td> 
						<th>SWIFT CODE / IBAN#</th><td><?=$r['sender_swift_code']?></td>
					</tr>
					<tr>
						<th>ACCOUNT #</th><td><?=$r['sender_account']?></td> 
						<th>ACCOUNT TITLE</th><td><?=$r['sender_account_title']?></td>
					</tr>
					<tr>
						<th>BANK PHONE #</th><td><?=$r['sender_bank_phone']?></td> 
						<th>ACCOUNT ADDRESS</th><td><?=$r['sender_account_address']?></td>
					</tr>
					<tr>
						<th colspan="4" align="center">
							
							<h5 class="text-center font-weight-bold">BENEFICIARY</h5>
						</th>
					</tr>
					<tr>
						<th>RECEIVING BANK NAME</th><td><?=$r['receving_bank']?></td> 
						<th>CURRENCY</th><td><?=$r['receiver_currency']?></td>
					</tr>
					<tr>
						<th>AMOUNT</th><td><?=$r['total_receiver_amount']?></td> 
						<th>EXCHANGE RATE</th><td><?=$r['exchange_rate']?></td>
					</tr>
					<tr>
						<th>INTER BANK CHARGES</th><td><?=$r['inter_bank_charges']?></td> 
						<th>LOCAL BANK CHARGES</th><td><?=$r['local_bank_charges']?></td>
					</tr>
					<tr>
						<th>NET RECEIVED AMOUNT</th><td><?=$r['net_amount_received']?></td> 
						<th>RECEIVING DATE</th><td><?=date('D, d-M-Y',strtotime($r['payment_time']))?></td>
					</tr>
					<tr>
						<th>INTER BANK CHARGES</th><td><?=$r['inter_bank_charges']?></td> 
						<th>LOCAL BANK CHARGES</th><td><?=$r['local_bank_charges']?></td>
					</tr>
					<tr>
						<th>TOTAL AMOUNT</th><td><?=$r['total_amount_recevied']?></td> 
						<th>Payement Type</th><td><?=@$r['voucher_type']?></td>
					</tr>
					<tr>

						<th>REFERENCE #</th><td><?=$r['receiver_reference']?></td> 
						<th>REMARKS</th><td><?=$r['voucher_notes']?></td>
					</tr>
					

					
</tbody>
</table>
<table class="table table-hover">
					

					<?php

					 $get_blancNow = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM transactions WHERE voucher_id = 'payment_id' ORDER BY transaction_id DESC "));
					 //echo "SELECT * FROM transactions WHERE voucher_id = '$_GET[print_voucher]' ";
					//$q = mysqli_query($dbc,"SELECT * FROM transactions WHERE payment_id = '$_GET[print_voucher]'");
					 $get_customer=mysqli_query($dbc,"SELECT SUM(credit-debit) as nowbalance,SUM(credit) as paidamount  ,invoice_id,customer_id,vehicle_id,voucher_id  FROM transactions WHERE voucher_id = '".$payment_id."' GROUP BY vehicle_id  ");
					 //echo "SELECT SUM(credit-debit) as nowbalance,SUM(credit) as paidamount  ,invoice_id,customer_id,vehicle_id,voucher_id  FROM transactions WHERE voucher_id = '$_GET[print_voucher]' GROUP BY vehicle_id , customer_id";

$abc=0;

					while($r = mysqli_fetch_assoc($get_customer)):

						if (!empty($r['vehicle_id'])):

					 	$totalblnc = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT  SUM(credit-debit) as nowbalance,sum(credit) as paidamount FROM transactions WHERE vehicle_id = '$r[vehicle_id]' "));
					 //echo "SELECT  SUM(credit-debit) as nowbalance,sum(credit) as paidamount FROM transactions WHERE vehicle_id = '$r[vehicle_id]'";
					


						$vehicle = fetchRecord($dbc,"vehicle_info","vehicle_id",$r['vehicle_id']);


				$invoice=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM invoice WHERE invoice_vehicle = '$vehicle[vehicle_id]' "));


                $maker = fetchRecord($dbc,"maker","maker_id",$vehicle['vehicle_maker']);

                $brand = fetchRecord($dbc,"brands","brand_id",$vehicle['vehicle_brand']);
                if ($abc==0) {
                	# code...
                
					?>
					<tr>
						<th>Vehicle Info</th>
						<th>Sold Price</th>
						<th>Paid Amount</th>
						<th>Remaining Amount</th>

					</tr>
					<?php $abc++; } ?>
					<tr align="center">
						<td>
							Name : <?=$maker['maker_name']?> <?=$brand['brand_name']?> <br/>
							Chassis Code:<?=$vehicle['vehicle_chassis_code']?><br/>
							Engine No: <?=$vehicle['vehicle_engine_type']?>
						</td>
						<td>
							Invoice # <?=$invoice['invoice_id']?><br/>
							Sold Price : <?=$invoice['invoice_grand_total']?>
						</td>

						<td>
							<?=round($totalblnc['paidamount'],1)?>
						</td>

						<td>
							<?=$r['nowbalance']?>
						</td>
						
					</tr>

					<?php
					//echo $get_blancNow['advance'];
					if($get_blancNow['advance']>0){?>

						<tr align="center">
						<td colspan="2">
							Balance Added
						</td>
						

						<td colspan="2">
							<?=$get_blancNow['advance']?>
						</td>
						
					</tr>


					<?php
				}

						endif;
						endwhile;
					?>
				
			</table><!-- table -->
		</div>
			<?php 	} ?>
		</div><!-- panel body -->
</div><!-- panel -->
</div>
</div>
<?php endif; ?>
<?php include_once 'includes/footer.php'; ?>
