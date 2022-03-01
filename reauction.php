<?php

include_once "includes/header.php";
?>

 <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">RE-AUCTION INFO</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">RE-AUCTION </li>
                            </ol>
                        </div>
                    </div>


                  <div class="col-sm-12" >
                  	<div class="panel panel-info">
                  			<div class="panel panel-heading-blue" align="center"><h4>RE-AUCTION INFO</h4></div>
                  			<div class="panel panel-body">
                  				<form action="php_action/custom_action.php" method="POST" role="form" id="formData12">
	<?php 
          @$id = $_GET['vehicle_id'];
        ?>
        <input type="text" value="<?=@$id?>" class="vehicle_idMain d-none" name="vehicle_id">
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">RE-Auction Requested By</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<select name="reauction_request_by" id="reauction_request_by" class="form-control">
							<option value="">~~SELECT~~</option>
							<?php $q = get($dbc,"users");
							while($r = mysqli_fetch_assoc($q)): ?>
								<option value="<?=$r['user_id']?>"><?=$r['username']?></option>
							<?php endwhile ?>
						</select>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Re-Auction Approved By</label>
					</div><!-- col -->
					<div class="col-sm-8">			
							<select name="reauction_approve_by" id="reauction_approve_by" class="form-control">
							<option value="">~~SELECT~~</option>
							<?php $q = get($dbc,"users");
							while($r = mysqli_fetch_assoc($q)): ?>
								<option value="<?=$r['user_id']?>"><?=$r['username']?></option>
							<?php endwhile ?>
						</select>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Rikusou Company</label>
					</div><!-- col -->
					<div class="col-sm-8">
						<select name="ricksu_companyforReauction" id="ricksu_companyforReauction" class="form-control">
							<option value="">~~SELECT~~</option>
							<?php $q = get($dbc,"ricksu_company");
							while($r = mysqli_fetch_assoc($q)): ?>
								<option value="<?=$r['ricksu_company_id']?>"><?=$r['ricksu_company_name']?></option>
							<?php endwhile ?>
						</select>		
						
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Rikusou Fee</label>
					</div><!-- col -->
					<div class="col-sm-8">					
						<input type="text" name="ricksu_fee" id="ricksu_fee" class="form-control form-control-sm">
						<input type="text" name="reauction_id" id="reauction_id" class="form-control d-none form-control-sm">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">AUCTION HOUSE</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<select name="auction_houseforReauction" id="auction_houseforReauction" class="form-control">
							<option value="">~~SELECT~~</option>
							<?php $q = get($dbc,"auction_home");
							while($r = mysqli_fetch_assoc($q)): ?>
								<option value="<?=$r['auction_home_id']?>"><?=$r['auction_home_name']?></option>
							<?php endwhile ?>
						</select>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">AUCTION DATE</label>
					</div><!-- col -->
					<div class="col-sm-8">			
					<input type="date" name="auction_date" id="auction_date" class="form-control form-control-sm">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">START PRICE</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<input type="number" name="start_price" id="start_price" class="form-control form-control-sm">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">SALE TARGET PRICE</label>
					</div><!-- col -->
					<div class="col-sm-8">	
						<input type="number" name="sale_target_price" id="sale_target_price" class="form-control form-control-sm">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->

				<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">STATUS</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<select name="status" id="status" class="form-control">
							<option value="">~~SELECT~~</option>
							<option value="unsold">Unsold</option>
							<option value="sold">Sold</option>
						</select>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->

				<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">SALE Price</label>
					</div><!-- col -->
					<div class="col-sm-8">	
						<input type="number" name="sale_price" id="sale_price" class="form-control form-control-sm">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->

			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">RECYCLE FEE</label>
					</div><!-- col -->
					<div class="col-sm-8">	
						<input type="number" name="recycle_fee" id="recycle_fee" class="form-control form-control-sm">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->

				<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">AUCTION FEE</label>
					</div><!-- col -->
					<div class="col-sm-8">	
						<input type="number" name="auction_fee" id="auction_fee" class="form-control form-control-sm">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->

				<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">SALE FEE</label>
					</div><!-- col -->
					<div class="col-sm-8">	
						<input type="number" name="sale_fee" id="sale_fee" class="form-control form-control-sm">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->

		</div><!-- col -->
		<div class="col-sm-6">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Reason</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<textarea name="reason" id="reason" class="form-control" rows="4"></textarea>
					</div><!-- col -->
					
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Car Location</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<input type="number" name="car_location" id="car_location" class="form-control form-control-sm">
					</div><!-- col -->
					
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Setup / Stage</label>
					</div><!-- col -->
					<div class="col-sm-4">		
						<input type="text" name="vehicle_setup" id="vehicle_setup" class="form-control form-control-sm">
					</div>
					<div class="col-sm-4">
						<input type="text" name="vehicle_stage" id="vehicle_stage" class="form-control  form-control-sm">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Total Expense </label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<input type="text" name="total_exp" id="total_exp" class="form-control  form-control-sm">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			
			<div style="margin-top: 150px"></div>
			<div class="form-group mt-5 ">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Decided By</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<select name="decided_by" id="decided_by" class="form-control">
							<option value="">~~SELECT~~</option>
							<?php $q = get($dbc,"users");
							while($r = mysqli_fetch_assoc($q)): ?>
								<option value="<?=$r['user_id']?>"><?=$r['username']?></option>
							<?php endwhile ?>
						</select>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group  ">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Sold By</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<select name="sold_by" id="sold_by" class="form-control">
							<option value="">~~SELECT~~</option>
							<option value="nego">NEGO</option>
							<option value="push">PUSH</option>
						</select>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->

				<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Tax (Returning)</label>
					</div><!-- col -->
					<div class="col-sm-8">	
						<input type="number" name="sale_tax_returning" id="sale_tax_returning" class="form-control form-control-sm">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div style="margin-top: 60px"></div>
			<div class="form-group mt-5">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Tax</label>
					</div><!-- col -->
					<div class="col-sm-8">	
						<input type="number" name="auction_fee_tax" id="auction_fee_tax" class="form-control form-control-sm">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->


			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Tax</label>
					</div><!-- col -->
					<div class="col-sm-8">	
						<input type="number" name="sale_fee_tax" id="sale_fee_tax" class="form-control form-control-sm">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->

				<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Note</label>
					</div><!-- col -->
					<div class="col-sm-8">	
						<textarea name="note" id="note" class="form-control" rows="2"></textarea>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->


		</div><!-- col -->
	</div><!-- mian -->
	<?php if (@$userPrivileges['nav_add']==1 || $fetchedUserRole=="admin"): ?>
		<button type="submit" class="btn btn-primary pull pull-right btn-sm" id="saveData12">Submit</button>
	<?php endif ?>
</form>

<br><br>
<table class="table table-hover table-sm table-bordered">
	<thead>
		<tr>
			<th>Sr.</th>
			<th>Detail</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody id="reauction">
	</tbody>
</table>
					  </div>
                  	</div>
                  </div>


























</div>
</div>

<style type="text/css">
	.row{
		margin-top: 10px;
		text-align:center;
	}
</style>




<?php

include_once "includes/footer.php";
?>