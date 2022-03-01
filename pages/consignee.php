
    <?php  @$id = $_GET['vehicle_id']; ?>
     <?php
 $checkShipQ=mysqli_query($dbc,"SELECT * FROM invoice WHERE invoice_vehicle = '$id' AND invoice_quotation='invoice'");
 if (mysqli_num_rows($checkShipQ)>0) {
    $checkShip=mysqli_fetch_assoc($checkShipQ);
      @$customer_Det = fetchRecord($dbc,"customers","customer_id",$checkShip['invoice_customer']);
      @$consignee_Det = fetchRecord($dbc,"consignee","consignee_id",$checkShip['consignee_id']);

  if ($checkShip['invoice_type']=="general_invoice" AND $checkShip['invoice_due_amount']==0) {
    $formSet="";
    $msgSet='d-none';
  }elseif ($checkShip['invoice_type']=="credit_invoice") {
    $formSet="";
    $msgSet='d-none';
  }else{
    $formSet='d-none';
    $msgSet='';
  }
 }else{
      $formSet='d-none';
      $msgSet='';
 }

 ?>


<div class="row">
	<div  class="col-12"> 
		<button type="button" onclick="refreshForm('consignee',<?=@$id?>)" class="btn btn-sm btn-primary float-right mb-2">Refresh</button>
	</div>
</div>
<div class="row"  class="">
  <div class="col-sm-12 ">
    <h3 class="<?=$msgSet;?>">Payment Has been not Cleared</h3>
  </div>
</div>

<form action="php_action/custom_action.php" method="POST" role="form" id="formData6" class="<?=$formSet;?>">

	<?php include 'consignee_new.php'; ?>




<div class="row">
			<div class="col-12">
				<input type="hidden" name="formData6_type"  value="">

				<button type="submit" class="btn btn-warning float-right ml-3" id="formData6_next" onclick="submitForm('formData6','next')" >Save and Next</button>
				<button type="submit" class="btn btn-primary float-right ml-3"   id="formData6_save" onclick="submitForm('formData6','save')" >Save</button>
			</div>
	</div>

</form>



<br>





<table class="table table-hover table-sm table-bordered <?=$formSet;?>">

	<thead>

		<tr>
			<th>Type</th>
			<th>Name</th>
			 <th>Phone No.</th>

			<th >Email</th>

			<th>Contact Person</th>
			<th>Company</th>
			<th>Country</th>
			<th>Port</th>
			<th>Action</th>

		</tr>

	</thead>

	<tbody id="consignee_info_table">
			<?php 
		 	
		 		$consignee_info= mysqli_fetch_assoc(mysqli_query($dbc,"SELECT consignee_info.*, customers.*,consignee.*  FROM consignee_info INNER JOIN customers ON customers.customer_id = consignee_info.consignee_info_customer INNER JOIN consignee ON consignee.consignee_id = consignee_info.consignee_info_consignee  WHERE consignee_info.vehicle_id = $id")); 


 ?>						 <tr>
                              <th>Customer</th>
                              <td><?=@$consignee_info['customer_name']?></td>
                                <td><?=@$consignee_info['customer_phone']?></td>
                              
                              <td><?=@$consignee_info['customer_email']?></td>
                              
                              <td><?=@$consignee_info['customer_contact_person']?></td>
                              <td><?=@$consignee_info['customer_company']?></td>
                              <td><?=@$consignee_info['customer_country']?></td>
                              <td><?=@$consignee_info['customer_designation']?></td>
                               <td><a target="_blank" href="details.php?type=customer&id=<?=$consignee_info['customer_id']?>" class="btn btn-sm btn-primary">Details</a></td>
                            </tr>
       						<tr>
                             <th>Consignee</th>
                              <td><?=@$consignee_info['consignee_name']?></td>
                             
                              <td><?=@$consignee_info['consignee_mobile']?></td>
                           
                              <td><?=@$consignee_info['consignee_email']?></td>
                           
                              <td><?=@$consignee_info['consignee_contact_person']?></td>
                              <td><?=@$consignee_info['consignee_company']?></td>
                               <td><?=@$consignee_info['consignee_country']?></td>
                              <td><?=@$consignee_info['consignee_dest_port']?></td>
                              <td><a target="_blank" href="details.php?type=consignee&id=<?=$consignee_info['consignee_id']?>" class="btn btn-sm btn-primary">Details</a></td>
                            </tr>
                           <?php if (@$consignee_info['consignee_info_type']=="notify_party"):
                           		$notify_party=fetchRecord($dbc,"consignee",'consignee_id',$consignee_info['consignee_info_party_name']);
                            ?>
                           	
                          
                          	<tr>
                             <th>Notify Type</th>
                              <td><?=@$notify_party['consignee_name']?></td>
                             
                              <td><?=@$notify_party['consignee_phone']?></td>
                           
                              <td><?=@$notify_party['consignee_email']?></td>
                           
                              <td><?=@$notify_party['consignee_contact_person']?></td>
                              <td><?=@$notify_party['consignee_company']?></td>
                                 <td><?=@$notify_party['consignee_country']?></td>
                              <td><?=@$notify_party['consignee_dest_port']?></td>
                               <td><a target="_blank" href="details.php?type=notify_party&id=<?=$notify_party['consignee_id']?>" class="btn btn-sm btn-primary">Details</a></td>
                            
                           
                            </tr>
                            <tr>
                          <td colspan="8"></td>
                              
                             <td colspan="col">
                             	<span class="text-danger" onclick="editConsignee(<?=@$consignee_info['consignee_info_id']?>)">Edit</span> | <span class="text-danger" onclick="deleteConsignee(<?=@$consignee_info['consignee_info_id']?>)">Delete</span></td>
                            </td>
                           		
                            </tr>
                         <?php endif ?>
	</tbody>

</table>	