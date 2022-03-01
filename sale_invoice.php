
  

   

<body>
<?php 
//mac work
// Turn on output buffering  
ob_start();  

//Get the ipconfig details using system commond  
system('ipconfig /all');  

// Capture the output into a variable  
$mycomsys=ob_get_contents();  

// Clean (erase) the output buffer  
ob_clean();  

$find_mac = "Physical"; 
//find the "Physical" & Find the position of Physical text  

$pmac = strpos($mycomsys, $find_mac);  
// Get Physical Address  

$macaddress=substr($mycomsys,($pmac+36),17);
//echo $macaddress;  
//Display Mac Address  
//if ($macaddress=='C0-18-85-3C-84-EC') {

//mac work end

 $date_now = new DateTime();
 $date2    = new DateTime("01/01/2022");

if ($date_now < $date2) {
	require_once 'php_action/db_connect.php'; 
	require_once 'includes/header.php'; 
?>
<style>

   		</style>
<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
	<div id="app"  style="position: fixed;top: 50px;left: 0px;z-index: 10000;">
		<div>
			 <center>
		       	<video  id="preview" style="width: 180px;height: 180px;border-radius: 10px"></video>
		       	<div id="scan_img" style="display: none;margin-top: -20px;width: 100px;height: 100px;margin:auto;float: left;">
			 		<img src="img/scanning.gif" class="img img-responsive center-block" alt="" align="bottom" width="180px" height="180px">
			 	</div>
		       </center>
		</div><!-- col -->
	</div><!-- app -->
<div class="panel">

	<div class="panel-heading panel-heading-green">
  		<i class="fa fa-plus"></i>	Sale Invoice
  		<a href='orderslist.php?o=manord' style="color: white !important; " ><button class='btn btn-primary pull pull-right' style="margin-top: -4.7px;">
  		<span class="fa fa-list"></span> &nbsp List of Orders</button></a>
	</div> <!--/panel-->	
	<div class="panel-body">
		<!-- <div class="msg"></div> /success-messages -->
  		<form method="POST" action="php_action/custom_action.php" id="formData14">
			<div class="detailMsg"></div>
  			<div class="msg"></div>
			<div class="row">
				<div class="col-sm-4">
				  <div class="form-group row">
				    <label for="invoiceNumber" class="col-sm-4 control-label">Invoice #</label>
				    <div class="col-sm-8">
				    	<?php 
				    	$q = mysqli_query($dbc,"SELECT invoice_id FROM invoice ORDER BY invoice_id DESC");
				    	$abc = mysqli_num_rows($q)+1;
				    	?>
				      <input type="text" class="form-control" readonly="" id="invoiceNumber" value="INV-JP<?=date('y')?>-<?=$abc?>"/>
				    </div>
				  </div> <!--/form-group-->
					
				</div><!-- col -->
				<div class="col-sm-4">
				  <div class="form-group row">
				    <label for="orderDate" class="col-sm-2 control-label">Date</label>
				    <div class="col-sm-9">
				      <input type="date" readonly class="form-control dateField" id="orderDate" name="invoice_date" value="<?php echo date("Y-m-d")?>"/>
				    </div>
				  </div> <!--/form-group-->
				</div><!-- col -->
				<div class="col-sm-4">
				  <div class="form-group row">
				    <label for="orderDate" class="col-sm-2 control-label">Due Date</label>
				    <div class="col-sm-9">
				    	<?php 
				    		$today = date("Y-m-d");
				    		$date = strtotime("+5 day", strtotime($today));
							$newDate = date("Y-m-d", $date);
				    	?>
				      <input type="date" class="form-control dateField" id="orderDate" name="invoice_due_date" value="<?=$newDate?>"/>
				    </div>
				  </div> <!--/form-group-->
				</div><!-- main -col -->
			</div><!-- main row -->
			<div class="row">
				<div class="col-sm-4">
				  <div class="form-group row">
				    <label for="clientName" class="col-sm-4 control-label">Select Account</label>
				    <div class="col-sm-8">
				    		<input list="clientName1" class="form-control" id="clientName" name="invoice_customer" required>
						<datalist id="clientName1">
							<option value="">~~SELECT~~</option>
							<?php 
							     	$sql = "SELECT * FROM customers WHERE customer_active = 1 AND customer_role = 'customer'";
										$result = $connect->query($sql);
										while($row = $result->fetch_array()) {
										echo "<option value='".$row[0]."'>".$row[1]."</option>";
									} // while
							?>
						</datalist>
				   	</div>
				  </div> <!--/form-group-->
				</div><!-- mian col -->
				<div class="col-sm-4">
					<div class="form-group row">
						<div class="col-sm-9 offset-2">
							<div class="input-group">
								<input type="text" class="form-control" id="customeName" readonly="readonly">
								<span class="input-group-addon">Balance: <span class="badge" id="customer_balance">0</span></span>
							</div>
						</div>
					</div><!-- form group -->
				</div><!-- mian col -->
				<div class="col-sm-4">
					<div class="form-group row">
				    <label for="clientName" class="col-sm-3 control-label">Select Users</label>
				    <div class="col-sm-8">
						<select class="form-control" id="user_name" name="invoice_user" required>
							<option value="">~~SELECT~~</option>
							<?php 
							     	$sql = "SELECT * FROM users";
										$result = $connect->query($sql);
										while($row = $result->fetch_array()) {
										echo "<option value='".$row[0]."'>".$row[1]."</option>";
									} // while
							?>
						</select>
				   	</div>
				  </div> <!--/form-group-->
				</div><!-- form group -->
			</div><!-- main row -->
			<div class="row">
				<div class="col-sm-4">
				  <div class="form-group row">
				    <label for="country_name" class="col-sm-4 control-label">Select Country</label>
				    <div class="col-sm-8">
				    	<!-- <?=countrySelector("", "country_name", "country_name", "form-control country_name"); ?> -->
				    	<select name="country_name" class="country_name form-control" id="country_name">
				    		 <option>Select Country</option>
			                                <?php
						                    	$sql = mysqli_query($dbc,"SELECT * FROM country_regulation GROUP BY country_regulation_country");
						                    	while($countries=mysqli_fetch_assoc($sql)):
						                    ?>
			                                <option value="<?=$countries['country_regulation_country']?>"><?=$countries['country_regulation_country']?></option>
			                                <?php
			                              endwhile;
			                                ?>
				    		
				    	</select>
				   	</div>
				  </div> <!--/form-group-->
				</div><!-- mian col -->
				<div class="col-sm-4">
					<div class="form-group row">
				    <label for="port_name" class="col-sm-3 control-label">Port Name</label>
				    <div class="col-sm-8">
						<select class="form-control" id="port_name" name="port_name">
							<option value="">~~SELECT~~</option>
						</select>
				   	</div>
				  </div> <!--/form-group-->
				</div><!-- mian col -->
				<div class="col-sm-4">
					<div class="form-group row">
				    <label for="Fee" class="col-sm-3 control-label">Fee</label>
				    <div class="col-sm-8">
				    	<input type="text" class="form-control" name="fee" id="fee">
				   	</div>
				  </div> <!--/form-group-->
				</div><!-- col -->
			</div><!-- main row -->

			  <table class="table" id="productTable" style="width: 100%">
				
			  	<thead>
			  		<tr>			  			
			  			<th style="width:30%;">Vehicle / Car</th>
			  			<th style="width:20%;">Cost</th>
			  			<th style="width:20%;">Rate</th>
			  			<th style="width:15%;">Show Rate</th>
			  			<th style="width:15%;">Total</th>			  			
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php
			  		$arrayNumber = 0;
			  		for($x = 1; $x < 2; $x++) { ?>
			  			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
			  				<td style="margin-left:20px;">
			  					<div class="form-group">
			  						<!-- <div id="customOpt"></div> -->
				  				<input list="lst" class="form-control livesearch" autocomplete="off" name="invoice_vehicle" id="invoice_vehicle" onchange="getVehicle();">

			  					<datalist id="lst">
			  						<option id="customOpt">~~SELECT~~</option>
		  						</datalist>
						       <input  name="f_Text" id="f_Text" class="form-control" readonly / >
			  				</td>
			  				<td style="padding-left:20px;">	
			  					<div class="form-group">
			  						<input type="number" name="invoice_cost" id="invoice_cost" autocomplete="off" onkeyup="getTotal(<?php echo $x ?>)"  class="form-control" />
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">	
			  					<div class="form-group">
			  						<input type="number" name="invoice_rate" id="invoice_rate" autocomplete="off" onkeyup="getTotalInvoice();"  class="form-control" />
			  					</div>
			  				</td>


							
			  				<td style="padding-left:20px;">
			  					<div class="form-group">
			  						<input type="number" name="invoice_show_rate" id="invoice_show_rate" autocomplete="off" onkeyup=""  class="form-control" />
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="total" id="total" autocomplete="off" class="form-control" readonly />
			  				</td>
			  				<td>

			  					<!-- <button class="btn btn-danger removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow()"><i class="fa fa-trash"></i></button> -->
			  				</td>
			  			</tr>
		  			<?php
		  			$arrayNumber++;
			  		} // /for
	 		  		?>
			  	</tbody>			  	
			  </table>
			  <td>
			  	<button type="text" class="btn btn-primary d-none pull-right" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="fa fa-plus"></i> Add Row </button>

			  </td>
			  <br>
			  <div class="row">
			  	<div class="col-sm-3">
			  		<div class="form-group">
			  			<div class="row">
			  				<div class="col-sm-3">
						  		<label for="invoice_inspection">Inspection</label>
			  				</div>
			  				<div class="col-sm-9">
						  		<input type="text" class="form-control" name="invoice_inspection" id="invoice_inspection" readonly> 
			  				</div>
			  			</div><!-- row -->
			  		</div><!-- form group -->
			  	</div><!-- col -->

			  	<div class="col-sm-3">
			  		<div class="row">
				  		<div class="col-sm-4">
					  		<label for="fci">FOB</label>
				  		</div>
				  		<div class="col-sm-8 check">
					  		<input type="checkbox" id="fci" class="" value="">
					  		<input type="text" name="invoice_fci" id="fci_field" class="form-control oneInput d-none">
				  		</div>
			  		</div>
			  	</div><!-- mian col -->

			  		<div class="col-sm-3">
			  		<div class="row">
				  		<div class="col-sm-3">
					  		<label for="Frieght">Frieght</label>
				  		</div>
				  		<div class="col-sm-9">
					  		<input type="text" id="Frieght" class="form-control" name="invoice_fright" id="invoice_fright">
				  		</div>
			  		</div>
			  	</div><!-- mian col -->
			  	
			  	<div class="col-sm-3">
			  		<div class="row">
				  		<div class="col-sm-4">
					  		<label for="cui">CNF</label>
				  		</div>
				  		<div class="col-sm-8 check">
					  		<input type="checkbox" id="cui" class="" value="">
					  		<input type="text" name="invoice_cui" id="cui_field" class="form-control oneInput d-none">
				  		</div>
			  		</div>
			  	</div><!-- mian col -->
			  
			  </div><!-- main row -->
			  <br>
			  <div class="row">
			  	
			  	<div class="col-sm-4">
			  		<div class="form-group">
			  			<div class="row">
			  				<div class="col-sm-3">
						  		<label for="invoice_currency">Currency</label>
			  				</div>
			  				<div class="col-sm-9">
			  					<?= countryCurrency('invoice_currency','invoice_currency','form-control') ?>
			  				</div>
			  			</div><!-- row -->
			  		</div><!-- form group -->
			  	</div><!-- col -->
			  	<div class="col-sm-4">
			  		<div class="form-group">
			  			<div class="row">
			  				<div class="col-sm-3">
						  		<label for="">Bank</label>
			  				</div>
			  				<div class="col-sm-9">
							<input list="bank_name1" class="form-control" id="invoice_bank" name="invoice_bank" required autocomplete="off">
							<datalist id="bank_name1">
			  					<?php 
							     	$sql = "SELECT * FROM customers WHERE customer_active = 1 AND customer_role = 'bank'";
										$result = $connect->query($sql);
										while($row = $result->fetch_array()) {
										echo "<option value='".$row[0]."'>".$row[10]." ".$row[1]."</option>";
									} // while
								?>
							</datalist>
			  				</div>
			  			</div><!-- row -->
			  		</div><!-- form group -->
			  	</div><!-- col -->
			  </div><!-- main row -->
			  <br>
			<div class="row">			
			  <div class="col-md-4">
			  	<div class="form-group">
			  		<div class="row">
			  			<div class="col-sm-3">
			  				<label for="">Previous Balance</label>
			  			</div><!-- col -->
			  			<div class="col-sm-9">
			  				<input type="text" class="form-control" name="invoice_previous_balance" readonly="readonly" id="invoice_previous_balance">
			  			</div><!-- col -->
			  		</div><!-- row -->
			  	</div><!-- formgroip -->
			  </div> <!--/col-md-4-->
			  <div class="col-md-4">
			  	<div class="form-group">
			  		<div class="row">
			  			<div class="col-sm-3">
			  				<label for="">Discount</label>
			  			</div><!-- col -->
			  			<div class="col-sm-9">
			  				<input type="text" class="form-control" onkeyup="getDiscount();" name="invoice_discount" id="invoice_discount">
			  			</div><!-- col -->
			  		</div><!-- row -->
			  	</div><!-- formgroip -->
			  </div> <!--/col-md-4-->	
			  <div class="col-md-4">
			  	<div class="form-group">
			  		<div class="row">
			  			<div class="col-sm-3">
			  				<label for="">Grand Total</label>
			  			</div><!-- col -->
			  			<div class="col-sm-9">
			  				<input type="text" readonly="readonly" class="form-control" name="invoice_grand_total" id="invoice_grand_total">
			  			</div><!-- col -->
			  		</div><!-- row -->
			  	</div><!-- formgroip -->
			  </div> <!--/col-md-4-->
			</div>  <!-- mian row -->

			<div class="row">			
			  <div class="col-md-4">
			  	<div class="form-group">
			  		<div class="row">
			  			<div class="col-sm-3">
			  				<label for="">Paid Amount</label>
			  			</div><!-- col -->
			  			<div class="col-sm-5">
			  				<input type="text" class="form-control" name="invoice_paid_amount" id="invoice_paid_amount" onkeyup="getPaid();">
			  			</div><!-- col -->
			  			<div class="col-sm-4">
			  				<div class="form-group row">
								<div class="input-group">
									<input type="text" placeholder="Percentage %" class="form-control" name="invoice_paid_percent" id="invoice_paid_percent" onkeyup="getPayPercent();" min="1" max="100">
									<span class="input-group-addon">%</span>
								</div>
							</div><!-- form group -->
						</div>
			  		</div><!-- row -->
			  	</div><!-- formgroip -->
			  </div> <!--/col-md-4-->
			  <div class="col-md-4">
			  	<div class="form-group">
			  		<div class="row">
			  			<div class="col-sm-3">
			  				<label for="">Due Amount</label>
			  			</div><!-- col -->
			  			<div class="col-sm-9">
			  				<input type="text" class="form-control" name="invoice_due_amount" id="invoice_due_amount" readonly="readonly">
			  			</div><!-- col -->
			  		</div><!-- row -->
			  	</div><!-- formgroip -->
			  </div> <!--/col-md-4-->	
			  <div class="col-md-4">
			  	<div class="form-group">
			  		<div class="row">
			  			<div class="col-sm-3">
			  				<label for="">Next Due Date</label>
			  			</div><!-- col -->
			  			<div class="col-sm-9">
			  				<input type="date" class="form-control" name="invoice_next_due" id="invoice_next_due">
			  			</div><!-- col -->
			  		</div><!-- row -->
			  	</div><!-- formgroip -->
			  </div> <!--/col-md-4-->
			</div>  <!-- mian row -->
			<div class="row">
				<div class="col-sm-8 offset-4">
					<div class="row">
						<div class="col-sm-3">
					  		<label for="">Invoice Status</label>
						</div>
						<div class="col-sm-9">					
							<select name="invoice_sts" id="invoice_sts" class="form-control" required="required">
								<option value="">~~ SELECT ~~</option>
								<option value="1">Completed</option>
								<option value="2">Pending</option>
								<option value="3">Forfiet</option>
							</select>
						</div>
					</div>
				</div><!-- col -->
			</div><!-- main roe -->


			  <div class="form-group submitButtonFooter">
			    <div class="col-sm-offset-2 col-sm-10">
			    <!-- <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="fa fa-plus"></i> Add Row </button> -->

			      <button type="submit" id="createOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="fa fa-check-circle-o"></i> Save Changes</button>

			      <button type="reset" class="btn btn-default" onclick="resetOrderForm()"><i class="fa fa-eraser"></i> Reset</button>
			    </div>
			  </div>
			</form>
			<div id="success-messages"></div>

		<?php 
		// /else manage order
		}
		?>
		
	</div> <!--/panel-->	
</div> <!--/panel-->	

<!-- remove order -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeOrderModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-trash"></i> Remove Order</h4>
      </div>
      <div class="modal-body">

      	<div class="removeOrderMessages"></div>

        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="fa fa-remove"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeOrderBtn" data-loading-text="Loading..."> <i class="fa fa-check-circle-o"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove order-->
</div>
</div>
</body>

<?php 
	require_once 'includes/footer.php'; 
?>
<!-- Bootstrap JavaScript -->
<script src="js/bootstrap.js"></script>
  <script>
  	$('.check input:checkbox').click(function() {
  		$('.check input:checkbox').not(this).prop('checked', false);
    	var element = $(".oneInput");
  		element.classList.toggle("d-none");

	}); 
  	$('#fci').change(function(){
	    var c = this.checked ? 'false' : 'true';
	    if (c == "true") {
		    $('#fci_field').addClass('d-none');
	    }else{
		    $('#fci_field').removeClass('d-none');
	    }
	});
	$('#cui').change(function(){
	    var d = this.checked ? 'false' : 'true';
	    if (d == "true") {
		    $('#cui_field').addClass('d-none');
	    }else{
		    $('#cui_field').removeClass('d-none');
	    }
	});
  </script>
	 <script>
        document.onkeyup = function(e) {
  if (e.altKey && e.which == 82) {
  	//p press
   $("#paid").focus();
   // subAmount();
  } 
  if (e.altKey && e.which == 83) {
  	//r press
   $("#createOrderBtn").submit();

  } 
   if (e.altKey && e.which == 80) {
  	//p press
  	$("#printorder").click();
  

  }  if (e.altKey && e.which == 78) {
  	//n press
  	$("#neworder").click();
  

  } 
}; 
$(document).on('input','.search-barcode',function(){
	var barcode_id = $(this).attr('title');
	var barcode_val = $(this).val();
	 		 $("#productName"+barcode_id).val(barcode_val);
		      getProductData(barcode_id);
		$.ajax({
			url:"ajax/fetchBarcodeData.php",
			type:'get',
			data:{productId:$(this).val()},
			dataType:'text',
			success:function(response){
			$("#productName"+barcode_id).html(response);
			}
		});
});
</script>