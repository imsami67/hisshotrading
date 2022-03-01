<!-- <form action="php_action/custom_action.php" method="POST" role="form" id="formData"> -->

<?php 

    @$id = $_GET['vehicle_id'];

?>



<input type="text" value="<?=@$id?>" class="vehicle_idMain d-none" name="vehicle_idMainConsigneetrade">
<input type="text" value="add" class="d-none" name="consignee_info_id" id="consignee_info_id">

	<div class="msg"></div>

	<div class="row mb-5">

		<div class="col-sm-4">
			
			<div  class="form-group">

				<label for=""> Customer</label>
				<input readonly type="text" class="form-control " id="customer_name_trade" value="<?=$customer_Det['customer_name']?> (<?=$customer_Det['customer_contact_person']?>)">
				<input type="hidden" class="form-control" value="<?=$checkShip['invoice_customer']?>" id="customer_id_trade" name="customer_id" required>

				</div>
			<div class="form-group dynamic_page">
						<div class="c-inputs-stacked">

							<label class="c-input c-radio">

								<input id="same_as_notify"  name="consignee_label" value="notify_party" type="radio">

								<span class="c-indicator"></span>

								Add Notify Party?

							</label>

							<label class="c-input c-radio">

								<input id="same_as_consignee" name="consignee_label" value="consignee" type="radio" checked >

								<span class="c-indicator"></span>

								Same as Consignee

							</label>

						</div>
						</div>

		<!-- col -->

		</div>

		<div class="col-sm-4" >

				<div class="form-group">
				
				<label for=""> Consignee</label>
				<input readonly type="text" class="form-control " id="consignee_name_trade" value="<?=$consignee_Det['consignee_name']?> (<?=$consignee_Det['consignee_contact_person']?>)">
				<input type="hidden" class="form-control" value="<?=$checkShip['consignee_id']?>" id="consignee_id_trade" name="consignee_name" required>
					
				</div>
				<div class="form-group d-none">

						<a href="consignee.php?consignee_label=consignee" target="_blank" class="btn btn-primary btn-xs m-2 float-right"><span class="fa fa-plus"></span></a>

						<button type="button" class="btn btn-xs btn-info m-2 float-right" id="refresh_btn" onclick="refresh_select(`customer_notify`,`consignee_id`,`consignee_name`,'',`consignee_contact_person`)"><span class="fa fa-refresh" ></span></button>
					</div>

			</div>
			<div class="col-sm-4">
						<div class="form-group" id="notify_id_trade">
							
							
								<label for="">Notify Party</label>
					<select class="form-control " name="customer_notify" id="customer_notify">
						<option>Select Notify Party</option>

					<?php $q = get($dbc,"consignee WHERE consignee_type='notify_party' AND customer_id='".$checkShip['invoice_customer']."'");

						while ($r = mysqli_fetch_assoc($q)):?>

						<option value="<?=$r['consignee_id']?>"><?=$r['consignee_id']?>-<?=$r['consignee_name']?> (<?=$r['consignee_contact_person']?>-<?=$r['consignee_country']?>)</option>

						<?php endwhile ?>
					</select>
			
					<div class="form-group">

						<a href="consignee.php?consignee_label=notify_party" target="_blank" class="btn btn-primary btn-xs m-2 float-right"><span class="fa fa-plus"></span></a>

						<button type="button" class="btn btn-xs btn-info m-2 float-right" id="refresh_btn" onclick="refresh_select(`customer_notify`,`consignee_id`,`consignee_name`,'',`consignee_contact_person`)"><span class="fa fa-refresh" ></span></button>
					</div>
				</div>
			</div>
		</div><!-- col -->


<!-- </form> -->

<script type="text/javascript">

	function refreshCall2(){

	 $("#refreshSelect").load(location.href + " #refreshSelect > *");

		//$("#Refreshit").load(location.href+" #Refreshit");









	}

</script>