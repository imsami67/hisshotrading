

<form action="php_action/custom_action.php" method="POST" role="form" id="personeForm">

        <div class="msg"></div>

	<?php 

          @$type = $_GET['type'];

          if ($type == 'bank') {

          	$text = "Bank";

          	?>

          	<div class="row">

          		<div class="col-sm-6">

	          	    <div class="form-group">

	          	    	<label for="">Beneficiary Name</label>

	          	        <input type="text" class="form-control" id="customer_email" name="customer_email">

	          	    </div>

	          	    <div class="form-group">

	          	    	<label for="">Account No</label>

	          	    	<div class="row">

	          	    		<div class="col-sm-6">

			          	        <input type="text" class="form-control" id="customer_name" name="customer_name">

	          	    		</div>

	          	    		<div class="col-sm-6">

			          	        <input type="text" class="form-control" id="customer_contact_person" name="customer_contact_person" placeholder="Swift Code">

	          	    		</div>

	          	    	</div>

						<input type="text" name="customer_id" id="customer_id" class="d-none">

	          	    </div>

	          	    <div class="form-group">

	          	    	<label for="">Name of Bank</label>

	          	        <input type="text" class="form-control" id="customer_company" name="customer_company">

	          	    </div>

					<div class="form-group">

						<label for="">Bank Memo</label>

						<input type="text" name="customer_email2" id="customer_email2" class="form-control">

					</div><!-- form group -->

          		</div>

          		<div class="col-sm-6">

	          	    <div class="form-group">

	          	    	<label for="">Branch Name</label>

	          	        <input type="text" class="form-control" id="customer_city" name="customer_city">

	          	    </div>

	          	    <div class="form-group">

	          	    	<label for="">Branch Address</label>

	          	        <input type="text" class="form-control" id="customer_address" name="customer_address">

	          	    </div>

	          	    <div class="form-group">

	          	    	<label for="">Acceptable Currency</label>

	          	    	<?= countryCurrency("customer_country","customer_country","form-control"); ?>

	          	        <input type="text" class="d-none" value="bank" id="customer_role" name="customer_role">

	          	    </div>

	          	    <div class="form-group">

	          	    	<label for="">Bank Status</label>	

						<select class="form-control" id="customer_active" name="customer_active">

							<option value="">~~SElECT~~</option>

							<option value="1">Active</option>

							<option value="2">Deactive</option>

						</select>

	          	    </div>

          		</div>

          	</div>

			<button type="submit" class="btn btn-primary" id="saveData3">Submit</button>

          	<?php 

          	}?>


</form>
