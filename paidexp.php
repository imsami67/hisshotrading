<?php

include_once "includes/header.php";



	//include_once 'functions.php';

	$vehicle_id=@$_GET['vehicle_id'];

	$vehicle_info=fetchRecord($dbc,"vehicle_info","vehicle_id",$vehicle_id);

	$maker=fetchRecord($dbc,"maker","maker_id",$vehicle_info['vehicle_maker']);

	$brands=fetchRecord($dbc,"brands","brand_id",$vehicle_info['vehicle_brand']);

	//$auction=fetchRecord($dbc,"auction_info","vehicle_id",$vehicle_id);
	$auction=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT auction_info.*, auction_home.* FROM auction_info INNER JOIN auction_home WHERE auction_info.vehicle_id = $vehicle_id GROUP BY vehicle_id"));

	$ricksuGet= mysqli_query($dbc,"SELECT ricksu.*, ricksu_company.* FROM ricksu INNER JOIN ricksu_company ON ricksu.ricksu_company = ricksu_company.ricksu_company_id WHERE ricksu.vehicle_id = '$vehicle_id' AND mini_ricksu!=1");


	$inspectionGet=mysqli_query($dbc,"SELECT inspection_info.*, inspection_company.* FROM inspection_info INNER JOIN inspection_company ON inspection_info.inspection_info_company = inspection_company.inspection_company_id WHERE inspection_info.vehicle_id = $vehicle_id");

	$shipmentGet=mysqli_query($dbc,"SELECT shipment.*, shipper.*,shipment_company.* FROM shipment INNER JOIN shipper ON shipper.shipper_id = shipment.shipper_id INNER JOIN shipment_company ON shipment_company.shipment_company_id = shipment.shipment_company WHERE shipment.vehicle_id = $vehicle_id"); 

	$airmailGet=mysqli_query($dbc,"SELECT airmail.*, consignee.*,services_company.* FROM airmail INNER JOIN consignee ON consignee.consignee_id = airmail.airmail_consignee INNER JOIN services_company ON services_company.services_company_id = airmail.airmail_services_company  WHERE airmail.vehicle_id = $vehicle_id");

	$expense_account=fetchRecord($dbc,"expense_account","vehicle_id",$vehicle_id);

	$checkPersonQ=get($dbc,"auction_person WHERE vehicle_id='".$vehicle_id."'  ");
	

	 ?>



   <div class="page-content-wrapper">

                <div class="page-content">
                	<div class="page-bar">

                        <div class="page-title-breadcrumb">

                            <div class=" pull-left">

                                <div class="page-title">Paid Expence </div>

                            </div>

                            <ol class="breadcrumb page-breadcrumb pull-right">

                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>

                                </li>

                                <li class="active">Paid Expence </li>

                            </ol>

                        </div>

                    </div>
                    <div  class="row">
                    	<div class="col-12">
                    		<button type="button" onclick="window.print()" class="btn btn-success btn-sm float-right">Print</button>
                   
                    	</div>
                    	 </div>

                    










		<h1 class="text-center text-secondary">Expense Paid Account</h1>

		<div class="container contain_auction bg-light">
			<div class="row">
                    	<div class="col-10 mx-auto">
                    		<table class="table">
                    			<tr>
                    				<th>Vehicle Name</th>
                    				<td><?=$maker['maker_name']?> <?=$brands['brand_name']?></td>
                    				<th>Chassis No</th>
                    				<td><?=$vehicle_info['vehicle_chassis_no']?></td>

                    			</tr>
                    			<tr>
                    				<th>Stock ID</th>
                    				<td><?=$vehicle_info['vehicle_stock_id']?></td>
                    				<th>Engine No.</th>
                    				<td><?=$vehicle_info['vehicle_engine_no']?></td>

                    			</tr>
								<tr>
                    				<th>Manufacture Year</th>
                    				<td><?=$vehicle_info['vehicle_manu_year']?></td>
                    				<th>Registration Year</th>
                    				<td><?=$vehicle_info['vehicle_reg_year']?></td>

                    			</tr>
                    			
                    		</table>
                    	</div>
                    </div>
                </div>


		<div class="response" >
			
		</div>
		<input type="hidden" name="" id="response" >
		<input type="hidden" name="" id="current_date" class="current_date" value="<?=date('Y-m-d')?>">


	
		<?php  if (mysqli_num_rows($checkPersonQ)==0){  ?>	
				<div class="container contain_auction bg-light">
			<h3 class="text-secondary">Auction Info</h3>
			<div  class="row">
				<div class="col-sm-11 mx-auto">
	<form action="php_action/custom_action.php" method="post" id="expense_auction">

		<input type="hidden" name="vehicle_idN" value="<?=@$_GET['vehicle_id']?>">

		<input type="hidden" name="expense_account_mnge" value="expense_auction">
		<input type="hidden" name="expense_remarks" value="paid to auction <?=$auction['auction_home_name']?>">
		

					<table class="table " style="border: none !important;" id="expense_auction_table">
						<tr>
							<th>Auction House</th><td><?=$auction['auction_home_name']?></td><th>Company Name</th><td><?=$auction['company_name']?></td>


						</tr>
				<tbody>
				<tr>
							<th>Win Price</th><td><?=@$auction['auction_win_price']+@$auction['auction_win_price_tax'];?></td>
							<td colspan="2">
								<input type="date" onchange="currentDateVadilty(this.id,'less')" required value="<?=@$expense_account['date_auction']?>" name="date_auction" id="date_auction"  class="form-control">
							</td>
							
						</tr>
						<tr>
							<th>Auction Fee</th><td><?=@$auction['auction_fee']+@$auction['auction_fee_tax'];?></td>
							<td colspan="2">
								<select class="form-control" required name="auction_bank">

								<option disabled >Select Bank</option>

								<?php 	$getBanks=get($dbc,"customers where customer_role='bank'");

									while ($bank=mysqli_fetch_assoc($getBanks)):

										 ?>

										<option <?=!empty($expense_account['auction_bank'])?"selected":""?>  value="<?=$bank['customer_id']?>"><?=$bank['customer_company']?></option>

									<?php 	endwhile; ?>

									</select>
							</td>
							
						</tr>
						<tr>
							<th>Recycle Fee</th><td><?=@$auction['auction_recycle_fee']+@$auction['auction_recycle_fee_tax'];?></td>
							<td colspan="2" rowspan="">
								<textarea rows="5" class="form-control" placeholder="Details" name="auction_bank_details"><?=@$expense_account['auction_bank_details']?></textarea></td>
						</tr>
		</tbody>			
		<tfoot>
				<tr>
							<th>Total</th><td>
								<?php 

							echo $total_aution=@(int)$auction['auction_win_price']+@(int)$auction['auction_win_price_tax']+@(int)$auction['auction_fee']+@(int)$auction['auction_fee_tax']+@(int)$auction['auction_recycle_fee']+@(int)$auction['auction_recycle_fee_tax'];
						 ?>
							</td>
							<td>
								<div class="form-check ml-4">

    					<input type="checkbox" required  class="form-check-input" <?=!empty($expense_account['paid_auction'])?"checked disabled":""?> value="<?=@$total_aution?>"  name="paid_auction" id="paid_auction">

    					<label class="form-check-label" for="buyingprice"><?=!empty($expense_account['paid_auction'])?"Paid":"Pending"?></label>

  						</div>


	

					
							</td>
							<td colspan="1">
								<?php
		$d  = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM airmail_files WHERE file_title LIKE '%auction bill%' AND vehicle_id = '$vehicle_id' ORDER BY airmail_file_id DESC LIMIT 1"));
		if($d['file_title'] == 'auction bill'){
		?>
		<a href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn btn-sm btn-dark">View Bill</a>

		<?php

		}else{?>

		<a href="trade.php?vehicle_id=<?=$vehicle_id?>" target="_blank" class="btn btn-sm btn-danger">Add Bill</a>
	<?php  } ?>
								<label for="auction_sheet"> Auction Paid Slip</label>
			<?php $d  = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM airmail_files WHERE file_title LIKE '%paid_exp_auction%' AND vehicle_id = '$vehicle_id'"));

			if(@$d['file_title'] == 'paid_exp_auction'){?>
						<a href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn btn-success btn-sm">View</a>
						<?php if (empty($expense_account['paid_auction'])): ?>
									<button type="submit" class="btn btn-sm btn-primary float-right" id="expense_auction_btn">Save</button>
									<?php else: ?>
											<a target="_blank" href="print_paidexp.php?vehicle_id=<?=$vehicle_id?>&type=auction" class="btn btn-success btn-sm float-right" id="expense_airmail_print">Print</a>
											<a target="_blank" title="send mail<?=$auction['auction_email']?>" href="mail.php?vehicle_id=<?=$vehicle_id?>&type=auction" class="btn btn-secondary btn-sm float-right" id="expense_airmail_print">Send Mail</a>
								<?php endif ?>
			<?php }else{?>
				<a href="paidexp_docs.php?vehicle_id=<?=$vehicle_id?>&name=paid_exp_auction" target="_blank" class="btn btn-info btn-sm">Add</a> 
					<button type="button" onclick="refreshMe('expense_auction_table')" class="btn btn-sm btn-primary float-right">Refresh</button>
			<?php 	} ?>


								
							
															</td>
						</tr>
		</tfoot>			
					</table>
</form>
				</div>
			</div>

<hr>
</div>
		<?php }else{ $person=mysqli_fetch_assoc($checkPersonQ);
 ?>
<div class="container contain_auction bg-light">

				<h3 class="text-secondary">Person Info</h3>
			<div class="row">

				<div class="col-sm-11 mx-auto">
	<form action="php_action/custom_action.php" method="post" id="expense_person">
		<?php 
       @$customers=fetchRecord($dbc,"customers","customer_id",$person['customer_id'])['customer_name'];  ?>
		<input type="hidden" name="vehicle_idN" value="<?=@$_GET['vehicle_id']?>">

		<input type="hidden" name="expense_account_mnge" value="expense_person">

		<input type="hidden" name="expense_remarks" value="paid to person <?=$customers?>">
		

		
		

					<table class="table " style="border: none !important;" id="expense_person_table">
						<tr>
							<th>Auction House</th><td><?=$auction['auction_home_name']?></td><th>Customer Name</th><td><?=$customers?></td>
						</tr>
				<tbody>
				<tr>
							<th>Bying Price</th><td><?=@$person['buyingprice']+@$person['buyingprice_tax']?></td>
							<td colspan="2">
								<input type="date" onchange="currentDateVadilty(this.id,'less')" required value="<?=@$expense_account['date_person']?>" name="date_person" id="date_person"  class="form-control">
							</td>

						</tr>
						<tr>
							<th>Commission</th><td><?=@$person['commission']+@$person['commission_tax']?></td>
							<td colspan="2" >

								<select class="form-control" required name="person_bank">

								<option disabled >Select Bank</option>

								<?php 	$getBanks=get($dbc,"customers where customer_role='bank'");

									while ($bank=mysqli_fetch_assoc($getBanks)):

										 ?>

										<option <?=!empty($expense_account['auction_bank'])?"selected":""?>  value="<?=$bank['customer_id']?>"><?=$bank['customer_company']?></option>

									<?php 	endwhile; ?>

									</select>
							
								</td>
						</tr>
						<tr>
							<th>Recycle Fee</th><td><?=@$person['recycle_fee']+@$person['recycle_fee_tax']?></td>
							<td colspan="2"><textarea rows="3" class="form-control" placeholder="Details" name="person_bank_details"><?=@$expense_account['person_bank_details']?></textarea></td>
						</tr>
		</tbody>			
		<tfoot>
				<tr>
							<th>Total</th><td>
								<?php 

							echo $total_person=@(int)$person['buyingprice']+@(int)$person['buyingprice_tax']+@(int)$person['commission']+@(int)$person['commission_tax']+@(int)$person['recycle_fee']+@(int)$person['recycle_fee_tax'];
						 ?>
							</td>
							<td>
								<div class="form-check ml-4">

    					<input type="checkbox" required  class="form-check-input" <?=!empty($expense_account['paid_person'])?"checked disabled":""?> value="<?=@$total_person?>"  name="paid_person" id="paid_person">

    					<label class="form-check-label" for="paid_person"><?=!empty($expense_account['paid_person'])?"Paid":"Pending"?></label>

  						</div>
							</td>
							<td colspan="1">

						<?php

						$d  = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM airmail_files WHERE file_title = 'auctionpersonbill ' AND vehicle_id = '$vehicle_id' ORDER BY airmail_file_id DESC LIMIT 1"));

if($d['file_title'] == 'auctionpersonbill'){

?>

						<!-- <a href="vehicle_docs.php?vehicle_id=<?=$vehicle_id?>&name=Export Certificate" class="btn btn-success">View</a> -->

<a href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn btn-sm btn-dark">View Bill</a>

		<?php

		}else{?>

		<a href="trade.php?vehicle_id=<?=$vehicle_id?>" target="_blank" class="btn btn-sm btn-danger">Add</a>


	<?php



}

?>
				
			<label for="auction_sheet">Person Paid Slip</label>
			<?php $d  = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM airmail_files WHERE file_title LIKE '%paid_exp_person%' AND vehicle_id = '$vehicle_id'"));

			if(@$d['file_title'] == 'paid_exp_person'){?>
						<a href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn btn-success btn-sm">View</a>
						<?php if (empty($expense_account['paid_person'])): ?>
										<button type="submit" class="btn btn-sm btn-primary float-right" id="expense_person_btn">Save</button>
									<?php else: ?>
											<a target="_blank" href="print_paidexp.php?vehicle_id=<?=$vehicle_id?>&type=person" class="btn btn-success btn-sm float-right" id="expense_airmail_print">Print</a>
											<a target="_blank" href="mail.php?vehicle_id=<?=$vehicle_id?>&type=person" class="btn btn-secondary btn-sm float-right" id="expense_airmail_print">Send Mail</a>
								<?php endif ?>
			<?php }else{?>
				<a href="paidexp_docs.php?vehicle_id=<?=$vehicle_id?>&name=paid_exp_person" target="_blank" class="btn btn-info btn-sm">Add</a>

					<button type="button" onclick="refreshMe('expense_person_table')" class="btn btn-sm btn-primary float-right">Refresh</button>
				 <?php 	} ?>
	
	
	
									
								
								
							</td>
						</tr>
		</tfoot>			
					</table>
		</form>
				</div>
			</div></div>
		<?php } ?>
			

				<hr>
		
			


<?php if (mysqli_num_rows($ricksuGet)>0): 
	$ricksu=mysqli_fetch_assoc($ricksuGet);
	?>
	

	
<div class="container contain_auction bg-light">

				<h3 class="text-secondary">Ricksu Info</h3>
			<div class="row">

				<div class="col-sm-11 mx-auto">
	<form action="php_action/custom_action.php" method="post" id="expense_ricksu">

		<input type="hidden" name="vehicle_idN" value="<?=@$_GET['vehicle_id']?>">

		<input type="hidden" name="expense_account_mnge" value="expense_ricksu">
		<input type="hidden" name="expense_remarks" value="paid to ricksu <?=$ricksu['ricksu_company_name']?>">
		
		

					<table class="table " style="border: none !important;" id="expense_ricksu_table">
						<tr>
							<th>Loading Point</th><td><?=$ricksu['ricksu_loading_point']?></td><th>RICKSU Company</th><td><?=$ricksu['ricksu_company_name']?></td>
						</tr>
				<tbody>
				<tr>
							<th>Repair Fee</th><td><?=@(int)$ricksu['ricksu_repair_fee']+@(int)$ricksu['ricksu_repair_fee_tax']?></td>
							<td colspan="2">
								<input type="date" onchange="currentDateVadilty(this.id,'less')" required value="<?=@$expense_account['ricksu_date']?>" name="ricksu_date" id="ricksu_date"  class="form-control">
							</td>

							
						</tr>
						<tr>
							<th>Ricksu Fee</th><td><?=@(int)$ricksu['ricksu_fee']+@(int)$ricksu['ricksu_fee_tax']?></td>
							<td colspan="2">
								<select class="form-control" required name="ricksu_bank">

								<option disabled >Select Bank</option>

								<?php 	$getBanks=get($dbc,"customers where customer_role='bank'");

									while ($bank=mysqli_fetch_assoc($getBanks)):

										 ?>

										<option <?=!empty($expense_account['ricksu_bank'])?"selected":""?>  value="<?=$bank['customer_id']?>"><?=$bank['customer_company']?></option>

									<?php 	endwhile; ?>

									</select>
							</td>
							
						</tr>
						<tr>
							<th>Charges For Additional Services</th><td><?=@(int)$ricksu['ricksu_charger_for_additional']+@(int)$ricksu['ricksu_charger_for_additional_tax']?></td>
							<td colspan="2" rowspan="2">
								<textarea rows="5" class="form-control" placeholder="Details" name="ricksu_bank_details"><?=@$expense_account['ricksu_bank_details']?></textarea></td>
						</tr>
		</tbody>			
		<tfoot>
				<tr>
							<th>Total</th><td>
								<?php 

							echo $total_ricksu=@(int)$ricksu['ricksu_repair_fee']+@(int)$ricksu['ricksu_repair_fee_tax']+@(int)$ricksu['ricksu_fee']+@(int)$ricksu['ricksu_fee_tax']+@(int)$ricksu['ricksu_charger_for_additional']+@(int)$ricksu['ricksu_charger_for_additional_tax'];
						 ?>
							</td>
							<td>
								<div class="form-check ml-4"><div class="form-check ml-4">

    					<input type="checkbox" required  class="form-check-input" <?=!empty($expense_account['ricksu_paid'])?"checked disabled":""?> value="<?=@$total_ricksu?>" name="ricksu_paid" id="ricksu_paid">

    					<label class="form-check-label" for="paid_repair"><?=!empty($expense_account['ricksu_paid'])?"Paid":"Pending"?></label>

  						</div></div>
							</td>
							<td colspan="1">
								
						<?php
//$d = get($dbc,"airmail_files WHERE file_title = 'Ownership Certificate' AND vehicle_id = '$vehicle_id'");
$d  = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM airmail_files WHERE file_title LIKE '%ricksu bill%' AND vehicle_id = '$vehicle_id' ORDER BY airmail_file_id DESC LIMIT 1"));
//echo $d['file_title'];
if($d['file_title'] == 'ricksu bill'){
?><a href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn btn-sm btn-dark">View Bill</a>

		<?php

		}else{?>

		<a href="trade.php?vehicle_id=<?=$vehicle_id?>" target="_blank" class="btn btn-sm btn-danger">Add Bill</a>
<?php

}
?>
					
			<label for="auction_sheet">Ricksu Paid Slip</label>
			<?php $d  = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM airmail_files WHERE file_title LIKE '%paid_exp_ricksu%' AND vehicle_id = '$vehicle_id'"));

			if(@$d['file_title'] == 'paid_exp_ricksu'){?>
						<a href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn btn-success btn-sm">View</a>
						<?php if (empty($expense_account['ricksu_paid'])): ?>
										<button type="submit" class="btn btn-sm btn-primary float-right" id="expense_ricksu_btn">Save</button>
									<?php else: ?>
											<a target="_blank" href="print_paidexp.php?vehicle_id=<?=$vehicle_id?>&type=ricksu" class="btn btn-success btn-sm float-right" id="expense_airmail_print">Print</a>
											<a target="_blank" href="mail.php?vehicle_id=<?=$vehicle_id?>&type=ricksu" class="btn btn-secondary btn-sm float-right" >Send Mail</a>
								<?php endif ?>
			<?php }else{?>
				<a href="paidexp_docs.php?vehicle_id=<?=$vehicle_id?>&name=paid_exp_ricksu" target="_blank" class="btn btn-info btn-sm">Add</a> 
					<button type="button" onclick="refreshMe('expense_ricksu_table')" class="btn btn-sm btn-primary float-right">Refresh</button>

			<?php 	} ?>
								
								
							</td>
						</tr>
		</tfoot>			
					</table>
		</form>
				</div></div></div>

				<hr>
<?php endif ?>
			<!-- --------------------------------mini ricksu--------------------------------- -->
			<?php 	$mini_ricksuQ= mysqli_query($dbc,"SELECT ricksu.*, ricksu_company.* FROM ricksu INNER JOIN ricksu_company ON ricksu.ricksu_company = ricksu_company.ricksu_company_id WHERE ricksu.vehicle_id = '$vehicle_id' AND mini_ricksu=1"); 
			$c=0;
			if (mysqli_num_rows($mini_ricksuQ)>0) {
			while ($mini=mysqli_fetch_assoc($mini_ricksuQ)) {
				
				$c++;
				$expense_mini_ricksu=fetchRecord($dbc,"expense_mini_ricksu","mini_ricksu_id",$mini['ricksu_id']);
				
		

			?>
			<div class="container contain_auction bg-light">
				<h3 class="text-secondary">Mini Ricksu Info #<?=$c?></h3>
			<div class="row">

				
				<div class="col-sm-11 mx-auto">
						
	<form action="php_action/custom_action.php" method="post" id="expense_mini_ricksu">

		<input type="hidden" name="vehicle_idN" value="<?=@$_GET['vehicle_id']?>">

		<input type="hidden" name="expense_mini_ricksu" value="<?=$mini['ricksu_id']?>">
		<input type="hidden" name="mini_ricksu_remarks" value="paid to mini ricksu <?=$mini['ricksu_company_name']?>">
		
		

					<table class="table " style="border: none !important;" id="expense_mini_ricksu_tb<?=$c?>">
						<tr>
							<th>Pickup Point</th><td><?=$mini['ricksu_delievery_point']?></td><th>Risku Company</th><td><?=$mini['ricksu_company_name']?></td>
						</tr>
				<tbody>
				<tr>
							<th>Ricksu Fee</th><td><?=@(int)$mini['ricksu_fee']+@(int)$mini['ricksu_fee_tax']?></td>
							<td colspan="2">
								<input type="date" onchange="currentDateVadilty(this.id,'less')" required value="<?=@$expense_mini_ricksu['mini_ricksu_date']?>" name="mini_ricksu_date" id="mini_ricksu_date"  class="form-control">
							</td>

							
						</tr>
						<tr>
							<th>Total</th><td>
								<?php 

							echo $total_ricksu_mini=@(int)$mini['ricksu_fee']+@(int)$mini['ricksu_fee_tax'];
						 ?>
							</td>
							<td colspan="2">
								<select class="form-control" required name="mini_ricksu_bank">

								<option disabled >Select Bank</option>

								<?php 	$getBanks=get($dbc,"customers where customer_role='bank'");

									while ($bank=mysqli_fetch_assoc($getBanks)):

										 ?>

										<option <?=!empty($expense_mini_ricksu['mini_ricksu_bank'])?"selected":""?>  value="<?=$bank['customer_id']?>"><?=$bank['customer_company']?></option>

									<?php 	endwhile; ?>

									</select>
							</td>
							
						</tr>
						<tr><td colspan="2"></td>
							
							<td colspan="2" rowspan="2">
								<textarea rows="5" class="form-control" placeholder="Details" name="mini_ricksu_bank_details"><?=@$expense_mini_ricksu['mini_ricksu_bank_details']?></textarea></td>
						</tr>
		</tbody>			
		<tfoot>
				<tr><td colspan="2"></td>
							
							<td>
								<div class="form-check ml-4"><div class="form-check ml-4">

    					<input type="checkbox" required  class="form-check-input" <?=!empty($expense_mini_ricksu['mini_ricksu_paid'])?"checked disabled":""?> value="<?=@$total_ricksu_mini?>" name="mini_ricksu_paid" id="mini_ricksu_paid">

    					<label class="form-check-label" for="mini_ricksu_paid"><?=!empty($expense_mini_ricksu['mini_ricksu_paid'])?"Paid":"Pending"?></label>

  						</div></div>
							</td>
							<td colspan="1">
								
			<label for="auction_sheet">Ricksu Paid Slip #<?=$c?></label>

			<?php 
				$ric='paid_exp_mini_ricksu_'.$mini['ricksu_id'];
			$d  = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM airmail_files WHERE file_title LIKE '%".$ric."%' AND vehicle_id = '$vehicle_id'"));

			if(@$d['file_title'] == $ric){?>
						<a href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn btn-success btn-sm">View</a>
							<?php if (empty($expense_mini_ricksu['mini_ricksu_paid'])): ?>
										<button type="submit" class="btn btn-sm btn-primary float-right" id="expense_mini_ricksu_btn">Save</button>
									<?php else: ?>
											<a target="_blank" href="print_paidexp.php?vehicle_id=<?=$vehicle_id?>&type=mini_ricksu&id=<?=$mini['ricksu_id']?>" class="btn btn-success btn-sm float-right" id="expense_airmail_print">Print</a>
											<a target="_blank" href="mail.php?vehicle_id=<?=$vehicle_id?>&type=mini_ricksu&id=<?=$mini['ricksu_id']?>" class="btn btn-secondary btn-sm float-right" >Send Mail</a>
								<?php endif ?>
			<?php }else{?>
				<a href="paidexp_docs.php?vehicle_id=<?=$vehicle_id?>&name=<?=$ric?>" target="_blank" class="btn btn-info btn-sm">Add</a>
					<button type="button" onclick="refreshMe('expense_mini_ricksu_tb<?=$c?>')" class="btn btn-sm btn-primary float-right">Refresh</button>
				
				 <?php 	} ?>
								
							
							</td>
						</tr>
		</tfoot>			
					</table>
		</form>
				</div></div>
			</div>
<?php 	}} //end mini ricksu ?>
			<!-- --------------------------------mini ricksu--------------------------------- -->
<?php if (mysqli_num_rows($inspectionGet)>0): $inspection=mysqli_fetch_assoc($inspectionGet); ?>
	
			
				<div class="container contain_auction bg-light">

			
					<h3 class="text-secondary">Inspection</h3>
			<div class="row">

				<div class="col-sm-11 mx-auto">
	<form action="php_action/custom_action.php" method="post" id="expense_inspection">

		<input type="hidden" name="vehicle_idN" value="<?=@$_GET['vehicle_id']?>">

		<input type="hidden" name="expense_account_mnge" value="expense_inspection">
		<input type="hidden" name="expense_remarks" value="paid to inspection <?=$inspection['inspection_company_name']?>">
		
		

					<table class="table " style="border: none !important;" id="expense_inspection_table">
						<tr>
							<th>Inspection For</th><td><?=@$inspection['inspection_info_for']?></td><th>Inspection Company</th><td><?=$inspection['inspection_company_name']?></td>
						</tr>
				<tbody>
				<tr>
							<th>Inspection Charges</th><td><?=@$inspection['inspection_info_charges']+@$inspection['inspection_info_charges_tax']?></td>
							<td colspan="2">
								<input type="date" onchange="currentDateVadilty(this.id,'less')" required value="<?=@$expense_account['inspection_date']?>" name="inspection_date" id="inspection_date"  class="form-control">
							</td>
							
						</tr>
						<tr>
							<th>Repair Charges</th><td><?=@$inspection['inspection_info_repair_charges']+@$inspection['inspection_info_repair_charges_tax']?></td>
							<td colspan="2">
								<select class="form-control" required name="inspection_bank" id="inspection_bank">

								<option disabled >Select Bank</option>

								<?php 	$getBanks=get($dbc,"customers where customer_role='bank'");

									while ($bank=mysqli_fetch_assoc($getBanks)):

										 ?>

										<option <?=!empty($expense_account['inspection_bank'])?"selected":""?>  value="<?=$bank['customer_id']?>"><?=$bank['customer_company']?></option>

									<?php 	endwhile; ?>

									</select>
							</td>
							
						</tr>
						<tr>
							<th>Re Inspection fee</th><td><?=@$inspection['inspection_info_reinspection1']+@$inspection['Inspection_info_reinspection1_tax']?></td><td colspan="2" rowspan="2">
								<textarea rows="5" class="form-control" placeholder="Details" name="inspection_bank_details"><?=@$expense_account['inspection_bank_details']?></textarea></td>
						</tr>
						<tr>
							<th>Ricksu Fee/Tax</th><td><?=@$inspection['inspection_info_ricksu1']+@$inspection['inspection_info_ricksu1_tax']?></td>
						</tr>
		</tbody>			
		<tfoot>
				<tr>
							<th>Total</th><td>
								<?php 

							echo $total_inspection=@(int)$inspection['inspection_info_charges']+@(int)$inspection['inspection_info_charges_tax']+@(int)$inspection['inspection_info_repair_charges']+@(int)$inspection['inspection_info_repair_charges_tax']+@(int)$inspection['inspection_info_reinspection1']+@(int)$inspection['Inspection_info_reinspection1_tax']+@(int)$inspection['inspection_info_ricksu1']+@(int)$inspection['inspection_info_ricksu1_tax'];
						 ?>
							</td>
							<td>
								<div class="form-check ml-4"><div class="form-check ml-4">

    					<input type="checkbox" required  class="form-check-input" <?=!empty($expense_account['inspection_paid'])?"checked disabled":""?> value="<?=@$total_inspection?>" name="inspection_paid" id="inspection_paid">

    					<label class="form-check-label" for="inspection_paid"><?=!empty($expense_account['inspection_paid'])?"Paid":"Pending"?></label>

  						</div></div>
							</td>
							<td colspan="1">
												
			<label for="auction_sheet">Inspection Paid Slip</label>
			<?php $d  = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM airmail_files WHERE file_title LIKE '%paid_exp_inspection%' AND vehicle_id = '$vehicle_id'"));

			if(@$d['file_title'] == 'paid_exp_inspection'){?>
						<a href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn btn-success btn-sm">View</a>
						<?php if (empty($expense_account['inspection_paid'])): ?>
										<button type="submit" class="btn btn-sm btn-primary float-right" id="expense_inspection_btn">Save</button>
									<?php else: ?>
													<a target="_blank" href="print_paidexp.php?vehicle_id=<?=$vehicle_id?>&type=inspection" class="btn btn-success btn-sm float-right" id="expense_airmail_print">Print</a>
													<a target="_blank" href="mail.php?vehicle_id=<?=$vehicle_id?>&type=inspection" class="btn btn-secondary btn-sm float-right" >Send Mail</a>
								<?php endif ?>
			<?php }else{?>
				<a href="paidexp_docs.php?vehicle_id=<?=$vehicle_id?>&name=paid_exp_inspection" target="_blank" class="btn btn-info btn-sm">Add</a>

				<button type="button" onclick="refreshMe('expense_inspection_table')" class="btn btn-sm btn-primary float-right">Refresh</button>
				 <?php 	} ?>
								
								
							</td>
						</tr>
		</tfoot>			
					</table>
		</form>
				</div>		
				</div>	
			</div>


		<hr>
<?php endif ?>
<?php if (mysqli_num_rows($shipmentGet)>0): $shipment=mysqli_fetch_assoc($shipmentGet); ?>
	


	<div class="container contain_auction bg-light">

			
					<h3 class="text-secondary">Shipment Info</h3>
			<div class="row">

				<div class="col-sm-11 mx-auto">
	<form action="php_action/custom_action.php" method="post" id="expense_shipment">

		<input type="hidden" name="vehicle_idN" value="<?=@$_GET['vehicle_id']?>">

		<input type="hidden" name="expense_account_mnge" value="expense_shipment">

		<input type="hidden" name="expense_remarks" value="paid to shipment <?=@$shipment['shipment_company_name']?>">
		
		

					<table class="table " style="border: none !important;" id="expense_shipment_table">
						<tr>
							<th>Shipper Name</th><td><?=@$shipment['shipper_name']?></td><th>Shipping Company</th><td><?=@$shipment['shipment_company_name']?></td>
							
						</tr>
				<tbody>
					<tr>
						<th>BL Charges</th><td><?=@$vehicle_info['vehicle_bl_charges']+@$vecicle_info['vehicle_bl_charges_tax']?></td>
						<td colspan="2">
								<input type="date" onchange="currentDateVadilty(this.id,'less')" required name="shipment_date" value="<?=@$expense_account['shipment_date']?>" id="shipment_date"  class="form-control">
							</td>
					</tr>
					<tr>
						<th>Radiaton Check Charges</th><td><?=@(int)$shipment['radiation_charges']+@(int)$shipment['radiation_charges_tax']?></td>
						<td colspan="2">
								<select class="form-control" required name="shipment_bank" id="inspection_bank">

								<option disabled >Select Bank</option>

								<?php 	$getBanks=get($dbc,"customers where customer_role='bank'");

									while ($bank=mysqli_fetch_assoc($getBanks)):

										 ?>

										<option <?=!empty($expense_account['shipment_bank'])?"selected":""?>  value="<?=$bank['customer_id']?>"><?=$bank['customer_company']?></option>

									<?php 	endwhile; ?>

									</select>
							</td>
					</tr>
					<tr>
						<th>Freight Charges</th><td><?=@$vehicle_info['vehicle_freight_charges']+@$vehicle_info['vehicle_freight_charges_tax']?></td>
						<td colspan="2" rowspan="2">
								<textarea rows="5" class="form-control" placeholder="Details" name="shipment_bank_details"><?=@$expense_account['shipment_bank_details']?></textarea></td>
					</tr>
					<tr>
						<th>Terminal Handling Charges</th><td><?=@(int)$vehicle_info['vehicle_terminal_charges']+@(int)$vehicle_info['vehicle_terminal_charges_tax']?></td>
					</tr>
					<tr>
						<th>Heat Treatment Charges</th><td><?=@(int)$shipment['heat_charges']+@(int)$shipment['heat_charges_tax']?></td>
					</tr>
					<tr>
						<th>Other Charges</th><td><?=@(int)$shipment['other_charges']+@(int)$shipment['other_charges_tax']?></td>
					</tr>
					<tr>
						<th>Shiping Charges</th><td><?=@(int)$shipment['shipping_charges']+@(int)$shipment['shipping_charges_tax']?></td>
					</tr>
					<tr>
						<th>Shiping Charges</th><td><?=@(int)$shipment['shipping_charges']+@(int)$shipment['shipping_charges_tax']?></td>
					</tr>
				</tbody>			
		<tfoot>
				<tr>
							<th>Total</th><td>
								<?php 

							echo $total_shipment=@(int)$vehicle_info['vehicle_bl_charges']+@(int)$vecicle_info['vehicle_bl_charges_tax']+@(int)$shipment['radiation_charges']+@(int)$shipment['radiation_charges_tax']+@(int)$vehicle_info['vehicle_freight_charges']+@(int)$vehicle_info['vehicle_freight_charges_tax']+@(int)$vehicle_info['vehicle_terminal_charges']+@(int)$vehicle_info['vehicle_terminal_charges_tax']+@(int)$shipment['heat_charges']+@(int)$shipment['heat_charges_tax']+@(int)$shipment['other_charges']+@(int)$shipment['other_charges_tax']+@(int)$shipment['shipping_charges']+@(int)$shipment['shipping_charges_tax'];
						 ?>
							</td>
							<td>
								<div class="form-check ml-4"><div class="form-check ml-4">

    					<input type="checkbox" required  class="form-check-input" <?=!empty($expense_account['shipment_paid'])?"checked disabled":""?> value="<?=@$total_shipment?>" name="shipment_paid" id="shipment_paid">

    					<label class="form-check-label" for="shipment_paid"><?=!empty($expense_account['shipment_paid'])?"Paid":"Pending"?></label>

  						</div></div>
							</td>
							<td colspan="1">

						<?php
$d  = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM airmail_files WHERE file_title LIKE '%freight bill%' AND vehicle_id = '$vehicle_id' ORDER BY airmail_file_id DESC LIMIT 1"));

if($d['file_title'] == 'freight bill'){
?>
<a href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn-sm btn btn-success">View Bill</a>
<?php
}else{?>
			<a href="trade.php?vehicle_id=<?=$vehicle_id?>" target="_blank" class="btn-sm btn btn-primary">Add Bill</a>
	<?php

}
?>
					
			<label for="auction_sheet">Shipment Paid Slip</label>
			<?php $d  = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM airmail_files WHERE file_title LIKE '%paid_exp_shipment%' AND vehicle_id = '$vehicle_id'"));

			if(@$d['file_title'] == 'paid_exp_shipment'){?>
						<a href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn btn-success btn-sm">View</a>
						<?php if (empty($expense_account['shipment_paid'])): ?>
										<button type="submit" class="btn btn-sm btn-primary float-right" id="expense_shipment_btn">Save</button>
									<?php else: ?>
											<a target="_blank" href="print_paidexp.php?vehicle_id=<?=$vehicle_id?>&type=shipment" class="btn btn-success btn-sm float-right" id="expense_airmail_print">Print</a>
											<a target="_blank" href="mail.php?vehicle_id=<?=$vehicle_id?>&type=shipment" class="btn btn-secondary btn-sm float-right" >Send Mail</a>
								<?php endif ?>
			<?php }else{?>
				<button type="button" onclick="refreshMe('expense_shipment_table')" class="btn btn-sm btn-primary float-right">Refresh</button>
				<a href="paidexp_docs.php?vehicle_id=<?=$vehicle_id?>&name=paid_exp_shipment" target="_blank" class="btn btn-info btn-sm">Add</a> <?php 	} ?>
									
									
								
								
							</td>
						</tr>
		</tfoot>			
					</table>
		</form>
				</div>		
				</div>	
			</div>

		<hr>
<?php endif; ?>
<?php if (mysqli_num_rows($airmailGet)>0): $airmail=mysqli_fetch_assoc($airmailGet); ?>
	

			<div class="container contain_auction bg-light">

			
					<h3 class="text-secondary">Airmail Info</h3>
			<div class="row">

				<div class="col-sm-11 mx-auto">
	<form action="php_action/custom_action.php" method="post" id="expense_airmail">

		<input type="hidden" name="vehicle_idN" value="<?=@$_GET['vehicle_id']?>">

		<input type="hidden" name="expense_account_mnge" value="expense_airmail">
		
		<input type="hidden" name="expense_remarks" value="paid to airmail <?=@$airmail['services_company_name']?>">
		

					<table class="table " style="border: none !important;" id="expense_airmail_table">
						<tr>
							<th>Consignee Name</th><td><?=$airmail['consignee_name']?></td><th>Company</th><td><?=$airmail['services_company_name']?></td>
						</tr>
				<tbody id="expense_airmail_tb">
				<tr>
							<th>Courier Charges</th><td><?=@(int)$airmail['airmail_courier_charges']+@(int)$airmail['airmail_courier_charges_tax']?></td>
							<td colspan="2">
								<input type="date" onchange="currentDateVadilty(this.id,'less')" required name="airmail_date" value="<?=@$expense_account['airmail_date']?>" id="airmail_date"  class="form-control">
							</td>
						
						</tr>
						<tr>
							<td colspan="2"></td>
								<td colspan="2">
								<select class="form-control" required name="airmail_bank">

								<option disabled >Select Bank</option>

								<?php 	$getBanks=get($dbc,"customers where customer_role='bank'");

									while ($bank=mysqli_fetch_assoc($getBanks)):

										 ?>

										<option <?=!empty($expense_account['airmail_bank'])?"selected":""?>  value="<?=$bank['customer_id']?>"><?=$bank['customer_company']?></option>

									<?php 	endwhile; ?>

									</select>
							</td>
						</tr>
						<tr>
							<th></th><td></td>

							<td colspan="2" >
								<textarea rows="2" class="form-control" placeholder="Details" name="airmail_bank_details"><?=@$expense_account['airmail_bank_details']?></textarea></td>
						</tr>
						
		</tbody>			
		<tfoot>
				<tr>
							<th>Total</th><td>
								<?php 

							echo $total_airmail=@(int)$airmail['airmail_courier_charges']+@(int)$airmail['airmail_courier_charges_tax'];
						 ?>
							</td>
							<td>
								<div class="form-check ml-4"><div class="form-check ml-4">

    					<input type="checkbox" required  class="form-check-input" <?=!empty($expense_account['airmail_paid'])?"checked disabled":""?> value="<?=@$total_airmail?>" name="airmail_paid" id="airmail_paid">

    					<label class="form-check-label" for="airmail_paid"><?=!empty($expense_account['airmail_paid'])?"Paid":"Pending"?></label>

  						</div></div>
							</td>
							<td colspan="1">

						<?php
$d  = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM airmail_files WHERE file_title LIKE '%airmail document%' AND vehicle_id = '$vehicle_id' ORDER BY airmail_file_id DESC LIMIT 1"));
//echo $d['file_title'];
if($d['file_title'] == 'airmail document'){
?>
						<a href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn-sm btn btn-success">View Bill</a>
<?php
}else{?>
			<a href="trade.php?vehicle_id=<?=$vehicle_id?>" target="_blank" class="btn-sm btn btn-primary">Add Bill</a>
	
	<?php

}
?>
					
								
													<label for="auction_sheet">Airmail Paid Slip</label>
			<?php $d  = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM airmail_files WHERE file_title LIKE '%paid_exp_airmail%' AND vehicle_id = '$vehicle_id'"));

			if(@$d['file_title'] == 'paid_exp_airmail'){?>
						<a href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn btn-success btn-sm">View</a>
						<?php if (empty($expense_account['airmail_paid'])): ?>
										<button type="submit" class="btn btn-sm btn-primary float-right" id="expense_airmail_btn">Save</button>
									<?php else: ?>
											<a target="_blank" href="print_paidexp.php?vehicle_id=<?=$vehicle_id?>&type=airmail" class="btn btn-success btn-sm float-right" id="expense_airmail_print">Print</a>
											<a target="_blank" href="mail.php?vehicle_id=<?=$vehicle_id?>&type=airmail" class="btn btn-secondary btn-sm float-right" >Send Mail</a>
								<?php endif ?>
			<?php }else{?>
				<button type="button" onclick="refreshMe('expense_airmail_table')" class="btn btn-sm btn-dark float-right">Refresh</button>
				<a href="paidexp_docs.php?vehicle_id=<?=$vehicle_id?>&name=paid_exp_airmail" target="_blank" class="btn btn-info btn-sm">Add</a> <?php 	} ?>
								

							</td>
						</tr>
		</tfoot>			
					</table>
		</form>
				</div>		
				</div>	
			</div>
<hr>
<?php endif ?>
<?php 	$get_expense=getWhere($dbc,"vehicle_expense","vehicle_info_id",$vehicle_id); $c=0; $total=0; $total_tax=0;

						
						if (mysqli_num_rows($get_expense)>0): ?>
	<div class="container contain_auction bg-light">

			
					<h3 class="text-secondary">Vehicle Expenses Info</h3>
			<div class="row">

				<div class="col-sm-11 mx-auto">
	<form action="php_action/custom_action.php" method="post" id="expense_services_form">

		<input type="hidden" name="vehicle_idN" value="<?=@$_GET['vehicle_id']?>">

		<input type="hidden" name="expense_account_mnge" value="expense_services">

		<input type="hidden" name="expense_remarks" value="paid to vehicle services">
		
		

					<table class="table " style="border: none !important;" id="expense_services_table">
						<tr>
							<th>Name </th><th>Amount</th><th>Tax</th>
						</tr>
						<?php 	
					
							while ($fetch_expense=mysqli_fetch_assoc($get_expense)):
							      $total+=$fetch_expense['vehicle_expense_amount'];
      							$total_tax+=$fetch_expense['vehicle_expense_tax'];
						 ?>
						<tr>
							  <td><?=$fetch_expense['vehicle_expense_name']?></td>
      <td><?=$fetch_expense['vehicle_expense_amount']?></td>
      <td><?=$fetch_expense['vehicle_expense_tax'];?></td>
						</tr>
					<?php  endwhile;  $grand=$total+$total_tax;   ?>
 					<tr style="border-top: 1px solid black;">
						<th colspan="2">Total</th><th><?=$grand?></th>
					</tr>
					<tr>
						<td>
								<input type="date" onchange="currentDateVadilty(this.id,'less')" required name="services_date" value="<?=@$expense_account['services_date']?>" id="services_date"  class="form-control">
							</td>
							<td>
								
								<select class="form-control" required name="services_bank">

								<option disabled >Select Bank</option>

								<?php 	$getBanks=get($dbc,"customers where customer_role='bank'");

									while ($bank=mysqli_fetch_assoc($getBanks)):

										 ?>
 
										<option <?=!empty($expense_account['services_bank'])?"selected":""?>  value="<?=$bank['customer_id']?>"><?=$bank['customer_company']?></option>

									<?php 	endwhile; ?>

									</select>
							
							</td>
					</tr>
					<tr>
							

							<td colspan="2" >
								<textarea rows="2" class="form-control" placeholder="Details" name="services_bank_details"><?=@$expense_account['services_bank_details']?></textarea></td>
						</tr>

				<tr>
							<td>
								<div class="form-check ml-4"><div class="form-check ml-4">

    					<input type="checkbox" required  class="form-check-input" <?=!empty($expense_account['services_paid'])?"checked disabled":""?> value="<?=@$grand?>" name="services_paid" id="services_paid">

    					<label class="form-check-label" for="services_paid"><?=!empty($expense_account['services_paid'])?"Paid":"Pending"?></label>

  						</div></div>
							</td>
							<td colspan="1">
								
													<label for="auction_sheet">Vehicel Expenses Paid Slip</label>
			<?php $d  = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM airmail_files WHERE file_title LIKE '%paid_exp_services%' AND vehicle_id = '$vehicle_id'"));

			if(@$d['file_title'] == 'paid_exp_services'){?>
						<a href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn btn-success btn-sm">View</a>
						<?php if (empty($expense_account['services_paid'])): ?>
										<button type="submit" class="btn btn-sm btn-primary float-right" id="expense_services_btn">Save</button>
									<?php else: ?>
											<a target="_blank" href="print_paidexp.php?vehicle_id=<?=$vehicle_id?>&type=services" class="btn btn-success btn-sm float-right" id="expense_services_print">Print</a>
											<a target="_blank" href="mail.php?vehicle_id=<?=$vehicle_id?>&type=services" class="btn btn-secondary btn-sm float-right" >Send Mail</a>
								<?php endif ?>
			<?php }else{?>

				<a href="paidexp_docs.php?vehicle_id=<?=$vehicle_id?>&name=paid_exp_services" target="_blank" class="btn btn-info btn-sm">Add</a>
				<button type="button" onclick="refreshMe('expense_services_table')" class="btn btn-sm btn-dark float-right">Refresh</button> <?php 	} ?>
								
							</td>
						</tr>
		
					</table>
		</form>
				</div>		
				</div>	
			</div>

		<hr>
		
<?php endif; ?>

	</div>

</div>



</body>

</html>

<?php

include_once "includes/footer.php";

?>