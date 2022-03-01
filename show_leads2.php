 <?php
include_once "includes/header.php";

?>

<script type="text/javascript" src="assets/js/custom2.js"></script>

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
                                <li class="active">Leads Management</li>
                            </ol>
                        </div>
                    </div>
            
<div class="row">
    
                <div class="col-sm-12">

                <div class="panel">
                    <div class="panel-heading panel-heading-red" align="center"><h4>Leads Management </h4></div>
                        <div class="panel-body">
                                            <div class="form-group row">
                                <div class="col-sm-3 offset-9">
        <input type="text" id="show_leads_input" placeholder="Search..." name="" class="form-control">
                                    
                                </div>
    </div>
                           <table class="table example1 table-responsive"  style="text-align: center;" id="show_leads_tb">
                            <thead>
                            <tr>
                                <th>Customer ID</th>
                                <th>Assign To</th>
                                <th>Added By</th>
                                <th>Customer Name</th>
                                <th>Bussiness Name</th>
                                <th>Country</th>
                                <th>Contact</th>
                                <th>Email</th>
                                
                              
                                <th>Action</th>

                                
                                
                            </tr>
                            </thead>
                            <tbody id="leads_lists">
<?php
//if ($glober_role == 'admin') {


     $q = mysqli_query($dbc,"SELECT * FROM leads_customer ORDER BY leads_cus_id DESC");
    
//}else{

     //$q = mysqli_query($dbc,"SELECT * FROM leads_customer WHERE assing_to = '$_SESSION[userId]'  ORDER BY leads_cus_id DESC");
//}
$x=1;
while($r = mysqli_fetch_assoc($q)):

    $usersNow= mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM users WHERE user_id = '$r[user_id]'"));
    $assign_to= mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM users WHERE user_id = '$r[assign_to]'"));

    




?>

                                <tr>
                                    <td><?=$x?></td>
                                   <!--  <td><?=$r['leads_cus_id']?></td> -->
                                    <td><?=@$usersNow['username']?>(<?=@$usersNow['user_role']?>)</td>
                                    <td><?=$assign_to['username']?>(<?=$assign_to['user_role']?>)</td>
                                    <td>

                                        <?=$r['customer_name']?><br/>
                                         <!-- <a href="tel:<?=$r['contact1']?>"><?=$r['contact1']?></a> -->
                                    </td>
                                    <td><?=$r['company_name']?></td>
                                    <td><?=$r['country']?></td>
                                    <td>
                                            <span><?=$r['contact1']?></span><br/>
                                           <a href="https://api.whatsapp.com/send?phone=<?=$r['contact1']?>&text=Hi..!." target="_blank"><i class="fa fa-whatsapp" style="font-size: 25px;color: green;"></i></a> 
                                          <a href="https://viber.me/<?=$r['contact1']?>/" target="_blank">
                                            <img src="https://cdn4.iconfinder.com/data/icons/logos-and-brands/512/359_Viber_logo-512.png" style="width: 25px">
                                             </a> 
                                    </td>
                                    <td><a href="mailto:<?=$r['email']?>"><?=$r['email']?></a></td>

                                   <!--  <td>
                                        <?php
                                        $activeleads = mysqli_query($dbc,"SELECT * FROM leads WHERE customer_id = '$r[leads_cus_id]'");
                                         $number = mysqli_num_rows($activeleads);
                                        ?>
                                        <label class="label lable-success" style="font-size: 28px"><?=$number?></label>
                                    </td> -->

                                    <td>
                                         <a href="leadreport.php?customer_id=<?=$r['leads_cus_id']?>" class="btn btn-info" target="_blank">Leads Report</a>
                                         
                                          <button class="btn btn-success mt-1" data-id="" onclick="setcustomerID(<?=$r['leads_cus_id']?>,`<?=$r['customer_name']?>`)" data-toggle="modal"  data-target="#add_inquiry_modal"><i class="fa fa-add"></i>Add INQUIRY</button>
                                    </td>
                                   
                                        
                                   
                                    
                                </tr>
                        
                                    <tr>
                                        <th><?=$x?></th>
                                        <th>Inquery For</th>
                                        <th>Follow Up</th>
                                        <th>Next FollowUp date</th>
                                        <th>Status</th>
                                        <th  colspan="3">Availablity</th>
                                        <th>Action</th>
                                    </tr>
                                 
                                        <?php
                                        $y=1;
                                        while($leadsNow = mysqli_fetch_assoc($activeleads)):?>
                                           <tr> 
                                       
                                            <?php
$maker = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM maker WHERE maker_id = '$leadsNow[maker_id]'"));
$brand = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM brands WHERE brand_id = '$leadsNow[brand_id]'"));

                                            ?>
                                            <td><?=$x?>-<?=$y?></td>
                                           
                                  <td>  <a  class="label label-info" style="font-size: 15px;" 
                                    onclick="showleads(<?=$leadsNow['leads_id']?>,'<?=$maker['maker_name']?> <?=$brand['brand_name']?>')"><?=$maker['maker_name']?> <?=$brand['brand_name']?> </a></td>
                                     <td>
                                    <button class="btn btn-success" onclick="Ssset(<?=$leadsNow['leads_id']?>,'<?=date('Y-m-d',strtotime($leadsNow['followup_next_date']))?>')"><span class="fa fa-plus"></span></button>
                                    </td>
                                   
                                     <td><?=date('d-M-Y',strtotime($leadsNow['followup_next_date']))?></td>
                                   
                                    <td>
                                        <?php
                                        if($leadsNow['status'] == 'active'){
                                        ?>
                                    <span class="label label-info"><?=$leadsNow['status']?></span>
                                    <?php
                                    }else{
                                    ?>
                                     <span class="label label-danger"><?=$leadsNow['status']?></span>
                                    <?php
                                    }
                                    ?>
                                    </td>
                                    <td colspan="3">
                                        <span style="float: left;">
                                       <?php
                                        $result = mysqli_query($dbc,"SELECT * FROM vehicle_info WHERE vehicle_maker = '$leadsNow[maker_id]' AND vehicle_brand = '$leadsNow[brand_id]' AND vehicle_status != 'sold' AND vehicle_chassis_code='$leadsNow[chassis_code]'");


                                        if(mysqli_num_rows($result)>0){
                                            $info = mysqli_fetch_assoc($result);
                                        ?>
                                            <span class="label lable-success">We have</span><br/><br/>
                                            StockID :<a href="trade.php?vehicle_id=<?=$info['vehicle_id']?>" target="_blank" class="mt-5"> <?=$info['vehicle_stock_id']?></a><br/>
                                            Color : <?=$info['vehicle_color_name']?> 

                                        <?php
                                        } else{
                                            echo "<span class='label label-danger'>Not Have</span>";
                                        }
                                        ?>
                                      </span>
                                   <!--  <a href="https://viber.me/923457573667/">abcd</a> -->
                                    </td>
                                    <td>
                                      <?php if (@$userPrivileges['nav_edit']==1 || $fetchedUserRole=="admin"): ?>
          
                                       <button type="button"  class="btn btn-xs btn-primary float-left" data-toggle="modal" onclick="editleads(<?=$leadsNow['leads_id']?>)" data-target="#add_inquiry_modal"><i class="fa fa-edit"></i></button>
                               <?php endif; ?>
                                       <?php if (@$userPrivileges['nav_delete']==1 || $fetchedUserRole=="admin"): ?>
           
                                        <form method="POST" action="">
                                            <input type="hidden" name="lead" value="<?=$leadsNow['leads_id']?>">
                                            <button class="btn btn-xs btn-danger" type="submit" name="delete"><i class="fa fa-trash" ></i></button>  
                                             <button class="btn btn-xs btn-warning" type="submit" name="deactive"> <i class="fa fa-remove" ></i></button>

                                     </form>
                                          <?php endif; ?>
                                    </td>
                                   
                                   

                                    
                                   </tr>  
                                        <?php 
                                        endwhile;   
                                        ?>
                                      <?php $x++;
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
<!-- Modal start -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" >Leads ID:<span id="modalfor"></span></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          Lead For = <span id="leadsid"></span>
          <hr>
          
     
            <div class="row">
                <div class="col-sm-6">
                    <span>
                        Years :  <span id="years"></span>
                         <br/>
                        Drive : <span id="drive"></span> <br/>
                        transmission  : <span id="transmission"></span><br/>
                        Seats : <span id="seats"></span> <br/>
                        Color Choice : <span id="colors"></span>      <br/>
                    </span>                     
                </div>
                <div class="col-sm-6">
                    <span>
                       
                        Chassis Code : <span id="chassis_code"></span> <br/>
                        Engine CC :<span id="engine_cc"></span> <br/>
                        Fuel  : <span id="fuel"></span> <br/>
                        Doors : <span id="doors"></span> <br/>
                        Feature Required : <span id="Feature"></span><br/>
                        Next Follow up Date : <span id="date" class="lable label-danger" style="font-size: 30px"></span>
                        <br/>
                    </span>   
                </div>
                Nuration /Hint /Special Note: <span id="note"></span><br/>

            </div>
    </div>
    
 
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>




<!-- modal end -->


<!-- Secind modal -->

<div class="modal fade" id="myModal2">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

  <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" >Leads ID:<span id="modalfor2"></span></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          Lead For = <span id="leadsid2"></span>
         
          <hr>
          
     
            <div class="row">
                <div class="col-sm-12">
                   

                    <form action="php_action/custom_action2.php" method="POST" role="form" id="formDatafinal2" >
                    <div class="form-group row">
                         <input type="hidden" name="leadsid" class="leadsid">
                <div class="col-sm-2">
                <label for=""> Source </label>
            </div>
                <!-- <input list="vehicle_door1" name="vehicle_door" id="vehicle_door" required="required" class="form-control"> -->
                <div class="col-sm-4">
                    <input list="source" name="sourcetype" id="sourcetype" required class="form-control">

                    <datalist id="source">
                      <option value="Viber">
                      <option value="Whatsapp">
                      <option value="Facebook">
                      <option value="Instagram">
                      <option value="Mobile">
                    </datalist>
                </div> 
                 <div class="col-sm-2">
                <label for=""> ScreenShot </label>
                </div>  
                    <div class="col-sm-4">
                        <input type="file" name="screenshot" id="screenshot" class="form-control"  required >
                    </div>

                    <div class="col-sm-2">
                <label for=""> Next Follow Up date   </label>
                </div>  
                    <div class="col-sm-4">
                        <input type="date"   name="nextdate" id="next_date"  onchange="compareDate('follow_up_date_check','next_date','add_lead_btn')" class="form-control" required>
                          <input type="hidden"  name="follow_up_date_check" id="follow_up_date_check" value="">
                
                        </div>


                     <div class="col-sm-2">
                <label for=""> Note   </label>
                </div>  
                    <div class="col-sm-4">
                        <input type="text" name="note"  class="form-control">
                    </div>



            </div><!-- form group --> 
 <input type="submit" class="btn btn-success pull pull-right" id="add_lead_btn"> 

                        
                    </form>


                </div>
                

            </div>
    </div>
    
 
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  <!-- Modal second end -->

<?php
include_once "includes/footer.php";

?>        

<!-- Modal start -->

 <!-- Modal -->
  <div class="modal  fade" id="add_inquiry_modal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <h4><span class="glyphicon glyphicon-lock"></span> Leads</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form role="form" action="php_action/custom_action2.php" id="saveleads">
            <div class="row">
              <div class="col-sm-6"><input type="text" readonly required value="" name="getleadscustomerID2" id="getleadscustomerID2" class="form-control"></div>
              <div class="col-sm-6">
             <input type="text" readonly required value="" name="getleadscustomerName" id="getleadscustomerName" class="form-control">
             <input type="hidden"  value="" name="lead_id" id="lead_id" class="form-control">
                
              </div>
            </div>
            
            <div class="row">
                <div class="col-sm-6">
                     <div class="form-group">
                <label for="">Maker.</label>            
                <input type="hidden" name="saveleads">
                <select name="vehicle_maker" onchange="loadBrands(this.value)" id="vehicle_maker" class="form-control abcCustomNew" required="required">
                    <option value="">~~SELECT~~</option>
                    <?php $q = get($dbc,"maker WHERE maker_sts = '1'");
                    while($r = mysqli_fetch_assoc($q)): ?>
                        <option value="<?=$r['maker_id']?>"><?=$r['maker_name']?></option>
                            <?php endwhile ?>
                </select>
            </div><!-- form group -->

            <div class="form-group">
                <label for=""> Year.</label>
                <span id="get_inquire_years"></span>
                 <select id="dates-field2" class="multiselect-ui styling form-control" multiple="multiple" name="years[]" >
                         <?php
                                $date = date('Y');
                                for ($i = $date; $i >= 1900; $i--) {?>
                                    <option value="<?=$i?>"><?=$i?></option>
                                <?php
                                    } 
                                ?>
                         </select>      
                <!-- <input list="vehicle_reg_month1" name="vehicle_reg_month" id="vehicle_reg_month" class="form-control" required="required" readonly> -->
                
            </div><!-- form group -->
            <div class="form-group">
                <label for="">Drive</label>
                <!-- <input list="vehicle_drive1" name="vehicle_drive" id="vehicle_drive" class="form-control" required="required"> -->
                
                <select list="vehicle_drive1" name="vehicle_drive" id="vehicle_drive" class="form-control" required="required">
                    <option value="">~~SELECT~~</option>
                    <?php $q = get($dbc,"drive WHERE drive_sts = '1'");
                            while($r = mysqli_fetch_assoc($q)): ?>
                        <option <?=@(strtolower($r['drive_name'])==strtolower($stock['vehicle_drive']))?"selected":""?> value="<?=$r['drive_name']?>"><?=$r['drive_name']?></option>
                    <?php endwhile ?>
                </select>
                
                        
            </div><!-- form group -->
            <div class="form-group">
                <label for="">Transmission</label>
                <!-- <input list="vehicle_transmission1" required="required" name="vehicle_transmission" id="vehicle_transmission" class="form-control"> -->
                <select list="vehicle_transmission1" required="required" name="vehicle_transmission" id="vehicle_transmission" class="form-control">
                    <option value="">~~SELECT~~</option>
                    <?php $q = get($dbc,"transmission WHERE transmission_sts = '1'");
                    while($r = mysqli_fetch_assoc($q)): ?>
                        <option <?=@(ucwords($r['transmission_name'])==ucwords($stock['vehicle_transmission']))?"selected":""?> value="<?=$r['transmission_name']?>"><?=$r['transmission_name']?></option>
                            <?php endwhile ?>
                </select>           
            </div><!-- form group -->
            <div class="form-group">
                <label for="">Seats</label>
                <!-- <input list="vehicle_seat1" name="vehicle_seat" id="vehicle_seat" class="form-control"> -->
                <select  list="vehicle_seat1" name="vehicle_seat" id="vehicle_seat" class="form-control">
                    <option value="">~~SELECT~~</option>
                    <?php $q = get($dbc,"seats WHERE seats_sts = '1'");
                    while($r = mysqli_fetch_assoc($q)): ?>
                        <option value="<?=$r['seats_name']?>"><?=$r['seats_name']?></option>
                            <?php endwhile ?>
                </select>           
            </div><!-- form group -->
            <div class="form-group">
                <label for="">Color Name</label>
                <span id="get_inquire_color"></span>

                <!-- <select list="vehicle_color_name1" autocomplete="off" onchange="loadcolorCode(this.value)" name="vehicle_color_name" id="vehicle_color_name" required="required" class="form-control"> -->
                     <select id="dates-field2" class="multiselect-ui styling form-control" multiple="multiple" name="vehicle_color_name[]" id="vehicle_color_name" required="required">
                    <option value="">~~SELECT~~</option>
                        <?php $q = get($dbc,"color_code WHERE color_code_sts = '1'");
                        while($r = mysqli_fetch_assoc($q)): ?>
                    <option value="<?=$r['color_name']?>"><?=$r['color_name']?></option>
                    <?php endwhile ?>
                </select>           
            </div><!-- form group -->

            <div class="form-group">
                <label for="">Special Inquiry Note</label>
                <textarea  rows="4" class="form-control" name="note" id="iquirey_special_note"></textarea>

            </div>



                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                <label for="">Brand.</label>            
                <select name="vehicle_brand" onchange="loadChassis(this.value)" id="vehicle_brand" class="form-control fuckJS" required="required">
                    <option class="fuckJS" value="">~~SELECT~~</option>
                    <option value="">~~SELECT~~</option>
                    <?php $q = get($dbc,"brands WHERE brand_status = '1'");
                    while($r = mysqli_fetch_assoc($q)): ?>
                        <option value="<?=$r['brand_id']?>"><?=$r['brand_name']?></option>
                            <?php endwhile ?>
                </select>
            </div><!-- form group -->

            <div class="form-group">
                <label for="">Chassis Code</label>          
                <!-- <input type="text"  class="form-control form-control-sm"> -->
                <select name="vehicle_chassis_code" id="vehicle_chassis_code" class="form-control" required="required" style="text-transform: uppercase ">
                    <option value="">~~SELECT~~</option>
                    <?php $q = get($dbc,"models WHERE model_sts = '1'");
                    while($r = mysqli_fetch_assoc($q)): ?>
                        <option value="<?=$r['model_id']?>" style="text-transform: uppercase!important;"><?=$r['model_name']?></option>
                            <?php endwhile ?>
                </select>
            </div><!-- form group -->

            <div class="form-group">
                <label for="">Engine CC</label>
                <!-- <input list="vehicle_cc1" name="vehicle_cc" id="vehicle_cc" class="form-control" required="required"> -->
                <select list="vehicle_cc1" name="vehicle_cc" id="vehicle_cc" class="form-control" required="required">
                    <option value="">~~SELECT~~</option>
                    <?php $q = get($dbc,"cc WHERE cc_sts = '1'");
                    while($r = mysqli_fetch_assoc($q)): ?>
                        <option value="<?=$r['cc_name']?>"><?=$r['cc_name']?></option>
                    <?php endwhile ?>
                </select>           
            </div><!-- form group -->
            <div class="form-group">
                <label for="">Fuel</label>
                <!-- <input list="vehicle_fuel1" name="vehicle_fuel" id="vehicle_fuel" class="form-control" required="required"> -->
                <select  list="vehicle_fuel1" name="vehicle_fuel" id="vehicle_fuel" class="form-control" required="required">
                    <option value="">~~SELECT~~</option>
                    <?php  $q = get($dbc,"fuel WHERE fuel_sts = '1'");
                    while($r = mysqli_fetch_assoc($q)): ?>
                        <option  value="<?=$r['fuel_name']?>"><?=$r['fuel_name']?></option>
                    <?php endwhile ?>
                </select>           
            </div><!-- form group -->
            <div class="form-group">
                <label for="">Doors</label>
                <!-- <input list="vehicle_door1" name="vehicle_door" id="vehicle_door" required="required" class="form-control"> -->
                <select list="vehicle_door1" name="vehicle_door" id="vehicle_door" required="required" class="form-control">
                    <option value="">~~SELECT~~</option>
                    <?php $q = get($dbc,"doors WHERE doors_sts = '1'");
                            while($r = mysqli_fetch_assoc($q)): ?>
                        <option value="<?=$r['doors_name']?>"><?=$r['doors_name']?></option>
                    <?php endwhile ?>
                </select>           
            </div><!-- form group -->


            <div class="form-group">
                <label for="">Features </label>
                <span id="get_inqurey_features"></span>
                <!-- <input list="vehicle_door1" name="vehicle_door" id="vehicle_door" required="required" class="form-control"> -->
                <select id="dates-field2" class="multiselect-ui styling form-control" list="vehicle_feature" name="vehicle_feature[]" id="vehicle_feature"  >
                    <option value="">~~SELECT~~</option>
                    <?php $q = get($dbc,"vehicle_feature WHERE vehicle_feature_sts = '1'");
                            while($r = mysqli_fetch_assoc($q)): ?>
                        <option value="<?=$r['vehicle_feature_id']?>"><?=$r['vehicle_feature_name']?>(<?=$r['vehicle_feature_category']?>)</option>
                    <?php endwhile ?>
                </select>           
            </div><!-- form group -->

            <div class="form-group">
                <label for="">Next Follow up Date </label>
              
                <input type="date" onchange="compareDate('current_date','next_date','add_inquiry_btn')"  name="nextdate" id="next_date" class="form-control" required>
                  <input type="hidden"  name="current_date" id="current_date" value="<?=date("Y-m-d")?>">
                
                            
            </div><!-- form group -->







                </div>

            
            
              <button type="submit" id="add_inquiry_btn" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Save Leads</button>
<!-- Delete -->


<!-- deler donme -->

          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
         
        </div>
      </div>
      
    </div>
  </div>


<!-- modal end -->            
<script type="text/javascript">
     function compareDate(from,to,dis) {

        var current_date=$('#'+from).val();
        var invoice_next_due=$('#'+to).val();
  
        if (invoice_next_due<current_date) {
            $('#'+dis).prop('disabled',true);
            alert('Date Should Not Less then Current Date');
        }
        else{
            $('#'+dis).prop('disabled',false);

        }
    }
    function showleads(leads_id,vehiclename){

        //alert(leads_id);
        $("#myModal").modal();
        
        $.ajax({
                            url: 'php_action/custom_action2.php',
                            type: 'post',
                            data: {
                                leads_id:leads_id
                            },
                            dataType: 'json',
                             
                            success:function(response) {

     $("#modalfor").html(leads_id);
        $("#leadsid").html(vehiclename);
        $("#years").html((JSON.parse(response.year)));
        $("#drive").html(response.drive);
        $("#transmission").html(response.transmission);
        $("#seats").html(response.seats);
        $("#colors").html(response.color);
        $("#chassis_code").html(response.chassis_code);
        $("#engine_cc").html(response.engine_cc);
        $("#fuel").html(response.fuel);
        $("#doors").html(response.doors);
        $("#Feature").html(response.features);
        $("#date").html(response.followup_next_date);
        $("#note").html(response.leads_note);

       
    }
  
 });       

    }

    function Ssset(leads_id,followup_next_date){
       // alert(leads_id);
         $("#myModal2").modal();
         $(".leadsid").val(leads_id);
         $("#follow_up_date_check").val(followup_next_date);
    }



$('#formDatafinal2').submit(function(){
    
    event.preventDefault();
     var form = $('#formDatafinal2');
     //alert(form);
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function() {
                //alert('abcd');
                $('#saveData').attr("disabled","disabled");
                 $('#saveData').text("Loading...");
                $(".loaderAjax").show(); 
                refereshdocs();
            },
            success:function (response) {

                $('#myModal2').modal('hide');
                    $('#myModal2').on('hidden.bs.modal', function () {
                        _this.render();
                    })

                        swal({
                          title: 'added',
                          text: 'Leads added successfully',
                          type : 'success',
                          icon: 'success',
                          timer: 2500,
                          buttons: false,
                          showCancelButton: false,
                          showConfirmButton: false
                        }); 
                       
               
            }
        });//ajax call
   
});

    
</script>


<?php
if(isset($_POST['deactive'])){
    $leadsIDNOW = $_POST['lead'];
   $zz =  mysqli_query($dbc,"UPDATE leads SET status = 'deactive' WHERE leads_id = '$leadsIDNOW'");
   if($zz){
    ?>
    <script type="text/javascript">
         swal({
                          title: 'added',
                          text: 'Leads Deactive successfully',
                          type : 'success',
                          icon: 'success',
                          timer: 2500,
                          buttons: false,
                          showCancelButton: false,
                          showConfirmButton: false
                        }); 
                       
    </script>
  <?php  
   }
    
redirect('show_leads.php');
}

if(isset($_POST['delete'])){
    $leadsIDNOW = $_POST['lead'];
   $zzz =  mysqli_query($dbc,"DELETE FROM leads WHERE leads_id = '$leadsIDNOW'");
   if($zzz){
    ?>
    <script type="text/javascript">
         swal({
                          title: 'added',
                          text: 'Leads DELETE successfully',
                          type : 'success',
                          icon: 'success',
                          timer: 2500,
                          buttons: false,
                          showCancelButton: false,
                          showConfirmButton: false
                        }); 
                       
    </script>
  <?php  
   }
    redirect('show_leads.php');

}

?>

<script>

$(document).ready(function(){
  
  });//main
$('#add_inquiry_modal').on('show.bs.modal', function (e) {

});
function setcustomerID(id,name) {
   
console.log(id);
$('#get_inquire_years').html();
$('#get_inquire_color').html();
$('#get_inqurey_features').html();


document.getElementById('saveleads').reset();
    $("#getleadscustomerID2").val(id);
    $("#getleadscustomerName").val(name);
     
    
}
function editleads(id){
   // console.log(id);

document.getElementById('saveleads').reset();
 $.ajax({
            url:'php_action/custom_action.php',
            type:'post',
            data:{action:"editleads",id:id},
            beforeSend:function() {
                //$('#expense_account_btn').prop("disabled",true);
                
                // $('#saveData1').text("Loading...");
            },
            success:function (data) {
              var json = JSON.parse($.trim(data));
               console.log(json.customer_id);
               $('#lead_id').val(json.leads_id);
               $('#vehicle_maker').val(json.maker_id);
               $('#vehicle_brand').val(json.brand_id);
               $('#vehicle_drive').val(json.drive);
               $('#vehicle_transmission').val(json.transmission);

               $('#vehicle_seat').val(json.seats);

               $('#vehicle_color_name').val(json.color);
                               
               var year;
               year = json.year.replace(/[\[\]']+/g, '');
               $('#get_inquire_years').html("<br> Selected : "+year.replace(/\"/g, ""));
               var color;
               color=json.year.replace(/[\[\]']+/g, '');
               $('#get_inquire_color').html("<br> Selected : "+color.replace(/\"/g, ""));
               var features;
               features=json.features.replace(/[\[\]']+/g, '');
               $('#get_inqurey_features').html("<br> Selected : "+features.replace(/\"/g, ""));
               $('#vehicle_chassis_code').val(json.chassis_code);
               $('#vehicle_cc').val(json.engine_cc);
              // $('#vehicle_fuel').val(json.fuel);
               $('#vehicle_fuel option[value="'+json.fuel+'"]').prop("selected", true); 

              
               $('#vehicle_door').val(json.doors);
               $('#vehicle_feature').val(json.features);
               $('#nextdate').val(json.followup_next_date);
               $('#iquirey_special_note').val(json.leads_note);
               $('#getleadscustomerID2').val(json.customer_id);
            
            }
        });//ajax call
}
$('#formDatafinal').submit(function(){
    
    event.preventDefault();
     var form = $('#formDatafinal');
     //alert(form);
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function() {
                //alert('abcd');
                $('#saveData').attr("disabled","disabled");
                 $('#saveData').text("Loading...");
                $(".loaderAjax").show(); 
                refereshdocs();
            },
            success:function (response) {

                    var idNow = parseInt(response);
                    //alert(idNow);
                    if(idNow != null){
                    GetleadsNow(idNow);
                     
}
                        swal({
                          title: 'added',
                          text: 'Leads added successfully',
                          type : 'success',
                          icon: 'success',
                          timer: 2500,
                          buttons: false,
                          showCancelButton: false,
                          showConfirmButton: false
                        }); 
                       //GetleadsNow(id);
                      
                //alert(msg);
                $(".loaderAjax").hide(); 
                $('#saveData').text("Save");
                $('#formData').each(function(){
                    this.reset();
                });    
                $('#saveData').removeAttr("disabled");
                $('#formData').css("opacity","");   
                $('.msg').text(msg).addClass("alert alert-success").fadeIn(6000).fadeOut(4000);
               
            }
        });//ajax call
   
});



$('#saveleads').submit(function(){
    
    event.preventDefault();
     var form = $('#saveleads');
     //alert(form);
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function() {
                //alert('abcd');
                $('#saveData').attr("disabled","disabled");
                 $('#saveData').text("Loading...");
                $(".loaderAjax").show(); 
                refereshdocs();
            },
            success:function (response) {
                    $("#leads_lists").load(location.href+" #leads_lists");

                     //$("#myModal").hide();
                     $('#add_inquiry_modal').modal('hide');
                    $('#add_inquiry_modal').on('hidden.bs.modal', function () {
                        _this.render();
                    })
//                     var idNow = parseInt(response);
//                     //alert(idNow);
//                     if(idNow != null){
//                     GetleadsNow(idNow);
                     
// }
//                         swal({
//                           title: 'added',
//                           text: 'Leads added successfully',
//                           type : 'success',
//                           icon: 'success',
//                           timer: 2500,
//                           buttons: false,
//                           showCancelButton: false,
//                           showConfirmButton: false
//                         }); 
//                        //GetleadsNow(id);
                      
                //alert(msg);
                $(".loaderAjax").hide(); 
                $('#saveData').text("Save");
                $('#formData').each(function(){
                    this.reset();
                });    
                                $('#saveData').removeAttr("disabled");
                $('#formData').css("opacity","");   
                $('.msg').text(msg).addClass("alert alert-success").fadeIn(6000).fadeOut(4000);
                
               
            }
        });//ajax call
   
});


// goTo("another page", "example", 'example.html');

</script>



<script type="text/javascript">
$(function() {
    $('.multiselect-ui').multiselect({
        includeSelectAllOption: true
    });
});

</script>
<style type="text/css">
    span.multiselect-native-select {
    position: relative
}
span.multiselect-native-select select {
    border: 0!important;
    clip: rect(0 0 0 0)!important;
    height: 1px!important;
    margin: -1px -1px -1px -3px!important;
    overflow: hidden!important;
    padding: 0!important;
    position: absolute!important;
    width: 1px!important;
    left: 50%;
    top: 30px
}
.multiselect-container {
    position: absolute;
    list-style-type: none;
    margin: 0;
    padding: 0
}
.multiselect-container .input-group {
    margin: 5px
}
.multiselect-container>li {
    padding: 0
}
.multiselect-container>li>a.multiselect-all label {
    font-weight: 700
}
.multiselect-container>li.multiselect-group label {
    margin: 0;
    padding: 3px 20px 3px 20px;
    height: 100%;
    font-weight: 700
}
.multiselect-container>li.multiselect-group-clickable label {
    cursor: pointer
}
.multiselect-container>li>a {
    padding: 0
}
.multiselect-container>li>a>label {
    margin: 0;
    height: 100%;
    cursor: pointer;
    font-weight: 400;
    padding: 3px 0 3px 30px
}
.multiselect-container>li>a>label.radio, .multiselect-container>li>a>label.checkbox {
    margin: 0
}
.multiselect-container>li>a>label>input[type=checkbox] {
    margin-bottom: 5px
}
.btn-group>.btn-group:nth-child(2)>.multiselect.btn {
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px
}
.form-inline .multiselect-container label.checkbox, .form-inline .multiselect-container label.radio {
    padding: 3px 20px 3px 40px
}
.form-inline .multiselect-container li a label.checkbox input[type=checkbox], .form-inline .multiselect-container li a label.radio input[type=radio] {
    margin-left: -20px;
    margin-right: 0
}

</style>
<?php
include_once 'multiselectjs.php';
?>

