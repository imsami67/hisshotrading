 currentLocat=window.location.href;
var url = new URL(currentLocat);
var edit_quotation_id = url.searchParams.get("edit_quotation_id");
var custom_active_link = url.searchParams.get("active");
var custom_customer_link = url.searchParams.get("reserve");

  $(document).ready(function () {
    $("#show_leads_input").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#show_leads_tb tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

 if (custom_customer_link!=null) {
        setTimeout(function() {
            $('#clientName').trigger('change');
            $('#clientName1').trigger('change');

            getVehicle();
              countSubTotal();
            setTimeout(function() {

                 $('#invoice_exchange_rate').trigger('change');
            },2000);
         },2000); 
 }
    if (custom_active_link!=null) {
        $("#"+custom_active_link+"-tab").trigger('click'); 
        
       setTimeout(function() {
            $("#"+custom_active_link+"-tab").trigger('click'); 
               if (custom_active_link=="reservation") {
                 $('#reservation_start_date').trigger('change');
               }else if (custom_active_link=="inspection_info") {
                var vehicle_idMain=$(".vehicle_idMain").val();
                getInspectionDetails(vehicle_idMain);
    
               }else if (custom_active_link=="shipment") {
                var vehicle_idMain=$(".vehicle_idMain").val();
                setShipmentsDets(vehicle_idMain);
    
               }
               
         },2000); 

    }
  if (edit_quotation_id>0) {
    
    var va=0;
    setTimeout(function() {
         $('#clientName').trigger('change');
            countSubTotal();                
    },4000);

    if (va==0) {
          
                      va=1;
    }
 }
    $('.data-table').DataTable();
    $('.select2').select2();
    $('.select2').css("width","100%");
    $('.select2').css("height","calc(2.25rem + 2px)");
    
   $('.my-colorpicker2').colorpicker();
  //   $(function() {
  //   $( ".futuresDate" ).datepicker({  maxDate: new Date() });
  // });
    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });
    var load_vehicle_idMain =  $('.vehicle_idMain').val();

    //Load Data on Trade 
    loadVehicle(load_vehicle_idMain, "load");
     loadAuction(load_vehicle_idMain, "load");

    loadReservation(load_vehicle_idMain, "load");
    loadRicksu(load_vehicle_idMain, "load");
    loadExport(load_vehicle_idMain, "load");
    loadConsignee(load_vehicle_idMain, "load");
    loadInspection(load_vehicle_idMain, "load");
    loadShipment(load_vehicle_idMain, "load");
    loadAirmail(load_vehicle_idMain, "load");
    loadImageGallery(load_vehicle_idMain); 
    editVehicle(load_vehicle_idMain, 'edit')
  $(document).on('click', ".tax_reset", function(){
        var tax=$(this).val();
        $("#"+tax).val(0);
        if($(this).prop("checked") == true){
        $("#"+tax).prop('readonly',true);
        $("#"+tax).attr('max','0');
        }
    else if($(this).prop("checked") == false){
        $("#"+tax).prop('readonly',false);
        $("#"+tax).attr('max','');
        $(".taxOnAmount").trigger('keyup');
    }
    });

    //Calculate Taxation
    $(document).on('keyup', '.taxOnAmount', function () {

        var taxOnAmount = $(this).val();
        var outputID = $(this).attr('id');
        var prefixTax = $('#prefixTax').val();
        var tax = (Number(taxOnAmount) / 100) * Number(prefixTax);
        if($("#"+outputID+"_box").prop("checked") == false){
        $("#"+outputID+"_tax").val(tax);
        
        }
           // }
    });
        $(document).on('keyup', '#airmail_trans_fee', function () {
        var taxOnAmount = $(this).val();
        var prefixTax = $('#prefixTax').val();
        var tax = (Number(taxOnAmount) / 100) * Number(prefixTax);
        $("#airmail_trans_fee_tax").val(tax);
        
        
           // }
    });

    //Shortcut Keys FOr Trade FOrm
    $(document).on('click', "#left", function(){
        $("#step1tostep5").hide();
        $("#steprestof").show();
        $(".nav_export_info").addClass('active');
        $("#export-tab").addClass('active');
        $("#export").addClass('show active');
    });

    $(document).on('change', "#customer_name_paymentModule", function(){
        var value=$("#customer_name_paymentModule").val();
        $("#steprestof").show();
        $(".nav_export_info").addClass('active');
        $("#export-tab").addClass('active');
        $("#export").addClass('show active');
    });
    $(document).on('change',"#customer_name_paymentModule",function () {
        var customer_details_payment = $(this).val();
        $.ajax({
            url:'php_action/custom_action.php',
            type:'post',
            data:{customer_details_payment:customer_details_payment},
            dataType:'text',
            success:function(response){  
                $("#get_Customer_by").html(response);
            }
        });
        $.ajax({
            url:'php_action/custom_action.php',
            type:'post',
            data:{customer_details_values:customer_details_payment},
            dataType:'text',
            success:function(data){ 
            var json = JSON.parse($.trim(data));
                $("input[name='total_amount']").val(json.total);
                $("input[name='received_amount']").val(json.paid);
                $("input[name='due_amount']").val(json.due);
            }
        });
    });
    
     $(document).on('keyup', "#total_amount_recevied", function(){
      var value  = $(this).val();
      var total=$("input[name='total_amount']").val()
      var due=$("input[name='due_amount']").val();
      var remain=parseInt(due)-parseInt(value);
      var percent=Math.round(100-(remain/total)*100);
      $("input[name='percentage']").val(percent);
      $("input[name='pay_amount']").val(value);
      $("input[name='remaing_amount']").val(remain);



    });
    $(document).on('click', "#right", function(){
        $("#step1tostep5").show();
        $("#steprestof").hide();
    })
    
    $(document).on('keyup',function(e){
        if(e.ctrlKey && e.keyCode == 190) {
            $("#step1tostep5").hide();
            $("#steprestof").show();
            $(".nav_export_info").addClass('active');
            $("#export-tab").addClass('active');
            $("#export").addClass('show active');
        }else if (e.ctrlKey && e.keyCode == 188) {
            $("#step1tostep5").show();
            $("#steprestof").hide();
        }
    });

    //Step Show Hide
    $("#step1tostep5").show();
    $("#steprestof").hide();
    $(".feature_form").hide();
    // $(".vehicel_main_form").hide();

    //Main Next Swipe
    $(".next").on('click',function () {
        $("#steprestof").show();
        $("#step1tostep5").hide();
    });
    //Main Home Swipe
    $("#backTohome").on('click',function () {
        $("#steprestof").hide();
        $("#step1tostep5").show();
    });

    //M3 Calculation
    $(document).on('keyup', '.forM3',function () {
        var vehicle_width = $("#vehicle_width").val();
        var vehicle_length = $("#vehicle_length").val();
        var vehicle_height = $("#vehicle_height").val();
        console.log(vehicle_width);
        var m3 = (vehicle_width * vehicle_length * vehicle_height) / 1000000;
        var vehicle_idMain = $("#vehicle_idMain").val();
        $("#vehicle_m3").val(m3);
        
    });
       $(document).on('change', '.autionDateCheck',function () {
        var auction_transport_due_date = $("#auction_transport_due_date").val();
        var auction_deadline = $("#auction_deadline").val();
        var auction_date = $("#auction_date").val();
        
        
    });

    //Main Home Swipe
    $(document).on('change',".ricksu_company",function () {
        var ricksu_company_nameFetchFee = $(this).val();
        $.ajax({
            url:'php_action/custom_action.php',
            type:'post',
            data:{ricksu_company_nameFetchFee:ricksu_company_nameFetchFee},
            dataType:'json',
            success:function(response){  
                $(".ricksu_fee").val(response[0].ricksu_company_fee).trigger('keyup');
            }
        });
    });

    //Main Home Swipe
    $(document).on('change',"#consignee_info_customer",function () {
        var consignee_info_customer1 = $(this).val();
        $.ajax({
            url:'php_action/custom_action.php',
            type:'post',
            data:{consignee_info_customer1:consignee_info_customer1},
            dataType:'json',
            success:function(response){  
                $("#consignee_info_contact").val(response[0].customer_phone);
                $("#consignee_info_email").val(response[0].customer_email);
                $("#consignee_info_customerNameShow").val(response[0].customer_name);
            }
        });
    });

    //Main Home Swipe
    $(document).on('change',"#reservation_customer",function () {
        var reservation_customer3 = $(this).val();
        $.ajax({
            url:'php_action/custom_action.php',
            type:'post',
            data:{consignee_info_customer1:reservation_customer3},
            dataType:'json',
            success:function(response){  
                $("#reservation_customer3").val(response[0].customer_country+"-"+response[0].customer_designation);
            }
        });
    });

    //Main Home Swipe
    $(document).on('change',".country_name",function () {

        var country_name = $(this).val();
       // alert(country_name);
        $.ajax({
            url:'php_action/custom_action.php',
            type:'post',
            data:{country_name1:country_name},
            dataType:'json',
            success:function(response){  
                 var country_ports = "<option>~~SELECT~~</option>";
                $.each(response, function (index, value) {
                    country_ports += '<option value="'+value['country_regulation_destination_port']+'">'+value['country_regulation_destination_port']+'</option>';
                });
                
                $(".port_name").empty().append(country_ports);
            }
        });
    });
      $(document).on('change',"#shipment_country",function () {

        var country_name = $(this).val();
       // alert(country_name);
        $.ajax({
            url:'php_action/custom_action.php',
            type:'post',
            data:{country_name1:country_name},
            dataType:'json',
            success:function(response){  
               
                   var country_ports = "<option>~~SELECT~~</option>";

                $.each(response, function (index, value) {
                    country_ports += '<option " value="'+value['country_regulation_destination_port']+'">'+value['country_regulation_destination_port']+'</option>';
                });
                
                $("#shipment_port_of_discharge").empty().append(country_ports);
            }
        });
    });

    $(document).on('change',"#consignee_country",function () {
          var country_name = $(this).val()
        var country = $('#consignee_countryconsignee_country option').filter(function() {
            return this.value == country_name;
        }).data('country');
       
       // alert(country_name);
        $.ajax({
            url:'php_action/custom_action.php',
            type:'post',
            data:{country_name1:country},
            dataType:'json',
            success:function(response){  
                if (response!='') {
                var country_ports = "<option>~~SELECT~~</option>";
                $.each(response, function (index, value) {
                    country_ports += '<option class="text-capitalize" value="'+value['country_regulation_destination_port']+'">'+value['country_regulation_destination_port']+'</option>';
                });
            }else{
                  var country_ports = "<option>~~Not Found~~</option>";   
            }

                $("#consignee_dest_port").empty().append(country_ports);
            }
        });
    });
    $(document).on('change',"#customer_country",function () {
          var country_name = $(this).val()
        var country = $('#customer_countrycustomer_country option').filter(function() {
            return this.value == country_name;
        }).data('country');
       
       // alert(country_name);
        $.ajax({
            url:'php_action/custom_action.php',
            type:'post',
            data:{country_name1:country},
            dataType:'json',
            success:function(response){  
                if (response!='') {
                var country_ports = "<option>~~SELECT~~</option>";
                $.each(response, function (index, value) {
                    country_ports += '<option class="text-capitalize" value="'+value['country_regulation_destination_port']+'">'+value['country_regulation_destination_port']+'</option>';
                });
            }else{
                  var country_ports = "<option>~~Not Found~~</option>";   
            }

                $("#consignee_dest_port").empty().append(country_ports);
            }
        });
    });

     $(document).on('change',".country_name",function () {
        var country_name = $(this).val();
        $.ajax({
            url:'php_action/custom_action.php',
            type:'post',
            data:{country_name1:country_name},
            dataType:'json',
            success:function(response){  
                var country_ports = "<option>~~SELECT~~</option>";
                $.each(response, function (index, value) {
                    country_ports += '<option class="text-capitalize" value="'+value['country_regulation_id']+'">'+value['country_regulation_destination_port']+'</option>';
                });
                $(".port_name").empty().append(country_ports);
            }
        });
    });
     $(document).on('change',"#reservation_country",function () {
        var country_name = $(this).val();
        $.ajax({
            url:'php_action/custom_action.php',
            type:'post',
            data:{country_name1:country_name},
            dataType:'json',
            success:function(response){  
                var country_ports = "<option>~~SELECT~~</option>";
                $.each(response, function (index, value) {
                    country_ports += '<option class="text-capitalize" value="'+value['country_regulation_id']+'">'+value['country_regulation_destination_port']+'</option>';
                });
                $("#reservation_port").empty().append(country_ports);
            }
        });
    });



    //Main Home Swipe
    $(document).on('change',"#port_name",function () {
        var port_name = $(this).val();
        $.ajax({
            url:'php_action/custom_action.php',
            type:'post',
            data:{port_name1:port_name},
            dataType:'json',
            success:function(response){
                $("#invoice_inspection").val(response[0].country_regulation_inspection);
                $("#fee").val(response[0].country_regulation_fee);
               // alert(response[0].country_regulation_inspection);
            }
        });
    });
    //  $(document).on('change',"#reservation_port",function () {
    //     var port_name = $(this).val();
    //     $.ajax({
    //         url:'php_action/custom_action.php',
    //         type:'post',
    //         data:{port_name1:port_name},
    //         dataType:'json',
    //         success:function(response){
    //             $("#reservation_inspection").val(response[0].country_regulation_inspection);
    //             $("#reservation_inspection_fee").val(response[0].country_regulation_fee);
    //         }
    //     });
    // });

    $(document).on('change',"#customer_type",function(){
        if ($(this).val() == 'dealer') {
            $(".customer_company").show();
            $(".customer_contact_person").show();
        }else{
            $(".customer_company").hide();
            $(".customer_contact_person").hide();
        }
    });

    $(document).on('click',".getContact",function(){
        tb = $(this).attr('id');
        var id = $("."+tb+"_contact").val();
        if($(this).is(":checked")) {
            $("."+tb).val(id).attr('readonly','readonly');
        }else{
            $("."+tb).val("").attr('readonly', false);
        }
    });

     //$(".person").hide();
    $(document).on('change', "#auction_type_check", function () {
        var status=$(this).val();
        
        if (status=="person") {
            $("#persone_div").css("display","block");
            $("#formData2").css("display","none");
            $("#company_div").css("display","none");
        }else if (status=="auction"){
            $("#formData2").css("display","block");
            $("#persone_div").css("display","none");
            $("#company_div").css("display","none");
        }else if (status=="company"){
            $("#formData2").css("display","none");
            $("#persone_div").css("display","none");
            $("#company_div").css("display","block");
        }
    });

    // $(document).on('click', "#person", function () {
      
    // });
    $(document).on('click', ".show_customer_info", function () {
       var id=$(this).data('id');
      var value=$("#"+id).val();
      console.log(value);
     
      if (value!='') {
       
        $.ajax({
            url:'php_action/custom_action.php',
            type:"POST",
            data:{show_customer_info:value},
            dataType:"json",
            beforeSend:function() {
                 $("#customer_info_modal").modal('show');
            },
            success:function(data) { 
                //var responeID=data.trim();
                console.log(data);
                var cust=`<tr>\
                        <th>Company Name</th><td>`+data.customer_company+`</td>\
                        <th>Customer Name</th><td>`+data.customer_name+`</td>\
                        <th>Contact Person</th><td>`+data.customer_contact_person+`</td>\
                        
                    </tr>\
                    <tr><th>Country</th><td>`+data.customer_country+`</td>\
                    
                        <th>STATE / PREFECTURE</th><td>`+data.customer_state+`</td>\
                        <th>City</th><td>`+data.customer_city+`</td>\
                    </tr>
                    <tr>
                        <th>ZIP/POSTAL CODE</th><td>`+data.customer_zip_code+`</td>
                        <th>FLOOR / BUILDING Name</th><td>`+data.customer_floor+`</td>
                        <th>SUBURB</th><td>`+data.customer_suburb+`</td>
                        
                    </tr>
                    <tr>
                        
                        <th>STREET / ROAD (Optional)</th><td>`+data.customer_street+`</td>
                        
                   
                        <th >Address</th><td colspan="3">`+data.customer_address+`</td>
                        
                                        </tr>
                    <tr>
                        <th>Landline No</th><td>`+data.customer_landline+`</td>
                        <th>Contact #1</th><td>`+data.customer_phone+`
                            
                        </td>
                          <th>Contact #2</th><td>`+data.customer_phone2+`
                        
                    </tr>
                    <tr>
                              

                        </td>

                        <th>Email</th><td><a href="mailto:`+data.customer_email+`">`+data.customer_email+`</a></td>

                        
                        
                   
                        <th>Email 2</th><td><a href="mailto:`+data.customer_email2+`">`+data.customer_email2+`</a></td>
                        <th>FAX NO</th><td>`+data.customer_fax+`</td>
                        
                        
                    </tr>
                    <tr><th>Skype ID</th><td>`+data.customer_skype+`</td>
                        <th>Website (Optional)</th><td>`+data.customer_web+`</td>
                          <th>Customer Type</th><td>`+data.customer_type+`</td>
                        
                    <tr>
        
                        <th>Note</th><td>`+data.person_note+`</td>     
                        
                        <th>Destination Port</th><td colspan="3">`+data.customer_designation+`</td>
                    </tr>
                    `;
            $("#customer_info_body").html(cust);     

            }

        });
    }else{

    }
    });
    $(".notify_party").hide();
    $("#radioStacked1").on("click",function() {
        $(".notify_party").show();
        $(".notify_party .notify_labels").text("Notify Name");
        $(".notify_party .notify_label_sts").text("Notify Status");
        $(".notify_party #assign_customer").css("display","none");
        $(".notify_party #customer_id").css("display","none");
        $(".notify_party #consignee_label").val('Notify Party');
        $(".notify_party .dynamic_page").hide();
        $(".notify_party #consignee_final_dest ").prop("readonly",true);
        $(".notify_party #consignee_dest_port ").prop("disabled",true);
        $(".notify_party #customer_id ").prop("disabled",true);
        
    });

    $("#radioStacked2").on("click",function() {
        $("#consignee_final_dest ").show();
        $("#consignee_dest_port ").show();
        $(".notify_party").hide();
        $(".notify_labels").text("Customer Name")
        $(".notify_label_sts").text("Customer Status")
        $("#consignee_label").val('Consignee');
        $("#assign_customer").css("display","block");
        $(".notify_party #consignee_final_dest ").prop("readonly",false);
        $(".notify_party #consignee_dest_port ").prop("disabled",false);
        $(".notify_party #customer_id").css("display","block");
        $(".notify_party #customer_id ").prop("disabled",false);
        
    });
    
    $(document).on('click', '#save_Close', function () {
        // $("#formData").submit();
        window.opener = null;  
        window.open("", "_self");  
        window.close();  
        open(location, '_self').close();
    });

    $(document).on('click', '.newOffice', function () {
        $("#office_sellername").val('');
        $("#office_id").val('');
        $("#office_sellerphone").val('');
        $("#office_sellerpost").val('');
    });

    
    $.fn.dataTable.ext.errMode = 'throw';
    manageAuctiongGrade = $('#auction_grade').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {action: 'loadAuctionGrade'},
            type: 'post',  // method  , by default get
        },
        'order': []     
    });

    managemakers = $('#maker').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {action: 'loadMakers'},
            type: 'post',  // method  , by default get
        },
        'order': []     
    });

    managecolor_code = $('#color_code').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {action: 'loadcolor_code'},
            type: 'post',  // method  , by default get
        },
        'order': []     
    });

    manageCC = $('#cc').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {action: 'ccTable'},
            type: 'post',  // method  , by default get
        },
        'order': []     
    });

    managedrive = $('#drive').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {action: 'drive'},
            type: 'post',  // method  , by default get
        },
        'order': []     
    });

    managetransmission = $('#transmission').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {action: 'transmission'},
            type: 'post',  // method  , by default get
        },
        'order': []     
    });

    manageinterior_grade = $('#interior_grade').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {action: 'interior_grade'},
            type: 'post',  // method  , by default get
        },
        'order': []     
    });

    manageexterior_grade = $('#exterior_grade').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {action: 'exterior_grade'},
            type: 'post',  // method  , by default get
        },
        'order': []     
    });

    manageseats = $('#seats').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {action: 'seats'},
            type: 'post',  // method  , by default get
        },
        'order': []     
    });

    managedoors = $('#doors').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {action: 'doors'},
            type: 'post',  // method  , by default get
        },
        'order': []     
    });

    manageoptions = $('#options').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {action: 'options'},
            type: 'post',  // method  , by default get
        },
        'order': []     
    });

    managefuel = $('#fuel').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {action: 'fuel'},
            type: 'post',  // method  , by default get
        },
        'order': []     
    });

    managepackage = $('#package').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {action: 'package'},
            type: 'post',  // method  , by default get
        },
        'order': []     
    });

    managebidders = $('#bidders').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {action: 'bidders'},
            type: 'post',  // method  , by default get
        },
        'order': []     
    });

    manageauction_home = $('#auction_home').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {action: 'auction_home'},
            type: 'post',  // method  , by default get
        },
        'order': []     
    });

    manageconsignee = $('#consignee').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {action: 'consignee'},
            type: 'post',  // method  , by default get
        },
        'order': []     
    });

    managericksu_company1 = $('#ricksu_company1').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {action: 'ricksu_company1'},
            type: 'post',  // method  , by default get
        },
        'order': []     
    });
     riksu_transportation1 = $('#riksu_transportation1').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {action: 'riksu_transportation1'},
            type: 'post',  // method  , by default get
        },
        'order': []     
    });

    manageinspection_company = $('#inspection_company').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {action: 'inspection_company'},
            type: 'post',  // method  , by default get
        },
        'order': []     
    });
      

    managetransportation = $('#transportation').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {action: 'transportation'},
            type: 'post',  // method  , by default get
        },
        'order': []     
    });

    manageservices_company = $('#services_company').DataTable({
        stateSave: true,
        'autoWidth'   : true,
         "responsive": true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {action: 'services_company'},
            type: 'post',  // method  , by default get
        },
        'order': []     
    });
      manageairmail_transportation = $('#airmail_transportation').DataTable({
        stateSave: true,
        'autoWidth'   : true,
         "responsive": true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {action: 'airmail_transportation'},
            type: 'post',  // method  , by default get
        },
        'order': []     
    });
       manageinspection_transportation = $('#inspection_transportation').DataTable({
        stateSave: true,
        'autoWidth'   : true,
         "responsive": true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {action: 'inspection_transportation'},
            type: 'post',  // method  , by default get
        },
        'order': []     
    });

    managevehicle_expense = $('#vehicle_expense').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {
                action: 'vehicle_expense',
                custom: $('#vehicle_info_id').val(),
            },
            type: 'post',  // method  , by default get
        },
        'order': []
    });

    managereauction = $('#reauction').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {action: 'reauction'},
            type: 'post',  // method  , by default get
        },
        'order': []     
    });

    managecustomers = $('#customers').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        scrollX: true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {action: 'customers'},
            type: 'post',  // method  , by default get
        },
        'order': []     
    });

    managebank = $('#bank').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        scrollX: true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {action: 'banks'},
            type: 'post',  // method  , by default get
        },
        'order': []     
    });

    manageCountryRegulation = $('#country_regulation').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {action: 'country_regulation'},
            type: 'post',  // method  , by default get
        },
        'order': []     
    });

    managevehicle_feature = $('#vehicle_feature').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {action: 'vehicle_feature'},
            type: 'post',  // method  , by default get
        },
        'order': []     
    });

    managebrands = $('#brands').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {action: 'brands'},
            type: 'post',  // method  , by default get
        },
        'order': []     
    });

    managemodels = $('#models').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {
                action: 'models',
                custom: $('#brand_id').val(),
            },
            type: 'post',  // method  , by default get
        },
        'order': []     
    });

    managevehicle_services = $('#vehicle_services').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {
                action: 'vehicle_services',
                custom: $('#vehicle_info_id').val(),
            },
            type: 'post',  // method  , by default get
        },
        'order': []     
    });

    managebody_type = $('#body_type').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {
                action: 'body_type',
            },
            type: 'post',  // method  , by default get
        },
        'order': []     
    });

    //nexco_offices
    nexco_offices = $('#nexco_offices').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {
                action: 'nexco_offices',
            },
            type: 'post',  // method  , by default get
        },
        'order': []     
    });

    manageshipper = $('#shipperTbl').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        scrollX: true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {action: 'shipper'},
            type: 'post',  // method  , by default get
        },
        'order': []     
    });

    manageshipment_company = $('#shipment_companyTbl').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        scrollX: true,
        "ajax": {
            url: "php_action/custom_action.php", // json datasource
            data: {action: 'shipment_company'},
            type: 'post',  // method  , by default get
        },
        'order': []     
    });

    //Save Data into Database

    //Save Data into Database
    
$("#save_vehicle_docs").on('click',function() {
   setTimeout(function(){ location.reload();

                    }, 4000);
});
    $("#formData").on('submit',function(e) {
        e.preventDefault();
        var form = $('#formData');
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function() {
                $('#saveData').attr("disabled","disabled");
                // $('#saveData').text("Loading...");
                $(".loaderAjax").show(); 
                refereshdocs();
            },
            success:function (msg) {
                $(".loaderAjax").hide(); 
                $('#saveData').text("Save");
                $('#formData').each(function(){
                    this.reset();
                });    
                $('#saveData').removeAttr("disabled");
                $('#formData').css("opacity","");   
                $('.msg').text(msg).addClass("alert alert-success").fadeIn(6000).fadeOut(4000);
                manageAuctiongGrade.ajax.reload(null, false);
                managemakers.ajax.reload(null, false);
                manageCC.ajax.reload(null, false);
                managecolor_code.ajax.reload(null, false);
                managedrive.ajax.reload(null, false);
                managetransmission.ajax.reload(null, false);
                manageinterior_grade.ajax.reload(null, false);
                manageexterior_grade.ajax.reload(null, false);
                manageseats.ajax.reload(null, false);
                managedoors.ajax.reload(null, false);
                manageoptions.ajax.reload(null, false);
                managefuel.ajax.reload(null, false);
                managepackage.ajax.reload(null, false);
                managebidders.ajax.reload(null, false);
                manageauction_home.ajax.reload(null, false);
                manageconsignee.ajax.reload(null, false);
                manageinspection_company.ajax.reload(null, false);
                managetransportation.ajax.reload(null, false);
                manageservices_company.ajax.reload(null, false);
                managevehicle_expense.ajax.reload(null, false);
                manageCountryRegulation.ajax.reload(null, false);
                managevehicle_feature.ajax.reload(null, false);
                managebrands.ajax.reload(null, false);
                managemodels.ajax.reload(null, false);
                managebank.ajax.reload(null, false);
                managericksu_company1.ajax.reload(null, false);
                riksu_transportation1.ajax.reload(null, false);
                managevehicle_services.ajax.reload(null, false);
                managebody_type.ajax.reload(null, false);
                nexco_offices.ajax.reload(null, false);
                manageshipper.ajax.reload(null, false);
                manageshipment_company.ajax.reload(null, false);
                manageairmail_transportation.ajax.reload(null, false);
                manageinspection_transportation.ajax.reload(null, false);
           
            }
        });//ajax call
    });//main

    //Save Data into Database
    $("#formData1").on('submit',function(e) {

        e.preventDefault();
        e.stopPropagation(); // only neccessary if something above is listening to the (default-)event too
        var form = $('#formData1');
      //  var files = $('#auction_sheet')[0].files[0];
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function() {
                $('#saveData1').attr("disabled","disabled");
                // $('#saveData1').text("Loading...");
            },
            success:function (msg) {
                var responeID = msg.trim();
                $(".vehicle_idMain").val(responeID);
                $(".stockMain").val(responeID);
                loadVehicle(responeID,'load');
                var url = 'trade.php?vehicle_id='+(msg.trim());
                history.pushState(null, null, url);
                $('#saveData1').text("Save And Next");
                $('#formData1').each(function(){
                    this.reset();
                });    
                sweeetalert("Added","vehicle has been added",'success',2000);
                $('#saveData1').removeAttr("disabled");
                $('#formData1').css("opacity","");  
                $(".vehicel_main_form").hide();
                $(".feature_form").show(); 

                // $(".nav_vehicle_info").removeClass('active').addClass('completed');
                // $("#vehicle-tab").removeClass('active');
                // $("#vehicle_info").removeClass('show active');
                // $(".nav_auction_info").addClass('active');
                // $("#auction-tab").addClass('active');
                // $("#auction_info").addClass('show active');
            
            }
        });//ajax call
    });//main


    //Save Data into Database
    $("#formData2").on('submit',function(e) {
        e.preventDefault();
        var form = $('#formData2');
       var btnValue=$('input[name="formData2_type"]').val();
            //var files = $('#auction_bill')[0].files[0];
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function() {
                $('#formData2_'+btnValue).prop("disabled",true);
                // $('#saveData2').text("Loading...");
            },
            success:function (msg) {
                // alert("Step2");
                var responeID = msg.trim();
               
                $(".vehicle_idMain").val(responeID);
                loadAuction(responeID,'load');
                $('#formData2_'+btnValue).text("Update");
                $('#formData2').each(function(){
                    this.reset();
                });
                
                sweeetalert("DONE","Action Has Been Perform Successfully",'success',2000);
                  $('#formData2_'+btnValue).prop("disabled",false);
                   loadAuction(responeID, "edit");
            if (btnValue=="next") {
                $('#formData2').css("opacity","");   
                $(".nav_auction_info").removeClass('active').addClass('completed');
                $("#auction-tab").removeClass('active');
                $("#auction_info").removeClass('show active');
                // for reservation
                // $(".nav_reservation").addClass('active');
                // $("#reservation-tab").addClass('active');
                // $("#reservation").addClass('show active');
                 $(".nav_ricksu").addClass('active');
                $("#ricksu-tab").addClass('active');
                $("#ricksu").addClass('show active');

            }   
                
            }
        });//ajax call
    });//main
       $("#personeForm").on('submit',function(e) {
        e.preventDefault();
        var form = $('#personeForm');
       var btnValue=$('input[name="personeForm_type"]').val();
            //var files = $('#auction_bill')[0].files[0];
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function() {
                $('#personeForm_'+btnValue).prop("disabled",true);
                // $('#saveData2').text("Loading...");
            },
            success:function (msg) {
                // alert("Step2");
                var responeID = msg.trim();
               
                $(".vehicle_idMain").val(responeID);
                loadAuction(responeID,'load');
                $('#personeForm_'+btnValue).text("Update");
                $('#personeForm').each(function(){
                    this.reset();
                });
                
                sweeetalert("DONE","Action Has Been Perform Successfully",'success',2000);
                  $('#personeForm_'+btnValue).prop("disabled",false);
                   loadAuction(responeID, "edit");
            if (btnValue=="next") {
                $('#personeForm').css("opacity","");   
                $(".nav_auction_info").removeClass('active').addClass('completed');
                $("#auction-tab").removeClass('active');
                $("#auction_info").removeClass('show active');
                // for reservation
                // $(".nav_reservation").addClass('active');
                // $("#reservation-tab").addClass('active');
                // $("#reservation").addClass('show active');
                 $(".nav_ricksu").addClass('active');
                $("#ricksu-tab").addClass('active');
                $("#ricksu").addClass('show active');

            }   
                
            }
        });//ajax call
    });//main

    //Save Data into Database
    $("#formData3").on('submit',function(e) {
        e.preventDefault();
        var form = $('#formData3');
          var btnValue=$('input[name="formData3_type"]').val();      
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function() {
                $('#formData3_'+btnValue).prop("disabled",true);
                // $('#saveData3').text("Loading...");
            },
            success:function (msg) {
                 sweeetalert("DONE","Action Has Been Perform Successfully",'success',2000);
                // alert("Step3");
                $('#formData3_'+btnValue).text("Saved");
                $('#formData3').each(function(){
                    this.reset();
                });
                managecustomers.ajax.reload(null, false);
                managebank.ajax.reload(null, false);
                $('#saveData3').removeAttr("disabled");
                $('#formData3').css("opacity","");   

                $('.msg').text(msg).addClass("alert alert-success").fadeIn(6000).fadeOut(4000);
            }
        });//ajax call
    });//main

    //Save Data into Database
    $("#formData4").on('submit',function(e) {
        e.preventDefault();
        e.stopPropagation();
        var form = $('#formData4');
        var btnValue=$('input[name="formData4_type"]').val();      
        
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function() {
                 Loader.open();
                 $('#formData4_'+btnValue).prop("disabled",true);
                 $('#formData4_'+btnValue).text("Loading...");
            },
            success:function (msg) {
                Loader.close();

                var responeID = msg.trim();
                $('#formData4_'+btnValue).prop("disabled",false);
                  
                
                $('#formData4_'+btnValue).text("Save");
                $('#formData4').each(function(){
                    this.reset();
                });
                
                if(isNaN(responeID)){
                     sweeetalert("DONE",responeID,'error',2000);

                }else{
                    sweeetalert("DONE","Action has been Perform Successfully",'success',2000);
                    
                    $(".vehicle_idMain").val(responeID);
                    loadReservation(responeID,'load');
                    getReservationQue(vehicle_idMain);
                    $('#reservation_start_date').trigger('change');

                }
            
            $("#employe_reservation_tb").load(location.href + " #employe_reservation_tb > *");
            
            if (btnValue=="next") {
                $('#formData4').css("opacity","");   
                $(".nav_reservation").removeClass('active').addClass('completed');
                $("#reservation-tab").removeClass('active');
                $("#reservation").removeClass('show active');
                $(".nav_ricksu").addClass('active');
                $("#ricksu-tab").addClass('active');
                $("#ricksu").addClass('show active');
            }
            }
        });//ajax call
    });//main
 
    //Save Data into Database
    $("#formData5").on('submit',function(e) {
        e.preventDefault();
            var btnValue=$('input[name="formData5_type"]').val();      
        
        var form = $('#formData5');
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function() {
                $('#formData5_'+btnValue).prop("disabled",true);
                // $('#saveData5').text("Loading...");
            },
            success:function (msg) {
                // alert("Step5");
                var responeID = msg.trim();
                $(".vehicle_idMain").val(responeID);
                loadRicksu(responeID,'load');        
                $('#formData5_'+btnValue).text("Save");
                $('#formData5').each(function(){
                    this.reset();
                });
                loadRicksu(responeID,'edit'); 
                get_auction_loading_yard(loadRicksu);
                sweeetalert("DONE","Action Has Been Perform Successfully",'success',2000);
                $('#formData5_'+btnValue).prop("disabled",false);

                if (btnValue=="next") {
                    $('#formData5').css("opacity","");   
                    $('.msg').text(msg).addClass("alert alert-success").fadeIn(6000).fadeOut(4000);
                    $("#step1tostep5").hide();
                    $("#steprestof").show();
                    $(".nav_ricksu").removeClass('active').addClass('completed');
                    $("#ricksu-tab").removeClass('active');
                    $("#ricksu").removeClass('show active');
                    $(".nav_export_info").addClass('active');
                    $("#export-tab").addClass('active');
                    $("#export").addClass('show active');
                }
            }
        });//ajax call
    });//main

    //Save Data into Database
    $("#formData7").on('submit',function(e) {
        e.preventDefault();
        var form = $('#formData7');
        var btnValue=$('input[name="formData7_type"]').val();  
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function() {
               $('#formData7_'+btnValue).prop("disabled",true);
                // $('#saveData7').text("Loading...");
            },
            success:function (msg) {
                // alert("Step7");
                var responeID = msg.trim();
                $(".vehicle_idMain").val(responeID);
                loadExport(responeID,'load');
                $('#saveData7').text("Save");
                $('#formData7').each(function(){
                    this.reset();
                });
                loadExport(responeID,'edit');
                sweeetalert("DONE","Action Has Been Perform Successfully",'success',2000);
                $('#formData7_'+btnValue).prop("disabled",false);
                $('#saveData7').removeAttr("disabled");
                if (btnValue=="next") {
                $('#formData7').css("opacity","");   
                $('.msg').text(msg).addClass("alert alert-success").fadeIn(6000).fadeOut(4000);
                $(".nav_export_info").removeClass('active').addClass('completed');
                $("#export-tab").removeClass('active');
                $("#export_info").removeClass('show active');                
                $(".nav_consignee_info").addClass('active');
                $("#consignee-tab").addClass('active');
                $("#consignee_info").addClass('show active');
                }
            }
        });//ajax call
    });//main

    //Save Data into Database
    $("#formData6").on('submit',function(e) {
        e.preventDefault();
        var form = $('#formData6');
        var btnValue=$('input[name="formData6_type"]').val();  
        
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function() {
                $('#formData6_'+btnValue).prop("disabled",true);
                // $('#saveData6').text("Loading...");
            },
            success:function (msg) {
                // alert("Step6");
                var responeID = msg.trim();
                $(".vehicle_idMain").val(responeID);
              
                 $('#formData6_'+btnValue).prop("disabled",false);
                $('#formData6').each(function(){
                    this.reset();
                });
              

                 sweeetalert("DONE","Action Has Been Perform Successfully",'success',2000);
                $('#formData6_'+btnValue).prop("disabled",false);
                $('#saveData6').removeAttr("disabled");
                if (btnValue=="next") {
                $('#formData6').css("opacity","");   
                $('.msg').text(msg).addClass("alert alert-success").fadeIn(6000).fadeOut(4000);

                $(".nav_consignee_info").removeClass('active').addClass('completed');
                $("#consignee-tab").removeClass('active');
                $("#consignee_info").removeClass('show active');
                
                $(".nav_inspection_info").addClass('active');
                $("#inspection_info-tab").addClass('active');
                $("#inspection_info").addClass('show active');
                }
                $("#consignee_info_table").load(location.href + " #consignee_info_table > *");
                  loadConsignee(responeID,'load');
                
            }
        });//ajax call
    });//main

    //Save Data into Database
    $("#formData8").on('submit',function(e) {
        e.preventDefault();
        var form = $('#formData8');
        var btnValue=$('input[name="formData8_type"]').val();  
        
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function() {
                $('#formData8_'+btnValue).prop("disabled",true);
                // $('#saveData8').text("Loading...");
            },
            success:function (msg) {
                // alert("Step8");
                var responeID = msg.trim();
                $(".vehicle_idMain").val(responeID);
                loadInspection(responeID,'load');
                $('#saveData8').text("Save");
                $('#formData8').each(function(){
                    this.reset();
                });

                 sweeetalert("DONE","Action Has Been Perform Successfully",'success',2000);
                $('#formData8_'+btnValue).prop("disabled",false);
                if (btnValue=="next") {
                    $('#formData8').css("opacity","");   
                $('.msg').text(msg).addClass("alert alert-success").fadeIn(6000).fadeOut(4000);

                $(".nav_inspection_info").removeClass('active').addClass('completed');
                $("#inspection_info-tab").removeClass('active');
                $("#inspection_info").removeClass('show active');
                
                $(".nav_shipment").addClass('active');
                $("#shipment-tab").addClass('active');
                $("#shipment").addClass('show active');
                }
                 loadInspection(responeID,'edit');
                
            }
        });//ajax call
    });//main

    //Save Data into Database
    $("#formData9").on('submit',function(e) {
        e.preventDefault();
        var form = $('#formData9');
        var btnValue=$('input[name="formData9_type"]').val();  
        
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function() {
               $('#formData9_'+btnValue).prop("disabled",true);
                // $('#saveData9').text("Loading...");
            },
            success:function (msg) {
                // alert("Step9");
                var responeID = msg.trim();
                $(".vehicle_idMain").val(responeID);
            
                $('#saveData9').text("Save");
                $('#formData9').each(function(){
                    this.reset();
                });
                    loadShipment(responeID,'load');
                loadShipment(responeID,'edit');
                 sweeetalert("DONE","Action Has Been Perform Successfully",'success',2000);
                $('#formData9_'+btnValue).prop("disabled",false);
                $('.msg').text(msg).addClass("alert alert-success").fadeIn(6000).fadeOut(4000);
                    if (btnValue=="next") {
                         $('#formData9').css("opacity","");  
                     $(".nav_shipment").removeClass('active').addClass('completed');
                $("#shipment-tab").removeClass('active');
                $("#shipment").removeClass('show active');
                
                $(".nav_airmail").addClass('active');
                $("#airmail-tab").addClass('active');
                $("#airmail").addClass('show active');   
                    }
                
            }
        });//ajax call
    });//main

    //Save Data into Database
    $("#formData10").on('submit',function(e) {
        e.preventDefault();
        var form = $('#formData10');
          var btnValue=$('input[name="formData10_type"]').val();  
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function() {
                $('#formData10_'+btnValue).prop("disabled",true);

                // $('#saveData10').text("Loading...");
            },
            success:function (msg) {
                // alert("Step10");
                var responeID = msg.trim();
                $(".vehicle_idMain").val(responeID);
               
                $('#saveData10').text("Save");
                $('#formData10').each(function(){
                    this.reset();
                });
                loadAirmail(responeID,'edit');
                 loadAirmail(responeID,'load');
                 sweeetalert("DONE","Action Has Been Perform Successfully",'success',2000);
                $('#formData10_'+btnValue).prop("disabled",false);

                $('#show_succes_message').fadeIn('slow');  
                $('#saveData10').removeAttr("disabled");
                $('#formData10').css("display","none");
                $('#show_succes_message').css("display","block"); 
            }
        });//ajax call
    });//main

    //Save Data into Database
    $("#formData11").on('submit',function(e) {
        e.preventDefault();
        var form = $('#formData11');
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'json',
            beforeSend:function() {
                $('#saveData11').attr("disabled","disabled");
                // $('#saveData11').text("Loading...");
            },
            success:function (msg) {
                //alert("done");
                //alert(msg);
                 // sweeetalert("DONE","Action Has Been Perform Successfully",'success',2000);
 swal("Payment Voucher Has Been Added Successfully", {
            icon: "success",
  buttons: {
    
    catch: {
      text: "Make a Invoice",
      value: "catch",
    },
    checks: {
      text: "Print Voucher",
      value: "checks",
      className:'btn-success'
    },
    cancel: "Cancel",

   
  },
})
.then((value) => {
    
  switch (value) {

    case "checks":
     window.open('print_voucher.php?print_voucher='+msg,'_blank');

      break;
 
    case "catch":
      window.open('sale_invoices.php?customer='+msg,'_blank');
      break;
 
    // default:
     // swal("Got away safely!");
  }
});
                // var abc = '<a target="_blank" href="print_voucher.php?print_voucher='+msg+'" class="btn btn-danger">Print Voucher</a>  <button class="btn btn-default" type="reset">Reset</button>'
                // $(".msgDetail").addClass("alert alert-success").html(abc);
                // $(".msg").addClass("alert alert-success").text(msg.msg).fadeIn(3000).fadeOut(2000); 
                 $('#saveData11').text("Save");
                $('#saveData11').attr("disabled",false);
                $('#formData11').each(function(){
                    this.reset();
                });                
            }
        });//ajax call
    });//main

    //Save Data into Database
    $("#formData12").on('submit',function(e) {
        e.preventDefault();
        var form = $('#formData12');
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function() {
                // $('#saveData12').attr("disabled","disabled");
                // $('#saveData12').text("Loading...");
            },
            success:function (msg) {
                alert(msg.trim());
                $(".msg").text(msg).fadeIn(3000).fadeOut(2000);
                $('#saveData12').text("Save");
                $('#formData12').each(function(){
                    this.reset();
                });
            }
        });//ajax call
    });//main

    //Save Data into Database
    $("#formData13").on('submit',function(e) {
        e.preventDefault();
        var form = $('#formData13');
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function() {
                // $('#saveData13').attr("disabled","disabled");
                // $('#saveData13').text("Loading...");
            },
            success:function (msg) {
                alert(msg.trim());
                $(".msg").text(msg).fadeIn(3000).fadeOut(2000);
                $('#saveData13').text("Save");
                $('#formData13').each(function(){
                    this.reset();
                });
            }
        });//ajax call
    });//main
//Save Data into Database
    $("#formData14").on('submit',function(e) {
        e.preventDefault();
        var form = $('#formData14');
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType:"json",
            beforeSend:function() {
                $('#createOrderBtn').attr("disabled","disabled");
                // $('#createOrderBtn').text("Loading...");
            },
            success:function (msg) {
                $(".msg").addClass("alert alert-success").text(msg.msg).fadeIn(3000).fadeOut(4000);
                if (msg.transaction_id == "quotation") {
                    var detail = '<div class="alert alert-info"><a href="print_invoice.php?invoice_id='+msg.invoice_id+'&transaction_id='+msg.transaction_id+'" class="btn btn-success" target="_blank">Print Voucher</a> <a class="btn btn-info">Send Invoice To Customer Email</a> <buttom type="reset" class="btn btn-primary">Refresh</button></div>';
                }else{
                    var detail = '<div class="alert alert-info"><a href="print_invoice.php?invoice_id='+msg.invoice_id+'&transaction_id='+msg.transaction_id+'" class="btn btn-success" target="_blank">Print Voucher</a> <a class="btn btn-info">Send Invoice To Customer Email</a> <buttom type="reset" class="btn btn-primary">Refresh</button></div>';
                }
                $(".detailMsg").html(detail);
                $('#createOrderBtn').text("Save Changes").attr("disabled",false);
                $('#formData14').each(function(){
                    this.reset();
                });
                // window.open("invoice.html?invoice_id=27&transaction_id=54", '_blank'); 
            }
        });//ajax call
    });//main
//////////////////////////.......ceo msg.........///////////////////////////////////////
    $("#ceo_mgs_form").on('submit',function(e) {
        e.preventDefault();
        var form = $('#ceo_mgs_form');
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType:"json",
            beforeSend:function() {
               $('#ceo_mgs_form_btn').text("Saved Changes").attr("disabled",false);
            },
            success:function (msg) {
                        console.log(msg);
                             
                $('#ceo_mgs_form').each(function(){
                    this.reset();
                });

            }
        });//ajax call
    });//main

    //Save Data into Database
    $("#formData15").on('submit',function(e) {
        e.preventDefault();
        var form = $('#formData15');
       
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType:"json",
            beforeSend:function() {
                $('#featureBtn').attr("disabled","disabled");
                // $('#featureBtn').text("Loading...");
            },
            success:function (msg) {
               // alert(msg)
                $(".msg").addClass("alert alert-success").text(msg.msg).fadeIn(3000).fadeOut(4000);
                $('#featureBtn').text("Save Changes").attr("disabled",false);
                $('#formData15').each(function(){
                    this.reset();
                });
                
                $(".nav_vehicle_info").removeClass('active').addClass('completed');
                $("#vehicle-tab").removeClass('active');
                $("#vehicle_info").removeClass('show active');
                
                $(".nav_auction_info").addClass('active');
                $("#auction-tab").addClass('active');
                $("#auction_info").addClass('show active');
            }
        });//ajax call
    });//main
    $("#formData16").on('submit',function(e) {
        e.preventDefault();
        var form = $('#formData16');
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType:"json",
            beforeSend:function() {
                 $('#formData16_btn').prop("disabled",true);
                $('#formData16_btn').text("Loading...");
            },
            success:function (response) {
              $('#formData16_btn').prop("disabled",false);
               sweeetalert("",response.msg,response.sts,2000);
        
                 $("#tableData16").load(location.href + " #tableData16");
  
                $('#formData16_btn').text("Save");
                $('#formData16').each(function(){
                    this.reset();
                });
            }
        });//ajax call
    });//main
    //Fetech Data From Database For Editing
    $(document).on('click','.update',function () {
        var edit_user_id = $(this).attr("id");
        var tbl = $("#table_name").val();
        var col = $("#col_name").val();
        $.ajax({
            url:'php_action/custom_action.php',
            type:"POST",
            data:{edit_user_id:edit_user_id, tbl2:tbl, col2:col},
            dataType:"json",
            beforeSend:function() {
                $(".loaderAjax").show(); 
                $(".loaderAjax").hide(); 
            },
            success:function(data) {       
                if (tbl == 'auction_grade') {
                    $("#auction_grade_id").val(data.auction_grade_id);
                    $("#auction_grade_name").val(data.auction_grade_name);
                    $('#auction_grade_sts option[value="'+data.auction_grade_sts+'"]').prop("selected", true); 
                }else if (tbl == 'maker') {
                    $("#maker_id").val(data.maker_id);
                    $("#maker_name").val(data.maker_name);
                    $("#maker_img").val(data.maker_img);
                    $('#maker_sts option[value="'+data.maker_sts+'"]').prop("selected", true); 
                }else if (tbl == 'color_code') {
                    $("#color_code_id").val(data.color_code_id);
                    $("#color_code_name").val(data.color_code_name);
                    $("#color_name").val(data.color_name);
                    $('#color_code_sts option[value="'+data.color_code_sts+'"]').prop("selected", true); 
                }else if (tbl == 'cc') {
                    $("#cc_id").val(data.cc_id);
                    $("#cc_name").val(data.cc_name);
                    $('#cc_sts option[value="'+data.cc_sts+'"]').prop("selected", true); 
                }else if (tbl == 'drive') {
                    $("#drive_id").val(data.drive_id);
                    $("#drive_name").val(data.drive_name);
                    $('#drive_sts option[value="'+data.drive_sts+'"]').prop("selected", true); 
                }else if (tbl == 'transmission') {
                    $("#transmission_id").val(data.transmission_id);
                    $("#transmission_name").val(data.transmission_name);
                    $('#transmission_sts option[value="'+data.transmission_sts+'"]').prop("selected", true); 
                }else if (tbl == 'interior_grade') {
                    $("#interior_grade_id").val(data.interior_grade_id);
                    $("#interior_grade_name").val(data.interior_grade_name);
                    $('#interior_grade_sts option[value="'+data.interior_grade_sts+'"]').prop("selected", true); 
                }else if (tbl == 'exterior_grade') {
                    $("#exterior_grade_id").val(data.exterior_grade_id);
                    $("#exterior_grade_name").val(data.exterior_grade_name);
                    $('#exterior_grade_sts option[value="'+data.exterior_grade_sts+'"]').prop("selected", true); 
                }else if (tbl == 'seats') {
                    $("#seats_id").val(data.seats_id);
                    $("#seats_name").val(data.seats_name);
                    $('#seats_sts option[value="'+data.seats_sts+'"]').prop("selected", true); 
                }else if (tbl == 'doors') {
                    $("#doors_id").val(data.doors_id);
                      $("#doors_name").focus();
                    $("#doors_name").val(data.doors_name);
                    $('#doors_sts option[value="'+data.doors_sts+'"]').prop("selected", true); 
                }else if (tbl == 'options') {
                    $("#option_id").val(data.option_id);
                    $("#option_id").focus();
                    $("#option_name").val(data.option_name);
                    $('#option_sts option[value="'+data.option_sts+'"]').prop("selected", true); 
                }else if (tbl == 'fuel') {
                    $("#fuel_id").val(data.fuel_id);
                     $("#fuel_name").focus();
                    $("#fuel_name").val(data.fuel_name);
                    $('#fuel_sts fuel[value="'+data.fuel_sts+'"]').prop("selected", true); 
                }else if (tbl == 'package') {
                    $("#pack_id").val(data.pack_id);
                    ("#pack_name").focus();
                    $("#pack_name").val(data.pack_name);
                    $('#pack_sts pack[value="'+data.pack_sts+'"]').prop("selected", true); 
                }else if (tbl == 'bidders') {
                    $("#bidder_id").val(data.bidders_id);
                    $("#bidder_name").val(data.bidders_name);
                    $('#bidder_sts option[value="'+data.bidders_sts+'"]').prop("selected", true); 
                }else if (tbl == 'auction_home') {
                    $("#auction_home_id").val(data.auction_home_id);
                    $("#auction_home_name").val(data.auction_home_name);
                    $("#auction_home_name").focus();
                    $("#auction_company_name").val(data.company_name);
                    $("#auction_location").val(data.auction_location);
                    $("#auction_contact").val(data.auction_contact);
                    $("#auction_fax").val(data.auction_fax);
                    $("#japanese_location").val(data.japanese_location);
                    $("#auction_url").val(data.auction_url);
                    $("#bussiness_type").val(data.bussiness_type);
                    $("#deadline_transportation").val(data.deadline_transportation);
                    $("#payment_deadline").val(data.payment_deadline);
                    $("#region").val(data.region);
                    $("#house_fee").val(data.house_fee);
                    $("#auction_email").val(data.auction_email);
                    $("#live_fee").val(data.live_fee);
                    $("#price_offer_fee").val(data.price_offer_fee);
                    $("#auction_house_postal").val(data.auction_house_postal);
                    $("#auction_address_jp").val(data.auction_address_jp);
                    $("#auction_address_en").val(data.auction_address_en);
                    $("#system_bid").val(data.system_bid);
                    $("#person_incharge").val(data.person_incharge);
                    $("#business_type").val(data.business_type);
                    $("#pos").val(data.pos);
                    var auction_day =data.auction_day.toLowerCase();
                    $('#auction_day option[value="'+auction_day+'"]').prop("selected", true);
                    $('#auction_home_sts option[value="'+data.auction_home_sts+'"]').prop("selected", true);
                }else if (tbl == 'consignee') {
                    $("#consignee_id").val(data.consignee_id);
                     $("#consignee_name").focus();
                    $("#consignee_name").val(data.consignee_name);
                    $('#consignee_sts option[value="'+data.consignee_sts+'"]').prop("selected", true); 
                    $('#customer_id option[value="'+data.customer_id+'"]').prop("selected", true);
                    $("#consignee_country").val(data.consignee_country)
                    $("#consignee_contact_person").val(data.consignee_contact_person)
                    $("#consignee_state").val(data.consignee_state)
                    $("#consignee_city").val(data.consignee_city)
                    $("#consignee_suburb").val(data.consignee_suburb)
                    $("#consignee_street").val(data.consignee_street)
                    $("#consignee_floor").val(data.consignee_floor)
                    $("#consignee_zip").val(data.consignee_zip)
                    $("#consignee_address").val(data.consignee_address)
                    $("#consignee_website").val(data.consignee_website)
                    $("#consignee_landline").val(data.consignee_landline)
                    $("#consignee_mobile").val(data.consignee_mobile)
                    $("#consignee_fax").val(data.consignee_fax)
                    $("#consignee_email").val(data.consignee_email)
                   // $("#consignee_dest_port").val(data.consignee_dest_port)
                    $('#consignee_dest_port option[value="'+data.consignee_dest_port+'"]').prop("selected", true); 
                    
                    $("#consignee_final_dest").val(data.consignee_final_dest) 
                }else if (tbl == 'inspection_company') {
                    $("#inspection_company_id").val(data.inspection_company_id);
                    $("#inspection_company_name").val(data.inspection_company_name);
                     $("#inspection_company_name").focus();
                    $("#inspection_contact_person").val(data.inspection_contact_person);
                    $("#inspection_fax").val(data.inspection_fax);
                    $("#inspection_email").val(data.inspection_email);
                    $("#inspection_address").val(data.inspection_address);
                    $("#inspection_website").val(data.inspection_website);
                     $('#inspection_company_name').focus(); 
                    $('#inspection_company_sts option[value="'+data.inspection_company_sts+'"]').prop("selected", true); 
                }else if (tbl == 'inspection_transportation') {
                     $('#inspection_trans_for').focus(); 
                    $("#inspection_trans_id").val(data.inspection_trans_id);
                    $("#inspection_trans_for").val(data.inspection_trans_for);
                    $("#inspection_trans_fee").val(data.inspection_trans_fee);
                    $("#inspection_trans_fee_tax").val(data.inspection_trans_fee_tax);
                     $("#inspection_validity_for").val(data.inspection_validity_for);
                    $("#inspection_trans_others").val(data.inspection_trans_others);
                    $('#inspection_trans_sts option[value="'+data.inspection_trans_sts+'"]').prop("selected", true); 
               
                    $('#inspection_trans_company option[value="'+data.inspection_trans_company+'"]').prop("selected", true); 
                }
                else if (tbl == 'transportation') {
                    $("#transportation_id").val(data.transportation_id);
                    $("#transportation_name").val(data.transportation_name);
                    $('#transportation_sts option[value="'+data.transportation_sts+'"]').prop("selected", true); 
                }else if (tbl == 'services_company') {
                     $('#services_company_name').focus(); 

                    $("#services_company_id").val(data.services_company_id);
                    $("#services_company_name").val(data.services_company_name);
                    $("#services_company_person").val(data.services_company_person);
                    $("#services_company_contact").val(data.services_company_contact);
                    $("#services_company_fax").val(data.services_company_fax);
                    $("#services_company_email").val(data.services_company_email);
                    $("#services_company_address").val(data.services_company_address);
                    $("#services_company_website").val(data.services_company_website);
                    $('#services_company_sts option[value="'+data.services_company_sts+'"]').prop("selected", true); 
                }else if (tbl == 'airmail_transportation') {
                    $("#airmail_trans_id").val(data.airmail_trans_id);
                    $('#airmail_trans_company option[value="'+data.airmail_trans_company+'"]').prop("selected", true); 
                    $('#airmail_trans_company').focus(); 
                    var airmail_trans_country=data.airmail_trans_country.toUpperCase();
                    $('#airmail_trans_country option[value="'+airmail_trans_country+'"]').prop("selected", true); 
                    $("#airmail_trans_type").val(data.airmail_trans_type);
                    $("#airmail_trans_weight").val(data.airmail_trans_weight);
                    $("#airmail_trans_fee").val(data.airmail_trans_fee);
                    $("#airmail_trans_fee_tax").val(data.airmail_trans_fee_tax);
                    $("#airmail_trans_others").val(data.airmail_trans_others);
                    $('#airmail_trans_sts option[value="'+data.airmail_trans_sts+'"]').prop("selected", true); 
                }
                else if (tbl == 'vehicle_expense') {
                     $("#vehicle_expense_name").focus();

                    $("#vehicle_expense_id").val(data.vehicle_expense_id);
                    $("#vehicle_expense_name").val(data.vehicle_expense_name);
                    $("#vehicle_info_id").val(data.vehicle_info_id);
                    $("#vehicle_expense_amount").val(data.vehicle_expense_amount);
                    $("#vehicle_expense_amount_tax").val(data.vehicle_expense_tax);
                    $("#vehicle_expense_type").val(data.vehicle_expense_type);
                }else if (tbl == 'customers') {
                    $("#customer_name").focus();
                    $("#customer_id").val(data.customer_id);
                    $("#customer_name").val(data.customer_name)
                    $("#customer_company").val(data.customer_company)
                    $("#customer_email").val(data.customer_email)
                    $("#customer_email2").val(data.customer_email2)
                    $("#customer_contact_person").val(data.customer_contact_person)
                    $("#customer_skype").val(data.customer_skype)
                    $("#customer_city").val(data.customer_city)
                    $("#customer_address").val(data.customer_address)
                    $('#customer_active option[value="'+data.customer_active+'"]').prop("selected", true);
                    $("#customer_street").val(data.customer_street)
                    $("#customer_floor").val(data.customer_floor)
                    $("#customer_state").val(data.customer_state)
                    $("#customer_zip_code").val(data.customer_zip_code)
                    $("#customer_suburb").val(data.customer_suburb)
                                    


                    if (data.customer_role=="bank") {
                           var obj = [];
                    obj = JSON.parse(data.customer_country);
                    $('.select2').select2().val(obj).trigger('change');

                        $('#customer_type option[value="'+data.customer_type+'"]').prop("selected", true);
                        
                    }else{
                     $("#customer_type").val(data.customer_type)
                       $("#customer_country").val(data.customer_country)

                       
                    }
                    $("#customer_designation").val(data.customer_designation)
                   
                        $("#person_note").val(data.person_note)
                    $("#customer_final_port").val(data.customer_final_port)
                    $(".customer_phone1").val(data.customer_phone)
                    if (data.customer_whatsapp!='') {
                        $("#customer_whatsapp1").prop("checked",true);
                    }
                     if (data.customer_viber!='') {
                        $("#customer_viber1").prop("checked",true);
                    }
                    if (data.customer_whatsapp2!='') {
                        $("#customer_whatsapp2").prop("checked",true);
                    }
                     if (data.customer_viber2!='') {
                        $("#customer_viber2").prop("checked",true);
                    }
                    $("#customer_whatsapp1").val(data.customer_whatsapp)
                    $("#customer_viber1").val(data.customer_viber)
                    $("#customer_phone2").val(data.customer_phone2)
                    $("#customer_whatsapp2").val(data.customer_whatsapp2)
                    $("#customer_viber2").val(data.customer_viber2)
                    $("#customer_landline").val(data.customer_landline)
                    $("#customer_fax").val(data.customer_fax)
                    $("#customer_web").val(data.customer_web)
                    $("#customer_fee").val(data.customer_fee)
                    $("#customer_fee_tax").val(data.customer_fee_tax)
                    $("#customer_buy_date").val(data.customer_buy_date)
                    $("#customer_buy_currency").val(data.customer_buy_currency)
                    $("#win_fee").val(data.win_fee)
                    $("#win_fee_tax").val(data.win_fee_tax)
                    $("#commission_fee").val(data.commission_fee)
                    $("#commission_fee_tax").val(data.commission_fee_tax)
                    $("#recycle_fee").val(data.recycle_fee)
                    $("#recycle_fee_tax").val(data.recycle_fee_tax)
                    $("#payment_deadline").val(data.payment_deadline)
                    $("#security_deposit").val(data.security_deposit)
                    if (data.customer_identity!='') {
                     $("#customer_identity_view").fadeIn('slow');
           
                     $("#customer_identity_action").val(data.customer_identity);
                     $("#customer_identity_view").attr('href','img/vehicle_docs/'+data.customer_identity);
                    }
                    

                    $("#win_fee").val(data.win_fee)
                }else if (tbl == 'country_regulation') {
                       $("#country_regulation_year").focus();
                    $("#country_regulation_year").val(data.country_regulation_year);
                    $("#country_regulation_id").val(data.country_regulation_id);
                    $("#country_regulation_destination_port").val(data.country_regulation_destination_port);
                    $("#country_regulation_time_shipment").val(data.country_regulation_time_shipment);
                    $("#country_regulation_vessel").val(data.country_regulation_vessel);
                    $("#country_regulation_shipping_line").val(data.country_regulation_shipping_line);
                    $("#country_regulation_inspection").val(data.country_regulation_inspection);
                    $("#country_regulation_fee").val(data.country_regulation_fee);
                    $("#country_regulation_country").val(data.country_regulation_country);
                    $('#country_regulation_continent option[value="'+data.country_regulation_continent+'"]').prop("selected", true);
                    $('#country_regulation_hand option[value="'+data.country_regulation_hand+'"]').prop("selected", true);
                    $("#container_20ft").val(data.container_20ft).focus();
                    $("#container_40ft").val(data.container_40ft);
                    $("#m3_0_14").val(data.m3_0_14);
                    $("#m3_14_20").val(data.m3_14_20);
                }else if (tbl == 'vehicle_feature') {
                    $("#vehicle_feature_name").val(data.vehicle_feature_name);
                    $("#vehicle_feature_id").val(data.vehicle_feature_id);
                    $('#vehicle_feature_category option[value="'+data.vehicle_feature_category+'"]').prop("selected", true);
                }else if (tbl == 'brands') {
                    $("#brand_name").val(data.brand_name);
                    $("#brand_id").val(data.brand_id);
                    $('#maker_id option[value="'+data.maker_id+'"]').prop("selected", true);
                    $('#brand_status option[value="'+data.brand_status+'"]').prop("selected", true);
                }else if (tbl == 'models') {
                    $("#model_id").val(data.model_id);
                    $("#model_name").val(data.model_name);
                    $("#brand_m3").val(data.brand_m3);
                    $('#brand_id option[value="'+data.brand_id+'"]').prop("selected", true);
                    $('#maker_id option[value="'+data.maker_id+'"]').prop("selected", true);
                }else if (tbl == 'shipper') {
                    $("#shipper_name").focus();
                    $("#shipper_id").val(data.shipper_id);
                    $("#shipper_name").val(data.shipper_name);
                    $("#shipper_email").val(data.shipper_email);
                    $("#shipper_contact_person").val(data.shipper_contact_person);
                    $("#shipper_state").val(data.shipper_state);
                    $("#shipper_city").val(data.shipper_city);
                    $("#shipper_suburb").val(data.shipper_suburb);
                    $("#shipper_street").val(data.shipper_street);
                    $("#shipper_floor").val(data.shipper_floor);
                    $("#shipper_zip_code").val(data.shipper_zip_code);
                    $("#shipper_other").val(data.shipper_other);
                    $("#shipper_landline").val(data.shipper_landline);
                    $("#shipper_mobile").val(data.shipper_mobile);
                    $("#shipper_fax").val(data.shipper_fax);
                    var shipper_country=data.shipper_country.toUpperCase();
                    $('#shipper_country option[value="'+shipper_country+'"]').prop("selected", true);
                    $('#shipper_sts option[value="'+data.shipper_sts+'"]').prop("selected", true);
                    $("#shipper_web").val(data.shipper_web)
                }else if (tbl == 'airmail_files') {
                    $("#vehicle_id").val(data.vehicle_id);
                     $("#airmail_file_id").focus();
                    $("#airmail_file_id").val(data.airmail_file_id);
                    $(".vehicle_file_name").val(data.airmail_file_name);
                }else if (tbl == 'ricksu_company') {
                     $("#ricksu_company_name").focus();
                    $("#ricksu_company_name").val(data.ricksu_company_name)
                    $("#ricksu_company_id").val(data.ricksu_company_id)
                    $("#ricksu_company_fee").val(data.ricksu_company_fee)
                    $("#ricksu_company_email").val(data.ricksu_company_email)
                    $("#ricksu_company_website").val(data.ricksu_company_website)
                    $("#ricksu_company_contact_person").val(data.ricksu_company_contact_person)
                    $("#ricksu_company_contact").val(data.ricksu_company_contact)
                    $("#ricksu_company_fax").val(data.ricksu_company_fax)
                    $('#ricksu_company_sts option[value="'+data.ricksu_company_sts+'"]').prop("selected", true);
                }else if (tbl == 'riksu_transportation') {
                        $("#auction_house_name").focus();
                    $("#auction_house_name").val(data.auction_house_name)
                    $("#ricksu_yard").val(data.YARD)
                    $("#ricksu_port").val(data.PORT)
                    $("#not_running").val(data.notrunning_fee)
                    $("#free_days").val(data.free_days)
                    $("#running_fee").val(data.running_fee)
                    $("#ricksu_trans_id").val(data.id)
                    $("#ricksu_btn").html("UPDATE")
                    $('#riksu_company_id option[value="'+data.riksu_company_id+'"]').prop("selected", true);
                }else if (tbl == 'shipment_company') {
                       $("#shipment_company_name").focus();
                    $("#shipment_company_id").val(data.shipment_company_id);
                    $("#shipment_company_name").val(data.shipment_company_name);
                    $("#shipment_company_email").val(data.shipment_company_email);
                    $("#shipment_company_contact_person").val(data.shipment_company_contact_person);
                    $("#shipment_company_state").val(data.shipment_company_state);
                    $("#shipment_company_city").val(data.shipment_company_city);
                    $("#shipment_company_suburb").val(data.shipment_company_suburb);
                    $("#shipment_company_street").val(data.shipment_company_street);
                    $("#shipment_company_floor").val(data.shipment_company_floor);
                    $("#shipment_company_zip_code").val(data.shipment_company_zip_code);
                    $("#shipment_company_other").val(data.shipment_company_other);
                    $("#shipment_company_landline").val(data.shipment_company_landline);
                    $("#shipment_company_mobile").val(data.shipment_company_mobile);
                    $("#shipment_company_fax").val(data.shipment_company_fax);
                    $("#shipment_company_country").val(data.shipment_company_country);
                    $('#shipment_company_sts option[value="'+data.shipment_company_sts+'"]').prop("selected", true);
                    $("#shipment_company_web").val(data.shipment_company_web)
                }else if (tbl == 'vehicle_services') {
                    $("#vehicle_services_name").focus();
                    $("#vehicle_services_id").val(data.vehicle_services_id);
                    $("#vehicle_info_id").val(data.vehicle_info_id);
                    $("#vehicle_services_name").val(data.vehicle_services_name);
                    $("#vehicle_services_amount").val(data.vehicle_services_amount);
                    $('#vehicle_services_sts option[value="'+data.vehicle_services_sts+'"]').prop("selected", true);
                }else if (tbl == 'body_type') {
                     $("#body_type_name").focus();
                    $("#body_type_id").val(data.body_type_id);
                    $("#body_type_name").val(data.body_type_name);
                    $("#body_type_img").val(data.body_type_img);
                    $('#body_type_sts option[value="'+data.body_type_sts+'"]').prop("selected", true); 
                }else if (tbl == 'nexco_offices') {
                    
                    $("#office_id").val(data.office_id);
                     $("#office_name").focus();
                    $("#office_name").val(data.office_name);
                    $("#office_address").val(data.office_address);
                    $("#office_country").val(data.office_country);
                    $("#office_phone").val(data.office_phone);
                    $("#office_sellername").val(data.office_sellername);
                    $("#office_sellerphone").val(data.office_sellerphone);
                    $("#office_sellerpost").val(data.office_sellerpost);
                    $("#office_lat").val(data.office_lat);
                    $("#office_lng").val(data.office_lng);
                }
            }
        });
    });//main 

       $(document).on('click','#customer_identity',function () {
         $("#customer_identity_action").val("add");
       });
    //Fetech Data From Database For Editing
    $(document).on('click','.delete',function () {
        var delete_user_id = $(this).attr("id");
        var tbl3 = $("#table_name").val();
        var sts_col = $("#sts_col").val();
        var col_name = $("#col_name").val();
        $.ajax({
            url:'php_action/custom_action.php',
            type:"POST",
            data:{delete_user_id:delete_user_id, tbl3:tbl3, col_name:col_name, sts_col:sts_col},
            dataType:"text",
            beforeSend:function() {
                $(".loaderAjax").show(); 
            },
            success:function(data) {       
                $(".loaderAjax").hide(); 
                $('.msg').text(data).addClass("alert alert-success").fadeIn(6000).fadeOut(4000);
                manageAuctiongGrade.ajax.reload(null, false);
                managemakers.ajax.reload(null, false);
                manageCC.ajax.reload(null, false);
                managecolor_code.ajax.reload(null, false);
                managedrive.ajax.reload(null, false);
                managetransmission.ajax.reload(null, false);
                manageinterior_grade.ajax.reload(null, false);
                manageexterior_grade.ajax.reload(null, false);
                manageseats.ajax.reload(null, false);
                managedoors.ajax.reload(null, false);
                manageoptions.ajax.reload(null, false);
                managefuel.ajax.reload(null, false);
                managepackage.ajax.reload(null, false);
                managebidders.ajax.reload(null, false);
                manageauction_home.ajax.reload(null, false);
                manageconsignee.ajax.reload(null, false);
                manageinspection_company.ajax.reload(null, false);
                manageinspection_transportation.ajax.reload(null, false);
                managetransportation.ajax.reload(null, false);
                manageservices_company.ajax.reload(null, false);
                manageairmail_transportation.ajax.reload(null, false);
                managevehicle_expense.ajax.reload(null, false);
                managecustomers.ajax.reload(null, false);
                manageCountryRegulation.ajax.reload(null, false);
                managevehicle_feature.ajax.reload(null, false);
                managebrands.ajax.reload(null, false);
                managemodels.ajax.reload(null, false);
                managebank.ajax.reload(null, false);
                managericksu_company1.ajax.reload(null, false);
                riksu_transportation1.ajax.reload(null, false);
                managevehicle_services.ajax.reload(null, false);
                managebody_type.ajax.reload(null, false);
                nexco_offices.ajax.reload(null, false);
                manageshipper.ajax.reload(null, false);
                manageshipment_company.ajax.reload(null, false);
                manageairmail_transportation.ajax.reload(null, false);
               
            }
        });
    });//main

    $(".loaderAjax").hide(); 

    $(document).on('change', '.consignee_country', function () {
        var consignee_country = $(this).val();
        $.ajax({
            type: 'POST',
            url: 'php_action/custom_action.php',
            data:{consignee_country12 : consignee_country},
            dataType: 'json',
            success:function (msg) {
                // $(".consignee_country").val(msg.name)
                $(".consignee_landline").val(msg)
                $(".consignee_mobile").val(msg)
                $(".consignee_mobile2").val(msg)
            }   
        });
    });
 
 $(document).on('change', '.customer_country', function () {
   // alert("abc");
        var consignee_country = $(this).val();
        $.ajax({
            type: 'POST',
            url: 'php_action/custom_action.php',
            data:{consignee_country12 : consignee_country},
            dataType: 'json',
            success:function (msg) {
                $(".customer_landline").val(msg)
                // $(".consignee_country").val(msg.name)
                $("#customer_landline").val(msg)
                $("#customer_phone").val(msg)
                $(".customer_whatsapp2_contact").val(msg)
                $('#customer_fax').val(msg);
            }   
        });
    });

 $(document).on('change', '.country_number_by', function () {
   // alert("abc");
        var consignee_country = $(this).val();
        ///console.log(consignee_country);
        $.ajax({
            type: 'POST',
            url: 'php_action/custom_action.php',
            data:{consignee_country12 : consignee_country},
            dataType: 'json',
            success:function (msg) {
                $(".country_number").val(msg);
              ///  console.log(msg);
           
            }   
        });
    });

 $(document).on('change', '.airmail_country', function () {
   // alert("abc");
        var consignee_country = $(this).val();
        $.ajax({
            type: 'POST',
            url: 'php_action/custom_action.php',
            data:{consignee_country12 : consignee_country},
            dataType: 'json',
            success:function (msg) {
                // $(".consignee_country").val(msg.name)
                $("#airmail_contact_no").val(msg)
                $("#airmail_landline").val(msg)
                $("#airmail_contact_receiver").val(msg)
            }   
        });
    });
function updateURLParameter(param, paramVal){
    var url=window.location.href;
    var newAdditionalURL = "";
    var tempArray = url.split("?");
    var baseURL = tempArray[0];
    var additionalURL = tempArray[1];
    var temp = "";
    if (additionalURL) {
        tempArray = additionalURL.split("&");
        for (var i=0; i<tempArray.length; i++){
            if(tempArray[i].split('=')[0] != param){
                newAdditionalURL += temp + tempArray[i];
                temp = "&";
            }
        }
    }

    var rows_txt = temp + "" + param + "=" + paramVal;
 
     window.history.replaceState('', '',baseURL + "?" + newAdditionalURL + rows_txt);

}
$(document).on('click', '#customer_info-tab', function () {
 updateURLParameter("active", "customer_info");
});
$(document).on('click', '#auction-tab', function () {
    var load_auction_idMain=$('#get_auction_idMain').val();
       var auction_type_check=$('#auction_type_check').val();
        var vehicle_idMain=$('.vehicle_idMain').val();
    if (auction_type_check=="person") {
        loadAuctionPerson(vehicle_idMain,"edit");

    }else{
        loadAuction(vehicle_idMain,"edit");
    }
        
    get_auction_loading_yard(vehicle_idMain);
    updateURLParameter("active", "auction");
});

$(document).on('change', '#auction_type_check', function () {
    var load_auction_idMain=$('#get_auction_idMain').val();
    loadAuctionPerson(load_auction_idMain,"edit");
});

$(document).on('click', '#ricksu-tab', function () {
    var vehicle_idMain=$('.vehicle_idMain').val();
    var load_ricksu_idMain=$('#get_ricksu_idMain').val();
    loadRicksu(vehicle_idMain,"edit");
    updateURLParameter("active", "ricksu");
     
});
$(document).on('click', '#reservation-tab', function () {
    var load_reservation_idMain=$('#get_reservation_idMain').val();
   
    // loadReservation(load_reservation_idMain,"edit");
    // loadReservation(load_reservation_idMain,"load");
    updateURLParameter("active", "reservation");
    
    $('#reservation_start_date').trigger('change');
});
 
$('#export-tab').on('click', function() {
    var loadExport_id=$('#get_export_info_idMain').val();
    var vehicle_idMain=$('.vehicle_idMain').val();
    loadExport(vehicle_idMain,"load");
    loadExport(vehicle_idMain,"edit");
    updateURLParameter("active", "export");
});

$(document).on('click', '#consignee-tab', function () {
    var consignee_id=$('#get_consignee_idMain').val();
    var vehicle_idMain=$('.vehicle_idMain').val();
    loadConsignee(consignee_id,"edit");
    $("#consignee_info_table").load(location.href + " #consignee_info_table > *");
      updateURLParameter("active", "consignee");
});
$(document).on('click', '#inspection_info-tab', function () {
    var inspection_info_id=$('#get_inspection_info_idMain').val();
    updateURLParameter("active", "inspection_info");
    var vehicle_idMain=$(".vehicle_idMain").val();
    getInspectionDetails(vehicle_idMain);
    loadInspection(vehicle_idMain,"edit");

});
$(document).on('click', '#shipment-tab', function () {
    updateURLParameter("active", "shipment");
    var shipment_id=$('#get_shipment_idMain').val();
    var vehicle_idMain=$(".vehicle_idMain").val();
    loadShipment(vehicle_idMain,"edit");
     setShipmentsDets(vehicle_idMain);

});
$(document).on('click', '#airmail-tab', function () {
    updateURLParameter("active", "airmail");
    var airmail_id=$('#get_airmail_idMain').val();
    var vehicle_idMain=$(".vehicle_idMain").val();
    loadAirmail(vehicle_idMain,"edit");
    setTimeout(function(){      
        var airmail_consignee=$('#airmail_consignee').val();
         consigneeDetails(airmail_consignee);
     }, 2000);

});

}); 



 //document ready

//*********************************************************Functions*********************************************************\\
//*********************************************************Functions*********************************************************\\
//*********************************************************Functions*********************************************************\\

function loadVehicle(load_vehicle_idMain, action) {
    var loadVehicle = load_vehicle_idMain;
    $.ajax({
        type: 'POST',
        url: 'php_action/custom_action.php',
        data:{loadVehicle : loadVehicle},
        dataType: 'json',
        beforeSend:function() {
            $(".loaderAjax").show(); 
        },
        success:function (msg) {
            $(".loaderAjax").hide(); 
            if (action == 'load') {
                var vehicle_infoTable = '';
                var x = 1;
                $.each(msg, function (index, value) {
                    vehicle_infoTable += '<tr>\
                                            <td>'+x+'</td>\
                                            <td>Stock ID : '+value['vehicle_stock_id']+'<br/>Chassis No : '+value['vehicle_chassis_no']+'<br/>Engine No : '+value['vehicle_engine_no']+'</td>\
       <td><span class="text-danger" onclick="editVehicle('+value['vehicle_id']+')">Edit</span> | <span class="text-danger" onclick="deleteVehicle('+value['vehicle_id']+')">Delete</span></td>\
                                          </tr>';
                                          x++;
                });
                $("#vehicle_idTable").empty().append(vehicle_infoTable);
            }else if (action == 'edit') {
                // loadBrands(msg[0].vehicle_maker);
                // loadChassis(msg[0].vehicle_brand);
                $("#vehicle_stock_pre").hide();
                $("#vehicle_stock_pre").prop("required",false);
                $(".customStockIDEDIT").attr('class', 'col-sm-12')
                $("#vehicle_stock_id").val(msg[0].vehicle_stock_id)
                $('#vehicle_maker option[value="'+msg[0].vehicle_maker+'"]').prop("selected", true);
                //$('#vehicle_brand option[value="'+msg[0].vehicle_brand+'"]').prop('selected', false).trigger('change');
                 $('#vehicle_manu_year option[value="'+msg[0].vehicle_manu_year+'"]').prop("selected", true);
               // $("#vehicle_manu_month").val(msg[0].vehicle_manu_month)
                 $('#vehicle_reg_year option[value="'+msg[0].vehicle_reg_year+'"]').prop("selected", true);
                  $('#vehicle_reg_month option[value="'+msg[0].vehicle_reg_month+'"]').prop("selected", true);
                   $('#vehicle_manu_month option[value="'+msg[0].vehicle_manu_month+'"]').prop("selected", true);
               // $("#vehicle_reg_month").val(msg[0].vehicle_reg_month)
                 $("#vehicle_chassis_no").val(msg[0].vehicle_chassis_no)
                 $('#vehicle_drive option[value="'+msg[0].vehicle_drive+'"]').prop("selected", true);
                 $('#vehicle_grade option[value="'+msg[0].vehicle_grade+'"]').prop("selected", true);
                
                $("#vehicle_engine_no").val(msg[0].vehicle_engine_no)
                $("#vehicle_engine_type").val(msg[0].vehicle_engine_type)
                $("#vehicle_loading_capacity").val(msg[0].vehicle_loading_capacity)
                $("#vehicle_weight").val(msg[0].vehicle_weight)
                $("#vehicle_access").val(msg[0].vehicle_access)
                $("#vehicle_km").val(msg[0].vehicle_km)
                $("#vehicle_km2").val(msg[0].vehicle_km2)
    
                $("#vehicle_maker").trigger('change');
                $("#vehicle_cc").val(msg[0].vehicle_cc);
                
                setTimeout(function(){ $('#vehicle_brand').append(`<option selected value="${msg[0].vehicle_brand}"> 
                                      ${msg[0].brand_name}
                                  </option>`); 
                $("#vehicle_brand").trigger('change');
                  setTimeout(function(){ 
                    $('#vehicle_chassis_code').append(`<option selected value="${msg[0].vehicle_chassis_code}"> 
                                      ${msg[0].model_name}
                                  </option>`);
                $("#vehicle_width").val(msg[0].vehicle_width)
                $("#vehicle_length").val(msg[0].vehicle_length)
                $("#vehicle_height").val(msg[0].vehicle_height)
                $("#vehicle_m3").val(msg[0].vehicle_m3)
          
                      }, 2000); 
                    }, 4000);
              
                         
                $('#vehicle_option option[value="'+msg[0].vehicle_option+'"]').prop("selected", true);
                $('#vehicle_door option[value="'+msg[0].vehicle_door+'"]').prop("selected", true);
                $("#vehicle_seat").val(msg[0].vehicle_seat)
                $('#vehicle_seat option[value="'+msg[0].vehicle_seat+'"]').prop("selected", true);
                $("#vehicle_color").val(msg[0].vehicle_color)
                $("#vehicle_color_name").val(msg[0].vehicle_color_name)
                $('#vehicle_color_name option[value="'+msg[0].vehicle_color_name+'"]').prop("selected", true);
                $("#vehicle_interior_color").val(msg[0].vehicle_interior_color)

                $("#vehicle_note").val(msg[0].vehicle_note)
                $("#vehicle_url").val(msg[0].vehicle_url)
                $("#vehicle_est_price").val(msg[0].vehicle_est_price)
                $('#vehicle_type option[value="'+msg[0].vehicle_type+'"]').prop("selected", true);
                $("#vehicle_mode").val(msg[0].vehicle_type);

                $('#vehicle_discount option[value="'+msg[0].vehicle_discount+'"]').prop("selected", true);
                $("#vehicle_mode").val(msg[0].vehicle_mode);
            }
        }    
    });
}

function loadAuction(load_auction_idMain, action) {
    $.ajax({
        type: 'POST',
        url: 'php_action/custom_action.php', 
        data:{load_auction_idMain : load_auction_idMain, action:action},
        dataType: 'json',
        beforeSend:function() {
            $(".loaderAjax").show(); 
        },
        success:function (msg) {
            $(".loaderAjax").hide(); 
            if (action == 'load') {
                var auction_infoTable = '';
                var x = 1;
                $.each(msg, function (index, value) {
                    auction_infoTable += '<tr>\
                                            <td>'+x+'</td>\
                                            <td>Auction Name : '+value['auction_home_name']+'<br/>Auction Fee : '+value['auction_fee']+'<br/>Auction Date : '+value['auction_date']+'</td>\
                                            <td><span class="text-danger" onclick="editAuction('+value['auction_id']+')">Edit</span> | <span class="text-danger" onclick="deleteAuction('+value['vehicle_id']+')">Delete</span></td>\
                                          </tr>';
                                          x++;
                });
                $("#auction_idTable").empty().append(auction_infoTable);
            }else if (action == 'edit') {

                AuctionInfNow(msg[0].auction_id);
                $('#auction_loading_point option[value="'+msg[0].auction_loading_point+'"]').prop("selected", true);
                $("#auction_id").val(msg[0].auction_id);
                $("#auction_house").val(msg[0].auction_house);
                 $("#auction_house").trigger('change');
                   $('#auction_house_type option[value="'+msg[0].auction_house_type+'"]').prop("selected", true);
                
                $("#auction_date").val(msg[0].auction_date);
                $("#auction_fee").val(msg[0].auction_fee);
                 $("#pos_number").val(msg[0].pos_number);
                $("#auction_start_price").val(msg[0].auction_start_price);
                $("#auction_win_price").val(msg[0].auction_win_price);
                $("#auction_transport_due_date").val(msg[0].auction_transport_due_date);
                $("#auction_bidder").val(msg[0].auction_bidder);
                $("#auction_turn").val(msg[0].auction_turn);
                 $("#auction_deadline").val(msg[0].auction_deadline);
                $("#auction_win_by").val(msg[0].auction_win_by);
                $("#auction_recycle_fee").val(msg[0].auction_recycle_fee);
                $("#auction_note").val(msg[0].auction_note);
                $("#auction_win_price_tax").val(msg[0].auction_win_price_tax);
                $("#auction_fee_tax").val(msg[0].auction_fee_tax);
                $("#security_deposit").val(msg[0].security_deposit);
                $("#auction_recycle_fee_tax").val(msg[0].auction_recycle_fee_tax);
                getSubYards(msg[0].auction_loading_point,"#auction_sub_yard");
                setTimeout(function() {
                $('#auction_sub_yard option[value="'+msg[0].auction_sub_yard+'"]').prop("selected", true);
                
                },2000);

            }
        }    
    });
}

function loadAuctionPerson(load_auction_idMain, action) {
    $.ajax({
        type: 'POST',
        url: 'php_action/custom_action.php', 
        data:{load_auctionPerson_idMain : load_auction_idMain, action:action},
        dataType: 'json',
        beforeSend:function() {
            $(".loaderAjax").show(); 
        },
        success:function (msg) {

            $(".loaderAjax").hide(); 
            if (action == 'load') {
                var auction_infoTable = '';
                var x = 1;
                $.each(msg, function (index, value) {
                    auction_infoTable += '<tr>\
                                            <td>'+x+'</td>\
                                            <td>Auction Name : '+value['auction_home_name']+'<br/>Auction Fee : '+value['auction_fee']+'<br/>Auction Date : '+value['auction_date']+'</td>\
                                            <td><span class="text-danger" onclick="editAuction('+value['auction_id']+')">Edit</span> | <span class="text-danger" onclick="deleteAuction('+value['vehicle_id']+')">Delete</span></td>\
                                          </tr>';
                                          x++;
                });
                $("#auction_idTable").empty().append(auction_infoTable);
            }else if (action == 'edit') {
            if (typeof msg[0].auction_person_id!=='undefined') {


                $("#auction_person_id").val(msg[0].auction_person_id);
                $('#auction_person  option[value="'+msg[0].customer_id+'"]').prop("selected", true);
                $('#auction_house2  option[value="'+msg[0].auction_id+'"]').prop("selected", true);
                $("#posnumber2").val(msg[0].pos_number);
                $('#person_loading_point option[value="'+msg[0].person_loading_point+'"]').prop("selected", true);
                $("#win_fee2").val(msg[0].buyingprice);
                $("#win_fee2_tax").val(msg[0].buyingprice_tax);
                $("#commission_fee2").val(msg[0].commission);
                $("#commission_fee2_tax").val(msg[0].commission_tax);
                $("#recycle_fee2").val(msg[0].recycle_fee);
                $("#recycle_fee2_tax").val(msg[0].recycle_fee_tax) ;                   
                $("#customer_buy_date").val(msg[0].buying_date);
                $("#customer_buy_currency").val(msg[0].currency);
                $("#payment_deadline2").val(msg[0].person_payment_deadline);
                $("#security_deposit2").val(msg[0].security_deposit);
                $("#person_note").val(msg[0].note);
                     
                    if (msg[0].trade_type=="person") {
                         getSubYards(msg[0].person_loading_point,"#person_sub_yard");
                    }else{
                       getSubYards(msg[0].person_loading_point,"#cp_person_sub_yard");

                    }
                setTimeout(function() {
                    if (msg[0].trade_type=="person") {
                         customer_infoall(msg[0].customer_id);
                           $('#person_sub_yard option[value="'+msg[0].person_sub_yard+'"]').prop("selected", true);
               
                    }else{
                         customer_infoall(msg[0].customer_id);
                        AuctionInfNow(msg[0].auction_id)
                     $('#cp_person_sub_yard option[value="'+msg[0].cp_person_sub_yard+'"]').prop("selected", true);
                   
                    }
                
                },2000);
            }

            }
        }    
    });
}


function loadReservation(load_reservation_idMain, action) {
    $.ajax({
        type: 'POST',
        url: 'php_action/custom_action.php',
        data:{load_reservation_idMain : load_reservation_idMain, action:action},
        dataType: 'json',
            beforeSend:function() {
                $(".loaderAjax").show(); 
            },
        success:function (msg) {
            $(".loaderAjax").hide(); 
            if (action == 'load') {
                var user_role=getCurrent_user_details('user_role');
console.log(user_role);
                var auction_infoTable = '';
                var x = 1;
               var sts=invoice_btn=reservation_btn=print_btn='';
                $.each(msg, function (index, value) {
        if (value['vehicle_status']=="sold" && value['invoice_customer']==value['reservation_customer']) {
                    var btn_links="d-block";
                                        var btn_edits="d-none";
                    var tb_active_class="table-info";
                    sts='<span class="label label-info">Sold</span>';
                       
                     invoice_btn='print_invoice.php?invoice_id='+value['invoice_id']+'&transaction_id='+value['transaction_id'];
                       
                                    
                     reservation_btn='print_voucher.php?reservation='+value['reservation_id'];
                     print_btn='<a href="sale_invoices.php?o=add&edit_quotation_id='+value['invoice_id']+'" class="btn-sm btn-primary mb-1" target="_blank">Invoice</a>';
                }else if(value['vehicle_status']=="sold"){
                    var btn_links="d-none";
                  
                    var tb_active_class="";
                    var btn_edits="d-none";
                    sts = '<span class="label label-warning">Sold Out</span>';
                    
                   

                }else{
                        
                   if (user_role=="admin") {
                        var btn_edits="d-block";
                    }else{
                        var btn_edits="d-none";

                    }
                        var btn_links="d-block";
                        var tb_active_class="";
                                            sts = '<span class="label label-success">Active</span>';
                     invoice_btn='sale_invoices.php?reserve='+value['reservation_id'];
                    reservation_btn='payment_voucher.php?reservation='+value['reservation_id'];

                      
                    

                }  
                 if(value['reservation_sts']==0){
                        var btn_links="d-none";
                        var btn_edits="d-none";
                        var tb_active_class="table-danger";
                        sts = '<span class="label label-danger">Deactive</span>';

                    }else if(value['reservation_sts']==2){
                         var btn_links="d-none";
                           var btn_edits="d-none";
                        var tb_active_class="table-warnig";
                        sts = '<span class="label label-warning">Expired</span>';
                    }
                   
             auction_infoTable += '<tr class="'+tb_active_class+'">\
                                    <td>'+x+'</td>\
                                    <td>'+value['username']+'</td>\
                                    <td>'+value['customer_name']+'</td>\
                                    <td>'+value['reservation_payement']+'</td>\
                                    <td>'+value['reservation_sold_price']+' '+value['reservation_sale_type']+'</td>\
                                    <td>'+value['reservation_time']+'</td>\
                                    <td>'+value['reservation_start_date']+'</td>\
                                    <td>'+value['reservation_expiry_date']+'</td>\
                                    <td>'+sts+'</td>\
                                    <td>'+value['reservation_que']+'</td>\
                                    <td><a target="_blank" href="'+reservation_btn+'" class=" btn-sm btn-info '+btn_links+'">Voucher</a><br/> <a target="_blank" href="'+invoice_btn+'" class="btn-sm btn-success '+btn_links+'">Invoice</a></td>\
                                    <td>'+print_btn+'<span class="text-danger '+btn_edits+'" onclick="editReservation('+value['reservation_id']+')">Edit</span> | <span class="text-danger '+btn_edits+'" onclick="deleteFromTable('+value['reservation_id']+',`reservation`)">Delete</span></td>\
                                </tr>';
                            x++;               
                });
                $("#reservation_idTable").empty().append(auction_infoTable);
            }else if (action == 'edit') {
                $('#reservation_id').val(msg[0].reservation_id);
                $('#res_vehicle_id').val(msg[0].vehicle_id);
                $('#reservation_by').val(msg[0].reservation_by);
                $('#reservation_sold_price').val(msg[0].reservation_sold_price);
                $('#reservation_customer').val(msg[0].reservation_customer);
                 $('#reservation_customer').trigger('change');
                $('#reservation_date').val(msg[0].reservation_date);
                $('#reservation_start_date').val(msg[0].reservation_start_date);
                $('#reservation_expiry_date').val(msg[0].reservation_expiry_date);
                $('#reservation_payement').val(msg[0].reservation_payement);
                $('#reservation_que').val(msg[0].reservation_que);
                $('#reservation_note').val(msg[0].reservation_note);
                $('#reservation_sts').val(msg[0].reservation_sts);
                var reservation_sale_type=msg[0].reservation_sale_type.toUpperCase();
                $('#reservation_sale_type option[value="'+reservation_sale_type+'"]').prop("selected", true);
                $('#reservation_final_destin').val(msg[0].reservation_final_destin);
                $('#reservation_shipment_type option[value="'+reservation_shipment_type+'"]').prop("selected", true);
                
                $('#reservation_transportation_cost').val(msg[0].reservation_transportation_cost);
                var reservation_country=msg[0].reservation_country.toUpperCase();
                $('#reservation_country option[value="'+reservation_country+'"]').prop("selected", true);
                $('#reservation_inspection option[value="'+msg[0].reservation_inspection+'"]').prop("selected", true);
               // $('#reservation_inspection').val(msg[0].reservation_inspection);
                $('#reservation_inspection_fee').val(msg[0].reservation_inspection_fee);
                $('#reservation_inspection_fee_tax').val(msg[0].reservation_inspection_fee_tax);
                $('#reservation_freight').val(msg[0].reservation_freight);
                $('#reservation_currency option[value="'+msg[0].reservation_currency+'"]').prop("selected", true);
               $('#reservation_country').trigger('change');
                
                setTimeout(function() {
                    $('#reservation_port option[value="'+msg[0].reservation_port+'"]').prop("selected", true);
                    getTotalCostPrice();
                },2000);
                 $("#formData4_save").text('Update');
            }
        }    
    });
}

function loadRicksu(load_ricksu_idMain, action) {
    $.ajax({
        type: 'POST',
        url: 'php_action/custom_action.php',
        data:{load_ricksu_idMain : load_ricksu_idMain, action:action},
        dataType: 'json',
            beforeSend:function() {
                $(".loaderAjax").show(); 
            },
        success:function (msg) {
                $(".loaderAjax").hide(); 
            if (action == 'load') {
                var auction_infoTable = '';
                var x = 1;
                $.each(msg, function (index, value) {
                    auction_infoTable += '<tr>\
                                            <td>'+x+'</td>\
                                            <td>'+value['ricksu_company_name']+'</td>\
                                            <td>'+value['ricksu_loading_point']+'</td>\
                                            <td>'+value['sub_yard_name']+'</td>\
                                            <td>'+value['ricksu_delievery_point']+'</td>\
                                            <td>'+value['ricksu_receive_by']+'</td>\
                                            <td>'+value['ricksu_type']+'</td>\
                                            <td>'+value['ricksu_fee']+'/'+value['ricksu_fee_tax']+'</td>\
                                            <td>'+value['ricksu_free_at_yard']+'</td>\
                                            <td><span class="text-danger" onclick="editRicksu('+value['vehicle_id']+')">Edit</span> | <span class="text-danger" onclick="deleteRicksu('+value['vehicle_id']+')">Delete</span></td>\
                                          </tr>';
                                          x++;
                });
                $("#ricksu_idTable").empty().append(auction_infoTable);
            }else if (action == 'edit') {
                
               
               // var vehicle_idMain=$('.vehicle_idMain').val();
                get_auction_loading_yard(msg[0].vehicle_id);
                $('.vehicle_idMain').val(msg[0].vehicle_id);
                $('#ricksu_company').val(msg[0].ricksu_company);
                 $('#ricksu_id').val(msg[0].ricksu_id);
                var loading =msg[0].ricksu_loading_point.toLowerCase();
          
                var ricksu_delievery =msg[0].ricksu_delievery_point.toLowerCase();
                $('#ricksu_loading_point option[value="'+loading+'"]').prop("selected", true);
                $("#ricksu_delievery_point").append("<option selected value='"+ricksu_delievery+"'>"+msg[0].ricksu_delievery_point+"</option>");
                $("#ricksu_sub_yard").append("<option selected value='"+msg[0].sub_yard_name+"'>"+msg[0].sub_yard_name+"</option>");
                $('#ricksu_delievery_point').trigger('change');
                  setTimeout(function() {
                        
                    $('#ricksu_dp_sub_yards option[value="'+msg[0].ricksu_dp_sub_yards+'"]').prop("selected", true);
               
                    
                
                },2000);
               // $('#ricksu_delievery_point').val(msg[0].ricksu_delievery_point);
                $('#ricksu_yard_service').val(msg[0].ricksu_yard_service);
                $('#ricksu_leaving_date').val(msg[0].ricksu_leaving_date);
                $('#ricksu_arrival_date').val(msg[0].ricksu_arrival_date);
                $('#ricksu_repair_info').val(msg[0].ricksu_repair_info);
                $('#ricksu_repair_fee').val(msg[0].ricksu_repair_fee);
                $('#ricksu_ad_service').val(msg[0].ricksu_ad_service);
                $('#ricksu_fee').val(msg[0].ricksu_fee);
             $('#ricksu_deliever_by').val(msg[0].ricksu_deliever_by);
            //   $('#ricksu_deliever_by option[value="'+msg[0].ricksu_deliever_by+'"]').prop("selected", true);
                $('#ricksu_receive_by').val(msg[0].ricksu_receive_by);
                $('#ricksu_free_at_yard').val(msg[0].ricksu_free_at_yard);
                $('#ricksu_charger_for_additional').val(msg[0].ricksu_charger_for_additional);
                $('#ricksu_note').val(msg[0].ricksu_note);
                $("#ricksu_repair_fee_tax").val(msg[0].ricksu_repair_fee_tax)
                $("#ricksu_fee_tax").val(msg[0].ricksu_fee_tax)
                $("#ricksu_charger_for_additional_tax").val(msg[0].ricksu_charger_for_additional_tax)
                if (msg[0].ricksu_type=='not_running') {
                     $("#customRadio2").prop('checked',true);
                     $("#customRadio1").prop('checked',false);
                }else{
                    $("#customRadio1").prop('checked',true);
                     $("#customRadio2").prop('checked',false);
                }
                    $("#formData5_save").text('Update');
                
            }
        }    
    });
}

function loadExport(load_export_idMain, action) {
   // alert(load_export_idMain);
    $.ajax({
        type: 'POST',
        url: 'php_action/custom_action.php',
        data:{load_export_idMain : load_export_idMain, action:action},
        dataType: 'json',
            beforeSend:function() {
                $(".loaderAjax").show(); 
            },
        success:function (msg) {
                $(".loaderAjax").hide(); 
            if (action == 'load') {
                var export_infoTable = '';
                var x = 1;
                $.each(msg, function (index, value) {
                    export_infoTable += '<tr>\
                                            <td>'+x+'</td>\
                                            <td>Export Mashou : '+value['export_info_mashou']+'<br/>Date : '+value['export_info_mashou_date']+'</td>\
                                            <td><span class="text-danger" onclick="editExport('+value['export_info_id']+')">Edit</span> | <span class="text-danger" onclick="deleteExport('+value['vehicle_id']+')">Delete</span></td>\
                                          </tr>';
                                          x++;
                });
                $("#export_idTable").empty().append(export_infoTable);
            }else if (action == 'edit') {
                console.log(msg[0]);
                $("#export_info_id").val(msg[0].export_info_id);
                $("#export_info_mashou").val(msg[0].export_info_mashou);
                $("#export_info_export_certificate").val(msg[0].export_info_export_certificate);
                $("#export_info_shipping_order").val(msg[0].export_info_shipping_order);
                $("#export_info_arrival").val(msg[0].export_info_arrival);
                $("#export_info_translation").val(msg[0].export_info_translation);
                $("#export_info_mashou_date").val(msg[0].export_info_mashou_date);
                $("#export_info_export_certificate_date").val(msg[0].export_info_export_certificate_date);
                $("#export_info_shipping_order_date").val(msg[0].export_info_shipping_order_date);
                $("#export_info_arrival_date").val(msg[0].export_info_arrival_date);
                $("#export_info_translation_date").val(msg[0].export_info_translation_date);
                $("#export_info_arrival_date").val(msg[0].export_info_arrival_date);
                $("#inspection_certificate_date").val(msg[0].inspection_certificate_date);
                $("#bill_of_lading_date").val(msg[0].bill_of_lading_date);
                $("#inspection_certificate").val(msg[0].inspection_certificate);
                $("#bill_of_lading").val(msg[0].bill_of_lading);
                 
            }
        }    
    });
}

function loadConsignee(load_consignee_idMain, action) {
//console.log(load_consignee_idMain);
    $.ajax({
        type: 'POST',
        url: 'php_action/custom_action.php',
        data:{load_consignee_idMain : load_consignee_idMain, action:action},
        dataType: 'json',
            beforeSend:function() {
                $(".loaderAjax").show(); 
            },
        success:function (msg) {
                $(".loaderAjax").hide(); 
            if (action == 'load') {
                var consignee_infoTable = '';
                var x = 1;
                $.each(msg, function (index, value) {
                    consignee_infoTable += '<tr>\
                                            <td>'+x+'</td>\
                                            <td colspan="2">'+value['customer_name']+'('+value['customer_phone']+')</td>\
                                             <td colspan="2">'+value['consignee_name']+'</td>\
                                            <td><span class="text-danger" onclick="editConsignee('+value['consignee_info_id']+')">Edit</span> | <span class="text-danger" onclick="deleteConsignee('+value['consignee_id']+')">Delete</span></td>\
                                          </tr>\
                                          <tr>\
                                           <th>Consignee Type</th>\
                                            <th>Contact Person</th>\
                                            <th>Phone </th>\
                                            <th>Country</th>\
                                            <th>Email</th>\
                                            <th >Final Destination</th>\
                                          </tr>\
                                          <tr>\
                                            <td>'+value['consignee_info_type']+'</td>\
                                            <td>'+value['consignee_contact_person']+'</td>\
                                            <td>'+value['consignee_mobile']+'</td>\
                                            <td>'+value['consignee_country']+'</td>\
                                            <td>'+value['consignee_email']+'</td>\
                                             <td>'+value['consignee_final_dest']+'</td>\
                                        </tr>\
                                          <tr>\
                                            <th>Address</th>\
                                            <td colspan="3">'+value['consignee_address']+'</td>\
                                            <th>Destination Port</th>\
                                            <td>'+value['consignee_dest_port']+'</td>\
                                             </tr>';

                                          x++;
                });
                $("#consignee_idTable").empty().append(consignee_infoTable);
            }else if (action == 'edit') {
           
                $("#consignee_info_id").val(msg[0].consignee_info_id);
           
                //$('#customer_id_trade').trigger("change");
               console.log(msg[0].consignee_info_type);
                if (msg[0].consignee_info_type=="notify_party") {
                     $("#notify_id_trade").fadeIn('slow');
                   $('#same_as_notify').prop("checked", true);   
                   $('#same_as_consignee').prop("checked", false);  
                    document.getElementById("same_as_notify").checked = true;   
                }if (msg[0].consignee_info_type=="consignee") {
                     $('#same_as_consignee').prop("checked", true);
                     $('#same_as_notify').prop("checked", false); 
                      $("#notify_id_trade").fadeOut('slow');  
                           document.getElementById("same_as_consignee").checked = true;    
                }
                $('#customer_id_trade option[value="'+msg[0].consignee_info_customer+'"]').prop("selected", true);
                $('#consignee_id_trade option[value="'+msg[0].consignee_info_consignee+'"]').prop("selected", true);
                $('#customer_notify option[value="'+msg[0].consignee_info_party_name+'"]').prop("selected", true);
                
              
            }
        }    
    });
}

function loadInspection(load_inspection_idMain, action) {
    $.ajax({
        type: 'POST',
        url: 'php_action/custom_action.php',
        data:{load_inspection_idMain : load_inspection_idMain, action:action},
        dataType: 'json',
            beforeSend:function() {
                $(".loaderAjax").show(); 
            },
        success:function (msg) {
                $(".loaderAjax").hide(); 
            if (action == 'load') {
                var inspection_infoTable = '';
                var x = 1;
                $.each(msg, function (index, value) {
                    inspection_infoTable += '<tr>\
                                            <td>'+x+'</td>\
                                            <td>Inspection Company : '+value['inspection_company_name']+'<br/>Validity : '+value['inspection_info_validity']+'</td>\
                                            <td><span class="text-danger" onclick="editInspection('+value['inspection_info_id']+')">Edit</span> | <span class="text-danger" onclick="deleteInspection('+value['inspection_info_id']+')">Delete</span></td>\
                                          </tr>';
                                          x++;
                });
                $("#inspection_idTable").empty().append(inspection_infoTable);
            }else if (action == 'edit') {
                

                $('#inspection_info_for option[value="'+msg[0].inspection_info_for+'"]').prop("selected", true);
                $('#inspection_info_id').val(msg[0].inspection_info_id); 
                $('#inspection_info_company').val(msg[0].inspection_info_company);
                $('#inspection_info_point').val(msg[0].inspection_info_point);
                $('#inspection_info_app_date').val(msg[0].inspection_info_app_date);
                $('#inspection_info_ricksu').val(msg[0].inspection_info_ricksu);
                $('#inspection_info_sts').val(msg[0].inspection_info_sts);
                if (msg[0].inspection_info_sts=="fail") {
                    $('#inspection_info_validity').prop('readonly',true);
                }else{
                    $('#inspection_info_validity').prop('readonly',false);
                }
                $('#inspection_info_validity').val(msg[0].inspection_info_validity);
                $('#inspection_info_validity1').val(msg[0].inspection_info_validity1);
                $('#inspection_info_reason').val(msg[0].inspection_info_reason);
                $('#inspection_info_repair_charges').val(msg[0].inspection_info_repair_charges);
                $('#inspection_info_repair_done_by').val(msg[0].inspection_info_repair_done_by);
                $('#inspection_info_note').val(msg[0].inspection_info_note);
                $('#inspection_info_reinspection').val(msg[0].inspection_info_reinspection);
                $('#inspection_info_reinspection_app_date').val(msg[0].inspection_info_reinspection_app_date);
                $('#inspection_info_reinspection_ricksu').val(msg[0].inspection_info_reinspection_ricksu);
                $('#inspection_info_reinspection_sts').val(msg[0].inspection_info_reinspection_sts);
                $("#inspection_info_repair_charges_tax").val(msg[0].inspection_info_repair_charges_tax);
                $("#inspection_info_charges").val(msg[0].inspection_info_charges);
                $("#inspection_info_charges_tax").val(msg[0].inspection_info_charges_tax);
                $("#inspection_info_reinspection1").val(msg[0].inspection_info_reinspection1)
                $("#inspection_info_reinspection1_tax").val(msg[0].inspection_info_reinspection1_tax)
                $("#inspection_info_ricksu1").val(msg[0].inspection_info_ricksu1)
                $("#inspection_info_ricksu1_tax").val(msg[0].inspection_info_ricksu1_tax)
               // console.log(msg)
                // inspection_info_reinspection1
                // inspection_info_reinspection1_tax
                // inspection_info_ricksu1
                // inspection_info_ricksu1_tax

            }
        }    
    });
}

function loadShipment(load_shipment_idMain, action) {
    $.ajax({
        type: 'POST',
        url: 'php_action/custom_action.php',
        data:{load_shipment_idMain : load_shipment_idMain, action:action},
        dataType: 'json',
            beforeSend:function() {
                $(".loaderAjax").show(); 
            },
        success:function (msg) {
                $(".loaderAjax").hide(); 
            if (action == 'load') {
                var shipment_infoTable = '';
                var x = 1;
                $.each(msg, function (index, value) {
                    shipment_infoTable += '<tr>\
                                            <td>'+x+'</td>\
                                            <td>Shipment Company : '+value['shipment_company']+'<br/>Shipment Country : '+value['shipment_country']+'</td>\
                                            <td><span class="text-danger" onclick="editShipment('+value['shipment_id']+')">Edit</span> | <span class="text-danger" onclick="deleteShipment('+value['vehicle_id']+')">Detele</span></td>\
                                          </tr>';
                                          x++;
                });
                $("#shipment_idTable").empty().append(shipment_infoTable);
            }else if (action == 'edit') {
                $('#shipment_id').val(msg[0].shipment_id);
                $('#shipment_company option[value="'+msg[0].shipment_company+'"]').prop("selected", true);
                $('#shipper option[value="'+msg[0].shipper_id+'"]').prop("selected", true);
                $('#shipment_country option[value="'+msg[0].shipment_country+'"]').prop("selected", true);
                $('#shipment_ship_name').val(msg[0].shipment_ship_name);
                $('#shipment_type option[value="'+msg[0].shipment_type+'"]').prop("selected", true);
                $('#shipment_consignee').val(msg[0].shipment_consignee);
                $('#shipment_notify_party_name').val(msg[0].shipment_notify_party_name);
                 $('#shipment_destination option[value="'+msg[0].shipment_destination+'"]').prop("selected", true);
                $('#shipment_destination').val(msg[0].shipment_destination);
                $('#shipment_access_with_cargo').val(msg[0].shipment_access_with_cargo);
                $('#shipment_order_no').val(msg[0].shipment_order_no);
                 $('#shipment_landing_country option[value="'+msg[0].shipment_landing_country+'"]').prop("selected", true);
                $('#shipment_country').trigger('change');
                 $('#shipment_landing_country').trigger('change');
             //$('#shipment_port_of_landing').val(msg[0].shipment_port_of_landing);
                if (msg[0].shipment_type=="roro") {
                    $('#shipment_hc_code').prop('readonly',true);
                    $('#shipment_container_no').prop('readonly',true);
                    $('#shipment_voyage_no').prop('readonly',true);
                    $('#vehicle_terminal_charges').prop('readonly',true);
                    $('#vehicle_terminal_charges_tax').prop('readonly',true);
                     $('#vehicle_terminal_charges_box').prop('checked',true);
                }else{
                    $('#shipment_hc_code').prop('readonly',false);
                    $('#shipment_container_no').prop('readonly',false);
                    $('#shipment_voyage_no').prop('readonly',false);
                    $('#vehicle_terminal_charges').prop('readonly',false);
                    $('#vehicle_terminal_charges_tax').prop('readonly',false);
                    $('#vehicle_terminal_charges_box').prop('checked',false);
                 }

               
               $('#shipment_voyage_no').val(msg[0].shipment_voyage_no);
               setTimeout(function() {
                //   $('#shipment_port_of_discharge option[value="'+msg[0].shipment_port_of_discharge+'"]').prop("selected", true);
                // $('#shipment_port_of_landing option[value="'+msg[0].shipment_port_of_landing+'"]').prop("selected", true);
                
                $("#shipment_port_of_discharge").append(' <option  value="">Select</option>   <option selected value="'+msg[0].shipment_port_of_discharge+'">'+msg[0].shipment_port_of_discharge+'</option>');
               $("#shipment_port_of_landing").append(' <option  value="">Select</option>   <option selected value="'+msg[0].shipment_port_of_landing+'">'+msg[0].shipment_port_of_landing+'</option>');
                
               },2000);
                $('#auction_note').val(msg[0].auction_note);
                $('#shipment_container_no').val(msg[0].shipment_container_no);
                $('#shipment_consignee_address').val(msg[0].shipment_consignee_address);
               // $('#shipment_measures_m3').val(msg[0].shipment_measures_m3);
                $('#shipment_hc_code').val(msg[0].shipment_hc_code);
                $('#shipment_notes').val(msg[0].shipment_notes);
                $('#shipment_date').val(msg[0].shipment_date);
                $('#shipment_order_cutting_date').val(msg[0].shipment_order_cutting_date);
                $('#shipment_wieght').val(msg[0].shipment_wieght);
                $('#shipment_contact').val(msg[0].shipment_contact);
                $('#shipment_contact2').val(msg[0].shipment_contact2);
            
                $('#shipment_shipping_line').val(msg[0].shipment_shipping_line);
                $("#vehicle_freight_charges").val(msg[0].vehicle_freight_charges);
                $("#vehicle_freight_charges_tax").val(msg[0].vehicle_freight_charges_tax);
                $("#vehicle_bl_charges").val(msg[0].vehicle_bl_charges);
                $("#vehicle_bl_charges_tax").val(msg[0].vehicle_bl_charges_tax);
                $("#vehicle_terminal_charges").val(msg[0].vehicle_terminal_charges);
                $("#vehicle_terminal_charges_tax").val(msg[0].vehicle_terminal_charges_tax);
                $("#inner_cargo_l").val(msg[0].inner_cargo_l);
                $("#inner_cargo_w").val(msg[0].inner_cargo_w)
                $("#inner_cargo_h").val(msg[0].inner_cargo_h);
                $("#inner_cargo_weight").val(msg[0].inner_cargo_weight);
                $("#shipment_etd").val(msg[0].ship_etd);
                $("#shipment_eta").val(msg[0].ship_eta);
                $("#vehicle_radiation_charges").val(msg[0].radiation_charges);
                $("#vehicle_radiation_charges_tax").val(msg[0].radiation_charges_tax);
                $("#vehicle_treatment_charges").val(msg[0].heat_charges);
                $("#vehicle_treatment_charges_tax").val(msg[0].heat_charges_tax);
                $("#vehicle_shipping_charges").val(msg[0].shipping_charges);
                $("#vehicle_shipping_charges_tax").val(msg[0].shipping_charges_tax);
                $("#vehicle_other_charges").val(msg[0].other_charges);
                $("#vehicle_other_charges_tax").val(msg[0].other_charges_tax);
                $("#bl_number").val(msg[0].bl_number);
            }
        }    
    });
}

function loadAirmail(load_airmail_idMain, action) {
    $.ajax({
        type: 'POST',
        url: 'php_action/custom_action.php',
        data:{load_airmail_idMain : load_airmail_idMain, action:action},
        dataType: 'json',
            beforeSend:function() {
                $(".loaderAjax").show(); 
            },
        success:function (msg) {
                $(".loaderAjax").hide(); 
            if (action == 'load') {
                var airmail_infoTable = '';
                var x = 1;
                $.each(msg, function (index, value) {
                    airmail_infoTable += '<tr>\
                                            <td>'+x+'</td>\
                                            <td>Parcel No : '+value['airmail_parcel_no']+'<br/>Receiver Name : '+value['airmail_receiver_name']+'</td>\
                                            <td><a class="text-danger" target="_new" href="view_docs.php?vehicle_id='+value['vehicle_id']+'">View Documents</a> | <span class="text-danger" onclick="editAirmail('+value['airmail_id']+')">Edit</span> | <span class="text-danger" onclick="deleteAirmail('+value['vehicle_id']+')">Detele</span></td>\
                                          </tr>';
                                          x++;
                });
                $("#airmail_idTable").empty().append(airmail_infoTable);
            }else if (action == 'edit') {
                $("#airmail_id").val(msg[0].airmail_id)
                if (msg[0].airmail_consignee==0) {
                    $("#airmail_consignee_name").val(msg[0].airmail_consignee_name)
                    $("#airmail_consignee_name").fadeIn('slow')
                    $("#airmail_consignee").fadeOut('slow')
                }else{
                    $("#airmail_consignee").val(msg[0].airmail_consignee)
                    $("#airmail_consignee").fadeIn('slow')
                    $("#airmail_consignee_name").fadeOut('slow')
                }
                
                $("#airmail_city").val(msg[0].airmail_city)
                $("#airmail_street").val(msg[0].airmail_street)
                $("#airmail_zipcode").val(msg[0].airmail_zipcode)
                $("#airmail_landline").val(msg[0].airmail_landline)
                $("#airmail_contact_no").val(msg[0].airmail_contact_no)
                $("#airmail_email").val(msg[0].airmail_email)
                $("#airmail_request_by").val(msg[0].airmail_request_by)
                $("#airmail_parcel_weight").val(msg[0].airmail_parcel_weight)
                $("#airmail_services_company").val(msg[0].airmail_services_company)
                $('#airmail_services_parcel_type option[value="'+msg[0].airmail_services_parcel_type+'"]').prop("selected", true);
                $("#airmail_tracking_no").val(msg[0].airmail_tracking_no)
                $('#airmail_country option[value="'+msg[0].airmail_country+'"]').prop("selected", true);
                $("#airmail_receiver_name").val(msg[0].airmail_receiver_name)
                $("#airmail_state").val(msg[0].airmail_state)
                $("#airmail_suburb").val(msg[0].airmail_suburb)
                $("#airmail_floor").val(msg[0].airmail_floor)
                $("#airmail_receiver_address").val(msg[0].airmail_receiver_address)
                $("#airmail_fax").val(msg[0].airmail_fax)
                $("#airmail_contact_receiver").val(msg[0].airmail_contact_receiver)
                $("#airmail_parcel_no").val(msg[0].airmail_parcel_no)
                $("#airmail_parcel_detail").val(msg[0].airmail_parcel_detail)
                $("#airmail_courier_charges").val(msg[0].airmail_courier_charges)
                $("#airmail_courier_charges_tax").val(msg[0].airmail_courier_charges_tax)
                $("#airmail_date_of_dispatch").val(msg[0].airmail_date_of_dispatch)             
                $("#airmail_note").val(msg[0].airmail_note);
                $("#airmail_decline_note").val(msg[0].airmail_decline_note)
                $("#airmail_receiver_note").val(msg[0].airmail_receiver_note)
                $('#airmail_payment_status option[value="'+msg[0].airmail_payment_status+'"]').prop("selected", true);
                $('#airmail_approval_status option[value="'+msg[0].airmail_approval_status+'"]').prop("selected", true);
                $("#airmail_con_approve_by").val(msg[0].username)
                $("#airmail_time").val(msg[0].airmail_time)




            }
        }    
    });
}

function loadImageGallery(load_img_idMain) {
    $.ajax({
        type: 'POST',
        url: 'php_action/custom_action.php',
        data:{load_img_idMain : load_img_idMain},
        dataType: 'json',
            beforeSend:function() {
                $(".loaderAjax").show(); 
            },
        success:function (msg) {
                $(".loaderAjax").hide(); 
                
            var img_infoTable = '';
            var x = 1;
            $.each(msg, function (index, value) {
                if (value['vehicle_image_featured']==0) { var checked="";}
                else{var checked="checked";}
                img_infoTable += '<div class="column">\
                <li data-post-id="'+value['vehicle_image_id']+'">\
        <div class="container2">\
            <img  src="img/vehicles_images/'+value['vehicle_image_name']+'">\
            <div class="top-left">'+value['vehicle_id']+'</div>\
            <button class="btn-sm btn-danger " style="margin-left:80px" onclick="deleteImage('+value['vehicle_image_id']+')"><span class="fa fa-trash"></span></button>\
            <a target="_blank" href="img/vehicles_images/'+value['vehicle_image_name']+'" class="btn-sm btn-primary m-0" ><span class="fa fa-eye"></span></a>\
              <a download target="_blank" href="img/vehicles_images/'+value['vehicle_image_name']+'" class="btn-sm btn-info" ><span class="fa fa-download"></span></a>\
            <div class="top-right">Featured <input type="radio" '+checked+' name="featured" title="Make it Featured" onclick="make_featured('+value['vehicle_image_id']+','+value['vehicle_id']+')"></div>\
        </div>\
        </li>\
      </div>';
            });
            $(".imageGallery").empty().append(img_infoTable);
        }    
    });
}
   
        $( "#post_list" ).sortable({
            placeholder : "ui-state-highlight",
            update  : function(event, ui)
            {
                 var post_order_ids = new Array();
                $('#post_list li').each(function(){
                    post_order_ids.push($(this).data("post-id"));
                });
                $.ajax({
                    url:"php_action/custom_action.php",
                    method:"POST",
                    data:{sortable_img:"sortable_img",post_order_ids:post_order_ids},
                    success:function(data)
                    {   console.log(data); }
                    
                });
            }
        });
  

function editVehicle(getVehicleID) {
    if (getVehicleID != "") {
      //  $("#saveData1").text("Save And Next ").removeClass("btn-primary").addClass("btn-warning");
        loadVehicle(getVehicleID, 'edit');
    }
}

function editAuction(getAuctionID) {
    $("#saveData2").text("Edit").removeClass("btn-primary").addClass("btn-warning");
    loadAuction(getAuctionID, 'edit');
}

function editReservation(getAuctionID) {
    $("#saveData4").text("Edit").removeClass("btn-primary").addClass("btn-warning");
    loadReservation(getAuctionID, 'edit');
}

function editRicksu(getRicksuD) {
    $("#saveData5").text("Edit").removeClass("btn-primary").addClass("btn-warning");
    loadRicksu(getRicksuD, 'edit');
}

function editExport(getExportID) {
    $("#saveData7").text("Edit").removeClass("btn-primary").addClass("btn-warning");
    loadExport(getExportID, 'edit');
}

function editConsignee(getExportID) {
    $("#saveData6").text("Edit").removeClass("btn-primary").addClass("btn-warning");
    loadConsignee(getExportID, 'edit');
}

function editInspection(getInspectionID) {
    $("#saveData8").text("Edit").removeClass("btn-primary").addClass("btn-warning");
    loadInspection(getInspectionID, 'edit');
}

function editShipment(getShipmentID) {
    $("#saveData9").text("Edit").removeClass("btn-primary").addClass("btn-warning");
    loadShipment(getShipmentID, 'edit');
}

function editAirmail(getAirmailID) {
    $("#saveData10").text("Edit").removeClass("btn-primary").addClass("btn-warning");
    loadAirmail(getAirmailID, 'edit');
}

function loadData(tblName, colID) {
    $.ajax({
        type: 'POST',
        url: 'php_action/custom_action.php',
        data:{tblName : tblName, colID:colID},
        dataType: 'json',
            beforeSend:function() {
                $(".loaderAjax").show(); 
            },
        success:function (msg) {
                $(".loaderAjax").hide(); 
            console.log(msg);
            var abc = '';
            if (tblName == 'vehicle_info') {
                var ar=JSON.parse(msg[0].vehicle_feature_list);
                
         if (msg[0].vehicle_feature_list) {
                var vehicle_features =ar.toString();
            }else{
                var vehicle_features ='';
            }
                abc += '<div class="row">\
                                  <div class="col-sm-4">\
                                    <table class="table table-hover">\
                                      <thead>\
                                        <tr>\
                                          <th>Index</th>\
                                          <th>Detail</th>\
                                        </tr>\
                                      </thead>\
                                      <tbody>\
                                        <tr>\
                                        <td>Stock ID</td>\
                                          <td>'+msg[0].vehicle_stock_id+'</td>\
                                        </tr>\
                                        <td>Manu. Date</td>\
                                          <td>'+msg[0].vehicle_manu_month+'-'+msg[0].vehicle_manu_year+'</td>\
                                        </tr>\
                                        <tr>\
                                          <td>Chassis No</td>\
                                          <td>'+msg[0].vehicle_chassis_no+'</td>\
                                        </tr>\
                                        <tr>\
                                          <td>Engine No</td>\
                                          <td>'+msg[0].vehicle_engine_no+'</td>\
                                        </tr>\
                                        <tr>\
                                          <td>Transmission</td>\
                                          <td>'+msg[0].vehicle_transmission+'</td>\
                                        </tr>\
                                        <tr>\
                                          <td>Interior Grade</td>\
                                          <td>'+msg[0].vehicle_interior+'</td>\
                                        </tr>\
                                        <tr>\
                                          <td>Seats</td>\
                                          <td>'+msg[0].vehicle_seat+'</td>\
                                        </tr>\
                                        <tr>\
                                          <td>Color</td>\
                                          <td>'+msg[0].vehicle_color+'</td>\
                                        </tr>\
                                        <tr>\
                                          <td>Height</td>\
                                          <td>'+msg[0].vehicle_height+'</td>\
                                        </tr>\
                                        <tr>\
                                          <td>M3</td>\
                                          <td>'+msg[0].vehicle_m3+'</td>\
                                        </tr>\
                                        <tr>\
                                          <td>Accessories</td>\
                                          <td>'+msg[0].vehicle_access+'</td>\
                                        </tr>\
                                        <tr>\
                                          <td>Vehicle Type</td>\
                                          <td>'+msg[0].body_type_name+'</td>\
                                        </tr>\
                                        <tr>\
                                          <td>Vehicle Mode</td>\
                                          <td>'+msg[0].vehicle_mode+'</td>\
                                        </tr>\
                                        <tr>\
                                          <td>Discount %</td>\
                                          <td>'+msg[0].vehicle_discount+'</td>\
                                        </tr>\
                                      </tbody>\
                                      <tfoot>\
                                      <tr>\
                                          <td>Vehicle Features</td>\
                                          <td colspan="6">'+vehicle_features+'</td>\
                                        </tr>\
                                      </tfoot>\
                                    </table>\
                                  </div><!-- col -->\
                                  <div class="col-sm-4">\
                                    <table class="table table-hover">\
                                      <thead>\
                                        <tr>\
                                          <th>Index</th>\
                                          <th>Detail</th>\
                                        </tr>\
                                      </thead>\
                                      <tbody>\
                                        <tr>\
                                        <td>Maker</td>\
                                          <td>'+msg[0].maker_name+'</td>\
                                        </tr>\
                                        <tr>\
                                          <td>Reg. Date</td>\
                                          <td>'+msg[0].vehicle_reg_month+'-'+msg[0].vehicle_reg_year+'</td>\
                                        </tr>\
                                        <td>Chassis Code</td>\
                                          <td>'+msg[0].model_name+'</td>\
                                        </tr>\
                                        <td>Engine CC</td>\
                                          <td>'+msg[0].vehicle_cc+'</td>\
                                        </tr>\
                                        <td>Fuel</td>\
                                          <td>'+msg[0].vehicle_fuel+'</td>\
                                        </tr>\
                                        <tr>\
                                          <td>Exterior Grade</td>\
                                          <td>'+msg[0].vehicle_exterior+'</td>\
                                        </tr>\
                                        <tr>\
                                          <td>Doors</td>\
                                          <td>'+msg[0].vehicle_door+'</td>\
                                        </tr>\
                                        <tr>\
                                          <td>Color Name</td>\
                                          <td>'+msg[0].vehicle_color_name+'</td>\
                                        </tr>\
                                        <tr>\
                                          <td>Width</td>\
                                          <td>'+msg[0].vehicle_width+'</td>\
                                        </tr>\
                                        <tr>\
                                          <td>Loading Capacity</td>\
                                          <td>'+msg[0].vehicle_loading_capacity+'</td>\
                                        </tr>\
                                        <tr>\
                                          <td>Km</td>\
                                          <td>'+msg[0].vehicle_km+'</td>\
                                        </tr>\
                                        <tr>\
                                          <td>Video URL</td>\
                                          <td>'+msg[0].vehicle_url+'</td>\
                                        </tr>\
                                      </tbody>\
                                    </table>\
                                  </div><!-- col -->\
                                  <div class="col-sm-4">\
                                  <table class="table table-hover">\
                                      <thead>\
                                          <tr>\
                                              <th>Index</th>\
                                              <th>Detail</th>\
                                          </tr>\
                                      </thead>\
                                      <tbody>\
                                        <tr>\
                                          <td>Brand</td>\
                                          <td>'+msg[0].brand_name+'</td>\
                                        </tr>\
                                        <tr>\
                                          <td>Drive</td>\
                                          <td>'+msg[0].vehicle_drive+'</td>\
                                        </tr>\
                                        <tr>\
                                          <td>Engine Type</td>\
                                          <td>'+msg[0].vehicle_engine_type+'</td>\
                                        </tr>\
                                        <tr>\
                                          <td>Package</td>\
                                          <td>'+msg[0].vehicle_package+'</td>\
                                        </tr>\
                                        <tr>\
                                          <td>Grade</td>\
                                          <td>'+msg[0].vehicle_grade+'</td>\
                                        </tr>\
                                        <tr>\
                                          <td>Steering</td>\
                                          <td>'+msg[0].vehicle_option+'</td>\
                                        </tr>\
                                        <tr>\
                                          <td>interior Color</td>\
                                          <td>'+msg[0].vehicle_interior_color+'</td>\
                                        </tr>\
                                        <tr>\
                                          <td>Length</td>\
                                          <td>'+msg[0].vehicle_length+'</td>\
                                        </tr>\
                                        <tr>\
                                          <td>Weight</td>\
                                          <td>'+msg[0].vehicle_weight+'</td>\
                                        </tr>\
                                        <tr>\
                                          <td>KM 2</td>\
                                          <td>'+msg[0].vehicle_km2+'</td>\
                                        </tr>\
                                        <tr>\
                                          <td>Estimated Price</td>\
                                          <td>'+msg[0].vehicle_est_price+'</td>\
                                        </tr>\
                                        <tr>\
                                          <td>Note</td>\
                                          <td>'+msg[0].vehicle_note+'</td>\
                                        </tr>\
                                        <tr>\
                                          <td>Note</td>\
                                          <td>'+msg[0].vehicle_note+'</td>\
                                        </tr>\
                                      </tbody>\
                                  </table>\
                                  </div>\
                                </div><!-- row -->';
                $(".modal-title").text('Vehicle Data');
                $("#loadData").empty().append(abc);
                $('#modal-id').modal('show'); 
            }else if (tblName == 'auction_info') {
                var x = 1;
                $.each(msg, function (index, value) {
                    abc += '<table class="table table-hover table-bordered">\
                  <thead>\
                    <tr>\
                      <th>Index</th>\
                      <th>Detail</th>\
                      <th>Index</th>\
                      <th>Detail</th>\
                    </tr>\
                  </thead>\
                  <tbody>\
                    <tr>\
                      <td>Auction House</td>\
                      <td>'+value['auction_home_name']+'</td>\
                      <td>Auction Transport Due Date</td>\
                      <td>'+value['auction_transport_due_date']+'</td>\
                    </tr>\
                    <tr>\
                      <td>POS Number</td>\
                      <td>'+value['pos_number']+'</td>\
                      <td>Auction Bidder</td>\
                      <td>'+value['bidders_name']+'</td>\
                    </tr>\
                    <tr>\
                      <td>Company Name</td>\
                      <td>'+value['auction_home_name']+'</td>\
                      <td>Turn</td>\
                      <td>'+value['auction_turn']+'</td>\
                    </tr>\
                    <tr>\
                      <td>Bid Type</td>\
                      <td>'+value['auction_house_type']+'</td>\
                      <td>Win By</td>\
                      <td>'+value['auction_win_by']+'</td>\
                    </tr>\
                    <tr>\
                      <td>Auction Date</td>\
                      <td>'+value['auction_date']+'</td>\
                       <td>Payment Deadline</td>\
                      <td>'+value['auction_deadline']+'</td>\
                    </tr>\
                    <tr>\
                      <td> Start Price</td>\
                      <td>'+value['auction_start_price']+'</td>\
                      <td> Security Deposit</td>\
                      <td>'+value['security_deposit']+'</td>\
                    </tr>\
                    <tr>\
                      <td> Auction Win Price</td>\
                      <td>'+value['auction_win_price']+'</td>\
                      <td>Auction Win Price Tax</td>\
                      <td>'+value['auction_win_price_tax']+'</td>\
                    </tr>\
                    </tr>\
                    <tr>\
                      <td>Auction Fee</td>\
                      <td>'+value['auction_fee']+'</td>\
                      <td>Auction Fee Tax</td>\
                      <td>'+value['auction_fee_tax']+'</td>\
                    </tr>\
                    <tr>\
                      <td>Auction Recycle Fee</td>\
                      <td>'+value['auction_recycle_fee']+'</td>\
                        <td>Auction Note</td>\
                      <td>'+value['auction_note']+'</td>\
                    </tr>\
                  </tbody>\
                </table>';
                    x++;
                });
                $(".modal-title").text('Auction Data');
                $("#loadData").empty().append(abc);
                $('#modal-id').modal('show'); 
            }else if (tblName == "ricksu") {
                console.log(msg);
                        var x = 1;
                $.each(msg, function (index, value) {
                    console.log(value['mini_ricksu']);
                    if (value['mini_ricksu']==0) {
                abc += '<div id="accordion" role="tablist" aria-multiselectable="true">\
                            <div class="panel ">\
                              <div class="panel-heading" role="tab" id="headingOne">\
                                <h4 class="panel-title">\
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne'+index+'" aria-expanded="true" aria-controls="collapseOne'+index+'">\
                                    Ricksu Information #'+x+'<br /> Company Name: <span class="text-capitalize">'+value['ricksu_company_name']+'</span>\
                                  </a>\
                                </h4>\
                              </div>\
                              <div id="collapseOne'+index+'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">\
                              <table class="table table-hover">\
                          <thead>\
                            <tr>\
                              <th>Index</th>\
                              <th>Detail</th>\
                              <th>Index</th>\
                              <th>Detail</th>\
                            </tr>\
                          </thead>\
                          <tbody>\
                            <tr>\
                              <td>Loading Point</td>\
                              <td>'+value['ricksu_loading_point']+'</td>\
                              <td>Delievery Point</td>\
                              <td>'+value['ricksu_delievery_point']+'</td>\
                            <tr>\
                            <tr>\
                              <td>Type</td>\
                              <td>'+value['ricksu_type']+'</td>\
                              <td>Deliever By</td>\
                              <td>'+value['ricksu_deliever_by']+'</td>\
                            <tr>\
                              <td>Ricksu Company</td>\
                              <td>'+value['ricksu_company_name']+'</td>\
                              <td>Free At Yard</td>\
                              <td>'+value['ricksu_free_at_yard']+'</td>\
                            </tr>\
                            <tr>\
                              <td>Received By</td>\
                              <td>'+value['ricksu_receive_by']+'</td>\
                              <td>Yard Service</td>\
                              <td>'+value['ricksu_yard_service']+'</td>\
                            </tr>\
                            <tr>\
                              <td>Yard Leaving Date</td>\
                              <td>'+value['ricksu_leaving_date']+'</td>\
                              <td>Additional Service</td>\
                              <td>'+value['ricksu_ad_service']+'</td>\
                            </tr>\
                            <tr>\
                              <td>Yard Arrival Date</td>\
                              <td>'+value['ricksu_arrival_date']+'</td>\
                              <td>Repair Info</td>\
                              <td>'+value['ricksu_repair_info']+'</td>\
                            </tr>\
                            <tr>\
                                <td>Repair Fee</td>\
                                <td>'+value['ricksu_repair_fee']+'</td>\
                              <td>Repair Fee Tax</td>\
                              <td>'+value['ricksu_repair_fee_tax']+'</td>\
                            </tr>\
                            <tr>\
                              <td>Fee</td>\
                              <td>'+value['ricksu_fee']+'</td>\
                               <td>Fee Tax</td>\
                              <td>'+value['ricksu_fee_tax']+'</td>\
                            </tr>\
                            <tr>\
                              <td>Charger For Additional</td>\
                              <td>'+value['ricksu_charger_for_additional']+'</td>\
                              <td>Charger For Additional Tax</td>\
                              <td>'+value['ricksu_charger_for_additional_tax']+'</td>\
                            </tr>\
                            <tr>\
                              <td>Note</td>\
                              <td colspan="3">'+value['ricksu_note']+'</td>\
                            </tr>\
                          </tbody>\
                        </table>\
                              </div>\
                            </div>\
                          </div>';
                          x++;  
                          }
                        
                });
        var y = 1;
        var mini='';
                $.each(msg, function (index, value) {
                    
                    if (value['mini_ricksu']==1) {
                mini += '<div id="accordion" role="tablist" aria-multiselectable="true">\
                            <div class="panel">\
                              <div class="panel-heading" role="tab" id="headingOne">\
                                <h4 class="panel-title">\
                                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne'+index+'" aria-expanded="true" aria-controls="collapseOne'+index+'">\
                                   Mini Ricksu Information #'+y+'<br /> Company Name: <span class="text-capitalize">'+value['ricksu_company_name']+'</span>\
                                  </a>\
                                </h4>\
                              </div>\
                              <div id="collapseOne'+index+'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">\
                              <table class="table table-hover">\
                          <thead>\
                            <tr>\
                              <th>Index</th>\
                              <th>Detail</th>\
                              <th>Index</th>\
                              <th>Detail</th>\
                            </tr>\
                          </thead>\
                          <tbody>\
                            <tr>\
                              <td>Unique ID</td>\
                              <td>'+value['ricksu_id']+'</td>\
                              <td>Risku Company</td>\
                              <td>'+value['ricksu_company_name']+'</td>\
                            <tr>\
                              <td>Type</td>\
                              <td>'+value['ricksu_type']+'</td>\
                              <td>Pickup Point</td>\
                              <td>'+value['mini_ricksu_pickup']+'</td>\
                            </tr>\
                            <tr>\
                              <td>Delivery Point</td>\
                              <td>'+value['ricksu_delievery_point']+'</td>\
                              <td>Free </td>\
                              <td>'+value['ricksu_fee']+'-'+value['ricksu_fee_tax']+'</td>\
                            </tr>\
                            <tr>\
                              <td>Pickup Date</td>\
                              <td>'+value['ricksu_pickup_date']+'</td>\
                              <td>Delivery date</td>\
                              <td>'+value['ricksu_delivery_date']+'</td>\
                            </tr>\
                            <tr>\
                              <td>Note</td>\
                              <td colspan="3">'+value['ricksu_note']+'</td>\
                            </tr>\
                          </tbody>\
                        </table>\
                              </div>\
                            </div>\
                          </div>';
                             y++; 
                          }
                      
                });
                $(".modal-title").text('Ricksu Data');
                $("#loadData").empty().append(abc);
                $("#loadData").append(mini);
                $('#modal-id').modal('show');
            }else if (tblName == 'reservation') {
                var x = 1;
                $.each(msg, function (index,value) {
                abc += '<div id="accordion" role="tablist" aria-multiselectable="true">\
                        <div class="panel">\
                          <div class="panel-heading" role="tab" id="headingOne">\
                            <h4 class="panel-title">\
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne'+index+'" aria-expanded="true" aria-controls="collapseOne'+index+'Customer Name '+value['customer_name']+'">\
                                Reservation #'+x+'<br /> Customer Name: <span class="text-capitalize">'+value['customer_name']+'</span>\
                              </a>\
                            </h4>\
                          </div>\
                          <div id="collapseOne'+index+'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">\
                          <table class="table table-bordered">\
                          <thead>\
                            <tr>\
                              <th>Index</th>\
                              <th>Detail</th>\
                               <th>Index</th>\
                              <th>Detail</th>\
                            </tr>\
                          </thead>\
                          <tbody>\
                            <tr>\
                              <td>Reservation by</td>\
                              <td>'+value['username']+'</td>\
                              <td>Peyement Term</td>\
                              <td>'+value['reservation_payement']+'</td>\
                            </tr>\
                            <tr>\
                              <td>Reservation Sold Price</td>\
                              <td>'+value['reservation_sold_price']+'</td>\
                              <td>Reservation Que</td>\
                              <td>'+value['reservation_que']+'</td>\
                            </tr>\
                            <tr>\
                              <td>Reservation Customer</td>\
                              <td>'+value['customer_name']+'</td>\
                              <td rowspan="5">Reservation Note</td>\
                              <td rowspan="5">'+value['reservation_note']+'</td>\
                            </tr>\
                            <tr>\
                              <td>Reservation Date</td>\
                              <td>'+value['reservation_date']+'</td>\
                            </tr>\
                            <tr>\
                              <td>Reservation Start Date</td>\
                              <td>'+value['reservation_start_date']+'</td>\
                            </tr>\
                            <tr>\
                              <td>Reservation Expiry_date</td>\
                              <td>'+value['reservation_expiry_date']+'</td>\
                            </tr>\
                            <tr>\
                              <td>Reservation Status</td>\
                              <td>'+getSts(value['reservation_sts'])+'</td>\
                            </tr>\
                          </tbody>\
                        </table>\
                          </div>\
                        </div>\
                      </div>';
                      x++;
                });
                // abc += '';
                $(".modal-title").text('Reservation Data');
                $("#loadData").empty().append(abc);
                $('#modal-id').modal('show');
            }else if (tblName == 'export_info') {
             
    $.ajax({
        type: 'POST',
        url: 'php_action/custom_action.php',
        data:{action : "export_docs_links", id:colID},
        dataType: 'json',
        success:function (res) {


                    abc = '<table class="table table-hover">\
                                  <thead>\
                                    <tr>\
                                      <th>Index</th>\
                                      <th>From</th>\
                                      <th>To</th>\
                                      <th>Docs</th>\
                                    </tr>\
                                  </thead>\
                                  <tbody>\
                                  <tr>\
                                      <td>Ownership  Certificate</td>\
                                      <td>'+msg[0].export_info_mashou+'</td>\
                                      <td>'+msg[0].export_info_mashou_date+'</td>\
                                      <td>'+res[0]+'</td>\
                                    </tr>\
                                    <tr>\
                                      <td>Export Certificate</td>\
                                      <td>'+msg[0].export_info_export_certificate+'</td>\
                                      <td>'+msg[0].export_info_export_certificate_date+'</td>\
                                      <td>'+res[1]+'</td>\
                                    </tr>\
                                    <tr>\
                                    <tr>\
                                      <td>Translation</td>\
                                      <td>'+msg[0].export_info_translation+'</td>\
                                      <td>'+msg[0].export_info_translation_date+'</td>\
                                      <td>'+res[2]+'</td>\
                                    </tr>\
                                    <tr>\
                                      <td>Bill of Lading\
                                      <td>'+msg[0].bill_of_lading+'</td>\
                                      <td>'+msg[0].bill_of_lading_date+'</td>\
                                      <td>'+res[3]+'</td>\
                                    </tr>\
                                    <tr>\
                                      <td>Inspection Certificate\
                                      <td>'+msg[0].inspection_certificate+'</td>\
                                      <td>'+msg[0].inspection_certificate_date+'</td>\
                                      <td>'+res[4]+'</td>\
                                    </tr>\
                                    <tr>\
                                      <td>Shipping Order\
                                      <td>'+msg[0].export_info_shipping_order+'</td>\
                                      <td>'+msg[0].export_info_shipping_order_date+'</td>\
                                      <td>'+res[5]+'</td>\
                                    </tr>\
                                  </tbody>\
                                </table>';
                   
  
                $(".modal-title").text('Export Documents');
                $("#loadData").empty().append(abc);
                $('#modal-id').modal('show');
                }

         });
            }else if (tblName == 'consignee_info') {
                var x = 1;
            
                abc += '<table class="table table-hover table-responsive">\
                          <tbody>\
                          <tr>\
                          <th>Type</th>\
                              <th>Name</th>\
                              <th>Phone no.</th>\
                              <th>Email</th>\
                              <th>Contact Person</th>\
                              <th>Company</th>\
                              <th>Country</th>\
                              <th>Port</th>\
                               <th>Action</th>\
                          </tr>\
                          <tr>\
                              <th>Customer</th>\
                              <td>'+msg[0].customer_name+'</td>\
                              <td>'+msg[0].customer_phone+'</td>\
                              <td>'+msg[0].customer_email+'</td>\
                              <td>'+msg[0].customer_contact_person+'</td>\
                              <td>'+msg[0].customer_company+'</td>\
                              <td>'+msg[0].customer_country+'</td>\
                              <td>'+msg[0].customer_designation+'</td>\
                             <td><a target="_blank" href="details.php?type=customer&id'+msg[0].customer_id+'" class="btn btn-sm btn-primary">Details</a></td>\
                            </tr>\
                            <tr>\
                              <th>Consignee</th>\
                              <td>'+msg[0].consignee_name+'</td>\
                              <td>'+msg[0].consignee_mobile+'</td>\
                              <td>'+msg[0].consignee_email+'</td>\
                              <td>'+msg[0].consignee_contact_person+'</td>\
                              <td>'+msg[0].consignee_company+'</td>\
                              <td>'+msg[0].consignee_country+'</td>\
                              <td>'+msg[0].consignee_dest_port+'</td>\
                               <td><a target="_blank" href="details.php?type=consignee&id'+msg[0].consignee_id+'" class="btn btn-sm btn-primary">Details</a></td></td>\
                            </tr>\
                          </tbody>\
                        </table>';
             
                $(".modal-title").text('Consignee Data');
                $("#loadData").empty().append(abc);
                $('#modal-id').modal('show');
            }else if (tblName == 'inspection_info') {
                 var inspect = '<table class="table table-hover">\
                          <thead>\
                            <tr>\
                              <th>Index</th>\
                              <th>Detail</th>\
                                <th>Index</th>\
                              <th>Detail</th>\
                            </tr>\
                          </thead>\
                          <tbody>\
                           <tr>\
                              <td>Inspection For</td>\
                              <td>'+msg[0].inspection_info_for+'</td>\
                              <td>Repair Charges</td>\
                              <td>'+msg[0].inspection_info_repair_charges+'-'+msg[0].inspection_info_repair_charges_tax+'-</td>\
                            </tr>\
                            <tr>\
                             <td>Inspection Company</td>\
                              <td>'+msg[0].inspection_company_name+'</td>\
                              <td>Repair Done By</td>\
                              <td>'+msg[0].inspection_info_repair_done_by+'</td>\
                            </tr>\
                            <tr>\
                              <td> Vehicle Current Location</td>\
                              <td colspan="3">'+msg[0].inspection_info_point+'</td>\
                            </tr>\
                            <tr>\
                              <td>Inspection Charges</td>\
                              <td>'+msg[0].inspection_info_charges+'-'+msg[0].inspection_info_charges_tax+'</td>\
                                <td>Re Inspection</td>\
                              <td>'+msg[0].inspection_info_reinspection+'</td>\
                            </tr>\
                            <tr>\
                              <td>Inspection Appointment</td>\
                              <td>'+msg[0].inspection_info_app_date+'</td>\
                              <td>Re Inspection Fee - Tax</td>\
                              <td>'+msg[0].inspection_info_reinspection1+' - '+msg[0].inspection_info_reinspection1_tax+'</td>\
                            </tr>\
                            <tr>\
                              <td>Inspection Status</td>\
                              <td>'+msg[0].inspection_info_sts+'</td>\
                                <td>ReInspection Appointment</td>\
                              <td>'+msg[0].inspection_info_reinspection_app_date+'</td>\
                            </tr>\
                            <tr>\
                              <td>Validity Of Inspection</td>\
                              <td>'+msg[0].inspection_info_validity+'</td>\
                              <td>Re Inspection Status</td>\
                              <td>'+msg[0].inspection_info_reinspection_sts+'</td>\
                            </tr>\
                            <tr>\
                              <td>Failure Reason</td>\
                              <td colspan="3">'+msg[0].inspection_info_reason+'</td>\
                            </tr>\
                          </tbody>\
                        </table>';
                      console.log(inspect);
                $(".modal-title").text('Inspection Data');
                $("#loadData").empty().append(inspect);
                $('#modal-id').modal('show');
            }else if (tblName == 'shipment') {
                var x = 1;
                $.each(msg, function (index, value) {
                abc += '<table class="table table-hover">\
                          <thead>\
                            <tr>\
                              <th>Index</th>\
                              <th>Detail</th>\
                              <th>Index</th>\
                              <th>Detail</th>\
                              <th>Index</th>\
                              <th>Detail</th>\
                            </tr>\
                          </thead>\
                          <tbody>\
                            <tr>\
                              <td>Shipper Name</td>\
                              <td>'+value['shipper_name']+'</td>\
                              <td>Shipped Country</td>\
                              <td>'+value['shipment_country']+'</td>\
                              <td>Shipment Type</td>\
                              <td>'+value['shipment_type']+'</td>\
                            </tr>\
                            <tr>\
                              <td>Shipping Company</td>\
                              <td>'+value['shipment_company_name']+'</td>\
                              <td>Shipment Port of discharge</td>\
                              <td>'+value['shipment_port_of_discharge']+'</td>\
                              <td>Shipment Measures M3</td>\
                              <td>'+value['shipment_measures_m3']+'</td>\
                            </tr>\
                            <tr>\
                              <td>Voyage No#</td>\
                              <td>'+value['shipment_voyage_no']+'</td>\
                               <td>Shipping Line</td>\
                              <td>'+value['shipment_shipping_line']+'</td>\
                               <td>HS Code</td>\
                              <td>'+value['shipment_hc_code']+'</td>\
                            </tr>\
                            <tr>\
                              <td>Loading Of Country</td>\
                              <td>'+value['shipment_landing_country']+'</td>\
                               <td>Container No</td>\
                              <td>'+value['shipment_container_no']+'</td>\
                               <td>Ship Name & Info</td>\
                              <td>'+value['shipment_ship_name']+'</td>\
                            </tr>\
                            <tr>\
                              <td>Port Of Loading</td>\
                              <td>'+value['shipment_port_of_landing']+'</td>\
                               <td>Inner Cargo Measurement</td>\
                              <td>'+value['inner_cargo_l']+'-'+value['inner_cargo_w']+'-'+value['inner_cargo_h']+'</td>\
                               <td>Shipment Weight</td>\
                              <td>'+value['shipment_wieght']+'</td>\
                            </tr>\
                            <tr>\
                              <td>Inner Cargo</td>\
                              <td>'+value['shipment_access_with_cargo']+'</td>\
                              <td>Shipping Order Date</td>\
                              <td>'+value['shipment_date']+'</td>\
                               <td>Final Destination</td>\
                              <td>'+value['shipment_destination']+'</td>\
                            </tr>\
                            <tr>\
                              <td>Shipping Order No</td>\
                              <td>'+value['shipment_order_no']+'</td>\
                              <td>Terminal Handling Charges</td>\
                              <td>'+value['vehicle_terminal_charges']+'/'+value['vehicle_terminal_charges_tax']+'</td>\
                               <td>Inner Cargo Weight</td>\
                              <td>'+value['inner_cargo_weight']+'</td>\
                            </tr>\
                            <tr>\
                              <td>Cut Date</td>\
                              <td>'+value['shipment_order_cutting_date']+'</td>\
                              <td>Ship ETD</td>\
                              <td>'+value['ship_etd']+'</td>\
                               <td>Ship ETA</td>\
                              <td>'+value['ship_eta']+'</td>\
                            </tr>\
                            <tr>\
                              <td>BL Number</td>\
                              <td>'+value['bl_number']+'</td>\
                              <td>Shipping Charges</td>\
                              <td>'+value['shipping_charges']+'/'+value['shipping_charges_tax']+'</td>\
                                <td>Other Charges</td>\
                              <td>'+value['other_charges']+'/'+value['other_charges_tax']+'</td>\
                            </tr>\
                            <tr>\
                              <td>BL Charges</td>\
                              <td>'+value['vehicle_bl_charges']+'/'+value['vehicle_bl_charges_tax']+'</td>\
                              <td>Heat Treatment Charges</td>\
                              <td>'+value['heat_charges']+'/'+value['heat_charges_tax']+'</td>\
                                <td>Radiation Check Charges</td>\
                              <td>'+value['radiation_charges']+'/'+value['radiation_charges_tax']+'</td>\
                            </tr>\
                            <tr>\
                              <td>Freight Charges</td>\
                              <td>'+value['vehicle_freight_charges']+'/'+value['vehicle_freight_charges_tax']+'</td>\
                              <td> Notes</td>\
                              <td>'+value['shipment_notes']+'</td>\
                            </tr>\
                          </tbody>\
                        </table>';
                          x++;
                });
                $(".modal-title").text('Shipment Data');
                $("#loadData").empty().append(abc);
                $('#modal-id').modal('show');
            }else if (tblName == 'airmail') {
             
                abc = '<table class="table table-hover">\
                          <thead>\
                            <tr>\
                              <th>Index</th>\
                              <th>Detail</th>\
                               <th>Index</th>\
                              <th>Detail</th>\
                            </tr>\
                          </thead>\
                          <tbody>\
                            <tr>\
                              <td>Country</td>\
                              <td>'+msg[0].airmail_country+'</td>\
                              <td>Services Company</td>\
                              <td>'+msg[0].services_company_name+'</td>\
                            </tr>\
                            <tr>\
                              <td>Parcel Weight</td>\
                              <td>'+msg[0].airmail_parcel_weight+' KG</td>\
                             <td>Parcel Type</td>\
                              <td>'+msg[0].airmail_services_parcel_type+'</td>\
                            </tr>\
                             <tr>\
                              <td>Consignee Name</td>\
                              <td>'+msg[0].consignee_name+'</td>\
                              <td>Reciever Name</td>\
                              <td>'+msg[0].airmail_receiver_name+'</td>\
                            </tr>\
                            <tr>\
                              <td>City</td>\
                              <td>'+msg[0].airmail_city+'</td>\
                              <td>STATE</td>\
                              <td>'+msg[0].airmail_state+'</td>\
                            </tr>\
                            <tr>\
                              <td>STREET / ROAD (Optional)</td>\
                              <td>'+msg[0].airmail_street+'</td>\
                              <td>Suburb (Optional)</td>\
                              <td>'+msg[0].airmail_suburb+'</td>\
                            </tr>\
                            <tr>\
                              <td>ZIP/POSTAL CODE</td>\
                              <td>'+msg[0].airmail_zipcode+'</td>\
                              <td>Floor / Building</td>\
                              <td>'+msg[0].airmail_floor+'</td>\
                            </tr>\
                            <tr>\
                              <td>LANDLINE NO</td>\
                              <td>'+msg[0].airmail_landline+'</td>\
                              <td>Receiver Address</td>\
                              <td>'+msg[0].airmail_receiver_address+'</td>\
                            </tr>\
                            <tr>\
                              <td>Contact No</td>\
                              <td>'+msg[0].airmail_contact_no+'</td>\
                              <td>Fax No</td>\
                              <td>'+msg[0].airmail_fax+'</td>\
                            </tr>\
                            <tr>\
                              <td>EMAIL ADDRESS</td>\
                              <td>'+msg[0].airmail_email+'</td>\
                              <td>Contact (Receiver)</td>\
                              <td>'+msg[0].airmail_contact_receiver+'</td>\
                            </tr>\
                            <tr>\
                              <td>Request By</td>\
                              <td>'+msg[0].username+'</td>\
                              <td>Parcel No</td>\
                              <td>'+msg[0].airmail_parcel_no+'</td>\
                            </tr>\
                            <tr>\
                              <td>TRACKING NO</td>\
                              <td>'+msg[0].airmail_tracking_no+'</td>\
                              <td>Parcel Details</td>\
                              <td>'+msg[0].airmail_parcel_detail+'</td>\
                            </tr>\
                            <tr>\
                              <td>Courier Charges</td>\
                              <td>'+msg[0].airmail_courier_charges+'-'+msg[0].airmail_courier_charges_tax+'</td>\
                              <td>Date Of Dispatch</td>\
                              <td>'+msg[0].airmail_date_of_dispatch+'</td>\
                            </tr>\
                          </tbody>\
                        </table>';
                   
                $(".modal-title").text('Airmail Data');
                $("#loadData").empty().append(abc);
                $('#modal-id').modal('show');
            }
        }//success
    });
}

function getSts(value) {
    var sts = 0;
    if (value == 1) {
        return sts = '<span class="label label-success">Active</span>';
    }else{
        return sts = '<span class="label label-danger">Deactive</span>';
    }
    // document.write(sts);/
}

function setColor(getIDforCOlor) {
    alert(getIDforCOlor);
    $('.view').addClass('text-success');
}

function deleteVehicle(id){
    var tbl = 'vehicle_info';
    var fld = 'vehicle_id';
    var sts_col = 'vehicle_sts';
    $.ajax({
        url:'php_action/custom_action.php',
        type:"POST",
        data:{delete_user_id:id, tbl3:tbl, col_name:fld, sts_col:sts_col},
        dataType:"text",
        success:function(data) {       
            alert(data.trim());
        }
    });   
}

function deleteAuction(id){
    var tbl = 'auction_info';
    var fld = 'vehicle_id';
    var sts_col = 'auction_sts';
    $.ajax({
        url:'php_action/custom_action.php',
        type:"POST",
        data:{delete_user_id:id, tbl3:tbl, col_name:fld, sts_col:sts_col},
        dataType:"text",
        success:function(data) {
            alert(data.trim());
        }
    });   
}
function deleteFromTable(id,table) {
     var vehicle_idMain=$('.vehicle_idMain').val();
    if (table=="reservation") {
        var tbl = 'reservation';
        var fld = 'reservation_id';
        var sts_col = 'reservation_sts';
    }
Swal.fire({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover it!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
        $.ajax({
        url:'php_action/custom_action.php',
        type:"POST",
        data:{delete_user_id:id, tbl3:tbl, col_name:fld, sts_col:sts_col},
        dataType:"text",
        success:function(data) {
            swal(data.trim(), {icon: "success",});
            if (table=="reservation") {
                loadReservation(vehicle_idMain,"load");
            }
        }
    

    });//end of ajax
              
            
     
    
  } else {
    swal("Your Record  is safe!");
  }
});
    // body...
}
function deleteReservation(id){
    var tbl = 'reservation';
    var fld = 'vehicle_id';
    var sts_col = 'reservation_sts';
    $.ajax({
        url:'php_action/custom_action.php',
        type:"POST",
        data:{delete_user_id:id, tbl3:tbl, col_name:fld, sts_col:sts_col},
        dataType:"text",
        success:function(data) {
            alert(data.trim());
        }
    });   
}

function deleteRicksu(id){
    var tbl = 'ricksu';
    var fld = 'vehicle_id';
    var sts_col = 'ricksu_sts';
    $.ajax({
        url:'php_action/custom_action.php',
        type:"POST",
        data:{delete_user_id:id, tbl3:tbl, col_name:fld, sts_col:sts_col},
        dataType:"text",
        success:function(data) {
            
            sweeetalert("deleted",data.trim(),"warning",1500);
              $("#ricksu_idTable").load(location.href + " #ricksu_idTable");
                $("#mini_ricksu_tb").load(location.href + " #mini_ricksu_tb");

        }
    });   
}
function deleteMiniRicksu(id){
    var tbl = 'ricksu';
    var fld = 'ricksu_id';
    var sts_col = 'ricksu_sts';
    $.ajax({
        url:'php_action/custom_action.php',
        type:"POST",
        data:{delete_user_id:id, tbl3:tbl, col_name:fld, sts_col:sts_col},
        dataType:"text",
        success:function(data) {
            sweeetalert("deleted",data.trim(),"warning",1500);
              $("#mini_ricksu_tb").load(location.href + " #mini_ricksu_tb");

        }
    });   
}

function deleteExport(id){
    var tbl = 'export_info';
    var fld = 'vehicle_id';
    var sts_col = 'export_info_sts';
    $.ajax({
        url:'php_action/custom_action.php',
        type:"POST",
        data:{delete_user_id:id, tbl3:tbl, col_name:fld, sts_col:sts_col},
        dataType:"text",
        success:function(data) {
            
            sweeetalert("deleted",data.trim(),"warning",1500);
        }
    });   
}

function deleteConsignee(id){
    var tbl = 'consignee_info';
    var fld = 'vehicle_id';
    var sts_col = 'consignee_info_sts';
    $.ajax({
        url:'php_action/custom_action.php',
        type:"POST",
        data:{delete_user_id:id, tbl3:tbl, col_name:fld, sts_col:sts_col},
        dataType:"text",
        success:function(data) {
            
            sweeetalert("deleted",data.trim(),"warning",1500);
        }
    });   
}

function deleteInspection(id){
    var tbl = 'inspection_info';
    var fld = 'vehicle_id';
    var sts_col = 'inspection_info_sts2';
    $.ajax({
        url:'php_action/custom_action.php',
        type:"POST",
        data:{delete_user_id:id, tbl3:tbl, col_name:fld, sts_col:sts_col},
        dataType:"text",
        success:function(data) {
            
            sweeetalert("deleted",data.trim(),"warning",1500);
        }
    });   
}

function deleteShipment(id){
    var tbl = 'shipment';
    var fld = 'vehicle_id';
    var sts_col = 'shipment_sts';
    $.ajax({
        url:'php_action/custom_action.php',
        type:"POST",
        data:{delete_user_id:id, tbl3:tbl, col_name:fld, sts_col:sts_col},
        dataType:"text",
        success:function(data) {
            
            sweeetalert("deleted",data.trim(),"warning",1500);
        }
    });   
}

function deleteAirmail(id){
    var tbl = 'airmail';
    var fld = 'vehicle_id';
    var sts_col = 'airmail_sts';
    $.ajax({
        url:'php_action/custom_action.php',
        type:"POST",
        data:{delete_user_id:id, tbl3:tbl, col_name:fld, sts_col:sts_col},
        dataType:"text",
        success:function(data) {
            
            sweeetalert("deleted",data.trim(),"warning",1500);
        }
    });
}

function deleteImage(id){
    Swal.fire({
  title: "Are you sure?",
  text: "Once deleted, you will not be able to recover this imaginary file!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    var vehicle_idMain = $("#vehicle_idMain").val();
    $.ajax({
        url:'php_action/custom_action.php',
        type:"POST",
        data:{delete_image:id},
        dataType:"text",
        success:function(data) {
              //alert(vehicle_idMain);
              swal("Poof! Your imaginary file has been deleted!", {
      icon: "success",
    });
            loadImageGallery(vehicle_idMain);
        }
    });
    
  } else {
    swal("Your imaginary file is safe!");
  }
});
    
 
}
function make_featured(id,vehicle_id){
    $.ajax({
        url:'php_action/custom_action.php',
        type:"POST",
        data:{make_featured:id,vehicle_id:vehicle_id},
        dataType:"text",
        success:function(data) {
            // 
            sweeetalert("Featured",data.trim(),"warning",1500);
            loadImageGallery(load_vehicle_idMain);
        }
    });
}

$(document).on('change','#clientName',function(){
    var customer_idSaleInvoice = $(this).val();
     var type = $('#clientName').data('type');
     console.log(type);
   // alert(customer_idSaleInvoice);
    $.ajax({
        url:'php_action/custom_action.php',
        type:'post',
        data:{customer_idSaleInvoice1:customer_idSaleInvoice,type:type},
        dataType:'json',
        success:function(response){
            $("#customer_balance").html(response['data'].customer_balance);
            $("#invoice_previous_balance").val(Number(response['data4']));
            $("#customeName").val(response['data'].customer_name);
                var x = "";
                $.each(response['data2'], function (index, value) {
                x += '<option value="'+value['vehicle_id']+'">Stock No : '+value['vehicle_stock_id']+' Engine No : '+value['vehicle_engine_no']+' Brand Name : '+value['brand_name']+'</option>'
            });
                 $('#customOpt').empty().after(x);
              var y = "";
                $.each(response['data3'], function (index, value) {
                y += '<option value="'+value['consignee_id']+'">'+value['consignee_name']+'</option>'
            });
            if (y=="") {
                  y = '<option value="">No Data Found<option>';
            }      
            $('#consignee_id').html(y);
            
             $("#customer_balance").html(response['data4']);
            console.log(y);
            console.log(response['data4']);
        }
    });
});

$(document).on('change','#ledger_customer_id',function(){
    var customer_idForVehicle = $('#ledger_customer_id').val();
    
   // alert(customer_idSaleInvoice);
    $.ajax({
        url:'php_action/custom_action.php',
        type:'POST',
        data:{customer_idForVehicle:customer_idForVehicle},
        cache: false,
        success:function(response){
             var data = $.trim(response);
              
            $('#vehicle_id_custom').html(data);

            
        }
    });
});
 
$(document).on('change','#receving_bank',function(){
    var receving_bank = $(this).val();
    $.ajax({
        url:'php_action/custom_action.php',
        type:'post',
        data:{receving_bank2:receving_bank},
        dataType:'json',
        success:function(response){
            $("#receving_account").val(response.customer_name)
        }
    });
});

function getVehicle(){
    var vehicle_idSaleInvoice = $("#invoice_vehicle").val();
     var type = $('#invoice_vehicle').data('type');
     console.log(type);
    $.ajax({
        url:'php_action/custom_action.php',
        type:'post',
        data:{vehicle_idSaleInvoice:vehicle_idSaleInvoice,type:type},
        dataType:'json',
        success:function(response){  
            $("#f_Text").val("Brand Name : "+response[0].brand_name+' Stock ID : '+response[0].vehicle_stock_id);
            $("#invoice_cost").val(response[1])
            $("#invoice_rate").val(response[1])
            $("#invoice_show_rate").val(response[1])
            $("#services_fetch").html(response[2])
            $("#total").val(response[1])
            $("#f_Text").val("Brand Name : "+response[0].brand_name+' Stock ID : '+response[0].vehicle_stock_id);
            getTotalInvoice();
        }
    });
}

function getTotalInvoice(){
    var a = $("#invoice_rate").val();
    $("#total").val(a);
    var gtotal = Number(a);
    $("#invoice_grand_total").val(gtotal);
}


function getDiscount(){
    var service=parseInt($('#total_val').val());
    if (isNaN(service)) {
        var service=0;
    }
    var disc = $("#invoice_discount").val();
    var a = $("#invoice_rate").val();
    
    var gtotal = Number(a);
    discAmount = (Number(gtotal) / 100) * Number(disc);
    updategTotal = gtotal - discAmount+service;
    $("#invoice_grand_total").val(updategTotal)  
}

$(document).on('keyup','#paid_amount_incurrency',function(){
     var blance=Number($('#invoice_previous_balance').val());
    var pay =Number( $("#paid_amount_incurrency").val());
    if(pay>blance){
        $("#createOrderBtn").prop("disabled",true);
        sweeetalertbtn("Sorry..!","Paid Amount Can not be Greater than Account Balance :"+blance,"error");
}else{
         $("#createOrderBtn").prop("disabled",false);
    }
});
function getPaid(){
     var gtotal = $("#invoice_grand_total").val();
    var pay = $("#invoice_paid_amount").val();
    var due = Number(gtotal) - Number(pay); 
    $("#invoice_due_amount").val(due);
    var abc = Number(pay) / Number(gtotal) * 100;
    $("#invoice_paid_percent").val(abc)
}
     

function getPayPercent(){
    var percent = $("#invoice_paid_percent").val();
    var gtotal = $("#invoice_grand_total").val();
    var abc = Number(gtotal) / 100 * Number(percent);
    var xyz = gtotal - abc;
    var re = gtotal - xyz;
    $("#invoice_paid_amount").val(re);
    getPaid();
     $("#invoice_paid_amount").trigger('keyup');
}

$(document).on('change','.consignee_info',function(){
    var consignee_info_party_name = $(this).val();
    var abc = $(this).attr('id');
    $.ajax({
        url:'php_action/custom_action.php',
        type:'post',
        data:{consignee_info_party_name2:consignee_info_party_name},
        dataType:'json',
        success:function(response){
            $("."+abc+"_address").val(response.consignee_address)
            $("."+abc+"_shipment").val(response.consignee_address)
            $('.'+abc+'_shipment2 option[value="'+response.consignee_id+'"]').prop("selected", true); 

        }
    });
});

function loadBrands(makers) {
        $.ajax({
        url:'php_action/custom_action.php',
            type:"POST",
            data:{makers:makers},
            dataType:"json",
            success:function(response) {
                var model = "<option>~~SELECT~~</option>";
                $.each(response, function (index, value) {
                    model += '<option class="text-capitalize" value="'+value['brand_id']+'">'+value['brand_name']+'</option>';
                });
                var vehicle_idMain = $("#vehicle_idMain").val();
                $("#vehicle_brand").empty().append(model);
            }
        });
       
}
function loadcolorCode(code) {
      var maker=$("#vehicle_maker").val();

        $.ajax({
        url:'php_action/custom_action.php',
            type:"POST",
            data:{color_name_get:code,color_maker:maker},
            dataType:"text",
            success:function(response) {
            var responeID = response.trim();
            console.log(responeID)
            
                $("#vehicle_color_code_name").html(responeID);
            }
        });}
function loadChassis(vehicle_brand) {
    $.ajax({
    url:'php_action/custom_action.php',
        type:"POST",
        data:{vehicle_brand1 : vehicle_brand},
        dataType:"json",
        success:function(response) {
            console.log(response)
            var fucked = "<option>~~SELECT~~</option>";
            $.each(response, function (index, value) {
                fucked += '<option class="text-capitalize" style="text-transform: uppercase!important;" value="'+value['model_id']+'">'+value['model_name']+'</option>';
            });
            $("#vehicle_chassis_code").empty().append(fucked);
        }
    });
        $.ajax({
    url:'php_action/custom_action.php',
        type:"POST",
        data:{vehicle_brand_m3 : vehicle_brand},
        dataType:"json",
        success:function(response) {
            console.log(response);
            if (response.sts==1) {
                     $("#vehicle_m3").val(response.m3);
                $("#vehicle_length").prop("readonly",true);
                  $("#vehicle_width").prop("readonly",true);
                   $("#vehicle_height").prop("readonly",true);
                   $("#vehicle_length").prop("required",false);
                  $("#vehicle_width").prop("required",false);
                   $("#vehicle_height").prop("required",false);
                   $("#vehicle_length").val('0');
                  $("#vehicle_width").val('0');
                   $("#vehicle_height").val('0');
            }
            if (response.sts==0) {
                $("#vehicle_m3").val('');
                     $("#vehicle_length").val('0');
                  $("#vehicle_width").val('0');
                   $("#vehicle_height").val('0');
                 $("#vehicle_length").prop("readonly",false);
                  $("#vehicle_width").prop("readonly",false);
                   $("#vehicle_height").prop("readonly",false);
                $("#vehicle_length").prop("required",true);
                  $("#vehicle_width").prop("required",true);
                   $("#vehicle_height").prop("required",true);
            }
           
        }
    });
}
$(document).on('keyup ','#vehicle_m3',function(){
  var vehicle_m3= $("#vehicle_m3").val();
   if (vehicle_m3=='') {
        $("#vehicle_length").prop("readonly",false);
        $("#vehicle_width").prop("readonly",false);
        $("#vehicle_height").prop("readonly",false);
   }
});


function getAuctionBid(value) {
    $.ajax({
    url:'php_action/custom_action.php',
        type:"POST",
        data:{auction_house_bid : value},
        dataType:"json",
        success:function(response) {
            console.log(response)
            var fucked = "<option>~~SELECT~~</option>";
            $.each(response, function (index, value) {
                fucked += '<option class="text-capitalize" value="'+value['auction_home_type']+'">'+value['auction_home_type']+'</option>';
            });
            $("#auction_house_type").empty().append(fucked);   
        }
    });
}

function getAuctionFee(value) {
    var auction_id=$("#auction_house").val();
    $.ajax({
    url:'php_action/custom_action.php',
        type:"POST",
        data:{auction_house_bid : value,auction_id:auction_id},
        dataType:"json",
        success:function(response) {
            $("#auction_fee").val(response).trigger('keyup');
            console.log(response);
        }
    });
}


function AuctionInfNow(value) {
    $.ajax({
    url:'php_action/custom_action.php',
        type:"POST",
        data:{auction_house_idNOW : value},
        dataType:"json",
        success:function(response) {
            $("#pos_number").val(response.pos);
             $("textarea[name='companyname']").val(response.auction_address_en);
             console.log(response);
        }
    });
}
function customer_infoall(value) {
    $.ajax({
    url:'php_action/custom_action.php',
        type:"POST",
        data:{customer_infoall : value},
        dataType:"json",
        success:function(response) {
            $("textarea[name='seller_address']").val(response.customer_address);
            console.log(response);
        }
    });
}


///Service for unique invoice
    $('#add_service').on('click', function() {
    var services_id = $('select[name="services_id"]').val();
    var invoice_id = $('input[name="invoice_id"]').val();
    if (services_id!='') {
   $.ajax({
        url:"php_action/custom_action.php",
        type: "POST",
        data: {
          action:"services_add_inInvoice",
          services_id:services_id,
          invoice_id:invoice_id,   
        },
        cache: false,
        success: function(response){
         
          $(".msg").addClass("alert alert-success").text(response).fadeIn(3000).fadeOut(4000);
          // console.log(response);
          
          $('select[name="services_id"]').val("").change();
    
           services_fetch(invoice_id);

        }
      });}
});
    function deleteServies(invoice_id,services_id) {
     
      
      $.ajax({
        url: "php_action/custom_action.php",
        type: "POST",
        data: {
          action:"services_delete",
          invoice_id:invoice_id,
          services_id:services_id,
       
        },
         cache: false,
        success: function(response){
         
        services_fetch(invoice_id);
        // console.log(response);
        }
      });
}
    function services_fetch(invoice_id,gift='') {
     
      
      $.ajax({
        url: "php_action/custom_action.php",
        type: "POST",
        data: {
          action:"services_fetch",
          invoice_id:invoice_id,
          gift:gift,
       
        },
         cache: false,
        success: function(response){
         
       $("#servicesTable").html(response);
        // console.log(response);
        }
      });
}



    
     function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

    

    $("#imageUpload").on('change', function(){
        readURL(this);
    });
    
    $(".upload-button").on('click', function() {
       $("#imageUpload").click();
    });
    ///////////////////////////////////
  $("#customRadio1").on('click', function() {
      var auction=$("#ricksu_loading_point").val();
      var delievery=$("#ricksu_delievery_point").val();
      var type="running";
      $("#type").val(type);
      $('.typeof').html('Running');
      var pickup= $("#ricksu_loading_point :selected").text();
    $('.pickup').html(pickup);
      get_auction("auction",auction,type,delievery);
    //  get_auction("port",auction,'',delievery);
}); 

$("#mini_ricksu_type1").on('click', function() {
      var auction=$("#mini_ricksu_pickup").val();
      var delievery=$("#mini_ricksu_delievery_point").val();
      var type="running";
      $("#type").val(type);
      $('.typeof').html('Running');
      var pickup= $("#mini_ricksu_pickup").val();
    $('.pickup').html(pickup);
      get_auction("auction",auction,type,delievery,'yes');
     // get_auction("port",auction,'',delievery,'yes');
      $('#mini_ricksu_modal').modal('hide');
      $('#running').modal('show');
});
$("#mini_ricksu_type2").on('click', function() {
      var auction=$("#mini_ricksu_pickup").val();
      var delievery=$("#mini_ricksu_delievery_point").val();
      var type="notrunning";
      $("#type").val(type);
      $('.typeof').html('Not Running');
      var pickup= $("#mini_ricksu_pickup").val();
    $('.pickup').html(pickup);
      get_auction("auction",auction,type,delievery,'yes');
    //  get_auction("port",auction,'',delievery,'yes');
      $('#mini_ricksu_modal').modal('hide');
      $('#running').modal('show');
}); 


 $("#ricksu_loading_point").on('change', function() {
     var auction=$("#ricksu_loading_point").val();
      get_auction("port",auction);
});


    $("#customRadio2").on('click', function() {
      var auction=$("#ricksu_loading_point").val();
      var delievery=$("#ricksu_delievery_point").val();
     var pickup= $("#ricksu_loading_point :selected").text();
      var type="notrunning";
     
      $("#type").val(type);
      $('.typeof').html('Not Running');
      $('.pickup').html(pickup);

      get_auction("auction",auction,type,delievery);
       // get_auction("port",auction,'',delievery);

});
    function get_auction(getstat,auction,type='',delievery='',modal='no') {
    $.ajax({
        url:'php_action/custom_action.php',
        type:'post',
        data:{auction:"get_auction",getstat:getstat,type:type,auction_value:auction,delievery:delievery,modal:modal},
        success:function(response){
            if (getstat=="auction") {
            $('#company_details').empty().html(response);
            
        }
        if (getstat=="company_info") { 
            $('#get_company_info').empty().html(response);
             $('.cp_name').html(type);
        }
        // if(getstat=="port"){ 

        //     if (modal=="yes") {
        //         $('#mini_ricksu_delievery_point').html(response); 
        //         //     if (delievery!='') {
        //         //     $("#mini_ricksu_delievery_point option[value="+delievery+"]").prop('selected', true);
        //         // } 
        //     }else{
        //            $('#ricksu_delievery_point').html(response);
        //      //       if (delievery!='') {
        //      // $("#ricksu_delievery_point option[value="+delievery+"]").prop('selected', true);
        //      // } 
        // }
        
       
        // }
             
           
        }
    });
   
        $.ajax({
        url:'php_action/custom_action.php',
        type:'post',
        data:{get_subyards:auction},
        dataType:'json',
        success:function(response){
              var y = "";
                $.each(response, function (index, value) {
                y += '<option value="'+value['sub_yard_id']+'">'+value['sub_yard_name']+'</option>'
            });
           
            $('#ricksu_sub_yard').empty().append(y);
        }
    });

    }
    function getSubYards(auction,id){
          $.ajax({
        url:'php_action/custom_action.php',
        type:'post',
        data:{get_subyards:auction},
        dataType:'json',
        success:function(response){
             var y = "<option value=''>Select Yard</option>";
                $.each(response, function (index, value) {
                y += '<option value="'+value['sub_yard_id']+'">'+value['sub_yard_name']+'</option>'
            });
           
            $(id).empty().append(y);
        }
    });
    }
    function set_risku(values,port,fee,days) {
    $("#ricksu_company option[value="+values+"]").prop('selected', true);
        
        $("#ricksu_fee").val(fee);
        var tax=fee*10/100;
        $("#ricksu_fee_tax").val(tax);
        $("#ricksu_free_at_yard").val(days);
        // $('#ricksu_delievery_point option[value="'+port+'"]').prop("selected", true); 
      
        // body...
    }
        function set_mini_risku(values,port,fee,days) {
    $('#running').modal('hide');
    $('#mini_ricksu_modal').modal('show');
    $("#mini_ricksu_company option[value="+values+"]").prop('selected', true);
        
        $("#mini_ricksu_fee").val(fee);
        var tax=fee*10/100;
        $("#mini_ricksu_fee_tax").val(tax);
 //       $("#ricksu_free_at_yard").val(days);
 console.log(port);
        // $('#mini_ricksu_delievery_point option[value="'+port+'"]').prop("selected", true); 
        
            
    }
    function refreshMe(id) {
            $("#"+id).load(location.href + " #"+id+" > *");
    }
function refreshDiv() {
    $("#RefreshMine").load(location.href + " #RefreshMine > *");
   
} 
 function refereshdocs() {
   // alert('refresh');
     $(".refereshdocs").load(location.href + " .refereshdocs > *");
     // body...
 }

function pay_byinvoice(invoice,vehicle,customer,due) {
     var amount=$("#inv_id"+invoice+"").val();
     var voucher_id=$("#voucher_id").val();
     var remain=due-parseInt(amount);
     $.ajax({
            url:'php_action/custom_action.php',
            type:'post',
            data:{action:"payment_voucher",amount:amount,invoice:invoice,vehicle:vehicle,customer:customer,remain:remain,voucher_id:voucher_id},
            dataType:'text',
            success:function(response){  
                $(".response").html(response);
            }
        });
     console.log(invoice,vehicle,customer,amount);
}
$("#shipper").on('click',function() {
    var consignee_dest_port= $("#consignee_dest_port :selected").text(); 
    var consignee_final_dest= $('#consignee_final_dest').val(); 

    console.log(consignee_dest_port);
    console.log(consignee_final_dest);
    $('#shipment_port_of_discharge').val(consignee_dest_port);
    $('#shipment_destination').val(consignee_final_dest); 
    
});

function getSoldDetails(vehicle) {
     $.ajax({
            url:'php_action/custom_action.php',
            type:'post',
            data:{action:"getSoldDetails",vehicle:vehicle},
            dataType:'text',
            success:function(response){  
                $("#show_sales_getdata").html(response);
            }
        });
     
} 
$('#invoice_vehicle,#invoice_rate,#fci_field,#Frieght,#cui_field').on('keyup change', function() {countSubTotal();});

function countSubTotal() {
     var fob=cnf=total=0;
setTimeout(function() { 
    var rate=$('input[name="invoice_rate"]').val();
    var inspection=$('#fee').val();
    var services_fee=$('#total_services_fee').val();
  if (inspection=='') {inspection=0;}
    fob=parseInt(rate)+parseInt(inspection);
    
    $('#fci').prop('checked',true);
    $('#cui').prop('checked',true);
    $('#fci_field').val(fob);
     $("#fci_field").removeClass('d-none');
     $("#fci_field").addClass("d-block");

    var Frieght=$('#Frieght').val();
      if (Frieght=='') {Frieght=0;}
    cnf=fob+parseInt(Frieght);
    $('#cui_field').val(cnf);
     $("#cui_field").removeClass('d-none');
     $("#cui_field").addClass("d-block");
    $('#sub_total_amount').val(cnf);
        $('#invoice_grand_total').val(cnf);

    }, 1500);

}
function checkbalance(id){
   $('#remaining_amount_topay').val('');
    var total=$('#total_ammount_topaid').val();
    $('#remaining_amount_topay').val(total);
    var amout=total_value=paying_amount=0;
    var balance=$('#check'+id).data('balance');
    var current=$('#check'+id).val();
    var left=$('#total_ammount_counted').val();
    
    
    $("input[name='paying_amount[]']").each(function() {
   if (this.value!==NaN) {
    amout=amout+Number(this.value);
        
  }
   });
 
    paying_amount=Number(left);
    if (amout!==NaN) {
          total_value=paying_amount-amout;
 
       console.log(total_value);
      $('#remaining_amount_topay').val(total_value);
    }
  
        if (amout>total) {
            $('#alert'+id).html('Paying Amount Should not Greater then TOTAL AMOUNT RECEIVED ');
            $('#alert'+id).css('display',"block");
        }
        if (amout<total) {
            $('#alert'+id).css('display',"none");
            $('#check'+id).css('border',"1px solid green");
        }
    

  // console.log(current);
  // console.log(balance);
 if (current>balance) {
    $('#check'+id).css('border',"1px solid red");
    $('#alert'+id).html('Paying Amount Should not Greater then Remaing Amount ');
     $('#alert'+id).css('display',"block");
    setTimeout(function() { 
     $('#check'+id).val(balance);   
    }, 1000);
 }
 if (current<balance || current==balance) {
     $('#alert'+id).css('display',"none");
    $('#check'+id).css('border',"1px solid green");
   // console.log('Less Amount');
 }
}

// $('#total_amount_recevied').on('keyup change', function() {
//     var total=$('#total_ammount_topaid').val();
//      $('#total_amount_recevied').attr('max',total);
//      var currentVal=$('#total_amount_recevied').val();

// if (total<currentVal) {
//     $('#alert_ammount_received').css('display',"block");
//     $('#alert_ammount_received').html('Ammount Should Not Be Less then '+total);
//     $('#total_amount_recevied').css('border',"1px solid red");
     
//     }
// if (total>currentVal) {
//     $('#alert_ammount_received').css('display',"none");
//     $('#total_amount_recevied').css('border',"1px solid green");
     
//     }
// });


                   function gift(amount,services_id,vehicle_id,invoice_id) {
                    var total_va=grandTotal=0;
                    //$(".service"+services_id).prop("checked", false);
                    $('#gift_'+services_id).prop("checked", true);
                    $('#notpur_'+services_id).prop("checked", false);
                    $('#pur_'+services_id).prop("checked", false);
                    $('#gift_'+services_id).attr('readonly', 'readonly');
                    $('#notpur_'+services_id).attr('readonly', '')
                    $('#pur_'+services_id).attr('readonly', '')
                     total_val= parseInt($('#total_val').val());
                   if (parseInt($('#invoice_grand_total').val())!=total_val) {
                      grandTotal=parseInt($('#invoice_grand_total').val()) - amount;
                    $('#invoice_grand_total').val(grandTotal);
                    $('#sub_total_amount').val(grandTotal);
                       
                   }
                 console.log(amount);
            
                    
                   }
            function notpurchase(amount,services_id,vehicle_id,invoice_id) {
                   var  total_va=grandTotal=0;
                     total_val= parseInt($('#total_val').val());
                   if (parseInt($('#invoice_grand_total').val())!=total_val) {
                      grandTotal=parseInt($('#invoice_grand_total').val()) - amount;
                    $('#invoice_grand_total').val(grandTotal);
                    $('#sub_total_amount').val(grandTotal);
                    
                   }
                    $('#notpur_'+services_id).prop("checked", true);
                    $('#gift_'+services_id).prop("checked", false);
                    $('#pur_'+services_id).prop("checked", false);
                    $('#notpur_'+services_id).attr('readonly', 'readonly');
                    $('#gift_'+services_id).attr('readonly', '')
                    $('#pur_'+services_id).attr('readonly', '') 
                    
                   }
                   $('#printcustomer_btn').click(function(){
                       $('#print_fm').attr('action', 'print_multiinvoice.php');
                       $('#print_fm').submit();
                    });
                      $('#printcustom_btn').click(function(){
                       $('#print_fm').attr('action', 'custom_invoicemulti.php');
                       $('#print_fm').submit();
                    });
                   function purchase(amount,services_id,vehicle_id,invoice_id) {
                     console.log(amount);
                    
                    $('#pur_'+services_id).prop("checked", true);
                    $('#notpur_'+services_id).prop("checked", false);
                    $('#gift_'+services_id).prop("checked", false);
                    $('#pur_'+services_id).attr('readonly', 'readonly');
                    $('#notpur_'+services_id).attr('readonly', '')
                    $('#gift_'+services_id).attr('readonly', '')    
                
                  var purchacetotal=parseInt(amount)+ parseInt($('#invoice_grand_total').val());
                    $('#invoice_grand_total').val(purchacetotal);
                    $('#sub_total_amount').val(purchacetotal);
                    
                   }
$(document).on('change','#sendCustomerID',function(){
 var id=$('#sendCustomerID').val();
   console.log(id);
 $.ajax({
            url:'php_action/custom_action.php',
            type:'post',
            data:{action:"getreserbationinfo",id:id,type:"customer"},
             dataType:'text',
            beforeSend:function() {
            },
            success:function (data) {
                       $('#showReservations').empty().html(data);
           
            }
        });//ajax call  
 });
$(document).on('change','#sendVehicleID',function(){
 var id=$('#sendVehicleID').val();
   console.log(id);
 $.ajax({
            url:'php_action/custom_action.php',
            type:'post',
            data:{action:"getreserbationinfo",id:id,type:"vehicle"},
             dataType:'text',
            beforeSend:function() {
            },
            success:function (data) {
                       $('#showReservations').empty().html(data);
           
            }
        });//ajax call
 });

$(document).on('change','#reservation_start_date',function(){
 var id=$('#reservation_start_date').val();
 $.ajax({
            url:'php_action/custom_action.php',
            type:'post',
            data:{action:"getReservationDate",id:id},
             dataType:'text',
            beforeSend:function() {
            },
            success:function (data) {
                var dateEnd=data.trim();
                       $('#reservation_expiry_date').val(dateEnd);
                     
            }
        });//ajax call
 });

$(document).on('change','#auction_date',function(){
 var id=$('#auction_date').val();
 var current_date = $("#current_date").val();
 if (id<current_date || id==current_date) {
 $.ajax({
            url:'php_action/custom_action.php',
            type:'post',
            data:{action:"getReservationDate",id:id},
             dataType:'text',
            beforeSend:function() {
            },
            success:function (data) {
                var dateEnd=data.trim();
                       $('#auction_transport_due_date').val(dateEnd);
                       $('#auction_deadline').val(dateEnd);
                     
            }
        });//ajax call
}else{
    alert("Auction Date should not be greater then Current date");
                 $("#auction_date").val('');
                 $('#auction_transport_due_date').val('');
                 $('#auction_deadline').val('');
}
 });

$(document).on('change','#customer_buy_date',function(){
 var id=$('#customer_buy_date').val();
 $.ajax({
            url:'php_action/custom_action.php',
            type:'post',
            data:{action:"getReservationDate",id:id},
             dataType:'text',
            beforeSend:function() {
            },
            success:function (data) {
                var dateEnd=data.trim();
                       $('#payment_deadline2').val(dateEnd);
                     
            }
        });//ajax call
 });


$(document).on('change','#customer_id_trade',function(){
 var id=$('#customer_id_trade').val();
   
var country_ports=notify_party='';
  // $.ajax({
  //           url:'php_action/custom_action.php',
  //           type:'post',
  //           data:{action:"getNotifyparty",id:id,type:"consignee"},
  //              dataType:'json',
  //           success:function(response){  
  //               console.log(response);
  //               var country_ports = "<option value=''>~~SELECT~~</option>";
  //               $.each(response, function (index, value) {
  //                   country_ports += '<option class="text-capitalize" value="'+value['consignee_id']+'">'+value['consignee_name']+'</option>';
  //               });
  //               $("#consignee_id_trade").empty().html(country_ports);
  //           }
            
  //       });//ajax call
  $.ajax({
            url:'php_action/custom_action.php',
            type:'post',
            data:{action:"getNotifyparty",id:id,type:"notify"},
             dataType:'json',
            success:function(response){  
                console.log(response);
                var country_ports = "<option >~~SELECT~~</option>";
                $.each(response, function (index, value) {
                    notify_party += '<option class="text-capitalize" value="'+value['consignee_id']+'">'+value['consignee_name']+'</option>';
                });
                $("#customer_notify").empty().html(notify_party);
            }
        });//ajax call
 });

$('#notify_id_trade').fadeOut('slow');
$(document).on('click','#same_as_notify',function(){
$('#notify_id_trade').fadeIn('slow');
});

$(document).on('click','#same_as_consignee',function(){
$('#notify_id_trade').fadeOut('slow');
});

// $(document).on('change','#shipment_etd',function(){
 
//  var shipment_etd=$('#shipment_etd').val();
//  var shipment_eta=$('#shipment_eta').val();

// if (shipment_eta<shipment_etd) {
//     alert("shipment eta should be greater then shipment etd");
//     $('#shipment_etd').val('');
// }

// });
$(document).on('change','#shipment_eta',function(){
 
 var shipment_etd=$('#shipment_etd').val();
 var shipment_eta=$('#shipment_eta').val();

if (shipment_eta<shipment_etd) {
    alert("shipment eta should be greater then shipment etd");
    $('#shipment_eta').val('');
}

});

function sweeetalert(title,text,status,time) {
         Swal.fire({
                          title: title,
                          text: text,
                          type : status,
                          icon: status,
                          timer: time,
                          buttons: false,
                          showCancelButton: false,
                          showConfirmButton: false
                        }); 
}
function sweeetalertbtn(title,text,status) {
         Swal.fire({           title: title,
                          text: text,
                          icon: status,
                    
                        }); 
}
$("#add_nav_menus_fm").on('submit',function(e) {

        e.preventDefault();
        e.stopPropagation(); // only neccessary if something above is listening to the (default-)event too
        var form = $('#add_nav_menus_fm');
      //  var files = $('#auction_sheet')[0].files[0];
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType:'json',
            beforeSend:function() {
                $('#add_nav_menus_btn').prop("disabled",true);
                // $('#saveData1').text("Loading...");
            },
            success:function (responeID) {
               
                $('#add_nav_menus_btn').prop("disabled",false);
                $('#add_nav_menus_fm').each(function(){
                    this.reset();
                });    
                if (responeID.sts=="success") {
                sweeetalert("Added","Menu has been Added",'success',2000);
                $("#add_nav_table").load(location.href + " #add_nav_table");
                }
                if (responeID.sts=="info") {
                sweeetalert("Update","Menu has been Updated",'info',2000);
                $("#add_nav_table").load(location.href + " #add_nav_table");
                }
 
            
            }
        });//ajax call
    });//main
$("#refund_req_fm").on('submit',function(e) {

        e.preventDefault();
        e.stopPropagation(); // only neccessary if something above is listening to the (default-)event too
        var form = $('#refund_req_fm');
      //  var files = $('#auction_sheet')[0].files[0];
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType:'json',
            beforeSend:function() {
                $('#refund_req_btn').prop("disabled",true);
                // $('#saveData1').text("Loading...");
            },
            success:function (responeID) {
               
                $('#refund_req_btn').prop("disabled",false);
                $('#refund_req_fm').each(function(){
                    this.reset();
                });    
                if (responeID.sts=="success") {
                sweeetalert("DONE","Request Has Been Submit",'success',2000);
                //$("#add_nav_table").load(location.href + " #add_nav_table");
                }
                if (responeID.sts=="info") {
                sweeetalert("Update","Request has been Updated",'info',2000);
                //$("#add_nav_table").load(location.href + " #add_nav_table");
                }
 
            
            }
        });//ajax call
    });//main
$("#refund_req_app_fm").on('submit',function(e) {

        e.preventDefault();
        e.stopPropagation(); // only neccessary if something above is listening to the (default-)event too
        var form = $('#refund_req_app_fm');
        var files = $('#new_document_file')[0].files[0];
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType:'json',
            beforeSend:function() {
                $('#refund_req_app_btn').prop("disabled",true);
                // $('#saveData1').text("Loading...");
            },
            success:function (responeID) {
               
                $('#refund_req_app_btn').prop("disabled",false);
                $('#refund_req_app_fm').each(function(){
                    this.reset();
                });    
                if (responeID.sts=="success") {
                sweeetalert("Rejected","Request Has Been Rejected",'info',2000);
                //$("#add_nav_table").load(location.href + " #add_nav_table");
                }
                if (responeID.sts=="info") {
                sweeetalert("Approved","Request has been Approved",'info',2000);
                //$("#add_nav_table").load(location.href + " #add_nav_table");
                }
 
            
            }
        });//ajax call
    });//main

 function deleteData(table,fld,id,url){

      var x = confirm(' Do you want to ID# : '+id);

        if (x==true) {

           $.ajax({

          url:"php_action/ajax_deleteData.php",

          type:"post",

          data:{table:table,fld:fld,delete_id:id,url:url},

          dataType:"json",

          success:function(response){
             $(".response").html('<div class="alert alert-'+response.sts+' text-center">'+response.msg+'</div>');
                


            setTimeout(function(){

               window.location=url;

              $(".response").html('');

            },1500);

          }

        });

      }
}
function getRefundDetails(id) {
    //console.log(id);
      $.ajax({
            type: 'POST',
            url: "php_action/custom_action.php",
            data: {action:"getRefundDetails",id:id},
            dataType:'text',
            success:function (msg) {
                var responeID = msg.trim();
               console.log(responeID)
                $('#getrfunds_data').empty().html(responeID);
               
 
            
            }
        });//ajax call
}
function getbalance(id,return_id) {
     $.ajax({
            type: 'POST',
            url: "php_action/custom_action.php",
            data: {action:"getBalance",id:id},
            dataType:'text',
            success:function (msg) {
                var responeID = msg.trim();
               console.log(responeID)
                $('#'+return_id).empty().val(responeID);
                 $('#'+return_id+'_text').empty().html(responeID);
               
 
            
            }
        });//ajax call
}
$("#requested_amount").on('keyup',function() {
    var requested_amount=parseInt($('#requested_amount').val());
    var balance_amount=parseInt($('#balance_amount').val());
    if (requested_amount>balance_amount) {
     $('#requested_amount').css("border-color",'red'); 
     $('#refund_req_btn').prop('disabled',true);  
     
    }

     if (requested_amount<=balance_amount) {
     $('#requested_amount').css("border-color",'green'); 
     $('#refund_req_btn').prop('disabled',false);  
     
    }

});

// $(".customer_country").on('change',function() {
//     //var consignee_country=$('#customer_country').val();
    

//  //  var vala=capitalizeFirstLetter(consignee_country);
//    // $('#customer_country').val(consignee_country);
//     //$('#customer_country').trigger('change');    
//  var customer_country= $('#customer_country option:selected').data('country');

//  console.log(customer_country);

//            $.ajax({
//             url:'php_action/custom_action.php',
//             type:'post',
//            data:{action:"getDestiPort",customer_country:customer_country},
//             dataType:'json',
//             success:function(response){  
//                 var country_ports = "<option>~~SELECT~~</option>";
//                 $.each(response, function (index, value) {
//                     country_ports += '<option class="text-capitalize" value="'+value['country_regulation_destination_port']+'">'+value['country_regulation_destination_port']+'</option>';
//                 });
//                 $("#consignee_dest_port").empty().append(country_ports);
//             }
//         });
             
    
// });
function capitalizeFirstLetter(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}

    //Save Data into Database
    $("#add_customer_data").on('submit',function(e) {

        e.preventDefault();
        e.stopPropagation(); // only neccessary if something above is listening to the (default-)event too
        var form = $('#add_customer_data');
              if (document.getElementById("customer_type_check").value!="bank" ) {
             var files = $('#customer_identity')[0].files[0];
                    }
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType:'json',
            beforeSend:function() {
                $('#add_customer_data_btn').prop("disabled",true);
                // $('#saveData1').text("Loading...");
            },
            success:function (res) {
               // var responeID = msg.trim();
                managecustomers.ajax.reload(null, false);
                managebank.ajax.reload(null, false);
                   if (res.sts=='warning') {
                sweeetalert("Error",res.msg,res.sts,2000);
                   $('#add_customer_data_btn').prop("disabled",false);
                
                   }
                      $("#customer_banks_tb").load(location.href + " #customer_banks_tb");

                   if (res.sts=='success') {
                    sweeetalert("Added",res.msg,res.sts,2000);
                   $('#add_customer_data_btn').prop("disabled",false);
                     $('#add_customer_data').each(function(){
                    this.reset();
                });    
                   }
                
            }
        });//ajax call
    });//main
    function setRequest_id(id) {
          $('#request_id').val(id);
    }
 $("#document_file_form").on('submit',function(e) {

        e.preventDefault();
        e.stopPropagation(); // only neccessary if something above is listening to the (default-)event too
        var form = $('#document_file_form');
        var files = $('#refund_docs_file')[0].files[0];
                
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType:'json',
            beforeSend:function() {
                $('#document_file_btn').prop("disabled",true);
                // $('#saveData1').text("Loading...");
            },
            success:function (res) {
               // var responeID = msg.trim();
                  sweeetalert("Added","Document Has been Added","success",2000);
                   $('#refund_document_modal').modal('hide');
                  

                   
                   $('#document_file_btn').prop("disabled",false);
                     $('#document_file_form').each(function(){
                    this.reset();
                });    
                   
                $("#doc_fund_tb").load(location.href + "#doc_fund_tb");

                
            }
        });//ajax call
    });//main
 $(document).on('change', '#consignee_country', function () {
   // alert("abc");
        var consignee_country = $(this).val();
        $.ajax({
            type: 'POST',
            url: 'php_action/custom_action.php',
            data:{consignee_country12 : consignee_country},
            dataType: 'json',
            success:function (msg) {
                $(".customer_landline").val(msg)
                // $(".consignee_country").val(msg.name)
                $("#consignee_mobile").val(msg)
                $("#consignee_fax").val(msg)
                $("#consignee_landline").val(msg)
            }   
        });
    });
     $("#reservation_sold_price").on('change',function() {
         var reservation_sold_price = $('#reservation_sold_price').val();
        var vehicle_estimated_price = $('#vehicle_estimated_price').val();
var sold=parseInt(reservation_sold_price);
var esti=parseInt(vehicle_estimated_price);
        
        if (esti>sold) {

        sweeetalertbtn("Warning",'Amount should not b less the Estimated Price','warning');
            $('#reservation_sold_price').val('');
        }
      
    });
     $("#res_vehicle_id").on('change',function() {
         var res_vehicle_id = $('#res_vehicle_id').val();
         $.ajax({
            type: 'POST',
            url: 'php_action/custom_action.php',
            data:{action : "getQue",id:res_vehicle_id},
            dataType: 'json',
            success:function (msg) {
                console.log(msg);
                $("#reservation_que").val(msg[0]);
                $("#vehicle_estimated_price").val(msg[1]);
                 $("#vehicle_estimated_price_view").val(msg[1]);
                 checkResLastdate(res_vehicle_id);
                
                    
            }   

        });
  
 
      

    });
     function checkResLastdate(vehicle_id) {
           $.ajax({
            type: 'POST',
            url: 'php_action/custom_action.php',
            data:{action:"checkResLastdate",vehicle_id:res_vehicle_id},
            dataType: 'json',
            success:function (res) {
                console.log(res);
              var reservation_start_date=addDays(res, 1);          
            $("#reservation_start_date").val(reservation_start_date);
             $("#reservation_start_date").trigger('change');
            
            }   
             });
     }
     
function checkDateValidty(id){

   var vehicle_idMain=$(".vehicle_idMain").val();
    var value=  $("input[name='"+id+"']").val();
  
        $.ajax({
            type: 'POST',
            url: 'php_action/custom_action.php',
            data:{action:"checkDateValidty",value:value,vehicle_id:vehicle_idMain},
            dataType: 'json',
            success:function (res) {
            if (res.sts=="danger") {
                sweeetalertbtn("Warning",res.msg,'warning');

                     $("#"+id).val('');
            }   
                
            }   
        });
}
// function checkResLastdate(){

//    var vehicle_idMain=$(".vehicle_idMain").val();
//    var value=  $("#reservation_start_date").val();
//     console.log(value);
//         $.ajax({
//             type: 'POST',
//             url: 'php_action/custom_action.php',
//             data:{action:"checkResLastdate",value:value,vehicle_id:vehicle_idMain},
//             dataType: 'json',
//             success:function (res) {
//                 console.log(res);
//              //    addDays(res, 1);          
//               if (res>value || res==value) {
//             alert("Current Date should be greater than to "+res+" last date");
//             $("#reservation_start_date").val('');
//             }
//             }   

//         });
// }
function addDays(date, days) {
  var result = new Date(date);

 
  var date = result.getDate()+1;
var month = result.getMonth() + 1; // Since getMonth() returns month from 0-11 not 1-12
var year = result.getFullYear();
if (month>0 || month<10) {
    month="0"+month;
}
var dateStr = year + "-" + month + "-" + date;
 console.log(dateStr);
  return dateStr;
}
    function checkduedate() {
        var current_date=$('#orderDate').val();
        var invoice_next_due=$('#invoice_next_due').val();
         var orderDate=$('input[name="invoice_due_date"]').val();
        if (invoice_next_due<current_date) {
            $('#createOrderBtn').prop('disabled',true);
            $('#invoice_next_due').val('');
            alert('Due Date Should Not Less then Current Date');
        }
        else if(orderDate<current_date){
            $('input[name="invoice_due_date"]').val('');
            alert('Due Date Should Not Less then Current Date')
            $('#createOrderBtn').prop('disabled',true);
       
        }
        else{
            $('#createOrderBtn').prop('disabled',false);

        }
    }
    function resetFormId(id){
        document.getElementById(id).reset();
    }
    function changeName(id,txt) {
        Loader.open();
          $("#"+id).text(txt);
           $("#"+id).prop('disabled',false);

           if (id=="formData4_save") {
            setTimeout(function() {
            $('#reservation_start_date').trigger('change');
            var vehicle_idMain=$('.vehicle_idMain').val();
            getReservationQue(vehicle_idMain);
            Loader.close();
            },2000);
           }else{
             Loader.close();
           }
   
        // body...
    }
      function trig(id,evenType) {
         $('#'+id).trigger(evenType);        // body...
            }
  function compareDates(from,to,name) {
      var from_date=$('#'+from).val(); //smaleer
        var to_date=$('#'+to).val(); //greater  
              var current = $('.current_date').val();
   if (current<from_date) {
        $('#'+from).val('');
        sweeetalertbtn("Warning",'Date should not be Greater than Current Date','warning');
       
     } else if (current<to_date) {
         $('#'+to).val('');
        sweeetalertbtn("Warning",'Date should not be Greater than Current Date','warning');

     }
     else if (from_date>to_date) {
            $('#'+to).val('');
            if (to_date!='') {

                sweeetalertbtn("Warning",'Date should  be greater than '+name,'warning');

            }
        }
  }
  function compareDateByless(from,to,name) {
      var from_date=$('#'+from).val(); //bri 
        var to_date=$('#'+to).val(); //smaller
        
        if (from_date<to_date) { //if from is less then to
            $('#'+to).val('');

    sweeetalertbtn("Warning",'Date should not be less than '+name,'warning');

        }
  }
  function compareDateBylessF(from,to,name) {
      var from_date=$('#'+from).val(); //bri 
        var to_date=$('#'+to).val(); //smaller
        
        if (from_date<to_date) { //if from is less then to
            $('#'+from).val('');
           $('.modal').modal('hide');
      sweeetalertbtn("Warning",'Date should not be less than '+name+' :'+to_date,'warning');
   
        }
  }
  function refreshSelect(id) {
     $('#'+id).selectmenu('refresh', true);     console.log('refresh');
  }
   $('#airmail_consignee_name').fadeOut('slow');
$(document).on('click', "#airmail_new_con", function(){
   
    $('#airmail_consignee').toggle();
    $('#airmail_consignee_name').toggle();
      $('#airmail_consignee_name').val('');
      $("#airmail_consignee").prop('selectedIndex', 0);
       $('.consignee_city').val('');
                $('.consignee_suburb').val('');
                $('.consignee_street').val('');
                $('.consignee_floor').val('');
                $('.consignee_zip').val('');
                $('.consignee_address').val('');
                $('.consignee_website').val('');
                $('.consignee_landline').val('');
                $('.consignee_fax').val('');
                $('.consignee_email').val('');
                $("#consignee_country").prop('selectedIndex', 0);
                $('.consignee_contact_person').val('');
                $('.consignee_state').val('');
});
$(document).on('click', "#mini_ricksu_modal_btn", function(){
    
    var ricksu_id=$("#ricksu_id").val()
    var vehicle_idMain=$(".vehicle_idMain").val();
    $('#mini_risku_form').each(function(){
        this.reset();
    });

    $.ajax({
        url:'php_action/custom_action.php',
        type:'post',
        data:{action:"checkcurrentLoc",vehicle_id:vehicle_idMain},
        dataType:'json',
        success:function(response){
           $('#mini_ricksu_pickup').val(response[0]);
           $('#ricksu_delivery_date_last').val(response[1]);
            get_auction("port",response[0],'','','yes');

        }
    });
    // var auction=$("#mini_ricksu_pickup").val();
  
     
    //    console.log(auction);


});
 $("#mini_risku_form").on('submit',function(e) {
        e.preventDefault();
            
        
        var form = $('#mini_risku_form');
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function() {
                $('#mini_risku_btn').prop("disabled",true);
                // $('#saveData5').text("Loading...");
            },
            success:function (msg) {
                // alert("Step5");
                $('#mini_ricksu_modal').modal('hide');
                var responeID = msg.trim();
            
                $('#mini_risku_form').each(function(){
                    this.reset();
                });
              
                sweeetalert("DONE",responeID,'success',2000);
                $('#mini_risku_btn').prop("disabled",false);
          
                $("#mini_ricksu_tb").load(location.href + " #mini_ricksu_tb");


             
            }
        });//ajax call
    });//main

function editMiniRicksu(id) {
     $('#mini_risku_form').each(function(){
                    this.reset();
                });
       $.ajax({
            type: 'POST',
            url: 'php_action/custom_action.php',
            data:{action:"editMiniRicksu",id:id},
            dataType: 'json',
            success:function (res) {
                 get_auction("port",res.mini_ricksu_pickup,'','','yes');

                $('#mini_ricksu_company option[value="'+res.ricksu_company+'"]').prop("selected", true); 
                
                     var ricksu_delievery_point=res.ricksu_delievery_point.toUpperCase();
               
                 $('#mini_ricksu_delievery_point option[value="'+ricksu_delievery_point+'"]').prop("selected", true); 
                     $('#mini_ricksu_delievery_point').trigger('change');
                  setTimeout(function() {
                        
                    $('#mini_ricksu_dp_sub_yards option[value="'+res.ricksu_dp_sub_yards+'"]').prop("selected", true);
                    
                
                },2000);

                $('#mini_ricksu_fee').val(res.ricksu_fee);
                $('#mini_ricksu_fee_tax').val(res.ricksu_fee_tax);
                $('#mini_ricksu_pickup').val(res.mini_ricksu_pickup);
                $('#mini_ricksu_note').val(res.ricksu_note);

                $('#ricksu_pickup_date').val(res.ricksu_pickup_date);
                $('#ricksu_delivery_date').val(res.ricksu_delivery_date);
                $('#mini_ricksu_deliever_by').val(res.ricksu_deliever_by);
                $('#mini_ricksu_id').val(res.ricksu_id);
                if (res.ricksu_type=="running") {
                          $('#mini_ricksu_type1').prop("checked", true); 

                }else{
                    $('#mini_ricksu_type2').prop("checked", true);
                }
          
         
            }   
        });
}
function consigneeDetails(id) {
    console.log(id);
       $.ajax({
            type: 'POST',
            url: 'php_action/custom_action.php',
            data:{action:"consigneeDetails",id:id},
            dataType: 'json',
            success:function (res) {

                $('.consignee_city').val(res.consignee_city);
                $('.consignee_suburb').val(res.consignee_suburb);
                $('.consignee_street').val(res.consignee_street);
                $('.consignee_floor').val(res.consignee_floor);
                $('.consignee_zip').val(res.consignee_zip);
                $('.consignee_address').val(res.consignee_address);
                $('.consignee_website').val(res.consignee_website);
                $('.consignee_landline').val(res.consignee_landline);
                $('.consignee_fax').val(res.consignee_fax);
                $('.consignee_email').val(res.consignee_email);
                var consignee_country=res.consignee_country.toUpperCase();    
                $('.consignee_country').val(consignee_country);
                $('.consignee_contact_person').val(res.consignee_contact_person);
                $('.consignee_state').val(res.consignee_state);
               
          
         
            }   
        });
}

function set_inspection(country,fax,tax,type) {
    if (type=="res") {
        $('#reservation_inspection option[value="'+country+'"]').prop("selected", true); 
        $('#reservation_inspection_fee').val(fax);
        $('#reservation_inspection_fee_tax').val(tax);
        getTotalCostPrice();
    }else{
        $('#inspection_info_company option[value="'+country+'"]').prop("selected", true); 

        $('#inspection_info_charges').val(fax);
        $('#inspection_info_charges_tax').val(tax)
    }
   
               
}
$("#airmail_parcel_weight").on('change', function() {
     var airmail_country=$("#airmail_country").val();
     var airmail_parcel_weight=$("#airmail_parcel_weight").val();
     var airmail_services_parcel_type=$("#airmail_services_parcel_type").val();
     $("#airmail_info_modal").modal('show');
    
        $.ajax({
        url:'php_action/custom_action.php',
        type:'post',
        data:{action:"airmail_country_for",country:airmail_country,type:airmail_services_parcel_type,weight:airmail_parcel_weight},
        success:function(response){
        $('#airmail_info_body').html(response);  
           
        }
    });

});
function set_aimail(company,type,weight,fee,tax) {
    // body...
    $('#airmail_services_company option[value="'+company+'"]').prop("selected", true); 
    $('#airmail_parcel_weight option[value="'+weight+'"]').prop("selected", true); 
    $('#airmail_services_parcel_type option[value="'+type+'"]').prop("selected", true); 
    $('#airmail_courier_charges').val(fee);
    $('#airmail_courier_charges_tax').val(tax);
}
$("#expense_auction").on('submit',function(e) {
   // alert("abc");
        e.preventDefault();
        e.stopPropagation(); 
        // only neccessary if something above is listening to the (default-)event too
        var form = $('#expense_auction');
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function() {
                $('#expense_auction_btn').prop("disabled",true);
                
                // $('#saveData1').text("Loading...");
            },
            success:function (msg) {
                var responeID = msg.trim();
                $(".response").html('<div class="alert alert-success text-center">Auction Data Has Bee Uploaded</div>')
                console.log(responeID);
                    setTimeout(function(){ $(".response").fadeOut('slow'); }, 10000);
                    $("#response").focus();
             setTimeout(function(){ location.reload();
                 location.reload();
                    }, 3000);

            
            }
        });//ajax call
    });//main
$("#expense_person").on('submit',function(e) {
   // alert("abc");
        e.preventDefault();
        e.stopPropagation(); 
        // only neccessary if something above is listening to the (default-)event too
        var form = $('#expense_person');
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function() {
                $('#expense_person_btn').prop("disabled",true);
                
                // $('#saveData1').text("Loading...");
            },
            success:function (msg) {
                var responeID = msg.trim();
                $(".response").html('<div class="alert alert-success text-center">Person Data Has Been Uploaded</div>')
                console.log(responeID);
                    setTimeout(function(){ $(".response").fadeOut('slow'); }, 10000);
                    $("#response").focus();
             setTimeout(function(){ location.reload();
                 location.reload();
                    }, 3000);

            
            }
        });//ajax call
    });//main
$("#expense_ricksu").on('submit',function(e) {
   // alert("abc");
        e.preventDefault();
        e.stopPropagation(); 
        // only neccessary if something above is listening to the (default-)event too
        var form = $('#expense_ricksu');
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function() {
                $('#expense_ricksu_btn').prop("disabled",true);
                
                // $('#saveData1').text("Loading...");
            },
            success:function (msg) {
                var responeID = msg.trim();
                $(".response").html('<div class="alert alert-success text-center">Ricksu Data Has Been Uploaded</div>')
                console.log(responeID);
                    setTimeout(function(){ $(".response").fadeOut('slow'); }, 10000);
              
                    $("#response").focus();
             setTimeout(function(){ location.reload();
                 location.reload();
                    }, 3000);

            
            }
        });//ajax call
    });//main

$("#expense_inspection").on('submit',function(e) {
   // alert("abc");
        e.preventDefault();
        e.stopPropagation(); 
        // only neccessary if something above is listening to the (default-)event too
        var form = $('#expense_inspection');
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function() {
                $('#expense_inspection_btn').prop("disabled",true);
                
                // $('#saveData1').text("Loading...");
            },
            success:function (msg) {
                var responeID = msg.trim();
                $(".response").html('<div class="alert alert-success text-center">Inspection Data Has Been Uploaded</div>')
                console.log(responeID);
                    setTimeout(function(){ $(".response").fadeOut('slow'); }, 10000);
             
                  $("#response").focus();
             setTimeout(function(){ location.reload();
                 location.reload();
                    }, 3000);

            }
        });//ajax call
    });//main


$("#expense_shipment").on('submit',function(e) {
   // alert("abc");
        e.preventDefault();
        e.stopPropagation(); 
        // only neccessary if something above is listening to the (default-)event too
        var form = $('#expense_shipment');
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function() {
                $('#expense_shipment_btn').prop("disabled",true);
                
                // $('#saveData1').text("Loading...");
            },
            success:function (msg) {
                var responeID = msg.trim();
                $(".response").html('<div class="alert alert-success text-center">Shipment Data Has Been Uploaded</div>')
                console.log(responeID);
                    setTimeout(function(){ $(".response").fadeOut('slow'); }, 10000);
            
                    $("#response").focus();
             setTimeout(function(){ location.reload();
                 location.reload();
                    }, 3000);

            
            }
        });//ajax call
    });//main
$("#expense_airmail").on('submit',function(e) {
   // alert("abc");
        e.preventDefault();
        e.stopPropagation(); 
        // only neccessary if something above is listening to the (default-)event too
        var form = $('#expense_airmail');
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function() {
                $('#expense_airmail_btn').prop("disabled",true);
                
                // $('#saveData1').text("Loading...");
            },
            success:function (msg) {
                var responeID = msg.trim();
                $(".response").html('<div class="alert alert-success text-center">Airmail Data Has Been Uploaded</div>')
                console.log(responeID);

                    setTimeout(function(){ $(".response").fadeOut('slow'); }, 10000);
                 
            
            $("#response").focus();
             setTimeout(function(){ location.reload();
                 location.reload();
                    }, 3000);
            }
        });//ajax call
    });//main
$("#refund_req_app_fm").fadeOut('slow');
    $("#approved_request_btn").on('click',function() {
    $("#refund_req_app_fm").fadeIn('slow');
});
$("#total_receiver_amount,#inter_bank_charges,#local_bank_charges,#exchange_rate").on('keyup',function() {
    var sub_total=grand_total=total=0;
  var total_receiver_amount=$("#total_receiver_amount").val(); 
  var inter_bank_charges=$("#inter_bank_charges").val(); 
  var local_bank_charges=$("#local_bank_charges").val();
    var exchange_rate=$("#exchange_rate").val();
  if (inter_bank_charges=='') { inter_bank_charges=0; }
  if (local_bank_charges=='') { local_bank_charges=0; } 
  if (exchange_rate=='') { exchange_rate=1; } 

  sub_total=parseInt(local_bank_charges)+parseInt(inter_bank_charges);
  grand_total=parseInt(total_receiver_amount)-sub_total;
  console.log('inter_bank_charges');
  total=grand_total*exchange_rate;
$("#net_amount_received").val(grand_total);
$("#total_amount_recevied").val(total);

});


$("#expense_mini_ricksu").on('submit',function(e) {
   // alert("abc");
        e.preventDefault();
        e.stopPropagation(); 
        // only neccessary if something above is listening to the (default-)event too
        var form = $('#expense_mini_ricksu');
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function() {
                $('#expense_mini_ricksu_btn').prop("disabled",true);
                
                // $('#saveData1').text("Loading...");
            },
            success:function (msg) {
                var responeID = msg.trim();
                $(".response").html('<div class="alert alert-success text-center">Airmail Data Has Been Uploaded</div>')
                console.log(responeID);

                    setTimeout(function(){ $(".response").fadeOut('slow'); }, 10000);
                 
            
            $("#response").focus();
             setTimeout(function(){ location.reload();
                 location.reload();
                    }, 3000);
            }
        });//ajax call
    });//main
$("#inspection_info_sts").on('change',function() {
 var value=$("#inspection_info_sts").val();
 
 if (value=="fail") {
    $('#inspection_info_validity').prop('readonly',true);
 }else{
    $('#inspection_info_validity').prop('readonly',false);
 }

});
$("#shipment_type").on('change',function() {
 var value=$("#shipment_type").val();
 
 if (value=="roro") {
    $('#shipment_hc_code').prop('readonly',true);
    $('#shipment_container_no').prop('readonly',true);
    $('#shipment_voyage_no').prop('readonly',true);
    $('#vehicle_terminal_charges').prop('readonly',true);
    $('#vehicle_terminal_charges_tax').prop('readonly',true);
     $('#vehicle_terminal_charges_box').prop('checked',true);
 }else{
    $('#shipment_hc_code').prop('readonly',false);
    $('#shipment_container_no').prop('readonly',false);
    $('#shipment_voyage_no').prop('readonly',false);
    $('#vehicle_terminal_charges').prop('readonly',false);
    $('#vehicle_terminal_charges_tax').prop('readonly',false);
    $('#vehicle_terminal_charges_box').prop('checked',false);
 }

});

$("#reservation_sale_type").on('change',function() {
    var sale_type=$("#reservation_sale_type").val();
    if (sale_type=="FOB" || sale_type=="LOCAL_SALE") {
        $("#reservation_freight").val('0');
        $("#reservation_freight").prop("readonly",true);
    }else{
        $("#reservation_freight").prop("readonly",false);    
    }
});
$("#expense_services_form").on('submit',function(e) {
   // alert("abc");
        e.preventDefault();
        e.stopPropagation(); 
        // only neccessary if something above is listening to the (default-)event too
        var form = $('#expense_services_form');
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function() {
                $('#expense_services_btn').prop("disabled",true);
                
                // $('#saveData1').text("Loading...");
            },
            success:function (msg) {
                var responeID = msg.trim();
                $(".response").html('<div class="alert alert-success text-center"> Data Has Been Uploaded</div>')
                console.log(responeID);

                    setTimeout(function(){ $(".response").fadeOut('slow'); }, 10000);
                 
            
            $("#response").focus();
             setTimeout(function(){ location.reload();
                 location.reload();
                    }, 3000);
            }
        });//ajax call
    });//main

function currentDateVadilty(id_num,type) {

      var current = $('.current_date').val();
        var id = $('#'+id_num).val();
     
     if (type=="greater") {
        if (current>id) {
            
            alert("Date should be Greater then Current Date");
           $('#'+id_num).val('');
        }
     }

    if (type=="less") {
        if (current<id) {
             alert("Date should not be Greater then Current Date");
        $('#'+id_num).val('');
     }
     }
}
function invoice_exchange() {
     
     var total=0;
    var sub_total_amount=$('#sub_total_amount').val();
    var invoice_exchange_rate=$('#invoice_exchange_rate').val();
    total=parseInt(sub_total_amount)/parseInt(invoice_exchange_rate);
    total=total.toFixed(2);
    $('#grand_total_incurrency').val(total);
    getDiscount();
    
}
function invoice_paid() {
     var total=0;
    var sub_total_amount=$('#paid_amount_incurrency').val();
    var invoice_exchange_rate=$('#invoice_exchange_rate').val();
    total=parseInt(sub_total_amount)*parseInt(invoice_exchange_rate);
       total=total.toFixed(2);
    $('#invoice_paid_amount').val(total);
    getPaid();
    
}
function refresh_select(select_id,tb_id,tb_name,extra='',more_extra=''){

   
    $.ajax({
        url:'php_action/custom_action.php',
        type:'post',
        data:{action:"refresh_select",select_id:select_id},
        dataType:'json',
        success:function(response){
              var y = "";
        
                $.each(response, function (index, value) {
                     if (more_extra=='') {
                             var extra='';
                        }else{
                         var extra="("+value[more_extra]+")";
                        }                   
                y += '<option '+extra+' value="'+value[tb_id]+'">'+value[tb_name]+' '+extra+'</option>'
            });
           Swal.fire({
            icon: "success",
            button: false,
            timer: 1000,
        });
            $('#'+select_id).empty().append(y);
        }
    });
}
function get_auction_loading_yard(vehicle_idMain){
     $.ajax({
            type: 'POST',
            url: 'php_action/custom_action.php',
            data:{get_auction_loading_yard : vehicle_idMain},
            dataType: 'json',
            success:function (msg) {
             
                // $(".consignee_country").val(msg.name)
                $("#ricksu_loading_point").val(msg[0])
                $("#ricksu_sub_yard").val(msg[1])
                 $("#ricksu_sub_yard_name").val(msg[2])
            
            }   
        });
}

function getReservationQue(vehicle_idMain){
     $.ajax({
            type: 'POST',
            url: 'php_action/custom_action.php',
            data:{getReservationQue : vehicle_idMain},
            dataType: 'json',
            success:function (msg) {
             
                // $(".consignee_country").val(msg.name)
                $("#reservation_que").val(msg)
           
            
            }   
        });
}
function getInspectionDetails(vehicle_idMain){
     $.ajax({
            type: 'POST',
            url: 'php_action/custom_action.php',
            data:{getInspectionDetails : vehicle_idMain},
            dataType: 'json',
            success:function (msg) {
                                $('#inspection_info_company option[value="'+msg[2]+'"]').prop("selected", true); 

            $('#inspection_info_company').prop("disabled", true);
             $('#inspection_info_company option[value="'+msg[2]+'"]').prop("disabled", false);
        
                $("#inspection_info_point").val(msg[0]+"-"+msg[1]);
                 setTimeout(function(){   
                    $('#inspection_info_charges').val(msg[3]);
                    $('#inspection_info_charges_tax').val(msg[4]);
           
                    }, 2000);
              
            
            }   
        });
}
function setShipmentsDets(vehicle_idMain){
     $.ajax({
            type: 'POST',
            url: 'php_action/custom_action.php',
            data:{setShipmentsDets : vehicle_idMain},
            dataType: 'json',
            success:function (msg) {
            $('#shipment_type option[value="'+msg[0]+'"]').prop("selected", true);
            $('#shipment_type').prop("disabled", true);
             $('#shipment_type option[value="'+msg[0]+'"]').prop("disabled", false);
             $('#shipment_destination').val(msg[1]);
             $('#shipment_country').val(msg[2]);
             $('#shipment_port_of_discharge').val(msg[3]);
             $('#shipment_port_of_discharge_nm').val(msg[4]);
                    
            }   
        });
}
function getCurrent_user_details(col_name){
     $.ajax({
            type: 'POST',
            url: 'php_action/custom_action.php',
            data:{getCurrent_user_details :col_name},
            dataType: 'text',
            success:function (response) {
                var res=response.trim();
                console.log(res);
               return res;
            },error: function() {
            alert('Error occured');
        }   
        });
}
function getTotalCostPrice() {
     setTimeout(function() {
            $("#reservation_inspection_fee").trigger('keyup'); 
        },1000);
     
    var sold_price=port_fee=freight=total_cost=transportation_cost=0;
    sold_price=$('#reservation_sold_price').val();
    transportation_cost=$('#reservation_transportation_cost').val();
    port_fee=$('#reservation_inspection_fee').val();
    port_fee_tax=$('#reservation_inspection_fee_tax').val();
    freight=$('#reservation_freight').val();
    sold_price=(sold_price=='')?(sold_price=0):(parseFloat(sold_price));
    transportation_cost=(transportation_cost=='')?(transportation_cost=0):(parseFloat(transportation_cost));
    port_fee=(port_fee=='')?(port_fee=0):(parseFloat(port_fee));
    freight=(freight=='')?(freight=0):(parseFloat(freight));
    port_fee_tax=(port_fee_tax=='')?(port_fee_tax=0):(parseFloat(port_fee_tax));
    
    total_cost=sold_price+port_fee+freight+port_fee_tax+transportation_cost;

    $('#reservation_total_cost').val(total_cost);



}

 $("#inspection_info_Details").on('click', function() {
     var inspection_info_for=$("#inspection_info_for").val();
     $("#inspection_info_modal").modal('show');
    
        $.ajax({
        url:'php_action/custom_action.php',
        type:'post',
        data:{action:"inspection_info_for_get",id:inspection_info_for,type:"ins"},
        success:function(response){
        $('#inspection_info_body').html(response);  
           
        }
    });

});

$("#reservation_country").on('change', function() {
     var reservation_country=$("#reservation_country").val();
     $("#reservation_inspection").prop('selectedIndex', 0);
      $("#reservation_inspection_fee").val(0);
      $("#reservation_inspection_fee_tax").val(0);
    
     
       $.ajax({
        url:'php_action/custom_action.php',
        type:'post',
        dataType:"json",
        data:{action:"inspection_info_for_check",id:reservation_country},
        success:function(response){
            if (response[3]==1) {
                set_inspection(response[0],response[1],response[2],'res');
            }else{

                $("#inspection_info_modal").modal('show');

        $.ajax({
        url:'php_action/custom_action.php',
        type:'post',
        data:{action:"inspection_info_for_get",id:reservation_country,type:"res"},
        success:function(response){
        $('#inspection_info_body').html(response);  
           
        }
    });

            }
         
           
        }
    });
       

});
$("#airmail_approval_status").on('change', function() {
     var airmail_approval_status=$("#airmail_approval_status").val();
     if(airmail_approval_status=="decline"){
        $("#airmail_decline_note").prop('readonly',false);
     }else{
        $("#airmail_decline_note").prop('readonly',true);
     }

});
