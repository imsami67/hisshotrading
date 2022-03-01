<?php 
include_once "includes/header.php";
 ?>
	<div class="row">
		<div class="col-sm-12">
		<ol class="breadcrumb">
  <li><a href="dashboard.php">Home</a></li>
  <li>Sales</li>
  <li class="active">
  	
  		Product Sale Report 

		
  </li>
</ol>
 <div class="panel panel-warning">
	<div class="panel-heading"><center>Product Sale Report</center></div>
 		<div class="panel panel-body">
 		<div class="col-sm-8">
 		<form class="" method="post">
				<input list="l0st" class="form-control livesearch"  onfocus="myFunction(this)"  name="productName" id="productName" >

			  					<datalist id="l0st">
			  						<option value="">~~SELECT~~</option>
			  						<?php
			  							$productSql = "SELECT * FROM product WHERE active = 1 AND status = 1 ORDER BY product_name ASC";
			  							$productData = $connect->query($productSql);

			  							while($row = $productData->fetch_array()) {	

			  							//for cetagory 
			  							$product_id = $row['product_id'];
				$fetchProduct = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM product WHERE product_id='$product_id'"));
				$fetchCategory = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM categories WHERE categories_id='$fetchProduct[categories_id]'"));
				$brand = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM brands WHERE brand_id='$fetchProduct[brand_id]'"));
									// for category end
									$category_show = $fetchCategory['categories_name'];
										$brand1 = $brand['brand_name'];	 		
											echo "<option value='".$row['product_id']."' id='changeProduct'>".$row['product_name'];
										
										echo "($category_show)";
										echo "[$brand1]</option>";
			  							
										 	 } // /while

			  						?>

		  						</option>
		  						
       
        
      </datalist>
      </div>
      <div class="col-sm-4">

      <input type="submit" name="show_deatils" class="btn btn-danger">
            </form>
      </div>
 		</div>
 </div>
 	</div>


 	<?php if (isset($_POST['show_deatils'])): 
 		$product_id = $_POST['productName'];
 		?>
 		<div class="col-sm-12">
 		<div class="panel panel-info">
	<div class="panel-heading">Show Sale </div>
		<div class="panel-body">
		<table class="table myTable" id="" class="table-responsive">

	<thead>
		<tr>
			<th>Order No#</th>
			<th>Date</th>
			<th>Customer</th>
			<th>Product Name</th>
			<th>Quantity</th>
			<th>Rate</th>
			<th>Total Amount</th>
			
		</tr>
				
	</thead>
	<tbody>
		<?php 
					$q=mysqli_query($dbc,"SELECT * FROM order_item WHERE product_id = '$product_id' ORDER BY order_item_id DESC");
				while($r=mysqli_fetch_assoc($q)): 
				$purchase__fetch_id = $r['order_id'];
				
					$q2=mysqli_query($dbc,"SELECT * FROM orders WHERE order_id = '$purchase__fetch_id'");
				while($r2=mysqli_fetch_assoc($q2)){

					
					?>
		<tr>
		<?php
		$purchase_id =  $r['order_id'];
		$fetchCustomer =mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM customers WHERE customer_id='$r2[client_name]'"));
		$fetchProductName =mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM product WHERE product_id='$r[product_id]'"));
		 
		?>
						<td><?= $r2['order_id']?></td>
						<td><?= $r2['order_date']?></td>
						<td><?= $fetchCustomer['customer_name'];?></td>
						<td><?= $fetchProductName['product_name']?></td>
						<td><?= $r['quantity']?></td>
						<td><?= $r['rate']?></td>
						<td><?= $r['total']?></td>
						
		</tr>
			
	
	<?php
	}
	 endwhile; ?>
	</tbody>
</table>
			
		</div>
</div>
 		
 	<?php endif ?>
 		</div>
 		</div>