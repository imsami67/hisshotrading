
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


  $tableStart='<!DOCTYPE html>

<html lang="en">

  <head>

    <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  </head>

  <body style="background-color: #f2fafc;">

    <table align="center"  cellspacing="0" cellpadding="10" >

      



      <tr>



        <th style="padding-right: 20px;"><img src="https://nexcojapan.com/admin/img/logo.png" alt="" height="80" width="80"></th>

        <th style="font-family: Nunito, Arial, Helvetica Neue, Helvetica; font-size: 24px;">NEXCO COMAPANY LTD</th>

      </tr>

    </table>

    <table align="center" cellspacing="0" width="600"  cellpadding="10" style="background-color: #fff; border-radius: 15px;">

      <tr>

        <th colspan="4" align="center"><h3>Vehicle Information</h3></th>

      </tr>


                          <tr>
                            <th>Vehicle Name</th>
                            <td>'.@$maker['maker_name'].' '.@$brands['brand_name'].'</td>
                            <th>Chassis No</th>
                            <td>'.@$vehicle_info['vehicle_chassis_no'].'</td>

                          </tr>
                          <tr>
                            <th>Stock ID</th>
                            <td>'.@$vehicle_info['vehicle_stock_id'].'</td>
                            <th>Engine No.</th>
                            <td>'.@$vehicle_info['vehicle_engine_no'].'</td>

                          </tr>
                         <tr>
                            <th>Manufacture Date</th>
                            <td>'.@$vehicle_info['vehicle_manu_month'].'-'.@$vehicle_info['vehicle_manu_year'].'</td>
                            <th>Registration Year</th>
                            <td>'.@$vehicle_info['vehicle_reg_month'].'-'.@$vehicle_info['vehicle_reg_year'].'</td>

                          </tr>';
    $tableEnd='    </table>
  </body>

</html>'
    ?>



                          
<?php if ($_REQUEST['type']=="auction"): 
  $customers=fetchRecord($dbc,"customers","customer_id",$expense_account['auction_bank'])['customer_company']; 
  $transactions=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM transactions  WHERE  transaction_from='paid_auction' AND vehicle_id = $vehicle_id"));
  $email=$auction['auction_email'];
  ?>
   <?php 
                $mainbody='<tr>

                  <th colspan="4" align="center"><h3>Paid Auction Information</h3></th>
                </tr>
                <tr><th>Transaction ID</th><td>nj-'.$transactions['transaction_id'].'</td>
                    <th>Win Price</th><td>'.(@(int)$auction['auction_win_price']+@(int)$auction['auction_win_price_tax']).'</td>
              
              
                </tr>
                  <tr><th>Transaction Remarks</th><td>'.$transactions['transaction_remarks'].'</td>
                     <th>Recycle Fee</th><td>'.(@(int)$auction['auction_recycle_fee']+@(int)$auction['auction_recycle_fee_tax']).'</td>
             
    
                  </tr>
                <tr><th>Auction House</th><td>'.$auction['auction_home_name'].'</td>
                    <th>Auction Fee</th><td>'.(@(int)$auction['auction_fee']+@(int)$auction['auction_fee_tax']).'</td>
            
                </tr>
                <tr><th>Company Name</th><td>'.$auction['company_name'].'</td>
                  <th>Total</th><td>'.(@(int)$auction['auction_win_price']+@(int)$auction['auction_win_price_tax']+@(int)$auction['auction_fee']+@(int)$auction['auction_fee_tax']+@(int)$auction['auction_recycle_fee']+@(int)$auction['auction_recycle_fee_tax']).'</td>
                 
                </tr>
                <tr><th>Bank Name</th><td>'.$customers.'</td></tr>
               <tr><th>Bank Details</th><td>'.$expense_account['auction_bank_details'].'</td></tr>';
              
 ?>
           <?php endif ?>   

<?php if ($_REQUEST['type']=="person"): 
       @$customers=fetchRecord($dbc,"customers","customer_id",$expense_account['person_bank'])['customer_company']; 
       @$transactions=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM transactions  WHERE  transaction_from='paid_person' AND vehicle_id = $vehicle_id"));
        @$customer_name=fetchRecord($dbc,"customers","customer_id",$person['customer_id']);
          $email=$customer_name['customer_email'];
             
$mainbody='
             <tr>

                  <th colspan="4" align="center"><h3>Paid Person Information</h3></th>
                </tr>

                  <tr><th>Transaction ID</th><td>nj-'.@$transactions['transaction_id'].'</td>
                  <th>Bying Price</th><td>'.(@$person['buyingprice']+@$person['buyingprice_tax']).'</td>
              
                  </tr>
                <tr><th>Transaction Remarks</th><td>'.@$transactions['transaction_remarks'].'</td>
                <th>Commission</th><td>'.(@$person['commission']+@$person['commission_tax']).'</td>
         </tr>            
                    <tr>
                      <th>Auction House</th><td>'.$auction['auction_home_name'].'</td>
                       <th>Recycle Fee</th><td>'.(@$person['recycle_fee']+@$person['recycle_fee_tax']).'</td>
                    </tr>
                    <tr>
                      <th>Customer Name</th><td>'.$customer_name['customer_name'].'</td>
                       <th>Total</th><td>'.(@(int)$person['buyingprice']+@(int)$person['buyingprice_tax']+@(int)$person['commission']+@(int)$person['commission_tax']+@(int)$person['recycle_fee']+@(int)$person['recycle_fee_tax']).'
              </td>
                    </tr>
                     <tr>
                       <th>Bank Name</th><td>'.$customers.'</td>
                     </tr>
                     <tr>
                        <th>Date</th><td>'.$expense_account['date_person'].'</td>
                     </tr>
                     <tr>
                        <th>Bank Details</th><td>'.$expense_account['auction_bank_details'].'</td>
                     </tr>
            ';
       
     endif ?>
             <?php if ($_REQUEST['type']=="mini_ricksu"): 
      $mini_ricksu=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT ricksu.*, ricksu_company.* FROM ricksu INNER JOIN ricksu_company ON ricksu.ricksu_company = ricksu_company.ricksu_company_id WHERE ricksu.ricksu_id = '".$_REQUEST['id']."' ")); 
      $c=0;
       $expense_mini_ricksu=fetchRecord($dbc,"expense_mini_ricksu","mini_ricksu_id",$_REQUEST['id']);
        @$customers=fetchRecord($dbc,"customers","customer_id",$expense_mini_ricksu['mini_ricksu_bank'])['customer_company'];
        $ric='paid_mini_ricksu_'.@$_REQUEST['id'];
             @$transactions=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM transactions  WHERE  transaction_from='$ric' AND vehicle_id = $vehicle_id"));
       $email=$mini_ricksu['ricksu_company_email'];
       $mainbody='
        <tr>

                  <th colspan="4" align="center"><h3>Paid Mini Ricksu Information</h3></th>
                </tr>
                     <tr><th>Transaction ID</th><td>nj-'.@$transactions['transaction_id'].'</td>
                        <th>Ricksu Fee</th><td>'.(@(int)$mini_ricksu['ricksu_fee']+@(int)$mini_ricksu['ricksu_fee_tax']).'</td>
            
                     </tr>
                <tr><th>Transaction Remarks</th><td>'.@$transactions['transaction_remarks'].'</td>
                  <th>Total</th><td>'.(@(int)$ricksu['ricksu_fee']+@(int)$mini_ricksu['ricksu_fee_tax']).'
                
              </td>
              
                </tr>   
                  <tr>
                    <th>Pickup Point</th><td>'.$mini_ricksu['ricksu_delievery_point'].'</td>
                   
                  </tr>
                  <tr>
                     <th>RICKSU Company</th><td>'.$mini_ricksu['ricksu_company_name'].'</td>
                      
              <td>
                  </tr>
                 <tr>
             
              <th>Bank Name</th><td>'.@$customers.'</td>
            </tr>
            <tr>
              
              <th>Bank Details</th><td>'.$expense_mini_ricksu['mini_ricksu_bank_details'].'</td>
            </tr>
            <tr>
              <th>Date</th><td>'.@$expense_mini_ricksu['mini_ricksu_date'].'</td>
            </tr>';
           endif ?>


             <?php if ($_REQUEST['type']=="ricksu"): 
       @$customers=fetchRecord($dbc,"customers","customer_id",$expense_account['ricksu_bank'])['customer_company']; 
       @$transactions=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM transactions  WHERE  transaction_from='paid_ricksu' AND vehicle_id = $vehicle_id"));
       $email=$ricksu['ricksu_company_email'];
       $mainbody='
        <tr>

                  <th colspan="4" align="center"><h3>Paid Ricksu Information</h3></th>
                </tr>
                     <tr><th>Transaction ID</th><td>nj-'.@$transactions['transaction_id'].'</td>
                        <th>Repair Fee</th><td>'.(@(int)$ricksu['ricksu_repair_fee']+@(int)$ricksu['ricksu_repair_fee_tax']).'</td>
            
                     </tr>
                <tr><th>Transaction Remarks</th><td>'.@$transactions['transaction_remarks'].'</td>
                  <th>Ricksu Fee</th><td>'.(@(int)$ricksu['ricksu_fee']+@(int)$ricksu['ricksu_fee_tax']).'</td>
              
                </tr>   
                  <tr>
                    <th>Loading Point</th><td>'.$ricksu['ricksu_loading_point'].'</td>
                     <th>Charges For Additional Services</th><td>'.(@(int)$ricksu['ricksu_charger_for_additional']+@(int)$ricksu['ricksu_charger_for_additional_tax']).'</td>
                  </tr>
                  <tr>
                     <th>RICKSU Company</th><td>'.$ricksu['ricksu_company_name'].'</td>
                      <th>Total</th><td>'.(@(int)$ricksu['ricksu_repair_fee']+@(int)$ricksu['ricksu_repair_fee_tax']+@(int)$ricksu['ricksu_fee']+@(int)$ricksu['ricksu_fee_tax']+@(int)$ricksu['ricksu_charger_for_additional']+@(int)$ricksu['ricksu_charger_for_additional_tax']).'
                
              </td>
              <td>
                  </tr>
                 <tr>
             
              <th>Bank Name</th><td>'.@$customers.'</td>
            </tr>
            <tr>
              
              <th>Bank Details</th><td>'.$expense_account['ricksu_bank_details'].'</td>
            </tr>
            <tr>
              <th>Date</th><td>'.@$expense_account['ricksu_date'].'</td>
            </tr>';
           endif ?>

    
          <?php if ($_REQUEST['type']=="inspection"): 
       @$customers=fetchRecord($dbc,"customers","customer_id",$expense_account['inspection_bank'])['customer_company'];
       @$transactions=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM transactions  WHERE  transaction_from='paid_inspection' AND vehicle_id = $vehicle_id"));
       $email=$inspection['inspection_email'];
       $mainbody='
        <tr>

                  <th colspan="4" align="center"><h3>Paid Inspection Information</h3></th>
                </tr>
                <tr><th>Transaction ID</th><td>nj-'.@$transactions['transaction_id'].'</td>
                   <th>Inspection Charges</th><td>'.(@(int)$inspection['inspection_info_charges']+@(int)$inspection['inspection_info_charges_tax']).'</td>
                </tr>
                <tr><th>Transaction Remarks</th><td>'.@$transactions['transaction_remarks'].'</td>
                   <th>Repair Charges</th><td>'.(@(int)$inspection['inspection_info_repair_charges']+@(int)$inspection['inspection_info_repair_charges_tax']).'</td>
                </tr> 
              
              <tr>
                 <th>Inspection Company</th><td>'.$inspection['inspection_company_name'].'</td>
                  <th>Re Inspection fee</th><td>'.(@(int)$inspection['inspection_info_reinspection1']+@(int)$inspection['Inspection_info_reinspection1_tax']).'</td>
              </tr>
              <tr>
             
              <th>Bank Name</th><td>'.@$customers.'</td>
              <th>Ricksu Fee/Tax</th><td>'.(@(int)$inspection['inspection_info_ricksu1']+@(int)$inspection['inspection_info_ricksu1_tax']).'</td>
            </tr>
             <tr>
             
              <th>Bank Details</th><td>'.@$expense_account['auction_bank_details'].'</td>
               <th>Total</th><td>'.(@(int)$inspection['inspection_info_charges']+@(int)$inspection['inspection_info_charges_tax']+@(int)$inspection['inspection_info_repair_charges']+@(int)$inspection['inspection_info_repair_charges_tax']+@(int)$inspection['inspection_info_reinspection1']+@(int)$inspection['Inspection_info_reinspection1_tax']+@(int)$inspection['inspection_info_ricksu1']+@(int)$inspection['inspection_info_ricksu1_tax']).'</td>
            </tr>
            <tr>
               <th>Date</th><td>'.@$expense_account['inspection_date'].'</td>
            </tr>';
           endif ?>



 
                <?php if ($_REQUEST['type']=="shipment"): 
       @$customers=fetchRecord($dbc,"customers","customer_id",$expense_account['shipment_bank'])['customer_company'];
       @$transactions=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM transactions  WHERE  transaction_from='paid_shipment' AND vehicle_id = $vehicle_id"));
        $email=$shipment['shipment_company_email'];
              $email2=$shipment['shipper_email'];
        $mainbody='
         <tr>

                  <th colspan="4" align="center"><h3>Paid Shipment Information</h3></th>
                </tr>
            <tr><th>Transaction ID</th><td>nj-'.@$transactions['transaction_id'].'</td>
               <th>BL Charges</th><td>'.(@(int)$vehicle_info['vehicle_bl_charges']+@(int)$vecicle_info['vehicle_bl_charges_tax']).'</td>
           
            </tr>
                <tr><th>Transaction Remarks</th><td>'.@$transactions['transaction_remarks'].'</td>
                   <th>Radiaton Check Charges</th><td>'.(@(int)$shipment['radiation_charges']+@(int)$shipment['radiation_charges_tax']).'</td>
           
                </tr>
            <tr>
              <th>Shipper Name</th><td>'.@$shipment['shipper_name'].'</td>
               <th>Freight Charges</th><td>'.(@(int)$vehicle_info['vehicle_freight_charges']+@(int)$vehicle_info['vehicle_freight_charges_tax']).'</td>
           
            </tr>
               <tr>
              <th>Shipping Company</th><td>'.@$shipment['shipment_company_name'].'</td>
              <th>Terminal Handling Charges</th><td>'.(@(int)$vehicle_info['vehicle_terminal_charges']+@(int)$vehicle_info['vehicle_terminal_charges_tax']).'</td>
              
              
            </tr>
            <tr><th>Bank Name</th><td>'.@$customers.'</td>
              <th>Heat Treatment Charges</th><td>'.(@(int)$shipment['heat_charges']+@(int)$shipment['heat_charges_tax']).'</td>
          
            </tr>
            <tr>
              <th>Date</th><td>'.@$expense_account['shipment_date'].'</td>
              <th>Shiping Charges</th><td>'.(@(int)$shipment['shipping_charges']+@(int)$shipment['shipping_charges_tax']).'</td>
          
            </tr>
             <tr>
              
              <th>Bank Details</th><td rowspan="1">'.$expense_account['auction_bank_details'].'</td>
              <th>Shiping Charges</th><td>'.(@(int)$shipment['shipping_charges']+@(int)$shipment['shipping_charges_tax']).'</td>
          
            </tr>
            <tr>
              <td colspan="2" ></td>
              <th>Total</th><td>'.(@(int)$vehicle_info['vehicle_bl_charges']+@(int)$vecicle_info['vehicle_bl_charges_tax']+@(int)$shipment['radiation_charges']+@(int)$shipment['radiation_charges_tax']+@(int)$vehicle_info['vehicle_freight_charges']+@(int)$vehicle_info['vehicle_freight_charges_tax']+@(int)$vehicle_info['vehicle_terminal_charges']+@(int)$vehicle_info['vehicle_terminal_charges_tax']+@(int)$shipment['heat_charges']+@(int)$shipment['heat_charges_tax']+@(int)$shipment['other_charges']+@(int)$shipment['other_charges_tax']+@(int)$shipment['shipping_charges']+@(int)$shipment['shipping_charges_tax']).'</td>
          
            </tr>'; endif ?>

                <?php if ($_REQUEST['type']=="airmail"): 
       @$customers=fetchRecord($dbc,"customers","customer_id",$expense_account['airmail_bank'])['customer_company'];
       @$transactions=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM transactions  WHERE  transaction_from='paid_airmail' AND vehicle_id = $vehicle_id"));

        $email=$airmail['services_company_email'];
        $mainbody='
             <tr>

                  <th colspan="4" align="center"><h3>Paid Arimail Information</h3></th>
                </tr>

             <tr><th>Transaction ID</th><td>nj-'.@$transactions['transaction_id'].'</td>
                 <th>Courier Charges</th><td>'.(@(int)$airmail['airmail_courier_charges']+@(int)$airmail['airmail_courier_charges_tax']).'</td>
             </tr>
                <tr><th>Transaction Remarks</th><td>'.@$transactions['transaction_remarks'].'</td>
                  <th>Total</th><td>'.(@(int)$airmail['airmail_courier_charges']+@(int)$airmail['airmail_courier_charges_tax']).'
              </td>
              
                </tr>
            <tr>
               <th>Consignee Name</th><td>'.$airmail['consignee_name'].'</td>
            </tr>
            <tr>
             <th>Company</th><td>'.$airmail['services_company_name'].'</td>
              
            </tr>
            <tr>
              <th>Bank Name</th><td>'.@$customers.'</td>
            </tr>
            <tr>
              <th>Date</th><td>'.@$expense_account['airmail_date'].'</td>
            </tr>
               <tr>
                 
              <th>Bank Details</th><td colspan="2">'.$expense_account['auction_bank_details'].'</td>
            </tr>';
         
          endif; ?>
           <?php if ($_REQUEST['type']=="services"): 
       @$customers=fetchRecord($dbc,"customers","customer_id",$expense_account['airmail_bank'])['customer_company'];
       @$transactions=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM transactions  WHERE  transaction_from='paid_services' AND vehicle_id = $vehicle_id"));
                
      $body1='
        <th colspan="4" align="center"><h3>Paid Vehicle Services Information</h3></th>
             <tr><th >Transaction ID</th><td >nj-'.@$transactions['transaction_id'].'</td>
               <th >Transaction Remarks</th><td >'.@$transactions['transaction_remarks'].'</td>
             
                
             </tr>
                 
            <tr>
               <th>Consignee Name</th><td>'.$airmail['consignee_name'].'</td>
               <th >Company</th><td colspan="3">'.$airmail['services_company_name'].'</td>

           
            
            </tr>
            <tr>
              <th >Bank Name</th><td>'.@$customers.'</td>
                 <th>Date</th><td colspan="3">'.@$expense_account['airmail_date'].'</td>
             
            
            </tr>
          
               <tr>
                 
              <th >Bank Details</th><td colspan="2">'.$expense_account['auction_bank_details'].'</td>
            </tr>
                <th colspan="4" align="center"><h3> Vehicle Expense </h3></th>
              <tr>
                <th colspan="2" align="left">  Name</th><th align="left">Amount</th><th align="left">Tax</th>
              </tr>
            ';
         $body2='';
      $servicesQ=getWhere($dbc,"vehicle_expense","vehicle_info_id",$vehicle_id); $c=0; $total=0; $total_tax=0;
            $vehicle_services_amount=$c=0;
            if (mysqli_num_rows($servicesQ)>0):
              while ($fetch_expense=mysqli_fetch_assoc($servicesQ)):
                  $total+=$fetch_expense['vehicle_expense_amount'];
                    $total_tax+=$fetch_expense['vehicle_expense_tax'];
        
          $body2.=' <tr>  
          <td colspan="2">'.$fetch_expense['vehicle_expense_name'].'</td>
      <td >'.$fetch_expense['vehicle_expense_amount'].'</td>
      <td >'.$fetch_expense['vehicle_expense_tax'].'</td></tr>';
         endwhile;  $grand=$total+$total_tax; endif; 
          $body3='<tr style="border-top: 1px solid black;">
            <th colspan="3" align="left">Total</th><th align="left">'.$grand.'</th>
          </tr>';  
          $mainbody=$body1." ".$body2." ".$body3;
    endif ?>
     
<?php  echo $body= $tableStart."  ".$mainbody."".$tableEnd; 

$headers = "MIME-Version: 1.0\r\n";



$headers = "Content-type: text/html; charset=ISO-8859-1";



if (mail($email,'paid auction slip',$body,$headers)) {

    echo "Email successfully sent to ".$email."... ";
    ?><script type="text/javascript">
      setTimeout(function(){ window.close(); }, 3000);
    </script><?php 

} else {

    echo "Email sending failed to ".$email."... ";



}

?>