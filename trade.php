



<?php include_once "includes/header.php";?>

<style>

  :root {

  --green: #96c03d;

  --active: #2c3f4c;

}

body,p,span,select,option,input,datalist{

    text-transform: capitalize;

}

select,option{

     text-transform: capitalize;

    

}

input[list]

{

  text-transform: capitalize;

}





.nav-tabs.wizard {

  background-color: transparent;

  padding: 0;

  width: 100%;

  margin: 1em auto;

  border-radius: .25em;

  clear: both;

  border-bottom: none;

}



/*.nav-tabs.wizard li {

  width: 100%;

  float: none;

  margin-bottom: 3px;

}*/



.nav-tabs.wizard li>* {

  position: relative;

  padding: 1em .8em .8em 2.5em;

  color: #999999;

  background-color: #dedede;

  border-color: #dedede;

}



.nav-tabs.wizard li.completed>* {

  color: #fff;

  background-color: var(--green);

  border-color: var(--green);

  // border-bottom: none;

}



.nav-tabs.wizard li.active>* {

  color: #fff;

  background-color: var(--active);

  border-color: var(--active);

  // border-bottom: none;

}



.nav-tabs.wizard li::after:last-child {

  border: none;

}



.nav-tabs.wizard > li > a {

  opacity: 1;

  font-size: 14px;

}



.nav-tabs.wizard a:hover {

  color: #fff;

  background-color: var(--active);

  border-color: var(--active)

}



span.step {

  display: inline-block;

  padding: 10px 0 0 0;

  background: #ffffff;

  width: 35px;

  line-height: 100%;

  height: 35px;

  margin: auto;

  border-radius: 50%;

  font-weight: bold;

  font-size: 16px;

  color: #555;

  margin-bottom: 10px;

  text-align: center;

}



@media(min-width:992px) {

  .nav-tabs.wizard li {

    position: relative;

    padding: 0;

    margin: 4px 4px 4px 0;

    width: 19.6%;

    float: left;

  }

  .nav-tabs.wizard li.active a {

    // padding-top: 15px;

  }

  .nav-tabs.wizard li::after,

  .nav-tabs.wizard li>*::after {

    content: '';

    position: absolute;

    top: 0;

    left: 100%;

    height: 0;

    width: 0;

    border: 45px solid transparent;

    border-right-width: 0;

    /*border-left-width: 20px*/

  }

  .nav-tabs.wizard li::after {

    z-index: 1;

    -webkit-transform: translateX(4px);

    -moz-transform: translateX(4px);

    -ms-transform: translateX(4px);

    -o-transform: translateX(4px);

    transform: translateX(4px);

    border-left-color: #fff;

    margin: 0

  }

  .nav-tabs.wizard li>*::after {

    z-index: 2;

    border-left-color: inherit;

  }

  .nav-tabs.wizard > li:nth-of-type(1) > a {

    border-top-left-radius: 10px;

    border-bottom-left-radius: 10px;

  }

  .nav-tabs.wizard li:last-child a {

    border-top-right-radius: 10px;

    border-bottom-right-radius: 10px;

  }

  .nav-tabs.wizard li:last-child {

    margin-right: 0;

  }

  .nav-tabs.wizard li:last-child a:after,

  .nav-tabs.wizard li:last-child:after {

    content: "";

    border: none;

  }

  span.step {

    display: block;

  }

}

</style>

<!-- start page content -->

            <div class="page-content-wrapper refreshTrade ">

                <div class="page-content">

                  <?php 

                    @$id = $_GET['vehicle_id'];

                    if ($id == "") {

                      $title = "Trade";

                      $title_color = "green";

                      $font_size = "25px";

                      $height = "45px";

                        $arrow='w-100';
                      $act = "d-none";

                    }else{
                        $arrow='w-25';


                      $title = "Edit Trade";

                      $title_color = "red";

                      $font_size = "25px";

                      $height = "45px";

                      @$stock = fetchRecord($dbc,"vehicle_info","vehicle_id",$_GET['vehicle_id']);
                      @$models = fetchRecord($dbc,"models","model_id",$stock['vehicle_chassis_code']);

                      
                      @$vehicle_expense = fetchRecord($dbc,"vehicle_expense","vehicle_info_id",$stock['vehicle_id']);

                      @$customer_info = fetchRecord($dbc,"customers","vehicle_id",$stock['vehicle_id']);

                      @$maker = fetchRecord($dbc,"maker","maker_id",$stock['vehicle_maker'])['maker_name'];

                      @$brand = fetchRecord($dbc,"brands","brand_id",$stock['vehicle_brand'])['brand_name'];

                      @$auction_info = fetchRecord($dbc,"auction_info","vehicle_id",$stock['vehicle_id'])['auction_id'];

                      @$get_ricksu = fetchRecord($dbc,"ricksu","vehicle_id",$stock['vehicle_id']);

                      @$reservation=fetchRecord($dbc,"reservation","vehicle_id",$stock['vehicle_id'])['reservation_id'];

                      @$export_info=fetchRecord($dbc,"export_info","vehicle_id",$stock['vehicle_id'])['export_info_id'];

                      @$consignee=fetchRecord($dbc,"consignee_info","vehicle_id",$stock['vehicle_id'])['consignee_info_id'];
  
                      @$inspection_info=fetchRecord($dbc,"inspection_info","vehicle_id",$stock['vehicle_id'])['inspection_info_id'];

                      @$shipment=fetchRecord($dbc,"shipment","vehicle_id",$stock['vehicle_id'])['shipment_id'];

                      @$airmail=fetchRecord($dbc,"airmail","vehicle_id",$stock['vehicle_id'])['airmail_id'];
                  


          @$auction_person =mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM auction_person WHERE vehicle_id = '$id' AND trade_type='person'"));
          @$auction_company =mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM auction_person WHERE vehicle_id = '$id' AND trade_type='company'"));
          @$auction_only =mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM auction_info WHERE vehicle_id = '$id'"));
            $auction_only_check = 0;
             $auction_person_check = 0;
             $auction_company_check=0;
             $dib="";
          if(@$auction_person['vehicle_id'] == $id){
            $purchase_date_top=@$auction_person['purchase_date'];
             $auction_person_check = 1;
             $auction_only_display = "display-none";
             $auction_person_display="display-block";
             $auction_company_display = "display-none";
             $dib="disabled";

          }elseif(@$auction_only['vehicle_id'] == $id){
            $purchase_date_top=@$auction_only['auction_date'];
             $auction_only_check = 1;
             $auction_only_display = "display-block";
             $auction_person_display="display-none";
             $auction_company_display = "display-none";
             $dib="disabled";


          }elseif(@$auction_company['vehicle_id'] == $id){
            $purchase_date_top=@$auction_company['purchase_date'];
             $auction_company_check = 1;
             $auction_only_display = "display-none";
             $auction_person_display="display-none";
             $auction_company_display = "display-block";
             $dib="disabled";


          }else{
            $dib=$purchase_date_top="";
             $auction_only_display = "display-none";
             $auction_person_display="display-none";
             $auction_company_display = "display-none";

             $auction_only_check = 0;
             $auction_person_check = 0;
             $auction_company_check=0;

          }

                    }

                  ?>

<div class="success-messages"></div> 

<div class="card">

  <div class="card-header card-bg text-white h2 text-center" style="height: <?=$height?>;font-size: <?=$font_size?>"><?=$title?> </div>

    <div class="card-body">

      <div class="container">

        

        <input type="text" value="<?=@$auction_info?>" id="get_auction_idMain" class=" d-none" >

        <input type="text" value="<?=@$get_ricksu['ricksu_id']?>" id="get_ricksu_idMain" class=" d-none" >

        <input type="text" value="<?=@$reservation?>" id="get_reservation_idMain" class=" d-none" >

        <input type="text" value="<?=@$export_info?>" id="get_export_info_idMain" class=" d-none" >

        <input type="text" value="<?=@$consignee?>" id="get_consignee_idMain" class=" d-none" >

        <input type="text" value="<?=@$inspection_info?>" id="get_inspection_info_idMain" class=" d-none" >

        <input type="text" value="<?=@$shipment?>" id="get_shipment_idMain" class=" d-none" >

        <input type="text" value="<?=@$airmail?>" id="get_airmail_idMain" class=" d-none" >
            <input type="hidden" name="" id="current_date" class="current_date" value="<?=date('Y-m-d')?>">









          <!--         

          <ul class="nav nav-tabs nav-fill wizard" id="myTab" role="tablist">

            <li class="nav-item nav_vehicle_info2 active">

              <a href="#vehicle_info2" class="nav-link active" id="vehicle-tab" data-toggle="tab" role="tab" aria-controls="veicle" aria-selected="true"><span class="step">1</span>Main Info</a>

            </li>

            <li class="nav-item nav_image_galary">

              <a href="#image_galary" class="nav-link" id="image_galary-tab" data-toggle="tab" role="tab" aria-controls="contact" aria-selected="false"><span class="step">2</span>Image Gallery</a>

            </li>

        </ul>



          <div class="tab-content">

            <div class="tab-pane fade show active" id="vehicle_info2" role="tabpanel" aria-labelledby="veicle2-tab"> -->

              <div class="row <?=@$act?>">

                <div class="col-sm-3">

                  <label for="">Stock ID</label>

                  <input type="text" class="form-control" id="stockMain" readonly="readonly" value="<?=@$stock['vehicle_stock_id']?>">

                </div>

                <div class="col-sm-3">

                  <label for="">Vehicle ID</label>

                  <input type="text" class="form-control vehicle_idMain" readonly="readonly" value="<?=@$id?>">

                </div>
                    <div class="col-sm-3">

                  <label for="">Maker</label>

                  <input type="text" class="form-control"  readonly="readonly" value="<?=@$maker?>">

                </div>

                <div class="col-sm-3">

                  <label for="">Brand</label>

                  <input type="text" class="form-control " readonly="readonly" value="<?=@$brand?>">

                </div>

              </div>

                <div class="row <?=@$act?>">
                    <div class="col-sm-4">

                  <label for="">Chassis No</label>

                  <input type="text" class="form-control" readonly="readonly" value="<?=@$models['model_name']?>-<?=@$stock['vehicle_chassis_no']?>">

                </div>

                
            

               

            <div class="col-sm-4">

                  <label for="">Sale Price</label>

                  <input type="text" class="form-control" id="vehicle_estimated_price" readonly="readonly" value="<?=@$stock['vehicle_est_price']?>">

                </div>
               



                </div>

               

        <div id="step1tostep5">    

          <ul class="nav nav-tabs nav-fill wizard" id="myTab" role="tablist">


            <li class=" nav-item nav_vehicle_info <?=$arrow?> active">

              <a href="#vehicle_info" class="nav-link active" id="vehicle-tab" data-toggle="tab" role="tab" aria-controls="veicle" aria-selected="true"><span class="step">1</span>Veicle Info</a>

            </li>

            <li class="nav-item nav_customer_info <?=$arrow?> <?=@$act?>">

              <a href="#customer_info" class="nav-link" id="customer_info-tab" data-toggle="tab" role="tab" aria-controls="customer_info" aria-selected="false"><span class="step">2</span>Image Gallery</a>

            </li>



          </ul>

          <div class="tab-content">

            <div class="tab-pane fade show active" id="vehicle_info" role="tabpanel" aria-labelledby="veicle-tab">

              <?php include 'pages/vehicle_info.php'; ?>    

            </div>

            <div class="tab-pane fade" id="auction_info" role="tabpanel" aria-labelledby="auction-tab">

              <?php include 'pages/auction.php'; ?>

            </div>

            <div class="tab-pane fade" id="customer_info" role="tabpanel" aria-labelledby="customer_info-tab">

              <?php include 'pages/image_galary.php'; ?>     

            </div>


            <div class="tab-pane fade" id="ricksu" role="tabpanel" aria-labelledby="ricksu-tab">

              <?php include 'pages/ricksu.php'; ?>

            </div>

            <div class="tab-pane fade " id="export_info" role="tabpanel" aria-labelledby="veicle-tab">

              <?php include 'pages/export_info.php'; ?>    

            </div>



      


            <div class="tab-pane fade " id="reservation" role="tabpanel" aria-labelledby="reservation_info-tab">

              <?php include 'pages/reservation.php'; ?>     

            </div>

            <div class="tab-pane fade" id="consignee_info" role="tabpanel" aria-labelledby="consignee-tab">

              <?php include 'pages/consignee.php'; ?>

            </div>

            <div class="tab-pane fade" id="inspection_info" role="tabpanel" aria-labelledby="customer_info-tab">

              <?php include 'pages/inspection_info.php'; ?>     

            </div>

            <div class="tab-pane fade" id="shipment" role="tabpanel" aria-labelledby="shipment_info-tab">

              <?php include 'pages/shipment.php'; ?>     

            </div>

            <div class="tab-pane fade" id="airmail" role="tabpanel" aria-labelledby="airmail-tab">

              <?php include 'pages/airmail.php'; ?>

            </div>

          </div>

        


        </div><!-- Step 1 to Step 5 --> 



        <div id="steprestof"></div><!--  rest of 5 -->    

            <!-- </div>

            <div class="tab-pane fade" id="image_galary" role="tabpanel" aria-labelledby="image_galary-tab">

              <?php include 'pages/image_galary.php'; ?>

            </div>

          </div>  -->

      </div>

    </div>

  </div>

</div>



<!-- /remove order-->

</div>
<div class="modal fade" id="inspection_info_modal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Inspection Companies</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
         <div class="container"  >
            <table class="table-bordered table-hover table ">
              <thead>
                <tr>
                  <th>Inspection Company Name</th>
                  <th>Inspection Fee/tax</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="inspection_info_body">
                
              </tbody>
            </table>
         </div>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      
        </div>
 
      </div>
    </div>
  </div>

<?php include_once "includes/footer.php";?>

<script>

  $('.wizard li').click(function() {
    $(this).prevAll().removeClass('active').addClass('completed');

    $('.wizard li').prevAll().removeClass('active').addClass('completed');

    $(this).removeClass('completed').addClass('active');

    $(this).nextAll().removeClass('completed active');

  });

  function refreshDivTrade() {

    $(".refreshTrade").load(location.href + " .refreshTrade");
    console.log('refresh');

   

} 
function submitForm(formName,btn_click_type) { 

  $('input[name="'+formName+'_type"]').val(btn_click_type);
  $('#'+formName).submit();

}
function refreshForm(type,id) {
  
  if (type=="vehicle" && id!='') {
      loadVehicle(id, "edit");
      $(".refresh_vehicle_doc").load(location.href + " .refresh_vehicle_doc");
  

  }
  if (type=="auction" && id!='') {
      loadAuction(id, "edit");
      $(".refresh_auction_doc").load(location.href + " .refresh_auction_doc");
  

  }
  if (type=="person" && id!='') {
      loadAuctionPerson(id, "edit");
      $(".refresh_person_doc").load(location.href + " .refresh_person_doc");
  

  }

  if (type=="reservation" && id!='') {
      loadReservation(id, "edit");

  }
  if (type=="reservation" && id!='') {
      loadReservation(id, "edit");

  }
  if (type=="ricksu" && id!='') {
      loadRicksu(id, "edit");

  }
  if (type=="consignee" && id!='') {
      loadConsignee(id, "edit");


  }
  if (type=="airmail" && id!='') {
      loadAirmail(id, "edit");

  }
  if (type=="shipment" && id!='') {
      loadShipment(id, "edit");
      $("#refresh_shipment_docs").load(location.href + " #refresh_shipment_docs");
  

  }
  if (type=="export" && id!='') {
      loadExport(id, "edit");
      $(".refresh_export_docs").load(location.href + " .refresh_export_docs");
  

  }
  if (type=="inspection" && id!='') {
      loadInspection(id, "edit");

  }
  
}






</script>