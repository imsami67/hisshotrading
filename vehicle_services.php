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
                                <div class="page-title">Vehicle Services</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Vehicle Services</li>
                            </ol>
                        </div>
                    </div>
                    <?php 	$vehicle_info=fetchvehicle_info($dbc,$_GET['vehicle_id']); ?>

			<div class="col-sm-12">
				<div class="panel">
					<div class="panel-heading panel-heading-red" align="center"><h4>Create Vehicle Services</h4></div>
						<div class="panel-body">
							<?php getMessage(@$msg,@$sts); ?>
							<form action="php_action/custom_action.php" method="POST" role="form" id="formData">
								<div class="msg"></div>
								<div class="form-group">
									<div class="row">
										<div class="col-sm-4">
											
									<?php 
										@$abc = $_GET['vehicle_id'];
										if ($abc == "") {
											@$sts_custom = '';
										}else{
											@$sts_custom = 'readonly';
										}
									?>
									<label for="">Vehicle</label>
									<input list="vehicle_info1" value="<?=@$abc?>" <?=@$sts_custom ?> name="vehicle_info_id" id="vehicle_info_id" class="form-control">
									<datalist id="vehicle_info1">
										<option value="">~~ SELECT ~~</option>
										<?php 
											$q = get($dbc,"vehicle_info"); 
											while ($r = mysqli_fetch_assoc($q)):
										?>
										<option value="<?=$r['vehicle_id']?>">Brand : <?=fetchRecord($dbc,"brands","brand_id",$r['vehicle_brand'])['brand_name'] ?> Chassis No : <?=$r['vehicle_chassis_no']?> Stock ID : <?=$r['vehicle_stock_id']?></option>
										<?php endwhile ?>
									</datalist>
								
										</div>
										<div class="col-sm-8">
											<label for="" style="visibility: hidden;">Vehicle</label>
											<input list="" value="<?=$vehicle_info['brand_name']?>-<?=$vehicle_info['maker_name']?>-<?=$vehicle_info['vehicle_chassis_no']?>" readonly name="" id="" class="form-control">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="">Vehicle Services Name</label>
									<input type="text" class="form-control" id="vehicle_services_name" name="vehicle_services_name"> 
									<input type="text" class="form-control d-none" id="vehicle_services_id" name="vehicle_services_id"> 
								</div>
								<div class="form-group">
									<label for="">Amount</label>
									<input type="text" class="form-control taxOnAmount" id="vehicle_services_amount" name="vehicle_services_amount"> 
								</div>
								<div class="form-group">
									<label for="">Status</label>
									<select name="vehicle_services_sts" id="vehicle_services_sts" class="form-control">
										<option value="">~~SELECT~~</option>
										<option value="1">Active</option>
										<option value="0">Dective</option>
									</select>
								</div>
								<button type="submit" class="btn btn-primary" class="saveData">Save</button>
							</form>
							</div>
						</div>
					</div>


<div class="col-sm-12">
		<div class="panel">
	<div class="panel-heading cyan-bgcolor" align="center"><h4>Vehicle services</h4></div>
	<div class="panel-body">
			<table class="table" id="vehicle_services">
			<thead>
				<tr>	
					<th>ID</th>
					<th>Vehicle</th>
					<th>Vehicle services</th>
					<th>Amount</th >
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