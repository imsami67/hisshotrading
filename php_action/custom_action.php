     <?php 



	require_once '../php_action/db_connect.php';



	require_once '../inc/functions.php';



	//auction_grade



	if (isset($_POST['auction_grade_name'])) {



		$auction_grade_id = $_POST['auction_grade_id'];



		$auction_grade_name = $_POST['auction_grade_name'];



		$auction_grade_sts = $_POST['auction_grade_sts'];



		if ($auction_grade_id == "") {



			$q = mysqli_query($dbc,"INSERT INTO auction_grade (auction_grade_name, auction_grade_sts)  VALUES ('$auction_grade_name', '$auction_grade_sts')");



			if ($q) {



				echo $msg = "Auction Grade Added Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}else{



			$q = mysqli_query($dbc,"UPDATE auction_grade SET auction_grade_name = '$auction_grade_name', auction_grade_sts = '$auction_grade_sts' WHERE auction_grade_id = '$auction_grade_id'");



			if ($q) {



				echo $msg = "Auction Grade Data Updated Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}



	} 







	//makers



	if (isset($_POST['maker_name'])) {



		if ($_POST['maker_id'] == "") {



			if (upload_pic($_FILES['maker_img'], "../img/vehicles_images/")) {



				$data = [



					'maker_name' => $_POST['maker_name'],



					'maker_sts' => $_POST['maker_sts'],



					'maker_img' => $_SESSION['pic_name'],



				];
 


				if (insert_data($dbc, "maker", $data)) {



					echo $msg = "Maker Added Successfully";



					exit();



				}else{



					echo $msg = mysqli_error($dbc);



					exit();



				}



			}



		}else{



			if (upload_pic($_FILES['maker_img'], "../img/vehicles_images/")) {



				$data = [



					'maker_id' => $_POST['maker_id'],



					'maker_name' => $_POST['maker_name'],



					'maker_sts' => $_POST['maker_sts'],



					'maker_img' => $_SESSION['pic_name'],



				];



				if (update_data($dbc, "maker", $data, "maker_id", $_POST['maker_id'])) {



					echo $msg = "Maker Data Updated Successfully";



					exit();



				}else{



					echo $msg = mysqli_error($dbc);



					exit();



				}



			}



		}



	}







	//color_code



	if (isset($_POST['color_code_name'])) {



		$data = [



			'color_code_id' => $_POST['color_code_id'],



			'color_name' => $_POST['color_name'],



			'color_code_name' => $_POST['color_code_name'],



			'color_code_sts' => $_POST['color_code_sts'],



			'color_maker' => $_POST['color_maker'],



		];



		if ($_POST['color_code_id'] == "") {



			if (insert_data($dbc,"color_code", $data)) {



				echo $msg = "Color Code Added Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}else{



			if (update_data($dbc,"color_code",$data,"color_code_id",$_POST['color_code_id'])) {



				echo $msg = "Color Code Data Updated Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}



	}







	//cc



	if (isset($_POST['cc_name'])) {



		$cc_id = $_POST['cc_id'];



		$cc_name = $_POST['cc_name'];



		$cc_sts = $_POST['cc_sts'];



		if ($cc_id == "") {



			$q = mysqli_query($dbc,"INSERT INTO cc (cc_name, cc_sts)  VALUES ('$cc_name', '$cc_sts')");



			if ($q) {



				echo $msg = "CC Added Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}else{



			$q = mysqli_query($dbc,"UPDATE cc SET cc_name = '$cc_name', cc_sts = '$cc_sts' WHERE cc_id = '$cc_id'");



			if ($q) {



				echo $msg = "CC Data Updated Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}



	}







	//drive



	if (isset($_POST['drive_name'])) {



		$drive_id = $_POST['drive_id'];



		$drive_name = $_POST['drive_name'];



		$drive_sts = $_POST['drive_sts'];



		if ($drive_id == "") {



			$q = mysqli_query($dbc,"INSERT INTO drive (drive_name, drive_sts)  VALUES ('$drive_name', '$drive_sts')");



			if ($q) {



				echo $msg = "Drive Added Sudriveessfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}else{



			$q = mysqli_query($dbc,"UPDATE drive SET drive_name = '$drive_name', drive_sts = '$drive_sts' WHERE drive_id = '$drive_id'");



			if ($q) {



				echo $msg = "Drive Data Updated Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}



	}







	//transmission



	if (isset($_POST['transmission_name'])) {



		$transmission_id = $_POST['transmission_id'];



		$transmission_name = $_POST['transmission_name'];



		$transmission_sts = $_POST['transmission_sts'];



		if ($transmission_id == "") {



			$q = mysqli_query($dbc,"INSERT INTO transmission (transmission_name, transmission_sts)  VALUES ('$transmission_name', '$transmission_sts')");



			if ($q) {



				echo $msg = "Transmission Added Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}else{



			$q = mysqli_query($dbc,"UPDATE transmission SET transmission_name = '$transmission_name', transmission_sts = '$transmission_sts' WHERE transmission_id = '$transmission_id'");



			if ($q) {



				echo $msg = "Transmission Data Updated Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}



	}







	//unterior



	if (isset($_POST['interior_grade_name'])) {



		$interior_grade_id = $_POST['interior_grade_id'];



		$interior_grade_name = $_POST['interior_grade_name'];



		$interior_grade_sts = $_POST['interior_grade_sts'];



		if ($interior_grade_id == "") {



			$q = mysqli_query($dbc,"INSERT INTO interior_grade (interior_grade_name, interior_grade_sts)  VALUES ('$interior_grade_name', '$interior_grade_sts')");



			if ($q) {



				echo $msg = "Interior Grade Added Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}else{



			$q = mysqli_query($dbc,"UPDATE interior_grade SET interior_grade_name = '$interior_grade_name', interior_grade_sts = '$interior_grade_sts' WHERE interior_grade_id = '$interior_grade_id'");



			if ($q) {



				echo $msg = "Interior Grade Data Updated Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}



	}







	//exterior



	if (isset($_POST['exterior_grade_name'])) {



		$exterior_grade_id = $_POST['exterior_grade_id'];



		$exterior_grade_name = $_POST['exterior_grade_name'];



		$exterior_grade_sts = $_POST['exterior_grade_sts'];



		if ($exterior_grade_id == "") {



			$q = mysqli_query($dbc,"INSERT INTO exterior_grade (exterior_grade_name, exterior_grade_sts)  VALUES ('$exterior_grade_name', '$exterior_grade_sts')");



			if ($q) {



				echo $msg = "Exterior Grade Added Suexterior_gradeessfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}else{



			$q = mysqli_query($dbc,"UPDATE exterior_grade SET exterior_grade_name = '$exterior_grade_name', exterior_grade_sts = '$exterior_grade_sts' WHERE exterior_grade_id = '$exterior_grade_id'");



			if ($q) {



				echo $msg = "Exterior Grade Data Updated Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}



	}







	//seats



	if (isset($_POST['seats_name'])) {



		$seats_id = $_POST['seats_id'];



		$seats_name = $_POST['seats_name'];



		$seats_sts = $_POST['seats_sts'];



		if ($seats_id == "") {



			$q = mysqli_query($dbc,"INSERT INTO seats (seats_name, seats_sts)  VALUES ('$seats_name', '$seats_sts')");



			if ($q) {



				echo $msg = "Seats Category Added Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}else{



			$q = mysqli_query($dbc,"UPDATE seats SET seats_name = '$seats_name', seats_sts = '$seats_sts' WHERE seats_id = '$seats_id'");



			if ($q) {



				echo $msg = "Seats Category Data Updated Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}



	}







	//doors



	if (isset($_POST['doors_name'])) {



		$doors_id = $_POST['doors_id'];



		$doors_name = $_POST['doors_name'];



		$doors_sts = $_POST['doors_sts'];



		if ($doors_id == "") {



			$q = mysqli_query($dbc,"INSERT INTO doors (doors_name, doors_sts)  VALUES ('$doors_name', '$doors_sts')");



			if ($q) {



				echo $msg = "Doors Category Added Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}else{



			$q = mysqli_query($dbc,"UPDATE doors SET doors_name = '$doors_name', doors_sts = '$doors_sts' WHERE doors_id = '$doors_id'");



			if ($q) {



				echo $msg = "Doors Category Data Updated Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}



	}







	//option



	if (isset($_POST['option_name'])) {



		$option_id = $_POST['option_id'];



		$option_name = $_POST['option_name'];



		$option_sts = $_POST['option_sts'];



		if ($option_id == "") {



			$q = mysqli_query($dbc,"INSERT INTO options (option_name, option_sts)  VALUES ('$option_name', '$option_sts')");



			if ($q) {



				echo $msg = "Option Type Added Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}else{



			$q = mysqli_query($dbc,"UPDATE options SET option_name = '$option_name', option_sts = '$option_sts' WHERE option_id = '$option_id'");



			if ($q) {



				echo $msg = "Option Type Data Updated Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}



	}







	//fuel



	if (isset($_POST['fuel_name'])) {



		$fuel_id = $_POST['fuel_id'];



		$fuel_name = $_POST['fuel_name'];



		$fuel_sts = $_POST['fuel_sts'];



		if ($fuel_id == "") {



			$q = mysqli_query($dbc,"INSERT INTO fuel (fuel_name, fuel_sts)  VALUES ('$fuel_name', '$fuel_sts')");



			if ($q) {



				echo $msg = "Fuel Type Added Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}else{



			$q = mysqli_query($dbc,"UPDATE fuel SET fuel_name = '$fuel_name', fuel_sts = '$fuel_sts' WHERE fuel_id = '$fuel_id'");



			if ($q) {



				echo $msg = "Fuel Type Data Updated Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}



	}







	//pack



	if (isset($_POST['pack_name'])) {



		$pack_id = $_POST['pack_id'];



		$pack_name = $_POST['pack_name'];



		$pack_sts = $_POST['pack_sts'];



		if ($pack_id == "") {



			$q = mysqli_query($dbc,"INSERT INTO package (pack_name, pack_sts)  VALUES ('$pack_name', '$pack_sts')");



			if ($q) {



				echo $msg = "Package Added Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}else{



			$q = mysqli_query($dbc,"UPDATE package SET pack_name = '$pack_name', pack_sts = '$pack_sts' WHERE pack_id = '$pack_id'");



			if ($q) {



				echo $msg = "Package Data Updated Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}



	}







	//nexco_offices



	if (isset($_POST['office_name'])) {



		$data = [



			'office_name' => $_POST['office_name'],



			'office_address' => $_POST['office_address'],



			'office_country' => $_POST['office_country'],



			'office_phone' => $_POST['office_phone'],



			'office_sellername' => $_POST['office_sellername'],



			'office_sellerphone' => $_POST['office_sellerphone'],



			'office_sellerpost' => $_POST['office_sellerpost'],



			'office_lat' => $_POST['office_lat'],



			'office_lng' => $_POST['office_lng'],



			// 'add_by' => $_SESSION['user_id'],



		];



		if ($_POST['office_id'] == "") {



			if (insert_data($dbc, 'nexco_offices', $data)) {



				echo $msg = "Office Data Added Successfully";



				exit();



			}else{



				echo mysqli_error($dbc);



				exit();



			}	



		}else{



			if (update_data($dbc, 'nexco_offices', $data, "office_id", $_POST['office_id'])) {



				echo $msg = "Office Data Updated Successfully";



				exit();



			}else{



				echo mysqli_error($dbc);



				exit();



			}	



		}



	}else{



		echo mysqli_error($dbc);



	}







	//consignee



	if (isset($_POST['consignee_name'])) {

		

			if ($_POST['consignee_label']=="notify_party") {
				$notify=$_POST['customer_notify'];
			}else{
				$notify='';
			}

			$data = [




				'consignee_info_customer' => $_POST['customer_id'],


				'consignee_info_consignee' =>$_POST['consignee_name'],

				'consignee_info_party_name'=>$notify,


				'consignee_type' =>@$_POST['consignee_label'],
				'consignee_info_type' =>@$_POST['consignee_label'],



				'vehicle_id' =>$_POST['vehicle_idMainConsigneetrade'],



			];







			if ($_POST['consignee_info_id']=="add") {
				@$check=get($dbc,"consignee_info WHERE vehicle_id='".$_POST['vehicle_idMainConsigneetrade']."'");


			if (mysqli_num_rows($check)>0) {
			
					$fetch=mysqli_fetch_assoc($check);
					if (update_data($dbc, "consignee_info", $data, "vehicle_id", $fetch['vehicle_id'])) {
				}else{
					echo $msg = mysqli_error($dbc);
					exit();
				}
			}else{
				
	if (insert_data($dbc, "consignee_info", $data)) {

				}else{
					echo $msg = mysqli_error($dbc);
					exit();
				}

			}

				
			}else{

				if (update_data($dbc, "consignee_info", $data, "consignee_info_id", $_POST['consignee_info_id'])) {
				}else{
					echo $msg = mysqli_error($dbc);
					exit();
				}



			

		}



		echo $_POST['customer_id'];



	}





if (isset($_POST['consignee_name_sep'])) {



		

	



			$data = [



				'consignee_id' =>@ $_POST['consignee_id'],



				'customer_id' =>@ $_POST['customer_id'],



				'consignee_dest_port' =>@ $_POST['consignee_dest_port'],



				'consignee_name' =>@ $_POST['consignee_name_sep'],



				'consignee_sts' =>@ $_POST['consignee_sts'],



				'consignee_country' =>@ $_POST['consignee_country'],



				'consignee_contact_person' =>@ $_POST['consignee_contact_person'],



				'consignee_state' =>@ $_POST['consignee_state'],



				'consignee_city' =>@ $_POST['consignee_city'],



				'consignee_suburb' =>@ $_POST['consignee_suburb'],



				'consignee_street' =>@ $_POST['consignee_street'],



				'consignee_floor' =>@ $_POST['consignee_floor'],



				'consignee_zip' =>@ $_POST['consignee_zip'],



				'consignee_address' =>@ $_POST['consignee_address'],



				'consignee_website' =>@ $_POST['consignee_website'],



				'consignee_landline' =>@ $_POST['consignee_landline'],



				'consignee_mobile' =>@ $_POST['consignee_mobile'],



				'consignee_mobile2' =>@ $_POST['consignee_mobile2'],



				'consignee_fax' =>@ $_POST['consignee_fax'],



				'consignee_email' =>@ $_POST['consignee_email'],



				'consignee_dest_port' =>@ $_POST['consignee_dest_port'],



				'consignee_final_dest' =>@ $_POST['consignee_final_dest'],



				'consignee_type' =>@strtolower($_POST['consignee_label']),





			];







			if ($_POST['consignee_id']== "") {



				if (insert_data($dbc, "consignee", $data)) {

					echo "Consignee Has Been Updated";





				}else{



					echo $msg = mysqli_error($dbc);



					exit();



				}



			}else{



				if (update_data($dbc, "consignee", $data, "consignee_id", $_POST['consignee_id'])) {



		echo "Consignee Has Been Updated";



				}else{



					echo $msg = mysqli_error($dbc);



					exit();



				}



			}



		







	}







	//Inspection



	if (isset($_POST['inspection_company_name'])) {

	$data=[
				'inspection_company_name' =>@ $_POST['inspection_company_name'],



				'inspection_contact_person' =>@ $_POST['inspection_contact_person'],



				'inspection_fax' =>@ $_POST['inspection_fax'],



				'inspection_email' =>@ $_POST['inspection_email'],



				'inspection_address' =>@ $_POST['inspection_address'],



				'inspection_website' =>@ $_POST['inspection_website'],



				'inspection_company_sts' =>@ $_POST['inspection_company_sts'],

		];

		$inspection_company_id = $_POST['inspection_company_id'];



	



		if ($inspection_company_id == "") {




			if (insert_data($dbc, "inspection_company", $data)) {

					echo "Inspection Company Added Successfully";





				}else{



					echo $msg = mysqli_error($dbc);



					exit();



				}





		}else{


				if (update_data($dbc, "inspection_company", $data, "inspection_company_id", $_POST['inspection_company_id'])) {

					echo "Inspection Company Data Updated Successfully";


				}else{



					echo  mysqli_error($dbc);



					exit();



				}



		}



	}
//transportation

	//Inspection



	if (isset($_POST['inspection_trans_company'])) {

	$data=[
				'inspection_trans_company' =>@ $_POST['inspection_trans_company'],



				'inspection_trans_for' =>@ $_POST['inspection_trans_for'],



				'inspection_trans_fee' =>@ $_POST['inspection_trans_fee'],



				'inspection_trans_fee_tax' =>@ $_POST['inspection_trans_fee_tax'],
				'inspection_validity_for' =>@ $_POST['inspection_validity_for'],



				'inspection_trans_others' =>@ $_POST['inspection_trans_others'],






				'inspection_trans_sts' =>@ $_POST['inspection_trans_sts'],

		];

		$inspection_trans_company = $_POST['inspection_trans_id'];



	



		if ($inspection_trans_company == "") {




			if (insert_data($dbc, "inspection_transportation", $data)) {

					echo "Inspection Transportation Added Successfully";





				}else{



					echo $msg = mysqli_error($dbc);



					exit();



				}





		}else{


				if (update_data($dbc, "inspection_transportation", $data, "inspection_trans_id", $_POST['inspection_trans_id'])) {

					echo "Inspection Transportation Data Updated Successfully";


				}else{



					echo  mysqli_error($dbc);



					exit();



				}



		}



	}






	//transporattion



	if (isset($_POST['transportation_name'])) {



		$transportation_id = $_POST['transportation_id'];



		$transportation_name = $_POST['transportation_name'];



		$transportation_sts = $_POST['transportation_sts'];



		if ($transportation_id == "") {



			$q = mysqli_query($dbc,"INSERT INTO transportation (transportation_name, transportation_sts)  VALUES ('$transportation_name', '$transportation_sts')");



			if ($q) {



				echo $msg = "Transportation Added Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}else{



			$q = mysqli_query($dbc,"UPDATE transportation SET transportation_name = '$transportation_name', transportation_sts = '$transportation_sts' WHERE transportation_id = '$transportation_id'");



			if ($q) {



				echo $msg = "Transportation Data Updated Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}



	}







	//Inspection



	if (isset($_POST['services_company_name'])) {

		$data=[
				'services_company_name' =>@ $_POST['services_company_name'],



				'services_company_person' =>@ $_POST['services_company_person'],



				'services_company_contact' =>@ $_POST['services_company_contact'],



				'services_company_fax' =>@ $_POST['services_company_fax'],



				'services_company_email' =>@ $_POST['services_company_email'],
				'services_company_address' =>@ $_POST['services_company_address'],
				'services_company_website' =>@ $_POST['services_company_website'],





				'services_company_sts' =>@ $_POST['services_company_sts'],

		];


		$services_company_id = $_POST['services_company_id'];


			if ($services_company_id == "") {




			if (insert_data($dbc, "services_company", $data)) {

					
				echo $msg = "Services Company Added Successfully";



				exit();



				}else{



					echo $msg = mysqli_error($dbc);



					exit();



				}





		}else{


				if (update_data($dbc, "services_company", $data, "services_company_id", $_POST['services_company_id'])) {

					echo "Services Company Data Updated Successfully";


				}else{



					echo  mysqli_error($dbc);



					exit();



				}



		}







	}



	//Inspection



	if (isset($_POST['airmail_trans_company'])) {

		$data=[
				'airmail_trans_company' =>@ $_POST['airmail_trans_company'],



				'airmail_trans_type' =>@ $_POST['airmail_trans_type'],



				'airmail_trans_weight' =>@ $_POST['airmail_trans_weight'],



				'airmail_trans_country' =>@ $_POST['airmail_trans_country'],



				'airmail_trans_fee' =>@ $_POST['airmail_trans_fee'],
				'airmail_trans_fee_tax' =>@ $_POST['airmail_trans_fee_tax'],
				'airmail_trans_others' =>@ $_POST['airmail_trans_others'],





				'airmail_trans_sts' =>@ $_POST['airmail_trans_sts'],

		];


		$airmail_trans_id = $_POST['airmail_trans_id'];


			if ($airmail_trans_id == "") {




			if (insert_data($dbc, "airmail_transportation", $data)) {

					
				echo $msg = "Airmail Tranportation  Added Successfully";



				exit();



				}else{



					echo $msg = mysqli_error($dbc);



					exit();



				}





		}else{


				if (update_data($dbc, "airmail_transportation", $data, "airmail_trans_id", $_POST['airmail_trans_id'])) {

					echo "Airmail Tranportation  Data Updated Successfully";


				}else{



					echo  mysqli_error($dbc);



					exit();



				}



		}







	}



	//Inspection



	if (isset($_POST['vehicle_expense_name'])) {



		$vehicle_expense_id = $_POST['vehicle_expense_id'];



		$vehicle_expense_name = $_POST['vehicle_expense_name'];



		$vehicle_info_id = $_POST['vehicle_info_id'];



		$vehicle_expense_amount = $_POST['vehicle_expense_amount'];



		$vehicle_expense_tax = $_POST['vehicle_expense_amount_tax'];



		$vehicle_expense_type = $_POST['vehicle_expense_type'];



		if ($vehicle_expense_id == "") {



			$q = mysqli_query($dbc,"INSERT INTO vehicle_expense (vehicle_expense_name, vehicle_info_id, vehicle_expense_amount, vehicle_expense_tax, vehicle_expense_type)  VALUES ('$vehicle_expense_name', '$vehicle_info_id', '$vehicle_expense_amount', '$vehicle_expense_tax', '$vehicle_expense_type')");



			if ($q) {



				echo $msg = "Vehicle Expense Added Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}else{



			$q = mysqli_query($dbc,"UPDATE vehicle_expense SET vehicle_expense_name = '$vehicle_expense_name', vehicle_info_id = '$vehicle_info_id', vehicle_expense_amount = '$vehicle_expense_amount', vehicle_expense_tax = '$vehicle_expense_tax', vehicle_expense_type = '$vehicle_expense_type' WHERE vehicle_expense_id = '$vehicle_expense_id'");



			if ($q) {



				echo $msg = "Vehicle Expense Data Updated Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}



	}







	//Inspection



	if (isset($_POST['vehicle_services_name'])) {



		$data = [



			'vehicle_services_id' => $_POST['vehicle_services_id'], 



			'vehicle_info_id' => $_POST['vehicle_info_id'], 



			'vehicle_services_name' => $_POST['vehicle_services_name'], 



			'vehicle_services_amount' => $_POST['vehicle_services_amount'], 



			'vehicle_services_sts' => $_POST['vehicle_services_sts'], 



		];



		if ($_POST['vehicle_services_id'] == "") {



			if (insert_data($dbc,"vehicle_services", $data)) {



				echo $msg = "Vehicle Services Added Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}else{



			if (update_data($dbc, "vehicle_services", $data, "vehicle_services_id", $_POST['vehicle_services_id'])) {



				echo $msg = "Vehicle Services Data Updated Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}



	}







	//Auction Houses



	if (isset($_POST['auction_home_name'])) {



		$data = [



			'auction_home_name' => strtoupper($_POST['auction_home_name']),



			'company_name' => strtoupper($_POST['auction_company_name']),



			'auction_day' => @$_POST['auction_day'],



			'auction_location' => @$_POST['auction_location'],



			'auction_contact' => @$_POST['auction_contact'],



			'auction_fax' => @$_POST['auction_fax'],



			'auction_house_postal' => @$_POST['auction_house_postal'],
			'auction_address_jp' => @$_POST['auction_address_jp'],
			'auction_address_en' => @$_POST['auction_address_en'],
			'system_bid' => @$_POST['system_bid'],
			'person_incharge' => @$_POST['person_incharge'],
			'business_type' => @$_POST['business_type'],

			


			'auction_url' => @$_POST['auction_url'],
			'auction_email' => @$_POST['auction_email'],



			'region' => @$_POST['region'],



			'auction_fax' => @$_POST['auction_fax'],



			'deadline_transportation' => @$_POST['deadline_transportation'],



			'payment_deadline' => @$_POST['payment_deadline'],



			'house_fee' => @$_POST['house_fee'],



			'live_fee' => @$_POST['live_fee'],



			'price_offer_fee' => @$_POST['price_offer_fee'],



			'pos' => @$_POST['pos'],



			'auction_home_sts' => @$_POST['auction_home_sts'],







		];



		if ($_POST['auction_home_id'] == "") {



			if (insert_data($dbc, "auction_home", $data)) {



				echo $msg = "Auction Home Added Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}else{



			if (update_data($dbc, "auction_home", $data, "auction_home_id", $_POST['auction_home_id'])) {



				echo $msg = "Auction Home Data Updated Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}



	}







	//Auction Houses



	if (isset($_POST['brand_name'])) {



		$data = [



			'maker_id' => $_POST['maker_id'],



			'brand_name' => $_POST['brand_name'],



			'brand_status' => $_POST['brand_status'],



			'brand_m3' => $_POST['brand_m3'],



		];



		if ($_POST['brand_id'] == "") {



			if (insert_data($dbc, "brands", $data)) {



				echo $msg = "Brands Added Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}else{



			if (update_data($dbc, "brands", $data, "brand_id", $_POST['brand_id'])) {



				echo $msg = "Brands Data Updated Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}



	}







	//Auction Houses



	if (isset($_POST['bidder_name'])) {



		$data = [



			'bidders_name' => $_POST['bidder_name'],



			'bidders_sts' => $_POST['bidder_sts'],



		];



		if ($_POST['bidder_id'] == "") {



			if (insert_data($dbc, "bidders", $data)) {



				echo $msg = "Bidders Added Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}else{



			if (update_data($dbc, "bidders", $data, "bidders_id", $_POST['bidder_id'])) {



				echo $msg = "Bidders Data Updated Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}



	}







	//Auction Houses



	if (isset($_POST['ricksu_company_name'])) {



		$data = [



			'ricksu_company_name' => $_POST['ricksu_company_name'],



			'ricksu_company_fee' => $_POST['ricksu_company_fee'],



			'ricksu_company_sts' => $_POST['ricksu_company_sts'],



			'ricksu_company_email' => $_POST['ricksu_company_email'],



			'ricksu_company_website' => $_POST['ricksu_company_website'],



			'ricksu_company_contact_person' => $_POST['ricksu_company_contact_person'],



			'ricksu_company_contact' => $_POST['ricksu_company_contact'],



			'ricksu_company_fax' => $_POST['ricksu_company_fax'],



		];



		if ($_POST['ricksu_company_id'] == "") {



			if (insert_data($dbc, "ricksu_company", $data)) {



				echo $msg = "Ricksu Company Added Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}else{



			if (update_data($dbc, "ricksu_company", $data, "ricksu_company_id", $_POST['ricksu_company_id'])) {



				echo $msg = "Ricksu Company Data Updated Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}



	}



	//risku tranportion



	if (isset($_POST['riksu_transportation'])) {



		$data = [



			'riksu_company_id' => $_POST['riksu_company_id'],



			'auction_house_name' => strtoupper($_POST['auction_house_name']),

			'PORT' => strtoupper($_POST['ricksu_port']),



			'running_fee' => $_POST['running_fee'],



			'notrunning_fee' => $_POST['not_running'],



			'free_days' => $_POST['free_days'],



			



		];



		if ($_POST['ricksu_trans_id'] == "") {



			if (insert_data($dbc, "riksu_transportation", $data)) {



				echo $msg = "Ricksu Transportation Added Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}else{



			if (update_data($dbc, "riksu_transportation", $data, "id", $_POST['ricksu_trans_id'])) {



				echo $msg = "Ricksu Transportation Data Updated Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}



	}







	//shipper 



	if (isset($_POST['shipper_name'])) {



		$data = [



			'shipper_name' => $_POST['shipper_name'],



			'shipper_email' => $_POST['shipper_email'],



			'shipper_contact_person' => $_POST['shipper_contact_person'],



			'shipper_state' => $_POST['shipper_state'],



			'shipper_city' => $_POST['shipper_city'],



			'shipper_suburb' => $_POST['shipper_suburb'],



			'shipper_street' => $_POST['shipper_street'],



			'shipper_floor' => $_POST['shipper_floor'],



			'shipper_zip_code' => $_POST['shipper_zip_code'],



			'shipper_other' => $_POST['shipper_other'],



			'shipper_landline' => $_POST['shipper_landline'],



			'shipper_mobile' => $_POST['shipper_mobile'],



			'shipper_fax' => $_POST['shipper_fax'],



			'shipper_sts' => $_POST['shipper_sts'],



			'shipper_country' => $_POST['shipper_country'],



			'shipper_web' => $_POST['shipper_web'],



		];



		if ($_POST['shipper_id'] == "") {



			if (insert_data($dbc, "shipper", $data)) {



				echo $msg = "Shipper Added Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}else{



			if (update_data($dbc, "shipper", $data, "shipper_id", $_POST['shipper_id'])) {



				echo $msg = "Shipper Data Updated Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}



	}



	



	//Shipment



	if (isset($_POST['shipment_company_name'])) {



		$data = [



			'shipment_company_name' => $_POST['shipment_company_name'],



			'shipment_company_email' => $_POST['shipment_company_email'],



			'shipment_company_contact_person' => $_POST['shipment_company_contact_person'],



			'shipment_company_state' => $_POST['shipment_company_state'],



			'shipment_company_city' => $_POST['shipment_company_city'],



			'shipment_company_suburb' => $_POST['shipment_company_suburb'],



			'shipment_company_street' => $_POST['shipment_company_street'],



			'shipment_company_floor' => $_POST['shipment_company_floor'],



			'shipment_company_zip_code' => $_POST['shipment_company_zip_code'],



			'shipment_company_other' => $_POST['shipment_company_other'],



			'shipment_company_landline' => $_POST['shipment_company_landline'],



			'shipment_company_mobile' => $_POST['shipment_company_mobile'],



			'shipment_company_fax' => $_POST['shipment_company_fax'],



			'shipment_company_sts' => $_POST['shipment_company_sts'],



			'shipment_company_country' => $_POST['shipment_company_country'],



			'shipment_company_web' => $_POST['shipment_company_web'],



		];



		if ($_POST['shipment_company_id'] == "") {



			if (insert_data($dbc, "shipment_company", $data)) {



				echo $msg = "Shipment Company Added Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}else{



			if (update_data($dbc, "shipment_company", $data, "shipment_company_id", $_POST['shipment_company_id'])) {



				echo $msg = "Shipment Company Data Updated Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}



	}







	//body_type



	if (isset($_POST['body_type_name'])) {



		if ($_POST['body_type_id'] == "") {



			if (upload_pic($_FILES['body_type_img'], "../img/vehicles_images/")) {



				$data = [



					'body_type_name' => $_POST['body_type_name'],



					'body_type_sts' => $_POST['body_type_sts'],



					'body_type_img' => $_SESSION['pic_name'],



				];



				if (insert_data($dbc, "body_type", $data)) {



					echo $msg = "Body Type Added Successfully";



					exit();



				}else{



					echo $msg = mysqli_error($dbc);



					exit();



				}



			}



		}else{



			if (upload_pic($_FILES['body_type_img'], "../img/vehicles_images/")) {



				$data = [



					'body_type_name' => $_POST['body_type_name'],



					'body_type_img' => $_SESSION['pic_name'],



					'body_type_sts' => $_POST['body_type_sts'],



				];



				if (update_data($dbc, "body_type", $data, "body_type_id", $_POST['body_type_id'])) {



					echo $msg = "Body Type Data Updated Successfully";



					exit();



				}else{



					echo $msg = mysqli_error($dbc);



					exit();



				}



			}



		}



	}







	if (isset($_POST['vehicle_stock_id'])) {



if (get($dbc,"color_code  WHERE color_name ='".$_POST['vehicle_color_name']."'  AND color_maker = '".$_POST['vehicle_maker']."' ")) {	



			$color=[



			'color_name'=>$_POST['vehicle_color_name'],



			'color_maker'=>$_POST['vehicle_maker'],



			'color_code_name'=>$_POST['vehicle_color'],



			'color_code_sts'=>1,



		];



		insert_data($dbc, "color_code", $color);



		



		}

		// upload_files($_FILES['auction_sheet'],"../img/vehicle_docs/");

		// $_SESSION['auction_sheet']=$_SESSION['pic_name'];

		// unset($_SESSION['pic_name']);

		$data = [

			'vehicle_chassis_no' => $_POST['vehicle_chassis_no'],



			'vehicle_engine_no' => strtoupper($_POST['vehicle_engine_no']),



			'vehicle_engine_type' => strtoupper($_POST['vehicle_engine_type']),



			'vehicle_loading_capacity' => $_POST['vehicle_loading_capacity'],



			'vehicle_weight' => $_POST['vehicle_weight'],



			'vehicle_access' => $_POST['vehicle_access'],



			'vehicle_m3' => $_POST['vehicle_m3'],



			'vehicle_km' => $_POST['vehicle_km'],



			'vehicle_km2' => $_POST['vehicle_km2'],



			'vehicle_manu_year' => $_POST['vehicle_manu_year'],



			'vehicle_reg_month' => $_POST['vehicle_reg_month'],



			'vehicle_reg_year' => $_POST['vehicle_reg_year'],



			'vehicle_maker' => $_POST['vehicle_maker'],



			'vehicle_brand' => $_POST['vehicle_brand'],



			'vehicle_grade' => $_POST['vehicle_grade'],



			'vehicle_cc' => $_POST['vehicle_cc'],



			'vehicle_transmission' => $_POST['vehicle_transmission'],



			'vehicle_drive' => $_POST['vehicle_drive'],



			'vehicle_fuel' => $_POST['vehicle_fuel'],



			'vehicle_package' => $_POST['vehicle_package'],



			'vehicle_option' => $_POST['vehicle_option'],



			'vehicle_door' => $_POST['vehicle_door'],



			'vehicle_seat' => $_POST['vehicle_seat'],



			'vehicle_color' => strtoupper($_POST['vehicle_color']),



			'vehicle_color_name' => $_POST['vehicle_color_name'],



			'vehicle_interior' => $_POST['vehicle_interior'],



			'vehicle_exterior' => $_POST['vehicle_exterior'],



			'vehicle_width' => $_POST['vehicle_width'],



			'vehicle_length' => $_POST['vehicle_length'],



			'vehicle_note' => $_POST['vehicle_note'],



			'vehicle_height' => $_POST['vehicle_height'],



			'vehicle_chassis_code' => $_POST['vehicle_chassis_code'],



			'vehicle_type' => $_POST['vehicle_type'],



			'vehicle_url' => $_POST['vehicle_url'],



			'vehicle_est_price' => $_POST['vehicle_est_price'],



			'vehicle_interior_color' => $_POST['vehicle_interior_color'],



			'vehicle_manu_month' => $_POST['vehicle_manu_month'],



			'vehicle_mode' => $_POST['vehicle_mode'],



			'vehicle_discount' => $_POST['vehicle_discount'],

			




			



			// 'vehicle_freight_charges' => $_POST['vehicle_freight_charges'],



			// 'vehicle_freight_charges_tax' => $_POST['vehicle_freight_charges_tax'],



			// 'vehicle_bl_charges' => $_POST['vehicle_bl_charges'],



			// 'vehicle_bl_charges_tax' => $_POST['vehicle_bl_charges_tax'],



			// 'vehicle_terminal_charges' => $_POST['vehicle_terminal_charges'],



			// 'vehicle_terminal_charges_tax' => $_POST['vehicle_terminal_charges_tax'],



		];





		if ($_POST['vehicle_id'] == "") {







			$q = mysqli_query($dbc,"INSERT INTO package (pack_name, pack_sts)  VALUES ('$_POST[vehicle_package]', '1')");



			$vehicle_color=$_POST['vehicle_color'];



			// if (get($dbc,"color_code WHERE vehicle_color='$vehicle_color'")) {



			// 	$data2=['vehicle_color' => $vehicle_color,];



			// 	insert_data($dbc, "color_code", $data2);



			// 	# code...



			// }











			if (insert_data($dbc, "vehicle_info", $data)) {

				echo $last_id = mysqli_insert_id($dbc);
				$stock_id=[
					'vehicle_stock_id' => $_POST['vehicle_stock_pre'].$_POST['vehicle_stock_id'],
					
				];
				update_data($dbc, "vehicle_info", $stock_id, "vehicle_id ", $last_id);

		
				



				



				exit();



			}else{



				echo mysqli_error($dbc);



				exit();



			}



		}else{



			$q = mysqli_query($dbc,"INSERT INTO package (pack_name, pack_sts)  VALUES ('$_POST[vehicle_package]', '1')");



			if (update_data($dbc, "vehicle_info", $data, "vehicle_id ", $_POST['vehicle_id'])) {

				$stock_id=[
					'vehicle_stock_id' =>$_POST['vehicle_stock_id'],
				];
				update_data($dbc, "vehicle_info", $stock_id, "vehicle_id ", $_POST['vehicle_id']);

				echo  $_POST['vehicle_id'];
				

				// $general=['vehicle_id'=>$last_id,

				// 	'file_title'=>'auction sheet',

				// 	'file_type'=>'general document',

				// 	'airmail_file_name'=>$_SESSION['auction_sheet'],

				// ];

				// @update_dataMultiple($dbc, "airmail_files", $general,"vehicle_id='$last_id' AND file_title='auction sheet'");

				exit();



			}else{



				echo mysqli_error($dbc);



				exit();



			}



		}



	}



	if (isset($_POST['auction_house'])) {

		// upload_files($_FILES['auction_bill'],"../img/vehicle_docs/");

		// $_SESSION['auction_bill']=$_SESSION['pic_name'];

		// unset($_SESSION['pic_name']);

		

		$data = [



			'auction_house' => strtoupper($_POST['auction_house']),
			'pos_number' => @$_POST['pos_number'],



			'auction_house_type' => $_POST['auction_house_type'],



			'auction_date' => $_POST['auction_date'],



			'auction_fee' => $_POST['auction_fee'],



			'auction_start_price' => $_POST['auction_start_price'],



			'auction_win_price' => $_POST['auction_win_price'],



			'auction_transport_due_date' => $_POST['auction_transport_due_date'],



			'auction_bidder' => $_POST['auction_bidder'],



			'auction_turn' => $_POST['auction_turn'],

			'auction_deadline' => $_POST['auction_deadline'],



			'auction_win_by' => $_POST['auction_win_by'],



			'auction_recycle_fee' => $_POST['auction_recycle_fee'],



			'auction_note' => $_POST['auction_note'],



			'auction_fee_tax' => @$_POST['auction_fee_tax'],



			'auction_win_price_tax' => @$_POST['auction_win_price_tax'],



			'auction_recycle_fee_tax' => @$_POST['auction_recycle_fee_tax'],



			'vehicle_id' => $_POST['vehicle_id'],

			'security_deposit'=>$_POST['security_deposit'],
			'auction_loading_point' => $_POST['auction_loading_point'],
			'auction_sub_yard' => $_POST['auction_sub_yard'],

			


		];

// $general=['vehicle_id'=>$_POST['vehicle_id'],

// 					'file_title'=>'auction bill',

// 					'file_type'=>'general document',

// 					'airmail_file_name'=>$_SESSION['auction_bill'],

// 				];



		if ($_POST['auction_id'] == "") { 



			if (insert_data($dbc, "auction_info", $data)) {

				

			// insert_data($dbc, "airmail_files", $general);



				echo $last_id = $_POST['vehicle_id'];



				$_SESSION['auction_id'] = mysqli_insert_id($dbc);



				exit();



			}else {



				echo mysqli_error($dbc);



				exit();



			}



		}else{



			if (update_data($dbc, "auction_info", $data, "auction_id", $_POST['auction_id'])) {

				echo $last_id = $_POST['vehicle_id'];



				$_SESSION['auction_id'] = mysqli_insert_id($dbc);
				exit();



			}else{



				echo mysqli_error($dbc);



				exit();



			}



		}



	}



	if (!empty($_POST['action']) AND $_POST['action']=="add_customer") {

		if (@$_POST['customer_identity_action']=="add") {
			upload_files(@$_FILES['customer_identity'],"../img/vehicle_docs/");

			$customer_identity=$_SESSION['pic_name'];

			unset($_SESSION['pic_name']);

		}else{
			$customer_identity=@$_POST['customer_identity_action'];
		}
		$currnt='';
			if ($_POST['customer_role']=="bank") {
				if (isset($_POST['customer_country'])) {
					$x=0;
					foreach ($_POST['customer_country'] as $key => $value) {
						$current_values[]=$value;
						$x++;
					}
				$currnt=json_encode($current_values);
				}
			}else{
				$currnt=$_POST['customer_country'];	
			}
		$data = [



			'customer_name' => @$_POST['customer_name'],
			'customer_identity' => @$customer_identity,


			'customer_email' => @$_POST['customer_email'],



			'customer_city' => @$_POST['customer_city'],



			'customer_country' => @$currnt,



			'customer_address' => @$_POST['customer_address'],



			'customer_active' => @$_POST['customer_active'],



			'customer_company' => @$_POST['customer_company'],



			'customer_email2' => @$_POST['customer_email2'],



			'customer_skype' => @$_POST['customer_skype'],



			'customer_role' => @$_POST['customer_role'],



			'customer_street' => @$_POST['customer_street'],



			'customer_floor' => @$_POST['customer_floor'],



			'customer_state' => @$_POST['customer_state'],




			'customer_zip_code' => @$_POST['customer_zip_code'],



			'customer_suburb' => @$_POST['customer_suburb'],



			'customer_type' => @$_POST['customer_type'],



			'customer_designation' => @$_POST['customer_designation'],



			'customer_final_port' => @$_POST['customer_final_port'],



			'customer_contact_person' => @$_POST['customer_contact_person'],



			'customer_phone' 	 => @$_POST['customer_phone1'],



			'customer_whatsapp'  => @$_POST['customer_whatsapp1'],



			'customer_viber' 	 => @$_POST['customer_viber1'],



			'customer_phone2' 	 => @$_POST['customer_phone2'],



			'customer_viber2' 	 => @$_POST['customer_viber2'],



			'customer_whatsapp2' => @$_POST['customer_whatsapp2'],



			'customer_landline' => @$_POST['customer_landline'],



			'customer_fax' => @$_POST['customer_fax'],



			'customer_web' => @$_POST['customer_web'],



			'customer_fee' => @$_POST['customer_fee'],



			'customer_fee_tax' => @$_POST['customer_fee_tax'],



			'customer_buy_date' => @$_POST['customer_buy_date'],



			'customer_buy_currency' => @$_POST['customer_buy_currency'],

			'win_fee' => @$_POST['win_fee'],

			'win_fee_tax' => @$_POST['win_fee_tax'],

			'commission_fee' => @$_POST['commission_fee'],

			'commission_fee_tax' => @$_POST['commission_fee_tax'],

			'recycle_fee' => @$_POST['recycle_fee'],

			'recycle_fee_tax' => @$_POST['recycle_fee_tax'],

			'bill_document' => @$_SESSION['bill_document'],

			'payment_deadline' => @$_POST['payment_deadline'],

			'security_deposit' => @$_POST['security_deposit'],

			'person_note' => @$_POST['person_note'],

			'vehicle_id' => @$_POST['vehicle_id'],

			'customer_addedby'=>@$_SESSION['userId'],



		];



		// print_r($data);
		


		if ($_POST['customer_id'] == "") {
				if ($_POST['customer_role']=="bank") {
						if (insert_data($dbc, "customers", $data)) {
					$response=['msg'=>"Bank Added Successfully",
							'sts'=>'success',
						];


				



			}else {


			 	$response=['msg'=>mysqli_error($dbc),
							'sts'=>'success',
			];


			}
				}else{
			if (mysqli_num_rows(mysqli_query($dbc,"SELECT * FROM customers WHERE customer_email='".$_POST['customer_email']."' OR customer_phone='".$_POST['customer_phone1']."' "))>0) {
		$response=['msg'=>"Phone or Email Already Registed",
							'sts'=>'warning',
			];
			}else{


			if (insert_data($dbc, "customers", $data)) {
					$response=['msg'=>"Customer Added Successfully",
							'sts'=>'success',
						];


				



			}else {


				$response=['msg'=>mysqli_error($dbc),
							'sts'=>'success',
			];


			}

			}}

		}else{



			if (update_data($dbc, "customers", $data, "customer_id", $_POST['customer_id'])) {



				$response=['msg'=>"Customer Update Successfully",
							'sts'=>'success',
						];



			}



		}

echo json_encode($response);

	}



 




	if (isset($_POST['ricksu_company'])) {

		// upload_files($_FILES['ricksu_bill'],"../img/vehicle_docs/");

		// $nameNOwThis = $_SESSION['auction_bill']=$_SESSION['pic_name'];

		// unset($_SESSION['pic_name']);

		$data = [



			'ricksu_company' => $_POST['ricksu_company'],
			'ricksu_sub_yard' => strtoupper($_POST['ricksu_sub_yard']),



			'ricksu_loading_point' => strtoupper($_POST['ricksu_loading_point']),



			'ricksu_delievery_point' => strtoupper($_POST['ricksu_delievery_point']),
			'ricksu_dp_sub_yards' => $_POST['ricksu_dp_sub_yards'],



		 	'ricksu_type' => @$_POST['ricksu_type'],



			'ricksu_yard_service' => $_POST['ricksu_yard_service'],



			'ricksu_arrival_date' => $_POST['ricksu_arrival_date'],



			'ricksu_leaving_date' => $_POST['ricksu_leaving_date'],



			'ricksu_repair_info' => $_POST['ricksu_repair_info'],



			'ricksu_repair_fee' => $_POST['ricksu_repair_fee'],



			'ricksu_ad_service' => $_POST['ricksu_ad_service'],



			'ricksu_fee' => $_POST['ricksu_fee'],



			'ricksu_deliever_by' => $_POST['ricksu_deliever_by'],



			'ricksu_receive_by' => $_POST['ricksu_receive_by'],



			'ricksu_free_at_yard' => $_POST['ricksu_free_at_yard'],



			'ricksu_charger_for_additional' => $_POST['ricksu_charger_for_additional'],



			'ricksu_note' => $_POST['ricksu_note'],



			'ricksu_repair_fee_tax' => @$_POST['ricksu_repair_fee_tax'],



			'ricksu_fee_tax' => @$_POST['ricksu_fee_tax'],



			'ricksu_charger_for_additional_tax' => @$_POST['ricksu_charger_for_additional_tax'],



			'vehicle_id' => $_POST['vehicle_id'],

			


		];
		@$company_email=fetchRecord($dbc,"ricksu_company","ricksu_company_id",$_POST['ricksu_company'])['ricksu_company_email'];

		if ($_POST['ricksu_id'] == "") {



			if (insert_data($dbc, "ricksu", $data)) {
				// insert_data($dbc, "airmail_files", $general);

				$last_inserted_id=mysqli_insert_id($dbc);
				html_mailto($dbc,$company_email,"Nexco Japan LTD CO",$last_inserted_id);
				echo $_POST['vehicle_id'];
				exit();
			}else{



				echo mysqli_error($dbc);



				exit();



			}



		}else{



			if (update_data($dbc, "ricksu", $data, "ricksu_id ", $_POST['ricksu_id'])) {

				//insert_data($dbc, "airmail_files", $general);

					html_mailto($dbc,$company_email,"Nexco Japan LTD CO",$_POST['ricksu_id']);

				echo  $_POST['vehicle_id'];

				// update_dataMultiple($dbc, "airmail_files", $general,"vehicle_id='$last_id' AND file_title='ricksu bill'");

				exit();



			}else{



				echo mysqli_error($dbc);



				exit();



			}



		}



	}







	if (isset($_POST['auctionperson'])) {

		//echo "abcd";



		$data = [



			"consignee_info_user_id" => $_POST['consignee_info_user_id'],



			"consignee_info_customer" => $_POST['consignee_info_customer'],



			"consignee_info_contact" => $_POST['consignee_info_contact'],



			"consignee_info_final_dest" => $_POST['consignee_info_final_dest'],



			"consignee_info_consignee" => $_POST['consignee_info_consignee'],



			"consignee_info_party_name" => $_POST['consignee_info_party_name'],



			"consignee_info_email" => $_POST['consignee_info_email'],



			"consignee_info_date" => $_POST['consignee_info_date'],



			"consignee_info_consignee_address" => $_POST['consignee_info_consignee_address'],



			"consignee_info_party_address" => $_POST['consignee_info_party_address'],



			"consignee_info_note" => $_POST['consignee_info_note'],



			'vehicle_id' => $_POST['vehicle_id']



		];



		if ($_POST['consignee_info_id'] == "") {



			if (insert_data($dbc, "consignee_info", $data)) {



				echo $last_id = $_POST['vehicle_id'];



				exit();



			}else{



				echo mysqli_error($dbc);



				exit();



			}



		}else{



			if (update_data($dbc, "consignee_info", $data, "consignee_info_id ", $_POST['consignee_info_id'])) {



				echo $last_id = $_POST['vehicle_id'];



				exit();



			}else{



				echo mysqli_error($dbc);



				exit();



			}



		}



	}







	if (isset($_POST['export_info_mashou'])) {



		$data = [



			'export_info_mashou' => $_POST['export_info_mashou'],



			'export_info_export_certificate' => $_POST['export_info_export_certificate'],



			'export_info_shipping_order' => $_POST['export_info_shipping_order'],



			// 'export_info_arrival' => $_POST['export_info_arrival'],



			// 'export_info_arrival_date' => $_POST['export_info_arrival_date'],



			'export_info_translation' => $_POST['export_info_translation'],



			'export_info_mashou_date' => $_POST['export_info_mashou_date'],



			'export_info_export_certificate_date' => $_POST['export_info_export_certificate_date'],



			'export_info_shipping_order_date' => $_POST['export_info_shipping_order_date'],



			'export_info_translation_date' => $_POST['export_info_translation_date'],



			'inspection_certificate_date' => $_POST['inspection_certificate_date'],



			'bill_of_lading_date' => $_POST['bill_of_lading_date'],



			'inspection_certificate' => $_POST['inspection_certificate'],



			'bill_of_lading' => $_POST['bill_of_lading'],



			'vehicle_id' => $_POST['vehicle_id']



		];



		if ($_POST['export_info_id'] == "") {



			if (insert_data($dbc, "export_info", $data)) {



				echo $last_id = $_POST['vehicle_id'];



				exit();



			}else{



				echo mysqli_error($dbc);



				exit();



			}



		}else{



			if (update_data($dbc, "export_info", $data, "export_info_id ", $_POST['export_info_id'])) {



				echo $last_id = $_POST['vehicle_id'];



				exit();



			}else{



				echo mysqli_error($dbc);



				exit();



			}



		}



	}







	if (isset($_POST['inspection_info_company'])) {



		$data = [



			'inspection_info_company' => @$_POST['inspection_info_company'],



			'inspection_info_point' => @$_POST['inspection_info_point'],



			'inspection_info_app_date' => @$_POST['inspection_info_app_date'],



			'inspection_info_for' => @$_POST['inspection_info_for'],



			'inspection_info_sts' => @$_POST['inspection_info_sts'],



			'inspection_info_validity' => @$_POST['inspection_info_validity'],



	


			'inspection_info_reason' => @$_POST['inspection_info_reason'],



			'inspection_info_repair_charges' => @$_POST['inspection_info_repair_charges'],



			'inspection_info_repair_charges_tax' => @$_POST['inspection_info_repair_charges_tax'],



			'inspection_info_repair_done_by' => @$_POST['inspection_info_repair_done_by'],



			'inspection_info_note' => @$_POST['inspection_info_note'],



			'inspection_info_reinspection' => @$_POST['inspection_info_reinspection'],



			'inspection_info_reinspection_app_date' => @$_POST['inspection_info_reinspection_app_date'],





			'inspection_info_reinspection_sts' => @$_POST['inspection_info_reinspection_sts'],



			'inspection_info_charges' => @$_POST['inspection_info_charges'],



			'inspection_info_charges_tax' => @$_POST['inspection_info_charges_tax'],



			



			'inspection_info_reinspection1' => @$_POST['inspection_info_reinspection1'],



			'inspection_info_reinspection1_tax' => @$_POST['inspection_info_reinspection1_tax'],









			'vehicle_id' => @$_POST['vehicle_id']



		];



		if ($_POST['inspection_info_id'] == "") {



			if (insert_data($dbc, "inspection_info", $data)) {



				echo $last_id = $_POST['vehicle_id'];



				exit();



			}else{



				echo mysqli_error($dbc);



				exit();



			}



		}else{



			if (update_data($dbc, "inspection_info", $data, "inspection_info_id ", $_POST['inspection_info_id'])) {



				echo $last_id = $_POST['vehicle_id'];



				exit();



			}else{



				echo mysqli_error($dbc);



				exit();



			}	



		}



	}







	if (isset($_POST['shipment_company'])) {

		// upload_files($_FILES['freight_bill'],"../img/vehicle_docs/");

		// $_SESSION['freight_bill']=$_SESSION['pic_name'];

		// unset($_SESSION['pic_name']);

		$data = [



			'shipment_country' => @$_POST['shipment_country'],



			'shipment_ship_name' => $_POST['shipment_ship_name'],



			'shipment_type' => $_POST['shipment_type'],



			'shipment_consignee' => $_POST['shipment_consignee'],



			'shipment_notify_party_name' => $_POST['shipment_notify_party_name'],



			'shipment_destination' => $_POST['shipment_destination'],



			'shipment_access_with_cargo' => $_POST['shipment_access_with_cargo'],



			'shipment_order_no' => $_POST['shipment_order_no'],



			'shipment_port_of_landing' => @$_POST['shipment_port_of_landing'],
			'shipment_landing_country' => @$_POST['shipment_landing_country'],



			'shipment_voyage_no' => $_POST['shipment_voyage_no'],



			'shipment_container_no' => $_POST['shipment_container_no'],



			'shipment_consignee_address' => $_POST['shipment_consignee_address'],



			'auction_note' => $_POST['auction_note'],



			'shipment_measures_m3' => $_POST['shipment_measures_m3'],



			'shipment_hc_code'=>$_POST['shipment_hc_code'],



			'shipment_notes' => $_POST['shipment_notes'],



			'shipment_port_of_discharge' => $_POST['shipment_port_of_discharge'],



			'shipment_date' => $_POST['shipment_date'],



			'shipment_order_cutting_date' => $_POST['shipment_order_cutting_date'],



			'shipment_wieght' => $_POST['shipment_wieght'],



			'shipment_contact' => $_POST['shipment_contact'],



			'shipment_contact2' => $_POST['shipment_contact2'],



			'shipment_shipping_line' => $_POST['shipment_shipping_line'],



			'vehicle_id' => $_POST['vehicle_id'],



			'shipment_company' => $_POST['shipment_company'],



			'shipper_id' => $_POST['shipper'],



			'inner_cargo_l' => $_POST['inner_cargo_l'],



			'inner_cargo_w' => $_POST['inner_cargo_w'],



			'inner_cargo_h' => $_POST['inner_cargo_h'], 



			'inner_cargo_weight' => $_POST['inner_cargo_weight'],



			'ship_etd' => $_POST['shipment_etd'],



			'ship_eta' => $_POST['shipment_eta'],



			'radiation_charges' => $_POST['vehicle_radiation_charges'],



			'radiation_charges_tax' => $_POST['vehicle_radiation_charges_tax'],



			'heat_charges' => $_POST['vehicle_treatment_charges'],



			'heat_charges_tax' => $_POST['vehicle_treatment_charges_tax'],



			'shipping_charges' => $_POST['vehicle_shipping_charges'],



			'shipping_charges_tax' => @$_POST['vehicle_shipping_charges_tax'],



			'other_charges' => $_POST['vehicle_other_charges'],



			'other_charges_tax' => @$_POST['vehicle_other_charges_tax'],

			'bl_number' => $_POST['bl_number'],

		];

			// 'freight_bill'=>@$_SESSION['freight_bill'],



			// $general=['vehicle_id'=>$_POST['vehicle_id'],

			// 		'file_title'=>'freight bill',

			// 		'file_type'=>'general document',

			// 		'airmail_file_name'=>$_SESSION['freight_bill'],

			// 	];

		if ($_POST['shipment_id'] == "") {



			if (insert_data($dbc, "shipment", $data)) {

			



				//insert_data($dbc, "airmail_files", $general);

				echo $last_id = $_POST['vehicle_id'];					



				$data2 = [



					'vehicle_freight_charges' => @$_POST['vehicle_freight_charges'],



					'vehicle_freight_charges_tax' =>@$_POST['vehicle_freight_charges_tax'],



					'vehicle_bl_charges' => $_POST['vehicle_bl_charges'],



					'vehicle_bl_charges_tax' => @$_POST['vehicle_bl_charges_tax'],



					'vehicle_terminal_charges' => $_POST['vehicle_terminal_charges'],



					'vehicle_terminal_charges_tax' => @$_POST['vehicle_terminal_charges_tax'],



				];



				if (update_data($dbc, "vehicle_info", $data2, 'vehicle_id', $last_id)) {

				

		

					exit();	



				}



			}else{



				echo mysqli_error($dbc);



				exit();



			}



		}else{



			if (update_data($dbc, "shipment", $data, "shipment_id ", $_POST['shipment_id'])) {

				echo $last_id = $_POST['vehicle_id'];
				exit();



			}else{



				echo mysqli_error($dbc);



				exit();



			}



		}



	}

	if (isset($_POST['airmail_parcel_no'])) {

		$data = [



			'vehicle_id' => $_POST['vehicle_id'],



			'airmail_consignee' => $_POST['airmail_consignee'],
			'airmail_consignee_name' => $_POST['airmail_consignee_name'],


			'airmail_country' => $_POST['airmail_country'],



			'airmail_city' => $_POST['airmail_city'],



			'airmail_street' => $_POST['airmail_street'],



			'airmail_zipcode' => $_POST['airmail_zipcode'],



			'airmail_landline' => $_POST['airmail_landline'],



			'airmail_contact_no' => $_POST['airmail_contact_no'],



			'airmail_email' => $_POST['airmail_email'],
			'airmail_payment_status' =>@$_POST['airmail_payment_status'],
			'airmail_approval_status' =>@$_POST['airmail_approval_status'],
			'airmail_approved_by' =>@$_POST['airmail_approved_by'],
			'airmail_decline_note' =>@$_POST['airmail_decline_note'],
			'airmail_note' =>@$_POST['airmail_note'],
			'airmail_receiver_note' =>@$_POST['airmail_receiver_note'],



			'airmail_request_by' => $_POST['airmail_request_by'],



			'airmail_parcel_weight' => $_POST['airmail_parcel_weight'],



			'airmail_services_company' => $_POST['airmail_services_company'],
			'airmail_services_parcel_type' => @$_POST['airmail_services_parcel_type'],



			'airmail_tracking_no' => $_POST['airmail_tracking_no'],



			'airmail_receiver_name' => $_POST['airmail_receiver_name'],



			'airmail_state' => $_POST['airmail_state'],



			'airmail_suburb' => $_POST['airmail_suburb'],



			'airmail_floor' => $_POST['airmail_floor'],



			'airmail_receiver_address' => $_POST['airmail_receiver_address'],



			'airmail_fax' => $_POST['airmail_fax'],



			'airmail_contact_receiver' => $_POST['airmail_contact_receiver'],



			'airmail_parcel_no' => $_POST['airmail_parcel_no'],



			'airmail_parcel_detail' => $_POST['airmail_parcel_detail'],



			'airmail_courier_charges' => $_POST['airmail_courier_charges'],



			'airmail_courier_charges_tax' => $_POST['airmail_courier_charges_tax'],



			'airmail_date_of_dispatch' => $_POST['airmail_date_of_dispatch'],

		];



		if ($_POST['airmail_id'] == "") {
			if (insert_data($dbc, "airmail", $data)) {
				$last_inserted_id=mysqli_insert_id($dbc);

				$data_con=['airmail_confirmed_by' =>$_SESSION['userId'],];
				if (update_data($dbc, "airmail", $data_con, "airmail_id ", $last_inserted_id)) {
					echo $last_id = $_POST['vehicle_id'];
					exit();
				}else{
				echo mysqli_error($dbc);
				exit();
				}
				
			}
		}else{
			if (update_data($dbc, "airmail", $data, "airmail_id ", $_POST['airmail_id'])) {
				echo $last_id = $_POST['vehicle_id'];
				exit();
			}else{
				echo mysqli_error($dbc);
				exit();
			}
		}
	}

	if (isset($_POST['reauction_request_by'])) {



		$data = [



			'reauction_id' => $_POST['reauction_id'],



			'vehicle_id' => $_POST['vehicle_id'],



			'reauction_request_by' => $_POST['reauction_request_by'],



			'reauction_approve_by' => $_POST['reauction_approve_by'],



			'ricksu_company' => $_POST['ricksu_companyforReauction'],



			'ricksu_fee' => $_POST['ricksu_fee'],



			'auction_house' => $_POST['auction_houseforReauction'],



			'auction_date' => $_POST['auction_date'],



			'start_price' => $_POST['start_price'],



			'sale_target_price' => $_POST['sale_target_price'],



			'status' => $_POST['status'],



			'sale_price' => $_POST['sale_price'],



			'recycle_fee' => $_POST['recycle_fee'],



			'auction_fee' => $_POST['auction_fee'],



			'sale_fee' => $_POST['sale_fee'],



			'reason' => $_POST['reason'],



			'car_location' => $_POST['car_location'],



			'vehicle_setup' => @$_POST['vehicle_setup'],



			'vehicle_stage' => @$_POST['vehicle_stage'],



			'total_exp' => $_POST['total_exp'],



			'decided_by' => $_POST['decided_by'],



			'sold_by' => $_POST['sold_by'],



			'sale_tax_returning' => @$_POST['sale_tax_returning'],



			'auction_fee_tax' => @$_POST['auction_fee_tax'],



			'sale_fee_tax' => @$_POST['sale_fee_tax'],



			'note' => $_POST['note']



		];



		if ($_POST['reauction_id'] == "") {



			if (insert_data($dbc, "reauction", $data)) {



				echo 'Reauction Added Successfully';



				exit();



			}else{



				echo mysqli_error($dbc);



				exit();



			}



		}else{



			if (update_data($dbc, "reauction", $data, "reauction_id ", $_POST['reauction_id'])) {



				echo $last_id = $_POST['vehicle_id'];



				exit();



			}else{



				echo mysqli_error($dbc);



				exit();



			}



		}



	}







	//Getting Data For Edit Purpose



	if (isset($_POST['edit_user_id']) && isset($_POST['edit_user_id']) != "") {



	 	$id = $_POST['edit_user_id'];



		$table = $_POST['tbl2'];



		$fld = $_POST['col2'];



	 	$q = mysqli_query($dbc,"SELECT * FROM $table WHERE $fld = '$id'");



		$response = array();



		while($r = mysqli_fetch_assoc($q)){



			$response = $r;



		}



		echo json_encode($response);	



		exit();



	}







	//Getting Data For Edit Purpose



	if (isset($_POST['loadVehicle']) && isset($_POST['loadVehicle']) != "") {



	 	$id = $_POST['loadVehicle'];



	 	$q = mysqli_query($dbc,"SELECT vehicle_info.*,brands.*,models.* FROM vehicle_info INNER JOIN brands ON brands.brand_id =vehicle_info.vehicle_brand INNER JOIN models ON models.model_id =vehicle_info.vehicle_chassis_code WHERE vehicle_info.vehicle_id = $id ");



		$response = array();



		while($r = mysqli_fetch_assoc($q)){



			$response[] = $r;



		}



		echo json_encode($response);	



		exit();



	}







	//Getting Data For Edit Purpose



	if (isset($_POST['load_auction_idMain']) && isset($_POST['load_auction_idMain']) != "") {



	 	$id = $_POST['load_auction_idMain'];



	 	$action = $_POST['action'];



	 	if ($action == 'load') {



			$q = mysqli_query($dbc,"SELECT auction_info.*, auction_home.* FROM auction_info INNER JOIN auction_home WHERE auction_info.vehicle_id = $id GROUP BY vehicle_id");

			//echo "SELECT auction_info.*, auction_home.* FROM auction_info INNER JOIN auction_home WHERE auction_info.vehicle_id = $id GROUP BY vehicle_id";



	 	}else{



			$q = mysqli_query($dbc,"SELECT * FROM auction_info WHERE vehicle_id = '$id'");

			//echo "SELECT * FROM auction_info WHERE auction_id = $id";



	 	}



		$response = array();
					# code...
		
		

		while($r = mysqli_fetch_assoc($q)){



			$response[] = $r;



		



		echo json_encode($response);	



		exit();
		}



	}



//Getting Data For Edit Purpose



	if (isset($_POST['load_auctionPerson_idMain']) && isset($_POST['load_auctionPerson_idMain']) != "") {



	 	$id = $_POST['load_auctionPerson_idMain'];



	 	$action = $_POST['action'];



	 	if ($action == 'load') {

 

			$q = mysqli_query($dbc,"SELECT auction_person.*, auction_home.* FROM auction_person INNER JOIN auction_home WHERE auction_person.vehicle_id = '$id' GROUP BY vehicle_id");

			//echo "SELECT auction_info.*, auction_home.* FROM auction_info INNER JOIN auction_home WHERE auction_info.vehicle_id = $id GROUP BY vehicle_id";



	 	}else{



			//$q = mysqli_query($dbc,"SELECT * FROM auction_person WHERE auction_id = '$id'");

			$q = mysqli_query($dbc,"SELECT auction_person.*, auction_home.*FROM auction_person INNER JOIN auction_home WHERE auction_person.vehicle_id = '$id'");

			//echo "SELECT * FROM auction_person WHERE auction_id = '$id'";



	 	}



		$response = array();



		while($r = mysqli_fetch_assoc($q)){



			$response[] = $r;



		}



		echo json_encode($response);	



		exit();



	}







	//Getting Data For Edit Purpose



	if (isset($_POST['load_reservation_idMain']) && isset($_POST['load_reservation_idMain']) != "") {



	 	$id = $_POST['load_reservation_idMain'];



	 	$action = $_POST['action'];



	 	if ($action == 'load') {

	 		$reservation =mysqli_num_rows(mysqli_query($dbc,"SELECT * FROM invoice WHERE invoice_vehicle = $id"));
	 		if ($reservation>0) {
	 			$q = mysqli_query($dbc,"SELECT  reservation.*,invoice.*,customers.*,users.*,vehicle_info.* FROM reservation INNER JOIN customers ON customers.customer_id = reservation.reservation_customer INNER JOIN vehicle_info ON vehicle_info.vehicle_id = reservation.vehicle_id INNER JOIN invoice ON invoice.invoice_vehicle = reservation.vehicle_id INNER JOIN users ON users.user_id = reservation.reservation_by   WHERE reservation.vehicle_id = '$id' ORDER BY reservation.reservation_id ASC ");
	 		}else{
	 			$q = mysqli_query($dbc,"SELECT  reservation.*,customers.*,users.*,vehicle_info.* FROM reservation INNER JOIN customers ON customers.customer_id = reservation.reservation_customer INNER JOIN vehicle_info ON vehicle_info.vehicle_id = reservation.vehicle_id INNER JOIN users ON users.user_id = reservation.reservation_by   WHERE reservation.vehicle_id = '$id' ORDER BY reservation.reservation_id ASC ");
	 		}

	 	}else{



		 	$q = mysqli_query($dbc,"SELECT * FROM reservation WHERE reservation_id = $id");



	 	}



		$response = array();



		while($r = mysqli_fetch_assoc($q)){



			$response[] = $r;



		}



		echo json_encode($response);	



		exit();



	}







	//Getting Data For Edit Purpose



	if (isset($_POST['load_ricksu_idMain']) && isset($_POST['load_ricksu_idMain']) != "") {



	 	$id = $_POST['load_ricksu_idMain'];



	 	$action = $_POST['action'];



	 	if ($action == "load") {



		 	$q = mysqli_query($dbc,"SELECT ricksu.*, ricksu_company.*,sub_yards.* FROM ricksu INNER JOIN ricksu_company ON ricksu.ricksu_company = ricksu_company.ricksu_company_id INNER JOIN sub_yards ON sub_yards.sub_yard_id = ricksu.ricksu_sub_yard WHERE ricksu.vehicle_id = '$id' AND mini_ricksu!=1 AND ricksu_sts=1 ");



	 	}else{



		 	// $q = mysqli_query($dbc,"SELECT * FROM ricksu WHERE ricksu_id = $id");
		 	$q = mysqli_query($dbc,"SELECT ricksu.*, ricksu_company.*,sub_yards.* FROM ricksu INNER JOIN ricksu_company ON ricksu.ricksu_company = ricksu_company.ricksu_company_id INNER JOIN sub_yards ON sub_yards.sub_yard_id = ricksu.ricksu_sub_yard WHERE ricksu.vehicle_id = '$id' AND mini_ricksu!=1  AND ricksu_sts=1 ");



	 	}



		$response = array();



		while($r = mysqli_fetch_assoc($q)){



			$response[] = $r;



		}



		echo json_encode($response);	



		exit();



	}







	//Getting Data For Edit Purpose



	if (isset($_POST['load_export_idMain']) && isset($_POST['load_export_idMain']) != "") {



	 	$id = $_POST['load_export_idMain'];



	 	$action = $_POST['action'];



	 	if ($action == 'load') {



		 	$q = mysqli_query($dbc,"SELECT * FROM export_info WHERE vehicle_id = $id"); 		



	 	}else{



		 	$q = mysqli_query($dbc,"SELECT * FROM export_info WHERE vehicle_id = $id"); 		



	 	}



		$response = array();



		while($r = mysqli_fetch_assoc($q)){



			$response[] = $r;



		}



		echo json_encode($response);	



		exit();



	}







	//Getting Data For Edit Purpose



	if (isset($_POST['load_consignee_idMain']) && isset($_POST['load_consignee_idMain']) != "") {



	 	$id = $_POST['load_consignee_idMain'];



	 	$action = $_POST['action'];



	 	if ($action == 'load') {



		 		$q = mysqli_query($dbc,"SELECT consignee_info.*, customers.*,consignee.*  FROM consignee_info INNER JOIN customers ON customers.customer_id = consignee_info.consignee_info_customer INNER JOIN consignee ON consignee.consignee_id = consignee_info.consignee_info_consignee  WHERE consignee_info.vehicle_id = $id");


	 	}else{



		 	$q = mysqli_query($dbc,"SELECT consignee_info.*, customers.*,consignee.*  FROM consignee_info INNER JOIN customers ON customers.customer_id = consignee_info.consignee_info_customer INNER JOIN consignee ON consignee.consignee_id = consignee_info.consignee_info_consignee WHERE consignee_info.consignee_info_id='$id' "); 		



	 	}



		$response = array();



		while($r = mysqli_fetch_assoc($q)){



			$response[] = $r;



		}



		echo json_encode($response);	



		exit();



	}







	//Getting Data For Edit Purpose



	if (isset($_POST['load_inspection_idMain']) && isset($_POST['load_inspection_idMain']) != "") {



	 	$id = $_POST['load_inspection_idMain'];



	 	$action = $_POST['action'];



	 	if ($action == 'load') {



		 	$q = mysqli_query($dbc,"SELECT inspection_info.*, inspection_company.* FROM inspection_info INNER JOIN inspection_company ON inspection_info.inspection_info_company = inspection_company.inspection_company_id WHERE inspection_info.vehicle_id = $id");



	 	}else{



		 	$q = mysqli_query($dbc,"SELECT * FROM inspection_info WHERE vehicle_id = $id"); 		



	 	}



		$response = array();



		while($r = mysqli_fetch_assoc($q)){



			$response[] = $r;



		}



		echo json_encode($response);	



		exit();



	}







	//Getting Data For Edit Purpose



	if (isset($_POST['load_shipment_idMain']) && isset($_POST['load_shipment_idMain']) != "") {



	 	$id = $_POST['load_shipment_idMain'];



	 	$action = $_POST['action'];



	 	if ($action == 'load') {



		 	$q = mysqli_query($dbc,"SELECT * FROM shipment WHERE vehicle_id = $id");



	 	}else{



		 	$q = mysqli_query($dbc,"SELECT shipment.*, vehicle_info.* FROM shipment INNER JOIN vehicle_info ON vehicle_info.vehicle_id = shipment.vehicle_id WHERE shipment.vehicle_id = $id"); 		



	 	}



		$response = array();

if (mysqli_num_rows($q)>0) {
	# code...


		while($r = mysqli_fetch_assoc($q)){



			$response[] = $r;



		}



		echo json_encode($response);	


}
		exit();



	}







	//Getting Data For Edit Purpose



	if (isset($_POST['load_airmail_idMain']) && isset($_POST['load_airmail_idMain']) != "") {



	 	$id = $_POST['load_airmail_idMain'];



	 	$action = $_POST['action'];



	 	if ($action == 'load') {



		 	$q = mysqli_query($dbc,"SELECT * FROM airmail WHERE vehicle_id = $id");



	 	}else{



		 	$q = mysqli_query($dbc,"SELECT airmail.*,users.* FROM airmail INNER JOIN users ON users.user_id=airmail.airmail_confirmed_by WHERE airmail.vehicle_id = $id "); 		



	 	}



		$response = array();



		while($r = mysqli_fetch_assoc($q)){



			$response[] = $r;



		}



		echo json_encode($response);	



		exit();



	}







	//Getting Data For Edit Purpose



	if (isset($_POST['load_img_idMain']) && isset($_POST['load_img_idMain']) != "") {



	 	$id = $_POST['load_img_idMain'];



	 	$q = mysqli_query($dbc,"SELECT * FROM vehicle_images WHERE vehicle_id = $id ORDER BY order_no ASC" );



		$response = array();



		while($r = mysqli_fetch_assoc($q)){



			$response[] = $r;



		}



		echo json_encode($response);	



		exit();



	}







	//Getting Data For Edit Purpose



	if (isset($_POST['delete_user_id']) && isset($_POST['delete_user_id']) != "") {



	 	$id = $_POST['delete_user_id'];



		$table = $_POST['tbl3'];



		$fld = $_POST['col_name'];



		$sts = $_POST['sts_col'];



		if ($sts != "") {



		 	$q = mysqli_query($dbc,"UPDATE $table SET $sts = 0 WHERE $fld = '$id'");



		 	echo "Record Deleted Successfully From $table Table";	



		}else{



		 	$q = deleteFromTable($dbc,$table, $fld, $id);



	 		echo "Record Permanently Deleted Successfully From $table Table";	



		}



		exit();



	}







	//Getting Data For Edit Purpose



	if (isset($_POST['tblName']) && isset($_POST['tblName']) != "") {



	 	$tblName = $_POST['tblName'];



	 	$colID = $_POST['colID'];



	 	if ($tblName == 'vehicle_info') {



		 	$q = mysqli_query($dbc,"SELECT vehicle_info.*, maker.*, brands.*,models.*,body_type.* FROM vehicle_info INNER JOIN maker ON vehicle_info.vehicle_maker = maker.maker_id INNER JOIN brands ON brands.brand_id = vehicle_info.vehicle_brand INNER JOIN models ON models.model_id = vehicle_info.vehicle_chassis_code INNER JOIN body_type ON body_type.body_type_id = vehicle_info.vehicle_type WHERE vehicle_info.vehicle_id = $colID");



	 	}elseif ($tblName == 'auction_info') {



		 	$q = mysqli_query($dbc,"SELECT auction_info.*, auction_home.*, bidders.* FROM auction_info INNER JOIN auction_home ON auction_info.auction_house = auction_home.auction_home_id INNER JOIN bidders ON bidders.bidders_id = auction_info.auction_bidder WHERE auction_info.vehicle_id = $colID");



	 	}elseif($tblName == "ricksu"){



		 	$q = mysqli_query($dbc,"SELECT ricksu.*, ricksu_company.* FROM ricksu INNER JOIN ricksu_company ON ricksu.ricksu_company = ricksu_company.ricksu_company_id WHERE ricksu.vehicle_id = $colID");



	 	}elseif ($tblName == "reservation") {



		 	$q = mysqli_query($dbc,"SELECT reservation.*, users.*, customers.* FROM reservation INNER JOIN users ON reservation.reservation_by = users.user_id INNER JOIN customers ON customers.customer_id = reservation.reservation_customer  WHERE reservation.vehicle_id = $colID");



	 	}elseif ($tblName == "export_info") {



		 	$q = mysqli_query($dbc,"SELECT * FROM export_info WHERE vehicle_id = $colID");



	 	}elseif ($tblName == "consignee_info") {


		 	$q = mysqli_query($dbc,"SELECT consignee_info.*, customers.*,consignee.*  FROM consignee_info INNER JOIN customers ON customers.customer_id = consignee_info.consignee_info_customer INNER JOIN consignee ON consignee.consignee_id = consignee_info.consignee_info_consignee  WHERE consignee_info.vehicle_id = '$colID' ");



	 	}elseif ($tblName == "inspection_info") {



		 	$q = mysqli_query($dbc,"SELECT inspection_info.*, inspection_company.* FROM inspection_info INNER JOIN inspection_company ON inspection_info.inspection_info_company = inspection_company.inspection_company_id  WHERE inspection_info.vehicle_id = $colID");



	 	}elseif ($tblName == "shipment") {



		 	$q = mysqli_query($dbc,"SELECT shipment.*, consignee.*, shipment_company.*, shipper.*,vehicle_info.* FROM shipment LEFT OUTER JOIN consignee ON shipment.shipment_consignee = consignee.consignee_id INNER JOIN shipment_company ON shipment.shipment_company = shipment_company.shipment_company_id LEFT OUTER JOIN shipper ON shipper.shipper_id = shipment.shipper_id LEFT OUTER JOIN vehicle_info ON vehicle_info.vehicle_id = shipment.vehicle_id WHERE shipment.vehicle_id = $colID");



	 	}elseif ($tblName == "airmail") {



		 	$q = mysqli_query($dbc,"SELECT airmail.*, services_company.*, consignee.*,users.* FROM airmail LEFT OUTER JOIN services_company ON airmail.airmail_services_company = services_company.services_company_id LEFT OUTER JOIN users ON airmail.airmail_request_by =users.user_id  LEFT OUTER JOIN consignee ON consignee.consignee_id WHERE airmail.airmail_consignee = $colID GROUP BY airmail.vehicle_id");



	 	}



	 	else{







	 	}



		$response = array();



		while($r = mysqli_fetch_assoc($q)){



			$response[] = $r;



		}



		echo json_encode($response);	



		exit();



	}







	if (isset($_POST['action']) && !empty($_POST['action'])) {



	    $action = $_POST['action'];



	    switch ($action) {



	        case 'loadAuctionGrade' :



	            loadAuctionGrade($dbc);



	            break;



	        case 'loadMakers' :



	            loadMakers($dbc);



	            break;



	        case 'ccTable' :



	            ccTable($dbc);



	            break;



	        case 'loadcolor_code' :



	            loadcolor_code($dbc);



	            break;



	        case 'drive' :



	            drive($dbc);



	            break;



	        case 'transmission' :



	            transmission($dbc);



	            break;



	        case 'interior_grade' :



	            interior_grade($dbc);



	            break;



	        case 'exterior_grade' :



	            exterior_grade($dbc);



	            break;



	        case 'seats' :



	            seats($dbc);



	            break;



	        case 'doors' :



	            doors($dbc);



	            break;



	        case 'options' :



	            options($dbc);



	            break;



	        case 'fuel' :



	            fuel($dbc);



	            break;



	        case 'package' :



	            package($dbc);



	            break;



	        case 'bidders' :



	            bidders($dbc);



	            break;



	        case 'auction_home' :



	            auction_home($dbc);



	            break;



	        case 'consignee' :



	            consignee($dbc);



	            break;



	        case 'inspection_company' :



	            inspection_company($dbc);



	            break;
	        case 'inspection_transportation' :



	            inspection_transportation($dbc);



	            break;    



	        case 'transportation' :



	            transportation($dbc);



	            break;



	        case 'services_company' :



	            services_company($dbc);



	            break;
	        case 'airmail_transportation' :



	            airmail_transportation($dbc);



	            break;



	        case 'vehicle_expense' :



	        	$id = $_POST['custom'];



	            vehicle_expense($dbc, $id);



	            break;



	        case 'reauction' :



	            reauction($dbc);



	            break;



	        case 'customers' :



	            customers($dbc);



	            break;



	        case 'banks' :



	            banks($dbc);



	            break;



	        case 'country_regulation' :



	            country_regulation($dbc);



	            break;



	        case 'vehicle_feature' :



	            vehicle_feature($dbc);



	            break;



	        case 'brands' :



	            brands($dbc);



	            break;



	        case 'models' :



	        	$id = $_POST['custom'];



	            models($dbc, $id);



	            break;



	        case 'shipper' :



	            shipper($dbc);



	            break;



	        case 'ricksu_company1' :



	            ricksu_company1($dbc);



	            break;



	       case 'riksu_transportation1' :



	       riksu_transportation1($dbc);



	       break;



	        case 'shipment_company' :



	            shipment_company($dbc);



	            break;



	        case 'vehicle_services' :



	        	$id = $_POST['custom'];



	            vehicle_services($dbc, $id);



	            break;



	        case 'body_type' :



	            body_type($dbc);



	            break;



	        case 'nexco_offices' :



	            nexco_offices($dbc);



	            break;



	    }



	}







//*******************************************************Funtions*************************************************************************\\	



//*******************************************************Funtions*************************************************************************\\	



//*******************************************************Funtions*************************************************************************\\	







	function loadAuctionGrade($dbc){



	    $result = mysqli_query($dbc,"SELECT * FROM auction_grade");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	     // $row = $result->fetch_array();



	     $auction_grade_sts = ""; 



	        while($row = $result->fetch_array()) {



	        $auction_grade_id = $row[0];



	            // active 



	            if($row[2] == 1) {



	                // activate member



	                $auction_grade_sts = "<label class='label label-success'>Active</label>";



	            } else {



	                // deactivate member



	                $auction_grade_sts = "<label class='label label-danger'>Inactive</label>";



	            }


	            	$btn_edit=$btn_del='';
		            $userPrivileges=getUserPri($dbc,'auction_grade.php');
					$fetchedUserRole=getUserRole($dbc);
					if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
						$btn_edit='<i id="'.$auction_grade_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> ';
					endif;
					if (@$userPrivileges['nav_delete']==1 || $fetchedUserRole=="admin"): 
						$btn_del='| <i id="'.$auction_grade_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i>';
					endif;


				$button = '<!-- Single button -->



	            <form>'.$btn_edit.$btn_del.'<input type="hidden" id="table_name" value="auction_grade"><input type="hidden" id="col_name" value="auction_grade_id"><input type="hidden" id="sts_col" value="auction_grade_sts"></form>';







	            $output['data'][] = array(      



	                $row[0],           



	                $row[1],           



	                $auction_grade_sts,



	                $button         



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}







	function loadMakers($dbc){



	    $result = mysqli_query($dbc,"SELECT * FROM maker");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	     // $row = $result->fetch_array();



	     $maker_sts = ""; 



	        while($row = $result->fetch_array()) {



	        $maker_id = $row[0];



	            // active 



	            if($row[2] == 1) {



	                // activate member



	                $maker_sts = "<label class='label label-success'>Active</label>";



	            } else {



	                // deactivate member



	                $maker_sts = "<label class='label label-danger'>Inactive</label>";



	            }




	            	$btn_edit=$btn_del='';
		            $userPrivileges=getUserPri($dbc,'maker.php');
					$fetchedUserRole=getUserRole($dbc);
					if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
						$btn_edit='<i id="'.$maker_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> ';
					endif;
					if (@$userPrivileges['nav_delete']==1 || $fetchedUserRole=="admin"): 
						$btn_del='| <i id="'.$maker_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i>';
					endif;

$button = '<!-- Single button -->



	            <form>'.$btn_edit.$btn_del.'<input type="hidden" id="table_name" value="maker"><input type="hidden" id="col_name" value="maker_id"><input type="hidden" id="sts_col" value="maker_sts"></form>';







	            $img = '<img style="width:100px" src="img/vehicles_images/'.$row[4].'" alt="No Image">';







	            $output['data'][] = array(      



	                $row[0],           



	                $img,           



	                $row[1],           



	                $maker_sts,



	                $button         



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}







	function body_type($dbc){



	    $result = mysqli_query($dbc,"SELECT * FROM body_type");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	     // $row = $result->fetch_array();



	     $body_type_sts = ""; 



	        while($row = $result->fetch_array()) {



	        $body_type_id = $row[0];



	            // active 



	            if($row[3] == 1) {



	                // activate member



	                $body_type_sts = "<label class='label label-success'>Active</label>";



	            } else {



	                // deactivate member



	                $body_type_sts = "<label class='label label-danger'>Inactive</label>";



	            }



	$btn_edit=$btn_del='';
		            $userPrivileges=getUserPri($dbc,'body_type.php');
					$fetchedUserRole=getUserRole($dbc);
					if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
						$btn_edit='<i id="'.$body_type_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> ';
					endif;
					if (@$userPrivileges['nav_delete']==1 || $fetchedUserRole=="admin"): 
						$btn_del='| <i id="'.$body_type_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i>';
					endif;




	        $button = '<!-- Single button -->



	            <form>'.$btn_edit.$btn_del.'
<input type="hidden" id="table_name" value="body_type"><input type="hidden" id="col_name" value="body_type_id"><input type="hidden" id="sts_col" value="body_type_sts"></form>';







	            $img = '<img style="width:100px" src="img/vehicles_images/'.$row[2].'" alt="No Image">';







	            $output['data'][] = array(      



	                $row[0],           



	                $img,           



	                $row[1],           



	                $body_type_sts,



	                $button         



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}







	function loadcolor_code($dbc){



	    $result = mysqli_query($dbc,"SELECT * FROM color_code");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	     // $row = $result->fetch_array();



	     $color_code_sts = ""; 



	        while($row = $result->fetch_array()) {



	        $color_code_id = $row[0];



	            // active 



	            if($row[3] == 1) {



	                // activate member



	                $color_code_sts = "<label class='label label-success'>Active</label>";



	            } else {



	                // deactivate member



	                $color_code_sts = "<label class='label label-danger'>Inactive</label>";



	            }







	            $color = '<h3 style="color: '.$row[2].'"><i class="fa fa-circle"></i></h3>';


	            	$btn_edit=$btn_del='';
		            $userPrivileges=getUserPri($dbc,'color_code.php');
					$fetchedUserRole=getUserRole($dbc);
					if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
						$btn_edit='<i id="'.$color_code_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> ';
					endif;
					if (@$userPrivileges['nav_delete']==1 || $fetchedUserRole=="admin"): 
						$btn_del='| <i id="'.$color_code_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i>';
					endif;





	           $button = '<!-- Single button -->



	            <form>'.$btn_edit.$btn_del.'<input type="hidden" id="table_name" value="color_code"><input type="hidden" id="col_name" value="color_code_id"><input type="hidden" id="sts_col" value="color_code_sts"></form>';







	            $output['data'][] = array(      



	                $row[0],



	                $row['color_maker'],



	                "Color Name : ".$row['color_name']."<br>Color Code : ".$row['1'],           



	                $color,           



	                $color_code_sts,



	                $button         



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}







	function ccTable($dbc){



	    $result = mysqli_query($dbc,"SELECT * FROM cc");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	     // $row = $result->fetch_array();



	     $cc_sts = ""; 



	        while($row = $result->fetch_array()) {



	        $cc_id = $row[0];



	            // active 



	            if($row[2] == 1) {



	                // activate member



	                $cc_sts = "<label class='label label-success'>Active</label>";



	            } else {



	                // deactivate member



	                $cc_sts = "<label class='label label-danger'>Inactive</label>";



	            }





	$btn_edit=$btn_del='';
		            $userPrivileges=getUserPri($dbc,'cc.php');
					$fetchedUserRole=getUserRole($dbc);
					if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
						$btn_edit='<i id="'.$cc_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> ';
					endif;
					if (@$userPrivileges['nav_delete']==1 || $fetchedUserRole=="admin"): 
						$btn_del='| <i id="'.$cc_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i>';
					endif;
	$button = '<!-- Single button -->



	            <form>'.$btn_edit.$btn_del.'<input type="hidden" id="table_name" value="cc"><input type="hidden" id="col_name" value="cc_id"><input type="hidden" id="sts_col" value="cc_sts"></form>';







	            $output['data'][] = array(      



	                $row[0],           



	                $row[1],           



	                $cc_sts,



	                $button         



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}







	function drive($dbc){



	    $result = mysqli_query($dbc,"SELECT * FROM drive");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	     // $row = $result->fetch_array();



	     $drive_sts = ""; 



	        while($row = $result->fetch_array()) {



	        $drive_id = $row[0];



	            // active 



	            if($row[2] == 1) {



	                // activate member



	                $drive_sts = "<label class='label label-success'>Active</label>";



	            } else {



	                // deactivate member



	                $drive_sts = "<label class='label label-danger'>Inactive</label>";



	            }




	$btn_edit=$btn_del='';
		            $userPrivileges=getUserPri($dbc,'drive.php');
					$fetchedUserRole=getUserRole($dbc);
					if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
						$btn_edit='<i id="'.$drive_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> ';
					endif;
					if (@$userPrivileges['nav_delete']==1 || $fetchedUserRole=="admin"): 
						$btn_del='| <i id="'.$drive_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i>';
					endif;




				$button = '<!-- Single button -->



	            <form>'.$btn_edit.$btn_del.'<input type="hidden" id="table_name" value="drive"><input type="hidden" id="col_name" value="drive_id"><input type="hidden" id="sts_col" value="drive_sts"></form>';







	            $output['data'][] = array(      



	                $row[0],           



	                $row[1],           



	                $drive_sts,



	                $button         



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}







	function transmission($dbc){



	    $result = mysqli_query($dbc,"SELECT * FROM transmission");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	     // $row = $result->fetch_array();



	     $transmission_sts = ""; 



	        while($row = $result->fetch_array()) {



	        $transmission_id = $row[0];



	            // active 



	            if($row[2] == 1) {



	                // activate member



	                $transmission_sts = "<label class='label label-success'>Active</label>";



	            } else {



	                // deactivate member



	                $transmission_sts = "<label class='label label-danger'>Inactive</label>";



	            }




	            	$btn_edit=$btn_del='';
		            $userPrivileges=getUserPri($dbc,'transmission.php');
					$fetchedUserRole=getUserRole($dbc);
					if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
						$btn_edit='<i id="'.$transmission_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> ';
					endif;
					if (@$userPrivileges['nav_delete']==1 || $fetchedUserRole=="admin"): 
						$btn_del='| <i id="'.$transmission_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i>';
					endif;

$button = '<!-- Single button -->



	            <form>'.$btn_edit.$btn_del.'
</i><input type="hidden" id="table_name" value="transmission"><input type="hidden" id="col_name" value="transmission_id"><input type="hidden" id="sts_col" value="transmission_sts"></form>';







	            $output['data'][] = array(      



	                $row[0],           



	                $row[1],           



	                $transmission_sts,



	                $button         



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}







	function interior_grade($dbc){



	    $result = mysqli_query($dbc,"SELECT * FROM interior_grade");



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





	$btn_edit=$btn_del='';
		            $userPrivileges=getUserPri($dbc,'interior_grade.php');
					$fetchedUserRole=getUserRole($dbc);
					if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
						$btn_edit='<i id="'.$interior_grade_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> ';
					endif;
					if (@$userPrivileges['nav_delete']==1 || $fetchedUserRole=="admin"): 
						$btn_del='| <i id="'.$interior_grade_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i>';
					endif;

	            $button = '<!-- Single button -->



	            <form>'.$btn_edit.$btn_del.'<input type="hidden" id="table_name" value="interior_grade"><input type="hidden" id="col_name" value="interior_grade_id"><input type="hidden" id="sts_col" value="interior_grade_sts"></form>';







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







	function exterior_grade($dbc){



	    $result = mysqli_query($dbc,"SELECT * FROM exterior_grade");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	     // $row = $result->fetch_array();



	     $exterior_grade_sts = ""; 



	        while($row = $result->fetch_array()) {



	        $exterior_grade_id = $row[0];



	            // active 



	            if($row[2] == 1) {



	                // activate member



	                $exterior_grade_sts = "<label class='label label-success'>Active</label>";



	            } else {



	                // deactivate member



	                $exterior_grade_sts = "<label class='label label-danger'>Inactive</label>";



	            }





	            $btn_edit=$btn_del='';
		            $userPrivileges=getUserPri($dbc,'exterior_grade.php');
					$fetchedUserRole=getUserRole($dbc);
					if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
						$btn_edit='<i id="'.$exterior_grade_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> ';
					endif;
					if (@$userPrivileges['nav_delete']==1 || $fetchedUserRole=="admin"): 
						$btn_del='| <i id="'.$exterior_grade_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i>';
					endif;


	           $button = '<!-- Single button -->



	            <form>'.$btn_edit.$btn_del.'<input type="hidden" id="table_name" value="exterior_grade"><input type="hidden" id="col_name" value="exterior_grade_id"><input type="hidden" id="sts_col" value="exterior_grade_sts"></form>';







	            $output['data'][] = array(      



	                $row[0],           



	                $row[1],           



	                $exterior_grade_sts,



	                $button         



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}







	function seats($dbc){



	    $result = mysqli_query($dbc,"SELECT * FROM seats");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	     // $row = $result->fetch_array();



	     $seats_sts = ""; 



	        while($row = $result->fetch_array()) {



	        $seats_id = $row[0];



	            // active 



	            if($row[2] == 1) {



	                // activate member



	                $seats_sts = "<label class='label label-success'>Active</label>";



	            } else {



	                // deactivate member



	                $seats_sts = "<label class='label label-danger'>Inactive</label>";



	            }
	            	$btn_edit=$btn_del='';
		            $userPrivileges=getUserPri($dbc,'seats.php');
					$fetchedUserRole=getUserRole($dbc);
					if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
						$btn_edit='<i id="'.$seats_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> ';
					endif;
					if (@$userPrivileges['nav_delete']==1 || $fetchedUserRole=="admin"): 
						$btn_del='| <i id="'.$seats_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i>';
					endif;





$button = '<!-- Single button -->



	            <form>'.$btn_edit.$btn_del.'<input type="hidden" id="table_name" value="seats"><input type="hidden" id="col_name" value="seats_id"><input type="hidden" id="sts_col" value="seats_sts"></form>';







	            $output['data'][] = array(      



	                $row[0],           



	                $row[1],           



	                $seats_sts,



	                $button         



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}







	function doors($dbc){



	    $result = mysqli_query($dbc,"SELECT * FROM doors");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	     // $row = $result->fetch_array();



	     $doors_sts = ""; 



	        while($row = $result->fetch_array()) {



	        $doors_id = $row[0];



	            // active 



	            if($row[2] == 1) {



	                // activate member



	                $doors_sts = "<label class='label label-success'>Active</label>";



	            } else {



	                // deactivate member



	                $doors_sts = "<label class='label label-danger'>Inactive</label>";



	            }


	            	$btn_edit=$btn_del='';
		            $userPrivileges=getUserPri($dbc,'doors.php');
					$fetchedUserRole=getUserRole($dbc);
					if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
						$btn_edit='<i id="'.$doors_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> ';
					endif;
					if (@$userPrivileges['nav_delete']==1 || $fetchedUserRole=="admin"): 
						$btn_del='| <i id="'.$doors_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i>';
					endif;


		$button = '<!-- Single button -->



	            <form>'.$btn_edit.$btn_del.'<input type="hidden" id="table_name" value="doors"><input type="hidden" id="col_name" value="doors_id"><input type="hidden" id="sts_col" value="doors_sts"></form>';







	            $output['data'][] = array(      



	                $row[0],           



	                $row[1],           



	                $doors_sts,



	                $button         



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}







	function options($dbc){



	    $result = mysqli_query($dbc,"SELECT * FROM options");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	     // $row = $result->fetch_array();



	     $option_sts = ""; 



	        while($row = $result->fetch_array()) {



	        $option_id = $row[0];



	            // active 



	            if($row[2] == 1) {



	                // activate member



	                $option_sts = "<label class='label label-success'>Active</label>";



	            } else {



	                // deactivate member



	                $option_sts = "<label class='label label-danger'>Inactive</label>";



	            }

					$btn_edit=$btn_del='';
		            $userPrivileges=getUserPri($dbc,'options.php');
					$fetchedUserRole=getUserRole($dbc);
					if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
						$btn_edit='<i id="'.$option_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> ';
					endif;
					if (@$userPrivileges['nav_delete']==1 || $fetchedUserRole=="admin"): 
						$btn_del='| <i id="'.$option_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i>';
					endif;






				$button = '<!-- Single button -->



	            <form>'.$btn_edit.$btn_del.'<input type="hidden" id="table_name" value="options"><input type="hidden" id="col_name" value="option_id"><input type="hidden" id="sts_col" value="option_sts"></form>';







	            $output['data'][] = array(      



	                $row[0],           



	                $row[1],           



	                $option_sts,



	                $button         



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}







	function fuel($dbc){



	    $result = mysqli_query($dbc,"SELECT * FROM fuel");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	     // $row = $result->fetch_array();



	     $fuel_sts = ""; 



	        while($row = $result->fetch_array()) {



	        $fuel_id = $row[0];



	            // active 



	            if($row[2] == 1) {



	                // activate member



	                $fuel_sts = "<label class='label label-success'>Active</label>";



	            } else {



	                // deactivate member



	                $fuel_sts = "<label class='label label-danger'>Inactive</label>";



	            }





	            	$btn_edit=$btn_del='';
		            $userPrivileges=getUserPri($dbc,'fuel.php');
					$fetchedUserRole=getUserRole($dbc);
					if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
						$btn_edit='<i id="'.$fuel_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> ';
					endif;
					if (@$userPrivileges['nav_delete']==1 || $fetchedUserRole=="admin"): 
						$btn_del='| <i id="'.$fuel_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i>';
					endif;
				$button = '<!-- Single button -->



	            <form>'.$btn_edit.$btn_del.'<input type="hidden" id="table_name" value="fuel"><input type="hidden" id="col_name" value="fuel_id"><input type="hidden" id="sts_col" value="fuel_sts"></form>';







	            $output['data'][] = array(      



	                $row[0],           



	                $row[1],           



	                $fuel_sts,



	                $button         



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}







	function package($dbc){



	    $result = mysqli_query($dbc,"SELECT * FROM package");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	     // $row = $result->fetch_array();



	     $pack_sts = ""; 



	        while($row = $result->fetch_array()) {



	        $pack_id = $row[0];



	            // active 



	            if($row[2] == 1) {



	                // activate member



	                $pack_sts = "<label class='label label-success'>Active</label>";



	            } else {



	                // deactivate member



	                $pack_sts = "<label class='label label-danger'>Inactive</label>";



	            }







	            $button = '<!-- Single button -->



	            <form><i id="'.$pack_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> | <i id="'.$pack_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i><input type="hidden" id="table_name" value="package"><input type="hidden" id="col_name" value="pack_id"><input type="hidden" id="sts_col" value="pack_sts"></form>';







	            $output['data'][] = array(      



	                $row[0],           



	                $row[1],           



	                $pack_sts,



	                $button         



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}







	function bidders($dbc){



	    $result = mysqli_query($dbc,"SELECT * FROM bidders");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	     // $row = $result->fetch_array();



	     $bidders_sts = ""; 



	        while($row = $result->fetch_array()) {



	        $bidders_id = $row[0];



	            // active 



	            if($row[2] == 1) {



	                // activate member



	                $bidders_sts = "<label class='label label-success'>Active</label>";



	            } else {



	                // deactivate member



	                $bidders_sts = "<label class='label label-danger'>Inactive</label>";



	            }




 				$btn_edit=$btn_del='';
	            $userPrivileges=getUserPri($dbc,'bidders.php');
				$fetchedUserRole=getUserRole($dbc);
				if ($userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
					$btn_edit='<i id="'.$bidders_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> ';
				endif;
				if ($userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
					$btn_del='| <i id="'.$bidders_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i>';
				endif;



	            $button = '<!-- Single button -->



	            <form>'.$btn_edit.$btn_del.'<input type="hidden" id="table_name" value="bidders"><input type="hidden" id="col_name" value="bidders_id"><input type="hidden" id="sts_col" value="bidders_sts"></form>';







	            $output['data'][] = array(      



	                $row[0],           



	                $row[1],           



	                $bidders_sts,



	                $button         



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}







	function auction_home($dbc){



	    $result = mysqli_query($dbc,"SELECT * FROM auction_home");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	     // $row = $result->fetch_array();



	     $auction_home_sts = ""; 



	        while($row = $result->fetch_array()) {



	        $auction_home_id = $row[0];



	            // active 



	            if($row['auction_home_sts'] == 1) {



	                // activate member



	                $auction_home_sts = "<label class='label label-success'>Active</label>";



	            } else {



	                // deactivate member



	                $auction_home_sts = "<label class='label label-danger'>Inactive</label>";



	            }
	$btn_edit=$btn_del='';
		            $userPrivileges=getUserPri($dbc,'auction_house.php');
					$fetchedUserRole=getUserRole($dbc);
					if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
						$btn_edit='<i id="'.$auction_home_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> ';
					endif;
					if (@$userPrivileges['nav_delete']==1 || $fetchedUserRole=="admin"): 
						$btn_del='| <i id="'.$auction_home_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i>';
					endif;





$button = '<!-- Single button -->

 

	            <form>'.$btn_edit.$btn_del.'
<input type="hidden" id="table_name" value="auction_home"><input type="hidden" id="col_name" value="auction_home_id"><input type="hidden" id="sts_col" value="auction_home_sts"></form>
<a href="auction_yards.php?auction_house='.$row['auction_home_name'].'" class="btn btn-success btn-sm">Add Yards</a>'
;







	            $output['data'][] = array(      



	                $row[0],           



	                $row['auction_home_name'],           



	                "House Fee :".$row['house_fee']."<br> Live Fee :".$row['live_fee']."<br> Price Offer Fee :".$row['price_offer_fee'], 



	                $row['3'], 

	                

                    $auction_home_sts,
                    $button ,
	                



	                        



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}







	function consignee($dbc){



	    $result = mysqli_query($dbc,"SELECT * FROM consignee");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	     // $row = $result->fetch_array();



	     $consignee_sts = ""; 



	        while($row = $result->fetch_array()) {



	        $consignee_id = $row[0];



	            // active 



	            if($row[3] == 1) {



	                // activate member



	                $consignee_sts = "<label class='label label-success'>Active</label>";



	            } else {



	                // deactivate member



	                $consignee_sts = "<label class='label label-danger'>Inactive</label>";



	            }


   			 $btn_edit=$btn_del='';
	            $userPrivileges=getUserPri($dbc,'consignee.php?consignee_label');
				$fetchedUserRole=getUserRole($dbc);
				if ($userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
					$btn_edit='<i id="'.$consignee_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> ';
				endif;
				if ($userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
					$btn_del='| <i id="'.$consignee_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i>';
				endif;




	            $button = '<!-- Single button -->



	            <form>'.$btn_edit.$btn_del.'<input type="hidden" id="table_name" value="consignee"><input type="hidden" id="col_name" value="consignee_id"><input type="hidden" id="sts_col" value="consignee_sts"></form>';







	            $output['data'][] = array(      



	                $row[0],           



	                $row[1],                    



	                $row[20],                    



	                $consignee_sts,



	                $button         



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}







	function inspection_company($dbc){



	    $result = mysqli_query($dbc,"SELECT * FROM inspection_company");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	     // $row = $result->fetch_array();



	     $inspection_company_sts = ""; 



	        while($row = $result->fetch_array()) {



	        $inspection_company_id = $row[0];



	            // active 



	            if($row['inspection_company_sts'] == 1) {



	                // activate member



	                $inspection_company_sts = "<label class='label label-success'>Active</label>";



	            } else {



	                // deactivate member



	                $inspection_company_sts = "<label class='label label-danger'>Inactive</label>";



	            }




	            $btn_edit=$btn_del='';
	            $userPrivileges=getUserPri($dbc,'inspection_company.php');
				$fetchedUserRole=getUserRole($dbc);
				if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
					$btn_edit='<i id="'.$inspection_company_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> ';
				endif;
				if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
					$btn_del='| <i id="'.$inspection_company_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i>';
				endif;


	            $button = '<!-- Single button -->



	            <form>'.$btn_edit.$btn_del.'<input type="hidden" id="table_name" value="inspection_company"><input type="hidden" id="col_name" value="inspection_company_id"><input type="hidden" id="sts_col" value="inspection_company_sts"></form>';

	            $details="Email :".$row[3]."<br>Fax :".$row[4]."<br>Website :".$row[6]."<br>";





	            $output['data'][] = array(      



	                $row[0],           



	                $row[1],
	                $row[2],
	               $details,
	                $row[5],                                          



	                $inspection_company_sts,



	                $button         



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}

	function inspection_transportation($dbc){



	    $result = mysqli_query($dbc,"SELECT * FROM inspection_transportation");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	     // $row = $result->fetch_array();



	     $inspection_trans_sts = ""; 



	        while($row = $result->fetch_array()) {



	        $inspection_trans_id = $row[0];



	            // active 



	            if($row['inspection_trans_sts'] == 1) {



	                // activate member



	                $inspection_trans_sts = "<label class='label label-success'>Active</label>";



	            } else {



	                // deactivate member



	                $inspection_trans_sts = "<label class='label label-danger'>Inactive</label>";



	            }




	            	            $userPrivileges=getUserPri($dbc,'ricksu_company.php');
				$fetchedUserRole=getUserRole($dbc);
				if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
					$btn_edit='<i id="'.$inspection_trans_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> ';
				endif;
				if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
					$btn_del='| <i id="'.$inspection_trans_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i>';
				endif;


	           $button = '<!-- Single button -->



	            <form>'.$btn_edit.$btn_del.'<input type="hidden" id="table_name" value="inspection_transportation"><input type="hidden" id="col_name" value="inspection_trans_id"><input type="hidden" id="sts_col" value="inspection_trans_sts"></form>';


	            $tax=$row[3]." Tax:".$row[4];
	            	 $inspection_company=fetchRecord($dbc,"inspection_company",'inspection_company_id',$row['inspection_trans_company']);


	            $output['data'][] = array(      



	                $row[0],


	                $inspection_company['inspection_company_name'],
	                $row[2],
	          		
	          		$tax,
	                $row[5],                                          



	                $inspection_trans_sts,



	                $button         



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}





	function transportation($dbc){



	    $result = mysqli_query($dbc,"SELECT * FROM transportation");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	     // $row = $result->fetch_array();



	     $transportation_sts = ""; 



	        while($row = $result->fetch_array()) {



	        $transportation_id = $row[0];



	            // active 



	            if($row[2] == 1) {



	                // activate member



	                $transportation_sts = "<label class='label label-success'>Active</label>";



	            } else {



	                // deactivate member



	                $transportation_sts = "<label class='label label-danger'>Inactive</label>";



	            }


	$btn_edit=$btn_del='';
		            $userPrivileges=getUserPri($dbc,'transportation.php');
					$fetchedUserRole=getUserRole($dbc);
					if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
						$btn_edit='<i id="'.$transportation_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> ';
					endif;
					if (@$userPrivileges['nav_delete']==1 || $fetchedUserRole=="admin"): 
						$btn_del='| <i id="'.$transportation_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i>';
					endif;



$button = '<!-- Single button -->



	            <form>'.$btn_edit.$btn_del.'<input type="hidden" id="table_name" value="transportation"><input type="hidden" id="col_name" value="transportation_id"><input type="hidden" id="sts_col" value="transportation_sts"></form>';







	            $output['data'][] = array(      



	                $row[0],           



	                $row[1],                    



	                $transportation_sts,



	                $button         



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}







	function services_company($dbc){



	    $result = mysqli_query($dbc,"SELECT * FROM services_company");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	     // $row = $result->fetch_array();



	     $services_company_sts = ""; 



	        while($row = $result->fetch_array()) {



	        $services_company_id = $row[0];



	            // active 



	            if($row['services_company_sts'] == 1) {



	                // activate member



	                $services_company_sts = "<label class='label label-success'>Active</label>";



	            } else {



	                // deactivate member



	                $services_company_sts = "<label class='label label-danger'>Inactive</label>";



	            }



	            $btn_edit=$btn_del='';
	            $userPrivileges=getUserPri($dbc,'services_company.php');
				$fetchedUserRole=getUserRole($dbc);
				if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
					$btn_edit='<i id="'.$services_company_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> ';
				endif;
				if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
					$btn_del='| <i id="'.$services_company_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i>';
				endif;



	            $button = '<!-- Single button -->



	            <form>'.$btn_edit.$btn_del.'<input type="hidden" id="table_name" value="services_company"><input type="hidden" id="col_name" value="services_company_id"><input type="hidden" id="sts_col" value="services_company_sts"></form>';







	            $output['data'][] = array(      



	                $row[0],           



	                $row[1],
	                $row[2], 
	                $row[3],                    



	                $services_company_sts,



	                $button         



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}


// aimmail trans

	function airmail_transportation($dbc){



	    $result = mysqli_query($dbc,"SELECT * FROM airmail_transportation");


	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	     // $row = $result->fetch_array();



	     $services_company_sts = ""; 



	        while($row = $result->fetch_array()) {



	        $airmail_trans_id = $row[0];



	            // active 



	            if($row['airmail_trans_sts'] == 1) {



	                // activate member



	                $airmail_trans_sts = "<label class='label label-success'>Active</label>";



	            } else {



	                // deactivate member



	                $airmail_trans_sts = "<label class='label label-danger'>Inactive</label>";



	            }



	            $btn_edit=$btn_del='';
	            $userPrivileges=getUserPri($dbc,'airmail_transportation.php');
				$fetchedUserRole=getUserRole($dbc);
				if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
					$btn_edit='<i id="'.$airmail_trans_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> ';
				endif;
				if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
					$btn_del='| <i id="'.$airmail_trans_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i>';
				endif;



	           $button = '<!-- Single button -->



	            <form>'.$btn_edit.$btn_del.'<input type="hidden" id="table_name" value="airmail_transportation"><input type="hidden" id="col_name" value="airmail_trans_id"><input type="hidden" id="sts_col" value="airmail_trans_sts"></form>';




	            	 $services_company=fetchRecord($dbc,"services_company",'services_company_id',$row[1]);



	            $output['data'][] = array(      



	                $row[0],           



	                $services_company['services_company_name'],
	                $row[2], 
	                $row[3]." Kg",  
	                $row[4], 
	                                 



	                $airmail_trans_sts,



	                $button         



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}







	function vehicle_expense($dbc, $id){



	    $result = mysqli_query($dbc,"SELECT * FROM vehicle_expense WHERE vehicle_info_id = '$id'");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	        while($row = $result->fetch_array()) {



	        $vehicle_expense_id = $row[0];
	        $btn_edit=$btn_del='';
		            $userPrivileges=getUserPri($dbc,'ricksu_company.php');
					$fetchedUserRole=getUserRole($dbc);
					if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
						$btn_edit='<i id="'.$vehicle_expense_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> ';
					endif;
					if (@$userPrivileges['nav_delete']==1 || $fetchedUserRole=="admin"): 
						$btn_del='| <i id="'.$vehicle_expense_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i>';
					endif;


	            $button = '<!-- Single button -->



	            <form>'.$btn_edit.$btn_del.'<input type="hidden" id="table_name" value="vehicle_expense"><input type="hidden" id="col_name" value="vehicle_expense_id"><input type="hidden" id="sts_col" value="vehicle_expense_sts"></form>';



	            $vehicle_info = fetchRecord($dbc, "vehicle_info", "vehicle_id", $row[1]);



	            $brand = fetchRecord($dbc, "brands", "brand_id", $vehicle_info['vehicle_brand'])['brand_name'];



	            $output['data'][] = array(      



	                $row[0],



	                "Stock ID : ".$vehicle_info['vehicle_stock_id']."<br> Vehicle Chassis No : ".$vehicle_info['vehicle_chassis_no']."<br> Brand : ".$brand ,



	                $row[2], 



	                $row[3], 



	                $row[4], 



	                $button         



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}







	function reauction($dbc){



	    $result = mysqli_query($dbc,"SELECT * FROM reauction");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	        while($row = $result->fetch_array()) {



	        $reauction_id = $row[0];

	        	$btn_edit=$btn_del='';
		            $userPrivileges=getUserPri($dbc,'reauction.php');
					$fetchedUserRole=getUserRole($dbc);
					if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
						$btn_edit='<i id="'.$reauction_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> ';
					endif;
					if (@$userPrivileges['nav_delete']==1 || $fetchedUserRole=="admin"): 
						$btn_del='| <i id="'.$reauction_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i>';
					endif;

	          $button = '<!-- Single button -->



	            <form>'.$btn_edit.$btn_del.'<input type="hidden" id="table_name" value="reauction"><input type="hidden" id="col_name" value="reauction_id"><input type="hidden" id="sts_col" value="vehicle_expense_sts"></form>';



	            $vehicle_info = fetchRecord($dbc, "vehicle_info", "vehicle_id", $row[1]);



	            $brand = fetchRecord($dbc, "brands", "brand_id", $vehicle_info['vehicle_brand'])['brand_name'];



	            $output['data'][] = array(      



	                $row[0],



	                "Stock ID : ".$vehicle_info['vehicle_stock_id']."<br> Vehicle Chassis No : ".$vehicle_info['vehicle_chassis_no']."<br> Brand : ".$brand ,



	                $button         



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}







	function customers($dbc){



	    $result = mysqli_query($dbc,"SELECT * FROM customers WHERE customer_role = 'customer'");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	     // $row = $result->fetch_array();



	     $customer_active = ""; 



	        while($row = $result->fetch_array()) {



	        $customer_id = $row[0];



	            // active 



	            if($row[8] == 1) {



	                // activate member



	                $customer_active = "<label class='label label-success'>Active</label>";



	            } else {



	                // deactivate member



	                $customer_active = "<label class='label label-danger'>Inactive</label>";



	            }



	            $btn_edit=$btn_del='';
	            $userPrivileges=getUserPri($dbc,'customers.php?type=customer');
				$fetchedUserRole=getUserRole($dbc);
				if ($userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
					$btn_edit='<i id="'.$customer_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> ';
				endif;
				if ($userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
					$btn_del='| <i id="'.$customer_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i>';
				endif;




	            $button = '<!-- Single button -->



	            <form>'.$btn_edit.$btn_del.'<input type="hidden" id="table_name" value="customers"><input type="hidden" id="col_name" value="customer_id"><input type="hidden" id="sts_col" value="customer_active"></form>
	            <a href="details.php?type=customer&id='.$row[0].'" class="btn btn-sm btn-primary">Details</a>
	             <a target="_blank" href="customer_banks.php?id='.$row[0].'" class="btn btn-sm btn-success">Customer Banks</a>'
	            ;





	            $output['data'][] = array(      



	                $row[0],      
	                $row['customer_company'],     



	                $row[1],           



	                $row[2],           



	                $row[3],



	                $row[5],
	                $row['customer_designation'],



	                $customer_active,



	                $row[9],           



	                $button         



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}







	function banks($dbc){



	    $result = mysqli_query($dbc,"SELECT * FROM customers WHERE customer_role = 'bank'");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	     // $row = $result->fetch_array();



	     $customer_active = ""; 



	        while($row = $result->fetch_array()) {



	        $customer_id = $row[0];



	            // active 



	            if($row[8] == 1) {



	                // activate member



	                $customer_active = "<label class='label label-success'>Active</label>";



	            } else {



	                // deactivate member



	                $customer_active = "<label class='label label-danger'>Inactive</label>";



	            }

	            $btn_edit=$btn_del='';
	            $userPrivileges=getUserPri($dbc,'customers.php?type=bank');
				$fetchedUserRole=getUserRole($dbc);
				if ($userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
					$btn_edit='<i id="'.$customer_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> ';
				endif;
				if ($userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
					$btn_del='| <i id="'.$customer_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i>';
				endif;



	            $button = '<!-- Single button -->



	            <form>'.$btn_edit.$btn_del.'<input type="hidden" id="table_name" value="customers"><input type="hidden" id="col_name" value="customer_id"><input type="hidden" id="sts_col" value="customer_active"></form>';







	            $output['data'][] = array(      



	                $row[0],           



	                $row[2],           



	               $row[1],           



	                $row[10],           



	                $row[4],



	                $row[6],



	                $row[5],           



	                $customer_active,



	                $button



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}







	function country_regulation($dbc){



	    $result = mysqli_query($dbc,"SELECT * FROM country_regulation");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	     // $row = $result->fetch_array();



	     $country_regulation_sts = ""; 



	        while($row = $result->fetch_array()) {



	        $country_regulation_id = $row[0];



	            // active 



	            if($row[11] == 1) {



	                // activate member



	                $country_regulation_sts = "<label class='label label-success'>Active</label>";



	            } else {



	                // deactivate member



	                $country_regulation_sts = "<label class='label label-danger'>Inactive</label>";



	            }




	            $btn_edit=$btn_del='';
	            $userPrivileges=getUserPri($dbc,'set_countries_regulation.php');
				$fetchedUserRole=getUserRole($dbc);
				if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
					$btn_edit='<i id="'.$country_regulation_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> ';
				endif;
				if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
					$btn_del='| <i id="'.$country_regulation_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i>';
				endif;


	           

$button = '<!-- Single button -->



	            <form>'.$btn_edit.$btn_del.'<input type="hidden" id="table_name" value="country_regulation"><input type="hidden" id="col_name" value="country_regulation_id"><input type="hidden" id="sts_col" value="country_regulation_sts"></form>';







	            $output['data'][] = array(      



	                $row[0],           



	                $button,         



	                $row[2],           



	                $row[1],           



	                $row[3],           



	                $row[4],           



	                $row[9],           



	                $row[5],           



	                $row[6],           



	                $row[7],           



	                $row[8],           



	                $row[10],           



	                $row[12],           



	                $row[13],           



	                $row[14],           



	                $row[15],           



	                $country_regulation_sts,
	                $button,



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}







	function vehicle_feature($dbc){



	    $result = mysqli_query($dbc,"SELECT * FROM vehicle_feature");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	     // $row = $result->fetch_array();



	     $vehicle_feature_sts = ""; 



	        while($row = $result->fetch_array()) {



	        $vehicle_feature_id = $row[0];



	            // active 



	            if($row[3] == 1) {



	                // activate member



	                $vehicle_feature_sts = "<label class='label label-success'>Active</label>";



	            } else {



	                // deactivate member



	                $vehicle_feature_sts = "<label class='label label-danger'>Inactive</label>";



	            }




	            $btn_edit=$btn_del='';
	            $userPrivileges=getUserPri($dbc,'vehicle_features.php');
				$fetchedUserRole=getUserRole($dbc);
				if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
					$btn_edit='<i id="'.$vehicle_feature_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> ';
				endif;
				if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
					$btn_del='| <i id="'.$vehicle_feature_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i>';
				endif;



	            $button = '<!-- Single button -->



	            <form>'.$btn_edit.$btn_del.'<input type="hidden" id="table_name" value="vehicle_feature"><input type="hidden" id="col_name" value="vehicle_feature_id"><input type="hidden" id="sts_col" value="vehicle_feature_sts"></form>';







	            $output['data'][] = array(      



	                $row[0],           



	                $row[1],           



	                $row[2],           



	                $vehicle_feature_sts,           



	                $button



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}







	function brands($dbc){



	    $result = mysqli_query($dbc,"SELECT brands.*, maker.* FROM brands INNER JOIN maker ON maker.maker_id = brands.maker_id");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	     // $row = $result->fetch_array();



	     $brand_sts = ""; 



	        while($row = $result->fetch_array()) {



	        $brand_id = $row[0];







	        // $New = $row[0];



	            // active 



	            if($row[4] == 1) {



	                // activate member



	                $brand_sts = "<label class='label label-success'>Active</label>";



	            } else {



	                // deactivate member



	                $brand_sts = "<label class='label label-danger'>Inactive</label>";



	            }



	$btn_edit=$btn_del='';
		            $userPrivileges=getUserPri($dbc,'brands.php');
					$fetchedUserRole=getUserRole($dbc);
					if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
						$btn_edit='<i id="'.$brand_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> ';
					endif;
					if (@$userPrivileges['nav_delete']==1 || $fetchedUserRole=="admin"): 
						$btn_del='| <i id="'.$brand_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i>';
					endif;



$button = '<!-- Single button -->



	            <form>'.$btn_edit.$btn_del.'<input type="hidden" id="table_name" value="brands"><input type="hidden" id="col_name" value="brand_id"><input type="hidden" id="sts_col" value="brand_sts"> | 



	            <a href="models.php?brand_id='.$brand_id.'" target="_blank"><i class="fa fa-plus-circle text-danger" style="cursor: pointer;"></i></a></form>';







	            $output['data'][] = array(      



	                $row[0],           



	                $row[7],           



	                $row[1],          



	                $row[5],           



	                $brand_sts,



	                $button         



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}







	function models($dbc, $id){



	    $result = mysqli_query($dbc,"SELECT * FROM models WHERE brand_id = '$id'");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	     // $row = $result->fetch_array();



	     $model_sts = ""; 



	        while($row = $result->fetch_array()) {



	        $model_id = $row[0];



	            // active 



	            if($row[3] == 1) {



	                // activate member



	                $model_sts = "<label class='label label-success'>Active</label>";



	            } else {



	                // deactivate member



	                $model_sts = "<label class='label label-danger'>Inactive</label>";



	            }







	            $button = '<!-- Single button -->



	            <form><i id="'.$model_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> | <i id="'.$model_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i><input type="hidden" id="table_name" value="models"><input type="hidden" id="col_name" value="model_id"><input type="hidden" id="sts_col" value=""></form>';







	            $fetchbrand = fetchRecord($dbc, "brands", "brand_id", $row[2])['brand_name'];







	            $output['data'][] = array(      



	                $row[0],           



	                $row[1],           



	                $fetchbrand,           



	                $model_sts,



	                $button         



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}







	function shipper($dbc){



	    $result = mysqli_query($dbc,"SELECT * FROM shipper");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	     // $row = $result->fetch_array();



	     $shipper_sts = ""; 



	        while($row = $result->fetch_array()) {



	        $shipper_id = $row[0];



	            // active 



	            if($row[2] == 1) {



	                // activate member



	                $shipper_sts = "<label class='label label-success'>Active</label>";



	            } else {



	                // deactivate member



	                $shipper_sts = "<label class='label label-danger'>Inactive</label>";



	            }



 				$btn_edit=$btn_del='';
	            $userPrivileges=getUserPri($dbc,'shipper.php');
				$fetchedUserRole=getUserRole($dbc);
				if ($userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
					$btn_edit='<i id="'.$shipper_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> ';
				endif;
				if ($userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
					$btn_del='| <i id="'.$shipper_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i>';
				endif;



	            $button = '<!-- Single button -->



	            <form>'.$btn_edit.$btn_del.'<input type="hidden" id="table_name" value="shipper"><input type="hidden" id="col_name" value="shipper_id"><input type="hidden" id="sts_col" value="shipper_sts"></form>';







	            $output['data'][] = array(      



	                $row[0],           



	                $row[1],                    



	                $row[3],                    



	                $row[4],                    



	                $row[5],                    



	                $row[6],                    



	                $row[7],                    



	                $row[8],                    



	                $row[9],                    



	                $row[10],                    



	                $row[11],                    



	                $row[12],                    



	                $row[13],                    



	                $row[14],                    



	                $row[15],                    



	                $shipper_sts,



	                $button         



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}







	function shipment_company($dbc){



	    $result = mysqli_query($dbc,"SELECT * FROM shipment_company");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	     // $row = $result->fetch_array();



	     $shipment_company_sts = ""; 



	        while($row = $result->fetch_array()) {



	        $shipment_company_id = $row[0];



	            // active 



	            if($row[2] == 1) {



	                // activate member



	                $shipment_company_sts = "<label class='label label-success'>Active</label>";



	            } else {



	                // deactivate member



	                $shipment_company_sts = "<label class='label label-danger'>Inactive</label>";



	            }





	            $btn_edit=$btn_del='';
	            $userPrivileges=getUserPri($dbc,'shipment_company.php');
				$fetchedUserRole=getUserRole($dbc);
				if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
					$btn_edit='<i id="'.$shipment_company_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> ';
				endif;
				if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
					$btn_del='| <i id="'.$shipment_company_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i>';
				endif;

	            $button = '<!-- Single button -->



	            <form>'.$btn_edit.$btn_del.'<input type="hidden" id="table_name" value="shipment_company"><input type="hidden" id="col_name" value="shipment_company_id"><input type="hidden" id="sts_col" value="shipment_company_sts"></form>';







	            $output['data'][] = array(      



	                $row[0],           



	                $row[1],                    



	                $row[3],                    



	                $row[4],                    



	                $row[5],                    



	                $row[6],                    



	                $row[7],                    



	                $row[8],                    



	                $row[9],                    



	                $row[10],                    



	                $row[11],                    



	                $row[12],                    



	                $row[13],                    



	                $row[14],                    



	                $row[15],                    



	                $shipment_company_sts,



	                $button         



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}







	function ricksu_company1($dbc){



	    $result = mysqli_query($dbc,"SELECT * FROM ricksu_company");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	     // $row = $result->fetch_array();



	     $ricksu_company_sts = ""; 



	        while($row = $result->fetch_array()) {



	        $ricksu_company_id = $row[0];



	            // active 



	            if($row[3] == 1) {



	                // activate member



	                $ricksu_company_sts = "<label class='label label-success'>Active</label>";



	            } else {



	                // deactivate member



	                $ricksu_company_sts = "<label class='label label-danger'>Inactive</label>";



	            }





	            $btn_edit=$btn_del='';
	            $userPrivileges=getUserPri($dbc,'ricksu_company.php');
				$fetchedUserRole=getUserRole($dbc);
				if ($userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
					$btn_edit='<i id="'.$ricksu_company_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> ';
				endif;
				if ($userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
					$btn_del='| <i id="'.$ricksu_company_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i>';
				endif;

	            $button = '<!-- Single button -->



	            <form>'.$btn_edit.$btn_del.'<input type="hidden" id="table_name" value="ricksu_company"><input type="hidden" id="col_name" value="ricksu_company_id"><input type="hidden" id="sts_col" value="ricksu_company_sts"></form>';







	            $output['data'][] = array(      



	                $row[0],           



	                $row[1],           



	                $row[2],           



	                $ricksu_company_sts,



	                $button         



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}



	function riksu_transportation1($dbc){



	    $result = mysqli_query($dbc,"SELECT * FROM riksu_transportation");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	     // $row = $result->fetch_array();



	     $ricksu_company_sts = ""; 



	        while($row = $result->fetch_array()) {



	        $ricksu_company_id = $row[1];



	          $ricksu_company_name=fetchRecord($dbc,"ricksu_company","ricksu_company_id",$ricksu_company_id);



	            if($row[5] == NULL) {



	                // activate member



	                $ricksu_fee =$row[6]." - Not Running";



	            } elseif($row[6] == NULL) {



	                // deactivate member



	               $ricksu_fee =$row[5]." - Running";



	            }



	            else{



	            	$ricksu_fee ="Null";



	            }



	            $YP=$row['PORT'];
	            $btn_edit=$btn_del='';
	            $userPrivileges=getUserPri($dbc,'ricksu_transportation.php');
				$fetchedUserRole=getUserRole($dbc);
				if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
					$btn_edit='<i id="'.$row[0].'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> ';
				endif;
				if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
					$btn_del='| <i id="'.$row[0].'" class="fa fa-remove delete" style="cursor: pointer;"></i>';
				endif;


	          $button = '<!-- Single button -->



	            <form>'.$btn_edit.$btn_del.'<input type="hidden" id="table_name" value="riksu_transportation"><input type="hidden" id="col_name" value="id"><input type="hidden" id="sts_col" value=""></form><a href="auction_yards.php?auction_house='.strtoupper($row['auction_house_name']).'" class="btn btn-success btn-sm m-1">Add LP Yard</a><a href="auction_yards.php?auction_house='.strtoupper($row['PORT']).'" class="btn btn-dark btn-sm m-1">Add DP Yard </a>';







	            $output['data'][] = array(      



	                $ricksu_company_name['ricksu_company_name'],           



	                $row[2],           



	                $YP,           



	                $row[7],



	                $row[5]."-".$row[6],



	                $button ,



	                      



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}







	function vehicle_services($dbc, $id){



	    $result = mysqli_query($dbc,"SELECT * FROM vehicle_services WHERE vehicle_info_id = '$id'");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	        while($row = $result->fetch_array()) {



	        $vehicle_services_id = $row[0]; 



	            if($row[4] == 1) {



	                // activate member



	                $vehicle_services_sts = "<label class='label label-success'>Active</label>";



	            } else {



	                // deactivate member



	                $vehicle_services_sts = "<label class='label label-danger'>Inactive</label>";



	            }



	            $button = '<form><i id="'.$vehicle_services_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> | <i id="'.$vehicle_services_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i><input type="hidden" id="table_name" value="vehicle_services"><input type="hidden" id="col_name" value="vehicle_services_id"><input type="hidden" id="sts_col" value="vehicle_services_sts"></form>';



	            $vehicle_info = fetchRecord($dbc, "vehicle_info", "vehicle_id", $row[1]);



	            $brand = fetchRecord($dbc, "brands", "brand_id", $vehicle_info['vehicle_brand'])['brand_name'];



	            $output['data'][] = array(      



	                $row[0],



	                "Stock ID : ".$vehicle_info['vehicle_stock_id']."<br> Vehicle Chassis No : ".$vehicle_info['vehicle_chassis_no']."<br> Brand : ".$brand ,



	                $row[2], 



	                $row[3], 



	                $vehicle_services_sts,



	                $button         



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}







	function nexco_offices($dbc){



	    $result = mysqli_query($dbc,"SELECT * FROM nexco_offices");



	    $output = array('data' => array());



	    if($result->num_rows > 0) { 



	     // $row = $result->fetch_array();



	     $auction_grade_sts = ""; 



	        while($row = $result->fetch_array()) {



	        $office_id = $row[0];
	        $btn_edit=$btn_del='';
		            $userPrivileges=getUserPri($dbc,'offices.php');
					$fetchedUserRole=getUserRole($dbc);
					if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): 
						$btn_edit='<i id="'.$office_id.'" class="fa fa-edit text-danger update" style="cursor: pointer;"></i> ';
					endif;
					if (@$userPrivileges['nav_delete']==1 || $fetchedUserRole=="admin"): 
						$btn_del='| <i id="'.$office_id.'" class="fa fa-remove delete" style="cursor: pointer;"></i>';
					endif;


	            $button = '<!-- Single button -->



	            <form>'.$btn_edit.$btn_del.'<input type="hidden" id="table_name" value="nexco_offices"><input type="hidden" id="col_name" value="office_id"><input type="hidden" id="sts_col" value=""> | <i id="'.$office_id.'" class="fa fa-plus-circle newOffice" style="cursor: pointer;"></i></form>';







	            $output['data'][] = array(      



	                $row[0],           



	                $row[1],



	                $row[5],



	                $button         



	            );  



	        } // /while 



	    }// if num_rows



	    $dbc->close();



	    echo json_encode($output);



	}







	//Getting Data For Edit Purpose



	if (isset($_POST['delete_image']) && isset($_POST['delete_image']) != "") {



	 	$id = $_POST['delete_image'];



	 	$img = fetchRecord($dbc, "vehicle_images", "vehicle_image_id", $id)['vehicle_image_name'];



	 	unlink('../img/vehicles_images/'.$img);



	 	deleteFromTable($dbc, "vehicle_images", "vehicle_image_id", $id);



	 	echo "Record Deleted Successfully From Table";	



		exit();



	}



	if (isset($_POST['make_featured']) && isset($_POST['make_featured']) != "") {



	 	$id = $_POST['make_featured'];



	 	$vehicle_id = $_POST['vehicle_id'];



	 	$get_images=mysqli_query($dbc,"SELECT * FROM vehicle_images WHERE vehicle_id='$vehicle_id' ");



	 	while ($fetch=mysqli_fetch_assoc($get_images)) {



	 		if ($fetch['vehicle_image_id']==$id) { 



	 			$data=[



	 				'vehicle_image_featured'=>1,



	 				];



	 			 }



	 		else{



	 				$data=[



	 				'vehicle_image_featured'=>0,



	 				];



	 		}



	 	



	 	update_data($dbc, "vehicle_images", $data,"vehicle_image_id",$fetch['vehicle_image_id']);



	 		



	 		



	 	}







	 	echo "Record updated Successfully ";	



		exit();



	}







 



if(isset($_FILES)){



// Path configuration 



$targetDir = "../img/vehicles_images/"; 



$watermarkImagePath = '../img/uploads/25.png'; 



$statusMsg = ''; 



// foreach ($_FILES["file"]["name"] as $index => $value) { 	



    if(!empty($_FILES["file"]["name"])){ 



        // File upload path 



		$vehicle_id = $_POST['vehicle_id'];



        $stock_id = fetchRecord($dbc, "vehicle_info", "vehicle_id", $vehicle_id)['vehicle_stock_id'];



        $ext = explode(".", $_FILES["file"]["name"]);



		$extension = end($ext);



		$fileName = uniqid(rand()).".".$extension;







        $q = mysqli_query($dbc,"INSERT INTO vehicle_images (vehicle_image_name, vehicle_id) VALUES ('$fileName', '$vehicle_id')");



        $targetFilePath = $targetDir.$fileName; 



        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION); 



    	$file_type = $_FILES["file"]["type"];



	    $file_size = $_FILES["file"]["size"];



    	$error = $_FILES["file"]["error"];



        // Allow certain file formats 



        $allowTypes = array('jpg','png','jpeg', 'JPG', 'PNG', 'JPEG'); 



        if(in_array($extension, $allowTypes)){ 



            // Upload file to the server 



            if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){ 



                // Load the stamp and the photo to apply the watermark to 



                $watermarkImg = imagecreatefrompng($watermarkImagePath); 



                switch($fileType){ 



                    case 'jpg': 



                        $im = imagecreatefromjpeg($targetFilePath); 



                        break; 



                    case 'jpeg': 



                        $im = imagecreatefromjpeg($targetFilePath); 



                        break; 



                    case 'png': 



                        $im = imagecreatefrompng($targetFilePath); 



                        break; 



                    case 'JPG': 



                        $im = imagecreatefromjpeg($targetFilePath); 



                        break; 



                    case 'JPEG': 



                        $im = imagecreatefromjpeg($targetFilePath); 



                        break; 



                    case 'PNG': 



                        $im = imagecreatefrompng($targetFilePath); 



                        break; 



                    default: 



                        $im = imagecreatefromjpeg($targetFilePath); 



                } 



				  



                //  = 	100;	



				//  = 	600;	



                $width = imagesx($im); 



				$height = imagesy($im); 







                $width2 = 	400;	//imagesx($im); 



				$height2 = 	40;	//imagesy($im); 



				



				$spacing = 15;



		        $spacing_double = $spacing  * 2;



				



				// Get image dimensions 



				list($width_orig, $height_orig) = getimagesize($targetFilePath); 



				



				// Resample the image 



				$im2 = imagecreatetruecolor($width, $height); 



				$im3 = imagecreatetruecolor($width2, $height2); 



				if (imagecopyresized($im2, $im, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig)) {



	                // Set the margins for the watermark 



	                $marge_right = 10; 



	                $marge_bottom = 10; 



	                // Get the height/width of the watermark image 



	                $sx = imagesx($watermarkImg);  // 429



	                $sy = imagesy($watermarkImg);  // 112



	                // Get the height/width of the Custome image 



	                $sx2 = imagesx($im3);  // 429



	                $sy2 = imagesy($im3);  // 112



	                //Set Watermark Width Height



	                $offsetX = (imagesx($im2) - ($sx + $spacing)) / 2;



	                $offsetY = (imagesy($im2) - ($sy + $spacing)) / 2;



	                //Set Custom Image Width Height



	                $offsetX2 = (imagesx($im2) - ($sx2 + $spacing));



	                $offsetY2 = (imagesy($im2) - ($sy2 + $spacing));



	                // Copy the watermark image onto our photo using the margin offsets and  



	                // the photo width to calculate the positioning of the watermark. 



					// imagecopymerge($im2, $watermarkImg, $offsetX, $offsetY, 0, 0, $sx, $sy, 25);



					imagecopy($im2, $watermarkImg, $offsetX, $offsetY, 0, 0, $sx, $sy); 



				    



	                $img = imagecreate(250, 50);



				    $textbgcolor = imagecolorallocate($img, 192,192,192);



				    $textcolor = imagecolorallocate($img, 255, 255, 255);



    



			        $txt = "Stock ID : ".$stock_id;



			        imagestring($img, 5, 5, 5, $txt, $textcolor);



			        //Image Copy Stock ID



			        //$dir = realpath('assets/font-awesome/fonts/fontawesome-webfont.ttf');



					// imagettftext($img, 90, 0, 100, 100, imagecolorallocate($im, 0, 0, 255),  "https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap", $txt); 







					imagecopy($im2, $img, $offsetX2, $offsetY2, 0, 0, $sx2, $sy2); 







	                // Save image and free memory 



	                imagejpeg($im2, $targetFilePath); 



	                imagedestroy($im2);



	                



	                if(file_exists($targetFilePath)){ 



	                    $statusMsg = "The image with watermark has been uploaded successfully."; 



	                }else{ 



	                    $statusMsg = "Image upload failed, please try again."; 



	                }  



            	}



            }else{ 



                $statusMsg = "Sorry, there was an error uploading your file."; 



            } 



        }else{ 



            $statusMsg = 'Sorry, only JPG, JPEG, and PNG files are allowed to upload.'; 



        } 



    }


  // }



	echo $statusMsg;



// Display status message 



} 



///////////////////////////////////////////invoice and Quotation 



if (isset($_POST['invoice_customer'])) {



	if (isset($_POST['quotation']) == "") {



	



		$debit = [



			'customer_id' => $_POST['invoice_customer'],



			'vehicle_id' => $_POST['invoice_vehicle'],



			'debit' => $_POST['invoice_due_amount'],

			'credit' => '0',



			'transaction_next_date' => $_POST['invoice_next_due'],



			'transaction_from' => "Invoice1",



		];



		$credit = [



			'customer_id' => $_POST['invoice_bank'],



			'vehicle_id' => $_POST['invoice_vehicle'],



			'bank_id' => $_POST['invoice_bank'],



			'credit' => $_POST['invoice_paid_amount'],

			'debit' => '0',
			'transaction_next_date' => $_POST['invoice_next_due'],

			'transaction_from' => "Invoice1",



		];
		$advanceAmmount=(int)$_POST['invoice_paid_amount']-(int)$_POST['invoice_previous_balance'];
		if ($advanceAmmount>=0) {
			$advanceAmmount=-1*abs($_POST['invoice_previous_balance']);
		}elseif ($advanceAmmount<0) {
			$advanceAmmount=-1*abs($_POST['invoice_paid_amount']);
		}
$advanceTransaction = [



			'customer_id' => $_POST['invoice_customer'],



			'vehicle_id' => $_POST['invoice_vehicle'],



			'bank_id' => $_POST['invoice_bank'],



			'advance' => $advanceAmmount,
			'credit' => '0',
			'debit' => '0',
			'transaction_next_date' => $_POST['invoice_next_due'],



			'transaction_from' => "Invoice1",



		];


		



		if ($_POST['type_btn']=='add') {



		//INsert Invoice



		if ($_POST['invoice_sts']==1) {



			if (insert_data($dbc, "transactions", $credit)) {//Transaction of Invoice



			$transaction_id = $_SESSION['transaction_id'] = mysqli_insert_id($dbc);

		}

		if ($_POST['invoice_previous_balance']!=0) {
			if (insert_data($dbc, "transactions", $advanceTransaction)) {//Transaction of Invoice
			$transaction_advance = $_SESSION['transaction_id'] = mysqli_insert_id($dbc);
			}
		}



			}else{







		if (insert_data($dbc, "transactions", $credit)) {
		//Transaction of Invoice



			$transaction_id = $_SESSION['transaction_id'] = mysqli_insert_id($dbc);
		}
		if ($_POST['invoice_previous_balance']!=0) {
			if (insert_data($dbc, "transactions", $advanceTransaction)) {//Transaction of Invoice
				$transaction_advance = $_SESSION['transaction_id'] = mysqli_insert_id($dbc);
			}
		}


			if (insert_data($dbc, "transactions", $debit)) {//Transaction of Invoice



				$transaction_id2 = $_SESSION['transaction_id'] = mysqli_insert_id($dbc);



				// 'consignee_id' => $_POST['consignee_id'],



				}
		
}
			



				// 'consignee_id' => $_POST['consignee_id'],



			$data = [

					'invoice_services' =>@$invoice_services,
					'consignee_id' => @$_POST['consignee_id'],
					'invoice_date' => $_POST['invoice_date'], 
					'invoice_due_date' => $_POST['invoice_due_date'],
					'invoice_customer' => $_POST['invoice_customer'],
					'invoice_user' => $_POST['invoice_user'],
					'invoice_country' => $_POST['country_name'],
					'invoice_country_port' => $_POST['port_name'],
					'invoice_fee' => $_POST['invoice_fee'],
					'invoice_vehicle' => $_POST['invoice_vehicle'],
					'invoice_vehicle_cost' => $_POST['invoice_cost'],
					'invoice_vehicle_rate' => $_POST['invoice_rate'],
					'invoice_show_rate' => $_POST['invoice_show_rate'],
					'invoice_fci' => $_POST['invoice_fci'],
					'invoice_cui' => $_POST['invoice_cui'],
					'invoice_fright' => $_POST['invoice_fright'],
					'invoice_previous_balance' => $_POST['invoice_previous_balance'],
					'invoice_discount' => $_POST['invoice_discount'],
					'invoice_grand_total' => $_POST['invoice_grand_total'],
					'invoice_paid_amount' => $_POST['invoice_paid_amount'],
					'invoice_due_amount' => $_POST['invoice_due_amount'],
					'invoice_next_due' => $_POST['invoice_next_due'],
					'invoice_inspection' => $_POST['invoice_inspection'],
					'invoice_currency' =>@$_POST['invoice_currency'],
					'exchange_rate' => $_POST['exchange_rate'],
					'invoice_bank' => $_POST['invoice_bank'],
					'invoice_sts' => $_POST['invoice_sts'],
					'invoice_percent' => $_POST['invoice_paid_percent'],
					'invoice_type' =>$_POST['invoice_type'],
					'transaction_id' => @$transaction_id,
					'transaction_id2' => @$transaction_id2,
					'transaction_advance'=>@$transaction_advance,
					'invoice_quotation' => "invoice",
				];
			if (insert_data($dbc, "invoice", $data)) {//Invoice Insert
					$msg = 'Invoice Added Successfully';

					$invoice_id = $_SESSION['invoice_id'] = mysqli_insert_id($dbc);

					mysqli_query($dbc,"UPDATE vehicle_info SET vehicle_status = 'sold' WHERE vehicle_id = '$_POST[invoice_vehicle]'");
					//invoicehtml_mailto($dbc,$invoice_id);
					$data3=['invoice_id' => $invoice_id,];

					@update_data($dbc, "transactions", $data3,"transaction_id",$transaction_id2);



					if (update_data($dbc, "transactions", $data3,"transaction_id",$transaction_id)) {

						

						$respone = array("transaction_id" => $transaction_id, "invoice_id" => $invoice_id, "msg" => $msg);

						/*serveices start*/

									if (!empty($_REQUEST['purchased'])) {

				# code...

			



		if (empty($_REQUEST['purchased'])) {



		foreach ($_REQUEST['gifted'] as $value) {



		$data_purchased=[



		'gifted'=>1,



		'services_id'=>$value,



		'vehicle_id'=>$_REQUEST['invoice_vehicle'],



		'invoice_id'=>$invoice_id,



		];



		if (insert_data($dbc,"services_invoice",$data_purchased)) {



		}



		else{ echo mysqli_error($dbc); }	



		}



		}if (empty($_REQUEST['gifted'])):



		foreach ($_REQUEST['purchased'] as $value) {



		$data_gifted=[



		'gifted'=>0,



		'services_id'=>$value,



		'vehicle_id'=>$_REQUEST['invoice_vehicle'],

		'invoice_id'=>$invoice_id,
		];
		if (insert_data($dbc,"services_invoice",$data_gifted)) { }
		else{ echo mysqli_error($dbc); }
		}
	endif;

	if (!empty($_REQUEST['not_purchased'])):



		foreach ($_REQUEST['not_purchased'] as $value) {



		$data_gifted=[



		'gifted'=>2,

		'services_id'=>$value,



		'vehicle_id'=>$_REQUEST['invoice_vehicle'],



		'invoice_id'=>$invoice_id,



		];
		if (insert_data($dbc,"services_invoice",$data_gifted)) { }
		else{ echo mysqli_error($dbc); }
		}
	endif;

}
						echo json_encode($respone);

					}

				}else{



					$msg = mysqli_error($dbc);



					$respone = array("","",$msg);



					echo json_encode($respone);



				}



			



		}if ($_POST['type_btn']=='update') {



			



			$debit = [



			'customer_id' => $_POST['invoice_customer'],



			'vehicle_id' => $_POST['invoice_vehicle'],



			'debit' => $_POST['invoice_due_amount'],

			'credit' => '0',



			'transaction_next_date' => $_POST['invoice_next_due'],



			'transaction_from' => "Invoice2",



		];



		$credit = [



			'customer_id' => $_POST['invoice_bank'],



			'vehicle_id' => $_POST['invoice_vehicle'],



			'bank_id' => $_POST['invoice_bank'],



			'credit' => $_POST['invoice_paid_amount'],

			'debit' => '0',



			'transaction_next_date' => $_POST['invoice_next_due'],



			'transaction_from' => "Invoice2",



		];







			$invoice_id = $_SESSION['invoice_id'] = $_POST['invoice_id'];

			$invoice=fetchRecord($dbc,"invoice","invoice_id",$_POST['invoice_id']);
			if ($_POST['invoice_sts']==1) {



			if (update_data($dbc, "transactions", $credit,"transaction_id",$invoice['transaction_id'])) {//Transaction of Invoice



		
			$transaction_id = $_SESSION['transaction_id'] = mysqli_insert_id($dbc);

		}

		if ($_POST['invoice_previous_balance']!=0) {
			if (update_data($dbc, "transactions", $advanceTransaction,'transaction_id',$invoice['transaction_advance'])) {//Transaction of Invoice
			$transaction_advance = $_SESSION['transaction_id'] = mysqli_insert_id($dbc);
			}
		}



}else{







		if (update_data($dbc, "transactions", $credit,"transaction_id",$invoice['transaction_id'])) {//Transaction of Invoice
				$transaction_id = $invoice['transaction_id'];
		}
		if ($_POST['invoice_previous_balance']!=0) {
			if (update_data($dbc, "transactions", $advanceTransaction,'transaction_id',$invoice['transaction_advance'])) {//Transaction of Invoice
				$transaction_advance = $invoice['transaction_advance'];
			}
		}

		if (update_data($dbc, "transactions", $debit,"transaction_id",$invoice['transaction_id2'])) {//Transaction of Invoice
				$transaction_id2 = $invoice['transaction_id2'];
				}
		
		}
			

/*[---------------------------------------------------------------------------------------------*/
			$data = [



					'invoice_date' => $_POST['invoice_date'], 



					'invoice_due_date' => $_POST['invoice_due_date'],



					'invoice_customer' => $_POST['invoice_customer'],



					'invoice_user' => $_POST['invoice_user'],



					'invoice_country' => $_POST['country_name'],



					'invoice_country_port' => $_POST['port_name'],



					'invoice_fee' => $_POST['invoice_fee'],



					'invoice_vehicle' => $_POST['invoice_vehicle'],



					'invoice_vehicle_cost' => $_POST['invoice_cost'],



					'invoice_vehicle_rate' => $_POST['invoice_rate'],



					'invoice_show_rate' => $_POST['invoice_show_rate'],
					'invoice_fci' => $_POST['invoice_fci'],
					'invoice_cui' => $_POST['invoice_cui'],
					'invoice_fright' => $_POST['invoice_fright'],
					'invoice_previous_balance' => $_POST['invoice_previous_balance'],
					'invoice_discount' => $_POST['invoice_discount'],
					'invoice_grand_total' => $_POST['invoice_grand_total'],
					'invoice_paid_amount' => $_POST['invoice_paid_amount'],
					'invoice_due_amount' => $_POST['invoice_due_amount'],
					'invoice_next_due' => $_POST['invoice_next_due'],
					'invoice_inspection' => $_POST['invoice_inspection'],
					'invoice_bank' => $_POST['invoice_bank'],
					'invoice_currency' =>@$_POST['invoice_currency'],
					'exchange_rate' => $_POST['exchange_rate'],
					'invoice_type' =>$_POST['invoice_type'],
					'invoice_sts' => $_POST['invoice_sts'],
					'invoice_percent' => $_POST['invoice_paid_percent'],


				];



					if (update_data($dbc, "invoice", $data,"invoice_id",$invoice_id)) {//Invoice Insert

						invoicehtml_mailto($dbc,$invoice_id);


					$msg = 'Invoice Updated Successfully';



					mysqli_query($dbc,"UPDATE vehicle_info SET vehicle_status = 'sold' WHERE vehicle_id = '$_POST[invoice_vehicle]'");



					$respone = array("transaction_id" => $transaction_id, "invoice_id" => $invoice_id, "msg" => $msg);

											/*serveices start*/

									if (!empty($_REQUEST['purchased'])) {

				# code...

			



		if (empty($_REQUEST['purchased'])) {



		foreach ($_REQUEST['gifted'] as $value) {



		$data_purchased=[



		'gifted'=>1,



		'services_id'=>$value,



		'vehicle_id'=>$_REQUEST['invoice_vehicle'],



		'invoice_id'=>$invoice_id,



		];



		if (update_data($dbc,"services_invoice",$data_purchased,"invoice_id",$invoice_id)) {

		}



		else{ echo mysqli_error($dbc); }	



		}



		}if (empty($_REQUEST['gifted'])):



		foreach ($_REQUEST['purchased'] as $value) {



		$data_gifted=[



		'gifted'=>0,



		'services_id'=>$value,



		'vehicle_id'=>$_REQUEST['invoice_vehicle'],



		'invoice_id'=>$invoice_id,



		];



		if (update_data($dbc,"services_invoice",$data_purchased,"invoice_id",$invoice_id))  { }



		else{ echo mysqli_error($dbc); }



		}



	endif;

	if (!empty($_REQUEST['not_purchased'])):



		foreach ($_REQUEST['not_purchased'] as $value) {



		$data_gifted=[



		'gifted'=>2,

		'services_id'=>$value,



		'vehicle_id'=>$_REQUEST['invoice_vehicle'],



		'invoice_id'=>$invoice_id,



		];



		if (update_data($dbc,"services_invoice",$data_purchased,"invoice_id",$invoice_id))  { }



		else{ echo mysqli_error($dbc); }



		}



	endif;

}

						/*services end*/ 

					echo json_encode($respone);



				}else{



					$msg = mysqli_error($dbc);



					$respone = array("","",$msg);



					echo json_encode($respone);



				}







		}



			}else{



		$data = [



			'invoice_date' => $_POST['invoice_date'], 



			'consignee_id' => $_POST['consignee_id'],



			'invoice_due_date' => $_POST['invoice_due_date'],



			'invoice_customer' => $_POST['invoice_customer'],



			'invoice_user' => $_POST['invoice_user'],



			'invoice_country' => $_POST['country_name'],



			'invoice_country_port' => $_POST['port_name'],



			'invoice_fee' => $_POST['invoice_fee'],



			'invoice_vehicle' => $_POST['invoice_vehicle'],



			'invoice_vehicle_cost' => $_POST['invoice_cost'],



			'invoice_vehicle_rate' => $_POST['invoice_rate'],



			'invoice_show_rate' => $_POST['invoice_show_rate'],



			'invoice_fci' => $_POST['invoice_fci'],



			'invoice_cui' => $_POST['invoice_cui'],



			'invoice_fright' => $_POST['invoice_fright'],



			'invoice_previous_balance' => $_POST['invoice_previous_balance'],



			'invoice_discount' => $_POST['invoice_discount'],



			'invoice_grand_total' => $_POST['invoice_grand_total'],



			'invoice_paid_amount' => $_POST['invoice_paid_amount'],



			'invoice_due_amount' => $_POST['invoice_due_amount'],



			'invoice_next_due' => $_POST['invoice_next_due'],



			'invoice_inspection' => $_POST['invoice_inspection'],



			'invoice_currency' => $_POST['invoice_currency'],



			'invoice_bank' => $_POST['invoice_bank'],



			'invoice_sts' => $_POST['invoice_sts'],



			'invoice_percent' => $_POST['invoice_paid_percent'],



			'invoice_quotation' => "quotation",



		];



		if ($_POST['type_btn']=='add') {



			if (insert_data($dbc, "invoice", $data)) {//Invoice Insert



			$msg = 'Invoice Added Successfully';



			$invoice_id = $_SESSION['invoice_id'] = mysqli_insert_id($dbc);



			$respone = array("transaction_id" => $_POST['quotation'], "invoice_id" => $invoice_id, "msg" => $msg);



		



			if (!empty($_REQUEST['purchased'])) {

				# code...

			



		if (empty($_REQUEST['purchased'])) {



		foreach ($_REQUEST['gifted'] as $value) {



		$data_purchased=[



		'gifted'=>1,



		'services_id'=>$value,



		'vehicle_id'=>$_REQUEST['invoice_vehicle'],



		'invoice_id'=>$invoice_id,



		];



		if (insert_data($dbc,"services_invoice",$data_purchased)) {



		}



		else{ echo mysqli_error($dbc); }	



		}



		}if (empty($_REQUEST['gifted'])):



		foreach ($_REQUEST['purchased'] as $value) {



		$data_gifted=[



		'gifted'=>0,



		'services_id'=>$value,



		'vehicle_id'=>$_REQUEST['invoice_vehicle'],



		'invoice_id'=>$invoice_id,



		];



		if (insert_data($dbc,"services_invoice",$data_gifted)) { }



		else{ echo mysqli_error($dbc); }



		}



	endif;

	if (!empty($_REQUEST['not_purchased'])):



		foreach ($_REQUEST['not_purchased'] as $value) {



		$data_gifted=[



		'gifted'=>2,

		'services_id'=>$value,



		'vehicle_id'=>$_REQUEST['invoice_vehicle'],



		'invoice_id'=>$invoice_id,



		];



		if (insert_data($dbc,"services_invoice",$data_gifted)) { }



		else{ echo mysqli_error($dbc); }



		}



	endif;

}

		echo json_encode($respone);



		}



		}



		if ($_POST['type_btn']=='update') {



			$invoice_id = $_SESSION['invoice_id'] = $_POST['invoice_id'];







					if (update_data($dbc, "invoice", $data,"invoice_id",$invoice_id)) {//Invoice Insert



						mysqli_query($dbc,"UPDATE invoice SET invoice_quotation = 'invoice' WHERE invoice_id = '$invoice_id' " );

						mysqli_query($dbc,"UPDATE vehicle_info SET vehicle_status = 'sold' WHERE vehicle_id =  '$_REQUEST[invoice_vehicle]'");



			$msg = 'Invoice Updated Successfully';



						$respone = array("transaction_id" => $_POST['quotation'], "invoice_id" => $invoice_id, "msg" => $msg);

								/*serveices start*/

									if (!empty($_REQUEST['purchased'])) {

				# code...

			



		if (empty($_REQUEST['purchased'])) {



		foreach ($_REQUEST['gifted'] as $value) {



		$data_purchased=[



		'gifted'=>1,



		'services_id'=>$value,



		'vehicle_id'=>$_REQUEST['invoice_vehicle'],



		'invoice_id'=>$invoice_id,



		];



		if (update_data($dbc,"services_invoice",$data_purchased,"invoice_id",$invoice_id)) {

		}



		else{ echo mysqli_error($dbc); }	



		}



		}if (empty($_REQUEST['gifted'])):



		foreach ($_REQUEST['purchased'] as $value) {



		$data_gifted=[



		'gifted'=>0,



		'services_id'=>$value,



		'vehicle_id'=>$_REQUEST['invoice_vehicle'],



		'invoice_id'=>$invoice_id,



		];



		if (update_data($dbc,"services_invoice",$data_purchased,"invoice_id",$invoice_id))  { }



		else{ echo mysqli_error($dbc); }



		}



	endif;

	if (!empty($_REQUEST['not_purchased'])):



		foreach ($_REQUEST['not_purchased'] as $value) {



		$data_gifted=[



		'gifted'=>2,

		'services_id'=>$value,



		'vehicle_id'=>$_REQUEST['invoice_vehicle'],



		'invoice_id'=>$invoice_id,



		];



		if (update_data($dbc,"services_invoice",$data_purchased,"invoice_id",$invoice_id))  { }



		else{ echo mysqli_error($dbc); }



		}



	endif;

}

						/*services end*/ 



			echo json_encode($respone);



		}



		}











	}



}



if(!empty($_REQUEST['action']) AND $_REQUEST['action']=="quotation"){



	include_once 'db_connect.php';



	$delete_id=$_REQUEST['delete_id'];



	$deleteQ=mysqli_query($dbc,"DELETE FROM invoice WHERE invoice_id='$delete_id'");



	if ($deleteQ) {



		echo "Quotation Has Been Deleted";	}



	else{



		echo mysqli_error($dbc);



	}



}





if (isset($_REQUEST['customer_details_payment'])) {



	 $custNow = $_REQUEST['customer_details_payment'];



	 $get_customer=mysqli_query($dbc,"SELECT SUM(credit-debit) as nowbalance,SUM(credit) as paidamount  ,invoice_id,customer_id,vehicle_id  FROM transactions WHERE customer_id = '$custNow' GROUP BY vehicle_id");

	 $c=$total_amount_remaing=0;

	 if (mysqli_num_rows($get_customer)>0) {
	 	// code...
	 

			while($fetchTrans=mysqli_fetch_assoc($get_customer)):



				$c++;



				
		if ((int)$fetchTrans['invoice_id']>0):
			@$invoice=fetchRecord($dbc,"invoice","invoice_id",@$fetchTrans['invoice_id']);

				$customer = fetchRecord($dbc, "customers", "customer_id", $fetchTrans['customer_id']);



				$vehicle = fetchRecord($dbc,"vehicle_info","vehicle_id",$fetchTrans['vehicle_id']);



                $maker = fetchRecord($dbc,"maker","maker_id",$vehicle['vehicle_maker'])['maker_name'];



                $brand = fetchRecord($dbc,"brands","brand_id",$vehicle['vehicle_brand'])['brand_name'];
                $debit=0;
			if ($fetchTrans['nowbalance']<0) {

				$total_amount_remaing+=abs($fetchTrans['nowbalance']);

				# code...



			



				echo"<tr><td>".$fetchTrans['invoice_id']."



			</td>



				<td>



					ID : ".$customer['customer_name']."<br>



					Name :".$brand." ".$maker."



				</td>



				<td>



					".$invoice['invoice_grand_total']."



				</td>



				



				<td>



					".abs($fetchTrans['nowbalance'])."



				</td>



				<td>



				<input type='number'  class='form-control' id='check".$c."' onchange='checkbalance(".$c.")'  data-balance='".abs($fetchTrans['nowbalance'])."' name='paying_amount[]'>

				<span style='color:red;display:none;' id='alert".$c."'>Paying Amount Should not Greater then Remaing Amount </span>



				<input type='hidden' class='form-control' value='".$fetchTrans['invoice_id']."' name='invoice_id[]'>



				<input type='hidden' class='form-control' value='".$invoice['invoice_vehicle']."' name='vehicle_id[]'>



				</td>

				<input type='hidden' id='total_ammount_topaid' value='".$total_amount_remaing."'>

			</tr>";}


endif;
		endwhile;
		}



	# code...



}



if (!empty($_REQUEST['action']) AND $_REQUEST['action']=="payment_voucher") {



	



		if (empty($_REQUEST['voucher_id'])) {



		$debit = [



			'customer_id' => $_POST['customer'],



			'vehicle_id' => $_POST['vehicle'],



			'invoice_id'=>$_REQUEST['invoice'],



			'debit' => $_POST['remain'],



		];



		$credit = [



			'customer_id' => $_POST['customer'],



			'vehicle_id' => $_POST['vehicle'],



			'invoice_id'=>$_REQUEST['invoice'],



			'credit' => $_POST['amount'],



		];



				if ($_POST['remain']==0) {



			if (insert_data($dbc, "transactions", $credit)) {//Transaction of Invoice



			$transaction_id = $_SESSION['transaction_id'] = mysqli_insert_id($dbc);}



			}



			else{







		if (insert_data($dbc, "transactions", $credit)) {//Transaction of Invoice



			$transaction_id = $_SESSION['transaction_id'] = mysqli_insert_id($dbc);



			if (insert_data($dbc, "transactions", $debit)) {//Transaction of Invoice



				}}}



}else{



	echo "Please Add First Payment";



}

}



if (isset($_REQUEST['customer_details_values'])) {



	 $get_customer=getWhere($dbc,"transactions","customer_id",$_REQUEST['customer_details_values']);

	 	$total=$remain=$paid;

			while($fetchCustomer=mysqli_fetch_assoc($get_customer)):



				$customer = fetchRecord($dbc, "customers", "customer_id", $fetchCustomer['customer_id']);



				@$invoice = fetchRecord($dbc, "invoice", "invoice_id",@$fetchCustomer['invoice_id']);



				@$total+=(int)$invoice['invoice_grand_total'];



				@$remain+=(int)$invoice['invoice_due_amount'];



				@$paid+=(int)$invoice['invoice_paid_amount'];



			endwhile;



			$data=['total'=>$total,



			'due'=>$remain,



			'paid'=>$paid,



				];



				echo json_encode($data);



	# code...



}







if (isset($_POST['customer_name_paymentModule'])) {

		@upload_files($_FILES['bank_slip'],"../img/vehicle_docs/");

				$document=$_SESSION['pic_name'];

				unset($_SESSION['pic_name']);
		$total=0;
		$data1 = [			
			'customer_name' => $_POST['customer_name_paymentModule'],
			'reservation_id' =>@$_POST['reservation_id'],
			'sender_country' => $_POST['sender_country'],
			'sender_country' => $_POST['sender_country'],
			'sender_reference' => $_POST['sender_reference'],
			'sender_currency' => $_POST['sender_currency'],
			'total_sender_amount' => $_POST['total_sender_amount'],
			'bank_slip' => @$document,
			'purpose' => $_POST['purpose'],			
			'sender_bank_name' => $_POST['sender_bank_name'],
			'sender_branch_code' => $_POST['sender_branch_code'],
			'sender_account' => $_POST['sender_account'],
			'sender_account_title' => $_POST['sender_account_title'],
			'sender_branch_name' => $_POST['sender_branch_name'],
			'sender_swift_code' => $_POST['sender_swift_code'],
			'sender_bank_phone' => $_POST['sender_bank_phone'],
			'sender_account_address' => $_POST['sender_account_address'],

			'receving_bank' => $_POST['receving_bank'],

			'total_receiver_amount' => $_POST['total_receiver_amount'],

			'inter_bank_charges' => $_POST['inter_bank_charges'],
			'local_bank_charges' => $_POST['local_bank_charges'],
			'net_amount_received' => $_POST['net_amount_received'],
			'receiver_reference' => $_POST['receiver_reference'],
			'receiver_currency' => $_POST['receiver_currency'],
			'total_amount_recevied' => $_POST['total_amount_recevied'],			

			'vehicle_info' => @$_POST['vehicle_info'],

			'exchange_rate' => $_POST['exchange_rate'],

			'receving_date' => $_POST['receving_date'],

			'voucher_notes' => $_POST['voucher_notes'],

			'voucher_type' => $_POST['payement_type'],

			];	

		if (insert_data($dbc, "payment", $data1)) {

			$payment_id = $_SESSION['payment_id'] = mysqli_insert_id($dbc);

			$x= 0;
			if (!empty($_REQUEST['paying_amount'])) {
		
			foreach ($_REQUEST['paying_amount'] as $key => $value) {
		
			mysqli_query($dbc,"INSERT INTO transactions(credit,debit,vehicle_id,customer_id,voucher_id,transaction_from,transaction_remarks,bank_id) VALUES('".$_REQUEST['paying_amount'][$x]."','0','".$_REQUEST['vehicle_id'][$x]."','".$_REQUEST['customer_name_paymentModule']."','$payment_id','voucher added','From payment voucher','".$_POST['receving_bank']."') ");	
				$x++;
				}
			}
				$total=(int)$_POST['total_amount_recevied']-(int)$_POST['total_ammount_counted'];
				$tans=[
					'bank_id'=>$_POST['receving_bank'],
					'transaction_remarks'=>'balance added',
					'debit'=>0,
					'advance'=>$total,
					'customer_id'=>$_POST['customer_name_paymentModule'],
					'voucher_id'=>$payment_id,
					'transaction_from'=>'voucher Added',

				];
				$bank_trans=[
					'customer_id'=>$_POST['receving_bank'],
					'bank_id'=>$_POST['receving_bank'],
					'credit'=>$_POST['total_amount_recevied'],
					'voucher_id'=>$payment_id,
					'transaction_from'=>'voucher Added',
					'transaction_remarks'=>'voucher added',


				];
				insert_data($dbc, "transactions", $bank_trans);
				insert_data($dbc, "transactions", $tans);
				echo $payment_id;
		}else{
			echo mysqli_error($dbc);
		}

	



}







if (isset($_POST['customer_idSaleInvoice1'])) {



	$customer_idSaleInvoice1 = $_POST['customer_idSaleInvoice1'];



	//Customer Balance



	$r = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM customers WHERE customer_id = '$customer_idSaleInvoice1'"));

	$r4 = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT sum(advance) AS newbalance FROM transactions WHERE customer_id = '$customer_idSaleInvoice1'"));






	//Customer Vehicle

if ($_POST['type']=="quotation") {
	# code...
	$q = mysqli_query($dbc,"SELECT vehicle_info.*,brands.* FROM vehicle_info INNER JOIN brands ON brands.brand_id = vehicle_info.vehicle_brand WHERE  vehicle_info.vehicle_status != 'sold'");


}else{
	# code...
	$q = mysqli_query($dbc,"SELECT reservation.*, vehicle_info.*,brands.* FROM reservation INNER JOIN vehicle_info ON vehicle_info.vehicle_id = reservation.vehicle_id INNER JOIN brands ON brands.brand_id = vehicle_info.vehicle_brand WHERE reservation.reservation_customer = '$customer_idSaleInvoice1' AND vehicle_info.vehicle_status != 'sold'");


}

	$r2 = array();



	while ($r1 = mysqli_fetch_assoc($q)) {



	    $r2[] = $r1;



	}



	$q3 = mysqli_query($dbc,"SELECT * FROM consignee WHERE customer_id = '$customer_idSaleInvoice1'");



	$r3 = array();



	while ($fetch = mysqli_fetch_assoc($q3)) {



	    $r3[] = $fetch;



	}



	echo json_encode(array('data' => $r,'data2' => $r2,'data3' => $r3,'data4' => $r4['newbalance']));



}

if (isset($_POST['customer_idForVehicle'])) {



	$customer_idForVehicle = $_POST['customer_idForVehicle'];



	//Customer Balance



	$r = mysqli_query($dbc, "SELECT * FROM invoice WHERE invoice_customer = '$customer_idForVehicle'");

	
if (mysqli_num_rows($r)>0) {
	# code...

$i=0;
	while ($fetch = mysqli_fetch_assoc($r)) {

$vid=$fetch['invoice_vehicle'];
$vehicle = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT vehicle_info.*, maker.*, brands.* FROM vehicle_info INNER JOIN maker ON vehicle_info.vehicle_maker = maker.maker_id INNER JOIN brands ON brands.brand_id = vehicle_info.vehicle_brand WHERE vehicle_info.vehicle_id = $vid"));

	  echo "<option value='".$fetch['invoice_vehicle']."' > ".$vehicle['maker_name']." ".$vehicle['brand_name']."</option>";
	  $i++;



	}
}else{
	 echo "<option value='' >No Vehicle Found</option>";
}

}






if (isset($_POST['vehicle_idSaleInvoice'])) {



	$vehicle_idSaleInvoice = $_POST['vehicle_idSaleInvoice'];



	//Vehicle

if ($_POST['type']=="quotation") {
	# code...
	$q = mysqli_query($dbc,"SELECT vehicle_info.*,brands.* FROM vehicle_info INNER JOIN brands ON brands.brand_id = vehicle_info.vehicle_brand WHERE  vehicle_info.vehicle_id = '$vehicle_idSaleInvoice' ");


}else{
	# code...
	$q = mysqli_query($dbc,"SELECT vehicle_info.*, reservation.*, brands.* FROM vehicle_info INNER JOIN reservation ON vehicle_info.vehicle_id = reservation.vehicle_id LEFT OUTER JOIN brands ON brands.brand_id = vehicle_info.vehicle_brand WHERE vehicle_info.vehicle_id = '$vehicle_idSaleInvoice'");


}


	


	$gTotal = getTotalCost($dbc,$vehicle_idSaleInvoice) + getTotalExpense($dbc, $vehicle_idSaleInvoice);



	$r2 = array();



	$r3 = array();



	while ($r1 = mysqli_fetch_assoc($q)) {



	    $r2 = $r1;



	}



	// ............



$services=getWhere($dbc,"vehicle_services","vehicle_info_id",$vehicle_idSaleInvoice);





$Subtotal_price=0;

if (mysqli_num_rows($services)>0) {

	# code...



	while ($servicesFetch=mysqli_fetch_assoc($services)) {



		



		 $vehicle=fetchRecord($dbc, "vehicle_info", "vehicle_id", $servicesFetch['vehicle_info_id']);



		@$Subtotal_price+=$servicesFetch["vehicle_services_amount"];



 $r3= '<tr >



            



             <td>'.$servicesFetch['vehicle_services_name'].'</td>                        



             <td>'.$servicesFetch["vehicle_services_amount"].'</td>



             <td ><input onclick="gift('.$servicesFetch["vehicle_services_amount"].','.$servicesFetch['vehicle_services_id'].','.$servicesFetch['vehicle_info_id'].','.$vehicle_idSaleInvoice.')" class="form-check-input gift service'.$servicesFetch["vehicle_services_id"].'" value="'.$servicesFetch["vehicle_services_id"].'" type="checkbox" name="gifted[]" id="gift_'.$servicesFetch['vehicle_services_id'].'">



                 <i class="fa fa-gift" style="font-size:30px;"></i>



                  </td> 



              <td  ><input onclick="purchase('.$servicesFetch["vehicle_services_amount"].','.$servicesFetch['vehicle_services_id'].','.$servicesFetch['vehicle_info_id'].','.$vehicle_idSaleInvoice.')"   class="form-check-input purchase ml-2 service'.$servicesFetch["vehicle_services_id"].'" value="'.$servicesFetch["vehicle_services_id"].'" type="checkbox" name="purchased[]" id="pur_'.$servicesFetch['vehicle_services_id'].'">



                 <i class="fa fa-dollar ml-4" style="font-size:30px;"></i>



                </td> 



                 <td  ><input onclick="notpurchase('.$servicesFetch["vehicle_services_amount"].','.$servicesFetch['vehicle_services_id'].','.$servicesFetch['vehicle_info_id'].','.$vehicle_idSaleInvoice.')"  class="form-check-input purchase ml-2  service'.$servicesFetch["vehicle_services_id"].'" value="'.$servicesFetch["vehicle_services_id"].'" type="checkbox" checked name="not_purchased[]" id="notpur_'.$servicesFetch['vehicle_services_id'].'">



                 <i class="fa fa-dollar ml-4" style="font-size:30px;"></i>		



                </td> 



                       <input type="hidden" name="total_services_fee" id="total_services_fee" value="'.$Subtotal_price.'">                                      



        </tr>                         



                                                       ';







	}}else{



 $r3= '<tr >

 			<td colspan="5">Not Service Found</td>

            

           <input type="hidden" name="total_services_fee" id="total_services_fee" value="0">                                      



        </tr>                         



                                                       ';



	}





















	//...............



	$response = array($r2,$gTotal,$r3);



	echo json_encode($response);



}



	



//Getting Data For Edit Purpose



if (isset($_POST['ricksu_company_nameFetchFee']) && isset($_POST['ricksu_company_nameFetchFee']) != "") {



	$id = $_POST['ricksu_company_nameFetchFee'];



	$q = mysqli_query($dbc,"SELECT * FROM ricksu_company WHERE ricksu_company_id = $id");



	$response = array();



	while($r = mysqli_fetch_assoc($q)){



		$response[] = $r;



	}



	echo json_encode($response);	



	exit();



}



	



//Getting Data For Edit Purpose



if (isset($_POST['consignee_info_customer1']) && isset($_POST['consignee_info_customer1']) != "") {



	$id = $_POST['consignee_info_customer1'];



	$q = mysqli_query($dbc,"SELECT * FROM customers WHERE customer_id = $id");



	$response = array();



	while($r = mysqli_fetch_assoc($q)){



		$response[] = $r;



	}



	echo json_encode($response);	



	exit();



}



	



//Getting Data For Edit Purpose



if (isset($_POST['receving_bank2']) && isset($_POST['receving_bank2']) != "") {



	$id = $_POST['receving_bank2'];



	$q = mysqli_query($dbc,"SELECT * FROM customers WHERE customer_id = $id");



	$response = array();



	while($r = mysqli_fetch_assoc($q)){



		$response = $r;



	}



	echo json_encode($response);	



	exit();



}







//country_regulation_country



if (isset($_POST['country_regulation_country'])) {



	$data = [



		'country_regulation_country' => $_POST['country_regulation_country'],



		'country_regulation_continent' => $_POST['country_regulation_continent'],



		'country_regulation_year' => $_POST['country_regulation_year'],



		'country_regulation_destination_port' => $_POST['country_regulation_destination_port'],



		'country_regulation_time_shipment' => $_POST['country_regulation_time_shipment'],



		'country_regulation_vessel' => $_POST['country_regulation_vessel'],



		'country_regulation_shipping_line' => $_POST['country_regulation_shipping_line'],



		'country_regulation_inspection' => $_POST['country_regulation_inspection'],



		'country_regulation_hand' => $_POST['country_regulation_hand'],



		'country_regulation_fee' => $_POST['country_regulation_fee'],



		'm3_0_14' => $_POST['m3_0_14'],



		'm3_14_20' => $_POST['m3_14_20'],



		'container_20ft' => $_POST['container_20ft'],



		'container_40ft' => $_POST['container_40ft'],



	];



	if ($_POST['country_regulation_id'] == "") {



		if (insert_data($dbc, "country_regulation", $data)) {



			echo $msg = "Countries Regulation Added Successfully";



			exit();



		}else{



			echo $msg = mysqli_error($dbc);



			exit();



		}



	}else{



		if (update_data($dbc, "country_regulation", $data, "country_regulation_id", $_POST['country_regulation_id'])) {



			echo $msg = "Countries Regulation Updated Successfully";



			exit();



		}else{



		echo $msg = mysqli_error($dbc);



			exit();



		}



	}



}







//vehicle_feature



if (isset($_POST['vehicle_feature_name'])) {



	$data = [



		'vehicle_feature_name' => $_POST['vehicle_feature_name'],



		'vehicle_feature_category' => $_POST['vehicle_feature_category'],



		'vehicle_feature_sts' => "1",



	];



	if ($_POST['vehicle_feature_id'] == "") {



		if (insert_data($dbc, "vehicle_feature", $data)) {



			echo $msg = "Vehicle Feature Added Successfully";



			exit();



		}else{



			echo $msg = mysqli_error($dbc);



			exit();



		}



	}else{



		if (update_data($dbc, "vehicle_feature", $data, "vehicle_feature_id", $_POST['vehicle_feature_id'])) {



		echo $msg = "Vehicle Feature Updated Successfully";



			exit();



		}else{



		echo $msg = mysqli_error($dbc);



			exit();



		}



	}



}







//vehicle_feature



if (isset($_POST['vehicle_feature_list'])) {



	$vehicle_feature_list = $_POST['vehicle_feature_list'];



	$array = json_encode($vehicle_feature_list);



	$data = [



		'vehicle_feature_list' => $array,



	];



	if ($_POST['vehicle_id'] != "") {



		if (update_data($dbc, "vehicle_info", $data, "vehicle_id", $_POST['vehicle_id'])) {



			echo 'Vehicle Features Added Successfully';



			redirect("../trade.php?vehicle_id=$_POST[vehicle_id]#customer_info", 3000);



		}



	}



}



	



 //Getting Data For Edit Purpose



if (isset($_POST['country_name1']) && isset($_POST['country_name1']) != "") {



	$id = $_POST['country_name1'];



	$q = mysqli_query($dbc,"SELECT * FROM country_regulation WHERE country_regulation_country LIKE '%$id%' ");

// echo "SELECT * FROM country_regulation WHERE country_regulation_country LIKE  '%$id%' ";

	$response = array();



	while($r = mysqli_fetch_assoc($q)){



		$response[] = $r;



	}



	echo json_encode($response);	



	exit();



}



	



//Getting Data For Edit Purpose



if (isset($_POST['port_name1']) && isset($_POST['port_name1']) != "") {



	$id = $_POST['port_name1'];



	$q = mysqli_query($dbc,"SELECT * FROM country_regulation WHERE country_regulation_id = '$id'");



	$response = array();



	while($r = mysqli_fetch_assoc($q)){



		$response[] = $r;



	}



	echo json_encode($response);	



	exit();



}







//Models



if (isset($_POST['model_name'])) {



	$brand_id = $_POST['brand_id'];



	$model_id = $_POST['model_id'];



	$modelName = explode(",", $_POST['model_name']);



	foreach ($modelName as $x => $value) {



		$data = [



			'model_name' => $value,



			'brand_id' => $brand_id



		];



		if ($model_id == "") {



			if (insert_data($dbc, "models", $data)) {



				echo $msg = "Models Added Successfully";



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}else{



			if (update_data($dbc, "models", $data, "model_id", $_POST['model_id'])) {



				echo $msg = "Models Data Updated Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}



	}



	exit();



}







//Vehicle Docs



if (isset($_POST['vehicle_idDocs'])) {



	if (upload_files($_FILES['vehicle_file_name'], "../img/vehicle_docs/")) {



		$data = [



			'vehicle_id' => $_POST['vehicle_idNow'],



			'file_type' =>$_POST['file_type'],



			'airmail_file_name' => $_SESSION['pic_name'],



			'file_title' => $_REQUEST['airmail_file_name'],



		];



		if ($_POST['airmail_file_id'] == "") {



			if (insert_data($dbc, "airmail_files", $data)) {



				echo 'Document Upload Successfully';



			}else{



				echo mysqli_error($dbc);



				exit();



			}



		}else{



		 	if (update_data($dbc, "airmail_files", $data, "airmail_file_id", $_POST['airmail_file_id'])) {



		 		echo 'Documents Updated Successfully';



		 	}



		}



	}



}



	



//Getting Data For Edit Purpose consignee_info_party_name2



if (isset($_POST['consignee_info_party_name2']) && isset($_POST['consignee_info_party_name2']) != "") {



	$id = $_POST['consignee_info_party_name2'];



	$q = mysqli_query($dbc,"SELECT * FROM consignee WHERE consignee_id = $id");



	$response = array();



	while($r = mysqli_fetch_assoc($q)){



		$response = $r;



	}



	echo json_encode($response);	



	exit();



}



if (isset($_POST['sortable_img']) && isset($_POST['sortable_img']) != "") {



$post_order = isset($_POST["post_order_ids"]) ? $_POST["post_order_ids"] : [];







if(count($post_order)>0){



	for($order_no= 0; $order_no < count($post_order); $order_no++)



	{



	 $query = "UPDATE vehicle_images SET order_no = '".($order_no+1)."' WHERE vehicle_image_id = '".$post_order[$order_no]."'";



	 mysqli_query($dbc, $query);



	}



	echo true; 



}else{



	echo false; 



}}







//Getting Data For Edit Purpose consignee_info_party_name2



if (isset($_POST['makers']) && isset($_POST['makers']) != "") {



	$id = $_POST['makers'];



	$q = mysqli_query($dbc,"SELECT * FROM brands WHERE maker_id = $id");



	// $response = array();



	while($r = mysqli_fetch_assoc($q)){



		$response[] = $r;



	}



	echo json_encode($response);	



	exit();



}



if (isset($_POST['color_name_get']) && isset($_POST['color_name_get']) != "") {



	$id = $_POST['color_maker'];



	$name = $_POST['color_name_get'];







	$q = mysqli_query($dbc,"SELECT DISTINCT color_code_name FROM color_code WHERE color_name = '$name' AND color_maker = '$id' AND color_code_sts = '1' ");



	// $response = array();



	if (mysqli_num_rows($q)>=1) {



		while ($r = mysqli_fetch_assoc($q)) {
			# code...
		



	echo '<option value="'.$r['color_code_name'].'">'.$r['color_code_name'].'</option>';
                  

}

	}else{



	echo "#";



	}












	exit();



}



if (isset($_POST['color_code_name_get']) && isset($_POST['color_code_name_get']) != "") {



	$id = $_POST['color_code_name_get'];



	$maker = $_POST['maker'];



	$q = mysqli_query($dbc,"SELECT * FROM color_code WHERE color_maker = $maker AND color_code_sts = '1' AND color_name='$id' ");



	// $response = array();



	while($r = mysqli_fetch_assoc($q)){



		$response[] = $r;



	}



	echo json_encode($response);	











	exit();



}







//Getting Data For Edit Purpose consignee_info_party_name2



if (isset($_POST['vehicle_brand1']) && isset($_POST['vehicle_brand1']) != "") {



	$id = $_POST['vehicle_brand1'];



	$q = mysqli_query($dbc,"SELECT * FROM models WHERE brand_id = $id");



	$response = array();



	while($r = mysqli_fetch_assoc($q)){



		$response[] = $r;



	}



	echo json_encode($response);	



	exit();



}
if (isset($_POST['vehicle_brand_m3']) && isset($_POST['vehicle_brand_m3']) != "") {



	$id = $_POST['vehicle_brand_m3'];



	$q = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM brands WHERE brand_id = $id"));


	if (!empty($q['brand_m3']) OR $q['brand_m3']!=0) {
		$response=['m3'=>$q['brand_m3'],
					'sts'=>1,
				];
	}			
	if (empty($q['brand_m3']) OR $q['brand_m3']==0){
		$response=['m3'=>0,
					'sts'=>0,
				];
	
	}

	echo json_encode($response);	



	exit();



}






if (isset($_POST['consignee_country12'])) {



	$countryArray = array(



	  'AD'=>array('name'=>'ANDORRA','code'=>'376'),



	  'AE'=>array('name'=>'UNITED ARAB EMIRATES','code'=>'971'),



	  'AF'=>array('name'=>'AFGHANISTAN','code'=>'93'),



	  'AG'=>array('name'=>'ANTIGUA AND BARBUDA','code'=>'1268'),



	  'AI'=>array('name'=>'ANGUILLA','code'=>'1264'),



	  'AL'=>array('name'=>'ALBANIA','code'=>'355'),



	  'AM'=>array('name'=>'ARMENIA','code'=>'374'),



	  'AN'=>array('name'=>'NETHERLANDS ANTILLES','code'=>'599'),



	  'AO'=>array('name'=>'ANGOLA','code'=>'244'),



	  'AQ'=>array('name'=>'ANTARCTICA','code'=>'672'),



	  'AR'=>array('name'=>'ARGENTINA','code'=>'54'),



	  'AS'=>array('name'=>'AMERICAN SAMOA','code'=>'1684'),



	  'AT'=>array('name'=>'AUSTRIA','code'=>'43'),



	  'AU'=>array('name'=>'AUSTRALIA','code'=>'61'),



	  'AW'=>array('name'=>'ARUBA','code'=>'297'),



	  'AZ'=>array('name'=>'AZERBAIJAN','code'=>'994'),



	  'BA'=>array('name'=>'BOSNIA AND HERZEGOVINA','code'=>'387'),



	  'BB'=>array('name'=>'BARBADOS','code'=>'1246'),



	  'BD'=>array('name'=>'BANGLADESH','code'=>'880'),



	  'BE'=>array('name'=>'BELGIUM','code'=>'32'),



	  'BF'=>array('name'=>'BURKINA FASO','code'=>'226'),



	  'BG'=>array('name'=>'BULGARIA','code'=>'359'),



	  'BH'=>array('name'=>'BAHRAIN','code'=>'973'),



	  'BI'=>array('name'=>'BURUNDI','code'=>'257'),



	  'BJ'=>array('name'=>'BENIN','code'=>'229'),



	  'BL'=>array('name'=>'SAINT BARTHELEMY','code'=>'590'),



	  'BM'=>array('name'=>'BERMUDA','code'=>'1441'),



	  'BN'=>array('name'=>'BRUNEI DARUSSALAM','code'=>'673'),



	  'BO'=>array('name'=>'BOLIVIA','code'=>'591'),



	  'BR'=>array('name'=>'BRAZIL','code'=>'55'),



	  'BS'=>array('name'=>'BAHAMAS','code'=>'1242'),



	  'BT'=>array('name'=>'BHUTAN','code'=>'975'),



	  'BW'=>array('name'=>'BOTSWANA','code'=>'267'),



	  'BY'=>array('name'=>'BELARUS','code'=>'375'),



	  'BZ'=>array('name'=>'BELIZE','code'=>'501'),



	  'CA'=>array('name'=>'CANADA','code'=>'1'),



	  'CC'=>array('name'=>'COCOS (KEELING) ISLANDS','code'=>'61'),



	  'CD'=>array('name'=>'CONGO, THE DEMOCRATIC REPUBLIC OF THE','code'=>'243'),



	  'CF'=>array('name'=>'CENTRAL AFRICAN REPUBLIC','code'=>'236'),



	  'CG'=>array('name'=>'CONGO','code'=>'242'),



	  'CH'=>array('name'=>'SWITZERLAND','code'=>'41'),



	  'CI'=>array('name'=>'COTE D IVOIRE','code'=>'225'),



	  'CK'=>array('name'=>'COOK ISLANDS','code'=>'682'),



	  'CL'=>array('name'=>'CHILE','code'=>'56'),



	  'CM'=>array('name'=>'CAMEROON','code'=>'237'),



	  'CN'=>array('name'=>'CHINA','code'=>'86'),



	  'CO'=>array('name'=>'COLOMBIA','code'=>'57'),



	  'CR'=>array('name'=>'COSTA RICA','code'=>'506'),



	  'CU'=>array('name'=>'CUBA','code'=>'53'),



	  'CV'=>array('name'=>'CAPE VERDE','code'=>'238'),



	  'CX'=>array('name'=>'CHRISTMAS ISLAND','code'=>'61'),



	  'CY'=>array('name'=>'CYPRUS','code'=>'357'),



	  'CZ'=>array('name'=>'CZECH REPUBLIC','code'=>'420'),



	  'DE'=>array('name'=>'GERMANY','code'=>'49'),



	  'DJ'=>array('name'=>'DJIBOUTI','code'=>'253'),



	  'DK'=>array('name'=>'DENMARK','code'=>'45'),



	  'DM'=>array('name'=>'DOMINICA','code'=>'1767'),



	  'DO'=>array('name'=>'DOMINICAN REPUBLIC','code'=>'1809'),



	  'DZ'=>array('name'=>'ALGERIA','code'=>'213'),



	  'EC'=>array('name'=>'ECUADOR','code'=>'593'),



	  'EE'=>array('name'=>'ESTONIA','code'=>'372'),



	  'EG'=>array('name'=>'EGYPT','code'=>'20'),



	  'ER'=>array('name'=>'ERITREA','code'=>'291'),



	  'ES'=>array('name'=>'SPAIN','code'=>'34'),



	  'ET'=>array('name'=>'ETHIOPIA','code'=>'251'),



	  'FI'=>array('name'=>'FINLAND','code'=>'358'),



	  'FJ'=>array('name'=>'FIJI','code'=>'679'),



	  'FK'=>array('name'=>'FALKLAND ISLANDS (MALVINAS)','code'=>'500'),



	  'FM'=>array('name'=>'MICRONESIA, FEDERATED STATES OF','code'=>'691'),



	  'FO'=>array('name'=>'FAROE ISLANDS','code'=>'298'),



	  'FR'=>array('name'=>'FRANCE','code'=>'33'),



	  'GA'=>array('name'=>'GABON','code'=>'241'),



	  'GB'=>array('name'=>'UNITED KINGDOM','code'=>'44'),



	  'GD'=>array('name'=>'GRENADA','code'=>'1473'),



	  'GE'=>array('name'=>'GEORGIA','code'=>'995'),



	  'GH'=>array('name'=>'GHANA','code'=>'233'),



	  'GI'=>array('name'=>'GIBRALTAR','code'=>'350'),



	  'GL'=>array('name'=>'GREENLAND','code'=>'299'),



	  'GM'=>array('name'=>'GAMBIA','code'=>'220'),



	  'GN'=>array('name'=>'GUINEA','code'=>'224'),



	  'GQ'=>array('name'=>'EQUATORIAL GUINEA','code'=>'240'),



	  'GR'=>array('name'=>'GREECE','code'=>'30'),



	  'GT'=>array('name'=>'GUATEMALA','code'=>'502'),



	  'GU'=>array('name'=>'GUAM','code'=>'1671'),



	  'GW'=>array('name'=>'GUINEA-BISSAU','code'=>'245'),



	  'GY'=>array('name'=>'GUYANA','code'=>'592'),



	  'HK'=>array('name'=>'HONG KONG','code'=>'852'),



	  'HN'=>array('name'=>'HONDURAS','code'=>'504'),



	  'HR'=>array('name'=>'CROATIA','code'=>'385'),



	  'HT'=>array('name'=>'HAITI','code'=>'509'),



	  'HU'=>array('name'=>'HUNGARY','code'=>'36'),



	  'ID'=>array('name'=>'INDONESIA','code'=>'62'),



	  'IE'=>array('name'=>'IRELAND','code'=>'353'),



	  'IL'=>array('name'=>'ISRAEL','code'=>'972'),



	  'IM'=>array('name'=>'ISLE OF MAN','code'=>'44'),



	  'IN'=>array('name'=>'INDIA','code'=>'91'),



	  'IQ'=>array('name'=>'IRAQ','code'=>'964'),



	  'IR'=>array('name'=>'IRAN, ISLAMIC REPUBLIC OF','code'=>'98'),



	  'IS'=>array('name'=>'ICELAND','code'=>'354'),



	  'IT'=>array('name'=>'ITALY','code'=>'39'),



	  'JM'=>array('name'=>'JAMAICA','code'=>'1876'),



	  'JO'=>array('name'=>'JORDAN','code'=>'962'),



	  'JP'=>array('name'=>'JAPAN','code'=>'81'),



	  'KE'=>array('name'=>'KENYA','code'=>'254'),



	  'KG'=>array('name'=>'KYRGYZSTAN','code'=>'996'),



	  'KH'=>array('name'=>'CAMBODIA','code'=>'855'),



	  'KI'=>array('name'=>'KIRIBATI','code'=>'686'),



	  'KM'=>array('name'=>'COMOROS','code'=>'269'),



	  'KN'=>array('name'=>'SAINT KITTS AND NEVIS','code'=>'1869'),



	  'KP'=>array('name'=>'KOREA DEMOCRATIC PEOPLES REPUBLIC OF','code'=>'850'),



	  'KR'=>array('name'=>'KOREA REPUBLIC OF','code'=>'82'),



	  'KW'=>array('name'=>'KUWAIT','code'=>'965'),



	  'KY'=>array('name'=>'CAYMAN ISLANDS','code'=>'1345'),



	  'KZ'=>array('name'=>'KAZAKSTAN','code'=>'7'),



	  'LA'=>array('name'=>'LAO PEOPLES DEMOCRATIC REPUBLIC','code'=>'856'),



	  'LB'=>array('name'=>'LEBANON','code'=>'961'),



	  'LC'=>array('name'=>'SAINT LUCIA','code'=>'1758'),



	  'LI'=>array('name'=>'LIECHTENSTEIN','code'=>'423'),



	  'LK'=>array('name'=>'SRI LANKA','code'=>'94'),



	  'LR'=>array('name'=>'LIBERIA','code'=>'231'),



	  'LS'=>array('name'=>'LESOTHO','code'=>'266'),



	  'LT'=>array('name'=>'LITHUANIA','code'=>'370'),



	  'LU'=>array('name'=>'LUXEMBOURG','code'=>'352'),



	  'LV'=>array('name'=>'LATVIA','code'=>'371'),



	  'LY'=>array('name'=>'LIBYAN ARAB JAMAHIRIYA','code'=>'218'),



	  'MA'=>array('name'=>'MOROCCO','code'=>'212'),



	  'MC'=>array('name'=>'MONACO','code'=>'377'),



	  'MD'=>array('name'=>'MOLDOVA, REPUBLIC OF','code'=>'373'),



	  'ME'=>array('name'=>'MONTENEGRO','code'=>'382'),



	  'MF'=>array('name'=>'SAINT MARTIN','code'=>'1599'),



	  'MG'=>array('name'=>'MADAGASCAR','code'=>'261'),



	  'MH'=>array('name'=>'MARSHALL ISLANDS','code'=>'692'),



	  'MK'=>array('name'=>'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF','code'=>'389'),



	  'ML'=>array('name'=>'MALI','code'=>'223'),



	  'MM'=>array('name'=>'MYANMAR','code'=>'95'),



	  'MN'=>array('name'=>'MONGOLIA','code'=>'976'),



	  'MO'=>array('name'=>'MACAU','code'=>'853'),



	  'MP'=>array('name'=>'NORTHERN MARIANA ISLANDS','code'=>'1670'),



	  'MR'=>array('name'=>'MAURITANIA','code'=>'222'),



	  'MS'=>array('name'=>'MONTSERRAT','code'=>'1664'),



	  'MT'=>array('name'=>'MALTA','code'=>'356'),



	  'MU'=>array('name'=>'MAURITIUS','code'=>'230'),



	  'MV'=>array('name'=>'MALDIVES','code'=>'960'),



	  'MW'=>array('name'=>'MALAWI','code'=>'265'),



	  'MX'=>array('name'=>'MEXICO','code'=>'52'),



	  'MY'=>array('name'=>'MALAYSIA','code'=>'60'),



	  'MZ'=>array('name'=>'MOZAMBIQUE','code'=>'258'),



	  'NA'=>array('name'=>'NAMIBIA','code'=>'264'),



	  'NC'=>array('name'=>'NEW CALEDONIA','code'=>'687'),



	  'NE'=>array('name'=>'NIGER','code'=>'227'),



	  'NG'=>array('name'=>'NIGERIA','code'=>'234'),



	  'NI'=>array('name'=>'NICARAGUA','code'=>'505'),



	  'NL'=>array('name'=>'NETHERLANDS','code'=>'31'),



	  'NO'=>array('name'=>'NORWAY','code'=>'47'),



	  'NP'=>array('name'=>'NEPAL','code'=>'977'),



	  'NR'=>array('name'=>'NAURU','code'=>'674'),



	  'NU'=>array('name'=>'NIUE','code'=>'683'),



	  'NZ'=>array('name'=>'NEW ZEALAND','code'=>'64'),



	  'OM'=>array('name'=>'OMAN','code'=>'968'),



	  'PA'=>array('name'=>'PANAMA','code'=>'507'),



	  'PE'=>array('name'=>'PERU','code'=>'51'),



	  'PF'=>array('name'=>'FRENCH POLYNESIA','code'=>'689'),



	  'PG'=>array('name'=>'PAPUA NEW GUINEA','code'=>'675'),



	  'PH'=>array('name'=>'PHILIPPINES','code'=>'63'),



	  'PK'=>array('name'=>'PAKISTAN','code'=>'92'),



	  'PL'=>array('name'=>'POLAND','code'=>'48'),



	  'PM'=>array('name'=>'SAINT PIERRE AND MIQUELON','code'=>'508'),



	  'PN'=>array('name'=>'PITCAIRN','code'=>'870'),



	  'PR'=>array('name'=>'PUERTO RICO','code'=>'1'),



	  'PT'=>array('name'=>'PORTUGAL','code'=>'351'),



	  'PW'=>array('name'=>'PALAU','code'=>'680'),



	  'PY'=>array('name'=>'PARAGUAY','code'=>'595'),



	  'QA'=>array('name'=>'QATAR','code'=>'974'),



	  'RO'=>array('name'=>'ROMANIA','code'=>'40'),



	  'RS'=>array('name'=>'SERBIA','code'=>'381'),



	  'RU'=>array('name'=>'RUSSIAN FEDERATION','code'=>'7'),



	  'RW'=>array('name'=>'RWANDA','code'=>'250'),



	  'SA'=>array('name'=>'SAUDI ARABIA','code'=>'966'),



	  'SB'=>array('name'=>'SOLOMON ISLANDS','code'=>'677'),



	  'SC'=>array('name'=>'SEYCHELLES','code'=>'248'),



	  'SD'=>array('name'=>'SUDAN','code'=>'249'),



	  'SE'=>array('name'=>'SWEDEN','code'=>'46'),



	  'SG'=>array('name'=>'SINGAPORE','code'=>'65'),



	  'SH'=>array('name'=>'SAINT HELENA','code'=>'290'),



	  'SI'=>array('name'=>'SLOVENIA','code'=>'386'),



	  'SK'=>array('name'=>'SLOVAKIA','code'=>'421'),



	  'SL'=>array('name'=>'SIERRA LEONE','code'=>'232'),



	  'SM'=>array('name'=>'SAN MARINO','code'=>'378'),



	  'SN'=>array('name'=>'SENEGAL','code'=>'221'),



	  'SO'=>array('name'=>'SOMALIA','code'=>'252'),



	  'SR'=>array('name'=>'SURINAME','code'=>'597'),



	  'ST'=>array('name'=>'SAO TOME AND PRINCIPE','code'=>'239'),



	  'SV'=>array('name'=>'EL SALVADOR','code'=>'503'),



	  'SY'=>array('name'=>'SYRIAN ARAB REPUBLIC','code'=>'963'),



	  'SZ'=>array('name'=>'SWAZILAND','code'=>'268'),



	  'TC'=>array('name'=>'TURKS AND CAICOS ISLANDS','code'=>'1649'),



	  'TD'=>array('name'=>'CHAD','code'=>'235'),



	  'TG'=>array('name'=>'TOGO','code'=>'228'),



	  'TH'=>array('name'=>'THAILAND','code'=>'66'),



	  'TJ'=>array('name'=>'TAJIKISTAN','code'=>'992'),



	  'TK'=>array('name'=>'TOKELAU','code'=>'690'),



	  'TL'=>array('name'=>'TIMOR-LESTE','code'=>'670'),



	  'TM'=>array('name'=>'TURKMENISTAN','code'=>'993'),



	  'TN'=>array('name'=>'TUNISIA','code'=>'216'),



	  'TO'=>array('name'=>'TONGA','code'=>'676'),



	  'TR'=>array('name'=>'TURKEY','code'=>'90'),



	  'TT'=>array('name'=>'TRINIDAD AND TOBAGO','code'=>'1868'),



	  'TV'=>array('name'=>'TUVALU','code'=>'688'),



	  'TW'=>array('name'=>'TAIWAN, PROVINCE OF CHINA','code'=>'886'),



	  'TZ'=>array('name'=>'TANZANIA, UNITED REPUBLIC OF','code'=>'255'),



	  'UA'=>array('name'=>'UKRAINE','code'=>'380'),



	  'UG'=>array('name'=>'UGANDA','code'=>'256'),



	  'US'=>array('name'=>'UNITED STATES','code'=>'1'),



	  'UY'=>array('name'=>'URUGUAY','code'=>'598'),



	  'UZ'=>array('name'=>'UZBEKISTAN','code'=>'998'),



	  'VA'=>array('name'=>'HOLY SEE (VATICAN CITY STATE)','code'=>'39'),



	  'VC'=>array('name'=>'SAINT VINCENT AND THE GRENADINES','code'=>'1784'),



	  'VE'=>array('name'=>'VENEZUELA','code'=>'58'),



	  'VG'=>array('name'=>'VIRGIN ISLANDS, BRITISH','code'=>'1284'),



	  'VI'=>array('name'=>'VIRGIN ISLANDS, U.S.','code'=>'1340'),



	  'VN'=>array('name'=>'VIET NAM','code'=>'84'),



	  'VU'=>array('name'=>'VANUATU','code'=>'678'),



	  'WF'=>array('name'=>'WALLIS AND FUTUNA','code'=>'681'),



	  'WS'=>array('name'=>'SAMOA','code'=>'685'),



	  'XK'=>array('name'=>'KOSOVO','code'=>'381'),



	  'YE'=>array('name'=>'YEMEN','code'=>'967'),



	  'YT'=>array('name'=>'MAYOTTE','code'=>'262'),



	  'ZA'=>array('name'=>'SOUTH AFRICA','code'=>'27'),



	  'ZM'=>array('name'=>'ZAMBIA','code'=>'260'),



	  'ZW'=>array('name'=>'ZIMBABWE','code'=>'263')



	);



	// if (in_array($countryArray, $_POST['consignee_country12'])) {



		// print_r($countryArray[$_POST['consignee_country12']]);



		echo $countryArray[$_POST['consignee_country12']]['code'];



	// }



}



	



//Getting Data For Edit Purpose consignee_info_party_name2



if (isset($_POST['auction_house_bid']) && isset($_POST['auction_house_bid']) != "") {



	$auction_house = $_POST['auction_id'];



	$id = $_POST['auction_house_bid'];



	$q = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM auction_home WHERE auction_home_id='$auction_house' "));







	echo $q[$id];



	exit();



}

if (isset($_POST['auction_house_idNOW']) && isset($_POST['auction_house_idNOW']) != "") {
	$auction_house = $_POST['auction_house_idNOW'];
	$id = $_POST['auction_house_idNOW'];
	$q = mysqli_query($dbc,"SELECT * FROM auction_home WHERE auction_home_id='$auction_house' ");
	while($r = mysqli_fetch_assoc($q)){
			$response = $r;
		}
		echo json_encode($response);
	exit();
}
if (isset($_POST['customer_infoall']) && isset($_POST['customer_infoall']) != "") {
	$id = $_POST['customer_infoall'];
	$q = mysqli_query($dbc,"SELECT * FROM customers WHERE customer_id='$id' ");
	while($r = mysqli_fetch_assoc($q)){
			$response = $r;
		}
		echo json_encode($response);
	exit();
}







if (isset($_POST['vechile_invoice_type']) && isset($_POST['vechile_invoice_type']) != "") {



	$services_id = $_POST['services_id'];



	$type = $_POST['vechile_invoice_type'];



	$vehicle_id = $_POST['vehicle_id'];



	$invoice_id = $_POST['invoice_id'];



	if ($type=="gifted") {



			$data=[



			'gifted'=>1,



			'services_id'=>$services_id,



			'vehicle_id'=>$vehicle_id,



			'invoice_id'=>$invoice_id,



		];



	}else{



			$data=[



			'gifted'=>0,



			'services_id'=>$services_id,



			'vehicle_id'=>$vehicle_id,



			'invoice_id'=>$invoice_id,



		];











}



	$check=mysqli_query($dbc,"SELECT * FROM services_invoice WHERE services_id='$services_id' AND invoice_id='$invoice_id' AND vehicle_id='$vehicle_id'");



	if (mysqli_num_rows($check)==1) {



		$checkFetch=mysqli_fetch_assoc($check);



		if (update_data($dbc,"services_invoice",$data,"services_invoice_id",$checkFetch['services_invoice_id'])) {echo $type."update"; }



		else{ echo mysqli_error($dbc); }



	}



	else{



		if (insert_data($dbc,"services_invoice",$data)) {echo $type."new"; }



		else{ echo mysqli_error($dbc); }



	}











	







	



}



/*---------------------------------------------------*/







if(!empty($_REQUEST['action']) AND $_REQUEST['action']=="services_add_inInvoice"){



	$services_id=$_REQUEST['services_id'];



	$invoice_id=$_REQUEST['invoice_id'];



	$invoiceR=fetchRecord($dbc,"invoice","invoice_id",$invoice_id);



	$invoice_vehicle=$invoiceR['invoice_vehicle'];



	 $data=[

	 	'services_id'=>$services_id,

	 	'vehicle_id'=>$invoice_vehicle,

	 	'invoice_id'=>$invoice_id,

	 	'gifted'=>2,

		 ];



	 if (insert_data($dbc,"services_invoice",$data)) {



	 }

	else{



		echo mysqli_error($dbc);



	}



}







if(!empty($_REQUEST['action']) AND $_REQUEST['action']=="services_delete"){



	$services_id=$_REQUEST['services_id'];

	$invoice_id=$_REQUEST['invoice_id'];



	if (mysqli_query($dbc,"DELETE FROM services_invoice WHERE services_invoice_id='$services_id'")) {

	# code...

	$msg =  "Deleted ....";

	$sts="warning";

	  // redirect('index.php?nav='.$_REQUEST['nav'],1500);

	}else{

	$msg= mysqli_error($dbc);

	$sts="danger";

	}



}







if(!empty($_REQUEST['action']) AND $_REQUEST['action']=="services_fetch"){



	$invoice_id=$_REQUEST['invoice_id'];



$invoiceR=fetchRecord($dbc,"invoice","invoice_id",$invoice_id);





$c=0;

$getData=getWhere($dbc,"services_invoice","invoice_id",$invoice_id);

if (mysqli_num_rows($getData)>0) {

	# code...



	while ($fetch=mysqli_fetch_assoc($getData)) {



 $vehicle=fetchRecord($dbc, "vehicle_info", "vehicle_id", $fetch['vehicle_id']);

 @$maker=fetchRecord($dbc, "maker", "maker_id", $vehicle['vehicle_maker']);

 $invoiceServices=fetchRecord($dbc,"vehicle_services","vehicle_services_id",$fetch['services_id']);



	@$Subtotal_price+=$invoiceServices["vehicle_services_amount"];  $c++;



 echo '<tr >



             <td>'.$c.'</td>



			<td>'.$maker['maker_name'].'</td>



             <td>'.$invoiceServices['vehicle_services_name'].'</td>                        



             <td>'.$invoiceServices["vehicle_services_amount"].'</td>



             <td ><a href="#" onclick="deleteServies('.$invoice_id.','.$fetch['services_invoice_id'].')"><i class="fa fa-times"></i></a></td>



        </tr>                          



                   <script> document.getElementById("set_total").innerHTML='.$Subtotal_price.';</script>                                       ';



	}

	}	

}









if (isset($_POST['ceo_msg_btn'])) {







if (upload_pic($_FILES['ceo_img'], "../img/")) {



	



	$data=[



	'ceo_name'=>$_REQUEST['ceo_name'],



	'ceo_phone'=>$_REQUEST['ceo_phone'],



	'ceo_facebook'=>$_REQUEST['ceo_facebook'],



	'ceo_viber'=>$_REQUEST['ceo_viber'],



	'ceo_insta'=>$_REQUEST['ceo_insta'],



	'ceo_linkedin'=>$_REQUEST['ceo_linkedin'],



	'ceo_twiter'=>$_REQUEST['ceo_twiter'],



	'ceo_msg'=>$_REQUEST['ceo_msg'],



	'ceo_img'=>$_SESSION['pic_name'],



];}



if ($_POST['ceo_msg_btn']=='add') {



	if (insert_data($dbc, "ceo_msg", $data)) {echo "Added Successfully";exit();}				



	else{echo mysqli_error($dbc);exit();}



	}



if ($_POST['ceo_msg_btn']=='update') {



	if (update_data($dbc, "ceo_msg", $data, "ceo_id", $_POST['ceo_id'])) { echo "Updated Successfully";exit();}	



	else{ echo mysqli_error($dbc);exit(); }







	}				



}



if (!empty($_REQUEST['auction']) AND $_REQUEST['auction']=="get_auction") {



	$type=$_REQUEST['type']; 



	if ($type=="notrunning") { $getType="AND notrunning_fee IS NOT NULL ORDER BY notrunning_fee DESC ";}



	else{ $getType="AND running_fee IS NOT NULL ORDER BY running_fee DESC"; }



	$getstat=$_REQUEST['getstat']; 







	if ($getstat=="auction") {



	$auction=$_REQUEST['auction_value'];



	$delievery=$_REQUEST['delievery'];



	



		$company=mysqli_query($dbc,"SELECT DISTINCT riksu_company_id,PORT,free_days,running_fee,notrunning_fee FROM riksu_transportation WHERE auction_house_name LIKE '%$auction%'  AND PORT='$delievery' $getType "); 



		if (mysqli_num_rows($company)>0) {



			while ($fetchCompany=mysqli_fetch_assoc($company)):



			$cp_name=fetchRecord($dbc,"ricksu_company","ricksu_company_id",$fetchCompany['riksu_company_id']);



				if ($type=="notrunning") { $fee=$fetchCompany['notrunning_fee']; }



				else{ $fee=$fetchCompany['running_fee']; }

				if ($_REQUEST['modal']=="yes") {
					$button='<button type="button" onclick="set_mini_risku('.$fetchCompany['riksu_company_id'].',`'.$fetchCompany['PORT'].'`,'.$fee.','.$fetchCompany['free_days'].')" class="btn btn-outline-info" >Apply</button>';
				}else{
					$button='<button type="button" onclick="set_risku('.$fetchCompany['riksu_company_id'].',`'.$fetchCompany['PORT'].'`,'.$fee.','.$fetchCompany['free_days'].')" class="btn btn-outline-info" data-dismiss="modal">Apply</button>';
				}



			echo '<tr><td>'.$cp_name['ricksu_company_name'].'</td>



            				<td> '.$fetchCompany['PORT'].'</td>



            				<td>'.$fee.'</td>



            				<td>'.$fetchCompany['free_days'].'</td>



            				<td>'.$button.'</td>



            				<td><button type="button" class="btn btn-info" data-toggle="modal"   onclick="get_auction(`company_info`,'.$fetchCompany['riksu_company_id'].',`'.$cp_name['ricksu_company_name'].'`)" data-target="#company" data-dismiss="modal" >Contact</button></td>



            				</tr>';



		endwhile; }



		else{



			echo '<tr ><td colspan="4">No data Found<td></tr>';



		}











	}



	if ($getstat=="port") {



	$auction=$_REQUEST['auction_value'];



		$company=mysqli_query($dbc,"SELECT DISTINCT PORT FROM riksu_transportation WHERE auction_house_name LIKE '%$auction%' $getType "); 



		if (mysqli_num_rows($company)>0) {

			$c=0;


			while ($fetchCompany=mysqli_fetch_assoc($company)):
				if ($c==0) {
					echo '<option value="">Select Port</option>';
					$c=1;
				}
					echo '<option  value="'.strtoupper($fetchCompany['PORT']).'">'.strtoupper($fetchCompany['PORT']).'</option>';
				

			



		endwhile; }



		else{



			echo '<option value="">No Data Found</option>';



		}



	}



		if ($getstat=="company_info") {



	$auction=$_REQUEST['auction_value'];



		if($fetchCompany=fetchRecord($dbc,"ricksu_company","ricksu_company_id",$auction)){



		



			echo '



			<tr><th>Company Email</th><td><a href = "mailto: '.$fetchCompany['ricksu_company_email'].'">'.$fetchCompany['ricksu_company_email'].'</a></td><th>Contact No.</th><td>'.$fetchCompany['ricksu_company_contact'].'</td></tr>



            		<tr><th>Company Fax</th><td>'.$fetchCompany['ricksu_company_fax'].'</td><th>Company Website</th><td><a href="'.$fetchCompany['ricksu_company_website'].'">'.$fetchCompany['ricksu_company_website'].'</a></td></tr>



            		<tr><th>Company Fee</th><td>'.$fetchCompany['ricksu_company_fee'].'</td><th>Company Contact Person</th><td>'.$fetchCompany['ricksu_company_contact_person'].'</td></tr>



				';



		}



		else{



			echo '<tr ><td colspan="4">No data Found<td></tr>';



		}



	}



 



   







	



}


if (isset($_REQUEST['expense_account_mnge'])) {
	
	if ($_REQUEST['expense_account_mnge']=="expense_auction") {
		$data=[

		'vehicle_id'=>@$_REQUEST['vehicle_idN'],

		'paid_auction'=>@$_REQUEST['paid_auction'],
		'date_auction'=>@$_REQUEST['date_auction'],
		'auction_bank'=>@$_REQUEST['auction_bank'],
		'auction_bank_details'=>@$_REQUEST['auction_bank_details'],
		
		];	
		$expense_trans_det=[
		'customer_id'=>@$_REQUEST['auction_bank'],
		'debit'=>$_REQUEST['paid_auction'],
		'bank_id'=>@$_REQUEST['auction_bank'],
		'vehicle_id'=>@$_REQUEST['vehicle_idN'],
		'transaction_remarks'=>@$_REQUEST['expense_remarks'],
		'transaction_from'=>'paid_acution',

		];
	}elseif ($_REQUEST['expense_account_mnge']=="expense_person") {
	
	$data=[
		'vehicle_id'=>@$_REQUEST['vehicle_idN'],

		'paid_person'=>@$_REQUEST['paid_person'],
		'date_person'=>@$_REQUEST['date_person'],
		'person_bank'=>@$_REQUEST['person_bank'],
		'person_bank_details'=>@$_REQUEST['person_bank_details'],
		];
		$expense_trans_det=[
		'customer_id'=>@$_REQUEST['person_bank'],
		'debit'=>$_REQUEST['paid_person'],
		'bank_id'=>@$_REQUEST['person_bank'],
		'vehicle_id'=>@$_REQUEST['vehicle_idN'],
		'transaction_remarks'=>@$_REQUEST['expense_remarks'],
		'transaction_from'=>'paid_person',

		];
	}elseif ($_REQUEST['expense_account_mnge']=="expense_ricksu") {
	
	$data=[
		'vehicle_id'=>@$_REQUEST['vehicle_idN'],

		'ricksu_date'=>@$_REQUEST['ricksu_date'],
		'ricksu_paid'=>@$_REQUEST['ricksu_paid'],
		'ricksu_bank'=>@$_REQUEST['ricksu_bank'],
		'ricksu_bank_details'=>@$_REQUEST['ricksu_bank_details'],
	
		];

		$expense_trans_det=[
			'customer_id'=>@$_REQUEST['ricksu_bank'],
			'debit'=>$_REQUEST['ricksu_paid'],
			'bank_id'=>@$_REQUEST['ricksu_bank'],
			'vehicle_id'=>@$_REQUEST['vehicle_idN'],
			'transaction_remarks'=>@$_REQUEST['expense_remarks'],
			'transaction_from'=>'paid_ricksu',
		];
	}elseif ($_REQUEST['expense_account_mnge']=="expense_inspection") {
			$expense_trans_det=[
				'customer_id'=>@$_REQUEST['inspection_bank'],
				'debit'=>$_REQUEST['inspection_paid'],
				'bank_id'=>@$_REQUEST['inspection_bank'],
				'vehicle_id'=>@$_REQUEST['vehicle_idN'],
				'transaction_remarks'=>@$_REQUEST['expense_remarks'],
				'transaction_from'=>'paid_inspection',

		];
	$data=[
		'vehicle_id'=>@$_REQUEST['vehicle_idN'],

		'inspection_date'=>@$_REQUEST['inspection_date'],
		'inspection_paid'=>@$_REQUEST['inspection_paid'],
		'inspection_bank'=>@$_REQUEST['inspection_bank'],
		'inspection_bank_details'=>@$_REQUEST['inspection_bank_details'],
		];
	}elseif ($_REQUEST['expense_account_mnge']=="expense_shipment") {
			$expense_trans_det=[
		'customer_id'=>@$_REQUEST['shipment_bank'],
		'debit'=>$_REQUEST['shipment_paid'],
		'bank_id'=>@$_REQUEST['shipment_bank'],
		'vehicle_id'=>@$_REQUEST['vehicle_idN'],
		'transaction_remarks'=>@$_REQUEST['expense_remarks'],
		'transaction_from'=>'paid_shipment',

		];
	$data=[
		'vehicle_id'=>@$_REQUEST['vehicle_idN'],

		'shipment_date'=>@$_REQUEST['shipment_date'],
		'shipment_paid'=>@$_REQUEST['shipment_paid'],
		'shipment_bank'=>@$_REQUEST['shipment_bank'],
		'shipment_bank_details'=>@$_REQUEST['shipment_bank_details'],
		];
	}elseif ($_REQUEST['expense_account_mnge']=="expense_airmail") {
			$expense_trans_det=[
		'customer_id'=>@$_REQUEST['airmail_bank'],
		'debit'=>$_REQUEST['airmail_paid'],
		'bank_id'=>@$_REQUEST['airmail_bank'],
		'vehicle_id'=>@$_REQUEST['vehicle_idN'],
		'transaction_remarks'=>@$_REQUEST['expense_remarks'],
		'transaction_from'=>'paid_airmail',

		];

	$data=[
		'vehicle_id'=>@$_REQUEST['vehicle_idN'],

		'airmail_date'=>@$_REQUEST['airmail_date'],
		'airmail_paid'=>@$_REQUEST['airmail_paid'],
		'airmail_bank'=>@$_REQUEST['airmail_bank'],
		'airmail_bank_details'=>@$_REQUEST['airmail_bank_details'],
		];
	}elseif ($_REQUEST['expense_account_mnge']=="expense_services") {
			$expense_trans_det=[
		'customer_id'=>@$_REQUEST['services_bank'],
		'debit'=>$_REQUEST['services_paid'],
		'bank_id'=>@$_REQUEST['services_bank'],
		'vehicle_id'=>@$_REQUEST['vehicle_idN'],
		'transaction_remarks'=>@$_REQUEST['expense_remarks'],
		'transaction_from'=>'paid_services',

		];

	$data=[
		'vehicle_id'=>@$_REQUEST['vehicle_idN'],

		'services_date'=>@$_REQUEST['services_date'],
		'services_paid'=>@$_REQUEST['services_paid'],
		'services_bank'=>@$_REQUEST['services_bank'],
		'services_bank_details'=>@$_REQUEST['services_bank_details'],
		];
	}
	



	if (countWhen($dbc,"expense_account","vehicle_id",$_REQUEST['vehicle_idN'])>0){

		if(update_data($dbc,"expense_account",$data,"vehicle_id",$_REQUEST['vehicle_idN'])) {
			insert_data($dbc, "transactions", $expense_trans_det);
			echo "Data Has been Updated";

		}else {

		echo mysqli_error($dbc);

	}

	}

	else {

	if (insert_data($dbc,"expense_account",$data)) {
		insert_data($dbc, "transactions", $expense_trans_det);

		echo "Data Has been Inserted";

	

	}else {

		echo mysqli_error($dbc);

	}
	}
}




if (isset($_REQUEST['expense_account'])) {

$data=[

		'vehicle_id'=>@$_REQUEST['vehicle_idN'],

		'date_win'=>@$_REQUEST['date_win'],

		'paid_win'=>@$_REQUEST['paid_win'],

		'date_auction'=>@$_REQUEST['date_auction'],

		'paid_auction'=>@$_REQUEST['paid_auction'],

		'date_recycle'=>@$_REQUEST['date_recycle'],

		'paid_recycle'=>@$_REQUEST['paid_recycle'],

		'date_repair'=>@$_REQUEST['date_repair'],

		'paid_repair'=>@$_REQUEST['paid_repair'],

		'date_ricksu'=>@$_REQUEST['date_ricksu'],

		'paid_ricksu'=>@$_REQUEST['paid_ricksu'],

		'date_additional'=>@$_REQUEST['date_additional'],

		'paid_additional'=>@$_REQUEST['paid_additional'],

		'date_inspection'=>@$_REQUEST['date_inspection'],

		'paid_inspection'=>@$_REQUEST['paid_inspection'],

		'date_repair_inspect'=>@$_REQUEST['date_repair_inspect'],

		'paid_repair_inspect'=>@$_REQUEST['paid_repair_inspect'],

		'date_inspection_tax'=>@$_REQUEST['date_inspection_tax'],

		'paid_inspection_tax'=>@$_REQUEST['paid_inspection_tax'],

		'date_ricksu_tax'=>@$_REQUEST['date_ricksu_tax'],

		'paid_ricksu_tax'=>@$_REQUEST['paid_ricksu_tax'],

		'date_bl'=>@$_REQUEST['date_bl'],

		'paid_bl'=>@$_REQUEST['paid_bl'],

		'date_radiation'=>@$_REQUEST['date_radiation'],

		'paid_radiation'=>@$_REQUEST['paid_radiation'],

		'date_freight'=>@$_REQUEST['date_freight'],

		'paid_freight'=>@$_REQUEST['paid_freight'],

		'date_terminal'=>@$_REQUEST['date_terminal'],

		'paid_terminal'=>@$_REQUEST['paid_terminal'],

		'date_heat'=>@$_REQUEST['date_heat'],

		'paid_heat'=>@$_REQUEST['paid_heat'],

		'date_other'=>@$_REQUEST['date_other'],

		'paid_other'=>@$_REQUEST['paid_other'],

		'date_ship'=>@$_REQUEST['date_ship'],

		'paid_ship'=>@$_REQUEST['paid_ship'],

		'date_courier'=>@$_REQUEST['date_courier'],

		'paid_courier'=>@$_REQUEST['paid_courier'],

		'auction_bank'=>@$_REQUEST['auction_bank'],

		'auction_bank_details'=>@$_REQUEST['auction_bank_details'],

		'ricksu_bank'=>@$_REQUEST['ricksu_bank'],

		'ricksu_bank_details'=>@$_REQUEST['ricksu_bank_details'],

		'inspection_bank'=>@$_REQUEST['inspection_bank'],

		'inspection_bank_details'=>@$_REQUEST['inspection_bank_details'],

		'shipment_bank'=>@$_REQUEST['shipment_bank'],

		'shipment_bank_details'=>@$_REQUEST['shipment_bank_details'],

		'airmail_bank'=>@$_REQUEST['airmail_bank'],

		'airmail_bank_details'=>@$_REQUEST['airmail_bank_details'],
		'buyingprice'=>@$_REQUEST['buyingprice'],
		'buyingprice_date'=>@$_REQUEST['buyingprice_date'],
		'commission'=>@$_REQUEST['commission'],
		'commission_date'=>@$_REQUEST['commission_date'],
		'person_recycle_fee'=>@$_REQUEST['person_recycle_fee'],
		'person_recycle_date'=>@$_REQUEST['person_recycle_date'],
		'person_bank'=>@$_REQUEST['person_bank'],
		'person_details'=>@$_REQUEST['person_details'],





	];

	$autionTotal=(int)$_REQUEST['paid_win']+(int)$_REQUEST['paid_auction']+(int)$_REQUEST['paid_recycle'];
	if (!empty($_REQUEST['auction_bank']) AND $autionTotal!=0) {
		$autionDebit=[
		'customer_id'=>@$_REQUEST['auction_bank'],
		'debit'=>$autionTotal,
		'bank_id'=>@$_REQUEST['auction_bank'],
		'vehicle_id'=>@$_REQUEST['vehicle_idN'],

	];
	insert_data($dbc, "transactions", $autionDebit);
	}
	$riskuTotal=(int)$_REQUEST['paid_repair']+(int)$_REQUEST['paid_ricksu']+(int)$_REQUEST['paid_additional'];
	if (!empty($_REQUEST['ricksu_bank']) AND $riskuTotal!=0) {
		$riskuTrans=[
		'customer_id'=>@$_REQUEST['ricksu_bank'],
		'debit'=>$riskuTotal,
		'bank_id'=>@$_REQUEST['ricksu_bank'],
		'vehicle_id'=>@$_REQUEST['vehicle_idN'],

	];
	insert_data($dbc, "transactions", $riskuTrans);
	}

	$inspectionTotal=(int)$_REQUEST['paid_inspection']+(int)$_REQUEST['paid_repair_inspect']+(int)$_REQUEST['paid_inspection_tax']+(int)$_REQUEST['paid_ricksu_tax'];
	if (!empty($_REQUEST['ricksu_bank']) AND $inspectionTotal!=0) {
		$inspectionTrans=[
		'customer_id'=>@$_REQUEST['inspection_bank'],
		'debit'=>$inspectionTotal,
		'bank_id'=>@$_REQUEST['inspection_bank'],
		'vehicle_id'=>@$_REQUEST['vehicle_idN'],

	];
	insert_data($dbc, "transactions", $inspectionTrans);
	}


	$shipmentTotal=(int)$_REQUEST['paid_bl']+(int)$_REQUEST['paid_radiation']+(int)$_REQUEST['paid_freight']+(int)$_REQUEST['paid_terminal']+(int)$_REQUEST['paid_heat']+(int)$_REQUEST['paid_other']+(int)$_REQUEST['paid_ship'];
	if (!empty($_REQUEST['ricksu_bank']) AND $shipmentTotal!=0) {
		$shipmentTrans=[
		'customer_id'=>@$_REQUEST['shipment_bank'],
		'debit'=>$shipmentTotal,
		'bank_id'=>@$_REQUEST['shipment_bank'],
		'vehicle_id'=>@$_REQUEST['vehicle_idN'],

	];
	insert_data($dbc, "transactions", $shipmentTrans);
	}
	$airmailTotal=(int)$_REQUEST['paid_courier'];
	if (!empty($_REQUEST['ricksu_bank']) AND $airmailTotal!=0) {
		$aimailtrans=[
		'customer_id'=>@$_REQUEST['airmail_bank'],
		'debit'=>$airmailTotal,
		'bank_id'=>@$_REQUEST['airmail_bank'],
		'vehicle_id'=>@$_REQUEST['vehicle_idN'],

	];
	insert_data($dbc, "transactions", $aimailtrans);
	}

	$personTotal=(int)$_REQUEST['buyingprice']+(int)$_REQUEST['commission']+(int)$_REQUEST['person_recycle_fee'];
	
	if (!empty($_REQUEST['ricksu_bank']) AND $personTotal!=0) {
		$personTrans=[
		'customer_id'=>@$_REQUEST['person_bank'],
		'debit'=>$personTotal,
		'bank_id'=>@$_REQUEST['person_bank'],
		'vehicle_id'=>@$_REQUEST['vehicle_idN'],

	];
	insert_data($dbc, "transactions", $personTrans);
	}

	if (countWhen($dbc,"expense_account","vehicle_id",$_REQUEST['vehicle_idN'])>0){

		if(update_data($dbc,"expense_account",$data,"vehicle_id",$_REQUEST['vehicle_idN'])) {

			echo "Data Has been Updated";

		}else {

		echo mysqli_error($dbc);

	}

	}

	else {

	if (insert_data($dbc,"expense_account",$data)) {

		echo "Data Has been Inserted";

	}else {

		echo mysqli_error($dbc);

	}}

}

if (!empty($_REQUEST['action']) AND $_REQUEST['action']=="getSoldDetails") {

	$getData=getWhere($dbc,"invoice","invoice_vehicle",$_REQUEST['vehicle']);

	while ($fetch=mysqli_fetch_assoc($getData)) {

		$total=(int)$fetch["invoice_grand_total"];

		$paid=(int)$fetch["invoice_paid_amount"];

		$sum=$total-$paid;



		$customers = fetchRecord($dbc, "customers", "customer_id", $fetch['invoice_customer']);

		echo ' <tr>

               <td>'.$customers["customer_name"].'</td>

               <td>'.$fetch["invoice_grand_total"].'</td>

               <td>'.$fetch["invoice_paid_amount"].'</td>

               <td>'.$sum.'</td>

             </tr>';

	}

}





if(!empty($_REQUEST['auction_person']) AND $_REQUEST['auction_person'] != '' ){





	$last_id = $_POST['vehicle_id'];

	$auction_person_id = $_REQUEST['auction_person_id'];

$person =[	

	'customer_id' => $_REQUEST['auction_person'],

	'vehicle_id' => $last_id,

	'auction_id' => $_REQUEST['auction_house2'],

	'pos_number' => $_REQUEST['posnumber2'],

	'buyingprice' => $_REQUEST['win_fee'],

	'buyingprice_tax' => $_REQUEST['win_fee_tax'],

	'commission' => $_REQUEST['commission_fee'],

	'commission_tax' => $_REQUEST['commission_fee_tax'],

	'recycle_fee' => $_REQUEST['recycle_fee'],

	'recycle_fee_tax' => $_REQUEST['recycle_fee_tax'],


	'buying_date' => $_REQUEST['customer_buy_date'],

	'currency' => $_REQUEST['customer_buy_currency'],

	'person_payment_deadline' => $_REQUEST['payment_deadline2'],

	'security_deposit' => $_REQUEST['security_deposit'],

	'note' => $_REQUEST['person_note'],
	'person_loading_point' => $_REQUEST['person_loading_point'],

	'person_sub_yard' => $_REQUEST['person_sub_yard'],

	'trade_type' => $_REQUEST['trade_type'],

	//'user_id' => $_SESSION['user_id'],

];









if ($auction_person_id == '' ) {

	if (insert_data($dbc, "auction_person", $person)) {

		echo $last_id;

		exit();

	}				



	else{

		echo mysqli_error($dbc);

		exit();

	}



}else{

		if (update_data($dbc, 'auction_person', $person, "auction_person_id", $auction_person_id)) {



// 			$d  = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM airmail_files WHERE file_title = 'auctionpersonbill ' AND vehicle_id = '$last_id' ORDER BY airmail_file_id DESC LIMIT 1"));



// 			if($d['file_title'] == 'auctionpersonbill'){

// 			 mysqli_query($dbc,"UPDATE airmail_files SET airmail_file_name = '$_SESSION[auctionperson]' WHERE vehicle_id = '$last_id' AND file_title = 'auctionpersonbill'");

// }else{



	



// 		$general=['vehicle_id'=>$last_id,

// 					'file_title'=>'auctionpersonbill',

// 					'file_type'=>'general document',

// 					'airmail_file_name'=>$_SESSION['auctionperson'],

// 				];





// 			insert_data($dbc, "airmail_files", $general);





// 		echo "Added Successfully";

// 		exit();

	



// }





			echo $last_id;

			exit();

		}else{

			echo mysqli_error($dbc);

		exit();

		}

}	



	}







if (!empty($_REQUEST['action']) AND $_REQUEST['action']=="editleads") {
$leads=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM leads WHERE leads_id = '".$_REQUEST['id']."' ")); 
   echo json_encode($leads);

}


if (!empty($_REQUEST['action']) AND $_REQUEST['action']=="getPaymentTrans") {

$transQ=mysqli_query($dbc,"SELECT transactions.*,vehicle_info.*,maker.*,brands.* from transactions INNER JOIN vehicle_info ON vehicle_info.vehicle_id=transactions.vehicle_id INNER JOIN maker ON maker.maker_id = vehicle_info.vehicle_maker INNER JOIN brands ON brands.brand_id=vehicle_info.vehicle_brand WHERE voucher_id = '".$_REQUEST['voucher_id']."' ");

$res = array();

		while($r = mysqli_fetch_assoc($transQ)){
			$res[] = $r;
		}
		

	echo json_encode($res);
	exit();
}


if(!empty($_REQUEST['action']) AND $_REQUEST['action']=="getPaymentTransBalance") {

	$balance=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT sum(advance) AS newbalance from transactions  WHERE voucher_id = '".$_REQUEST['id']."' "));
	echo $balance['newbalance'];
}



if (!empty($_REQUEST['action']) AND $_REQUEST['action']=="getreserbationinfo") {
if ($_REQUEST['type']=="customer") {
$transQ=mysqli_query($dbc,"SELECT * FROM reservation WHERE reservation_customer = '".$_REQUEST['id']."' ");
if (mysqli_num_rows($transQ)>0) {
	while($r = mysqli_fetch_assoc($transQ)){
		$users=fetchRecord($dbc,"users","user_id",$r['reservation_by'])['username'];
		$vehicle=fetchRecord($dbc, "vehicle_info", "vehicle_id", $r['vehicle_id']);
		@$maker=fetchRecord($dbc, "maker", "maker_id", $vehicle['vehicle_maker'])['maker_name'];
		@$brand=fetchRecord($dbc, "brands", "brand_id", $vehicle['vehicle_brand'])['brand_name'];
						echo "<tr>
								<td>".$maker." ".$brand."</td>
                                            <td>".$users."</td>
                                            <td>".$r['reservation_start_date']."</td>
                                            <td>".$r['reservation_expiry_date']."</td>
                                            <td>".$r['reservation_payement']."</td>
                                            <td>".$r['reservation_sold_price']."</td>
                                            <td>".$r['reservation_que']."</td>
                                            <td>".$r['reservation_date']."</td>
                                          </tr>";
											
                  

	}
}else{
	echo "
	<tr>
	<td align='center' colspan='7'>No Reservation Fuund</td>
	</tr>
	";
}
}/*end of customer*/
if ($_REQUEST['type']=="vehicle") {
$transQ=mysqli_query($dbc,"SELECT * FROM reservation WHERE vehicle_id = '".$_REQUEST['id']."' ");
if (mysqli_num_rows($transQ)>0) {
	while($r = mysqli_fetch_assoc($transQ)){
		$users=fetchRecord($dbc,"users","user_id",$r['reservation_by'])['username'];
		$vehicle=fetchRecord($dbc, "vehicle_info", "vehicle_id", $r['vehicle_id']);
		@$maker=fetchRecord($dbc, "maker", "maker_id", $vehicle['vehicle_maker'])['maker_name'];
		@$brand=fetchRecord($dbc, "brands", "brand_id", $vehicle['vehicle_brand'])['brand_name'];
						echo "<tr>
								<td>".$maker." ".$brand."</td>
                                            <td>".$users."</td>
                                            <td>".$r['reservation_start_date']."</td>
                                            <td>".$r['reservation_expiry_date']."</td>
                                            <td>".$r['reservation_payement']."</td>
                                            <td>".$r['reservation_sold_price']."</td>
                                            <td>".$r['reservation_que']."</td>
                                            <td>".$r['reservation_date']."</td>
                                          </tr>";
											
                  

	}
}else{
	echo "
	<tr>
	<td align='center' colspan='7'>No Reservation Fuund</td>
	</tr>
	";
}
}/*end of customer*/
}

function vehicleQuery($dbc,$id)
{
	$q = mysqli_query($dbc,"SELECT vehicle_info.*, maker.*, brands.*,models.* FROM vehicle_info INNER JOIN maker ON vehicle_info.vehicle_maker = maker.maker_id INNER JOIN models ON models.model_id =vehicle_info.vehicle_chassis_code INNER JOIN brands ON brands.brand_id = vehicle_info.vehicle_brand WHERE vehicle_info.vehicle_id = '$id'");
	return ($q);
}

function vehicleFetched($dbc,$id)
{
	$q = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT vehicle_info.*, maker.*, brands.*,models.* FROM vehicle_info INNER JOIN maker ON vehicle_info.vehicle_maker = maker.maker_id INNER JOIN brands ON brands.brand_id = vehicle_info.vehicle_brand INNER JOIN models ON models.model_id =vehicle_info.vehicle_chassis_code WHERE vehicle_info.vehicle_id = '$id'"));
	return ($q);
}

if (!empty($_REQUEST['action']) AND $_REQUEST['action']=="getReservationDate") {
	$holidayDates = array(
    '2016-03-26',
    '2016-03-27',
    '2016-03-28',
    '2016-03-29',
    '2016-04-05',
);

$count5WD = 0;
$temp = strtotime($_REQUEST['id']); //example as today is 2016-03-25
while($count5WD<3){
    $next1WD = strtotime('+1 weekday', $temp);
    $next1WDDate = date('Y-m-d', $next1WD);
    if(!in_array($next1WDDate, $holidayDates)){
        $count5WD++;
    }
    $temp = $next1WD;
}

$next5WD = date("Y-m-d", $temp);

echo $next5WD;
}

if (!empty($_REQUEST['action']) AND $_REQUEST['action']=="getNotifyparty" AND $_REQUEST['type']=="consignee") {
$q=get($dbc,"consignee WHERE customer_id='".$_REQUEST['id']."' AND consignee_type='consignee'");
if (mysqli_num_rows($q)>0) {
	while ($r=mysqli_fetch_assoc($q)) {
	$response[]=$r;	
		// echo '<option value="'.$r['consignee_id'].'">'.$r['consignee_name'].'</option>';
	}
	echo json_encode($response);
}


}
if (!empty($_REQUEST['action']) AND $_REQUEST['action']=="getNotifyparty" AND $_REQUEST['type']=="notify") {
$q=get($dbc,"consignee WHERE customer_id='".$_REQUEST['id']."' AND consignee_type='notify_party' ");
$response=array();
if (mysqli_num_rows($q)>0) {
	while ($r=mysqli_fetch_assoc($q)) {
	$response[]=$r;	
	}
	echo json_encode($response);
}

}


/*--------------------------------------------nav development-----------------------------------------*/

if (!empty($_REQUEST['action']) AND $_REQUEST['action']=="add_nav_menu") {

		# code...
		$data = [
			'title'=>@$_REQUEST['nav_title'],
			'page'=>@$_REQUEST['nav_page'],
			'parent_id'=>@$_REQUEST['nav_parent_id'],
			'icon'=>@$_REQUEST['nav_icon'],
			'nav_edit'=>@$_REQUEST['nav_edit'],
			'nav_delete'=>@$_REQUEST['nav_delete'],
			'nav_add'=>@$_REQUEST['nav_add'],

		];
	if ($_REQUEST['edit_menu_id']=='') {
			if (insert_data($dbc,"menus",$data)) {
			$msg = "Menu Added Successfully";
			$sts = "success";
			
			}else{
			$msg = mysqli_error($dbc);
			$sts = "danger";
			}
	}else{
			if (update_data($dbc,"menus",$data,"id",$_REQUEST['edit_menu_id'])) {
			# code...
			$msg = "Menu Updated Successfully";
			$sts = "info";
			
		}else{
			$msg = mysqli_error($dbc);
			$sts = "danger";
		}

}
$response=['msg'=>$msg,
			'sts'=>$sts,
];
echo json_encode($response);

		
	}

/*---------------------------------------------------*/
if (!empty($_REQUEST['action']) AND $_REQUEST['action']=="refund_req") {

	$data = [
			'customer_id'=>@$_REQUEST['customer_id'],
			'payment_id'=>@$_REQUEST['payment_id'],
			'bank_name'=>@$_REQUEST['bank_name'],
			'branch_name'=>@$_REQUEST['branch_name'],
			'branch_city'=>@$_REQUEST['branch_city'],
			'title_of_account'=>@$_REQUEST['title_of_account'],
			'bank_account_no'=>@$_REQUEST['bank_account_no'],
			'swift_code'=>@$_REQUEST['swift_code'],
			'priority_status'=>@$_REQUEST['priority_status'],
			'account_holder_address'=>@$_REQUEST['account_holder_address'],
			'bank_address'=>@$_REQUEST['bank_address'],
			'refund_reason'=>@$_REQUEST['refund_reason'],
			'note'=>@$_REQUEST['note'],
			'user_id'=>@$_SESSION['userId'],
			'request_status'=>@'pending',
			'requested_amount'=>@$_REQUEST['requested_amount'],
			'requested_amount_currency'=>@$_REQUEST['requested_amount_currency'],
			];
	if ($_REQUEST['request_id']=='') {
			if (insert_data($dbc,"refund_requests",$data)) {
			$msg = "Request Added Successfully";
			$sts = "success";
			
			}else{
			$msg = mysqli_error($dbc);
			$sts = "danger";
			}
	}else{
			if (update_data($dbc,"refund_requests",$data,"request_id",$_REQUEST['request_id'])) {
			# code...
			$msg = "Request Updated Successfully";
			$sts = "info";
			
		}else{
			$msg = mysqli_error($dbc);
			$sts = "danger";
		}

}
$response=['msg'=>$msg,
			'sts'=>$sts,
];
echo json_encode($response);


		
}
if (!empty($_REQUEST['action']) AND $_REQUEST['action']=="refund_req_app") {

	$data = [
			'admin_bank'=>@$_REQUEST['bank_id'],
			'receiving_amount'=>@$_REQUEST['receiving_amount'],
			'transaction_id'=>@$_REQUEST['transaction_id'],
			'receiving_amount_currency'=>@$_REQUEST['receiving_amount_currency'],
			'request_status'=>"approved",
			];

			if (update_data($dbc,"refund_requests",$data,"request_id",$_REQUEST['request_id'])) {
			# code...
				@upload_files($_FILES['document_file'],"../img/vehicle_docs/");

				$document=$_SESSION['pic_name'];

				unset($_SESSION['pic_name']);

				$data=[
					'document_title'=>@$_REQUEST['document_title'],
					'document_file'=>$document,
					'request_id'=>$_REQUEST['request_id']
				
				];
				insert_data($dbc,"refund_docs",$data);

				$payment=-1*abs((int)$_REQUEST['receiving_amount']);
			$adva=[
					'bank_id'=>$_REQUEST['bank_id'],
					'transaction_remarks'=>'payment from refund voucher',
					'debit'=>0,
					'credit'=>0,
					'advance'=>@$payment,
					'customer_id'=>$_REQUEST['customer_id'],
					'voucher_id'=>@$_REQUEST['transaction_id'],
					'transaction_from'=>'refund_voucher',

				];
				$debit=[
					'customer_id'=>$_REQUEST['customer_id'],
					'bank_id'=>$_REQUEST['bank_id'],
					'debit'=>(int)$_REQUEST['receiving_amount'],
					'credit'=>0,
					'voucher_id'=>$_REQUEST['transaction_id'],
					'transaction_from'=>'payment from refund voucher',
					'transaction_remarks'=>'refund_voucher',

				];
				insert_data($dbc, "transactions", $debit);
				insert_data($dbc, "transactions", $adva);
					$msg = "Request Updated Successfully";
					$sts = "info";
			
			
		}else{
			$msg = mysqli_error($dbc);
			$sts = "danger";
		}


$response=['msg'=>$msg,
			'sts'=>$sts,
];


echo json_encode($response);
		
	}
if (!empty($_REQUEST['action']) AND $_REQUEST['action']=="rejectfund") {
$data = [
			'request_status'=>"rejected",
			];

if (update_data($dbc,"refund_requests",$data,"request_id",base64_decode($_REQUEST['id']))) {
			# code...
			header('Location:../refund_request_list.php');

			
			
		}else{
			$msg = mysqli_error($dbc);
			$sts = "danger";
		}


}
if (!empty($_REQUEST['action']) AND $_REQUEST['action']=="getRefundDetails") {
	echo $_REQUEST['id'];
	
	$refund=mysqli_query($dbc,"SELECT refund_requests.*,customers.*,users.* FROM refund_requests INNER JOIN customers ON refund_requests.customer_id=customers.customer_id INNER JOIN users ON refund_requests.user_id=users.user_id WHERE  refund_requests.request_id='".$_REQUEST['id']."' ");	

	
		while ($r=mysqli_fetch_assoc($refund)) {
				$balance=getcustomerBlance($dbc,$r['customer_id']);
			echo "<tr>
					<th>Customer Name</th>	<td>".$r['customer_name']."</td>
					<th>User Name</th><td>".$r['username']."</td>
					</tr>
					<tr>
					<th>Bank Name</th>	<td>".$r['bank_name']."</td>
					<th>Branch Name</th>	<td>".$r['branch_name']."</td>
					</tr>
					<tr>
					<th>Bank city</th><td>".$r['branch_city']."</td>
					<th>Title of Account</th><td>".$r['title_of_account']."</td>
					</tr>
								<tr>
									<th>Bank Account Number</th><td>".$r['bank_account_no']."</td>
									<th>Swift Code</th><td>".$r['swift_code']."</td>
								</tr>
								<tr>
									<th>Bank Address</th><td>".$r['bank_address']."</td>
									<th>Account Holder Address</th><td>".$r['account_holder_address']."</td>
								</tr>
								<tr>
									<th>Reason of Refund</th><td>".$r['refund_reason']."</td>
									<th>Note</th><td>".$r['note']."</td>
								</tr>
								<tr>
									<th>Amount</th><td>".$r['requested_amount']." ".$r['requested_amount_currency']."</td>
									<th>Priority  Status</th><td>".$r['priority_status']."</td>
								</tr>
								<tr>
									<th>Balance Remaing </th><td>".$balance."</td>
									
								</tr>
				";
		}

	}

if (!empty($_REQUEST['action']) AND $_REQUEST['action']=="getBalance") {
echo getcustomerBlance($dbc,$_REQUEST['id']);
}

if (!empty($_REQUEST['action']) AND $_REQUEST['action']=="getDestiPort") {


	$id = $_REQUEST['customer_country'];



	$q = mysqli_query($dbc,"SELECT * FROM country_regulation WHERE country_regulation_country = '$id'");



	$response = array();



	while($r = mysqli_fetch_assoc($q)){



		$response[] = $r;



	}



	echo json_encode($response);	



	exit();



}
if (!empty($_REQUEST['action']) AND $_REQUEST['action']=="checkDateValidty") {

	$q = mysqli_query($dbc,"SELECT * FROM auction_info WHERE vehicle_id = '".$_REQUEST['vehicle_id']."' ");
	@$person= mysqli_query($dbc,"SELECT * FROM auction_person WHERE vehicle_id = '".$_REQUEST['vehicle_id']."' ");
		if (mysqli_num_rows($q)>0) {
			$r = mysqli_fetch_assoc($q);
			if (!empty($r['auction_date'])) {
				$action_date=getDateFormat("Y-m-d",$r['auction_date']);
				$value=getDateFormat("Y-m-d",$_REQUEST['value']);
				if ($action_date>$value) {
					$response=['msg'=>"Date should not lower than Buying date",'sts'=>'danger',];
				}else{
					$response=['msg'=>"",'sts'=>'success',];
			
				}
				
			}else{
				$response=['msg'=>'Buying Date is Not Added','sts'=>'danger',];
			}
		}elseif(mysqli_num_rows($person)>0){
			$r = mysqli_fetch_assoc($person);
			if (!empty($r['buying_date'])) {
				
				$action_date=getDateFormat("Y-m-d",$r['buying_date']);
				$value=getDateFormat("Y-m-d",$_REQUEST['value']);
				if ($action_date>$value) {
					$response=['msg'=>"Date should not lower than Buying date",'sts'=>'danger',];
				}else{
					$response=['msg'=>"",'sts'=>'success',];
			
				}
				
			}else{
				$response=['msg'=>'Buying Date is Not Added','sts'=>'danger',];
			}

		}
		else{
				$response=['msg'=>'Buying Date is Not Added','sts'=>'danger',];
			}

	echo json_encode($response);


}
if (!empty($_REQUEST['action']) AND $_REQUEST['action']=="getQue") {
$countQue=(int)(countWhen($dbc,'reservation','vehicle_id',$_REQUEST['id']))+1;
//echo json_encode($countQue);
 $vehicle_est_price = fetchRecord($dbc,"vehicle_info","vehicle_id",$_REQUEST['id'])['vehicle_est_price'];
		$response=array($countQue,$vehicle_est_price);
		echo json_encode($response);
}

if (!empty($_REQUEST['action']) AND $_REQUEST['action']=="checkResLastdate") {
	$q = mysqli_query($dbc,"SELECT * FROM reservation WHERE vehicle_id = '".$_REQUEST['vehicle_id']."' ORDER BY reservation_id  DESC LIMIT 1 ");
		if (mysqli_num_rows($q)>0) {
			$r = mysqli_fetch_assoc($q);
			echo json_encode($r['reservation_expiry_date']);

		}
}

if (!empty($_REQUEST['action']) AND $_REQUEST['action']=="editMiniRicksu") {
	$q = mysqli_query($dbc,"SELECT * FROM ricksu WHERE ricksu_id = '".$_REQUEST['id']."' ");
		if (mysqli_num_rows($q)>0) {
			$r = mysqli_fetch_assoc($q);
			echo json_encode($r);

		}

}
if (isset($_POST['mini_ricksu_company'])) {



		$data = [



			'ricksu_company' => @$_POST['mini_ricksu_company'],



			'ricksu_type' => @$_POST['mini_ricksu_type'],



			'mini_ricksu_pickup' => strtoupper($_POST['mini_ricksu_pickup']),



			'ricksu_delievery_point' => strtoupper($_POST['ricksu_delievery_point']),
			'ricksu_dp_sub_yards' => $_POST['ricksu_dp_sub_yards'],



			'ricksu_deliever_by' => @$_POST['ricksu_deliever_by'],
			'ricksu_fee' => @$_POST['mini_ricksu_fee'],



			'ricksu_fee_tax' => @$_POST['mini_ricksu_fee_tax'],
			'vehicle_id' => @$_POST['vehicle_id'],



			'ricksu_note' => @$_POST['ricksu_note'],
			'ricksu_pickup_date' => @$_POST['ricksu_pickup_date'],
			'ricksu_delivery_date' => @$_POST['ricksu_delivery_date'],
			'mini_ricksu' => 1,



		];



		if ($_POST['mini_ricksu_id'] == "") {



			if (insert_data($dbc, "ricksu", $data)) {



				echo $msg = "Ricksu  Added Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}else{



			if (update_data($dbc, "ricksu", $data, "ricksu_id", $_POST['mini_ricksu_id'])) {



				echo $msg = "Ricksu  Data Updated Successfully";



				exit();



			}else{



				echo $msg = mysqli_error($dbc);



				exit();



			}



		}



	}
if (!empty($_POST['action']) AND $_POST['action']=="inspection_info_for_check"){
		$country=getCountryName($_POST['id']);
		$q=mysqli_query($dbc,"SELECT *  FROM inspection_transportation WHERE inspection_trans_for='".$country."' ");
		if (mysqli_num_rows($q)==1) {
		 	$r=mysqli_fetch_assoc($q);
		 	$response=[$r['inspection_trans_company'],$r['inspection_trans_fee'],$r['inspection_trans_fee_tax'],1];
		 }elseif(mysqli_num_rows($q)>1){
		 	$r=mysqli_fetch_assoc($q);
		 	$response=[0,0,0,2];
		 }else{
		 	$response=[0,0,0,0];
		 } 

		 echo json_encode($response);
}
if (!empty($_POST['action']) AND $_POST['action']=="inspection_info_for_get"){

		if ($_POST['type']=="res") {
			$country=getCountryName($_POST['id']);
		}else{
			$country=$_POST['id'];
		}

		$q=mysqli_query($dbc,"SELECT *  FROM inspection_transportation WHERE inspection_trans_for='".$country."' "); 



		if (mysqli_num_rows($q)>0) {



			while ($r=mysqli_fetch_assoc($q)):



			$company=fetchRecord($dbc,"inspection_company","inspection_company_id",$r['inspection_trans_company']);
			echo '<tr><td>'.$company['inspection_company_name'].'</td>
            			<td>'.$r['inspection_trans_fee'].' - '.$r['inspection_trans_fee_tax'].'</td>
            				<td><button type="button" onclick="set_inspection(`'.$r['inspection_trans_company'].'`,'.$r['inspection_trans_fee'].','.$r['inspection_trans_fee_tax'].',`'.$_POST['type'].'`)" class="btn btn-outline-info" data-dismiss="modal">Apply</button></td>
            		</tr>';



		endwhile; }



		else{



			echo '<tr ><td colspan="3">No data Found </td></tr>';



		}

}


if (!empty($_POST['action']) AND $_POST['action']=="airmail_country_for"){
		$q=mysqli_query($dbc,"SELECT *  FROM airmail_transportation WHERE airmail_trans_country='".$_POST['country']."' AND (airmail_trans_type='".$_POST['type']."' OR airmail_trans_weight='".$_POST['weight']."') "); 



		if (mysqli_num_rows($q)>0) {



			while ($r=mysqli_fetch_assoc($q)):



			$company=fetchRecord($dbc,"services_company","services_company_id",$r['airmail_trans_company']);






			echo '<tr><td>'.$company['services_company_name'].'</td>



            				<td>'.$r['airmail_trans_type'].'</td>
            				<td>'.$r['airmail_trans_weight'].'</td>
            				<td>'.$r['airmail_trans_fee'].'/'.$r['airmail_trans_fee_tax'].'</td>





            				<td><button type="button" onclick="set_aimail(`'.$r['airmail_trans_company'].'`,`'.$r['airmail_trans_type'].'`,`'.$r['airmail_trans_weight'].'`,`'.$r['airmail_trans_fee'].'`,`'.$r['airmail_trans_fee_tax'].'`)" class="btn btn-outline-info" data-dismiss="modal">Apply</button></td>



            			


            				</tr>';



		endwhile; }



		else{



			echo '<tr ><td colspan="4">No data Found<td></tr>';



		}

}

if (!empty($_REQUEST['action']) AND $_REQUEST['action']=="checkcurrentLoc") {
	$q = mysqli_query($dbc,"SELECT * FROM ricksu WHERE vehicle_id = '".$_REQUEST['vehicle_id']."' ORDER BY ricksu_id  DESC LIMIT 1 ");
		if (mysqli_num_rows($q)>0) {
			$r = mysqli_fetch_assoc($q);
			if ($r['mini_ricksu']==1) {
				$d_date=$r['ricksu_delivery_date'];
			}else{
				$d_date=$r['ricksu_arrival_date'];
			}
			

			$response=[strtoupper($r['ricksu_delievery_point']),$d_date];
			echo json_encode($response);

		}
}
if (!empty($_REQUEST['action']) AND $_REQUEST['action']=="consigneeDetails") {
	$consignee =mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM consignee WHERE consignee_id = '".$_REQUEST['id']."' "));
			echo json_encode($consignee);

	
}
if (isset($_REQUEST['expense_mini_ricksu'])) {
	
	
	$data=[
		'vehicle_id'=>@$_REQUEST['vehicle_idN'],
		'mini_ricksu_id'=>@$_REQUEST['expense_mini_ricksu'],
		'mini_ricksu_paid'=>@$_REQUEST['mini_ricksu_paid'],
		'mini_ricksu_date'=>@$_REQUEST['mini_ricksu_date'],
		'mini_ricksu_bank'=>@$_REQUEST['mini_ricksu_bank'],
		'mini_ricksu_bank_details'=>@$_REQUEST['mini_ricksu_bank_details'],

	
		];

		$expense_trans_det=[
			'customer_id'=>@$_REQUEST['mini_ricksu_bank'],
			'debit'=>$_REQUEST['mini_ricksu_paid'],
			'bank_id'=>@$_REQUEST['mini_ricksu_bank'],
			'vehicle_id'=>@$_REQUEST['vehicle_idN'],
			'transaction_remarks'=>@$_REQUEST['mini_ricksu_remarks'],
			'transaction_from'=>'paid_mini_ricksu_'.@$_REQUEST['expense_mini_ricksu'],
		];
	



	if (countWhen($dbc,"expense_mini_ricksu","mini_ricksu_id",$_REQUEST['expense_mini_ricksu'])>0){

		if(update_data($dbc,"expense_mini_ricksu",$data,"vehicle_id",$_REQUEST['vehicle_idN'])) {
			insert_data($dbc, "transactions", $expense_trans_det);
			echo "Data Has been Updated";

		}else {

		echo mysqli_error($dbc);

	}

	}

	else {

	if (insert_data($dbc,"expense_mini_ricksu",$data)) {
		insert_data($dbc, "transactions", $expense_trans_det);

		echo "Data Has been Inserted";

	

	}else {

		echo mysqli_error($dbc);

	}
	}
}

if (!empty($_REQUEST['action']) AND $_REQUEST['action']=="export_docs_links") {
$id=$_REQUEST['id'];

@$d  = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM airmail_files WHERE file_title='ownership_certificate' AND vehicle_id = '$id'"));

	if(@$d['file_title'] == 'ownership_certificate'){

		$ownership='<a href="img/vehicle_docs/'.$d['airmail_file_name'].'" target="_blank" class="btn btn-success btn-sm">View</a>';
		}else{ $ownership='not added';
		}
	
@$d  = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM airmail_files WHERE file_title='export_certificate' AND vehicle_id = '$id'"));

	if(@$d['file_title'] == 'export_certificate'){

		$export_certificate='<a href="img/vehicle_docs/'.$d['airmail_file_name'].'" target="_blank" class="btn btn-success">View</a>';
		}else{ $export_certificate='not added';
		}

@$d  = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM airmail_files WHERE file_title='translations' AND vehicle_id = '$id'"));

	if(@$d['file_title'] == 'translations'){

		$translations='<a href="img/vehicle_docs/'.$d['airmail_file_name'].'" target="_blank" class="btn btn-success">View</a>';
		}else{ $translations='not added';
		}
	
@$d  = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM airmail_files WHERE file_title='bill_of_lading' AND vehicle_id = '$id'"));

	if(@$d['file_title'] == 'bill_of_lading'){

		$bill_of_lading='<a href="img/vehicle_docs/'.$d['airmail_file_name'].'" target="_blank" class="btn btn-success">View</a>';
		}else{ $bill_of_lading='not added';
		}
	
@$d  = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM airmail_files WHERE file_title='inspection_certificate' AND vehicle_id = '$id'"));

	if(@$d['file_title'] == 'inspection_certificate'){

		$inspection_certificate='<a href="img/vehicle_docs/'.$d['airmail_file_name'].'" target="_blank" class="btn btn-success">View</a>';
		}else{ $inspection_certificate='not added';
		}
	
@$d  = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM airmail_files WHERE file_title='shipping_order' AND vehicle_id = '$id'"));

	if(@$d['file_title'] == 'shipping_order'){

		$shipping_order='<a href="img/vehicle_docs/'.$d['airmail_file_name'].'" target="_blank" class="btn btn-success">View</a>';
		}else{ $shipping_order='not added';
		}
	

	$response=array($ownership,$export_certificate,$translations,$bill_of_lading,$inspection_certificate,$shipping_order);
	echo json_encode($response);

}

if (isset($_REQUEST['add_document_title_d'])) {
	
	upload_files($_FILES['refund_docs_file'],"../img/vehicle_docs/");

	 $document=$_SESSION['pic_name'];

	unset($_SESSION['pic_name']);
	
      
     
   

		$data=[
			'document_title'=>@$_REQUEST['add_document_title_d'],
			'document_file'=>$document,
			'request_id'=>$_REQUEST['request_id']
		
		];
	

	
	if(insert_data($dbc,"refund_docs",$data)) {
		
		
		$response=['msg'=>"Document Added Successfully",
							'sts'=>'success',
						];
	}else {


				$response=['msg'=>mysqli_error($dbc),
							'sts'=>'error',
			];

	}
	echo json_encode($response);
	exit();

}

/*---------------------------------------------------*/
if (isset($_REQUEST['add_customer_id'])) {

	$data = [
			'customer_id'=>@$_REQUEST['add_customer_id'],
			'bank_name'=>@$_REQUEST['bank_name'],
			'bank_phone'=>@$_REQUEST['bank_phone'],
			'bank_fax_no'=>@$_REQUEST['bank_fax_no'],
			'branch_name'=>@$_REQUEST['branch_name'],
			'bank_account_name'=>@$_REQUEST['bank_account_name'],
			'bank_account_no'=>@$_REQUEST['bank_account_no'],
			'swift_code'=>@$_REQUEST['swift_code'],
			'bank_memo'=>@$_REQUEST['bank_memo'],
			'branch_address'=>@$_REQUEST['branch_address'],
			'bank_currency'=>@$_REQUEST['bank_currency'],
			'bank_status'=>@$_REQUEST['bank_status'],
			];
	if ($_REQUEST['customer_bank_id']=='') {
			if (insert_data($dbc,"customer_banks",$data)) {
			$msg = "Bank Added Successfully";
			$sts = "success";
			
			}else{
			$msg = mysqli_error($dbc);
			$sts = "error";
			}
	}else{
			if (update_data($dbc,"customer_banks",$data,"customer_bank_id",$_REQUEST['customer_bank_id'])) {
			# code...
			$msg = "Bank Updated Successfully";
			$sts = "success";
			
		}else{
			$msg = mysqli_error($dbc);
			$sts = "danger";
		}

}
$response=['msg'=>$msg,
			'sts'=>$sts,
];
echo json_encode($response);


		
}

if (isset($_REQUEST['show_customer_info'])) {
	$r=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM customers WHERE customer_id='".$_REQUEST['show_customer_info']."' "));

				echo json_encode($r);

}

if (isset($_REQUEST['get_auction_loading_yard'])) {
	// $r=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM auction_info WHERE vehicle_id='".$_REQUEST['get_auction_loading_yard']."' "));
	$id=$_REQUEST['get_auction_loading_yard'];
	@$auction_person =mysqli_fetch_assoc(mysqli_query($dbc,"SELECT auction_person.*,sub_yards.* FROM auction_person INNER JOIN sub_yards ON sub_yards.sub_yard_id=auction_person.person_sub_yard WHERE vehicle_id = '$id' AND trade_type='person'"));
    @$auction_company =mysqli_fetch_assoc(mysqli_query($dbc,"SELECT auction_person.*,sub_yards.* FROM auction_person INNER JOIN sub_yards ON sub_yards.sub_yard_id=auction_person.person_sub_yard WHERE vehicle_id = '$id' AND trade_type='company'"));
    @$auction_only =mysqli_fetch_assoc(mysqli_query($dbc,"SELECT auction_info.*,sub_yards.* FROM auction_info INNER JOIN sub_yards ON sub_yards.sub_yard_id=auction_info.auction_sub_yard WHERE vehicle_id = '$id'"));
          
          	
          if(@$auction_person['vehicle_id'] == $id){

          	 $loading_point = $auction_person['person_loading_point'];
          	  $sub_yard = $auction_person['person_sub_yard'];
          	  $sub_yard_name = $auction_person['sub_yard_name'];
          	 

          }elseif(@$auction_only['vehicle_id'] == $id){

          	 $loading_point = $auction_only['auction_loading_point'];
          	  $sub_yard = $auction_only['auction_sub_yard'];
          	  $sub_yard_name = $auction_only['sub_yard_name'];
          	 


          }elseif(@$auction_company['vehicle_id'] == $id){

          	 $loading_point = $auction_company['person_loading_point'];
          	  $sub_yard = $auction_company['person_sub_yard'];
          	   $sub_yard_name = $auction_company['sub_yard_name'];



          }else{
          	 $loading_point =$sub_yard=$sub_yard_name="";

          	 
          
          }
          $response=[$loading_point,$sub_yard,$sub_yard_name];
 

				echo json_encode($response);

}
if (isset($_REQUEST['get_subyards'])) {
	$response=[];
	$q=mysqli_query($dbc,"SELECT * FROM sub_yards WHERE auction_home_id LIKE '%".$_REQUEST['get_subyards']."%' ");
	if (mysqli_num_rows($q)>0) {
		while($r=mysqli_fetch_assoc($q)):
			$response[]=$r;
		endwhile;
	}

echo json_encode($response);

}
if (isset($_REQUEST['action']) AND $_REQUEST['action']=="refresh_select") {
	$response=[];
	if ($_REQUEST['select_id']=="reservation_customer" OR $_REQUEST['select_id']=="auction_person" OR $_REQUEST['select_id']=="customer_id_trade" OR $_REQUEST['select_id']=="customer_id") {
		$query="SELECT * FROM customers WHERE customer_role= 'customer' AND customer_active = 1";
	}elseif ($_REQUEST['select_id']=="ricksu_loading_point") {
		$query="SELECT DISTINCT auction_house_name FROM riksu_transportation";
	}elseif ($_REQUEST['select_id']=="airmail_services_company") {
		$query="SELECT * FROM services_company WHERE services_company_sts = '1'";
	}elseif ($_REQUEST['select_id']=="consignee_id_trade") {
		$query="SELECT * FROM consignee WHERE consignee_type='consignee' AND consignee_sts=1 ";
	}elseif ($_REQUEST['select_id']=="customer_notify") {
		$query="SELECT * FROM consignee WHERE consignee_type='notify_party' AND consignee_sts=1 ";
	}elseif ($_REQUEST['select_id']=="auction_house" OR $_REQUEST['select_id']=="auction_house2") {
		$query="SELECT * FROM auction_home  WHERE auction_home_sts=1";
	}elseif ($_REQUEST['select_id']=="shipper") {
		$query="SELECT * FROM shipper WHERE shipper_sts = '1' ";
	}elseif ($_REQUEST['select_id']=="shipment_company") {
		$query="SELECT * FROM shipment_company WHERE shipment_company_sts = 1 ";
	}elseif ($_REQUEST['select_id']=="mini_ricksu_company") {
		$query="SELECT * FROM ricksu_company WHERE ricksu_company_sts=1 ";
	}elseif ($_REQUEST['select_id']=="ricksu_delievery_point" OR $_REQUEST['select_id']=="mini_ricksu_delievery_point") {
		$query="SELECT DISTINCT PORT FROM riksu_transportation";
	}elseif ($_REQUEST['select_id']=="inspection_trans_company" OR $_REQUEST['select_id']=="reservation_inspection") {
		$query="SELECT * FROM inspection_company WHERE inspection_company_sts = '1'";
	}


	$q=mysqli_query($dbc,$query);
	if (mysqli_num_rows($q)>0) {
		while($r=mysqli_fetch_assoc($q)):
			$response[]=$r;
		endwhile;
	}

echo json_encode($response);

}
?>

<?php 	if (isset($_POST['add_sub_yard_name'])) {
		$data = [
			'sub_yard_name' =>strtoupper($_POST['add_sub_yard_name']),
			'sub_yard_postal' =>@$_POST['sub_yard_postal'],
			'sub_yard_contact' =>@$_POST['sub_yard_contact'],
			'auction_home_id' =>strtoupper($_POST['auction_home_id']),
			'sub_yard_fax' =>@$_POST['sub_yard_fax'],
			'sub_yard_address_jap' =>@$_POST['sub_yard_address_jap'],
			'sub_yard_address_eng' =>@$_POST['sub_yard_address_eng'],
		];
		if ($_POST['sub_yard_id'] == "") {
			if (insert_data($dbc, "sub_yards", $data)) {
				 $msg = "Yard Added Successfully";
				 $sts="success";
						}else{



				 $msg = mysqli_error($dbc);
				 $sts="error";
						}

		}else{
			if (update_data($dbc, "sub_yards", $data, "sub_yard_id ", $_POST['sub_yard_id'])) {

				 $msg = "Yard Updated Successfully";
				 $sts="success";
						}else{
				 $msg = mysqli_error($dbc);
				 $sts="error";
						}
		}
		$response=['msg'=>$msg,
			'sts'=>$sts,
			];
echo json_encode($response);
	}
 
if (isset($_REQUEST['getReservationQue'])) {
	$countQue=@(int)(countWhen($dbc,'reservation','vehicle_id',$_REQUEST['getReservationQue']))+1;
	echo json_encode($countQue);
}

if (isset($_REQUEST['getCurrent_user_details'])) {
	$user = $_SESSION['userId'];
	$col = $_REQUEST['getCurrent_user_details'];
	$fetch_globeluser = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM users WHERE user_id = '$user'"));
	echo $fetch_globeluser[$col];
}

if (isset($_REQUEST['getInspectionDetails'])) {
	@$result=fetchRecord($dbc,'reservation','vehicle_id',$_REQUEST['getInspectionDetails']);
	$q = mysqli_query($dbc,"SELECT * FROM ricksu WHERE vehicle_id = '".$_REQUEST['getInspectionDetails']."' ORDER BY ricksu_id  DESC LIMIT 1 ");
		if (mysqli_num_rows($q)>0) {
			$r = mysqli_fetch_assoc($q);
			if ($r['mini_ricksu']==1) {
				$d_date=$r['ricksu_delivery_date'];
			}else{
				$d_date=$r['ricksu_arrival_date'];
			}
			

			$response=[strtoupper($r['ricksu_delievery_point']),$d_date,@$result['reservation_inspection'],@$result['reservation_inspection_fee'],@$result['reservation_inspection_fee_tax']];
			echo json_encode($response);

		}
	
}
if (isset($_REQUEST['setShipmentsDets'])) {
	  
	   $runD = mysqli_query($dbc,"SELECT  reservation.*,invoice.* FROM reservation INNER JOIN invoice ON invoice.invoice_customer = reservation.reservation_customer WHERE reservation.vehicle_id='".$_REQUEST['setShipmentsDets']."' AND invoice.invoice_customer = reservation.reservation_customer ");
    if (mysqli_num_rows($runD)>0) {
        $r=mysqli_fetch_assoc($runD);
       $port=fetchRecord($dbc,'country_regulation','country_regulation_id',$r['reservation_port']);

        $response=[strtolower($r['reservation_shipment_type']),$r['reservation_final_destin'],$r['reservation_country'],$r['reservation_port'],$port['country_regulation_destination_port']];
		echo json_encode($response);
      
    }
	

}

if (isset($_POST['new_currency_name'])) {
	
		if ($_POST['currency_id'] == "") {
		$data = [
			'currency_name' => strtoupper($_POST['new_currency_name']),
			'currency_rate' =>(double)$_POST['currency_rate'],
			'country_id' => $_POST['country_id'],
			'currency_status' => $_POST['currency_status'],
			'added_by' => $_SESSION['userId'],
		];
			if (insert_data($dbc, "currency", $data)) {
				
				$response=['msg'=>"Currency Added Successfully",
						'sts'=>'success',
				];
			}else{
				$response=['msg'=>mysqli_error($dbc),
						'sts'=>'error',
				];
			}
		}else{
			$data = [
			'currency_name' => strtoupper($_POST['new_currency_name']),
			'currency_rate' => (double)$_POST['currency_rate'],
			'country_id' => $_POST['country_id'],
			'currency_status' => $_POST['currency_status'],
			'edited_by' => $_SESSION['userId'],
		];
			if (update_data($dbc, "currency", $data, "currency_id", $_POST['currency_id'])) {
				$response=['msg'=>"Currency Updated Successfully",
						'sts'=>'success',
				];
			}else{
					$response=['msg'=>mysqli_error($dbc),
						'sts'=>'error',
				];
			}
		}
		echo json_encode($response);
	}

	
 ?>

