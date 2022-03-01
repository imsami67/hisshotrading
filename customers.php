 <?php include_once "includes/header.php" ?>

<?php include_once "inc/code.php" ?>

<!-- start page content -->

<?php 

          @$type = $_GET['type'];

          if ($type == 'bank') {

          		$text = "Bank";

          	}else{

          		$text = "Customers";

          	}

          	?>

               <div class="page-content-wrapper">

                <div class="page-content">

                    <div class="page-bar">

                        <div class="page-title-breadcrumb">

                            <div class=" pull-left">

                                <div class="page-title"><?=$text ?></div>

                            </div>

                            <ol class="breadcrumb page-breadcrumb pull-right">

                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>

                                </li>

                                <li class="active"><?=$text ?></li>

                            </ol>

                        </div>

                    </div>

                    

				    

 

				   

                    <div class="col-sm-12">

		<div class="panel">

	<div class="panel-heading panel-heading-red" align="center"><h4>Create <?=$text ?></h4></div>

	<div class="panel-body">

		<?php include 'pages/custom_info2.php'; ?>

		

			<br><br>

		</div>

	</div>

</div>

	<div class="panel">

		<div class="panel-heading bg-orange" align="center">

			<h5><span class="glyphicon glyphicon-user"></span> <?=$text ?> Management system</h5>

		</div>

		<?php 

			if (@$_GET['type'] == 'customer') {?>

		<div class="panel-body">

<table class="table" id="customers" class="table-responsive">

	<thead>

		<tr class="">

			<th>ID</th>

			<th>Customer Name</th>
			<th>Customer Company</th>

			<th>Email</th>

			<th>Phone</th>

			<th>Country</th>
			<th>Port</th>

			<th>Status</th>

			<th>Created Date</th>

			<th>Action</th>

	</thead>

	<tbody>

	</tbody>

</table>

		</div>

		<?php	

			}else{?>

		<div class="panel-body">

<table class="table" id="bank" class="table-responsive">

	<thead>

		<tr class="">

			<th>ID</th>

			<th>Beneficiary Name</th>

			<th>Account No</th>

			<th>Bank Name</th>

			<th>Branch Name</th>

			<th>Address</th>

			<th>Currency</th>

			<th>Status</th>

			<th>Action</th>

	</thead>

	<tbody>

	</tbody>

</table>	

		</div>

				<?php

					}

				?>

	</div> 

</div>

</div>



<?php include_once 'includes/footer.php'; ?>