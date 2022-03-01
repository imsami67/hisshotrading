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
                                <div class="page-title">Model</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Model</li>
                            </ol>
                        </div>
                    </div>
			<div class="col-sm-12">
				<div class="panel">
					<div class="panel-heading panel-heading-red" align="center"><h4>Create Model</h4></div>
						<div class="panel-body">
							<?php 
								@$brand_id = $_GET['brand_id'];
								$fetchBrand = fetchRecord($dbc, "brands", 'brand_id', $brand_id);
							?>
							<form action="php_action/custom_action.php" method="POST" role="form" id="formData">
								<div class="msg"></div>
								<div class="form-group">
									<label for="">Maker Name</label>
									<select class="form-control" id="maker_id" name="maker_id">
										<option value="">~~SELECT~~</option>
										<?php 
											if (empty($fetchBrand['maker_id'])) {
												$q = get($dbc,"maker");
											}else{
												$q = get($dbc,"maker WHERE maker_id = '".$fetchBrand['maker_id']."'");

											}
											while ($r = mysqli_fetch_assoc($q)):?>
										<option selected="" value="<?=$r['maker_id']?>"><?=$r['maker_name']?></option>
										<?php endwhile ?>
									</select>
								</div>
								<div class="form-group">
									<label for="">Brand Name</label>
									<select class="form-control" id="brand_id" name="brand_id">
										<option value="">~~SELECT~~</option>
										<?php 	
											if (empty($brand_id)) {
												$q = get($dbc,"brands");
											}else{
												$q = get($dbc,"brands WHERE brand_id = $brand_id");

											}
											while ($r = mysqli_fetch_assoc($q)):?>
										<option selected="" value="<?=$r['brand_id']?>"><?=$r['brand_name']?></option>
										<?php endwhile ?>
									</select>
								</div>
								<div class="form-group">
									<label for="">Model Name</label>
									<input type="text" class="form-control" id="model_name" name="model_name"> 
									<input type="text" class="form-control d-none" id="model_id" name="model_id"> 
								</div>
							
								<button type="submit" class="btn btn-primary" id="saveData">Save</button>
								<!-- <button type="button" class="btn btn-primary" id="save_Close">Close</button> -->
							</form>
							</div>
						</div>
					</div>
					<input type="text" class="form-control d-none" id="brand_id" name="brand_id" value="<?=$brand_id ?>"> 

<div class="col-sm-12">
		<div class="panel">
	<div class="panel-heading cyan-bgcolor" align="center"><h4>Models</h4></div>
	<div class="panel-body">
			<table class="table" id="models">
				<thead>
			<tr>	
				<th>ID</th>
				<th>Model Name</th>
				<th>Brand Name</th>
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