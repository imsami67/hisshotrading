 <?php 
include_once "includes/header.php";
include_once "inc/code.php";

?>
<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">AA
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Color Code</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Color Code</li>
                            </ol>
                        </div>
                    </div>

			<div class="col-sm-12">
				<div class="panel">
					<div class="panel-heading panel-heading-red" align="center"><h4>Create Color Code</h4></div>
						<div class="panel-body">
							<form action="php_action/custom_action.php" method="POST" role="form" id="formData">
								<div class="msg"></div>
								<div class="form-group">
				<label for="">Maker</label>			
				<select id="color_maker" name="color_maker" class="form-control abcCustomNew" required="required">
					<option value="">~~SELECT~~</option>
					<?php $q = get($dbc,"maker WHERE maker_sts = '1'");
					while($r = mysqli_fetch_assoc($q)): ?>
						<option value="<?=$r['maker_id']?>"><?=$r['maker_name']?></option>
							<?php endwhile ?>
				</select>
			</div><!-- form group -->										
		<div class="form-group">
				<label for="">Color Name</label>
				<select list="vehicle_color_name1" autocomplete="off" name="color_name" id="color_name" required="required" class="form-control">
					<option value="">~~SELECT~~</option>
						<?php $q = get($dbc,"color_code WHERE color_code_sts = '1'");
						while($r = mysqli_fetch_assoc($q)): ?>
					<option value="<?=$r['color_name']?>"><?=$r['color_name']?></option>
					<?php endwhile ?>
				</select>			
			</div><!-- form group -->
								
									 
									<input type="text" class="form-control d-none" id="color_code_id" name="color_code_id"> 
						
								<div class="form-group">
									<label for="">Color Code</label>
							     <div class="input-group my-colorpicker2">
                   <input type="text" class="form-control" id="color_code_name" name="color_code_name">

                    <div class="input-group-append">
                      <span class="input-group-text"><i class="fa fa-square"></i></span>
                    </div>
                  </div>
								</div>
								<div class="form-group">
									<label for="">Color Code Status</label>
									<select class="form-control" id="color_code_sts" name="color_code_sts"> 
										<option value="">~~SELECT~~</option>
										<option value="1">Active</option>
										<option value="0">Inactive</option>
									</select>
								</div>
							<?php if (@$userPrivileges['nav_add']==1 || $fetchedUserRole=="admin"): ?>
								<button type="submit" class="btn btn-primary" class="saveData">Save</button>
									<?php endif ?>
							</form>
							</div>
						</div>
					</div>


<div class="col-sm-12">
		<div class="panel">
	<div class="panel-heading cyan-bgcolor" align="center"><h4>Color Codes</h4></div>
	<div class="panel-body">
			<table class="table" id="color_code">
				<thead>
			<tr>	
				<th>ID</th>
				<th> Maker</th>
				<th> Color Name</th>
				<th>Color Code</th>
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