<?php include_once 'php_action/core.php'; 
  
?>
// <?php // if(!isset($_SESSION['userId'])){
//   header('location:login.php');
//   exit();
// } ?>

<!doctype html>
<html lang="en">
  <?php include_once 'includes/head.php'; ?>
  <body class="vertical  dark  ">
    <div class="wrapper">
  <?php include_once 'includes/header.php'; ?>
   <?php include_once 'includes/sidebar.php'; ?>
      <main role="main" class="main-content">
        
        <div class="container-fluid">
          <div class="card">
            <div class="card-header card-bg" align="center">

            <div class="row">
              <div class="col-12 mx-auto h4">
                <b class="text-center card-text">Profile</b>
              </div>
            </div>
  
          </div>
           <div class="card-body">

		<form action="php_action/panel.php" method="post" id="formData">
			<span class="responseProfile"></span>
			<input type="hidden" name="action" value="update_profile">
			<input type="hidden" name="user_id" value="<?=$fetchedUserData['user_id']?>">
			
			

			<div class="row">

				<div class="col-sm-6">

					<div class="panel panel-default panel-body">

						<div class="form-group">

							<label for="">Full Name</label>

							<input type="text" name="user_fullname" value="<?=@$fetchedUserData['fullname']?>" class="form-control">

						</div><!-- group -->

						<div class="form-group">

							<label for="">Address</label>

							<textarea name="user_address" class="form-control" id="" cols="30" rows="4"><?=@$fetchedUserData['address']?></textarea>

						</div><!-- group -->

					</div><!-- panel -->

				</div><!-- col -->

				<div class="col-sm-6">

					<div class="panel panel-default panel-body">

						<div class="form-group">

							<label for="">Username </label>

							<input type="text" name="username" value="<?=@$fetchedUserData['username']?>" class="form-control" disabled>

						</div><!-- group -->

						<div class="form-group">

							<label for="">Email</label>

							<input type="text" name="user_email" value="<?=@$fetchedUserData['email']?>" class="form-control" readonly>

						</div><!-- group -->

						<div class="form-group">

							<label for="">Phone No.</label>

							<input type="text"  name="user_phone" value="<?=@$fetchedUserData['phone']?>" class="form-control">

						</div><!-- group -->


					</div><!-- panel -->	

				</div><!-- col -->

			</div><!-- row -->

			<button class="btn btn-admin" type="submit" id="formData_btn">Update Profile</button>

		</form>

		<hr>

		<div class="panel panel-default panel-body">

			<h3>Change Password</h3>
		<form action="php_action/panel.php" method="POST" id="formData1">
			<span class="response"></span>
			<input type="hidden" name="action" value="reset_password">
			<input type="hidden" name="user_id" value="<?=$fetchedUserData['user_id']?>">
			
		     <div class="form-group"><input required type="password" class="form-control" name="current_password" placeholder="Old Password"></div> 
				<input type="hidden" class="form-control" name="user_email" value="<?=$fetchUser['user_email']?>">
		          <div class="form-group"><input type="password" class="form-control" name="new_password" placeholder="New Password" required></div>

		          <div class="form-group"><input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" required></div><br>

		          <button class="btn btn-admin2" type="submit" id="formData1_btn">UPDATE PASSWORD</button>
	    </form>

	</div>

	</div>
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
       
      

      </main> <!-- main -->
    </div> <!-- .wrapper -->
    <?php include_once 'includes/foot.php'; ?>
  </body>
</html>