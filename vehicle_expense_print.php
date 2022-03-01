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
       $vehicle_id = $_GET['vehicle_id'];
      $check=getWhere($dbc,"vehicle_expense","vehicle_info_id",$vehicle_id); 

  if (mysqli_num_rows($check)>0) { 
   
     
 


             $get_expense= mysqli_query($dbc,"SELECT  brands.*, maker.* FROM vehicle_info  INNER JOIN brands ON brands.brand_id = vehicle_info.vehicle_brand  INNER JOIN maker ON maker.maker_id = vehicle_info.vehicle_maker WHERE vehicle_info.vehicle_id = '$vehicle_id' ");
        
      $fetch_name = mysqli_fetch_assoc($get_expense);
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
       
            <h4>Vehicle Expense</h4>     
          </center>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12" style="padding-top: 10px">
					<span style="color: darkblue;float: left;" ><b>Vehicle Name : </b></span> <span style="float: left"> <?=$fetch_name['maker_name']?> <?=$fetch_name['brand_name']?></span>
				    <span style="color: darkblue;float: right;margin-left:8px"></span> <span style="float: right"></span>

				</div>
			</div>


         <div class="row">
         	<div class="col-12 table-responsive">
  <table class="table table-borderedless mx-auto text-center table-sm mt-5" style="color:black;width:100%; ">
  <thead  style="width:100%;" >
    <tr>
 
      <th >Expense Name</th>
       <th >Expense Amount</th>
       <th>Expense Tax</th>

    </tr>
  </thead>
  <tbody>
    <?php $get_expense=getWhere($dbc,"vehicle_expense","vehicle_info_id",$vehicle_id); $c=0; $total=0; $total_tax=0;

  if (mysqli_num_rows($get_expense)>0) { 

      # code...
    
    while ($fetch_expense=mysqli_fetch_assoc($get_expense)) { 
      $total+=$fetch_expense['vehicle_expense_amount'];
      $total_tax+=$fetch_expense['vehicle_expense_tax'];
      ?>

    <tr>
     
      <td><?=$fetch_expense['vehicle_expense_name']?></td>
      <td><?=$fetch_expense['vehicle_expense_amount']?></td>
      <td><?=$fetch_expense['vehicle_expense_tax'];?></td>
    </tr>
<?php } @$grand=$total_tax+$total;  }?>
  </tbody>
  <tfoot style="border-top: 1px solid black;">
    <tr>
      <th></th><th colspan="">Total Amount</th><td><?=$total?></td></tr>
     <tr> <th></th><th colspan="">Total Amount</th><td><?=$total_tax?></td>

       <tr> <th></th><th  style="border-top: 1px solid black;">Grand Total</th><th style="border-top: 1px solid black;"><?=$grand?></th>


    </tr>
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
<?php 
}else{
  echo "No Data FOund";
 redirect('show_trade.php',2000);
}
 ?>

		<!-- jQuery -->
		<script src="https://code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
 		<script src="Hello World"></script>
	</body>
</html>