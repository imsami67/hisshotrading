<?php include_once "includes/header.php";?>
<script type="text/javascript" src="custom/js/purchase.js"></script>
<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
<div class="success-messages"></div> 
<div class="panel">
	<div class="panel-heading panel-heading-green">Show Purchases </div>
		<div class="panel-body">
		<table class="table example1">

	<thead>
		<tr>
			<th>Purchase Id</th>
			<th>Date</th>
			<th>Account</th>
			<th>Customer</th>
			<th>Total Amount</th>
			<th>option</th>
		</tr>
				
	</thead>
	<tbody>
		<?php 
					$q=mysqli_query($dbc,"SELECT * FROM purchase ORDER BY purchase_id DESC");
				while($r=mysqli_fetch_assoc($q)): ?>
		<tr>
		<?php
		$purchase_id =  $r['purchase_id'];
		$fetchCustomer =mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM customers WHERE customer_id='$r[client_name]'"));
		 
		?>
						<td><?= $r['purchase_id']?></td>
						<td><?= $r['purchase_date']?></td>
						<td><?= $fetchCustomer['customer_name'];?></td>
						<td><?= $r['client_contact']?></td>
						<td><?= $r['sub_total']?></td>
						<?php
						$purchase_id  = $r['purchase_id'];
						$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	  
	    
	    
	   

	    <li><a type="button" targe="_blank" href="php_action/print_purchase.php?var='.$r['purchase_id'].'"  onclick=" printOrdermange('. $r['purchase_id'].')""> <i class="glyphicon glyphicon-print"></i> Print </a></li>
	      <li><a type="button" targe="_blank" href="edit_purchase.php?var='.$r['purchase_id'].'"  > <i class="glyphicon glyphicon-edit"></i> Edit </a></li>

	       <li><a type="button" targe="_blank" href="php_action/removePurchase.php?var='.$r['purchase_id'].'"  > <i class="glyphicon glyphicon-trash"></i> Delete</a></li>
	       
	    
	        
	  </ul>
	</div>';
	?>
						<td> <?= $button ?></td>
		</tr>
			
	
	<?php endwhile; ?>
	</tbody>
</table>
			
		</div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="removeOrderModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Purchase</h4>
      </div>
      <div class="modal-body">

      	<div class="removeOrderMessages"></div>

        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeOrderBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove order-->
</div>
</div>
<?php include_once "includes/footer.php";?>
