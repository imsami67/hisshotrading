<?php  @$id = $_GET['vehicle_id'];
 ?>
 <?php
 $checkShipQ=mysqli_query($dbc,"SELECT * FROM invoice WHERE invoice_vehicle = '$id' AND invoice_quotation='invoice'");
 if (mysqli_num_rows($checkShipQ)>0) {
 		$checkShip=mysqli_fetch_assoc($checkShipQ);
 	if ($checkShip['invoice_type']=="general_invoice" AND $checkShip['invoice_due_amount']==0) {
 		$formSet="";
 		$msgSet='d-none';
 	}elseif ($checkShip['invoice_type']=="credit_invoice") {
 		$formSet="";
 		$msgSet='d-none';
 	}else{
 		$formSet='d-none';
 		$msgSet='';
 	}
 }else{
 			$formSet='d-none';
 			$msgSet='';
 }

 ?>
 <style>
 	.d-none{
 		display: none !important;
 	}
 	
 </style>


<div class="row">
	<div  class="col-12">
		<button type="button" onclick="refreshForm('shipment',<?=@$id?>)" class="btn btn-sm btn-primary float-right mb-2">Refresh</button>
	</div>
</div>
<div class="row"  class="">
	<div class="col-sm-12">
		<h3 class="<?=$msgSet;?>">Payment Has been not Cleared</h3>
	</div>
</div>
<form action="php_action/custom_action.php" class="<?=$formSet?>" method="POST" role="form" id="formData9">
	<?php 
     
          @$conDestination=fetchRecord($dbc,"consignee","consignee_id",$id);
        ?>
        <input type="text" value="<?=@$id?>" class="vehicle_idMain d-none" name="vehicle_id">
	<div class="row" id="refresh_shipment_docs">
		<div class="col-sm-12">
			<div class="row form-group">
				<div class="col-sm-4">
					<label for="">Shipper Names</label>
						<select name="shipper" id="shipper" class="form-control p-0 col-9 d-inline">		
							<option value="">~~SELECT~~</option>
							<?php $q = get($dbc,"shipper WHERE shipper_sts = '1'");
							while($r = mysqli_fetch_assoc($q)): ?>
								<option value="<?=$r['shipper_id']?>"><?=$r['shipper_name']?></option>
							<?php endwhile ?>
						</select>
			
					
				<a href="shipper.php" target="_blank" class="d-inline btn-sm btn-primary"><span class="fa fa-plus"></span></a>
				<button type="button" class="d-inline btn-info btn-sm" onclick="refresh_select(`shipper`,`shipper_id`,`shipper_name`,``,``)"><span class="fa fa-refresh" ></span></button>
					
				</div>
				<div class="col-sm-4">
					<label for="">Loading Country</label>
						<select name="shipment_landing_country" id="shipment_landing_country" class="form-control country_name" required>
				    		 <option>Select Country</option>
			                                <?php
						                    	$sql = mysqli_query($dbc,"SELECT * FROM country_regulation GROUP BY country_regulation_country");
						                    	while($countries=mysqli_fetch_assoc($sql)):
						                    ?>
			                                <option  value="<?=strtolower($countries['country_regulation_country'])?>"><?=$countries['country_regulation_country']?></option>
			                                <?php
			                              endwhile;
			                                ?>
				    	</select>
				</div>
			<div class="col-sm-4">
				<label for="">Loading Port</label>
				<select name="shipment_port_of_landing" id="shipment_port_of_landing" class="form-control port_name" required>
							<option value="">~~SELECT~~</option>
						</select>
			</div>
			</div>
			<div class="row form-group">
				<div class="col-sm-4">
					<label for="">Shipped Country</label>
					<input type="text" readonly name="shipment_country" id="shipment_country" class="form-control ">
						
					
				</div>
				<div class="col-sm-4">
					<label for="">Discharge Port</label>
					<input type="text" readonly name="shipment_port_of_discharge_nm" id="shipment_port_of_discharge_nm" class="form-control ">
					<input type="hidden"  name="shipment_port_of_discharge" id="shipment_port_of_discharge" class="form-control ">
					<!-- <select name="shipment_port_of_discharge" id="shipment_port_of_discharge" class="form-control" required>
							<option value="">~~SELECT~~</option>
							
						</select>	 -->
				</div>
				<div class="col-sm-4">
					<label for="">Final Destination</label>
					<input readonly type="text" value="<?=@$conDestination['consignee_final_dest']?>" name="shipment_destination" id="shipment_destination" class="form-control">
				</div>
			</div><!-- end of row -->

				<div class="row form-group">
					<div class="col-sm-4">
						<label for="">M3 Size</label>
						<input  type="text" name="shipment_measures_m3" value="<?=@$stock['vehicle_m3']?>"  id="shipment_measures_m3" class="form-control" rows="2">
					</div><!-- col -->
					<div class="col-sm-4">
						<label for="">Shipment Weight (kg)</label>
						<input type="text" name="shipment_wieght" id="shipment_wieght" class="form-control">
					</div><!-- col -->
					<div class="col-sm-4">
						<label for="">Shipment Type</label>
						<select name="shipment_type" id="shipment_type" class="form-control" required="required">
							<option value="">~~SELECT~~</option>
							<option value="roro">RORO</option>
							<option value="container">Container</option>
						</select>
					
					</div>
				</div><!-- inner row -->
				<div class="row form-group">
					<div class="col-sm-4">
						<label for="">Inner cargo weight (kg)</label>
						<input type="text" name="inner_cargo_weight" id="inner_cargo_weight" class="form-control">
					</div><!-- col -->
					<div class="col-sm-4">
						<label for="">Inner Cargo Measuremen</label>
						
						<div class="col-sm-12 row">	
						<div class="col-sm-4">
							
							<input type="numebr" name="inner_cargo_l" id="inner_cargo_l" class="form-control" style="width: 60px!important" placeholder="mm">
						</div>
						<div class="col-sm-4">
							
							<input type="numebr" name="inner_cargo_w" id="inner_cargo_w" class="form-control" style="width: 60px!important" placeholder="mm">
						</div>
						<div class="col-sm-4">
							
							<input type="numebr" name="inner_cargo_h" id="inner_cargo_h" class="form-control" style="width: 60px!important" placeholder="mm">
						</div>
					</div>
					
					</div><!-- col -->
					<div class="col-sm-4">
						<label for="">Inner cargo weight (kg)</label>
						<input type="text" name="inner_cargo_weight" id="inner_cargo_weight" class="form-control">
					
					</div>
				</div><!-- inner row -->
				<div class="row form-group">
					<div class="col-sm-4">
						
					<label for="">Shipping Company </label>
									
						<select name="shipment_company" id="shipment_company" class="form-control p-0 col-9 d-inline">		
							<option value="">~~SELECT~~</option>
							<?php $q = get($dbc,"shipment_company WHERE shipment_company_sts = '1'");
							while($r = mysqli_fetch_assoc($q)): ?>
								<option value="<?=$r['shipment_company_id']?>"><?=$r['shipment_company_name']?></option>
							<?php endwhile ?>
						</select>
						<a href="shipment_company.php" target="_blank" class="d-inline btn-sm btn-primary"><span class="fa fa-plus"></span></a>
						<button type="button" class="d-inline btn-info btn-sm" onclick="refresh_select(`shipment_company`,`shipment_company_id`,`shipment_company_name`,``,``)"><span class="fa fa-refresh" ></span></button>				
					</div>
				<div class="col-sm-4">
					<label for="">Shipping Line</label>

						<input type="text" name="shipment_shipping_line" id="shipment_shipping_line" class="form-control form-control-sm">
					
				</div>
				<div class="col-sm-4">
					<label for="">Ship Name & info</label>

						<input type="text" name="shipment_ship_name" id="shipment_ship_name" class="form-control form-control-sm">
						<input type="text" name="shipment_id" id="shipment_id" class="form-control d-none">
					
				</div>
			</div> <!-- row -->
			<div class="row form-group">
				<div class="col-sm-4">
					<label for="">Ship ETD</label>
					<input type="date" onchange="checkDateValidty('shipment_etd')" name="shipment_etd" id="shipment_etd" class="form-control" required>
				</div>
				<div class="col-sm-4">
					<label for="">Ship ETA</label>
					<input type="date" onchange="checkDateValidty('shipment_eta')" name="shipment_eta" id="shipment_eta" class="form-control">
				</div>
				<div class="col-sm-4"></div>
			</div><!-- row -->
			<div class="row form-group">
				<div class="col-sm-4">
					<label for="">Shipping Order Date</label>
					<input required type="date" onchange="checkDateValidty('shipment_date');compareDateByless('shipment_order_cutting_date','shipment_date','Cut Date')" name="shipment_date" id="shipment_date" class="form-control">
				</div>
				<div class="col-sm-4">
					<label for="">Shipping Order No</label>
					<input type="text"  name="shipment_order_no" id="shipment_order_no" class="form-control form-control-sm">
				</div>
				<div class="col-sm-4">
					<label for="">Cut Date</label>
					<input required type="date" onchange="checkDateValidty('shipment_order_cutting_date');compareDateByless('shipment_order_cutting_date','shipment_date','Cut Date')" name="shipment_order_cutting_date" id="shipment_order_cutting_date" class="form-control">
				</div>
			</div><!-- row -->
			<div class="row form-group">
				<div class="col-sm-4">
					<label for="">Container No</label>
					<input type="text" name="shipment_container_no" id="shipment_container_no" class="form-control form-control-sm">
				</div>
				<div class="col-sm-4">
					<label for="">Voyage No#</label>
					<input type="text" name="shipment_voyage_no" id="shipment_voyage_no" class="form-control form-control-sm">
				</div>
				<div class="col-sm-4">
					<label for="">HS Code</label>
					<input name="shipment_hc_code" id="shipment_hc_code" class="form-control">
				</div>
			</div><!-- row -->
			<div class="row form-group">
				<div class="col-sm-4">
					<label for="">Terminal Handling Charges</label>
					<div class="row">
						<div class="col-sm-5">
							<input type="number" name="vehicle_terminal_charges" id="vehicle_terminal_charges" class="form-control form-control-sm taxOnAmount">
						</div>
					
						<div class="col-sm-4">
							<input type="text" name="vehicle_terminal_charges_tax" id="vehicle_terminal_charges_tax" class="form-control form-control-sm prefixTax" placeholder="Tax">
						</div>
						<div class="col-sm-3">
  							<input class="form-check-input tax_reset" id="vehicle_terminal_charges_box" value="vehicle_terminal_charges_tax" type="checkbox">
  							<label class="form-check-label" for="defaultCheck1"> No Tax</label>
						</div>
					</div>
					
				</div>
				<div class="col-sm-4">
					<label for="">Heat Treatment Charges</label>
					<div class="row">
						<div class="col-sm-5">
							<input type="number" name="vehicle_treatment_charges" id="vehicle_treatment_charges" class="form-control form-control-sm taxOnAmount">
						</div>
					
						<div class="col-sm-4">
							<input type="text" name="vehicle_treatment_charges_tax" id="vehicle_treatment_charges_tax" class="form-control form-control-sm prefixTax" placeholder="Tax">
						</div>
						<div class="col-sm-3">
  							<input class="form-check-input tax_reset" id="vehicle_treatment_charges_box" value="vehicle_treatment_charges_tax" type="checkbox">
  							<label class="form-check-label" for="defaultCheck1"> No Tax</label>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<label for="">Radiation check charges </label>
					<div class="row">
						<div class="col-sm-5">
							<input type="number" name="vehicle_radiation_charges" id="vehicle_radiation_charges" class="form-control form-control-sm taxOnAmount">
						</div>
					
						<div class="col-sm-4">
							<input type="text" name="vehicle_radiation_charges_tax" id="vehicle_radiation_charges_tax" class="form-control form-control-sm prefixTax" placeholder="Tax">
						</div>
						<div class="col-sm-3">
  							<input class="form-check-input tax_reset" id="vehicle_radiation_charges_box" value="vehicle_radiation_charges_tax" type="checkbox">
  							<label class="form-check-label" for="defaultCheck1"> No Tax</label>
						</div>
					</div>
				</div>
			</div><!-- row -->
			<div class="row form-group">
				
				<div class="col-sm-4">
					<label for="">Shipping Charges</label>
					<div class="row">
						<div class="col-sm-5">
							<input type="number" name="vehicle_shipping_charges" id="vehicle_shipping_charges" class="form-control form-control-sm taxOnAmount">
						</div>
					
						<div class="col-sm-4">
							<input type="text" name="vehicle_shipping_charges_tax" id="vehicle_shipping_charges_tax" class="form-control form-control-sm prefixTax" placeholder="Tax">
						</div>
						<div class="col-sm-3">
  							<input class="form-check-input tax_reset" id="vehicle_shipping_charges_box" value="vehicle_shipping_charges_tax" type="checkbox">
  							<label class="form-check-label" for="defaultCheck1"> No Tax</label>
						</div>
					</div>
					
				</div>
				<div class="col-sm-4">
					<label for="">Freight Charges</label>
					<div class="row">
						<div class="col-sm-5">
							<input type="number" name="vehicle_freight_charges" id="vehicle_freight_charges" class="form-control form-control-sm taxOnAmount">
						</div>
					
						<div class="col-sm-4">
							<input type="text" name="vehicle_freight_charges_tax" id="vehicle_freight_charges_tax" class="form-control form-control-sm prefixTax " placeholder="Tax">
						</div>
						<div class="col-sm-3">
  							<input class="form-check-input tax_reset" id="vehicle_freight_charges_box" value="vehicle_freight_charges_tax" type="checkbox">
  							<label class="form-check-label" for="defaultCheck1"> No Tax</label>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<label for="">BL Charges</label>
					<div class="row">
						<div class="col-sm-5">
							<input type="number" name="vehicle_bl_charges" id="vehicle_bl_charges" class="form-control form-control-sm taxOnAmount">
						</div>
					
						<div class="col-sm-4">
							
						<input type="text" name="vehicle_bl_charges_tax" id="vehicle_bl_charges_tax" class="form-control form-control-sm prefixTax" placeholder="Tax">
						
					</div>
						<div class="col-sm-3">
  							<input class="form-check-input tax_reset" id="vehicle_bl_charges_box" value="vehicle_bl_charges_tax" type="checkbox">
  							<label class="form-check-label" for="defaultCheck1"> No Tax</label>
						</div>
					</div>
				</div>
			
			</div>
			<div class="row form-group">
				
				
				<div class="col-sm-4">
					<label for="">Other Charges</label>
					<div class="row">
						<div class="col-sm-5">
							<input type="number" name="vehicle_other_charges" id="vehicle_other_charges" class="form-control form-control-sm taxOnAmount">
						
						</div>
					
						<div class="col-sm-4">
							<input type="text" name="vehicle_other_charges_tax" id="vehicle_other_charges_tax" class="form-control form-control-sm prefixTax" placeholder="Tax">
						</div>
						<div class="col-sm-3">
  							<input class="form-check-input tax_reset" id="vehicle_other_charges_box" value="vehicle_other_charges_tax" type="checkbox">
  							<label class="form-check-label" for="defaultCheck1"> No Tax</label>
						</div>
					</div>
					
				</div>
				<div class="col-sm-4">
					<label for="">BL Number</label>
						<input type="text" name="bl_number" id="bl_number" class="form-control form-control-sm ">
				</div>
				<div class="col-sm-4">
						<label for="">Notes</label>
						<textarea name="shipment_notes" id="shipment_notes" class="form-control" rows="3"></textarea>
				</div>
			
			
			</div>

			
		</div><!-- col -->
		
	</div><!-- row -->

	<!-- <button type="submit" class="btn btn-primary" id="saveData9">Submit</button>
	 --><div class="row">
			<div class="col-12">
				<input type="hidden" name="formData9_type"  value="">
				<button type="submit" class="btn btn-warning float-right ml-3" id="formData9_next" onclick="submitForm('formData9','next')" >Save and Next</button>
				<button type="submit" class="btn btn-primary float-right ml-3"   id="formData9_save" onclick="submitForm('formData9','save')" >Save</button>
				
			</div>
	</div>
</form>

<br>

<table class="table table-hover table-sm table-bordered d-none">
	<thead>
		<tr>
			<th>Sr.</th>
			<th>Detail</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody id="shipment_idTable">
	</tbody>
</table>