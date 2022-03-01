<!DOCTYPE html>

<html lang="en">

	<head>

		<meta charset="utf-8">

		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Refund Voucher</title>



		<!-- Bootstrap CSS -->

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

		<style >

			*{

				box-sizing: border-box;

			}

			@media print{



        .div{

        	

        	background-color:  #21618C !important;

        

        

			}

			.div span{

        	    color: rgb(252, 252, 252 ) !important;

       }

       .div p{

        	    color: rgb(252, 252, 252 ) !important;

       }

       .column1{

             	background-color: #D6EAF8 !important;

             }

            .table thead{

             background-color:  #21618C !important;

            } 

        }

       .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th ,.b-none {

  border-top: none;

}

.b-1{border: 1px solid black;

}



.row1{

	background-color: #D6EAF8 !important;

	height: auto;

} 



        .column1 {

  float: left;

  width: 50%;

   height: auto;

   padding: 20px;

}

.row1:after {

  content: "";

  display: table;

  clear: both;

}





@media screen and (max-width: 600px) {

  .column1 {

    width: 100%;

  }

}





.column2 {

  float: left;

  width: 70%;

 

  height: auto; /* Should be removed. Only for demonstration */

}

.column3 {

  float: left;

  width: 30%;

  padding: 10px;

  margin-top:50px; 

  height:auto; /* Should be removed. Only for demonstration */

}



/* Clear floats after the columns */

.row2:after {

  content: "";

  display: table;

  clear: both;

}

.border_none{

  border-top: none;

}



/* Responsive layout - makes the two columns stack on top of each other instead of next to each other */

@media screen and (max-width: 600px) {

  .column {

    width: 100%;

  }

}

</style>



</head>

	<body>

    <?php 

      require_once 'php_action/db_connect.php';

      require_once 'inc/functions.php';

       $refund=fetchRecord($dbc,"refund_requests",'request_id',base64_decode($_GET['request_id']));
$customer=fetchRecord($dbc, "customers", "customer_id", $refund['customer_id']);
$bank=fetchRecord($dbc, "customers", "customer_id", $refund['admin_bank']);
$users=fetchRecord($dbc, "users", "user_id", $refund['user_id']);


      // "<pre>".print_r($fetchInvoice)."</pre>";

    ?>

		<div class="container">

			<div class="row">
        <div class="col-sm-3">
          <img src="img/logo.png" width="90" height="90" class="img-fluid float-right">
        </div>
        <div class="col-sm-8 mt-3">
          <h2 style="color: red;font-weight: bold;">NEXCO JAPAN LTD CO</h2>
          <p style="float: none;font-weight: bold;">358-2 Kamishizuhara, Sakura City, Chiba Prefecture, Japan, 285-0844</p>
          <p style="margin-left: -15%;font-weight: bold;margin-top: -10px;">Tel: +81-43-312-1411 Fax: +81-43-312-1412 E-mail: info@nexcojapan.com Web: www.nexcojapan.com</p>
  

          
        </div>
        <center style="width: 100%;margin-top: -5px;"><p style="font-weight: bold;">
        Refund Voucher</p></center>
                <div style="width: 100%;padding:2px;background-color:  #21618C " class="div"></div>
      </div>

			<div class="row">
              <table class="table table-bordered">
                <tr>
                  <th>Customer</th><td><?=$customer['customer_name']?></td>
                  <th>Refund Request By</th><td><?=$users['username']?></td>
                </tr>
                <tr>
                  <th>Bank</th><td><?=$bank['customer_company']?></td>
                  <th>Transaction ID</th><td><?=$refund['transaction_id']?></td>
                </tr>
                <tr>
                  <th>Amount </th><td><?=$refund['receiving_amount']?>-<?=$refund['receiving_amount_currency']?></td>
                  
                </tr>
                <tr>
                  <hr>
                  <th colspan="4">

                    Customer Details
                  </th>
                </tr>
                <tr>
                  <th>Bank Name</th><td><?=$refund['bank_name']?></td>
                  <th>Branch Name</th><td><?=$refund['branch_name']?></td>
                </tr>
                <tr>
                  <th>Bank city</th><td><?=$refund['branch_city']?></td>
                  <th>Title of Account</th><td><?=$refund['title_of_account']?></td>
                </tr>
                <tr>
                  <th>Bank Account Number</th><td><?=$refund['bank_account_no']?></td>
                  <th>Swift Code</th><td><?=$refund['swift_code']?></td>
                </tr>
                <tr>
                  <th>Bank Address</th><td colspan="3"> <?=$refund['bank_address']?></td>
                   </tr>
                    <tr>
                  <th>Account Holder Address</th><td colspan="3"><?=$refund['account_holder_address']?></td>
                </tr>
                <tr>
                  <th>Reason of Refund</th><td colspan="3"><?=$refund['refund_reason']?></td>
                </tr>
                
                <tr>
                  <th>Note</th><td colspan="3"><?=$refund['note']?></td>
                </tr>
              </table>   
      </div>

				<div class="row">

				<div class="col-sm-12" style="margin-top:5px"></div>

			</div>









<div cass="row">

	<div class="col-sm-12">

		<h5 style="text-align: center">NEXCO JAPAN LTD CO</h5>

		<p style="text-align: center;color: black">Should you have any enquiries concerning this invoice, please contact</p>

	</div>

</div>





<!-- <div cass="row">

	<div class="col-sm-12">

		<div class="div" style="background-color:#21618C;color: white;width:100%;text-align: center;padding: 2px ">

			<p>358-2 Kamishizuhara, sukara city, chiba prefecture, japan 285-0844</p>

			<p>Tel +81-43-312-1411 FAX: +81-43-312-1412 EMAIL: info@nexcojapan.com Web: www..nexcojapan.com</p>

		</div>

	</div>

</div> -->

		</div>







		<!-- jQuery -->

		<script src="https://code.jquery.com/jquery.js"></script>

		<!-- Bootstrap JavaScript -->

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->

 		<script src="Hello World"></script>

	</body>

</html>