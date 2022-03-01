 <?php 
include_once "includes/header.php";
include_once "inc/code.php";
$payment=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT  payment.*,customers.* FROM payment INNER JOIN customers ON customers.customer_id=payment.customer_name WHERE payment.payment_id='".$_REQUEST['id']."' "));
//$record=fetchRecord($dbc,"customers","customer_id",$payment['receving_bank']);

?>
<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Refund Request</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Refund Request</li>

                            </ol>
                        </div>
                    </div>

			<div class="col-sm-12">
				<div class="card">
					<?php 	//echo $_SESSION['userId']; ?>
										<div class="card-body">
						<form action="php_action/custom_action.php" method="POST" role="form" id="refund_req_fm">
							<input type="text" class="form-control d-none"  name="action" value="refund_req">
							<input type="text" class="form-control d-none" id="request_id" name="request_id" value=""> 
							<input type="text" class="form-control d-none" id="payment_id" name="payment_id" value="<?=@$payment['payment_id']?>"> 

								<div class="msg"></div>
								<div class="form-group row">
									<div class="col-sm-6">

										<label>Select Customer</label>
										<select class="form-control" name="customer_id" onchange="getbalance(this.value,'balance_amount')">
												<option value="">~~SELECT~~</option>

							<?php $q = get($dbc,"customers WHERE customer_role= 'customer' AND customer_active = 1");

							while ($r = mysqli_fetch_assoc($q)):?>

								<option <?=($payment['customer_id']==$r['customer_id'])?"selected":""?> value="<?=$r['customer_id']?>"><?=$r['customer_id']?>-<?=$r['customer_name']?> (<?=$r['customer_contact_person']?>-<?=$r['customer_country']?>)</option>


							<?php endwhile ?>
										</select>
									</div>
									<div class="col-sm-6">
										<label>Bank Name</label>
										<input type="text" name="bank_name" value="<?=$payment['sender_bank_name']?>" required class="form-control">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-6">
										<label>Branch Name</label>
										<input type="text" name="branch_name" id="branch_name" required class="form-control" value="<?=$payment['sender_branch_name']?>">
									</div>
									<div class="col-sm-6">
										<label>Branch City</label>
										<input type="text" name="branch_city" id="branch_city" required class="form-control">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-6">
										<label>Title of Account</label>
										<input type="text" name="title_of_account" id="title_of_account" required class="form-control" value="<?=$payment['sender_account_title']?>">
									</div>
									<div class="col-sm-6">
										<label>Bank Account Number</label>
										<input type="text" name="bank_account_no" id="bank_account_no" required class="form-control" value="<?=$payment['sender_account']?>">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-6">
										<label>Swift Code</label>
										<input type="text" name="swift_code" id="swift_code" required class="form-control">
									</div>
									<div class="col-sm-4">
										<label>Amount</label>
										<input type="hidden" value="<?=@getcustomerBlance($dbc,$payment['customer_id']);?>" name="balance_amount" id="balance_amount"  class="form-control">
										<input type="number" min="0" name="requested_amount" id="requested_amount"  required class="form-control">
											<span >Balance :<b id="balance_amount_text"><?=@getcustomerBlance($dbc,$payment['customer_id']);?></b></span>
									</div>
									<div  class="col-sm-2">
										<label>Currency</label>
										<?= countryCurrency('requested_amount_currency','requested_amount_currency','form-control','') ?>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-6">
											<label>Account Holder Address</label>
											<textarea name="account_holder_address" id="account_holder_address" class="form-control"></textarea>
									</div>
								
										<div class="col-sm-6">
											<label>Bank Address</label>
											<textarea name="bank_address" id="bank_address" class="form-control"></textarea>
										</div>	
								</div>
								<div class="form-group row">
									<div class="col-sm-6">
											<label>Reason of Refunt</label>
											<textarea name="refund_reason" id="refund_reason" class="form-control"></textarea>
									</div>
								
										<div class="col-sm-6">
											<label>Note</label>
											<textarea name="note" id="bank_address" class="form-control"></textarea>
										</div>	
								</div>	
								
									<div class="row">
										<div class="col-sm-6">
										<label>Select Priority</label>
										<select class="form-control" name="priority_status">
											<option  value="high">Normal</option>
											<option  value="high">High</option>
										</select>
											</div>
										<div  class="col-sm-6">
											<br>
											 <?php if (@$userPrivileges['nav_add']==1 || $fetchedUserRole=="admin"): ?>
											<button type="submit" class="btn btn-primary" id="refund_req_btn">Save</button>
										<?php endif; ?>
										</div>
									</div>


								
							</form>
							</div>
						</div>
					</div>

	</div></div>
<?php
include_once "includes/footer.php";
?>