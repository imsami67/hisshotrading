<?php  /*--------------------------------------------nav development-----------------------------------------*/

	require_once '../php_action/db_connect.php';
	require_once '../includes/functions.php';

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
/*--------------------------------------update profile-------------------------------------------------------*/
if (!empty($_REQUEST['action']) AND $_REQUEST['action']=="update_profile") {
		$data_array = [
			'fullname'=>$_REQUEST['user_fullname'],
			'address'=>$_REQUEST['user_address'],
			'phone'=>$_REQUEST['user_phone'],
		];
		if (update_data($dbc,"users",$data_array,"user_id",$_REQUEST['user_id'])) {
			# code...
			$response=[
				"msg"=>"Profile Updated successfully",
				"sts"=>"success"
			];

		}else{
			$response=[
				"msg"=>mysqli_error($dbc),
				"sts"=>"danger"
			];
		}
		echo json_encode($response);
	}
/*--------------------------------------update password-------------------------------------------------------*/
if (!empty($_POST['action']) AND $_POST['action']=="reset_password") {
	$currentPassword = md5($_POST['current_password']);
	$newPassword = md5($_POST['new_password']);
	$conformPassword = md5($_POST['confirm_password']);
	$userId = $_POST['user_id'];
	$result =mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM users WHERE user_id ='$userId'"));

	if($currentPassword == $result['password']) {

		if($newPassword == $conformPassword) {

			$updateSql = mysqli_query($dbc,"UPDATE users SET password = '$newPassword' WHERE user_id ='$userId' ");
			if($updateSql) {
	
				$response=[
				"msg"=>"Password Updated successfully",
				"sts"=>"success"
					];		
			} else {
				$response=[
				"msg"=>"Error while updating the password",
				"sts"=>"error",
					];
			}

		} else {
			$response=[
				"msg"=>"New password does not match with Conform password",
				"sts"=>"error"
				];
		}

	} else {
		$response=[
				"msg"=>"Current password is incorrect",
				"sts"=>"error"
				];
	}

	

	echo json_encode($response);

}
/*--------------------------------------Brand and Category-------------------------------------------------------*/
if (isset($_REQUEST['add_brand_name'])) {
		$data_array = [
			'brand_name'=>$_REQUEST['add_brand_name'],
			'brand_status'=>$_REQUEST['brand_status'],
		];
	if ($_REQUEST['brand_id']=='') {
		if (insert_data($dbc,"brands",$data_array)) {
			# code...
			$response=[
				"msg"=>"Brand Added successfully",
				"sts"=>"success"
			];

		}else{
			$response=[
				"msg"=>mysqli_error($dbc),
				"sts"=>"danger"
			];
		}
	}else{
		if (update_data($dbc,"brands",$data_array,"brand_id",$_REQUEST['brand_id'])) {
			# code...
			$response=[
				"msg"=>"Brand Updated successfully",
				"sts"=>"success"
			];

		}else{
			$response=[
				"msg"=>mysqli_error($dbc),
				"sts"=>"danger"
			];
		}
	}
		echo json_encode($response);

	}
if (isset($_REQUEST['add_category_name'])) {
		$data_array = [
			'categories_name'=>$_REQUEST['add_category_name'],
			'categories_status'=>$_REQUEST['categories_status'],
		];
	if ($_REQUEST['categories_id']=='') {
		if (insert_data($dbc,"categories",$data_array)) {
			# code...
			$response=[
				"msg"=>"Category Added successfully",
				"sts"=>"success"
			];

		}else{
			$response=[
				"msg"=>mysqli_error($dbc),
				"sts"=>"danger"
			];
		}
	}else{
		if (update_data($dbc,"categories",$data_array,"categories_id",$_REQUEST['categories_id'])) {

$response=[
				"msg"=>"Category Updated successfully",
				"sts"=>"success"
			];
		}else{
			$response=[
				"msg"=>mysqli_error($dbc),
				"sts"=>"danger"
			];
		}
	}
		echo json_encode($response);

	}

if (isset($_POST['sortable_img']) && isset($_POST['sortable_img']) != "") {
$post_order = isset($_POST["post_order_ids"]) ? $_POST["post_order_ids"] : [];
if(count($post_order)>0){
	for($order_no= 0; $order_no < count($post_order); $order_no++)
	{
	 $query = "UPDATE menus SET sort_order = '".($order_no+1)."'   WHERE id = '".$post_order[$order_no]."' ";
	 mysqli_query($dbc, $query);
	}
	echo true; 
}else{
	echo false; 
}}
if (!empty($_REQUEST['action']) AND $_REQUEST['action']=="category_ranking") {
		$query = get($dbc, "menus WHERE id='".$_REQUEST['value']."' ORDER BY sort_order ASC  ");
			$rowCount = mysqli_num_rows($query);
			if($rowCount > 0){ $c=1;
				while($row = mysqli_fetch_assoc($query)){
					$value=$row['category_id'];
					$users="";
					$users="user";
					//$user = fetchRecord($dbc,"users","user_id",$row['user_id']);
					//$fetchuser = fetchRecord($dbc,"users","user_id",$row['user_id']);
					//$image=($fetchuser['user_pic']==null)?"default.png":$fetchuser['user_pic'];
					echo '
				<li data-post-id="'.$row["id"].'" class="row" id="userRank'.$row["id"].'_'.$value.'">
			
		        	<div class="col-md-5 mt-3 ml-4">
		        		<strong>Name:</strong><p class="text-primary d-inline mt-3"> '.$fetchuser["user_first_name"].'  '.$fetchuser['user_last_name'].'</p> <br>
		        	</div>
		        	<div class="col-md-2">
		        		<h2 class="mt-4"><?=$c?></h2>
		        		<input id="rankable'.$row["user_id"].'_'.$value.'" value="'.$value.'" checked type="checkbox" onclick="rankable('.$row['user_id'].','.$value.',1)"  class="checkbox-input">
                  
		        	 </div>
		       </li>';
		$c++; }} else{
			echo "<li>No Data Found </li>";
		}
	
		
	}

	?>