<?php
include_once "includes/header.php";
?>
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-info">
			<div class="panel-heading">Search By Brand / Category</div>
			<div class="panel-body">
				
	
			  		<form action="" method="post" class="form-inline print_hide" >
			<div class=" col-sm-4">
				<label for="">Select Brand</label>
				<select class="form-control " id="brand" name="brand" autofocus="true" >
		      	<option value="">~~SELECT~~</option>
		      	<?php 
		      	$sqlll = "SELECT * FROM brands ";
						$result = $connect->query($sqlll);

						while($row = $result->fetch_array()) {
							echo "<option value='".$row[0]."'>".$row[1]."</option>";
						} // while
						
		      	?>
		      </select>	
			</div><!-- group -->
			<div class=" col-sm-4">
				<label for="">Select Category</label>
				<select class="form-control " id="categories" name="categories" autofocus="true" >
		      	<option value="">~~SELECT~~</option>
		      	<?php 
		      	$sqll = "SELECT * FROM categories ";
						$result2 = $connect->query($sqll);

						while($row2 = $result2->fetch_array()) {
							echo "<option value='".$row2[0]."'>".$row2[1]."</option>";
						} // while
						
		      	?>
		      </select>	
			</div><!-- group -->
			<div class="col-sm-2">
			<button class="btn btn-success" name="search_product" type="submit">Search</button>
			</div>
		</form>			 
       
        
      
     
			  					
			</div>
			<?php
				if (isset($_POST['search_product'])) {
					?>
				<div class="panel-body">
					<table class="table table-bordered" >
						<tr>
							<th>Sr#</th>
							<th>Product Name</th>
							<th>Product Quantity</th>
							<th>Product PurchaseRate</th>
							<th>Total</th>
						</tr>
						<?php
						$counter = 1;
						$brand = $_POST['brand'];
						$categories = $_POST['categories'];

						$q = mysqli_query($dbc,"SELECT * FROM product WHERE  brand_id = '$brand'  AND categories_id='$categories'"); ?>
						<tr>
				<?php while($r=mysqli_fetch_assoc($q)):
?>
				<td><?= $counter ; ?></td>
				<td><?= $r ['product_name'];?></td>
				<td><?= $r ['quantity'];?></td>
				<td><?= $r ['purchase'];?></td>
				<td><?= $r ['quantity'] *  $r ['purchase'] ;?></td>
					
				

</tr>
<?php	

			endwhile;

						?>


					</table>

					


				</div>	
					<?php
				}
			?>

		</div>
	</div>


	

	
</div>



<?php
include_once "includes/footer.php";
?>
