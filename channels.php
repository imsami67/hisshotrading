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
                                <div class="page-title">Channels</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Channels</li>
                            </ol>
                        </div>
                    </div>

	<div class="col-sm-12">
		<div class="panel">
	<div class="panel-heading panel-heading-red" align="center"><h4>Create Channels</h4></div>
	<div class="panel-body">
		<?php getMessage(@$msg,@$sts); ?>
		<form class="form-horizontal" method="POST" action="" id="">
			  <div class="form-group row">
			    <label for="clientContact" class="col-sm-2 control-label">Channel Name</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="channel_name" name="channel_name" placeholder="Channel Name" autocomplete="off"  required  value="<?=@$fetchchannel['channel_name']?>" />
			    </div>
			     <label for="clientContact" class="col-sm-2 control-label">On Airing Detail </label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="onairing_detail" name="onairing_detail" placeholder="On Airing Detail" autocomplete="off"  required  value="<?=@$fetchchannel['airing']?>" />
			    </div>
			  </div> <!--/form-group-->		
			 	<div class="form-group row">
			    <label for="clientContact" class="col-sm-2 control-label">Duration</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="duration" name="duration" placeholder="Channel Duration" autocomplete="off"  required  value="<?=@$fetchchannel['duration']?>" />
			    </div>
			      <label for="clientContact" class="col-sm-2 control-label">Time </label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="date" name="time" placeholder="Time Detail" autocomplete="off"  required  value="<?=@$fetchchannel['channel_time']?>" />
			    </div>
			  </div> <!--/form-group-->	
			  <div class="form-group row">
			    <label for="clientContact" class="col-sm-2 control-label">Rate</label>
			    <div class="col-sm-6">
			      <input type="text" class="form-control" id="rate" name="rate" placeholder="Rate Value" autocomplete="off"  required  value="<?=@$fetchchannel['rate']?>" />
			    </div>
			    <div class="col-sm-4">
			    	<?=$channel_button;?>
			    </div>
			    
			  </div> <!--/form-group-->			  
			 
			</form>
			<br><br>
		</div>
	</div>
</div>


<div class="col-sm-12">
		<div class="panel">
	<div class="panel-heading cyan-bgcolor" align="center"><h4>Channels</h4></div>
	<div class="panel-body">
<?php getMessage(@$msg,@$sts); ?>
			<table class="table example1" id="myTable"  >
				<thead>
			<tr>	
				<th>Channel Name</th>
				<th>Channel On Air Details</th>
				<th>Duration</th>
				<th>Time</th>
				<th>Rate</th>
				<th>Added Time</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
			</thead>
			<tbody>
			<?php 
				
			
			
			$sql = "SELECT * FROM channels  ";
	
	$result = mysqli_query($dbc, $sql);
	
	if ( mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_array($result)){
			?>
			<tr>
				<td><?=$row['channel_name'];?></td>
				<td><?=$row['airing'];?></td>
				<td><?=$row['duration'];?></td>
				<td><?=$row['channel_time'];?></td>
				<td><?=$row['rate'];?></td>
				<td>
					<?php
					if ($row['status'] == '1') {
						?>
						 <span class="label label-lg label-info" style="font-size: ">Available</span>
						<?php
						# code...
					}else{
						?>
						<span class="label label-lg label-danger" style="font-size: "> Not Available</span>
						<?php
					}
					?>
				</td>
				<td><?=date('D, d-M-Y',strtotime($row['timestamp'])) ;?>
					

				</td>
				<td><a href="channels.php?channel_del_id=<?=$row['channel_id']?>" class="text-danger"><span class="fa fa-remove"></span></a> | 
					<a href="channels.php?channel_edit_id=<?=$row['channel_id']?>" class="text-success"><span class="fa fa-edit"></span></a></td>
				
			</tr>
			</tbody>
		<?php 
}
	} 
		?>
			
			
			</table>
		
	</div>
</div>

</div>
	</div></div>
<?php
include_once "includes/footer.php";
?>