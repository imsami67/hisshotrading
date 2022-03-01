 <?php 

include_once "includes/header.php";

include_once "inc/code.php";

if (!empty($_REQUEST['edit_menu_id'])) {
		# code...
		$fetchMenu=fetchRecord($dbc,"menus","id",base64_decode($_REQUEST['edit_menu_id']));
	}

?>

<!-- start page content -->

            <div class="page-content-wrapper">

                <div class="page-content">

                    <div class="page-bar">

                        <div class="page-title-breadcrumb">

                            <div class=" pull-left">

                                <div class="page-title">Developer Mode</div>

                            </div>

                            <ol class="breadcrumb page-breadcrumb pull-right">

                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>

                                </li>

                                <li class="active">Developer Mode</li>

                            </ol>

                        </div>

                    </div>



			<div class="col-sm-12">

				<div class="panel">

					<div class="panel-heading panel-heading-red" align="center">

						<b>Developer Mode</b>
						<a href="developer.php" class="btn btn-success pull-right btn-sm">Add New</a>
	
					</div>

						<div class="panel-body">
							
				<form action="php_action/custom_action.php" method="post" id="add_nav_menus_fm">
					<input type="hidden" name="action" value="add_nav_menu">
					<input type="hidden" name="edit_menu_id" value="<?=@base64_decode($_GET['edit_menu_id'])?>">
					<div class="form-group">
						<label for="">Page Title</label>
						<input type="text" class="form-control" placeholder="Page Title" name="nav_title" value="<?=@$fetchMenu['title']?>">
					</div><!-- group -->
					<div class="form-group">
						<label for="">Page url (.php)</label>
						<input type="text" class="form-control" placeholder="Page Url (.php)" name="nav_page" value="<?=@$fetchMenu['page']?>">
					</div><!-- group -->
					<div class="form-group">
						<label for="">Parent</label>
						<select name="nav_parent_id" id="" class="form-control">
						<option  value="0">No parent</option>
							<?php $q=mysqli_query($dbc,"SELECT DISTINCT(title),id FROM menus where parent_id=0");
							while($r=mysqli_fetch_assoc($q)):
							 ?>
							<option <?=(@$fetchMenu['parent_id']==$r['id'])?"selected":""?> value="<?=$r['id']?>"><?=ucwords($r['title'])?></option>
						<?php endwhile; ?>
						</select>
					</div><!-- group -->
					<div class="row form-group ">
						<div  class="col-sm-12">
							<div class="form-check form-check-inline ml-4">
						  <input class="form-check-input" type="checkbox" <?=@($fetchMenu['nav_edit']==1)?"checked":""?> name="nav_edit" id="nav_edit" value="1" />
						  <label class="form-check-label" for="nav_edit">Edit</label>
						</div>

						<div class="form-check form-check-inline ml-4">
						  <input class="form-check-input" name="nav_delete" <?=@($fetchMenu['nav_delete']==1)?"checked":""?> type="checkbox" id="nav_delete" value="1" />
						  <label class="form-check-label" for="nav_delete">Delete</label>
						</div>
						<div class="form-check form-check-inline ml-4">
						  <input class="form-check-input" type="checkbox" <?=@($fetchMenu['nav_add']==1)?"checked":""?> name="nav_add" id="nav_add" value="1" />
						  <label class="form-check-label" for="nav_add">Add</label>
						</div>
						</div>
					</div>
					<div class="form-group">
						<label for="">Icon</label>
					<input type="text" name="nav_icon" value="<?=@$fetchMenu['icon']?>" class="form-control">
					</div><!-- group -->
					<button class="btn btn-secondary btn-sm" id="add_nav_menus_btn">Save</button>
				</form>
			
						</div>

						</div>

					</div>





<div class="col-sm-12">

		<div class="panel">

	<div class="panel-heading cyan-bgcolor" align="center"><h4>Page Lists</h4></div>

	<div class="panel-body">

		<table class="table data-table">
			<thead>
				<th>
					Title
				</th>
				<th>Url </th>
				<th>Parent</th>
				<th>Featured</th>
				<th>Action</th>
			</thead>
			
			<tbody>
							<?php $q=mysqli_query($dbc,"SELECT * FROM menus WHERE parent_id IS NOT NULL");
							while($r=mysqli_fetch_assoc($q)):
								$fetchParent = fetchRecord($dbc,"menus","id",$r['parent_id']);
								 if ((mysqli_num_rows(mysqli_query($dbc,"SELECT * FROM menus WHERE parent_id='".$r['id']."' OR parent_id=0 ")))>0) {
							 ?>
							<tr>
								<td><?=ucwords($r['title'])?></td>
								<td><?=$r['page']?></td>
								<td><?=($r['parent_id']==0)?"Parent":$fetchParent['title']?></td>
								<td>
									<?php if ($r['nav_edit']==1): ?>
										Edit <br>
									<?php endif ?>
									<?php if ($r['nav_delete']==1): ?>
										Delete <br>
									<?php endif ?>
									<?php if ($r['nav_add']==1): ?>
										Add <br>
									<?php endif ?>
								</td>
								<td>
							
									<a href="developer.php?edit_menu_id=<?=base64_encode($r['id'])?>" class="btn btn-sm btn-info" >Edit</a> | <a href="#"  onclick="deleteData('menus','id',<?=$r['id']?>,'developer.php')" class="btn btn-sm btn-danger">Delete</a>
								</td>
								
							</tr>
						<?php } endwhile; ?>
						</tbody>
		</table>

		

	</div>

</div>



</div>

	</div></div>

<?php

include_once "includes/footer.php";

?>