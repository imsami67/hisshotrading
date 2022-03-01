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
                                <div class="page-title">Shipment Company</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Shipment Company</li>
                            </ol>
                        </div>
                    </div>
			<div class="col-sm-12">
				<div class="panel">
					<div class="panel-heading panel-heading-red" align="center"><h4>Create Shipment Company</h4></div>
						<div class="panel-body">
							<form action="php_action/custom_action.php" method="POST" role="form" id="formData">
								<div class="msg"></div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="">Shipment Company</label>
											<input type="text" class="form-control" autofocus="true" id="shipment_company_name" name="shipment_company_name"> 
											<input type="text" class="form-control d-none" id="shipment_company_id" name="shipment_company_id"> 
										</div>
										<div class="form-group">
											<label for="">COUNTRY</label>
											<?=countrySelector("", "shipment_company_country", "shipment_company_country", "form-control") ?> 
										</div>
										<div class="form-group">
											<label for="">CITY</label>
											<input type="text" class="form-control" id="shipment_company_city" name="shipment_company_city"> 
										</div>
										<div class="form-group">
											<label for="">STREET / ROAD (Optional)</label>
											<input type="text" class="form-control" id="shipment_company_street" name="shipment_company_street"> 
										</div>		
										<div class="form-group">
											<label for="">ZIP/POSTAL CODE</label>
											<input type="text" class="form-control" id="shipment_company_zip_code" name="shipment_company_zip_code"> 
										</div>		
										<div class="form-group">
											<label for="">LANDLINE NO</label>
											<input type="text" class="form-control" id="shipment_company_landline" name="shipment_company_landline"> 
										</div>		
										<div class="form-group">
											<label for="">FAX NO</label>
											<input type="text" class="form-control" id="shipment_company_fax" name="shipment_company_fax"> 
										</div>
										<div class="form-group">
											<label for="">Website (Optional)</label>
											<input type="text" class="form-control" id="shipment_company_web" name="shipment_company_web"> 
										</div>
									</div><!-- col -->
									<div class="col-sm-6">
										<div class="form-group">
											<label for="">CONTACT PERSON</label>
											<input type="text" class="form-control" id="shipment_company_contact_person" name="shipment_company_contact_person"> 
										</div>
										<div class="form-group">
											<label for="">STATE / PREFECTURE</label>
											<input type="text" class="form-control" id="shipment_company_state" name="shipment_company_state"> 
										</div>
										<div class="form-group">
											<label for="">SUBURB (Optional)</label>
											<input type="text" class="form-control" id="shipment_company_suburb" name="shipment_company_suburb"> 
										</div>		
										<div class="form-group">
											<label for="">FLOOR / BUILDING Name</label>
											<input type="text" class="form-control" id="shipment_company_floor" name="shipment_company_floor"> 
										</div>		
										<div class="form-group">
											<label for="">OTHER ADDRESS INFO</label>
											<input type="text" class="form-control" id="shipment_company_other" name="shipment_company_other"> 
										</div>		
										<div class="form-group">
											<label for="">MOBILE NO</label>
											<input type="text" class="form-control" id="shipment_company_mobile" name="shipment_company_mobile"> 
										</div>		
										<div class="form-group">
											<label for="">EMAIL ADDRESS</label>
											<input type="email" class="form-control" id="shipment_company_email" name="shipment_company_email"> 
										</div>

										<div class="form-group">
											<label for="">Shipment Comapny Status</label>
											<select class="form-control" id="shipment_company_sts" name="shipment_company_sts"> 
												<option value="">~~SELECT~~</option>
												<option value="1">Active</option>
												<option value="0">Inactive</option>
											</select>
										</div>
									</div><!-- col -->
								</div><!-- row -->
								<button type="submit" class="btn btn-primary" class="saveData">Save</button>
							</form>
							</div>
						</div>
					</div>


<div class="col-sm-12">
		<div class="panel">
	<div class="panel-heading cyan-bgcolor" align="center"><h4>Shipment Comapny</h4></div>
	<div class="panel-body">
			<table class="table" id="shipment_companyTbl">
				<thead>
			<tr>	
				<th>ID</th>
				<th>Name</th>
				<th>Email</th>
				<th>Contact Person</th>
				<th>Country</th>
				<th>State</th>
				<th>City</th>
				<th>Suburb</th>
				<th>Street</th>
				<th>Floor</th>
				<th>Zip code</th>
				<th>Other Detail</th>
				<th>Landline</th>
				<th>Mobile</th>
				<th>Fax</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
			</thead>
			<tbody>
			</tbody>
			
			
			</table>
		
	</div>
</div>

</div>
	</div></div>
<?php
include_once "includes/footer.php";
?>