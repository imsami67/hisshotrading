<?php  @$id = $_GET['vehicle_id'];

 ?>


<div class="row">
	<div  class="col-12">
		<button type="button" onclick="refreshForm('airmail',<?=@$id?>)" class="btn btn-sm btn-primary float-right mb-2">Refresh</button>
	</div>
</div>
<style type="text/css">

 .checkmark-circle {
  width: 150px;
  height: 150px;
  position: relative;
  display: inline-block;
  vertical-align: top;
}
.checkmark-circle .background {
  width: 150px;
  height: 150px;
  border-radius: 50%;
  background: #1ab394;
  position: absolute;
}
 .checkmark-circle .checkmark {
  border-radius: 5px;
}
 .checkmark-circle .checkmark.draw:after {
  -webkit-animation-delay: 300ms;
  -moz-animation-delay: 300ms;
  animation-delay: 300ms;
  -webkit-animation-duration: 1s;
  -moz-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-timing-function: ease;
  -moz-animation-timing-function: ease;
  animation-timing-function: ease;
  -webkit-animation-name: checkmark;
  -moz-animation-name: checkmark;
  animation-name: checkmark;
  -webkit-transform: scaleX(-1) rotate(135deg);
  -moz-transform: scaleX(-1) rotate(135deg);
  -ms-transform: scaleX(-1) rotate(135deg);
  -o-transform: scaleX(-1) rotate(135deg);
  transform: scaleX(-1) rotate(135deg);
  -webkit-animation-fill-mode: forwards;
  -moz-animation-fill-mode: forwards;
  animation-fill-mode: forwards;
}
 .checkmark-circle .checkmark:after {
  opacity: 1;
  height: 75px;
  width: 37.5px;
  -webkit-transform-origin: left top;
  -moz-transform-origin: left top;
  -ms-transform-origin: left top;
  -o-transform-origin: left top;
  transform-origin: left top;
  border-right: 15px solid #fff;
  border-top: 15px solid #fff;
  border-radius: 2.5px !important;
  content: '';
  left: 35px;
  top: 80px;
  position: absolute;
}

@-webkit-keyframes checkmark {
  0% {
    height: 0;
    width: 0;
    opacity: 1;
  }
  20% {
    height: 0;
    width: 37.5px;
    opacity: 1;
  }
  40% {
    height: 75px;
    width: 37.5px;
    opacity: 1;
  }
  100% {
    height: 75px;
    width: 37.5px;
    opacity: 1;
  }
}
@-moz-keyframes checkmark {
  0% {
    height: 0;
    width: 0;
    opacity: 1;
  }
  20% {
    height: 0;
    width: 37.5px;
    opacity: 1;
  }
  40% {
    height: 75px;
    width: 37.5px;
    opacity: 1;
  }
  100% {
    height: 75px;
    width: 37.5px;
    opacity: 1;
  }
}
@keyframes checkmark {
  0% {
    height: 0;
    width: 0;
    opacity: 1;
  }
  20% {
    height: 0;
    width: 37.5px;
    opacity: 1;
  }
  40% {
    height: 75px;
    width: 37.5px;
    opacity: 1;
  }
  100% {
    height: 75px;
    width: 37.5px;
    opacity: 1;
  }
}


</style> 
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
<div class="row"  class="">
	<div class="col-sm-12">
		<h3 class="<?=$msgSet?>">Payment Has been not Cleared</h3>
	</div>
</div>
<?php// }else{
	 ?>


<form action="php_action/custom_action.php" method="POST" role="form" id="formData10" class="<?=$formSet?>">
		<?php 
          @$id = $_GET['vehicle_id'];
        ?>
        <input type="text" value="<?=@$id?>" class="vehicle_idMain d-none" name="vehicle_id">
        <input type="hidden" name="airmail_user_role" id="airmail_user_role" value="<?@$fetch_globeluser['user_role']?>">

	<div class="row">
		<div class="col-sm-12">
			<div class="row form-group">
				<div class="col-sm-2">
					<label for="">Request By</label>
				</div>
				<div class="col-sm-4">
					
					<select name="airmail_request_by" id="airmail_request_by" class="form-control">
							<option value="">~~SELECT~~</option>
							<?php $q = get($dbc,"users");
							while($r = mysqli_fetch_assoc($q)): ?>
								<option value="<?=$r['user_id']?>"><?=ucwords($r['username'])?></option>
							<?php endwhile ?>
						</select>	
				</div>
				<div class="col-sm-2">
					<label for="">Consignee Name</label>
				</div>
				<div class="col-sm-3">
				
				<select onchange="consigneeDetails(this.value)" name="airmail_consignee"  id="airmail_consignee" class="form-control consignee_info">
					<option value="">~~SELECT~~</option>
							<?php $q = get($dbc,"consignee WHERE customer_id='".$checkShip['invoice_customer']."'  AND  consignee_sts = '1'");
							while($r = mysqli_fetch_assoc($q)): ?>
								<option <?=($checkShip['consignee_id']==$r['consignee_id'])?"selected":""?> value="<?=$r['consignee_id']?>"><?=$r['consignee_name']?> </option>
							<?php endwhile ?>
						</select>
					<input type="text" name="airmail_consignee_name" class="form-control" id="airmail_consignee_name">
			</div>
			<div class="col-sm-1">
				<button class="btn btn-xs btn-danger" id="airmail_new_con" type="button"><span class="fa fa-plus"></span></button>
			</div>
			</div><!-- row -->
			<div class="row form-group">
				<div class="col-sm-2">
					<label for="">Country</label>
				</div>
				<div class="col-sm-4">
						
						<?=countryBySelect("airmail_country", "airmail_country", "form-control consignee_country","","");?>
				</div>
				<div class="col-sm-2">
					<label for="">State</label>
				</div>
				<div class="col-sm-4">
					
					<input type="text" name="airmail_state" id="airmail_state" class="form-control form-control-sm consignee_state">
				</div>
			</div>
			<div class="row form-group">
				<div class="col-sm-2">
					<label for="">City</label>
				</div>
				<div class="col-sm-4">
						
						<input type="text" name="airmail_city" id="airmail_city" class="form-control form-control-sm consignee_city">
				</div>
				<div class="col-sm-2">
					<label for="">Suburb (Optional)</label>
				</div>
				<div class="col-sm-4">

					<input type="text" name="airmail_suburb" id="airmail_suburb" class="form-control form-control-sm consignee_suburb">
				</div>
			</div><!-- row -->
			<div class="row form-group">
				<div class="col-sm-2">
						<label for="">Street / Road (Optional)</label>
				</div>
				<div class="col-sm-4">
					
						<input type="text" name="airmail_street" id="airmail_street" class="form-control form-control-sm consignee_street">
				</div>
				<div class="col-sm-2">
					<label for="">Floor / Building</label>
				</div>
				<div class="col-sm-4">
					
					<input type="text" name="airmail_floor" id="airmail_floor" class="form-control form-control-sm consignee_floor">
				</div>
			</div><!-- row -->
			<div class="row form-group">
				<div class="col-sm-2">
					<label for="">Zip/Postal Code</label>
				</div>
				<div class="col-sm-4">
						<input type="text" name="airmail_zipcode" id="airmail_zipcode" class="form-control form-control-sm consignee_zip">
				</div>
				<div class="col-sm-2">
					<label for="">Contact No</label>
				</div>
				<div class="col-sm-4">		
						<input type="number" name="airmail_contact_no" id="airmail_contact_no" class="form-control form-control-sm consignee_contact_no">
					</div>
			</div><!-- row -->

				<div class="row form-group">
					<div class="col-sm-2">
						<label for="">Landline No.</label>
					</div><!-- col -->
					<div class="col-sm-4">		
						<input type="number" name="airmail_landline" id="airmail_landline" class="form-control form-control-sm consignee_landline">
					</div><!-- col -->
					<div class="col-sm-2">
						<label for="">Fax No</label>
					</div><!-- col -->
					<div class="col-sm-4">			
						<input type="number" name="airmail_fax" id="airmail_fax" class="form-control form-control-sm consignee_fax">
					</div><!-- col -->
				</div><!-- inner row -->
				<div class="row form-group">
					<div class="col-sm-2">
						<label for="">Email Address</label>
					</div><!-- col -->
					<div class="col-sm-4">		
						<input type="text" name="airmail_email" id="airmail_email" class="form-control form-control-sm consignee_email">
					</div><!-- col -->
					
					<div class="col-sm-2">
						<label for="">Invoice /Payment Status</label>
					</div><!-- col -->
					<div class="col-sm-4">		
						<select class="form-control" id="airmail_payment_status" name="airmail_payment_status">
							<option value="">Select Status</option>
							<option value="full_paid">Full Paid</option>
							<option value="credit_paid">Credit Paid</option>
						</select>
					</div><!-- col -->				
				</div>
			<?php if ($fetch_globeluser['user_role']=="admin"): ?>
				  <input type="hidden" name="airmail_approved_by" id="airmail_approved_by" value="<?@$_SESSION['userId']?>">
				<div class="row form-group">
					<div class="col-sm-2">
						<label for="">Approval Status</label>
					</div><!-- col -->
					<div class="col-sm-4">		
						<select class="form-control" id="airmail_approval_status" name="airmail_approval_status">
							<option value="">Select Status</option>
							<option value="decline">Decline</option>
							<option value="approved">Approved</option>
						</select>
					</div><!-- col -->
					<div class="col-sm-2">
						<label for="">Confirmed & Approved By</label>
					</div><!-- col -->
					<div class="col-sm-4">		
						<input type="text" readonly name="airmail_con_approve_by" id="airmail_con_approve_by" class="form-control form-control-sm">
					</div><!-- col -->
				</div>
			<?php endif ?>
				<div class="row form-group">
					<div class="col-sm-2">
						<label for="">Approval Date & Time</label>
					</div><!-- col -->
					<div class="col-sm-4">		
						<input type="text" readonly name="airmail_time" id="airmail_time" class="form-control form-control-sm">
					</div><!-- col -->
					<div class="col-sm-2">
						<label for="">Decline Note </label>
					</div><!-- col -->
					<div class="col-sm-4">		
						<textarea name="airmail_decline_note" readonly id="airmail_decline_note" class="form-control">
						</textarea>
					</div><!-- col -->
				</div>
			<hr>
				<div class="row form-group">
					<div class="col-sm-2">
						<label for="">Services Company</label>
					</div><!-- col -->
					<div class="col-sm-3">				
						<select name="airmail_services_company" id="airmail_services_company" class="form-control">
							<option value="">~~SELECT~~</option>
							<?php $q = get($dbc,"services_company WHERE services_company_sts = '1'");
							while($r = mysqli_fetch_assoc($q)): ?>
								<option value="<?=$r['services_company_id']?>"><?=$r['services_company_name']?></option>
							<?php endwhile ?>
						</select>
					</div><!-- col -->
					<div class="col-sm-1 p-0">

						<a href="airmail_company.php" target="_blank" class="btn btn-xs btn-primary"><span class="fa fa-plus"></span></a>
						<button type="button" class="btn btn-xs btn-info" id="refresh_btn" onclick="refresh_select(`airmail_services_company`,`services_company_id`,`services_company_name`,'',``)"><span class="fa fa-refresh" ></span></button>
					</div>
					<div class="col-sm-2">
						<label for="">Parcel Type</label>
					</div><!-- col -->
					<div class="col-sm-4">				
						<select name="airmail_services_parcel_type" id="airmail_services_parcel_type" class="form-control">
							<option value="">~~SELECT~~</option>
								<option value="normal">Normal</option>
								<option value="express">Express</option>
						
						</select>
					</div><!-- col -->
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label for="">Parcel Weight</label>
					</div><!-- col -->
					<div class="col-sm-3">			
						<select name="airmail_parcel_weight" id="airmail_parcel_weight" class="form-control">
										<option >Parcel Weight </option>
										<option value="0.5">0.5 kg</option>
										<option value="1">1 kg</option>
										<option value="2">2 kg</option>
										<option value="5">5 kg</option>
										<option value="10">10 kg</option>
										<option value="15">15 kg</option>
									</select>			
					</div><!-- col -->
					<div class="col-sm-1 p-0">

						<a href="airmail_transportation.php" target="_blank" class="btn btn-xs btn-primary"><span class="fa fa-plus"></span></a>
						<a href="#" class="btn btn-xs btn-info" id="refresh_btn" onclick="refreshCall()"><span class="fa fa-refresh" ></span></a>
					</div>
					<div class="col-sm-2">
						<label for="">Courier Charges</label>
					</div><!-- col -->
						<div class="col-sm-2">		
						<input type="number" name="airmail_courier_charges" id="airmail_courier_charges" class="form-control form-control-sm taxOnAmount">
					</div><!-- col -->
					<div class="col-sm-1 p-0">		
						<input type="number" placeholder="Tax" name="airmail_courier_charges_tax" id="airmail_courier_charges_tax" class="form-control form-control-sm">
					</div><!-- col -->
					<div class="col-sm-1">
						<div class="form-check">
  							<input class="form-check-input tax_reset" id="airmail_courier_charges_box" value="airmail_courier_charges_tax" type="checkbox">
  							<label class="form-check-label" for="defaultCheck1"> No Tax</label>
						</div>
					</div><!-- col -->
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label for="">Parcel Details</label>
					</div><!-- col -->
					<div class="col-sm-4">			
						<input type="text" name="airmail_parcel_detail" id="airmail_parcel_detail" class="form-control form-control-sm">
					</div><!-- col -->
					<div class="col-sm-2">
						<label for="">Parcel No</label>
					</div><!-- col -->
					<div class="col-sm-4">			
						<input type="text" name="airmail_parcel_no" id="airmail_parcel_no" class="form-control form-control-sm">
						<input type="text" name="airmail_id" id="airmail_id" class="form-control d-none">
					</div><!-- col -->
				</div>
					<div class="row form-group">
					<div class="col-sm-2">
						<label for="">Date of Dispatch</label>
					</div><!-- col -->
					<div class="col-sm-4">		
					<input type="hidden"  value="<?=@$shipment['shipment_date']?>" id="shipment_date_c" class="form-control">
						<input type="date"  onchange="checkDateValidty('airmail_date_of_dispatch');compareDateByless('airmail_date_of_dispatch','shipment_date_c','Date of Dispatch')" name="airmail_date_of_dispatch"  id="airmail_date_of_dispatch" class="form-control form-control-sm">
					</div><!-- col -->
					<div class="col-sm-2">
						<label for="">Tracking No</label>
					</div><!-- col -->
					<div class="col-sm-4">		
						<input type="text" name="airmail_tracking_no" id="airmail_tracking_no" class="form-control form-control-sm">
					</div><!-- col -->
				</div>
					<div class="row form-group">
					<div class="col-sm-2">
						<label for="">Note</label>
					</div><!-- col -->
					<div class="col-sm-4">
						<textarea class="form-control" id="airmail_note" name="airmail_note"></textarea>
					</div><!-- col -->
					<div class="col-sm-2">Airmail Document</div><!-- col -->
					<div class="col-sm-4">
							<?php if (!empty($_REQUEST['vehicle_id'])): 
$d  = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM airmail_files WHERE file_title='airmail_document' AND vehicle_id = '$id' ORDER BY airmail_file_id DESC LIMIT 1"));
//echo $d['file_title'];
if(@$d['file_title'] == 'airmail_document'){
?>
	<a href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn btn-success">View</a>
	<a href="img/vehicle_docs/<?=$d['airmail_file_name']?>" download target="_blank" class="btn btn-info">Download</a>
<?php
}else{?>
			<a href="vehicle_docs.php?vehicle_id=<?=$id?>&name=airmail_document" target="_blank" class="btn btn-primary">Add</a>
	
	<?php

}
endif;
?>
					
					</div><!-- col -->
				</div>
<hr>
	<div class="row form-group">
					<div class="col-sm-2">
						<label for="">Reciever Name</label>
					</div><!-- col -->
					<div class="col-sm-4">			
						<input type="text" name="airmail_receiver_name" id="airmail_receiver_name" class="form-control form-control-sm">
					</div><!-- col -->
					<div class="col-sm-2">
						<label for="">Receiver  Contact No.</label>
					</div><!-- col -->
					<div class="col-sm-4">			
						<input type="number" name="airmail_contact_receiver" id="airmail_contact_receiver" class="form-control form-control-sm">
					</div><!-- col -->
				</div>
					<div class="row form-group">
					<div class="col-sm-2">
						<label for="">Note</label>
					</div><!-- col -->
					<div class="col-sm-4">			
						<textarea name="airmail_receiver_note" id="airmail_receiver_note" class="form-control"></textarea>
					</div><!-- col -->
					
				</div>
		</div><!-- col -->
	</div><!-- mian -->

	<button type="submit" class="btn btn-primary" id="saveData10">Submit</button>
</form>
<?php // } ?>
<div class="" id="show_succes_message" style="display: none;">
	<div class="row">
		<div class="col-12">
			<h2 style="text-align:center;">Thank You</h2>

			 <h1 style="text-align:center;"><div class="checkmark-circle">
  <div class="background"></div>
  <div class="checkmark draw"></div>
</div><h1>
		</div>
	</div>
</div>

<br>

<table class="table table-hover table-sm table-bordered d-none">
	<thead>
		<tr>
			<th>Sr.</th>
			<th>Detail</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody id="airmail_idTable">
	</tbody>
</table>
<div class="modal fade" id="airmail_info_modal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Airmail Companies</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
         <div class="container"  >
         		<table class="table-bordered table-hover table ">
         			<thead>
         				<tr>
         					<th> Company Name</th>
         					<th>Type</th>
         					<th>Weight</th>
         					<th>Charges/Tax</th>
         					<th>Action</th>
         				</tr>
         			</thead>
         			<tbody id="airmail_info_body">
         				
         			</tbody>
         		</table>
         </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      
        </div>
 
      </div>
    </div>
  </div>

