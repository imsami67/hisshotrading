<?php 
include_once "includes/header.php";
include_once "inc/code.php";
?>

<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
<div class="panel">
	<div class="panel-heading panel-heading-blue" align="center"><h5>Create voucher</h5></div>
	<div class="panel-body">
		<?php getMessage(@$msg,@$sts); ?>
		<?php if(!empty($_REQUEST['print_voucher'])): ?>
			<hr>
			<a target="_blank" href="print_voucher.php?print_voucher=<?=$_REQUEST['print_voucher']?>" class="btn btn-primary btn-block">Print Last Voucher</a>
			<hr>
		<?php endif; ?>
		<form class="form-horizontal" method="POST" action="" id="">
			
			  <div class="form-group">
			  	<div class="row">
			  		
			    <label for="orderDate" class="col-sm-2 control-label">Order Date</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control datepicker" id="orderDate" name="voucher_date" 
			      value="<?php echo date("Y/m/d/l")?>" style="z-index: 1000"/>
			    </div>
			  	</div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			  	<div class="row">
			  		
			    <label for="clientName" class="col-sm-2 control-label">Select Account</label>
			    <div class="col-sm-10">
			    			<div class="input-group">
			    				<select class="form-control" id="clientName" name="customer_id" autofocus="true" required style="z-index: 1">
						      	<option value="">~~SELECT~~</option>
						      	<?php 
						      	$sql = "SELECT * FROM customers WHERE customer_active = 1";

										$result = $connect->query($sql);

										while($row = $result->fetch_array()) {
											echo "<option value='".$row[0]."'>".$row[1]."</option>";
										} // while
										
						      	?>
						      </select>	
						      <span class="input-group-addon">
						      	Balance: 
						      		<span class="badge" id="customer_balance">
						      			0
						      		</span>
						      	</span>
			    			</div><!-- input group -->
			     <!--  <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Client Name" autocomplete="off" value="_"  autofocus="true" />
 -->
			  	</div>
			    </div>
			     
			  </div> <!--/form-group-->
			  <div class="form-group">
			  	<div class="row">
			  		
			    <label for="orderDate" class="col-sm-2 control-label">Debit</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="debit" name="debit" placeholder="Debit" autocomplete="off" value="0" />

			    </div>
			    <label for="orderDate" class="col-sm-2 control-label">Credit</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="credit" name="credit" placeholder="Debit" autocomplete="off" value="0" />

			    </div>
			  	</div>

			  </div> <!--/form-group-->	
			  <div class="form-group">
			  	<div class="row">
			    <label for="clientContact" class="col-sm-2 control-label">Nuration</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="nuration" name="nuration" placeholder="Enter Nuration" autocomplete="off" value="_" />
			    </div>
			  	</div>
			  </div> <!--/form-group-->			  
			  <button type="submit" id="voucher" name="add_voucher" data-loading-text="Loading..." class="btn btn-info pull pull-right"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
			</form>
			<br>
	</div>
</div>
</div>
</div>
<?php
include_once "includes/footer.php";
?>

 <script>
  	$(document).on('change','#clientName',function(){
  		var customer_id = $(this).val();
  		$.ajax({
  			url:'ajax/getbalance.php',
  			type:'get',
  			dataType:'text',
  			data:{customer_id:customer_id},
  			success:function(response){
  				$("#customer_balance").html(response);
  			}
  		});
  	});
  	$(document).on('input','#debit',function(){
  		var debit = $("#debit").val();
  		if (Number(debit)>0) {
  			$("#credit").attr('readonly',true);
  			$("#credit").val('0');
  		}else{
  			$("#credit").attr('readonly',false);
  			$("#credit").val('0');
  		}
  	});
  		$(document).on('input','#credit',function(){
  		var debit = $("#credit").val();
  		if (Number(debit)>0) {
  			$("#debit").attr('readonly',true);
  			$("#debit").val('0');
  		}else{
  			$("#debit").attr('readonly',false);
  			$("#debit").val('0');
  		}
  	});

  </script>
  	
