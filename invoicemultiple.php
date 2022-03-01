<?php

include_once "includes/header.php";

$type = @$_GET['type'];

?>



<!-- start page content -->

            <div class="page-content-wrapper">

                <div class="page-content">

                    <div class="page-bar">

                        <div class="page-title-breadcrumb">

                            <div class=" pull-left">

                                <div class="page-title"><?=$type?></div>

                            </div>

                            <ol class="breadcrumb page-breadcrumb pull-right">

                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>

                                </li>

                                <li class="active"><?=$type?></li>

                            </ol>

                        </div>

                    </div>

			<div class="col-sm-12">

				<div class="panel">

					<div class="panel-heading cyan-bgcolor" align="center"><h4>Create <?=$type?> Report</h4></div>

						<div class="panel-body">

							<div class="row">

							<div class="col-sm-2">Customer</div>

							<div class="col-sm-2">

								<!-- <label> Customer</label> -->

								<form method="POST">

								<select class="form-control" name="customer" id="customer" >

									<option value="">~~SELECT~~</option>

									<?php

									$qa = mysqli_query($dbc,"SELECT * FROM customers WHERE customer_role = 'customer'");

									while($c = mysqli_fetch_assoc($qa)):

									?>

									<option value="<?=$c['customer_id']?>"><?=$c['customer_name']?> </option>

									<?php

										endwhile;

									?>

								</select>

								

							</div>



							

							<div class="col-sm-6 row">

								



								<div class="col-sm-6">

								<input type="date" name="fromdate" class="form-control">

								</div>

								<div class="col-sm-6">

								<input type="date" name="todate" class="form-control">

								</div>



							</div>



							<div class="col-sm-2">

								<select class="form-control" name="type" id="type">

									<option value="<?=$type?>"><?=$type?></option>

									<option value="invoice">invoice</option>

									<option value="qutation">qutation</option>

								</select>

							</div>

							<div class="col-sm-12 " >

								<input type="submit" name="getinvoices" class="btn btn-info pull pull-right">

							</div>

						</form>

							<div class="col-sm-12">

								<table class="table table-bordered"  >

									<tr>

										<th>SELECT </th>

										<th>Invoice #</th>

										<th>Customer Info</th>

										<th>Vehicle Info</th>

										<th>Sold / Reserve BY</th>

										<th>Total Amount</th>

										

										

									</tr>

									<form method="POST" action="" id="print_fm">

					<?php

					if (isset($_POST['getinvoices'])) {

						//echo $_POST['customer'];

					

					$q = mysqli_query($dbc,"SELECT * FROM invoice WHERE invoice_customer = '$_POST[customer]' OR invoice_quotation = '$_POST[type]'   ");

					//echo "SELECT * FROM invoice WHERE invoice_customer = '$_POST[customer]' AND invoice_quotation = '$_POST[type]'";

						while($row = mysqli_fetch_assoc($q)):
							$fetchCustomer=fetchRecord($dbc,"customers",'customer_id',$row['invoice_customer']);
							$vehicle=fetchRecord($dbc,"vehicle_info",'vehicle_id',$row['invoice_vehicle']);
							$maker=fetchRecord($dbc,"maker",'maker_id',$vehicle['vehicle_maker']);
							$brand=fetchRecord($dbc,"brands",'brand_id',$vehicle['vehicle_brand']);
							$user=fetchRecord($dbc,"users",'user_id',$row['invoice_user']);

					?>	

					

									<tr align="center">

										<td><input type="checkbox" name="invoice_ids[]" value="<?=$row['invoice_id']?>"></td>

										<td><?=$row['invoice_id']?></td>

										<td><?=$fetchCustomer['customer_name']?></td>

										<td><?=$maker['maker_name']?> <?=$brand['brand_name']?></td>

										<td><?=$user['username']?></td>

										<td><?=$row['invoice_grand_total']?></td>

										

										

									</tr>



											

					<?php



					endwhile;

					?>

					<tr>

						<th colspan="6" style="text-align: center;">

					<button  type="button" name="getinvoicesNow" class="btn btn-info" id="printcustomer_btn">Print Customer Invoice</button>

					<button  type="button" name="getinvoices" class="btn btn-primary" id="printcustom_btn">Print Custom Invoice</button>

					</th>

					</form>

					</tr>

			<?php		

				}

					?>				

									

								</table>

							</div>



						</div>

				</div>

			</div><!-- col-sm-12 -->



		</div><!-- upper 1 -->

		</div><!-- upper 2 -->











<script type="text/javascript">



</script>





















<?php

include_once "includes/footer.php";

?>







