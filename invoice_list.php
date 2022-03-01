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
                                <div class="page-title">Invoice List</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Invoice List</li>
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
				<th>ID</th>
				<th>Customer Name</th>
				<th>Vehicle Name</th>
				<th>Date</th>
				<th>Bank</th>
				<th></th>
			</tr>
		
			</thead>
			<tbody>
<?php $c=0; $getQuation=mysqli_query($dbc,"SELECT * FROM  invoice WHERE invoice_quotation='invoice'");
		while($fetchQuation=mysqli_fetch_assoc($getQuation)):$c++;
	$vehicle=fetchRecord($dbc, "vehicle_info", "vehicle_id", $fetchQuation['invoice_vehicle']);
	$brand=fetchRecord($dbc, "brands", "brand_id", $vehicle['vehicle_brand']);
	$maker=fetchRecord($dbc, "maker", "maker_id", $vehicle['vehicle_maker']);
	$customer=fetchRecord($dbc, "customers", "customer_id", $fetchQuation['invoice_customer']);
	$bank=fetchRecord($dbc, "customers", "customer_id", $fetchQuation['invoice_bank']);

	//bank b select kr l bank name aay?
	//aPmKA PHONE KIDR H ?Developer k pass wait lata ho.
	//hhaaha wo dekhy kia msg kr rha mjy phone ly  k call p ajaye m kch smjhana apko 

 ?>
		<tr><td><?=$c?></td>
			<td><?=$customer['customer_name']?></td>
			<td><?=$maker['maker_name']?> <?=$brand['brand_name']?></td>
			<td><?=$fetchQuation['invoice_date']?></td>
			<td><?=$bank['customer_company']?></td>
			<input type="hidden" name="invoice_id" >
			<td>
				 <?php if (@$userPrivileges['nav_delete']==1 || $fetchedUserRole=="admin"): ?>
				 	<button type="button" class="btn-sm btn-danger" onclick='deleteQuotationByid(<?=$fetchQuation["invoice_id"]?>);'>Delete</button> | 
				 		<?php endif ?>
				 					 <?php if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): ?>
				<a href="sale_invoices.php?o=add&edit_quotation_id=<?=$fetchQuation['invoice_id']?>" class="btn-sm btn-success">Edit</a> |
					<?php endif ?>
				<a href="print_invoice.php?invoice_id=<?=$fetchQuation['invoice_id']?>&transaction_id=invoice" class="btn-sm btn-primary"><i class="fa fa-print mr-1"></i>Print</a> 
				<!-- <a href="services_form.php?invoice=<?=base64_encode($fetchQuation['invoice_id'])?>&transaction_id=invoice" class="btn-sm btn-info "><i class="fa fa-plus mr-1"></i>Services</a>
 -->


			</td>




		</tr>
			
				<?php endwhile; ?>
 			</tbody>
			
			
			</table>
		
	</div>
</div>

</div>
	</div></div>

<script>
  
   
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });


 
    function deleteQuotationByid(delete_id){

   $.ajax({
        url:"php_action/custom_action.php",
        type: "POST",
        data: {
          action:"quotation",
          delete_id:delete_id,   
        },
        cache: false,
        success: function(response){
         
          $(".msg").addClass("alert alert-success").text(response).fadeIn(3000).fadeOut(4000);
         $("#example1").load(location.href+" #example1");
           console.log(response);

        }
      });
}
</script>
<?php
include_once "includes/footer.php";
?>