

<?php 

//Debug Function 

function debug_mode($array){

echo "<pre>";

print_r($array);

exit;

}

?>

 <?php function getYesNo($data){

  return ($data==1)?'Yes':'No';

 } ?>

  

<?php function getEnDis($data){

  return ($data==1)?'<span class="text-success">Enabled</span>':'<span class="text-danger">Disabled</span>';

} ?>

<?php function isActive($data){

  return ($data==1)?'<span class="label label-success">Activate</span>':'<span class="label label-danger">Deactivated</span>';

} ?>

<?php function getDateFormat($format,$data){

  return date($format,strtotime($data));

  } ?>

<?php 

//Get Data from table 

function get($dbc,$table){

return mysqli_query($dbc,"SELECT * FROM $table");

}

?>

<?php 

//Get Data by criteria  

function getWhere($dbc,$table,$fld,$id){

return mysqli_query($dbc,"SELECT * FROM $table WHERE $fld = '$id'");

}

?>

<?php 

//Get Data from table 

function getOrderBy($dbc,$table,$fld){

return mysqli_query($dbc,"SELECT * FROM $table ORDER BY $fld ASC");

}

?>

<?php 

//Get and Fetch Data from table

function getFetch($dbc,$table){

return mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM $table"));

}

 ?>

<?php 

//Count Row

function countIf($dbc,$arr){

  echo (mysqli_num_rows($arr)==0)?"No Found":'';

}

?>

<?php 

 //Get Message 

 function getMessage($msg,$sts){

  global $sts;

  global $msg;

if (!empty($msg)) {

# code...

echo "<div class='alert alert-".$sts."'>".$msg."</div>";

}

}

  ?>

  <?php 

  //Delete Data From Table

  function deleteFromTable($dbc,$table,$fld="",$id){

  global $sts;

  global $msg;

  // $id = base64_decode($id);

if (mysqli_query($dbc,"DELETE FROM $table WHERE $fld='$id'")) {

# code...

$msg =  "Deleted ....";

$sts="warning";

  // redirect('index.php?nav='.$_REQUEST['nav'],1500);

}else{

$msg= mysqli_error($dbc);

$sts="danger";

}

  }

   ?>

   <?php 

   //Redirect Function

  function redirect($url,$time=0){

  ?>

<script>

setTimeout(function(){

window.location="<?=$url?>";

},<?=$time?>);

</script>



  <?php

  }

    ?>

     <?php 

   //Redirect Function

  function redirectURL($time=0){

  ?>

<script>

setTimeout(function(){

window.location=window.location.href;

},<?=$time?>);

</script>



  <?php

  }

    ?>

    <?php 

    //Validate Function

     function validate_data($dbc,$data)

    {

    # code...

    return mysqli_real_escape_string($dbc,strip_tags($data));

    } ?>

<?php 

// Delete All function

function delete_all($dbc, $table, $array, $fld ){

global $sts;

  global $msg;

  if(!empty($array)):

foreach ($array as $data) {

# code...

$q = mysqli_query($dbc,"DELETE FROM $table WHERE $fld='$data'");

}

if ($q) {

# code...

$msg = "Data Deleted";

$sts = "danger";

}else{

$msg = mysqli_error($dbc);

$sts = "danger";

}

endif;

}

?>

<?php 

//count unseen

function countUnseen($dbc,$table,$fld){

return mysqli_num_rows(mysqli_query($dbc,"SELECT * FROM $table WHERE $fld=0"));

}

 ?>

<?php 

  // Fetch by Criteria

function fetchRecord($dbc,$table,$fld,$data){

return  mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM $table WHERE $fld='$data'"));

} ?>

<?php 

  // Count When

function countWhen($dbc,$table,$fld,$data){

return  mysqli_num_rows(mysqli_query($dbc,"SELECT * FROM $table WHERE $fld='$data'"));

} ?>

<?php 

  // Count When

function countWhens($dbc,$table,$fld1,$data1,$fld2,$data2){

return  mysqli_num_rows(mysqli_query($dbc,"SELECT * FROM $table WHERE $fld1='$data1' AND $fld2='$data2'"));

} ?>

<?php 

//Insert Data Function

function insert_data($dbc,$table,$data){

  global $msg;

  global $sts;

  $fld=$values="";

  $i=0;

  $comma=",";

  $count = count($data);

  foreach ($data as $index => $value) {

  # code...

  if(($count-1)==$i){

  $comma="";

  }

  $fld=$fld.$index.$comma;

  if ($index!="post_body") {

  # code...

  $val =strtolower(validate_data($dbc,$value));

  }else{

  $val =strtolower($value);

  }

  $values = $values."'".$val."'".$comma;

  $i++;

  }

  return mysqli_query($dbc,"INSERT INTO $table($fld) VALUES($values)");

}



?>

<?php 

//Update Data Function

function update_data($dbc,$table,$data,$col,$val){

$set_data="";

$i=0;

$comma=",";

$count = count($data);

//debug_mode($data);

foreach ($data as $index => $value) {

# code...

if(($count-1)==$i){

$comma="";

}

$set_data=$set_data.$index."='".validate_data($dbc,$value)."'".$comma;

$i++;

}

return mysqli_query($dbc,"UPDATE $table SET $set_data WHERE $col='$val'");

}



?>

<?php

//Count Rows  

function countAll($dbc,$table){

return mysqli_num_rows(mysqli_query($dbc,"SELECT * FROM $table"));

}

?>

<?php 

// get User IP Address 

if (!empty($_SERVER['HTTP_CLIENT_IP'])) {

   $ip = $_SERVER['HTTP_CLIENT_IP'];

} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

   $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

} else {

   $ip = $_SERVER['REMOTE_ADDR'];

}

?>

<?php 

function url(){

    $pu = parse_url($_SERVER['REQUEST_URI']);

    return $pu["scheme"] . "://" . $pu["host"];

}

 ?>

 <?php 

function url_origin( $s, $use_forwarded_host = false )

{

    $ssl      = ( ! empty( $s['HTTPS'] ) && $s['HTTPS'] == 'on' );

    $sp       = strtolower( $s['SERVER_PROTOCOL'] );

    $protocol = substr( $sp, 0, strpos( $sp, '/' ) ) . ( ( $ssl ) ? 's' : '' );

    $port     = $s['SERVER_PORT'];

    $port     = ( ( ! $ssl && $port=='80' ) || ( $ssl && $port=='443' ) ) ? '' : ':'.$port;

    $host     = ( $use_forwarded_host && isset( $s['HTTP_X_FORWARDED_HOST'] ) ) ? $s['HTTP_X_FORWARDED_HOST'] : ( isset( $s['HTTP_HOST'] ) ? $s['HTTP_HOST'] : null );

    $host     = isset( $host ) ? $host : $s['SERVER_NAME'] . $port;

    return $protocol . '://' . $host;

}



function full_url( $s, $use_forwarded_host = false )

{

    return url_origin( $s, $use_forwarded_host ) . $s['REQUEST_URI'];

}



 ?>

<?php

// Pic upload

 function upload_pic($file,$url){

global $sts;

global $msg;

global $size;

global $pic;

// @$file= $_FILES['f'];

$file_name = $file['name'];

$temp_name = $file['tmp_name'];

$size = $file['size'];

// $type = $file['type'];

$errors = $file['error'];

$type = explode('.', $file_name);

$type = $type[count($type)-1];

$pic = uniqid(rand()).'.'.$type;

$_SESSION['pic_name'] = $pic;

$url = $url.$pic;

if (!$temp_name) {

# code...

$sts="info";

$msg= "Please Choose a File Before Clicking";

}elseif($size>500000){

$sts="info";

$msg= "Not Allowed more than 5 MB file size";

unlink($temp_name);

// exit();

}

elseif(!preg_match("/\.(gif|jpg|png|jpeg)$/i", $file_name)){

$sts="info";

$msg= "Only .jpg , .png and .gif file types are allowed";

unlink($temp_name);

// exit();

}elseif($errors==1){

$sts="info";

$msg= "Error while uploading....";

unlink($temp_name);

// exit();

}

if(move_uploaded_file($temp_name, $url)){

return true;

}

else{

$sts="info";

$msg= "Not Uploaded...";

@unlink($temp_name);

//exit();

}

} ?>



<?php

// file upload

 function upload_files($file,$url){

global $sts;

global $msg;

global $size;

global $pic;

// @$file= $_FILES['f'];

$file_name = $file['name'];

$temp_name = $file['tmp_name'];

$size = $file['size'];

// $type = $file['type'];

$errors = $file['error'];

$type = explode('.', $file_name);

$type = $type[count($type)-1];

$pic = uniqid(rand()).'.'.$type;

$_SESSION['pic_name'] = $pic;

$url = $url.$pic;

if (!$temp_name) {

# code...

$sts="info";

$msg[]= "Please Choose a File Before Clicking";

}elseif($size>1000000){

$sts="info";

$msg[]= "Not Allowed more than 10 MB file size";

unlink($temp_name);

// exit();

}

elseif($errors==1){

$sts="info";

$msg[]= "Error while uploading....";

unlink($temp_name);

// exit();

}

if(move_uploaded_file($temp_name, $url)){

return true;

}

else{

$sts="info";

$msg[]= "Not Uploaded...";

@unlink($temp_name);

//exit();

}

 /* $txt="";

  foreach ($msg as $value) {

    # code...

    $txt.=$value."<br>";

  }

  echo "<script>alert('".$txt."')</script>";*/

} ?>



<?php 

  function getSelectTag($data,$text){

    if (isset($data)) {

      # code...

      echo "<option value='".$data."'>".$data."</option>";

    }else{

      echo "<option value=''>".$text."</option>";



    }

  }

 ?>



<?php 

  function getSelectTagEnDis($data,$text){

    if (isset($data)) {

      # code...

      echo "<option value='".$data."'>".getStatus($data)."</option>";

    }else{

      echo "<option value=''>".$text."</option>";



    }

  }

 ?>

<?php 

//Send Email

function send_email($email_address,$email_body){

global $sts;

  global $msg;

$mail = new PHPMailer;

//Tell PHPMailer to use SMTP

$mail->isSMTP();



//Enable SMTP debugging

// 0 = off (for production use)

// 1 = client messages

// 2 = client and server messages

$mail->SMTPDebug = 0;



//Ask for HTML-friendly debug output

$mail->Debugoutput = 'html';



//Set the hostname of the mail server

$mail->Host = 'smtp.gmail.com';

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission

$mail->Port = 587;



//Set the encryption system to use - ssl (deprecated) or tls

$mail->SMTPSecure = 'tls';



//Whether to use SMTP authentication

$mail->SMTPAuth = true;



//Username to use for SMTP authentication - use full email address for gmail

$mail->Username = "moixx.ansari43@gmail.com";



//Password to use for SMTP authentication

$mail->Password = "3593ab59";



//Set who the message is to be sent from

$mail->setFrom('moixx.ansari43@email.com', 'Moixxweb Education Alert');



//Set an alternative reply-to address

//$mail->addReplyTo('replyto@example.com', 'First Last');



//Set who the message is to be sent to

$mail->addAddress($email_address, 'Moixxweb Education Alert');



//Set the subject line

$mail->Subject = 'Moixxweb Education Alert';



//Read an HTML message body from an external file, convert referenced images to embedded,

//convert HTML into a basic plain-text alternative body

//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));

 

$body =$email_body;

$mail->Body =$body ;



//Replace the plain text body with one created manually

$mail->AltBody = 'This is a plain-text message body';

$mail->isHTML(true);  

//Attach an image file

//$mail->addAttachment('images/phpmailer_mini.png');



//send the message, check for errors

if (!$mail->send()) {

   $msg= "Mailer Error: " . $mail->ErrorInfo;

   $sts="danger";

} else{

$msg="Email Sent Successfully...";

$sts="success";

}



} ?>



 <?php  

  //student promoton

   function studentPromotion($dbc,$student_id){

    $q = mysqli_query($dbc,"SELECT * FROM student_promotion WHERE student_id='$student_id' ORDER BY promotion_date DESC");

    while($r=mysqli_fetch_assoc($q)){

      echo "<li> <mark>Promoted to <i>".$r['student_class']." ".$r['student_section']." at ".date('D, d-M-Y',strtotime($r['promotion_date']))."</i></mark> <hr></li>";

    }

   }

  ?>



<?php  

  //student Fund History

   function studentFundHistory($dbc,$student_id){

    $q = mysqli_query($dbc,"SELECT * FROM fee_and_fund WHERE student_id='$student_id' GROUP BY fund_add_date ORDER BY fund_id DESC");

    if(mysqli_num_rows($q)>=1){

    while($r=mysqli_fetch_assoc($q)){

      echo '<a target="_new" href="print_student_reciept.php?fund_id='.$r['fund_id'].'" class="btn btn-warning pull-right">

          <span class="glyphicon glyphicon-list"></span> Print Reciept

          </a>';

      echo '<a href="index.php?nav=fee_and_fund&edit_fund_id='.$r['fund_id'].'" class="btn btn-primary pull-right">

                    <span class="glyphicon glyphicon-edit"></span> Edit

                  </a>';

         echo '<a href="index.php?nav=fee_and_fund&del_fund_id='.$r['fund_id'].'" class="btn btn-danger pull-right">

          <span class="glyphicon glyphicon-trash"></span> Delete

        </a>';

      echo "Dated: <span class='label label-danger'>".date('d-M-Y',strtotime($r['fund_add_date']))."</span><br>";

      echo "Monthly Fee: ".$r['fund_monthly_fee']."<br>";

      echo "Cycle Fund: ".$r['fund_cycle']."<br>";

       echo "Paper Fund: ".$r['fund_paper']."<br>";

        echo "MF Fund: ".$r['fund_mf']."<br>";

         echo "Admission Fee: ".$r['fund_admission_fee']."<br>";

          echo "Minhaj Registration: ".$r['fund_minhaj_registration']."<br>";

          echo "Board Registration: ".$r['fund_board_registration']."<br>";          

          echo "Board Admission Fee: ".$r['fund_board_admission_fee']."<br>";       

          echo "<hr>";   



    }

  }

   }

  ?>



<?php 

  //Level status

  function getLevel($sts){

    switch ($sts) {

      case 'l1':

        # code...

      return '<label class="label label-warning">Level 1</label>';

        break;

      case 'l2':

        # code...

      return '<label class="label label-primary">Level 2</label>';

        break;

      case 'l3':

        # code...

      return '<label class="label label-success">Level 3</label>';

        break;

      default:

        # code... 

      break;

    }

  }



function getTransaction($sts){

  if ($sts == "ware_sale") { 

    return '<label class="label label-warning">Ware House Sale</label>';

  }elseif($sts == "sale"){

    return '<label class="label label-success">Direct Sale</label>';

  }else{

    return '<label class="label label-danger">Purchase</label>';

  }

}  



function getOrderType($sts){

  if ($sts == "0") { 

    return '<label class="label label-danger">Cancelled</label>';

  }elseif($sts == "1"){

    return '<label class="label label-info">Approved</label>';

  }elseif($sts == "2"){

    return '<label class="label label-success">Completed</label>';

  }else{

    return '<label class="label label-warning">Pending</label>';

  }

}  

 ?>





<?php 

  function setColor($dbc, $tbl, $colName, $checkID, $fetchThis){

    $id = fetchRecord($dbc, $tbl, $colName, $checkID)[$fetchThis];

    echo ($id > 0) ? "text-success" : "text-danger";

  }

  // setColor($dbc,"vehicle_info", "vehicle_id", $r['vehicle_id'], "vehicle_id")

?> 



<?php 

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



/*

* Country Array to HTML Select List

* Developed By: Jose Philip Raja - www.josephilipraja.com

* About Author: Creative Director of CreaveLabs IT Solutions - www.creavelabs.com

*

* Usage:

*   echo countrySelector(); // Basic

*   echo countrySelector("IN"); // Set default Country with its code

*   echo countrySelector("IN", "my-country", "my-country", "form-control"); // With full Options

*

*/

function countrySelector($defaultCountry = "", $id = "", $name = "", $classes = ""){

    global $countryArray; // Assuming the array is placed above this function

    

    $output = "<input  list='".$id.$name."' id='".$id."' name='".$name."' class='".$classes."'><datalist id='".$id.$name."'>";

  

  foreach($countryArray as $code => $country){

    $countryName = ucwords(strtolower($country["name"])); // Making it look good

    $output .= "<option data-country='".$countryName."' value='".$code."' ".(($code==strtoupper($defaultCountry))?"selected":"").">".$code." - ".$countryName." (+".$country["code"].")</option>";

  }

  

  $output .= "</datalist>";

  

  return $output; // or echo $output; to print directly

}

function countryBySelect($id = "", $name = "", $classes = "",$defaultoption = "",$defaultMsg = ""){

    global $countryArray; // Assuming the array is placed above this function

    

    $output = "<select  id='".$id."' name='".$name."' class='".$classes."'  ".$defaultMsg.">";

  

  foreach($countryArray as $code => $country){

    $countryName = ucwords(strtolower($country["name"])); // Making it look good

    $output .= "<option ".$defaultoption." value='".$code."' >".$code." - ".$countryName." (+".$country["code"].")</option>";

  }

  

  $output .= "</select>";

  

  return $output; // or echo $output; to print directly

}


$currency = array (

            'ALL' => 'Albania Lek',

            'AFN' => 'Afghanistan Afghani',

            'ARS' => 'Argentina Peso',

            'AWG' => 'Aruba Guilder',

            'AUD' => 'Australia Dollar',

            'AZN' => 'Azerbaijan New Manat',

            'BSD' => 'Bahamas Dollar',

            'BBD' => 'Barbados Dollar',

            'BDT' => 'Bangladeshi taka',

            'BYR' => 'Belarus Ruble',

            'BZD' => 'Belize Dollar',

            'BMD' => 'Bermuda Dollar',

            'BOB' => 'Bolivia Boliviano',

            'BAM' => 'Bosnia and Herzegovina Convertible Marka',

            'BWP' => 'Botswana Pula',

            'BGN' => 'Bulgaria Lev',

            'BRL' => 'Brazil Real',

            'BND' => 'Brunei Darussalam Dollar',

            'KHR' => 'Cambodia Riel',

            'CAD' => 'Canada Dollar',

            'KYD' => 'Cayman Islands Dollar',

            'CLP' => 'Chile Peso',

            'CNY' => 'China Yuan Renminbi',

            'COP' => 'Colombia Peso',

            'CRC' => 'Costa Rica Colon',

            'HRK' => 'Croatia Kuna',

            'CUP' => 'Cuba Peso',

            'CZK' => 'Czech Republic Koruna',

            'DKK' => 'Denmark Krone',

            'DOP' => 'Dominican Republic Peso',

            'XCD' => 'East Caribbean Dollar',

            'EGP' => 'Egypt Pound',

            'SVC' => 'El Salvador Colon',

            'EEK' => 'Estonia Kroon',

            'EUR' => 'Euro Member Countries',

            'FKP' => 'Falkland Islands (Malvinas) Pound',

            'FJD' => 'Fiji Dollar',

            'GHC' => 'Ghana Cedis',

            'GIP' => 'Gibraltar Pound',

            'GTQ' => 'Guatemala Quetzal',

            'GGP' => 'Guernsey Pound',

            'GYD' => 'Guyana Dollar',

            'HNL' => 'Honduras Lempira',

            'HKD' => 'Hong Kong Dollar',

            'HUF' => 'Hungary Forint',

            'ISK' => 'Iceland Krona',

            'INR' => 'India Rupee',

            'IDR' => 'Indonesia Rupiah',

            'IRR' => 'Iran Rial',

            'IMP' => 'Isle of Man Pound',

            'ILS' => 'Israel Shekel',

            'JMD' => 'Jamaica Dollar',

            'JPY' => 'Japan Yen',

            'JEP' => 'Jersey Pound',

            'KZT' => 'Kazakhstan Tenge',

            'KPW' => 'Korea (North) Won',

            'KRW' => 'Korea (South) Won',

            'KGS' => 'Kyrgyzstan Som',

            'LAK' => 'Laos Kip',

            'LVL' => 'Latvia Lat',

            'LBP' => 'Lebanon Pound',

            'LRD' => 'Liberia Dollar',

            'LTL' => 'Lithuania Litas',

            'MKD' => 'Macedonia Denar',

            'MYR' => 'Malaysia Ringgit',

            'MUR' => 'Mauritius Rupee',

            'MXN' => 'Mexico Peso',

            'MNT' => 'Mongolia Tughrik',

            'MZN' => 'Mozambique Metical',

            'NAD' => 'Namibia Dollar',

            'NPR' => 'Nepal Rupee',

            'ANG' => 'Netherlands Antilles Guilder',

            'NZD' => 'New Zealand Dollar',

            'NIO' => 'Nicaragua Cordoba',

            'NGN' => 'Nigeria Naira',

            'NOK' => 'Norway Krone',

            'OMR' => 'Oman Rial',

            'PKR' => 'Pakistan Rupee',

            'PAB' => 'Panama Balboa',

            'PYG' => 'Paraguay Guarani',

            'PEN' => 'Peru Nuevo Sol',

            'PHP' => 'Philippines Peso',

            'PLN' => 'Poland Zloty',

            'QAR' => 'Qatar Riyal',

            'RON' => 'Romania New Leu',

            'RUB' => 'Russia Ruble',

            'SHP' => 'Saint Helena Pound',

            'SAR' => 'Saudi Arabia Riyal',

            'RSD' => 'Serbia Dinar',

            'SCR' => 'Seychelles Rupee',

            'SGD' => 'Singapore Dollar',

            'SBD' => 'Solomon Islands Dollar',

            'SOS' => 'Somalia Shilling',

            'ZAR' => 'South Africa Rand',

            'LKR' => 'Sri Lanka Rupee',

            'SEK' => 'Sweden Krona',

            'CHF' => 'Switzerland Franc',

            'SRD' => 'Suriname Dollar',

            'SYP' => 'Syria Pound',

            'TWD' => 'Taiwan New Dollar',

            'THB' => 'Thailand Baht',

            'TTD' => 'Trinidad and Tobago Dollar',

            'TRY' => 'Turkey Lira',

            'TRL' => 'Turkey Lira',

            'TVD' => 'Tuvalu Dollar',

            'UAH' => 'Ukraine Hryvna',

            'GBP' => 'United Kingdom Pound',

            'UGX' => 'Uganda Shilling',

            'USD' => 'United States Dollar',

            'UYU' => 'Uruguay Peso',

            'UZS' => 'Uzbekistan Som',

            'VEF' => 'Venezuela Bolivar',

            'VND' => 'Viet Nam Dong',

            'YER' => 'Yemen Rial',

            'ZWD' => 'Zimbabwe Dollar'

        );



function countryCurrency($id = "", $name = "", $classes = "",$checkstate=""){

    global $currency; // Assuming the array is placed above this function

      

    $output = "<input value='".$checkstate."' list='".$id.$name."' id='".$id."' name='".$name."' class='".$classes."'><datalist id='".$id.$name."'>";

  

  foreach ($currency as $index => $country) {

 

    $output .= "<option  value='".$index."'>".$index." - ".$country."</option>";

  }

  

  $output .= "</datalist>";

  

  return $output; // or echo $output; to print directly

}

?>



<?php 

function getTotalCost($dbc,$data){

  //Vehicle Info

  $fright = 0;

  $bl = 0;

  $terminal = 0;

  $vehicle_info = fetchRecord($dbc, "vehicle_info", "vehicle_id", $data);

  $fright = $vehicle_info['vehicle_freight_charges'];

  $bl = $vehicle_info['vehicle_bl_charges'];

  $terminal = $vehicle_info['vehicle_terminal_charges'];

  $vehicle_info_total =  (int)$fright + (int)$bl + (int)$terminal;



  //Auction Info

  $fee = 0;

  $win_price = 0;

  $recycle_fee = 0;

  $auction_info = fetchRecord($dbc, "auction_info", "vehicle_id", $data);

  $fee = $auction_info['auction_fee'];

  $win_price = $auction_info['auction_win_price'];

  $recycle_fee = $auction_info['auction_recycle_fee'];

  $auction_info_total = (int)$fee + (int)$win_price + (int)$recycle_fee;



  //Auction Info

  $ricksu_fee = 0;

  $ricksu_repair = 0;
  $ricksu_charger_for_additional=0;

  $ricksu = fetchRecord($dbc, "ricksu", "vehicle_id", $data);

  $ricksu_fee = $ricksu['ricksu_fee'];

  $ricksu_repair = $ricksu['ricksu_repair_fee'];
  $ricksu_charger_for_additional = $ricksu['ricksu_charger_for_additional'];

  $ricksu_total = (int)$ricksu_fee + (int)$ricksu_repair +(int)$ricksu_charger_for_additional;

  



  $repair_charges_tax = 0;

  $charges = 0;

  $inspection_info = fetchRecord($dbc, "inspection_info", "vehicle_id", $data);

  $repair_charges_tax = $inspection_info['inspection_info_repair_charges'];

  $charges = $inspection_info['inspection_info_charges'];

  $inspection_info_total = (int)$repair_charges_tax + (int)$charges;



$shipment_total=0;
$vehicle_bl_charges=$vehicle_info['vehicle_bl_charges'];
$radiation_charges=$shipment['radiation_charges'];
$radiation_charges=$vehicle_info['vehicle_freight_charges'];
$vehicle_terminal_charges=$vehicle_info['vehicle_terminal_charges'];
$heat_charges=$shipment['heat_charges'];
$other_charges=$shipment['other_charges'];
$shipping_charges=$shipment['shipping_charges'];

$shipment_total=(int)$vehicle_bl_charges+(int)$radiation_charges+(int)$radiation_charges+(int)$vehicle_terminal_charges+(int)$heat_charges+(int)$other_charges+(int)$shipping_charges;

$shipment=fetchRecord($dbc,"shipment","vehicle_id",$data);




  $airmail = fetchRecord($dbc, "airmail", "vehicle_id", $data);

  $airmail_courier =  $airmail['airmail_courier_charges'];

  

  $grandTotal = (int)$vehicle_info_total + (int)$auction_info_total + (int)$ricksu_total + (int)$ricksu_total + (int)$airmail_courier+$shipment_total;

  return $grandTotal;

}



function getTotalExpense($dbc,$data){

  $ttl = 0;

  $q = mysqli_query($dbc, "SELECT * FROM vehicle_expense WHERE vehicle_info_id = '$data'");

  while ($r = mysqli_fetch_assoc($q)) {

      $ttl += $r['vehicle_expense_amount'];

  }

  return $ttl;

}







?>

<?php



function html_mailto($dbc,$to_email,$subject,$id)

{

  $record=fetchRecord($dbc,"ricksu","ricksu_id",$id);

  $v=fetchRecord($dbc,"vehicle_info","vehicle_id",$record['vehicle_id']);

  $company=fetchRecord($dbc,"ricksu_company","ricksu_company_id",$record['ricksu_company']);

  $brand=fetchRecord($dbc,"brands","brand_id",$v['vehicle_brand']);

  $maker=fetchRecord($dbc,"maker","maker_id",$v['vehicle_maker']);
  @$body_type=fetchRecord($dbc,"body_type","body_type_id",$v['vehicle_type']);


$body = '<!DOCTYPE html>

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

        <td  align="left"  width="93px">

          Vehicle Name: 

        </td>

        <td width="93px">'.@$brand['brand_name'].' '.@$maker['maker_name'].'</td>

   

        <td width="93px">

          Manufacture Year:

        </td>
<td width="93px">'.@$v['vehicle_manu_year'].'</td>
       


      </tr>

      <tr>

        <td  align="left"  width="93px">

          Vehicle Type: 

        </td>

         <td width="93px">'.@$body_type['body_type_name'].'</td><!-- input -->




        <td width="93px">

          Vehicle Color:

        </td>

        <td width="93px">'.@$v['vehicle_color'].'</td>



      </tr>

      <tr>

        <th colspan="4" align="center"><h3>Risku Information</h3></th>

      </tr>

      <tr>

        <td  align="left"  width="93px">

          Loading Point: 

        </td>

        <td width="93px">'.@$record['ricksu_loading_point'].'</td>



        <td width="93px">

          Delivery Point:

        </td>

        <td width="93px">'.@$record['ricksu_delievery_point'].'</td>



      </tr>

      <tr>

        <td  align="left"  width="93px">

          Type: 

        </td>
         <td width="93px">'.@$record['ricksu_type'].'</td>




        <td width="93px">

          Risku Company:

        </td>

        <td width="93px">'.@$company['ricksu_company_name'].'</td>



      </tr>

      <tr>

        <td  align="left"  width="93px">

          Recieved By: 

        </td>

        <td width="93px">'.@$record['ricksu_receive'].'</td>



        <td width="93px">

          Delivered By:

        </td>

        <td width="93px">'.@$record['ricksu_deliever_by'].'</td>



      </tr>

      <tr>

        <td  align="left"  width="93px">

          Yard Arrival Date: 

        </td>

        <td width="93px">'.@$record['ricksu_arrival_date'].'</td>



        <td width="93px">

          Yard Leaving Date:

        </td>

        <td width="93px">'.@$record['ricksu_leaving_date'].'</td>



      </tr>

      <tr>

        <td  align="left"  width="93px">

          Repair Info: 

        </td>

        
        <td width="93px">'.@$record[' ricksu_repair_info'].'</td><!-- input -->



        <td width="93px">

          Repair Fee:

        </td>

        <td width="93px">'.@$record['ricksu_repair_fee'].'</td>



      </tr>

      <tr>

        <td  align="left"  width="93px">

          Risku Fee: 

        </td>

        <td width="93px">'.@$record['ricksu_fee'].'</td>



        <td width="93px">

          Additonal Charges:

        </td>

        <td width="93px">'.@$record['ricksu_charger_for_additional'].'</td>



      </tr>

      <tr>

        <td  align="left"  width="93px">

          Free Days at Yard: 

        </td>

        <td width="93px">'.@$record['ricksu_free_at_yard'].'</td>



        <td width="93px">

          Yard Services:

        </td>

        <td width="93px">'.@$record['ricksu_yard_services'].'</td>



      </tr>

      

    </table>

    



    

  </body>

</html>';



$headers = "MIME-Version: 1.0\r\n";



$headers = "Content-type: text/html; charset=ISO-8859-1";



if (mail($to_email,$subject,$body,$headers)) {

    echo "Email successfully sent to $to_email... ";

} else {

    echo "Email sending failed...";



}

}
function getcustomerBlance($dbc,$id){
// $r4 = mysqli_fetch_assoc(mysqli_query($dbc, "SELECT sum(advance) AS newbalance FROM transactions WHERE customer_id = '$id'"));
// return ((int)$r4['newbalance']);

 $from_balance=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT SUM(credit-debit) AS from_balance FROM transactions WHERE customer_id='$id'"));
  if (!empty($from_balance['from_balance'])) {
    return $from_balance['from_balance'];
  }else{
    return 0;
  }
  # code...
}
function getIncome($dbc,$value=''){
   $salesGet = mysqli_query($dbc,"SELECT * FROM orders ".$value." ");
    $net_profit=0;
  
  while($fetchOrder=mysqli_fetch_assoc($salesGet)):
            $sql = "SELECT * FROM order_item WHERE order_id = '$fetchOrder[order_id]' AND order_item_status=1";
                  $query = $dbc->query($sql);
                  while ($result = $query->fetch_assoc()) {
                  $product_id= $result['product_id'];
                  $sold_quantity= $result['quantity'];
                  $sold_rate= $result['rate'];
                //$purchases_items ="SELECT * FROM purchase_item WHERE purchase_id=  ";
                  $sql_item = "SELECT * FROM purchase_item WHERE product_id = '$product_id'";
                  $query_item = $dbc->query($sql_item);
                  while ($result_item = $query_item->fetch_assoc()) {
                  $product_purchase= $result_item['rate'];
                  $sold_income = @$sold_quantity * @$sold_rate;
                  $purchase_income = $product_purchase * $sold_quantity; 
                }
                  $net_profit+=@$sold_income-@$purchase_income ;

                 }//while
  endwhile; 
     return $net_profit;
}
function getexpense($dbc,$value){
  $expense =mysqli_query($dbc,"SELECT sum(voucher_amount) as total_amount FROM vouchers  WHERE voucher_group='expense_voucher' ".$value." ");
  if (mysqli_num_rows($expense)>0) {
    $r=mysqli_fetch_array($expense);
    return $total_expense=!empty($r['total_amount'])?abs($r['total_amount']):0;
  }else{
    return 0;
  }
}
function getOrders($dbc,$value,$type)
{
  @$total_sales=mysqli_query($dbc,"SELECT count(*) as total_order,sum(grand_total) as total_sales FROM orders ".$value." ");
                             
   if (mysqli_num_rows($total_sales)>0) {
    $r=mysqli_fetch_array($total_sales);
    if ($type=="order") {
      return $total_sales=!empty($r['total_order'])?abs($r['total_order']):0; 
      # code...
    }else{
      return $total_sales=!empty($r['total_sales'])?abs($r['total_sales']):0; 
    }
   
  }else{
    return 0;
  }
}
?>