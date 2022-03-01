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
                                <div class="page-title">Offices</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Offices</li>
                            </ol>
                        </div>
                    </div>

			<div class="col-sm-12">
				<div class="panel">
					<div class="panel-heading panel-heading-red" align="center"><h4>Create Offices</h4></div>
						<div class="panel-body">
							<form action="php_action/custom_action.php" method="POST" role="form" id="formData">
								<div class="msg"></div>
								<!-- addby	 -->
								<div class="row">
									<div class="col-sm-6">	
										<div class="form-group">
											<label for="office_name">Office Name</label>
											<input type="text" class="form-control" id="office_name" name="office_name">
											<input type="text" class="d-none" id="office_id" name="office_id">
										</div>
										<div class="form-group">
											<label for="office_address">Office Address</label>
											<input type="text" class="form-control" id="office_address" name="office_address">
										</div>
										<div class="form-group">
											<label for="office_country">Office Country</label>
											<input type="text" class="form-control" id="office_country" name="office_country">
										</div>
										<div class="form-group">
											<label for="office_phone">Office Phone</label>
											<input type="text" class="form-control" id="office_phone" name="office_phone">
										</div>
									</div><!-- col -->
									<div class="col-sm-6">
										<div class="form-group">
											<label for="office_sellername">Office Seller Name</label>
											<input type="text" class="form-control" id="office_sellername" name="office_sellername">
										</div>
										<div class="form-group">
											<label for="office_sellerphone">Office Seller Phone</label>
											<input type="text" class="form-control" id="office_sellerphone" name="office_sellerphone">
										</div>
										<div class="form-group">
											<label for="office_sellerpost">Office Seller Post</label>
											<input type="text" class="form-control" id="office_sellerpost" name="office_sellerpost">
										</div>
										<div class="form-group">
											<label for="office_lat">Office lat</label>
											<input type="text" class="form-control" id="office_lat" name="office_lat">
										</div>
										<div class="form-group">
											<label for="office_lng">Office lng</label>
											<input type="text" class="form-control" id="office_lng" name="office_lng">
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
	<div class="panel-heading cyan-bgcolor" align="center"><h4>Auction Grades</h4></div>
	<div class="panel-body">
			<table class="table" id="nexco_offices">
				<thead>
			<tr>	
				<th>ID</th>
				<th>Office Name</th>
				<th>Seller Name</th>
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