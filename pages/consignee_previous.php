<?php  @$id = $_GET['vehicle_id']; ?>

<div class="row">
	<div  class="col-12">
		<button type="button" onclick="refreshForm('consignee',<?=@$id?>)" class="btn btn-sm btn-primary float-right mb-2">Refresh</button>
	</div>
</div>
<form action="php_action/custom_action.php" method="POST" role="form" id="formData6">

	<?php 

          @$id = $_GET['vehicle_id'];

        ?>

        <input type="text" value="<?=@$id?>" class="vehicle_idMain d-none" name="vehicle_id">

	<div class="row">

		<div class="col-sm-6">

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">User Name</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<select name="consignee_info_user_id" id="consignee_info_user_id" class="form-control">

							<option value="">~~SELECT~~</option>

							<?php $q = get($dbc,"users WHERE status = '1'");

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

						<label for="">Customer Name</label>

					</div><!-- col -->

					<div class="col-sm-4">			

						<input list="customer_name2" name="consignee_info_customer" id="consignee_info_customer" class="form-control">

						<datalist id="customer_name2">

							<option value="">~~SELECT~~</option>

							<?php $q = get($dbc,"customers WHERE customer_active = '1'");

							while($r = mysqli_fetch_assoc($q)): ?>

								<option value="<?=$r['customer_id']?>"><?=$r['customer_name']?></option>

							<?php endwhile ?>

						</datalist>

					</div><!-- col -->

					<div class="col-sm-4">

						<input readonly="readonly" id="consignee_info_customerNameShow" class="form-control">

					</div>

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Contact No</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<input type="number" name="consignee_info_contact" id="consignee_info_contact" class="form-control form-control-sm">

						<input type="text" name="consignee_info_id" id="consignee_info_id" class="form-control d-none">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<!-- <div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Final Destination at Rec. Port</label>

					</div>

					<div class="col-sm-8">			

						<input type="text" name="consignee_info_final_dest" id="consignee_info_final_dest" class="form-control form-control-sm">

					</div>

				</div>

			</div> -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Consignee Name</label>

					</div><!-- col -->

					<div class="col-sm-8">

						<select name="consignee_info_consignee" id="consignee_info_consignee" class="form-control consignee_info">

							<option value="">~~SELECT~~</option>

							<?php $q = get($dbc,"consignee WHERE consignee_type = 'Consignee' AND consignee_sts = '1'");

							while($r = mysqli_fetch_assoc($q)): ?>

								<option value="<?=$r['consignee_id']?>"><?=$r['consignee_name']?></option>

							<?php endwhile ?>

						</select>

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Notify Party Name</label>

					</div><!-- col -->

					<div class="col-sm-8">	

						<select name="consignee_info_party_name" id="consignee_info_party_name" class="form-control consignee_info form-control-sm">

							<option value="">~~SELECT~~</option>

							<?php $q = get($dbc,"consignee WHERE consignee_type = 'Notify Party' AND consignee_sts = '1'");

							while($r = mysqli_fetch_assoc($q)): ?>

								<option value="<?=$r['consignee_id']?>"><?=$r['consignee_name']?></option>

							<?php endwhile ?>

						</select>

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Email</label>

					</div><!-- col -->

					<div class="col-sm-8">				

						<input type="Email" name="consignee_info_email" id="consignee_info_email" class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Date</label>

					</div><!-- col -->

					<div class="col-sm-8">		

						<input type="date" name="consignee_info_date" id="consignee_info_date" class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

		</div><!-- col -->

		<div class="col-sm-6">

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Consignee Address</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<textarea name="consignee_info_consignee_address" id="consignee_info_consignee_address" class="consignee_info_consignee_address form-control" rows="3"></textarea>

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Notify Party Address</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<textarea name="consignee_info_party_address" id="consignee_info_party_address" class="consignee_info_party_name_address form-control" rows="3"></textarea>

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Note</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<textarea name="consignee_info_note" id="consignee_info_note" class="form-control" rows="5"></textarea>

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

		</div><!-- col -->

	</div><!-- mian -->



	<button type="submit" class="btn btn-primary" id="saveData6">Submit</button>

</form>



<br>



<table class="table table-hover table-sm table-bordered d-none">

	<thead>

		<tr>

			<th>Sr.</th>

			<th>Detail</th>

			<th>Action</th>

		</tr>

	</thead>

	<tbody id="consignee_idTable">

	</tbody>

</table>	