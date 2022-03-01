<?php
include_once "includes/header.php";
?>

<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Search</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Search</li>
                            </ol>
                        </div>
                    </div>

                    <div class="col-sm-12">
				<div class="panel">
					<div class="panel-heading panel-heading-red" align="center"><h4>Your search : <?=@$_GET['query']?></h4></div>
						<div class="panel-body">

							<table class="table ">
								<tr>
									
									<th>Stock ID</th>
									<th>Chassis</th>
									<th>Engine no.</th>
									<th>Drive</th>
									<th>Option</th>
								</tr>
<?php
$query = @$_GET['query'];
$q = mysqli_query($dbc,"SELECT * FROM vehicle_info WHERE vehicle_chassis_no LIKE '%$query%' OR vehicle_engine_no LIKE '%$query%' OR vehicle_stock_id = '$query' OR vehicle_drive LIKE '%$query%'  ");
//echo "SELECT * FROM vehicle_info WHERE vehicle_chassis_no LIKE '%$query%' OR vehicle_engine_no LIKE '%$query%' OR vehicle_stock_id = '$query' OR vehicle_drive LIKE '%$query%'";
while($r = mysqli_fetch_assoc($q)):


?>


								
								<tr>
									
									<td><a href="trade.php?vehicle_id=<?=$r['vehicle_id']?>"><?=$r['vehicle_stock_id']?></a></td>
									<td><a href="trade.php?vehicle_id=<?=$r['vehicle_id']?>"><?=$r['vehicle_chassis_no']?></td></a>
									<td><a href="trade.php?vehicle_id=<?=$r['vehicle_id']?>"><?=$r['vehicle_engine_no']?></td></a>
									<td><a href="trade.php?vehicle_id=<?=$r['vehicle_id']?>"><?=$r['vehicle_drive']?></td></a>
									<td>
										<a href="vehicle_docs.php?vehicle_id=<?=$r['vehicle_id']?>" class="btn btn-info"><span class="fa fa-file"></span></a>
										<a href="trade.php?vehicle_id=<?=$r['vehicle_id']?>" class="btn btn-info"><span class="fa fa-edit"></span></a>
									</td>
								</tr>
								
		<?php
		endwhile;
		?>						
							</table>




						</div>
					</div>
				</div>






</div>
</div>

<?php
include_once "includes/footer.php";
?>