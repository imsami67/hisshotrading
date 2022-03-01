<?php require_once 'php_action/db_connect.php' ?>
<?php require_once 'includes/header.php'; ?>

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Home</a></li>		  
		  <li class="active">Product</li>
		</ol>

		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Product</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
				<a href="stockprint.php" target="_blank"><button class="btn btn-primary">Print Stock</button></a>
					<button class="btn btn-default button1" data-toggle="modal" id="addProductModalBtn" data-target="#addProductModal"> <i class="glyphicon glyphicon-plus-sign"></i> Add Product </button>

				</div> <!-- /div-action -->				
				
				<table class="table">
					<thead>
						<tr>
							<th style="width:10%;">Photo</th>			
							<th>Product Name</th>
							<th>Rate</th>							
							<th>Quantity</th>
						</tr>
					</thead>
					<tbody id="tbody">
						<?php $q=mysqli_query($dbc,"SELECT * FROM product LIMIT 50");
						while($r=mysqli_fetch_assoc($q)):
						 ?>
						<tr>
							<td><?=$r['product_image']?></td>
							<td><?=$r['product_name']?></td>
							<td><?=$r['rate']?></td>
							<td><?=$r['quantity']?></td>
						</tr>
					<?php endwhile; ?>
					</tbody>
				</table>
				<center>
					<button class="btn btn-success" id="loadMore">Load More</button>
				</center>
				<!-- /table -->
			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->



<script src="custom/js/product.js"></script>

<?php require_once 'includes/footer.php'; ?>