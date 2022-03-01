 
 <?php
include_once "includes/header.php";

// include_once "php_action/custom_action2.php";

?>
<script type="text/javascript" src="assets/js/custom2.js"></script>
<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
 <style>
  .modal-header, h4, .close {
    background-color: #5cb85c;
    color:white !important;
    text-align: center;
    font-size: 30px;
  }
  .modal-footer {
    background-color: #f9f9f9;
  }
  </style>
<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Leads Management</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Leads</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Leads Management</li>
                            </ol>
                        </div>
                    </div>
<div class="row">
                 <div class="col-sm-6">
				<div class="panel">
					<div class="panel-heading panel-heading-red" align="center"><h4>Create Auction House</h4></div>
						<div class="panel-body">
							<?php getMessage(@$msg,@$sts); ?>
							<input type="text" value="<?=@$id?>" class="vehicle_idMain d-none" name="vehicle_id">
	<div class="row">
		<div class="col-sm-12">
			<div class="row">
					<div class="col-sm-4">
						<label for="">Existing Customer</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<select class="form-control leadscustomerN uppercase" name="leadscustomerN" id="leadscustomerN" onchange="GetleadsNow(this.value)" >
							<option value="">~~SELECT Customer~~</option>
							<?php
								$q = mysqli_query($dbc,"SELECT * FROM leads_customer ");
								while($c = mysqli_fetch_assoc($q)):
							?>
								<option <?=@($_REQUEST['customer']==$c['leads_cus_id'])?"selected":""?> value="<?=$c['leads_cus_id']?>"><?=$c['customer_name']?></option>
							<?php
									endwhile;
							?>
							
						</select>
					</div><!-- col -->
				</div><!-- inner row -->
				<hr/>

<?php 
						@$customer=fetchRecord($dbc,"leads_customer","leads_cus_id",$_REQUEST['customer']);
				 ?>
		<form action="php_action/custom_action2.php" method="POST" role="form" id="formDatafinal">		
			<div class="form-group row">
				<input type="hidden" name="lead_id" value="<?=@empty($_REQUEST['customer'])?'':$customer['leads_cus_id']?>" >
				<div class="col-sm-4">
				<label for="">Assign to</label>
							</div>
				<!-- <input list="vehicle_door1" name="vehicle_door" id="vehicle_door" required="required" class="form-control"> -->
				<div class="col-sm-8">
				<select list="assign_to" name="assign_to" id="assign_to" required="required" class="form-control">
					<option value="">~~SELECT~~</option>
					<?php

					$q = get($dbc,"users ");

							while($r = mysqli_fetch_assoc($q)): ?>
						<option <?=@($customer['assign_to']==$r['user_id'])?"selected":""?> value="<?=$r['user_id']?>"><?=$r['username']?></option>
					<?php endwhile ?>
				</select>	

				<input type="hidden" name="leads" id="leads" value="leads">
				</div>		
			</div><!-- form group -->
			<div class="form-group customer_company">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Company Name</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<input type="text" value="<?=@$customer['company_name']?>" name="customer_company" id="customer_company" class="form-control form-control-sm">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Customer Name</label>
					</div><!-- col -->
					<div class="col-sm-8">	
					<div class="input-group">
      <span class="input-group-addon <?=@empty($_REQUEST['customer'])?"":"d-none"?>">
      <select class="" name="addon">
      	 <?php if (!empty($_REQUEST['customer'])): ?>
      	 	<option value="">Select</option>
      	 <?php endif ?>
      <option value="Mr ">Mr.</option>
      <option value="Mrs ">Mrs.</option>
      </select>
      </span>
     <input type="text" value="<?=@$customer['customer_name']?>" name="customer_name" id="customer_name" class="form-control form-control-sm">
     <input type="text"   value="<?=@$customer['customer_id']?>" name="customer_id" id="customer_id" class="d-none">
    </div>


						
						
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Country</label>
					</div><!-- col -->
					<div class="col-sm-8">
						<?php if (!empty($_REQUEST['customer'])): ?>
							<input type="text" value="<?=@$customer['country']?>" name="customer_country" id="customer_country" class="form-control customer_country">
						<?php endif ?>
						
						<?=countrySelector(@$customer['country'], "customer_country", "customer_country", "form-control customer_country")?>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">City</label>
					</div><!-- col -->
					<div class="col-sm-8">					
						<input type="text" value="<?=@$customer['city']?>" name="customer_city" id="city" class="form-control form-control-sm">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">STREET / ROAD (Optional)</label>
					</div><!-- col -->
					<div class="col-sm-8">					
						<input type="text"   value="<?=@$customer['street']?>" name="customer_street" id="customer_street" class="form-control form-control-sm">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">ZIP/POSTAL CODE</label>
					</div><!-- col -->
					<div class="col-sm-8">					
						<input type="text"   value="<?=@$customer['zip']?>" name="customer_zip_code" id="customer_zip_code" class="form-control form-control-sm">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Contact #1</label>
					</div><!-- col -->
					<div class="col-sm-4">			
						<input type="number"   value="<?=@$customer['contact1']?>" name="customer_landline" id="customer_contact1" class="customer_landline form-control form-control-sm customer_viber1_contact customer_whatsapp1_contact">
	          	       <!--  <input type="text" class="d-none" value="customer" id="customer_role" name="customer_role"> -->
					</div><!-- col -->
					<div class="col-sm-4">
						<label for="customer_viber1">Viber ID <br><input  type="checkbox"    id="customer_viber1" <?=@empty($customer['contact1_viber'])?"":"checked"?> class="getContact" name="customer_viber1"></label>
						<label class="ml-5" for="customer_whatsapp1">Whatsapp <br><input type="checkbox" id="customer_whatsapp1"  <?=@empty($customer['contact1_whatsapp'])?"":"checked"?> class="getContact" id="customer_whatsapp1"></label>
						<input type="text"   value="<?=@$customer['contact1_viber']?>" name="customer_viber1" class="customer_viber1 form-control d-none">
						<input type="text"   value="<?=@$customer['contact1_whatsapp']?>" name="customer_whatsapp1" class="customer_whatsapp1 form-control d-none">
					</div>
				</div><!-- inner row -->
			</div><!-- form group -->
			
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Contact #2</label>
					</div><!-- col -->
					<div class="col-sm-4">			
						<input type="number"   value="<?=@$customer['contact2']?>" name="customer_phone2" id="customer_phone" class="customer_phone1 form-control form-control-sm customer_viber1_contact customer_whatsapp1_contact">
	          	        <input type="text" class="d-none" value="customer" id="customer_role" name="customer_role">
					</div><!-- col -->
					<div class="col-sm-4">
						<label for="customer_viber1">Viber ID <br><input type="checkbox"    id="customer_viber2" class="getContact" <?=@empty($customer['contact2_viber'])?"":"checked"?> name="customer_viber2"></label>
						<label class="ml-5" for="customer_whatsapp1">Whatsapp <br><input type="checkbox" id="customer_whatsapp2" class="getContact" <?=@empty($customer['contact2_whatsapp'])?"":"checked"?> name="customer_whatsapp2"></label>
						<input type="text"   value="<?=@$customer['contact2_viber']?>" name="customer_viber1" class="customer_viber1 form-control d-none">
						<input type="text"   value="<?=@$customer['contact2_whatsapp']?>" name="customer_whatsapp1" class="customer_whatsapp1 form-control d-none">
					</div>
				</div><!-- inner row -->
			</div><!-- form group -->
			
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Email</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<input type="email"  value="<?=@$customer['email']?>"  name="customer_email" id="customer_email" class="form-control form-control-sm">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Email 2</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<input type="email"   value="<?=@$customer['email2']?>" name="customer_email2" id="customer_email2" class="form-control form-control-sm">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group ">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Designation Port</label>
					</div><!-- col -->
					<div class="col-sm-8">		
					<select name="customer_designation" id="customer_designation" class="form-control form-control-sm">
						<option>Select Destination</option>
						<?php $q=get($dbc,"country_regulation");
							while ($port=mysqli_fetch_assoc($q)) {
							
						 ?>
						 <option <?=@($customer['designation']==$port['country_regulation_destination_port'])?"selected":""?> value="<?=$port['country_regulation_destination_port']?>"><?=$port['country_regulation_destination_port']?></option>
						<?php } ?>
					</select>			
						<!-- <input type="text"   value="<?=@$customer['designation']?>" value="0" name="customer_designation" id="customer_designation" class="form-control form-control-sm"> -->
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Skype ID</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<input type="text"   value="<?=@$customer['skype']?>" name="customer_skype" id="customer_skype" class="form-control form-control-sm">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Website(optional)</label>
					</div><!-- col -->
					<div class="col-sm-8">					
						<input type="text" value="<?=@$customer['website']?>" name="website" id="website" class="form-control form-control-sm">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Customer Type</label>
					</div><!-- col -->
					<div class="col-sm-8">					
						<select class="form-control" name="customer_type" id="customer_type" required>
							<option value="">~~SELECT~~</option>
							<option <?=@($customer['customer_type']=="customer")?"selected":""?> value="customer">Customer</option>
							<option <?=@($customer['customer_type']=="dealer")?"selected":""?> value="dealer">Dealer</option>
							<option <?=@($customer['customer_type']=="other")?"selected":""?> value="other">Others</option>
						</select>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Priority </label>
					</div><!-- col -->
					<div class="col-sm-8">					
						<select class="form-control" name="priority" id="priority" required>
							<option <?=@($customer['priority']=="")?"selected":""?> value="">~~SELECT~~</option>
							<option <?=@($customer['priority']=="high")?"selected":""?> value="high">High</option>
							<option <?=@($customer['priority']=="medium")?"selected":""?> value="medium">Medium</option>
							<option  <?=@($customer['priority']=="average")?"selected":""?>  value="average">Average</option>
						</select>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Status </label>
					</div><!-- col -->
					<div class="col-sm-8">					
						<select class="form-control" name="status" id="status">
							
							<option  <?=@($customer['status']=='active')?"selected":""?> value="active">Active</option>
							<option  <?=@($customer['status']=='deactive')?"selected":""?> value="deactive">De active</option>
							
						</select>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<br/>
			<?php if (empty($_REQUEST['customer'])): ?>
				<button  class="btn btn-success float-right" id="saveData" onclick="javascript:"  >Add Customer</button>
			<?php endif ?>
			<?php if (!empty($_REQUEST['customer'])): ?>
				<button  class="btn btn-success float-right" id="saveData" onclick="javascript:"  >Update Customer</button>
			<?php endif ?>
			
			<input type="button" onclick="resetForm()" name="" value="Clear form" class="btn btn-danger">
			
		</div><!-- col -->
		
	</div><!-- mian -->
			</form>
		</div>
				</div>			
					</div>

					<div class="col-sm-6">
				<div class="panel">
					<div class="panel-heading panel-heading-blue" align="center"><h4>Show Leads  </h4></div>
						<div class="panel-body">
							<?php getMessage(@$msg,@$sts); ?>
	<div class="row">
		<div class="col-sm-3">
			Leads For
		</div>
		<div class="col-sm-6">
			<input type="hidden"  name="getleadscustomerID" id="getleadscustomerID" value="<?=@$_REQUEST['customer']?>" >
			<input type="text" readonly name="getleadscustomer" value="<?=@$customer['customer_name']?>" id="getleadscustomer" class="form-control uppercase">

		</div>
		<div class="col-sm-2">
			<button class="btn btn-info " id="myBtn"><i class="fa fa-add"></i>Add INQUIRY</button>
		</div>
	</div><hr/>


<!-- Tabs satrt -->

<div class="refreshNowthis" id="refreshNowthis" >
 <ul class="nav nav-tabs" role="tablist">
<?php
  $customer = @$_GET['customer'];
  $leasGET =mysqli_query($dbc,"SELECT * FROM leads WHERE customer_id = '$customer'");
  $active = '';
  $nn = 1;
  while($r = mysqli_fetch_assoc($leasGET)):

?>
	
	 <li class="nav-item">
      <a class="nav-link <?=$active?>" data-toggle="tab" href="#home<?=$nn?>">Inquiry <?=$nn?></a>
    </li>
  <?php
  $nn ++;
  $active = '';
  endwhile;
  ?>  
     
  </ul>


<?php
  $customer = @$_GET['customer'];
  $leasGET =mysqli_query($dbc,"SELECT * FROM leads WHERE customer_id = '$customer'");
  $active = '';

  $n = 1;
  while($r = mysqli_fetch_assoc($leasGET)):

  	$users = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM users WHERE user_id = '$r[user_id]'"));
  	$maker = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM maker WHERE maker_id = '$r[maker_id]'"));
  	$brand = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM brands WHERE brand_id = '$r[brand_id]'"));



?>
  <div class="tab-content">
  	 <div id="home<?=$n?>" class="container tab-pane fade  <?=$active?>"><br>
    
      <center><h3>Inquiry <?=$n?> <br/> Added By: <?=$users['username']?>   </h3></center>
     
            <div class="row">
            	<div class="col-sm-6">
            		<span>
            			Maker : <?=$maker['maker_name']?> <br/>
            			Years :  
            			<?php
            			$year = json_decode($r['year']);
            				foreach ($year as $value) {
							  echo $value;
							  echo ",";
							}
            			?>
            			 <br/>
            			Drive : <?=$r['drive']?> <br/>
            			transmission  : <?=$r['transmission']?> <br/>
            			Seats : <?=$r['seats']?> <br/>
            			Color Choice : 
            			<?php
            			$color = json_decode($r['color']);
            				foreach ($color as $value) {
							  echo $value;
							  echo ",";
							}
            			?>
            			<br/>
					</span>            			
            	</div>
            	<div class="col-sm-6">
            		<span>
            			Brand : <?=$brand['brand_name']?> <br/>
            			Chassis Code : <?=$r['chassis_code']?> <br/>
            			Engine CC : <?=$r['engine_cc']?> <br/>
            			Fuel  : <?=$r['fuel']?> <br/>
            			Doors : <?=$r['doors']?> <br/>
            			Feature Required : 
            			<?php
            			$features = json_decode($r['features']);
            				foreach ($features as $value) {
							  echo $value;
							  echo ",";
							}
            			?>
            			<br/>
					</span>   
            	</div>
            	Nuration /Hint /Special Note: 

            </div>
    </div>
    
  </div>
<?php
  $n ++;
  $active = '';
  endwhile;
  ?>  
</div>
  <!-- tabs end -->
						</div>
				</div>
				</div>			
</div>					



</div>
</div>




<!-- Modal start -->

 <!-- Modal -->
  <div class="modal  fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <h4><span class="glyphicon glyphicon-lock"></span> Leads</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form role="form" action="php_action/custom_action2.php" id="saveleads">
          	<input type="text" readonly required value="<?=@$_REQUEST['customer']?>" name="getleadscustomerID2" id="getleadscustomerID2" class="form-control">
          	<div class="row">
          		<div class="col-sm-6">
          			 <div class="form-group">
				<label for="">Maker.</label>			
				<input type="hidden" name="saveleads">
				<select name="vehicle_maker" onchange="loadBrands(this.value)" id="vehicle_maker" class="form-control abcCustomNew" required="required">
					<option value="">~~SELECT~~</option>
					<?php $q = get($dbc,"maker WHERE maker_sts = '1'");
					while($r = mysqli_fetch_assoc($q)): ?>
						<option value="<?=$r['maker_id']?>"><?=$r['maker_name']?></option>
							<?php endwhile ?>
				</select>
			</div><!-- form group -->

			<div class="form-group">
				<label for=""> Year.</label>
				 <select id="dates-field2" class="multiselect-ui styling form-control" multiple="multiple" name="years[]" >
           				 <?php
								$date = date('Y');
								for ($i = $date; $i >= 1900; $i--) {?>
									<option value="<?=$i?>"><?=$i?></option>
								<?php
									} 
				     			?>
       					 </select>		
				<!-- <input list="vehicle_reg_month1" name="vehicle_reg_month" id="vehicle_reg_month" class="form-control" required="required" readonly> -->
				
			</div><!-- form group -->
			<div class="form-group">
				<label for="">Drive</label>
				<!-- <input list="vehicle_drive1" name="vehicle_drive" id="vehicle_drive" class="form-control" required="required"> -->
				
				<select list="vehicle_drive1" name="vehicle_drive" id="vehicle_drive" class="form-control" required="required">
					<option value="">~~SELECT~~</option>
					<?php $q = get($dbc,"drive WHERE drive_sts = '1'");
							while($r = mysqli_fetch_assoc($q)): ?>
						<option <?=@(strtolower($r['drive_name'])==strtolower($stock['vehicle_drive']))?"selected":""?> value="<?=$r['drive_name']?>"><?=$r['drive_name']?></option>
					<?php endwhile ?>
				</select>
				
						
			</div><!-- form group -->
			<div class="form-group">
				<label for="">Transmission</label>
				<!-- <input list="vehicle_transmission1" required="required" name="vehicle_transmission" id="vehicle_transmission" class="form-control"> -->
				<select list="vehicle_transmission1" required="required" name="vehicle_transmission" id="vehicle_transmission" class="form-control">
					<option value="">~~SELECT~~</option>
					<?php $q = get($dbc,"transmission WHERE transmission_sts = '1'");
					while($r = mysqli_fetch_assoc($q)): ?>
						<option <?=@(ucwords($r['transmission_name'])==ucwords($stock['vehicle_transmission']))?"selected":""?> value="<?=$r['transmission_name']?>"><?=$r['transmission_name']?></option>
							<?php endwhile ?>
				</select>			
			</div><!-- form group -->
			<div class="form-group">
				<label for="">Seats</label>
				<!-- <input list="vehicle_seat1" name="vehicle_seat" id="vehicle_seat" class="form-control"> -->
				<select  list="vehicle_seat1" name="vehicle_seat" id="vehicle_seat" class="form-control">
					<option value="">~~SELECT~~</option>
					<?php $q = get($dbc,"seats WHERE seats_sts = '1'");
					while($r = mysqli_fetch_assoc($q)): ?>
						<option value="<?=$r['seats_name']?>"><?=$r['seats_name']?></option>
							<?php endwhile ?>
				</select>			
			</div><!-- form group -->
			<div class="form-group">
				<label for="">Color Name</label>


				<!-- <select list="vehicle_color_name1" autocomplete="off" onchange="loadcolorCode(this.value)" name="vehicle_color_name" id="vehicle_color_name" required="required" class="form-control"> -->
					 <select id="dates-field2" class="multiselect-ui styling form-control" multiple="multiple" name="vehicle_color_name[]" id="vehicle_color_name" required="required">
					<option value="">~~SELECT~~</option>
						<?php $q = get($dbc,"color_code WHERE color_code_sts = '1'");
						while($r = mysqli_fetch_assoc($q)): ?>
					<option value="<?=$r['color_name']?>"><?=$r['color_name']?></option>
					<?php endwhile ?>
				</select>			
			</div><!-- form group -->

			<div class="form-group">
				<label for="">Special Inquiry Note</label>
				<textarea  rows="4" class="form-control" name="note"  ></textarea>

          	</div>



          		</div>

          		<div class="col-sm-6">
          			<div class="form-group">
				<label for="">Brand.</label>			
				<select name="vehicle_brand" onchange="loadChassis(this.value)" id="vehicle_brand" class="form-control fuckJS" required="required">
					<option class="fuckJS" value="">~~SELECT~~</option>
					<option value="">~~SELECT~~</option>
					<?php $q = get($dbc,"brands WHERE brand_status = '1'");
					while($r = mysqli_fetch_assoc($q)): ?>
						<option value="<?=$r['brand_id']?>"><?=$r['brand_name']?></option>
							<?php endwhile ?>
				</select>
			</div><!-- form group -->

			<div class="form-group">
				<label for="">Chassis Code</label>			
				<!-- <input type="text"  class="form-control form-control-sm"> -->
				<select name="vehicle_chassis_code" id="vehicle_chassis_code" class="form-control" required="required" style="text-transform: uppercase ">
					<option value="">~~SELECT~~</option>
					<?php $q = get($dbc,"models WHERE model_sts = '1'");
					while($r = mysqli_fetch_assoc($q)): ?>
						<option value="<?=$r['model_id']?>" style="text-transform: uppercase!important;"><?=$r['model_name']?></option>
							<?php endwhile ?>
				</select>
			</div><!-- form group -->

			<div class="form-group">
				<label for="">Engine CC</label>
				<!-- <input list="vehicle_cc1" name="vehicle_cc" id="vehicle_cc" class="form-control" required="required"> -->
				<select list="vehicle_cc1" name="vehicle_cc" id="vehicle_cc" class="form-control" required="required">
					<option value="">~~SELECT~~</option>
					<?php $q = get($dbc,"cc WHERE cc_sts = '1'");
					while($r = mysqli_fetch_assoc($q)): ?>
						<option value="<?=$r['cc_name']?>"><?=$r['cc_name']?></option>
					<?php endwhile ?>
				</select>			
			</div><!-- form group -->
			<div class="form-group">
				<label for="">Fuel</label>
				<!-- <input list="vehicle_fuel1" name="vehicle_fuel" id="vehicle_fuel" class="form-control" required="required"> -->
				<select  list="vehicle_fuel1" name="vehicle_fuel" id="vehicle_fuel" class="form-control" required="required">
					<option value="">~~SELECT~~</option>
					<?php  $q = get($dbc,"fuel WHERE fuel_sts = '1'");
					while($r = mysqli_fetch_assoc($q)): ?>
						<option <?=@(strtolower($r['fuel_name'])==strtolower($stock['vehicle_fuel']))?"selected":""?> value="<?=$r['fuel_name']?>"><?=$r['fuel_name']?></option>
					<?php endwhile ?>
				</select>			
			</div><!-- form group -->
			<div class="form-group">
				<label for="">Doors</label>
				<!-- <input list="vehicle_door1" name="vehicle_door" id="vehicle_door" required="required" class="form-control"> -->
				<select list="vehicle_door1" name="vehicle_door" id="vehicle_door" required="required" class="form-control">
					<option value="">~~SELECT~~</option>
					<?php $q = get($dbc,"doors WHERE doors_sts = '1'");
							while($r = mysqli_fetch_assoc($q)): ?>
						<option value="<?=$r['doors_name']?>"><?=$r['doors_name']?></option>
					<?php endwhile ?>
				</select>			
			</div><!-- form group -->


			<div class="form-group">
				<label for="">Features </label>
				<!-- <input list="vehicle_door1" name="vehicle_door" id="vehicle_door" required="required" class="form-control"> -->
				<select id="dates-field2" class="multiselect-ui styling form-control" list="vehicle_feature" name="vehicle_feature[]" id="vehicle_feature"  >
					<option value="">~~SELECT~~</option>
					<?php $q = get($dbc,"vehicle_feature WHERE vehicle_feature_sts = '1'");
							while($r = mysqli_fetch_assoc($q)): ?>
						<option value="<?=$r['vehicle_feature_id']?>"><?=$r['vehicle_feature_name']?>(<?=$r['vehicle_feature_category']?>)</option>
					<?php endwhile ?>
				</select>			
			</div><!-- form group -->

			<div class="form-group">
				<label for="">Next Follow up Date </label>
				<input type="date" name="nextdate" id="nextdate"  class="form-control">
							
			</div><!-- form group -->







          		</div>

          	
            
              <button type="submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Save Leads</button>
<!-- Delete -->


<!-- deler donme -->

          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
         
        </div>
      </div>
      
    </div>
  </div>


<!-- modal end -->
<?php
include_once "includes/footer.php";

?>

<script>
$(document).ready(function(){
  $("#myBtn").click(function(){
  	//alert('abc');
    $("#myModal").modal();
  });
  });//main

$('#formDatafinal').submit(function(){
	
	event.preventDefault();
	 var form = $('#formDatafinal');
	 //alert(form);
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function() {
            	//alert('abcd');
                $('#saveData').attr("disabled","disabled");
                 $('#saveData').text("Loading...");
                $(".loaderAjax").show(); 
                refereshdocs();
            },
            success:function (response) {

            		var idNow = parseInt(response);
            		//alert(idNow);
            		if(idNow != null){
            		GetleadsNow(idNow);
            		 
}
                        swal({
                          title: 'added',
                          text: 'Leads added successfully',
                          type : 'success',
                          icon: 'success',
                          timer: 2500,
                          buttons: false,
                          showCancelButton: false,
                          showConfirmButton: false
                        }); 
                       //GetleadsNow(id);
                      
            	//alert(msg);
                $(".loaderAjax").hide(); 
                $('#saveData').text("Save");
                $('#formData').each(function(){
                    this.reset();
                });    
                $('#saveData').removeAttr("disabled");
                $('#formData').css("opacity","");   
                $('.msg').text(msg).addClass("alert alert-success").fadeIn(6000).fadeOut(4000);
               
            }
        });//ajax call
   
});



$('#saveleads').submit(function(){
	
	event.preventDefault();
	 var form = $('#saveleads');
	 //alert(form);
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function() {
            	//alert('abcd');
                $('#saveData').attr("disabled","disabled");
                 $('#saveData').text("Loading...");
                $(".loaderAjax").show(); 
                refereshdocs();
            },
            success:function (response) {
            		
            		 //$("#myModal").hide();
            		 $('#myModal').modal('hide');
					$('#myModal').on('hidden.bs.modal', function () {
					    _this.render();
					})
            		var idNow = parseInt(response);
            		//alert(idNow);
            		if(idNow != null){
            		GetleadsNow(idNow);
            		 
}
                        swal({
                          title: 'added',
                          text: 'Leads added successfully',
                          type : 'success',
                          icon: 'success',
                          timer: 2500,
                          buttons: false,
                          showCancelButton: false,
                          showConfirmButton: false
                        }); 
                       //GetleadsNow(id);
                      
            	//alert(msg);
                $(".loaderAjax").hide(); 
                $('#saveData').text("Save");
                $('#formData').each(function(){
                    this.reset();
                });    
                $('#saveData').removeAttr("disabled");
                $('#formData').css("opacity","");   
                $('.msg').text(msg).addClass("alert alert-success").fadeIn(6000).fadeOut(4000);
                
               
            }
        });//ajax call
   
});






//$(".leadscustomerN").change(function(){

	function GetleadsNow(id){

			//var leadscustomer = $('#leadscustomerN').val();
			var leadscustomer = id;
		//alert(leadscustomer);

				$.ajax({
							url: 'php_action/custom_action2.php',
							type: 'post',
							data: {
								leadscustomer:leadscustomer
							},
							dataType: 'json',
							 
							success:function(response) {

								$("#getleadscustomerID").val(response.leads_cus_id);
								$("#getleadscustomerID2").val(response.leads_cus_id);
								$("#getleadscustomer").val(response.customer_name);
								goTo("leads.php", "example", 'leads.php?customer='+response.leads_cus_id);
								
								//$("#refreshDiv").load(location.href+" #refreshDiv");
								location.reload();
								//processAjaxData('leads.php?customer='+response.leads_cus_id);
								

	}
});

			//});
}
function resetForm() {
	window.location.assign('leads.php');

	}
function goTo(page, title, url) {
  if ("undefined" !== typeof history.pushState) {
    history.pushState({page: page}, title, url);
  $("#refreshNowthis").load(location.href + " #refreshNowthis > *");
  } else {
    window.location.assign(url);
  }
}

// goTo("another page", "example", 'example.html');

</script>



<script type="text/javascript">
$(function() {
    $('.multiselect-ui').multiselect({
        includeSelectAllOption: true
    });
});
</script>
<style type="text/css">
	span.multiselect-native-select {
	position: relative
}
span.multiselect-native-select select {
	border: 0!important;
	clip: rect(0 0 0 0)!important;
	height: 1px!important;
	margin: -1px -1px -1px -3px!important;
	overflow: hidden!important;
	padding: 0!important;
	position: absolute!important;
	width: 1px!important;
	left: 50%;
	top: 30px
}
.multiselect-container {
	position: absolute;
	list-style-type: none;
	margin: 0;
	padding: 0
}
.multiselect-container .input-group {
	margin: 5px
}
.multiselect-container>li {
	padding: 0
}
.multiselect-container>li>a.multiselect-all label {
	font-weight: 700
}
.multiselect-container>li.multiselect-group label {
	margin: 0;
	padding: 3px 20px 3px 20px;
	height: 100%;
	font-weight: 700
}
.multiselect-container>li.multiselect-group-clickable label {
	cursor: pointer
}
.multiselect-container>li>a {
	padding: 0
}
.multiselect-container>li>a>label {
	margin: 0;
	height: 100%;
	cursor: pointer;
	font-weight: 400;
	padding: 3px 0 3px 30px
}
.multiselect-container>li>a>label.radio, .multiselect-container>li>a>label.checkbox {
	margin: 0
}
.multiselect-container>li>a>label>input[type=checkbox] {
	margin-bottom: 5px
}
.btn-group>.btn-group:nth-child(2)>.multiselect.btn {
	border-top-left-radius: 4px;
	border-bottom-left-radius: 4px
}
.form-inline .multiselect-container label.checkbox, .form-inline .multiselect-container label.radio {
	padding: 3px 20px 3px 40px
}
.form-inline .multiselect-container li a label.checkbox input[type=checkbox], .form-inline .multiselect-container li a label.radio input[type=radio] {
	margin-left: -20px;
	margin-right: 0
}

</style>
<?php
include_once 'multiselectjs.php';
?>