 <?php

include_once "includes/header.php";



?>



<script type="text/javascript" src="assets/js/custom2.js"></script>



 <div class="page-content-wrapper">

                <div class="page-content">

                    <div class="page-bar">

                        <div class="page-title-breadcrumb">

                            <div class=" pull-left">

                                <div class="page-title">Payment Vouchers List</div>

                            </div>

                            <ol class="breadcrumb page-breadcrumb pull-right">

                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Leads</a>&nbsp;<i class="fa fa-angle-right"></i>

                                </li>

                                <li class="active">Leads Management</li>

                            </ol>

                        </div>

                    </div>

<div class="row">

                <div class="col-sm-12">

                <div class="card card-box">

                    <div class="card-head " >

                      <h4 class="text-center">Payment Vouchers List </h4></div>

                        <div class="card-body p-0">

                            
                          
                           <table class="table example1" width="100%" style="width: 100%;">

                            <thead>

                            <tr>

                               

                                <th>Payment ID</th>


                                <th>Customer Name</th>

                                <th>Exchange Rate</th>

                                 <th>Currency</th>

                                 <th>Sent Country </th>

                                <th>Total Amount Received</th>

                                <th>Voucher Type</th>

                                <th>Payment Time</th>
                                  <th>Action</th>
                                

                              

                         



                                

                                

                            </tr>

                            </thead>

                            <tbody>

                              <?php 

                              

     $q = mysqli_query($dbc,"SELECT  payment.*,customers.* FROM payment INNER JOIN customers WHERE customers.customer_id=payment.customer_name ORDER BY payment_id DESC");

    $x=1;

    while($r = mysqli_fetch_assoc($q)): ?>

          <tr>

           

            <td><a href="#" data-toggle="modal" onclick="getPaymentTrans(<?=$r['payment_id']?>)" data-target="#voucherDetails"><?=$r['vehicle_info']?></a> </td>


            <td><?=$r['customer_name']?></td>

            <td><?=$r['exchange_rate']?></td>

            <td><?=strtoupper($r['sender_currency'])?></td>

            <td><?=strtoupper($r['sender_country'])?></td>

            <td><?=$r['total_amount_recevied']?></td> 

            <td><?=$r['voucher_type']?></td> 

            <td><?=$r['receving_date']?></td> 
            <td>
             <!--  <a target="_blank" href="print_voucher.php?print_voucher=<?=$r['payment_id']?>" class="btn btn-sm btn-success m-2">Print</a> |
              <a target="_blank" href="refund.php?id=<?=$r['payment_id']?>" class="btn btn-sm btn-info m-2">Refund Request</a>
              <a target="_blank" href="img/vehicle_docs/<?=$r['bank_slip']?>" class="btn btn-sm btn-warning m-2">Document</a> -->
            <div class="btn-group btn-group-circle">
                    <button type="button" class="btn btn-default">Action</button>
                    <button type="button" class="btn btn-circle-right btn-default dropdown-toggle m-r-20" data-toggle="dropdown" aria-expanded="true">
                      <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu" style=" z-index: +2;" role="menu" x-placement="top-start">
                      <li><a href="#"><a target="_blank" href="print_voucher.php?print_voucher=<?=$r['payment_id']?>" class="btn btn-sm btn-success m-2">Print</a></a>
                      </li>
                      <li><a target="_blank" href="refund.php?id=<?=$r['payment_id']?>" class="btn btn-sm btn-info m-2">Refund Request</a></li>
                      <li><a target="_blank" href="img/vehicle_docs/<?=$r['bank_slip']?>" class="btn btn-sm btn-warning m-2">Document</a></li>
                      </li>
                      
                      
                    </ul>
                  </div>
            </td>

            



          </tr>

     <?php $x++; endwhile; ?>   

                            </tbody>

                          

                           

                           </table>









                        </div>

                    </div>

                </div><!-- col-sm-12 end -->

</div><!-- Row end -->              









 </div>

 </div>







<!-- Secind modal -->



<div class="modal fade" id="voucherDetails">

    <div class="modal-dialog modal-lg">

      <div class="modal-content">



  <!-- Modal Header -->

        <div class="modal-header">

          <h4 class="modal-title" >Payment Voucher <span id="modalfor2"></span></h4>

          <button type="button" class="close" data-dismiss="modal">&times;</button>

        </div>

        

        <!-- Modal body -->

        <div class="modal-body">

          

      

     

            <div class="row">

              <div class="col-12">

                <table class="table table-bordered">

                  <thead>

                    <tr>
                      <th>Stock ID#</th>
                       <th>Vehicle Info</th>

                      <th>Transaction From</th>

                    <th>Debit</th>

                    <th>Credit</th>

                    <th>Transaction Remarks</th>



                    </tr>                  </thead>

                  <tbody id="showTrans">

                    

                  </tbody>

                </table>

              </div>

              

            </div>

    </div>

    

 

        <!-- Modal footer -->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

        </div>

        

      </div>

    </div>

  </div>

  <!-- Modal second end -->



<?php

include_once "includes/footer.php";



?>        

<script type="text/javascript">

  

 

function getPaymentTrans(id){

   var transactionfetch = '';

   // console.log(id);

 $.ajax({

            url:'php_action/custom_action.php',

            type:'post',

            data:{action:'getPaymentTrans',voucher_id:id},

             dataType:'json',
            success:function (response) {
            $("#showTrans").html('');
              // var responseValue = JSON.parse($.trim(response));
               var x=1;
               console.log(response);
             $.each(response, function (index, value) {
                    transactionfetch += "<tr>\
                                            <td>"+value['vehicle_stock_id']+"</td>\
                                            <td>"+value['maker_name']+" "+value['brand_name']+"</td>\
                                            <td>"+value['transaction_from']+"</td>\
                                            <td>"+value['debit']+"</td>\
                                            <td>"+value['credit']+"</td>\
                                            <td>"+value['transaction_remarks']+"</td>\
                                          </tr>";

                                          x++;

                });

           //$('#showTrans').html(vehicle_infoTable);

               $("#showTrans").empty().append(transactionfetch);
              
      

            

            }

        });//ajax call

 $.ajax({

            url:'php_action/custom_action.php',

            type:'POST',

            data:{action:"getPaymentTransBalance",id:id},

              dataType:'text',
            success:function (res) {
               console.log(res);
              
           $("#showTrans").append(`<tr>\
                                    <th colspan='5'>Balance</th>\
                                    <td>`+res+`</td>\
                                    </tr>`);

            

            }

        });//ajax call

}

     



</script>