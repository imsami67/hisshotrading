 <?php 

include_once "includes/header.php";

include_once "inc/code.php";
if (!empty($_REQUEST['sub_yard_id'])) {
    # code...
    $sub_yards=fetchRecord($dbc,"sub_yards","sub_yard_id",base64_decode($_REQUEST['sub_yard_id']));
  }

?>

<!-- start page content -->

            <div class="page-content-wrapper">

                <div class="page-content">

                    <div class="page-bar">

                        <div class="page-title-breadcrumb">

                            <div class=" pull-left">

                                <div class="page-title">Auction Sub Yards</div>

                            </div>

                            <ol class="breadcrumb page-breadcrumb pull-right">

                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>

                                </li>

                                <li class="active">Auction Sub Yards</li>

                            </ol>

                        </div>

                    </div>



			<div class="col-sm-12">

				<div class="panel">

					<div class="panel-heading panel-heading-red" align="center">

						<b>Auction House : <?=$_REQUEST['auction_house']?></b>
						<a href="auction_yards.php" class="btn btn-success pull-right btn-sm">Add New</a>
	
					</div>

						<div class="panel-body">
                            <form action="php_action/custom_action.php" method="POST" role="form" id="formData16">
                                <input type="hidden" name="sub_yard_id" value="<?=@base64_decode($_REQUEST['sub_yard_id'])?>">
                                <input type="hidden" name="auction_home_id" value="<?=@$_REQUEST['auction_house']?>">
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label>Yard Name</label>
                                        <input required type="text" name="add_sub_yard_name" class="form-control" value="<?=@$sub_yards['sub_yard_name']?>">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Postal Code</label>
                                        <input required type="text" name="sub_yard_postal" class="form-control" value="<?=@$sub_yards['sub_yard_postal']?>">
                                    </div>
                                </div>  
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label>Contact No.</label>
                                        <input required type="text" name="sub_yard_contact" class="form-control" value="<?=@$sub_yards['sub_yard_contact']?>">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Fax No.</label>
                                        <input required type="text" name="sub_yard_fax" class="form-control" value="<?=@$sub_yards['sub_yard_fax']?>">
                                    </div>
                                </div> 
                                 <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label>Address in Japanese</label>
                                        <input  type="text" name="sub_yard_address_jap" class="form-control" value="<?=@$sub_yards['sub_yard_address_jap']?>">
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Address in English</label>
                                        <input required type="text" name="sub_yard_address_eng" class="form-control" value="<?=@$sub_yards['sub_yard_address_eng']?>">
                                    </div>
                                </div> 
                                <div class="row form-group">
                                    <button class="btn btn-primary btn-sm float-right" id="formData16_btn">Save</button>
                                </div>

                            </form>                  
                        </div>

						</div>

					</div>
<div class="col-sm-12">
    
        <div class="panel">
    <div class="panel-heading cyan-bgcolor" align="center"><h4>Sub Yards</h4></div>
    <div class="panel-body">
            <table class="table data-table" id="tableData16">
                <thead>
            <tr>    
                <th>ID</th>
                <th>Yard Name</th>
                <th>Name</th>
                <th>Contact</th >
                <th>Address(jpn)</th>
                 <th>Address(eng)</th>
                

                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                <?php  $c=0;  
                $q=mysqli_query($dbc,"SELECT * FROM sub_yards WHERE auction_home_id='".$_REQUEST['auction_house']."'");
                            while($r=mysqli_fetch_assoc($q)):
                                    $c++;
                 ?>
                 <tr>   
                        <td><?=$c?></td>
                        <td><?=$r['sub_yard_name']?></td>
                        <td><?=$r['auction_home_id']?></td>
                        <td><?=$r['sub_yard_contact']?></td>
                        <td><?=$r['sub_yard_address_jap']?></td>
                         <td><?=$r['sub_yard_address_eng']?></td>
                         <td>
                             <a class="btn btn-primary btn-sm" href="auction_yards.php?sub_yard_id=<?=base64_encode($r['sub_yard_id'])?>&auction_house=<?=@$_REQUEST['auction_house']?>">Edit</a>
                         </td>
                 </tr>  
             <?php  endwhile; ?>
            </tbody>
            
            
            </table>
        
    </div>
</div>
    
        
</div>




	</div></div>  <!-- /// end of panel-->

<?php

include_once "includes/footer.php";

?>