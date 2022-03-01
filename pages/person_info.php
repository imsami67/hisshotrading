<form action="php_action/custom_action.php" method="POST" role="form" id="personeForm">
	<input type="hidden" name="trade_type" value="person">

<div class="row">
	<div class="col-sm-6">
		
		<h4>Individual Info</h4>
	
	</div>
	<div  class="col-sm-6">
		

		<button type="button" onclick="refreshForm('person',<?=@$id?>)" class="btn btn-sm btn-primary float-right mb-2">Refresh</button>
				
	</div>
</div>
<hr>

          	<?php 

          

          	$text = "Customers"; ?>

        <input type="text" value="<?=@$id?>" class="vehicle_idMain d-none" name="vehicle_id">

	<div class="row">

		<div class="col-sm-6">

			 	<div class="form-group" id="RefreshMine">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Seller Name</label>

					</div><!-- col -->

					<div class="col-sm-4" >	

					<input type="hidden" name="auction_person_id" id="auction_person_id">		

						<!-- <input class="form-control" list="reservation_customer1" name="reservation_customer" id="reservation_customer"> -->

						<select class="form-control show_customer_info_input" list="reservation_customer1" name="auction_person" id="auction_person" onchange="customer_infoall(this.value)">

							<option value="">~~SELECT~~</option>
							

							<?php $q = get($dbc,"customers WHERE customer_role= 'customer' AND customer_active = 1");

							while ($r = mysqli_fetch_assoc($q)):
								if ($r['customer_type']=='dealer') {?>
									<option value="<?=$r['customer_id']?>"><?=$r['customer_id']?>-<?=$r['customer_company']?> (<?=$r['customer_contact_person']?>-<?=$r['customer_country']?>)</option>

																<?php }else{
								?>

								<option value="<?=$r['customer_id']?>"><?=$r['customer_id']?>-<?=$r['customer_name']?> (<?=$r['customer_contact_person']?>-<?=$r['customer_country']?>)</option>

							<?php  } endwhile ?>

						</select>

					</div><!-- col -->

					<div class="col-sm-4">
						<button type="button" data-id="auction_person" class="btn btn-success btn-sm show_customer_info"><span class="fa fa-eye"></span></button>
						<a href="customers.php?type=customer" target="_blank" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span></a>


					<button type="button" class="btn btn-info btn-sm"  onclick="refresh_select(`auction_person`,`customer_id`,`customer_name`,'',`customer_contact_person`)"><span class="fa fa-refresh" ></span></button>


					</div>

				</div><!-- inner row -->

			</div><!-- form group -->

			<input type="hidden"  name="auction_house2" id="auction_house2"  value="" >

			<input type="hidden"  name="posnumber2" id="posnumber2"  value="" >

		<div class="form-group d-none">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Address</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<textarea readonly name="seller_address" id="seller_address" class="form-control">
							</textarea>
					</div><!-- col -->

				</div><!-- inner row -->
		</div>




						<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Buying Price </label>

					</div><!-- col -->

					<div class="col-sm-3">			

						<input type="number" name="win_fee" id="win_fee2" class="form-control form-control-sm taxOnAmount">

					</div><!-- col -->

					<div class="col-sm-3">			

						<input type="text" name="win_fee_tax" id="win_fee2_tax" placeholder="Tax" class="form-control form-control-sm">

					</div><!-- col -->

					<div class="col-sm-2">

						<div class="form-check pl-0">

  							<input class="form-check-input tax_reset" id="win_fee2_box" value="win_fee2_tax" type="checkbox">

  							<label class="form-check-label" for="win_fee_box"> No Tax</label>

						</div>

					</div><!-- col -->

				</div><!-- inner row -->

				<div class="row mt-1">

					<div class="col-sm-4">

						<label for="">Commission/<br>Services Charges</label>

					</div><!-- col -->

					<div class="col-sm-3">			

						<input type="number" name="commission_fee" id="commission_fee2" class="form-control form-control-sm taxOnAmount">

					</div><!-- col -->

					<div class="col-sm-3">			

						<input type="text" name="commission_fee_tax" id="commission_fee2_tax" placeholder="Tax" class="form-control form-control-sm">

					</div><!-- col -->

					<div class="col-sm-2">

						<div class="form-check pl-0">

  							<input class="form-check-input tax_reset" id="commission_fee2_box" value="commission_fee2_tax" type="checkbox">

  							<label class="form-check-label" for="commission_fee_box"> No Tax</label>

						</div>

					</div><!-- col -->

				</div><!-- inner row -->

				<div class="row mt-1">

					<div class="col-sm-4">

						<label for="">Recycle Fee</label>

					</div><!-- col -->

					<div class="col-sm-5">		 	

						<input type="number" name="recycle_fee" id="recycle_fee2" class="form-control form-control-sm ">

					</div><!-- col -->

					<div class="col-sm-2 d-none">			

						<input type="text" value="0" name="recycle_fee_tax" id="recycle_fee2_tax" placeholder="Tax" class="form-control form-control-sm">

					</div><!-- col -->

					<div class="col-sm-2 d-none">

						<div class="form-check pl-0">

  							<input class="form-check-input tax_reset" id="recycle_fee_box" value="recycle_fee2_tax" type="checkbox">

  							<label class="form-check-label" for="recycle_fee_box"> No Tax</label>

						</div>

					</div><!-- col -->

				</div><!-- inner row -->

				<div class="row mt-1">

					<div class="col-sm-4">

						<label for="">Bill</label>

					</div><!-- col -->

					<div class="col-sm-2"></div><!-- col -->

					<div class="col-sm-6">

						<?php

						$d  = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM airmail_files WHERE file_title = 'auctionpersonbill' AND vehicle_id = '$id' ORDER BY airmail_file_id DESC LIMIT 1"));

if(@$d['file_title'] == 'auctionpersonbill'){

?>
<a href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn btn-success">View</a>
<a download href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn btn-info">Download</a>
<?php

}else{?>

		<a href="vehicle_docs.php?vehicle_id=<?=$id?>&name=auctionpersonbill" target="_blank" class="btn btn-primary">Add</a>


	<?php



}

?>

					</div>

				</div><!-- inner row -->
				<div class="row mt-1">
					

					<div class="col-sm-4">

						<label for="">Identity Document</label>

					</div><!-- col -->

					<div class="col-sm-2"></div><!-- col -->

					<div class="col-sm-6">

						<?php

						$d  = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM airmail_files WHERE file_title = 'person_identity_doc' AND vehicle_id = '$id' ORDER BY airmail_file_id DESC LIMIT 1"));

if(@$d['file_title'] == 'person_identity_doc'){

?>
<a href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn btn-success">View</a>
<a download href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn btn-info">Download</a>
<?php

}else{?>

		<a href="vehicle_docs.php?vehicle_id=<?=$id?>&name=person_identity_doc" target="_blank" class="btn btn-primary">Add</a>


	<?php



}

?>

					</div>

				
				</div>

			</div><!-- form group -->

		</div><!-- col -->

		<div class="col-sm-6">

			

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Buying Date</label>

					</div><!-- col -->

					<div class="col-sm-8">					

						<input type="date" name="customer_buy_date" id="customer_buy_date" class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row"> 

					<div class="col-sm-4">

						<label for="">Currency</label>

					</div><!-- col -->

					<div class="col-sm-8">					
<!-- 
						<input type="text" name="customer_buy_currency" id="customer_buy_currency" class="form-control form-control-sm"> -->
						<?= countryCurrency('customer_buy_currency','customer_buy_currency','form-control form-control-sm','') ?>

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Payment Deadline</label>

					</div><!-- col -->

					<div class="col-sm-8">					

						<input type="date" name="payment_deadline2" id="payment_deadline2" value="<?=@$auction_person['payment_deadline']?>" class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

				<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Security Deposit</label>

					</div><!-- col -->

					<div class="col-sm-8">					

						<input type="text" name="security_deposit" id="security_deposit2" class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Note</label>

					</div><!-- col -->

					<div class="col-sm-8">					

						<textarea rows="3" name="person_note" id="person_note" class="form-control form-control-sm"></textarea>

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Loading Point</label>
					</div><!-- col -->
					<div class="col-sm-5">			
						<select onchange='getSubYards(this.value,"#person_sub_yard")' name="person_loading_point" id="person_loading_point" class="form-control">
						
							<?php $q = mysqli_query($dbc,"SELECT DISTINCT auction_house_name FROM riksu_transportation ");
							while ($r = mysqli_fetch_assoc($q)):?>
								<option <?=@(strtolower($r['auction_house_name'])==strtolower($fetchricksu['ricksu_loading_point']))?"selected":""?> value="<?=$r['auction_house_name']?>"><?=$r['auction_house_name']?></option>
							<?php endwhile ?>
						</select>
					</div><!-- col -->
					<div class="col-sm-3">
						<a href="ricksu_transportation.php" target="_blank" class="btn btn-primary"><span class="fa fa-plus"></span></a>
						<button type="button" class="btn btn-info" id="refresh_btn" onclick="refresh_select(`ricksu_loading_point`,`auction_house_name`,`auction_house_name`,``,``)"><span class="fa fa-refresh" ></span></button>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Sub Yards</label>
					</div><!-- col -->
					<div class="col-sm-5">			
						<select  name="person_sub_yard" id="person_sub_yard" class="form-control">
						</select>
					</div><!-- col -->
					<div class="col-sm-3">
						<a href="auction_house.php" target="_blank" class="btn btn-primary"><span class="fa fa-plus"></span></a>
						<button type="button" class="btn btn-info" id="ricksu_sub_yard_refresh" ><span class="fa fa-refresh" ></span></button>
					</div><!-- col -->
				</div><!-- inner row -->
			
			</div><!-- form-group -->



		</div><!-- col -->

	</div><!-- mian -->



	
<div class="row">
			<div class="col-12">
				<input type="hidden" name="personeForm_type"  value="">
				<button type="submit" class="btn btn-warning float-right ml-3" id="personeForm_next" onclick="submitForm('personeForm','next')" >Save and Next</button>
				<button type="submit" class="btn btn-primary float-right ml-3" id="personeForm_save" onclick="submitForm('personeForm','save')" >Save</button>
				
			</div>
		</div>
        

</form>

