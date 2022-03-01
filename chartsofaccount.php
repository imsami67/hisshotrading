<?php 
include_once "includes/header.php";
include_once "inc/code.php";

?>
<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content row">
<div class="col-sm-6">
		<div class="panel">
	<div class="panel-heading panel-heading-purple" align="center"><h4>Create Charts Of Account</h4></div>
	<div class="panel-body">
<?php getMessage(@$msg,@$sts); ?>
			<table class="table table-responsive" align="center" cellpadding="5" cellspacing="5">
			<tr>	
				<th>Budget Category Date</th>
				<th>Budget Category Name</th>
				<th>Budget Category Type</th>
				<th>Action</th>
			</tr>
			<?php 
				
			
			
			$sql = "SELECT * FROM budget_category  ";
	
	$result = mysqli_query($dbc, $sql);
	
	if ( mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_array($result)){
			?>
			<tr>
				<td><?=$row['budget_category_name'];?></td>
				<td><?=$row['budget_category_type'];?></td>
				<td><?=date('D, d-M-Y',strtotime($row['budget_category_add_date'])) ;?>
					

				</td>
				<td><a href="chartsofaccount.php?budget_category_del_id=<?=$row['budget_category_id']?>" class="text-danger"><span class="fa fa-remove"></span></a> | 
					<a href="chartsofaccount.php?budget_category_edit_id=<?=$row['budget_category_id']?>" class="text-success"><span class="fa fa-edit"></span></a></td>
				
			</tr>
		<?php 
}
	} 
		?>
			
			
			</table>
		
	</div>
</div>

</div>
	<div class="col-sm-6">
		<div class="panel">
	<div class="panel-heading panel-heading-green" align="center"><h4>Create Charts Of Account</h4></div>
	<div class="panel-body">
		<?php getMessage(@$msg,@$sts); ?>
		<form class="form-horizontal" method="POST" action="" id="">
			  <div class="form-group row">
			    <label for="clientContact" class="col-sm-5 control-label">Budget Category Name</label>
			    <div class="col-sm-7">
			      <input type="text" class="form-control" id="budget_category_name" name="budget_category_name" placeholder="Enter Budget Category Name" autocomplete="off"  required  value="<?=@$fetchBudgetCategory['budget_category_name']?>" />
			    </div>
			  </div> <!--/form-group-->		
			  <div class="form-group row">
			    <label for="clientContact" class="col-sm-5 control-label">Budget Category Type</label>
			    <div class="col-sm-7">
			      <select type="text" class="form-control" id="budget_category_type" name="budget_category_type" required  >
			      		<?php getSelectTag($fetchBudgetCategory['budget_category_type'],"~~SELECT~~"); ?>
			      		<option value="income">Income</option>
			      		<option value="expense">Expence</option>
			      </select>
			    </div>
			  </div> <!--/form-group-->			  
			 <?=$budget_category_button;?>
			</form>
			<br><br>
		</div>
	</div>
</div>
	</div></div>
<?php
include_once "includes/footer.php";
?>