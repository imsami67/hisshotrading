<?php require_once 'includes/header.php'; ?>

<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading panel-heading-red">
				<div class="page-heading"> <i class="fa fa-dashboard"></i> Daily Profit Summary</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">
			<table class="table">
				<thead>
					<tr>
						<th>Dated</th>
						<th>Profit</th>
						<th>Expense</th>
						<th>Net Profit</th>
					</tr>
				</thead>
				<tbody>

					<?php 
					 $expense=$net_profit=0;
					$q = $connect->query("SELECT DISTINCT(order_date) FROM orders WHERE order_status=1 ORDER BY order_date DESC"); 
					while($r=$q->fetch_assoc()):
						$getOrder = $connect->query("SELECT * FROM orders WHERE order_date='$r[order_date]'");
						$getBudget = $connect->query("SELECT * FROM budget WHERE budget_date='$r[order_date]' AND budget_type='expense'");
						$order_date=$r['order_date'];
					?>
					<tr>
						<td><?=date('D, d-M-Y',strtotime($r['order_date']))?></td>
						<td>
						
							<?php while($fetchOrder=$getOrder->fetch_assoc()): ?>
								<?php	
									
										 $sql = "SELECT * FROM order_item WHERE order_id = '$fetchOrder[order_id]' AND order_item_status=1";
											$query = $connect->query($sql);
									while ($result = $query->fetch_assoc()) {
										  $product_id= $result['product_id'];
										 $sold_quantity= $result['quantity'];
										 $sold_rate= $result['rate'];
										
									$sql_item = "SELECT * FROM product WHERE product_id = '$product_id'";
									$query_item = $connect->query($sql_item);
									while ($result_item = $query_item->fetch_assoc()) {
										 $product_purchase= $result_item['purchase'];
									
									$sold_income = $sold_quantity * $sold_rate;
									$purchase_income = $product_purchase * $sold_quantity; 
								}
								 	$net_profit+=$sold_income-$purchase_income ;
								 }//while
										?>
							<?php endwhile; ?>
							<span class="label label-sm label-success" style="font-size: 25px"><?php echo  @$net_profit; ?></span>
						</td>
						<td>
							<?php while($fetchBudget=$getBudget->fetch_assoc()): ?>
								<?php $expense+=$fetchBudget['budget_amount']; ?>
							<?php endwhile; ?>
							<span class="label label-sm label-danger" style="font-size: 25px"><?php echo  @$expense; ?></span>
						</td>
						<td>
							<span class="label label-sm label-warning" style="font-size: 25px"><?php echo  @($net_profit-$expense); ?></span>
						</td>
					</tr>
				<?php $expense= $net_profit=0;endwhile; ?>
				</tbody>
			</table>
			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

<div class="row">
	<div class="col-md-12">
		<div class="panel">
			<div class="panel-heading panel-heading-purple">
				<div class="page-heading"> <i class="fa fa-dashboard"></i> Month Profit Summary</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">
			<table class="table">
				<thead>
					<tr>
						<th>Dated</th>
						<th>Sale</th>
						<th>Profit</th>
						<th>Expense</th>
						<th>Net Profit</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					// echo $current_month = date('Y-m');
					$grand_total= $expense=$net_profit=0;

					$q = $connect->query("SELECT DISTINCT(DATE_FORMAT(order_date,'%Y-%m')) AS 'month' FROM orders  WHERE order_status=1 ORDER BY order_date DESC");
					while($r=$q->fetch_assoc()):
						$current_month=$r['month'];
						$mon = date('Y-m',strtotime($r['month']));
						$getOrder = $connect->query("SELECT * FROM orders WHERE order_date LIKE '%$current_month%' AND order_status=1");
						$getOrderGrand = $connect->query("SELECT * FROM orders WHERE order_date LIKE '%$current_month%' AND order_status=1");
						$getBudget = $connect->query("SELECT * FROM budget WHERE budget_date LIKE '%$current_month%' AND budget_type='expense'");
						
					?>
					<tr>
						<td><?= date('M-Y',strtotime($mon)) ?></td>
						<td>
							<?php while($fetchOrderGrand=$getOrderGrand->fetch_assoc()): ?>
								<?php $grand_total+=$fetchOrderGrand['grand_total']; ?>
							<?php endwhile; ?>
							<?php echo $grand_total; ?>
							
						</td>
						<td>
						
							<?php while($fetchOrder=$getOrder->fetch_assoc()): ?>
								<?php	
									
										 $sql = "SELECT * FROM order_item WHERE order_id = '$fetchOrder[order_id]' AND order_item_status=1";
											$query = $connect->query($sql);
									while ($result = $query->fetch_assoc()) {
										  $product_id= $result['product_id'];
										 $sold_quantity= $result['quantity'];
										 $sold_rate= $result['rate'];
										
									$sql_item = "SELECT * FROM product WHERE product_id = '$product_id'";
									$query_item = $connect->query($sql_item);
									while ($result_item = $query_item->fetch_assoc()) {
										 $product_purchase= $result_item['purchase'];
									
									$sold_income = $sold_quantity * $sold_rate;
									$purchase_income = $product_purchase * $sold_quantity; 
								}
								 	$net_profit+=$sold_income-$purchase_income ;
								 }//while
										?>
							<?php endwhile; ?>
							<span class="label label-sm label-success" style="font-size: 25px"><?php echo  @$net_profit; ?></span>
						</td>
						<td>
							<?php while($fetchBudget=$getBudget->fetch_assoc()): ?>
								<?php $expense+=$fetchBudget['budget_amount']; ?>
							<?php endwhile; ?>
							<span class="label label-sm label-danger" style="font-size: 25px"><?php echo  @$expense; ?></span>
						</td>
						<td>
							<span class="label label-sm label-warning" style="font-size: 25px"><?php echo  @($net_profit-$expense); ?></span>
						</td>
					</tr>
				<?php $grand_total=$expense= $net_profit=0;endwhile; ?>
					
				</tbody>
			</table>
			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->
</div>
</div>
<?php require_once 'includes/footer.php'; ?>