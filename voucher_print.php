<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Invoice</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
		<style >
			*{
				box-sizing: border-box;
			}
			@media print{

        .div{
        	
        	background-color:  #21618C !important;
        
        
			}
			.div span{
        	    color: rgb(252, 252, 252 ) !important;
       }
       .div p{
        	    color: rgb(252, 252, 252 ) !important;
       }
       .column1{
             	background-color: #D6EAF8 !important;
             }
            .table thead{
             background-color:  #21618C !important;
            } 
        }
       .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th ,.b-none {
  border-top: none;
}
.b-1{border: 1px solid black;
}

.row1{
	background-color: #D6EAF8 !important;
	height: auto;
} 

        .column1 {
  float: left;
  width: 50%;
   height: auto;
   padding: 20px;
}
.row1:after {
  content: "";
  display: table;
  clear: both;
}


@media screen and (max-width: 600px) {
  .column1 {
    width: 100%;
  }
}


.column2 {
  float: left;
  width: 70%;
 
  height: auto; /* Should be removed. Only for demonstration */
}
.column3 {
  float: left;
  width: 30%;
  padding: 10px;
  margin-top:50px; 
  height:auto; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row2:after {
  content: "";
  display: table;
  clear: both;
}
.border_none{
  border-top: none;
}

/* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .column {
    width: 100%;
  }
}
</style>

</head>
	<body>
    <?php 
      require_once 'php_action/db_connect.php';
      require_once 'inc/functions.php';
       $voucher_id = $_GET['voucher_id'];
	    $payment=fetchRecord($dbc,"payment","payment_id",$voucher_id);
	    $customer=fetchRecord($dbc,"customers","customer_id",$payment['customer_name']);

      	

        # code...
      
      
      // "<pre>".print_r($fetchInvoice)."</pre>";
    ?>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h1 style="color: red;font-weight: bold;">NEXCO JAPAN LTD CO</h1>
					<p style="font-weight: bold;float: none;">Car for everyone</p>
					<h4 style="text-align: right;font-weight: bold;">
					<center style="width: 100%;padding:12px;background-color:  #21618C;color: white; " class="div">
       
            <h4>PAYMENT VOUCHER</h4>     
          </center>
				</div>
			</div>


         <div class="row">
         	<div class="col-12 table-responsive">
   <table class="table table-borderedless mx-auto text-center table-sm mt-5" style="color:black;width:100%; ">
   	<tbody>
   	   <tr>
   	   	<th>Bank : </th><td colspan="2"><?=$customer['customer_company']?></td>
   			<th>Account : </th><td colspan="2"><?=$payment['receving_account']?></td>
   	   </tr>
   	   	<tr>
   	   		
   			<th>Date : </th><td><?=date('d-M-Y',strtotime($payment['payment_time']))?></td>
   			<th>Vocher No : </th><td><?=$payment['payment_id']?></td>
   			<th>Customer : </th><td><?=$customer['customer_name']?></td>
   		</tr>
   		<tr>
   			<th>Sender Name : </th><td><?=$payment['sender_name']?></td>
   			<th>Sent Country : </th><td><?=$payment['send_country']?></td>
   			<th>Payment Type : </th><td><?=$payment['currency']?></td>
   		</tr>
   		<tr>
   			<th> Amount : </th><td><?=$payment['total_amount_recevied']?></td>
   			<th>Tax : </th><td><?=$payment['bank_charges']?></td>
   			<th>Net Amount : </th><td><?=$payment['total_amount_recevied']-$payment['bank_charges']?></?></td>
   			   		</tr>
   		<tr>
   			<th>Currency : </th><td><?=$payment['currency']?></td>
   			<th>Exchange Rate : </th><td><?=$payment['exchange_rate']?></td>
   			<th> Receiving : </th><td><?=$payment['receving_date']?></td>
   		</tr>
   		<tr>
   			<th >Notes</th><td colspan="2"><?=$payment['voucher_notes']?></td>
   			
   		</tr>

   	</tbody>
   </table>
  <table class="table table-borderedless mx-auto text-center table-sm mt-5" style="color:black;width:100%; ">
  <thead  style="width:100%;" >
    <tr>
 		<th>Invoice Id</th>
 		<th>Vehicle Info</th>
      <th >Sold Price</th>
       <th >Received Amount</th>
       <th>Remaining Amount</th>

    </tr>
  </thead>
  <tbody>
    <?php //$transactionGet=getWhere($dbc,"transactions","voucher_id",$voucher_id);  $balance=0;
     $transactionGet=mysqli_query($dbc,"SELECT SUM(credit-debit) as nowbalance ,invoice_id,customer_id,vehicle_id,debit,credit,transaction_add_date  FROM transactions WHERE voucher_id = '$voucher_id' GROUP BY vehicle_id");
  if (mysqli_num_rows($transactionGet)>0) {
    while ($transaction=mysqli_fetch_assoc($transactionGet)) { 

    $get_expense= mysqli_query($dbc,"SELECT  brands.*, maker.* FROM vehicle_info  INNER JOIN brands ON brands.brand_id = vehicle_info.vehicle_brand  INNER JOIN maker ON maker.maker_id = vehicle_info.vehicle_maker WHERE vehicle_info.vehicle_id = '".$transaction['vehicle_id']."' ");
     $vehicle = mysqli_fetch_assoc($get_expense);
				$invoice=fetchRecord($dbc,"invoice","invoice_id",$transaction['invoice_id']);	
				$tran=getWhere($dbc,"transactions","voucher_id",$voucher_id);
					while ( $tansFetch=mysqli_fetch_assoc($tran)) {
						@$total_debit += $tansFetch['debit'];
						@$total_credit= $tansFetch['credit'];
					}

    	
    	
      ?>

    <tr>
    <td><?=$transaction['invoice_id']?>  </td>
     <td><?=$vehicle['maker_name']?>  <?=$vehicle['brand_name']?></td>
     
      <td><?=$invoice['invoice_grand_total']?></td>
      <td><?=$total_credit?></td>
      <td><?=$invoice['invoice_grand_total']-$total_debit?></td>
    </tr>
<?php } $balance=$total_credit-$total_debit;}?>
  </tbody>
  <tfoot style="border-top: 1px solid black;">
    <tr>
      <th colspan="2"></th><th colspan="">Balance</th><td><?=$balance?></td></tr>
     <!-- <tr> <th></th><th colspan="">Total Amount</th><td><?=$total_tax?></td> -->

      <!--  <tr> <th></th><th  style="border-top: 1px solid black;">Grand Total</th><th style="border-top: 1px solid black;"><?=$grand?></th>


    </tr> -->
  </tfoot>

  </table>
       </div>
       </div>

<div class="row mt-5">
	<div class="col-sm-12 mt-2">
  	
  <table class="table table-borderedless text-center table-sm" style="color:black ">

        <tr><th colspan="2" class="text-left h6">COMMENT</th><td></td><td colspan="1" rowspan="2" ><img src="uploads/logo.png" style="width: 150px;height:150px;"></td></tr>

    
    <tr><td colspan="4" class="text-justify">Please include the invoice number as reference when paying online or by cheque.<br>All the payment transfer charges must be paid by the buyer.<h6 style="color: #21618C;">Thanks You For Your Bussiness</h6></td></tr>
  <tbody>
</table>
</div>
</div>

<div cass="row">
	<div class="col-sm-12">
		<h5 style="text-align: center">NEXCO JAPAN LTD CO</h5>
		<p style="text-align: center;color: black">Should you have any enquiries concerning this invoice, please contact</p>
	</div>
</div>


<div cass="row">
	<div class="col-sm-12">
		<div class="div" style="background-color:#21618C;color: white;width:100%;text-align: center;padding: 2px ">
			<p>358-2 Kamishizuhara, sukara city, chiba prefecture, japan 285-0844</p>
			<p>Tel +81-43-312-1411 FAX: +81-43-312-1412 EMAIL: info@nexcojapan.com Web: www..nexcojapan.com</p>
		</div>
	</div>
</div>
		</div>


		<!-- jQuery -->
		<script src="https://code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
 		<script src="Hello World"></script>
	</body>
</html>