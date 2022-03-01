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
                                <div class="page-title">Inspection </div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Inspection </li>
                            </ol>
                        </div>
                    </div>

			<div class="col-sm-12">
				<div class="panel">
					<div class="panel-heading panel-heading-red" align="center"><h4>Create Inspection </h4></div>
						<div class="panel-body">
							<?php getMessage(@$msg,@$sts); ?>
							<form action="php_action/custom_action.php" method="POST" role="form" id="formData">
								<div class="msg"></div>
								<div class="row form-group">
									<div class="col-sm-4">
										
									<label for="">Inspection Company</label>
									
									<select class="form-control" id="inspection_trans_company" name="inspection_trans_company">
										<option >Select Inspection Company</option>
										<?php $q=get($dbc,"inspection_company WHERE inspection_company_sts='1'"); 
											while ($r=mysqli_fetch_assoc($q)) {
											
										?>
										<option value="<?=$r['inspection_company_id']?>"><?=$r['inspection_company_name']?></option>
									<?php } ?>
									</select>
									<input type="text" class="form-control d-none" id="inspection_trans_id" name="inspection_trans_id"> 
								
									</div>
									<div class="col-sm-2">
										<label for="" style="visibility: hidden;">..</label><br>
								<a href="inspection_company.php" target="_blank" class=" btn-sm btn-primary"><span class="fa fa-plus"></span></a>
							<button type="button" class=" btn-info btn-sm"  onclick="refresh_select(`inspection_trans_company`,`inspection_company_id`,`inspection_company_name`,'',``)"><span class="fa fa-refresh" ></span></button>


							</div>

									<div class="col-sm-6">
										
									<label for="">Inspection For</label>
									<!-- <input type="text" class="form-control" id="inspection_trans_for" name="inspection_trans_for">  -->
									<?=countrySelector("inspection_trans_for", "inspection_trans_for", "inspection_trans_for", "form-control"); ?>
									
								
									</div>
								
								</div>
								<div class="row form-group">
									<div class="col-sm-6">
										
									<label for="">Inspection Fee </label>
									<input type="number" min="1" class="form-control" id="inspection_trans_fee" name="inspection_trans_fee"> 
									
								
									</div>

									<div class="col-sm-6">
										
									<label for="">Inspection Fee Tax</label>
									<input type="number" min="1" class="form-control" id="inspection_trans_fee_tax" name="inspection_trans_fee_tax"> 
									
								
									</div>
								
								</div>
								<div class=" row form-group">
									<div class="col-sm-6">
										
									<label for="">Inspection Validity For</label>
									<input type="text"  class="form-control" id="inspection_validity_for" name="inspection_validity_for"> 
									
								
									</div>
									<div class="col-sm-6">
										<label>Others</label>
										<textarea name="inspection_trans_others" id="inspection_trans_others" class="form-control"></textarea>
									</div>
								</div>
								<div class="row form-group">
									

									<div class="col-sm-12">
										<label for=""> Status</label>
									<select class="form-control" id="inspection_trans_sts" name="inspection_trans_sts"> 
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
	<div class="panel-heading cyan-bgcolor" align="center"><h4>Inspection Transportation</h4></div>
	<div class="panel-body">
			<table class="table" id="inspection_transportation">
				<thead>
			<tr>	
				<th>ID</th>
				<th>Inspection Company</th>
				<th>Inspection For</th>
				<th>Inspection Fee</th>
				<th>Others</th>
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