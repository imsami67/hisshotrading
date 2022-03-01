 <?php  

	require_once("custom/vendor/autoload.php");

?>
<?php  @$id = $_GET['vehicle_id'];
 
                      @$stock = fetchRecord($dbc,"vehicle_info","vehicle_id",$_GET['vehicle_id']);
 ?>

<div class="row d-none">
	<div  class="col-12">
		<button type="button" onclick="refreshForm('vehicle',<?=@$id?>)" class="btn btn-sm btn-primary">Refresh</button>
	</div>
</div>

<form action="php_action/custom_action.php" method="POST" role="form" id="formData1">

        <?php 

	        @$id = $_GET['vehicle_id'];

			$q = mysqli_query($dbc,"SELECT vehicle_id FROM vehicle_info ORDER BY vehicle_id DESC");

			$abc = mysqli_num_rows($q)+1;

	    ?>

	    <div class="vehicel_main_form">

	<input type="text" value="<?=@$id?>" class="vehicle_idMain d-none" name="vehicle_id">

	<div class="row">

		<div class="col-sm-4">

			<div class="form-group">

				<label for="">Stock ID</label>			

				<div class="row">

					<div class="col-sm-6">

						<select tabindex="1" name="vehicle_stock_pre" id="vehicle_stock_pre" class="form-control" required>	


								<option value="HX-<?=date('y')?>">HX-<?=date('y')?></option>	 

								<option value="HS-<?=date('y')?>">HJ-<?=date('y')?></option>	 

								<option value="HT-<?=date('y')?>">HD-<?=date('y')?></option>	

								<option value="HL-<?=date('y')?>">NL-<?=date('y')?></option>	

						</select>

					</div><!-- col -->

					<div class="col-sm-6 customStockIDEDIT">

						<input type="text" value="<?=sprintf("%03d", $abc)?>" readonly name="vehicle_stock_id" id="vehicle_stock_id" class="form-control form-control-sm">

					</div><!-- col -->



				</div> <!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<label for="">Manufacture Year.</label>			

				<div class="row">

					<div class="col-sm-6">

						<!-- <input list="manu_year" name="vehicle_manu_year" id="vehicle_manu_year" class="form-control"> -->

						<select tabindex="1" list="manu_year" onchange="validateyears()" name="vehicle_manu_year" id="vehicle_manu_year" class="form-control" >

						<!-- <datalist id="manu_year"> -->

							<option value="">~~SELECT~~</option>

							<?php

								$date = date('Y');

								for ($i = $date; $i >= 1900; $i--) {?>

									<option value="<?=$i?>"><?=$i?></option>

								<?php

									} 

				     			?>

						<!-- </datalist> -->

						</select>

					</div><!-- ccol -->

					<div class="col-sm-6">

						<!-- <input type="text" name="vehicle_manu_month" id="vehicle_manu_month" class="form-control form-control-sm"> -->

						

					<select tabindex="2" name="vehicle_manu_month" id="vehicle_manu_month" onchange="validatemonth()" class="form-control" >

							<option data-id="0" value="">~~SELECT~~</option>

							<option data-id="1" value="jan">Jan</option>

							<option data-id="2" value="feb">Feb</option>

							<option data-id="3" value="march">March</option>

							<option data-id="4" value="april">April</option>

							<option data-id="5" value="may">May</option>

							<option data-id="6" value="june">June</option>

							<option data-id="7" value="july">July</option>

							<option data-id="8" value="august">August</option>

							<option data-id="9" value="september">September</option>

							<option data-id="10" value="october">October</option>

							<option data-id="11" value="november">November</option>

							<option data-id="12" value="necember">December</option>

					</select>

					</div><!-- ccol -->

				</div>

			</div><!-- form group -->



			<!-- <div class="form-group">

				<label for="vehicle_mode">Manufacturing Month</label>

			</div> -->

	  		<div class="form-group">

				<label for="">Chassis Code</label>			

				<!-- <input type="text"  class="form-control form-control-sm"> -->

				<select name="vehicle_chassis_code" id="vehicle_chassis_code" class="form-control" required="required" style="text-transform: uppercase ">

					<option value="">~~SELECT~~</option>

					<?php $q = get($dbc,"models WHERE model_sts = '1'");

					while($r = mysqli_fetch_assoc($q)): ?>

						<option value="<?=$r['model_id']?>" style="text-transform: uppercase!important;"><?=$r['model_name']?></option>

							<?php endwhile ?>

				</select>

			</div><!-- form group -->

			<div class="form-group">

				<label for="">Engine No.</label>			

				<input type="text" name="vehicle_engine_no" id="vehicle_engine_no" class="form-control form-control-sm text-capitalize">

			</div><!-- form group -->

			<div class="form-group">

				<label for="">Transmission</label>

				<!-- <input list="vehicle_transmission1" required="required" name="vehicle_transmission" id="vehicle_transmission" class="form-control"> -->

				<select list="vehicle_transmission1" required="required" name="vehicle_transmission" id="vehicle_transmission" class="form-control">

					<option value="">~~SELECT~~</option>

					<?php $q = get($dbc,"transmission WHERE transmission_sts = '1'");

					while($r = mysqli_fetch_assoc($q)): ?>

						<option <?=@(ucwords($r['transmission_name'])==ucwords($stock['vehicle_transmission']))?"selected":""?> value="<?=$r['transmission_name']?>"><?=$r['transmission_name']?></option>

							<?php endwhile ?>

				</select>			

			</div><!-- form group -->

			<div class="form-group">

				<label for="">Interior Grade</label>

				<!-- <input list="vehicle_interior1" autocomplete="off" name="vehicle_interior" id="vehicle_interior" class="form-control"> -->

				<select list="vehicle_interior1" autocomplete="off" name="vehicle_interior" id="vehicle_interior" class="form-control">

					<option value="">~~SELECT~~</option>

					<?php $q = get($dbc,"interior_grade WHERE interior_grade_sts = '1'");

					while($r = mysqli_fetch_assoc($q)): ?>

						<option <?=@(ucwords($r['interior_grade_name'])==ucwords($stock['vehicle_interior']))?"selected":""?> class="text-capitalize" value="<?=ucwords($r['interior_grade_name'])?>"><?=ucwords($r['interior_grade_name'])?></option>

					<?php endwhile ?>

				</select>			

			</div><!-- form group -->

			<div class="form-group">

				<label for="">Seats</label>

				<!-- <input list="vehicle_seat1" name="vehicle_seat" id="vehicle_seat" class="form-control"> -->

				<select  list="vehicle_seat1" name="vehicle_seat" id="vehicle_seat" class="form-control">

					<option value="">~~SELECT~~</option>

					<?php $q = get($dbc,"seats WHERE seats_sts = '1'");

					while($r = mysqli_fetch_assoc($q)): ?>

						<option value="<?=$r['seats_name']?>"><?=$r['seats_name']?></option>

							<?php endwhile ?>

				</select>			

			</div><!-- form group -->

		

		<div class="form-group">

				<label for="">Color Name</label>

				<select list="vehicle_color_name1" autocomplete="off" onchange="loadcolorCode(this.value)" name="vehicle_color_name" id="vehicle_color_name" required="required" class="form-control">

					<option value="">~~SELECT~~</option>

						<?php $q = mysqli_query($dbc,"SELECT DISTINCT color_name FROM color_code WHERE color_code_sts = '1'");

						while($r = mysqli_fetch_assoc($q)): ?>

					<option value="<?=$r['color_name']?>"><?=$r['color_name']?></option>

					<?php endwhile ?>

				</select>			

			</div><!-- form group -->

			<div class="form-group">

				<label for="">Lenght(cm)</label>			

				<input type="number" name="vehicle_length" id="vehicle_length" required="required" class="form-control form-control-sm forM3">

			</div><!-- form group -->

			<div class="form-group">

				<label for="">M3</label>			

				<input type="text" name="vehicle_m3" required="required" id="vehicle_m3" class="form-control form-control-sm">

			</div><!-- form group -->

			<div class="form-group">

				<label for="">Accessories</label>			

				<input type="text" name="vehicle_access" required="required" id="vehicle_access" class="form-control form-control-sm">

			</div><!-- form group -->



			<!-- Notes -->



		</div><!-- col -->

		<div class="col-sm-4">

			<div class="form-group">

				<label for="">Maker.</label>			

				<select tabindex="2" name="vehicle_maker" onchange="loadBrands(this.value)" id="vehicle_maker" class="form-control abcCustomNew vehicle_maker" required="required">

					<option value="">~~SELECT~~</option>

					<?php $q = get($dbc,"maker WHERE maker_sts = '1'");

					while($r = mysqli_fetch_assoc($q)): ?>

						<option value="<?=$r['maker_id']?>"><?=$r['maker_name']?></option>

							<?php endwhile ?>

				</select>

			</div><!-- form group -->

			<div class="form-group">

				<label for="">Registration Year.</label>			

				<!-- <input list="vehicle_reg_month1" name="vehicle_reg_month" id="vehicle_reg_month" class="form-control" required="required" readonly> -->

				<select list="vehicle_reg_month1" name="vehicle_reg_year" id="vehicle_reg_year" class="form-control vehicle_reg_month" required="required" onchange="validateyears()">

					<option value="">~~SELECT~~</option>

					<?php

						$date = date('Y');

						for ($i = $date; $i >= 1900; $i--) {?>

							<option value="<?=$i?>"><?=$i?></option>

						<?php

							} 

		     			?>

				</select>

			</div><!-- form group -->

			<div class="form-group">

				<label for="">Chassis No.</label>			

				<input type="text" name="vehicle_chassis_no" id="vehicle_chassis_no" class="form-control form-control-sm vehicle_chassis_no">

			</div><!-- form group -->

			<div class="form-group">

				<label for="">Engine CC</label>

				<!-- <input list="vehicle_cc1" name="vehicle_cc" id="vehicle_cc" class="form-control" required="required"> -->

				<select list="vehicle_cc1" name="vehicle_cc" id="vehicle_cc" class="form-control" required="required">

				 <option value="">~~SELECT~~</option>

					<?php $q = get($dbc,"cc WHERE cc_sts = '1'");

					while($r = mysqli_fetch_assoc($q)): ?>

						<option value="<?=$r['cc_name']?>"><?=$r['cc_name']?></option>

					<?php endwhile ?>

				</select>			

			</div><!-- form group -->

			<div class="form-group">

				<label for="">Fuel</label>

				<!-- <input list="vehicle_fuel1" name="vehicle_fuel" id="vehicle_fuel" class="form-control" required="required"> -->

				<select  list="vehicle_fuel1" name="vehicle_fuel" id="vehicle_fuel" class="form-control" required="required">

					<option value="">~~SELECT~~</option>

					<?php  $q = get($dbc,"fuel WHERE fuel_sts = '1'");

					while($r = mysqli_fetch_assoc($q)): ?>

						<option <?=@(strtolower($r['fuel_name'])==strtolower($stock['vehicle_fuel']))?"selected":""?> value="<?=$r['fuel_name']?>"><?=$r['fuel_name']?></option>

					<?php endwhile ?>

				</select>			

			</div><!-- form group -->

			<div class="form-group">

				<label for="">Exterior Grade</label>

				<!-- <input list="vehicle_exterior1" autocomplete="off" name="vehicle_exterior" id="vehicle_exterior" class="form-control"> -->

				<select list="vehicle_exterior1" autocomplete="off" name="vehicle_exterior" id="vehicle_exterior" class="form-control" >

					<option value="">~~SELECT~~</option>

					<?php $q = get($dbc,"exterior_grade WHERE exterior_grade_sts = '1'");

							while($r = mysqli_fetch_assoc($q)): ?>

						<option  <?=@(ucwords($r['exterior_grade_name'])==ucwords($stock['vehicle_exterior']))?"selected":""?> class="text-capitalize" value="<?=ucwords($r['exterior_grade_name'])?>"><?=ucwords($r['exterior_grade_name'])?></option>

					<?php endwhile ?>

				</select>			

			</div><!-- form group -->

			<div class="form-group">

				<label for="">Doors</label>

				<!-- <input list="vehicle_door1" name="vehicle_door" id="vehicle_door" required="required" class="form-control"> -->

				<select list="vehicle_door1" name="vehicle_door" id="vehicle_door" required="required" class="form-control">

					<option value="">~~SELECT~~</option>

					<?php $q = get($dbc,"doors WHERE doors_sts = '1'");

							while($r = mysqli_fetch_assoc($q)): ?>

						<option value="<?=$r['doors_name']?>"><?=$r['doors_name']?></option>

					<?php endwhile ?>

				</select>			

			</div><!-- form group -->

		<div class="form-group">

				<label for="">Color Code</label>

				<!-- <input list="vehicle_color1" name="vehicle_color" id="vehicle_color" class="form-control"> -->

				<input list="vehicle_color_code_name" name="vehicle_color"  id="vehicle_color" class="form-control">

					

					<datalist id="vehicle_color_code_name">

					</datalist>

				</select>			

			</div><!-- form group -->

			<div class="form-group">

				<label for="">Width(cm)</label>			

				<input type="text" name="vehicle_width" id="vehicle_width" required="required" class="form-control form-control-sm forM3">

			</div><!-- form group -->

			<div class="form-group">

				<label for="">Loading Capacity (kg)</label>			

				<input type="number" name="vehicle_loading_capacity" id="vehicle_loading_capacity"  class="form-control form-control-sm">

			</div><!-- form group -->

			<div class="form-group">

				<label for="">KM.</label>			

				<input type="number" name="vehicle_km" id="vehicle_km" required="required" class="form-control form-control-sm">

			</div><!-- form group -->

		</div><!-- col -->

		<div class="col-sm-4">

			<div class="form-group">

				<label for="">Brand</label>			

				<select tabindex="3" name="vehicle_brand" onchange="loadChassis(this.value)" id="vehicle_brand" class="form-control fuckJS vehicle_brand" required="required">

					<!-- <option class="fuckJS" value="">~~SELECT~~</option>

					<option value="">~~SELECT~~</option>

					<?php $q = get($dbc,"brands WHERE brand_status = '1'");

					while($r = mysqli_fetch_assoc($q)): ?>

						<option value="<?=$r['brand_id']?>"><?=$r['brand_name']?></option>

							<?php endwhile ?> -->

				</select>

			</div><!-- form group -->

			<div class="form-group">

<label>Registration Month</label>		

					<select name="vehicle_reg_month" onchange="validatemonth()" id="vehicle_reg_month" class="form-control" required="required" >

							<option data-id="0" value="">~~SELECT~~</option>

							<option data-id="1" value="jan">Jan</option>

							<option data-id="2" value="feb">Feb</option>

							<option data-id="3" value="march">March</option>

							<option data-id="4" value="april">April</option>

							<option data-id="5" value="may">May</option>

							<option data-id="6" value="june">June</option>

							<option data-id="7" value="july">July</option>

							<option data-id="8" value="august">August</option>

							<option data-id="9" value="september">September</option>

							<option data-id="10" value="october">October</option>

							<option data-id="11" value="november">November</option>

							<option data-id="12" value="december">December</option>

					</select>

			</div><!-- form group -->

			<div class="form-group">

				<label for="">Drive</label>

				<!-- <input list="vehicle_drive1" name="vehicle_drive" id="vehicle_drive" class="form-control" required="required"> -->

				<select list="vehicle_drive1" name="vehicle_drive" id="vehicle_drive" class="form-control" required="required">

					<option value="">~~SELECT~~</option>

					<?php $q = get($dbc,"drive WHERE drive_sts = '1'");

							while($r = mysqli_fetch_assoc($q)): ?>

						<option <?=@(strtolower($r['drive_name'])==strtolower($stock['vehicle_drive']))?"selected":""?> value="<?=$r['drive_name']?>"><?=$r['drive_name']?></option>

					<?php endwhile ?>

				</select>			

			</div><!-- form group -->

			<div class="form-group">

				<label for="">Engine Type</label>			

				<input type="text" name="vehicle_engine_type" id="vehicle_engine_type" class="form-control form-control-sm text-capitalize">

			</div><!-- form group -->

			<div class="form-group">

				<label for="">Package</label>

				<input list="vehicle_package1" value="<?=@$stock['vehicle_package']?>" name="vehicle_package" id="vehicle_package" class="form-control" autocomplete="off">



				<datalist id="vehicle_package1" >

					<option value="">~~SELECT~~</option>

						<?php //$q = get($dbc,"package WHERE pack_sts = '1'");

						$q = mysqli_query($dbc,"SELECT DISTINCT(pack_name) FROM package WHERE pack_sts = '1' ");

						while($r = mysqli_fetch_assoc($q)): ?>

							<option value="<?=$r['pack_name']?>"><?=$r['pack_name']?></option>

						<?php endwhile ?>

				</datalist>			

			</div><!-- form group -->

			<div class="form-group">

				<label for="">Auction Grade</label>

				<!-- <input list="vehicle_grade1" autocomplete="off" name="vehicle_grade" id="vehicle_grade" class="form-control"> -->

				<select  name="vehicle_grade" id="vehicle_grade" class="form-control">

					<option value="">~~SELECT~~</option>

					<?php $q = get($dbc,"auction_grade WHERE auction_grade_sts = '1'");

							while($r = mysqli_fetch_assoc($q)): ?>

						<option <?=@(ucwords($r['auction_grade_name'])==ucwords($stock['vehicle_grade']))?"selected":""?> value="<?=strtoupper($r['auction_grade_name'])?>"><?=ucwords($r['auction_grade_name'])?></option>

					<?php endwhile ?>

				</select>			

			</div><!-- form group -->

			<div class="form-group">

				<label for="">Steering </label>

				<!-- <input list="vehicle_option1" name="vehicle_option" id="vehicle_option" class="form-control" required="required"> -->

				<select  name="vehicle_option" id="vehicle_option" class="form-control" >

					<option value="">~~SELECT~~</option>

					<?php $q = get($dbc,"options WHERE option_sts = '1'");

							while($r = mysqli_fetch_assoc($q)): ?>

						<option <?=(strtoupper(@$stock['vehicle_option'])==strtoupper($r['option_name']))?"selected":""?> value="<?=strtoupper($r['option_name'])?>"><?=$r['option_name']?></option>

					<?php endwhile ?>

				</select>			

			</div><!-- form group -->

			<div class="form-group">

				<label for="">Interior Color</label>			

				<input type="text" name="vehicle_interior_color" id="vehicle_interior_color" class="form-control form-control-sm">

			</div><!-- form group -->

			<div class="form-group">

				<label for="">Height(cm)</label>			

				<input type="text" name="vehicle_height" required="required" id="vehicle_height" class="form-control form-control-sm forM3">

			</div><!-- form group -->

			

			<div class="form-group">

				<label for="">Total Weight (kg)</label>			

				<input type="number" name="vehicle_weight" id="vehicle_weight" required="required" class="form-control form-control-sm">

			</div><!-- form group -->

			<div class="form-group">

				<label for="">KM 2.</label>			

	 			<input type="text" name="vehicle_km2" id="vehicle_km2" class="form-control form-control-sm">

			</div><!-- form group -->

		</div><!-- col -->

	</div><!-- mian -->

	<div class="row">

		<div class="col-sm-4">

			<label for="">Vehicle Type</label>			

			<select name="vehicle_type" id="vehicle_type" class="form-control">

						<option value="">~~SELECT~~</option>

				<?php $q = get($dbc,"body_type WHERE body_type_sts = '1'");

							while($r = mysqli_fetch_assoc($q)): ?>

						<option value="<?=$r['body_type_id']?>"><?=$r['body_type_name']?></option>

					<?php endwhile ?>

			</select>

		</div>

		<div class="col-sm-4">

			<div class="form-group">

				<label for="">Video URL</label>			

				<input type="text" name="vehicle_url" id="vehicle_url" class="form-control form-control-sm">

			</div><!-- form group -->

		</div>

		<div class="col-sm-4">

			<div class="form-group">

				<label for="">Sale Rate</label>			

				<input type="number" name="vehicle_est_price" id="vehicle_est_price" required="required" class="form-control form-control-sm">

			</div><!-- form group -->

		</div>

	</div><!-- row -->

	<div class="row">

		<div class="col-sm-4">

			<div class="form-group">

				<label for="vehicle_mode">Vehicle Mode</label>

				<select name="vehicle_mode" id="vehicle_mode" class="form-control">

					<option value=""></option>

					<option value="discount">Discount</option>

					<option value="premium">Premium</option>

				</select>

			</div>

			<div class="form-group">

				<label for="vehicle_discount">Discount %</label>

				<input type="number" name="vehicle_discount" value="<?=@$stock['vehicle_discount']?>" id="vehicle_discount" class="form-control form-control-sm">

			</div>

		</div>

		<div class="col-sm-8">

			<label for="vehicle_note">Narration / Note / Hint</label>

			<textarea name="vehicle_note" placeholder="Note / HINT / Narration" id="vehicle_note" class="form-control" rows="5"></textarea>

		</div><!-- col -->

	</div><!-- row -->

		<?php		if(!empty($id)){

			?>

	<div class="row refresh_vehicle_doc">

		<div class="col-sm-8">

			<label for="auction_sheet">Auction Sheet</label>

			<input type="file" name="auction_sheet" id="auction_sheet" value="00" class="hidden"><br/>

			

			
			<?php

//$d = get($dbc,"airmail_files WHERE file_title = 'Ownership Certificate' AND vehicle_id = '$id'");

$d  = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM airmail_files WHERE file_title ='auction_sheet' AND vehicle_id = '$id'"));

//echo $d['file_title'];

if(@$d['file_title'] == 'auction_sheet'){

?>
	<a href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn btn-success">View</a>
	<a href="img/vehicle_docs/<?=$d['airmail_file_name']?>" download target="_blank" class="btn btn-info">Download</a>


<?php

}else{?>
	<a href="vehicle_docs.php?vehicle_id=<?=$id?>&name=auction_sheet" target="_blank" class="btn btn-primary">Add</a>

	<?php } ?>
</div></div>

<?php }

?>

	<br> 
<?php if (!isset($_REQUEST['vehicle_id']) AND @$userPrivileges['nav_add']==1 || $fetchedUserRole=="admin"): ?>
	<button type="submit" class="btn btn-primary float-left" id="saveData1">Submit</button>
<?php endif ?>
<?php if (isset($_REQUEST['vehicle_id']) AND @$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): ?>
	<button type="submit" class="btn btn-warning float-left" id="saveData1">Save and Next</button>
<?php endif ?>

	<button type="button" class="btn btn-info float-right <?=$act?>" data-toggle="modal" data-target="#modal-default">Payment Info</button>

	  <div class="modal fade" id="modal-default">

        <div class="modal-dialog">

          <div class="modal-content">

            <div class="modal-header">

              <h4 class="modal-title">Payment Info</h4>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <span aria-hidden="true">&times;</span>

              </button>

            </div>

            <div class="modal-body">

              <table class="table table-inverse">

              	

              	<thead>

        			<tr>

        				<th>Invoice Id</th>

        				<th>Customer Name</th>

        				<th>Sold Amount</th>

        				<th>Received Amount</th>

        			</tr>

              	

              	</thead>

             <tbody>

             	<?php  $get_customer=mysqli_query($dbc,"SELECT SUM(credit-debit) as nowbalance,invoice_id,customer_id,vehicle_id  FROM transactions WHERE vehicle_id = '$id' GROUP BY vehicle_id");

			while($fetchTrans=mysqli_fetch_assoc($get_customer)):

				$invoice=fetchRecord($dbc,"invoice","invoice_id",$fetchTrans['invoice_id']);

				$customer = fetchRecord($dbc, "customers", "customer_id", $fetchTrans['customer_id']);

				$vehicle = fetchRecord($dbc,"vehicle_info","vehicle_id",$fetchTrans['vehicle_id']);

                $maker = fetchRecord($dbc,"maker","maker_id",$vehicle['vehicle_maker'])['maker_name'];

                $brand = fetchRecord($dbc,"brands","brand_id",$vehicle['vehicle_brand'])['brand_name'];

                $debit=0;

           

			if ($fetchTrans['nowbalance']!=0) {?>

       			<tr>

       				<td><?=@$fetchTrans['invoice_id']?></td>

       				<td><?=@$customer['customer_name']?></td>

       				<td><?=@$invoice['invoice_grand_total']?></td>

       				<td><?=@$fetchTrans['nowbalance']?></td>



       			</tr><?php } endwhile; ?>



              </tbody>

              <tfoot>

              	<tr>

             		<th>Total Cost</th><td><?=@getTotalCost($dbc,$id); ?></td>

             		<th>Total Expense</th><td><?=@getTotalExpense($dbc,$id ); ?></td>

             	</tr>

              </tfoot>

              </table>

            </div>

            <div class="modal-footer justify-content-between">

              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>            </div>

          </div>

          <!-- /.modal-content -->

        </div>

        <!-- /.modal-dialog -->

      </div>

      <!-- /.modal -->



	</div>

</form>



	<div class="feature_form">

		<form action="php_action/custom_action.php" method="POST" role="formData15">

		<input type="text" value="<?=@$id?>" class="vehicle_idMain d-none" name="vehicle_id">	

			<div class="row">

				<?php 

				$q1 = get($dbc,"vehicle_feature WHERE vehicle_feature_sts = 1 GROUP BY vehicle_feature_category ASC");

				foreach ($q1 as $index => $value):?>

				<div class="col-sm-2">	

					<div class="form-group">

						<strong><?=ucwords($value['vehicle_feature_category'])?></strong><br>

						<?php 

						$x = 0;

						@$vehicle_id = $_GET['vehicle_id'];

						$q = get($dbc,"vehicle_feature WHERE vehicle_feature_sts = '1' AND vehicle_feature_category = '".$value['vehicle_feature_category']."'");

						while ($r = mysqli_fetch_assoc($q)):?>

							<label class="text-capitalize" for="_<?=$x.$index?>"><?=$r['vehicle_feature_name']?></label>

							<input class="float-right" id="_<?=$x.$index?>" type="checkbox" name="vehicle_feature_list[]" <?php getChecked($dbc, $vehicle_id, $r['vehicle_feature_name']);?> value="<?=$r['vehicle_feature_name']?>"><br>

						<?php 

							$x++;

							endwhile

						?>

					</div>	

				</div>

				<?php 

					endforeach;

					function getChecked($dbc, $vehicle_id, $newValue){

						if ($vehicle_id != "") {

							$q2 = mysqli_query($dbc,"SELECT vehicle_feature_list FROM vehicle_info WHERE vehicle_id = '$vehicle_id'");

							$r2 = mysqli_fetch_assoc($q2);

							if (!empty($r2['vehicle_feature_list'])) {

								# code...

							

							$new_array = json_decode($r2['vehicle_feature_list']);

							foreach ($new_array as $index => &$value) {

								if ($newValue == $value) {

									echo "checked";

									return false;

								}else{

									echo "";

								}

							}

						}}

					}

				?>

			</div>

			<button type="submit" class="btn btn-primary" id="featureBtn">Save</button>

		</form>

	</div>



<br>



<table class="table table-hover table-sm table-bordered d-none">

	<thead>

		<tr>

			<th>Sr.</th>

			<th>Detail</th>

			<th>Action</th>

		</tr>

	</thead>

	<tbody id="vehicle_idTable">

	</tbody>

</table>



<script type="text/javascript">
	function validateyears(){
		var from_year = $("#vehicle_manu_year").val();
		var to_year = $("#vehicle_reg_year").val();
		var from_month = $("#vehicle_manu_month :selected").data('id');
		var to_month = $("#vehicle_reg_month :selected").data('id');
		var result = 0;
	
	if (from_year > to_year) {
			  //$("#vehicle_reg_month").foucs();
			   sweeetalertbtn("Warning","Registration Year should NOT be lower than manufacturing Year",'warning');
		 $('#vehicle_reg_year').prop('selectedIndex',0);
		 	 $('#vehicle_reg_month').prop('selectedIndex',0);

			// $('.vehicle_reg_month').removeAttr('selected').find('option:first').attr('selected', 'selected');
			
		 }
		

		
	}
	function validatemonth(){
		var from_year = $("#vehicle_manu_year").val();
		var to_year = $("#vehicle_reg_year").val();
		var from_month = $("#vehicle_manu_month :selected").data('id');
		var to_month = $("#vehicle_reg_month :selected").data('id');
		var result = 0;
	if (from_month!=0 ) {
		
		if( from_year==to_year){
			if (from_month > to_month) {
			
			 
              sweeetalertbtn("Warning","Registration Month should NOT be lower than manufacturing Month ",'warning');
			 
		 $('#vehicle_reg_month').prop('selectedIndex',0);
			// $('.vehicle_reg_month').removeAttr('selected').find('option:first').attr('selected', 'selected');
			
		}
		}
	}else if (from_year=='') {
		
		  sweeetalertbtn("Error","Select Manufacturing Year ",'error');
		 $('#vehicle_manu_month').prop('selectedIndex',0);
		
			
	}

		
	}
</script>





