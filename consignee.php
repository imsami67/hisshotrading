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

                                <div class="page-title"><?=ucwords(str_replace("_", " ", $_REQUEST['consignee_label']))?></div>

                            </div>

                            <ol class="breadcrumb page-breadcrumb pull-right">

                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>

                                </li>

                                <li class="active"><?=ucwords(str_replace("_", " ", $_REQUEST['consignee_label']))?></li>

                            </ol>

                        </div>

                    </div>



			<div class="col-sm-12">

				<div class="panel">

					<div class="panel-heading panel-heading-red" align="center"><h4>Create <?=ucwords(str_replace("_", " ", $_REQUEST['consignee_label']))?></h4></div>

						<div class="panel-body">

							<form action="php_action/custom_action.php" method="POST" role="form" id="formData">

								<div class="msg"></div>

								<div class="row" >

									<div class="col-sm-4">

											<div class="form-group row" id="RefreshMine">

											<div class="col-sm-9">

											<label for="">Assign Customer</label>

											<select class="form-control" id="customer_id" name="customer_id"> 

												<option value="">~~SELECT~~</option>

												<?php 

													$q = get($dbc,"customers WHERE customer_role = 'customer'");

													while ($r = mysqli_fetch_assoc($q)):?>

														<option value="<?=$r['customer_id']?>"><?=$r['customer_name']?></option>

													<?php endwhile ?>

											</select>

										</div>

										<div class="col-sm-3 mt-4">

											<a href="customers.php?type=customer" target="_blank" class=" btn-primary btn-sm mt-3"><span class="fa fa-plus"></span></a>

											<button type="button" class=" btn-info btn-sm" onclick="refresh_select(`customer_id`,`customer_id`,`customer_name`,``,``)"><span class="fa fa-refresh" ></span></button>

										</div>

										</div>

										<div class="form-group">

											<label for=""><?=ucwords(str_replace("_", " ", $_REQUEST['consignee_label']))?> Name</label>

											<input type="text" class="form-control" required id="consignee_name" name="consignee_name_sep"> 

											<input type="text" class="form-control d-none" id="consignee_id" name="consignee_id"> 

										</div>

								

									

										<div class="form-group">

											<label for="">CONTACT PERSON</label>

											<input type="text" required class="form-control" id="consignee_contact_person" name="consignee_contact_person"> 

										</div>

										<div class="form-group">

											<label for="">COUNTRY</label>

											 <?=countrySelector("", "consignee_country", "consignee_country", "form-control customer_country") ?> 
										<!-- 	<select name="consignee_country" class="country_name form-control" id="consignee_country">

				    					 <option>Select Country</option>

			                                <?php

						                    	$sql = mysqli_query($dbc,"SELECT * FROM country_regulation GROUP BY country_regulation_country");

						                    	while($countries=mysqli_fetch_assoc($sql)):

						                    ?>

			                                <option <?=(@$fetchQuationData['invoice_country']==$countries['country_regulation_country'])?"selected":""?> value="<?=$countries['country_regulation_country']?>"><?=$countries['country_regulation_country']?></option>

			                                <?php

			                              endwhile;

			                                ?>

				    		

				    	</select> -->

										</div>

										<div class="form-group">

											<label for="">STATE</label>

											<input type="text" class="form-control" id="consignee_state" name="consignee_state"> 

										</div>

										<div class="form-group">

											<label for="">CITY</label>

											<input type="text" class="form-control" id="consignee_city" name="consignee_city"> 

										</div>

									</div><!-- col -->

									<div class="col-sm-4">

										<div class="form-group">

											<label for="">SUBURB (Optional)</label>

											<input type="text" class="form-control" id="consignee_suburb" name="consignee_suburb"> 

										</div>

										<div class="form-group">

											<label for="">STREET / ROAD (Optional)</label>

											<input type="text" class="form-control" id="consignee_street" name="consignee_street"> 

										</div>

										<div class="form-group">

											<label for="">FLOOR / BUILDING Name</label>

											<input type="text" class="form-control" id="consignee_floor" name="consignee_floor"> 

										</div>

										<div class="form-group">

											<label for="">ZIP/POSTAL CODE</label>

											<input type="text" required class="form-control" id="consignee_zip" name="consignee_zip"> 

										</div>

										<div class="form-group">

											<label for="">OTHER ADDRESS INFO</label>

											<input type="text" class="form-control" id="consignee_address" name="consignee_address"> 

										</div>

										<div class="form-group">

											<label for="">WEBSITTE(Optional)</label>

											<input type="text" class="form-control" id="consignee_website" name="consignee_website"> 

										</div>

										<div class="form-group">

											<label for="">LANDLINE NO</label>

											<input type="text" class="form-control" id="consignee_landline" name="consignee_landline"> 

										</div>

									</div><!-- col -->

									<div class="col-sm-4">

										<div class="form-group">

											<label for="">MOBILE NO</label>

											<input type="text" required class="form-control" id="consignee_mobile" name="consignee_mobile"> 

										</div>

										<div class="form-group">

											<label for="">FAX NO</label>

											<input type="text" class="form-control" id="consignee_fax" name="consignee_fax"> 

										</div>

										<div class="form-group">

											<label for="">EMAIL ADDRESS</label>

											<input type="email" required class="form-control" id="consignee_email" name="consignee_email"> 

										</div>

										<div class="form-group">

											<label for="">DESTINATION PORT</label>

										<!-- 	<input type="text" class="form-control" id="consignee_dest_port" name="consignee_dest_port"> -->
									<select class="form-control" id="consignee_dest_port" name="consignee_dest_port" required>
										 	<option>Select Country First</option>
										 	<?php 	$sql = mysqli_query($dbc,"SELECT * FROM country_regulation GROUP BY country_regulation_country");

						                    	while($countries=mysqli_fetch_assoc($sql)):

						                    ?>

			                                <option  value="<?=$countries['country_regulation_destination_port']?>"><?=$countries['country_regulation_destination_port']?></option>

			                                <?php

			                              endwhile;

			                                ?>

												

											</select>

										</div>

										<div class="form-group">

											<label for="">FINAL DESTINATION</label>

											<input type="text" class="form-control" id="consignee_final_dest" name="consignee_final_dest"> 

										</div>

											<div class="form-group">

											<label for="">Consignee Status</label>

											<select class="form-control" id="consignee_sts" required name="consignee_sts"> 

												<option value="">~~SELECT~~</option>

												<option value="1">Active</option>

												<option value="0">Inactive</option>

											</select>

										</div>

										<div class="form-group">

											<label for="">Page Label</label>

											<input type="text" readonly="readonly" class="form-control" id="consignee_label" value="<?=@ucwords($_GET['consignee_label'])?>" name="consignee_label"> 

										</div>

									</div><!-- col -->

								</div><!-- row -->

							<?php if (@$userPrivileges['nav_add']==1 || $fetchedUserRole=="admin"): ?>

								<button type="submit" class="btn btn-primary" class="saveData">Save</button>
<?php endif ?>
							</form>

							</div>

						</div>

					</div>





<div class="col-sm-12">

		<div class="panel">

	<div class="panel-heading cyan-bgcolor" align="center"><h4>Consignee</h4></div>

	<div class="panel-body">

			<table class="table" id="consignee">

				<thead>

			<tr>	

				<th>ID</th>

				<th>Consignee</th>

				<th>Type</th>

				<th>Status</th>

				<th>Action</th>

			</tr>

			</thead>

			<tbody>

			</tbody>

			

			

			</table>

		

	</div>

</div>



</div>

	</div></div>

<?php

include_once "includes/footer.php";

?>
<script type="text/javascript">
	
	$( document ).ready(function() {
		  
		setTimeout(function(){ 
			var consignee_label =$('#consignee_label').val();
			$('input[type="search"]').trigger('keyup');
			$('input[type="search"]').val(consignee_label);
			$('input[type="search"]').trigger('change');
			$('input[type="search"]').trigger('keyup');

		 }, 3000);
   
});
</script>