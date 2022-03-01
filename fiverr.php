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
                                <div class="page-title"> Code info</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Code Info</li>
                            </ol>
                        </div>
                    </div>

			<div class="col-sm-12">
				<div class="panel">
					<div class="panel-heading panel-heading-red" align="center"><h4>Create Code info</h4></div>
						<div class="panel-body">
							<?php getMessage(@$msg,@$sts); ?>
							<form action="" method="POST" role="form" id="">
								<div class="msg"></div>
								<div class="form-group">
									<label for="">Part Number</label>
									<input type="text" class="form-control" id="part_number" name="part_number"> 
									<!-- <input type="text" class="form-control d-none" id="auction_grade_id" name="auction_grade_id">  -->
								</div>
								<div class="form-group">
									<label for="">Serial Number</label>
									
									<input type="text" class="form-control" id="serial_number" name="serial_number"> 
								</div>

								<div class="form-group">
									<label for="">Quantity </label>
									<input type="text" class="form-control" id="quantity" name="quantity"> 
									
								</div>

								
							<input type="submit" name="test" class="btn btn-primary" value="Submit">
								<!-- <button type="submit" class="btn btn-primary" class="saveData">Save</button> -->
							</form>
							</div>
						</div>
					</div>


<div class="col-sm-12">
		<div class="panel">
	<div class="panel-heading cyan-bgcolor" align="center"><h4>Code Info</h4></div>
	<div class="panel-body">
			<table class="table" id="">
				<thead>
			<tr>	
				<th>ID</th>
				<th>Part Number</th>
				<th>Serial Number</th>
				<th>Quantity</th>
				<th>Date Time</th>
			</tr>
			</thead>
			<tbody>
				<?php
$a = mysqli_query($dbc,"SELECT * FROM fiverr");
while($r = mysqli_fetch_assoc($a)):

				?>
				<tr>	
				<th><?=$r['id']?></th>
				<th><?=$r['part_number']?> </th>
				<th><?=$r['serial_number']?> </th>
				<th><?=$r['quantity']?></th>
				<th><?=$r['adddatetime']?> Time</th>
				</tr>
				<?php
endwhile;
				?>
			</tbody>
			
			
			</table>
		
	</div>
</div>

</div>
	</div></div>
<?php
include_once "includes/footer.php";

if ($_POST['test']) {


	$part_number = $_POST['part_number'];
	$serial_number = $_POST['serial_number'];
	$quantity = $_POST['quantity'];

	$q = mysqli_query($dbc,"INSERT INTO fiverr (part_number,serial_number,quantity) VALUES ('$part_number','$serial_number','$quantity')");
	if($q){
		$msg = "Added Successfully";
		$sts = "info";
		redirect("fiverr.php",1200);
	}

	# code...
}

?>