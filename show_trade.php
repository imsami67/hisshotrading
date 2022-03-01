<?php include_once "includes/header.php";?>

<!-- start page content -->

<style> 

  .view{

    cursor: pointer;

  }

  .view:hove{

    border-bottom: 1px solid blue;

  }

  .edit{

    cursor: pointer;

  }

</style>




<div class="card card-box">

  <div class=" card-header card-bg rounded-0" style="color: white"><h4 class="font-weight-bold text-white text-center">View Trade</h4> </div>

    <div class="card-body">

      <div class="container">

        <table class="table table-hover table-inverse table-responsive" id="example4" >

          <thead>

            <tr>

              <th>Sr.</th>

              <th style="width: 20%!important">Vehicle</th>

              <th>Full Detail</th>

              <th>Sold Status</th>

             

              <th>Action</th>

            </tr>

          </thead>

          <tbody>

            <?php

            $x = 1; 

            $q = get($dbc,"vehicle_info");

            while ($r = mysqli_fetch_assoc($q)):

            ?>

            <tr>

              <td><?=$x?></td>

              <td> 
<?php if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): ?>
                <a style="color: black;" href="trade.php?vehicle_id=<?=$r['vehicle_id']?>">
                <?php endif ?>

                <br>

                Brand Name : <?=fetchRecord($dbc, "brands", "brand_id", $r['vehicle_brand'])['brand_name']?> <br>

                Stock ID : <?=$r['vehicle_stock_id']?> <br>

                Chassis No : <?=$r['vehicle_chassis_no']?> <br>

                Engine No : <?=$r['vehicle_engine_no']?><br>
<?php if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): ?>

                </a>
     <?php endif ?>
              </td>

              <td style="font-style: 11px!important">
                <button onclick="loadData('vehicle_info', <?=$r['vehicle_id']?>)" class="dropdown-item text-success view">Vehicle Info</button>
              </td>




              <td>

<?php

$in = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM invoice WHERE invoice_quotation != 'quotation' AND invoice_vehicle = '$r[vehicle_id]'"));

 $get_trans=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT SUM(credit-debit) as nowbalance,SUM(credit) as paidamount  ,invoice_id,customer_id,vehicle_id  FROM transactions WHERE vehicle_id = '$r[vehicle_id]'  GROUP BY vehicle_id"));

//echo "SELECT * FROM invoice WHERE invoice_quotation != 'quotation' AND invoice_vehicle = '$r[vehicle_id]'";

if(@$get_trans['nowbalance'] ){

  ?>

  <span class="badge badge-success">Sold</span><br/>

   <span class="badge" >Sold Amount : <?=$in['invoice_grand_total']?></span><br>

   <span class="badge" >Received Amount : <?=$get_trans['paidamount']?></span><br>

   <span class="badge" >Remaining Amount :  <?=$in['invoice_grand_total'] - $get_trans['paidamount']?></span><br>

  <?php

}else{

?>

<span class="badge badge-danger">Not Sold</span>

<?php

}

?>



                 

              </td>





            



              <td align="center">

                 <a href="paidexp.php?vehicle_id=<?=$r['vehicle_id']?>" class="btn themebg mb-1">

                    <span class="fa fa-plus-circle text-white"></span>

                  </a>

                <div class="dropdown">

                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                    Action

                  </button>

                  <div class="dropdown-menu" aria-labelledby="dropdownMenu3">

                    <a href="trade.php?vehicle_id=<?=$r['vehicle_id']?>" class="dropdown-item"><i class="fa fa-pencil-square-o"></i> Edit</a>

                    <a href="vehicle_expense.php?vehicle_id=<?=$r['vehicle_id']?>" class="dropdown-item"><i class="fa fa-warning"></i> Additional Expense</a>

                    <a href="vehicle_docs.php?vehicle_id=<?=$r['vehicle_id']?>" class="dropdown-item"><i class="fa fa-plus-circle"></i> Add Documents</a>

                    <a href="vehicle_services.php?vehicle_id=<?=$r['vehicle_id']?>" class="dropdown-item"><i class="fa fa-tasks"></i> Add Services</a>

                    <a href="vehicle_expense_print.php?vehicle_id=<?=$r['vehicle_id']?>" class="dropdown-item"><i class="fa fa-print"></i>Additional Expense list</a>

                    <a href="crystal_report.php?v_id=<?=$r['vehicle_id']?>" class="dropdown-item"><i class="fa fa-print"></i>Crystal Report</a>

                  </div>

                </div>

              </td>

            </tr>

            <?php 

              $x++;

              endwhile; 

            ?>

          </tbody>

        </table>

      </div>

    </div>

  </div>




<!-- <a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Trigger modal</a> -->

<div class="modal fade" id="modal-id">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <div class="modal-header">

        <h4 class="modal-title"></h4>

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

      </div>

      <div class="modal-body" id="loadData">

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>

    </div>

  </div>

</div>

<?php include_once "includes/footer.php";?>

 

  

  

  

  

  

  

  

  

  



  