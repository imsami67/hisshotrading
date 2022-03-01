 



 


 <?php  @$id = $_GET['vehicle_id']; 
          


 ?>
 <style type="text/css">
 	.display-none{
 		display: none;
 	}
 	.display-block{
 		display: block;
 	}
 </style>
<div class="row">
	<div class="col-sm-6">
		 <select class="form-control" id="auction_type_check" <?=$dib?>>
		 	 <option value="">Select</option>
        	<option <?=@($auction_only_check==1)?"selected":""?> value="auction">Auction </option>
        	<option <?=@($auction_person_check==1)?"selected":""?> value="person">Individual</option>
       
        	<option <?=@($auction_company_check==1)?"selected":""?> value="company">Company </option>
        </select>
	</div>
	
</div>
    <div class="person <?=$auction_person_display?>"  id="persone_div">

    	<?php include_once 'person_info.php'; ?>

    </div>
      <div class="<?=$auction_company_display?>"  id="company_div">

    	<?php include_once 'company_info.php'; ?>

    </div>
   


<form action="php_action/custom_action.php" method="POST" class="<?=$auction_only_display?>" role="form" id="formData2">
<div class="row">
	<div class="col-sm-6">
		<h4>Auction Info</h4>
	</div>
	<div  class="col-6">

			<button type="button" onclick="refreshForm('auction',<?=@$auction_info['auction_id']?>)" class="btn btn-sm btn-primary float-right mb-2">Refresh</button>
		
		
	</div>
</div>

	<?php 





				$Date1 = date('Y-m-d');

$date = new DateTime($Date1);

$date->modify('+3 day');

 $Date2 = $date->format('Y-m-d');

			

        ?>
        <input type="text" value="<?=@$auction_info?>" id="get_auction_idMain" class=" d-none" >
        <input type="text" value="<?=@$id?>" class="vehicle_idMain d-none" name="vehicle_id">

       

       <!--  <button type="button" id="auction" class="btn btn-danger">Auction<span  id="personNumber" class="badge badge-secondary"></span></button>

        <button type="button" id="person" class="btn btn-danger">Person <span  id="personNumber" class="badge badge-secondary"><?=$num?></span>  </button> -->

        <hr>

	<div class="row auction">

		<div class="col-sm-6">

			<div class="form-group">

				<div class="row">

			 		<div class="col-sm-4">

						<label for="">Auction House</label>

					</div><!-- col -->

					<div class="col-sm-4">			

						<select name="auction_house" id="auction_house" class="form-control" style="width: 100%;" onchange="AuctionInfNow(this.value)">

							<option value="">~~SELECT~~</option>

							<?php $q = get($dbc,"auction_home WHERE auction_home_sts=1");

							while($r = mysqli_fetch_assoc($q)): ?>

								<option value="<?=$r['auction_home_id']?>"><?=$r['auction_home_name']?></option>

							<?php endwhile ?>

						</select>

					</div><!-- col -->
					<div class="col-sm-4">
						<a href="auction_house.php" target="_blank" class="btn btn-primary btn-sm"><span class="fa fa-plus "></span></a>
						<button type="button" class="btn btn-info btn-sm" onclick="refresh_select(`auction_house`,`auction_home_id`,`auction_home_name`,``,``)"><span class="fa fa-refresh" ></span></button>
					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">POS Number</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<input type="text" readonly name="pos_number" id="pos_number" class="form-control" >

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group d-none">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Address</label>

					</div><!-- col -->

					<div class="col-sm-8">			

							<textarea readonly name="companyname" id="companyname" class="form-control companyname">
							</textarea>
					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Bid Type</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<select name="auction_house_type" id="auction_house_type" onchange="getAuctionFee(this.value)" class="form-control">

				 			<option value="">~~SELECT~~</option>

							<option value="live_fee">System Live Bid Fee</option>

							<option value="house_fee">In House Bid Fee </option>

							<option value="price_offer_fee">Negoatiation Price offer Fee</option>
							<option value="system_bid">System  Bid Price Fee</option>

						</select>

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Buying Date</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<input type="date" value="<?=date('Y-m-d')?>" name="auction_date" id="auction_date" class="form-control form-control-sm" onchange="checkAuctionDate()" >
						<input type="date" name="current_date" id="current_date" value="<?=date('Y-m-d')?>" class="d-none">

						<input type="text" name="auction_id" id="auction_id" class="d-none">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Start Price</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<input type="number" name="auction_start_price" id="auction_start_price" class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Win Price</label>

					</div><!-- col -->

					<div class="col-sm-4">			

						<input type="number" name="auction_win_price" id="auction_win_price" class="form-control form-control-sm taxOnAmount">

						<!-- <input class="form-control" list="reservation_customer1" name="reservation_customer" id="reservation_customer"> -->

						<!-- <datalist id="reservation_customer19">

							<option value="">~~SELECT~~</option>

							<?php $q = get($dbc,"customers WHERE customer_role= 'customer'");

							while ($r = mysqli_fetch_assoc($q)):?>

								<option value="<?=$r['customer_id']?>"><?=$r['customer_name']?> (<?=$r['customer_phone']?>)</option>

							<?php endwhile ?>

						</datalist> -->

					</div><!-- col -->

					<div class="col-sm-2">			

						<input type="text" name="auction_win_price_tax" id="auction_win_price_tax" placeholder="Tax" class="form-control form-control-sm">

					</div><!-- col -->

					<div class="col-sm-2">

						<div class="form-check pl-0">

  							<input class="form-check-input tax_reset" id="auction_win_price_box" value="auction_win_price_tax" type="checkbox">

  							<label class="form-check-label" for="recycle_fee_box"> No Tax</label>

						</div>

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Auction Fee</label>

					</div><!-- col -->

					<div class="col-sm-4">			

						<input type="number" name="auction_fee" id="auction_fee" class="form-control form-control-sm taxOnAmount">

					</div><!-- col -->

					<div class="col-sm-2">			

						<input type="text" name="auction_fee_tax" id="auction_fee_tax" placeholder="Tax" class="form-control form-control-sm">

					</div>

					<div class="col-sm-2">

						<div class="form-check pl-0">

  							<input class="form-check-input tax_reset" id="auction_fee_box" value="auction_fee_tax" type="checkbox">

  							<label class="form-check-label" for="recycle_fee_box"> No Tax</label>

						</div>

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Recycle Fee</label>

					</div><!-- col -->

					<div class="col-sm-6">			

						<input type="number" name="auction_recycle_fee" id="auction_recycle_fee" class="form-control form-control-sm">

					</div><!-- col -->

					<div class="col-sm-2 d-none">			

						<input type="number" name="auction_recycle_fee_tax" id="auction_recycle_fee_tax" placeholder="Tax" value="0" class="form-control form-control-sm">

					</div><!-- col -->

					<div class="col-sm-2 d-none">

						<div class="form-check pl-0">

  							<input class="form-check-input tax_reset" id="auction_recycle_fee_box" value="auction_recycle_fee_tax" type="checkbox">

  							<label class="form-check-label" for="recycle_fee_box"> No Tax</label>

						</div>

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group refresh_auction_doc">

				<div class="row">

					<div class="col-sm-4">

						<label for="auction_bill">Auction Bill</label>

					</div><!-- col -->

					<div class="col-sm-2">			

					</div><!-- col -->

					<div class="col-sm-6">

						<?php


$d  = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM airmail_files WHERE file_title='auction_bill' AND vehicle_id = '$id' ORDER BY airmail_file_id DESC LIMIT 1"));



if(@$d['file_title'] == 'auction_bill'){

?>
<a href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn btn-success">View</a>
<a href="img/vehicle_docs/<?=$d['airmail_file_name']?>" download target="_blank" class="btn btn-info">Download</a>

<?php

}else{?>
<a href="vehicle_docs.php?vehicle_id=<?=$id?>&name=auction_bill" target="_blank" class="btn btn-primary">Add</a>

	<?php



}

?>

					</div>

					

				</div><!-- inner row -->

			</div><!-- form group -->

		</div><!-- col -->

		<div class="col-sm-6">

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Transportation Due Date</label>

					</div><!-- col -->

					<div class="col-sm-8">	

						<input type="date" onchange="validatedatesauction()" name="auction_transport_due_date" id="auction_transport_due_date" class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Bidder Name</label>

					</div><!-- col -->

					<div class="col-sm-8">					

						<select name="auction_bidder" id="auction_bidder" class="form-control">

							<option value="">~~SELECT~~</option>

							<?php $q = get($dbc,"bidders WHERE bidders_sts = '1'");

							while($r = mysqli_fetch_assoc($q)): ?>

								<option value="<?=$r['bidders_id']?>"><?=$r['bidders_name']?></option>

							<?php endwhile ?>

						</select>

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Turn</label>

					</div><!-- col -->

					<div class="col-sm-8">		

						<input type="number" name="auction_turn" id="auction_turn" class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Win By</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<!-- <input type="text" name="auction_win_by" id="auction_win_by" class="form-control form-control-sm"> -->
						<select class="form-control"  name="auction_win_by" id="auction_win_by">

							<option value="">~~SELECT~~</option>

							<?php $q = get($dbc,"customers WHERE customer_role= 'customer' AND customer_active = 1");

							while ($r = mysqli_fetch_assoc($q)):?>

								<option value="<?=$r['customer_name']?>"><?=$r['customer_id']?>-<?=$r['customer_name']?> (<?=$r['customer_contact_person']?>-<?=$r['customer_country']?>)</option>

							<?php endwhile ?>

						</select>

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->



			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Payment Deadline</label>

					</div><!-- col -->

					<div class="col-sm-8">		 	

						<input type="date" onchange="validatedatesauction()" name="auction_deadline" id="auction_deadline" value="<?=$Date2?>"  class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Security Deposit</label>

					</div><!-- col -->

					<div class="col-sm-8">		 	

						<input type="text" name="security_deposit" id="security_deposit" value="<?=@$auction_info['security_deposit']?>"  class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->





			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Note</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<textarea name="auction_note" id="auction_note" class="form-control" rows="3"></textarea>

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Loading Point</label>
					</div><!-- col -->
					<div class="col-sm-5">			
						<select onchange='getSubYards(this.value,"#auction_sub_yard")' name="auction_loading_point" id="auction_loading_point" class="form-control">
								<option value="">Select Point</option>
							<?php $q = mysqli_query($dbc,"SELECT DISTINCT auction_house_name FROM riksu_transportation ");
							while ($r = mysqli_fetch_assoc($q)):?>
								<option <?=@(strtolower($r['auction_house_name'])==strtolower($fetchricksu['ricksu_loading_point']))?"selected":""?> value="<?=$r['auction_house_name']?>"><?=$r['auction_house_name']?></option>
							<?php endwhile ?>
						</select>
					
					</div><!-- col -->
					<div class="col-sm-3">
						<a href="ricksu_transportation.php" target="_blank" class="btn btn-primary"><span class="fa fa-plus"></span></a>
						<button type="button" class="btn btn-info" id="refresh_btn" onclick="refresh_select(`ricksu_loading_point`,`auction_house_name`,`auction_house_name`,``,``)"><span class="fa fa-refresh" ></span></button>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Sub Yards</label>
					</div><!-- col -->
					<div class="col-sm-5">			
						<select  name="auction_sub_yard" id="auction_sub_yard" class="form-control">
						</select>
					</div><!-- col -->
					<div class="col-sm-3">
						<a href="auction_house.php" target="_blank" class="btn btn-primary"><span class="fa fa-plus"></span></a>
						<button type="button" class="btn btn-info" id="ricksu_sub_yard_refresh" ><span class="fa fa-refresh" ></span></button>
					</div><!-- col -->
				</div><!-- inner row -->
			
			</div><!-- form-group -->

		</div><!-- col -->
	

	</div><!-- mian -->
		<div class="row">
			<div class="col-12">
				<input type="hidden" name="formData2_type"  value="">
				<button type="submit" class="btn btn-warning float-right ml-3" id="formData2_next" onclick="submitForm('formData2','next')" >Save and Next</button>
				<button type="submit" class="btn btn-primary float-right ml-3" id="formData2_save" onclick="submitForm('formData2','save')" >Save</button>
				
			</div>
		</div>
</form>



<br><br>



<table class="table table-hover table-sm table-bordered d-none">

	<thead>

		<tr>

			<th>Sr.</th>

			<th>Detail</th>

			<th>Action</th>

		</tr>

	</thead>

	<tbody id="auction_idTable">

	</tbody>

</table>



<script type="text/javascript">




	function validatedatesauction(){

		var from_year = $("#auction_date").val();

		var to_year = $("#auction_transport_due_date").val();
		var auction_deadline = $("#auction_deadline").val();

		

		if (from_year > to_year || from_year > auction_deadline) {

			alert("Transportation Date should NOT be lower than Auction Date ");

			  //$("#vehicle_reg_month").foucs();

 $('#auction_transport_due_date').val(0);


			 $("#auction_date").change();

		
			// $('.vehicle_reg_month').removeAttr('selected').find('option:first').attr('selected', 'selected');

			

		}





		

	}





</script>