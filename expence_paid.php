<?php
include_once"includes/header.php";
?>

  <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Expense Paid </div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Expense Paid </li>
                            </ol>
                        </div>
                    </div>
	<div class="col-sm-12">
				<div class="panel">
					<div class="panel-heading panel-heading-red" align="center"><h4>Expense Paid Account</h4></div>
						<div class="panel-body">
		<!-- <h1 class="text-center text-secondary">Expense Paid Account</h1> -->
		<div class="container  ">
			<h3 class="text-secondary">Auction Info</h3>
			<div class="row">
				<div class="col-12">
					<form class="form-group form-row" id="auction">
						<input class="form-control col-12 col-sm-3 col-md-3 col-lg-3 ml-4" type="date" name="date_auction" id="auction_id">
						<label for="" class="col-12 col-sm-2 col-md-2 col-lg-2 text-center ml-2" id="auction_fee_id">Fee Name</label>
						<input class="form-control col-12 col-sm-3 col-md-3 col-lg-3 ml-2" type="text" name="amount_auction" id="auction_amount_id" value="" placeholder="Amount" readonly>
						<input class="form-control col-12 col-sm-3 col-md-3 col-lg-3 ml-4" type="text" name="paid_auction" id="auction_paid_id" value="" placeholder="Paid">
					</form>
				</div>
			</div>
		</div>
		<hr>
		<div class="container  ">
			<h3 class=" text-secondary">Ricksu</h3>
			<div class="row">
				<div class="col-12">
					<form class="form-group form-row" id="ricksu">
						<input class="form-control col-12 col-sm-3 col-md-3 col-lg-3 ml-4" type="date" name="date_ricksu" id="auction_id">
						<label for="" class="col-12 col-sm-2 col-md-2 col-lg-2 text-center ml-2" id="ricksu_fee_id">Fee Name</label>
						<input class="form-control col-12 col-sm-3 col-md-3 col-lg-3 ml-2" type="text" name="amount_ricksu" id="ricksu_amount_id" value="" placeholder="Amount" readonly>
						<input class="form-control col-12 col-sm-3 col-md-3 col-lg-3 ml-4" type="text" name="paid_ricksu" id="ricksu_paid_id" value="" placeholder="Paid">
					</form>
				</div>
			</div>
		</div>
		<hr>
		<div class="container  ">
			<h3 class="text-secondary">Inspection</h3>
			<div class="row">
				<div class="col-12">
					<form class="form-group form-row" id="inspection">
						<input class="form-control col-12 col-sm-3 col-md-3 col-lg-3 ml-4" type="date" name="date_inspection" id="inspection_id">
						<label for="" class="col-12 col-sm-2 col-md-2 col-lg-2 text-center ml-2" id="inspection_fee_id">Fee Name</label>
						<input class="form-control col col-sm-3 col-md-3 col-lg-3 ml-2" type="text" name="amount_inspection" id="inspection_amount_id" value="" placeholder="Amount" readonly>
						<input class="form-control col-12 col-sm-3 col-md-3 col-lg-3 ml-4" type="text" name="paid_inspection" id="inspection_paid_id" value="" placeholder="Paid">
					</form>
				</div>
			</div>
		</div>
		<hr>
		<div class="container  ">
			<h3 class="text-secondary">Shipment</h3>
			<div class="row">
				<div class="col-12">
					<form class="form-group form-row" id="bl">
						<input class="form-control col-12 col-sm-3 col-md-3 col-lg-3 ml-4" type="date" name="date_bl" id="auction_id">
						<label for="" class="col-12 col-sm-2 col-md-2 col-lg-2 text-center ml-2" id="bl_fee_id">BL Charges</label>
						<input class="form-control col-12 col-sm-3 col-md-3 col-lg-3 ml-2" type="text" name="amount_bl" id="bl_amount_id" value="" placeholder="Amount" readonly>
						<input class="form-control col-12 col-sm-3 col-md-3 col-lg-3 ml-4" type="text" name="paid_bl" id="bl_paid_id" value="" placeholder="Paid">
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<form class="form-group form-row" id="radiation">
						<input class="form-control col-12 col-sm-3 col-md-3 col-lg-3 ml-4" type="date" name="date_radiation" id="auction_id">
						<label for="" class="col-12 col-sm-2 col-md-2 col-lg-2 text-center ml-2" id="radiation_fee_id">Radiaton Check Charges</label>
						<input class="form-control col-12 col-sm-3 col-md-3 col-lg-3 ml-2" type="text" name="amount_radiation" id="radiation_amount_id" value="" placeholder="Amount" readonly>
						<input class="form-control col-12 col-sm-3 col-md-3 col-lg-3 ml-4" type="text" name="paid_radiation" id="radiation_paid_id" value="" placeholder="Paid">
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<form class="form-group form-row" id="freight">
						<input class="form-control col-12 col-sm-3 col-md-3 col-lg-3 ml-4" type="date" name="date_freight" id="freight_id">
						<label for="" class="col-12 col-sm-2 col-md-2 col-lg-2 text-center ml-2" id="freight_fee_id">Freight Charges</label>
						<input class="form-control col-12 col-sm-3 col-md-3 col-lg-3 ml-2" type="text" name="amount_freight" id="freight_amount_id" value="" placeholder="Amount" readonly>
						<input class="form-control col-12 col-sm-3 col-md-3 col-lg-3 ml-4" type="text" name="paid_freight" id="freight_paid_id" value="" placeholder="Paid">
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<form class="form-group form-row" id="terminal">
						<input class="form-control col-12 col-sm-3 col-md-3 col-lg-3 ml-4" type="date" name="date_terminal" id="terminal_id">
						<label for="" class="col-12 col-sm-2 col-md-2 col-lg-2 text-center ml-2" id="terminal_fee_id">Terminal Handling Charges</label>
						<input class="form-control col-12 col-sm-3 col-md-3 col-lg-3 ml-2" type="text" name="amount_terminal" id="terminal_amount_id" value="" placeholder="Amount" readonly>
						<input class="form-control col-12 col-sm-3 col-md-3 col-lg-3 ml-4" type="text" name="paid_terminal" id="termianl_paid_id" value="" placeholder="Paid">
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<form class="form-group form-row" id="heat">
						<input class="form-control col-12 col-sm-3 col-md-3 col-lg-3 ml-4" type="date" name="date_heat" id="heat_id">
						<label for="" class="col-12 col-sm-2 col-md-2 col-lg-2 text-center ml-2" id="auction_fee_id">Heat Treatment Charges</label>
						<input class="form-control col-12 col-sm-3 col-md-3 col-lg-3 ml-2" type="text" name="amount_heat" id="heat_amount_id" value="" placeholder="Amount" readonly>
						<input class="form-control col-12 col-sm-3 col-md-3 col-lg-3 ml-4" type="text" name="paid_heat" id="heat_paid_id" value="" placeholder="Paid">
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<form class="form-group form-row" id="other">
						<input class="form-control col-12 col-sm-3 col-md-3 col-lg-3 ml-4" type="date" name="date_other" id="other_id">
						<label for="" class="col-12 col-sm-2 col-md-2 col-lg-2 text-center ml-2" id="other_fee_id">Other Charges</label>
						<input class="form-control col-12 col-sm-3 col-md-3 col-lg-3 ml-2" type="text" name="amount_other" id="other_amount_id" value="" placeholder="Amount" readonly>
						<input class="form-control col-12 col-sm-3 col-md-3 col-lg-3 ml-4" type="text" name="paid_other" id="other_paid_id" value="" placeholder="Paid">
					</form>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<form class="form-group form-row" id="shiping_charge">
						<input class="form-control col-12 col-sm-3 col-md-3 col-lg-3 ml-4" type="date" name="date_ship" id="ship_date_id">
						<label for="" class="col-12 col-sm-2 col-md-2 col-lg-2 text-center ml-2" id="ship_label_id">Shiping Charges</label>
						<input class="form-control col-12 col-sm-3 col-md-3 col-lg-3 ml-2" type="text" name="amount_ship" id="ship_amount_id" value="" placeholder="Amount" readonly>
						<input class="form-control col-12 col-sm-3 col-md-3 col-lg-3 ml-4" type="text" name="paid_ship" id="ship_paid_id" value="" placeholder="Paid">
					</form>
				</div>
			</div>
		</div>
		<hr>
		<div class="container  ">
			<h3 class="text-secondary">Airmail</h3>
			<div class="row">
				<div class="col-12">
					<form class="form-group form-row" id="courier">
						<input class="form-control col-12 col-sm-3 col-md-3 col-lg-3 ml-4" type="date" name="date_courier" id="courier_id">
						<label for="" class="col-12 col-sm-2 col-md-2 col-lg-2 text-center ml-2" id="courier_label_id">Courier Charges</label>
						<input class="form-control col-12 col-sm-3 col-md-3 col-lg-3 ml-2" type="text" name="amount_courier" id="courier_amount_id" value="" placeholder="Amount" readonly>
						<input class="form-control col-12 col-sm-3 col-md-3 col-lg-3 ml-4" type="text" name="paid_courier" id="courier_paid_id" value="" placeholder="Paid">
					</form>
				</div>
			</div>
		</div>
		
		</div>
	</div> 
<?php
include_once"includes/footer.php";
?>
