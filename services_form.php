<body>
<?php 
//mac work
// Turn on output buffering  
ob_start();  

//Get the ipconfig details using system commond  
system('ipconfig /all');  

// Capture the output into a variable  
$mycomsys=ob_get_contents();  

// Clean (erase) the output buffer  
ob_clean();  

$find_mac = "Physical"; 
//find the "Physical" & Find the position of Physical text  

$pmac = strpos($mycomsys, $find_mac);  
// Get Physical Address  

$macaddress=substr($mycomsys,($pmac+36),17);
//echo $macaddress;  
//Display Mac Address  
//if ($macaddress=='C0-18-85-3C-84-EC') {

//mac work end

 $date_now = new DateTime();
 $date2    = new DateTime("01/01/2025");

if ($date_now < $date2) {
	require_once 'php_action/db_connect.php';
	
	require_once 'includes/header.php'; 
	require_once 'inc/code.php'; 
?>


<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
	<div id="app"  style="position: fixed;top: 50px;left: 0px;z-index: 10000;">
		<div>
			 <center>
		       	<video  id="preview" style="width: 180px;height: 180px;border-radius: 10px"></video>
		       	<div id="scan_img" style="display: none;margin-top: -20px;width: 100px;height: 100px;margin:auto;float: left;">
			 		<img src="img/scanning.gif" class="img img-responsive center-block" alt="" align="bottom" width="180px" height="180px">
			 	</div>
		       </center>
		</div><!-- col -->
	</div><!-- app -->
<div class="panel">
		<div class="panel-heading panel-heading-red">
  		<i class="fa fa-plus"></i>	Services Form <?=@base64_decode($_REQUEST['invoice'])?>
<a href="print_invoice.php?invoice_id=<?=@base64_decode($_REQUEST['invoice'])?>&transaction_id=<?=$_REQUEST['transaction_id']?>" class="btn-sm btn-primary float-right"><i class="fa fa-print mr-1"></i>Print</a>
	</div> <!--/panel-->

    <div class="row">
          <div class="col-sm-12">
            <div class="p-3">
           
              <form class="user" id="myForm" method="post" action="" enctype="multipart/form-data">
                <input type="hidden" name="invoice_id" value="<?=@base64_decode($_REQUEST['invoice'])?>">
				 <div class="form-group row">
                       <div class="col-sm-9 mx-auto">
                       	<label>Select Services</label>
                         <select type="date" class="form-control"  name="services_id"  required >
                   <option    value="">Select Services</option>
                          <?php
                            $result=mysqli_query($dbc,"SELECT * FROM vehicle_services where vehicle_services_sts=1 ");
                             while($row=mysqli_fetch_array($result)){ 
                            
                          ?>
                    
                      <option  <?=empty($r['vehicle_services_id'])?"":"selected"?>  value="<?=$row["vehicle_services_id"]?>"  >
                      	<?=$row["vehicle_services_name"]?> | Cost : <?=$row["vehicle_services_amount"]?></option>

                      <?php   } ?>
                  </select>
                      </div>
                       <div class="col-sm-2 ml--3">
                        <br>
				<button type="button"    class="btn btn-success btn-sm mt-2" id="add_service"><i class="fa fa-plus"></i> <b>Add</b></button>
                      </div>
                    </div><!-- other info -->
              <br>
               
                  </div>           
              

            </form>

              <div class="col-12" style="overflow-x:auto;">
                  <table class="table  saleTable" id="myDiv"> 
                    <thead class="table-bordered">
                      <tr>
                        <th>Sr.</th>
                        <th>Vehicle Name</th>
                        <th>Services Name</th>
                        <th>Services Price</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody class="table-bordered" id="servicesTable"></tbody>
                
    			 <tfoot>
    			 
     	  			<tr>
                <td colspan="3"class="border-none" ></td>
                <td class="table-bordered">Total</td>
                <td class="table-bordered" id="set_total"></td>
              </tr>
           
                   </tfoot>
                </table>
                 </div><!---- table div -----> 
                 <div class="row">
                   <div class="col-sm-2 float-right">
                     <a class="btn btn-sm btn-primary" href="quotation_form.php?edit_quotation_id=<?=@base64_decode($_REQUEST['invoice'])?>">Save</a>
                   </div>
                 </div>
             </div>
            </div>
          </div>


	
</div> <!--/panel-->	
<?php 
		// /else manage order
		}
		?>

</div>
</div>
</body>

<?php 
	require_once 'includes/footer.php'; 
?>
<!-- Bootstrap JavaScript -->
<script src="js/bootstrap.js"></script>
<script type="text/javascript">
	services_fetch(<?=@base64_decode($_REQUEST['invoice'])?>);
</script>
 