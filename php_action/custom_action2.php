 <?php 
include_once '../inc/functions.php';
include_once '../php_action/db_connect.php';
if (isset($_POST['leads'])) {



		//echo $interior_grade_id = $_POST['leads'];

		//'pos' => @$_POST['pos'],
	$lead = [
		'assign_to' 			=> $_POST['assign_to'],
		'company_name'     => @$_POST['customer_company'],                               
		'customer_name'        => @$_POST['addon'] . $_POST['customer_name'],                            
		'country'    			 => @$_POST['customer_country'],                               
		'city'                 => @$_POST['customer_city'],                   
		'street'     			 => @$_POST['customer_street'],                              
		'zip'    			=> @$_POST['customer_zip_code'],                                
		'contact1'   			 => @$_POST['customer_landline'],                                
		'contact1_viber'      =>@ $_POST['customer_viber1'],                              
		'contact1_whatsapp'   => @$_POST['customer_whatsapp1'],                                 
		'contact2'       => @$_POST['customer_phone2'],                             
		'contact2_viber'      => @$_POST['customer_viber2'],                              
		'contact2_whatsapp'   => @$_POST['customer_whatsapp1'],                                 
		'email'       			=> @$_POST['customer_email'],                             
		'email2'      			=> @$_POST['customer_email2'],                              
		'designation'			 => @$_POST['customer_designation'],                                   
		'skype'      			 => @$_POST['customer_skype'],                             
		'website'              => @$_POST['website'],                      
		'customer_type'        => @$_POST['customer_type'],                            
		'priority'             => @$_POST['priority'],                       
		'status'               => @$_POST['status'],  
		//'user_id'				=> $_SESSION['userId'],
		];
		if ($_REQUEST['lead_id']=="") {
			if (insert_data($dbc,"leads_customer", $lead)) {
			
			echo mysqli_insert_id($dbc);
		}else{
			echo mysqli_error($dbc);

		}
		}else{
			if(update_data($dbc,"leads_customer", $lead,"leads_cus_id",$_REQUEST['lead_id'])) {
			
			echo mysqli_insert_id($dbc);
		}else{
			echo mysqli_error($dbc);

		}
		}


	}
	if (isset($_POST['saveleads'])) {

		

	$leadfinal = [
		'customer_id'		=> $_POST['getleadscustomerID2'],
		'maker_id'         => $_POST['vehicle_maker'],           
		'year'                 => json_encode($_POST['years']),   
		'drive'         => $_POST['vehicle_drive'],           
		'transmission'  => $_POST['vehicle_transmission'],                  
		'seats'          => $_POST['vehicle_seat'],          
		'color'    => json_encode($_POST['vehicle_color_name']),                
		'brand_id'         => $_POST['vehicle_brand'],           
		'chassis_code'  => $_POST['vehicle_chassis_code'],                  
		'engine_cc'            => $_POST['vehicle_cc'],        
		'fuel'          => $_POST['vehicle_fuel'],          
		'doors'          => $_POST['vehicle_door'],          
		'features'       => json_encode($_POST['vehicle_feature']),
		'followup_next_date' => $_POST['nextdate'],
		'leads_note'   	=> $_POST['note'],  
		'user_id'		=> @$_SESSION['userId'], 
		'status'		=> "active",           
		];

	if ($_REQUEST['lead_id']=='') {
			if (insert_data($dbc,"leads", $leadfinal)) {
			
			echo $_POST['getleadscustomerID2'];
		}else{
			echo mysqli_error($dbc);

		}
	}else{
			if (update_data($dbc,"leads", $leadfinal,"leads_id",$_REQUEST['lead_id'])) {
			
			echo $_POST['getleadscustomerID2'];
		}else{
			echo mysqli_error($dbc);

		}
	}


	}

	if (isset($_POST['sourcetype'])) {

		//upload_pic($_FILES['screenshot'], "../img/leads/");
		upload_files($_FILES['screenshot'],"../img/leads/");



		$dataleads = [
		'leads_id'     => $_POST['leadsid'],   
		'sourcetype'  => $_POST['sourcetype'],      
		'screenshot'  => $_SESSION['pic_name'],      
		'nextdate'    => $_POST['nextdate'],    
		'note'        => $_POST['note'],
		'user_id'	  => $_SESSION['userId'],

		
	];
	
	if (insert_data($dbc,"leads_followup", $dataleads)) {
			
	
	mysqli_query($dbc,"UPDATE leads SET followup_next_date = '$_POST[nextdate]' WHERE leads_id = '$_POST[leadsid]' ");
	//echo "UPDATE leads SET followup_next_date = '$_POST[nextdate]' WHERE leads_id = '$_POST[leadsid]' ";
			echo "leadsadd";
		}else{
			echo mysqli_error($dbc);

		}
	}





	if (isset($_POST['leadscustomer'])) {


$cusId = $_POST['leadscustomer'];

$sql = "SELECT leads_cus_id, customer_name  FROM  leads_customer WHERE  leads_cus_id = '$cusId'";
$result = mysqli_query($dbc,$sql);

	$row = mysqli_fetch_assoc($result);

$connect->close();

echo json_encode($row);

		# code...
	}

	if (isset($_POST['leads_id'])) {


$leads_id = $_POST['leads_id'];

$sql = "SELECT  * FROM  leads WHERE  leads_id = '$leads_id'";
$result = mysqli_query($dbc,$sql);

	$row = mysqli_fetch_assoc($result);

$connect->close();

echo json_encode($row);

		# code...
	}


	 
if (isset($_POST['action']) && !empty($_POST['action'])) {

	    $action = $_POST['action'];

	    switch ($action) {

	        case 'leadsCustomer' :

	            leadsCustomer($dbc);

	            break;
	         }
	      }


	      function leadsCustomer($dbc){

	    $result = mysqli_query($dbc,"SELECT * FROM leads_customer");

	    $output = array('data' => array());

	    if($result->num_rows > 0) { 

	     // $row = $result->fetch_array();

	     $interior_grade_sts = ""; 

	        while($row = $result->fetch_array()) {

	        $interior_grade_id = $row[0];

	            // active 

	            if($row[2] == 1) {

	                // activate member

	                $interior_grade_sts = "<label class='label label-success'>Active</label>";

	            } else {

	                // deactivate member

	                $interior_grade_sts = "<label class='label label-danger'>Inactive</label>";

	            }



	            $button = '<!-- Single button -->

	            <form><i id="'.$interior_grade_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> | <i id="'.$interior_grade_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i><input type="hidden" id="table_name" value="interior_grade"><input type="hidden" id="col_name" value="interior_grade_id"><input type="hidden" id="sts_col" value="interior_grade_sts"></form>';



	            $output['data'][] = array(      

	                $row[0],           

	                $row[1],           

	                $interior_grade_sts,

	                $button         

	            );  

	        } // /while 

	    }// if num_rows

	    $dbc->close();

	    echo json_encode($output);

	}      
	if (isset($_POST['reservation_by_add'])) {



		$data = [
			'reservation_by' => $_POST['reservation_by_add'],
			'reservation_sold_price' =>@$_POST['reservation_sold_price'],
			'reservation_sale_type' =>strtoupper($_POST['reservation_sale_type']),
			'reservation_shipment_type' =>strtolower($_POST['reservation_shipment_type']),
			'reservation_customer' =>@$_POST['reservation_customer'],
			'reservation_country' =>strtoupper($_POST['reservation_country']),
			'reservation_port' =>@$_POST['reservation_port'],
			'reservation_final_destin' =>@$_POST['reservation_final_destin'],
			'reservation_transportation_cost' =>@$_POST['reservation_transportation_cost'],
			'reservation_inspection' =>@$_POST['reservation_inspection'],
			'reservation_inspection_fee' =>@$_POST['reservation_inspection_fee'],
			'reservation_inspection_fee_tax' =>@$_POST['reservation_inspection_fee_tax'],
			'reservation_currency' =>@$_POST['reservation_currency'],
			'reservation_freight' =>@$_POST['reservation_freight'],
			'reservation_date' => @$_POST['reservation_date'],
			'reservation_start_date' =>@$_POST['reservation_start_date'],
			'reservation_expiry_date' => @$_POST['reservation_expiry_date'],
			'reservation_payement' =>@$_POST['reservation_payement'],
			'reservation_que' =>@$_POST['reservation_que'],
			'reservation_note' =>@$_POST['reservation_note'],
			'reservation_sts' =>@$_POST['reservation_sts'],
			'vehicle_id' =>@$_POST['vehicle_id'],
			'user_id' => @$_SESSION['userId'],
		];



		if ($_POST['reservation_id'] == "") {
			 $stock = fetchRecord($dbc,"vehicle_info","vehicle_id",$_POST['vehicle_id']);
                     
		  	$checkQ=mysqli_num_rows(mysqli_query($dbc,"SELECT reservation_customer FROM reservation WHERE reservation_customer='".$_POST['reservation_customer']."' AND vehicle_id='".$_POST['vehicle_id']."' AND reservation_sts=1 "));
			if ($checkQ>0) {
				echo "Reservation Already Exists";
				exit();
			}elseif ($stock['vehicle_status']=='sold') {
				echo "Vehicle Has Been Sold";
				exit();
			} else{


			if (insert_data($dbc, "reservation", $data)) {



				echo $last_id = $_POST['vehicle_id'];



				exit();



			}else{



				echo mysqli_error($dbc);



				exit();



			}

		} //check customer_2bication

		}else{



			if (update_data($dbc, "reservation", $data, "reservation_id ", $_POST['reservation_id'])) {



				echo $last_id = $_POST['vehicle_id'];



				exit();



			}else{



				echo mysqli_error($dbc);



				exit();



			}



		}



	}



