<?php
   require_once '../inc/functions.php';
   require_once '../php_action/db_connect.php';
   // include_once '';
$id = $_POST['vehicle_id'];
$check = mysqli_query($dbc,"SELECT * FROM vehicle_images WHERE vehicle_id = '$id'");
while ($row = mysqli_fetch_assoc($check)){
  $pictures[] = $row['vehicle_image_name'];
}

 $error = ""; //error holder  
 
 if(isset($_POST['create_pdf']))  
 {  
      $post = $pictures;
     
     $file_folder = "vehicles_images/"; // folder to load files  
      if(extension_loaded('zip'))  
      {   
           // Checking ZIP extension is available  
            
                // Checking files are selected  
                $zip = new ZipArchive(); // Load zip library   
                $zip_name = time().".zip";           // Zip name  
                if($zip->open($zip_name, ZIPARCHIVE::CREATE)!==TRUE)  
                {   
                     // Opening zip file to load files  
                     $error .= "*Sorry ZIP creation failed at this time";  
                }  
                foreach($post as $file)  
                {   
                     $zip->addFile($file_folder.$file); // Adding files into zip  
                }  
                $zip->close();  
                if(file_exists($zip_name))  
                {  
                     // push to download the zip  
                     header('Content-type: application/zip');  
                     header('Content-Disposition: attachment; filename="'.$zip_name.'"');  
                     readfile($zip_name);  
                     // remove zip file is exists in temp path  
                     unlink($zip_name);  
                }  
            
           else  
           {  
                $error .= "* Please select file to zip ";  
           }  
      }  
      else  
      {  
           $error .= "* You dont have ZIP extension";  
      }  
 }