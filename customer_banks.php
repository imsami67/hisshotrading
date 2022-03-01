 <?php include_once "includes/header.php" ?>

<?php include_once "inc/code.php"; ?>

<!-- start page content -->


               <div class="page-content-wrapper">

                <div class="page-content">

                    <div class="page-bar">

                        <div class="page-title-breadcrumb">

                            <div class=" pull-left">

                                <div class="page-title">Customer Bank</div>

                            </div>

                            <ol class="breadcrumb page-breadcrumb pull-right">

                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>

                                </li>

                                <li class="active">Customer Bank</li>

                            </ol>

                        </div>

                    </div>

                    

				    

 

				   

                    <div class="col-sm-12">

		<div class="panel">

	<div class="panel-heading panel-heading-red" align="center"><h4>Create Customer Bank</h4></div>

	<div class="panel-body">

		<form action="php_action/custom_action.php" method="POST"  id="add_customer_data">
	<input type="hidden" value="<?=$_REQUEST['id']?>" name="add_customer_id" id="add_customer_id">
	<input type="hidden" class="form-control" id="customer_type_check" name="customer_type_check" value="bank">
	<input type="hidden" class="form-control" value="<?=@$fetchBankData['customer_bank_id']?>" id="customer_bank_id" name="customer_bank_id">
		

        <div class="msg"></div>

          	<div class="row">

          		<div class="col-sm-6">

	          	    <div class="form-group">

	          	    	<label for="">Beneficiary Name</label>

	          	        <input type="text" class="form-control" id="bank_account_name" name="bank_account_name" value="<?=@$fetchBankData['bank_account_name']?>">

	          	    </div>
	          	   

	          	    <div class="form-group">

	          	    	<label for="">Account No</label>

	          	    	<div class="row">

	          	    		<div class="col-sm-6">

			          	        <input type="text" class="form-control" id="bank_account_no" name="bank_account_no" value="<?=@$fetchBankData['bank_account_no']?>">

	          	    		</div>

	          	    		<div class="col-sm-6">

			          	        <input type="text" class="form-control" id="swift_code" name="swift_code" placeholder="Swift Code" value="<?=@$fetchBankData['swift_code']?>">

	          	    		</div>

	          	    	</div>

					

	          	    </div>


	          	    <div class="form-group">

	          	    	<label for="">Name of Bank</label>

	          	        <input type="text" class="form-control" id="bank_name" name="bank_name" value="<?=@$fetchBankData['bank_name']?>">

	          	    </div>
	          	      <div class="form-group">

	          	    	<label for="">Bank Phone no.</label>

	          	        <input type="text" class="form-control" id="bank_phone" name="bank_phone" value="<?=@$fetchBankData['bank_phone']?>">

	          	    </div>

					<div class="form-group">

						<label for="">Bank Memo</label>

						<input type="text" name="bank_memo" id="bank_memo" class="form-control" value="<?=@$fetchBankData['bank_memo']?>">

					</div><!-- form group -->

          		</div>

          		<div class="col-sm-6">

	          	    <div class="form-group">

	          	    	<label for="">Branch Name</label>

	          	        <input type="text" class="form-control" id="branch_name" name="branch_name" value="<?=@$fetchBankData['branch_name']?>">

	          	    </div>


	          	    <div class="form-group">

	          	    	<label for="">Branch Address</label>

	          	        <input type="text" class="form-control" id="branch_address" name="branch_address" value="<?=@$fetchBankData['branch_address']?>">

	          	    </div>
	          	    

	          	    <div class="form-group">

	          	    	<label for="">Acceptable Currency</label>

	          	    	<?= countryCurrency("bank_currency","bank_currency","form-control",@$fetchBankData['bank_currency']); ?>

	          	    

	          	    </div>
 <div class="form-group">

	          	    	<label for="">Bank Fax no.</label>

	          	        <input type="text" class="form-control" id="bank_fax_no" name="bank_fax_no" value="<?=@$fetchBankData['bank_fax_no']?>">

	          	    </div>
	          	    <div class="form-group">

	          	    	<label for="">Bank Status</label>	

						<select class="form-control" id="bank_status" name="bank_status">

							<option value="">~~SElECT~~</option>

							<option <?=(@$fetchBankData['bank_status']==1)?"selected":""?> value="1">Active</option>

							<option <?=(@$fetchBankData['branch_address']==2)?"selected":""?> value="2">Deactive</option>

						</select>

	          	    </div>

          		</div>

          	</div>
	 <?php if (@$userPrivileges['nav_add']==1 || $fetchedUserRole=="admin"): ?>

			<button type="submit" class="btn btn-primary" id="saveData3">Submit</button>
<?php endif; ?>
</form>
<script type="text/javascript">
	
</script>
		

			<br><br>

		</div>

	</div>

</div>

	<div class="panel">

		<div class="panel-heading bg-orange" align="center">

			<h5><span class="glyphicon glyphicon-user"></span> Customer Bank Management system</h5>

		</div>

	
		<div class="panel-body"><table class="table"  class="table-responsive data-table" id="customer_banks_tb">

	<thead>

		<tr class="">

			

			<th>Bank Name</th>

			<th>Account Name</th>

			<th>Branch Name</th>

			<th>Swift Code</th>

			<th>Phone</th>

			<th>Address</th>

			<th>Currency</th>
			<th>Action</th>

	</thead>

	<tbody>
		<?php $getBanks=get($dbc,"customer_banks WHERE bank_status=1");
			while ($banks=mysqli_fetch_assoc($getBanks)):
				# code...
		
		 ?>
		 <tr>
		 	<td><?=$banks['bank_name']?></td>
		 	<td><?=$banks['bank_account_name']?></td>
		 	<td><?=$banks['branch_name']?></td>
		 	<td><?=$banks['swift_code']?></td>
		 	<td>Phone:<?=$banks['bank_phone']?><br>Fax:<?=$banks['bank_fax_no']?></td>
		 	<td><?=$banks['branch_address']?></td>
		 	<td><?=$banks['bank_currency']?></td>
		 	<td>
		 		 <?php if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): ?>
		 		<a href="customer_banks.php?edit_customer_bank=<?=$banks['customer_bank_id']?>" class="btn-sm btn-success">Edit</a> 
		 				<?php endif ?>
		 	</td>
		 </tr>
		<?php endwhile; ?>
	</tbody>

</table></div>

				

	</div> 

</div>

</div>



<?php include_once 'includes/footer.php'; ?>