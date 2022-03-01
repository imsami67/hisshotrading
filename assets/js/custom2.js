 manageinterior_grade = $('#leadscustomer').DataTable({
        stateSave: true,
        'autoWidth'   : true,
        "responsive": true,
        "ajax": {
            url: "php_action/custom_action2.php", // json datasource
            data: {action: 'leadsCustomer'},
            type: 'post',  // method  , by default get
        },
        'order': []     
    }); 



  //Save Data into Database
$('#formDatafinal2').submit(function(){
    
    event.preventDefault();
     var form = $('#formDatafinal');
        alert("anc");
        
        // event.preventDefault();
        // var form = $('#formData');
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend:function() {
                alert("abncd");
                $('#saveData').attr("disabled","disabled");
                // $('#saveData').text("Loading...");
                $(".loaderAjax").show(); 
                refereshdocs();
            },
            success:function (msg) {
                
               
            }
        });//ajax call
   });
