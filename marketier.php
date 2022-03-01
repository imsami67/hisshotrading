<?php include_once "includes/header.php" ?>
<?php include_once "inc/code.php" ?>
<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
	<div class="panel">
		<div class="panel-heading cyan-bgcolor" align="center">
			<h5><span class="glyphicon glyphicon-user"></span> Maketier Management system</h5>
		</div>
		<div class="panel-body">
			<div class="mt-5 mb-5" style="float: right;">
	<button type="button" class="btn btn-info  " data-toggle="modal" data-target="#myModal">
	<i class="material-icons">person_add</i> Add Maketier</button>
</div>
<br/><br/>
<table class="table" id="myTable" class="table-responsive">

	<thead>
		<tr class="">
			<th>Marketier ID</th>
			<th>Marketier Name</th>
			<th>Email</th>
			<th>Phone</th>
			<th>Status</th>
			<th>Created Date</th>
			<th>Open Account</th>
		</tr>
	</thead>
	<tbody>
		<?php $q=mysqli_query($dbc,"SELECT * FROM customers WHERE customer_role = 'marketier'");
		while($r=mysqli_fetch_assoc($q)):
			$customer_id = $r['customer_id'];
		 ?>
		<tr>
			<td><?=$r['customer_id']?></td>
			<td class="text-capitalize"><?=$r['customer_name']?></td>
			<td class="text-lowercase"><?=$r['customer_email']?></td>
			<td><?=$r['customer_phone']?></td>
			<td><?=$r['customer_active']?></td>
			<td><?=$r['customer_add_date']?></td>
			<td>
				<?php $getTransaction = mysqli_query($dbc,"SELECT * FROM transactions WHERE customer_id='$customer_id' AND debit='0' AND credit='0'"); 
					if(mysqli_num_rows($getTransaction)>=1):
						$fetchTansaction = mysqli_fetch_assoc($getTransaction);
				?>
				<div class="badge badge-info">Open from <?=$fetchTansaction['balance']?>/-</div>
			<?php else: ?>

				<a href='index.php?nav=open_account&customer_id=<?=base64_encode($r['customer_id'])?>'>Open Account</a>
			<?php endif; ?>

			</td>
		</tr>
	<?php endwhile; ?>
	</tbody>
</table>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          
          <h4 class="modal-title" style="float: left;">Add Marketier</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
	        <div class="modal-body">
	          <form action="" method="post">
				  <div class="form-group">
				    <label for="email">Full Name:</label>
				    <input type="text" class="form-control" id="name" name="name" autofocus="true" placeholder="Full Name">
				  </div>
				  <div class="form-group">
				    <label for="email">Email:</label>
				    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
				  </div>
				  <div class="form-group">
				    <label for="email">Phone:</label>
				    <input type="number" class="form-control" id="phone" name="phone" placeholder="Phone">
				  </div>
				   <div class="form-group">
				    <label for="address">Address:</label>
				   <textarea name="address" id="address" cols="30" rows="4" placeholder="Address" class="form-control"></textarea>
				  </div>
				   <div class="form-group">
				    <label for="active">Status:</label>
				    <select name="status" required class="form-control "> 
				    	<option value="1">Active</option>
				    	<option value="2">Deactive</option>
				    </select>
				  </div>
				  
				 <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" name="add_marketier">Submit</button>
        </div>
				  
			</form>
	        </div>

      </div>
      
    </div>
  </div>
		</div>
	</div>
  
</div>
</div>

<?php include_once 'includes/footer.php'; ?>