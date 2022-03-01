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
	<div class="panel-heading panel-heading-green"><?=ucfirst($_REQUEST['consignee_label'])?> List </div>
		<div class="panel-body">
			<div class="container">
        <table class="table table-hover data-table"  style="width: 100%">
          <thead>
            <tr>
              <th>Sr.</th>
              <th>Consignee Name</th>
              <th>Customer name</th>
              <th>Contact Person</th>
              <th>Country</th>
              <th>Contact</th>
              <th>Email </th>
              <th>Details</th>
            </tr>
          </thead>
          <tbody>
          <?php

           $getCustomers=getWhere($dbc,"consignee","consignee_type",$_REQUEST['consignee_label']);
          $c=1;
          while ($consignee=mysqli_fetch_assoc($getCustomers)):
            $customer=fetchRecord($dbc,"customers","customer_id",$consignee['customer_id']);

           ?>
            <tr>
              <td><?=$c?></td>
              <td><?=$consignee['consignee_name']?></td>
              <td><a href="details.php?type=customer&id=<?=$consignee['customer_id']?>"><?=$customer['customer_name']?></a></td>
              <td><?=$consignee['consignee_contact_person']?></td>
              <td><?=$consignee['consignee_country']?></td>
              <td><?=$consignee['consignee_mobile']?></td>
              <td><?=$consignee['consignee_email']?></td>
              <td><a href="details.php?type=<?=$_REQUEST['consignee_label']?>&id=<?=$consignee['consignee_id']?>" class="btn btn-sm btn-primary">Details</a></td>
            </tr>
          <?php $c++; endwhile; ?>
          </tbody>
        </table>
			</div>
		</div>
	</div>
</div>

<!-- /remove order-->
</div>


<?php include_once "includes/footer.php";?>
 
  
  
  
  
  
  
  
  
  

  