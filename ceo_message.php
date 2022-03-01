 <?php 
include_once "includes/header.php";
include_once "inc/code.php";
  $ceo_info = fetchRecord($dbc, "ceo_msg", "ceo_id",get_last_record($dbc));
?>
<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Ceo Message</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Ceo Message</li>
                            </ol>
                        </div>
                    </div>
			<div class="col-sm-12">
				<div class="panel">
					<div class="panel-heading cyan-bgcolor" align="center"><h4>Ceo Message</h4></div>
						<div class="panel-body">
							<form action="php_action/custom_action.php" method="POST" role="form" id="ceo_mgs_form">
								<div class="msg"></div>
								<div class="form-group row">
										
									    <div class="avatar-upload" >
									    	<input type='file' id="imageUpload" value="<?=$ceo_info['ceo_img']?>" name="ceo_img" accept=".png, .jpg, .jpeg" />
        									<div class="avatar-edit upload-button">
            								 <label for="imageUpload" id="file_upload"></label>
        									</div>
        									<div class="avatar-preview" >
            							<div id="imagePreview" style="background-image: url(img/<?=$ceo_info['ceo_img']?>);">
            							</div>
    							    </div>
    							</div>
								</div>
							<div class="form-group row">
								<div class="col-sm-6">
									<label>Ceo Name</label> <input value="<?=@$ceo_info['ceo_name']?>" type="text" placeholder="" class="form-control" name="ceo_name"></div>
								<div class="col-sm-6">
									<label>Ceo Phone No.</label> <input value="<?=@$ceo_info['ceo_phone']?>" type="text" placeholder="" class="form-control" name="ceo_phone"></div>
								</div>
							<div class="form-group row">
								<div class="col-sm-6">
									<label>Facebook</label> <input value="<?=@$ceo_info['ceo_facebook']?>" type="text" placeholder="" class="form-control" name="ceo_facebook"></div>
								<div class="col-sm-6">
									<label>Viber</label> <input value="<?=@$ceo_info['ceo_viber']?>" type="text" placeholder="" class="form-control" name="ceo_viber"></div>
							</div>
								<div class="form-group row">
								<div class="col-sm-6">
									<label>Instagram</label> <input value="<?=@$ceo_info['ceo_insta']?>" type="text" placeholder="" class="form-control" name="ceo_insta"></div>
								<div class="col-sm-6">
									<label>Linkedin</label> <input value="<?=@$ceo_info['ceo_linkedin']?>" type="text" placeholder="" class="form-control" name="ceo_linkedin"></div>
								</div>
								<div class="form-group row">
								<div class="col-sm-12">
									<label>Twitter</label> <input value="<?=@$ceo_info['ceo_twiter']?>" type="text" placeholder="" class="form-control" name="ceo_twiter">
								</div>
								</div>
								<div class="form-group row">
									<div class="col-sm-12">
									<label>Ceo Message</label>
								<textarea class="form-control"  name="ceo_msg" rows="4"><?=@$ceo_info['ceo_msg']?></textarea>
									 </div>
								</div>
									    <?php $btn_name=(empty(@$ceo_info))?"Save Changes":"Update Changes";
			    						$btn_value=(empty(@$ceo_info))?"add":"update"; ?>

								<input type="hidden" name="ceo_msg_btn" value="<?=$btn_value?>">
								<input type="hidden" name="ceo_id" value="<?=@$ceo_info['ceo_id']?>">
								
								<button type="submit" class="btn btn-primary" id="ceo_mgs_form_btn" class="saveData"><?=@$btn_name?></button>
							</form>
							</div>
						</div>
					</div>



	</div></div>
<?php
include_once "includes/footer.php";
?>