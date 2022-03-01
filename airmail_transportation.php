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
                                <div class="page-title">Airmail Transportation</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Airmail Transportation</li>
                            </ol>
                        </div>
                    </div>

			<div class="col-sm-12">
				<div class="panel">
					<div class="panel-heading panel-heading-red" align="center"><h4>Create Airmail Transportation</h4></div>
						<div class="panel-body">
							<?php getMessage(@$msg,@$sts); ?>
							<form action="php_action/custom_action.php" method="POST" role="form" id="formData">
								<div class="msg"></div>
								<div class="row form-group">
									<div class="col-sm-6">
										
									<label for="">Airmail Company</label>
									
									<select class="form-control" id="airmail_trans_company" name="airmail_trans_company">
										<option >Select Inspection Company</option>
										<?php $q=get($dbc,"services_company WHERE services_company_sts='1'"); 
											while ($r=mysqli_fetch_assoc($q)) {
											
										?>
										<option value="<?=$r['services_company_id']?>"><?=$r['services_company_name']?></option>
									<?php } ?>
									</select>
									<input type="text" class="form-control d-none" id="airmail_trans_id" name="airmail_trans_id"> 
								
									</div>

									<div class="col-sm-6">
										
									<label for="">Parcel Type </label>
									<select class="form-control" id="airmail_trans_type" name="airmail_trans_type">
										<option value="express">Express</option>
										<option value="normal">Normal</option>
									</select>
									</div>
								
								</div>
								<div class="row form-group">
									<div class="col-sm-6">
									<label for="">Parcel Weight </label>
									<select class="form-control" id="airmail_trans_weight" name="airmail_trans_weight">
										<option >Parcel Weight </option>
										<option value="0.5">0.5 kg</option>
										<option value="1">1 kg</option>
										<option value="2">2 kg</option>
										<option value="5">5 kg</option>
										<option value="10">10 kg</option>
										<option value="15">15 kg</option>
									</select>
									</div>
									<div class="col-sm-6">
									<label for="">Country</label>
									<?=countryBySelect("airmail_trans_country", "airmail_trans_country", "form-control",""); ?>
									</div>
								</div>
									<div class="row form-group">
									<div class="col-sm-6">
									<input type="hidden" id="prefixTax" value="10">	
									<label for="">Fee</label>
									<input type="number" min="0" class="form-control" id="airmail_trans_fee" name="airmail_trans_fee"> 
								
									</div>

									<div class="col-sm-6">
										
									<label for="">Fee Tax</label>
									<input type="number" min="0" class="form-control" id="airmail_trans_fee_tax" name="airmail_trans_fee_tax"> 
									
								
									</div>
								
								</div>

								<div class=" row form-group">
									<div class="col-sm-12">
										<label>Others</label>
										<textarea name="airmail_trans_others" id="airmail_trans_others" class="form-control"></textarea>
									</div>
								</div>
								<div class="row form-group">
									

									<div class="col-sm-12">
										<label for=""> Status</label>
									<select class="form-control" id="airmail_trans_sts" name="airmail_trans_sts"> 
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
	<div class="panel-heading cyan-bgcolor" align="center"><h4>Airmail Transportation List</h4></div>
	<div class="panel-body">
			<table class="table" id="airmail_transportation">
				<thead>
			<tr>	
				<th>ID</th>
				<th>Airmail Company</th>
				<th>Parcel Type</th>
				<th>Parcel Weight</th>
				<th>Country</th>
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