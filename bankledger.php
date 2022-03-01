<?php include_once "includes/header.php";



?>



<form action="" method="post" accept-charset="utf-8">



	



	



<!-- start page content -->



            <div class="page-content-wrapper">



                <div class="page-content">



<div class="panel">



	<div class="panel-heading panel-heading-purple">Bank Ledger</div>



	<div class="panel-body">



		<form action="" method="post" class="form-inline print_hide" >



			<div class="row hidden_print ">



			<div class="form-group col-sm-4 print_hide">



				<label for="">Bank Account</label>



				<select class="form-control" id="ledger_customer_id" name="customer_id" autofocus="true">



		      	<option value="">~~SELECT~~</option>



		      	<?php 



		      	$sql = "SELECT * FROM customers WHERE customer_active = 1 AND customer_role='bank'";



						$result = $connect->query($sql);







						while($row = $result->fetch_array()) {



							echo "<option value='".$row[0]."'>".$row['customer_company']."</option>";



						} // while



						



		      	?>



		      </select>	



			</div><!-- group -->

	<div class="form-group col-sm-3 ">



				<label for="">From Date</label>



				<input type="date" name="from_date" class="form-control">



                                             

                                            

			</div>
	<div class="form-group col-sm-3 ">



				<label for="">To Date</label>



				<input type="date" name="to_date" class="form-control">



                                             

                                            

			</div>

			



			<div class="form-group col-sm-2 print_hide">



				<label for="">Click To Search</label><br />



				<button class="btn btn-success" name="genealledger" type="submit"><span class="fa fa-search">_</span>Search</button>



			</div><!-- group -->



			</div>



		</form>



	</div>



</form>



<button class="btn btn-info print_hide pull pull-right" onclick="window.print();" style="margin-right: 15px;"><span class="fa fa-print"></span> Print Report</button>



<br><br>



	<?php 



		if (isset($_POST['genealledger'])) :



			$customer = $_POST['customer_id'];

			



?>



	<table width="100%" border="2px" align="center" class="table table-hover ">



		



			<?php



			//echo  DateFormat($f_date , '%Y-%m-%d');



			 ?>



			 <center>



			 <?php 



			 $fetchCustomer = fetchRecord($dbc,"customers","customer_id",$customer);



			//$fetchCustomer = fetchRecord($dbc ,"SELECT * FROM customer WHERE customer_id =  '$customer' ");



			 ?>



			 <h4>Client Name: <label class="label label-success"><?= $fetchCustomer['customer_company'] ;?></label></h4>



			 </center><?php 

			 	if(!empty($customer)){

			 	

					 $invoice = fetchRecord($dbc,"invoice","invoice_bank",$customer);





				 ?>




		<tbody>




			<?php 	 ?>

				<tr>



				<th>Transaction #</th>



				<th>Date</th>

				<th>Trans From</th>

				<th>Payment ID</th>

				<th>Exchnage rate</th>

				<th>Remarks</th>



				<th>Debit</th>



				<th>Credit</th>



				<th>Balance</th>



				<!-- <th>Test</th> -->



			</tr>



<?php

				

		if (!empty($_REQUEST['from_date']) AND !empty($_REQUEST['to_date'])) {
			$sql = "SELECT * FROM transactions WHERE  bank_id='$customer' AND transaction_add_date BETWEEN '".$_REQUEST['from_date']."' AND '".$_REQUEST['to_date']."' ";
		}else if (!empty($_REQUEST['from_date']) AND empty($_REQUEST['to_date'])) {
			$sql = "SELECT * FROM transactions WHERE  bank_id='$customer' AND transaction_add_date = '".$_REQUEST['from_date']."' ";
		}else{
		
			$sql = "SELECT * FROM transactions WHERE  bank_id='$customer' ";

		}



			//$sql = "SELECT * FROM transactions WHERE customer_id = '$customer_id' AND  ";



	



	$result = mysqli_query($dbc, $sql);



	$temp=0;



	if ( mysqli_num_rows($result) > 0) :



		while($row = mysqli_fetch_array($result)):



			@$total_debit += $row['debit'];



			@$total_credit+= $row['credit'];



			@$remaing_balance = $row['balance'];





			if($row['voucher_id'] != ''){

				$vocuher = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM payment WHERE payment_id = '$row[voucher_id]'"));

			}else{

				$vocuher = 0;

			}

			?>





			<tr>



				<td><?=$row['transaction_id']?></td>



				<td><?=date('D, d-M-Y',strtotime($row['transaction_add_date']))?></td>

				<td><?=$row['transaction_from']?></td>

				<td><?=@$vocuher['vehicle_info']?></td>

				<td><?=@$vocuher['exchange_rate']?>  <?=@$vocuher['currency']?></td>



				<td><?=$row['transaction_remarks']?></td>



				<td><?=$row['debit']?></td>



				<td><?=$row['credit']?></td>



				<!-- <td><?=($row['balance']<0)?"<span class='label label-danger'>{$row['balance']}</span>":"<span class='label label-success'>{$row['balance']}</span>"?></td> -->



				<td class="bg-danger"><?=((int)$row['credit']-(int)$row['debit'])+(int)$temp?></td>







			</tr>



			<?php



				$remaing_balance = (@(int)$row['credit']-@(int)$row['debit'])+$temp;



			 $temp=(@(int)$row['credit']-@(int)$row['debit'])+$temp; ?>



		<?php endwhile; ?>



		<tr >



				<td> </td>



				<td> </td>



				<td> </td>

				<td> </td>

				<td> </td>

				<td> </td>



				<td><?= $total_debit ?></td>



				<td><?= $total_credit ?></td>

				<td> </td>



			</tr>



			<tr >



				<td> Total Remaining </td>



				<td> </td>



				<td> </td>



				<td></td>



				<td></td>

				<td> </td>

				<td> </td>



				<td colspan="2"><h3><?=($remaing_balance<0)?"<span class='label label-danger'>{$remaing_balance}</span>":"<span class='label label-success'>{$remaing_balance}</span>"?></h3></td>



			</tr>



		</tbody>



	



		<?php endif;	

	}else{

							

					} ?>

<hr/>



<tfoot>





<tr>



				<th>Balance Info</th>



				<th>Date</th>

				<th>Trans From</th>

				<th>Payment ID</th>

				<th>Exchnage rate</th>

				<th>Remarks</th>



				



				<th colspan="3">Balance</th>



			



			</tr>



	<?php

	$nx = mysqli_query($dbc,"SELECT * FROM transactions WHERE customer_id = '$_POST[customer_id]' AND advance != '0'");

	//print_r($nx);

		

	//$adv = mysqli_fetch_assoc($nx);

		while($ad = mysqli_fetch_assoc($nx)):

	$voucherNow = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM payment WHERE payment_id = '$ad[voucher_id]'"));

	?>

	<tr>

		<td >Advance Payment </td>

		<td><?=date('D, d-M-Y',strtotime($ad['transaction_add_date']))?></td>

		<td><?=$ad['transaction_from']?></td>

		<td><?=$voucherNow['vehicle_info']?></td>

		<td><?=$voucherNow['exchange_rate']?></td>

		<td><?=$ad['transaction_remarks']?></td>

		<td colspan="3">

			<h3><label class="label label-success"><?=$ad['advance']?>

				</label></h3>

			</td>

	</tr>

	<?php

endwhile;

	?>

</tfoot>





</table>

	<?php endif; ?>



			











</div><!--panel end-->



</div>



</div>







<?php include_once "includes/footer.php";?>







<script>



	$( function() {



		var dateFormat = "yy-mm-dd";



			from = $( "#from" )



				.datepicker({



					changeMonth: true,



					numberOfMonths: 1,



					dateFormat : "yy-mm-dd",



				})



				.on( "change", function() {



					to.datepicker( "option", "minDate", getDate( this ) );



				}),



			to = $( "#to" ).datepicker({



				changeMonth: true,



				numberOfMonths: 1,



				dateFormat : "yy-mm-dd",



			})



			.on( "change", function() {



				from.datepicker( "option", "maxDate", getDate( this ) );



			});







		function getDate( element ) {



			var date;



			try {



				date = $.datepicker.parseDate( dateFormat, element.value );



			} catch( error ) {



				date = null;



			}







			return date;



		}



	} );



	</script>