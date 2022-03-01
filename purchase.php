<?php include_once "includes/header.php"; ?>
<script src="custom/js/purchase.js" type="text/javascript"></script>	
<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
<div class="panel">
	<div class="panel-heading panel-heading-green" align="center"><strong>Purchase</strong></div>
	<div class="panel-body">
		<?php if(!empty($_REQUEST['purchase_id'])): ?>
			<div class="alert alert-info">
			<a target="_blank" href="php_action/print_purchase.php?var=<?=$_REQUEST['purchase_id']?>" class="btn btn-primary">Print Last Purchase</a>
			<!-- <a target="_blank" href="print_voucher.php?print_voucher=<?=$_REQUEST['print_voucher']?>" class="btn btn-success">Edit Purchase</a> -->
			</div>
		<?php endif; ?>
		<form class="form-horizontal" method="POST" action="php_action/createpurchase.php" id="createOrderForm">
			
			  <div class="form-group">
			  	<div class="row">
			  		
			    <label for="purchaseDate" class="col-sm-2 control-label">purchase Date</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control datepicker" id="orderDate" name="purchaseDate" 
			      value="<?php echo date("Y/m/d/l")?>"     />
			    </div>
			  </div> <!--/form-group-->
			  	</div>
			  <div class="form-group">
			  	<div class="row">
			  		
			    <label for="clientName" class="col-sm-2 control-label">Select Account</label>
			    <div class="col-sm-10">
			    			<div class="input-group">
			    				<select class="form-control" id="clientName" name="clientName" autofocus="true" style="z-index: 1">
						      	<option value="">~~SELECT~~</option>
						      	<?php 
						      	$sql = "SELECT * FROM customers WHERE customer_active = 1";

										$result = $connect->query($sql);

										while($row = $result->fetch_array()) {
											echo "<option value='".$row['customer_id']."'>".$row[1]."</option>";
										} // while
										
						      	?>
						      </select>	
						      <span class="input-group-addon">
						      	Balance: 
						      		<span class="badge" id="customer_balance">
						      			0
						      		</span>
						      	</span>
			    			</div><!-- input group -->
			     <!--  <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Client Name" autocomplete="off" value="_"  autofocus="true" />
 -->
			  	</div>
			    </div>
			     
			  </div> <!--/form-group-->
			  <div class="form-group">
			  	<div class="row">
			  		
			    <label for="clientContact" class="col-sm-2 control-label">Party Customer / Name</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="clientContact" name="clientContact" placeholder="Contact Number" autocomplete="off" value="_" />
			    </div>
			  	</div>
			  </div> <!--/form-group-->			  

			  <table class="table" id="productTable">
			  <!-- <button type="button" class="btn btn-primary pull-right" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus"></i> Add Row </button> -->
				
			  	<thead>
			  		<tr>			  			
			  			<th style="width:40%;">Product</th>
			  			<th style="width:20%;">Quantity</th>
		 	  			<th style="width:15%;"> Purchase Rate</th>			  			
			  			<th style="width:15%;">Total</th>			  			
			  			<th style="width:10%;"></th>
			  			<th style="width:10%;"></th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php
			  		$arrayNumber = 0;
			  		for($x = 1; $x < 2; $x++) { ?>
			  			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
			  				<td style="margin-left:20px;">
			  					<div class="form-group">
	
			  					<input list="lst" class="form-control livesearch"  onfocus="myFunction(this)"  name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)">

								<datalist id="lst">	
			  						<?php
			  							$productSql = "SELECT * FROM product WHERE active = 1 AND status = 1 ORDER BY product_name ASC";
			  							$productData = $connect->query($productSql);

			  							while($row = $productData->fetch_array()) {	

			  							//for cetagory 
			  							$product_id = $row['product_id'];
				$fetchProduct = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM product WHERE product_id='$product_id'"));
				$fetchCategory = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM categories WHERE categories_id='$fetchProduct[categories_id]'"));
									// for category end	 		
											echo "<option value='".$row['product_id']."' id='changeProduct'>".$row['product_name'];
										$category_show = $fetchCategory['categories_name'];
										echo "($category_show)</option>";
	 		  							
										 	 } // /while

			  						?>

		  						</option>
									
								</datalist>
								 <input  name="f_Text" id="f_Text<?php echo $x; ?>" class="form-control" readonly / >
		  						
       
        
      
     
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control"  />
			  								  					
			  					<input type="hidden" name="rateValue[]" id="rateValue<?php echo $x; ?>" autocomplete="off" class="form-control" />	
			  					<div class="input-group">
			  						<span class="input-group-addon">Previous p</span>
			  						<input readonly type="text" name="purchase[]" id="purchase_value<?php echo $x; ?>" autocomplete="off" class="form-control" />
			  					</div>
			  					<div class="input-group">
			  						<span class="input-group-addon">Stock</span>
			  						<input readonly type="text" name="stock[]" id="quantity_show<?php echo $x; ?>" autocomplete="off" class="form-control" />
			  					</div>			  					
			  				</td>


							
			  				<td style="padding-left:20px;">
			  					<div class="form-group">
			  					<input type="text" name="rate[]" id="purchase<?php echo $x; ?>" autocomplete="off"  class="form-control" onkeyup="getTotal(<?php echo $x ?>)" />
			  					
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" readonly />			  					
			  					<input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
			  				</td>
			  				<td>

			  					<button class="btn btn-danger removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="fa fa-trash"></i></button>
			  				</td>
			  				

			  			</tr>
		  			<?php
		  			$arrayNumber++;
			  		} // /for
	 		  		?>
<!-- 	 		  		<tr>
	 		  		</tr> -->
			  	</tbody>			  	
			  </table>
						<td>
				  			<button type="button" class="btn btn-primary pull-right" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="fa fa-plus"></i>Add Row</button>
				  		</td>
				  		<br><br>
	
	  		<div class="row">
			  <div class="col-md-6">
			  	<div class="form-group">
			  		<div class="row">
			  			
				    <label for="subTotal" class="col-sm-3 control-label">Sub Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" />
				      <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" />
				    </div>
			  		</div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
			  		<div class="row">
			  			
				    <label for="vat" class="col-sm-3 control-label">Discount 0</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="vat" name="vat" disabled="true" />
				      <input type="hidden" class="form-control" id="vatValue" name="vatValue" />
				    </div>
			  		</div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
			  		<div class="row">
			  			
				    <label for="totalAmount" class="col-sm-3 control-label">Total Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true"/>
				      <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" />
				    </div>
			  		</div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
			  		<div class="row">
			  			
				    <!-- <label for="discount" class="col-sm-3 control-label">Tex (OFF)</label> -->
				    <div class="col-sm-9">
				      <input type="hidden" class="form-control" id="discount" name="discount"  autocomplete="off"  value="0" />
			  		</div>
				    </div>
				  </div> <!--/form-group-->	
				  <div class="form-group">
			  		<div class="row">
			  			
				    <label for="grandTotal" class="col-sm-3 control-label">Grand Total</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true" />
				      <input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue" />
			  		</div>
				    </div>
				  </div> <!--/form-group-->			  		  
			  </div> <!--/col-md-6-->

			  <div class="col-md-6">
			  	<div class="form-group">
			  		<div class="row">
				    <label for="paid" class="col-sm-3 control-label">Paid Amount</label>
				    <div class="col-sm-9">
				    <!-- <input type="text" class="form-control" id="paid" name="grandTotal"  />
				      <input type="hidden" class="form-control" id="paidValue" name="paidValue" /> -->
				      <input type="text" class="form-control" id="paid" name="paid" autocomplete="off" onkeyup="paidAmount()" />
				    </div>
				  </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
			  		<div class="row">
				    <label for="due" class="col-sm-3 control-label">Due Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="due" name="due" disabled="true" />
				      <input type="hidden" class="form-control" id="dueValue" name="dueValue" />
				    </div>
				  </div>
				  </div> <!--/form-group-->		
				  <div class="form-group">
			  		<div class="row">
				    <label for="clientContact" class="col-sm-3 control-label">Payment Type</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="paymentType" id="paymentType">
				      	<option value="2">Cash</option>
				      	<option value="1">Cheque</option>
				      	
				      	<option value="3">Credit Card</option>
				      </select>
				    </div>
				  </div>
				  </div> <!--/form-group-->							  
				  <div class="form-group">
			  		<div class="row">
				    <label for="clientContact" class="col-sm-3 control-label">Payment Status</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="paymentStatus" id="paymentStatus">
				      	<option value="1">Full Payment</option>
				      	
				      	<option value="2">Advance Payment</option>
				      	<option value="3">No Payment</option>
				      </select>
				    </div>
				  </div>
				  </div> <!--/form-group-->	
				  <div class="form-group">
				  	<textarea name="transaction_remarks" class="form-control" placeholder="Note...." id="" cols="30" rows="4">Purchased product</textarea>
				  </div><!-- group -->
			  </div> <!--/col-md-6-->
			  </div>


			  <div class="form-group submitButtonFooter">
			    <div class="col-sm-offset-2 col-sm-10">
			    <button type="button" class="btn btn-secondary" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="fa fa-plus"></i> Add Row </button>

			      <button type="submit" id="createOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="fa fa-check-circle-o"></i> Save Changes</button>

			      <button type="reset" class="btn btn-secondary" onclick="resetOrderForm()"><i class="fa fa-eraser"></i> Reset</button>
			    </div>
			  </div>
			</form>
	</div>
</div>
</div>
</div>
<?php include_once "includes/footer.php";?>
 <script>
  	$(document).on('change','#clientName',function(){
  		var customer_id = $(this).val();
  		$.ajax({
  			url:'ajax/getbalance.php',
  			type:'get',
  			dataType:'text',
  			data:{customer_id:customer_id},
  			success:function(response){
  				$("#customer_balance").html(response);
  			}
  		});
  	});
  	</script> 