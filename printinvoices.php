<?php
 $z = ($_POST['invoice_ids']);

foreach ($z as $key => $value) {
 	
 	$invoice_id =  $value;
 } 
?>
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
			/*@media print{

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
        }*/
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
     // $transaction_id = $_GET['transaction_id'].'<br>';
     // $invoice_id = $_GET['invoice_id'];
     
        $q = mysqli_query($dbc,"SELECT invoice.*, customers.*, vehicle_info.*, brands.*, maker.* FROM invoice LEFT OUTER JOIN customers ON customers.customer_id = invoice.invoice_customer LEFT OUTER JOIN vehicle_info ON vehicle_info.vehicle_id = invoice.invoice_vehicle LEFT OUTER JOIN brands ON brands.brand_id = vehicle_info.vehicle_brand  LEFT OUTER JOIN maker ON maker.maker_id = vehicle_info.vehicle_maker WHERE invoice.invoice_id = '$invoice_id' ");
     
      
      $fetchInvoice = mysqli_fetch_assoc($q);
      if ($fetchInvoice) {
        # code...
      }else{
          $fetchInvoice = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT invoice.*, transactions.*, customers.*, vehicle_info.*, brands.*, maker.* FROM invoice INNER JOIN transactions ON invoice.transaction_id = transactions.transaction_id LEFT OUTER JOIN customers ON customers.customer_id = invoice.invoice_customer LEFT OUTER JOIN vehicle_info ON vehicle_info.vehicle_id = transactions.vehicle_id LEFT OUTER JOIN brands ON brands.brand_id = vehicle_info.vehicle_brand  LEFT OUTER JOIN maker ON maker.maker_id = vehicle_info.vehicle_maker WHERE invoice.invoice_id = '$invoice_id'"));
      }
      // "<pre>".print_r($fetchInvoice)."</pre>";
    ?>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h1 style="color: red;font-weight: bold;">NEXCO JAPAN LTD CO</h1>
					<p style="font-weight: bold;float: none;">Car for everyone</p>
					<h4 style="text-align: right;font-weight: bold;">
<?=($fetchInvoice['invoice_quotation']=="quotation")?"QUOTATION":"INVOICE"?></h4>
					<div style="width: 100%;padding:12px;background-color:  #21618C " class="div"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12" style="padding-top: 10px">
					<span style="color: darkblue;float: left" >DATE</span> <span style="float: left"> : <?=date('m-d-Y - l',strtotime($fetchInvoice['invoice_time'])) ?></span>
				    <span style="color: darkblue;float: right;margin-left:8px"><?=($fetchInvoice['invoice_quotation']=="quotation")?"QUO-JP".date('y')."-":"INV-NEX-"?>
				    	<?php
				    	foreach ($z as $key => $value) {
 						echo $value;

 					$invoice_id =  $value;
 						} 
				    	?>
				    </span> <span style="float: right"> <?=($fetchInvoice['invoice_quotation']=="quotation")?"QUOTATION":"INVOICE"?> #</span>

				</div>
			</div>
				<div class="row">
				<div class="col-sm-12" style="margin-top:5px">
					<span style="color: darkblue;float: left">DUE</span> 
          <span style="float: left"> : 
            <?=empty(date('m-d-Y - l',strtotime(@$fetchInvoice['transaction_next_date'])))? date('m-d-Y - l',strtotime(@$fetchInvoice['transaction_next_date'])) : "No Data Available"?>
          </span>

          

				</div>
			</div>


<div class="row mb-2" style="background-color: #D6EAF8;">
      <div class="col-sm-12 ">
        <div class="row" style="background-color: #21618C;color:white;">
        <h6 class="pt-1  pl-5 text-center "> Customer info </h6>
      </div>
      <div class="row" >
        <div class="col-sm-11 text-break   mx-auto">
         <table class="table table-borderedless table-sm">
          <tbody>
            <tr>
              <td>NAME</td><td><?=ucfirst($fetchInvoice['customer_name'])?></td></tr>
            <tr>
              <td>ADDRESS</td><td><?=$fetchInvoice['customer_address']?></td>
            </tr>
            <tr>
              <td>PHONE</td> <td><?=$fetchInvoice['customer_phone']?></td>
            </tr>
             <tr>
              <td>EMAIL</td><td><?=$fetchInvoice['customer_email']?></td>
            </tr>
          </tbody>
        </table>
      </div>
      </div>
  </div>

 

</div><!-- end row -->

         <div class="row">
         	<div class="col-12 table-responsive">
  <table class="table  " border="5px" style="color:black;width:100%;border:5px; border:5px black;text-align: center; ">
  <thead  style="background-color:  #21618C;color: white;width:100%;" >
    <tr >
    	 <th style="width: 10%">STOCK ID</th>
      <th style="width: 15%">VEHICLE NAME</th>
    <th>CHASSIS </th>
      <th>REG YEAR/MONTH</th>
       <th>COLOR</th>
       <th>FUEL</th>
       <th>TRANS</th>
        <th>MILAGE</th>
       <th>UNIT PRICE</th>
       <th>AMOUNT</th>

    </tr>
  </thead>
  <tbody style="border:1px black">
  	 <?php
        $z = ($_POST['invoice_ids']);
        $grand = 0;

foreach ($z as $key => $value) {
 	
 	$invoice_id =  $value;

 	 $fetchInvoice = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT invoice.*, transactions.*, customers.*, vehicle_info.*, brands.*, maker.* FROM invoice INNER JOIN transactions ON invoice.transaction_id = transactions.transaction_id LEFT OUTER JOIN customers ON customers.customer_id = invoice.invoice_customer LEFT OUTER JOIN vehicle_info ON vehicle_info.vehicle_id = transactions.vehicle_id LEFT OUTER JOIN brands ON brands.brand_id = vehicle_info.vehicle_brand  LEFT OUTER JOIN maker ON maker.maker_id = vehicle_info.vehicle_maker WHERE invoice.invoice_id = '$invoice_id'"));
  

 
?>
        
    <tr >
    	<td><?=strtoupper($fetchInvoice['vehicle_stock_id'])?></td>
      <td  class="text-break">
      <?=$fetchInvoice['maker_name']?> <?=$fetchInvoice['brand_name']?>
      </td>
      <td><?=$fetchInvoice['vehicle_chassis_no']?></td>
       <td><?=$fetchInvoice['vehicle_reg_year']?>/<?=strtoupper(substr($fetchInvoice['vehicle_reg_month'],0,3))?></td>
         <td><?=strtoupper($fetchInvoice['vehicle_color_name'])?></td>
         <td><?=strtoupper($fetchInvoice['vehicle_fuel'])?></td>
           <td><?=strtoupper($fetchInvoice['vehicle_transmission'])?></td>
        <td><?=$fetchInvoice['vehicle_km']?> KM</td>

      <td><?=$fetchInvoice['invoice_vehicle_rate']?> <?=strtoupper($fetchInvoice['invoice_currency'])?></td>
        <td><?=$fetchInvoice['invoice_grand_total']?></td>
   </tr>

   <tr >
   
   	<th colspan="2">DESCRIPTION </th>
   	<td colspan="8"><?=$fetchInvoice['vehicle_package']?>,<?=$fetchInvoice['vehicle_cc']?>CC,<?=$fetchInvoice['vehicle_access']?>,
   		<!-- <?php
   	 	$val = $fetchInvoice['vehicle_feature_list'];

   	foreach ($val as $key => $value) {
   		echo $value;
   		# code...
   	}

   		?> -->
   	Seat:2 , Loading Capacity : 40

   	</td>
   
   </tr>
     
 <?php

 $grand +=$fetchInvoice['invoice_vehicle_rate'];
 }
 ?> 

  </tbody>
  <tfoot>
    <tr><td colspan="5" style="border:0"><hr style="padding: 2px;width: 100%;background-color:#21618C " ></td></tr>
    <tr><td colspan="4" style="border:0;text-align: right">SUBTOTAL USD $</td><td><?=$grand?></td></tr>
    <tr><td colspan="4" style="border:0;text-align: right">SALE TAX RATE %</td><td>0.0</td></tr>
  </tfoot>
  </table>
       </div>
       </div>

<div class="row">
	<div class="col-sm-12">
  	
  <table class="table table-borderedless text-center table-sm" style="color:black ">
  
    <h3 style="color: black">SERVICES</h3>
  <thead style="background-color:  #21618C;color: white" id="table">
    <tr>
      <th scope="col">Service Name</th>
      <th scope="col">Sell Price</th>
      <th scope="col">Gifted/Purchased</th>
    </tr>
  </thead>
  <tbody>
  <?php   
 foreach ($z as $key => $value) {
 	
 	$invoice_id =  $value;
    $c=0;
  $invoiceGet=getWhere($dbc,"services_invoice","invoice_id",$invoice_id);
 // $services_value=json_decode($invoiceFetch['invoice_services']);
  
  if ($invoiceGet) {
    $total_price=$total_units=$total_Amount=0;
     ?>
    <?php
   

    while($invoiceFetch=mysqli_fetch_assoc($invoiceGet)):

if ($invoiceFetch['gifted']==1) {
  $type='<i class="fa fa-gift" style="font-size:25px;"></i>';
  $text="Gifted";
  # cod
}else{ $type='<i class="fa fa-dollar" style="font-size:25px;"></i>';
  $text="Purchased";
}

  $getServices=fetchRecord($dbc,"vehicle_services","vehicle_services_id",$invoiceFetch['services_id']);
  @$Subtotal_price+=$getServices["vehicle_services_amount"];  $c++;

 // $total_price+=$getServices["vehicle_services_amount"]*$counts[$value];
 ?>

    <tr>
   
      <td> <?=$getServices['vehicle_services_name']?></td>
      <td><?=$getServices["vehicle_services_amount"]?></td>
      <td> <?=$type?>  <?=$text?> </td>
    </tr> <?php endwhile; 
}
}
    ?>
  </tbody>
</table><?php 
if (empty($Subtotal_price)) {
  $Subtotal_price=0;}
$total_Amount=@$Subtotal_price+$fetchInvoice['invoice_grand_total'];
?>
  <?php $bankDetail=fetchRecord($dbc,"customers","customer_id",$fetchInvoice['invoice_bank']) ?>
   <table class="table table-borderedless text-center table-sm" style="color:black ">
    <tbody>
    <tr><td colspan="4"><hr style="padding: 2px;width: 100%;background-color:#21618C " ></td></tr>
    <tr><td colspan="2" class="b-1"><h6 class="font-weight-bold">BANKING INFORATION</h6></td><td>SUBTOTAL USD $</td><td><?=@$Subtotal_price?></td></tr>
    <?php // if ($fetchInvoice['invoice_quotation'] != "quotation"):?>
    <tr><td class="b-1 font-weight-bold">BENIFICIARY NAME</td><td class="b-1 font-weight-bold"><?=$bankDetail['customer_email']?></td>
      <td>SALE TAX RATE %</td><td>0.0</td></tr>
    <tr><td class="b-1 h6">ACCOUNT NO</td><td class="b-1"><?=$bankDetail['customer_name']?></td>
      <td>TOTAL UNIT $</td><td><?=$total_price?></td></tr>
    <tr><td class="b-1 h6">NAME OF BANK</td><td class="b-1"><?=ucfirst($bankDetail['customer_company'])?></</td>
      <td>TOTAL PARTS $</td><td><?=@$total_units?></td></tr>
    <tr><td class="b-1 h6">BRANCH NAME</td><td class="b-1"><?=ucfirst($bankDetail['customer_city'])?></</</td>
      <td>SALES TAX $ </td><td>0.0</td></tr>
     <tr><td class="b-1 h6">BRANCH ADDRESS</td><td class="b-1"><?=ucfirst($bankDetail['customer_address'])?></</</td>
      <td style="border-top: 3px solid black;" >TOTAL PRICE FJD $</td><td style="border-top: 3px solid black;"><?=$total_Amount?></td></tr>

    <tr><td class="b-1 h6">SWIFT CODE</td><td class="b-1"><?=$bankDetail['customer_contact_person']?></td></tr>
        <tr><td class="b-1 h6 "  >ACCEPTABLE CURRENCY </td><td class="b-1"><?=$bankDetail['customer_country']?></td><td colspan="2" class="b-none"></td></tr>
        <tr><th class="text-left h6">COMMENT</th><td></td><td colspan="2" rowspan="2" ><img src="uploads/logo.png" style="width: 150px;height:150px;margin-top: -70px;"></td></tr>

    
    <tr><td colspan="4" class="text-justify">Please include the invoice number as reference when paying online or by cheque.<br>All the payment transfer charges must be paid by the buyer.<h6 style="color: #21618C;">Thanks You For Your Bussiness</h6></td></tr>

    <?php //endif ?>
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