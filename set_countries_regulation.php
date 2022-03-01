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
                                <div class="page-title">Set Country Regulations</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Set Country Regulations</li>
                            </ol>
                        </div>
                    </div>
			<div class="col-sm-12">
				<div class="panel">
					<div class="panel-heading panel-heading-red" align="center"><h4>Set Countries Regulations</h4></div>
						<div class="panel-body">
							<form action="php_action/custom_action.php" method="POST" role="form" id="formData">
								<div class="msg"></div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="">Continents</label>
											<select name="country_regulation_continent" id="country_regulation_continent" class="form-control" required="required">
												<option value="">~~SELECT~~</option>
												<option value="asia">Asia & Pacific</option>
												<option value="africa">Africa</option>
												<option value="south america">South America & Caribbean</option>
												<option value="middle east">Middle East</option>
												<option value="europe">Europe</option>
												<option value="united states">United States & Canada</option>
											</select>
										</div>
										<div class="form-group">
											<label for="">Country</label>
											<?=countrySelector("","country_regulation_country","country_regulation_country","form-control"); ?>
										</div>
										<div class="form-group">
											<label for="">Year Rstriction</label>
											<input type="text" class="form-control" id="country_regulation_year" name="country_regulation_year"> 
											<input type="text" class="form-control d-none" id="country_regulation_id" name="country_regulation_id"> 
										</div>
										<div class="form-group">
											<label for="">Destination Port</label>
											<input type="text" class="form-control" id="country_regulation_destination_port" name="country_regulation_destination_port"> 
										</div>
										<div class="form-group">
											<label for="">Hand Drive</label>
											<select name="country_regulation_hand" id="country_regulation_hand" class="form-control" required="required">
												<option value="">~~SELECT~~</option>
												<option value="left">Left Hand</option>
												<option value="right">Right Hand</option>
												<option value="both">Both</option>
											</select>
										</div>
										<div class="form-group">
											<label for="">Container 20ft</label>
											<input type="text" class="form-control" id="container_20ft" name="container_20ft"> 
										</div>
										<div class="form-group">
											<label for="">Container 40ft</label>
											<input type="text" class="form-control" id="container_40ft" name="container_40ft"> 
										</div>
									</div><!-- col -->
									<div class="col-sm-6">
										<div class="form-group">
											<label for="">0-14 M3</label>
											<input type="text" class="form-control" id="m3_0_14" name="m3_0_14"> 
										</div>
										<div class="form-group">
											<label for="">14-20 M3</label>
											<input type="text" class="form-control" id="m3_14_20" name="m3_14_20"> 
										</div>
										<div class="form-group">
											<label for="">Time of Shipment</label>
											<input type="text" class="form-control" id="country_regulation_time_shipment" name="country_regulation_time_shipment"> 
										</div>
										<div class="form-group">
											<label for="">Vessel Schedule</label>
											<input type="text" class="form-control" id="country_regulation_vessel" name="country_regulation_vessel"> 
										</div>
										<div class="form-group">
											<label for="">Shipping Line</label>
											<input type="text" class="form-control" id="country_regulation_shipping_line" name="country_regulation_shipping_line"> 
										</div>
										<div class="form-group">
											<label for="">Inspection</label>
											<input type="text" class="form-control" id="country_regulation_inspection" name="country_regulation_inspection"> 
										</div>
										<div class="form-group">
											<label for="">Fees</label>
											<input type="text" class="form-control" id="country_regulation_fee" name="country_regulation_fee"> 
										</div>
									</div><!-- col -->
								</div><!-- row -->
							
								<button type="submit" class="btn btn-primary" class="saveData">Save</button>
							</form>
							</div>
						</div>
					</div>


<div class="col-sm-12">
		<div class="panel">
	<div class="panel-heading cyan-bgcolor" align="center"><h4>ccs</h4></div>
	<div class="panel-body">
			<table class="table table-responsive" id="country_regulation" style="width: 100%">
				<thead>
			<tr>	
				<th>ID</th>
				<th>Action</th>
				<th>Continent Name</th>
				<th>Country Name</th>
				<th>Year of Restriction</th>
				<th>Destination Port</th>
				<th>Hand Drive</th>
				<th>Time of Shipment</th>
				<th>Vessel Schedule</th>
				<th>Shipping Line</th>
				<th>Inspection</th>
				<th>Fee</th>
				<th>Sts</th>				
				<th>container_20ft</th>
				<th>container_40ft</th>
				<th>m3_0_14	text</th>
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