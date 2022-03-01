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
                                <div class="page-title">View Documents</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><i class="fa fa-shopping-cart"></i>&nbsp;<a class="parent-item" href="dashboard.php">Trade</a>&nbsp;<i class="fa fa-angle-right"></i>
                                <li><i class="fa fa-shopping-cart"></i>&nbsp;<a class="parent-item" href="dashboard.php">Airmail</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">View Documents</li>
                            </ol>
                        </div>
                    </div>


<div class="col-sm-12">
		<div class="panel">
	<div class="panel-heading cyan-bgcolor" align="center"><h4>View Documents</h4></div>
	<div class="panel-body">
			<table class="table" id="">
				<thead>
			<tr>	
				<th>ID</th>
				<th>Vehicle ID</th>
				<th>Document Name</th>
				<th>Action</th>
			</tr>
			</thead>
			<tbody>
			<?php 
			$id = $_GET['vehicle_id'];
			$x = 1;
			$q = get($dbc,"airmail_files WHERE vehicle_id = '$id'");
			while ($r = mysqli_fetch_assoc($q)):?>
				<tr>
					<td><?=$x?></td>
					<td>
						Vehicle Stock id : <?=fetchRecord($dbc,"vehicle_info","vehicle_id",$r['vehicle_id'])['vehicle_stock_id']?><br>
						Vehicle Chassis No : <?=fetchRecord($dbc,"vehicle_info","vehicle_id",$r['vehicle_id'])['vehicle_chassis_no']?><br>
						Vehicle Engine No : <?=fetchRecord($dbc,"vehicle_info","vehicle_id",$r['vehicle_id'])['vehicle_engine_no']?>
					</td>
					<td>
						<a href="img/airmail_documents/<?=$r['airmail_file_name']?>" target="_blank"><?=$r['airmail_file_name']?></a>
					</td>
					<td>
						<a href="index">Delete</a>
					</td>
				</tr>
			<?php 
				$x++;
				endwhile ?>
			</tbody>
			
			
			</table>
		
	</div>
</div>

</div>
	</div></div>
<?php
include_once "includes/footer.php";
?>