<?php  @$id = $_GET['vehicle_id']; ?>
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
<div class="row">
	<div  class="col-12">
		<button type="button" onclick="refreshForm('inspection',<?=@$id?>)" class="btn btn-sm btn-primary float-right mb-2">Refresh</button>
	</div>
</div>
<div class="row"  >
	<div class="col-sm-12">
		<h3 class="<?=$msgSet;?>">Payment Has been not Cleared</h3>
	</div>
</div>
<form action="php_action/custom_action.php" class="<?=$formSet?>" method="POST" role="form" id="formData8">
	<?php 
          @$id = $_GET['vehicle_id'];
        ?>
        <input type="text" value="<?=@$id?>" class="vehicle_idMain d-none" name="vehicle_id">
	 <div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<div class="row" id="refreshDiv">
					<div class="col-sm-4">
						<label for="">Inspection For</label>
					</div><!-- col -->
					<div class="col-sm-5">			
						<input type="text" readonly name="inspection_info_for_name" id="inspection_info_for_name" value="	<?=getCountryName($checkShip['invoice_country']);?>-<?=$checkShip['invoice_country'];?>" class="form-control">
						<input type="hidden" id="inspection_info_for"  name="inspection_info_for" value="<?=getCountryName($checkShip['invoice_country']);?>"> 
						
					
					</div><!-- col -->
					<div class="col-sm-3">

			

					<button type="button" id="inspection_info_Details" class="btn btn-info btn-sm"><span class="fa fa-eye" ></span></button>

				</div>
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Inspection Company</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<select name="inspection_info_company" id="inspection_info_company" class="form-control">
							<option  value="">~~SELECT~~</option>
							<?php $q = get($dbc,"inspection_company WHERE inspection_company_sts = '1'");
							while($r = mysqli_fetch_assoc($q)): ?>
								<option  value="<?=$r['inspection_company_id']?>" disabled><?=$r['inspection_company_name']?></option>
							<?php endwhile ?>
						</select>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for=""> Vehicle Current Location</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<input type="text" name="inspection_info_point" id="inspection_info_point" readonly class="form-control form-control-sm">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Inspection Charges</label>
					</div><!-- col -->
					<div class="col-sm-4">			
						<input type="number" placeholder="fee" readonly name="inspection_info_charges" id="inspection_info_charges" class="form-control form-control-sm taxOnAmount">
					</div><!-- col -->
					<div class="col-sm-4">				
						<input type="text" readonly name="inspection_info_charges_tax" id="inspection_info_charges_tax" class="form-control form-control-sm" placeholder="Tax">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Inspection Appointment</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<input type="date" onchange="checkDateValidty('inspection_info_app_date');check_inspection_dates()" name="inspection_info_app_date" id="inspection_info_app_date" class="form-control form-control-sm">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
		
			
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Inspection Status</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<select name="inspection_info_sts" id="inspection_info_sts" class="form-control">
							<option value="pass">Pass</option>
							<option value="fail">Fail</option>
						</select>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Validity of Inspection</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<input type="date" readonly class="form-control" onchange="checkDateValidty('inspection_info_validity');check_inspection_dates()" id="inspection_info_validity" name="inspection_info_validity">
						
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Failure Reason</label>
					</div><!-- col -->
					<div class="col-sm-8">	
						<textarea name="inspection_info_reason" id="inspection_info_reason" class="form-control" rows="3"></textarea>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
		</div><!-- col -->
		<div class="col-sm-6">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Repair Charges</label>
					</div><!-- col -->
					<div class="col-sm-4">			
						<input type="number" name="inspection_info_repair_charges" id="inspection_info_repair_charges" class="form-control form-control-sm taxOnAmount">
					</div><!-- col -->
					<div class="col-sm-4">			
						<input type="text" name="inspection_info_repair_charges_tax" id="inspection_info_repair_charges_tax" class="form-control form-control-sm" placeholder="Tax">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Repair Done By</label>
					</div><!-- col -->
					<div class="col-sm-8">		
						<input type="text" name="inspection_info_repair_done_by" id="inspection_info_repair_done_by" class="form-control form-control-sm">
						<input type="text" name="inspection_info_id" id="inspection_info_id" class="form-control d-none form-control-sm">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Note</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<textarea name="inspection_info_note" id="inspection_info_note" class="form-control" rows="3"></textarea>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Re Inspection</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<select  name="inspection_info_reinspection" id="inspection_info_reinspection" class="form-control form-control-sm">

							<option value="">~~SELECT~~</option>
							<?php $q = get($dbc,"inspection_company WHERE inspection_company_sts = '1'");
							while($r = mysqli_fetch_assoc($q)): ?>
								<option value="<?=$r['inspection_company_id']?>"><?=$r['inspection_company_name']?></option>
							<?php endwhile ?>
						</select>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Re Inspection Fee / Tax</label>
					</div><!-- col -->
					<div class="col-sm-3">			
						<input type="number" name="inspection_info_reinspection1" id="inspection_info_reinspection1" class="form-control form-control-sm taxOnAmount">
					</div><!-- col -->
					<div class="col-sm-3">			
						<input type="text" name="inspection_info_reinspection1_tax" id="inspection_info_reinspection1_tax" class="form-control form-control-sm" placeholder="Tax">
					</div><!-- col -->
					<div class="col-sm-2">
						<div class="form-check pl-0">
  							<input class="form-check-input tax_reset" id="inspection_info_reinspection1_box" value="inspection_info_reinspection1_tax" type="checkbox">
  							<label class="form-check-label" for="defaultCheck1"> No Tax</label>
						</div>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">ReInspection Appointment</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<input type="date" onchange="checkDateValidty('inspection_info_reinspection_app_date');check_inspection_dates()" name="inspection_info_reinspection_app_date" id="inspection_info_reinspection_app_date" class="form-control form-control-sm">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
		
		
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Re Inspection Status</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<select name="inspection_info_reinspection_sts" id="inspection_info_reinspection_sts" class="form-control">
							<option value="pass">Pass</option>
							<option value="fail">Fail</option>
						</select>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
	
		</div><!-- col -->
	</div><!-- mian -->

		<div class="row">
			<div class="col-12">
				<input type="hidden" name="formData8_type"  value="">
				<button type="submit" class="btn btn-warning float-right ml-3" id="formData8_next" onclick="submitForm('formData8','next')" >Save and Next</button>
				<button type="submit" class="btn btn-primary float-right ml-3"   id="formData8_save" onclick="submitForm('formData8','save')" >Save</button>
				
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
	<tbody id="inspection_idTable">
	</tbody>
</table>
  <script type="text/javascript">
  	
  		function check_inspection_dates() {
  			var  inspection_info_validity=$('#inspection_info_validity').val();
  			var  inspection_info_app_date=$('#inspection_info_app_date').val();
  			var  inspection_info_reinspection_app_date=$('#inspection_info_reinspection_app_date').val();
  			if (inspection_info_validity>inspection_info_app_date) {
  				console.log(">");
  			}
  			if (inspection_info_validity<inspection_info_app_date) {
  				console.log("<");
  				$('#inspection_info_validity').val('');
  				alert('Validity Of Inspection Date should not be less then Inspection Appointment data');
  			}else if (inspection_info_reinspection_app_date<inspection_info_validity) {
  				$('#inspection_info_reinspection_app_date').val('');
  				alert("ReInspection Appointment should not be less then Validity Of Inspection");
  				console.log("<");

  			}
  			}

  </script>