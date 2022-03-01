   $(document).on('click', '.todo-check label', function() {
            $(this).parents('li').children('.todo-title').toggleClass('line-through');
            var id=$(this).data('id');
        if($("#todo-check"+id).prop("checked") == true){
          var value=0;
          
            }
    else if($("#todo-check"+id).prop("checked") == false){
             var value=1;
    }
    console.log(value);
          $.ajax({
            type: 'POST',
            url: 'php_action/panel.php',
            data: {setTodoList:id,value:value},
            dataType:"json",
            success:function (response) {
           
                sweeetalert("Done",response.msg,response.sts,2000);
                
            }
        });//ajax call }
        });
        $(document).on('click', '.todo-remove', function() {
            $(this).closest("li").remove();
            return false;
        });

currentLocat=window.location.href;
var url = new URL(currentLocat);
// var view = url.searchParams.get("edit_quotation_id");
// console.log(url.pathname);
$(document).ready(function () {
 $('.data_table').DataTable();
  $(function() {
    $( ".futuresDate" ).datepicker({  maxDate: new Date()  });

    
         $('.only_year').datepicker( {
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'yy',
        onClose: function(dateText, inst) { 
            var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
            var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
            $(this).datepicker('setDate', new Date(year, 1));
        }
    });

  $(".only_year").focus(function () {
        $(".ui-datepicker-month").hide();
    });
  });

   });  



 $("#order_sale_form").on('submit',function(e) {
        e.preventDefault();
        var form = $('#order_sale_form');
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
                console.log(msg);
                var responeID = msg.trim()
                 $('#nameClient').focus();
                 //$(".response").html('<div class="alert alert-success text-center">'+msg+'</div>').fadeOut(2000);
                  sweeetalert("Done",responeID,'info',2000);
                
                $('#order_sale_form').each(function(){
                    this.reset();
                });
            }
        });//ajax call
    });//main
  $("#employee_fm").on('submit',function(e) {
        e.preventDefault();
        var form = $('#employee_fm');
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function() {
               $('#employee_btn').prop("disabled",true);
            },
            success:function (msg) {
               // console.log(msg);
                $('#employee_fm').each(function(){
                    this.reset();
                });
                var responeID = msg.trim()
                 $('#nameClient').focus();
                 $('#employee_btn').prop("disabled",false);
                  sweeetalert("Done",responeID,'success',3000);                
                // $('#employee_fm').each(function(){
                //     this.reset();
                // });
            }
        });//ajax call
    });//main
  $("#changeState_form").on('submit',function(e) {
    
        e.preventDefault();
        var form = $('#changeState_form');
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: form.serialize(),
            dataType:'json',
            beforeSend:function() {
                $('#changeState_btn').prop("disabled",true);
                // $('#saveData12').text("Loading...");
            },
            success:function (res) {
                console.log(res.msg);
                 $('#changeState_btn').prop("disabled",false);
              
              
if (res.sts=="success") {
                  $("#order_type_table").load(location.href+" #order_type_table");
                  }
                 //$(".response").html('<div class="alert alert-success text-center">'+msg+'</div>').fadeOut(2000);
                  sweeetalert(res.sts,res.msg,res.sts,2500);
                
               
            }
        });//ajax call
    });//main

 function payPayment(id) {
    console.log(id);
      // var pending_amount=  $('#pending_amount').val();
      // var amount_payable=  $('#amount_payable').val();
         var amount_paid=  $('#amount_paid').val();
         var payment_coment1=  $('#payment_coment1').val();
         var payment_coment2=  $('#payment_coment2').val();

        if (amount_paid!='' || amount_paid!='0') {
                $.ajax({
            type: 'POST',
            url: 'php_action/custom_action.php',
            data: {payPayment:id,amount_paid:amount_paid,payment_coment1:payment_coment1,payment_coment2:payment_coment2},
            dataType:"json",
            success:function (msg) {

                  sweeetalert("Done",msg.msg,'success',2000);
                  
                 $('#amount_paid').val('0');
                $('#pending_amount').val(msg.sts);
            }
        });//ajax call }
   }else{
     sweeetalert("Error",'Amount to Pay: should not be empty','error',2000);
   }

   }
   
$("#amount_paid").on('keyup',function() {
  $('#payto_payment_agree_btn').prop("disabled",false);
});

    $("#order_type_btn").on('click',function() {
        var value=  $('#order_type_get :selected').val();
        var from_date=  $('#from_date').val();
        var to_date=  $('#to_date').val();
         $.ajax({
            type: 'POST',
            url: 'php_action/custom_action.php',
            data: {order_type_get:value,from_date:from_date,to_date:to_date},
            dataType:"text",
            success:function (msg) {
              var res=msg.trim();
               $("#order_type_tb").empty().html(res);
                
            }
        });//ajax call }
    });
     $("#add_product_fm").on('submit',function(e) {
        e.preventDefault();
        var form = $('#add_product_fm');
        $.ajax({
            type: 'POST', 
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function() {
                 $('#add_product_btn').prop("disabled",true);
                 },
            success:function (msg) {
                console.log(msg);
                  $('#add_product_fm').each(function(){
                    this.reset();
                });
                var responeID = msg.trim()
                  $('#add_product_btn').prop("disabled",false);
                    $("#add_product_tb").load(location.href+" #add_product_tb");
                  sweeetalert("Done",responeID,'info',2000);
                
                
            }
        });//ajax call
    });//main
        $("#custom_privileges_form").on('submit',function(e) {
        e.preventDefault();
        var form = $('#custom_privileges_form');
        $.ajax({
            type: 'POST', 
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function() {
                 $('#custom_privileges_btn').prop("disabled",true);
                 },
            success:function (msg) {
                console.log(msg);
                 
                var responeID = msg.trim()
                  $('#custom_privileges_btn').prop("disabled",false);
                  
                  sweeetalert("Done",responeID,'success',2000);
                
                
            }
        });//ajax call
    });//main
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
            dataType:"json",
            beforeSend:function() {
                 $('#formData_btn').prop("disabled",true);
                 },
            success:function (msg) {
              if (msg.sts=="success") {
                  $('#formData').each(function(){
                    this.reset();
                });

                  
                  $("#tableData").load(location.href+" #tableData > *"); 
              }    $('#formData_btn').prop("disabled",false); 
                  sweeetalert("Done",msg.msg,msg.sts,2000);
                
                
            }
        });//ajax call
    });//main
  $("#new_req_rejected").on('click',function() {
        var request_id=$("#new_req_id").val();
        var status=$("#new_req_status").val();
         Swal.fire({
            title: 'Do you want to reject it?',
            icon: 'error',
          showDenyButton: true,
          showCancelButton: true,
          confirmButtonText: `Save`,
          denyButtonText: `Don't save`,
            })
            .then((result) => {
              if (result.isConfirmed) {
                $.ajax({
                  type: 'POST',
                  url:"php_action/emloyee.php",
                  data:{request_change_stat:request_id,status:status,type:"rejected"},
                  success:function (msg) {
                    var responeID = msg.trim()
                    if (responeID!="error") {
                      $("#employment_requests_stat").html(responeID);
                       Swal.fire("Request has been Rejected Successfully", {
                        icon: "success",
                      });
                
                    }                 
                      
                  }
              });//ajax call

                
              }
            });

      }); 
    $("#new_req_approved").on('click',function() {
        var request_id=$("#new_req_id").val();
        var status=$("#new_req_status").val();
      var OldStat=  $("#employment_requests_stat").text();
      console.log(OldStat);
      if (OldStat=="ASPIRANTES" || OldStat=="REJECTED") {
        var accpt="Convocado";
        var deny="Rechazado";
        
      }else if (OldStat=="CONVOCADOS" || OldStat=="ABSENT") {
         var accpt="Entrevistado";
        var deny="Ausente";
      }else if (OldStat=="ENTREVISTADOS" || OldStat=="NO_APROBADOS") {
         var accpt="Approved";
        var deny="Not Approved";
      }

        Swal.fire({
            title: 'Deseas aprobar al postulante?',
            icon: 'success',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText:accpt,
            denyButtonText:deny,
          
            })
            .then((main_result) => {
              if (main_result.isConfirmed) {

                $.ajax({
                  type: 'POST',
                  url:"php_action/emloyee.php",
                  data:{request_change_stat:request_id,status:status,type:"approved"},
                  success:function (msg) {
                    var responeID = msg.trim()
                    if (responeID!="error") {
                      $("#employment_requests_stat").html(responeID);
                      $("#employment_requests_tb").load(location.href+" #employment_requests_tb > *"); 
             
 if (OldStat=="ASPIRANTES") {                       
 Swal.fire({
  title: '<strong>Interview Time & Date</strong>',
  icon: 'info',
  html:
    '<label>Time</label>'+
    '<input type="time" class="form-control" id="send_int_time">'+
    '<label>Date</label>'+
    '<input type="date" class="form-control" id="send_int_date">',
  showCloseButton: true,
  showCancelButton: true,
  focusConfirm: false,
  confirmButtonText:
    'Send Email',
  confirmButtonAriaLabel: 'Thumbs up, great!',
  cancelButtonText:
    'cancle',
  cancelButtonAriaLabel: 'Thumbs down'
})  .then((result) => {
              if (result.isConfirmed) {
  var send_int_time=$("#send_int_time").val();
  var send_int_date=$("#send_int_date").val();
      $.ajax({
                  type: 'POST',
                  url:"php_action/emloyee.php",
                  data:{send_mail_to:request_id,time:send_int_time,date:send_int_date},
                  success:function (msg) {
                    var responeID = msg.trim()
                    if (responeID!="error") {
                     // $("#employment_requests_stat").html(responeID);
                    
                     Swal.fire(
                        'Hecho',
                        'El correo se ha enviado correctamente',
                        'success'
                      )
                          }else{
                           
                            Swal.fire(
                                      'Error',
                                      'Email sending failed...',
                                      'error'
                                        );
                          }               
                      
                  }
              });//ajax2 call

    }
  });  
  }else{
    Swal.fire(
                        'Done',
                        'Email Has Been Sent',
                        'success'
                      )
  }         


                   }else{
                    Swal.fire(
                                      'Something is Wrong',
                                      'Email sending failed...',
                                      'error'
                                        );
                   }             
                      
                  }
              });//ajax call

                
              }else if (main_result.isDenied) {
           $.ajax({
                  type: 'POST',
                  url:"php_action/emloyee.php",
                  data:{request_change_stat:request_id,status:status,type:"rejected"},
                  success:function (msg) {
                    var responeID = msg.trim()
                    if (responeID!="error") {
                      $("#employment_requests_stat").html(responeID);
                       Swal.fire("Request has been Rejected Successfully", {
                        icon: "success",
                      });
                
                    }                 
                      
                  }
              });//ajax call
  }
            });

      });

function upload_image() 
{
  var bar = $('#bar');
  var percent = $('#percent');
  $('#myForm').ajaxForm({
    beforeSubmit: function() {
      document.getElementById("progress_div").style.display="block";
      var percentVal = '0%';
      bar.width(percentVal)
      percent.html(percentVal);
    },

    uploadProgress: function(event, position, total, percentComplete) {
      var percentVal = percentComplete + '%';
      bar.width(percentVal)
      percent.html(percentVal);
    },
    
  success: function() {
      var percentVal = '100%';
      bar.width(percentVal)
      percent.html(percentVal);
    },

    complete: function(xhr) {
      if(xhr.responseText)
      {
        document.getElementById("output_image").innerHTML=xhr.responseText;
      }
    }
  }); 
} 


