 <?php 
include_once "includes/header.php";
include_once "inc/code.php";

?>
<div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Reservation</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Reservation</li>
                            </ol>
                        </div>
                    </div>

			<div class="col-sm-12">
				<div class="card">
					
				<div class="card-header">
					<h4 class="text-center">
						Reservation
					</h4>
				</div>
				<div class="card-body">
					<form action="php_action/custom_action.php" method="POST" role="form" id="formData4">

	<div class="row">

		<div class="col-sm-6">

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Reserved By</label>

					</div><!-- col -->

					<div class="col-sm-8">			
						<?php 	 $user = fetchRecord($dbc,"users","user_id",$_SESSION['userId']); ?>
						<input class="form-control" readonly  value="<?=$user['user_id']?>-<?=$user['username']?>-<?=$user['phone']?>" name="reservation_by_details" id="reservation_by_details">
						<input class="form-control" type="hidden"  value="<?=$user['user_id']?>" name="reservation_by" id="reservation_by">

						
					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			
			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Sold Price</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<input type="number"  name="reservation_sold_price" id="reservation_sold_price" class="form-control form-control-sm">
						<input type="text"  readonly id="vehicle_estimated_price_view" class="form-control form-control-sm">
						<input type="hidden"  name="reservation_sold_price" id="vehicle_estimated_price" class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group" id="RefreshMine">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Customer Name</label>

					</div><!-- col -->

					<div class="col-sm-5" >			

						<!-- <input class="form-control" list="reservation_customer1" name="reservation_customer" id="reservation_customer"> -->

						<select class="form-control  w-100" list="reservation_customer1" name="reservation_customer" id="reservation_customer">

							<option value="">~~SELECT~~</option>

							<?php $q = get($dbc,"customers WHERE customer_role= 'customer' AND customer_active = 1");

							while ($r = mysqli_fetch_assoc($q)):?>

								<option value="<?=$r['customer_id']?>"><?=$r['customer_id']?>-<?=$r['customer_name']?> (<?=$r['customer_contact_person']?>-<?=$r['customer_country']?>)</option>


							<?php endwhile ?>

						</select>

					</div><!-- col -->

					<div class="col-sm-3">

						<a href="customers.php?type=customer" target="_blank" class="btn btn-primary"><span class="fa fa-plus"></span></a>

						<!-- <button class="btn btn-info" id="refresh_btn" onclick="refreshCall()"><span class="fa fa-refresh" ></span></button> -->

						<a href="#" class="btn btn-info" id="refresh_btn" onclick="refreshCall()"><span class="fa fa-refresh" ></span></a>

						<!-- <input type="text" name="reservation_customer3" readonly="readonly" id="reservation_customer3" class="form-control form-control-sm"> -->



					</div>

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for=""></label>

					</div><!-- col -->

					<div class="col-sm-8">	

					<input type="text" name="reservation_customer3" readonly="readonly" id="reservation_customer3" class="form-control form-control-sm">		

						

					</div><!-- col -->

					

				</div><!-- inner row -->

			</div><!-- form group -->

			<?php 

				$today = date("Y-m-d");

				$date = strtotime("+3 day", strtotime($today));

				$newDate = date("Y-m-d", $date);

			?>

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Reservation Date</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<input type="date" readonly  name="reservation_date" value="<?=$today?>" id="reservation_date" class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Reservation Start Date</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<input type="date"  readonly name="reservation_start_date" value="<?=$today?>" id="reservation_start_date" class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Reservation Expiry Date</label>

					</div><!-- col -->

					<div class="col-sm-8">	

						<input type="date"  readonly name="reservation_expiry_date" value="" id="reservation_expiry_date" class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

		</div><!-- col -->

		<div class="col-sm-6">
			<div class="form-group">
				

				<div class="row">

					<div class="col-sm-4">

						<label for="">Vehicle</label>

					</div><!-- col -->

					<div class="col-sm-8">
						<select class="form-control vehicle_idMain" name="vehicle_id" id="res_vehicle_id">
							<option value="">Select Vehicle</option>
							<?php 
								$q= mysqli_query($dbc,"SELECT vehicle_info.*,brands.*,maker.* FROM vehicle_info INNER JOIN brands ON brands.brand_id =vehicle_info.vehicle_brand INNER JOIN maker ON maker.maker_id =vehicle_info.vehicle_maker WHERE vehicle_info.vehicle_status!='sold'");
								
								if (mysqli_num_rows($q)>0) {
									# code...
								
								while ($r=mysqli_fetch_assoc($q)) {
								
							 ?>
							 	<option value="<?=$r['vehicle_id']?>"><?=strtoupper($r['vehicle_stock_id'])?>-<?=$r['maker_name']?> <?=$r['brand_name']?><br>-(<?=$r['vehicle_chassis_no']?>-<?=$r['vehicle_chassis_code']?>)</option>
							 <?php } } ?>
						</select>
					</div><!-- col -->

				</div><!-- inner row -->

			
			</div>
			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Peyement Term</label>

					</div><!-- col -->

					<div class="col-sm-8">	

						<input type="number" class="form-control" list="reservation_payement1" name="reservation_payement" id="reservation_payement">

						<datalist id="reservation_payement1">

							<option value="">~~SELECT~~</option>

							<?php 

								$i  = 5;

								while ($i <= 100) {?>

								<option value="<?=$i?>"><?=$i?>%</option>

							<?php

							    echo $i;

							    $i += 5;

								}

							?>

						</datalist>

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Que No.</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						
						<input type="number" readonly value="" name="reservation_que" id="reservation_que" class="form-control form-control-sm">

						<input type="text" name="reservation_id" id="reservation_id" class="form-control form-control-sm d-none">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Note</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<textarea name="reservation_note" id="reservation_note" class="form-control" rows="4"></textarea>

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Status</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<select class="form-control" id="reservation_sts" name="reservation_sts">

							<option value="">~~SElECT~~</option>

							<option value="1">Active</option>

							<option value="0">Deactive</option>

						</select>

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

		</div><!-- col -->

	</div><!-- mian -->


			<div class="row">
			<div class="col-12">
			
				<button type="submit" class="btn btn-primary float-right ml-3"   id="formData4_save" >Save</button>
			</div>
	</div>

</form>
				</div>
					
				</div>
			</div>

<div class="card">
	<div class="card-header">
		<h4>Reservation List</h4>
	</div>
	<div class="card-body">
		<table class="table t table-sm data-table">

	<thead>

		<tr>

			<th>Sr.</th>
			<th>Reservation By</th>
			<th>Reservation For</th>
			<th>Vehicle Info</th>
			<th>Payment</th>
			<th>Sold Price</th>
			<th>Start Date</th>
			<th>End Date</th>
			<th>Reservation Status</th>
			<th>Reservation Que</th>
			<th>Action</th>

		</tr>

	</thead>

	<tbody id="employe_reservation_tb">

						
							<?php 
							$x=0;
		 	$q = mysqli_query($dbc,"SELECT * FROM  reservation WHERE reservation_by='".$_SESSION['userId']."'  ");
		 	 // echo "SELECT  reservation.*,customers.*,users.* FROM reservation INNER JOIN customers ON customers.customer_id = reservation.reservation_customer INNER JOIN users ON users.user_id = reservation.reservation_by WHERE reservation.reservation_by='".$_SESSION['userId']."'";
				//*,customers.*,users.* FROM reservation INNER JOIN customers ON customers.customer_id = reservation.reservation_customer INNER JOIN users ON users.user_id = reservation.reservation_by WHERE reservation
				while ($r=mysqli_fetch_assoc($q)) {
					$customers=fetchRecord($dbc,"customers","customer_id",$r['reservation_customer']);

					$users=fetchRecord($dbc,"users","user_id",$r['reservation_by']);
					$vehicleNow= mysqli_fetch_assoc(mysqli_query($dbc,"SELECT vehicle_info.*,brands.*,maker.* FROM vehicle_info INNER JOIN brands ON brands.brand_id =vehicle_info.vehicle_brand INNER JOIN maker ON maker.maker_id =vehicle_info.vehicle_maker WHERE vehicle_info.vehicle_id='".$r['vehicle_id']."'"));
						//echo "SELECT vehicle_info.*,brands.*,maker.* FROM vehicle_info INNER JOIN brands ON brands.brand_id =vehicle_info.vehicle_brand INNER JOIN maker ON maker.maker_id =vehicle_info.vehicle_maker WHERE vehicle_info.vehicle_id='".$r['vehicle_id']."'";
					// var_dump($vehicleNow);
					// 	echo $vehicleNow['vehicle_id'];
								
					$x++;
							 ?>	
							 	<tr>
                                    <td><?=$x?></td>
                                    <td><?=$users['username']?></td>
                                    <td><?=$customers['customer_name']?></td>
                                    <td><?=$vehicleNow['vehicle_id']?>-<?=$vehicleNow['maker_name']?>-<?=$vehicleNow['brand_name']?>- <button onclick="loadData('vehicle_info',<?=$r['vehicle_id']?>)" class="dropdown-item text-success view">See More</button>
</td>
                                    <td><?=$r['reservation_payement']?></td>
                                    <td><?=$r['reservation_sold_price']?></td>
                                    <td><?=$r['reservation_start_date']?></td>
                                    <td><?=$r['reservation_expiry_date']?></td>
                                     <td>
                                     	<?php if ($r['reservation_sts']==0): ?>
                                     		<span class="label label-danger">Deactive</span>
                                     	<?php endif ?>
                                     	<?php if ($r['reservation_sts']==1): ?>
                                     		<span class="label label-primary">Active</span>
                                     	<?php endif ?>
                                     	<?php if ($r['reservation_sts']==2): ?>
                                     		<span class="label label-warning">Expired</span>
                                     	<?php endif ?>
                                     	

                                     </td>
                                    <td><?=$r['reservation_que']?></td>
                                    <td><?php if ($r['user_id']==$_SESSION['userId']): ?>
                                    	<a href="#"><span class="text-danger" onclick="editReservation(<?=$r['reservation_id']?>)">Edit</span></a>
                                    <?php endif ?>
                                   </td>
                                </tr>	 
		<?php }  ?>
						
	</tbody>

</table>
	</div>

</div>

	</div></div>

<div class="modal fade" id="modal-id">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <div class="modal-header">

        <h4 class="modal-title"></h4>

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

      </div>

      <div class="modal-body" id="loadData">

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>

    </div>

  </div>

</div>

<?php
include_once "includes/footer.php";
?>
<script type="text/javascript">
	  $('#reservation_start_date').trigger('change');
</script>