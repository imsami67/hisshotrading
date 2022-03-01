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
                                <div class="page-title">RICKSU</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">RICKSU TRANSPORTATION</li>
                            </ol>
                        </div>
                    </div>

			<div class="col-sm-12">
				<div class="panel">
					<div class="panel-heading panel-heading-red" align="center"><h4>RICKSU TRANSPORTATION</h4></div>
						<div class="panel-body">
							<?php getMessage(@$msg,@$sts); ?>
							<form action="php_action/custom_action.php" method="POST" role="form" id="formData">
								<div class="msg"></div>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label for="">RICKSU Company</label>
											<select class="form-control" required name="riksu_company_id" id="riksu_company_id">
												<option>SELECT COMPANY</option>
											<?php $get_company=get($dbc,"ricksu_company");
											while ( $fetch_company=mysqli_fetch_assoc($get_company)):?>
												<option value="<?=$fetch_company['ricksu_company_id']?>"><?=$fetch_company['ricksu_company_name']?></option>
											<?php endwhile; ?>
											</select> 
											<input type="text" class="form-control d-none" id="ricksu_trans_id" name="ricksu_trans_id"> 
											<input type="text" class="form-control d-none"  name="riksu_transportation"> 
										</div>
										<div class="form-group">
											<label for="">FREE DAYS</label>
											<input type="number" min="1" class="form-control" id="free_days" name="free_days"> 
										</div>
										<div class="form-group">
											<label for="">RUNNING FEE</label>
											<input type="number" required min="1" class="form-control" id="running_fee" name="running_fee"> 
										</div>
										
									</div><!-- col -->
									<div class="col-sm-6">
										<div class="form-group">
											<label for="">Loading Point</label>
											<input required type="text" class="form-control" id="auction_house_name" name="auction_house_name"> 
										</div>
										<div class="form-group">
											<label for="">Delivery Point</label>
											<input type="text" class="form-control" id="ricksu_port" name="ricksu_port"> 
										</div>
										<div class="form-group">
											<label for="">NOT RUNNING FEE</label>
											<input type="number" required min="1" class="form-control" id="not_running" name="not_running"> 
										</div>
									
									</div><!-- col -->
								</div><!-- row -->
							
								<button type="submit" class="btn btn-primary" id="ricksu_btn" class="saveData">ADD</button>
							</form>
							</div>
						</div>
					</div>


<div class="col-sm-12">
		<div class="panel">
	<div class="panel-heading cyan-bgcolor" align="center"><h4>RICKSU</h4></div>
	<div class="panel-body">
			<table class="table" id="riksu_transportation1">
				<thead>
			<tr>	
				
				<th>RICKSU COMPANY</th>
				<th>LOADING POINT</th>
				<th>Delivery Point</th>
				<th>FREE DAYS</th>
				<th>RUNNING - NOT RUNNING FEE</th>
				
				<th>ACTION</th>
				
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