<?php
include_once 'php_action/db_connect.php';
include_once 'inc/functions.php';

if(isset($_REQUEST['DownloadZip']) AND $_REQUEST['DownloadZip']!=""){
	
	extract($_REQUEST);
	
	$filename	='vehicle_docs'.time().'.zip';
	
$q = get($dbc,"airmail_files WHERE file_type = 'general document' AND vehicle_id = '".$_REQUEST['vehicle_id']."' ");
		$zip = new ZipArchive;
	if ($zip->open($filename,  ZipArchive::CREATE)){
		while ($r = mysqli_fetch_assoc($q)){
			$zip->addFile('img/vehicle_docs/'.$r['airmail_file_name'], $r['airmail_file_name']);
		}
		

		$zip->close();
		header("Content-type: application/zip"); 
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Pragma: no-cache"); 
		header("Expires: 0"); 
		readfile("$filename"); 
		unlink($filename);
	}else{
	   echo 'Failed!';
	}
}
if(isset($_REQUEST['DownloadImagesZip']) AND $_REQUEST['DownloadImagesZip']!=""){
	
	extract($_REQUEST);
	$vehicle=fetchvehicle_info($dbc,$_REQUEST['vehicle_id']);
	$filename	=$vehicle['maker_name']."-".$vehicle['brand_name']."-".time().'.zip';
	
$q = get($dbc,"vehicle_images WHERE vehicle_id = '".$_REQUEST['vehicle_id']."' ");
		$zip = new ZipArchive;
	if ($zip->open($filename,  ZipArchive::CREATE)){
		while ($r = mysqli_fetch_assoc($q)){
			$zip->addFile('img/vehicles_images/'.$r['vehicle_image_name'], $r['vehicle_image_name']);
		}
		

		$zip->close();
		header("Content-type: application/zip"); 
		header("Content-Disposition: attachment; filename=$filename"); 
		header("Pragma: no-cache"); 
		header("Expires: 0"); 
		readfile("$filename"); 
		unlink($filename);
	}else{
	   echo 'Failed!';
	}
}
?> 