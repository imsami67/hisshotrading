<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Invoice</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
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
      $transaction_id = $_GET['transaction_id'].'<br>';
     echo $invoice_id = $_GET['invoice_id'];
      if (is_string($transaction_id) == "quotation") {
        $q = mysqli_query($dbc,"SELECT invoice.*, customers.*, vehicle_info.*, brands.*, maker.* FROM invoice LEFT OUTER JOIN customers ON customers.customer_id = invoice.invoice_customer LEFT OUTER JOIN vehicle_info ON vehicle_info.vehicle_id = invoice.invoice_vehicle LEFT OUTER JOIN brands ON brands.brand_id = vehicle_info.vehicle_brand  LEFT OUTER JOIN maker ON maker.maker_id = vehicle_info.vehicle_maker WHERE invoice.invoice_id = '$invoice_id' AND invoice.invoice_quotation = 'quotation'");
      }else{
        $q = mysqli_query($dbc,"SELECT invoice.*, transactions.*, customers.*, vehicle_info.*, brands.*, maker.* FROM invoice INNER JOIN transactions ON invoice.transaction_id = transactions.transaction_id LEFT OUTER JOIN customers ON customers.customer_id = invoice.invoice_customer LEFT OUTER JOIN vehicle_info ON vehicle_info.vehicle_id = transactions.vehicle_id LEFT OUTER JOIN brands ON brands.brand_id = vehicle_info.vehicle_brand  LEFT OUTER JOIN maker ON maker.maker_id = vehicle_info.vehicle_maker WHERE invoice.invoice_id = '$invoice_id'");
      }
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
					<h1 style="color: red;font-weight: bold;text-align: center;">NEXCO JAPAN LTD CO</h1>
					<p style="text-align: center;font-weight: bold;">Car for everyone</p>
					<h4 style="text-align: right;font-weight: bold;">INVOICE</h4>
					<div style="width: 100%;padding:12px;background-color:  #21618C " class="div"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12" style="padding-top: 10px">
					<span style="color: darkblue;float: left" >DATE</span> <span style="float: left"> : <?=date('m-d-Y - l',strtotime($fetchInvoice['invoice_time'])) ?></span>
				    <span style="color: darkblue;float: right;margin-left:8px">INV-NEX-<?=$invoice_id?></span> <span style="float: right"> INVOICE #</span>
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


			<div class="row">
				<div class="col-sm-12">
				<div style="width: 100%;height:25px;color:white;background-color:  #21618C " class="div">
					<div class="col-sm-12">
						<span style="color:white;" class="span">Customer info</span>
							<span style="color:white;margin-left: 41%" class="span">Vehicle info</span>
					</div>
				</div>
			</div>
			</div>

         <div class="row">
         	<div class="col-sm-12">
         		<div class="row1">
  <div class="column1" style="background-color:#D6EAF8 ">
  <span style="color: darkblue;">NAME</span> <span style="  text-transform: uppercase;margin-left: 15px"><?=$fetchInvoice['customer_name'] ?></span><br><br>
   <span style="color: darkblue;">ADDRESS</span> <span style="  text-transform: uppercase;margin-left: 15px"><?=$fetchInvoice['customer_address'] ?></span><br><br>
     <span style="  text-transform: uppercase;margin-left: 70px">PHONE</span> <span style="  text-transform: uppercase;margin-left: 10px"><?=$fetchInvoice['customer_phone'] ?></span><br>
      <span style="margin-left: 70px"><a href="#"><?=$fetchInvoice['customer_email'] ?></span> 
  </div>
  <div class="column1" style="background-color:#D6EAF8 ;">
   <span style="color: darkblue;">NAME</span> <span style="margin-left: 29px;color:black"><?=$fetchInvoice['maker_name'] ?></span><br>
   <span style="color: darkblue;">MODEL</span> <span style="margin-left: 29px;color:black"><?=$fetchInvoice['brand_name'] ?></span><br>
   <span style="color: darkblue;">YEAR</span> <span style="margin-left: 29px;color:black"><?=$fetchInvoice['vehicle_reg_month'] ?></span><br>
   <span style="color: darkblue;">Color</span> <span style="margin-left: 29px;color:black"><?=$fetchInvoice['vehicle_color'] ?></span><br>
   <span style="color: darkblue;">CHASSIS #</span> <span style="margin-left: 20px;color:black"><?=$fetchInvoice['vehicle_chassis_no'] ?></span><br>
   <span style="color: darkblue;">EnGINE CC#</span> <span style="margin-left: 18px;color:black"><?=$fetchInvoice['vehicle_engine_no'] ?></span><br>
     <span style="color: darkblue;">MILEAGE</span> <span style="margin-left: 23px;color:black"><?=$fetchInvoice['vehicle_m3'] ?></span><br>
  </div>
</div>
         	</div>
         </div>

         <div class="row">
         	<div class="col-sm-12">
         		<table class="table" style="color:black ">
  <thead  style="background-color:  #21618C;color: white" >
    <tr>
      <th scope="col">DESCRIPTION</th>
      <th scope="col">QUANTITY</th>
      <th scope="col">UNIT PRICE</th>
      <th scope="col">AMOUNT</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">PW,PS,AW,AAC,NV,Bluettoth,AUX,AUDIO,VIDEO,CD, Fog Lamps,</th>
      <td>1</td>
      <td><?=$fetchInvoice['invoice_grand_total']?></td>
      <td><?=$fetchInvoice['invoice_grand_total']?></td>
    </tr>
    <tr>
      <th scope="row">Good tires with Mag wheels,Keyless Entry, Spare Key, Tools Kit, ETC Equipped,</th>
      <td></td>
      <td></td>
      <td>-</td>
    </tr>
     <tr>
      <th scope="row"></th>
      <td></td>
      <td></td>
      <td>-</td>
    </tr>
  
  </tbody>
</table>
          </div>
       </div>


<div class="row">
	<div class="col-sm-12">
		<hr style="padding: 2px;width: 100%;background-color:#21618C " class="div">
		 <span style="color: darkblue;float: right;margin-left:145px"><?=$fetchInvoice['invoice_grand_total']?></span> <span style="float: right"> SUBTOTAL USD $</span><br>
		  <span style="color: darkblue;float: right;margin-left:155px">0.0</span> <span style="float: right"> SALE TAX RATE %</span>
	</div>
</div>

<div class="row">
         	<div class="col-sm-12">
         		<h3 style="color: black">SERVICES(if any)</h3>
         		<table class="table" style="color:black ">
  <thead style="background-color:  #21618C;color: white" id="table">
    <tr>
      <th scope="col">PART #</th>
      <th scope="col">PART NAME</th>
      <th scope="col">RATE</th>
      <th scope="col">AMOUNT</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $q0 = mysqli_query($dbc,"SELECT * FROM vehicle_expense WHERE vehicle_info_id = '".$fetchInvoice['vehicle_id']."'");
    while ($r2 = mysqli_fetch_assoc($q0)):?>
    <tr>
      <th scope="row"><?=$r2['vehicle_expense_id']?></th>
      <td><?=$r2['vehicle_expense_name']?></td>
      <td><?=$r2['vehicle_expense_amount']?></td>
       <td>-</td>
    </tr> 
    <?php endwhile ?>
  </tbody>
</table>
          </div>
       </div>

       <div class="row">
	<div class="col-sm-12">
		<hr style="padding: 2px;width: 100%;background-color:#21618C " class="div">
		 <span style="color: darkblue;float: right;margin-left:180px">-</span> <span style="float: right"> SUBTOTAL USD $</span><br>
		  <span style="color: darkblue;float: right;margin-left:155px">0.0</span> <span style="float: right"> SALE TAX RATE %</span>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
	

<div class="row2">
  <?php if ($fetchInvoice['invoice_quotation'] != "quotation"):?>
  <div class="column2" style="background-color:;">
  		<h6>BANKING INFORATION</h6>

  <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">BENIFICIARY NAME</th>
      <th scope="col">NEXO JAPAN LTD</th>
     
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">ACCOUNT NO</th>
      <td>8342888988</td>
    
    </tr>
    <tr>
      <th scope="row">NAME OF BANK</th>
      <td>BOP</td>
     
    </tr>
    <tr>
      <th scope="row">BRANCH NAME</th>
      <td >SUVA</td>
     </tr>
      <tr>
      <th scope="row">SWIFT CODE</th>
      <td >xxx</td>
     </tr>
      <tr>
      <th scope="row">BANK ADDRESS</th>
      <td >some address</td>
     </tr>
      <tr>
      <th scope="row">ACCEPTABLE CURRENCY</th>
      <td >USD</td>
     </tr>
  </tbody>
</table>
<h6>COMMENT</h6>
<hr style="width: 100%;padding: 1px;background-color: #21618C" class="div">
<p style="color: black">Please include the invoice number as reference when paying online or by cheque.<br>All the payment transfer charges must be paid by the buyer.</p>
  </div>
  <?php endif ?>

  <div class="column3" style="background-color:;">
   <span style="color: darkblue">TOTAL UNIT $ </span> <span style="margin-left: 10px"><?=$fetchInvoice['invoice_grand_total']?></span><br>
     <span style="color: darkblue">TOTAL PARTS $ </span> <span style="margin-left: 10px">--</span><br>
       <span style="color: darkblue">SALES TAX $ </span> <span style="margin-left: 10px">--</span><br>
       <hr style="width: 100%;padding: 1px;background-color: black" class="div">
        <span style="color: red;font-size:13px">TOTAL PRICE FJD $ </span> <span style="margin-left: 10px"><?=$fetchInvoice['invoice_grand_total']?></span><br>
  </div>
</div>
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