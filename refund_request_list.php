 <?php 
include_once "includes/header.php";
include_once "inc/code.php";

?>
<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
	           <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Refund Request Lists</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Refund Request List</li>
                            </ol>
                        </div>
                    </div>

<div class="col-sm-12">
		<div class="panel">
			<div class="msg"></div>
	<div class="panel-body">
			   <table id="example1" class="table table-bordered table-striped">

				<thead>
		<tr>	
				<th>Sr.No#</th>
				<th>Customer Name</th>
				<th>Request By</th>
				<th>Date</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		
			</thead>
			<tbody>
<?php $c=0; $getReq=mysqli_query($dbc,"SELECT * FROM  refund_requests ");
		while($fetchRequest=mysqli_fetch_assoc($getReq)):$c++;
	$customer=fetchRecord($dbc, "customers", "customer_id", $fetchRequest['customer_id']);
	$users=fetchRecord($dbc, "users", "user_id", $fetchRequest['user_id']);
	
	//bank b select kr l bank name aay?
	//aPmKA PHONE KIDR H ?Developer k pass wait lata ho.
	//hhaaha wo dekhy kia msg kr rha mjy phone ly  k call p ajaye m kch smjhana apko 

 ?>
		<tr><td><?=$c?></td>
			<td><?=$customer['customer_name']?></td>
			<td><?=$users['username']?> </td>
			<td><?=$fetchRequest['timestamp']?></td>
			<td><?=$fetchRequest['request_status']?></td>
			<td>
				<?php if ($fetchRequest['request_status']=="pending" AND @$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): ?>
			<!-- 		<a href="php_action/custom_action.php?action=rejectfund&id=<?=base64_encode($fetchRequest['request_id'])?>" class="btn-sm btn-danger"  title="Reject"><i  class="fa fa-times-circle"></i></a> |  -->

				<a href="refund_approved.php?id=<?=base64_encode($fetchRequest['request_id'])?>" title="Approve" class="btn-sm btn-success">More Details</a> |
				<?php endif ?>
				
			<button type="button" onclick='getRefundDetails(<?=$fetchRequest['request_id']?>)' class="btn btn-primary btn-sm" data-toggle="modal" data-target="#getrfunds_modal"> Details</button>
				<?php if ($fetchRequest['request_status']=="approved"): ?>
			<a href="print_refund.php?request_id=<?=base64_encode($fetchRequest['request_id'])?>" class="btn btn-primary" >Print</a>
			


				<?php endif ?>
				<a href="refund_docs.php?id=<?=$fetchRequest['request_id']?>" class="btn btn-success btn-sm"  onclick="setRequest_id(<?=$fetchRequest['request_id']?>)">Documents</a>
				




			</td>




		</tr>
			
				<?php endwhile; ?>
 			</tbody>
			
			
			</table>
		
	</div>
</div>

</div>
	</div></div>

<div class="modal fade" id="getrfunds_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" >
     <table class="table">
     	<tbody id="getrfunds_data">
     		
     	</tbody>
     </table>
    </div>
  </div>
</div>
<?php
include_once "includes/footer.php";
?>

