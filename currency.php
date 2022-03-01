 <?php 
include_once "includes/header.php";
include_once "inc/code.php";
if (isset($_REQUEST['currency_id'])) {
	@$fetchCurrency=fetchRecord($dbc,"currency","currency_id",$_REQUEST['currency_id']);
}

?>
<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Currency</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Currency</li>
                            </ol>
                        </div>
                    </div>
			<div class="col-sm-12">
				<div class="panel">
					<div class="panel-heading cyan-bgcolor" >
						<div class="row">
							<div class="col-sm-6">
								<h4 class="float-right">Currency</h4>
							</div>
						

						<div  class="col-sm-6">
							<a href="currency.php" class="btn btn-sm mt-2 btn-primary float-right">Add new</a>
						</div>
					</div>
					</div>
						<div class="panel-body">
							<form action="php_action/custom_action.php" method="POST" role="form" id="formData16">
							
								<div class="row form-group">
									<div class="col-sm-6">
										
									<label for="">Currency Name</label>
									<input type="text" class="form-control" id="currency_name" name="new_currency_name" required value="<?=@$fetchCurrency['currency_name']?>"> 
									<input type="hidden" class="form-control" id="currency_id" name="currency_id" value="<?=@$fetchCurrency['currency_id']?>"> 
								
									</div>
							
									<div class="col-sm-6">
										
									<label for="">Country</label>
									<select class="form-control" id="country_id" name="country_id" required>

				    		 <option>Select Country</option>

			                                <?php

						                    	$sql = mysqli_query($dbc,"SELECT * FROM country_regulation GROUP BY country_regulation_country");

						                    	while($countries=mysqli_fetch_assoc($sql)):

						                    ?>

			                                <option <?=(@$fetchCurrency['country_id']==$countries['country_regulation_id'])?"selected":""?> value="<?=$countries['country_regulation_id']?>"><?=$countries['country_regulation_country']?></option>

			                                <?php

			                              endwhile;

			                                ?>

				    		

				    	</select>
								
									</div>
								</div>
								<div class="row form-group ">
									<div class="col-sm-6">
										<label for="">Rate</label>
										<input type="number" min="0" class="form-control" id="currency_rate" name="currency_rate" required value="<?=@$fetchCurrency['currency_rate']?>"> 
								
									</div>
									<div class="col-sm-6">
										<label for="">Currency Status</label>
										<select class="form-control" id="currency_status" name="currency_status" required> 
										<option value="">~~SELECT~~</option>
										<option <?=(@$fetchCurrency['currency_status']==1)?"selected":""?> value="1">Active</option>
										<option <?=(@$fetchCurrency['currency_status']==0)?"selected":""?> value="0">Inactive</option>
									</select>
								
									</div>
								</div>
								<div class="form-group row">
									<?php if (@$userPrivileges['nav_add']==1 || $fetchedUserRole=="admin"): ?>
								<button type="submit" class="btn btn-primary" id="formData16_btn">Save</button>
								<?php endif ?>
							</div>
							</form>
							</div>
						</div>
					</div>


<div class="col-sm-12">
		<div class="panel">
	<div class="panel-heading cyan-bgcolor" align="center"><h4>Currency Lists</h4></div>
	<div class="panel-body">
			<table class="table data-table" id="tableData16">
				<thead>
			<tr>	
				<th>ID</th>
				<th>Currency Name</th>
				<th>Country</th>
				<th>Rate</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
			</thead>
			<tbody>
				<?php 

					$q=get($dbc,"currency");
					while($r=mysqli_fetch_assoc($q)):
					$countryName=fetchRecord($dbc,"country_regulation","country_regulation_id",$r['country_id'])['country_regulation_country'];

				 ?>
				 <tr>
				 	<td><?=$r['currency_id']?></td>
				 	<td><?=$r['currency_name']?></td>
				 	<td><?=$countryName?></td>
				 	<td><?=$r['currency_rate']?></td>
				 	<td><?=$r['currency_status']?></td>
				 	<td>
				 		<a href="currency.php?currency_id=<?=$r['currency_id']?>" class="btn btn-sm btn-info">Edit</a>
				 	</td>
				 </tr>
				<?php endwhile; ?>	
			</tbody>
			
			
			</table>
		
	</div>
</div>

</div>
	</div></div>
<?php
include_once "includes/footer.php";
?>