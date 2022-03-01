<!DOCTYPE html>
<html lang="en">
<?php include_once 'includes/head.php'; require_once 'includes/code.php';
 	/*get company data*/
		 	if (!empty($get_company)) {
		 		# code...
		 		
		 		$company_edit = $get_company['id'];
		 		$company_button='<input type="submit" value="Edit" name="company_update" class="btn btn-admin2 " style="width: 80%; border-radius: 10px;">';

		 	}else{
		 		$company_button = '<input type="submit" name="company_submit" class="btn btn-admin " style="width: 80%; border-radius: 10px;">';
		 	}
 ?>
  <body class="horizontal light  ">
    <div class="wrapper">
  <?php include_once 'includes/header.php'; ?>
      <main role="main" class="main-content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header card-bg" align="center">

            <div class="row">
              <div class="col-12 mx-auto h4">
                <b class="text-center card-text">Company Details</b>
           
             
              </div>
            </div>
  
          </div>
           <div class="card-body">
				<form method="post" action="" enctype="multipart/form-data">
					<input type="hidden" name="company_id" value="<?=@$get_company['id']?>">
					<div class="row">
					<div class="col-sm-6">
					<div class="form-group" >

						<h4>Enter Company Name </h4>
						<input type="text" name="name" placeholder="Enter Company Name" class="form-control" value="<?=@$get_company['name']?>" /><br/>
						<h4>Enter Company Logo </h4>
						<?php if(!empty($get_company['logo'])): ?>
							<a href="img/logo/<?=$get_company['logo']?>">
								<img src="img/logo/<?=$get_company['logo']?>" class="float-right" width="50" height="50" alt="">
							</a>
						<?php endif; ?>
						<input type="file" name="logo"  class="form-control" value="<?=@$get_company['logo']?>" /><br/>
					
					<h4>Stock Manage</h4>

						<select class="form-control" name="stock_manage">
							<option <?=@($get_company['stock_manage']==0)?"selected":""?> value="0">No</option>
							<option <?=@($get_company['stock_manage']==1)?"selected":""?> value="1">Yes</option>
						</select>
						<h4>Enter Company Address </h4>
						<input type="text" name="address" placeholder="Enter Company Address" class="form-control" value="<?=@$get_company['address']?>" /><br/>
						
					</div>
					</div>
					<div class="col-sm-6">
					<div class="form-group" >
						<h4>Enter Company Phone  </h4>
						<input type="text" name="company_phone" placeholder="Enter Company Phone" class="form-control" value="<?=@$get_company['company_phone']?>" /><br/>
						<h4>Enter Email Or Website  </h4>
						<input type="text" name="email" placeholder="Enter Email or Website" class="form-control" value="<?=@$get_company['email']?>" /><br/>
						<h4>Enter Personal Phone  </h4>
						<input type="text" name="personal_phone" placeholder="Enter personal Phone" class="form-control" value="<?=@$get_company['personal_phone']?>" /><br/>
						<h4>Interface</h4>

						<select class="form-control" name="sale_interface">
							<option <?=@($get_company['sale_interface']=='gui')?"selected":""?> value="gui">gui</option>
							<option <?=@($get_company['sale_interface']=='keyboard')?"selected":""?> value="keyboard">keyboard</option>
							<option <?=@($get_company['sale_interface']=='barcode')?"selected":""?> value="barcode">barcode</option>
						</select>
						<br>
						
						<?=@$company_button; ?>
					</div>
					</div>
					</div>
					</form>
				
			</div>
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
       
      </main> <!-- main -->
    </div> <!-- .wrapper -->
    
  </body>
</html>
<?php include_once 'includes/foot.php'; ?>