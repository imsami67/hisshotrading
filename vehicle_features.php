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
                                <div class="page-title">Vehicle Features</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Vehicle Features</li>
                            </ol>
                        </div>
                    </div>
			<div class="col-sm-12">
				<div class="panel">
					<div class="panel-heading panel-heading-red" align="center"><h4>Create Vehicle Features</h4></div>
						<div class="panel-body">
							<form action="php_action/custom_action.php" method="POST" role="form" id="formData">
								<div class="msg"></div>
								<div class="form-group">
									<label for="">Category</label>
									<select class="form-control" id="vehicle_feature_category" name="vehicle_feature_category"> 
										<option value="">~~SELECT~~</option>
										<option value="exterior">Exterior Options</option>
										<option value="interior">Interior Options</option>
										<option value="safety">Safety</option>
										<option value="convenient">Convenient</option>
										<option value="multimedia">Multimedia</option>
										<option value="equipment">Equipment</option>
									</select>
									<input type="text" class="form-control d-none" id="vehicle_feature_id" name="vehicle_feature_id"> 
								</div>
								<div class="form-group">
									<label for="">Feature Name</label>
									<input type="text" class="form-control" id="vehicle_feature_name" name="vehicle_feature_name"> 
								</div>						
<?php if (@$userPrivileges['nav_add']==1 || $fetchedUserRole=="admin"): ?>
								<button type="submit" class="btn btn-primary" class="saveData">Save</button>
							<?php endif ?>
							</form>
							</div>
						</div>
					</div>
<div class="col-sm-12">
		<div class="panel">
	<div class="panel-heading cyan-bgcolor" align="center"><h4>Vehicle Features</h4></div>
	<div class="panel-body">
			<table class="table" id="vehicle_feature">
				<thead>
			<tr>	
				<th>ID</th>
				<th>Category</th>
				<th>Name</th>
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