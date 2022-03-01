<?php  @$id = $_GET['vehicle_id'];
@$export_info=fetchRecord($dbc,"export_info","vehicle_id",$stock['vehicle_id'])['export_info_id'];

 ?>
      <?php
 $checkShipQ=mysqli_query($dbc,"SELECT * FROM invoice WHERE invoice_vehicle = '$id' AND invoice_quotation='invoice' ");
 if (mysqli_num_rows($checkShipQ)>0) {
    $checkShip=mysqli_fetch_assoc($checkShipQ);
  if ($checkShip['invoice_type']=="general_invoice" AND $checkShip['invoice_due_amount']==0) {
    $formSet="";
    $msgSet='d-none';
  }elseif ($checkShip['invoice_type']=="credit_invoice") {
    $formSet="";
    $msgSet='d-none';
  }else{
    $formSet='disabled';
    $msgSet='';
  }
 }else{
      $formSet='disabled';
      $msgSet='';
 }

 ?>

<div class="row">
	<div  class="col-12">
		<button type="button" onclick="refreshForm('export',<?=@$export_info?>)" class="btn btn-sm btn-primary float-right mb-2">Refresh</button>
	</div>
</div>
<form action="php_action/custom_action.php" method="POST" role="form" id="formData7">

	<?php 

          @$id = $_GET['vehicle_id'];

        ?>

        <input type="text" value="<?=@$id?>" class="vehicle_idMain d-none" name="vehicle_id">

	<div class="row refresh_export_docs">

		<div class="col-sm-6">

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<small class="text-primary">From - To Date</small><br>

						<label for="">Ownership Certificate</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<input type="text" id="export_info_id" name="export_info_id" class="d-none">

						<small class="text-danger">Applied </small>

						<input type="date" onchange="checkDateValidty('export_info_mashou');compareDates('export_info_mashou','export_info_mashou_date','Ownership Certificate')" class="form-control" name="export_info_mashou" id="export_info_mashou">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<small class="text-primary">From - To Date</small><br>

						<label for="">Export Certificate</label>

					</div><!-- col -->

					<div class="col-sm-8">

					<small class="text-danger">Applied </small>

					<input type="date" onchange="checkDateValidty('export_info_export_certificate');compareDates('export_info_export_certificate','export_info_export_certificate_date','Export Certificate');compareDates('export_info_mashou_date','export_info_export_certificate','Ownership Certificate');" class="form-control" name="export_info_export_certificate" id="export_info_export_certificate">

					</div><!-- col -->

				</div><!-- inner row -->

				

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<small class="text-primary">From - To Date</small><br>

						<label for="">Translations</label>

					</div><!-- col -->

					<div class="col-sm-8">

						<small class="text-danger">Applied</small>

						<input type="date" onchange="checkDateValidty('export_info_translation');compareDates('export_info_translation','export_info_translation_date','Translations ');compareDates('export_info_export_certificate_date','export_info_translation','Export Certificate ');" class="form-control" name="export_info_translation" id="export_info_translation">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->
			
			<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<label for="">Inspection Certificate</label>

					</div><!-- col -->

					<div class="col-sm-8">	

						<small class="text-danger">Applied</small>

						<input type="date" onchange="checkDateValidty('inspection_certificate');compareDates('inspection_certificate','inspection_certificate_date','Inspection Certificate');compareDates('export_info_export_certificate_date','inspection_certificate','Export Certificate ');" name="inspection_certificate" id="inspection_certificate" class="form-control form-control-sm">

					</div><!-- col -->

				</div><!-- inner row -->

			</div><!-- form group -->

					<div class="form-group">

				<div class="row">

					<div class="col-sm-4">

						<small class="text-primary">From - To Date</small><br>

						<label for="">Shipping Order</label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<small class="text-danger">Applied</small>

						<input type="date" onchange="checkDateValidty('export_info_shipping_order');compareDates('export_info_shipping_order','export_info_shipping_order_date','Shipping Order');compareDates('inspection_certificate_date','export_info_shipping_order','Inspection Certificate ');" class="form-control" name="export_info_shipping_order" id="export_info_shipping_order">

					</div><!-- col -->

				</div><!-- inner row -->

				

			</div><!-- form group -->
			<div class="form-group">
				
				<div class="row"  class="">
					<div class="col-sm-12 ">
						<h6 class="text-danger  <?=$msgSet;?>">Invoice or Payment Has been not Cleared</h6>
					</div>
				</div>

				<div class="row ">

					<div class="col-sm-4">

						<small class="text-primary">From - To Date</small><br>

						<label for="">Bill of lading </label>

					</div><!-- col -->

					<div class="col-sm-8">			

						<small class="text-danger">Applied</small>

						<input type="date" <?=$formSet?> onchange="checkDateValidty('bill_of_lading');compareDates('bill_of_lading','bill_of_lading_date','Bill of lading  ');compareDates('export_info_shipping_order_date','bill_of_lading','Shipping Order ');" class="form-control" name="bill_of_lading" id="bill_of_lading">

					</div><!-- col -->

				</div><!-- inner row -->

				

			
			</div>

		</div><!-- col -->

		<div class="col-sm-6">

			<div class="form-group">

				<div class="row">

					<div class="col-sm-2">

						<label for="">Date</label>

					</div><!-- col -->

					<div class="col-sm-6">	

						<small class="text-danger">Received</small>

						<input type="date" onchange="checkDateValidty('export_info_mashou_date');compareDates('export_info_mashou','export_info_mashou_date','Ownership Certificate')" name="export_info_mashou_date" id="export_info_mashou_date" class="form-control form-control-sm">

					</div><!-- col -->

					<div class="col-sm-4" style="margin-top: 10px">

						<small class="text-danger"></small>

						
<?php

//$d = get($dbc,"airmail_files WHERE file_title = 'Ownership Certificate' AND vehicle_id = '$id'");

$d  = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM airmail_files WHERE file_title='ownership_certificate' AND vehicle_id = '$id'"));

//echo $d['file_title'];

if(@$d['file_title'] == 'ownership_certificate'){

?>
	<a href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn-sm btn btn-success mt-3"><i class="fa fa-eye"></i></a>

	<a href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn-sm btn btn-secondary mt-3" download><i class="fa fa-download"></i></a>

<?php

}else{?>

		<a href="vehicle_docs.php?vehicle_id=<?=$id?>&name=ownership_certificate" target="_blank" class="btn-sm mt-3 btn btn-primary"><i class="fa fa-plus"></i></a>


	<?php



}

?>						

					</div>

				</div><!-- inner row -->

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-2">

						<label for="">Date</label>

					</div><!-- col -->

					<div class="col-sm-6">	

						<small class="text-danger">Received</small>

						<input type="date" name="export_info_export_certificate_date" id="export_info_export_certificate_date" class="form-control form-control-sm" onchange="checkDateValidty('export_info_export_certificate_date');compareDates('export_info_export_certificate','export_info_export_certificate_date','Export Certificate');">



					</div><!-- col -->





					<div class="col-sm-4" style="margin-top: 10px">

						<small class="text-danger"></small>

					
<?php

//$d = get($dbc,"airmail_files WHERE file_title = 'Ownership Certificate' AND vehicle_id = '$id'");

$d  = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM airmail_files WHERE file_title='export_certificate' AND vehicle_id = '$id'"));

//echo $d['file_title'];

if(@$d['file_title'] == 'export_certificate'){

?>

						<!-- <a href="vehicle_docs.php?vehicle_id=<?=$id?>&name=Export Certificate" class="btn-sm btn btn-success mt-3"><i class="fa fa-eye"></i></a> -->

						<a href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn-sm btn btn-success mt-3"><i class="fa fa-eye"></i></a>
						<a href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn-sm btn btn-secondary mt-3" download><i class="fa fa-download"></i></a>

<?php

}else{?>

			<a href="vehicle_docs.php?vehicle_id=<?=$id?>&name=export_certificate" target="_blank" class="btn-sm mt-3 btn btn-primary"><i class="fa fa-plus"></i></a>


	<?php



}

?>						

					</div>

				</div><!-- inner row -->

				

			</div><!-- form group -->

			<div class="form-group">

				<div class="row">

					<div class="col-sm-2">

						<label for="">Date</label>

					</div><!-- col -->

					<div class="col-sm-6">	

						<small class="text-danger">Received</small>

						<input type="date" onchange="checkDateValidty('export_info_translation_date');compareDates('export_info_translation','export_info_translation_date','Translations ');" name="export_info_translation_date" id="export_info_translation_date" class="form-control form-control-sm">



					</div><!-- col -->

						<div class="col-sm-4" style="margin-top: 10px">

						<small class="text-danger"></small>

						
<?php

//$d = get($dbc,"airmail_files WHERE file_title = 'Ownership Certificate' AND vehicle_id = '$id'");

$d  = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM airmail_files WHERE file_title='translations' AND vehicle_id = '$id'"));

//echo $d['file_title'];

if(@$d['file_title'] == 'translations'){

?>

						<!-- <a href="vehicle_docs.php?vehicle_id=<?=$id?>&name=Export Certificate" class="btn-sm btn btn-success mt-3"><i class="fa fa-eye"></i></a> -->

						<a href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn-sm btn btn-success mt-3"><i class="fa fa-eye"></i></a>
						<a href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn-sm btn btn-secondary mt-3" download><i class="fa fa-download"></i></a>

<?php

}else{?>

		<a href="vehicle_docs.php?vehicle_id=<?=$id?>&name=Translations" target="_blank" class="btn-sm mt-3 btn btn-primary"><i class="fa fa-plus"></i></a>


	<?php



}

?>						

					</div>



				</div><!-- inner row -->

			</div><!-- form group -->

	

		

			<div class="form-group">

				<div class="row">

					<div class="col-sm-2">

						<label for="">Date</label>

					</div><!-- col -->

					<div class="col-sm-6">	

						<small class="text-danger">Received</small>

						<input type="date" onchange="checkDateValidty('inspection_certificate_date');compareDates('inspection_certificate','inspection_certificate_date','Inspection Certificate');" name="inspection_certificate_date" id="inspection_certificate_date" class="form-control form-control-sm">

					</div><!-- col -->

					<div class="col-sm-4" style="margin-top: 10px">

						<small class="text-danger"></small>

<?php

//$d = get($dbc,"airmail_files WHERE file_title = 'Ownership Certificate' AND vehicle_id = '$id'");

$d  = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM airmail_files WHERE file_title='inspection_certificate' AND vehicle_id = '$id'"));

//echo $d['file_title'];

if(@$d['file_title'] == 'inspection_certificate'){

?>

						<!-- <a href="vehicle_docs.php?vehicle_id=<?=$id?>&name=Export Certificate" class="btn-sm btn btn-success mt-3"><i class="fa fa-eye"></i></a> -->

						<a href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn-sm btn btn-success mt-3"><i class="fa fa-eye"></i></a>
						<a href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn-sm btn btn-secondary mt-3" download><i class="fa fa-download"></i></a>


<?php

}else{?>

						<a href="vehicle_docs.php?vehicle_id=<?=$id?>&name=inspection_certificate" target="_blank" class="btn-sm mt-3 btn btn-primary"><i class="fa fa-plus"></i></a>


	<?php



}

?>						

					</div>

				</div><!-- inner row -->

			</div><!-- form group -->

					<div class="form-group">

				<div class="row">

					<div class="col-sm-2">

						<label for="">Date</label>

					</div><!-- col -->

					<div class="col-sm-6">	

						<small class="text-danger">Received</small>

						<input type="date" onchange="checkDateValidty('export_info_shipping_order_date');compareDates('export_info_shipping_order','export_info_shipping_order_date','Shipping Order');" name="export_info_shipping_order_date" id="export_info_shipping_order_date" class="form-control form-control-sm">

					</div><!-- col -->

					<div class="col-sm-4" style="margin-top: 10px">

						<small class="text-danger"></small>

						
<?php

//$d = get($dbc,"airmail_files WHERE file_title = 'Ownership Certificate' AND vehicle_id = '$id'");

$d  = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM airmail_files WHERE file_title='shipping_order' AND vehicle_id = '$id'"));

//echo $d['file_title'];

if(@$d['file_title'] == 'shipping_order'){

?>

						<!-- <a href="vehicle_docs.php?vehicle_id=<?=$id?>&name=Export Certificate" class="btn-sm btn btn-success mt-3"><i class="fa fa-eye"></i></a> -->

	<a href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn-sm btn btn-success mt-3"><i class="fa fa-eye"></i></a>
	<a href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn-sm btn btn-secondary mt-3" download><i class="fa fa-download"></i></a>

<?php

}else{?>
<a href="vehicle_docs.php?vehicle_id=<?=$id?>&name=shipping_order" target="_blank" class="btn-sm mt-3 btn btn-primary"><i class="fa fa-plus"></i></a>


	<?php



}

?>						

					</div>

				</div><!-- inner row -->

			</div><!-- form group -->
			<div class="form-group">
				
				<div class="row"  class="">
					<div class="col-sm-12 ">
						<h6 class="text-danger <?=$msgSet;?>">Invoice or Payment Has been not Cleared</h6 class="text-danger">
					</div>
				</div>

				<div class="row ">

					<div class="col-sm-2">

						<label for="">Date</label>

					</div><!-- col -->

					<div class="col-sm-6">	

						<small class="text-danger">Received</small>

						<input type="date" <?=$formSet?>  onchange="checkDateValidty('bill_of_lading_date');compareDates('bill_of_lading','bill_of_lading_date','Bill of lading  ');" name="bill_of_lading_date" id="bill_of_lading_date" class="form-control form-control-sm">

					</div><!-- col -->

					<div class="col-sm-4" style="margin-top: 10px">

						<small class="text-danger"></small>

<?php

//$d = get($dbc,"airmail_files WHERE file_title = 'Ownership Certificate' AND vehicle_id = '$id'");

$d  = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM airmail_files WHERE file_title='bill_of_lading' AND vehicle_id = '$id'"));

//echo $d['file_title'];

if(@$d['file_title'] == 'bill_of_lading'){

?>

						<!-- <a href="vehicle_docs.php?vehicle_id=<?=$id?>&name=Export Certificate" class="btn-sm btn btn-success mt-3"><i class="fa fa-eye"></i></a> -->

						<a  href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn-sm btn btn-success mt-3 <?=$formSet?>"><i class="fa fa-eye"></i></a>
						<a  href="img/vehicle_docs/<?=$d['airmail_file_name']?>" target="_blank" class="btn-sm btn btn-secondary mt-3 <?=$formSet?>" download><i class="fa fa-download"></i></a>

<?php

}else{?>

			
						<a  href="vehicle_docs.php?vehicle_id=<?=$id?>&name=bill_of_lading" target="_blank" class="btn-sm <?=$formSet?> mt-3 btn btn-primary"><i class="fa fa-plus"></i></a>

	<?php



}

?>						

					</div>

				</div><!-- inner row -->

			
			</div>

			

		</div><!-- col -->

	</div><!-- mian -->




	
			<div class="row">
			<div class="col-12">
				<input type="hidden" name="formData7_type"  value="">
				
				<button type="button" class="btn btn-success" id="backTohome">Previous</button>
				<button type="submit" class="btn btn-warning float-right ml-3" id="formData7_next" onclick="submitForm('formData7','next')" >Save and Next</button>
				<button type="submit" class="btn btn-primary float-right ml-3"   id="formData7_save" onclick="submitForm('formData7','save')" >Save</button>
			</div>
	</div>

</form>



<br>





	<div class="col-sm-12">

		<div class="panel">

	<div class="panel-heading cyan-bgcolor " align="center"><h4>Vehicle File</h4></div>

	<div class="panel-body" >

		

			<table class="table table-hover table-sm table-bordered refresh_person_doc">

				<thead>

			<tr>	

				<th>ID</th>

				<th>Docs Title </th>

				<th>File </th>

				

			</tr>

			</thead>

			<div class="" id="" >

			<tbody>

				<?php  

					$q = get($dbc,"airmail_files WHERE file_type = 'general_document' AND vehicle_id = '$id'");

					while ($r = mysqli_fetch_assoc($q)):?>

				<tr>

					<td><?=$r['airmail_file_id']?></td>

					<td><?=$r['file_title']?></td>

					<td>

							<a href="img/vehicle_docs/<?=$r['airmail_file_name']?>" target="_blank" class="btn-sm btn btn-success mt-3"><i class="fa fa-eye"></i></a>
						<a href="img/vehicle_docs/<?=$r['airmail_file_name']?>" target="_blank" class="btn-sm btn btn-secondary mt-3" download><i class="fa fa-download"></i></a>
					</td>

					

				</tr>

				<?php endwhile ?>

			</tbody></div>

			

			</table>

		

	</div>

</div>



</div>

	







<table class="table table-hover table-sm table-bordered d-none">

	<thead>

		<tr>

			<th>Sr.</th>

			<th>Detail</th>

			<th>Action</th>

		</tr>

	</thead>

	<tbody id="export_idTable">

	</tbody>

</table>



<script type="text/javascript">

	



	function validatedateseport(){

		var from_year = $("#export_info_export_certificate").val();

		var to_year =  $("#export_info_export_certificate_date").val();



		alert(from_year);

		

		if (from_year > to_year) {

			alert("Receiving date  should NOT be lower than Applied Date ");

			  //$("#vehicle_reg_month").foucs();



			 

		 $('#export_info_export_certificate_date').val(0);

			// $('.vehicle_reg_month').removeAttr('selected').find('option:first').attr('selected', 'selected');

			

		}





		

	}





</script>