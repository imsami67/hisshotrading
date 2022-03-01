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
                                <div class="page-title">Auction House</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Auction House</li>
                            </ol>
                        </div>
                    </div>

			<div class="col-sm-12">
				<div class="panel">
					<div class="panel-heading panel-heading-red" align="center"><h4>Create Auction House</h4></div>
						<div class="panel-body">
							<?php getMessage(@$msg,@$sts); ?>
							<form action="php_action/custom_action.php" method="POST" role="form" id="formData">
								<div class="msg"></div>
								<div class="form-group row">
									<div class="col-sm-6">
									<label for="">Auction House Name</label>
									<input type="text" required class="form-control" id="auction_home_name" name="auction_home_name"> 
									<input type="text" class="form-control d-none" id="auction_home_id" name="auction_home_id"> </div>
									<div class="col-sm-6">
										<label for="">Auction Company Name</label>
										<input type="text" class="form-control" id="auction_company_name" required name="auction_company_name"> 
									</div>
								</div> <!-- end group -->
								<div class="form-group row">
									<div class="col-sm-6">
									<label for="">Auction Day</label>
									<select required class="form-control" id="auction_day" name="auction_day"> 
										<option value="">~~SELECT~~</option>
										<option value="monday">Monday</option>
										<option value="tuesday">Tuesday</option>
										<option value="wednesday">Wenesday</option>
										<option value="thursday">Thursday</option>
										<option value="friday">Friday</option>
										<option value="saturday">Saturday</option>
										<option value="sunday">Sunday</option>

									</select> 
									 </div>

									<div class="col-sm-6">
										<label for="">Auction House Address</label>
										<div class="row">
											<div class="col-sm-4 m-0 pr-0">
												<input type="text" placeholder="Postal Code" class="form-control" id="auction_house_postal" name="auction_house_postal">
											</div>
											<div class="col-sm-2 pr-0">
												<label for="">Address</label>
											</div>
											<div class="col-sm-6 pl-0">
												<input type="text" placeholder="Japanese" class="form-control" id="auction_address_jp" name="auction_address_jp">
												<input type="text" placeholder="English" class="form-control" id="auction_address_en" name="auction_address_en">
											</div>
										</div>
									</div>
								</div> <!-- end group -->
								<div class="form-group row">
									<div class="col-sm-3">
									<label for="">Contact</label>
									<input type="text" required class="form-control" id="auction_contact" name="auction_contact"> </div>
									<div class="col-sm-3">
										<label for="">Fax</label>
										<input type="text" class="form-control" id="auction_fax" name="auction_fax"> 
									</div>
									<div class="col-sm-3">
										<label for=""> Email</label>
										<input required type="email" class="form-control" id="auction_email" name="auction_email"> 
									</div>
									<div class="col-sm-3">
										<label for="">URL</label>
										<input type="text" class="form-control" id="auction_url" name="auction_url"> 
									</div>
									
								</div> <!-- end group -->
								
								<div class="form-group row">
									<div class="col-sm-3">
									<label for="">Auction Region</label>
									<input type="text" class="form-control" id="region" name="region"> </div>
									<div class="col-sm-3">
										<label for="">Bussiness Type</label>
										<input type="text" class="form-control" id="business_type" name="business_type"> 
									</div>
							
									<div class="col-sm-3">
									<label for="">Pickup Deadline</label>
									<input type="text" class="form-control" id="deadline_transportation" name="deadline_transportation"> </div>
									<div class="col-sm-3">
										<label for="">Payment Deadline</label>
									<input type="text" class="form-control" id="payment_deadline" name="payment_deadline">  
									</div>
								</div> <!-- end group -->
									<div class="form-group row">
									<div class="col-sm-3">
									<label for="">In House Bid Fee </label>
									<input type="text" required class="form-control" id="house_fee" name="house_fee"> </div>
									<div class="col-sm-3">
									<label for="">System Live Bid Fee</label>
									<input type="text" required class="form-control" id="live_fee" name="live_fee"> </div>
									<div class="col-sm-3">
									<label for="">System  Bid Price Fee</label>
									<input type="text" required class="form-control" id="system_bid" name="system_bid"> </div>
									<div class="col-sm-3">
										<label for="">Negoatiation  Price Offer Fee</label>
									<input type="text" required class="form-control" id="price_offer_fee" name="price_offer_fee">  
									</div>
								</div> <!-- end group -->
		<div class="form-group row">
			<div class="col-sm-4">
									<label for="">Person Incharge</label>
									<input type="text" class="form-control" id="person_incharge" name="person_incharge"> 
								</div>
									<div class="col-sm-4">
									<label for="">POS</label>
									<input type="text" class="form-control" id="pos" name="pos" required> 
								</div>
									<div class="col-sm-4">
									<label for="">Auction House Status</label>
									<select required class="form-control" id="auction_home_sts" name="auction_home_sts"> 
										<option value="">~~SELECT~~</option>
										<option value="1">Active</option>
										<option value="0">Inactive</option>
									</select>
								</div>
								</div> <!-- end group -->
	
								
							<?php if (@$userPrivileges['nav_add']==1 || $fetchedUserRole=="admin"): ?>
								<button type="submit" class="btn btn-primary" class="saveData">Save</button>
								<?php endif ?>
							</form>
							</div>
						</div>
					</div>


<div class="col-sm-12">
		<div class="panel">
	<div class="panel-heading cyan-bgcolor" align="center"><h4>Auction House</h4></div>
	<div class="panel-body">
			<table class="table" id="auction_home">
				<thead>
			<tr>	
				<th>ID</th>
				<th>Auction House</th>
				<th>Bids</th>
				<th>Auction Day</th >
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
	</div>
</div>
<?php
include_once "includes/footer.php";
?>