<?php
  /* $sql = "SELECT * FROM company ORDER BY id ASC LIMIT 1";

                    $result = $connect->query($sql);

                    while($row = $result->fetch_array()) {
                     
                   // while?>
	
    <?php
    $logo = $row['logo'];
     $name= $row['name'];
   $company_phone= $row['company_phone'];
	$personal_phone=$row['personal_phone'];
	$address=$row['address'];

 } */
    ?>
<?php 
include_once "includes/header.php";
?>
<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
<div class="panel">
	<div class="panel-heading panel-heading-red" align="center"><h4>Purchase Report</h4></div>
	<div class="panel-body">
		<?php getMessage(@$msg,@$sts); ?>
		<form action="" method="post" class="form-inline print_hide" >
			<div class="form-group">
				<label for="">Customer Account</label>
				<select class="form-control" id="clientName" name="customer_id" autofocus="true">
		      	<option value="">~~SELECT~~</option>
		      	<?php 
		      	$sql = "SELECT * FROM customers WHERE customer_active = 1";
						$result = $connect->query($sql);

						while($row = $result->fetch_array()) {
							echo "<option value='".$row[0]."'>".$row[1]."</option>";
						} // while
						
		      	?>
		      </select>	
			</div><!-- group -->
			<div class="form-group">
				<label for="">From</label>
				<input type="text" class="form-control" autocomplete="off" name="from_date" id="from" placeholder="From Date">
			</div><!-- group -->
			<div class="form-group">
				<label for="">To</label>
				<input type="text" class="form-control" autocomplete="off" name="to_date" id="to" placeholder="To Date">
			</div><!-- group -->
			<button class="btn btn-success" name="search_sale" type="submit">Search</button>
		</form>
		<?php if(isset($_REQUEST['search_sale'])): 
			$qty=0;
			 $f_date=$_REQUEST['from_date'];
			 $t_date = $_REQUEST['to_date'];
			 $customer_id = $_REQUEST['customer_id'];
			?>


					

					<button onclick="window.print();"  class="btn btn-primary pull-right print_btn print_hide">Print Report</button>
					<br><br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Sr.No</th>
					<th>Dated</th>
					<th>Bill#</th>
					<th>Item</th>
					<th>purchased Qty</th>
					<th>Rate</th>
					<th>Grand Total</th>
					<th>Party Detail</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1; 
				$q = mysqli_query($dbc,"SELECT * FROM purchase WHERE (purchase_date BETWEEN '$f_date' AND '$t_date') OR client_name='$customer_id'"); ?>
				<?php while($r=mysqli_fetch_assoc($q)):

					$fetchCustomer = fetchRecord($dbc,"customers","customer_id",$r['client_name']);
					$getItem = mysqli_query($dbc,"SELECT * FROM purchase_item WHERE purchase_id='$r[purchase_id]'");

					?>

				<tr>
					<th><?=$i?></th>
					<th><?=date('D, d-M-Y',strtotime($r['purchase_date']))?></th>
					<th><?=$r['purchase_id']?></th>
					<th>
						<?php 

					while($fetchItem=mysqli_fetch_assoc($getItem)):
						$fetchProduct = fetchRecord($dbc,"product",'product_id',$fetchItem['product_id']);
						$fetchCategory = fetchRecord($dbc,"categories","categories_id",$fetchProduct['categories_id']);?>
						<p><?=$fetchProduct['product_name']?> <small><?=$fetchCategory['categories_name']?></small></p>
					<?php endwhile; ?>
						</th>
					<th>
					<?php 
					$getItem = mysqli_query($dbc,"SELECT * FROM purchase_item WHERE purchase_id='$r[purchase_id]'");
					while($fetchItem=mysqli_fetch_assoc($getItem)):
						$fetchProduct = fetchRecord($dbc,"product",'product_id',$fetchItem['product_id']);
						$fetchCategory = fetchRecord($dbc,"categories","categories_id",$fetchProduct['categories_id']);?>
						<p><?=$fetchItem['quantity']?> <span class="text-right">x</span></p>
					<?php endwhile; ?>
						</th>
					<th>
					<?php 
					$getItem = mysqli_query($dbc,"SELECT * FROM purchase_item WHERE purchase_id='$r[purchase_id]'");
					while($fetchItem=mysqli_fetch_assoc($getItem)):
						$fetchProduct = fetchRecord($dbc,"product",'product_id',$fetchItem['product_id']);
						$fetchCategory = fetchRecord($dbc,"categories","categories_id",$fetchProduct['categories_id']);?>
						<p><?=$fetchItem['rate']?></p>
					<?php endwhile; ?>
						</th>
					<th>
					<?php 
					$getItem = mysqli_query($dbc,"SELECT * FROM purchase_item WHERE purchase_id='$r[purchase_id]'");
					while($fetchItem=mysqli_fetch_assoc($getItem)):
						$fetchProduct = fetchRecord($dbc,"product",'product_id',$fetchItem['product_id']);
						$fetchCategory = fetchRecord($dbc,"categories","categories_id",$fetchProduct['categories_id']);?>
						<p><?=$fetchItem['total']?></p>
					<?php endwhile; ?>
						</th>
					<th><?=$fetchCustomer['customer_name']?> <br><?=$r['client_contact']?></th>
				</tr>
			<?php $i++;endwhile; ?>
			</tbody>
		</table>
	<?php endif; ?>
	</div><!-- body -->
</div><!-- panel -->
</div>
</div>

<?php
include_once "includes/footer.php";
?>
  	

<script>
	$( function() {
		var dateFormat = "yy-mm-dd";
			from = $( "#from" )
				.datepicker({
					changeMonth: true,
					numberOfMonths: 1,
					dateFormat : "yy-mm-dd",
				})
				.on( "change", function() {
					to.datepicker( "option", "minDate", getDate( this ) );
				}),
			to = $( "#to" ).datepicker({
				changeMonth: true,
				numberOfMonths: 1,
				dateFormat : "yy-mm-dd",
			})
			.on( "change", function() {
				from.datepicker( "option", "maxDate", getDate( this ) );
			});

		function getDate( element ) {
			var date;
			try {
				date = $.datepicker.parseDate( dateFormat, element.value );
			} catch( error ) {
				date = null;
			}

			return date;
		}
	} );
	</script>