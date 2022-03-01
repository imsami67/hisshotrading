<?php 
include_once "includes/header.php";
include_once "inc/code.php";
?>
<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
<div class="panel">
	<div class="panel-heading panel-heading-red" align="center"><h4>Enter Expenses</h4></div>
	<div class="panel-body">
		<?php @getMessage(@$msg,@$sts); ?>
		<form class="form-horizontal" method="POST" action="" id="">
			
			  <div class="form-group row">
			    <label for="orderDate" class="col-sm-2 control-label">Expenses Date</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control datepicker" id="expense_date" name="expense_date" 
			      value="<?php echo date("Y/m/d/l")?>"     />
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group row">
			    <label for="clientName" class="col-sm-2 control-label">Select Expense Category</label>
			    <div class="col-sm-10">
			    			
			    				<select class="form-control col-sm-10" id="expense_category" name="expense_category" autofocus="true" required>
						      	
						      	<?php 
						      	$sql = "SELECT * FROM  budget_category";

										$result = $connect->query($sql);

										while($row = $result->fetch_array()) {
											echo "<option value='".$row[1]."'>".$row[1]."</option>";
										} // while
										
						      	?>
						      </select>	
						      
						      	
			    			
			    </div>
			     
			  </div> <!--/form-group-->
			  
			  <div class="form-group row">
			    <label for="clientContact" class="col-sm-2 control-label">Amount</label>
			    <div class="col-sm-10">
			      <input type="number" class="form-control" id="expense_amount" name="expense_amount" placeholder="Enter Expenses" autocomplete="off"  />
			    </div>
			  </div> <!--/form-group-->			 
			  <button type="submit" id="add_expenses" name="add_expenses" data-loading-text="Loading..." class="btn btn-info pull pull-right"><i class="glyphicon glyphicon-ok-sign"></i> Enter Expenses</button>
			  <br><br> 
			</form>
	</div>
</div>
</div>
</div>

<?php
include_once "includes/footer.php";
?>

 
  	
