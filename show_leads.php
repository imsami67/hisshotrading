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
							
                           <table class="table example1 table-xs" style="text-align: center;">
                            <thead>
                            <tr>
                                <th>Customer ID</th>
                                <th>Assign To</th>
                                <th>Added By</th>
                                <th>Customer Info</th>
                                <th>Contact</th>
                                <th>Total active Leads</th>
                               
                                <th>Customer Leads Report</th>

                                
                                
                            </tr>
                            </thead>
                            <tbody>
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
                                    <td><?=$usersNow['username']?>(<?=$usersNow['user_role']?>)</td>
                                    <td><?=$assign_to['username']?>(<?=$assign_to['user_role']?>)</td>
                                    <td>
                                        <?=$r['customer_name']?>(<?=$r['company_name']?>)<br/>
                                        <a href="mailto:<?=$r['email']?>"><?=$r['email']?></a><br/>
                                        <a href="tel:<?=$r['contact1']?>"><?=$r['contact1']?></a>
                                    </td>
                                    <td>
                                        
                                           <a href="https://api.whatsapp.com/send?phone=<?=$r['contact1']?>&text=Hi..!." target="_blank"><i class="fa fa-whatsapp" style="font-size: 40px;color: green"></i></a>  <br/>
                                          <a href="https://viber.me/<?=$r['contact1']?>/" target="_blank">Viber </a> 
                                    </td>
                                    <td>
                                        <?php
                                        $activeleads = mysqli_query($dbc,"SELECT * FROM leads WHERE customer_id = '$r[leads_cus_id]'");
                                         $number = mysqli_num_rows($activeleads);
                                        ?>
                                        <label class="label lable-success" style="font-size: 28px"><?=$number?></label>
                                    </td>

                                    <td>
                                         <a href="leadreport.php?customer_id=<?=$r['leads_cus_id']?>" class="btn btn-info" target="_blank">Leads Report</a>
                                    </td>
                                   
                                        
                                   
                                    
                                </tr>
                        

                                 
                                        <?php
                                        $y=1;
                                        while($leadsNow = mysqli_fetch_assoc($activeleads)):?>
                                           <tr colspan="6"> 
                                       
                                            <?php
$maker = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM maker WHERE maker_id = '$leadsNow[maker_id]'"));
$brand = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM brands WHERE brand_id = '$leadsNow[brand_id]'"));

                                            ?>
                                            <td><?=$x?>-<?=$y?></td>
                                            <td><?=date('d-M-Y',strtotime($leadsNow['add_datetime']))?></td>
                                  <td>  <a  class="label label-info" style="font-size: 15px;" 
                                    onclick="showleads(<?=$leadsNow['leads_id']?>,'<?=$maker['maker_name']?> <?=$brand['brand_name']?>')"><?=$maker['maker_name']?> <?=$brand['brand_name']?> </a></td>
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
                                    <td>
                                    <button class="btn btn-success" onclick="Ssset(<?=$leadsNow['leads_id']?>)"><span class="fa fa-plus"></span></button>
                                    </td>
                                    <td>
                                       <?php
                                        $result = mysqli_query($dbc,"SELECT * FROM vehicle_info WHERE vehicle_maker = '$leadsNow[maker_id]' AND vehicle_brand = '$leadsNow[brand_id]' AND vehicle_status != 'sold'");


                                        if(mysqli_num_rows($result)>0){
                                            $info = mysqli_fetch_assoc($result);
                                        ?>
                                            <span class="label lable-success">We have</span><br/>
                                            StockID :<a href="trade.php?vehicle_id=<?=$info['vehicle_id']?>" target="_blank"> <?=$info['vehicle_stock_id']?></a><br/>
                                            Color : <?=$info['vehicle_color_name']?> 

                                        <?php
                                        } else{
                                            echo "<span class='label label-danger'>Not Have</span>";
                                        }
                                        ?>
                                   <!--  <a href="https://viber.me/923457573667/">abcd</a> -->
                                    </td>
                                    <td>
                                        <form method="POST" action="">
                                            <input type="hidden" name="lead" value="<?=$leadsNow['leads_id']?>">
                                            <button class="btn btn-xs btn-warning" type="submit" name="delete"><i class="fa fa-trash" ></i></button> |  
                                             <button class="btn btn-xs btn-warning" type="submit" name="deactive"> <i class="fa fa-remove" ></i></button>
                                        
                                     </form>
                                      
                                    </td>
                                   
                                   

                                    
                                   </tr>  
                                        <?php 
                                        endwhile;   
                                        ?>
                                    
                              </tbody>
                            <?php
                            endwhile;
                            ?>    
                           
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
                        <input type="date" name="nextdate" class="form-control" >
                    </div>


                     <div class="col-sm-2">
                <label for=""> Note   </label>
                </div>  
                    <div class="col-sm-4">
                        <input type="text" name="note"  class="form-control">
                    </div>



            </div><!-- form group --> 
 <input type="submit" class="btn btn-success pull pull-right"> 

                        
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
<script type="text/javascript">
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

    function Ssset(leads_id){
       // alert(leads_id);
         $("#myModal2").modal();
         $(".leadsid").val(leads_id);
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