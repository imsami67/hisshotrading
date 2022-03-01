 <?php 
include_once "includes/header.php";
include_once "inc/code.php";
$refund=fetchRecord($dbc,"refund_requests",'request_id',base64_decode($_REQUEST['id']));
$customer=fetchRecord($dbc, "customers", "customer_id", $refund['customer_id']);
$users=fetchRecord($dbc, "users", "user_id", $refund['user_id']);

?>
<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Approve Refund Request</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Approve Refund Request</li>

                            </ol>
                        </div>
                    </div>

			<div class="col-sm-12">
				<div class="card">
		
					<div class="card-body">
							<table class="table " style="text-align: left!important;">
								<tr>
									<th>Customer</th><td><?=$customer['customer_name']?></td>
									<th>Refund Request By</th><td><?=$users['username']?></td>
								</tr>
								<tr>
									<th colspan="4">
										Customer Details
									</th>
								</tr>
								<tr>
									<th>Bank Name</th><td><?=$refund['bank_name']?></td>
									<th>Branch Name</th><td><?=$refund['branch_name']?></td>
								</tr>
								<tr>
									<th>Bank city</th><td><?=$refund['branch_city']?></td>
									<th>Title of Account</th><td><?=$refund['title_of_account']?></td>
								</tr>
								<tr>
									<th>Bank Account Number</th><td><?=$refund['bank_account_no']?></td>
									<th>Swift Code</th><td><?=$refund['swift_code']?></td>
								</tr>
								<tr>
									<th>Bank Address</th><td><?=$refund['bank_address']?></td>
									<th>Account Holder Address</th><td><?=$refund['account_holder_address']?></td>
								</tr>
								<tr>
									<th>Reason of Refund</th><td><?=$refund['refund_reason']?></td>
									<th>Note</th><td><?=$refund['note']?></td>
								</tr>
								<tr>
									<th>Balance Remaining</th><td><?=getcustomerBlance($dbc,$refund['customer_id']);?></td>
								</tr>
							</table>
							<?php if ($refund['request_status']=="pending"): ?>
						<div class="row mb-5">
							<div class="col-sm-3 offset-sm-9">
								<a href="php_action/custom_action.php?action=rejectfund&id=<?=base64_encode($refund['request_id'])?>" class="btn btn-danger"  title="Reject">Reject</a> 
								<button class="btn btn-success" type="button" id="approved_request_btn">Approved</button>
							</div>
						</div>
						<?php endif ?>
						<form action="php_action/custom_action.php" method="POST" role="form" id="refund_req_app_fm" enctype="multipart/form-data" >
							<input type="text" class="form-control d-none"  name="action" value="refund_req_app">
							<input type="text" class="form-control d-none" id="request_id" name="request_id" value="<?=base64_decode($_REQUEST['id'])?>"> 
							<input type="text" class="form-control d-none" id="customer_id" name="customer_id" value="<?=$refund['customer_id']?>"> 

								<div class="msg"></div>
								<div class="form-group row">
									<div class="col-sm-6">
										<label>Select Bank</label>
										<select class="form-control" name="bank_id">
												<option value="">~~SELECT~~</option>

							<?php $q = get($dbc,"customers WHERE customer_role= 'bank' AND customer_active = 1");

							while ($r = mysqli_fetch_assoc($q)):?>

								<option <?=@($refund['admin_bank']==$r['customer_id'])?"selected":""?> value="<?=$r['customer_id']?>"><?=$r['customer_company']?></option>


							<?php endwhile ?>
										</select>
									</div>
									<div class="col-sm-6">
										<label>Transaction ID</label>
										<input type="text" name="transaction_id" value="<?=@!empty($refund['transaction_id'])?$refund['transaction_id']:""?>" class="form-control">
									</div>
									
								</div>
								<div class="row form-group">
									<div class="col-sm-6">
										<label>Amount</label>
										<input type="text" name="receiving_amount" value="<?=@!empty($refund['receiving_amount'])?$refund['receiving_amount']:""?>" class="form-control">
									</div>
									<div class="col-sm-6">
										<label>Currency</label>
										
										<?= countryCurrency('receiving_amount_currency','receiving_amount_currency','form-control',@$refund['receiving_amount_currency']) ?>
									</div>
									
								</div>
								<div class="row form-group">
									<div class="col-sm-6">
       	<label>Title</label>
       	<input type="text" name="add_document_title" class="form-control" required>
       
       </div>
									<div class="col-sm-4">
       	<label>File</label>
       	<input type="file" name="new_document_file" id="new_document_file" class="form-control" required>
       </div>
       <div class="col-sm-2">
       	<?php 
$reqest_docq=mysqli_query($dbc,"SELECT * FROM  refund_docs WHERE request_id='".$refund['request_id']."' ");
       	if (mysqli_num_rows($reqest_docq)>0):
					$reqest_doc=mysqli_fetch_assoc($reqest_docq);
				 ?>
					<a target="_blank" href="<?=$reqest_doc['document_file']?>" class="btn btn-info mt-5 btn-sm" >View Docs</a>
				<?php endif ?>
       </div>
									
      </div>

								
								<button type="submit" class="btn btn-primary" id="refund_req_app_btn">Save</button>
								<a href="print_refund.php?request_id=<?=$_REQUEST['id']?>" class="btn btn-primary" >Print</a>
							</form>

							</div>
						</div>
					</div>

	</div></div>
<?php
include_once "includes/footer.php";
?>