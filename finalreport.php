<?php 
$query=mysqli_connect("localhost","root","","nexco_japan_new");
// if($query){
// 	echo "connected";
// }else{
// 	echo mysqli_error($query);
// }
$v_id=$_GET['vehicle_id'];
$q=mysqli_query($query,"SELECT * FROM vehicle_info WHERE vehicle_id=$v_id ;");
$f=mysqli_fetch_assoc($q);
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
    <td>Vehicle id</td>
    <td><?=$f['vehicle_id']?></td>
    <td>M3</td>
    <td><?=$f['vehicle_m3']?></td>
     <td>exterior grade</td>
    <td><?=$f['vehicle_exterior']?></td>
    <td>package</td>
    <td><?=$f['vehicle_package']?></td>
    </tr>
  <tr>
  	 <td>stock id</td>
    <td><?=$f['vehicle_stock_id']?></td>
  	<td>access</td>
    <td><?=$f['vehicle_access']?></td>
    <td>door</td>
    <td><?=$f['vehicle_door']?></td>
    <td>grade</td>
    <td><?=$f['vehicle_grade']?></td>
  
  </tr>
  <tr>
  	<td>Manu. year</td>
    <td><?=$f['vehicle_manu_year']?></td>
  	  <td>type</td>
    <td><?=$f['vehicle_type']?></td>
    <td>color name</td>
    <td><?=$f['vehicle_color_name']?></td>
    <td>option</td>
    <td><?=$f['vehicle_option']?></td>
  </tr>
  <tr>
  	 <td>chassis code</td>
    <td><?=$f['vehicle_chassis_code']?></td>
    <td>mode</td>
    <td><?=$f['vehicle_mode']?></td>
     <td>width</td>
    <td><?=$f['vehicle_width']?></td>
     <td>interior color</td>
    <td><?=$f['vehicle_interior_color']?></td>
  </tr>
  <tr>
  	<td>engine no</td>
    <td><?=$f['vehicle_engine_no']?></td>
  	 <td>discount</td>
    <td><?=$f['vehicle_discount']?></td>
    <td>loading caacity</td>
    <td><?=$f['vehicle_loading_capacity']?></td>
    <td>height</td>
    <td><?=$f['vehicle_height']?></td>
   </tr>
   <tr>
   	<td>transmission</td>
    <td><?=$f['vehicle_transmission']?></td>
     <td>maker</td>
    <td><?=$f['vehicle_maker']?></td>
     <td>KM</td>
    <td><?=$f['vehicle_km']?></td>
    <td>weight</td>
    <td><?=$f['vehicle_weight']?></td>
   </tr>
   <tr>
   	<td>interior grade</td>
    <td><?=$f['vehicle_interior']?></td>
     <td>reg year</td>
    <td><?=$f['vehicle_reg_year']?></td>
    <td>brand</td>
    <td><?=$f['vehicle_brand']?></td>
     <td>KM2</td>
    <td><?=$f['vehicle_km2']?></td>
   </tr>
   <tr>
   	 <td>seat</td>
    <td><?=$f['vehicle_seat']?></td>
    	<td>chassis no</td>
    <td><?=$f['vehicle_chassis_no']?></td>
     <td>Reg month</td>
    <td><?=$f['vehicle_reg_month']?></td>
    <td>Estimated price</td>
    <td><?=$f['vehicle_est_price']?></td>
   </tr>
    <tr>
   	<td>color</td>
    <td><?=$f['vehicle_color']?></td>
    <td>cc</td>
    <td><?=$f['vehicle_cc']?></td>
      <td>drive</td>
    <td><?=$f['vehicle_drive']?></td>
    <td>note</td>
    <td><?=$f['vehicle_note']?></td>
   </tr>
    <tr>
    <td>length</td>
    <td><?=$f['vehicle_length']?></td>
     <td>fuel</td>
    <td><?=$f['vehicle_fuel']?></td>
    <td>engine type</td>
    <td><?=$f['vehicle_engine_type']?></td>
   </tr>
    
 
</table>
<?php 
$q1=mysqli_query($query,"SELECT * FROM auction_info WHERE vehicle_id=$v_id ;");
$a=mysqli_fetch_assoc($q1);
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
    <td><?=$a['auction_house']?></td>
    <td>start price</td>
    <td><?=$a['auction_start_price']?></td>
     <td>recycle fee</td>
    <td><?=$a['auction_recycle_fee'].', '.$a['auction_recycle_fee_tax'].'Tax' ;?></td>
    <td>Turn</td>
    <td><?=$a['auction_turn']?></td>
    </tr>
  <tr>
  	 <td>Bid Type</td>
    <td></td>
  	<td>win price</td>
    <td><?=$a['auction_win_price'].', '.$a['auction_win_price_tax'].'Tax' ;?></td>
    <td>transport due date</td>
    <td><?=$a['auction_transport_due_date']?></td>
    <td>win by</td>
    <td><?=$a['auction_win_by']?></td>
  
  </tr>
  <tr>
  	<td>auction date</td>
    <td><?=$a['auction_date']?></td>
  	  <td>auction fee</td>
    <td><?=$a['auction_fee'].', '.$a['auction_fee_tax'].'Tax' ;?></td>
    <td>bidder name</td>
    <td><?=$a['auction_bidder']?></td>
    <td>note</td>
    <td><?=$a['auction_note']?></td>
  </tr>
 </table>
 <?php 
$q2=mysqli_query($query,"SELECT * FROM reservation WHERE vehicle_id=$v_id ;");
$r=mysqli_fetch_assoc($q2);
 ?>
<h3>Reservation</h3>
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
    <td><?=$r['reservation_by']?></td>
    <td>customer name</td>
    <td><?=$r['reservation_customer']?></td>
    <td>reservation start date</td>
    <td><?=$r['reservation_start_date']?></td>
    <td>payement term</td>
    <td><?=$r['reservation_payement']?></td>
    <td>note</td>
    <td><?=$r['reservation_note']?></td>
    </tr>
  <tr>
  	 <td>Sold Price</td>
    <td><?=$r['reservation_sold_price']?></td>
  	<td>reservation date</td>
    <td><?=$r['reservation_date']?></td>
    <td>reservation expiry date</td>
    <td><?=$r['reservation_expiry_date']?></td>
    <td>Que No.</td>
    <td><?=$r['reservation_que']?></td>
    <td>status</td>
    <td><?=$r['reservation_sts']?></td>
  </tr>
 </table>
  <?php 
$q3=mysqli_query($query,"SELECT * FROM ricksu WHERE vehicle_id=$v_id ;");
$ricksu=mysqli_fetch_assoc($q3);
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
    <td><?=$ricksu['ricksu_company']?></td>
    <td>arrival date</td>
    <td><?=$ricksu['ricksu_arrival_date']?></td>
    <td>repair fee</td>
    <td><?=$ricksu['ricksu_repair_fee'].', '.$ricksu['ricksu_repair_fee_tax'].'Tax' ;?></td>
    <td>note</td>
    <td><?=$ricksu['ricksu_note']?></td>
    <td>free days at yard</td>
    <td><?=$ricksu['ricksu_free_at_yard']?></td>
    </tr>
  <tr>
  	 <td>loading point</td>
    <td><?=$ricksu['ricksu_loading_point']?></td>
  	<td>leaving date</td>
    <td><?=$ricksu['ricksu_leaving_date']?></td>
    <td>ricksu feee</td>
    <td><?=$ricksu['ricksu_fee'].','.$ricksu['ricksu_fee_tax'].'Tax' ;?></td>
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
    <td><?=$ricksu['ricksu_charger_for_additional'].', '.$ricksu['ricksu_charger_for_additional_tax'].'Tax' ;?></td>
    <td>deliever by</td>
    <td><?=$ricksu['ricksu_deliever_by']?></td>
    <td>Additional Services</td>
    <td><?=$ricksu['ricksu_ad_service']?></td>
  </tr>
 </table>

 <?php 
$q4=mysqli_query($query,"SELECT * FROM export_info WHERE vehicle_id=$v_id ;");
$e=mysqli_fetch_assoc($q4);
 ?>
<h3>Reservation</h3>
<table>
  <tr>
    <th>Index</th>
    <th>Detail</th>
    <th>Index</th>
    <th>Detail</th>
  </tr>
  <tr>
    <td>Ownership Certificate</td>
    <td><?=$e['export_info_arrival']?></td>
    <td>Date</td>
    <td><?=$e['export_info_arrival_date']?></td>
    </tr>
    <tr>
    <td>export certificate</td>
    <td><?=$e['export_info_export_certificate']?></td>
    <td>Date</td>
    <td><?=$e['	export_info_export_certificate_date']?></td>
    </tr>
    <tr>
    <td>translation</td>
    <td><?=$e['export_info_translation']?></td>
    <td>Date</td>
    <td><?=$e['export_info_translation_date']?></td>
    </tr>
    <tr>
    <td>shipping order</td>
    <td><?=$e['export_info_shipping_order']?></td>
    <td>Date</td>
    <td><?=$e['export_info_shipping_order_date']?></td>
    </tr> 
</table>

<?php 
$q5=mysqli_query($query,"SELECT * FROM consignee WHERE vehicle_id=$v_id ;");
$consignee=mysqli_fetch_assoc($q5);
$custmer=$consignee['customer_id'];
$q6=mysqli_query($query,"SELECT * FROM customers WHERE customer_id='$custmer' ");
$customer=mysqli_fetch_assoc($q6);
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
    <td>Consignee Name</td>
    <td><?=$consignee['consignee_name']?></td>
    <td>CONTACT PERSON</td>
    <td><?=$consignee['consignee_contact_person']?></td>
    <td>COUNTRY</td>
    <td><?=$consignee['consignee_country']?></td>
    <td>STATE</td>
    <td><?=$consignee['consignee_state']?></td>
    <td>CITY</td>
    <td><?=$consignee['consignee_city']?></td>
    </tr>
  <tr>
  	 <td>SUBURB (Optional)</td>
    <td><?=$consignee['consignee_suburb']?></td>
  	<td>STREET / ROAD (Optional)</td>
    <td><?=$consignee['consignee_street']?></td>
    <td>FLOOR / BUILDING Name</td>
    <td><?=$consignee['consignee_floor']?></td>
    <td>ZIP/POSTAL CODE</td>
    <td><?=$consignee['consignee_zip']?></td>
    <td>OTHER ADDRESS INFO</td>
    <td><?=$consignee['consignee_address']?></td>
  </tr>
 <tr>
    <td>LANDLINE NO</td>
    <td><?=$consignee['consignee_landline']?></td>
    <td>FAX NO</td>
    <td><?=$consignee['consignee_fax']?></td>
    <td>MOBILE NO</td>
    <td><?=$consignee['consignee_mobile']?></td>
    <td>MOBILE #2</td>
    <td><?=$consignee['consignee_mobile2']?></td>
    <td>EMAIL ADDRESS</td>
    <td><?=$consignee['consignee_email']?></td>
    </tr>
  <tr>
  	 <td>WEBSITTE(Optional)</td>
    <td><?=$consignee['consignee_website']?></td>
  	<td>DESTINATION PORT</td>
    <td><?=$consignee['consignee_dest_port']?></td>
    <td>FINAL DESTINATION</td>
    <td><?=$consignee['consignee_final_dest']?></td>
    <td>Consignee Status</td>
    <td><?=$consignee['consignee_sts']?></td>
    <td>Assign Customer</td>
    <td><?=$customer['customer_name']?></td>
  </tr>
</table>

<?php 
$q7=mysqli_query($query,"SELECT * FROM inspection_info WHERE vehicle_id=$v_id ;");
$inspection=mysqli_fetch_assoc($q7);
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
    <td><?=$inspection['inspection_info_company']?></td>
    <td>Inspection Appointment</td>
    <td><?=$inspection['inspection_info_app_date']?></td>
    <td>Validity Of Inspection</td>
    <td><?=$inspection['inspection_info_validity']?></td>
    <td>Repair Done By</td>
    <td><?=$inspection['inspection_info_repair_done_by']?></td>
    <td>Re Inspection Fee / Tax</td>
    <td></td>
   </tr>
  <tr>
  	 <td>Inspection Point</td>
    <td><?=$inspection['inspection_info_point']?></td>
  	<td>Ricksu For Inspection</td>
    <td><?=$inspection['inspection_info_ricksu']?></td>
    <td>Failure Reason</td>
    <td><?=$inspection['inspection_info_reason']?></td>
    <td>Note</td>
    <td><?=$inspection['inspection_info_note']?></td>
    <td>inspection Appointment</td>
    <td><?=$inspection['inspection_info_reinspection_app_date']?></td>
  </tr>
 <tr>
    <td>Inspection Charges</td>
    <td><?=$inspection['inspection_info_charges']?></td>
    <td>Inspection Status</td>
    <td><?=$inspection['inspection_info_sts']?></td>
    <td>Repair Charges</td>
    <td><?=$inspection['inspection_info_repair_charges'].', '.$inspection['inspection_info_repair_charges_tax']?></td>
    <td>Re Inspection</td>
    <td><?=$inspection['inspection_info_reinspection']?></td>
    <td>Ricksu For Inspection</td>
    <td><?=$inspection['inspection_info_reinspection_ricksu']?></td>
   </tr>
  <tr>
  	 <td>Ricksu Fee / Tax</td>
    <td></td>
        <td>Re Inspection Status</td>
    <td><?=$inspection['inspection_info_reinspection_sts']?></td>
     <td>Validity Of Inspection</td>
    <td><?=$inspection['inspection_info_validity1']?></td>
  </tr>
</table>
</body>
</html>