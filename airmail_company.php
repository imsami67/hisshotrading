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
                                <div class="page-title">Airmail Company</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Airmail Company</li>
                            </ol>
                        </div>
                    </div>

			<div class="col-sm-12">
				<div class="panel">
					<div class="panel-heading panel-heading-red" align="center"><h4>Create Services Company</h4></div>
						<div class="panel-body">
							<?php getMessage(@$msg,@$sts); ?>
							<form action="php_action/custom_action.php" method="POST" role="form" id="formData">
								<div class="msg"></div>
								<div class="row form-group">
									<div class="col-sm-12">
										
									<label for="">Services Company</label>
									<input type="text" class="form-control" id="services_company_name" name="services_company_name" required> 
									<input type="text" class="form-control d-none" id="services_company_id" name="services_company_id"> 
								
									</div>
								</div>
								<div class="row form-group">
									<div class="col-sm-6">
										
									<label for=""> Contact Person</label>
									<input type="text" class="form-control" id="services_company_person" name="services_company_person"> 
									
								
									</div>

									<div class="col-sm-6">
										
									<label for=""> Contact Number</label>
									<input type="number" class="form-control" id="services_company_contact" name="services_company_contact" required> 
									
								
									</div>
								
								</div>
								<div class="row form-group">
									<div class="col-sm-6">
										
									<label for="">  Fax Number</label>
									<input type="text" class="form-control" id="services_company_fax" name="services_company_fax"> 
									
								
									</div>

									<div class="col-sm-6">
										
									<label for="">  Email</label>
									<input type="text" class="form-control" id="services_company_email" name="services_company_email"> 
									
								
									</div>
								
								</div>
								<div class=" row form-group">
									<div class="col-sm-12">
										<label>Office Address</label>
										<textarea name="services_company_address" id="services_company_address" class="form-control"></textarea>
									</div>
								</div>
								<div class="row form-group">
									<div class="col-sm-6">
										
									<label for=""> Website</label>
									<input type="text" class="form-control" id="services_company_website" name="services_company_website"> 

								
									</div>

									<div class="col-sm-6">
										<label for=""> Status</label>
									<select class="form-control" id="services_company_sts" name="services_company_sts"> 
										<option value="">~~SELECT~~</option>
										<option value="1">Active</option>
										<option value="0">Inactive</option>
									</select></div>
								
								</div>
							
								<button type="submit" class="btn btn-primary" class="saveData">Save</button>
							</form>
							</div>
						</div>
					</div>


<div class="col-sm-12">
		<div class="panel">
	<div class="panel-heading cyan-bgcolor" align="center"><h4>Inspection Company</h4></div>
	<div class="panel-body">
			<table class="table" id="services_company">
				<thead>
			<tr>	
				<th>ID</th>
				<th>Services Company</th>
				<th>Contact Person</th>
				<th>Contact No.</th>
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