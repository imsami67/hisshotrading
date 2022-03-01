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
                                <div class="page-title">Shipper</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Shipper</li>
                            </ol>
                        </div>
                    </div>
			<div class="col-sm-12">
				<div class="panel">
					<div class="panel-heading panel-heading-red" align="center"><h4>Create Shipper</h4></div>
						<div class="panel-body">
							<form action="php_action/custom_action.php" method="POST" role="form" id="formData">
								<div class="msg"></div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="">Shipper Company</label>
											<input type="text" class="form-control" autofocus="true" id="shipper_name" name="shipper_name"> 
											<input type="text" class="form-control d-none" id="shipper_id" name="shipper_id"> 
										</div>
										<div class="form-group">
											<label for="">COUNTRY</label>
											<?=countryBySelect("shipper_country", "shipper_country", "form-control country_number_by") ?> 
										</div>
										<div class="form-group">
											<label for="">CITY</label>
											<input type="text" class="form-control" id="shipper_city" name="shipper_city"> 
										</div>
										<div class="form-group">
											<label for="">STREET / ROAD (Optional)</label>
											<input type="text" class="form-control" id="shipper_street" name="shipper_street"> 
										</div>		
										<div class="form-group">
											<label for="">ZIP/POSTAL CODE</label>
											<input type="text" class="form-control" id="shipper_zip_code" name="shipper_zip_code"> 
										</div>		
										<div class="form-group">
											<label for="">LANDLINE NO</label>
											<input type="text" class="form-control  country_number" id="shipper_landline" name="shipper_landline"> 
										</div>		
										<div class="form-group">
											<label for="">FAX NO</label>
											<input type="text" class="form-control country_number" id="shipper_fax" name="shipper_fax"> 
										</div>
										<div class="form-group">
											<label for="">Website (Optional)</label>
											<input type="text" class="form-control" id="shipper_web" name="shipper_web"> 
										</div>
									</div><!-- col -->
									<div class="col-sm-6">
										<div class="form-group">
											<label for="">CONTACT PERSON</label>
											<input type="text" class="form-control country_number" id="shipper_contact_person" name="shipper_contact_person"> 
										</div>
										<div class="form-group">
											<label for="">STATE / PREFECTURE</label>
											<input type="text" class="form-control" id="shipper_state" name="shipper_state"> 
										</div>
										<div class="form-group">
											<label for="">SUBURB (Optional)</label>
											<input type="text" class="form-control" id="shipper_suburb" name="shipper_suburb"> 
										</div>		
										<div class="form-group">
											<label for="">FLOOR / BUILDING Name</label>
											<input type="text" class="form-control" id="shipper_floor" name="shipper_floor"> 
										</div>		
										<div class="form-group">
											<label for="">OTHER ADDRESS INFO</label>
											<input type="text" class="form-control" id="shipper_other" name="shipper_other"> 
										</div>		
										<div class="form-group">
											<label for="">MOBILE NO</label>
											<input type="text" class="form-control country_number" id="shipper_mobile" name="shipper_mobile"> 
										</div>		
										<div class="form-group">
											<label for="">EMAIL ADDRESS</label>
											<input type="email" class="form-control" id="shipper_email" name="shipper_email"> 
										</div>

										<div class="form-group">
											<label for="">Shipper Status</label>
											<select class="form-control" id="shipper_sts" name="shipper_sts"> 
												<option value="">~~SELECT~~</option>
												<option value="1">Active</option>
												<option value="0">Inactive</option>
											</select>
										</div>
									</div><!-- col -->
								</div><!-- row -->

<?php if (@$userPrivileges['nav_add']==1 || $fetchedUserRole=="admin"): ?>
								<button type="submit" class="btn btn-primary" class="saveData">Save</button>
								<?php endif ?>
							</form>

							</div>
						</div>
					</div>


<div class="col-sm-12">
		<div class="panel">
	<div class="panel-heading cyan-bgcolor" align="center"><h4>Shippers</h4></div>
	<div class="panel-body">
			<table class="table" id="shipperTbl">
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