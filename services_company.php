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
                                <div class="page-title">Services Company</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Services Company</li>
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
								<div class="form-group">
									<label for="">Services Company</label>
									<input type="text" class="form-control" id="services_company_name" name="services_company_name"> 
									<input type="text" class="form-control d-none" id="services_company_id" name="services_company_id"> 
								</div>
								<div class="form-group">
									<label for="">Services Company Status</label>
									<select class="form-control" id="services_company_sts" name="services_company_sts"> 
										<option value="">~~SELECT~~</option>
										<option value="1">Active</option>
										<option value="0">Inactive</option>
									</select>
								</div>
							
								<button type="submit" class="btn btn-primary" class="saveData">Save</button>
							</form>
							</div>
						</div>
					</div>


<div class="col-sm-12">
		<div class="panel">
	<div class="panel-heading cyan-bgcolor" align="center"><h4>Services Company</h4></div>
	<div class="panel-body">
			<table class="table" id="services_company">
				<thead>
			<tr>	
				<th>ID</th>
				<th>Services Company</th>
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