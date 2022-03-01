<?php
include_once "includes/header.php";
?>

            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Customer Table</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li><a class="parent-item" href="">Customer</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Customer List</li>
                            </ol>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-topline-aqua">
                                <div class="card-head">
                                    <header>Customer List</header>
                                    <div class="tools">
                                        <a class="fa fa-repeat btn-color box-refresh" href="javascript:;"></a>
	                                    <a class="t-collapse btn-color fa fa-chevron-down" href="javascript:;"></a>
	                                    <a class="t-close btn-color fa fa-times" href="javascript:;"></a>
                                    </div>
                                </div>
                                <div class="card-body ">
                                    <table id="saveStage" class="display full-width">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Country</th>
                                                <th>Social</th>
                                                <th>Sold Vehicle </th>
                                                <th>Active Vehicle </th>
                                                <th>Rank</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                      <?php
                                      $q = mysqli_query($dbc,"SELECT * FROM customers WHERE customer_role = 'customer'");
                                      	while($c = mysqli_fetch_assoc($q)):
                                      ?>  	
                                        	<tr>
	                                           	<td><?=$c['customer_id']?></td>
	                                           	<td><?=$c['customer_name']?>(<?=$c['customer_company']?>)<br/>[<?=$c['customer_company']?>]</td>
	                                           	<td><a href="tel:<?=$c['customer_phone']?>">
	                                           		<i class="fa fa-phone"></i>
	                                           		<?=$c['customer_phone']?></a>
	                                           		<?php
	                                           		if(($c['customer_name'])>0):?>
	                                           		<br/>
	                                           		<a href="tel:<?=$c['customer_phone2']?>">
	                                           			<i class="fa fa-phone"></i>
	                                           			<?=$c['customer_phone2']?></a>	
	                                           	<?php endif;?>
	                                           	</td>
	                                           	<td>
	                                           		<a href="mailto:<?=$c['customer_email']?>">
	                                           			<i class="fa fa-envelope"></i>
	                                           			<?=$c['customer_email']?></a>
	                                           		<?php
	                                           		if(($c['customer_email']) != ''):?>
	                                           		<br/>
	                                           		<a href="tel:<?=$c['customer_email']?>">
	                                           			<i class="fa fa-envelope"></i>
	                                           			<?=$c['customer_email']?></a>	
	                                           	<?php endif;?>
	                                           			
	                                           	</td>
	                                           	<td><?=$c['customer_country']?></td>
	                                           	<td>
	                                           		     <span class="label label-sm label-info"><?=$c['customer_phone']?></span><br/><br/>
                                           <a href="https://api.whatsapp.com/send?phone=<?=$c['customer_whatsapp']?>&text=Hi..!." target="_blank"><i class="fa fa-whatsapp" style="font-size: 25px;color: green;"></i></a> 
                                          	<?php if($c['customer_viber']):?>
                                          <a href="https://viber.me/<?=$c['customer_viber']?>/" target="_blank">
                                            <img src="https://cdn4.iconfinder.com/data/icons/logos-and-brands/512/359_Viber_logo-512.png" style="width: 25px">
                                             </a>
                                             <?php
                                             	endif;
                                             ?> 
	                                           	</td>
	                                           
	                                           		<?php
	                                           		$vehicle = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT sum(credit-debit) = 0  AS totalsold , sum(credit-debit) != 0  AS totalative FROM transactions WHERE customer_id = '$c[customer_id]' GROUP BY vehicle_id   "));

	                                           		?>
	                                           	<td>   <?=$vehicle['totalsold']?> </td>
	                                           	<td><?=$vehicle['totalative']?></td>
	                                           	<td><span class="label label-sm label-warning">Gold</span></td>
                                           	</tr>
                                           <?php
                                           	endwhile;
                                           ?>	
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page content -->
           


<?php
include_once "includes/footer.php";
?>