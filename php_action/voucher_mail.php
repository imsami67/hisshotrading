<?php 
if (isset($_REQUEST['mail_voucher'])):
	# code...
include 'db_connect.php';
include '../inc/functions.php';
$q=mysqli_query($dbc,"SELECT * FROM payment WHERE payment_id = '$_REQUEST[mail_voucher]'");
				$r=mysqli_fetch_assoc($q);
					$fetchCustomer=fetchRecord($dbc,"customers",'customer_id',$r['customer_name']);
					$bank=fetchRecord($dbc,"customers",'customer_id',$r['receving_bank']);

$body= '<!DOCTYPE html>

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

        <th colspan="4" align="center"><h3>REMITTER</h3></th>

      </tr>



      <tr>

        <td  align="left"  width="93px">CUSTOMER NAME</td>

        <td width="93px">'.$fetchCustomer['customer_name'].'</td>

   

        <td width="93px">

          COUNTRY:

        </td>
<td width="93px">'.@$r['sender_country'].'</td>
       


      </tr>

      <tr>

        <td  align="left"  width="93px">AMOUNT REMITTED</td>

         <td width="93px">'.@$r['total_sender_amount'].'</td><!-- input -->




        <td width="93px">CURRENCY</td>

        <td width="93px">'.@$r['sender_currency'].'</td>



      </tr>

      <tr>

        <td  align="left"  width="93px">REFERENCE #</td>

         <td width="93px">'.@$r['receiver_reference'].'</td><!-- input -->




        <td width="93px">PAYMENT PURPOSE</td>

        <td width="93px">'.@$r['purpose'].'</td>



      </tr>

      <tr>

        <td  align="left"  width="93px">REMITTER BANK NAME</td>

         <td width="93px">'.@$r['sender_bank_name'].'</td><!-- input -->
        <td width="93px">BRANCH NAME</td>

        <td width="93px">'.@$r['sender_branch_name'].'</td>



      </tr>
       <tr>

        <td  align="left"  width="93px">BRANCH CODE</td>

         <td width="93px">'.@$r['sender_branch_code'].'</td><!-- input -->
        <td width="93px">SWIFT CODE / IBAN#</td>

        <td width="93px">'.@$r['sender_swift_code'].'</td>
      </tr>
        <tr>
            <td width="93px">ACCOUNT #</td><td width="93px">
              '.$r['sender_account'].'</td> 
            <td width="93px">ACCOUNT TITLE</td>
            <td width="93px">'.$r['sender_account_title'].'</td>
          </tr>
          <tr>
            <td width="93px">BANK PHONE #</td>
            <td width="93px">'.$r['sender_bank_phone'].'</td> 
            <td width="93px">ACCOUNT ADDRESS</td>
            <td width="93px">'.$r['sender_account_address'].'</td>
          </tr>

     <!--  <tr>

        <th colspan="4" align="center"><h3>Risku Information</h3></th>

      </tr> -->

      

    </table>

    



    

  </body>

</html>';

$headers = "MIME-Version: 1.0\r\n";



$headers = "Content-type: text/html; charset=ISO-8859-1";



if (mail($_REQUEST['mail_to'],"test",$body,$headers)) {

    echo "Email successfully sent to $to_email... ";

} else {

    echo "Email sending failed...";



}
endif;
 ?>