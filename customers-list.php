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
            <div class="page-content-wrapper">
                <div class="page-content">
<div class="success-messages"></div> 
<div class="panel">
	<div class="panel-heading panel-heading-green">Customer List </div>
		<div class="panel-body">
			<div class="container">
        <?php if ($_GET['type']=="customer"): ?>
          
       
        <table class="table table-hover data-table"  style="width: 100%">
          <thead>
            <tr>
              <th>Sr.</th>
              <th>Sales</th>
              <th>Company name</th>
              <th>Contact Person</th>
              <th>Country</th>
              <th>Contact</th>
              <th>Email </th>
              <th>Details</th>
            </tr>
          </thead>
          <tbody>
          <?php

           $getCustomers=getWhere($dbc,"customers","customer_role",$_GET['type']);
          $c=1;
          while ($customers=mysqli_fetch_assoc($getCustomers)): ?>
            <tr>
              <td><?=$c?></td>
              <td><?=countWhen($dbc,"invoice","invoice_customer",$customers['customer_id']);?></td>
              <td><?=$customers['customer_company']?></td>
              <td><?=$customers['customer_name']?></td>
              <td><?=$customers['customer_country']?></td>
              <td><?=$customers['customer_phone2']?></td>
              <td><?=$customers['customer_email2']?></td>
              <td><a href="details.php?type=<?=$_GET['type']?>&id=<?=$customers['customer_id']?>" class="btn btn-sm btn-primary">Details</a>
                <a target="_blank" href="customer_banks.php?id=<?=$customers['customer_id']?>" class="btn btn-sm btn-success">Customer Banks</a>
              </td>
              
            </tr>
          <?php $c++; endwhile; ?>
          </tbody>
        </table>
         <?php endif ?>
                 <?php if ($_GET['type']=="bank"): ?>
          
       
        <table class="table table-hover data-table"  style="width: 100%">
          <thead>
            <tr>
              <th>Sr.</th>
              <th>Name of Bank</th>
              <th>Beneficiary Name</th>
              <th>Branch Name</th>
              <th>Account No</th>
              <th>Swift Code</th>
              <th>Acceptable Currency</th>
              <th>Details</th>
            </tr>
          </thead>
          <tbody>
          <?php

           $getCustomers=getWhere($dbc,"customers","customer_role",$_GET['type']);
          $c=1;
          while ($r=mysqli_fetch_assoc($getCustomers)): ?>
            <tr>
              <td><?=$c?></td>
              <td><?=@$r['customer_company']?></td>
              <td><?=$r['customer_email']?></td>
              <td><?=$r['customer_city']?></td>
              <td><?=$r['customer_name']?></td>
              <td><?=$r['customer_contact_person']?></td>
              <td><?=$r['customer_country']?></td>
              <td><a href="details.php?type=<?=$_GET['type']?>&id=<?=$r['customer_id']?>" class="btn btn-sm btn-primary">Details</a></td>
            </tr>
          <?php $c++; endwhile; ?>
          </tbody>
        </table>
         <?php endif ?>
			</div>
		</div>
	</div>
</div>

<!-- /remove order-->
</div>


<?php include_once "includes/footer.php";?>
 
  
  
  
  
  
  
  
  
  

  