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

<div class="panel panel-danger">
	<div class="panel-heading" align="center"><h4>Expence Report</h4></div>
	<div class="panel-body">
		<?php getMessage(@$msg,@$sts); ?>
		<form action="" method="post" class="form-inline print_hide" >
			
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
			// $customer_id = $_REQUEST['customer_id'];
			?>


					

					<button onclick="window.print();"  class="btn btn-primary pull-right print_btn print_hide">Print Report</button>
		<table class="table">
			<thead>
				<tr>
					<th>Sr.No</th>
					<th>Date</th>
					<th>Expense Type</th>
					<th>Amount</th>
					
				</tr>
			</thead>
			<tbody>
				<?php $i=1; 
				$q = mysqli_query($dbc,"SELECT * FROM budget WHERE (budget_date BETWEEN '$f_date' AND '$t_date') AND budget_type = 'expense' "); ?>
				<?php while($r=mysqli_fetch_assoc($q)):

					

					?>

				<tr>
					<th><?=$i?></th>
					<th><?=date('D, d-M-Y',strtotime($r['budget_date']))?></th>
					<th><?= $r['budget_name']?></th>
					<th><?= $r['budget_amount']?></th>
					
					
						
					
				</tr>
			<?php $i++;
			endwhile; ?>
			</tbody>
		</table>
	<?php endif; ?>
	</div><!-- body -->
</div><!-- panel -->

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