 
 <?php
include_once "includes/header.php";

// include_once "php_action/custom_action2.php";

?>
<script type="text/javascript" src="assets/js/custom2.js"></script>
<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
 <style>
  .modal-header, h4, .close {
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
                 <div class="col-sm-12">
				<div class="card card-box">
					<div class="card-head themebg" align="center"><h4>Create Customer Leads</h4></div>
						<div class="card-body">
							<?php getMessage(@$msg,@$sts); ?>
							<input type="text" value="<?=@$id?>" class="vehicle_idMain d-none" name="vehicle_id">
	<div class="row">
		<div class="col-sm-6">
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
						<label class="" for="customer_whatsapp1">Whatsapp <br><input type="checkbox" id="customer_whatsapp1"  <?=@empty($customer['contact1_whatsapp'])?"":"checked"?> class="getContact" id="customer_whatsapp1"></label>
						<input type="text"   value="<?=@$customer['contact1_viber']?>" name="customer_viber1" class="customer_viber1 form-control d-none">
						<input type="text"   value="<?=@$customer['contact1_whatsapp']?>" name="customer_whatsapp1" class="customer_whatsapp1 form-control d-none">
					</div>
				</div><!-- inner row -->
			</div><!-- form group -->

			
		
			<br/>
			
			
		</div><!-- col -->
		<div class="col-sm-6">
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
						<label class="" for="customer_whatsapp1">Whatsapp <br><input type="checkbox" id="customer_whatsapp2" class="getContact" <?=@empty($customer['contact2_whatsapp'])?"":"checked"?> name="customer_whatsapp2"></label>
						<input type="text"   value="<?=@$customer['contact2_viber']?>" name="customer_viber1" class="customer_viber1 form-control d-none">
						<input type="text"   value="<?=@$customer['contact2_whatsapp']?>" name="customer_whatsapp1" class="customer_whatsapp1 form-control d-none">
					</div>

				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="row form-group">
				<div class="col-sm-8">
		
					<?php if (empty($_REQUEST['customer']) AND $userPrivileges['nav_add']==1 || $fetchedUserRole=="admin"): ?>
				<button  class="btn btn-success float-right" id="saveData" onclick="javascript:"  >Add Customer</button>
			<?php endif ?>
			<?php if (!empty($_REQUEST['customer'])  AND $userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): ?>
				<button  class="btn btn-success float-right" id="saveData" onclick="javascript:"  >Update Customer</button>
			<?php endif ?>
			
			<input type="button" onclick="resetForm()" name="" value="Clear form" class="btn btn-danger float-right">
				</div>
			</div>
		</div>
		
	</div><!-- mian -->
			</form>
		</div>

<hr>

				</div>			
					</div>

							
</div>					
<div  class="card card-box">
	<div  class="card-head themebg"><h4>Customers List</h4></div>
	<div class="card-body">
				<div class="row mt-2">
			<div class="col-12">
				<table class="table example1 text-center">
					<thead>
						<th>Sr.No</th>
						<th>Customer Name</th>
						<th>Bussiness Name</th>
						<th>Contact Info</th>
						<th>Customer Type</th>
						<th>Action</th>
					</thead>
					<tbody>
						<?php $c=0; $q = mysqli_query($dbc,"SELECT * FROM leads_customer ");
								while($customer = mysqli_fetch_assoc($q)): $c++; ?>
						<tr>
							<td><?=$c?></td>
							<td><?=$customer['customer_name']?></td>
							<td><?=$customer['company_name']?></td>
							<td><?=$customer['contact1']?><br>
								<?=$customer['contact2']?><br>
								(<?=$customer['email']?>)
							</td>
							<td><?=$customer['customer_type']?></td>
							<td>
							<?php if ($userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): ?>
							<a title="Edit Lead" href="leads2.php?customer=<?=$customer['leads_cus_id']?>"><i class="fa fa-edit"></i></a> |
							<?php endif; ?>
								 <a title="See More Details" href="details.php?id=<?=$customer['leads_cus_id']?>&type=leads"><i class="fa fa-info" style="font-size: 16px;"></i></a></td>
						</tr>

					<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


</div>
</div>




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
								goTo("leads.php", "example", 'leads2.php?customer='+response.leads_cus_id);
								
								//$("#refreshDiv").load(location.href+" #refreshDiv");
								location.reload();
								//processAjaxData('leads.php?customer='+response.leads_cus_id);
								

	}
});

			//});
}
function resetForm() {
	window.location.assign('leads2.php');

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