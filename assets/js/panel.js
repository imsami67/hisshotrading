// currentLocat=window.location.href;
// var url = new URL(currentLocat);
// var view = url.searchParams.get("edit_quotation_id");

$(document).ready(function () {

  

      $('.dataTable').DataTable(
      {
        autoWidth: true,
        "lengthMenu": [
          [10, 20, 50, -1],
          [10, 20, 50, "All"]
        ],
         "order": [[ 0, "desc" ]]
      });
         $('.credit_order').DataTable(
      {
        autoWidth: true,
        "lengthMenu": [
          [10, 20, 50, -1],
          [10, 20, 50, "All"]
        ],
         "order": [[ 6, "asc" ]]
      });
      $('.searchableSelect').select2(
      {
        theme: 'bootstrap4',
      });
      $('.selectMulti').select2(
      {
        multiple: true,
        theme: 'bootstrap4',
      });
   // $('.my-colorpicker2').colorpicker();

   //  $('.my-colorpicker2').on('colorpickerChange', function(event) {
   //    $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
   //  });

   $( "#post_list" ).sortable({
      placeholder : "ui-state-highlight",
      update  : function(event, ui)
      {
        var post_order_ids = new Array();
        $('#post_list li').each(function(){
          post_order_ids.push($(this).data("post-id"));
        });
        $.ajax({
              url:"php_action/panel.php",
              method:"POST",
              data:{sortable_img:"sortable_img",post_order_ids:post_order_ids},
              success:function(data)
              {   
              }
                    
                });
      }
    });
}); //end of jquery ready
 

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
$("#add_nav_menus_fm").on('submit',function(e) {

        e.preventDefault();
        e.stopPropagation(); 
        var form = $('#add_nav_menus_fm');
      var nav_page=$('#nav_page').val();
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
                sweeetalert("Menu has been Added",'success',2000);
                $("#add_nav_table").load(location.href + " #add_nav_table");
                }
                if (responeID.sts=="info") {
                sweeetalert("Menu has been Updated",'info',2000);
                $("#add_nav_table").load(location.href + " #add_nav_table");
                }
                if (nav_page=="#") {
                    location.reload();
                }
 
            
            }
        });//ajax call
    });//main    

function sweeetalert(text,status,time) {
  Swal.fire({
    position: 'center',
    icon: status,
    title:text,
    showConfirmButton: false,
    timer: time
  });
}
function sameValue(id,id2) {
   $(''+id2).val(id);
}
function resetForm(id) {
  document.getElementById(id).reset();
}

function deleteAlert(id,table,row,reload_type){
  Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {

    $.ajax({
      url: 'php_action/ajax_deleteData.php',
      type: 'post',
      data: {delete_bymanually:id,table:table,row:row},
      dataType: 'json',
      success:function(response) {
        //console.log(response);
          if (response.sts=="success") {
             if (reload_type!="pg") {
                $("#"+reload_type).load(location.href+" #"+reload_type+" > *");
             }else{
              location.reload();
             }
          }
           
             Swal.fire(
      'Deleted!',
      response.msg,
      response.sts,
    )   
           

            }   
                
            
        });//ajax 
    console.log("Deleted");
   
  }
})
}
function reload_page() {
  location.reload();
}