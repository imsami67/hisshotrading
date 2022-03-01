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
                                <div class="page-title">Inspection Company</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Inspection Company</li>
                            </ol>
                        </div>
                    </div>

			<div class="col-sm-12">
				<div class="panel">
					<div class="panel-heading panel-heading-red" align="center"><h4>Create Inspection Company</h4></div>
						<div class="panel-body">
							<?php getMessage(@$msg,@$sts); ?>
							<form action="php_action/custom_action.php" method="POST" role="form" id="formData">
								<div class="msg"></div>
								<div class="row form-group">
									<div class="col-sm-6">
										
									<label for="">Inspection Company</label>
									<input type="text" class="form-control" id="inspection_company_name" name="inspection_company_name"> 
									<input type="text" class="form-control d-none" id="inspection_company_id" name="inspection_company_id"> 
								
									</div>

									<div class="col-sm-6">
										
									<label for="">Contact Person</label>
									<input type="text" class="form-control" id="inspection_contact_person" name="inspection_contact_person"> 
									
								
									</div>
								
								</div>
								<div class="row form-group">
									<div class="col-sm-6">
										
									<label for="">Inspection Company Fax Number</label>
									<input type="text" class="form-control" id="inspection_fax" name="inspection_fax"> 
									
								
									</div>

									<div class="col-sm-6">
										
									<label for="">Inspection Company Email</label>
									<input type="text" class="form-control" id="inspection_email" name="inspection_email"> 
									
								
									</div>
								
								</div>
								<div class=" row form-group">
									<div class="col-sm-12">
										<label>Inspection Company Address</label>
										<textarea name="inspection_address" id="inspection_address" class="form-control"></textarea>
									</div>
								</div>
								<div class="row form-group">
									<div class="col-sm-6">
										
									<label for="">Inspection Company Website</label>
									<input type="text" class="form-control" id="inspection_website" name="inspection_website"> 

								
									</div>

									<div class="col-sm-6">
										<label for="">Inspection Company Status</label>
									<select class="form-control" id="inspection_company_sts" name="inspection_company_sts"> 
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
			<table class="table" id="inspection_company">
				<thead>
			<tr>	
				<th>ID</th>
				<th>Inspection Company</th>
				<th>Contact Person</th>
				<th>Detail</th>
				<th>Address</th>
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