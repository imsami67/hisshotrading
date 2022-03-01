<form action="php_action/custom_action.php" method="POST"  id="add_customer_data">
<input type="hidden" name="action" value="add_customer">
 <input type="hidden" class="form-control" id="customer_type_check" name="customer_type_check" value="<?=$_GET['type']?>">
        <div class="msg"></div>

	<?php 

          @$type = $_GET['type'];

          if ($type == 'bank') {

          	$text = "Bank";

          	?>

          	<div class="row">

          		<div class="col-sm-6">
          			 <div class="form-group">

	          	    	<label for="">Name of Bank</label>

	          	        <input type="text" class="form-control" id="customer_company" name="customer_company">

	          	    </div>

	          	    <div class="form-group">

	          	    	<label for="">Beneficiary Name</label>

	          	        <input type="text" class="form-control" id="customer_email" name="customer_email">

	          	    </div>

	          	    <div class="form-group">

	          	    	<label for="">Account No</label>

	          	    	<div class="row">

	          	    		<div class="col-sm-6">

			          	        <input type="text" class="form-control" id="customer_name" name="customer_name">

	          	    		</div>

	          	    		<div class="col-sm-6">

			          	        <input type="text" class="form-control" id="customer_contact_person" name="customer_contact_person" placeholder="Swift Code">

	          	    		</div>

	          	    	</div>

						<input type="text" name="customer_id" id="customer_id" class="d-none">

	          	    </div>

	          	    <div class="form-group">

	          	    	<label for="">Acceptable Currency</label>

	          	    	<?=countryCurrencyMulti("customer_country","customer_country[]","customer_country form-control"); ?>

	          	        <input type="text" class="d-none" value="bank" id="customer_role" name="customer_role">

	          	    </div>

	          	   
<div class="form-group">

						<label for="">Bank Memo</label>

						<input type="text" name="customer_email2" id="customer_email2" class="form-control">

					</div><!-- form group -->
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">

						<label for="">Bank Type</label>

							<select class="form-control" id="customer_type" name="customer_type">

							<option value="">~~SElECT~~</option>

							<option value="general_deposit">General deposit account (Futsu yokin)</option>

							<option value="time_deposit">Time deposit account (Teiki yokin)</option>
							<option value="current_account">Current account (Toza yokin)</option>
							<option value="foreign_account">Foreign currency account (Gaika yokin )</option>

						</select>


					</div><!-- form group -->
						</div>
						<div class="col-sm-6">
							<div class="form-group">

						<label for="">Person Incharge Name</label>

						<input type="text" name="customer_floor" id="customer_floor" class="form-control">

					</div><!-- form group -->
						</div>

					</div>
	          	    	
					
					
          		</div>

          		<div class="col-sm-6">

	          	    <div class="form-group">

	          	    	<label for="">Branch Name</label>

	          	        <input type="text" class="form-control" id="customer_city" name="customer_city">

	          	    </div>
	          	     <div class="form-group">

	          	    	<label for="">Branch Code</label>

	          	        <input type="text" class="form-control" id="customer_zip_code" name="customer_zip_code">

	          	    </div>
	          	    <div class="form-group">

	          	    	<label for="">Branch Address</label>

	          	        <input type="text" class="form-control" id="customer_address" name="customer_address">

	          	    </div>
	          	    <div class="row">
	          	    	<div class="col-sm-6">
	          	    		<div class="form-group">

						<label for="">Branch Phone #</label>

						<input type="text" name="customer_phone1" id="customer_phone1" class="form-control customer_phone1">

					</div><!-- form group -->
	          	    	</div>
	          	    	<div class="col-sm-6">
	          	    		<div class="form-group">

	          	    	<label for="">Branch Fax #</label>

	          	        <input type="text" class="form-control customer_whatsapp1" id="customer_whatsapp1" name="customer_whatsapp1">

	          	    </div>
	          	    	</div>
	          	    	
	          	    </div>
	          	    <div class="row">
	          	    	<div class="col-sm-6">
	          	    		 <div class="form-group">

	          	    	<label for="">Branch Email</label>

	          	        <input type="text" class="form-control" id="customer_viber" name="customer_viber">

	          	    </div>
	          	    	</div>
	          	    	<div class="col-sm-6">
	          	    		 <div class="form-group">

	          	    	<label for="">Branch URL</label>

	          	        <input type="text" class="form-control" id="customer_skype" name="customer_skype">

	          	    </div>
	          	    	</div>
	          	    </div>
	          	    
	          	    


	          	    <div class="form-group">

	          	    	<label for="">Bank Status</label>	

						<select class="form-control" id="customer_active" name="customer_active">

							<option value="">~~SElECT~~</option>

							<option value="1">Active</option>

							<option value="2">Deactive</option>

						</select>

	          	    </div>

          		</div>

          	</div>
<?php if (@$userPrivileges['nav_add']==1 || $fetchedUserRole=="admin"): ?>
			<button type="submit" class="btn btn-primary" id="saveData3">Submit</button>
<?php endif ?>
          	<?php 

          	}else{

          	$text = "Customers"; ?>

        <input type="text" value="<?=@$id?>" class="vehicle_idMain d-none" name="vehicle_id">

	<div class="row">

		<div class="col-sm-6">

			<div class="form-group customer_company">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Company Name</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<input type="text" value="<?=@$customer_info['customer_company']?>" name="customer_company" id="customer_company" class="form-control form-control-sm" required >

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Customer Name</label>

					</div><!-- col -->

					<div class="col-sm-8">	

				
						<input type="text" required value="<?=@$customer_info['customer_name']?>" name="customer_name" id="customer_name" class="form-control form-control-sm"  >

						<input type="text"   value="<?=@$customer_info['customer_id']?>" name="customer_id" id="customer_id" class="d-none">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Country</label>

					</div><!-- col -->

					<div class="col-sm-8">

					 <?=countrySelector('', "customer_country", "customer_country", "form-control customer_country")?> 
							<!-- <select name="customer_country" class="country_name form-control" id="consignee_country" required>

				    					 <option>Select Country</option>

			                                <?php

						                    	$sql = mysqli_query($dbc,"SELECT * FROM country_regulation GROUP BY country_regulation_country");

						                    	while($countries=mysqli_fetch_assoc($sql)):

						                    ?>

			                                <option <?=(@$fetchQuationData['invoice_country']==$countries['country_regulation_country'])?"selected":""?> value="<?=$countries['country_regulation_country']?>"><?=$countries['country_regulation_country']?></option>

			                                <?php

			                              endwhile;

			                                ?>

				    		

				    	</select> -->

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">City</label>

					</div><!-- col -->

					<div class="col-sm-8">					

											<input type="text" value="<?=@$customer_info['customer_city']?>" name="customer_city" id="customer_city" class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Street / Road (Optional)</label>

					</div><!-- col -->

					<div class="col-sm-8">					

						<input type="text"   value="<?=@$customer_info['customer_street']?>" name="customer_street" id="customer_street" class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">ZIP/Postal Code</label>

					</div><!-- col -->

					<div class="col-sm-8">					

						<input type="text"  required value="<?=@$customer_info['customer_zip_code']?>" name="customer_zip_code" id="customer_zip_code" class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Landline No</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<input type="text"   value="<?=@$customer_info['customer_landline']?>" name="customer_landline" id="customer_landline" class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Contact #1</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<input type="text" required  value="<?=@$customer_info['customer_phone1']?>" name="customer_phone1" id="customer_phone" class="customer_phone1 form-control form-control-sm customer_viber1_contact customer_whatsapp1_contact">

	          	        <input type="text" class="d-none" value="customer" id="customer_role" name="customer_role">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-8 offset-4">

						<label for="customer_viber1">Viber ID <br><input type="checkbox"    id="customer_viber1" class="getContact"></label>

						<label class="ml-5" for="customer_whatsapp1">Whatsapp <br><input type="checkbox" id="customer_whatsapp1" class="getContact"></label>

						<input type="text"   value="<?=@$customer_info['customer_viber1']?>" name="customer_viber1" class="customer_viber1 form-control d-none">

						<input type="text"   value="<?=@$customer_info['customer_whatsapp1']?>" name="customer_whatsapp1" class="customer_whatsapp1 form-control d-none">

					</div>

				</div>

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Email</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<input type="email" required value="<?=@$customer_info['customer_email']?>"  name="customer_email" id="customer_email" class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Email 2</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<input type="email"   value="<?=@$customer_info['customer_email2']?>" name="customer_email2" id="customer_email2" class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group ">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Designation Port</label>

					</div><!-- col -->

					<div class="col-sm-8">					
<!-- 
						<input type="text"   value="<?=@$customer_info['customer_designation']?>" value="0" name="customer_designation" id="customer_designation" class="form-control form-control-sm"> -->
						<select class="form-control" id="consignee_dest_port" name="customer_designation" required>
							<option value="">Select Country First</option>
						<?php 	$sql = mysqli_query($dbc,"SELECT * FROM country_regulation GROUP BY country_regulation_country");
						     	while($countries=mysqli_fetch_assoc($sql)):
						                    ?>
			                           <option  value="<?=$countries['country_regulation_destination_port']?>"><?=$countries['country_regulation_destination_port']?></option>

			                                <?php

			                              endwhile;

			                                ?>

												

											</select>

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Skype ID</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<input type="text"   value="<?=@$customer_info['customer_skype']?>" name="customer_skype" id="customer_skype" class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Note</label>

					</div><!-- col -->

					<div class="col-sm-8">
						<textarea class="form-control" rows="2" id="person_note" name="person_note"></textarea>
					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group d-none">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Fee</label>

					</div><!-- col -->

					<div class="col-sm-8">					

						<input type="text" value="<?=@$customer_info['customer_fee']?>" name="customer_fee" id="customer_fee" class="form-control form-control-sm" >

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group d-none">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Tax</label>

					</div><!-- col -->

					<div class="col-sm-8">					

						<input type="text"  value="<?=@$customer_info['customer_fee_tax']?>"  name="customer_fee_tax" id="customer_fee_tax" class="form-control taxOnAmount form-control-sm" >

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

						<div class="form-group d-none">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Buying Price </label>

					</div><!-- col -->

					<div class="col-sm-3">			

						<input type="number" name="win_fee" id="win_fee" class="form-control form-control-sm taxOnAmount">

					</div><!-- col -->

					<div class="col-sm-3">			

						<input type="text" name="win_fee_tax" id="win_fee_tax" placeholder="Tax" class="form-control form-control-sm">

					</div><!-- col -->

					<div class="col-sm-2">

						<div class="form-check pl-0">

  							<input class="form-check-input tax_reset" id="win_fee_box" value="win_fee_tax" type="checkbox">

  							<label class="form-check-label" for="win_fee_box"> No Tax</label>

						</div>

					</div><!-- col -->

				</div><!-- inner row -->

				<div class="row mt-1">

					<div class="col-sm-4">

						<label for="">Commission/<br>Services Charges</label>

					</div><!-- col -->

					<div class="col-sm-3">			

						<input type="number" name="commission_fee" id="commission_fee" class="form-control form-control-sm taxOnAmount">

					</div><!-- col -->

					<div class="col-sm-3">			

						<input type="text" name="commission_fee_tax" id="commission_fee_tax" placeholder="Tax" class="form-control form-control-sm">

					</div><!-- col -->

					<div class="col-sm-2">

						<div class="form-check pl-0">

  							<input class="form-check-input tax_reset" id="commission_fee_box" value="commission_fee_tax" type="checkbox">

  							<label class="form-check-label" for="commission_fee_box"> No Tax</label>

						</div>

					</div><!-- col -->

				</div><!-- inner row -->

				<div class="row mt-1">

					<div class="col-sm-4">

						<label for="">Recycle Fee</label>

					</div><!-- col -->

					<div class="col-sm-3">			

						<input type="number" name="recycle_fee" id="recycle_fee" class="form-control form-control-sm taxOnAmount">

					</div><!-- col -->

					<div class="col-sm-3">			

						<input type="text" name="recycle_fee_tax" id="recycle_fee_tax" placeholder="Tax" class="form-control form-control-sm">

					</div><!-- col -->

					<div class="col-sm-2">

						<div class="form-check pl-0">

  							<input class="form-check-input tax_reset" id="recycle_fee_box" value="recycle_fee_tax" type="checkbox">

  							<label class="form-check-label" for="recycle_fee_box"> No Tax</label>

						</div>

					</div><!-- col -->

				</div><!-- inner row -->

			

			</div><!-- form group -->

		</div><!-- col -->

		<div class="col-sm-6">

			<div class="form-group customer_contact_person">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Contact Person</label>

					</div><!-- col -->

					<div class="col-sm-8">	

						<input type="text" required value="<?=@$customer_info['customer_contact_person']?>"  name="customer_contact_person" id="customer_contact_person" class="form-control">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">State / Prefecture </label>

					</div><!-- col -->

					<div class="col-sm-8">					

						<input type="text"  value="<?=@$customer_info['customer_state']?>"  name="customer_state" id="customer_state" class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for=""> Suburg (Optional)</label>

					</div><!-- col -->

					<div class="col-sm-8">					

						<input type="text"   value="<?=@$customer_info['customer_suburb']?>" name="customer_suburb" id="customer_suburb" class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">FLoor / Building Name</label>

					</div><!-- col -->

					<div class="col-sm-8">					

						<input type="text"   value="<?=@$customer_info['customer_floor']?>" name="customer_floor" id="customer_floor" class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Address</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<textarea required   name="customer_address" id="customer_address" class="form-control" rows="3"><?=@$customer_info['customer_address']?></textarea>

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->	

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Fax No.</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<input type="text" <?=@$customer_info['customer_fax']?> name="customer_fax" id="customer_fax" class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->			

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Contact #2</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<input type="text" <?=@$customer_info['customer_phone2']?> name="customer_phone2" id="customer_phone" class="form-control form-control-sm customer_viber2_contact customer_whatsapp2_contact">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-8 offset-4">

						<label for="customer_viber2">Viber ID <br><input type="checkbox" id="customer_viber2" class="getContact"></label>

						<label class="ml-5" for="customer_whatsapp2">Whatsapp <br><input type="checkbox" id="customer_whatsapp2" class="getContact"></label>

						<input type="text" <?=@$customer_info['customer_viber2']?> name="customer_viber2" class="customer_viber2 form-control d-none">

						<input type="text" <?=@$customer_info['customer_whatsapp2']?> name="customer_whatsapp2" class="customer_whatsapp2 form-control d-none">

					</div>

				</div>

			</div><!-- form group -->	

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Website (Optional)</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<input type="text" <?=@$customer_info['customer_web']?> name="customer_web" id="customer_web" class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group d-none">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Final Designation Port</label>

					</div><!-- col -->

					<div class="col-sm-8">					

						<input type="text" value="0" name="customer_final_port" id="customer_final_port" class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->



			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Customer Type</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<select class="form-control" id="customer_type" name="customer_type">

							<option value="">~~SElECT~~</option>

							<option <?=(("dealer"==@$customer_info['customer_type'])?"selected":"")?> value="dealer">Dealer</option>

							<option <?=(("customer"==@$customer_info['customer_type'])?"selected":"")?> value="customer">Individual</option>

							<option <?=(("quotation"==@$customer_info['customer_type'])?"selected":"")?> value="quotation">Quotation</option>

						</select>

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Status</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<select class="form-control" id="customer_active" name="customer_active">

							<option  value="">~~SElECT~~</option>

							<option <?=(("1"==@$customer_info['customer_active'])?"selected":"")?> value="1">Active</option>

							<option <?=(("2"==@$customer_info['customer_active'])?"selected":"")?> value="2">Deactive</option>

						</select>

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Identity</label>

					</div><!-- col -->

					<div class="col-sm-6">
							
						<input type="hidden" name="customer_identity_action"  id="customer_identity_action" value="add">
					
						<input type="file" name="customer_identity"  id="customer_identity" class="form-control">
					</div><!-- col -->
					<div class="col-sm-2">
						<a href="#" id="customer_identity_view" target="_blank" class="btn btn-success" style="display: none;" >View</a>
					</div>
				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group d-none">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Buying Date</label>

					</div><!-- col -->

					<div class="col-sm-8">					

						<input type="text" name="customer_buy_date" id="customer_buy_date" class="form-control form-control-sm" value="0">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group d-none">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Currency</label>

					</div><!-- col -->

					<div class="col-sm-8">					

						<input type="text" name="customer_buy_currency" id="customer_buy_currency" class="form-control form-control-sm" value="0">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group --> 

			<div class="form-group d-none">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Payment Deadline</label>

					</div><!-- col -->

					<div class="col-sm-8">					

						<input type="date" value="0" name="payment_deadline" id="payment_deadline" class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

				<div class="form-group d-none">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Security Deposit</label>

					</div><!-- col -->

					<div class="col-sm-8">					

						<input type="text" value="0" name="security_deposit" id="security_deposit" class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			



		</div><!-- col -->

	</div><!-- mian -->


<?php if (@$userPrivileges['nav_add']==1 || $fetchedUserRole=="admin"): ?>
	<button type="submit" class="btn btn-primary" id="add_customer_data_btn">Submit</button>
<?php endif ?>
        <?php

          }

        ?>

</form>
<script type="text/javascript">
	
</script>