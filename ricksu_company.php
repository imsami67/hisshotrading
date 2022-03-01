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
                                <div class="page-title">RICKSU</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">RICKSU</li>
                            </ol>
                        </div>
                    </div>

			<div class="col-sm-12">
				<div class="panel">
					<div class="panel-heading panel-heading-red" align="center"><h4>Create RICKSU</h4></div>
						<div class="panel-body">
							<?php getMessage(@$msg,@$sts); ?>
							<form action="php_action/custom_action.php" method="POST" role="form" id="formData">
								<div class="msg"></div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="">RICKSU Company Name</label>
											<input type="text" class="form-control" id="ricksu_company_name" name="ricksu_company_name"> 
											<input type="text" class="form-control d-none" id="ricksu_company_id" name="ricksu_company_id"> 
										</div>
										<div class="form-group">
											<label for="">RICKSU Fee</label>
											<input type="text" class="form-control" id="ricksu_company_fee" name="ricksu_company_fee"> 
										</div>
										<div class="form-group">
											<label for="">RICKSU Email</label>
											<input type="text" class="form-control" id="ricksu_company_email" name="ricksu_company_email"> 
										</div>
										<div class="form-group">
											<label for="">RICKSU Website</label>
											<input type="text" class="form-control" id="ricksu_company_website" name="ricksu_company_website"> 
										</div>
									</div><!-- col -->
									<div class="col-sm-6">
										<div class="form-group">
											<label for="">Contact Person Name</label>
											<input type="text" class="form-control" id="ricksu_company_contact_person" name="ricksu_company_contact_person"> 
										</div>
										<div class="form-group">
											<label for="">Contact No</label>
											<input type="text" class="form-control" id="ricksu_company_contact" name="ricksu_company_contact"> 
										</div>
										<div class="form-group">
											<label for="">Fax No</label>
											<input type="text" class="form-control" id="ricksu_company_fax" name="ricksu_company_fax"> 
										</div>
										<div class="form-group">
											<label for="">RICKSU Status</label>
											<select class="form-control" id="ricksu_company_sts" name="ricksu_company_sts"> 
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
	<div class="panel-heading cyan-bgcolor" align="center"><h4>RICKSU</h4></div>
	<div class="panel-body">
			<table class="table" id="ricksu_company1">
				<thead>
			<tr>	
				<th>ID</th>
				<th>RICKSU</th>
				<th>Fee</th>
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