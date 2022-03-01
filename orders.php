
  

   

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
 $date2    = new DateTime("01/01/2021");

if ($date_now < $date2) {
       
   

require_once 'php_action/db_connect.php'; 
require_once 'includes/header.php'; 


// if($_GET['o'] == 'add') { 
// // add order  

// 	echo "<div class='div-request div-hide'>add</div>";
// } else if($_GET['o'] == 'manord') { 
// 	echo "<div class='div-request div-hide'>manord</div>";
// } else if($_GET['o'] == 'editOrd') { 
// 	echo "<div class='div-request div-hide'>editOrd</div>";
// } // /else manage order


?>
<style>

   		</style>
<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
<!-- <ol class="breadcrumb"> -->
  <!-- <li><a href="dashboard.php">Home</a></li> -->
  <!-- <li>Order</li> -->
  <!-- <li class="active"> -->
  	<!-- <?php if($_GET['o'] == 'add') {
  	 ?>
  		Add Order  

		<?php } else if($_GET['o'] == 'manord') { ?>
			Manage Order
		<?php } // /else manage order ?> -->
  <!-- </li> -->
<!-- </ol> -->


<!-- <h4>
	<i class='fa fa-circle-arrow-right'></i>
	<?php if($_GET['o'] == 'add') {
		echo "Add Order";
	} else if($_GET['o'] == 'manord') { 
		echo "Manage Order";
	} else if($_GET['o'] == 'editOrd') { 
		echo "Edit Order";
	}
	?>	
</h4> -->
 <?php if($_REQUEST['o'] =='add'  ): ?>
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
<?php endif; ?>
<div class="panel">

	<div class="panel-heading panel-heading-green">

		<?php if($_GET['o'] == 'add') { ?>
  		<i class="fa fa-plus"></i>	Add Order  
  		<a href='orderslist.php?o=manord' style="color: white !important; " ><button class='btn btn-primary pull pull-right' style="margin-top: -4.7px;"> 
  		<span class="fa fa-list"></span> &nbsp List of Orders</button></a>
  		
		<?php } else if($_GET['o'] == 'manord') { ?>
			<i class="fa fa-edit"></i> Manage Order
		<?php } else if($_GET['o'] == 'editOrd') { ?>
			<i class="fa fa-edit"></i> Edit Order
		<?php } ?>

	</div> <!--/panel-->	
	<div class="panel-body">
			
		<?php if($_GET['o'] == 'add') { 
			// add order
			?>			

			<div class="success-messages"></div> <!--/success-messages-->

  		<form class="form-horizontal" method="POST" action="php_action/createOrder.php" id="createOrderForm">
			
			  <div class="form-group row">
			    <label for="orderDate" class="col-sm-2 control-label">Order Date</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control dateField" id="orderDate" name="orderDate" 
			      value="<?php echo date("Y/m/d/l")?>"/>
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group row">
			    <label for="clientName" class="col-sm-2 control-label">Select Account</label>
			    <div class="col-sm-10">
			    			<div class="input-group">
			    				<select class="form-control" id="clientName" name="clientName" autofocus="true" required style="z-index: 1">
						      	<option value="">~~SELECT~~</option>
						      	<?php 
						      	$sql = "SELECT * FROM customers WHERE customer_active = 1";

										$result = $connect->query($sql);

										while($row = $result->fetch_array()) {
											echo "<option value='".$row[0]."'>".$row[1]."</option>";
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
			     
			  </div> <!--/form-group-->
			  <div class="form-group row">
			    <label for="clientContact" class="col-sm-2 control-label">Party Customer / Name</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="clientContact" name="clientContact" placeholder="Contact Number" autocomplete="off" value="_" />
			    </div>
			  </div> <!--/form-group-->			  

			  <table class="table" id="productTable" style="width: 100%">
			  <!-- <button type="button" class="btn btn-primary pull-right" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="fa fa-plus-sign"></i> Add Row </button> -->
				
			  	<thead>
			  		<tr>			  			
			  			<th style="width:30%;">Product</th>
			  			<th style="width:20%;">Quantity</th>
			  			<th style="width:10%;">Rate</th>
			  			<!-- <th style="width:10%;">Discount%</th>			  			 -->
			  			<th style="width:15%;">Total</th>			  			
			  			
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
	
			  					 <!-- <select class="form-control " name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" > -->

			  				<input list="lst" class="form-control livesearch" autocomplete="off" onfocus="myFunction(this)"  name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)">

			  					<datalist id="lst">
			  						<option value="">~~SELECT~~</option>
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
			  						<span class="input-group-addon">Purchase</span>
			  						<input readonly type="text" name="purchase_rateValue[]" id="purchase_rateValue<?php echo $x; ?>" autocomplete="off" class="form-control" />
			  					</div>
			  					<div class="input-group">
			  						<span class="input-group-addon">Stock</span>
			  						<input readonly type="text" name="stock[]" id="stock<?php echo $x; ?>" autocomplete="off" class="form-control" />
			  					</div>			  					
			  				</td>


							
			  				<td style="padding-left:20px;">
			  					<div class="form-group">
			  					<input type="number" name="rate[]" id="rate<?php echo $x; ?>" autocomplete="off" onkeyup="getTotal(<?php echo $x ?>)"  class="form-control" />
			  					
			  					</div>
			  				</td>

			  				<!-- <td style="padding-left:20px;">
			  					<div class="form-group">
			  					<input type="number" name="pdiscount[]" id="pdiscount<?php echo $x; ?>" autocomplete="off" onkeyup="getTotal(<?php echo $x ?>)"  class="form-control" value="0" />
			  					
			  					</div>
			  				</td>  -->
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" readonly />			  					
			  					<input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
			  				</td>
			  				<td>

			  					<button class="btn btn-danger removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="fa fa-trash"></i></button>
			  				</td>
			  				<!-- <td>
			  				<span id="imgVal<?php echo $x; ?>"></span>

			  					
			  				</td> -->

			  				

			  			</tr>
		  			<?php
		  			$arrayNumber++;
			  		} // /for
	 		  		?>
			  	</tbody>			  	
			  </table>
			  <td>
			  	<button type="button" class="btn btn-primary pull-right" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="fa fa-plus"></i> Add Row </button>
			  </td>
			  <br><br><br>
			<div class="row">			
			  <div class="col-md-6">
			  	<div class="form-group row">
				    <label for="subTotal" class="col-sm-3 control-label">Previous Balance</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="previous_balance" name="previous_balance" disabled="true" />
				      <input type="hidden" class="form-control" id="previous_balanceValue" name="previous_balanceValue" />
				    </div>
				  </div> <!--/form-group-->	
			  	<div class="form-group row">
				    <label for="subTotal" class="col-sm-3 control-label">Sub Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" />
				      <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" />
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group hidden">
				    <label for="vat" class="col-sm-3 control-label">Discount 0</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="vat" name="vat" disabled="true" />
				      <input type="hidden" class="form-control" id="vatValue" name="vatValue" />
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group row">
				    <label for="totalAmount" class="col-sm-3 control-label">Total Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true"/>
				      <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" />
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group row">
				    <!-- <label for="discount" class="col-sm-3 control-label">Tex (OFF)</label> -->
				    <div class="col-sm-9">
				      <input type="hidden" class="form-control" id="discount" name="discount"  autocomplete="off"  value="0" />
				    </div>
				  </div> <!--/form-group-->	
				  <div class="form-group row">
				    <label for="grandTotal" class="col-sm-3 control-label">Grand Total</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true" />
				      <input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue" />
				    </div>
				  </div> <!--/form-group-->			  		  
			  </div> <!--/col-md-6-->

			  <div class="col-md-6">
			  	<p id="show_current_amount" class="text-center text-danger"></p>
			  	<div class="form-group row">
				    <label for="paid" class="col-sm-3 control-label">Paid Amount</label>
				    <div class="col-sm-9">
				    <!-- <input type="text" class="form-control" id="paid" name="grandTotal"  />
				      <input type="hidden" class="form-control" id="paidValue" name="paidValue" /> -->
				      <input type="number" class="form-control" id="paid" name="paid" autocomplete="off" onkeyup="paidAmount()" required />
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group row">
				    <label for="due" class="col-sm-3 control-label">Due Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="due" name="due" disabled="true" />
				      <input type="hidden" class="form-control" id="dueValue" name="dueValue" />
				    </div>
				  </div> <!--/form-group-->		
				  <div class="form-group row">
				    <label for="clientContact" class="col-sm-3 control-label">Payment Type</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="paymentType" id="paymentType">
				      	<option value="2">Cash</option>
				      	<option value="1">Cheque</option>
				      	
				      	<option value="3">Credit Card</option>
				      </select>
				    </div>
				  </div> <!--/form-group-->							  
				  <div class="form-group row">
				    <label for="clientContact" class="col-sm-3 control-label">Payment Status</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="paymentStatus" id="paymentStatus">
				      	<option value="1">Full Payment</option>
				      	
				      	<option value="2">Advance Payment</option>
				      	<option value="3">No Payment</option>
				      </select>
				    </div>
				  </div> <!--/form-group-->	
				  <div class="form-group">
				  	<textarea name="transaction_remarks" class="form-control"  placeholder="Note...." id="" cols="30" rows="4">Amount receivable for goods sold</textarea>
				  </div><!-- group -->
			  </div> <!--/col-md-6-->
			</div>  


			  <div class="form-group submitButtonFooter">
			    <div class="col-sm-offset-2 col-sm-10">
			    <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="fa fa-plus"></i> Add Row </button>

			      <button type="submit" id="createOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="fa fa-check-circle-o"></i> Save Changes</button>

			      <button type="reset" class="btn btn-default" onclick="resetOrderForm()"><i class="fa fa-eraser"></i> Reset</button>
			    </div>
			  </div>
			</form>
		<?php } else if($_GET['o'] == 'manord') { 
			// manage order
			?>

			<div id="success-messages"></div>
			
			<table class="table" id="manageOrderTable">
				<thead>
					<tr>
						<th>#</th>
						<th>Order Date</th>
						<th>Account</th>
						<th>Customer</th>
						<th>Total Order Item</th>
						<th>Payment Status</th>
						<th>Option</th>
						

					</tr>
				</thead>
			</table>

		<?php 
		// /else manage order
		} else if($_GET['o'] == 'editOrd') {
			// get order
			?>
			
			<div class="success-messages"></div> <!--/success-messages-->

  		<form class="form-horizontal" method="POST" action="php_action/editOrder.php" id="editOrderForm">

  			<?php $orderId = $_GET['i'];

  			$sql = "SELECT orders.order_id, orders.order_date, orders.client_name, orders.client_contact, orders.sub_total, orders.vat, orders.total_amount, orders.discount, orders.grand_total, orders.paid, orders.due, orders.payment_type, orders.payment_status FROM orders 	
					WHERE orders.order_id = {$orderId}";

				$result = $connect->query($sql);
				$data = $result->fetch_row();				
  			?>
  			  <div class="form-group">
			    <label for="orderDate" class="col-sm-2 control-label">Order Date</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="orderDate" name="orderDate" 
			      value="<?php echo $data[1] ?>"     />
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="clientName" class="col-sm-2 control-label">Select Account</label>
			    <div class="col-sm-10">
			    			<div class="input-group">
			    				<select class="form-control" id="clientName" name="clientName" autofocus="true">
			    					<?php if(empty($data[2])): 
			    						
			    						?>
			    						<option value="walking">Cash in hand</option>
			    					<?php else: 
			    						$fetchParty=fetchRecord($dbc,"customers",'customer_id',$data[2]);
			    						$fetchTransaction = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM transactions WHERE customer_id='$data[2]' ORDER BY transaction_id DESC LIMIT 1"));
			    						?>
			    						<option value="<?=$data[2]?>"><?=$fetchParty['customer_name']?></option>
			    					<?php endif; ?>
						      	
						      	<?php 
						      	$sql = "SELECT * FROM customers WHERE customer_active = 1";

										$result = $connect->query($sql);

										while($row = $result->fetch_array()) {
											echo "<option value='".$row[0]."'>".$row[1]."</option>";
										} // while
										
						      	?>
						      </select>	
						      <span class="input-group-addon">
						      	Balance: 
						      		<span class="badge" id="customer_balance">
						      			<?=$fetchTransaction['balance']?>
						      		</span>
						      	</span>
			    			</div><!-- input group -->
			     <!--  <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Client Name" autocomplete="off" value="_"  autofocus="true" />
 -->
			    </div>
			     
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-2 control-label">Party Customer / Name</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="clientContact" name="clientContact" placeholder="Contact Number" autocomplete="off" value="<?=$data[3]?>" />
			    </div>
			  </div> <!--/form-group-->


			  <table class="table" id="productTable">
			  	<thead>
			  		<tr>			  			
			  			<th style="width:40%;">Product</th>
			  			<th style="width:25%;">Quantity</th>
			  			<th style="width:20%;">Rate</th>			  			
			  			<th style="width:15%;">Total</th>			  			
			  			<th style="width:10%;"></th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php

			  		$orderItemSql = "SELECT order_item.order_item_id, order_item.order_id, order_item.product_id, order_item.quantity, order_item.rate, order_item.total FROM order_item WHERE order_item.order_id = {$orderId}";
						$orderItemResult = $connect->query($orderItemSql);
						// $orderItemData = $orderItemResult->fetch_all();						
						
						// print_r($orderItemData);
			  		$arrayNumber = 0;
			  		// for($x = 1; $x <= count($orderItemData); $x++) {
			  		$x = 1;
			  		while($orderItemData = $orderItemResult->fetch_array()) { 
			  			// print_r($orderItemData);
			  			$fetchProductData = fetchRecord($dbc,"product",'product_id',$orderItemData['product_id']);
			  			?>
			  			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
			  				<td style="margin-left:20px;">
			  					<div class="form-group">
						<select class="form-control" data-show-subtext="true" data-live-search="true" name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)">
			  					<!-- <select class="form-control" name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" > -->
			  						<option value="">~~SELECT~~</option>
			  						<?php
			  							$productSql = "SELECT * FROM product WHERE active = 1 AND status = 1 AND quantity != 0";
			  							$productData = $connect->query($productSql);

			  							while($row = $productData->fetch_array()) {									 		
			  								$selected = "";
			  								if($row['product_id'] == $orderItemData['product_id']) {
			  									$selected = "selected";
			  								} else {
			  									$selected = "";
			  								}

			  								echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."' ".$selected." >".$row['product_name']."</option>";
										 	} // /while 

			  						?>
		  						</select>
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">
			  				<input type="text" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" value="<?php echo $orderItemData['quantity']; ?>" />			  					
			  					
			  								  					
			  					<input type="hidden" name="rateValue[]" id="rateValue<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $orderItemData['rate']; ?>"/>	
			  					<div class="input-group">
			  						<span class="input-group-addon">Purchase</span>
			  						<input readonly type="text" name="purchase_rateValue[]" id="purchase_rateValue<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo number_format($fetchProductData['purchase'],2); ?>"/>
			  					</div>
			  					<div class="input-group">
			  						<span class="input-group-addon">Stock</span>
			  						<input readonly type="text" name="stock[]" id="stock<?php echo $x; ?>" autocomplete="off" class="form-control"  value="<?php echo $fetchProductData['quantity']; ?>"/>
			  					</div>			  					
			  				</td><!-- rate cell -->
			  				
			  				<td style="padding-left:20px;">
			  					<div class="form-group">
			  						<input type="text" name="rate[]" id="rate<?php echo $x; ?>" autocomplete="off" onkeyup="getTotal(<?php echo $x ?>)"  class="form-control" value="<?php echo $orderItemData['rate']; ?>"/>
			  					</div>
			  				</td>
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" readonly value="<?php echo $orderItemData['total']; ?>"/>			  					
			  					<input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $orderItemData['total']; ?>"/>			  					
			  				</td>
			  				<td>

			  					<button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="fa fa-trash"></i></button>
			  				</td>
			  			</tr>
		  			<?php
		  			$arrayNumber++;
		  			$x++;
			  		} // /for
			  		?>
			  	</tbody>			  	
			  </table>
			   <td>
			  					
			  					<button type="button" class="btn btn-primary pull-right" 
			  					onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="fa fa-plus</i> Add Row </button>
			  				</td>
				 <div class="col-md-6">
			  	<div class="form-group">
				    <label for="subTotal" class="col-sm-3 control-label">Previous Balance</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="previous_balance" name="previous_balance" disabled="true" value="<?php echo $fetchTransaction['balance'] ?>"/>
				      <input type="hidden" class="form-control" id="previous_balanceValue" name="previous_balanceValue" value="<?php echo $fetchTransaction['balance'] ?>"/>
				    </div>
				  </div> <!--/form-group-->	
			  	<div class="form-group">
				    <label for="subTotal" class="col-sm-3 control-label">Sub Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" value="<?php echo $data[4] ?>"/>
				      <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" value="<?php echo $data[4] ?>"/>
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group hidden">
				    <label for="vat" class="col-sm-3 control-label">Discount 0</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="vat" name="vat" disabled="true" />
				      <input type="hidden" class="form-control" id="vatValue" name="vatValue" />
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
				    <label for="totalAmount" class="col-sm-3 control-label">Total Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true" value="<?php echo $data[6] ?>"/>
				      <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue"  value="<?php echo $data[6] ?>"/>
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
				    <!-- <label for="discount" class="col-sm-3 control-label">Tex (OFF)</label> -->
				    <div class="col-sm-9">
				      <input type="hidden" class="form-control" id="discount" name="discount"  autocomplete="off"  value="0" />
				    </div>
				  </div> <!--/form-group-->	
				  <div class="form-group">
				    <label for="grandTotal" class="col-sm-3 control-label">Grand Total</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true" value="<?php echo $data[8] ?>"/>
				      <input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue" value="<?php echo $data[8] ?>"/>
				    </div>

				  </div> <!--/form-group-->	

			  </div> <!--/col-md-6-->
			  
					
			  <div class="col-md-6">
			  	<button type="button" onclick="subAmount()" class="btn btn-danger btn-block">Show Current Amount</button>
			  	<p id="show_current_amount" class="text-center text-danger"></p>
			  	<div class="form-group">
				    <label for="paid" class="col-sm-3 control-label">Paid Amount</label>
				    <div class="col-sm-9">
				      <input type="number" class="form-control" id="paid" name="paid" autocomplete="off" onkeyup="paidAmount()" value="<?php echo $data[9] ?>"  />
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
				    <label for="due" class="col-sm-3 control-label">Due Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="due" name="due" disabled="true" value="<?php echo $data[10] ?>"  />
				      <input type="hidden" class="form-control" id="dueValue" name="dueValue" value="<?php echo $data[10] ?>"  />
				    </div>
				  </div> <!--/form-group-->		
				  <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Payment Type</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="paymentType" id="paymentType" >
				      	<option value="">~~SELECT~~</option>
				      	<option value="1" <?php if($data[11] == 1) {
				      		echo "selected";
				      	} ?> >Cheque</option>
				      	<option value="2" <?php if($data[11] == 2) {
				      		echo "selected";
				      	} ?>  >Cash</option>
				      	<option value="3" <?php if($data[11] == 3) {
				      		echo "selected";
				      	} ?> >Credit Card</option>
				      </select>
				    </div>
				  </div> <!--/form-group-->							  
				  <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Payment Status</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="paymentStatus" id="paymentStatus">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1" <?php if($data[12] == 1) {
				      		echo "selected";
				      	} ?>  >Full Payment</option>
				      	<option value="2" <?php if($data[12] == 2) {
				      		echo "selected";
				      	} ?> >Advance Payment</option>
				      	<option value="3" <?php if($data[10] == 3) {
				      		echo "selected";
				      	} ?> >No Payment</option>
				      </select>
				    </div>
				  </div> <!--/form-group-->	
				    <div class="form-group">
				  	<textarea name="transaction_remarks" class="form-control"  placeholder="Note...." id="" cols="30" rows="4"><?=@$fetchTransaction['transaction_remarks']?></textarea>
				  </div><!-- group -->						  
			  </div> <!--/col-md-6-->


			  <div class="form-group editButtonFooter">
			    <div class="col-sm-offset-2 col-sm-10">
			    <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="fa fa-plus"></i> Add Row </button>

			    <input type="hidden" name="orderId" id="orderId" value="<?php echo $_GET['i']; ?>" />

			    <button type="submit" id="editOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="fa fa-check-circle-o"></i> Save Changes</button>
			      
			    </div>
			  </div>
			</form>

			<?php
		} // /get order else  ?>


	</div> <!--/panel-->	
</div> <!--/panel-->	


<!-- edit order -->
<div class="modal fade" tabindex="-1" role="dialog" id="paymentOrderModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Payment</h4>
      </div>      

      <div class="modal-body form-horizontal" style="max-height:500px; overflow:auto;" >

      	<div class="paymentOrderMessages"></div>

      	     				 				 
			  <div class="form-group">
			    <label for="due" class="col-sm-3 control-label">Due Amount</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="due" name="due" disabled="true" />					
			    </div>
			  </div> <!--/form-group-->		
			  <div class="form-group">
			    <label for="payAmount" class="col-sm-3 control-label">Pay Amount</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="payAmount" name="payAmount"/>					      
			    </div>
			  </div> <!--/form-group-->		
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-3 control-label">Payment Type</label>
			    <div class="col-sm-9">
			      <select class="form-control" name="paymentType" id="paymentType" >
			      	<option value="">~~SELECT~~</option>
			      	<option value="1">Cheque</option>
			      	<option value="2">Cash</option>
			      	<option value="3">Credit Card</option>
			      </select>
			    </div>
			  </div> <!--/form-group-->							  
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-3 control-label">Payment Status</label>
			    <div class="col-sm-9">
			      <select class="form-control" name="paymentStatus" id="paymentStatus">
			      	<option value="">~~SELECT~~</option>
			      	<option value="1">Full Payment</option>
			      	<option value="2">Advance Payment</option>
			      	<option value="3">No Payment</option>
			      </select>
			    </div>
			  </div> <!--/form-group-->	

      </div> <!--/modal-body-->
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="fa fa-remove"></i> Close</button>
        <button type="button" class="btn btn-primary" id="updatePaymentOrderBtn" data-loading-text="Loading..."> <i class="fa fa-check-circle-o"></i> Save changes</button>	
      </div>           
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit order-->

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

<script src="custom/js/order.js"></script>
<!-- <script>
document.getElementById("date").innerHTML = Date();
</script>
<script type="text/javascript">
function SetDate()
{
var date = new Date();

var day = date.getDate();
var month = date.getMonth() + 1;
var year = date.getFullYear();

if (month < 10) month = "0" + month;
if (day < 10) day = "0" + day;

var today = day + "-" + month + "-" + year;


document.getElementById('orderDate').value = today;
}
</script> -->

<?php 
}//mac address
else{
	echo"<script>window.open('expired.php');</script>";
}
require_once 'includes/footer.php'; 

// } //date baracet
 //else{
      // echo"<script>window.open('expired.php');</script>";
    //}
?>
  <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script> -->
		<!-- Bootstrap JavaScript -->
<script src="js/bootstrap.js"></script>
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
  				$("#previous_balance").val(response);
  				$("#previous_balanceValue").val(response);
  			}
  		});
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
<!-- <script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="js/adapter.js"></script>
    <script type="text/javascript" src="js/vue.js"></script> -->
    <!-- <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script> -->
   