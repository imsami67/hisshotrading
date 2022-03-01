 <?php 

include_once "includes/header.php";

include_once "inc/code.php";



 $user_id = base64_decode($_REQUEST['user_id']);


 
$fetchUSer=mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM users WHERE user_id =  '$user_id ' "))



?>

<!-- start page content -->

            <div class="page-content-wrapper">

                <div class="page-content">

                    <div class="page-bar">

                        <div class="page-title-breadcrumb">

                            <div class=" pull-left">

                                <div class="page-title">Privileges </div>

                            </div>

                            <ol class="breadcrumb page-breadcrumb pull-right">

                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>

                                </li>

                                <li>Users /&nbsp;</li>

                                <li class="active">Privileges</li>

                            </ol>

                        </div>

                    </div>



	<div class="col-sm-12">

		<div class="panel">

	<div class="panel-heading panel-heading-red" align="center"><h4>User Privileges</h4></div>

	<div class="panel-body">

			<form class="form-horizontal" method="POST" action="" id="">

		<div class="form-group row">

			<div class="col-sm-4">

				

			</div>

			<div class="col-sm-4 text-center">

				<p style="font-size: 18px">Allow This user to manage these tools</p>

				<input type="text" class="form-control" name="now_user_id" readonly="" value="<?=$fetchUSer['username']?>">

			</div>

			<div class="col-sm-4">

			</div>



		</div>

		<?= getMessage(@$msg,@$sts); ?>



	



			<input type="checkbox" id="checkAl" class="checkbox">CheckAll<br/><hr/>

			 	<?php



			 $sql =mysqli_query($dbc,"SELECT * FROM menus ");

			 while($row=mysqli_fetch_assoc($sql)):

			 	if ($row['page'] == '#' ) {?>
		
			 			

			<?php 	}else{


			 		$fetchchecked = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM privileges WHERE user_id = '$user_id'  AND  nav_id = '".$row['id']."'  "));

			 		if ($fetchchecked) {

			 			$checked = "checked";

			 		}else{

			 			$checked = "";

			 		}



			 	?>





			  <div class="row">
			  	<div class="col-sm-3">
			  		<input type="checkbox" class="checkbox" name="name[]" value="<?=$row['id']?>" title="<?=$row['page']?>" <?=$checked?>>

  					<label for="vehicle1" ><?=$row['title']?></label><br/>	

  					<input type="hidden" name="url[]" value="<?=$row['page']?>" title="<?=$row['page']?>">		

			  	</div>
			  	<div class="col-sm-4">
			  		
			  		<?php if (@$row['nav_edit']==1): ?>
			  			<input type="checkbox" class="checkbox" name="nav_edit[]" value="1" title="<?=$row['page']?>" >

  					<label for="nav_edit" >Edit</label> &nbsp;&nbsp;&nbsp;
			  		<?php endif ?>
			  		<?php if (@$row['nav_delete']==1): ?>
			  			<input type="checkbox" class="checkbox" name="nav_delete[]" value="1" title="<?=$row['page']?>" >

  					<label for="nav_delete" >Delete</label> &nbsp;&nbsp;&nbsp;
			  		<?php endif ?>
			  		<?php if (@$row['nav_add']==1): ?>
			  			<input type="checkbox" class="checkbox" name="nav_add[]" value="1" title="<?=$row['page']?>" >

  					<label for="nav_add" >Add</label> &nbsp;&nbsp;&nbsp;
			  		<?php endif ?>

			  			

  					
			  	</div>
			  </div>




			 		



			 	<?php

			 }

endwhile;

			 	?>	  

			 		<input type="submit" name="save" class="btn btn-info"/>

			</form>

			<br><br>

		</div>

	</div>

</div>







	</div></div>

<?php

include_once "includes/footer.php";



	if (isset($_REQUEST['save'])) {





		 $name = $_REQUEST['name'];

		

		$now_user_id =base64_decode($_REQUEST['user_id']);

		// echo json_encode($_REQUEST['name']);

		// echo json_encode($_REQUEST['url']);



			$delte = mysqli_query($dbc,"SELECT * FROM privileges WHERE user_id = '$user_id'");

			while($row=mysqli_fetch_assoc($delte)){





				$q = mysqli_query($dbc,"DELETE FROM privileges WHERE user_id = '".$row['user_id']."'");

				





			}



		



		for ($i=0; $i <= count($name) ; $i++) { 

			if (@$_REQUEST['nav_edit'][$i]==1) { $nav_edit=1; }
			else{ $nav_edit=0; }
			if (@$_REQUEST['nav_add'][$i]==1) { $nav_add=1; }
			else{ $nav_add=0; }
			if (@$_REQUEST['nav_delete'][$i]==1) { $nav_delete=1; }
			else{ $nav_delete=0; }

			$FetchURL = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM nav WHERE nav_id ='".$name[$i]."' "));

			if($name[$i] != ''){


			$test = mysqli_query($dbc,"INSERT INTO privileges(user_id,nav_id,nav_url,addby,nav_delete,nav_add,nav_edit) VALUES('".@$user_id."','".@$name[$i]."','".@$FetchURL['url']."','Added By: $globel_username ','$nav_delete','$nav_add','$nav_edit')");

			if($test){



			$msg = "Role Assigned successfully ";

			$sts ="success";

			redirect("users.php",1200);

		}



			

			}else{



			}

		}

		

	}

		

?>





<style type="text/css">

	.checkbox{

		width: 20px;

		height: 20px;

	}

	label{

		font-size: 20px;

	}

</style>



<script>

$("#checkAl").click(function () {

$('input:checkbox').not(this).prop('checked', this.checked);

});

</script>