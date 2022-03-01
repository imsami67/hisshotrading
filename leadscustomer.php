
<?php
include_once  "includes/header.php";
?>

 <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Leads Management</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Leads</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Leads Customers </li>
                            </ol>
                        </div>
                    </div>

                    <div class="row">
                <div class="col-sm-12">
				<div class="panel">
					<div class="panel-heading panel-heading-red" align="center"><h4>Leads Customers  </h4></div>
						<div class="panel-body">
							
                           <table class="table example1">
                            <thead>
                            <tr>
                                <th>Customer ID</th>
                                <th>Customer Name</th>
                                <th>Company Name</th>
                                <th>Country </th>
                                <th>Phones</th>

                                <th>Email</th>
                                <th>Total Leads  </th>
                                <th>Add Leads</th>

                                
                                
                            </tr>
                            </thead>
                            <tbody>
<?php
//if ($glober_role == 'admin') {


     $q = mysqli_query($dbc,"SELECT * FROM leads_customer ORDER BY leads_cus_id DESC");
    
//}else{

     //$q = mysqli_query($dbc,"SELECT * FROM leads_customer WHERE assing_to = '$_SESSION[userId]'  ORDER BY leads_cus_id DESC");
//}

while($r = mysqli_fetch_assoc($q)):

    $usersNow= mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM users WHERE user_id = '$r[user_id]'"));
    $assign_to= mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM users WHERE user_id = '$r[assign_to]'"));

    




?>

                                <tr>
                                    <td><?=$r['leads_cus_id']?></td>
                                    <td><?=ucfirst($r['customer_name'])?></td>
                                    <td><?=$r['company_name']?></td>
                                    <td><?=ucfirst($r['country'])?></td>
                                    <td>
                                      
                                        <a href="tel:<?=$r['contact1']?>"><?=$r['contact1']?></a><br/>
                                         <a href="tel:<?=$r['contact2']?>"><?=$r['contact2']?></a><br/><br/>
                                           <a href="https://api.whatsapp.com/send?phone=<?=$r['contact1']?>&text=Hi..!." target="_blank"><i class="fa fa-whatsapp" style="font-size: 40px;color: green"></i></a>  <br/>
                                		  <a href="https://viber.me/<?=$r['contact1']?>/" target="_blank">Viber </a> 
                                    </td>
                                   
                                    <td>
                                    	  <a href="mailto:<?=$r['email']?>"><?=$r['email']?></a><br/>
                                    	   <a href="mailto:<?=$r['email2']?>"><?=$r['email2']?></a><br/>

                                    </td>
                                    <td>
                                        <?php
                                        $activeleads = mysqli_query($dbc,"SELECT * FROM leads WHERE customer_id = '$r[leads_cus_id]'");
                                         $number = mysqli_num_rows($activeleads);
                                        ?>
                                        <label class="label lable-success" style="font-size: 28px"><?=$number?></label>
                                    </td>

                                	

                                    <td>
                                         <a href="leads.php?customer_id=<?=$r['leads_cus_id']?>" class="btn btn-info" target="_blank">ADD INQUIRY </a>
                                    </td>
                                   
                                        
                                   
                                    
                                </tr>
                            <?php
                            endwhile;
                            ?>    
                            </tbody>
                           </table>




						</div>
					</div>
				</div><!-- col-sm-12 end -->
</div><!-- Row end -->	



                 
               </div>
               </div>
<?php
include_once "includes/footer.php";
?>