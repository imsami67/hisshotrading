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
                                <div class="page-title">Vehicle Expense</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Vehicle Expense</li>
                            </ol>
                        </div>
                    </div>

			<div class="col-sm-12">
				<div class="panel">
					<div class="panel-heading panel-heading-red" align="center"><h4>Create Vehicle Expense</h4></div>
						<div class="panel-body">
							<?php getMessage(@$msg,@$sts); ?>
							<form action="php_action/custom_action.php" method="POST" role="form" id="formData">
								<div class="msg"></div>
								<div class="form-group">
									<?php 
										@$abc = $_GET['vehicle_id'];
										if ($abc == "") {
											@$sts_custom = '';
										}else{
											$vehicle_info=fetchRecord($dbc,"vehicle_info","vehicle_id",$abc);
											$brand=fetchRecord($dbc,"brands","brand_id",$vehicle_info['vehicle_brand'])['brand_name'];
											$maker=fetchRecord($dbc,"maker","maker_id",$vehicle_info['vehicle_maker'])['maker_name'];
											@$sts_custom = 'readonly';
										}
									?>
									<label for="">Vehicle</label>
									<input list="vehicle_info1" value="<?=@$abc?>-<?=@$maker?> <?=@$brand?> " <?=@$sts_custom ?> name="vehicle_info_id" id="vehicle_info_id" class="form-control">
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
								<div class="form-group">
									<label for="">Vehicle Expense Name</label>
									<input type="text" class="form-control" id="vehicle_expense_name" name="vehicle_expense_name"> 
									<input type="text" class="form-control d-none" id="vehicle_expense_id" name="vehicle_expense_id"> 
								</div>
								<div class="form-group">
									<label for="">Amount</label>
									<input type="text" class="form-control taxOnAmount" id="vehicle_expense_amount" name="vehicle_expense_amount"> 
								</div>
								<div class="form-group">
									<label for="">Tax</label>
									<input type="text" class="form-control" id="vehicle_expense_amount_tax" name="vehicle_expense_amount_tax"> 
								</div>
								<input type="hidden" class="form-control" id="vehicle_expense_type" value="expense" name="vehicle_expense_type"> 
								<!-- <div class="form-group">

									<label for="vehicle_expense_type">Type</label>
									<select name="vehicle_expense_type" id="vehicle_expense_type" class="form-control">
									
										<option value="expense">Expense</option>
										<option value="service">Service</option>
									</select>
								</div> -->
								<?php if (@$userPrivileges['nav_add']==1 || $fetchedUserRole=="admin"): ?>
								<button type="submit" class="btn btn-primary" class="saveData">Save</button>
								<?php endif ?>
							</form>
							</div>
						</div>
					</div>


<div class="col-sm-12">
		<div class="panel">
	<div class="panel-heading cyan-bgcolor" align="center"><h4>Vehicle Expense</h4></div>
	<div class="panel-body">
			<table class="table" id="vehicle_expense">
			<thead>
				<tr>	
					<th>ID</th>
					<th>Vehicle</th>
					<th>Vehicle Expense</th>
					<th>Amount</th >
					<th>Tax</th>
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