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
      .cd{
        color:#21618C;
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
   //   $transaction_id = $_GET['transaction_id'].'<br>';
    
 $z = ($_POST['invoice_ids']);

foreach ($z as $key => $value) {
  
  $invoice_id =  $value;
 } 
  
        $q = mysqli_query($dbc,"SELECT invoice.*, transactions.*, customers.*, vehicle_info.*, brands.*, maker.* FROM invoice INNER JOIN transactions ON invoice.transaction_id = transactions.transaction_id LEFT OUTER JOIN customers ON customers.customer_id = invoice.invoice_customer LEFT OUTER JOIN vehicle_info ON vehicle_info.vehicle_id = transactions.vehicle_id LEFT OUTER JOIN brands ON brands.brand_id = vehicle_info.vehicle_brand  LEFT OUTER JOIN maker ON maker.maker_id = vehicle_info.vehicle_maker WHERE invoice.invoice_id = '$invoice_id'");
    
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
        <div class="col-sm-3">
          <img src="img/logo.png" width="90" height="90" class="img-fluid float-right">
        </div>
        <div class="col-sm-8 mt-3">
          <h2 style="color: red;font-weight: bold;">NEXCO JAPAN LTD CO</h2>
          <p style="float: none;font-weight: bold;">358-2 Kamishizuhara, Sakura City, Chiba Prefecture, Japan, 285-0844</p>
          <p style="margin-left: -15%;font-weight: bold;margin-top: -10px;">Tel: +81-43-312-1411 Fax: +81-43-312-1412 E-mail: info@nexcojapan.com Web: www.nexcojapan.com</p>
  

          
        </div>
     
                <div style="width: 100%;padding:2px;background-color:  #21618C " class="div"></div>
      </div>
      <div class="row">
        <div class="col-sm-9" style="padding-top: 10px">
           <?=$invoice_id?></span> <span style="float: left">Invoice No#</span>
            <span style="color: darkblue;float: left;margin-left: 10px;">  <?=($fetchInvoice['invoice_quotation']=="quotation")?"QUO-JP".date('y')."-":"INV-NEX-"?>

        </div>
          <div class="col-sm-3" style="padding-top: 10px">
           
              <span style="color: darkblue;float:;" >DATE :</span> <span style="float: right;"><?=date('m-d-Y - l',strtotime($fetchInvoice['invoice_time'])) ?></span>

        </div>
      </div>
         <center style="width: 100%;margin-top: -5px;"><p style="font-weight: bold;"><?=($fetchInvoice['invoice_quotation']=="quotation")?"QUOTATION":"INVOICE"?></center>
        <div class="row">
        <div class="col-sm-12" style="margin-top:5px">
          

          

        </div>
      </div>


<div class="row mb-2" style="background-color: #D6EAF8;">
     <?php $shipperQ=getWhere($dbc,"shipment","vehicle_id",$fetchInvoice['invoice_vehicle']); 
     $shipcount=mysqli_num_rows($shipperQ);?>
      <?php if ($shipcount>0): 
              $shipment=mysqli_fetch_assoc($shipperQ);
              $shipper=fetchRecord($dbc,"shipper","shipper_id",$shipment['shipment_company']); 
              @$customers=fetchRecord($dbc,"customers","customer_id",$fetchInvoice['invoice_customer']);
               @$consignee_info=fetchRecord($dbc,"consignee","vehicle_id",$fetchInvoice['invoice_vehicle']); 
              ?>
      <div class="col-sm-6 ">
  
     

    <div class="row" style="background-color: #21618C;color:white;">
        <h6 class="pt-1  pl-5 text-center "> SHIPPER :  </h6>
      </div>
      <div class="row" >
        <div class="col-sm-10 text-break   mx-auto">
         <table class="table table-borderedless table-sm">
          <tbody>
          <tr>
              <td>Shipper Name</td><td><?=ucfirst(@$shipper['shipper_name'])?></td></tr>
            <tr>
              <td>Shipper Address</td><td><?=@$shipper['shipper_email']?></td>
            </tr>
            <tr>
              <td>Phone/Fax</td><td><?=@$shipper['shipper_landline']?>/<?=@$shipper['shipper_fax']?></td></tr>
              <tr> <td>Mobile</td><td><?=@$shipper['shipper_mobile']?></td></tr>
              <tr> <td>Email</td><td><a href="mailto:<?=@$shipper['shipper_email']?>"><?=@$shipper['shipper_email']?></a></td>
            </tr>
            
           
             
         
      </tbody>
        </table>
      </div>
      </div>
  
  </div>
  <div class="col-sm-6 ">
   


    <div class="row" style="background-color: #21618C;color:white;">
        <h6 class="pt-1  pl-5 text-center "> Messrs :  </h6>
      </div>
      <div class="row" >
        <div class="col-sm-10 text-break   mx-auto">
         <table class="table table-borderedless table-sm">
          <tbody>
            <tr><td>Consignee Name</td><td><?=@$customers['customer_name']?></td></tr>
            <tr><td>Consignee Address</td><td><?=@$customers['customer_country']?></td></tr>
            <tr><td>Phone / Fax # </td><td><?=@$customers['customer_whatsapp']?></td></tr>
            <tr><td>Mobile #</td><td><?=@$customers['customer_phone']?></td></tr>
            <tr><td>Email </td><td><?=@$customers['customer_email']?></td></tr>
          </tbody>
        </table>
      </div>
      </div>
       <div class="row" style="background-color: #21618C;color:white;">
        <h6 class="pt-1  pl-5 text-center "> Notify Party :  </h6>
      </div>
      <div class="row" >
      
        <div class="col-sm-10 text-break   mx-auto">
            
         
         <table class="table table-borderedless table-sm">
          <tbody>
          <?php if ($consignee_info['consignee_type']=="notify party"){ ?>

            <tr><td>Notify Party Name</td><td><?=@$consignee_info['consignee_name']?></td></tr>
            <tr><td>Notify party  Address</td><td><?=@$consignee_info['consignee_address']?></td></tr>
            <tr><td>Notify Party Contact #</td><td><?=@$consignee_info['consignee_mobile']?></td></tr>
         <?php }else{ ?>
           
            <tr><td>Same as Consignee</td></tr>
            <?php } ?>

          </tbody>
        </table>
      </div>
      </div>
  
  </div><?php endif; ?>
</div><!-- end row -->
<div class="row">
    <div class="col-6">
    <table class="table table-borderedless mx-auto text-left table-sm" style="color:black;width:100%; ">
      <tr>
        <th>Vessel name:</th><td><?=strtoupper($shipment['shipment_ship_name'])?></td></tr>
       <tr> <th>Sailing on or about:</th><td><?=$shipment['ship_eta']?></td>
      </tr>
        <tr>
        <th>PORT OF LOADING</th><td><?=@ucfirst($shipper['shipment_port_of_landing'])?></td></tr>
       <tr> <th>PORT OF DISCHARGE</th><td>
           <?=@ucfirst(fetchRecord($dbc,"country_regulation","country_regulation_id",$fetchInvoice['invoice_country_port'])['country_regulation_destination_port'])?> <?=ucfirst($fetchInvoice['invoice_country'])?>
        </td>

      </tr>
      <tr> <th>PORT OF DESTINATION</th><td>
           <?=ucfirst($consignee_info['consignee_final_dest'])?>
        </td>
    </table>
  </div>  
  <div class="col-6">
    <table class="table table-borderedless mx-auto text-left table-sm" style="color:black;width:100%; ">
      <tr>
        <th>Currency</th><td><?=strtoupper($fetchInvoice['invoice_currency'])?></td>
       </tr>
       <tr><th>Shipment Term</th><td><?=empty($fetchInvoice['invoice_fright'])?"FOB":"CNF"?></td></tr>
       
      
    </table>
  </div>  
</div><!-- end row -->
<div class="row">
  <div  class="col-12">
    <h6>Description Goods</h6>
    <p>Used Car(s)</p>
    <p>
Shipping Mark : NO MARK</p>
  </div>
</div>
<div class="row">
  <div class="col-12">
    

<!-- <div class="row" style="background-color: #21618C;color:white;">
        <h6 class="pt-1 pl-5"> Vehicle info</h6>
      </div> -->
      <div class="row" >
        <div class="col-sm-12 text-break   mx-auto">
         <table class="table table-bordered text-center w-100 " >
          <thead style="background-color: #21618C;color:white;">
            <th>STOCK ID</th>
            <th>MAKER</th>
            <th>MODEL</th>
            <th>CHASSIS No.</th>
            <th>YEAR</th>
            <th>SEAT</th>
 
            <th>ENGINE TYPE</th>
            <th>ENGINE CAP.(L)</th>
            <th>QUANTITY</th>
            <th>WEIGHT</th>
           <!--  <th>MILAGE</th> -->
            <th>AMOUNT</th>
           
          </thead>
          <tbody>
             <?php  // $_POST['invoice_ids']
              $z = ($_POST['invoice_ids']);
        $sub_total_amount = 0;
$count_units=0;
$total_weight=0;
foreach ($z as $key => $value) {
  $count_units++;
  $invoice_id =  $value;

   $fetchInvoice = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT invoice.*, transactions.*, customers.*, vehicle_info.*, brands.*, maker.* FROM invoice INNER JOIN transactions ON invoice.transaction_id = transactions.transaction_id LEFT OUTER JOIN customers ON customers.customer_id = invoice.invoice_customer LEFT OUTER JOIN vehicle_info ON vehicle_info.vehicle_id = transactions.vehicle_id LEFT OUTER JOIN brands ON brands.brand_id = vehicle_info.vehicle_brand  LEFT OUTER JOIN maker ON maker.maker_id = vehicle_info.vehicle_maker WHERE invoice.invoice_id = '$invoice_id'"));
   $total_weight+=$fetchInvoice['vehicle_weight'];
    ?>
            <tr>
              <td><?=strtoupper($fetchInvoice['vehicle_stock_id'])?></td>
              <td><?=$fetchInvoice['maker_name'] ?></td>
              <td><?=$fetchInvoice['brand_name'] ?></td>
              <td><?=$fetchInvoice['vehicle_chassis_no'] ?></td>   
              <td><?=$fetchInvoice['vehicle_reg_year'] ?></td>
              <td><?=$fetchInvoice['vehicle_seat'] ?></td>
            
               <td><?=strtoupper($fetchInvoice['vehicle_engine_type'])?></td>
              <td><?=strtoupper($fetchInvoice['vehicle_fuel'])?></td>
            <!--   <td><?=strtoupper($fetchInvoice['vehicle_cc'])?> CC</td> -->
              <!-- <td><?=strtoupper($fetchInvoice['vehicle_transmission'])?></td> -->
              <td>1</td>
         <td><?=$fetchInvoice['vehicle_weight'] ?> KG</td> 
           <!--    <td><?=$fetchInvoice['vehicle_m3'] ?></td> -->
              <td><?=$fetchInvoice['invoice_grand_total']?> <?=strtoupper($fetchInvoice['invoice_currency'])?></td>         
            
            </tr>
         <!--    <tr>
              <th colspan="2" style="background-color: #21618C;color:white;">
                OPTIONS
              </th>
              <td colspan="8">
               
        <?php
        $features = json_decode($fetchInvoice['vehicle_feature_list']);
        foreach ($features  as  $value) {
        echo $value.",";
        }

        ?>
  
              </td>
            </tr> -->
          <?php $sub_total_amount+=$fetchInvoice['invoice_grand_total'];
 } ?>
          </tbody>
        </table>
      </div>
      </div>
  
  </div>
</div> <!-- end row -->
         <div class="row">
          <div class="col-12 table-responsive">
  <table class="table table-borderedless mx-auto text-center table-sm text-right" style="color:black;width:100%; ">
  <tfoot>
    <tr><td colspan="5"><hr style="padding: 2px;width: 100%;background-color:#21618C " ></td></tr>
    <tr><td colspan="4" class="text-right" style="color: #21618C;font-weight: bold;">SUBTOTAL USD $</td><td class="cd"><?=$sub_total_amount?></td></tr>
    <tr><td colspan="4" class="text-right" style="color:#21618C;font-weight: bold; ">SALE TAX RATE %</td><td class="cd">0.0</td></tr>
  </tfoot>
  </table>
       </div>
       </div>

<div class="row">
  <div class="col-sm-12">
    
  <table class="table table-borderedless text-center table-sm" style="color:black ">
    <?php   $invoiceGet=getWhere($dbc,"services_invoice","invoice_id",$invoice_id);
 // $services_value=json_decode($invoiceFetch['invoice_services']);
     $total_price=$total_units=$total_Amount=0;
  if (mysqli_num_rows($invoiceGet)>0) {
 
     ?>
    <h3 style="color: black">SERVICES</h3>
  <thead style="background-color:  #21618C;color: white" id="table">
    <tr>
      <th scope="col">Description</th>
      <th scope="col">Gifted/Purchased</th>
       <th scope="col">Price</th>
    </tr>
  </thead>
  <tbody>

    <?php
    $c=0;
    while($invoiceFetch=mysqli_fetch_assoc($invoiceGet)):
 $getServices=fetchRecord($dbc,"vehicle_services","vehicle_services_id",$invoiceFetch['services_id']);
  $c++;
if ($invoiceFetch['gifted']==1) {
  $type='<i class="fa fa-gift" style="font-size:25px;"></i>';
  $text="Gifted";
  # cod
}else{ $type='<i class="fa fa-dollar" style="font-size:25px;"></i>';
  $text="Purchased";
   @$Subtotal_price+=$getServices["vehicle_services_amount"]; 
}

 

 // $total_price+=$getServices["vehicle_services_amount"]*$counts[$value];
 ?>

    <tr>
   
      <td> <?=$getServices['vehicle_services_name']?></td>
      <td> <?=$type?>  <?=$text?> </td>
       <td><?=$getServices["vehicle_services_amount"]?></td>
    </tr> <?php endwhile; ?>
  </tbody>
</table><?php } 
if (empty($Subtotal_price)) {
  $Subtotal_price=0;}
$total_Amount=@$Subtotal_price+$sub_total_amount;
?>
  <?php $bankDetail=fetchRecord($dbc,"customers","customer_id",$fetchInvoice['invoice_bank']) ?>

<div class="row">
  
    <div class="col-12"><hr style="padding: 2px;width: 100%;background-color:#21618C " ></div>
    <div class="col-sm-8"></div>
     <div class="col-sm-4">
       <table class="table table-bordered text-center table-sm" style="color:black ">
         <tr>
           <th>Total</th><td><?=$count_units?></td><td><?=$total_weight?> KG</td> 
           <td><?=$total_Amount?></td>
         </tr>
         <tr>
           <td></td><td>UNITS</td><td>KGS</td><td><?=strtoupper($fetchInvoice['invoice_currency'])?></td>
         </tr>
       </table>
     </div>
     
   
</div>
</div>
</div>

<div cass="row">
  <div class="col-sm-12">
    <h5 style="text-align: center">NEXCO JAPAN LTD CO</h5>
    <p style="text-align: center;color: black">Should you have any enquiries concerning this Quotation Please write us at info@nexcojapan.com </p>
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