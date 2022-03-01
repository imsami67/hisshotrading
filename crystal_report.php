<?php 
include_once 'php_action/db_connect.php';
include_once 'inc/functions.php';
// if($dbc){
// 	echo "connected";
// }else{
// 	echo mysqli_error($query);
// }
$v_id=$_GET['v_id'];
$q=mysqli_query($dbc,"SELECT * FROM vehicle_info WHERE vehicle_id=$v_id ;");
$f=mysqli_fetch_assoc($q);
$makers=fetchRecord($dbc,"maker","maker_id",$f['vehicle_maker']);
$brands=fetchRecord($dbc,"brands","brand_id",$f['vehicle_brand']);
$type=fetchRecord($dbc,"body_type","body_type_id",$f['vehicle_type']);

 ?>

<html>
<head>
	<title></title>
	<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  font-size: 12px;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}
tr:nth-child(even) {
  background-color: #dddddd;
}
th,td{
  text-transform:capitalize;;
}
</style>
</head>
<body>
<h3>Veicle Info</h3>
<table>
  <tr>
    <th>Index</th>
    <th>Detail</th>
    <th>Index</th>
    <th>Detail</th>
    <th>Index</th>
    <th>Detail</th>
    <th>Index</th>
    <th>Detail</th>
  </tr>
  <tr>
    <td>Vehicle ID</td>
    <td><?=$f['vehicle_id']?></td>
     <td>stock ID</td>
    <td><?=$f['vehicle_stock_id']?></td>

    <td>type</td>
    <td><?=@$type['body_type_name']?></td>
  
     <td>engine no</td>
    <td><?=$f['vehicle_engine_no']?></td>
    </tr>
   
  <tr>
      <td>Manu. year</td>
    <td><?=$f['vehicle_manu_year']?></td>
      <td>reg year</td>
    <td><?=$f['vehicle_reg_year']?></td>
   
      <td>Reg month</td>
    <td><?=$f['vehicle_reg_month']?></td>
    <td>Manu. month</td>
    <td><?=$f['vehicle_manu_month']?></td>
  </tr>
   <tr>
     <td>maker</td>
    <td><?=$makers['maker_name']?></td>
    <td>brand</td>
    <td><?=$brands['brand_name']?></td>
    <td>chassis no</td>
    <td style="text-transform: uppercase;"><?=$f['vehicle_chassis_no']?></td>
     <td>chassis code</td>
    <td><?=$f['vehicle_chassis_code']?></td>
  </tr>
  <tr>
      <td>transmission</td>
    <td><?=$f['vehicle_transmission']?></td>
    <td>exterior grade</td>
    <td><?=$f['vehicle_exterior']?></td>
      <td>interior grade</td>
    <td><?=$f['vehicle_interior']?></td>
      <td>package</td>
    <td><?=$f['vehicle_package']?></td>
  </tr>
  <tr>
    <td>access</td>
    <td style="text-transform: uppercase;"><?=$f['vehicle_access']?></td>
        <td>door</td>
    <td><?=$f['vehicle_door']?></td>

          <td>color name</td>
    <td><?=$f['vehicle_color_name']?></td>
    <td>option</td>
    <td><?=$f['vehicle_option']?></td>
  </tr>
  <tr>
    <td>mode</td>
    <td><?=$f['vehicle_mode']?></td>
   <td>seat</td>
    <td><?=$f['vehicle_seat']?></td>

  <td>color</td>
    <td style="text-transform: uppercase;"><?=$f['vehicle_color']?></td>
        <td>interior color</td>
    <td><?=$f['vehicle_interior_color']?></td>
  </tr>
  <tr>
     <td>length</td>
    <td><?=$f['vehicle_length']?></td>
    <td>width</td>
    <td><?=$f['vehicle_width']?></td>
    <td>height</td>
    <td><?=$f['vehicle_height']?></td>
        <td>weight</td>
    <td><?=$f['vehicle_weight']?></td>

  </tr>
  <tr>
    <td>grade</td>
    <td style="text-transform: uppercase;"><?=$f['vehicle_grade']?></td>
     <td>loading caacity</td>
    <td><?=$f['vehicle_loading_capacity']?></td>
    <td>M3</td>
    <td><?=$f['vehicle_m3']?></td>

     <td>KM</td>
    <td><?=$f['vehicle_km']?></td>
  </tr>
  <tr>
    <td>Estimated price</td>
    <td><?=$f['vehicle_est_price']?></td>
       <td>discount</td>
    <td><?=$f['vehicle_discount']?></td>
     <td>note</td>
    <td><?=$f['vehicle_note']?></td>
     <td>KM2</td>
    <td><?=$f['vehicle_km2']?></td>
  </tr>
  <!-- --------------- -->
    <tr>
    <td>CC</td>
    <td><?=$f['vehicle_cc']?></td>
    <td>drive</td>
    <td><?=$f['vehicle_drive']?></td>
    <td>Engine type</td>
    <td><?=$f['vehicle_engine_type']?></td>
    <td>fuel</td>
    <td><?=$f['vehicle_fuel']?></td>
   </tr>
    <tr>
    <td>Vehicle features</td>
     <td colspan="7">
       <?php 
       if (!empty($f['vehicle_feature_list'])) {
         # code...
       
        foreach (json_decode($f['vehicle_feature_list']) as  $value){
          echo $value.",";
          }
          }
          ?> 
     </td>
   </tr>
    
 
</table>
<?php 
@$q1=mysqli_query($dbc,"SELECT * FROM auction_info WHERE vehicle_id=$v_id ;");
@$a=mysqli_fetch_assoc($q1);
@$auction_home=fetchRecord($dbc,"auction_home","auction_home_id",$a['auction_house']);
@$bidders=fetchRecord($dbc,"bidders","bidders_id",$a['auction_bidder']);
 ?>
<h3>Auction Info</h3>
<table>
  <tr>
    <th>Index</th>
    <th>Detail</th>
    <th>Index</th>
    <th>Detail</th>
    <th>Index</th>
    <th>Detail</th>
    <th>Index</th>
    <th>Detail</th>
  </tr>
  <tr>
    <td>auction house</td>
    <td><?=@$auction_home['auction_home_name']?></td>
    <td>POS Nmmber</td>
    <td><?=@$a['pos_number']?></td>
    <td>Payment Deadline</td>
    <td><?=@$a['auction_deadline']?></td>
    <td>bidder name</td>
    <td><?=@$bidders['bidders_name']?></td>
</tr>
  <tr>
    <td>Security Deposit</td>
    <td><?=@$auction_home['security_deposit']?></td>
    <td>start price</td>
    <td><?=@$a['auction_start_price']?></td>
     <td>recycle fee</td>
    <td><?=@$a['auction_recycle_fee']?></td>
    <td>Turn</td>
    <td><?=@$a['auction_turn']?></td>
    </tr>
  <tr>
  	 <td>Bid Type</td>
    <td><?=@$a['auction_house_type']?></td>
  	<td>win price</td>
    <td><?=@$a['auction_win_price']?></td>
    <td>transport due date</td>
    <td><?=@$a['auction_transport_due_date']?></td>
    <td>win by</td>
    <td><?=@$a['auction_win_by']?></td>
  
  </tr>
  <tr>
  	<td>auction date</td>
    <td><?=@$a['auction_date']?></td>
  	  <td>auction fee</td>
    <td><?=@$a['auction_fee']?></td>
    
    <td>note</td>
    <td colspan="3"><?=@$a['auction_note']?></td>
  </tr>
 </table>
 <?php 
 $c=0;
$q2=mysqli_query($dbc,"SELECT * FROM reservation WHERE vehicle_id=$v_id ;");
while ($r=mysqli_fetch_assoc($q2)):
  $c++;
$user=fetchRecord($dbc,"users","user_id",@$r['reservation_by']);
$customers=fetchRecord($dbc,"customers","customer_id",@$r['reservation_customer']);
 ?>
<h3>Reservation <?=$c?></h3>
<table>
  <tr>
    <th>Index</th>
    <th>Detail</th>
    <th>Index</th>
    <th>Detail</th>
    <th>Index</th>
    <th>Detail</th>
    <th>Index</th>
    <th>Detail</th>
     <th>Index</th>
    <th>Detail</th>
  </tr>
  <tr>
    <td>Reserved By</td>
    <td><?=@$user['username']?></td>
    <td>customer name</td>
    <td><?=@$customers['customer_name']?></td>
    <td>reservation start date</td>
    <td><?=$r['reservation_start_date']?></td>
    <td>payement term</td>
    <td><?=$r['reservation_payement']?></td>

         <td>Sold Price</td>
    <td><?=$r['reservation_sold_price']?></td>
    </tr>
  <tr>

  	<td>reservation date</td>
    <td><?=$r['reservation_date']?></td>
    <td>reservation expiry date</td>
    <td><?=$r['reservation_expiry_date']?></td>
    <td>Que No.</td>
    <td><?=$r['reservation_que']?></td>
    <td>status</td>
    <td><?=($r['reservation_sts']==1)?"active":"inactive";?></td>

  </tr>
  <tr>
    <td>Note</td><td colspan="9"><?=$r['reservation_note']?></td>
   
  </tr>
   </table>
<?php endwhile; ?>

  <?php 
$q3=mysqli_query($dbc,"SELECT * FROM ricksu WHERE vehicle_id=$v_id");
$ricksu=mysqli_fetch_assoc($q3);
$ricksu_loading_point=fetchRecord($dbc,"riksu_transportation","auction_house_name",$ricksu['ricksu_loading_point']);
$ricksu_company=fetchRecord($dbc,"ricksu_company","ricksu_company_id",$ricksu['ricksu_company']);
 ?>
<h3>Ricksu</h3>
<table>
  <tr>
    <th>Index</th>
    <th>Detail</th>
    <th>Index</th>
    <th>Detail</th>
    <th>Index</th>
    <th>Detail</th>
    <th>Index</th>
    <th>Detail</th>
     <th>Index</th>
    <th>Detail</th>
  </tr>
  <tr>
    <td>ricksu company</td>
    <td><?=$ricksu_company['ricksu_company_name']?></td>
    <td>arrival date</td>
    <td><?=$ricksu['ricksu_arrival_date']?></td>
    <td>repair fee</td>
    <td><?=$ricksu['ricksu_repair_fee']?></td>
    <td>note</td>
    <td><?=$ricksu['ricksu_note']?></td>
    <td>free days at yard</td>
    <td><?=$ricksu['ricksu_free_at_yard']?></td>
    </tr>
  <tr>
  	 <td>loading point</td>
    <td><?=@$ricksu_loading_point['auction_house_name']?></td>
  	<td>leaving date</td>
    <td><?=$ricksu['ricksu_leaving_date']?></td>
    <td>ricksu feee</td>
    <td><?=$ricksu['ricksu_fee'];?></td>
    <td>delievery point</td>
    <td><?=$ricksu['ricksu_delievery_point']?></td>
    <td>yard service	</td>
    <td><?=$ricksu['ricksu_yard_service']?></td>
  </tr>
   <tr>
  	 <td>receive by</td>
    <td><?=$ricksu['ricksu_receive_by']?></td>
  	<td>repair info</td>
    <td><?=$ricksu['ricksu_repair_info']?></td>
    <td>charger for additional services</td>
    <td><?=$ricksu['ricksu_charger_for_additional']?></td>
    <td>deliever by</td>
    <td><?=$ricksu['ricksu_deliever_by']?></td>
    <td>Additional Services</td>
    <td><?=$ricksu['ricksu_ad_service']?></td>
  </tr>
 </table>
<?php $mini=mysqli_query($dbc,"SELECT * FROM ricksu WHERE vehicle_id=$v_id AND mini_ricksu=1  ");

if (mysqli_num_rows($mini)>0) {
  $c=0;

  while ($ricksu=mysqli_fetch_assoc($q3)):
    $c++;
  $ricksu_loading_point=fetchRecord($dbc,"riksu_transportation","auction_house_name",$ricksu['ricksu_loading_point']);
  $ricksu_company=fetchRecord($dbc,"ricksu_company","ricksu_company_id",$ricksu['ricksu_company']);
  ?>
  <h3>Mini Ricksu #<?=$c?></h3>
<table>
  <tr>
    <th>Index</th>
    <th>Detail</th>
    <th>Index</th>
    <th>Detail</th>
    <th>Index</th>
    <th>Detail</th>
    <th>Index</th>
    <th>Detail</th>
     <th>Index</th>
    <th>Detail</th>
  </tr>
  <tr>
    <td>Risku Company</td>
    <td><?=$ricksu_company['ricksu_company_name']?></td>
    <td>Type</td>
    <td><?=$ricksu['ricksu_type']?></td>
    <td>Pickup Point</td>
    <td><?=$ricksu['mini_ricksu_pickup']?></td>
    <td>Delivery Point</td>
    <td><?=$ricksu['ricksu_delievery_point']?></td>
    <td>Fee</td>
    <td><?=$ricksu['ricksu_fee']?></td>
  </tr>
  <tr>
     <td>Pickup Date</td>
      <td><?=$ricksu['ricksu_pickup_date']?></td>
    <td>Delivery date</td>
     <td><?=$ricksu['ricksu_delivery_date']?></td>

    <td>Note</td>
    <td colspan="5"><?=$ricksu['ricksu_note'];?></td>
   
  </tr>

 </table>

<?php endwhile; } ?>
<!-- Export -->
<?php 
$q8=mysqli_query($dbc,"SELECT * FROM export_info WHERE vehicle_id=$v_id ;");
$export_info=mysqli_fetch_assoc($q8);
 ?>
<h3>Export Documentation</h3>
<table>
  <tr>
    <th>Index</th>
    <th>From</th>
    <th>To</th>
      <th>Index</th>
    <th>From</th>
    <th>To</th>

  </tr>

    <td>Ownership Certificate</td>
    <td><?=@$export_info['export_info_export_certificate']?></td>
    <td><?=@$export_info['export_info_export_certificate_date']?></td>

    <td>Export Certificate</td>
    <td><?=@$export_info['export_info_shipping_order']?></td>
     <td><?=@$export_info['export_info_export_certificate_date']?></td>
  </tr>
  <tr>

    <td>Translations</td>
    <td><?=@$export_info['export_info_translation']?></td>
     <td><?=@$export_info['export_info_translation_date']?></td>
    <td>Shipping Order</td>
    <td><?=@$export_info['export_info_shipping_order']?></td>
    <td><?=@$export_info['export_info_shipping_order_date']?></td>

    </tr>
      <tr>

    <td>Bill Of Lading</td>
    <td><?=@$export_info['bill_of_lading']?></td>
     <td><?=@$export_info['bill_of_lading_date']?></td>
    <td>Inspection Certificate</td>
    <td><?=@$export_info['inspection_certificate']?></td>
    <td><?=@$export_info['inspection_certificate_date']?></td>

    </tr>
</table>

<?php 
@$q5=mysqli_query($dbc,"SELECT * FROM consignee_info WHERE vehicle_id=$v_id ;");
$consignee=mysqli_fetch_assoc($q5);

$customers=fetchRecord($dbc,"customers","customer_id",$consignee['consignee_info_customer']);
$consignee_info_consignee=fetchRecord($dbc,"consignee","consignee_id",$consignee['consignee_info_consignee']);
$consignee_info_party_name=fetchRecord($dbc,"consignee","consignee_id",$consignee['consignee_info_party_name']);


 ?>
<h3>consignee</h3>
<table>
  <tr>
    <th>Index</th>
    <th>Detail</th>
    <th>Index</th>
    <th>Detail</th>
    <th>Index</th>
    <th>Detail</th>
    <th>Index</th>
    <th>Detail</th>
     <th>Index</th>
    <th>Detail</th>
  </tr>
  <tr>
    <th>Customer Name</th>
    <td><a target="blank" href="details.php?type=customer&id=<?=@$customers['customer_id']?>"><?=@$customers['customer_name']?></a></td>
    <td>Contact No.</td>
    <td><?=@$customers['customer_phone']?></td>
    <td>Email</td>
    <td><?=@$customers['customer_email']?></td>
    <td>Contact Person</td>
    <td><?=@$customers['customer_contact_person']?></td>
    <td>Customer Company</td>
    <td><?=@$customers['customer_company']?></td>
  </tr>
  <tr>
  	 <th>Consignee</th>
    <td><a target="blank" href="details.php?type=consignee&id=<?=@$consignee_info_consignee['consignee_id']?>"><?=@$consignee_info_consignee['consignee_name']?></a></td>
  	<td>Contact No.</td>
    <td><?=@$consignee_info_consignee['consignee_phone']?></td>
    <td>Email</td>
    <td><?=@$consignee_info_consignee['consignee_email']?></td>
    <td>Contact Person</td>
    <td><?=@$consignee_info_consignee['consignee_contact_person']?></td>
    <td>Consignee Company</td>
    <td><?=@$consignee_info_consignee['consignee_company']?></td>
  </tr>

<?php if ($consignee['consignee_type']=="notify_party"): ?>
  <tr>
    <th>Notify Party</th>
    <td><a target="blank" href="details.php?type=notify_party&id=<?=@$consignee_info_party_name['consignee_id']?>"><?=@$consignee_info_party_name['consignee_name']?></a></td>
    <td>Contact No.</td>
    <td><?=@$consignee_info_party_name['consignee_phone']?></td>
    <td>Email</td>
    <td><?=@$consignee_info_party_name['consignee_email']?></td>
    <td>Contact Person</td>
    <td><?=@$consignee_info_party_name['consignee_contact_person']?></td>
    <td>Consignee Company</td>
    <td><?=@$consignee_info_party_name['consignee_company']?></td>
  </tr>
<?php endif ?>
</table>

<?php 
$q7=mysqli_query($dbc,"SELECT * FROM inspection_info WHERE vehicle_id=$v_id ;");
$inspection=mysqli_fetch_assoc($q7);
$inspection_company=fetchRecord($dbc,"inspection_company","inspection_company_id",$inspection['inspection_info_company']);
$ricksu_company2=fetchRecord($dbc,"ricksu_company","ricksu_company_id",$inspection['inspection_info_ricksu']);
$ricksu_company3=fetchRecord($dbc,"ricksu_company","ricksu_company_id",$inspection['inspection_info_reinspection_ricksu']);
 ?>
<h3>Inspection</h3>
<table>
  <tr>
    <th>Index</th>
    <th>Detail</th>
    <th>Index</th>
    <th>Detail</th>
    <th>Index</th>
    <th>Detail</th>
    <th>Index</th>
    <th>Detail</th>
     <th>Index</th>
    <th>Detail</th>
  </tr>
  <tr>
    <td>Inspection Company</td>
    <td><?=@$inspection_company['inspection_company_name']?></td>
    <td>Inspection Appointment</td>
    <td><?=$inspection['inspection_info_app_date']?></td>
    <td>Validity Of Inspection</td>
    <td><?=$inspection['inspection_info_validity']?></td>
    <td>Repair Done By</td>
    <td><?=$inspection['inspection_info_repair_done_by']?></td>
    <td>Re Inspection Fee / Tax</td>
    <td><?=$inspection['inspection_info_reinspection1']?></td>
   </tr>
  <tr>
  	 <td> Vehicle Current Location</td>
    <td><?=$inspection['inspection_info_point']?></td>
  
    <td>Failure Reason</td>
    <td><?=$inspection['inspection_info_reason']?></td>
    <td>Note</td>
    <td><?=$inspection['inspection_info_note']?></td>
    <td>Reinspection Appointment</td>
    <td><?=$inspection['inspection_info_reinspection_app_date']?></td>
         <td>Validity Of Inspection2</td>
    <td><?=$inspection['inspection_info_validity1']?></td>
  </tr>
 <tr>
    <td>Inspection Charges</td>
    <td><?=$inspection['inspection_info_charges']?></td>
    <td>Inspection Status</td>
    <td><?=$inspection['inspection_info_sts']?></td>
    <td>Repair Charges</td>
    <td><?=$inspection['inspection_info_repair_charges']?></td>
    <td>Re Inspection</td>
    <td><?=$inspection['inspection_info_reinspection']?></td>

    <td>Re Inspection Status</td>
    <td><?=$inspection['inspection_info_reinspection_sts']?></td>

   
   </tr>
  <tr>

  </tr>
</table>

<!-- Shipment -->

<?php $q9=mysqli_query($dbc,"SELECT * FROM shipment WHERE vehicle_id=$v_id ;");
$shipment=mysqli_fetch_assoc($q9);
$shipper=fetchRecord($dbc,"shipper","shipper_id",$shipment['shipper_id']);
$shipment_company=fetchRecord($dbc,"shipment_company","shipment_company_id",$shipment['shipment_company']);
$shipment_destination=fetchRecord($dbc,"bidders","bidders_id",$shipment['shipment_destination']);
 ?>
<h3>Shipment</h3>
<table>
  <tr>

    <th>Index</th>
    <th>Detail</th>
    <th>Index</th>
    <th>Detail</th>
    <th>Index</th>
    <th>Detail</th>
    <th>Index</th>
    <th>Detail</th>
     <th>Index</th>
    <th>Detail</th>
  </tr>
  <tr>
    <td>Shipper</td>
    <td><?=@$shipper['shipper_name']?></td>
    <td>Shipped Company</td>
    <td><?=@$shipment_company['shipment_company_name']?></td>
    <td>Shipping Country</td>
    <td><?=$shipment['shipment_country']?></td>
    <td>Shipment Type</td>
    <td><?=$shipment['shipment_type']?></td>
    <td>Shipping Line</td>
    <td><?=$shipment['shipment_shipping_line']?></td>
   </tr>
     <tr>
    <td>Container No</td>
    <td><?=$shipment['shipment_container_no']?></td>
    <td>Port of Discharge</td>
    <td><?=$shipment['shipment_port_of_discharge']?></td>
    <td>Inner Cargo</td>
    <td><?=$shipment['shipment_access_with_cargo']?></td>
    <td>Shipping Order No</td>
    <td><?=$shipment['shipment_order_no']?></td>
    <td>Inner cargo Measurement </td>
    <td>L-<?=$shipment['inner_cargo_l']?>,W-<?=$shipment['inner_cargo_w']?>,H-<?=$shipment['inner_cargo_h']?></td>
   </tr>
    <tr>
    <td>Voyage No#</td>
    <td><?=$shipment['shipment_voyage_no']?></td>
    <td>Port of Landing</td>
    <td><?=$shipment['shipment_port_of_landing']?></td>
    <td>Cut Date</td>
    <td><?=$shipment['shipment_order_cutting_date']?></td>
     <td>M3</td>
    <td><?=$shipment['shipment_measures_m3']?></td>
    <td>HF Code</td>
    <td><?=$shipment['shipment_hc_code']?></td>


    <tr>
    <td>Ship Name & info</td>
    <td><?=$shipment['shipment_ship_name']?></td>
    <td>Shipment Weight</td>
    <td><?=$shipment['shipment_wieght']?></td>
    <td>Final Destination</td>
    <td><?=@$shipment_destination['bidders_name']?></td>
    <td>Inner cargo weight</td>
    <td><?=$shipment['inner_cargo_weight']?></td>
    <td>Contact No.2</td>
    <td><?=$shipment['shipment_contact2']?></td>
   </tr>
   <tr>
    <td>BL Charges</td>
    <td><?=$f['vehicle_bl_charges']?></td>
    <td>Other Charges</td>
    <td><?=$shipment['other_charges']?></td>
    <td>Freight Charges</td>
    <td><?=$f['vehicle_freight_charges']?></td>
    <td>Terminal Handling Charges</td>
    <td><?=$f['vehicle_terminal_charges']?></td>
    <td>Heat Treatment Charges</td>
    <td><?=$shipment['heat_charges']?></td>
   </tr>
      </tr>
    <tr>
    <td>Ship ETD</td>
    <td><?=$shipment['ship_etd']?></td>
    <td>Radiation check charges</td>
    <td><?=$shipment['radiation_charges']?></td>
    <td>Contact No.</td>
    <td><?=$shipment['shipment_contact']?></td>
   </tr>
   
 


</table>

<!-- Airmail -->

<?php $q10=mysqli_query($dbc,"SELECT * FROM airmail WHERE vehicle_id=$v_id ;");
$airmail=mysqli_fetch_assoc($q10);
$airmail_consignee=fetchRecord($dbc,"consignee","consignee_id",$airmail['airmail_consignee']);
$airmail_services_company=fetchRecord($dbc,"services_company","services_company_id",$airmail['airmail_services_company']);
 ?>
<h3>Airmail</h3>
<table>
  <tr>
    <th>Index</th>
    <th>Detail</th>
    <th>Index</th>
    <th>Detail</th>
    <th>Index</th>
    <th>Detail</th>
    <th>Index</th>
    <th>Detail</th>
     <th>Index</th>
    <th>Detail</th>
  </tr>
    <tr>
    <td>Consignee Name</td>
    <td><?=@$airmail_consignee['consignee_name']?></td>
    <td>Reciever Name</td>
    <td><?=$airmail['airmail_receiver_name']?></td>
    <td>Country</td>
    <td><?=$airmail['airmail_country']?></td>
    <td>STATE</td>
    <td><?=$airmail['airmail_state']?></td>
    <td>City</td>
    <td><?=$airmail['airmail_city']?></td>
   </tr>
    <tr>
    <td>Suburb (Optional)</td>
    <td><?=$airmail['airmail_suburb']?></td>
    <td>Floor / Building</td>
    <td><?=$airmail['airmail_floor']?></td>
    <td>STREET / ROAD (Optional)</td>
    <td><?=$airmail['airmail_street']?></td>
    <td>ZIP/POSTAL CODE</td>
    <td><?=$airmail['airmail_zipcode']?></td>
    <td>LANDLINE NO</td>
    <td><?=$airmail['airmail_landline']?></td>
   </tr>
    <tr>
    <td>Contact No</td>
    <td><?=$airmail['airmail_contact_no']?></td>
    <td>EMAIL ADDRESS</td>
    <td><?=$airmail['airmail_email']?></td>
    <td>Request By</td>
    <?php $user_nam=fetchRecord($dbc,"users","user_id",2);?>
    <td><?=$user_nam['username']?></td>
    <td>Receiver Address</td>
    <td><?=$airmail['airmail_receiver_address']?></td>
    <td>Fax No</td>
    <td><?=$airmail['airmail_fax']?></td>
   </tr>
       <tr>
    <td>Contact (Receiver)</td>
    <td><?=$airmail['airmail_contact_receiver']?></td>
    <td>Parcel No</td>
    <td><?=$airmail['airmail_parcel_no']?></td>
    <td>Parcel Details</td>
    <td><?=$airmail['airmail_parcel_detail']?></td>
    <td>Courier Charges</td>
    <td><?=$airmail['airmail_courier_charges']?></td>
    <td>Date of Dispatch</td>
    <td><?=$airmail['airmail_date_of_dispatch']?></td>
   </tr>
   <tr>
    <td>Services Company</td>
    <?php @$company=fetchRecord($dbc,"services_company","services_company_id",$airmail['airmail_services_company']);?>
    <td><?=@$company['services_company_name']?></td>
    <td>Parcel Weight</td>
    <td><?=@$airmail['airmail_parcel_weight']?></td>
    <td>TRACKING NO</td>
    <td><?=$airmail['airmail_tracking_no']?></td>
 
   </tr>
     <tr>
    <td>Parcel Type</td>
    <td><?=@$company['airmail_parcel_type']?></td>
    
 
   </tr>



</table>

</body>
</html>