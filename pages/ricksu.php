<?php  @$id = $_GET['vehicle_id'];
 ?>
          


<div class="row">
	<div  class="col-12">
	
		
		<button type="button" onclick="refreshForm('ricksu',<?=@$id?>)" class="btn btn-sm btn-primary float-right mb-2">Refresh</button>
		 <button type="button" id="mini_ricksu_modal_btn" style="" class="btn btn-sm btn-secondary float-right mb-2 ml-1 mr-2" data-toggle="modal" data-target="#mini_ricksu_modal">
    Add Additional Ricksu
  </button>
	</div>
</div>

<form action="php_action/custom_action.php" method="POST" role="form" id="formData5">
	<?php 
          @$id = $_GET['vehicle_id'];
           @$fetchricksu = fetchRecord($dbc,"ricksu","vehicle_id",$id);
        ?>
        <input type="text" value="<?=@$id?>" class="vehicle_idMain d-none" name="vehicle_id">
						<input type="hidden" name="ricksu_id" id="ricksu_id" class="">


	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Loading Point</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<input readonly type="text" name="ricksu_loading_point" id="ricksu_loading_point" class="form-control" value="">
						
					</div><!-- col -->
					
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				
				<div class="row">
					<div class="col-sm-4">
						<label for="">Sub Yards</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<input  type="hidden" name="ricksu_sub_yard" id="ricksu_sub_yard" class="form-control" value="">
						<input readonly type="text" name="ricksu_sub_yard_name" id="ricksu_sub_yard_name" class="form-control" value="">
						
					</div><!-- col -->
				
				
				</div><!-- inner row -->
			
			</div>
			   <div class="form-group row">
			           	<div class="col-sm-4">
						<label for="">Type</label>					</div><!-- col -->
                      <div class="col-sm-4">
                      	  <div class="custom-control custom-radio">
                          <input  class="custom-control-input" type="radio" data-toggle="modal" data-target="#running" id="customRadio1"  value="running"  name="ricksu_type"   required>
                          <label for="customRadio1" class="custom-control-label">Running</label>
                        </div>
                      </div>
                         <div class="col-sm-4">
                      	  <div class="custom-control custom-radio">
                          <input   class="custom-control-input" type="radio" data-toggle="modal" data-target="#running" id="customRadio2" value="not_running"  name="ricksu_type" required>
                          <label for="customRadio2"    class="custom-control-label">Not Running</label>
                        </div>
                      </div>
                                             
                      </div>
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">RICKSU Company</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<select class="form-control ricksu_company" id="ricksu_company" name="ricksu_company">
							<option value="">~~SELECT~~</option>
							<?php $q = get($dbc,"ricksu_company");
							while ($r = mysqli_fetch_assoc($q)):?>
								<option value="<?=$r['ricksu_company_id']?>"><?=$r['ricksu_company_name']?></option>
							<?php endwhile  ?>
						</select>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->

			     
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Received By</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<input type="text" name="ricksu_receive_by" id="ricksu_receive_by" class="form-control form-control-sm">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Pickup Date Date</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<input type="date" onchange="checkDateValidty('ricksu_leaving_date');validatedatesriksu();" name="ricksu_leaving_date" id="ricksu_leaving_date" class="form-control form-control-sm" >
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Yard Delivery Date</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<input type="date" onchange="checkDateValidty('ricksu_arrival_date');validatedatesriksu();"  name="ricksu_arrival_date" id="ricksu_arrival_date" class="form-control form-control-sm">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Repair Info</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<input type="text" name="ricksu_repair_info" id="ricksu_repair_info" class="form-control form-control-sm">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Repair Fee</label>
					</div><!-- col -->
					<div class="col-sm-3">			
						<input type="number" name="ricksu_repair_fee" id="ricksu_repair_fee" class="form-control form-control-sm taxOnAmount">
					</div><!-- col -->
					<div class="col-sm-3">			
						<input type="text" name="ricksu_repair_fee_tax" id="ricksu_repair_fee_tax" placeholder="Tax" class="form-control form-control-sm">
					</div><!-- col -->
					<div class="col-sm-2">
						<div class="form-check pl-0">
  							<input class="form-check-input tax_reset" id="ricksu_repair_fee_box" value="ricksu_repair_fee_tax" type="checkbox">
  							<label class="form-check-label" for="defaultCheck1"> No Tax</label>
						</div>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">RICKSU Fee</label>
					</div><!-- col -->
					<div class="col-sm-3">	
						<input type="number" name="ricksu_fee" id="ricksu_fee" class="form-control form-control-sm taxOnAmount ricksu_fee">
					</div><!-- col -->
					<div class="col-sm-3">			
						<input type="text" name="ricksu_fee_tax" id="ricksu_fee_tax" placeholder="Tax" class="form-control form-control-sm">
					</div><!-- col -->
					<div class="col-sm-2">
						<div class="form-check pl-0">
  							<input class="form-check-input tax_reset" id="ricksu_fee_box" value="ricksu_fee_tax" type="checkbox">
  							<label class="form-check-label" for="defaultCheck1"> No Tax</label>
						</div>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Charges For Additional Services</label>
					</div><!-- col -->
					<div class="col-sm-3">			
						<input type="number" name="ricksu_charger_for_additional" id="ricksu_charger_for_additional" class="form-control form-control-sm taxOnAmount">
						<!-- <select class="form-control" id="ricksu_charger_for_additional" name="ricksu_charger_for_additional">
							<option value="">~~SElECT~~</option>
							<option value="1">Active</option>
							<option value="0">Deactive</option>
						</select> -->
					</div><!-- col -->
					<div class="col-sm-3">			
						<input type="text" name="ricksu_charger_for_additional_tax" id="ricksu_charger_for_additional_tax" placeholder="Tax" class="form-control form-control-sm">
					</div><!-- col -->
					<div class="col-sm-2">
						<div class="form-check pl-0">
  							<input class="form-check-input tax_reset" value="ricksu_charger_for_additional_tax" type="checkbox" id="ricksu_charger_for_additional_box">
  							<label class="form-check-label" for="defaultCheck1"> No Tax</label>
						</div>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Note</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<textarea name="ricksu_note" id="ricksu_note" class="form-control" rows="4"></textarea>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
		</div><!-- col -->
		<div class="col-sm-6">
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Delievery Point</label>
					</div><!-- col -->
					<div class="col-sm-5">			
						<select onchange='getSubYards(this.value,"#ricksu_dp_sub_yards")' name="ricksu_delievery_point" id="ricksu_delievery_point" class="form-control">
							<option >Select Delivery Point</option>

							<?php $q = mysqli_query($dbc,"SELECT DISTINCT PORT FROM riksu_transportation ");
							while ($r = mysqli_fetch_assoc($q)):?>
								<option  value="<?=$r['PORT']?>"><?=$r['PORT']?></option>
							<?php endwhile ?>
						</select>
						
					</div><!-- col -->
						<div class="col-sm-3">
						<a href="ricksu_transportation.php" target="_blank" class="btn btn-primary"><span class="fa fa-plus"></span></a>
						<button type="button" class="btn btn-info" id="refresh_btn" onclick="refresh_select(`ricksu_delievery_point`,`PORT`,`PORT`,``,``)"><span class="fa fa-refresh" ></span></button>
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Sub Yards DP</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<select name="ricksu_dp_sub_yards" id="ricksu_dp_sub_yards" class="form-control">
							<option >Select Delivery Point</option>
						</select>
						
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Delievered By</label>
					</div><!-- col -->
					<div class="col-sm-8">	
						<input type="text" class="form-control" id="ricksu_deliever_by" name="ricksu_deliever_by">
							
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Free Days At Yard</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<input type="number" name="ricksu_free_at_yard" id="ricksu_free_at_yard" class="form-control form-control-sm">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Yard Services</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<input type="text" name="ricksu_yard_service" id="ricksu_yard_service" class="form-control form-control-sm">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
			<div class="form-group">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Additional Services</label>
					</div><!-- col -->
					<div class="col-sm-8">			
						<input type="text" name="ricksu_ad_service" id="ricksu_ad_service" class="form-control form-control-sm">
					</div><!-- col -->
				</div><!-- inner row -->
			</div><!-- form group -->
				<div class="form-group refresh_documents">
				<div class="row">
					<div class="col-sm-4">
						<label for="">Risku Bill</label>
					</div><!-- col -->
					<div class="col-sm-4">	
				
					</div><!-- col -->
					<div class="col-sm-4 ">
						<?php
$d  = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM airmail_files WHERE file_title='ricksu_bill' AND vehicle_id = '$id' ORDER BY airmail_file_id DESC LIMIT 1"));
//echo $d['file_title'];
if(@$d['file_title'] == 'ricksu_bill'){
?>
	<a href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn btn-success">View</a>
	<a download href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn btn-info">Download</a>
<?php
}else{?>
		
	<a href="vehicle_docs.php?vehicle_id=<?=$id?>&name=ricksu_bill" target="_blank" class="btn btn-primary">Add</a>
	<?php

}
?>
					</div>
				</div><!-- inner row -->
			</div><!-- form group -->
		</div><!-- col -->
	</div><!-- mian -->

	<div class="row">
			<div class="col-12">
				<input type="hidden" name="formData5_type"  value="">

				<button type="submit" class="btn btn-warning float-right ml-3" id="formData5_next" onclick="submitForm('formData5','next')" >Save and Next</button>
				<button type="submit" class="btn btn-primary float-right ml-3"   id="formData5_save" onclick="submitForm('formData5','save')" >Save</button>
			</div>
	</div>
</form>

<br>
<h3 class="text-center">Main Ricksu</h3>
<table class="table table-hover table-sm table-bordered ">
	<thead>
		<tr>
			<th>Sr.</th>
			<th>Ricksu Company</th>
			<th>Loading Point</th>
			<th>Sub Yard</th>
			<th>Delievery Point</th>
			<th>Received By</th>
			<th>Type</th>
			<th>Risku Fee/Tax</th>
			<th>Free Days At Yard</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody id="ricksu_idTable"> 
	</tbody>
</table>
<?php if (!empty($id)): ?>
	
<h3 class="text-center">Additional Ricksu</h3>
<table class="table table-hover table-sm table-bordered " id="mini_ricksu_tb">
	<thead>
		<tr>
			<th>Sr.</th>
			<th>Ricksu Company</th>
			<th>Pickup Point</th>
			<th>Delievery Point</th>
			<th>Pickup date</th>
			<th>Delivery date</th>
			<th>Fee</th>
			<th>Type</th>
			<th>Action</th>
			
		
		</tr>
	</thead>
	<tbody > 
		<?php

		$c=0;
		 $q=mysqli_query($dbc,"SELECT * FROM ricksu WHERE vehicle_id='$id' AND mini_ricksu=1 AND ricksu_sts=1 ");

				while ($r=mysqli_fetch_assoc($q)) {
			$ricksu_company=fetchRecord($dbc,'ricksu_company','ricksu_company_id',$r['ricksu_company']);
				$c++;
		 ?>
		 <tr>
		 	<td><?=$c?></td>
		 	<td><?=$ricksu_company['ricksu_company_name']?></td>
		 	<td><?=$r['mini_ricksu_pickup']?></td>
		 	<td><?=$r['ricksu_delievery_point']?></td>
		 	 <td><?=$r['ricksu_pickup_date']?></td>
		 	<td><?=$r['ricksu_delivery_date']?></td>
		 	<td><?=$r['ricksu_fee']?>-<?=$r['ricksu_fee_tax']?></td>
		 	<td><?=@$r['ricksu_type']?></td>
			<td><span  onclick="editMiniRicksu(<?=$r['ricksu_id']?>)" data-toggle="modal" data-target="#mini_ricksu_modal"  class="text-danger">Edit</span> | <span class="text-danger" onclick="deleteMiniRicksu(<?=$r['ricksu_id']?>)">Delete</span></td>
		 	

		 </tr>
		<?php } ?>
	</tbody>
</table>
<?php endif ?>
<!-- model 1 ---runnign --> 
  <div class="modal fade" id="running">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title typeof" >Running</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            	<h6> Pickup Name: <b  class="pickup"></b> </h6>
            	<table class="table">
            		<thead>
            			<tr>
            				<th>Company Name</th>
            				<th>Delivery Point</th>
            				<th>Fee</th>
            				<th>Free Days</th>
            				<th>Apply</th>
            				<th>Contact</th>
            			</tr>
            		</thead>
            		<tbody id="company_details">
            		
            		</tbody>
            	</table>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->  

<!-- model 1 ---runnign -->
  <div class="modal fade" id="company">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" >Company Name <b class="cp_name">abc</b></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            	<table class="table">
            		
            		<tbody id="get_company_info">
            		
            		</tbody>
            	</table>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->  


<script type="text/javascript">
	function refreshItAgain() {
		 $("#ricksu_loading_point").selectmenu("refresh");

	}

	function validatedatesriksu(){
		var from_year = $("#ricksu_arrival_date").val();
		var to_year = $("#ricksu_leaving_date").val();
		
		if (from_year < to_year) {
			
			alert("Yard Leaving date  should NOT be lower than Yard Arrival Date ");
			  //$("#vehicle_reg_month").foucs();

			 
		 $('#ricksu_arrival_date').val(0);
			// $('.vehicle_reg_month').removeAttr('selected').find('option:first').attr('selected', 'selected');
			
		}


		
	}

</script>
<div class="modal fade" id="mini_ricksu_modal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Additional Risku</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
    <form action="php_action/custom_action.php" method="POST" role="form" id="mini_risku_form">
        <!-- Modal body -->
        <div class="modal-body">
         <div class="container">
    	<input type="hidden" name="mini_ricksu_id" id="mini_ricksu_id" value="">
       <input type="text" value="<?=@$id?>" class="vehicle_idMain d-none" name="vehicle_id">

       				<div class="row form-group">
         			<div class="col-sm-12">
         				<label>Pickup point </label>
         				<input  type="text" readonly name="mini_ricksu_pickup" id="mini_ricksu_pickup" class="form-control">
         			</div>
         		</div>

         		<div class="row form-group">
         			<div class="col-sm-7">
         				<label>Delivery point </label>
         		
						<select  required onchange='getSubYards(this.value,"#mini_ricksu_dp_sub_yards")' name="ricksu_delievery_point" id="mini_ricksu_delievery_point" class="form-control">
							<option >Select Delivery Point</option>

							<?php $q = mysqli_query($dbc,"SELECT DISTINCT PORT FROM riksu_transportation ");
							while ($r = mysqli_fetch_assoc($q)):?>
								<option  value="<?=$r['PORT']?>"><?=$r['PORT']?></option>
							<?php endwhile ?>
						</select>
						
				
         			</div>
         					<div class="col-sm-5">
         						<label style="visibility: hidden;">.</label>
						<a href="ricksu_transportation.php" target="_blank" class="btn btn-primary"><span class="fa fa-plus"></span></a>
						<button type="button" class="btn btn-info" id="refresh_btn" onclick="refresh_select(`mini_ricksu_delievery_point`,`PORT`,`PORT`,``,``)"><span class="fa fa-refresh" ></span></button>
					</div><!-- col -->
         		</div>
         		<div class="form-group row">
				<div class="col-sm-12">
				
						<label for="">Sub Yards DP</label>
			
						<select name="ricksu_dp_sub_yards" id="mini_ricksu_dp_sub_yards" class="form-control">
							<option >Select DP sub Yards </option>
						</select>
						
					</div><!-- col -->
				</div><!-- inner row -->
		
         			<div class="row form-group mt-3">
			           	<div class="col-sm-4">
						<label for="">Type</label>					</div><!-- col -->
                      <div class="col-sm-4">
                      	  <div class="custom-control custom-radio">
                          <input  class="custom-control-input mini_ricksu_type" type="radio" id="mini_ricksu_type1"   value="running"  name="mini_ricksu_type"   >
                          <label  for="mini_ricksu_type1" class="custom-control-label">Running</label>
                        </div>
                      </div>
                         <div class="col-sm-4">
                      	  <div class="custom-control custom-radio">
                          <input   class="custom-control-input mini_ricksu_type" type="radio"  id="mini_ricksu_type2" value="not_running"  name="mini_ricksu_type" >
                          <label for="mini_ricksu_type2"    class="custom-control-label ">Not Running</label>
                        </div>
                      </div>
                                             
                </div>
         		<div class="row form-group">
         			<div class="col-sm-8">
         			<label>Risku Company</label>	
						<select class="form-control ricksu_company" required id="mini_ricksu_company" name="mini_ricksu_company">
							<option value="">~~SELECT~~</option>
							<?php $q = get($dbc,"ricksu_company WHERE ricksu_company_sts=1");
							while ($r = mysqli_fetch_assoc($q)):?>
								<option value="<?=$r['ricksu_company_id']?>"><?=$r['ricksu_company_name']?></option>
							<?php endwhile  ?>
						</select>
					
         			</div>
         		<div  class="col-sm-4 mt-4">
        	<label style="visibility: hidden;">.</label>

						<a href="ricksu_company.php" target="_blank" class="btn btn-primary"><span class="fa fa-plus"></span></a>

						<button type="button" class="btn btn-info btn-sm" onclick="refresh_select(`mini_ricksu_company`,`ricksu_company_id`,`ricksu_company_name`,``,``)"><span class="fa fa-refresh" ></span></button>
         		</div>	
         		</div>  <!-- end of row -->
         	
         		
         		
         		<div class="row form-group">
         			<div class="col-sm-8">
         				<label>Fee </label>
         				<input type="number"  name="mini_ricksu_fee" id="mini_ricksu_fee" class="form-control taxOnAmount ricksu_fee">
         			</div>
         			<div class="col-sm-4">
         				<label>Tax</label>
         				<input type="number" name="mini_ricksu_fee_tax" id="mini_ricksu_fee_tax" class="form-control">
         			</div>
         		</div>
                 		<div class="row form-group">
         			<div class="col-sm-6">
         				<label>Pickup Date</label>
         					<input type="hidden"  name="ricksu_delivery_date_last" id="ricksu_delivery_date_last" class="form-control">
         				<input type="date" onchange="compareDateBylessF('ricksu_pickup_date','ricksu_delivery_date_last','Last Delivery Date')" name="ricksu_pickup_date" id="ricksu_pickup_date" class="form-control">
         			</div>
         			<div class="col-sm-6">
         				<label>Delivery Date</label>
         				<input type="date" onchange="compareDateBylessF('ricksu_pickup_date','ricksu_delivery_date_last','Last Delivery Date')"  name="ricksu_delivery_date" id="ricksu_delivery_date" class="form-control">
         			</div>
         		</div>
         		 		<div class="form-group row">
				<div class="col-sm-12">
					<label for="">Delievered By</label>
						<input type="text" class="form-control" id="mini_ricksu_deliever_by" name="ricksu_deliever_by">
							
					
				</div><!-- inner row -->
			</div><!-- form group -->

         		<div class="row form-group">
         			<div class="col-sm-12">
         				<label>Note</label>
         				<input name="ricksu_note" id="mini_ricksu_note" class="form-control">
         			</div>
         		</div>
         	
         </div>
        </div>

        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary"  id="mini_risku_btn">Save</button>
        </div>
    </form>
      </div>
    </div>
  </div>