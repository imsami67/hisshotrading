<?php  @$id = $_GET['vehicle_id']; ?>

<div class="row">
	<div  class="col-12">
		<button type="button" onclick="changeName('formData4_save','Save');resetFormId('formData4')" class="btn btn-sm btn-secondary float-right mb-2 ml-1 mr-2">Add New</button>
		
	</div>
</div>
<form action="php_action/custom_action2.php" method="POST" role="form" id="formData4">

	<?php 

        @$id = $_GET['vehicle_id'];
        @$reservation=fetchRecord($dbc,"reservation","vehicle_id",$id)['reservation_id'];

        // if ($glober_role == "admin") {

         // 	$des = '';

        // }else{

        // 	$des = 'disabled';

        // }

    ?>

    <input type="text" value="<?=@$id?>" class="vehicle_idMain d-none" name="vehicle_id">
    <input type="text" value="<?=@$reservation?>" id="get_reservation_idMain" class=" d-none" >

	<div class="row">

		<div class="col-sm-6">

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Reserved By</label>

					</div><!-- col -->

					<div class="col-sm-8">			


						<select required class="form-control " list="reservation_customer12" name="reservation_by_add" id="reservation_by">

							<option value="">~~SELECT~~</option>

							<?php $q = get($dbc,"users");

							while ($r = mysqli_fetch_assoc($q)):?>

								<option value="<?=$r['user_id']?>"><?=$r['username']?> (<?=$r['phone']?>)</option>

							<?php endwhile ?>

						</select>

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->
			<span class="loader"></span>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Destination Country</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<select required class="form-control" id="reservation_country" name="reservation_country">
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
					<div class="col-sm-2 d-none">

			

					<button type="button" id="reservation_country_details" class="btn btn-info btn-sm"><span class="fa fa-eye" ></span></button>

				</div>
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Final Destination </label>
					</div><!-- col -->
					<div class="col-sm-8">	
						<input type="text" name="reservation_final_destin"  id="reservation_final_destin" class="form-control">		
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Inspection Company</label>
					</div><!-- col -->
					<div class="col-sm-5">			
						<select name="reservation_inspection" id="reservation_inspection" class="form-control">
							<option value="">~~SELECT~~</option>
							<?php $q = get($dbc,"inspection_company WHERE inspection_company_sts = '1'");
							while($r = mysqli_fetch_assoc($q)): ?>
								<option value="<?=$r['inspection_company_id']?>"><?=$r['inspection_company_name']?></option>
							<?php endwhile ?>
						</select>
					</div><!-- col -->
					<div class="col-sm-3">
						<a href="inspection_transportation.php" target="_blank" class=" btn-sm btn-primary"><span class="fa fa-plus"></span></a>
						<button type="button" class=" btn-info btn-sm" onclick="refresh_select(`reservation_inspection`,`inspection_company_id`,`inspection_company_name`,'',``)"><span class="fa fa-refresh" ></span></button>


					</div>
				</div><!-- inner row -->
			</div><!-- form group -->
		<!-- 	<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Inspection</label>
					</div> 
					<div class="col-sm-8">	
						<input type="text" name="reservation_inspection"  id="reservation_inspection" class="form-control">		
					</div> 
				</div>
			</div> -->

		<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Sale Type</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<select required class="form-control" id="reservation_sale_type" name="reservation_sale_type">
							<option value="">Select</option>
							<option value="FOB">FOB</option>
							<option value="CIF">CIF</option>
							<option value="C&F">C&F</option>
							<option value="LOCAL_SALE">LOCAL SALE</option>
						</select>

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

		<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Shipment Type</label>
					</div><!-- col -->
					<div class="col-sm-8">
						<select name="reservation_shipment_type" id="reservation_shipment_type" class="form-control" required="required">
							<option value="">~~SELECT~~</option>
							<option value="roro">RORO</option>
							<option value="container">Container</option>
						</select></div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->
			
			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Sale Price</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<input required type="number" onkeyup ="getTotalCostPrice()"  name="reservation_sold_price" id="reservation_sold_price" class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Total Cost</label>
					</div><!-- col -->
					<div class="col-sm-8">	
						<input type="number" readonly name="reservation_total_cost"  id="reservation_total_cost" class="form-control">		
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for=""></label>

					</div><!-- col -->

					<div class="col-sm-8">	

					<input type="text" name="reservation_customer3" readonly="readonly" id="reservation_customer3" class="form-control form-control-sm">		

						

					</div><!-- col -->

					

				</div><!-- inner row -->

			</div><!-- form group -->

			<?php 

				$today = date("Y-m-d");

				$date = strtotime("+3 day", strtotime($today));

				$newDate = date("Y-m-d", $date);

			?>

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Reservation Date</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<input type="date" readonly name="reservation_date" value="<?=$today?>" id="reservation_date" class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Reservation Start Date</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<input type="date" readonly value="<?=$today?>"  name="reservation_start_date"  id="reservation_start_date" class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Reservation Expiry Date</label>

					</div><!-- col -->

					<div class="col-sm-8">	

						<input type="date"  readonly name="reservation_expiry_date" value="" id="reservation_expiry_date" class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

		</div><!-- col -->

		<div class="col-sm-6">

			<div class="form-group" id="RefreshMine">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Customer Name</label>

					</div><!-- col -->

					<div class="col-sm-5" >			

						<!-- <input class="form-control" list="reservation_customer1" name="reservation_customer" id="reservation_customer"> -->

						<select required class="form-control show_customer_info_input" list="reservation_customer1" name="reservation_customer" id="reservation_customer">

							<option value="">~~SELECT~~</option>

							<?php $q = get($dbc,"customers WHERE customer_role= 'customer' AND customer_active = 1");

							while ($r = mysqli_fetch_assoc($q)):?>

								<option value="<?=$r['customer_id']?>"><?=$r['customer_id']?>-<?=$r['customer_name']?> (<?=$r['customer_contact_person']?>-<?=$r['customer_country']?>)</option>


							<?php endwhile ?>

						</select>

					</div><!-- col -->

					<div class="col-sm-3">
						<button type="button" data-id="reservation_customer" class="btn-success btn-sm show_customer_info"><span class="fa fa-eye"></span></button>
						<a href="customers.php?type=customer" target="_blank" class=" btn-sm btn-primary"><span class="fa fa-plus"></span></a>

						<!-- <button class="btn btn-info" id="refresh_btn" onclick="refreshCall()"><span class="fa fa-refresh" ></span></button> -->

						<button type="button" class=" btn-info btn-sm" id="refresh_btn" onclick="refresh_select(`reservation_customer`,`customer_id`,`customer_name`,'',`customer_contact_person`)"><span class="fa fa-refresh" ></span></button>

						<!-- <input type="text" name="reservation_customer3" readonly="readonly" id="reservation_customer3" class="form-control form-control-sm"> -->



					</div>

				</div><!-- inner row -->

			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Destination PORT</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<select required  class="port_name form-control" id="reservation_port" name="reservation_port">
				    		 <option value="">Select Port</option>
			                                <?php
						                    	while($countries=mysqli_fetch_assoc($sql)):

						                    ?>

			                             <option value="<?=$country_regulation['country_regulation_id']?>"><?=$country_regulation['country_regulation_destination_port']?> </option>
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
						<label for="">Transportation Cost</label>
					</div><!-- col -->
					<div class="col-sm-8">	
						<input type="number" onkeyup="getTotalCostPrice()" min="0" name="reservation_transportation_cost"  id="reservation_transportation_cost" class="form-control">		
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->

				<div class="row">
					<div class="col-sm-4">
						<label for="">Inspection Charges</label>
					</div><!-- col -->
					<div class="col-sm-3">			
						<input type="number" name="reservation_inspection_fee" id="reservation_inspection_fee" class="form-control form-control-sm taxOnAmount">
					</div><!-- col -->
					<div class="col-sm-3">			
						<input type="text" name="reservation_inspection_fee_tax" id="reservation_inspection_fee_tax" class="form-control form-control-sm" placeholder="Tax">
					</div><!-- col -->
					<div class="col-sm-2">
						<div class="form-check pl-0">
  							<input class="form-check-input tax_reset" id="reservation_inspection_fee_box" value="reservation_inspection_fee_tax"  type="checkbox">
  							<label class="form-check-label" for="defaultCheck1"> No Tax</label>
						</div>
					</div><!-- col -->
				</div><!-- inner row -->
		
				<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Freight</label>
					</div><!-- col -->
					<div class="col-sm-8">	
						<input type="number" onkeyup ="getTotalCostPrice()" name="reservation_freight"  id="reservation_freight" class="form-control">		
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Currency</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<select required class="form-control" id="reservation_currency" name="reservation_currency">
							<option value="">Select</option>
							<?php $q=get($dbc,"currency WHERE currency_status=1 ");
									while($r=mysqli_fetch_assoc($q)): ?>
							<option value="<?=$r['currency_id']?>"><?=$r['currency_name']?></option>
							<?php endwhile; ?>
						</select>

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Payment Term</label>

					</div><!-- col -->

					<div class="col-sm-8">	

						<input  type="number" class="form-control" list="reservation_payement1" name="reservation_payement" id="reservation_payement" required>

						<datalist id="reservation_payement1">

							<option value="">~~SELECT~~</option>

							<?php 

								$i  = 5;

								while ($i <= 100) {?>

								<option value="<?=$i?>"><?=$i?>%</option>

							<?php

							    echo $i;

							    $i += 5;

								}

							?>

						</datalist>

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Que No.</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<?php 
						
							$countQue=(int)(countWhen($dbc,'reservation','vehicle_id',$_GET['vehicle_id']))+1;
						 ?>
						<input readonly type="number" value="<?=$countQue?>" name="reservation_que" id="reservation_que" class="form-control form-control-sm">

						<input type="text" name="reservation_id" id="reservation_id" class="form-control form-control-sm d-none">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Note</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<textarea name="reservation_note" id="reservation_note" class="form-control" rows="4"></textarea>

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Status</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<select required class="form-control" id="reservation_sts" name="reservation_sts">

							<option value="">~~SElECT~~</option>

							<option value="1">Active</option>

							<option value="0">Deactive</option>

						</select>

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

		</div><!-- col -->

	</div><!-- mian -->


			<div class="row">
			<div class="col-12">
				<?php if ($stock['vehicle_status']=='active'): ?>
				<input type="hidden" name="formData4_type"  value="">
				<button type="submit" class="btn btn-warning float-right ml-3" id="formData4_next" onclick="submitForm('formData4','next')" >Save and Next</button>
				<button type="submit" class="btn btn-primary float-right ml-3"   id="formData4_save" onclick="submitForm('formData4','save')" >Save</button>
				<?php endif ?>
			</div>
	</div>

</form>



<br>



<table class="table table-hover table-sm table-bordered">

	<thead>

		<tr>

			<th>Sr.</th>
			<th>Reservation By</th>
			<th>Reservation For</th>
			<th>Payment</th>
			<th>Sold Price</th>
			<th>Time/Date</th>
			<th>Start Date</th>
			<th>End Date</th>
			<th>Status</th>
			<th>Que No</th>
			<th>Voucher/ <br>Invoice</th>
			<th>Action</th>

		</tr>

	</thead>

	<tbody id="reservation_idTable">

	</tbody>

</table>


