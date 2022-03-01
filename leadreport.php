<?php
include_once "includes/links.php";

$customer_id = $_GET['customer_id'];

$customerinfo =mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM leads_customer WHERE leads_cus_id = '$customer_id'"));

$leads= mysqli_query($dbc,"SELECT * FROM leads WHERE customer_id = '$customer_id'");


?>

<div class="container"  >
	<table class="table " style="width: 100%">
		<tr>
			<th>Customer Name(Company)</th>
			<th>Csutomer Phone</th>
			<th>Address,City</th>
			<th>Emails</th>
			<th>Added By</th>
			<th>Assign To</th>
		</tr>

		<tr>
			<td><?=$customerinfo['customer_name']?>(<?=$customerinfo['company_name']?>)</td>
			<td>
				<a href="tel:<?=$customerinfo['contact1']?>"><?=$customerinfo['contact1']?></a><br/>
				<a href="tel:<?=$customerinfo['contact2']?>"><?=$customerinfo['contact2']?></a><br/>

				
			<td><?=$customerinfo['street']?>-<?=$customerinfo['country']?></td>
			<td>
				<a href="mailto:<?=$customerinfo['email']?>"><?=$customerinfo['email']?></a><br/>
				<a href="mailto:<?=$customerinfo['email2']?>"><?=$customerinfo['email2']?></a>

			</td>
			<td>
				<?php
				$q = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM users WHERE user_id = '$customerinfo[user_id]'"));
				?>
				<span class="label label-info uppercase" style="font-size: 15px" ><?=$q['username']?>(<?=$q['user_role']?>)</span><br><br/>
				<a href="mailto:<?=$q['email']?>" class="label label-success" style="font-size: 15px"><?=$q['email']?></a><br><br/>
				<a href="tell:<?=$q['phone']?>" class="label label-success" style="font-size: 15px"><?=$q['phone']?></a>
					
				</td>
			<td>
				<td>
				<?php
				$q = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM users WHERE user_id = '$customerinfo[assign_to]'"));
				?>
				<span class="label label-info uppercase" style="font-size: 15px" ><?=$q['username']?>(<?=$q['user_role']?>)</span><br><br/>
				<a href="mailto:<?=$q['email']?>" class="label label-success" style="font-size: 15px"><?=$q['email']?></a><br><br/>
				<a href="tell:<?=$q['phone']?>" class="label label-success" style="font-size: 15px"><?=$q['phone']?></a>
					
				</td>
			</td>
		</tr>
		
	</table>

	<?php
	$leads = mysqli_query($dbc,"SELECT * FROM leads WHERE customer_id = '$customer_id '");
	$x = 1;
	while($r = mysqli_fetch_assoc($leads)):
		
$users = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM users WHERE user_id = '$r[user_id]'"));
  	$maker = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM maker WHERE maker_id = '$r[maker_id]'"));
  	$brand = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM brands WHERE brand_id = '$r[brand_id]'"));
	?>
	<h4 class="label label-success">Leads No :<?=$x?></h4><br/>
	 <div class="row mt-3" style="font-size: 20px" >
            	<div class="col-sm-6">
            		<span>
            			Maker : <?=$maker['maker_name']?> <br/>
            			Years :  
            			<?php
            			$year = json_decode($r['year']);
            				foreach ($year as $value) {
							  echo $value;
							  echo ",";
							}
            			?>
            			 <br/>
            			Drive : <?=$r['drive']?> <br/>
            			transmission  : <?=$r['transmission']?> <br/>
            			Seats : <?=$r['seats']?> <br/>
            			Color Choice : 
            			<?php
            			$color = json_decode($r['color']);
            				foreach ($color as $value) {
							  echo $value;
							  echo ",";
							}
            			?>
            			<br/>
					</span>            			
            	</div>
            	<div class="col-sm-6">
            		<span>
            			Brand : <?=$brand['brand_name']?> <br/>
            			Chassis Code : <?=$r['chassis_code']?> <br/>
            			Engine CC : <?=$r['engine_cc']?> <br/>
            			Fuel  : <?=$r['fuel']?> <br/>
            			Doors : <?=$r['doors']?> <br/>
            			Feature Required : 
            			<?php
            			$features = json_decode($r['features']);
            				foreach ($features as $value) {
							  echo $value;
							  echo ",";
							}
            			?>
            			<br/>
					</span>   
            	</div>
            	Nuration /Hint /Special Note: <?=$r['leads_note']?>

            </div>

            <div class="row">
            	<div class="col-sm-12">
            		<table class="table table-primary ">
            			<tr>
            				<th>SS Images </th>
            				<th>contact Source </th>
            				<th>Next Date</th>
            				<th>Note</th>
            				<th>Add Datetime</th>
            			</tr>
         <?php
         $q = mysqli_query($dbc,"SELECT * FROM leads_followup WHERE leads_id = '$r[leads_id]'");
         while($f = mysqli_fetch_assoc($q)):
         ?>
         		<tr>
         			<td><a href="img/leads/<?=$f['screenshot']?>" target="_blank"><img src="img/leads/<?=$f['screenshot']?>" style="width:150px" /></a></td>
         			<td><?=$f['sourcetype']?></td>
         			<td><?=$f['nextdate']?></td>
         			<td><?=$f['note']?></td>
         			<td><?=$f['adddatetime']?></td>
         			
         		</tr>



         <?php
     endwhile;
         ?>
            			
            		</table>
            	</div>
            	
            </div>

            <hr/>


	<?php
	$x++;
endwhile;
	?>
</div>

