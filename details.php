 <?php 
include_once "includes/header.php";
include_once "inc/code.php";


?>
<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
	           <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Details</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Details</li>
                            </ol>
                        </div>
                    </div>
<?php if ($_REQUEST['type']=='customer') {
	  $r = fetchRecord($dbc, "customers", "customer_id ", $_REQUEST['id']);

 ?>
                <div class="card ">
					<div class="card-header">
						<h4 class="text-center">
							Customer Details
						</h4>
					</div>
					<div class="card-body">
							<table class="table table-bordered mt-4">
					<tr>
						<th>Company Name</th><td><?=$r['customer_company']?></td>
						<th>Customer Name</th><td><?=$r['customer_name']?></td>
						
					</tr>
					<tr>
						<th>Contact Person</th><td><?=@$r['customer_contact_person']?></td>
						<th>Country</th><td><?=$r['customer_country']?></td>
						
					</tr>
					<tr>
						<th>STATE / PREFECTURE</th><td><?=$r['customer_state']?></td>
						<th>City</th><td><?=$r['customer_city']?></td>
					</tr>
					<tr>
						<th>ZIP/POSTAL CODE</th><td><?=$r['customer_zip_code']?></td>
						<th>FLOOR / BUILDING Name</th><td><?=$r['customer_floor']?></td>
						
					</tr>
					<tr>
						<th>SUBURB</th><td><?=$r['customer_suburb']?></td>
						<th>STREET / ROAD (Optional)</th><td><?=$r['customer_street']?></td>
						
						
					</tr>
					<tr>
						<th >Address</th><td colspan="3"><?=$r['customer_address']?></td>
					
						
					</tr>
					<tr>
						<th>Landline No</th><td><?=$r['customer_landline']?></td>
						<th>FAX NO</th><td><?=$r['customer_fax']?></td>
						
					</tr>
					<tr>
						<th>Contact #1</th><td><?=$r['customer_phone']?>
							 <?php if ($r['customer_viber']!=""): ?>
                                          	<a href="https://viber.me/<?=$r['customer_viber']?>/" target="_blank">
                                            <img src="https://cdn4.iconfinder.com/data/icons/logos-and-brands/512/359_Viber_logo-512.png" style="width: 25px">
                                             </a>
                               <?php endif ?>
                               <?php if ($r['customer_whatsapp']!=""): ?>
							 	<a href="https://api.whatsapp.com/send?phone=<?=$r['customer_whatsapp']?>&text=Hi..!." target="_blank" class="mt-4" ><i class="fa fa-whatsapp " style="font-size: 25px;color: green;"></i></a>
							 <?php endif ?> 
						</td>
							<th>Contact #2</th><td><?=$r['customer_phone2']?>
							<?php if ($r['customer_viber2']!=""): ?>
                                          	<a href="https://viber.me/<?=$r['customer_viber2']?>/" target="_blank">
                                            <img src="https://cdn4.iconfinder.com/data/icons/logos-and-brands/512/359_Viber_logo-512.png" style="width: 25px">
                                             </a>
                               <?php endif ?>
                               <?php if ($r['customer_whatsapp2']!=""): ?>
							 	<a href="https://api.whatsapp.com/send?phone=<?=$r['customer_whatsapp2']?>&text=Hi..!." target="_blank" class="mt-4" ><i class="fa fa-whatsapp " style="font-size: 25px;color: green;"></i></a>
							 <?php endif ?> 

						</td>

						

						
						
					</tr>
					<tr>
						<th>Email</th><td><a href="mailto:<?=$r['customer_email']?>"><?=$r['customer_email']?></a></td>
						<th>Email 2</th><td><a href="mailto:<?=$r['customer_email2']?>"><?=$r['customer_email2']?></a></td>
						
						
						
					</tr>
					<tr><th>Skype ID</th><td><?=$r['customer_skype']?></td>
						<th>Website (Optional)</th><td><?=@$r['customer_web']?></td>
						
					<tr>
		
											<th>Customer Type</th><td><?=$r['customer_type']?></td>
						
						<th>Destination Port</th><td colspan="5"><?=$r['customer_designation']?></td>
					</tr>
					<tr>
							<th >Note</th><td colspan="3"><?=@$r['person_note']?></td>
					</tr>
					
				</table>
					</div>
				</div>
<?php } ?>
<!-- end of customer card -->
<?php if ($_REQUEST['type']=='bank') {
	  $r = fetchRecord($dbc, "customers", "customer_id ", $_REQUEST['id']);

 ?>
                <div class="card ">
					<div class="card-header">
						<h4 class="text-center">
							Bank Details
						</h4>
					</div>
					<div class="card-body">
							<table class="table table-bordered mt-4">
					<tr>
						<th>Name of Bank</th><td><?=@$r['customer_company']?></td>
						<th>Beneficiary Name</th><td><?=$r['customer_email']?></td>
						
						
					</tr>
					
					<tr>
						<th>Branch Name</th><td><?=$r['customer_city']?></td>
						<th>Account No</th><td><?=$r['customer_name']?></td>
						
						
						
						
					</tr>
					<tr>
						<th>Swift Code</th><td ><?=$r['customer_contact_person']?></td>
						
						<th>Acceptable Currency</th><td><?=$r['customer_country']?></td>
					</tr>
					<tr>
						<th>Bank Memo</th><td><?=$r['customer_email2']?></td>
						<th >Address</th><td colspan="3"><?=$r['customer_address']?></td>
						
					</tr>

					
					
				</table>
					</div>
				</div>
<?php } ?>
<!-- end of customer card -->
<!-- start of consif card -->
<?php if ($_REQUEST['type']=='consignee' OR $_REQUEST['type']=='notify_party' OR $_REQUEST['type']=='airmail_consignee') {
	  $r = fetchRecord($dbc, "consignee", "consignee_id ", $_REQUEST['id']);
	    $customer=fetchRecord($dbc,"customers","customer_id",$r['customer_id']);
	    //$desti=fetchRecord($dbc,"country_regulation","country_regulation_id",$r['consignee_dest_port']);

 ?>
   <div class="card ">
					<div class="card-header">
						<h4 class="text-center">
							<?php if ($_REQUEST['type']=="airmail_consignee") {
								echo "Airmail Consignee";
							}elseif ($_REQUEST['type']=="consignee") {
								echo "Consignee Details";
							}else{
								echo "Notify Party Details";
							} ?>
						</h4>
					</div>
					<div class="card-body">
							<table class="table table-bordered mt-4">
					<tr>
						<th>Name</th><td><?=$r['consignee_name']?></td>
						<th>Customer Name</th><td><?=$customer['customer_name']?></td>
						
					</tr>
					<tr>
						<th>Contact Person</th><td><?=@$r['consignee_contact_person']?></td>
						<th>Country</th><td><?=$r['consignee_country']?></td>
						
					</tr>
					<tr>
						<th>STATE / PREFECTURE</th><td><?=$r['consignee_state']?></td>
						<th>City</th><td><?=$r['consignee_city']?></td>
					</tr>
					<tr>
						<th>ZIP/POSTAL CODE</th><td><?=$r['consignee_zip']?></td>
						<th>FLOOR / BUILDING Name</th><td><?=$r['consignee_floor']?></td>
						
					</tr>
					<tr>
						<th>SUBURB</th><td><?=$r['consignee_suburb']?></td>
						<th>STREET / ROAD (Optional)</th><td><?=$r['consignee_street']?></td>
						
						
					</tr>
					<tr>
						<th >Address</th><td colspan="3"><?=$r['consignee_address']?></td>
					</tr>
					<tr>
						<th>Landline No</th><td><?=$r['consignee_landline']?></td>
						<th>Mobile No.</th><td><?=$r['consignee_mobile']?></td>
						
					</tr>
					<tr>
						<th>FAX NO</th><td><?=$r['consignee_fax']?></td>
						<th>Email</th><td>
							<a href="mailto:<?=$r['consignee_email']?>"><?=$r['consignee_email']?></a>
						</td>
						
						
					</tr>
					<tr>
						<th>Type</th><td><?=$r['consignee_type']?></td>
						<th>Website (Optional)</th><td><?=@$r['consignee_website']?></td>
					</tr>
					<tr>
						
						<th>DESTINATION PORT</th><td ><?=$r['consignee_dest_port']?></td>
						<th>FINAL DESTINATION</th><td ><?=$r['consignee_final_dest']?></td>
					</tr>

					
					
				</table>
					</div>
				</div>
<?php } ?>
<!-- end  of consif card -->
<?php if ($_REQUEST['type']=='leads') {
	  $r = fetchRecord($dbc, "leads_customer", "leads_cus_id  ", $_REQUEST['id']);
	  $user = fetchRecord($dbc, "users", "user_id  ", $r['user_id']);

$assign = fetchRecord($dbc, "users", "user_id ", $r['assign_to']);


 ?>
                <div class="card ">
					<div class="card-header">
						<h4 class="text-center">
						Lead's	Customer 						</h4>
					</div>
					<div class="card-body">
							<table class="table table-bordered mt-4">
					<tr>
						<th>Company Name</th><td><?=$r['company_name']?></td>
						<th>Customer Name</th><td><?=$r['customer_name']?></td>
						<th>Customer type</th><td><?=@$r['customer_type']?></td>
					</tr>
					
					<tr>
						<th>Country</th><td><?=$r['country']?></td>
						<th>City</th><td><?=$r['city']?></td>
						<th>Street</th><td><?=$r['street']?></td>
					</tr>
					<tr>
						<th>ZIP/POSTAL CODE</th><td><?=$r['zip']?></td>
						<th>Contact No.</th><td><?=$r['contact1']?>

							<?php if ($r['contact1_whatsapp']=="on"): ?>
							 	<a href="https://api.whatsapp.com/send?phone=<?=$r['contact1_whatsapp']?>&text=Hi..!." target="_blank"><i class="fa fa-whatsapp" style="font-size: 25px;color: green;"></i></a>
							 <?php endif ?> 
                                          <?php if ($r['contact1_viber']=="on"): ?>
                                          	<a href="https://viber.me/<?=$r['contact1_viber']?>/" target="_blank">
                                            <img src="https://cdn4.iconfinder.com/data/icons/logos-and-brands/512/359_Viber_logo-512.png" style="width: 25px">
                                             </a>
                                          <?php endif ?>

						</td>
						<th>Contact No.2</th><td><?=$r['contact2']?>
							<?php if ($r['contact2_whatsapp']=="on"): ?>
							 	<a href="https://api.whatsapp.com/send?phone=<?=$r['contact2_whatsapp']?>&text=Hi..!." target="_blank" class="mt-4" ><i class="fa fa-whatsapp " style="font-size: 25px;color: green;"></i></a>
							 <?php endif ?> 
                                          <?php if ($r['contact2_viber']=="on"): ?>
                                          	<a href="https://viber.me/<?=$r['contact2_viber']?>/" target="_blank">
                                            <img src="https://cdn4.iconfinder.com/data/icons/logos-and-brands/512/359_Viber_logo-512.png" style="width: 25px">
                                             </a>
                                          <?php endif ?>
						</td>
					</tr>
				
					<tr>
						<th>Email</th><td><a href="mailto:<?=$r['email']?>"><?=$r['email']?></a></td>
						<th>Email 2</th><td><a href="mailto:<?=$r['email2']?>"><?=$r['email2']?>						</td>
						<th>Designation Port</th><td><?=$r['designation']?></td>
					</tr>
					<tr>
						<th>Skype</th><td><?=$r['skype']?></td>
						<th>Website</th><td><?=$r['website']?></td>
						<th>Priority</th><td><?=$r['priority']?></td>
					</tr>
					<tr>
						<th>User Id</th><td><?=@$user['username']?></td>
						<th>Assign To</th><td><?=@$assign['username']?></td>
						<th>Date</th><td><?=$r['adddatetime']?></td>
					</tr>
					
					
				</table>
					</div>
				</div>
<?php } ?>
<!-- end of customer card -->


	</div>
</div>

<?php
include_once "includes/footer.php";
?>


