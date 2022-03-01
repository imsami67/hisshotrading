
<?php 
include_once 'functions.php';
@include_once '../php_action/db_connect.php'; 




?>
		
		 <?php
		 	if (isset($_REQUEST['company_submit'])) {
		 			if ($_FILES['logo']['tmp_name']) {
		 			# code...
		 			upload_pic($_FILES['logo'],'img/uploads/');
		 			$data=[
		 			'logo'=>$_SESSION['pic_name'],
		 			'name'=>$_POST['name'],
		 			'address'=>$_POST['address'],
		 			'company_phone'=>$_POST['company_phone'],
		 			'personal_phone'=> $_POST['personal_phone'],
		 			'email' => $_POST['email'],
		 			'stock_manage' => $_POST['stock_manage'],
		 			'sale_interface' => $_POST['sale_interface']
			 		];
		 		}else{
		 			$data=[
		 			'name'=>$_POST['name'],
		 			'address'=>$_POST['address'],
		 			'company_phone'=>$_POST['company_phone'],
		 			'personal_phone'=> $_POST['personal_phone'],
		 			'email' => $_POST['email'],
		 			'stock_manage' => $_POST['stock_manage'],
		 			'sale_interface' => $_POST['sale_interface']
			 		];
		 		}

		 	 if (insert_data($dbc,'company', $data)) {
				# code...
				echo "<script>alert('company Added....!')</script>";
				//$msg = "<script>alert('Company Added')</script>";
					$sts = 'success';
					redirect("company.php",2000);
				}else{
					$msg = mysqli_error($dbc);
					$sts ="error";
				}
		 		
		 	}
		

		 /*edit company profile*/
		 	if (isset($_POST['company_update'])) {
		 		$company_id=  $_REQUEST['company_id'];
		 		if ($_FILES['logo']['tmp_name']) {
		 			# code...
		 			upload_pic($_FILES['logo'],'img/logo/');
		 			$data=[
		 				'logo'=>$_SESSION['pic_name'],
		 			'name'=>$_POST['name'],
		 			'address'=>$_POST['address'],
		 			'company_phone'=>$_POST['company_phone'],
		 			'personal_phone'=> $_POST['personal_phone'],
		 			'email' => $_POST['email'],
		 			'stock_manage' => $_POST['stock_manage'],
		 			'sale_interface' => $_POST['sale_interface']
			 		];
		 		}else{
		 			$data=[
		 			'name'=>$_POST['name'],
		 			'address'=>$_POST['address'],
		 			'company_phone'=>$_POST['company_phone'],
		 			'personal_phone'=> $_POST['personal_phone'],
		 			'email' => $_POST['email'],
		 			'stock_manage' => $_POST['stock_manage'],
		 			'sale_interface' => $_POST['sale_interface']
			 		];
		 		}
		 		
		 			

		 	 if (update_data($dbc,'company', $data , 'id',$company_id)) {
				# code...
				//echo "<script>alert('company Updated....!')</script>";
				echo $msg = "<script>alert('Company Updated')</script>";
					$sts = 'success';
					redirect("company.php",2000);
				}else{
					$msg = mysqli_error($dbc);
					$sts ="error";
				}	
			}
		   ?>
<?php

?>
		<?php
	/*Add Channel*/
if (!empty($_POST['action']) AND $_POST['action']=="add_new_user") {
		
		if (empty($_REQUEST['password'])) {
			$password=md5($_REQUEST['password']);
		}else{
			if ($_REQUEST['new_user_id']!='') {
				$password=$_REQUEST['old_password'];
			}else{
				$password=md5($_REQUEST['old_password']);
			}
		}

		$data_user=[
			'fullname' => @$_REQUEST['fullname'],
			'username' => $_REQUEST['username'],
			'email' => $_REQUEST['email'],
			'phone' => $_REQUEST['phone'],
			'password' => $password,
			'user_role' => $_REQUEST['user_role'],
			'address' => @$_REQUEST['address'],
			'status' => $_REQUEST['status'],
		];
			
	if ($_REQUEST['new_user_id']=='') {
		if(insert_data($dbc,"users",$data_user)){
		
			$res=['msg'=>'User Added Successfully','sts'=>'success'];
			//redirect("users.php",500);
		}else{
			
						$res=['msg'=>mysqli_error($dbc),'sts'=>'error'];

		}
	}else{

			if(update_data($dbc,"users",$data_user,'user_id',$_REQUEST['new_user_id'])){
			$res=['msg'=>'User Updated Successfully','sts'=>'success'];
			//redirect("users.php",500);
		}else{
			$res=['msg'=>mysqli_error($dbc),'sts'=>'error'];
		}

	}
		
		echo json_encode($res);
	}

	/*Delete budget_category_del_id */
	if (!empty($_REQUEST['user_del_id'])) {
		# code...
		mysqli_query($dbc,"UPDATE users SET status = '0' WHERE user_id = '$_REQUEST[user_del_id]'");
		redirect('users.php',2000);
	}
	/*Fetch budget_category_edit_id */
	if (!empty($_REQUEST['user_edit_id'])) {
		# code...
		$fetchusers = fetchRecord($dbc,"users",'user_id',$_REQUEST['user_edit_id']);
		$users_button=' <button type="submit" id="userFmData_btn" name="user_edit" class="btn btn-admin2 pull pull-right"> Edit </button>';
	}else{
		$users_button=' <button type="submit" id="userFmData_btn" name="users_add" class="btn btn-admin pull pull-right">Save </button>';
	}
	/*Edit budget Category*/
	if (isset($_REQUEST['user_edit'])) {
		# code...
		$user_id = $_REQUEST['user_edit_id'];
		$data_user_update=[

			'username' => $_REQUEST['username'],
			'email' => $_REQUEST['email'],
			'phone' => $_REQUEST['phone'],
			'password' => md5($_REQUEST['password']),
			'user_role' => $_REQUEST['user_role'],
			'address' => $_REQUEST['address'],
			'status' => $_REQUEST['status'],
			

		];
			
	}

?>

<?php


if( isset($_POST['DownloadZip']) )  {
 
 $filename = $_POST['docs'];
 $source = $_POST['docs'];
 $type = $_POST['docs']; 
 
 echo sizeof($filename) ;
 
 //check file is selected for upload
 if(isset($filename) != ""){
 
      //First check whether zip extension is enabled or not
  if(extension_loaded('zip')) {
  
   //create the directory named as "images"
   $folderLocation = "images" ; 
   if (!file_exists($folderLocation)) {
    mkdir($folderLocation, 0777, true);
   }  
         
   $zip_name = time().".zip"; // Zip file name 
   $zip = new ZipArchive;
   if ($zip->open($zip_name, ZipArchive::CREATE) == TRUE){          
   
    foreach($filename as $key=>$tmp_name){
     $temp = $filename[$key];
     $actualfile = $filename[$key];
     // moving image files to temporary locati0n that is "images/"
     move_uploaded_file($temp, $folderLocation."/".$actualfile);
     // adding image file to zip
     $zip->addFile($folderLocation."/".$actualfile, $actualfile );
   
    } 
   // All files are added, so close the zip file.
   $zip->close();
    }
       
  }
  // push to download the zip
  header();
  header('Content-type: application/zip');
  header('Content-Disposition: attachment; filename="skptricks.zip"');
  readfile($zip_name);
  // remove zip file is exists in temp path
  unlink($zip_name);
  //remove image directory once zip file created
  removedir($folderLocation); 
 }
 
} 
 // user defined function to remove directory with their content
function removedir($dir) {
  if (is_dir($dir)) {
    $objects = scandir($dir);
    foreach ($objects as $object) {
      if ($object != "." && $object != "..") {
        if (filetype($dir."/".$object) == "dir") 
           rrmdir($dir."/".$object); 
        else unlink   ($dir."/".$object);
      }
    }
    reset($objects);
    rmdir($dir);
  }
 } 


 
?>

<?php if (!empty($_REQUEST["adding_cart"])) {
       // $_REQUEST["quantity"] = 1;
        switch ($_REQUEST["adding_cart"]) {
            case "add":
                if (!empty($_REQUEST["quantity"])) {
                    $productByCode = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT * FROM product WHERE product_id='" . $_REQUEST["code"] . "'"));
                 //   $prod_img=json_decode($productByCode['product_image']);
                    $itemArray = array(
                        "item_" . $_REQUEST["code"] => array(
                            'name' => $productByCode["product_name"],
                            'img' => $productByCode["product_image"],
                            'code' => $productByCode["product_id"],
                            'quantity' => $_REQUEST["quantity"],
                            'price' => $productByCode["rate"],
                            'brand_id' => $productByCode["brand_id"],
                            'categories_id' => $productByCode["categories_id"],
                            'status' => 'new',
                        )
                    );

                    if (!empty($_SESSION["cart_item"])) {

                        $proByCode=  "item_" .$productByCode["product_id"];
                        if (in_array($proByCode, array_keys($_SESSION["cart_item"]))) {

                            foreach ($_SESSION["cart_item"] as $k => $v) {
                                if ($proByCode == $k) {
                                    if (empty($_SESSION["cart_item"][$k]["quantity"])) {
                                        $_SESSION["cart_item"][$k]["quantity"] = 0;
                                    }
                                  
                                    $_SESSION["cart_item"][$k]["quantity"] += $_REQUEST["quantity"];
                                }
                            }
                           // $msg = "Item Update into Cart Successfully";
                        } else {
                        
                            $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                            $msg = 1;
                        }
                    } else {
                        $_SESSION["cart_item"] = $itemArray;
                        $msg = 1;
                    }
                }
                ?>
                <?php
                $msg = 1;
                $sts = "success";
                break;
            case "remove":
                if (!empty($_SESSION["cart_item"])) {
                    foreach ($_SESSION["cart_item"] as $k => $v) {
                        //$k . "<br>";
                        
                         

                        if ($_REQUEST["code"] == $_SESSION["cart_item"][$k]['code']){
                            
                            unset($_SESSION["cart_item"][$k]);
                        }
                        if (empty($_SESSION["cart_item"])){
                            unset($_SESSION["cart_item"]);
                        }
                    }
                }
                $msg = "Item Removed from Cart Successfully";
                $sts = "info";
                $_SESSION["item_total_qty"] = $_SESSION["item_total_qty"] - 1;
                break;
            case "empty":
                unset($_SESSION["cart_item"]);
                unset($_SESSION["item_total_qty"]);
                unset($_SESSION["order_id"]);
                break;
        }
        echo $msg;
    }
 ?>
