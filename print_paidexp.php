<!DOCTYPE html>

<html lang="en">

	<head>

		<meta charset="utf-8">

		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>PaidExpense-Print</title>



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
      $vehicle_id=@$_GET['vehicle_id'];

  $vehicle_info=fetchRecord($dbc,"vehicle_info","vehicle_id",$vehicle_id);

  $maker=fetchRecord($dbc,"maker","maker_id",$vehicle_info['vehicle_maker']);

  $brands=fetchRecord($dbc,"brands","brand_id",$vehicle_info['vehicle_brand']);

  //$auction=fetchRecord($dbc,"auction_info","vehicle_id",$vehicle_id);
  $auction=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT auction_info.*, auction_home.* FROM auction_info INNER JOIN auction_home WHERE auction_info.vehicle_id = $vehicle_id GROUP BY vehicle_id"));

  $ricksu= mysqli_fetch_assoc(mysqli_query($dbc,"SELECT ricksu.*, ricksu_company.* FROM ricksu INNER JOIN ricksu_company ON ricksu.ricksu_company = ricksu_company.ricksu_company_id WHERE ricksu.vehicle_id = '$vehicle_id' AND mini_ricksu!=1"));


  $inspection=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT inspection_info.*, inspection_company.* FROM inspection_info INNER JOIN inspection_company ON inspection_info.inspection_info_company = inspection_company.inspection_company_id WHERE inspection_info.vehicle_id = $vehicle_id"));

  $shipment=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT shipment.*, shipper.*,shipment_company.* FROM shipment INNER JOIN shipper ON shipper.shipper_id = shipment.shipper_id INNER JOIN shipment_company ON shipment_company.shipment_company_id = shipment.shipment_company WHERE shipment.vehicle_id = $vehicle_id")); 

  $airmail=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT airmail.*, consignee.*,services_company.* FROM airmail INNER JOIN consignee ON consignee.consignee_id = airmail.airmail_consignee INNER JOIN services_company ON services_company.services_company_id = airmail.airmail_services_company  WHERE airmail.vehicle_id = $vehicle_id"));

  $expense_account=fetchRecord($dbc,"expense_account","vehicle_id",$vehicle_id);

  $checkPersonQ=get($dbc,"auction_person WHERE vehicle_id='".$vehicle_id."'  ");
  $person=mysqli_fetch_assoc($checkPersonQ);

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
        <center style="width: 100%;margin-top: -5px;"><p style="font-weight: bold;">
Expense Paid Account</p></center>
                <div style="width: 100%;padding:2px;background-color:  #21618C " class="div"></div>
      </div>

			
     
      <div class="row">
                      <div class="col-10 mx-auto">
                        <table class="table">
                          <tr>
                            <th>Vehicle Name</th>
                            <td><?=$maker['maker_name']?> <?=$brands['brand_name']?></td>
                            <th>Chassis No</th>
                            <td><?=$vehicle_info['vehicle_chassis_no']?></td>

                          </tr>
                          <tr>
                            <th>Stock ID</th>
                            <td><?=$vehicle_info['vehicle_stock_id']?></td>
                            <th>Engine No.</th>
                            <td><?=$vehicle_info['vehicle_engine_no']?></td>

                          </tr>
                         <tr>
                            <th>Manufacture Date</th>
                            <td><?=$vehicle_info['vehicle_manu_month']?>-<?=$vehicle_info['vehicle_manu_year']?></td>
                            <th>Registration Year</th>
                            <td><?=$vehicle_info['vehicle_reg_month']?>-<?=$vehicle_info['vehicle_reg_year']?></td>

                          </tr>
                          
                        </table>
                      </div>
                    </div>

		





<div class="row mb-2" style="background-color: #D6EAF8;">

      <div class="col-sm-12 ">

        <div class="row" style="background-color: #21618C;color:white;">

        <h6 class="pt-1  pl-5 text-center "><?=ucfirst($_REQUEST['type'])?> Info</h6>

      </div>

     

    <?php if ($_REQUEST['type']=="auction"): ?>
            
  <?php 
  $customers=fetchRecord($dbc,"customers","customer_id",$expense_account['auction_bank'])['customer_company']; 

$transactions=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM transactions  WHERE  transaction_from='paid_auction' AND vehicle_id = $vehicle_id"));
  ?>         

      
       
           <div class="row">
          <div class="col-sm-6">
              <table class="table table-borderedless " style="width: 100%;">
        
            

         
                <tr><th>Transaction ID</th><td>nj-<?=$transactions['transaction_id']?></td></tr>
                  <tr><th>Transaction Remarks</th><td><?=$transactions['transaction_remarks']?></td></tr>
                <tr><th>Auction House</th><td><?=$auction['auction_home_name']?></td></tr>
                <tr><th>Company Name</th><td><?=$auction['company_name']?></td></tr>
                <tr><th>Bank Name</th><td><?=$customers?></td></tr>
               <tr><th>Bank Details</th><td><?=$expense_account['auction_bank_details']?></td></tr>
             
            
   
       
      
           
         </table>
          </div>
           <div class="col-sm-6">
                <table class="table table-borderedless " style="width: 100%;">
        
            

          
            
                  <tr>
              <th>Win Price</th><td><?=@(int)$auction['auction_win_price']+@$auction['auction_win_price_tax'];?></td>
              
              
            </tr>
            <tr>
              <th>Auction Fee</th><td><?=@(int)$auction['auction_fee']+@$auction['auction_fee_tax'];?></td>
                           
            </tr>
            <tr>
              <th>Recycle Fee</th><td><?=@(int)$auction['auction_recycle_fee']+@$auction['auction_recycle_fee_tax'];?></td>
             
            </tr>

        </td>
        <tr>
          
              <th>Total</th><td>
                <?php 

              echo $total_aution=@(int)$auction['auction_win_price']+@(int)$auction['auction_win_price_tax']+@(int)$auction['auction_fee']+@(int)$auction['auction_fee_tax']+@(int)$auction['auction_recycle_fee']+@(int)$auction['auction_recycle_fee_tax'];
             ?>
              </td>
        </tr>


            
       
      
           
         </table>
           </div>
        </div>
            
     <?php endif ?>     

    <?php if ($_REQUEST['type']=="person"): 
       $customers=fetchRecord($dbc,"customers","customer_id",$expense_account['person_bank'])['customer_company']; 
        @$customer_name=fetchRecord($dbc,"customers","customer_id",$person['customer_id'])['customer_name'];
       @$transactions=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM transactions  WHERE  transaction_from='paid_person' AND vehicle_id = $vehicle_id"));
       ?>         

            <div class="row">
              <div class="col-sm-6">
                  <table class="table table-borderedless " style="width: 100%;">        

                  <tr><th>Transaction ID</th><td>nj-<?=@$transactions['transaction_id']?></td></tr>
                <tr><th>Transaction Remarks</th><td><?=@$transactions['transaction_remarks']?></td></tr>            
                    <tr>
                      <th>Auction House</th><td><?=$auction['auction_home_name']?></td>
                    </tr>
                    <tr>
                      <th>Customer Name</th><td><?=$customer_name?></td>
                    </tr>
                     <tr>
                       <th>Bank Name</th><td><?=$customers?></td>
                     </tr>
                     <tr>
                        <th>Date</th><td><?=$expense_account['date_person']?></td>
                     </tr>
                     <tr>
                        <th>Bank Details</th><td><?=$expense_account['auction_bank_details']?></td>
                     </tr>
            
                   </table>
              </div>
              <div  class="col-sm-6">
                  <table class="table table-borderedless " style="width: 100%;">
                    
                
              <tr>
              <th>Bying Price</th><td><?=@$person['buyingprice']+@$person['buyingprice_tax']?></td>
              

            </tr>
            <tr>
              <th>Commission</th><td><?=@$person['commission']+@$person['commission_tax']?></td>
         
            </tr>
            <tr>
              <th>Recycle Fee</th><td><?=@$person['recycle_fee']+@$person['recycle_fee_tax']?></td>
              
            </tr>
            <tr>
              <th>Total</th><td>
                <?php 

              echo $total_person=@(int)$person['buyingprice']+@(int)$person['buyingprice_tax']+@(int)$person['commission']+@(int)$person['commission_tax']+@(int)$person['recycle_fee']+@(int)$person['recycle_fee_tax'];
             ?>
              </td>
          
             
                
              </td>
            </tr>
    
              
                  </table>
              </div>
            </div>
       
     <?php endif ?>
        <?php if ($_REQUEST['type']=="ricksu"): 
       @$customers=fetchRecord($dbc,"customers","customer_id",$expense_account['ricksu_bank'])['customer_company']; 
       @$transactions=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM transactions  WHERE  transaction_from='paid_ricksu' AND vehicle_id = $vehicle_id"));
       ?>         

            <div class="row">
              <div class="col-sm-6">
                 <table class="table table-borderedless " style="width: 100%;">
                     <tr><th>Transaction ID</th><td>nj-<?=@$transactions['transaction_id']?></td></tr>
                <tr><th>Transaction Remarks</th><td><?=@$transactions['transaction_remarks']?></td></tr>   
                  <tr>
                    <th>Loading Point</th><td><?=$ricksu['ricksu_loading_point']?></td>
                  </tr>
                  <tr>
                     <th>RICKSU Company</th><td><?=$ricksu['ricksu_company_name']?></td>
                  </tr>
                 <tr>
             
              <th>Bank Name</th><td><?=@$customers?></td>
            </tr>
            <tr>
              
              <th>Bank Details</th><td><?=$expense_account['ricksu_bank_details']?></td>
            </tr>
            <tr>
              <th>Date</th><td><?=@$expense_account['ricksu_date']?></td>
            </tr>
           </table> 
              </div>
              <div class="col-sm-6">
                 <table class="table table-borderedless " style="width: 100%;">
        <tr>
              <th>Repair Fee</th><td><?=@$ricksu['ricksu_repair_fee']+@$ricksu['ricksu_repair_fee_tax']?></td>
              

              
            </tr>
            <tr>
              <th>Ricksu Fee</th><td><?=@$ricksu['ricksu_fee']+$ricksu['ricksu_fee_tax']?></td>
              
              
            </tr>
            <tr>
              <th>Charges For Additional Services</th><td><?=@(int)$ricksu['ricksu_charger_for_additional']+@(int)$ricksu['ricksu_charger_for_additional_tax']?></td>
             
            </tr>
            <tr>
              <th>Total</th><td>
                <?php 

             
              echo $total_ricksu=@(int)$ricksu['ricksu_repair_fee']+@(int)$ricksu['ricksu_repair_fee_tax']+@(int)$ricksu['ricksu_fee']+@(int)$ricksu['ricksu_fee_tax']+@(int)$ricksu['ricksu_charger_for_additional']+@(int)$ricksu['ricksu_charger_for_additional_tax'];
             ?>
              </td>
              <td>
               
            
            </tr>
    </table>
              </div>
            </div>
         

    
     <?php endif ?>

     <!-- -------------------------mini ricksy--------------------------------------- -->
          <?php if ($_REQUEST['type']=="mini_ricksu"): 
       
  $mini_ricksu=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT ricksu.*, ricksu_company.* FROM ricksu INNER JOIN ricksu_company ON ricksu.ricksu_company = ricksu_company.ricksu_company_id WHERE ricksu.ricksu_id = '".$_REQUEST['id']."' ")); 
      $c=0;
       $expense_mini_ricksu=fetchRecord($dbc,"expense_mini_ricksu","mini_ricksu_id",$_REQUEST['id']);
        @$customers=fetchRecord($dbc,"customers","customer_id",$expense_mini_ricksu['mini_ricksu_bank'])['customer_company'];
        $ric='paid_mini_ricksu_'.@$_REQUEST['id'];
             @$transactions=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM transactions  WHERE  transaction_from='$ric' AND vehicle_id = $vehicle_id"));
        
       ?>         

            <div class="row">
              <div class="col-sm-6">
                 <table class="table table-borderedless " style="width: 100%;">
                     <tr><th>Transaction ID</th><td>nj-<?=@$transactions['transaction_id']?></td></tr>
                <tr><th>Transaction Remarks</th><td><?=@$transactions['transaction_remarks']?></td></tr>   
                  <tr>
                    <th>Pickup Point</th><td><?=$mini_ricksu['ricksu_delievery_point']?></td>
                  </tr>
                  <tr>
                     <th>RICKSU Company</th><td><?=$mini_ricksu['ricksu_company_name']?></td>
                  </tr>
                 <tr>
             
              <th>Bank Name</th><td><?=@$customers?></td>
            </tr>
            <tr>
              
              <th>Bank Details</th><td><?=$expense_mini_ricksu['mini_ricksu_bank_details']?></td>
            </tr>
              </div>
            <tr>
              <th>Date</th><td><?=@$expense_mini_ricksu['mini_ricksu_date']?></td>
            </tr>
           </table> 
              <div class="col-sm-6">
                 <table class="table table-borderedless " style="width: 100%;">
      
            <tr>
              <th>Ricksu Fee</th><td><?=@$mini_ricksu['ricksu_fee']+$mini_ricksu['ricksu_fee_tax']?></td>
              
              
            </tr>
            
            <tr>
              <th>Total</th><td>
                <?php 

             
              echo $total_ricksu=@(int)$mini_ricksu['ricksu_fee']+@(int)$mini_ricksu['ricksu_fee_tax'];
             ?>
              </td>
              <td>
               
            
            </tr>
    </table>
              </div>
            </div>
         

    
     <?php endif ?>
     <!-- -------------------------mini ricksy--------------------------------------- -->
            <?php if ($_REQUEST['type']=="inspection"): 
       @$customers=fetchRecord($dbc,"customers","customer_id",$expense_account['inspection_bank'])['customer_company'];
       @$transactions=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM transactions  WHERE  transaction_from='paid_inspection' AND vehicle_id = $vehicle_id"));
        ?>         
       <div class="row">
         <div class="col-sm-6">
            <table class="table table-borderedless " style="width: 100%;">
                <tr><th>Transaction ID</th><td>nj-<?=@$transactions['transaction_id']?></td></tr>
                <tr><th>Transaction Remarks</th><td><?=@$transactions['transaction_remarks']?></td></tr> 
              
              <tr>
                 <th>Inspection Company</th><td><?=$inspection['inspection_company_name']?></td>
              </tr>
              <tr>
             
              <th>Bank Name</th><td><?=@$customers?></td>
            </tr>
             <tr>
             
              <th>Bank Details</th><td><?=$expense_account['auction_bank_details']?></td>
            </tr>
            <tr>
               <th>Date</th><td><?=@$expense_account['inspection_date']?></td>
            </tr>
           </table>
         </div>
         <div class="col-sm-6">
            <table class="table table-borderedless " style="width: 100%;">

        <tr>
              <th>Inspection Charges</th><td><?=@$inspection['inspection_info_charges']+@$inspection['inspection_info_charges_tax']?></td>
              
              
            </tr>
            <tr>
              <th>Repair Charges</th><td><?=@$inspection['inspection_info_repair_charges']+@$inspection['inspection_info_repair_charges_tax']?></td>
            
              
            </tr>
            <tr>
              <th>Re Inspection fee</th><td><?=@$inspection['inspection_info_reinspection1']+@$inspection['Inspection_info_reinspection1_tax']?></td></tr>
            <tr>
              <th>Ricksu Fee/Tax</th><td><?=@$inspection['inspection_info_ricksu1']+@$inspection['inspection_info_ricksu1_tax']?></td>
            </tr>
            
        <tr>
              <th>Total</th><td>
                <?php 

              echo $total_inspection=@(int)$inspection['inspection_info_charges']+@(int)$inspection['inspection_info_charges_tax']+@(int)$inspection['inspection_info_repair_charges']+@(int)$inspection['inspection_info_repair_charges_tax']+@(int)$inspection['inspection_info_reinspection1']+@(int)$inspection['Inspection_info_reinspection1_tax']+@(int)$inspection['inspection_info_ricksu1']+@(int)$inspection['inspection_info_ricksu1_tax'];
             ?>
              </td>
             
            </tr>
    </table>
         </div>
       </div>
            
         

     <?php endif ?>
  
                <?php if ($_REQUEST['type']=="shipment"): 
       @$customers=fetchRecord($dbc,"customers","customer_id",$expense_account['shipment_bank'])['customer_company'];
       @$transactions=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM transactions  WHERE  transaction_from='paid_shipment' AND vehicle_id = $vehicle_id"));
        ?>         
       <div class="row">
         <div class="col-sm-6">
           <table class="table table-borderedless " style="width: 100%;">
            <tr><th>Transaction ID</th><td>nj-<?=@$transactions['transaction_id']?></td></tr>
                <tr><th>Transaction Remarks</th><td><?=@$transactions['transaction_remarks']?></td></tr>
            <tr>
              <th>Shipper Name</th><td><?=@$shipment['shipper_name']?></td>
            </tr>
               <tr>
              <th>Shipping Company</th><td><?=@$shipment['shipment_company_name']?></td>
              
              
            </tr>
            <tr><th>Bank Name</th><td><?=@$customers?></td></tr>
            <tr>
              <th>Date</th><td><?=@$expense_account['shipment_date']?></td>
            </tr>
             <tr>
              
              <th>Bank Details</th><td colspan="2"><?=$expense_account['auction_bank_details']?></td>
            </tr>
           </table>
         </div>
         <div class="col-sm-6">
           
         <table class="table table-borderedless " style="width: 100%;">
           
       
          
        <tbody>
          <tr>
            <th>BL Charges</th><td><?=@$vehicle_info['vehicle_bl_charges']+@$vecicle_info['vehicle_bl_charges_tax']?></td>
           
          </tr>
          <tr>
            <th>Radiaton Check Charges</th><td><?=@(int)$shipment['radiation_charges']+@(int)$shipment['radiation_charges_tax']?></td>
            
          </tr>
          <tr>
            <th>Freight Charges</th><td><?=@$vehicle_info['vehicle_freight_charges']+@$vehicle_info['vehicle_freight_charges_tax']?></td>
           
          </tr>
          <tr>
            <th>Terminal Handling Charges</th><td><?=@(int)$vehicle_info['vehicle_terminal_charges']+@(int)$vehicle_info['vehicle_terminal_charges_tax']?></td>
          </tr>
          <tr>
            <th>Heat Treatment Charges</th><td><?=@(int)$shipment['heat_charges']+@(int)$shipment['heat_charges_tax']?></td>
          </tr>
          <tr>
            <th>Other Charges</th><td><?=@(int)$shipment['other_charges']+@(int)$shipment['other_charges_tax']?></td>
          </tr>
          <tr>
            <th>Shiping Charges</th><td><?=@(int)$shipment['shipping_charges']+@(int)$shipment['shipping_charges_tax']?></td>
          </tr>
          <tr>
            <th>Shiping Charges</th><td><?=@(int)$shipment['shipping_charges']+@(int)$shipment['shipping_charges_tax']?></td>
          </tr>
           <tr>
              <th>Total</th><td>
                <?php 

              echo $total_shipment=@(int)$vehicle_info['vehicle_bl_charges']+@(int)$vecicle_info['vehicle_bl_charges_tax']+@(int)$shipment['radiation_charges']+@(int)$shipment['radiation_charges_tax']+@(int)$vehicle_info['vehicle_freight_charges']+@(int)$vehicle_info['vehicle_freight_charges_tax']+@(int)$vehicle_info['vehicle_terminal_charges']+@(int)$vehicle_info['vehicle_terminal_charges_tax']+@(int)$shipment['heat_charges']+@(int)$shipment['heat_charges_tax']+@(int)$shipment['other_charges']+@(int)$shipment['other_charges_tax']+@(int)$shipment['shipping_charges']+@(int)$shipment['shipping_charges_tax'];
             ?>
              </td>
          
            </tr>
        </tbody>      
   
          
         </table>
         </div>
       </div>
            
         

     <?php endif ?>

                <?php if ($_REQUEST['type']=="airmail"): 
       @$customers=fetchRecord($dbc,"customers","customer_id",$expense_account['airmail_bank'])['customer_company'];
       @$transactions=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM transactions  WHERE  transaction_from='paid_airmail' AND vehicle_id = $vehicle_id"));
        ?>         
       <div class="row">
         <div class="col-sm-6">
           <table class="table table-borderedless " style="width: 100%;">
             <tr><th>Transaction ID</th><td>nj-<?=@$transactions['transaction_id']?></td></tr>
                <tr><th>Transaction Remarks</th><td><?=@$transactions['transaction_remarks']?></td></tr>
            <tr>
               <th>Consignee Name</th><td><?=$airmail['consignee_name']?></td>
            </tr>
            <tr>
             <th>Company</th><td><?=$airmail['services_company_name']?></td>
              
            </tr>
            <tr>
              <th>Bank Name</th><td><?=@$customers?></td>
            </tr>
            <tr>
              <th>Date</th><td><?=@$expense_account['airmail_date']?></td>
            </tr>
               <tr>
                 
              <th>Bank Details</th><td colspan="2"><?=$expense_account['auction_bank_details']?></td>
            </tr>
         
           </table>
         </div>
         <div  class="col-sm-6">
           <table class="table table-borderedless " style="width: 100%;">
            <tr>
              <th>Courier Charges</th><td><?=@(int)$airmail['airmail_courier_charges']+@(int)$airmail['airmail_courier_charges_tax']?></td>
              
            
            </tr>
              <tr>
              <th>Total</th><td>
                <?php 

              echo $total_airmail=@(int)$airmail['airmail_courier_charges']+@(int)$airmail['airmail_courier_charges_tax'];
             ?>
              </td>
              
            
            </tr>
          </table>
         </div>
       </div>     
          
       
     <?php endif ?>
                    <?php if ($_REQUEST['type']=="services"): 
       @$customers=fetchRecord($dbc,"customers","customer_id",$expense_account['airmail_bank'])['customer_company'];
       @$transactions=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM transactions  WHERE  transaction_from='paid_airmail' AND vehicle_id = $vehicle_id"));
        ?>         
       <div class="row">
         <div class="col-sm-6">
           <table class="table table-borderedless " style="width: 100%;">
             <tr><th>Transaction ID</th><td>nj-<?=@$transactions['transaction_id']?></td>
                
             </tr>
             <tr>
               <th>Transaction Remarks</th><td><?=@$transactions['transaction_remarks']?></td>
             </tr>     
                       
            <tr>
               <th>Consignee Name</th><td><?=$airmail['consignee_name']?></td>

           
            
            </tr>
            <tr>
                <th>Company</th><td><?=$airmail['services_company_name']?></td>
              
            </tr>
            <tr>
              <th>Bank Name</th><td><?=@$customers?></td>

             
            
            </tr>
            <tr> <th>Date</th><td><?=@$expense_account['airmail_date']?></td></tr>
          
               <tr>
                 
              <th>Bank Details</th><td colspan="2"><?=$expense_account['auction_bank_details']?></td>
            </tr>
         
           </table>
         </div>
         <div  class="col-sm-6">
           <table class="table table-borderedless " style="width: 100%;"> 
              <tr>
               <th>Name </th><th>Amount</th><th>Tax</th>
              </tr>
            <?php   
            $servicesQ=getWhere($dbc,"vehicle_expense","vehicle_info_id",$vehicle_id); $c=0; $total=0; $total_tax=0;
            $vehicle_services_amount=$c=0;
            if (mysqli_num_rows($servicesQ)>0):
              while ($fetch_expense=mysqli_fetch_assoc($servicesQ)):
                  $total+=$fetch_expense['vehicle_expense_amount'];
                    $total_tax+=$fetch_expense['vehicle_expense_tax'];
                    ?>
            <tr>
      <td><?=$fetch_expense['vehicle_expense_name']?></td>
      <td><?=$fetch_expense['vehicle_expense_amount']?></td>
      <td><?=$fetch_expense['vehicle_expense_tax'];?></td>
            </tr>
       <?php  endwhile;  $grand=$total+$total_tax; endif;  ?>
          <tr style="border-top: 1px solid black;">
           <th colspan="2">Total</th><th><?=$grand?></th>
          </tr></table>
         </div>
       </div>     
          
       
     <?php endif ?>
  </div>

  

</div><!-- end row -->



<div class="row"></div>



<div cass="row">

	<div class="col-sm-12">

		<h5 style="text-align: center">NEXCO JAPAN LTD CO</h5>

		<p style="text-align: center;color: black">Should you have any enquiries concerning this invoice, please contact</p>

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