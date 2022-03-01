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

                                <div class="page-title">Vehicle Files</div>

                            </div>

                            <ol class="breadcrumb page-breadcrumb pull-right">

                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>

                                </li>

                                <li class="active">Vehicle Files</li>

                            </ol>

                        </div>

                    </div>

			<div class="col-sm-12">

				<div class="panel">

					<div class="panel-heading panel-heading-red" align="center"><h4>Create Vehicle Files</h4></div>

						<div class="panel-body">

							<form action="php_action/custom_action.php" method="POST" role="form" id="formData">

								<div class="msg"></div>

								<div class="form-group row">

									<div class="col-sm-3">

										<?php 

										$id = @$_GET['vehicle_id'];

										$name = @$_GET['name'];

										if($name){

											$v = 'readonly';

										}else{

											$v = '';

										}

										$vehicle_info = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM vehicle_info WHERE vehicle_id = '$id'"));

										$maker = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM maker WHERE maker_id = '$vehicle_info[vehicle_maker]'"));

										$brand = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM brands WHERE brand_id = '$vehicle_info[vehicle_brand]'"));

									?>

									<label for="">Vehicle Stock ID</label>



									<input type="text" class="form-control" readonly="readonly" value="<?=$vehicle_info['vehicle_id'];?>" id="vehicle_id" name="vehicle_idNow"> 

								</div>



								<div class="col-sm-3">

									<label for="">Chassis No</label>



									<input type="text" class="form-control" readonly  value="<?=$vehicle_info['vehicle_chassis_no']?>" id="vehicle_id" name="vehicle_idDocs"> 

								</div>



								<div class="col-sm-3">

									<label for="">Engine No</label>



									<input type="text" class="form-control" readonly="readonly" value="<?=$vehicle_info['vehicle_engine_no']?>" id="vehicle_id" name="vehicle_idDocs"> 

								</div>

								<div class="col-sm-3">

									<label for="">Vehicle</label>



									<input type="text" class="form-control" readonly="readonly" value="<?=$maker['maker_name']?> <?=$brand['brand_name']?>" id="vehicle_id" name="vehicle_idDocs"> 

								</div>

								</div>



								<div class="form-group row">

									<div class="col-sm-2">

										<label for="">File</label>

									</div>

									<div class="col-sm-5">

										<input type="file" class="form-control" id="vehicle_file_name" name="vehicle_file_name"> 

										<input type="text" class="form-control d-none" id="airmail_file_id" name="airmail_file_id"> 
										<input type="text" class="form-control d-none" id="file_type" name="file_type" value= "general_document"> 

									</div><!-- col -->

									<div class="col-sm-5">

										<input type="text" class="form-control vehicle_file_name" <?=$v?> placeholder="Title "  id="airmail_file_name" name="airmail_file_name" value="<?=$name?>" required > 

									</div><!-- col -->

								</div>		
						<?php 
						if (isset($_GET['name'])) {
						$d  = mysqli_num_rows(mysqli_query($dbc,"SELECT * FROM airmail_files WHERE file_title LIKE '%".$_GET['name']."%' AND vehicle_id = '".$_GET['vehicle_id']."' "));
						if ($d==0) {
 ?>
									<button type="submit" class="btn btn-primary" id="save_vehicle_docs" class="saveData">Save</button>
								<?php }else{  ?>
									<span class="alert alert-danger	" id="alert_vehicle_docs">Already Exists</span>
							<?php	}
						}else{?>
							<button type="submit" class="btn btn-primary" id="save_vehicle_docs" class="saveData">Save</button>

						<?php 	} ?>
							
							</form>

							</div>

						</div>

					</div>

 



<div class="col-sm-12">

		<div class="panel">

	<div class="panel-heading cyan-bgcolor" align="center"><h4>Vehicle File</h4></div>

	<div class="panel-body" >

		<button class="pull pull-right btn btn-success" onclick="refereshdocs()">Refresh</button>

		<form method="post" action="" name="login" enctype="multipart/form-data">

			<table class="table" id="example2">

				<thead>

			<tr>

				<th>Select</th>	

				<th>ID</th>

				<th>Docs Title </th>

				<th>File </th>

				<th>Action</th>

			</tr>

			</thead>

			<div class="refereshdocs" id="refereshdocs" >

			<tbody>

				<?php  

					$q = get($dbc,"airmail_files WHERE file_type = 'general_document' AND vehicle_id = '$id'");

					while ($r = mysqli_fetch_assoc($q)):?>

				<tr>

					<td><input type="checkbox" name="docs[]" value="img/vehicle_docs/<?=$r['airmail_file_name']?>"></td>

					<td><?=$r['airmail_file_id']?></td>

					<td><?=$r['file_title']?></td>

					<td><a href="img/vehicle_docs/<?=$r['airmail_file_name']?>"><?=$r['airmail_file_name']?></a></td>

					<td>

						<form>  <i id="<?=$r['airmail_file_id'] ?>" class="fa fa-remove delete" style="cursor: pointer;"></i><input type="hidden" id="table_name" value="airmail_files"><input type="hidden" id="col_name" value="airmail_file_id"></form>

					</td>

				</tr>

				<?php endwhile ?>

				<tr>

					<td>Download zip</td>

					<form method="post" action="downloadZip.php">

					<td><input type="hidden" name="vehicle_id" value="<?=$id?>" /></td>



					<td><input type="submit" name="DownloadZip" value="DownloadZip" /></td>

					</form>

				</tr>

			</tbody></div>

			

			</table>

		</form>

		

	</div>

</div>



</div>



	</div></div>

<?php

include_once "includes/footer.php";

?>

