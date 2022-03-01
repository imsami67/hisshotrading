 <?php
include_once "includes/header.php";

?>
 <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Reservation List</div>
                            </div>
                            
                        </div>
                    </div>
                  <div class="card card-body">
                      <div  class="row form-group">
                      <div  class="col-sm-6">
                        <select class="form-control" id="sendCustomerID" name="sendCustomerID">
                          <option value="">~~SELECT Customer~~</option>
                          <?php $q = get($dbc,"customers WHERE customer_active = '1'  AND customer_role='customer'");
                          while($r = mysqli_fetch_assoc($q)): ?>
                            <option value="<?=$r['customer_id']?>"><?=$r['customer_name']?></option>
                          <?php endwhile; ?>
                        </select>
                      </div>
                      <div  class="col-sm-6">
                        <select class="form-control" id="sendVehicleID" name="sendVehicleID">
                          <option value="">~~SELECT Vechicle~~</option>
                          <?php 
                          $q = mysqli_query($dbc,"SELECT vehicle_info.*, maker.*, brands.* FROM vehicle_info INNER JOIN maker ON vehicle_info.vehicle_maker = maker.maker_id INNER JOIN brands ON brands.brand_id = vehicle_info.vehicle_brand WHERE vehicle_info.vehicle_status != 'sold'");
                          while($r = mysqli_fetch_assoc($q)): ?>
                            <option value="<?=$r['vehicle_id']?>"><?=$r['maker_name']?> <?=$r['brand_name']?></option>
                          <?php endwhile; ?>
                        </select> 
                      </div>
                    </div>
                  </div>
<div class="row">
                <div class="col-sm-12">
                <div class="card">
                    <div class="card-head themebg" align="center"><h4 class="text-white">Reservation List</h4></div>
                        <div class="card-body">
                            
                           <table class="table example1 "  width="100%">
                            <thead>
                            <tr>
                                <th>Vehicle</th>
                                <th>Reservation by</th>
                                <th>Start Date</th>
                                <th>Expiry Date</th>
                                <th>Payment</th>
                                <th>Sold Price</th>
                                <th>Que</th>
                                <th>Date</th>
                                                        
                            </tr>
                            </thead>
                            <tbody id="showReservations"></tbody>
                          
                           
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
 


